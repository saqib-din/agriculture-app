@extends('layouts.admin')

@section('content')
    <div class="pc-container">
        <div class="pc-content">

            {{-- Page Header --}}
            <div class="page-header">
                <div class="page-header-title">
                    <h2 class="mb-0">Orders List</h2>
                </div>
            </div>

            @include('components.alerts')

            {{-- Add Order Button --}}
            <div class="mb-3 text-end">
                <a href="{{ route('orders.create') }}" class="btn btn-primary">
                    <i class="ti ti-plus"></i> Add Order
                </a>
            </div>

            {{-- Table --}}
            <div class="card">
                <div class="card-body table-card">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Order #</th>
                                    <th>Client</th>
                                    <th>Date</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th class="text-end">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($orders as $order)
                                    <tr>
                                        <td>{{ $order->order_no }}</td>
                                        <td>{{ $order->client->name ?? '-' }}</td>
                                        <td>{{ $order->order_date }}</td>
                                        <td>{{ number_format($order->total_amount) }}</td>
                                        <td>
                                            @if ($order->status == 'completed')
                                                <span class="badge bg-success">Completed</span>
                                            @elseif ($order->status == 'cancelled')
                                                <span class="badge bg-danger">Cancelled</span>
                                            @else
                                                <span class="badge bg-warning">Pending</span>
                                            @endif
                                        </td>
                                        <td class="text-end">
                                            <a href="{{ route('orders.edit', $order->id) }}"
                                                class="avtar avtar-xs btn-link-secondary">
                                                <i class="ti ti-edit f-20"></i>
                                            </a>

                                            <a href="#" class="avtar avtar-xs btn-link-secondary"
                                                onclick="event.preventDefault(); document.getElementById('delete-{{ $order->id }}').submit();">
                                                <i class="ti ti-trash f-20"></i>
                                            </a>

                                            <form id="delete-{{ $order->id }}"
                                                action="{{ route('orders.destroy', $order->id) }}" method="POST"
                                                style="display:none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">No Orders Found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
