<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\QuoteRequest;
use App\Models\QuoteActivity;
use App\Models\Client;
// use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
// use Barryvdh\DomPDF\Facade\Pdf;
use App\Jobs\SendQuoteEmailJob;
use App\Jobs\SendReplyEmailJob;

class QuoteRequestController extends Controller
{
    // Store quote request (single or bulk) - Frontend
    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:40',
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

            // Create quote request with 'new' status
            $quoteRequest = QuoteRequest::create([
                'client_id' => $client ? $client->id : null,
                'customer_name' => $validated['customer_name'],
                'customer_email' => $validated['customer_email'],
                'customer_phone' => $validated['customer_phone'] ?? null,
                'customer_message' => $validated['customer_message'] ?? null,
                'total_quantity' => $validated['total_quantity'] ?? null,
                'quote_status' => 'new' // Initial status
            ]);

            // Attach products with quantities
            foreach ($validated['products'] as $index => $productId) {
                $quantity = $validated['quantities'][$index] ?? 1;
                $quoteRequest->products()->attach($productId, ['quantity' => $quantity]);
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

            // Send email notification
            $this->sendQuoteNotification($quoteRequest);

            return response()->json([
                'success' => true,
                'message' => 'Quote request submitted successfully!',
                'data' => $quoteRequest->load('products')
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Quote Store Error: ' . $e->getMessage());

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
        $quoteRequest->load(['client', 'products.images', 'emaillogs', 'activities']);
        return view('pages.admin-side.quotes.show', compact('quoteRequest'));
    }

    // Admin: Update quantity
    public function updateQuantity(Request $request, QuoteRequest $quoteRequest)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        try {
            DB::beginTransaction();

            $quoteRequest->products()->updateExistingPivot(
                $request->product_id,
                ['quantity' => $request->quantity]
            );

            // Auto-update status from 'new' to 'pending' on first interaction
            if ($quoteRequest->quote_status === 'new') {
                $quoteRequest->update(['quote_status' => 'pending']);
                QuoteActivity::create([
                    'quote_request_id' => $quoteRequest->id,
                    'type' => 'other',
                    'details' => 'Quote status changed from New to Pending'
                ]);
            }

            // Log activity
            QuoteActivity::create([
                'quote_request_id' => $quoteRequest->id,
                'type' => 'other',
                'details' => "Product quantity updated to {$request->quantity}"
            ]);

            DB::commit();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Update Quantity Error: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    // Admin: Update price
    public function updatePrice(Request $request, QuoteRequest $quoteRequest)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'price' => 'required|numeric|min:0'
        ]);

        try {
            DB::beginTransaction();

            $quoteRequest->products()->updateExistingPivot(
                $request->product_id,
                ['price' => $request->price]
            );

            // Auto-update status from 'new' to 'pending' on first interaction
            if ($quoteRequest->quote_status === 'new') {
                $quoteRequest->update(['quote_status' => 'pending']);
                QuoteActivity::create([
                    'quote_request_id' => $quoteRequest->id,
                    'type' => 'other',
                    'details' => 'Quote status changed from New to Pending'
                ]);
            }

            // Log activity
            QuoteActivity::create([
                'quote_request_id' => $quoteRequest->id,
                'type' => 'other',
                'details' => "Product price updated to PKR " . number_format($request->price, 2)
            ]);

            DB::commit();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Update Price Error: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    // Admin: Convert to client
    public function convertToClient(Request $request, QuoteRequest $quoteRequest)
    {
        if ($quoteRequest->isExistingClient()) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Quote is already linked to a client.'
                ], 400);
            }
            return redirect()->back()->with('error', 'Quote is already linked to a client.');
        }

        try {
            DB::beginTransaction();

            $client = Client::create([
                'name' => $quoteRequest->customer_name,
                'email' => $quoteRequest->customer_email,
                'phone' => $quoteRequest->customer_phone,
            ]);

            $quoteRequest->update([
                'client_id' => $client->id,
                'quote_status' => 'pending' // Set to pending after client conversion
            ]);

            QuoteActivity::create([
                'quote_request_id' => $quoteRequest->id,
                'type' => 'other',
                'details' => "Converted to client: {$client->name}. Status changed to Pending."
            ]);

            DB::commit();

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'redirect' => route('admin.quotes.show', $quoteRequest)
                ]);
            }

            return redirect()->route('admin.quotes.show', $quoteRequest)
                ->with('success', 'Quote converted to client successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Convert to Client Error: ' . $e->getMessage());

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to convert to client: ' . $e->getMessage()
                ], 500);
            }

            return redirect()->back()->with('error', 'Failed to convert to client: ' . $e->getMessage());
        }
    }

    // Admin: Convert to Order
    public function convertToOrder(QuoteRequest $quoteRequest)
    {
        if ($quoteRequest->order) {
            return back()->with('error', 'Order already exists for this quote.');
        }

        if (!$quoteRequest->canConvertToOrder()) {
            return back()->with('error', 'Quote must have a linked client and be in pending status to convert to order.');
        }

        try {
            DB::beginTransaction();

            // Calculate totals from quote products
            $subtotal = 0;
            foreach ($quoteRequest->products as $product) {
                $price = $product->pivot->price ?? $product->price;
                $quantity = $product->pivot->quantity;
                $subtotal += $price * $quantity;
            }

            $taxRate = 0;
            $taxAmount = $subtotal * ($taxRate / 100);
            $total = $subtotal + $taxAmount;

            // Create order
            $order = \App\Models\Order::create([
                'quote_request_id' => $quoteRequest->id,
                'client_id' => $quoteRequest->client_id,
                'order_number' => 'ORD-' . now()->format('Ymd') . '-' . str_pad($quoteRequest->id, 5, '0', STR_PAD_LEFT),
                'status' => 'converted',
                'subtotal' => $subtotal,
                'tax_rate' => $taxRate,
                'tax_amount' => $taxAmount,
                'discount' => 0,
                'total' => $total,
            ]);

            // Copy products from quote to order
            foreach ($quoteRequest->products as $product) {
                $price = $product->pivot->price ?? $product->price;
                $quantity = $product->pivot->quantity;
                $subtotalProduct = $price * $quantity;

                $order->products()->attach($product->id, [
                    'quantity' => $quantity,
                    'price' => $price,
                    'subtotal' => $subtotalProduct
                ]);
            }

            // Update quote status to CONVERTED (not completed)
            $quoteRequest->update(['quote_status' => 'converted']);

            // Activity log
            QuoteActivity::create([
                'quote_request_id' => $quoteRequest->id,
                'type' => 'other',
                'details' => 'Quote converted to order #' . $order->order_number . '. Status changed to Converted.'
            ]);

            DB::commit();

            return redirect()->route('admin.orders.show', $order->id)
                ->with('success', 'Quote converted to order successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Convert to Order Error: ' . $e->getMessage());
            return back()->with('error', $e->getMessage());
        }
    }

    // Admin: Reject quote
    public function reject(QuoteRequest $quoteRequest)
    {
        if (!$quoteRequest->canReject()) {
            return redirect()->back()->with('error', 'This quote cannot be rejected.');
        }

        try {
            DB::beginTransaction();

            $quoteRequest->update(['quote_status' => 'rejected']);

            QuoteActivity::create([
                'quote_request_id' => $quoteRequest->id,
                'type' => 'other',
                'details' => 'Quote rejected by admin'
            ]);

            DB::commit();

            return redirect()->back()->with('success', 'Quote rejected successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Reject Quote Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to reject quote.');
        }
    }

    // Admin: Reopen quote
    public function reopen(QuoteRequest $quoteRequest)
    {
        if (!$quoteRequest->canReopen()) {
            return redirect()->back()->with('error', 'Only rejected quotes can be reopened.');
        }

        try {
            DB::beginTransaction();

            $quoteRequest->update(['quote_status' => 'pending']);

            QuoteActivity::create([
                'quote_request_id' => $quoteRequest->id,
                'type' => 'other',
                'details' => 'Quote reopened and set to pending status'
            ]);

            DB::commit();

            return redirect()->back()->with('success', 'Quote reopened successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Reopen Quote Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to reopen quote.');
        }
    }

    // Admin: Store activity
    public function storeActivity(Request $request, QuoteRequest $quoteRequest)
    {
        $request->validate([
            'type' => 'required|in:call,message,meeting,email,other',
            'title' => 'nullable',
            'details' => 'nullable|string'
        ]);

        try {
            DB::beginTransaction();

            QuoteActivity::create([
                'quote_request_id' => $quoteRequest->id,
                'type' => $request->type,
                'title' => $request->title,
                'details' => $request->details
            ]);

            // Auto-update status from 'new' to 'pending' on first activity
            if ($quoteRequest->quote_status === 'new') {
                $quoteRequest->update(['quote_status' => 'pending']);
                QuoteActivity::create([
                    'quote_request_id' => $quoteRequest->id,
                    'type' => 'other',
                    'details' => 'Quote status changed from New to Pending'
                ]);
            }

            DB::commit();

            return redirect()->back()->with('success', 'Activity added successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Store Activity Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to add activity.');
        }
    }

    // // Admin: Reply to customer
    // public function reply(Request $request, $id)
    // {
    //     $quoteRequest = QuoteRequest::findOrFail($id);

    //     if (!$quoteRequest->customer_email) {
    //         return back()->with('error', 'No email found for this customer!');
    //     }

    //     $request->validate([
    //         'reply_message' => 'required|string|max:5000',
    //     ]);

    //     try {
    //         DB::beginTransaction();

    //         // Send email
    //         Mail::raw($request->reply_message, function ($message) use ($quoteRequest) {
    //             $message->to($quoteRequest->customer_email)
    //                 ->subject('Reply from ' . config('app.name'));
    //         });

    //         // Log activity
    //         QuoteActivity::create([
    //             'quote_request_id' => $quoteRequest->id,
    //             'type' => 'email',
    //             'details' => 'Email sent to customer: ' . substr($request->reply_message, 0, 100) . '...'
    //         ]);

    //         // Auto-update status from 'new' to 'pending' on first reply
    //         if ($quoteRequest->quote_status === 'new') {
    //             $quoteRequest->update(['quote_status' => 'pending']);
    //             QuoteActivity::create([
    //                 'quote_request_id' => $quoteRequest->id,
    //                 'type' => 'other',
    //                 'details' => 'Quote status changed from New to Pending'
    //             ]);
    //         }

    //         DB::commit();

    //         return back()->with('success', 'Reply sent successfully!');
    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         Log::error('Reply Email Error: ' . $e->getMessage());
    //         return back()->with('error', 'Failed to send reply: ' . $e->getMessage());
    //     }
    // }

    // // Admin: Send Quote with PDF Invoice
    // public function sendQuote(QuoteRequest $quoteRequest)
    // {
    //     try {
    //         DB::beginTransaction();

    //         // Load products with images
    //         $quoteRequest->load('products.images');

    //         // Calculate totals
    //         $subtotal = 0;
    //         $products = [];

    //         foreach ($quoteRequest->products as $product) {
    //             $price = $product->pivot->price ?? $product->price;
    //             $quantity = $product->pivot->quantity ?? 1;
    //             $productSubtotal = $price * $quantity;
    //             $subtotal += $productSubtotal;

    //             $imageUrl = null;
    //             if ($product->images && $product->images->first()) {
    //                 $imagePath = storage_path('app/public/' . $product->images->first()->image);
    //                 if (file_exists($imagePath)) {
    //                     $imageUrl = asset('storage/' . $product->images->first()->image);
    //                 }
    //             }

    //             $products[] = [
    //                 'name' => $product->name,
    //                 'sku' => $product->sku ?? 'N/A',
    //                 'brand' => $product->brand ?? 'N/A',
    //                 'model' => $product->model ?? 'N/A',
    //                 'quantity' => $quantity,
    //                 'price' => $price,
    //                 'subtotal' => $productSubtotal,
    //                 'image' => $imageUrl
    //             ];
    //         }

    //         $taxRate = 0;
    //         $taxAmount = $subtotal * ($taxRate / 100);
    //         $total = $subtotal + $taxAmount;

    //         // Generate quote number
    //         $quoteNumber = 'QT-' . now()->format('Ymd') . '-' . str_pad($quoteRequest->id, 5, '0', STR_PAD_LEFT);

    //         $data = [
    //             'quote' => $quoteRequest,
    //             'products' => $products,
    //             'subtotal' => $subtotal,
    //             'tax_rate' => $taxRate,
    //             'tax_amount' => $taxAmount,
    //             'total' => $total,
    //             'quote_number' => $quoteNumber
    //         ];

    //         // Generate PDF
    //         $pdf = Pdf::loadView('emails.quote-invoice-pdf', $data)
    //             ->setPaper('a4', 'portrait')
    //             ->setOption('defaultFont', 'DejaVu Sans');

    //         $pdfContent = $pdf->output();

    //         // Send email with PDF
    //         Mail::send('emails.quote-details', $data, function ($message) use ($quoteRequest, $pdfContent, $quoteNumber) {
    //             $message->to($quoteRequest->customer_email)
    //                 ->subject('Quote Request - ' . $quoteNumber)
    //                 ->attachData($pdfContent, 'quote-' . $quoteNumber . '.pdf', [
    //                     'mime' => 'application/pdf',
    //                 ]);
    //         });

    //         // Log activity
    //         QuoteActivity::create([
    //             'quote_request_id' => $quoteRequest->id,
    //             'type' => 'email',
    //             'details' => 'Quote details and invoice PDF sent to customer via email'
    //         ]);

    //         // Auto-update status from 'new' to 'pending'
    //         if ($quoteRequest->quote_status === 'new') {
    //             $quoteRequest->update(['quote_status' => 'pending']);
    //             QuoteActivity::create([
    //                 'quote_request_id' => $quoteRequest->id,
    //                 'type' => 'other',
    //                 'details' => 'Quote status changed from New to Pending'
    //             ]);
    //         }

    //         DB::commit();

    //         return redirect()->back()->with('success', 'Quote sent successfully with invoice PDF!');
    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         Log::error('Send Quote Error: ' . $e->getMessage());
    //         Log::error('Stack Trace: ' . $e->getTraceAsString());

    //         return redirect()->back()->with('error', 'Failed to send quote: ' . $e->getMessage());
    //     }
    // }


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
            // Dispatch job to queue
            SendReplyEmailJob::dispatch($quoteRequest, $request->reply_message);

            return back()->with('success', 'Reply is being sent! You will be notified once it\'s delivered.');
        } catch (\Exception $e) {
            Log::error('Reply Dispatch Error: ' . $e->getMessage());
            return back()->with('error', 'Failed to queue reply: ' . $e->getMessage());
        }
    }

    // Admin: Send Quote with PDF Invoice
    public function sendQuote(QuoteRequest $quoteRequest)
    {
        try {
            // Dispatch job to queue
            SendQuoteEmailJob::dispatch($quoteRequest);

            return redirect()->back()->with('success', 'Quote is being sent! Customer will receive it shortly.');
        } catch (\Exception $e) {
            Log::error('Send Quote Dispatch Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to queue quote: ' . $e->getMessage());
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
            Log::error('Delete Quote Error: ' . $e->getMessage());
            return redirect()->route('admin.quotes.index')
                ->with('error', 'Failed to delete quote request.');
        }
    }

    // Send email notification
    private function sendQuoteNotification($quoteRequest)
    {
        try {
            $quoteRequest->load('products');

            // Admin notification
            Mail::send('emails.quote-admin', ['quote' => $quoteRequest], function ($message) {
                $adminEmail = config('mail.admin_email', env('ADMIN_EMAIL', 'admin@example.com'));
                $message->to($adminEmail)
                    ->subject('New Quote Request Received');
            });

            // Customer confirmation
            Mail::send('emails.quote-customer', ['quote' => $quoteRequest], function ($message) use ($quoteRequest) {
                $message->to($quoteRequest->customer_email)
                    ->subject('Quote Request Confirmation - ' . config('app.name'));
            });

            Log::info('Quote notification emails sent successfully for Quote ID: ' . $quoteRequest->id);
        } catch (\Exception $e) {
            Log::error('Quote notification email failed: ' . $e->getMessage());
            Log::error('Stack Trace: ' . $e->getTraceAsString());
        }
    }
}
