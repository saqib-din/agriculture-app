@extends('layouts.admin')

@section('content')
    <div class="pc-container">
        <div class="pc-content">

            {{-- Page Header --}}
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('index') }}">Categories</a>
                                </li>
                                <li class="breadcrumb-item">Add Category</li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <h2 class="mb-0">Add New Category</h2>
                        </div>
                    </div>
                </div>
            </div>

            @include('components.alerts')

            {{-- Form Card --}}
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">

                            <form action="{{ route('store') }}" method="POST">
                                @csrf

                                {{-- Name --}}
                                <div class="mb-3">
                                    <label class="form-label">Category Name</label>
                                    <input type="text" name="name" class="form-control" value="{{ old('name') }}"
                                        required>
                                </div>

                                {{-- Slug --}}
                                <div class="mb-3">
                                    <label class="form-label">Slug (optional)</label>
                                    <input type="text" name="slug" class="form-control" value="{{ old('slug') }}">
                                </div>

                                {{-- Description --}}
                                <div class="mb-3">
                                    <label class="form-label">Description</label>
                                    <textarea name="description" rows="4" class="form-control">{{ old('description') }}</textarea>
                                </div>

                                {{-- Status --}}
                                <div class="mb-3">
                                    <label class="form-label">Status</label>
                                    <select name="status" class="form-select">
                                        <option value="1" selected>Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>

                                {{-- Buttons --}}
                                <div class="d-flex justify-content-end">
                                    <a href="{{ route('index') }}" class="btn btn-secondary me-2">
                                        Cancel
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        Save Category
                                    </button>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
