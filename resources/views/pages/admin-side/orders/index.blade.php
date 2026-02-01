@extends('layouts.admin')

@section('content')
    <div class="pc-container">
        <div class="pc-content">
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                                <li class="breadcrumb-item">Orders</li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">Orders Management</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @include('components.alerts')

            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-sm-flex align-items-center justify-content-between">
                                <h5 class="mb-3 mb-sm-0">Orders List</h5>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('admin.orders.create') }}" class="btn btn-primary btn-md">
                                        New Order
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="card-body table-card">
                            <div class="table-responsive">
                                <table class="table table-hover" id="pc-dt-simple">
                                    <thead>
                                        <tr>
                                            <th>Order #</th>
                                            <th>Client</th>
                                            <th>Products</th>
                                            <th>Total Amount</th>
                                            <th>Status</th>
                                            <th>Date</th>
                                            <th class="text-end">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($orders as $order)
                                            <tr>
                                                <td>
                                                    <strong>{{ $order->order_number }}</strong>
                                                    @if ($order->quote_request_id)
                                                        <br>
                                                        <small class="text-muted">
                                                            <i class="ti ti-file-text"></i> From Quote
                                                            #{{ $order->quote_request_id }}
                                                        </small>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="avtar avtar-s bg-light-primary flex-shrink-0">
                                                            <i class="ti ti-user"></i>
                                                        </div>
                                                        <div class="ms-2">
                                                            <h6 class="mb-0">{{ $order->client->name }}</h6>
                                                            <small class="text-muted">{{ $order->client->email }}</small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="badge bg-light-info">
                                                        <i class="ti ti-package me-1"></i>{{ $order->products->count() }}
                                                        Items
                                                    </span>
                                                </td>
                                                <td>
                                                    <strong>PKR {{ number_format($order->total, 2) }}</strong>
                                                    <br>
                                                    <small class="text-muted">
                                                        Subtotal: PKR {{ number_format($order->subtotal, 2) }}
                                                    </small>
                                                </td>
                                                <td>
                                                    @php
                                                        $statusColors = [
                                                            'new' => 'info',
                                                            'processing' => 'warning',
                                                            'completed' => 'success',
                                                            'cancelled' => 'danger',
                                                        ];
                                                    @endphp
                                                    <span
                                                        class="badge bg-light-{{ $statusColors[$order->status] ?? 'secondary' }}">
                                                        {{ ucfirst($order->status) }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <small>{{ $order->created_at->format('d M, Y') }}</small>
                                                    <br>
                                                    <small
                                                        class="text-muted">{{ $order->created_at->format('h:i A') }}</small>
                                                </td>
                                                <td class="text-end">
                                                    <a href="{{ route('admin.orders.show', $order->id) }}"
                                                        class="avtar avtar-xs btn-link-secondary" data-bs-toggle="tooltip"
                                                        title="View Details">
                                                        <i class="ti ti-eye f-20"></i>
                                                    </a>

                                                    @if ($order->canGenerateInvoice() && $order->status === 'completed')
                                                        <a href="{{ route('admin.orders.print', $order->id) }}"
                                                            target="_blank" class="avtar avtar-xs btn-link-secondary"
                                                            data-bs-toggle="tooltip" title="Print Order">
                                                            <i class="ti ti-printer f-20"></i>
                                                        </a>
                                                    @endif

                                                    @if (!in_array($order->status, ['completed', 'cancelled']))
                                                        <a href="{{ route('admin.orders.edit', $order->id) }}"
                                                            class="avtar avtar-xs btn-link-secondary"
                                                            data-bs-toggle="tooltip" title="Edit">
                                                            <i class="ti ti-edit f-20"></i>
                                                        </a>
                                                    @endif

                                                    <a href="#" class="avtar avtar-xs btn-link-secondary bs-pass-para"
                                                        data-id="{{ $order->id }}" data-bs-toggle="tooltip"
                                                        title="Delete"
                                                        onclick="deleteOrder({{ $order->id }}); return false;">
                                                        <i class="ti ti-trash f-20"></i>
                                                    </a>

                                                    <form id="delete-form-{{ $order->id }}"
                                                        action="{{ route('admin.orders.destroy', $order->id) }}"
                                                        method="POST" style="display: none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center">
                                                    <div class="py-4">
                                                        <i class="ti ti-shopping-cart-off f-40 text-muted"></i>
                                                        <p class="text-muted mt-2">No orders found</p>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            @if ($orders->hasPages())
                                <div class="mt-3">
                                    {{ $orders->links() }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function deleteOrder(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "This order will be permanently deleted!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }
    </script>
@endsection
<script>
    document.addEventListener('DOMContentLoaded', function() {
        window.dt = new simpleDatatables.DataTable('#pc-dt-simple', {
            sortable: true,
            searchable: true,
            fixedHeight: true
        });
    });
</script>
