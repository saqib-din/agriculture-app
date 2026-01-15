@extends('layouts.admin')

@section('content')
    <!-- [ Main Content ] start -->
    <div class="pc-container">
        <div class="pc-content">

            <!-- [ breadcrumb ] start -->
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.quotes.index') }}">Quotes</a></li>
                                <li class="breadcrumb-item" aria-current="page">Details</li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">Quote Request {{ $quoteRequest->id }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ breadcrumb ] end -->

            @include('components.alerts')

            <!-- [ Main Content ] start -->
            <div class="row">
                <!-- Customer Information -->
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Customer Information</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <div class="avtar avtar-lg bg-light-primary">
                                    <i class="ti ti-user f-24"></i>
                                </div>
                                <div class="ms-3">
                                    <h6 class="mb-0">{{ $quoteRequest->customer_name }}</h6>
                                    <small class="text-muted">Customer</small>
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
                                            <h6 class="mb-0">{{ $quoteRequest->customer_email }}</h6>
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
                                            <h6 class="mb-0">{{ $quoteRequest->customer_phone ?? 'N/A' }}</h6>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="d-flex align-items-center">
                                        <div class="avtar avtar-s bg-light-secondary flex-shrink-0">
                                            <i class="ti ti-calendar"></i>
                                        </div>
                                        <div class="ms-2">
                                            <p class="mb-0 text-muted small">Request Date</p>
                                            <h6 class="mb-0">{{ $quoteRequest->created_at->format('d M, Y h:i A') }}</h6>
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
                                                @if ($quoteRequest->status == 'pending')
                                                    <span class="badge bg-light-warning">Pending</span>
                                                @elseif($quoteRequest->status == 'processing')
                                                    <span class="badge bg-light-info">Processing</span>
                                                @elseif($quoteRequest->status == 'completed')
                                                    <span class="badge bg-light-success">Completed</span>
                                                @else
                                                    <span class="badge bg-light-danger">Cancelled</span>
                                                @endif
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @if ($quoteRequest->customer_message)
                                <hr>
                                <div>
                                    <h6 class="mb-2">
                                        <i class="ti ti-message-circle me-1"></i>Message
                                    </h6>
                                    <p class="text-muted mb-0" style="font-size: 0.875rem;">
                                        {{ $quoteRequest->customer_message }}
                                    </p>
                                </div>
                            @endif

                            <hr>

                            <div class="d-grid gap-2">
                                <!-- Reply Button -->
                                <button type="button" class="btn btn-light-success btn-md d-flex justify-content-center"
                                    data-bs-toggle="modal" data-bs-target="#replyModal">
                                    <i class="ti ti-mail me-1"></i> Reply
                                </button>



                                <a href="{{ route('admin.quotes.index') }}" class="btn btn-outline-secondary btn-md d-flex justify-content-center">
                                    <i class="ti ti-arrow-left me-1"></i>Back to List
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Products Requested -->
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Products Requested</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>SKU</th>
                                            <th class="text-end">Model</th>
                                            <th class="text-center">Quantity</th>
                                            <th class="text-end">Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $total = 0; @endphp
                                        @foreach ($quoteRequest->products as $product)
                                            @php
                                                $quantity = $product->pivot->quantity;
                                                $subtotal = $product->price * $quantity;
                                                $total += $subtotal;
                                            @endphp
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
                                                <td class="text-end">
                                                    <strong>{{ $product->model }}</strong>
                                                </td>
                                                <td class="text-center">
                                                    <span class="badge bg-light-primary">{{ $quantity }}</span>
                                                </td>
                                                <td class="text-end">
                                                    <strong>PKR {{ number_format($subtotal, 2) }}</strong>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr class="table-active">
                                            <th colspan="4" class="text-end">Total Amount:</th>
                                            <th class="text-end">
                                                <h5 class="mb-0">PKR {{ number_format($total, 2) }}</h5>
                                            </th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Update Status Card -->
                    <div class="card mt-3">
                        <div class="card-header">
                            <h5 class="mb-0">Update Status</h5>
                        </div>
                        <div class="card-body">
                            <form id="statusUpdateForm">
                                @csrf
                                <div class="row align-items-end">
                                    <div class="col-md-8">
                                        <label class="form-label">Change Request Status</label>
                                        <select class="form-select" id="statusSelect" name="status">
                                            <option value="pending"
                                                {{ $quoteRequest->status == 'pending' ? 'selected' : '' }}>
                                                Pending
                                            </option>
                                            <option value="processing"
                                                {{ $quoteRequest->status == 'processing' ? 'selected' : '' }}>
                                                Processing
                                            </option>
                                            <option value="completed"
                                                {{ $quoteRequest->status == 'completed' ? 'selected' : '' }}>
                                                Completed
                                            </option>
                                            <option value="cancelled"
                                                {{ $quoteRequest->status == 'cancelled' ? 'selected' : '' }}>
                                                Cancelled
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <button type="submit" class="btn btn-primary w-100 d-flex justify-content-center">
                                            <i class="ti ti-check me-1"></i>Update Status
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </div>
    <!-- [ Main Content ] end -->

    <!-- Reply Modal -->
    <div class="modal fade" id="replyModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form id="replyForm" action="{{ route('admin.quotes.reply', $quoteRequest->id) }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Reply to {{ $quoteRequest->customer_name }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p><strong>To:</strong> {{ $quoteRequest->customer_email }}</p>
                        <textarea name="reply_message" class="form-control" rows="8" placeholder="Type your message here..." required></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Send Reply</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const statusForm = document.getElementById('statusUpdateForm');
            const statusSelect = document.getElementById('statusSelect');

            statusForm.addEventListener('submit', function(e) {
                e.preventDefault();

                const status = statusSelect.value;
                const quoteId = {{ $quoteRequest->id }};

                fetch(`/admin/quotes/${quoteId}/status`, {
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
                            // Show success notification
                            const notification = document.createElement('div');
                            notification.className =
                                'alert alert-success alert-dismissible fade show position-fixed';
                            notification.style.cssText =
                                'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
                            notification.innerHTML = `
                                <i class="ti ti-check me-2"></i>Status updated successfully!
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            `;
                            document.body.appendChild(notification);

                            setTimeout(() => {
                                notification.remove();
                                location.reload();
                            }, 2000);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Failed to update status');
                    });
            });
        });
    </script>
@endsection
