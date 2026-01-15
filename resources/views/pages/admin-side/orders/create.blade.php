@extends('layouts.admin')

@section('content')
    <div class="pc-container">
        <div class="pc-content">

            {{-- Page Header --}}
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('dashboard') }}">Home</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{{ route('orders.index') }}">Orders</a>
                                </li>
                                <li class="breadcrumb-item active">Add</li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">Add Order</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Form --}}
            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-header">
                            <h5 class="mb-0">Order Information</h5>
                        </div>

                        <div class="card-body">
                            <form action="{{ route('orders.store') }}" method="POST">
                                @csrf

                                <div class="row">

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Client *</label>
                                        <select name="client_id" class="form-select" required>
                                            <option value="">Select Client</option>
                                            @foreach ($clients as $client)
                                                <option value="{{ $client->id }}">
                                                    {{ $client->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Order Date *</label>
                                        <input type="date" name="order_date" class="form-control" required>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Total Amount *</label>
                                        <input type="number" name="total_amount" class="form-control" required>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Status</label>
                                        <select name="status" class="form-select">
                                            <option value="pending" selected>Pending</option>
                                            <option value="completed">Completed</option>
                                            <option value="cancelled">Cancelled</option>
                                        </select>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Notes</label>
                                        <textarea name="notes" rows="3" class="form-control"></textarea>
                                    </div>

                                    <div class="col-md-12 text-end">
                                        <button class="btn btn-primary">
                                            <i class="ti ti-device-floppy"></i> Save Order
                                        </button>
                                        <a href="{{ route('orders.index') }}" class="btn btn-secondary">
                                            Back
                                        </a>
                                    </div>

                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
