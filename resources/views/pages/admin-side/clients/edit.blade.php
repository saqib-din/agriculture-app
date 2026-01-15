@extends('layouts.admin')

@section('content')
    <div class="pc-container">
        <div class="pc-content">

            <div class="page-header">
                <div class="page-header-title">
                    <h2 class="mb-0">Edit Client</h2>
                </div>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card">
                <div class="card-body">
                    <form action="{{ route('clients.update', $client->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">

                            {{-- EXISTING FIELDS --}}
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Name *</label>
                                <input type="text" name="name" class="form-control"
                                    value="{{ old('name', $client->name) }}" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control"
                                    value="{{ old('email', $client->email) }}">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Phone</label>
                                <input type="text" name="phone" class="form-control"
                                    value="{{ old('phone', $client->phone) }}">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Company</label>
                                <input type="text" name="company" class="form-control"
                                    value="{{ old('company', $client->company) }}">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Status *</label>
                                <select name="status" class="form-select">
                                    <option value="1" {{ $client->status == 1 ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ $client->status == 0 ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>

                            {{-- NEW FIELDS --}}
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Street</label>
                                <input type="text" name="street" class="form-control"
                                    value="{{ old('street', $client->street) }}">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">City</label>
                                <input type="text" name="city" class="form-control"
                                    value="{{ old('city', $client->city) }}">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">State</label>
                                <input type="text" name="state" class="form-control"
                                    value="{{ old('state', $client->state) }}">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Country</label>
                                <input type="text" name="country" class="form-control"
                                    value="{{ old('country', $client->country) }}">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Zip Code</label>
                                <input type="text" name="zip_code" class="form-control"
                                    value="{{ old('zip_code', $client->zip_code) }}">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">NTN / GST</label>
                                <input type="text" name="ntn_gst" class="form-control"
                                    value="{{ old('ntn_gst', $client->ntn_gst) }}">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Image</label>
                                <input type="file" name="image" class="form-control">
                                @if ($client->image)
                                    <img src="{{ asset($client->image) }}" width="60" class="mt-2">
                                @endif
                            </div>

                            <div class="col-md-12 text-end">
                                <button class="btn btn-primary">Update Client</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
