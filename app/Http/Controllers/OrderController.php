<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderActivity;
use App\Models\QuoteActivity;
use App\Models\Client;
use App\Models\Product;
use App\Models\QuoteRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['client', 'products'])
            ->latest()
            ->paginate(20);
        return view('pages.admin-side.orders.index', compact('orders'));
    }
    public function create(Request $request)
    {
        $clients = Client::where('status', true)->get();
        $products = Product::where('status', true)->get();
        $quoteRequestId = $request->quote_request_id;
        return view('pages.admin-side.orders.create', compact('clients', 'products', 'quoteRequestId'));
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
            'notes' => 'nullable|string'
        ]);
        DB::beginTransaction();
        try {
            $subtotal = 0;
            foreach ($request->products as $product) {
                $subtotal += $product['price'] * $product['quantity'];
            }
            $taxAmount = ($subtotal - ($request->discount ?? 0)) * (17 / 100);
            $total = $subtotal + $taxAmount - ($request->discount ?? 0);
            $order = Order::create([
                'client_id' => $request->client_id,
                'quote_request_id' => $request->quote_request_id,
                'subtotal' => $subtotal,
                'tax_rate' => 17.00,
                'tax_amount' => $taxAmount,
                'discount' => $request->discount ?? 0,
                'total' => $total,
                'status' => 'pending',
                'notes' => $request->notes
            ]);
            foreach ($request->products as $product) {
                $order->products()->attach($product['id'], [
                    'quantity' => $product['quantity'],
                    'price' => $product['price'],
                    'subtotal' => $product['price'] * $product['quantity']
                ]);
            }
            OrderActivity::create([
                'order_id' => $order->id,
                'type' => 'other',
                'details' => 'Order created'
            ]);
            if ($request->quote_request_id) {
                $quoteRequest = QuoteRequest::find($request->quote_request_id);
                if ($quoteRequest) {
                    QuoteActivity::create([
                        'quote_request_id' => $quoteRequest->id,
                        'type' => 'other',
                        'details' => "Order created: {$order->order_number}"
                    ]);
                }
            }
            DB::commit();
            return redirect()->route('admin.orders.index', $order)
                ->with('success', 'Order created successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to create order: ' . $e->getMessage());
        }
    }
    public function show(Order $order)
    {
        $order->load(['client', 'products.images', 'activities', 'quoteRequest']);
        return view('pages.admin-side.orders.show', compact('order'));
    }
    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,in_progress,delivered,installed,completed,cancelled'
        ]);
        $oldStatus = $order->status;
        $order->update(['status' => $request->status]);
        OrderActivity::create([
            'order_id' => $order->id,
            'type' => 'status_change',
            'details' => "Status changed from {$oldStatus} to {$request->status}"
        ]);
        return response()->json(['success' => true]);
    }
    public function storeActivity(Request $request, Order $order)
    {
        $request->validate([
            'type' => 'required|in:call,message,meeting,email,payment,other',
            'details' => 'required|string'
        ]);
        OrderActivity::create([
            'order_id' => $order->id,
            'type' => $request->type,
            'details' => $request->details
        ]);
        return redirect()->back()->with('success', 'Activity added successfully.');
    }
    public function print(Order $order)
    {
        $order->load(['client', 'products']);
        return view('pages.admin-side.orders.print', compact('order'));
    }
    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('admin.orders.index')
            ->with('success', 'Order deleted successfully.');
    }
}
