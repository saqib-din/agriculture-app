@extends('layouts.admin')

@section('content')
    <div class="pc-container">
        <div class="pc-content">

            <!-- Page Header -->
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ url('/hero') }}">Home</a>
                                </li>
                                <li class="breadcrumb-item" aria-current="page">
                                    Clients
                                </li>
                            </ul>
                        </div>

                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">Clients List</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @include('components.alerts')

            <!-- Clients Card -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">

                        <!-- Card Header -->
                        <div class="card-header">
                            <div class="d-sm-flex align-items-center justify-content-between">
                                <h5 class="mb-3 mb-sm-0">Clients</h5>
                                <div>
                                    <a href="{{ route('admin.clients.create') }}" class="btn btn-primary">
                                        Add Client
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Card Body -->
                        <div class="card-body table-card">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Company</th>
                                            <th>Status</th>
                                            <th class="text-end">Actions</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($clients as $client)
                                            <tr>
                                                <td>{{ $client->id }}</td>

                                                <!-- Image + Name (Hero style) -->
                                                <td>
                                                    <div class="row align-items-center">
                                                        <div class="col-auto pe-0">
                                                            @if ($client->image)
                                                                <img src="{{ asset('storage/' . $client->image) }}"
                                                                    alt="client image" class="rounded-circle"
                                                                    style="width: 40px; height: 40px;">
                                                            @else
                                                                <img src="{{ asset('admin/assets/images/user/avatar-1.jpg') }}"
                                                                    alt="default image" class="rounded-circle"
                                                                    style="width: 40px; height: 40px;">
                                                            @endif
                                                        </div>
                                                        <div class="col">
                                                            <h6 class="mb-0">{{ $client->name }}</h6>
                                                        </div>
                                                    </div>
                                                </td>

                                                <td>{{ $client->email }}</td>
                                                <td>{{ $client->phone ?? '-' }}</td>
                                                <td>{{ $client->company ?? '-' }}</td>

                                                <!-- Status -->
                                                <td>
                                                    <span
                                                        class="badge bg-{{ $client->status ? 'light-success' : 'light-danger' }}">
                                                        {{ $client->status ? 'Active' : 'Inactive' }}
                                                    </span>
                                                </td>

                                                <!-- Actions -->
                                                <td class="text-end">
                                                    <a href="{{ route('admin.clients.show', $client->id) }}"
                                                        class="avtar avtar-xs btn-link-secondary" title="View">
                                                        <i class="ti ti-eye f-20"></i>
                                                    </a>

                                                    <a href="{{ route('admin.clients.edit', $client->id) }}"
                                                        class="avtar avtar-xs btn-link-secondary" title="Edit">
                                                        <i class="ti ti-edit f-20"></i>
                                                    </a>

                                                    <a href="#" class="avtar avtar-xs btn-link-secondary"
                                                        title="Delete"
                                                        onclick="event.preventDefault();
                                                        document.getElementById('delete-form-{{ $client->id }}').submit();">
                                                        <i class="ti ti-trash f-20"></i>
                                                    </a>

                                                    <!-- Delete Form -->
                                                    <form id="delete-form-{{ $client->id }}"
                                                        action="{{ route('admin.clients.destroy', $client->id) }}"
                                                        method="POST" style="display: none;">
                                                        @csrf
                                                        @method('DELETE')
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
