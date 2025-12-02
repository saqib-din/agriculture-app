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
                                <li class="breadcrumb-item"><a href="{{ route('partners.index') }}">Partners</a></li>
                                <li class="breadcrumb-item" aria-current="page">Edit</li>
                            </ul>
                        </div>

                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">Edit Partner</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @include('components.alerts')

            <!-- Edit Form -->
            <div class="row">
                <div class="col-12">

                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Update Partner Information</h5>
                        </div>

                        <div class="card-body">

                            <form action="{{ route('partners.update', $partner->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('POST') <!-- POST method for update route -->

                                <div class="row">

                                    <!-- Name -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Name</label>
                                            <input type="text" name="name" class="form-control"
                                                value="{{ old('name', $partner->name) }}">
                                            @error('name')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Image -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Image</label>
                                            <input type="file" name="image" class="form-control">
                                            @error('image')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                            <br>
                                            <img src="{{ asset('storage/' . $partner->image) }}" width="80"
                                                alt="Partner Image">
                                        </div>
                                    </div>

                                    <!-- Status -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Status <span class="text-danger">*</span></label>
                                            <select name="status" class="form-select" required>
                                                <option value="1" {{ $partner->status == 1 ? 'selected' : '' }}>Active
                                                </option>
                                                <option value="0" {{ $partner->status == 0 ? 'selected' : '' }}>
                                                    Inactive</option>
                                            </select>
                                            @error('status')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Submit -->
                                    <div class="col-md-12 text-end">
                                        <button class="btn btn-primary">Update Partner</button>
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
