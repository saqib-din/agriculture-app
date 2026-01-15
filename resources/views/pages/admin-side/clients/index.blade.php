@extends('layouts.admin')

@section('content')
    <div class="pc-container">
        <div class="pc-content">

            <div class="page-header">
                <div class="page-header-title">
                    <h2 class="mb-0">Clients List</h2>
                </div>
            </div>

            @include('components.alerts')

            <div class="mb-3 text-end">
                <a href="{{ route('clients.create') }}" class="btn btn-primary">
                    <i class="ti ti-plus"></i> Add Client
                </a>
            </div>

            <div class="card">
                <div class="card-body table-card">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Company</th>
                                    <th>Status</th>
                                    <th class="text-end">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($clients as $client)
                                    <tr>
                                        <td>
                                            @if ($client->image)
                                                <img src="{{ asset($client->image) }}" width="40">
                                            @endif
                                        </td>
                                        <td>{{ $client->name }}</td>
                                        <td>{{ $client->email }}</td>
                                        <td>{{ $client->phone }}</td>
                                        <td>{{ $client->company }}</td>
                                        <td>
                                            @if ($client->status)
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td class="text-end">
                                            <a href="{{ route('clients.edit', $client->id) }}"
                                                class="avtar avtar-xs btn-link-secondary">
                                                <i class="ti ti-edit f-20"></i>
                                            </a>

                                            <a href="#" class="avtar avtar-xs btn-link-secondary"
                                                onclick="event.preventDefault(); document.getElementById('delete-form-{{ $client->id }}').submit();">
                                                <i class="ti ti-trash f-20"></i>
                                            </a>

                                            <form id="delete-form-{{ $client->id }}"
                                                action="{{ route('clients.destroy', $client->id) }}" method="POST"
                                                style="display:none;">
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
@endsection
