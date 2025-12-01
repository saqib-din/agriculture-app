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
                                <li class="breadcrumb-item" aria-current="page">Add</li>
                            </ul>
                        </div>

                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">Add Partner</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @include('components.alerts')

            <!-- Add Form -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Partner Information</h5>
                        </div>

                        <div class="card-body">
                            <form action="{{ route('partners.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="row">

                                    <!-- Name -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Name</label>
                                            <input type="text" name="name" class="form-control"
                                                placeholder="Enter partner name" value="{{ old('name') }}">
                                            @error('name')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Image -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Image <span class="text-danger">*</span></label>
                                            <input type="file" name="image" class="form-control" required>
                                            @error('image')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Status -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Status <span class="text-danger">*</span></label>
                                            <select name="status" class="form-select" required>
                                                <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Active
                                                </option>
                                                <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactive
                                                </option>
                                            </select>
                                            @error('status')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Submit -->
                                    <div class="col-md-12 text-end">
                                        <button class="btn btn-primary">Submit</button>
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
