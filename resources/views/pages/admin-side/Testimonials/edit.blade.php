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
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Testimonials</a></li>
                                <li class="breadcrumb-item" aria-current="page">Edit</li>
                            </ul>
                        </div>

                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">Edit Testimonial</h2>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Edit Form -->
            <div class="row">
                <div class="col-12">

                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Basic Information</h5>
                        </div>

                        <div class="card-body">

                            <form action="{{ route('testimonials.update', $testimonial->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf

                                {{-- @method('PUT') --}}

                                <div class="row">

                                    <!-- Name -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Name <span class="text-danger">*</span></label>
                                            <input type="text" name="name" class="form-control" placeholder="Enter name"
                                                value="{{ $testimonial->name }}" required>
                                        </div>
                                    </div>

                                    <!-- Designation -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Designation</label>
                                            <input type="text" name="design" class="form-control" placeholder="Enter designation"
                                                value="{{ $testimonial->design }}">
                                        </div>
                                    </div>

                                    <!-- Company -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Company</label>
                                            <input type="text" name="company" class="form-control" placeholder="Enter company"
                                                value="{{ $testimonial->company }}">
                                        </div>
                                    </div>

                                    <!-- Rating -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Rating (1–5) <span
                                                    class="text-danger">*</span></label>
                                            <input type="number" name="rating" min="1" max="5" placeholder="Enter rating"
                                                value="{{ $testimonial->rating }}" class="form-control" required>
                                        </div>
                                    </div>

                                    <!-- Status -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Status</label>
                                            <select name="status" class="form-select" required>
                                                <option value="1" {{ $testimonial->status ? 'selected' : '' }}>Active
                                                </option>
                                                <option value="0" {{ !$testimonial->status ? 'selected' : '' }}>
                                                    Inactive</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Current Image -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Current Image</label><br>

                                            @if ($testimonial->image)
                                                <img src="{{ asset('storage/' . $testimonial->image) }}" width="80"
                                                    class="rounded mb-2">
                                            @endif

                                            <input type="file" name="image" class="form-control">
                                        </div>
                                    </div>

                                    <!-- Review -->
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Review <span class="text-danger">*</span></label>
                                            <textarea name="review" class="form-control" placeholder="Enter review" rows="3" required>{{ $testimonial->review }}</textarea>
                                        </div>
                                    </div>

                                    <!-- Submit -->
                                    <div class="col-md-12 text-end">
                                        <button class="btn btn-primary">Update</button>
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
