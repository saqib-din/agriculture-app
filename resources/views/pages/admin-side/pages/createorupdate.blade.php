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
                                <li class="breadcrumb-item">Pages</li>
                                <li class="breadcrumb-item">{{ $page ? 'Edit' : 'Add' }}</li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">{{ $page ? 'Edit Page' : 'Add Page' }}</h2>
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
                            <form action="{{ $page ? route('pages.save', $page->id) : route('pages.save') }}"
                                method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Name<span class="text-danger">*</span></label>
                                            <input type="text" name="name" id="page-name" class="form-control"
                                                placeholder="Enter name" value="{{ old('name', $page->name ?? '') }}"
                                                required>
                                            @error('name')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Slug<span class="text-danger">*</span></label>
                                            <input type="text" name="slug" id="page-slug" class="form-control"
                                                placeholder="Auto-generated from name"
                                                value="{{ old('slug', $page->slug ?? '') }}" required>
                                            @error('slug')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Content <span class="text-danger">*</span></label>
                                            <textarea name="content" class="form-control" rows="5" placeholder="Enter content" required>{{ old('content', $page->content ?? '') }}</textarea>
                                            @error('content')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Status <span class="text-danger">*</span></label>
                                            <select name="status" class="form-select" required>
                                                <option value="Active"
                                                    {{ old('status', $page->status ?? '') == 'Active' ? 'selected' : '' }}>
                                                    Active</option>
                                                <option value="Inactive"
                                                    {{ old('status', $page->status ?? '') == 'Inactive' ? 'selected' : '' }}>
                                                    Inactive</option>
                                            </select>
                                            @error('status')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Display In Footer</label>
                                            <select name="display_in_footer" class="form-select" required>
                                                <option value="yes"
                                                    {{ old('display_in_footer', $page->display_in_footer ?? '') == 'yes' ? 'selected' : '' }}>
                                                    Yes</option>
                                                <option value="no"
                                                    {{ old('display_in_footer', $page->display_in_footer ?? '') == 'no' ? 'selected' : '' }}>
                                                    No</option>
                                            </select>
                                            @error('display_in_footer')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12 text-end">
                                        <button type="submit"
                                            class="btn btn-primary">{{ $page ? 'Update' : 'Submit' }}</button>
                                    </div>
                                </div>
                            </form>

                            @push('scripts')
                                <script>
                                    // Auto-generate slug from name
                                    document.getElementById('page-name').addEventListener('input', function() {
                                        let name = this.value;
                                        let slug = name.toLowerCase()
                                            .replace(/[^a-z0-9\s-]/g, '') // Remove special characters
                                            .replace(/\s+/g, '-') // Replace spaces with hyphens
                                            .replace(/-+/g, '-'); // Replace multiple hyphens with single

                                        document.getElementById('page-slug').value = slug;
                                    });
                                </script>
                            @endpush
                         
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
