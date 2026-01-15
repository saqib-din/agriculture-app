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
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Quotes</a></li>
                                <li class="breadcrumb-item" aria-current="page">List</li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">Quote Requests</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ breadcrumb ] end -->

            @include('components.alerts')

            <!-- [ Main Content ] start -->
            <div class="row">
                <div class="col-sm-12">

                    <div class="card">
                        <div class="card-header">
                            <div class="d-sm-flex align-items-center justify-content-between">
                                <h5 class="mb-3 mb-sm-0">Quote Requests List</h5>
                                <div>
                                    <span class="badge bg-light-primary">Total: {{ $quoteRequests->total() }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="card-body table-card">
                            <div class="table-responsive">
                                <table class="table table-hover" id="pc-dt-simple">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Customer Info</th>
                                            <th>Contact</th>
                                            <th>Products</th>
                                            {{-- <th>Message</th> --}}
                                            <th>Status</th>
                                            <th>Date</th>
                                            <th class="text-end">Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @forelse ($quoteRequests as $quote)
                                            <tr>
                                                <!-- ID -->
                                                <td>
                                                    <h6 class="mb-0">{{ $quote->id }}</h6>
                                                </td>

                                                <!-- CUSTOMER INFO -->
                                                <td>
                                                    <div class="row">
                                                        <div class="col-auto pe-0">
                                                            <div class="avtar avtar-s bg-light-primary">
                                                                <i class="ti ti-user f-20"></i>
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <h6 class="mb-0">{{ $quote->customer_name }}</h6>
                                                            <small class="text-muted">{{ $quote->customer_email }}</small>
                                                        </div>
                                                    </div>
                                                </td>

                                                <!-- CONTACT -->
                                                <td>
                                                    {{-- <i class="ti ti-phone me-1"></i> --}}
                                                    @if ($quote->customer_phone)
                                                        {{ $quote->customer_phone }}
                                                    @else
                                                        <span class="text-muted">N/A</span>
                                                    @endif
                                                </td>

                                                <!-- PRODUCTS -->
                                                <td>
                                                    <span class="badge bg-light-info">
                                                        <i class="ti ti-package me-1"></i>{{ $quote->products->count() }}
                                                        Products
                                                    </span>
                                                    @if ($quote->total_quantity)
                                                        <br>
                                                        <small class="text-muted">Qty: {{ $quote->total_quantity }}</small>
                                                    @endif
                                                </td>

                                                {{-- <!-- MESSAGE -->
                                                <td>
                                                    @if ($quote->customer_message)
                                                        @php
                                                            $words = explode(' ', $quote->customer_message);
                                                            $chunks = array_chunk($words, 5);
                                                        @endphp
                                                        @foreach (array_slice($chunks, 0, 2) as $chunk)
                                                            {{ implode(' ', $chunk) }}<br>
                                                        @endforeach
                                                        @if (count($chunks) > 2)
                                                            <small class="text-muted">...</small>
                                                        @endif
                                                    @else
                                                        <span class="text-muted">No message</span>
                                                    @endif
                                                </td> --}}

                                                <!-- STATUS -->
                                                <td>
                                                    <select class="form-select form-select-sm status-select fw-semibold"
                                                        data-id="{{ $quote->id }}"
                                                        style="width:130px; border-radius:20px;">
                                                        <option value="pending" class="text-warning"
                                                            {{ $quote->status == 'pending' ? 'selected' : '' }}>
                                                            Pending
                                                        </option>
                                                        <option value="processing" class="text-primary"
                                                            {{ $quote->status == 'processing' ? 'selected' : '' }}>
                                                            Processing
                                                        </option>
                                                        <option value="completed" class="text-success"
                                                            {{ $quote->status == 'completed' ? 'selected' : '' }}>
                                                            Completed
                                                        </option>
                                                        <option value="cancelled" class="text-danger"
                                                            {{ $quote->status == 'cancelled' ? 'selected' : '' }}>
                                                            Cancelled
                                                        </option>
                                                    </select>
                                                </td>


                                                <!-- DATE -->
                                                <td>
                                                    <small>{{ $quote->created_at->format('d M, Y') }}</small>
                                                    <br>
                                                    <small
                                                        class="text-muted">{{ $quote->created_at->format('h:i A') }}</small>
                                                </td>

                                                <!-- ACTION -->
                                                <td class="text-end">
                                                    <a href="{{ route('admin.quotes.show', $quote->id) }}"
                                                        class="avtar avtar-xs btn-link-secondary" title="View Details">
                                                        <i class="ti ti-eye f-20"></i>
                                                    </a>

                                                    <a href="#" class="avtar avtar-xs btn-link-secondary bs-pass-para"
                                                        data-id="{{ $quote->id }}" title="Delete">
                                                        <i class="ti ti-trash f-20"></i>
                                                    </a>

                                                    <form id="delete-form-{{ $quote->id }}"
                                                        action="{{ route('admin.quotes.destroy', $quote->id) }}"
                                                        method="POST" style="display: none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8" class="text-center">
                                                    <div class="py-4">
                                                        <i class="ti ti-inbox f-40 text-muted"></i>
                                                        <p class="text-muted mt-2">No quote requests found</p>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>

                                </table>
                            </div>

                            <!-- Pagination -->
                            @if ($quoteRequests->hasPages())
                                <div class="mt-3">
                                    {{ $quoteRequests->links() }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </div>
    <!-- [ Main Content ] end -->

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            document.querySelectorAll('.status-select').forEach(select => {
                select.addEventListener('change', function() {

                    const quoteId = this.dataset.id;
                    const status = this.value;

                    fetch("{{ route('admin.quotes.updateStatus') }}", {
                            method: "POST",
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector(
                                    'meta[name="csrf-token"]').content
                            },
                            body: JSON.stringify({
                                id: quoteId,
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
                                    timer: 1200,
                                    showConfirmButton: false
                                });
                            }
                        })
                        .catch(() => {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Failed to update status'
                            });
                        });
                });
            });

        });
    </script>


    <script>
        document.querySelectorAll('.status-select').forEach(select => {
            select.addEventListener('change', function() {
                this.classList.remove('text-warning', 'text-primary', 'text-success', 'text-danger');

                if (this.value === 'pending') this.classList.add('text-warning');
                if (this.value === 'processing') this.classList.add('text-primary');
                if (this.value === 'completed') this.classList.add('text-success');
                if (this.value === 'cancelled') this.classList.add('text-danger');
            });
        });
    </script>
@endsection
