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
                                <li class="breadcrumb-item">
                                    <a href="{{ route('dashboard') }}">Home</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="javascript:void(0)">Categories</a>
                                </li>
                                <li class="breadcrumb-item" aria-current="page">List</li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">Categories List</h2>
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
                                <h5 class="mb-3 mb-sm-0">Categories List</h5>
                                <div>
                                    <button class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#addCategoryModal">
                                        Add Category
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="card-body table-card">
                            <div class="table-responsive">
                                <table class="table table-hover" id="pc-dt-simple">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Category Name</th>
                                            <th>Products</th>
                                            <th class="text-end">Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @forelse ($categories as $category)
                                            <tr>
                                                <!-- ID -->
                                                <td>
                                                    <h6 class="mb-0">{{ $category->id }}</h6>
                                                </td>

                                                <!-- NAME -->
                                                <td>
                                                    <h6 class="mb-0">{{ $category->name }}</h6>
                                                </td>

                                                <td>
                                                    <span class="badge bg-light-info">
                                                        {{ $category->products_count }}
                                                    </span>
                                                </td>

                                                <!-- ACTION -->
                                                <td class="text-end">

                                                    <!-- EDIT -->
                                                    <a href="#" class="avtar avtar-xs btn-link-secondary"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#editCategoryModal-{{ $category->id }}"
                                                        title="Edit">
                                                        <i class="ti ti-edit f-20"></i>
                                                    </a>

                                                    <a href="#" class="avtar avtar-xs btn-link-danger bs-pass-para"
                                                        data-id="{{ $category->id }}" title="Delete">
                                                        <i class="ti ti-trash f-20"></i>
                                                    </a>

                                                    <form id="delete-form-{{ $category->id }}"
                                                        action="{{ route('destroy', $category) }}" method="POST"
                                                        style="display:none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center text-muted">
                                                    No categories found
                                                </td>
                                            </tr>
                                        @endforelse
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


    <!-- ADD CATEGORY MODAL -->
    <div class="modal fade" id="addCategoryModal">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <form method="POST" action="{{ route('store') }}" class="modal-content">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title">Add Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    {{-- Category Name --}}
                    <div class="mb-3">
                        <label class="form-label">Category Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                    </div>

                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>

            </form>
        </div>
    </div>

    <!-- EDIT CATEGORY MODAL -->
    @foreach ($categories as $category)
        <div class="modal fade" id="editCategoryModal-{{ $category->id }}">
            <div class="modal-dialog modal-md modal-dialog-centered">
                <form method="POST" action="{{ route('update', $category->id) }}" class="modal-content">
                    @csrf
                    @method('PUT')

                    <div class="modal-header">
                        <h5 class="modal-title">Edit Category - {{ $category->name }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">

                        {{-- Category Name --}}
                        <div class="mb-3">
                            <label class="form-label">Category Name</label>
                            <input type="text" name="name" class="form-control"
                                value="{{ old('name', $category->name) }}" required>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>

                </form>
            </div>
        </div>
    @endforeach
@endsection
