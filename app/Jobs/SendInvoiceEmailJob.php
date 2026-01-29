<?php

namespace App\Jobs;

use App\Models\Order;
use App\Models\EmailLog;
use App\Models\OrderActivity;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf;

class SendInvoiceEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $order;
    public $tries = 3;
    public $timeout = 120;
    public $backoff = [60, 300, 900];

    private $emailLog;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function handle()
    {
        try {
            DB::beginTransaction();

            // Load relationships
            $this->order->load(['client', 'products']);

            // Create email log entry
            $this->emailLog = EmailLog::create([
                'order_id' => $this->order->id,
                'email_type' => 'invoice',
                'recipient_email' => $this->order->client->email,
                'recipient_name' => $this->order->client->name,
                'subject' => 'Invoice - Order #' . $this->order->order_number,
                'status' => 'pending',
                'attempt_number' => $this->attempts(),
            ]);

            // Generate PDF
            $pdf = Pdf::loadView('pages.admin-side.orders.print', ['order' => $this->order])
                ->setPaper('a4', 'portrait')
                ->setOption('defaultFont', 'DejaVu Sans');

            $pdfContent = $pdf->output();

            // Send email
            Mail::send('emails.invoice', ['order' => $this->order], function ($message) use ($pdfContent) {
                $message->to($this->order->client->email, $this->order->client->name)
                    ->subject('Invoice - Order #' . $this->order->order_number)
                    ->attachData($pdfContent, 'invoice-' . $this->order->order_number . '.pdf', [
                        'mime' => 'application/pdf',
                    ]);
            });

            // Update email log - SUCCESS
            $this->emailLog->update([
                'status' => 'sent',
                'sent_at' => now(),
            ]);

            // CREATE ACTIVITY - Email Sent Successfully
            OrderActivity::create([
                'order_id' => $this->order->id,
                'type' => 'email',
                'title' => 'Invoice Email Sent',
                'details' => "Invoice successfully sent to {$this->order->client->email}" .
                    ($this->attempts() > 1 ? " (Attempt #{$this->attempts()})" : ""),
            ]);

            // Update order status and tracking
            $updateData = ['invoice_sent_at' => now()];

            if ($this->order->status === 'new') {
                $oldStatus = $this->order->status;
                $updateData['status'] = 'processing';

                $this->order->update($updateData);

                // CREATE ACTIVITY - Status Changed
                OrderActivity::create([
                    'order_id' => $this->order->id,
                    'type' => 'status_change',
                    'title' => 'Order Status Updated',
                    'details' => "Status automatically changed from '{$oldStatus}' to 'processing' after invoice was sent successfully",
                ]);
            } else {
                $this->order->update($updateData);
            }

            DB::commit();

            Log::info('Invoice sent successfully', [
                'order_id' => $this->order->id,
                'email' => $this->order->client->email,
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
                    OrderActivity::create([
                        'order_id' => $this->order->id,
                        'type' => 'email',
                        'title' => 'Invoice Email Failed',
                        'details' => "Attempt #{$this->attempts()} failed to send invoice to {$this->order->client->email}. " .
                            "Error: " . substr($e->getMessage(), 0, 150) .
                            (strlen($e->getMessage()) > 150 ? '...' : ''),
                    ]);
                } catch (\Exception $activityException) {
                    Log::error('Failed to create activity log', [
                        'error' => $activityException->getMessage()
                    ]);
                }
            }

            Log::error('Send Invoice Job Error: ' . $e->getMessage(), [
                'order_id' => $this->order->id,
                'attempt' => $this->attempts(),
                'trace' => $e->getTraceAsString()
            ]);

            throw $e;
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
                OrderActivity::create([
                    'order_id' => $this->order->id,
                    'type' => 'email',
                    'title' => 'Invoice Email Permanently Failed',
                    'details' => "Invoice delivery failed after {$this->tries} attempts to {$this->order->client->email}. " .
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

        Log::error('Invoice Email Failed After All Retries', [
            'order_id' => $this->order->id,
            'client_email' => $this->order->client->email ?? 'N/A',
            'error' => $exception->getMessage()
        ]);
    }
}
