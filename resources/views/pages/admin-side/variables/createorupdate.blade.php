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
                                <li class="breadcrumb-item">Settings</li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">Company Variables</h2>
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
                                                value="{{ old('name', $variables['company_name'] ?? '') }}"
                                                placeholder="Enter company name" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Company Email <span
                                                    class="text-danger">*</span></label>
                                            <input type="email" name="email" class="form-control"
                                                value="{{ old('email', $variables['company_email'] ?? '') }}"
                                                placeholder="Enter company email" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Company Phone <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="phone" class="form-control"
                                                value="{{ old('phone', $variables['company_phone'] ?? '') }}"
                                                placeholder="Enter company phone" required>
                                        </div>
                                    </div>

                                    {{-- GST Field --}}
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">GST Rate (%) <span
                                                    class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <input type="number" name="gst_rate" id="gstRateInput" class="form-control"
                                                    value="{{ old('gst_rate', $variables['gst_rate'] ?? '0') }}"
                                                    placeholder="Enter GST rate" max="100"
                                                    step="0.01" required>
                                                <span class="input-group-text">%</span>
                                            </div>
                                            {{-- <small class="text-muted">Example: For 15% GST, enter 15</small>
                                            <div id="gstExample" class="mt-2" style="display: none;">
                                                <div class="alert alert-info py-2 px-3 mb-0">
                                                    <small>
                                                        <strong>Example Calculation:</strong><br>
                                                        Amount: PKR <span id="exampleAmount">150.00</span><br>
                                                        GST (<span id="exampleRate">0</span>%): PKR <span
                                                            id="exampleGst">0.00</span><br>
                                                        Total: PKR <span id="exampleTotal">150.00</span>
                                                    </small>
                                                </div>
                                            </div> --}}
                                        </div>
                                    </div>

                                    {{-- Optional Fields --}}
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Fax</label>
                                            <input type="text" name="fax" class="form-control"
                                                value="{{ old('fax', $variables['company_fax'] ?? '') }}"
                                                placeholder="Enter company fax">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Working Hours</label>
                                            <input type="text" name="working_hours" class="form-control"
                                                value="{{ old('working_hours', $variables['working_hours'] ?? '') }}"placeholder="Enter working hours">
                                        </div>
                                    </div>

                                    {{-- Social Links --}}
                                    @foreach (['linkedin', 'facebook', 'instagram', 'youtube', 'twitter'] as $social)
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">{{ ucfirst($social) }}</label>
                                                <input type="text" name="{{ $social }}" class="form-control"
                                                    value="{{ old($social, $variables[$social] ?? '') }}"
                                                    placeholder="Enter social link url">
                                            </div>
                                        </div>
                                    @endforeach

                                    {{-- Other Fields --}}
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Registration Number</label>
                                            <input type="text" name="reg" class="form-control"
                                                value="{{ old('reg', $variables['registration_number'] ?? '') }}"
                                                placeholder="Enter registration number">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Company Slogan</label>
                                            <input type="text" name="slogan" class="form-control"
                                                value="{{ old('slogan', $variables['company_slogan'] ?? '') }}"
                                                placeholder="Enter company slogan">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Map URL</label>
                                            <input type="text" name="map" class="form-control"
                                                value="{{ old('map', $variables['company_map'] ?? '') }}"
                                                placeholder="Enter map url">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">About Us</label>
                                            <input type="text" name="about_us" class="form-control"
                                                value="{{ old('about_us', $variables['about_us'] ?? '') }}"
                                                placeholder="Enter about us">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Company Mission</label>
                                            <input type="text" name="company_mission" class="form-control"
                                                value="{{ old('company_mission', $variables['company_mission'] ?? '') }}"
                                                placeholder="Enter company mission">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Company Vision</label>
                                            <input type="text" name="company_vision" class="form-control"
                                                value="{{ old('company_vision', $variables['company_vision'] ?? '') }}"
                                                placeholder="Enter company vision">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Company Address</label>
                                            <textarea name="address" class="form-control" rows="3" placeholder="Enter company address">{{ old('address', $variables['company_address'] ?? '') }}</textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-12 text-end mt-3">
                                        <button type="submit" class="btn btn-primary">Save Variables</button>
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
