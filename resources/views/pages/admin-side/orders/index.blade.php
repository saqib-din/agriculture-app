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
                                    {{-- <span class="badge bg-light-primary">Total: {{ $orders->total() }}</span> --}}
                                    <a href="{{ route('admin.orders.create') }}" class="btn btn-primary btn-md">
                                        New Order
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="card-body table-card">
                            <div class="table-responsive">
                                <table class="table table-hover">
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
                                                    <select class="form-select form-select-sm status-select fw-semibold"
                                                        data-id="{{ $order->id }}"
                                                        style="width: 140px; border-radius: 20px;">
                                                        <option value="pending"
                                                            {{ $order->status == 'pending' ? 'selected' : '' }}>
                                                            Pending
                                                        </option>
                                                        <option value="in_progress"
                                                            {{ $order->status == 'in_progress' ? 'selected' : '' }}>
                                                            In Progress
                                                        </option>
                                                        <option value="delivered"
                                                            {{ $order->status == 'delivered' ? 'selected' : '' }}>
                                                            Delivered
                                                        </option>
                                                        <option value="installed"
                                                            {{ $order->status == 'installed' ? 'selected' : '' }}>
                                                            Installed
                                                        </option>
                                                        <option value="completed"
                                                            {{ $order->status == 'completed' ? 'selected' : '' }}>
                                                            Completed
                                                        </option>
                                                        <option value="cancelled"
                                                            {{ $order->status == 'cancelled' ? 'selected' : '' }}>
                                                            Cancelled
                                                        </option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <small>{{ $order->created_at->format('d M, Y') }}</small>
                                                    <br>
                                                    <small
                                                        class="text-muted">{{ $order->created_at->format('h:i A') }}</small>
                                                </td>
                                                <td class="text-end">
                                                    <a href="{{ route('admin.orders.show', $order->id) }}"
                                                        class="avtar avtar-xs btn-link-secondary" title="View Details">
                                                        <i class="ti ti-eye f-20"></i>
                                                    </a>

                                                    <a href="{{ route('admin.orders.print', $order->id) }}" target="_blank"
                                                        class="avtar avtar-xs btn-link-secondary" title="Print Order">
                                                        <i class="ti ti-printer f-20"></i>
                                                    </a>

                                                    <a href="#" class="avtar avtar-xs btn-link-secondary"
                                                        onclick="deleteOrder({{ $order->id }})" title="Delete">
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
                                                        {{-- <a href="{{ route('admin.orders.create') }}"
                                                            class="btn btn-primary btn-sm mt-2">
                                                            <i class="ti ti-plus me-1"></i> Create First Order
                                                        </a> --}}
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
        document.addEventListener('DOMContentLoaded', function() {
            // Status update
            document.querySelectorAll('.status-select').forEach(select => {
                const originalValue = select.value;

                select.addEventListener('change', function() {
                    const orderId = this.dataset.id;
                    const status = this.value;
                    const selectElement = this;

                    Swal.fire({
                        title: 'Update Status?',
                        text: `Change order status to ${status.replace('_', ' ')}?`,
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, update it',
                        cancelButtonText: 'Cancel'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            fetch(`/admin/orders/${orderId}/status`, {
                                    method: 'PATCH',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': document.querySelector(
                                            'meta[name="csrf-token"]').content
                                    },
                                    body: JSON.stringify({
                                        status: status
                                    })
                                })
                                .then(res => res.json())
                                .then(data => {
                                    if (data.success) {
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Updated',
                                            text: 'Status updated successfully',
                                            timer: 1500,
                                            showConfirmButton: false
                                        });
                                        updateStatusColor(selectElement);
                                    }
                                })
                                .catch(() => {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error',
                                        text: 'Failed to update status'
                                    });
                                    selectElement.value = originalValue;
                                });
                        } else {
                            selectElement.value = originalValue;
                        }
                    });
                });

                updateStatusColor(select);
            });

            function updateStatusColor(select) {
                select.classList.remove('text-warning', 'text-primary', 'text-info', 'text-success', 'text-danger');

                const colorMap = {
                    'pending': 'text-warning',
                    'in_progress': 'text-primary',
                    'delivered': 'text-info',
                    'installed': 'text-success',
                    'completed': 'text-success',
                    'cancelled': 'text-danger'
                };

                if (colorMap[select.value]) {
                    select.classList.add(colorMap[select.value]);
                }
            }
        });

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
