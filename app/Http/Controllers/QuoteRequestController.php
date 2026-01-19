<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\QuoteRequest;
use App\Models\QuoteActivity;
use App\Models\Client;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class QuoteRequestController extends Controller
{
    // Store quote request (single or bulk) - Frontend
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

            // Check if customer email exists in clients table
            $client = Client::where('email', $validated['customer_email'])->first();

            // Create quote request
            $quoteRequest = QuoteRequest::create([
                'client_id' => $client ? $client->id : null,
                'customer_name' => $validated['customer_name'],
                'customer_email' => $validated['customer_email'],
                'customer_phone' => $validated['customer_phone'] ?? null,
                'customer_message' => $validated['customer_message'] ?? null,
                'total_quantity' => $validated['total_quantity'] ?? null,
                'status' => 'pending',
                'quote_status' => 'pending'
            ]);

            // Attach products with quantities
            foreach ($validated['products'] as $index => $productId) {
                $quantity = $validated['quantities'][$index] ?? 1;

                $quoteRequest->products()->attach($productId, [
                    'quantity' => $quantity
                ]);
            }

            // Create initial activity
            QuoteActivity::create([
                'quote_request_id' => $quoteRequest->id,
                'type' => 'other',
                'details' => 'Quote request submitted by customer'
            ]);

            // If client exists, log that too
            if ($client) {
                QuoteActivity::create([
                    'quote_request_id' => $quoteRequest->id,
                    'type' => 'other',
                    'details' => 'Quote linked to existing client: ' . $client->name
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
        $quoteRequests = QuoteRequest::with(['client', 'products'])
            ->latest()
            ->paginate(20);

        return view('pages.admin-side.quotes.index', compact('quoteRequests'));
    }

    // Admin: View single quote request
    public function show(QuoteRequest $quoteRequest)
    {
        $quoteRequest->load(['client', 'products.images', 'activities']);
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
        $oldStatus = $quote->status;
        $quote->status = $request->status;
        $quote->save();

        // Log activity
        QuoteActivity::create([
            'quote_request_id' => $quote->id,
            'type' => 'other',
            'details' => "Status changed from {$oldStatus} to {$request->status}"
        ]);

        return response()->json([
            'success' => true,
            'status' => $quote->status
        ]);
    }

    // Admin: Update quantity
    public function updateQuantity(Request $request, QuoteRequest $quoteRequest)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $quoteRequest->products()->updateExistingPivot(
            $request->product_id,
            ['quantity' => $request->quantity]
        );

        return response()->json(['success' => true]);
    }

    // Admin: Convert to client
    public function convertToClient(QuoteRequest $quoteRequest)
    {
        if ($quoteRequest->isExistingClient()) {
            return redirect()->back()->with('error', 'Quote is already linked to a client.');
        }

        try {
            DB::beginTransaction();

            $client = Client::create([
                'name' => $quoteRequest->customer_name,
                'email' => $quoteRequest->customer_email,
                'phone' => $quoteRequest->customer_phone,
                'status' => true
            ]);

            $quoteRequest->update([
                'client_id' => $client->id,
                'quote_status' => 'converted'
            ]);

            QuoteActivity::create([
                'quote_request_id' => $quoteRequest->id,
                'type' => 'other',
                'details' => "Converted to client: {$client->name}"
            ]);

            DB::commit();

            return redirect()->route('admin.quotes.show', $quoteRequest)
                ->with('success', 'Quote converted to client successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to convert to client: ' . $e->getMessage());
        }
    }

    public function convertToOrder(QuoteRequest $quoteRequest)
    {
        if ($quoteRequest->order) {
            return back()->with('error', 'Order already exists for this quote.');
        }

        try {
            DB::beginTransaction();

            // Create order
            $order = \App\Models\Order::create([
                'quote_request_id' => $quoteRequest->id,
                'client_id' => $quoteRequest->client_id,
                'order_no' => 'ORD-' . now()->timestamp,
                'status' => 'pending',
                'total' => null, // calculate later if needed
            ]);

            // Copy products from quote to order
            foreach ($quoteRequest->products as $product) {
                $order->products()->attach($product->id, [
                    'quantity' => $product->pivot->quantity
                ]);
            }

            // Update quote status
            $quoteRequest->update([
                'quote_status' => 'converted'
            ]);

            // Activity log
            QuoteActivity::create([
                'quote_request_id' => $quoteRequest->id,
                'type' => 'other',
                'details' => 'Quote converted to order #' . $order->order_no
            ]);

            DB::commit();

            return redirect()->route('admin.orders.show', $order->id)
                ->with('success', 'Quote converted to order successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }


    // Admin: Reject quote
    public function reject(QuoteRequest $quoteRequest)
    {
        $quoteRequest->update(['quote_status' => 'rejected']);

        QuoteActivity::create([
            'quote_request_id' => $quoteRequest->id,
            'type' => 'other',
            'details' => 'Quote rejected'
        ]);

        return redirect()->back()->with('success', 'Quote rejected successfully.');
    }

    // Admin: Reopen quote
    // public function reopen(QuoteRequest $quoteRequest)
    // {
    //     $quoteRequest->update(['quote_status' => 'reopened']);

    //     QuoteActivity::create([
    //         'quote_request_id' => $quoteRequest->id,
    //         'type' => 'other',
    //         'details' => 'Quote reopened'
    //     ]);

    //     return redirect()->back()->with('success', 'Quote reopened successfully.');
    // }

    // Admin: Store activity
    public function storeActivity(Request $request, QuoteRequest $quoteRequest)
    {
        $request->validate([
            'type' => 'required|in:call,message,meeting,email,other',
            'details' => 'required|string'
        ]);

        QuoteActivity::create([
            'quote_request_id' => $quoteRequest->id,
            'type' => $request->type,
            'details' => $request->details
        ]);

        return redirect()->back()->with('success', 'Activity added successfully.');
    }

    // Admin: Reply to customer
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

            // Log activity
            QuoteActivity::create([
                'quote_request_id' => $quoteRequest->id,
                'type' => 'email',
                'details' => 'Email sent to customer: ' . substr($request->reply_message, 0, 100) . '...'
            ]);

            return back()->with('success', 'Reply sent successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to send reply: ' . $e->getMessage());
        }
    }

    // Admin: Delete quote request
    public function destroy(QuoteRequest $quoteRequest)
    {
        try {
            $quoteRequest->delete();
            return redirect()->route('admin.quotes.index')
                ->with('success', 'Quote request deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('admin.quotes.index')
                ->with('error', 'Failed to delete quote request.');
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
