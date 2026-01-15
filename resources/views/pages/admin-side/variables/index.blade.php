{{-- @extends('layouts.admin')

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
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Variables</a></li>
                                <li class="breadcrumb-item" aria-current="page">List</li>
                            </ul>
                        </div>

                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">Variables List</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @include('components.alerts')

            <!-- Table -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Variables List</h5>
                            <a href="{{ route('variables.create') }}" class="btn btn-primary">Add Variable</a>
                        </div>

                        <div class="card-body table-card">
                            <div class="table-responsive">
                                <table class="table table-hover" id="pc-dt-simple">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Company Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Fax</th>
                                            <th>Slogan</th>
                                            <th>Working Hours</th>
                                            <th class="text-end">Actions</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($variables as $variable)
                                            <tr>
                                                <td>{{ $variable->id }}</td>
                                                <td>{{ $variable->name }}</td>
                                                <td>{{ $variable->email }}</td>
                                                <td>{{ $variable->phone }}</td>
                                                <td>{{ $variable->fax }}</td>
                                                <td>{{ $variable->slogan }}</td>
                                                <td>{{ $variable->working_hours }}</td>


                                                <td class="text-end">
                                                    <a href="{{ route('variables.show', $variable->id) }}"
                                                        class="avtar avtar-xs btn-link-secondary">
                                                        <i class="ti ti-eye f-20"></i>
                                                    </a>

                                                    <a href="{{ route('variables.edit', $variable->id) }}"
                                                        class="avtar avtar-xs btn-link-secondary">
                                                        <i class="ti ti-edit f-20"></i>
                                                    </a>

                                                   <a href="#" class="avtar avtar-xs btn-link-secondary bs-pass-para"
                                                        data-id="{{ $variable->id }}" title="Delete">
                                                        <i class="ti ti-trash f-20"></i>
                                                    </a>

                                                    <!-- Hidden form -->
                                                    <form id="delete-form-{{ $variable->id }}"
                                                        action="{{ route('variables.destroy', $variable->id) }}" method="POST"
                                                        style="display: none;">
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
@endsection --}}
