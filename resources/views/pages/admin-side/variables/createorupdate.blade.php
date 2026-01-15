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
                                <li class="breadcrumb-item">{{ isset($variable) ? 'Edit' : 'Add' }}</li>
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

            @include('components.alerts')


            <div class="row">
                <div class="col-12">

                    <form action="{{ route('variables.save') }}" method="POST">
                        @csrf

                        <input type="hidden" name="id" value="{{ $variable->id ?? '' }}">

                        <div class="card mt-3">
                            <div class="card-header">
                                <h5 class="mb-0">Variable Information</h5>
                            </div>

                            <div class="card-body">
                                <div class="row">

                                    {{-- Required Fields --}}
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Company Name <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="name" class="form-control"
                                                placeholder="Enter company name"
                                                value="{{ old('name', $variable->name ?? '') }}" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Company Email <span
                                                    class="text-danger">*</span></label>
                                            <input type="email" name="email" class="form-control"
                                                placeholder="Enter company email"
                                                value="{{ old('email', $variable->email ?? '') }}" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Company Phone <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="phone" class="form-control"
                                                placeholder="Enter company phone"
                                                value="{{ old('phone', $variable->phone ?? '') }}" required>
                                        </div>
                                    </div>

                                    {{-- Optional Fields --}}
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Company Fax</label>
                                            <input type="text" name="fax" class="form-control"
                                                placeholder="Enter company fax"
                                                value="{{ old('fax', $variable->fax ?? '') }}">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Working Hours</label>
                                            <input type="text" name="working_hours" class="form-control"
                                                placeholder="Enter working hours"
                                                value="{{ old('working_hours', $variable->working_hours ?? '') }}">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">LinkedIn</label>
                                            <input type="text" name="linkedin" class="form-control"
                                                placeholder="Enter LinkedIn URL"
                                                value="{{ old('linkedin', $variable->linkedin ?? '') }}">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Facebook</label>
                                            <input type="text" name="facebook" class="form-control"
                                                placeholder="Enter Facebook URL"
                                                value="{{ old('facebook', $variable->facebook ?? '') }}">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Instagram</label>
                                            <input type="text" name="instagram" class="form-control"
                                                placeholder="Enter Instagram URL"
                                                value="{{ old('instagram', $variable->instagram ?? '') }}">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">YouTube</label>
                                            <input type="text" name="youtube" class="form-control"
                                                placeholder="Enter YouTube URL"
                                                value="{{ old('youtube', $variable->youtube ?? '') }}">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Twitter</label>
                                            <input type="text" name="twitter" class="form-control"
                                                placeholder="Enter Twitter URL"
                                                value="{{ old('twitter', $variable->twitter ?? '') }}">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Registration Number</label>
                                            <input type="text" name="reg" class="form-control"
                                                placeholder="Enter registration number"
                                                value="{{ old('reg', $variable->reg ?? '') }}">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Company Slogan</label>
                                            <input type="text" name="slogan" class="form-control"
                                                placeholder="Enter company slogan"
                                                value="{{ old('slogan', $variable->slogan ?? '') }}">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Company Map URL</label>
                                            <input type="text" name="map" class="form-control"
                                                placeholder="Enter company map URL"
                                                value="{{ old('map', $variable->map ?? '') }}">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">About Us</label>
                                            <input type="text" name="about_us" class="form-control"
                                                placeholder="Enter about us"
                                                value="{{ old('about_us', $variable->about_us ?? '') }}">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Company Mission</label>
                                            <input type="text" name="company_mission" class="form-control"
                                                placeholder="Enter company mission"
                                                value="{{ old('company_mission', $variable->company_mission ?? '') }}">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Company Vision</label>
                                            <input type="text" name="company_vision" class="form-control"
                                                placeholder="Enter company vision"
                                                value="{{ old('company_vision', $variable->company_vision ?? '') }}">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Company Address</label>
                                            <textarea name="address" class="form-control" placeholder="Enter company address" rows="3">{{ old('address', $variable->address ?? '') }}</textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-12 text-end mt-3">
                                        <div class="mb-3">
                                            <button type="submit" class="btn btn-primary">
                                                {{ isset($variable) ? 'Update' : 'Submit' }}
                                            </button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
