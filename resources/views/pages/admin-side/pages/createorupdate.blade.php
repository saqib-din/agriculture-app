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
                                            <textarea name="content" id="content-editor" class="form-control">{{ old('content', $page->content ?? '') }}</textarea>
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
                                            <label class="form-label">Display In Footer <span
                                                    class="text-danger">*</span></label>
                                            <select name="display_in_footer" class="form-select" required>
                                                <option value="1"
                                                    {{ old('display_in_footer', $page->display_in_footer ?? 0) == 1 ? 'selected' : '' }}>
                                                    Yes</option>
                                                <option value="0"
                                                    {{ old('display_in_footer', $page->display_in_footer ?? 0) == 0 ? 'selected' : '' }}>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.tiny.cloud/1/3qaqbgyxgk401lk8tn5xj7qotutnfngz5o9vmds2n6b6s9yz/tinymce/6/tinymce.min.js">
    </script>
    <script>
        document.getElementById('page-name').addEventListener('input', function() {
            let name = this.value;
            let slug = name.toLowerCase()
                .replace(/[^a-z0-9\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-');

            document.getElementById('page-slug').value = slug;
        });

        tinymce.init({
            selector: '#content-editor',
            height: 300,
            menubar: false,

            plugins: [
                'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
                'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
                'insertdatetime', 'media', 'table', 'help', 'wordcount'
            ],

            toolbar: 'undo redo | blocks | bold italic forecolor backcolor | ' +
                'alignleft aligncenter alignright alignjustify | ' +
                'bullist numlist outdent indent | removeformat | help',

            content_style: 'body { font-family: -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif; font-size: 14px; }'
        });
    </script>
@endpush
