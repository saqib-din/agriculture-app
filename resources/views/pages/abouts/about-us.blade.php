@extends('layouts.landing')

@section('hero')
    <!-- Page-title -->
    <div class="page-title page-about-us">
        <div class="rellax" data-rellax-speed="5">
            <img src="{{ asset('assets/images/page-title/about-us.jpg') }}" alt="">
        </div>
        <div class="content-wrap">
            <div class="tf-container w-1290">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="content">
                            <p class="sub-title">
                                Harnessing the Sun, Powering the World
                            </p>
                            <h1 class="title">
                                About Our Solar Plant
                            </h1>

                            <div class="icon-img">
                                <img src="{{ asset('assets/images/item/line-throw-title.png') }}" alt="">
                            </div>
                            <div class="breadcrumb">
                                <a href="{{ url('/') }}">Home</a>
                                <div class="icon">
                                    <i class="icon-arrow-right1"></i>
                                </div>
                                {{-- <a href="{{ url('/aboutus') }}">About Us </a>
                                <div class="icon">
                                    <i class="icon-arrow-right1"></i>
                                </div> --}}
                                <a href="javascript:void(0)">About Us</a>
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
    <div class="main-content pb-0 pt-93">

        <!-- Section welcome to -->
        <section class="s-welcome-to">
            <div class="s-content-wrap">
                <div class="tf-container">
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="content-section">
                                <div class="heading-section style-4">
                                    <div class="img-item">
                                        <img class="tf-animate-1" src="{{ asset('assets/images/item/rice-plant-2.png') }}"
                                            alt="">
                                    </div>
                                    <p class="sub-title">
                                        Welcome to Solar Plant Energy Solutions
                                    </p>
                                    <p class="title wow fadeInUp" data-wow-delay="0s">
                                        Delivering Reliable <br>
                                        Clean Energy <br>
                                        To Homes and Businesses.
                                    </p>

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="text-wrap">
                                @if (!empty($company['about_us']))
                                    <p class="text-1 wow fadeInUp" data-wow-delay="0s">
                                        {{ $company['about_us'] ?? '' }}
                                    </p>
                                    {{-- <p class="text-2 wow fadeInUp" data-wow-delay="0s">
                                        {{ $variables->first()->about_us }}
                                    </p> --}}
                                @else
                                    <p class="text-1 wow fadeInUp" data-wow-delay="0s">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus lacus odio,
                                        egestas vitae augue sed, vulputate viverra velit. Quisque fringilla viverra
                                        turpis, at condimentum arcu convallis sit amet. Class aptent taciti sociosqu ad
                                        litora torquent per conubia nostra, per inceptos himenaeos. Fusce laoreet lectus
                                        in velit euismod.
                                    </p>
                                    <p class="text-2 wow fadeInUp" data-wow-delay="0s">
                                        Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos
                                        himenaeos. Fusce laoreet lectus in velit euismod. Praesent fermentum dignissim
                                        sapien ornare sagittis. Cras erat lorem, vulputate non magna ac, molestie
                                        bibendum felis.
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                {{-- <div class="s-img-item item-1 scroll-element-3">
                    <img class="scale-1-1" src="{{ asset('assets/images/section/yellow-f.png') }}" alt="">
                </div> --}}
            </div>
            <div class="s-content-wrap-2">

                <div class="tf-container">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="box-text wow fadeInUp" data-wow-delay="0s">
                                <p class="title font-worksans fw-7">
                                    Our Mission
                                </p>
                                @if (!empty($company['company_mission']))
                                    <p class="text font-snowfall">
                                        {{ $company['company_mission'] }}
                                    </p>
                                @else
                                    <p class="text font-snowfall">
                                        Our mission is to contribute to the promotion of agricultural products in
                                        Vietnam with a commitment to produce sustainable values that meet international
                                        standards and thereby create a fair and competitive market
                                    </p>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="box-text wow fadeInUp" data-wow-delay="0.1s">
                                <p class="title font-worksans fw-7">
                                    Our Vision
                                </p>
                                @if (!empty($company['company_vision']))
                                    <p class="text font-snowfall">
                                        {{ $company['company_vision'] }}
                                    </p>
                                @else
                                    <p class="text font-snowfall">
                                        Our mission is to contribute to the promotion of agricultural products in
                                        Vietnam with a commitment to produce sustainable values that meet international
                                        standards and thereby create a fair and competitive market
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="s-img-item item-1">
                    <img src="{{ asset('assets/images/item/wave-yellow-has-item.png') }}" alt="">
                </div>

            </div>
        </section><!-- /.Section welcome to -->

    </div><!-- /.Main-content -->
@endsection
