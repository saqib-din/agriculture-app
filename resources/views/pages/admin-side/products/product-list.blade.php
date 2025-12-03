@extends('layouts.admin')

@section('content')
    <div class="pc-container">
        <div class="pc-content">
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/products') }}">Home</a></li>
                                <li class="breadcrumb-item" aria-current="page">Products</li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">Products List</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- <x-alerts /> --}}

            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-sm-flex align-items-center justify-content-between">
                                <h5 class="mb-3 mb-sm-0">Product list</h5>
                                <div>
                                    <a href="{{ url('/product/add') }}" class="btn btn-primary">Add Product</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body table-card">
                            <div class="table-responsive">
                                <table class="table mb-0">
                                    <thead>
                                        <tr>
                                            <th>Product Name</th>
                                            <th>Specifications</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th class="text-end">STATUS</th>
                                            <th class="text-end">ACTIONS</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="row">
                                                    <div class="col-auto pe-0">
                                                        <img src="{{ asset('admin/assets/images/user/avatar-2.jpg') }}"
                                                            alt="user" class="avtar avtar-md rounded-circle" />
                                                    </div>
                                                    <div class="col justify-content-center">
                                                        <h5 class="mb-0">
                                                            Admin
                                                        </h5>
                                                        <small class="text-truncate w-100 text-muted"></small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="row">
                                                    <div class="col">
                                                        <span class="text-truncate w-100 text-muted">
                                                            Duis eleifend euismod arcu, nec faucibus
                                                        </span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="row">
                                                    <div class="col">
                                                        <span class="text-truncate w-100 text-muted">
                                                            100
                                                        </span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="row">
                                                    <div class="col">
                                                        <span class="text-truncate w-100 text-muted">
                                                            $150
                                                        </span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-end">
                                                <span class="badge bg-light-success ">Active
                                                </span>
                                            </td>
                                            <td class="text-end">
                                                <a data-bs-toggle="modal" href="#"
                                                    class="avtar avtar-xs btn-link-secondary">
                                                    <i class="ti ti-eye f-20"></i>
                                                </a>
                                                <a data-bs-toggle="modal" href="#"
                                                    class="avtar avtar-xs btn-link-secondary">
                                                    <i class="ti ti-edit f-20"></i>
                                                </a>
                                                <a data-bs-toggle="modal" href="#"
                                                    class="avtar avtar-xs btn-link-secondary">
                                                    <i class="ti ti-trash f-20"></i>
                                                </a>
                                            </td>
                                        </tr>
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
