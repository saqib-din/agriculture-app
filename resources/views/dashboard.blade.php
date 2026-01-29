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
                                        <img src="{{ asset('admin/assets/images/widget/welcome-banner.png') }}"
                                            alt="img" class="img-fluid" style="height:auto;" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row g-4">
                        @php
                            $cards = [
                                [
                                    'title' => 'Hero Sections',
                                    'value' => $stats['hero_sections'],
                                    'icon' => 'ti ti-layout',
                                    'color' => 'primary',
                                ],
                                [
                                    'title' => 'Services',
                                    'value' => $stats['services'],
                                    'icon' => 'ti ti-briefcase',
                                    'color' => 'success',
                                ],
                                [
                                    'title' => 'Products',
                                    'value' => $stats['products'],
                                    'icon' => 'ti ti-package',
                                    'color' => 'info',
                                ],
                                [
                                    'title' => 'Categories',
                                    'value' => $stats['categories'],
                                    'icon' => 'ti ti-folder',
                                    'color' => 'warning',
                                ],
                                [
                                    'title' => 'Quote Requests',
                                    'value' => $stats['quoteRequests'],
                                    'icon' => 'ti ti-clipboard',
                                    'color' => 'danger',
                                ],
                                [
                                    'title' => 'Clients',
                                    'value' => $stats['clients'],
                                    'icon' => 'ti ti-users',
                                    'color' => 'primary',
                                ],
                                [
                                    'title' => 'Orders',
                                    'value' => $stats['orders'],
                                    'icon' => 'ti ti-shopping-cart',
                                    'color' => 'success',
                                ],
                                [
                                    'title' => 'Team Members',
                                    'value' => $stats['teams'],
                                    'icon' => 'ti ti-user',
                                    'color' => 'info',
                                ],
                                [
                                    'title' => 'Testimonials',
                                    'value' => $stats['testimonials'],
                                    'icon' => 'ti ti-quote',
                                    'color' => 'warning',
                                ],
                                [
                                    'title' => 'FAQs',
                                    'value' => $stats['faqs'],
                                    'icon' => 'ti ti-help',
                                    'color' => 'danger',
                                ],

                                [
                                    'title' => 'Contact Messages',
                                    'value' => $stats['contacts'],
                                    'icon' => 'ti ti-mail',
                                    'color' => 'primary',
                                ],
                                [
                                    'title' => 'Partner Logos',
                                    'value' => $stats['partners'],
                                    'icon' => 'ti ti-brand-apple',
                                    'color' => 'success',
                                ],
                                [
                                    'title' => 'Footer Pages',
                                    'value' => $stats['footer_pages'],
                                    'icon' => 'ti ti-list',
                                    'color' => 'info',
                                ],
                            ];
                        @endphp

                        @foreach ($cards as $card)
                            <div class="col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <div class="avtar bg-light-{{ $card['color'] }}">
                                                    <i class="{{ $card['icon'] }} f-24"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <p class="mb-1">{{ $card['title'] }}</p>
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <h4 class="mb-0">{{ $card['value'] }}+</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <style>
                        .avtar {
                            width: 50px;
                            height: 50px;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            border-radius: 8px;
                        }

                        .f-24 {
                            font-size: 24px;
                        }

                        .bg-light-primary {
                            background-color: rgba(13, 110, 253, 0.1);
                            color: #0d6efd;
                        }

                        .bg-light-success {
                            background-color: rgba(25, 135, 84, 0.1);
                            color: #198754;
                        }

                        .bg-light-info {
                            background-color: rgba(13, 202, 240, 0.1);
                            color: #0dcaf0;
                        }

                        .bg-light-warning {
                            background-color: rgba(255, 193, 7, 0.1);
                            color: #ffc107;
                        }

                        .bg-light-danger {
                            background-color: rgba(220, 53, 69, 0.1);
                            color: #dc3545;
                        }

                        .card {
                            border: 1px solid rgba(0, 0, 0, 0.05);
                            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
                            transition: all 0.3s ease;
                        }

                        .card:hover {
                            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
                            transform: translateY(-2px);
                        }
                    </style>

                    {{-- About Us Status
                    <div class="row mt-3">
                        <div class="col-md-4">
                            <div class="card {{ $stats['about_page'] ? 'bg-success' : 'bg-danger' }} text-white">
                                <div class="card-body">
                                    <h6>About Us Page</h6>
                                    <h4>{{ $stats['about_page'] ? 'Active' : 'Not Available' }}</h4>
                                </div>
                            </div>
                        </div>
                    </div> --}}


                </div>
            </div>
        </div>
    </div>
@endsection
