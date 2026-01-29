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
                                <li class="breadcrumb-item"><a href="{{ route('admin.orders.index') }}">Orders</a></li>
                                <li class="breadcrumb-item">{{ $order->order_number }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            @include('components.alerts')

            <div class="col-md-12">
                <div class="page-header-title d-flex justify-content-between align-items-center flex-wrap">
                    <div class="d-print-none card mb-3 w-100">
                        <div class="card-body p-3">
                            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

                                {{-- Order Number --}}
                                <div class="d-flex align-items-center gap-2">
                                    <h2 class="mb-0">{{ $order->order_number }}</h2>
                                </div>

                                {{-- Action Buttons --}}
                                <ul class="list-inline mb-0 d-flex justify-content-end flex-wrap gap-2">

                                    {{-- Reopen Order Button --}}
                                    @if ($order->canBeReopened())
                                        <li class="list-inline-item">
                                            <form action="{{ route('admin.orders.reopenOrder', $order->id) }}"
                                                method="POST" class="d-inline reopen-form">
                                                @csrf
                                                <button type="submit" class="avtar avtar-s btn-link-warning reopen-btn"
                                                    data-bs-toggle="tooltip" title="Reopen Order">
                                                    <span class="btn-icon">
                                                        <i class="ti ti-refresh f-22"></i>
                                                    </span>
                                                    <span class="btn-loading d-none">
                                                        <span class="spinner-border spinner-border-sm"></span>
                                                    </span>
                                                </button>
                                            </form>
                                        </li>
                                    @endif

                                    {{-- Generate Invoice Button --}}
                                    <li class="list-inline-item">
                                        <a href="{{ route('admin.orders.print', $order->id) }}" target="_blank"
                                            class="avtar avtar-s btn-link-primary" data-bs-toggle="tooltip"
                                            title="Generate Invoice">
                                            <i class="ti ti-printer f-22"></i>
                                        </a>
                                    </li>

                                    {{-- Edit Button --}}
                                    @if (!in_array($order->status, ['completed', 'cancelled']))
                                        <li class="list-inline-item">
                                            <a href="{{ route('admin.orders.edit', $order->id) }}"
                                                class="avtar avtar-s btn-link-secondary" data-bs-toggle="tooltip"
                                                title="Edit Order">
                                                <i class="ti ti-edit f-22"></i>
                                            </a>
                                        </li>
                                    @endif

                                    {{-- Mark Completed Button --}}
                                    @if (!in_array($order->status, ['completed', 'cancelled']))
                                        <li class="list-inline-item">
                                            <form action="{{ route('admin.orders.markCompleted', $order->id) }}"
                                                method="POST" class="d-inline complete-form">
                                                @csrf
                                                <button type="submit" class="avtar avtar-s btn-link-success complete-btn"
                                                    data-bs-toggle="tooltip" title="Mark Completed">
                                                    <span class="btn-icon">
                                                        <i class="ti ti-check f-22"></i>
                                                    </span>
                                                    <span class="btn-loading d-none">
                                                        <span class="spinner-border spinner-border-sm"></span>
                                                    </span>
                                                </button>
                                            </form>
                                        </li>

                                        {{-- Cancel Order Button --}}
                                        <li class="list-inline-item">
                                            <form action="{{ route('admin.orders.markCancelled', $order->id) }}"
                                                method="POST" class="d-inline cancel-form">
                                                @csrf
                                                <button type="submit" class="avtar avtar-s btn-link-danger cancel-btn"
                                                    data-bs-toggle="tooltip" title="Cancel Order">
                                                    <span class="btn-icon">
                                                        <i class="ti ti-x f-22"></i>
                                                    </span>
                                                    <span class="btn-loading d-none">
                                                        <span class="spinner-border spinner-border-sm"></span>
                                                    </span>
                                                </button>
                                            </form>
                                        </li>
                                    @endif

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

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
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <div class="d-grid gap-2">
                                <button type="button"
                                    class="btn btn-light-warning d-flex justify-content-center open-invoice-modal"
                                    data-route="{{ route('admin.orders.sendInvoice', $order->id) }}"
                                    data-email="{{ $order->client->email }}">
                                    <i class="ti ti-mail me-2"></i> Send Invoice By Email
                                </button>

                                <a href="{{ route('admin.clients.show', $order->client->id) }}"
                                    class="btn btn-light-success d-flex justify-content-center">
                                    <i class="ti ti-external-link me-1"></i> View Client Profile
                                </a>

                                <a href="{{ route('admin.orders.index') }}"
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
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Order Items</h5>
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
            <div class="p-3 bg-body border-bottom">
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="collapse"
                        data-bs-target="#addActivityForm">
                        <i class="ti ti-plus me-1"></i> Add Activity
                    </button>
                </div>

                <div class="collapse mt-3" id="addActivityForm">
                    <form action="{{ route('admin.orders.storeActivity', $order->id) }}" method="POST" class="bg-body">
                        @csrf

                        <div class="mb-2">
                            <label class="form-label small text-body">
                                Activity Type <span class="text-danger">*</span>
                            </label>
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
                            <label class="form-label small text-body">Title</label>
                            <input name="title" class="form-control form-control-sm" placeholder="Enter Title">
                        </div>

                        <div class="mb-2">
                            <label class="form-label small text-body">Details</label>
                            <textarea name="details" class="form-control form-control-sm" rows="3" placeholder="Enter details"></textarea>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-sm btn-light-success mt-2">
                                <i class="ti ti-check me-1"></i> Save Activity
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Blade - Without Spatie for now -->
            <div class="activity-timeline p-3">
                @php
                    $allActivities = collect();

                    // Custom activities
                    foreach ($order->activities as $activity) {
                        $allActivities->push([
                            'type' => 'custom',
                            'data' => $activity,
                            'created_at' => $activity->created_at,
                        ]);
                    }

                    // Email logs
                    foreach ($order->emailLogs as $emailLog) {
                        $allActivities->push([
                            'type' => 'email',
                            'data' => $emailLog,
                            'created_at' => $emailLog->created_at,
                        ]);
                    }

                    $allActivities = $allActivities->sortByDesc('created_at');
                @endphp

                @forelse($allActivities as $item)
                    <div class="timeline-item mb-4">
                        <div class="d-flex">
                            <div class="flex-shrink-0">
                                @if ($item['type'] === 'custom')
                                    <div class="avtar avtar-s bg-light-{{ $item['data']->type_color }}">
                                        <i class="ti {{ $item['data']->type_icon }}"></i>
                                    </div>
                                @else
                                    {{-- Email --}}
                                    <div
                                        class="avtar avtar-s bg-light-{{ $item['data']->status === 'sent' ? 'success' : ($item['data']->status === 'pending' ? 'warning' : 'danger') }}">
                                        <i class="ti ti-mail"></i>
                                    </div>
                                @endif
                            </div>

                            <div class="flex-grow-1 ms-3">
                                @if ($item['type'] === 'custom')
                                    {{-- Custom Activity --}}
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
                                @else
                                    {{-- Email Log --}}
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
                                @endif

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

    {{-- ===== Send Invoice Modal ===== --}}
    <div class="modal fade" id="sendInvoiceModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form method="POST" id="sendInvoiceForm">
                    @csrf

                    <div class="modal-header">
                        <h5 class="modal-title">Confirm Send Invoice</h5>
                        <button class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <p>
                            Are you sure you want to send this invoice to
                            <strong id="invoiceEmail"></strong>?
                        </p>
                        <p class="text-muted small">
                            The invoice PDF will be sent via email in the background.
                        </p>

                        <div class="alert alert-info mb-0">
                            <i class="ti ti-info-circle me-2"></i>
                            <small>You'll be notified once the email is successfully delivered. You can continue working
                                without waiting.</small>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                            Cancel
                        </button>

                        <button type="submit" class="btn btn-light-success" id="sendInvoiceBtn">
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
@endsection

{{-- Styles --}}
@push('styles')
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
@endpush

{{-- Scripts --}}
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // ========== Send Invoice Modal Logic ==========
            const sendInvoiceModal = document.getElementById('sendInvoiceModal');
            const sendInvoiceForm = document.getElementById('sendInvoiceForm');
            const sendInvoiceBtn = document.getElementById('sendInvoiceBtn');
            const invoiceEmailElement = document.getElementById('invoiceEmail');

            // Handle click on "open-invoice-modal" buttons
            document.querySelectorAll('.open-invoice-modal').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();

                    const route = this.getAttribute('data-route');
                    const email = this.getAttribute('data-email');

                    // Set form action
                    sendInvoiceForm.action = route;

                    // Display email
                    invoiceEmailElement.textContent = email;

                    // Reset button state
                    resetButton(sendInvoiceBtn);

                    // Show modal
                    const modal = new bootstrap.Modal(sendInvoiceModal);
                    modal.show();
                });
            });

            // Handle form submission
            sendInvoiceForm.addEventListener('submit', function() {
                showLoading(sendInvoiceBtn);
            });

            // Reset button when modal closes
            sendInvoiceModal.addEventListener('hidden.bs.modal', function() {
                resetButton(sendInvoiceBtn);
            });

            // ========== Other Form Handlers ==========

            // Reopen Order Form
            const reopenForm = document.querySelector('.reopen-form');
            if (reopenForm) {
                const reopenBtn = reopenForm.querySelector('.reopen-btn');
                reopenForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    toggleIconLoading(reopenBtn, true);
                    this.submit();
                });
            }

            // Complete Order Form
            const completeForm = document.querySelector('.complete-form');
            if (completeForm) {
                const completeBtn = completeForm.querySelector('.complete-btn');
                completeForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    toggleIconLoading(completeBtn, true);
                    this.submit();
                });
            }

            // Cancel Order Form
            const cancelForm = document.querySelector('.cancel-form');
            if (cancelForm) {
                const cancelBtn = cancelForm.querySelector('.cancel-btn');
                cancelForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    toggleIconLoading(cancelBtn, true);
                    this.submit();
                });
            }

            // ========== Helper Functions ==========

            // For modal buttons with .btn-text and .btn-loading
            function showLoading(button) {
                button.querySelector('.btn-text').classList.add('d-none');
                button.querySelector('.btn-loading').classList.remove('d-none');
                button.disabled = true;
            }

            function resetButton(button) {
                button.querySelector('.btn-text').classList.remove('d-none');
                button.querySelector('.btn-loading').classList.add('d-none');
                button.disabled = false;
            }

            // For icon buttons with .btn-icon and .btn-loading
            function toggleIconLoading(button, isLoading) {
                const btnIcon = button.querySelector('.btn-icon');
                const btnLoading = button.querySelector('.btn-loading');

                if (isLoading) {
                    btnIcon.classList.add('d-none');
                    btnLoading.classList.remove('d-none');
                    button.disabled = true;
                } else {
                    btnIcon.classList.remove('d-none');
                    btnLoading.classList.add('d-none');
                    button.disabled = false;
                }
            }
        });
    </script>
@endpush
