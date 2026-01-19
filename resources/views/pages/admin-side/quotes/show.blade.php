@extends('layouts.admin')

@section('content')
    <div class="pc-container">
        <div class="pc-content">
            <!-- Breadcrumb -->
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
                            <div class="page-header-title d-flex justify-content-between align-items-center">
                                <h2 class="mb-0">Quote Request #{{ $quoteRequest->id }}</h2>

                                <!-- Action Buttons -->
                                <div class="d-flex gap-2">
                                    @if ($quoteRequest->isExistingClient())
                                        <!-- If Client Exists - Show View Client & Create Order -->
                                        <a href="{{ route('admin.clients.show', $quoteRequest->client_id) }}"
                                            class="btn btn-light-info">
                                            <i class="ti ti-user-check me-1"></i> View Client
                                        </a>

                                        <a href="{{ route('admin.orders.create', ['quote_id' => $quoteRequest->id]) }}"
                                            class="btn btn-light-success">
                                            <i class="ti ti-shopping-cart me-1"></i> Create Order
                                        </a>
                                    @else
                                        <!-- If Client Doesn't Exist - Show Convert Button -->
                                        <form action="{{ route('admin.quotes.convertToClient', $quoteRequest) }}"
                                            method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-light-success"
                                                onclick="return confirm('Convert this quote to a client?')">
                                                <i class="ti ti-user-plus me-1"></i> Convert to Client
                                            </button>
                                        </form>
                                    @endif

                                    @if ($quoteRequest->quote_status !== 'rejected')
                                        <form action="{{ route('admin.quotes.reject', $quoteRequest) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-light-danger"
                                                onclick="return confirm('Reject this quote?')">
                                                <i class="ti ti-x me-1"></i> Reject
                                            </button>
                                        </form>
                                    @endif

                                    {{-- @if ($quoteRequest->quote_status === 'rejected' || $quoteRequest->quote_status === 'converted')
                                        <form action="{{ route('admin.quotes.reopen', $quoteRequest) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-light-warning">
                                                <i class="ti ti-refresh me-1"></i> Reopen
                                            </button>
                                        </form>
                                    @endif --}}

                                    <button type="button" class="btn btn-light-primary" data-bs-toggle="modal"
                                        data-bs-target="#addActivityModal">
                                        <i class="ti ti-plus me-1"></i> Add Activity
                                    </button>

                                    {{-- <form action="{{ route('admin.quotes.destroy', $quoteRequest) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger"
                                            onclick="return confirm('Delete this quote permanently?')">
                                            <i class="ti ti-trash me-1"></i> Delete
                                        </button>
                                    </form> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @include('components.alerts')

            <!-- Main Content -->
            <div class="row">
                <!-- Left Column - Customer Info -->
                <div class="col-md-4">
                    <!-- Customer Information Card -->
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
                                    <small class="text-muted">
                                        @if ($quoteRequest->isExistingClient())
                                            <i class="ti ti-check-circle text-success"></i> Existing Client
                                        @else
                                            <i class="ti ti-user-question text-warning"></i> New Customer
                                        @endif
                                    </small>
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
                                                @switch($quoteRequest->status)
                                                    @case('pending')
                                                        <span class="badge bg-light-warning">Pending</span>
                                                    @break

                                                    @case('processing')
                                                        <span class="badge bg-light-info">Processing</span>
                                                    @break

                                                    @case('completed')
                                                        <span class="badge bg-light-success">Completed</span>
                                                    @break

                                                    @case('cancelled')
                                                        <span class="badge bg-light-danger">Cancelled</span>
                                                    @break
                                                @endswitch
                                            </h6>
                                        </div>
                                    </div>
                                </div>

                                {{-- <div class="col-12">
                                    <div class="d-flex align-items-center">
                                        <div class="avtar avtar-s bg-light-secondary flex-shrink-0">
                                            <i class="ti ti-flag"></i>
                                        </div>
                                        <div class="ms-2">
                                            <p class="mb-0 text-muted small">Quote Status</p>
                                            <h6 class="mb-0">
                                                @switch($quoteRequest->quote_status)
                                                    @case('pending')
                                                        <span class="badge bg-light-warning">Pending</span>
                                                    @break

                                                    @case('converted')
                                                        <span class="badge bg-light-success">Converted</span>
                                                    @break

                                                    @case('rejected')
                                                        <span class="badge bg-light-danger">Rejected</span>
                                                    @break

                                                    @case('reopened')
                                                        <span class="badge bg-light-info">Reopened</span>
                                                    @break
                                                @endswitch
                                            </h6>
                                        </div>
                                    </div>
                                </div> --}}
                            </div>

                            <!-- Message History Section -->
                            @php
                                // Get all email activities from the quote
                                $emailActivities = $quoteRequest
                                    ->activities()
                                    ->where('type', 'email')
                                    ->orWhere(function ($query) {
                                        $query->whereNotNull('details')->where('details', 'like', '%Email sent%');
                                    })
                                    ->latest()
                                    ->get();

                                $hasMessages = $quoteRequest->customer_message || $emailActivities->isNotEmpty();
                            @endphp

                            @if ($hasMessages)
                                <hr>
                                <div class="message-history">
                                    <h6 class="mb-3 text-dark">
                                        <i class="ti ti-messages me-1"></i> Conversation History
                                    </h6>

                                    <div class="messages-container" style="max-height: 400px; overflow-y: auto;">
                                        <!-- Customer Initial Message -->
                                        @if ($quoteRequest->customer_message)
                                            <div class="message-item mb-3">
                                                <div class="d-flex align-items-start">
                                                    <div class="avtar avtar-s bg-light-primary flex-shrink-0">
                                                        <i class="ti ti-user"></i>
                                                    </div>
                                                    <div class="ms-2 flex-grow-1">
                                                        <div
                                                            class="d-flex justify-content-between align-items-center mb-1">
                                                            <strong
                                                                class="small text-dark">{{ $quoteRequest->customer_name }}</strong>
                                                            <small
                                                                class="text-muted">{{ $quoteRequest->created_at->format('d M, Y h:i A') }}</small>
                                                        </div>
                                                        <div class="message-content bg-light-primary p-2 rounded">
                                                            <p class="mb-0 small">{{ $quoteRequest->customer_message }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        <!-- Admin Replies -->
                                        @foreach ($emailActivities as $activity)
                                            @php
                                                // Extract the actual message from activity details
                                                $messageContent = '';
                                                if (str_contains($activity->details, 'Email sent to customer:')) {
                                                    $messageContent = trim(
                                                        str_replace('Email sent to customer:', '', $activity->details),
                                                    );
                                                } else {
                                                    $messageContent = $activity->details;
                                                }
                                            @endphp

                                            <div class="message-item mb-3">
                                                <div class="d-flex align-items-start">
                                                    <div class="avtar avtar-s bg-light-success flex-shrink-0">
                                                        <i class="ti ti-headset"></i>
                                                    </div>
                                                    <div class="ms-2 flex-grow-1">
                                                        <div
                                                            class="d-flex justify-content-between align-items-center mb-1">
                                                            <strong class="small text-dark">Admin Support</strong>
                                                            <small
                                                                class="text-muted">{{ $activity->created_at->format('d M, Y h:i A') }}</small>
                                                        </div>
                                                        <div class="message-content bg-light-success p-2 rounded">
                                                            <p class="mb-0 small">{{ $messageContent }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            <hr>

                            <!-- Action Buttons -->
                            <div class="d-grid gap-2">
                                <button type="button" class="btn btn-light-success" data-bs-toggle="modal"
                                    data-bs-target="#replyModal">
                                    <i class="ti ti-send me-1"></i> Send Message
                                </button>

                                <a href="{{ route('admin.quotes.index') }}" class="btn btn-outline-secondary">
                                    <i class="ti ti-arrow-left me-1"></i> Back to List
                                </a>
                            </div>
                        </div>
                    </div>

                    <style>
                        .message-history {
                            background: #f8f9fa;
                            padding: 15px;
                            border-radius: 8px;
                        }

                        .messages-container {
                            padding: 10px 0;
                        }

                        .message-item {
                            animation: fadeIn 0.3s ease-in;
                        }

                        @keyframes fadeIn {
                            from {
                                opacity: 0;
                                transform: translateY(10px);
                            }

                            to {
                                opacity: 1;
                                transform: translateY(0);
                            }
                        }

                        .message-content {
                            position: relative;
                            word-wrap: break-word;
                            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
                        }

                        .message-content p {
                            line-height: 1.6;
                        }

                        .messages-container::-webkit-scrollbar {
                            width: 6px;
                        }

                        .messages-container::-webkit-scrollbar-track {
                            background: #f1f1f1;
                            border-radius: 10px;
                        }

                        .messages-container::-webkit-scrollbar-thumb {
                            background: #888;
                            border-radius: 10px;
                        }

                        .messages-container::-webkit-scrollbar-thumb:hover {
                            background: #555;
                        }

                        /* Customer message styling */
                        .bg-light-primary.message-content {
                            background-color: rgba(70, 128, 255, 0.1) !important;
                            border-left: 3px solid #4680ff;
                        }

                        /* Admin message styling */
                        .bg-light-success.message-content {
                            background-color: rgba(44, 168, 127, 0.1) !important;
                            border-left: 3px solid #2ca87f;
                        }
                    </style>
                </div>

                <!-- Right Column - Products & Status -->
                <div class="col-md-8">
                    <!-- Products Requested -->
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Products Requested</h5>
                            <button type="button" class="btn btn-light-info btn-sm" data-bs-toggle="offcanvas"
                                data-bs-target="#activityOffcanvas">
                                <i class="ti ti-history me-1"></i> Activity Log
                            </button>
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
                                                    <div class="d-flex align-items-center justify-content-center gap-2">
                                                        <button class="btn btn-sm btn-icon btn-light-secondary"
                                                            onclick="updateQuantity({{ $product->id }}, -1, this)">
                                                            <i class="ti ti-minus"></i>
                                                        </button>
                                                        <span class="badge bg-light-primary px-3 quantity-display"
                                                            id="qty-{{ $product->id }}"
                                                            data-quantity="{{ $quantity }}">
                                                            {{ $quantity }}
                                                        </span>
                                                        <button class="btn btn-sm btn-icon btn-light-secondary"
                                                            onclick="updateQuantity({{ $product->id }}, 1, this)">
                                                            <i class="ti ti-plus"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                                <td class="text-end">
                                                    <strong class="subtotal-display" id="subtotal-{{ $product->id }}"
                                                        data-price="{{ $product->price }}">
                                                        PKR {{ number_format($subtotal, 2) }}
                                                    </strong>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr class="table-active">
                                            <th colspan="4" class="text-end">Total Amount:</th>
                                            <th class="text-end">
                                                <h5 class="mb-0" id="total-amount">PKR {{ number_format($total, 2) }}
                                                </h5>
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
                                                {{ $quoteRequest->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="processing"
                                                {{ $quoteRequest->status == 'processing' ? 'selected' : '' }}>Processing
                                            </option>
                                            <option value="completed"
                                                {{ $quoteRequest->status == 'completed' ? 'selected' : '' }}>Completed
                                            </option>
                                            <option value="cancelled"
                                                {{ $quoteRequest->status == 'cancelled' ? 'selected' : '' }}>Cancelled
                                            </option>
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
                </div>
            </div>
        </div>
    </div>

    <!-- Reply Modal -->
    <div class="modal fade" id="replyModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form action="{{ route('admin.quotes.reply', $quoteRequest->id) }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Reply to {{ $quoteRequest->customer_name }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label"><strong>To:</strong></label>
                            <p class="mb-0">{{ $quoteRequest->customer_email }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Message <span class="text-danger">*</span></label>
                            <textarea name="reply_message" class="form-control" rows="8" placeholder="Type your message here..." required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="ti ti-send me-1"></i> Send Reply
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Add Activity Modal -->
    <div class="modal fade" id="addActivityModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('admin.quotes.storeActivity', $quoteRequest) }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Activity</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Activity Type <span class="text-danger">*</span></label>
                            <select name="type" class="form-select" required>
                                <option value="">Select Type</option>
                                <option value="call">Phone Call</option>
                                <option value="message">Message/SMS</option>
                                <option value="meeting">Meeting</option>
                                <option value="email">Email</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Details <span class="text-danger">*</span></label>
                            <textarea name="details" class="form-control" rows="4" placeholder="Enter activity details..." required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="ti ti-plus me-1"></i> Add Activity
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Activity Offcanvas -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="activityOffcanvas" style="width: 400px;">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title">
                <i class="ti ti-history me-2"></i> Activity Log
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body p-0">
            <div class="activity-timeline p-3">
                @forelse($quoteRequest->activities as $activity)
                    <div class="timeline-item mb-4">
                        <div class="d-flex">
                            <div class="flex-shrink-0">
                                <div
                                    class="avtar avtar-s 
                            @switch($activity->type)
                                @case('call') bg-light-info @break
                                @case('message') bg-light-warning @break
                                @case('meeting') bg-light-primary @break
                                @case('email') bg-light-success @break
                                @default bg-light-secondary
                            @endswitch">
                                    <i
                                        class="ti 
                                @switch($activity->type)
                                    @case('call') ti-phone @break
                                    @case('message') ti-message @break
                                    @case('meeting') ti-users @break
                                    @case('email') ti-mail @break
                                    @default ti-info-circle
                                @endswitch"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <div class="d-flex justify-content-between align-items-start mb-1">
                                    <h6 class="mb-0 text-sm">{{ ucfirst($activity->type) }}</h6>
                                    <small class="text-muted">{{ $activity->created_at->diffForHumans() }}</small>
                                </div>
                                <p class="text-muted mb-0 small">{{ $activity->details }}</p>
                                <small class="text-muted">{{ $activity->created_at->format('d M, Y h:i A') }}</small>
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

        .quantity-display {
            min-width: 45px;
            font-size: 14px;
            font-weight: 600;
        }

        .btn-icon {
            width: 28px;
            height: 28px;
            padding: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
    </style>

    <script>
        // Update quantity
        function updateQuantity(productId, change, button) {
            const qtyElement = document.getElementById(`qty-${productId}`);
            const subtotalElement = document.getElementById(`subtotal-${productId}`);
            const currentQty = parseInt(qtyElement.dataset.quantity);
            const newQty = currentQty + change;

            if (newQty < 1) {
                showNotification('Quantity cannot be less than 1', 'warning');
                return;
            }

            button.disabled = true;

            fetch(`/admin/quotes/{{ $quoteRequest->id }}/update-quantity`, {
                    method: 'PATCH',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        product_id: productId,
                        quantity: newQty
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        qtyElement.textContent = newQty;
                        qtyElement.dataset.quantity = newQty;

                        const price = parseFloat(subtotalElement.dataset.price);
                        const newSubtotal = price * newQty;
                        subtotalElement.textContent =
                            `PKR ${newSubtotal.toLocaleString('en-PK', {minimumFractionDigits: 2, maximumFractionDigits: 2})}`;

                        recalculateTotal();
                        showNotification('Quantity updated successfully', 'success');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showNotification('Failed to update quantity', 'danger');
                })
                .finally(() => {
                    button.disabled = false;
                });
        }

        // Recalculate total
        function recalculateTotal() {
            let total = 0;
            document.querySelectorAll('.subtotal-display').forEach(element => {
                const price = parseFloat(element.dataset.price);
                const qtyElement = element.closest('tr').querySelector('.quantity-display');
                const qty = parseInt(qtyElement.dataset.quantity);
                total += price * qty;
            });

            document.getElementById('total-amount').textContent =
                `PKR ${total.toLocaleString('en-PK', {minimumFractionDigits: 2, maximumFractionDigits: 2})}`;
        }

        // Show notification
        function showNotification(message, type = 'success') {
            const notification = document.createElement('div');
            notification.className = `alert alert-${type} alert-dismissible fade show position-fixed`;
            notification.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';

            const icon = type === 'success' ? 'ti-check' : type === 'warning' ? 'ti-alert-triangle' : 'ti-x';

            notification.innerHTML = `
        <i class="ti ${icon} me-2"></i>${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;
            document.body.appendChild(notification);

            setTimeout(() => notification.remove(), 3000);
        }

        // Status update form
        document.addEventListener('DOMContentLoaded', function() {
            const statusForm = document.getElementById('statusUpdateForm');
            const statusSelect = document.getElementById('statusSelect');

            statusForm.addEventListener('submit', function(e) {
                e.preventDefault();

                const status = statusSelect.value;

                fetch(`/admin/quotes/{{ $quoteRequest->id }}/status`, {
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
                            showNotification('Status updated successfully', 'success');
                            setTimeout(() => location.reload(), 1500);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        showNotification('Failed to update status', 'danger');
                    });
            });
        });
    </script>
@endsection
