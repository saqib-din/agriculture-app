<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Client;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the orders.
     */
    public function index()
    {
        $orders = Order::with('client')->latest()->get();
        return view('pages.admin-side.orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new order.
     */
    public function create()
    {
        $clients = Client::orderBy('name')->get();
        return view('pages.admin-side.orders.create', compact('clients'));
    }

    /**
     * Store a newly created order in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'client_id'     => 'required|exists:clients,id',
            'order_date'    => 'required|date',
            'total_amount'  => 'required|numeric',
            'status'        => 'nullable',
            'notes'         => 'nullable',
        ]);

        Order::create([
            'client_id'     => $request->client_id,
            'order_no'      => 'ORD-' . time(),
            'order_date'    => $request->order_date,
            'total_amount'  => $request->total_amount,
            'status'        => $request->status ?? 'pending',
            'notes'         => $request->notes,
        ]);

        return redirect()->route('orders.index')
            ->with('success', 'Order added successfully');
    }

    /**
     * Show the form for editing the specified order.
     */
    public function edit(string $id)
    {
        $order = Order::findOrFail($id);
        $clients = Client::orderBy('name')->get();

        return view('pages.admin-side.orders.edit', compact('order', 'clients'));
    }

    /**
     * Update the specified order in storage.
     */
    public function update(Request $request, string $id)
    {
        $order = Order::findOrFail($id);

        $request->validate([
            'client_id'     => 'required|exists:clients,id',
            'order_date'    => 'required|date',
            'total_amount'  => 'required|numeric',
            'status'        => 'required',
            'notes'         => 'nullable',
        ]);

        $order->update([
            'client_id'     => $request->client_id,
            'order_date'    => $request->order_date,
            'total_amount'  => $request->total_amount,
            'status'        => $request->status,
            'notes'         => $request->notes,
        ]);

        return redirect()->route('orders.index')
            ->with('success', 'Order updated successfully');
    }

    /**
     * Remove the specified order from storage.
     */
    public function destroy(string $id)
    {
        Order::findOrFail($id)->delete();

        return redirect()->route('orders.index')
            ->with('success', 'Order deleted successfully');
    }
}
