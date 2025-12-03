@extends('layouts.landing')

@section('hero')
    <!-- Page-title -->
    <div class="page-title page-our-service  ">
        <div class="rellax" data-rellax-speed="5">
            <img src="{{ asset('assets/images/page-title/our-service.jpg') }}" alt="">
        </div>
        <div class="content-wrap">
            <div class="tf-container w-1290">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="content">
                            <p class="sub-title">
                                What Services Do We Provide?
                            </p>
                            <h1 class="title">
                                Our Services
                            </h1>
                            <div class="icon-img">
                                <img src="{{ asset('assets/images/item/line-throw-title.png') }}" alt="">
                            </div>
                            <div class="breadcrumb">
                                <a href="{{ url('/') }}">Home</a>
                                <div class="icon">
                                    <i class="icon-arrow-right1"></i>
                                </div>
                                <a href="javascript:void(0)"> Our Services</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="img-item item-2">
            <img src="{{ asset('assets/images/item/grass.png') }}" alt="">
        </div>
    </div><!-- /.Page-title -->
@endsection

@section('content')
    <!-- Main-content -->
    <div class="main-content page-our-service page-our-commitments pb-0">

        @php
            $mainService = $services->firstWhere('main_service', 1);
        @endphp

        <section class="s-commitment-2">
            <div class="tf-container">
                <div class="row">
                    <div class="col-lg-5">
                        <div class="image-wrap">
                            <div class="image">
                                @if ($mainService && $mainService->image)
                                    <img src="{{ asset('uploads/services/' . $mainService->image) }}" alt=""
                                        class="lazyload">
                                @else
                                    <img src="{{ asset('assets/images/widget/commitment.jpg') }}" alt=""
                                        class="lazyload">
                                @endif
                            </div>
                            @if ($mainService)
                                <!-- Agar main service hai to koi extra decorative image optional -->
                                <div class="img-item item-1 tf-animate__box">
                                    <img class="up-down-move" src="{{ asset('assets/images/item/notice-2.png') }}"
                                        alt="">
                                </div>
                            @else
                                <div class="img-item item-1 tf-animate__box">
                                    <img class="up-down-move" src="{{ asset('assets/images/item/notice-2.png') }}"
                                        alt="">
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="content-section">
                            <div class="heading-section style-2 ">
                                <div class="img-item">
                                    <div class="item">
                                        <img class="tf-animate-1 active-animate"
                                            src="{{ asset('assets/images/item/rice-plant-2.png') }}" alt="">
                                    </div>
                                    <p class="sub-title">
                                        Our Commitment To Freshness

                                    </p>
                                </div>
                                <p class="title text-anime-style-1">
                                    {{ $mainService ? $mainService->service_name : 'Our Commitment To Freshness' }}
                                </p>
                            </div>
                            <p class="text">
                                {{ $mainService ? $mainService->description : 'We Always Bring The Best Products To Consumers' }}
                            </p>
                            <ul class="benefit-list">
                                <li>
                                    <div class="icon"><i class="fa-solid fa-circle-check"></i></div>
                                    <p>We are committed to not using pesticides</p>
                                </li>
                                <li>
                                    <div class="icon"><i class="fa-solid fa-circle-check"></i></div>
                                    <p>Do not use preservatives</p>
                                </li>
                                <li>
                                    <div class="icon"><i class="fa-solid fa-circle-check"></i></div>
                                    <p>Fresh Fruits & Vegetables</p>
                                </li>
                                <li>
                                    <div class="icon"><i class="fa-solid fa-circle-check"></i></div>
                                    <p>Low price guaranteed with quality</p>
                                </li>
                                <li>
                                    <div class="icon"><i class="fa-solid fa-circle-check"></i></div>
                                    <p>Environmental protection is the focus</p>
                                </li>
                            </ul>
                            @if (!$mainService)
                                <p class="text">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc odio nunc, egestas
                                    quis efficitur eu, tempus ut nisi. Suspendisse dignissim ut massa ac bibendum.
                                    Vivamus sit amet felis odio. Phasellus a nisi eleifend.
                                </p>
                                {{-- <ul class="benefit-list">
                                    <li>
                                        <div class="icon"><i class="fa-solid fa-circle-check"></i></div>
                                        <p>We are committed to not using pesticides</p>
                                    </li>
                                    <li>
                                        <div class="icon"><i class="fa-solid fa-circle-check"></i></div>
                                        <p>Do not use preservatives</p>
                                    </li>
                                    <li>
                                        <div class="icon"><i class="fa-solid fa-circle-check"></i></div>
                                        <p>Fresh Fruits & Vegetables</p>
                                    </li>
                                    <li>
                                        <div class="icon"><i class="fa-solid fa-circle-check"></i></div>
                                        <p>Low price guaranteed with quality</p>
                                    </li>
                                    <li>
                                        <div class="icon"><i class="fa-solid fa-circle-check"></i></div>
                                        <p>Environmental protection is the focus</p>
                                    </li>
                                </ul> --}}
                            @endif

                            {{-- <a href="{{ url('/products') }}" class="tf-btn">
                                <span class="text-style">View Shop Product</span>
                                <div class="icon"><i class="icon-arrow_right"></i></div>
                            </a> --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="s-img-item item-1 scroll-element-4">
                {{-- <img src="{{ $mainService ? asset('uploads/services/' . $mainService->image) : asset('assets/images/item/tructor.png') }}"
                    alt=""> --}}
            </div>
        </section>


        <!-- Section provide -->
        <section class="s-provide">
            <div class="tf-container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="heading-section text-center has-text mb-81">
                            <p class="sub-title">What Is Our Expertise?
                            </p>
                            <p class="title text-anime-style-1">We Providing The <br>
                                Best Agricultural Services</p>
                            <p class="text">
                                Duis eleifend euismod arcu, nec faucibus mauris finibus id. Integer mattis, tellus
                                non finibus
                                rutrum.
                            </p>
                            <div class="img-item">
                                <img class="tf-animate-1" src="{{ asset('assets/images/item/rice-plant-2.png') }}"
                                    alt="" />
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="grid-layout-3">
                            @foreach ($services->where('main_service', 0) as $service)
                                <div class="box-infor ic-hover img-hover style-1 wow fadeInUp" data-wow-delay="0s">
                                    <div class="image hover-icon hover-item">
                                        @if ($service->image)
                                            <img src="{{ asset('uploads/services/' . $service->image) }}"
                                                alt="{{ $service->service_name }}" class="lazyload">
                                        @else
                                            <img src="{{ asset('assets/images/widget/provide-item-1.jpg') }}"
                                                alt="Default Service Image" class="lazyload">
                                        @endif
                                        <div class="icon style-circle">
                                            <i class="icon-lemon-slice"></i>
                                        </div>
                                    </div>
                                    <div class="content">
                                        <a href="{{ url('/services') }}"
                                            class="title fs-23 fw-6 font-worksans hover-text-4">
                                            {{ $service->service_name }}
                                        </a>
                                        <p class="text font-nunito" style="white-space: pre-line;">
                                            {!! nl2br(e($service->description)) !!}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- /.Section provide -->

    </div><!-- /.Main-content -->
@endsection
