<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Client;
use App\Models\Product;
use App\Models\QuoteRequest;
use App\Http\Controllers\VariablesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Jobs\SendInvoiceEmailJob;

// use Illuminate\Support\Facades\Mail;
// use Barryvdh\DomPDF\Facade\Pdf;


class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('client')
            ->latest()
            ->paginate(20);

        return view('pages.admin-side.orders.index', compact('orders'));
    }

    public function create(Request $request)
    {
        $clients = Client::orderBy('name')->get();
        $products = Product::with('images')->where('status', 1)->get();

        // Get GST rate from variables
        $gstRate = VariablesController::getGstRate();

        $quoteRequestId = $request->query('quote_request_id');
        $quoteProducts = [];
        $selectedClientId = null;

        if ($quoteRequestId) {
            $quoteRequest = QuoteRequest::with(['products'])->findOrFail($quoteRequestId);
            $selectedClientId = $quoteRequest->client_id;

            // Map products with pivot price
            $quoteProducts = $quoteRequest->products->map(function ($product) {
                return [
                    'id' => $product->id,
                    'name' => $product->name,
                    'sku' => $product->sku,
                    'price' => $product->pivot->price ?? $product->price,
                    'pivot' => [
                        'quantity' => $product->pivot->quantity,
                        'price' => $product->pivot->price ?? $product->price
                    ]
                ];
            });
        }

        return view('pages.admin-side.orders.createorupdate', compact('clients', 'products', 'quoteProducts', 'quoteRequestId', 'selectedClientId', 'gstRate'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'products' => 'required|array|min:1',
            'products.*.id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
            'products.*.price' => 'required|numeric|min:0',
            'discount' => 'nullable|numeric|min:0',
            'notes' => 'nullable|string',
            'quote_request_id' => 'nullable|exists:quote_requests,id'
        ]);

        try {
            DB::beginTransaction();

            // Get GST rate from variables
            $gstRate = VariablesController::getGstRate();

            // Calculate totals
            $subtotal = 0;
            foreach ($request->products as $product) {
                $quantity = $product['quantity'];
                $price = $product['price'];
                $subtotal += $quantity * $price;
            }

            // Calculate GST on subtotal
            $gstAmount = round($subtotal * ($gstRate / 100), 2);

            // Get discount
            $discount = $request->discount ?? 0;

            // Calculate total: Subtotal + GST - Discount
            $total = round($subtotal + $gstAmount - $discount, 2);

            // Generate order number
            $orderNumber = 'ORD-' . now()->format('Ymd') . '-' . str_pad(Order::count() + 1, 5, '0', STR_PAD_LEFT);

            // Create order with status 'new'
            $order = Order::create([
                'client_id' => $request->client_id,
                'quote_request_id' => $request->quote_request_id,
                'order_number' => $orderNumber,
                'status' => 'new',
                'subtotal' => $subtotal,
                'tax_rate' => $gstRate,
                'tax_amount' => $gstAmount,
                'discount' => $discount,
                'total' => $total,
                'notes' => $request->notes
            ]);

            // Attach products
            foreach ($request->products as $product) {
                $productId = $product['id'];
                $quantity = $product['quantity'];
                $price = $product['price'];
                $productSubtotal = $quantity * $price;

                $order->products()->attach($productId, [
                    'quantity' => $quantity,
                    'price' => $price,
                    'subtotal' => $productSubtotal
                ]);
            }

            // If created from quote, update quote status
            if ($request->quote_request_id) {
                QuoteRequest::where('id', $request->quote_request_id)
                    ->update(['quote_status' => 'pending']);
            }

            DB::commit();

            return redirect()->route('admin.orders.show', $order->id)
                ->with('success', 'Order created successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Order Create Error: ' . $e->getMessage());

            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to create order: ' . $e->getMessage());
        }
    }

    // Controller - Simple version
    public function show(Order $order)
    {
        $order->load(['client', 'products', 'quoteRequest', 'activities', 'emailLogs']);

        $gstRate = $order->tax_rate ?? VariablesController::getGstRate();

        return view('pages.admin-side.orders.show', compact('order', 'gstRate'));
    }

    public function edit(Order $order)
    {
        $clients = Client::orderBy('name')->get();
        $products = Product::with('images')->where('status', 1)->get();

        // Get GST rate
        $gstRate = $order->tax_rate ?? VariablesController::getGstRate();

        $order->load('products');

        return view('pages.admin-side.orders.createorupdate', compact('order', 'clients', 'products', 'gstRate'));
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'products' => 'required|array|min:1',
            'products.*.id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
            'products.*.price' => 'required|numeric|min:0',
            'discount' => 'nullable|numeric|min:0',
            'notes' => 'nullable|string'
        ]);

        try {
            DB::beginTransaction();

            // Get GST rate (use existing order rate or get from variables)
            $gstRate = $order->tax_rate ?? VariablesController::getGstRate();

            // Calculate totals
            $subtotal = 0;
            foreach ($request->products as $product) {
                $quantity = $product['quantity'];
                $price = $product['price'];
                $subtotal += $quantity * $price;
            }

            // Calculate GST on subtotal
            $gstAmount = round($subtotal * ($gstRate / 100), 2);

            // Get discount
            $discount = $request->discount ?? 0;

            // Calculate total: Subtotal + GST - Discount
            $total = round($subtotal + $gstAmount - $discount, 2);

            // Update order
            $order->update([
                'client_id' => $request->client_id,
                'subtotal' => $subtotal,
                'tax_rate' => $gstRate,
                'tax_amount' => $gstAmount,
                'discount' => $discount,
                'total' => $total,
                'notes' => $request->notes
            ]);

            // Sync products
            $order->products()->detach();
            foreach ($request->products as $product) {
                $productId = $product['id'];
                $quantity = $product['quantity'];
                $price = $product['price'];
                $productSubtotal = $quantity * $price;

                $order->products()->attach($productId, [
                    'quantity' => $quantity,
                    'price' => $price,
                    'subtotal' => $productSubtotal
                ]);
            }

            DB::commit();

            return redirect()->route('admin.orders.show', $order->id)
                ->with('success', 'Order updated successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Order Update Error: ' . $e->getMessage());

            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to update order: ' . $e->getMessage());
        }
    }

    public function destroy(Order $order)
    {
        try {
            $order->delete();

            return redirect()->route('admin.orders.index')
                ->with('success', 'Order deleted successfully!');
        } catch (\Exception $e) {
            Log::error('Order Delete Error: ' . $e->getMessage());

            return redirect()->back()
                ->with('error', 'Failed to delete order: ' . $e->getMessage());
        }
    }

    public function storeActivity(Request $request, Order $order)
    {
        $request->validate([
            'type' => 'required|in:call,message,meeting,email,payment,other',
            'title' => 'nullable|string|max:30',
            'details' => 'nullable|string'
        ]);

        try {
            // Create activity
            $order->activities()->create([
                'type' => $request->type,
                'title' => $request->title,
                'details' => $request->details
            ]);

            // Change status to processing only if current status is 'new'
            if ($order->status === 'new') {
                $order->update(['status' => 'processing']);
            }

            return redirect()->back()->with('success', 'Activity added successfully!');
        } catch (\Exception $e) {
            Log::error('Activity Store Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to add activity');
        }
    }

    public function print(Order $order)
    {
        $order->load(['client', 'products']);

        // Change status to processing only if current status is 'new'
        if ($order->status === 'new') {
            $order->update(['status' => 'processing']);
        }

        return view('pages.admin-side.orders.print', compact('order'));
    }

    public function sendInvoice($id)
    {
        try {
            $order = Order::with('client')->findOrFail($id);

            // Validate that client exists and has email
            if (!$order->client || !$order->client->email) {
                return redirect()->back()->with('error', 'Customer email not found!');
            }

            // Dispatch job to queue
            SendInvoiceEmailJob::dispatch($order);

            return redirect()->back()->with('success', 'Invoice is being sent! Customer will receive it shortly.');
        } catch (\Exception $e) {
            Log::error('Invoice Dispatch Error: ' . $e->getMessage(), [
                'order_id' => $id
            ]);

            return redirect()->back()->with('error', 'Failed to queue invoice: ' . $e->getMessage());
        }
    }

    // public function sendInvoice(Order $order)
    // {
    //     try {
    //         // Change status to processing only if current status is 'new'
    //         if ($order->status === 'new') {
    //             $order->update(['status' => 'processing']);
    //         }

    //         $order->load(['client', 'products']);

    //         // Generate PDF from print view


    //         $pdf = PDF::loadView('pages.admin-side.orders.print', compact('order'))
    //             ->setPaper('a4', 'portrait')
    //             ->setOption('defaultFont', 'DejaVu Sans');

    //         // Send email with PDF attachment
    //         Mail::send('emails.invoice', ['order' => $order], function ($message) use ($order, $pdf) {
    //             $message->to($order->client->email, $order->client->name)
    //                 ->subject('Invoice - Order #' . $order->id)
    //                 ->attachData($pdf->output(), 'invoice-' . $order->id . '.pdf');
    //         });

    //         return redirect()->back()->with('success', 'Invoice sent successfully!');
    //     } catch (\Exception $e) {
    //         Log::error('Send Invoice Error: ' . $e->getMessage());
    //         return redirect()->back()->with('error', 'Failed to send invoice: ' . $e->getMessage());
    //     }
    // }

    public function markCompleted(Order $order)
    {
        try {
            $order->update(['status' => 'completed']);

            // Log activity
            $order->activities()->create([
                'type' => 'other',
                'title' => 'Order Completed',
                'details' => 'Order marked as completed'
            ]);

            return redirect()->back()->with('success', 'Order marked as completed!');
        } catch (\Exception $e) {
            Log::error('Mark Completed Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to mark order as completed');
        }
    }

    public function markCancelled(Order $order)
    {
        try {
            $order->update(['status' => 'cancelled']);

            // Log activity
            $order->activities()->create([
                'type' => 'other',
                'title' => 'Order Cancelled',
                'details' => 'Order marked as cancelled'
            ]);

            return redirect()->back()->with('success', 'Order marked as cancelled!');
        } catch (\Exception $e) {
            Log::error('Mark Cancelled Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to mark order as cancelled');
        }
    }

    public function reopenOrder(Order $order)
    {
        try {
            // Only allow reopening if order is completed or cancelled
            if (in_array($order->status, ['completed', 'cancelled'])) {
                $order->update(['status' => 'processing']);

                // Log activity
                $order->activities()->create([
                    'type' => 'other',
                    'title' => 'Order Reopened',
                    'details' => 'Order reopened and moved back to processing'
                ]);

                return redirect()->back()->with('success', 'Order reopened successfully!');
            }

            return redirect()->back()->with('error', 'Only completed or cancelled orders can be reopened');
        } catch (\Exception $e) {
            Log::error('Reopen Order Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to reopen order');
        }
    }
}
