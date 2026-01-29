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

class SendReplyEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $quoteRequest;
    public $replyMessage;
    public $tries = 3;
    public $timeout = 120;
    public $backoff = [60, 300, 900]; // Added backoff

    private $emailLog; // Added email log

    public function __construct(QuoteRequest $quoteRequest, $replyMessage)
    {
        $this->quoteRequest = $quoteRequest;
        $this->replyMessage = $replyMessage;
    }

    public function handle()
    {
        try {
            DB::beginTransaction();

            // Create email log entry
            $this->emailLog = EmailLog::create([
                'quote_request_id' => $this->quoteRequest->id, // Agar EmailLog mein quote_request_id column hai
                'email_type' => 'reply',
                'recipient_email' => $this->quoteRequest->customer_email,
                'recipient_name' => $this->quoteRequest->customer_name ?? 'Customer',
                'subject' => 'Reply from ' . config('app.name'),
                'status' => 'pending',
                'attempt_number' => $this->attempts(),
            ]);

            // Send email
            Mail::raw($this->replyMessage, function ($message) {
                $message->to($this->quoteRequest->customer_email)
                    ->subject('Reply from ' . config('app.name'));
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
                'title' => 'Reply Email Sent', // Added title
                'details' => "Email sent to {$this->quoteRequest->customer_email}: " .
                    substr($this->replyMessage, 0, 100) .
                    (strlen($this->replyMessage) > 100 ? '...' : '') .
                    ($this->attempts() > 1 ? " (Attempt #{$this->attempts()})" : ""),
            ]);

            // Auto-update status
            if ($this->quoteRequest->quote_status === 'new') {
                $oldStatus = $this->quoteRequest->quote_status;
                $this->quoteRequest->update(['quote_status' => 'pending']);

                QuoteActivity::create([
                    'quote_request_id' => $this->quoteRequest->id,
                    'type' => 'status_change', // Changed from 'other'
                    'title' => 'Quote Status Updated',
                    'details' => "Status automatically changed from '{$oldStatus}' to 'pending' after reply email sent"
                ]);
            }

            DB::commit();

            Log::info('Reply email sent successfully', [
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
                        'title' => 'Reply Email Failed',
                        'details' => "Attempt #{$this->attempts()} failed to send reply to {$this->quoteRequest->customer_email}. " .
                            "Error: " . substr($e->getMessage(), 0, 150) .
                            (strlen($e->getMessage()) > 150 ? '...' : ''),
                    ]);
                } catch (\Exception $activityException) {
                    Log::error('Failed to create activity log', [
                        'error' => $activityException->getMessage()
                    ]);
                }
            }

            Log::error('Reply Email Job Error: ' . $e->getMessage(), [
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
                    'title' => 'Reply Email Permanently Failed',
                    'details' => "Reply email failed after {$this->tries} attempts to {$this->quoteRequest->customer_email}. " .
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

        Log::error('Reply Email Failed After All Retries', [
            'quote_id' => $this->quoteRequest->id,
            'customer_email' => $this->quoteRequest->customer_email ?? 'N/A',
            'error' => $exception->getMessage()
        ]);
    }
}
