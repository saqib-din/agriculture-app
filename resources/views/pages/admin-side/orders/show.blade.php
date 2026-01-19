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
                                <li class="breadcrumb-item"><a href="{{ route('index') }}">Orders</a></li>
                                <li class="breadcrumb-item">{{ $order->order_number }}</li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="page-header-title d-flex justify-content-between align-items-center">
                                <h2 class="mb-0">Order {{ $order->order_number }}</h2>
                                <div class="btn-group">
                                    <a href="{{ route('admin.orders.print', $order->id) }}" target="_blank"
                                        class="btn btn-outline-primary">
                                        <i class="ti ti-printer me-1"></i> Print
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @include('components.alerts')

            <div class="row">
                <!-- Client Information -->
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Client Information</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <div class="avtar avtar-lg bg-light-primary">
                                    <i class="ti ti-user f-24"></i>
                                </div>
                                <div class="ms-3">
                                    <h6 class="mb-0">{{ $order->client->name }}</h6>
                                    <small class="text-muted">Client ID: #{{ $order->client->id }}</small>
                                </div>
                            </div>

                            <hr>

                            <div class="row g-3">
                                <div class="col-12">
                                    <div class="d-flex align-items-center">
                                        <div class="avtar avtar-s bg-light-secondary flex-shrink-0">
                                            <i class="ti ti-mail"></i>
                                        </div>
                                        <div class="ms-2">
                                            <p class="mb-0 text-muted small">Email</p>
                                            <h6 class="mb-0">{{ $order->client->email }}</h6>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="d-flex align-items-center">
                                        <div class="avtar avtar-s bg-light-secondary flex-shrink-0">
                                            <i class="ti ti-phone"></i>
                                        </div>
                                        <div class="ms-2">
                                            <p class="mb-0 text-muted small">Phone</p>
                                            <h6 class="mb-0">{{ $order->client->phone ?? 'N/A' }}</h6>
                                        </div>
                                    </div>
                                </div>

                                @if ($order->client->company)
                                    <div class="col-12">
                                        <div class="d-flex align-items-center">
                                            <div class="avtar avtar-s bg-light-secondary flex-shrink-0">
                                                <i class="ti ti-building"></i>
                                            </div>
                                            <div class="ms-2">
                                                <p class="mb-0 text-muted small">Company</p>
                                                <h6 class="mb-0">{{ $order->client->company }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                @if ($order->client->address)
                                    <div class="col-12">
                                        <div class="d-flex align-items-start">
                                            <div class="avtar avtar-s bg-light-secondary flex-shrink-0">
                                                <i class="ti ti-map-pin"></i>
                                            </div>
                                            <div class="ms-2">
                                                <p class="mb-0 text-muted small">Address</p>
                                                <h6 class="mb-0">{{ $order->client->address }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <div class="col-12">
                                    <div class="d-flex align-items-center">
                                        <div class="avtar avtar-s bg-light-secondary flex-shrink-0">
                                            <i class="ti ti-calendar"></i>
                                        </div>
                                        <div class="ms-2">
                                            <p class="mb-0 text-muted small">Order Date</p>
                                            <h6 class="mb-0">{{ $order->created_at->format('d M, Y h:i A') }}</h6>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="d-flex align-items-center">
                                        <div class="avtar avtar-s bg-light-secondary flex-shrink-0">
                                            <i class="ti ti-refresh"></i>
                                        </div>
                                        <div class="ms-2">
                                            <p class="mb-0 text-muted small">Status</p>
                                            <h6 class="mb-0">
                                                @php
                                                    $statusColors = [
                                                        'pending' => 'warning',
                                                        'in_progress' => 'primary',
                                                        'delivered' => 'info',
                                                        'installed' => 'success',
                                                        'completed' => 'success',
                                                        'cancelled' => 'danger',
                                                    ];
                                                @endphp
                                                <span
                                                    class="badge bg-light-{{ $statusColors[$order->status] ?? 'secondary' }}">
                                                    {{ ucfirst(str_replace('_', ' ', $order->status)) }}
                                                </span>
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <div class="d-grid gap-2">
                                <a href="{{ route('admin.clients.show', $order->client->id) }}"
                                    class="btn btn-light-info d-flex justify-content-center">
                                    <i class="ti ti-external-link me-1"></i> View Client Profile
                                </a>

                                <button type="button" class="btn btn-light-success d-flex justify-content-center"
                                    data-bs-toggle="offcanvas" data-bs-target="#activityOffcanvas">
                                    <i class="ti ti-history me-1"></i> Activity Log
                                </button>

                                <a href="{{ route('index') }}"
                                    class="btn btn-outline-secondary d-flex justify-content-center">
                                    <i class="ti ti-arrow-left me-1"></i> Back to Orders
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Order Details -->
                <div class="col-md-8">
                    <!-- Products -->
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Order Items</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>SKU</th>
                                            <th class="text-center">Quantity</th>
                                            <th class="text-end">Price</th>
                                            <th class="text-end">Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($order->products as $product)
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0">
                                                            @if ($product->images->first())
                                                                <img src="{{ asset('storage/' . $product->images->first()->image) }}"
                                                                    alt="{{ $product->name }}" class="img-radius"
                                                                    style="width: 50px; height: 50px; object-fit: cover;">
                                                            @else
                                                                <div class="avtar avtar-s bg-light-secondary">
                                                                    <i class="ti ti-package"></i>
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <div class="ms-3">
                                                            <h6 class="mb-0">{{ $product->name }}</h6>
                                                            <small class="text-muted">{{ $product->brand }}</small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="badge bg-light-secondary">{{ $product->sku }}</span>
                                                </td>
                                                <td class="text-center">
                                                    <span
                                                        class="badge bg-light-primary px-3">{{ $product->pivot->quantity }}</span>
                                                </td>
                                                <td class="text-end">
                                                    <strong>PKR {{ number_format($product->pivot->price, 2) }}</strong>
                                                </td>
                                                <td class="text-end">
                                                    <strong>PKR {{ number_format($product->pivot->subtotal, 2) }}</strong>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="4" class="text-end">Subtotal:</td>
                                            <td class="text-end"><strong>PKR
                                                    {{ number_format($order->subtotal, 2) }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" class="text-end">Tax ({{ $order->tax_rate }}%):</td>
                                            <td class="text-end"><strong>PKR
                                                    {{ number_format($order->tax_amount, 2) }}</strong></td>
                                        </tr>
                                        @if ($order->discount > 0)
                                            <tr>
                                                <td colspan="4" class="text-end">Discount:</td>
                                                <td class="text-end"><strong class="text-danger">- PKR
                                                        {{ number_format($order->discount, 2) }}</strong></td>
                                            </tr>
                                        @endif
                                        <tr class="table-active">
                                            <td colspan="4" class="text-end">
                                                <h5 class="mb-0">Grand Total:</h5>
                                            </td>
                                            <td class="text-end">
                                                <h5 class="mb-0">PKR {{ number_format($order->total, 2) }}</h5>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Order Status Update -->
                    <div class="card mt-3">
                        <div class="card-header">
                            <h5 class="mb-0">Update Order Status</h5>
                        </div>
                        <div class="card-body">
                            <form id="statusUpdateForm">
                                @csrf
                                <div class="row align-items-end">
                                    <div class="col-md-8">
                                        <label class="form-label">Change Order Status</label>
                                        <select class="form-select" id="statusSelect" name="status">
                                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>
                                                Pending</option>
                                            <option value="in_progress"
                                                {{ $order->status == 'in_progress' ? 'selected' : '' }}>In Progress
                                            </option>
                                            <option value="delivered"
                                                {{ $order->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                                            <option value="installed"
                                                {{ $order->status == 'installed' ? 'selected' : '' }}>Installed</option>
                                            <option value="completed"
                                                {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                            <option value="cancelled"
                                                {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <button type="submit" class="btn btn-primary w-100">
                                            <i class="ti ti-check me-1"></i> Update Status
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Notes -->
                    @if ($order->notes)
                        <div class="card mt-3">
                            <div class="card-header">
                                <h5 class="mb-0">Order Notes</h5>
                            </div>
                            <div class="card-body">
                                <p class="mb-0">{{ $order->notes }}</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Activity Offcanvas -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="activityOffcanvas" style="width: 450px;">
        <div class="offcanvas-header border-bottom">
            <h5 class="offcanvas-title">
                <i class="ti ti-history me-2"></i>Activity Timeline
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body p-0">
            <!-- Add Activity Form -->
            <div class="p-3 bg-light border-bottom">
                <button type="button" class="btn btn-sm btn-primary w-100" data-bs-toggle="collapse"
                    data-bs-target="#addActivityForm">
                    <i class="ti ti-plus me-1"></i> Add Activity
                </button>

                <div class="collapse mt-3" id="addActivityForm">
                    <form action="{{ route('admin.orders.storeActivity', $order->id) }}" method="POST">
                        @csrf
                        <div class="mb-2">
                            <label class="form-label small">Activity Type</label>
                            <select name="type" class="form-select form-select-sm" required>
                                <option value="call">Call</option>
                                <option value="message">Message</option>
                                <option value="meeting">Meeting</option>
                                <option value="email">Email</option>
                                <option value="payment">Payment Received</option>
                                <option value="other" selected>Other</option>
                            </select>
                        </div>
                        <div class="mb-2">
                            <label class="form-label small">Details</label>
                            <textarea name="details" class="form-control form-control-sm" rows="3" placeholder="Enter activity details..."
                                required></textarea>
                        </div>
                        <button type="submit" class="btn btn-sm btn-success w-100">
                            <i class="ti ti-check me-1"></i> Save Activity
                        </button>
                    </form>
                </div>
            </div>

            <!-- Activities Timeline -->
            <div class="activity-timeline p-3">
                @forelse($order->activities as $activity)
                    <div class="timeline-item mb-4">
                        <div class="d-flex">
                            <div class="flex-shrink-0">
                                <div class="avtar avtar-s bg-light-{{ $activity->type_color }}">
                                    <i class="ti {{ $activity->type_icon }}"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <div class="d-flex justify-content-between align-items-start mb-1">
                                    <h6 class="mb-0 text-sm text-capitalize">
                                        {{ str_replace('_', ' ', $activity->type) }}
                                    </h6>
                                    <small class="text-muted">{{ $activity->created_at->diffForHumans() }}</small>
                                </div>
                                <p class="text-muted mb-1 small">{{ $activity->details }}</p>
                                <small class="text-muted" style="font-size: 0.75rem;">
                                    {{ $activity->created_at->format('d M, Y h:i A') }}
                                </small>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-5">
                        <div class="avtar avtar-xl bg-light-secondary mx-auto mb-3">
                            <i class="ti ti-clipboard-off f-32"></i>
                        </div>
                        <h6 class="text-muted">No activities yet</h6>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <style>
        .timeline-item {
            position: relative;
            padding-left: 0;
        }

        .timeline-item:not(:last-child):before {
            content: '';
            position: absolute;
            left: 18px;
            top: 40px;
            bottom: -20px;
            width: 2px;
            background: #e9ecef;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const statusForm = document.getElementById('statusUpdateForm');

            statusForm.addEventListener('submit', function(e) {
                e.preventDefault();

                const status = document.getElementById('statusSelect').value;

                fetch(`/admin/orders/{{ $order->id }}/status`, {
                        method: 'PATCH',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({
                            status: status
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: 'Status updated successfully',
                                timer: 1500,
                                showConfirmButton: false
                            });
                            setTimeout(() => location.reload(), 1500);
                        }
                    })
                    .catch(error => {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Failed to update status'
                        });
                    });
            });
        });
    </script>
@endsection
