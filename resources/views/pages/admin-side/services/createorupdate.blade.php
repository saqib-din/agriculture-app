@extends('layouts.admin')

@section('content')
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
                                <li class="breadcrumb-item">{{ $service ? 'Edit' : 'Add' }}</li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">{{ $service ? 'Edit Service' : 'Add Service' }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ breadcrumb ] end -->

            @include('components.alerts')

            <!-- [ Main Content ] start -->
            <div class="row">
                <div class="col-12">

                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Service Information</h5>
                        </div>

                        <div class="card-body">

                            <form action="{{ route('services.save', $service->id ?? null) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="row">

                                    <!-- Service Name -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Service Name <span class="text-danger">*</span></label>
                                            <input type="text" name="service_name" class="form-control"
                                                placeholder="Enter service name"
                                                value="{{ old('service_name', $service->service_name ?? '') }}" required>
                                        </div>
                                    </div>

                                    <!-- Description -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Description</label>
                                            <input type="text" name="description" class="form-control"
                                                placeholder="Enter description"
                                                value="{{ old('description', $service->description ?? '') }}">
                                        </div>
                                    </div>

                                    <!-- Main Service -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Main Service</label>
                                            <select name="main_service" class="form-select">
                                                <option value="0"
                                                    {{ old('main_service', $service->main_service ?? 0) == 0 ? 'selected' : '' }}>
                                                    No</option>
                                                <option value="1"
                                                    {{ old('main_service', $service->main_service ?? 0) == 1 ? 'selected' : '' }}>
                                                    Yes</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Featured Service -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Featured Service</label>
                                            <select name="featured_service" class="form-select">
                                                <option value="0"
                                                    {{ old('featured_service', $service->featured_service ?? 0) == 0 ? 'selected' : '' }}>
                                                    No</option>
                                                <option value="1"
                                                    {{ old('featured_service', $service->featured_service ?? 0) == 1 ? 'selected' : '' }}>
                                                    Yes</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Status -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Status <span class="text-danger">*</span></label>
                                            <select name="status" class="form-select">
                                                <option value="Active"
                                                    {{ old('status', $service->status ?? '') == 'Active' ? 'selected' : '' }}>
                                                    Active</option>
                                                <option value="Inactive"
                                                    {{ old('status', $service->status ?? '') == 'Inactive' ? 'selected' : '' }}>
                                                    Inactive</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Image -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Service Image</label>
                                            <input class="form-control" type="file" name="image">
                                        </div>

                                    </div>

                                    <!-- Submit -->
                                    <div class="col-md-12 text-end">
                                        <button class="btn btn-primary">
                                            {{ $service ? 'Update' : 'Submit' }}
                                        </button>
                                    </div>

                                </div>
                            </form>

                        </div>
                    </div>

                </div>
            </div>
            <!-- [ Main Content ] end -->

        </div>
    </div>
@endsection
