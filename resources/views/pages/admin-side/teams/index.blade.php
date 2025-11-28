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
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0)">Teams</a></li>
                                <li class="breadcrumb-item" aria-current="page">List</li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">Teams List</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ breadcrumb ] end -->

            @include('components.alerts')

            <!-- [ Main Content ] start -->
            <div class="row">
                <div class="col-12">
                    <div class="card table-card">
                        <div class="card-header">
                            <div class="d-sm-flex align-items-center justify-content-between">
                                <h5 class="mb-3 mb-sm-0">Teams list</h5>
                                <div>
                                    <a href="{{ route('createorupdate') }}" class="btn btn-primary">Add Team</a>
                                </div>
                            </div>
                        </div>

                        <div class="card-body pt-3">
                            <div class="table-responsive">
                                <table class="table table-hover" id="pc-dt-simple">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Designation</th>
                                            <th>Description</th>
                                            <th>Social Links</th>
                                            <th>CEO</th>
                                            <th>Status</th>
                                            <th class="text-end">Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($teams as $team)
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0">
                                                            <img src="{{ $team->image ? asset('uploads/teams/' . $team->image) : asset('admin/assets/images/user/avatar-1.jpg') }}"
                                                                alt="user image" style="width: 40px; height: 40px;"
                                                                class="rounded-circle" />
                                                        </div>
                                                        <div class="flex-grow-1 ms-3">
                                                            <h6 class="mb-0">{{ $team->name }}</h6>
                                                        </div>
                                                    </div>
                                                </td>

                                                <td>{{ $team->designation }}</td>

                                                <td style="max-width: 200px;">
                                                    @php
                                                        $words = explode(' ', $team->description ?? '');
                                                        $chunks = array_chunk($words, 5); // Split into arrays of 5 words each
                                                    @endphp

                                                    @foreach ($chunks as $chunk)
                                                        {{ implode(' ', $chunk) }}<br>
                                                    @endforeach
                                                </td>

                                                <td>
                                                    @if ($team->linkedin)
                                                        <a href="{{ $team->linkedin }}" target="_blank">LinkedIn</a><br>
                                                    @endif
                                                    @if ($team->facebook)
                                                        <a href="{{ $team->facebook }}" target="_blank">Facebook</a><br>
                                                    @endif
                                                    @if ($team->instagram)
                                                        <a href="{{ $team->instagram }}" target="_blank">Instagram</a>
                                                    @endif
                                                </td>
                                                <td>
                                                    <span class="badge {{ $team->is_ceo ? 'bg-light-info' : 'bg-light-secondary' }}">{{ $team->is_ceo ? 'Yes' : 'No' }}</span>
                                                </td>
                                                <td>
                                                    @if ($team->status == 'Active')
                                                        <span class="badge bg-light-success">Active</span>
                                                    @else
                                                        <span class="badge bg-light-danger">Inactive</span>
                                                    @endif
                                                </td>

                                                <td class="text-end">
                                                    <a href="{{ route('createorupdate', $team->id) }}"
                                                        class="avtar avtar-xs btn-link-secondary">
                                                        <i class="ti ti-edit f-20"></i>
                                                    </a>

                                                    <form action="{{ route('teams.destroy', $team->id) }}" method="POST"
                                                        style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="avtar avtar-xs btn-link-secondary"
                                                            onclick="return confirm('Are you sure?')">
                                                            <i class="ti ti-trash f-20"></i>
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
            <!-- [ Main Content ] end -->
        </div>
    </div>
    <!-- [ Main Content ] end -->
@endsection
