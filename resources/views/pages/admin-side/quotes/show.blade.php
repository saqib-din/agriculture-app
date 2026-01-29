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
                                    @if ($quoteRequest->quote_status === 'rejected')
                                        <form action="{{ route('admin.quotes.reopen', $quoteRequest) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-light-warning">
                                                <i class="ti ti-refresh me-1"></i> Reopen Quote
                                            </button>
                                        </form>
                                    @elseif ($quoteRequest->quote_status === 'converted')
                                        <!-- Show View Order Button when Converted -->
                                        @if ($quoteRequest->order)
                                            <a href="{{ route('admin.orders.show', $quoteRequest->order->id) }}"
                                                class="btn btn-light-primary">
                                                <i class="ti ti-eye me-1"></i> View Order
                                            </a>
                                        @endif

                                        <span class="badge bg-light-success fs-6 px-3 py-2">
                                            <i class="ti ti-check-circle me-1"></i> Already Converted
                                        </span>
                                    @else
                                        @if ($quoteRequest->isExistingClient())
                                            <a href="{{ route('admin.clients.show', $quoteRequest->client_id) }}"
                                                class="btn btn-light-info d-flex">
                                                <i class="ti ti-user-check me-1"></i> View Client
                                            </a>

                                            <a href="{{ route('admin.orders.create', ['quote_request_id' => $quoteRequest->id]) }}"
                                                class="btn btn-light-success d-flex">
                                                <i class="ti ti-shopping-cart me-1"></i> Create Order
                                            </a>
                                        @else
                                            <button type="button" class="btn btn-light-success" id="convertToClientBtn"
                                                data-quote-id="{{ $quoteRequest->id }}">
                                                <span class="btn-text">
                                                    <i class="ti ti-user-plus me-1"></i> Convert to Client
                                                </span>
                                                <span class="btn-loading d-none">
                                                    <span class="spinner-border spinner-border-sm me-1" role="status">
                                                        <span class="visually-hidden">Loading...</span>
                                                    </span>
                                                    Converting...
                                                </span>
                                            </button>
                                        @endif

                                        <form action="{{ route('admin.quotes.reject', $quoteRequest) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-light-danger d-flex">
                                                <i class="ti ti-x me-1"></i> Reject
                                            </button>
                                        </form>
                                    @endif
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

                                <!-- Status Display -->
                                <div class="col-12">
                                    <div class="d-flex align-items-center">
                                        <div class="avtar avtar-s bg-light-secondary flex-shrink-0">
                                            <i class="ti ti-refresh"></i>
                                        </div>
                                        <div class="ms-2">
                                            <p class="mb-0 text-muted small">Status</p>
                                            <h6 class="mb-0">
                                                @switch($quoteRequest->quote_status)
                                                    @case('new')
                                                        <span class="badge bg-light-info">New</span>
                                                    @break

                                                    @case('pending')
                                                        <span class="badge bg-light-warning">Pending</span>
                                                    @break

                                                    @case('converted')
                                                        <span class="badge bg-light-primary">Converted</span>
                                                    @break

                                                    @case('completed')
                                                        <span class="badge bg-light-success">Completed</span>
                                                    @break

                                                    @case('rejected')
                                                        <span class="badge bg-light-danger">Rejected</span>
                                                    @break

                                                    @default
                                                        <span
                                                            class="badge bg-light-secondary">{{ ucfirst($quoteRequest->quote_status) }}</span>
                                                @endswitch
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <div class="d-grid gap-2">
                                <div class="d-flex justify-content-between gap-2">
                                    <button type="button" class="btn btn-light-success d-flex" data-bs-toggle="modal"
                                        data-bs-target="#replyModal">
                                        <i class="ti ti-send me-1"></i> Send Message
                                    </button>
                                    <button type="button" class="btn btn-light-warning d-flex" data-bs-toggle="modal"
                                        data-bs-target="#sendquoteModal">
                                        <i class="ti ti-mail me-1"></i> Send Quote
                                    </button>
                                </div>
                                <a href="{{ route('admin.quotes.index') }}"
                                    class="btn btn-outline-secondary d-flex justify-content-center">
                                    <i class="ti ti-arrow-left me-1"></i> Back to List
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Send Quote Modal -->
                <div class="modal fade" id="sendquoteModal">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <form action="{{ route('admin.quotes.send', $quoteRequest) }}" method="POST"
                                id="sendQuoteForm">
                                @csrf
                                <div class="modal-header">
                                    <h5 class="modal-title">Confirm Send Quote</h5>
                                    <button class="btn-close" data-bs-dismiss="modal"></button>
                                </div>

                                <div class="modal-body">
                                    <p>Are you sure you want to send this quote to
                                        <strong>{{ $quoteRequest->customer_email }}</strong>?
                                    </p>
                                    <p class="text-muted small">The quote details and invoice PDF will be sent via email in
                                        the background.</p>

                                    <div class="alert alert-info mb-0">
                                        <i class="ti ti-info-circle me-2"></i>
                                        <small>You'll receive a notification once the email is successfully sent.</small>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light-secondary"
                                        data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-light-success" id="sendQuoteBtn">
                                        <span class="btn-text">
                                            <i class="ti ti-send me-1"></i> Yes, Send By Email
                                        </span>
                                        <span class="btn-loading d-none">
                                            <span class="spinner-border spinner-border-sm me-1"></span>
                                            Processing...
                                        </span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <script>
                    document.getElementById('sendQuoteForm').addEventListener('submit', function() {
                        const btn = document.getElementById('sendQuoteBtn');
                        btn.querySelector('.btn-text').classList.add('d-none');
                        btn.querySelector('.btn-loading').classList.remove('d-none');
                        btn.disabled = true;
                    });
                </script>

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
                                <table class="table table-hover align-middle">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>SKU/Model</th>
                                            <th class="text-center">Quantity</th>
                                            <th class="text-end">Unit Price</th>
                                            <th class="text-end">Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $total = 0; @endphp
                                        @foreach ($quoteRequest->products as $product)
                                            @php
                                                $quantity = $product->pivot->quantity;
                                                $price = $product->pivot->price ?? $product->price;
                                                $subtotal = $price * $quantity;
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
                                                    <br><small class="text-muted">{{ $product->model }}</small>
                                                </td>

                                                <!-- Editable Quantity -->
                                                <td class="text-center">
                                                    <input type="number"
                                                        class="form-control form-control-sm text-center quantity-input"
                                                        id="quantity-{{ $product->id }}" value="{{ $quantity }}"
                                                        min="1" data-product-id="{{ $product->id }}"
                                                        style="max-width: 70px; margin: auto;">
                                                </td>

                                                <!-- Editable Price -->
                                                <td class="text-end">
                                                    <input type="number"
                                                        class="form-control form-control-sm text-end price-input"
                                                        id="price-{{ $product->id }}" value="{{ $price }}"
                                                        step="0.01" min="0"
                                                        data-product-id="{{ $product->id }}"
                                                        style="max-width: 100px; margin-left: auto;">
                                                </td>

                                                <!-- Subtotal -->
                                                <td class="text-end">
                                                    <strong class="subtotal-display" id="subtotal-{{ $product->id }}">
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
                </div>
            </div>
        </div>
    </div>

    <!-- Reply Modal -->
    <div class="modal fade" id="replyModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form action="{{ route('admin.quotes.reply', $quoteRequest->id) }}" method="POST" id="replyForm">
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

                        <div class="alert alert-info mb-0">
                            <i class="ti ti-info-circle me-2"></i>
                            <small>Your reply will be sent in the background. This won't block your workflow.</small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" id="replyBtn">
                            <span class="btn-text">
                                <i class="ti ti-send me-1"></i> Send Reply
                            </span>
                            <span class="btn-loading d-none">
                                <span class="spinner-border spinner-border-sm me-1"></span>
                                Sending...
                            </span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('replyForm').addEventListener('submit', function() {
            const btn = document.getElementById('replyBtn');
            btn.querySelector('.btn-text').classList.add('d-none');
            btn.querySelector('.btn-loading').classList.remove('d-none');
            btn.disabled = true;
        });
    </script>

    <!-- Activity Offcanvas -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="activityOffcanvas" style="width:480px;">
        <div class="offcanvas-header border-bottom">
            <div class="d-flex justify-content-between align-items-center w-100">
                <h5 class="offcanvas-title mb-0">
                    <i class="ti ti-history me-2"></i>Activity Timeline
                </h5>

                <!-- Add Activity Button -->
                <button class="btn btn-sm btn-primary" data-bs-toggle="collapse" data-bs-target="#addActivityForm">
                    <i class="ti ti-plus"></i> Add Activity
                </button>
            </div>
        </div>

        <div class="offcanvas-body p-0">

            <!-- Add Activity Form -->
            <div class="collapse bg-body border-bottom p-3 bg-light" id="addActivityForm">
                <form action="{{ route('admin.quotes.storeActivity', $quoteRequest) }}" method="POST" class="bg-body">
                    @csrf
                    <div class="mb-2">
                        <label class="form-label small">Activity Type</label>
                        <select name="type" class="form-select form-select-sm" required>
                            <option value="call">Call</option>
                            <option value="message">Message</option>
                            <option value="meeting">Meeting</option>
                            <option value="email">Email</option>
                            <option value="other" selected>Other</option>
                        </select>
                    </div>

                    <div class="mb-2">
                        <label class="form-label small">Title</label>
                        <input name="title" class="form-control form-control-sm" placeholder="Enter title">
                    </div>

                    <div class="mb-2">
                        <label class="form-label small">Details</label>
                        <textarea name="details" class="form-control form-control-sm" placeholder="Enter details" rows="3"></textarea>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-sm btn-light-success mt-2">
                            <i class="ti ti-check me-1"></i> Save Activity
                        </button>
                    </div>
                </form>
            </div>

            <!-- Timeline -->
            <div class="activity-timeline p-3">
                @php
                    $allActivities = collect();

                    // Add custom activities
                    foreach ($quoteRequest->activities as $activity) {
                        $allActivities->push([
                            'type' => 'custom',
                            'data' => $activity,
                            'created_at' => $activity->created_at,
                        ]);
                    }

                    // Add email logs
                    if ($quoteRequest->emailLogs) {
                        foreach ($quoteRequest->emailLogs as $emailLog) {
                            $allActivities->push([
                                'type' => 'email',
                                'data' => $emailLog,
                                'created_at' => $emailLog->created_at,
                            ]);
                        }
                    }

                    // Add initial customer message (if exists)
                    if ($quoteRequest->customer_message) {
                        $allActivities->push([
                            'type' => 'customer_message',
                            'data' => $quoteRequest,
                            'created_at' => $quoteRequest->created_at,
                        ]);
                    }

                    // Sort by date (newest first)
                    $allActivities = $allActivities->sortByDesc('created_at');
                @endphp

                @forelse($allActivities as $item)
                    <div class="timeline-item mb-4">
                        <div class="d-flex">
                            {{-- Icon based on activity type --}}
                            <div class="flex-shrink-0">
                                @if ($item['type'] === 'custom')
                                    {{-- Custom Activity --}}
                                    <div class="avtar avtar-s bg-light-{{ $item['data']->type_color }}">
                                        <i class="ti {{ $item['data']->type_icon }}"></i>
                                    </div>
                                @elseif($item['type'] === 'email')
                                    {{-- Email Log --}}
                                    <div
                                        class="avtar avtar-s bg-light-{{ $item['data']->status === 'sent' ? 'success' : ($item['data']->status === 'pending' ? 'warning' : 'danger') }}">
                                        <i class="ti ti-mail"></i>
                                    </div>
                                @else
                                    {{-- Customer Message --}}
                                    <div class="avtar avtar-s bg-light-primary">
                                        <i class="ti ti-message-circle"></i>
                                    </div>
                                @endif
                            </div>

                            {{-- Content --}}
                            <div class="flex-grow-1 ms-3">
                                @if ($item['type'] === 'custom')
                                    {{-- Custom Activity Content --}}
                                    <div class="d-flex justify-content-between align-items-start mb-1">
                                        <h6 class="mb-0 text-sm text-capitalize">
                                            {{ $item['data']->title ?? 'Activity' }}
                                        </h6>
                                        <span class="badge bg-light-{{ $item['data']->type_color }} ms-1 text-capitalize">
                                            {{ str_replace('_', ' ', $item['data']->type) }}
                                        </span>
                                    </div>
                                    <p class="text-muted mb-1" style="font-size: 0.80rem;">
                                        {{ $item['data']->details }}
                                    </p>
                                @elseif($item['type'] === 'email')
                                    {{-- Email Log Content --}}
                                    <div class="d-flex justify-content-between align-items-start mb-1">
                                        <h6 class="mb-0 text-sm">
                                            {{ ucfirst($item['data']->email_type) }} Email
                                            {{ ucfirst($item['data']->status) }}
                                        </h6>
                                        <span
                                            class="badge bg-light-{{ $item['data']->status === 'sent' ? 'success' : ($item['data']->status === 'pending' ? 'warning' : 'danger') }}">
                                            {{ ucfirst($item['data']->status) }}
                                        </span>
                                    </div>
                                    <p class="text-muted mb-1 small">
                                        <strong>To:</strong> {{ $item['data']->recipient_email }}
                                        @if ($item['data']->attempt_number > 1)
                                            <span class="badge bg-light-warning ms-1">
                                                Attempt {{ $item['data']->attempt_number }}
                                            </span>
                                        @endif
                                    </p>
                                    @if ($item['data']->error_message)
                                        <div class="alert alert-danger p-2 mb-1 mt-2">
                                            <small><strong>Error:</strong> {{ $item['data']->error_message }}</small>
                                        </div>
                                    @endif
                                @else
                                    {{-- Customer Message --}}
                                    <div class="d-flex justify-content-between align-items-start mb-1">
                                        <h6 class="mb-0 text-sm">Customer Message</h6>
                                        <span class="badge bg-light-primary ms-1">Initial Request</span>
                                    </div>
                                    <p class="text-muted mb-1" style="font-size: 0.80rem;">
                                        {{ $item['data']->customer_message }}
                                    </p>
                                @endif

                                {{-- Timestamp --}}
                                <div class="d-flex justify-content-between mt-2">
                                    <small class="text-muted">
                                        {{ $item['created_at']->format('d M, Y h:i A') }}
                                    </small>
                                    <small class="text-muted">
                                        {{ $item['created_at']->diffForHumans() }}
                                    </small>
                                </div>
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

        .price-input,
        .quantity-input {
            font-weight: 600;
        }

        .btn-loading {
            display: inline-flex;
            align-items: center;
        }

        #convertToClientBtn.loading .btn-text,
        #sendQuoteBtn.loading .btn-text {
            display: none;
        }

        #convertToClientBtn.loading .btn-loading,
        #sendQuoteBtn.loading .btn-loading {
            display: inline-flex !important;
        }

        #convertToClientBtn:disabled,
        #sendQuoteBtn:disabled {
            opacity: 0.7;
            cursor: not-allowed;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

            // Convert to Client
            const convertBtn = document.getElementById('convertToClientBtn');
            if (convertBtn) {
                convertBtn.addEventListener('click', function() {
                    const quoteId = this.dataset.quoteId;
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = `/admin/quotes/${quoteId}/convert-to-client`;

                    const csrfInput = document.createElement('input');
                    csrfInput.type = 'hidden';
                    csrfInput.name = '_token';
                    csrfInput.value = csrfToken;

                    form.appendChild(csrfInput);
                    this.classList.add('loading');
                    this.disabled = true;

                    document.body.appendChild(form);
                    form.submit();
                });
            }

            // Send Quote Form
            const sendQuoteForm = document.getElementById('sendQuoteForm');
            if (sendQuoteForm) {
                sendQuoteForm.addEventListener('submit', function(e) {
                    const btn = document.getElementById('sendQuoteBtn');
                    btn.classList.add('loading');
                    btn.disabled = true;
                });
            }

            // Handle Quantity Updates
            let quantityTimeout;
            document.querySelectorAll('.quantity-input').forEach(input => {
                input.addEventListener('change', function() {
                    clearTimeout(quantityTimeout);
                    const productId = this.dataset.productId;
                    const newQuantity = parseInt(this.value);

                    if (newQuantity < 1) {
                        showNotification('Quantity cannot be less than 1', 'warning');
                        this.value = 1;
                        return;
                    }

                    quantityTimeout = setTimeout(() => {
                        updateQuantity(productId, newQuantity);
                    }, 500);
                });
            });

            // Handle Price Updates
            let priceTimeout;
            document.querySelectorAll('.price-input').forEach(input => {
                input.addEventListener('change', function() {
                    clearTimeout(priceTimeout);
                    const productId = this.dataset.productId;
                    const newPrice = parseFloat(this.value);

                    if (isNaN(newPrice) || newPrice < 0) {
                        showNotification('Invalid price', 'warning');
                        return;
                    }

                    priceTimeout = setTimeout(() => {
                        updatePrice(productId, newPrice);
                    }, 500);
                });
            });

            // Update Quantity via AJAX
            function updateQuantity(productId, quantity) {
                fetch(`/admin/quotes/{{ $quoteRequest->id }}/update-quantity`, {
                        method: 'PATCH',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        },
                        body: JSON.stringify({
                            product_id: productId,
                            quantity: quantity
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            updateSubtotalDisplay(productId);
                            showNotification('Quantity updated success', 'success');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        showNotification('Failed to update quantity', 'danger');
                    });
            }

            // Update Price via AJAX
            function updatePrice(productId, price) {
                fetch(`/admin/quotes/{{ $quoteRequest->id }}/update-price`, {
                        method: 'PATCH',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        },
                        body: JSON.stringify({
                            product_id: productId,
                            price: price
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            updateSubtotalDisplay(productId);
                            showNotification('Price updated successfully', 'success');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        showNotification('Failed to update price', 'danger');
                    });
            }

            // Update Subtotal Display
            function updateSubtotalDisplay(productId) {
                const quantityInput = document.getElementById(`quantity-${productId}`);
                const priceInput = document.getElementById(`price-${productId}`);
                const subtotalDisplay = document.getElementById(`subtotal-${productId}`);

                const quantity = parseInt(quantityInput.value);
                const price = parseFloat(priceInput.value);
                const subtotal = quantity * price;

                subtotalDisplay.textContent = `PKR ${subtotal.toLocaleString('en-PK', {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                })}`;

                updateTotal();
            }

            // Update Total
            function updateTotal() {
                let total = 0;
                document.querySelectorAll('.subtotal-display').forEach(element => {
                    const value = parseFloat(element.textContent.replace('PKR', '').replace(/,/g, '')
                        .trim());
                    total += value;
                });

                document.getElementById('total-amount').textContent = `PKR ${total.toLocaleString('en-PK', {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                })}`;
            }

            // Notification System
            let notificationCount = 0;

            function showNotification(message, type = 'success') {
                const notification = document.createElement('div');

                notification.className = `alert alert-${type} alert-dismissible fade show`;
                notification.style.cssText = `
                    position: fixed;
                    bottom: ${20 + notificationCount * 75}px;
                    right: 20px;
                    z-index: 9999;
                    min-width: 280px;
                    max-width: 360px;
                    padding: 12px 18px;
                    border-radius: 10px;
                    box-shadow: 0 8px 20px rgba(0,0,0,0.15);
                    transition: all 0.3s ease-in-out;
                `;

                const icon =
                    type === 'success' ? 'ti-check' :
                    type === 'warning' ? 'ti-alert-triangle' :
                    type === 'danger' ? 'ti-x' :
                    'ti-info';

                notification.innerHTML = `
                    <div class="d-flex align-items-center gap-2">
                        <i class="ti ${icon} fs-5"></i>
                        <span class="flex-grow-1">${message}</span>
                        <button type="button" class="btn-close ms-2" data-bs-dismiss="alert"></button>
                    </div>
                `;

                document.body.appendChild(notification);
                notificationCount++;

                setTimeout(() => {
                    notification.classList.remove('show');
                    setTimeout(() => {
                        notification.remove();
                        notificationCount--;
                    }, 300);
                }, 3000);
            }

            window.showNotification = showNotification;
        });
    </script>

@endsection
