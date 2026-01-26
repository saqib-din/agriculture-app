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
                                <li class="breadcrumb-item"><a href="{{ route('admin.clients.index') }}">Clients</a></li>
                                <li class="breadcrumb-item">{{ $client->name }}</li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">Client Profile</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @include('components.alerts')

            <!-- Client Header Card -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    @if ($client->image)
                                        <img src="{{ asset('storage/' . $client->image) }}" alt="{{ $client->name }}"
                                            class="img-radius" style="width: 80px; height: 80px; object-fit: cover;">
                                    @else
                                        <div class="avtar avtar-xl bg-light-primary">
                                            <i class="ti ti-user f-32"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="col">
                                    <h3 class="mb-1">{{ $client->name }}</h3>
                                    <p class="text-muted mb-2">
                                        @if ($client->company)
                                            <i class="ti ti-building me-1"></i>{{ $client->company }}
                                        @endif
                                    </p>
                                    <div class="d-flex gap-3 flex-wrap">
                                        <span>
                                            <i class="ti ti-mail me-1"></i>{{ $client->email }}
                                        </span>
                                        @if ($client->phone)
                                            <span>
                                                <i class="ti ti-phone me-1"></i>{{ $client->phone }}
                                            </span>
                                        @endif
                                        <span>
                                            @if ($client->status)
                                                <span class="badge bg-light-success">Active</span>
                                            @else
                                                <span class="badge bg-light-danger">Inactive</span>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <a href="{{ route('admin.clients.edit', $client->id) }}"
                                        class="btn btn-outline-primary">
                                        <i class="ti ti-edit me-1"></i> Edit Profile
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabs Navigation -->
            <div class="row">
                <div class="col-12">
                    <ul class="nav nav-tabs profile-tabs mb-3" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#info" role="tab">
                                <i class="ti ti-info-circle me-2"></i>Information
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#orders" role="tab">
                                <i class="ti ti-shopping-cart me-2"></i>Orders
                                <span class="badge bg-primary ms-1">{{ $client->orders->count() }}</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#quotes" role="tab">
                                <i class="ti ti-file-text me-2"></i>Quotations
                                <span class="badge bg-info ms-1">{{ $client->quoteRequests->count() }}</span>
                            </a>
                        </li>
                    </ul>

                    <!-- Tab Content -->
                    <div class="tab-content">
                        <!-- Information Tab -->
                        <div class="tab-pane fade show active" id="info" role="tabpanel">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="mb-4">Client Information</h5>
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <p class="text-muted mb-1">Full Name</p>
                                            <h6>{{ $client->name }}</h6>
                                        </div>
                                        <div class="col-md-6">
                                            <p class="text-muted mb-1">Email</p>
                                            <h6>{{ $client->email }}</h6>
                                        </div>
                                        <div class="col-md-6">
                                            <p class="text-muted mb-1">Phone</p>
                                            <h6>{{ $client->phone ?? 'N/A' }}</h6>
                                        </div>
                                        <div class="col-md-6">
                                            <p class="text-muted mb-1">Company</p>
                                            <h6>{{ $client->company ?? 'N/A' }}</h6>
                                        </div>

                                        <div class="col-md-6">
                                            <p class="text-muted mb-1">City</p>
                                            <h6>{{ $client->city ?? 'N/A' }}</h6>
                                        </div>
                                        <div class="col-md-6">
                                            <p class="text-muted mb-1">State</p>
                                            <h6>{{ $client->state ?? 'N/A' }}</h6>
                                        </div>
                                        <div class="col-md-6">
                                            <p class="text-muted mb-1">Country</p>
                                            <h6>{{ $client->country ?? 'N/A' }}</h6>
                                        </div>
                                        @if ($client->notes)
                                            <div class="col-6">
                                                <p class="text-muted mb-1">Notes</p>
                                                <p>{{ $client->notes }}</p>
                                            </div>
                                        @endif
                                        @if ($client->address)
                                            <div class="col-6">
                                                <p class="text-muted mb-1">Address</p>
                                                <h6>{{ $client->address }}</h6>
                                            </div>
                                        @endif
                                        <div class="col-md-6">
                                            <p class="text-muted mb-1">Created At</p>
                                            <h6>{{ $client->created_at->format('d M, Y h:i A') }}</h6>
                                        </div>
                                        <div class="col-md-6">
                                            <p class="text-muted mb-1">Last Updated</p>
                                            <h6>{{ $client->updated_at->format('d M, Y h:i A') }}</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Orders Tab -->
                        <div class="tab-pane fade" id="orders" role="tabpanel">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0">Orders</h5>
                                    <a href="{{ route('admin.orders.create', ['client_id' => $client->id]) }}"
                                        class="btn btn-primary btn-sm">
                                        <i class="ti ti-plus me-1"></i> New Order
                                    </a>
                                </div>
                                <div class="card-body">
                                    @if ($client->orders->count() > 0)
                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Order #</th>
                                                        <th>Products</th>
                                                        <th>Status</th>
                                                        <th class="text-end">Date</th>
                                                        <th class="text-end">Total Amount</th>
                                                        <th class="text-end">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($client->orders as $order)
                                                        <tr>
                                                            <td>
                                                                <strong>{{ $order->order_number }}</strong>
                                                            </td>
                                                            <td>
                                                                <span class="badge bg-light-info">
                                                                    {{ $order->products->count() }} Items
                                                                </span>
                                                            </td>

                                                            <td>
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
                                                            </td>
                                                            <td class="text-end">
                                                                <small>{{ $order->created_at->format('d M, Y') }}</small>
                                                            </td>
                                                            <td class="text-end">
                                                                <strong>PKR {{ number_format($order->total, 2) }}</strong>
                                                            </td>
                                                            <td class="text-end">
                                                                <a href="{{ route('admin.orders.show', $order->id) }}"
                                                                    class="avtar avtar-xs btn-link-secondary">
                                                                    <i class="ti ti-eye f-20"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    @else
                                        <div class="text-center py-5">
                                            <div class="avtar avtar-xl bg-light-secondary mx-auto mb-3">
                                                <i class="ti ti-shopping-cart-off f-32"></i>
                                            </div>
                                            <h6 class="text-muted">No orders yet</h6>
                                            <p class="text-muted">Create a new order for this client</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Quotations Tab -->
                        <div class="tab-pane fade" id="quotes" role="tabpanel">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">Quote Requests</h5>
                                </div>
                                <div class="card-body">
                                    @if ($client->quoteRequests->count() > 0)
                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Quote #</th>
                                                        <th>Products</th>
                                                        {{-- <th>Status</th> --}}
                                                        <th>Quote Status</th>
                                                        <th>Date</th>
                                                        <th class="text-end">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($client->quoteRequests as $quote)
                                                        <tr>
                                                            <td>
                                                                <strong>#{{ $quote->id }}</strong>
                                                            </td>
                                                            <td>
                                                                <span class="badge bg-light-info">
                                                                    {{ $quote->products->count() }} Items
                                                                </span>
                                                            </td>
                                                            {{-- <td>
                                                                @php
                                                                    $statusColors = [
                                                                        'pending' => 'warning',
                                                                        'processing' => 'primary',
                                                                        'completed' => 'success',
                                                                        'cancelled' => 'danger',
                                                                    ];
                                                                @endphp
                                                                <span
                                                                    class="badge bg-light-{{ $statusColors[$quote->status] ?? 'secondary' }}">
                                                                    {{ ucfirst($quote->status) }}
                                                                </span>
                                                            </td> --}}
                                                            <td>
                                                                @php
                                                                    $quoteStatusColors = [
                                                                        'pending' => 'warning',
                                                                        'converted' => 'success',
                                                                        'rejected' => 'danger',
                                                                        'reopened' => 'info',
                                                                    ];
                                                                @endphp
                                                                <span
                                                                    class="badge bg-light-{{ $quoteStatusColors[$quote->quote_status] ?? 'secondary' }}">
                                                                    {{ ucfirst($quote->quote_status) }}
                                                                </span>
                                                            </td>
                                                            <td>
                                                                <small>{{ $quote->created_at->format('d M, Y') }}</small>
                                                            </td>
                                                            <td class="text-end">
                                                                <a href="{{ route('admin.quotes.show', $quote->id) }}"
                                                                    class="avtar avtar-xs btn-link-secondary">
                                                                    <i class="ti ti-eye f-20"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    @else
                                        <div class="text-center py-5">
                                            <div class="avtar avtar-xl bg-light-secondary mx-auto mb-3">
                                                <i class="ti ti-file-text-off f-32"></i>
                                            </div>
                                            <h6 class="text-muted">No quotations yet</h6>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
