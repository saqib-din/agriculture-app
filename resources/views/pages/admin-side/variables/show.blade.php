@extends('layouts.admin')

@section('content')
    <div class="pc-container">
        <div class="pc-content">
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{ url('/variables') }}">Variables</a></li>
                                <li class="breadcrumb-item" aria-current="page">{{ $variable->name }}</li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">{{ $variable->name }}</h2>
                                <p class="mb-1 text-muted">Variable Details</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body py-0">
                            <ul class="nav nav-tabs profile-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link {{ session('active_tab', 'profile-1') == 'profile-1' ? 'active' : '' }}"
                                        id="profile-tab-1" data-bs-toggle="tab" href="#profile-1" role="tab"
                                        aria-selected="{{ session('active_tab', 'profile-1') == 'profile-1' ? 'true' : 'false' }}">
                                        Variable Details
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="tab-content">
                        <div class="tab-pane fade {{ session('active_tab', 'profile-1') == 'profile-1' ? 'show active' : '' }}"
                            id="profile-1" role="tabpanel" aria-labelledby="profile-tab-1">
                            <div class="row">
                                <div class="col-lg-8 col-xxl-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Personal Details</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="col-sm-12 text-start mb-3">
                                                <div class="user-upload wid-75">
                                                    @if ($variable->profile_image)
                                                        <img src="{{ asset('storage/variables/' . $variable->profile_image) }}"
                                                            alt="img" class="img-fluid" />
                                                    @else
                                                        <img src="{{ asset('admin/assets/images/user/avatar-2.jpg') }}"
                                                            alt="img" class="img-fluid" />
                                                    @endif
                                                </div>
                                            </div>

                                            <ul class="list-group list-group-flush">
                                                <li class="list-group-item px-0 pt-0">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <p class="mb-1 text-muted">Company Name</p>
                                                            <p class="mb-0">{{ $variable->name }}</p>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <p class="mb-1 text-muted">Company Email</p>
                                                            <p class="mb-0">{{ $variable->email }}</p>
                                                        </div>
                                                    </div>
                                                </li>

                                                <li class="list-group-item px-0">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <p class="mb-1 text-muted">Company Phone</p>
                                                            <p class="mb-0">{{ $variable->phone }}</p>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <p class="mb-1 text-muted">Company Fax</p>
                                                            <p class="mb-0">{{ $variable->fax ?? 'N/A' }}</p>
                                                        </div>
                                                    </div>
                                                </li>

                                                <li class="list-group-item px-0">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <p class="mb-1 text-muted">Working Hours</p>
                                                            <p class="mb-0">{{ $variable->working_hours ?? 'N/A' }}</p>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <p class="mb-1 text-muted">Linkedin</p>
                                                            <p class="mb-0">{{ $variable->linkedin ?? 'N/A' }}</p>
                                                        </div>
                                                    </div>
                                                </li>

                                                <li class="list-group-item px-0">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <p class="mb-1 text-muted">Facebook</p>
                                                            <p class="mb-0">{{ $variable->facebook ?? 'N/A' }}</p>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <p class="mb-1 text-muted">Instagram</p>
                                                            <p class="mb-0">{{ $variable->instagram ?? 'N/A' }}</p>
                                                        </div>
                                                    </div>
                                                </li>

                                                <li class="list-group-item px-0">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <p class="mb-1 text-muted">Twitter</p>
                                                            <p class="mb-0">{{ $variable->twitter ?? 'N/A' }}</p>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <p class="mb-1 text-muted">Company Map</p>
                                                            <p class="mb-0">{{ $variable->map ?? 'N/A' }}</p>
                                                        </div>
                                                    </div>
                                                </li>

                                                <li class="list-group-item px-0">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <p class="mb-1 text-muted">Company Slogan</p>
                                                            <p class="mb-0">{{ $variable->slogan ?? 'N/A' }}</p>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <p class="mb-1 text-muted">Registration No</p>
                                                            <p class="mb-0">{{ $variable->reg ?? 'N/A' }}</p>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="list-group-item px-0">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <p class="mb-1 text-muted">Company Vision</p>
                                                            <p class="mb-0">{{ $variable->company_vision ?? 'N/A' }}</p>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <p class="mb-1 text-muted">Company Mission</p>
                                                            <p class="mb-0">{{ $variable->company_mission ?? 'N/A' }}</p>
                                                        </div>
                                                    </div>
                                                </li>

                                                <li class="list-group-item px-0">
                                                    <p class="mb-1 text-muted">Address</p>
                                                    <p class="mb-0">{{ $variable->address ?? 'N/A' }}</p>
                                                </li>

                                                <li class="list-group-item px-0">
                                                    <p class="mb-1 text-muted">About Us</p>
                                                    <p class="mb-0">{{ $variable->about_us ?? 'N/A' }}</p>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
