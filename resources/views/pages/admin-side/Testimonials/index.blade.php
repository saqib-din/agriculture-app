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
                                <li class="breadcrumb-item" aria-current="page">List</li>
                            </ul>
                        </div>

                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">Testimonials List</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @include('components.alerts')

            <!-- Table -->
            <div class="row">
                <div class="col-12">
                    <div class="card table-card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Testimonials List</h5>
                            <a href="{{ route('testimonials.create') }}" class="btn btn-primary">Add Testimonial</a>
                        </div>

                        <div class="card-body pt-3">
                            <div class="table-responsive">
                                <table class="table table-hover" id="pc-dt-simple">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Company</th>
                                            <th>Rating</th>
                                            <th>Image</th>
                                            <th>Status</th>
                                            <th width="150px">Actions</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($testimonials as $key => $item)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->company }}</td>
                                                <td>{{ $item->rating }} ⭐</td>
                                                <td>
                                                    @if ($item->image)
                                                        <img src="{{ asset('storage/' . $item->image) }}" width="60"
                                                            class="rounded">
                                                    @else
                                                        No Image
                                                    @endif

                                                </td>
                                                <td>
                                                    @if ($item->status)
                                                        <span class="badge bg-success">Active</span>
                                                    @else
                                                        <span class="badge bg-danger">Inactive</span>
                                                    @endif
                                                </td>
                                                <td class="d-flex">
                                                    <a href="{{ route('testimonials.edit', $item->id) }}"
                                                        class="avtar avtar-xs btn-link-secondary"> <i
                                                            class="ti ti-edit f-20"></i>
                                                    </a>

                                                    <form action="{{ route('testimonials.destroy', $item->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="avtar avtar-xs btn-link-secondary"
                                                            onclick="return confirm('Are you sure?')"> <i
                                                                class="ti ti-trash f-20"></i>
                                                        </button>
                                                    </form>


                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
