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
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Variables</a></li>
                                <li class="breadcrumb-item">{{ isset($team) ? 'Edit' : 'Add' }}</li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">{{ isset($variable) ? 'Variable Edit' : 'Variable Add' }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">

                    {{-- <form action="{{ route('variables.save') }}" method="POST" enctype="multipart/form-data"> --}}
                    {{-- @csrf --}}

                    <input type="hidden" name="id" value="{{ $variable->id ?? '' }}">

                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Variable Information</h5>
                        </div>

                        <div class="card-body">
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Company Name <span class="text-danger">*</span></label>
                                        <input type="text" name="name" class="form-control" placeholder="Enter name"
                                            value="{{ old('name', $variable->name ?? '') }}" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Company Email</label>
                                        <input type="text" name="email" class="form-control" placeholder="Enter email"
                                            value="{{ old('email', $variable->email ?? '') }}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Company Phone <span class="text-danger">*</span></label>
                                        <input type="text" name="phone" class="form-control" placeholder="Enter phone"
                                            value="{{ old('phone', $variable->phone ?? '') }}" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Company Fax</label>
                                        <input type="text" name="fax" class="form-control" placeholder="Enter fax"
                                            value="{{ old('fax', $variable->fax ?? '') }}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Working Hours</label>
                                        <input type="number" name="phone" class="form-control"
                                            placeholder="Enter phone number"
                                            value="{{ old('phone', $variable->phone ?? '') }}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Company LinkedIn</label>
                                        <input type="text" name="linkedin" class="form-control"
                                            placeholder="Enter LinkedIn profile URL"
                                            value="{{ old('linkedin', $variable->linkedin ?? '') }}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Company Facebook</label>
                                        <input type="text" name="facebook" class="form-control"
                                            placeholder="Enter Facebook profile URL"
                                            value="{{ old('facebook', $variable->facebook ?? '') }}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Company Instagram</label>
                                        <input type="text" name="instagram" class="form-control"
                                            placeholder="Enter Instagram profile URL"
                                            value="{{ old('instagram', $variable->instagram ?? '') }}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Company YouTube</label>
                                        <input type="text" name="youtube" class="form-control"
                                            placeholder="Enter YouTube profile URL"
                                            value="{{ old('youtube', $variable->youtube ?? '') }}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Company Twitter</label>
                                        <input type="text" name="twitter" class="form-control"
                                            placeholder="Enter Twitter profile URL"
                                            value="{{ old('twitter', $variable->twitter ?? '') }}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Company Slogan</label>
                                        <input type="text" name="slogan" class="form-control"
                                            placeholder="Enter Company Slogan"
                                            value="{{ old('slogan', $variable->slogan ?? '') }}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Company Registration Number</label>
                                        <input type="text" name="reg" class="form-control"
                                            placeholder="Enter Company Registration Number"
                                            value="{{ old('reg', $variable->reg ?? '') }}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Company Address <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="address" class="form-control"
                                            placeholder="Enter address"
                                            value="{{ old('address', $variable->address ?? '') }}" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">About Us <span class="text-danger">*</span></label>
                                        <input type="text" name="about_us" class="form-control"
                                            placeholder="Enter about us"
                                            value="{{ old('about_us', $variable->about_us ?? '') }}" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Company Mission <span
                                                class="text-danger">*</span></label>
                                        <input name="company_mission" class="form-control"
                                            placeholder="Enter company mission"
                                            value="{{ old('company_mission', $variable->company_mission ?? '') }}"
                                            required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Company Vision <span
                                                class="text-danger">*</span></label>
                                        <input name="company_vision" class="form-control"
                                            placeholder="Enter company vision"
                                            value="{{ old('company_vision', $variable->company_vision ?? '') }}" required>
                                    </div>
                                </div>

                                <div class="col-md-12 text-end">
                                    <button class="btn btn-primary">
                                        {{ isset($variable) ? 'Update' : 'Submit' }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- </form> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
