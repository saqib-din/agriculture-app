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
                                <li class="breadcrumb-item" aria-current="page">Users</li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">Users List</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @include('components.alerts')

            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-sm-flex align-items-center justify-content-between">
                                <h5 class="mb-3 mb-sm-0">Users list</h5>
                                <div>
                                    {{-- <a href="{{ url('/users/add') }}" class="btn btn-primary">Add User</a> --}}
                                </div>
                            </div>
                        </div>
                        <div class="card-body table-card">
                            <div class="table-responsive">
                                <table class="table mb-0">
                                    <thead>
                                        <tr>
                                            <th>User Name</th>
                                            <th>Email</th>
                                            <th class="text-end">ACTIONS</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="row">
                                                    <div class="col-auto pe-0">
                                                        <img src="{{ asset('admin/assets/images/user/avatar-1.jpg') }}"
                                                            alt="user" class="avtar avtar-md rounded-circle" />
                                                    </div>
                                                    <div class="col justify-content-center">
                                                        <h5 class="mb-0">
                                                            {{ Auth::user()->name }}
                                                        </h5>
                                                        <small class="text-truncate w-100 text-muted"></small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="row">
                                                    <div class="col">
                                                        <span class="text-truncate w-100 text-muted">
                                                            {{ Auth::user()->email }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-end">
                                                <a href="{{ route('profile.edit') }}"
                                                    class="avtar avtar-xs btn-link-secondary">
                                                    <i class="ti ti-edit f-20"></i>
                                                </a>
                                                {{-- <a href="#" class="avtar avtar-xs btn-link-secondary bs-pass-para"
                                                    data-id="{{ Auth::user()->id }}" title="Delete">
                                                    <i class="ti ti-trash f-20"></i>
                                                </a>

                                                <!-- Hidden form -->
                                                <form id="delete-form-{{ Auth::user()->id }}"
                                                    action="{{ route('profile.destroy', Auth::user()->id) }}" method="POST"
                                                    style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form> --}}
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
