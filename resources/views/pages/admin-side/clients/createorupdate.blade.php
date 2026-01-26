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
                                <li class="breadcrumb-item"><a href="{{ route('index') }}">Clients</a></li>
                                <li class="breadcrumb-item">{{ isset($client) ? 'Edit' : 'Create' }}</li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">{{ isset($client) ? 'Edit' : 'Add' }} Client</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @include('components.alerts')

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form
                                action="{{ isset($client) ? route('admin.clients.update', $client->id) : route('admin.clients.store') }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                @if (isset($client))
                                    @method('PUT')
                                @endif

                                <div class="row g-3">
                                    <!-- Basic Information -->
                                    <div class="col-12">
                                        <h5 class="mb-3">Basic Information</h5>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Full Name <span class="text-danger">*</span></label>
                                        <input type="text" name="name" class="form-control"
                                            value="{{ old('name', $client->name ?? '') }}" placeholder="Enter a full name" required>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Email <span class="text-danger">*</span></label>
                                        <input type="email" name="email" class="form-control"
                                            value="{{ old('email', $client->email ?? '') }}" placeholder="Enter a email" required>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Phone</label>
                                        <input type="text" name="phone" class="form-control"
                                            value="{{ old('phone', $client->phone ?? '') }}" placeholder="Enter a phone">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Company</label>
                                        <input type="text" name="company" class="form-control"
                                            value="{{ old('company', $client->company ?? '') }}" placeholder="Enter a company">
                                    </div>



                                    <div class="col-md-6">
                                        <label class="form-label">City</label>
                                        <input type="text" name="city" class="form-control"
                                            value="{{ old('city', $client->city ?? '') }}" placeholder="Enter a city">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">State/Province</label>
                                        <input type="text" name="state" class="form-control"
                                            value="{{ old('state', $client->state ?? '') }}" placeholder="Enter a state/province">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">ZIP/Postal Code</label>
                                        <input type="text" name="zip" class="form-control"
                                            value="{{ old('zip', $client->zip ?? '') }}" placeholder="Enter a zip/postal code">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Country</label>
                                        <input type="text" name="country" class="form-control"
                                            value="{{ old('country', $client->country ?? '') }}" placeholder="Enter a country">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Profile Image</label>
                                        <input type="file" name="image" class="form-control" accept="image/*">
                                        @if (isset($client) && $client->image)
                                            <img src="{{ asset('storage/' . $client->image) }}" alt="Current Image"
                                                class="mt-2 img-thumbnail" style="max-width: 150px;">
                                        @endif
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Status</label>
                                        <select name="status" class="form-select">
                                            <option value="1"
                                                {{ old('status', $client->status ?? 1) == 1 ? 'selected' : '' }}>Active
                                            </option>
                                            <option value="0"
                                                {{ old('status', $client->status ?? 1) == 0 ? 'selected' : '' }}>Inactive
                                            </option>
                                        </select>
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label">Address</label>
                                        <textarea name="address" class="form-control" rows="2" placeholder="Enter a address">{{ old('address', $client->address ?? '') }}</textarea>
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label">Notes</label>
                                        <textarea name="notes" class="form-control" rows="3" placeholder="Enter a notes">{{ old('notes', $client->notes ?? '') }}</textarea>
                                    </div>

                                    <!-- Submit Buttons -->
                                    <div class="col-12">
                                        <div class="d-flex justify-content-end gap-2 mt-3">
                                            <a href="{{ route('admin.clients.index') }}"
                                                class="btn btn-outline-secondary">
                                                 Cancel
                                            </a>
                                            <button type="submit" class="btn btn-primary">
                                                {{ isset($client) ? 'Update' : 'Create' }}
                                            </button>
                                        </div>
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
