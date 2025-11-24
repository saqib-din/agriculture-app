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

        <!-- Section our commitment 2 -->
        <section class="s-commitment-2">
            <div class="tf-container">
                <div class="row">
                    <div class="col-lg-5">
                        <div class="image-wrap">
                            <div class="image">
                                <img src="{{ asset('assets/images/widget/commitment.jpg') }}"
                                    data-src="{{ asset('assets/images/widget/commitment.jpg') }}" alt=""
                                    class="lazyload">
                            </div>
                            <div class="img-item item-1 tf-animate__box">
                                <img class="up-down-move" src="{{ asset('assets/images/item/notice-2.png') }}"
                                    alt="">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="content-section">
                            <div class="heading-section style-2 ">
                                <div class="img-item">
                                    <div class="item">
                                        <img class="tf-animate-1" src="{{ asset('assets/images/item/rice-plant-2.png') }}"
                                            alt="" />
                                    </div>
                                    <p class="sub-title">
                                        Our Commitment To Freshness

                                    </p>
                                </div>

                                <p class="title text-anime-style-1">
                                    We Always Bring The Best
                                    Products To Consumers
                                </p>
                            </div>
                            <p class="text">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc odio nunc, egestas
                                quis efficitur eu, tempus ut nisi. Suspendisse dignissim ut massa ac bibendum.
                                Vivamus sit amet felis odio. Phasellus a nisi eleifend.
                            </p>
                            <ul class="benefit-list">
                                <li>
                                    <div class="icon">
                                        <i class="fa-solid fa-circle-check"></i>
                                    </div>
                                    <p>We are committed to not using pesticides</p>
                                </li>
                                <li>
                                    <div class="icon">
                                        <i class="fa-solid fa-circle-check"></i>
                                    </div>
                                    <p>Do not use preservatives</p>
                                </li>
                                <li>
                                    <div class="icon">
                                        <i class="fa-solid fa-circle-check"></i>
                                    </div>
                                    <p>Fresh Fruits & Vegetables</p>
                                </li>
                                <li>
                                    <div class="icon">
                                        <i class="fa-solid fa-circle-check"></i>
                                    </div>
                                    <p>Low price guaranteed with quality</p>
                                </li>
                                <li>
                                    <div class="icon">
                                        <i class="fa-solid fa-circle-check"></i>
                                    </div>
                                    <p>Environmental protection is the focus</p>
                                </li>
                            </ul>
                            <a href="{{ url('/products') }}" class="tf-btn">
                                <span class="text-style">View Shop Product</span>
                                <div class="icon"><i class="icon-arrow_right"></i></div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="s-img-item item-1 scroll-element-4">
                <img src="{{ asset('assets/images/item/tructor.png') }}" alt="">
            </div>
        </section><!-- /.Section our commitment 2 -->

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
                            <div class="box-infor ic-hover img-hover style-1 wow fadeInUp" data-wow-delay="0s">
                                <div class="image hover-icon hover-item">
                                    <img src="{{ asset('assets/images/widget/provide-item-1.jpg') }}"
                                        data-src="{{ asset('assets/images/widget/provide-item-1.jpg') }}" alt=""
                                        class=" lazyload">
                                    <div class="icon style-circle">
                                        <i class="icon-salad"></i>
                                    </div>
                                </div>
                                <div class="content">
                                    <a href="service-detail.html" class="title fs-23 fw-6 font-worksans hover-text-4">
                                        Clean Vegetables
                                    </a>
                                    <p class="text font-nunito">
                                        Ultrices sagittis orci a scelerisque purus semper eget duis at. Sollicitudin
                                        nibh sit amet
                                        commodo nulla.
                                    </p>
                                    <a href="our-services.html" class="tf-btn-read hover-text-4">Read More</a>
                                </div>
                            </div>
                            <div class="box-infor ic-hover img-hover style-1 wow fadeInUp" data-wow-delay="0.1s">
                                <div class="image hover-icon hover-item">
                                    <img src="{{ asset('assets/images/widget/provide-item-2.jpg') }}"
                                        data-src="{{ asset('assets/images/widget/provide-item-2.jpg') }}" alt=""
                                        class=" lazyload">
                                    <div class="icon style-circle">
                                        <i class="icon-cow"></i>
                                    </div>
                                </div>
                                <div class="content">
                                    <a href="service-detail.html" class="title fs-23 fw-6 font-worksans hover-text-4">
                                        Pure Cow's Milk
                                    </a>
                                    <p class="text font-nunito">
                                        Ultrices sagittis orci a scelerisque purus semper eget duis at. Sollicitudin
                                        nibh sit amet
                                        commodo nulla.
                                    </p>
                                    <a href="our-services.html" class="tf-btn-read hover-text-4">Read More</a>
                                </div>
                            </div>
                            <div class="box-infor ic-hover img-hover style-1 wow fadeInUp" data-wow-delay="0.2s">
                                <div class="image hover-icon hover-item">
                                    <img src="{{ asset('assets/images/widget/provide-item-3.jpg') }}"
                                        data-src="{{ asset('assets/images/widget/provide-item-3.jpg') }}" alt=""
                                        class=" lazyload">
                                    <div class="icon style-circle">
                                        <i class="icon-chicken-2
                                            "></i>
                                    </div>
                                </div>
                                <div class="content">
                                    <a href="service-detail.html" class="title fs-23 fw-6 font-worksans hover-text-4">
                                        Clean Chicken And Eggs
                                    </a>
                                    <p class="text font-nunito">
                                        Ultrices sagittis orci a scelerisque purus semper eget duis at. Sollicitudin
                                        nibh sit amet
                                        commodo nulla.
                                    </p>
                                    <a href="our-services.html" class="tf-btn-read hover-text-4">Read More</a>
                                </div>
                            </div>
                            <div class="box-infor ic-hover img-hover style-1 wow fadeInUp" data-wow-delay="0s">
                                <div class="image hover-icon hover-item">
                                    <img src="{{ asset('assets/images/widget/provide-item-4.jpg') }}"
                                        data-src="{{ asset('assets/images/widget/provide-item-4.jpg') }}" alt=""
                                        class=" lazyload">
                                    <div class="icon style-circle">
                                        <i class="icon-fertilizer"></i>
                                    </div>
                                </div>
                                <div class="content">
                                    <a href="service-detail.html" class="title fs-23 fw-6 font-worksans hover-text-4">
                                        Fertilizer Products
                                    </a>
                                    <p class="text font-nunito">
                                        Ultrices sagittis orci a scelerisque purus semper eget duis at. Sollicitudin
                                        nibh sit amet
                                        commodo nulla.
                                    </p>
                                    <a href="our-services.html" class="tf-btn-read hover-text-4">Read More</a>
                                </div>
                            </div>
                            <div class="box-infor ic-hover img-hover style-1 wow fadeInUp" data-wow-delay="0.1s">
                                <div class="image hover-icon hover-item">
                                    <img src="{{ asset('assets/images/widget/provide-item-5.jpg') }}"
                                        data-src="{{ asset('assets/images/widget/provide-item-5.jpg') }}"alt=""
                                        class=" lazyload">
                                    <div class="icon style-circle">
                                        <i class="icon-lemon-slice"></i>
                                    </div>
                                </div>
                                <div class="content">
                                    <a href="service-detail.html" class="title fs-23 fw-6 font-worksans hover-text-4">
                                        Tubers And Fruits
                                    </a>
                                    <p class="text font-nunito">
                                        Ultrices sagittis orci a scelerisque purus semper eget duis at. Sollicitudin
                                        nibh sit amet
                                        commodo nulla.
                                    </p>
                                    <a href="our-services.html" class="tf-btn-read hover-text-4">Read More</a>
                                </div>
                            </div>
                            <div class="box-infor ic-hover img-hover style-1 wow fadeInUp" data-wow-delay="0.2s">
                                <div class="image hover-icon hover-item">
                                    <img src="{{ asset('assets/images/widget/provide-item-6.jpg') }}"
                                        data-src="{{ asset('assets/images/widget/provide-item-6.jpg') }}" alt=""
                                        class=" lazyload">
                                    <div class="icon style-circle">
                                        <i class="icon-meat222"></i>
                                    </div>
                                </div>
                                <div class="content">
                                    <a href="service-detail.html" class="title fs-23 fw-6 font-worksans hover-text-4">
                                        Meat Of Cattle And Poultry
                                    </a>
                                    <p class="text font-nunito">
                                        Ultrices sagittis orci a scelerisque purus semper eget duis at. Sollicitudin
                                        nibh sit amet
                                        commodo nulla.
                                    </p>
                                    <a href="#" class="tf-btn-read hover-text-4">Read More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- /.Section provide -->

    </div><!-- /.Main-content -->
@endsection
