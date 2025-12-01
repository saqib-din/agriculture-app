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
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Partners</a></li>
                                <li class="breadcrumb-item" aria-current="page">List</li>
                            </ul>
                        </div>

                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">Partners List</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @include('components.alerts')

            <!-- Table -->
            <div class="row">
                <div class="col-sm-12">

                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Partners List</h5>
                            <a href="{{ route('partners.create') }}" class="btn btn-primary">Add Partner</a>
                        </div>

                        <div class="card-body table-card">
                            <div class="table-responsive">
                                <table class="table table-hover" id="pc-dt-simple">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Image</th>
                                            <th>Name</th>
                                            <th>Status</th>
                                            <th class="text-end">Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($partners as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>

                                                <td>
                                                    @if ($item->image)
                                                        <img src="{{ asset('storage/' . $item->image) }}" width="60"
                                                            class="rounded">
                                                    @else
                                                        No Image
                                                    @endif
                                                </td>

                                                <td>{{ $item->name ?? '-' }}</td>

                                                <td>
                                                    @if ($item->status == 1)
                                                        <span class="badge bg-success">Active</span>
                                                    @else
                                                        <span class="badge bg-danger">Inactive</span>
                                                    @endif
                                                </td>

                                                <td class="text-end">
                                                    <a href="{{ route('partners.edit', $item->id) }}"
                                                        class="avtar avtar-xs btn-link-secondary">
                                                        <i class="ti ti-edit f-20"></i>
                                                    </a>

                                                    <a href="#" class="avtar avtar-xs btn-link-secondary bs-pass-para"
                                                        data-id="{{ $item->id }}" title="Delete">
                                                        <i class="ti ti-trash f-20"></i>
                                                    </a>

                                                    <!-- Hidden delete form -->
                                                    <form id="delete-form-{{ $item->id }}"
                                                        action="{{ route('partners.destroy', $item->id) }}" method="POST"
                                                        style="display: none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
