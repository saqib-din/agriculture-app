@extends('layouts.admin')

@section('content')
    <div class="pc-container">
        <div class="pc-content">
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="page-header-title d-flex justify-content-between">
                                <h2 class="mb-0">Dashboard</h2>
                                {{-- <a id="refreshBtn" class="avtar avtar-xs btn-link-secondary" data-bs-toggle="tooltip"
                                    data-bs-placement="left" title="Stats Refresh Now">
                                    <i class="ti ti-refresh f-20"></i>
                                </a> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card welcome-banner">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6 d-flex align-items-center">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3">
                                            <div class="user-upload wid-75">
                                                <img src="{{ asset('admin/assets/images/user/sms.png') }}"
                                                    alt="Default Logo" class="img-fluid" style="max-width: 150px;" />
                                            </div>
                                        </div>
                                        <div class="pt-0">
                                            <h2 class="text-white">
                                                Agriculture App
                                            </h2>
                                            <p class="text-white">
                                                Please configure your
                                                app settings.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 text-center">
                                    <div class="img-welcome-banner position-relative">
                                        <img src="{{ asset('admin/assets/images/widget/welcome-banner.png') }}" alt="img"
                                            class="img-fluid" style="height:auto;" />
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
