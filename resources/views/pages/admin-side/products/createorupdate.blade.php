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
                                <li class="breadcrumb-item"><a href="{{ route('products.list') }}">Products</a></li>
                                <li class="breadcrumb-item" aria-current="page">
                                    {{ isset($product) ? 'Edit' : 'Add' }}
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">{{ isset($product) ? 'Edit Product' : 'Add Product' }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @include('components.alerts')

            {{-- Display Validation Errors --}}
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Please fix the following errors:</strong>
                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- Main Content -->
            <div class="row">
                <div class="col-12">
                    <form action="{{ route('admin.products.storeUpdate', $product->id ?? null) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="card">
                            <div class="card-body">
                                <!-- Tab Navigation -->
                                <ul class="nav nav-tabs profile-tabs mb-4" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-bs-toggle="tab" href="#basic-info" role="tab">
                                            <i class="ti ti-info-circle me-2"></i>Basic Information
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#category-specs" role="tab">
                                            <i class="ti ti-list-details me-2"></i>Category & Specifications
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#images" role="tab">
                                            <i class="ti ti-photo me-2"></i>Images
                                        </a>
                                    </li>
                                </ul>

                                <!-- Tab Content -->
                                <div class="tab-content">
                                    <!-- Basic Information Tab -->
                                    <div class="tab-pane fade show active" id="basic-info" role="tabpanel">
                                        <div class="row">
                                            <!-- Product Name -->
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">
                                                        Product Name <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="text" name="name" id="productName"
                                                        class="form-control @error('name') is-invalid @enderror"
                                                        placeholder="Enter product name"
                                                        value="{{ old('name', $product->name ?? '') }}" required />
                                                    @error('name')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <!-- Slug -->
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">
                                                        Slug <span class="text-danger">*</span>
                                                        <small class="text-muted">(Auto-generated)</small>
                                                    </label>
                                                    <div class="input-group">
                                                        <input type="text" name="slug" id="productSlug"
                                                            class="form-control @error('slug') is-invalid @enderror"
                                                            placeholder="product-slug"
                                                            value="{{ old('slug', $product->slug ?? '') }}" readonly />
                                                        <button type="button" class="btn btn-outline-secondary"
                                                            id="editSlugBtn">
                                                            <i class="ti ti-edit"></i> Edit
                                                        </button>
                                                    </div>
                                                    @error('slug')
                                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <!-- Brand -->
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Brand</label>
                                                    <input type="text" name="brand" class="form-control"
                                                        placeholder="Enter brand name"
                                                        value="{{ old('brand', $product->brand ?? '') }}" />
                                                </div>
                                            </div>

                                            <!-- Model -->
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Model</label>
                                                    <input type="text" name="model" class="form-control"
                                                        placeholder="Enter model name"
                                                        value="{{ old('model', $product->model ?? '') }}" />
                                                </div>
                                            </div>

                                            <!-- Price -->
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Price (PKR)</label>
                                                    <input type="number" name="price" class="form-control"
                                                        placeholder="Enter price" step="0.01"
                                                        value="{{ old('price', $product->price ?? '') }}" />
                                                </div>
                                            </div>

                                            <!-- Quantity -->
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Quantity</label>
                                                    <input type="number" name="quantity" class="form-control"
                                                        placeholder="Enter quantity"
                                                        value="{{ old('quantity', $product->quantity ?? '') }}" />
                                                </div>
                                            </div>

                                            <!-- Status -->
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Status</label>
                                                    <select name="status" class="form-select">
                                                        <option value="1"
                                                            {{ old('status', $product->status ?? 1) == 1 ? 'selected' : '' }}>
                                                            Active
                                                        </option>
                                                        <option value="0"
                                                            {{ old('status', $product->status ?? 1) == 0 ? 'selected' : '' }}>
                                                            Inactive
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>

                                            <!-- Brief Details -->
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Brief Details</label>
                                                    <textarea name="brief_details" class="form-control" rows="1" placeholder="Enter brief details">{{ old('brief_details', $product->brief_details ?? '') }}</textarea>
                                                </div>
                                            </div>

                                            <!-- Description -->
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Description</label>
                                                    <textarea name="description" class="form-control" rows="3" placeholder="Enter description">{{ old('description', $product->description ?? '') }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Category & Specifications Tab -->
                                    <div class="tab-pane fade" id="category-specs" role="tabpanel">
                                        <div class="row">
                                            <!-- Category Selection -->
                                            <div class="col-md-12">
                                                <div class="mb-4">
                                                    <label class="form-label fw-semibold">
                                                        <i class="ti ti-category me-2"></i>Product Category
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <select name="category_id"
                                                        class="form-select @error('category_id') is-invalid @enderror"
                                                        required>
                                                        <option value="">-- Select Category --</option>
                                                        @foreach ($categories as $category)
                                                            <option value="{{ $category->id }}"
                                                                {{ old('category_id', $product->category_id ?? '') == $category->id ? 'selected' : '' }}>
                                                                {{ $category->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('category_id')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                    <small class="text-muted">
                                                        Please select a category for this product.
                                                    </small>
                                                </div>
                                            </div>

                                            <!-- Specifications -->
                                            <div class="col-md-12">
                                                <div class="d-flex justify-content-between align-items-center mb-3">
                                                    <label class="form-label fw-semibold mb-0">
                                                        <i class="ti ti-list-details me-2"></i>Product Specifications
                                                    </label>
                                                    <button type="button" class="btn btn-sm btn-primary"
                                                        id="addSpecBtn">
                                                        <i class="ti ti-plus me-1"></i>Add Specification
                                                    </button>
                                                </div>

                                                <div id="specificationsContainer">
                                                    @if (isset($product) && $product->specifications->count())
                                                        @foreach ($product->specifications as $index => $spec)
                                                            <div class="specification-row mb-3">
                                                                <div class="card">
                                                                    <div class="card-body">
                                                                        <div class="row align-items-end">
                                                                            <div class="col-md-5">
                                                                                <label class="form-label">Specification
                                                                                    Name</label>
                                                                                <input type="text"
                                                                                    name="specifications[{{ $index }}][name]"
                                                                                    class="form-control"
                                                                                    placeholder="e.g., Weight, Color, Size"
                                                                                    value="{{ $spec->name }}" />
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <label class="form-label">Value</label>
                                                                                <input type="text"
                                                                                    name="specifications[{{ $index }}][value]"
                                                                                    class="form-control"
                                                                                    placeholder="e.g., 2.5 kg, Red, Large"
                                                                                    value="{{ $spec->value }}" />
                                                                            </div>
                                                                            <div class="col-md-1">
                                                                                <button type="button"
                                                                                    class="btn btn-danger btn-sm remove-spec">
                                                                                    <i class="ti ti-trash"></i>
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @else
                                                        <div class="alert alert-info">
                                                            <i class="ti ti-info-circle me-2"></i>
                                                            No specifications added yet. Click "Add Specification" to add.
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Images Tab -->
                                    <div class="tab-pane fade" id="images" role="tabpanel">
                                        <div class="row">
                                            <!-- Upload New Images -->
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label class="form-label fw-semibold">
                                                        <i class="ti ti-upload me-2"></i>Upload Product Images
                                                    </label>
                                                    <input class="form-control" type="file" name="images[]" multiple
                                                        accept="image/*" id="imageInput" />
                                                    <small class="text-muted">
                                                        Allowed: JPG, JPEG, PNG, WEBP. Max size: 2MB per image.
                                                    </small>
                                                </div>

                                                <!-- Image Preview -->
                                                <div id="imagePreview" class="d-flex flex-wrap gap-2 mb-3"></div>
                                            </div>

                                            <!-- Existing Images -->
                                            @if (isset($product) && $product->images->count())
                                                <div class="col-md-12">
                                                    <label class="form-label fw-semibold">
                                                        <i class="ti ti-photo me-2"></i>Existing Images
                                                    </label>
                                                    <div class="d-flex flex-wrap gap-2">
                                                        @foreach ($product->images as $img)
                                                            <div class="image-wrapper position-relative"
                                                                style="width:150px; height:150px;">
                                                                <img src="{{ asset('storage/' . $img->image) }}"
                                                                    alt="Product Image" class="img-thumbnail w-100 h-100"
                                                                    style="object-fit:cover;" />

                                                                <button type="button"
                                                                    class="btn btn-danger btn-sm position-absolute top-0 end-0 m-1"
                                                                    onclick="document.getElementById('delete-form-{{ $img->id }}').submit();">
                                                                    <i class="ti ti-trash"></i>
                                                                </button>

                                                                <form id="delete-form-{{ $img->id }}"
                                                                    action="{{ route('admin.products.imageDestroy', $img->id) }}"
                                                                    method="POST" style="display:none;">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                </form>

                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <!-- Submit Buttons -->
                                <div class="row mt-4">
                                    <div class="col-12 text-end">
                                        <a href="{{ route('products.list') }}" class="btn btn-secondary me-2">
                                            Cancel
                                        </a>
                                        <button type="submit" class="btn btn-primary">
                                            {{ isset($product) ? 'Update' : 'Create' }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Tab Styling */
        .nav-tabs .nav-link {
            color: #6c757d;
            font-weight: 500;
        }

        .nav-tabs .nav-link.active {
            color: #4680ff;
            border-bottom: 2px solid #4680ff;
        }

        /* Image Wrapper */
        .image-wrapper {
            position: relative;
            border-radius: 8px;
            overflow: hidden;
        }

        .delete-image-btn {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            opacity: 0;
            transition: opacity 0.3s ease;
            z-index: 10;
        }

        .image-wrapper:hover .delete-image-btn {
            opacity: 1;
        }

        .image-wrapper:hover img {
            opacity: 0.6;
        }

        /* Specification Card */
        .specification-row .card {
            border: 1px solid #e5e7eb;
            transition: all 0.2s ease;
        }

        .specification-row .card:hover {
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        /* Image Preview */
        #imagePreview img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 8px;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Slug Generation
            const productNameInput = document.getElementById('productName');
            const productSlugInput = document.getElementById('productSlug');
            const editSlugBtn = document.getElementById('editSlugBtn');
            let slugEditable = false;
            let isEditMode = {{ isset($product) ? 'true' : 'false' }};

            function generateSlug(text) {
                return text.toString().toLowerCase().trim()
                    .replace(/\s+/g, '-')
                    .replace(/[^\w\-]+/g, '')
                    .replace(/\-\-+/g, '-')
                    .replace(/^-+/, '')
                    .replace(/-+$/, '');
            }

            if (!isEditMode) {
                productNameInput.addEventListener('input', function() {
                    if (!slugEditable) {
                        productSlugInput.value = generateSlug(this.value);
                    }
                });
            }

            editSlugBtn.addEventListener('click', function() {
                slugEditable = !slugEditable;
                if (slugEditable) {
                    productSlugInput.removeAttribute('readonly');
                    productSlugInput.focus();
                    this.innerHTML = '<i class="ti ti-check"></i> Done';
                    this.classList.replace('btn-outline-secondary', 'btn-success');
                } else {
                    productSlugInput.setAttribute('readonly', true);
                    this.innerHTML = '<i class="ti ti-edit"></i> Edit';
                    this.classList.replace('btn-success', 'btn-outline-secondary');
                    productSlugInput.value = generateSlug(productSlugInput.value);
                }
            });

            // Add Specification
            let specIndex = {{ isset($product) ? $product->specifications->count() : 0 }};
            document.getElementById('addSpecBtn').addEventListener('click', function() {
                const container = document.getElementById('specificationsContainer');

                // Remove info alert if exists
                const alert = container.querySelector('.alert-info');
                if (alert) alert.remove();

                const newSpec = `
                    <div class="specification-row mb-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="row align-items-end">
                                    <div class="col-md-5">
                                        <label class="form-label">Specification Name</label>
                                        <input type="text" name="specifications[${specIndex}][name]" 
                                               class="form-control" placeholder="e.g., Weight, Color, Size" />
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Value</label>
                                        <input type="text" name="specifications[${specIndex}][value]" 
                                               class="form-control" placeholder="e.g., 2.5 kg, Red, Large" />
                                    </div>
                                    <div class="col-md-1">
                                        <button type="button" class="btn btn-danger btn-sm remove-spec">
                                            <i class="ti ti-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>`;

                container.insertAdjacentHTML('beforeend', newSpec);
                specIndex++;
            });

            // Remove Specification
            document.addEventListener('click', function(e) {
                if (e.target.closest('.remove-spec')) {
                    e.target.closest('.specification-row').remove();
                }
            });

            // Image Preview
            document.getElementById('imageInput').addEventListener('change', function(e) {
                const preview = document.getElementById('imagePreview');
                preview.innerHTML = '';

                Array.from(e.target.files).forEach(file => {
                    const reader = new FileReader();
                    reader.onload = function(event) {
                        const img = document.createElement('img');
                        img.src = event.target.result;
                        img.className = 'img-thumbnail';
                        preview.appendChild(img);
                    };
                    reader.readAsDataURL(file);
                });
            });

            // Delete Existing Image
            document.querySelectorAll('.delete-image-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    if (confirm('Are you sure you want to delete this image?')) {
                        const imageId = this.dataset.id;
                        document.getElementById(`delete-form-${imageId}`).submit();
                    }
                });
            });
        });
    </script>
@endsection
