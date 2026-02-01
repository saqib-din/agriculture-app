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

            @include('components.alerts')

            <!-- Main Content -->
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
                                            <th>Status</th>
                                            <th>Date</th>
                                            <th class="text-end">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($quoteRequests as $quote)
                                            <tr>
                                                <td>{{ $quote->id }}</td>

                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="avtar avtar-s bg-light-primary me-2">
                                                            <i class="ti ti-user f-20"></i>
                                                        </div>
                                                        <div>
                                                            <h6 class="mb-0">{{ $quote->customer_name }}</h6>
                                                            <small class="text-muted">{{ $quote->customer_email }}</small>
                                                        </div>
                                                    </div>
                                                </td>

                                                <td>
                                                    @if ($quote->customer_phone)
                                                        {{ $quote->customer_phone }}
                                                    @else
                                                        <span class="text-muted">N/A</span>
                                                    @endif
                                                </td>

                                                <td>
                                                    <span class="badge bg-light-info">
                                                        <i class="ti ti-package me-1"></i>{{ $quote->products->count() }}
                                                        Products
                                                    </span>
                                                    @if ($quote->total_quantity)
                                                        <br><small class="text-muted">Qty:
                                                            {{ $quote->total_quantity }}</small>
                                                    @endif
                                                </td>

                                                <!-- Status Badge -->
                                                <td>
                                                    @switch($quote->quote_status)
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
                                                                class="badge bg-light-secondary">{{ ucfirst($quote->quote_status) }}</span>
                                                    @endswitch
                                                </td>

                                                <td>
                                                    <small>{{ $quote->created_at->format('d M, Y') }}</small><br>
                                                    <small
                                                        class="text-muted">{{ $quote->created_at->format('h:i A') }}</small>
                                                </td>

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
                                                    <td colspan="7" class="text-center">
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
                                    <div class="mt-3">{{ $quoteRequests->links() }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            window.dt = new simpleDatatables.DataTable('#pc-dt-simple', {
                sortable: true,
                searchable: true,
                fixedHeight: true
            });
        });
    </script>
