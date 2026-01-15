@extends('layouts.admin')

@section('content')
    <div class="pc-container">
        <div class="pc-content">

            {{-- Page Header --}}
            <div class="page-header">
                <div class="page-header-title">
                    <h2 class="mb-0">Edit Order</h2>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-body">
                            <form action="{{ route('orders.update', $order->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="row">

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Client *</label>
                                        <select name="client_id" class="form-select" required>
                                            @foreach ($clients as $client)
                                                <option value="{{ $client->id }}"
                                                    {{ $order->client_id == $client->id ? 'selected' : '' }}>
                                                    {{ $client->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Order Date *</label>
                                        <input type="date" name="order_date" value="{{ $order->order_date }}"
                                            class="form-control" required>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Total Amount *</label>
                                        <input type="number" name="total_amount" value="{{ $order->total_amount }}"
                                            class="form-control" required>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Status</label>
                                        <select name="status" class="form-select">
                                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>
                                                Pending</option>
                                            <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>
                                                Completed</option>
                                            <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>
                                                Cancelled</option>
                                        </select>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Notes</label>
                                        <textarea name="notes" rows="3" class="form-control">{{ $order->notes }}</textarea>
                                    </div>

                                    <div class="col-md-12 text-end">
                                        <button class="btn btn-primary">
                                            Update Order
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
