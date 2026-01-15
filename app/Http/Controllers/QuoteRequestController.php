<?php

namespace App\Http\Controllers;

use App\Models\QuoteRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;


class QuoteRequestController extends Controller
{
    // Store quote request (single or bulk)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:30',
            'customer_email' => 'required|email|max:50',
            'customer_phone' => 'nullable|string|max:20',
            'customer_message' => 'nullable|string',
            'total_quantity' => 'nullable|integer|min:1',
            'products' => 'required|array|min:1',
            'products.*' => 'exists:products,id',
            'quantities' => 'nullable|array',
            'quantities.*' => 'nullable|integer|min:1'
        ]);

        try {
            DB::beginTransaction();

            // Create quote request
            $quoteRequest = QuoteRequest::create([
                'customer_name' => $validated['customer_name'],
                'customer_email' => $validated['customer_email'],
                'customer_phone' => $validated['customer_phone'] ?? null,
                'customer_message' => $validated['customer_message'] ?? null,
                'total_quantity' => $validated['total_quantity'] ?? null,
                'status' => 'pending'
            ]);

            // Attach products with quantities
            foreach ($validated['products'] as $index => $productId) {
                $quantity = $validated['quantities'][$index] ?? 1;

                $quoteRequest->products()->attach($productId, [
                    'quantity' => $quantity
                ]);
            }

            DB::commit();

            // Send email notification (optional)
            $this->sendQuoteNotification($quoteRequest);

            return response()->json([
                'success' => true,
                'message' => 'Quote request submitted successfully!',
                'data' => $quoteRequest->load('products')
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Failed to submit quote request. Please try again.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // Admin: View all quote requests
    public function index()
    {
        $quoteRequests = QuoteRequest::with('products')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('pages.admin-side.quotes.index', compact('quoteRequests'));
    }

    // Admin: View single quote request
    public function show($id)
    {
        $quoteRequest = QuoteRequest::with('products')->findOrFail($id);

        return view('pages.admin-side.quotes.show', compact('quoteRequest'));
    }

    // Admin: Update status
    public function updateStatus(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:quote_requests,id',
            'status' => 'required|in:pending,processing,completed,cancelled'
        ]);

        $quote = QuoteRequest::findOrFail($request->id);
        $quote->status = $request->status;
        $quote->save();

        return response()->json([
            'success' => true,
            'status' => $quote->status
        ]);
    }

    // Admin: Delete quote request
    public function destroy($id)
    {
        try {
            $quoteRequest = QuoteRequest::findOrFail($id);
            $quoteRequest->delete();

            return redirect()->route('admin.quotes.index')
                ->with('success', 'Quote request deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->route('admin.quotes.index')
                ->with('error', 'Failed to delete quote request.');
        }
    }

    public function reply(Request $request, $id)
    {
        $quoteRequest = QuoteRequest::findOrFail($id);

        if (!$quoteRequest->customer_email) {
            return back()->with('error', 'No email found for this customer!');
        }

        $request->validate([
            'reply_message' => 'required|string|max:5000',
        ]);

        try {
            // Send email
            Mail::raw($request->reply_message, function ($message) use ($quoteRequest) {
                $message->to($quoteRequest->customer_email)
                    ->subject('Reply from ' . config('app.name'));
            });

            // Optionally mark as replied
            $quoteRequest->update([
                'is_replied' => true,
                'replied_at' => now(),
            ]);

            return back()->with('success', 'Reply sent successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to send reply: ' . $e->getMessage());
        }
    }

    // Send email notification
    private function sendQuoteNotification($quoteRequest)
    {
        try {
            // Admin notification
            Mail::send('emails.quote-admin', ['quote' => $quoteRequest], function ($message) {
                $message->to(config('mail.admin_email', 'admin@example.com'))
                    ->subject('New Quote Request Received');
            });

            // Customer confirmation
            Mail::send('emails.quote-customer', ['quote' => $quoteRequest], function ($message) use ($quoteRequest) {
                $message->to($quoteRequest->customer_email)
                    ->subject('Quote Request Confirmation');
            });
        } catch (\Exception $e) {
            Log::error('Quote notification email failed: ' . $e->getMessage());
        }
    }
}
    