<?php

namespace App\Jobs;

use App\Models\QuoteRequest;
use App\Models\QuoteActivity;
use App\Models\EmailLog;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf;

class SendQuoteEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $quoteRequest;
    public $tries = 3;
    public $timeout = 120;
    public $backoff = [60, 300, 900]; // Added backoff

    private $emailLog; // Added email log

    public function __construct(QuoteRequest $quoteRequest)
    {
        $this->quoteRequest = $quoteRequest;
    }

    public function handle()
    {
        try {
            DB::beginTransaction();

            // Load products with images
            $this->quoteRequest->load('products.images');

            // Generate quote number
            $quoteNumber = 'QT-' . now()->format('Ymd') . '-' . str_pad($this->quoteRequest->id, 5, '0', STR_PAD_LEFT);

            // Create email log entry
            $this->emailLog = EmailLog::create([
                'quote_request_id' => $this->quoteRequest->id,
                'email_type' => 'quote',
                'recipient_email' => $this->quoteRequest->customer_email,
                'recipient_name' => $this->quoteRequest->customer_name ?? 'Customer',
                'subject' => 'Quote Request - ' . $quoteNumber,
                'status' => 'pending',
                'attempt_number' => $this->attempts(),
            ]);

            // Calculate totals
            $subtotal = 0;
            $products = [];

            foreach ($this->quoteRequest->products as $product) {
                $price = $product->pivot->price ?? $product->price;
                $quantity = $product->pivot->quantity ?? 1;
                $productSubtotal = $price * $quantity;
                $subtotal += $productSubtotal;

                $imageUrl = null;
                if ($product->images && $product->images->first()) {
                    $imagePath = storage_path('app/public/' . $product->images->first()->image);
                    if (file_exists($imagePath)) {
                        $imageUrl = asset('storage/' . $product->images->first()->image);
                    }
                }

                $products[] = [
                    'name' => $product->name,
                    'sku' => $product->sku ?? 'N/A',
                    'brand' => $product->brand ?? 'N/A',
                    'model' => $product->model ?? 'N/A',
                    'quantity' => $quantity,
                    'price' => $price,
                    'subtotal' => $productSubtotal,
                    'image' => $imageUrl
                ];
            }

            $taxRate = 0;
            $taxAmount = $subtotal * ($taxRate / 100);
            $total = $subtotal + $taxAmount;

            $data = [
                'quote' => $this->quoteRequest,
                'products' => $products,
                'subtotal' => $subtotal,
                'tax_rate' => $taxRate,
                'tax_amount' => $taxAmount,
                'total' => $total,
                'quote_number' => $quoteNumber
            ];

            // Generate PDF
            $pdf = Pdf::loadView('emails.quote-invoice-pdf', $data)
                ->setPaper('a4', 'portrait')
                ->setOption('defaultFont', 'DejaVu Sans');

            $pdfContent = $pdf->output();

            // Send email with PDF
            Mail::send('emails.quote-details', $data, function ($message) use ($pdfContent, $quoteNumber) {
                $message->to($this->quoteRequest->customer_email)
                    ->subject('Quote Request - ' . $quoteNumber)
                    ->attachData($pdfContent, 'quote-' . $quoteNumber . '.pdf', [
                        'mime' => 'application/pdf',
                    ]);
            });

            // Update email log - SUCCESS
            $this->emailLog->update([
                'status' => 'sent',
                'sent_at' => now(),
            ]);

            // Log activity with title
            QuoteActivity::create([
                'quote_request_id' => $this->quoteRequest->id,
                'type' => 'email',
                'title' => 'Quote Email Sent', // Added title
                'details' => "Quote details and invoice PDF sent to {$this->quoteRequest->customer_email}" .
                    ($this->attempts() > 1 ? " (Attempt #{$this->attempts()})" : "")
            ]);

            // Auto-update status
            if ($this->quoteRequest->quote_status === 'new') {
                $oldStatus = $this->quoteRequest->quote_status;
                $this->quoteRequest->update(['quote_status' => 'pending']);

                QuoteActivity::create([
                    'quote_request_id' => $this->quoteRequest->id,
                    'type' => 'status_change', // Changed from 'other'
                    'title' => 'Quote Status Updated',
                    'details' => "Status automatically changed from '{$oldStatus}' to 'pending' after quote email sent"
                ]);
            }

            DB::commit();

            Log::info('Quote sent successfully', [
                'quote_id' => $this->quoteRequest->id,
                'email' => $this->quoteRequest->customer_email,
                'attempt' => $this->attempts(),
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            // Update email log - FAILED
            if (isset($this->emailLog)) {
                $this->emailLog->update([
                    'status' => 'failed',
                    'error_message' => $e->getMessage(),
                ]);

                // CREATE ACTIVITY - Email Failed
                try {
                    QuoteActivity::create([
                        'quote_request_id' => $this->quoteRequest->id,
                        'type' => 'email',
                        'title' => 'Quote Email Failed',
                        'details' => "Attempt #{$this->attempts()} failed to send quote to {$this->quoteRequest->customer_email}. " .
                            "Error: " . substr($e->getMessage(), 0, 150) .
                            (strlen($e->getMessage()) > 150 ? '...' : ''),
                    ]);
                } catch (\Exception $activityException) {
                    Log::error('Failed to create activity log', [
                        'error' => $activityException->getMessage()
                    ]);
                }
            }

            Log::error('Send Quote Job Error: ' . $e->getMessage(), [
                'quote_id' => $this->quoteRequest->id,
                'attempt' => $this->attempts(),
                'trace' => $e->getTraceAsString()
            ]);

            throw $e; // Changed from $this->fail($e)
        }
    }

    public function failed(\Throwable $exception)
    {
        if (isset($this->emailLog)) {
            $this->emailLog->update([
                'status' => 'failed',
                'error_message' => 'Failed after ' . $this->tries . ' attempts: ' . $exception->getMessage(),
            ]);

            // CREATE ACTIVITY - Final Failure
            try {
                QuoteActivity::create([
                    'quote_request_id' => $this->quoteRequest->id,
                    'type' => 'email',
                    'title' => 'Quote Email Permanently Failed',
                    'details' => "Quote delivery failed after {$this->tries} attempts to {$this->quoteRequest->customer_email}. " .
                        "Last error: " . substr($exception->getMessage(), 0, 150) .
                        (strlen($exception->getMessage()) > 150 ? '...' : '') .
                        ". Please check email configuration or contact customer manually.",
                ]);
            } catch (\Exception $activityException) {
                Log::error('Failed to create final failure activity', [
                    'error' => $activityException->getMessage()
                ]);
            }
        }

        Log::error('Quote Email Failed After All Retries', [
            'quote_id' => $this->quoteRequest->id,
            'customer_email' => $this->quoteRequest->customer_email ?? 'N/A',
            'error' => $exception->getMessage()
        ]);
    }
}
