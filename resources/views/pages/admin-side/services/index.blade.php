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
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Services</a></li>
                                <li class="breadcrumb-item" aria-current="page">List</li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">Services List</h2>
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
                                <h5 class="mb-3 mb-sm-0">Services List</h5>
                                <div>
                                    <a href="{{ route('services.add') }}" class="btn btn-primary">Add Service</a>
                                </div>
                            </div>
                        </div>

                        <div class="card-body table-card">
                            <div class="table-responsive">
                                <table class="table table-hover" id="pc-dt-simple">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Service Name</th>
                                            <th>Description</th>
                                            <th>Main Service</th>
                                            <th>Featured</th>
                                            <th>Status</th>
                                            <th class="text-end">Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($services as $service)
                                            <tr>
                                                <!-- NAME -->
                                                <td>
                                                    <h6 class="mb-0">{{ $service->id }}</h6>
                                                </td>
                                                <!-- IMAGE -->
                                                <td>
                                                    <div class="row">
                                                        <div class="col-auto pe-0">
                                                            @if ($service->image)
                                                                <img src="{{ asset('uploads/services/' . $service->image) }}"
                                                                    alt="service image" style="width: 40px; height: 40px;"
                                                                    class="img-radius wid-40">
                                                            @else
                                                                <img src="{{ asset('admin/assets/images/user/sms.png') }}"
                                                                    alt="img" class="img-radius wid-40"
                                                                    style="width: 40px; height: 40px;">
                                                            @endif
                                                        </div>
                                                        <div class="col justify-content-center">
                                                            <h6 class="mb-0">{{ $service->service_name }}</h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    @php
                                                        $words = explode(' ', $service->description ?? '');
                                                        $chunks = array_chunk($words, 5); // Split into arrays of 5 words each
                                                    @endphp

                                                    @foreach ($chunks as $chunk)
                                                        {{ implode(' ', $chunk) }}<br>
                                                    @endforeach
                                                </td>

                                                <!-- MAIN SERVICE -->
                                                <td>
                                                    @if ($service->main_service == 1)
                                                        <span class="badge bg-light-warning">Yes</span>
                                                    @else
                                                        <span class="badge bg-secondary">No</span>
                                                    @endif
                                                </td>

                                                <!-- FEATURED -->
                                                <td>
                                                    @if ($service->featured_service == 1)
                                                        <span class="badge bg-light-info">Featured</span>
                                                    @else
                                                        <span class="badge bg-secondary">No</span>
                                                    @endif
                                                </td>

                                                <!-- STATUS -->
                                                <td>
                                                    @if ($service->status == 'Active')
                                                        <span class="badge bg-light-success">Active</span>
                                                    @else
                                                        <span class="badge bg-light-danger">Inactive</span>
                                                    @endif
                                                </td>

                                                <!-- ACTION -->
                                                <td class="text-end">
                                                    <a href="{{ route('services.edit', $service->id) }}"
                                                        class="avtar avtar-xs btn-link-secondary" data-bs-toggle="tooltip"
                                                        title="Edit">
                                                        <i class="ti ti-edit f-20"></i>
                                                    </a>
                                                    <a href="#" class="avtar avtar-xs btn-link-danger bs-pass-para"
                                                        data-id="{{ $service->id }}" data-bs-toggle="tooltip"
                                                        title="Delete">
                                                        <i class="ti ti-trash f-20"></i>
                                                    </a>
                                                    <form id="delete-form-{{ $service->id }}"
                                                        action="{{ route('services.delete', $service->id) }}"
                                                        method="POST" style="display: none;">
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
            <!-- [ Main Content ] end -->
        </div>
    </div>
    <!-- [ Main Content ] end -->
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
