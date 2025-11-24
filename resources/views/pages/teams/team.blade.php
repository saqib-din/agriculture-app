@extends('layouts.landing')

@section('hero')
    <!-- Page-title -->
    <div class="page-title page-our-farmers ">
        <div class="rellax" data-rellax-speed="5">
            <img src="{{ asset('assets/images/page-title/our-farmer.jpg') }}" alt="">
        </div>
        <div class="content-wrap">

            <div class="tf-container w-1290">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="content">
                            <p class="sub-title">
                                Dedicated And Pofessional People
                            </p>
                            <h1 class="title">
                                Meet our farmers
                            </h1>
                            <div class="icon-img">
                                <img src="{{ asset('assets/images/item/line-throw-title.png') }}" alt="">
                            </div>
                            <div class="breadcrumb">
                                <a href="{{ url('/') }}">Home</a>
                                <div class="icon">
                                    <i class="icon-arrow-right1"></i>
                                </div>
                                <a href="{{ url('/aboutus') }}">About Us </a>
                                <div class="icon">
                                    <i class="icon-arrow-right1"></i>
                                </div>
                                <a href="javascript:void(0)">Meet Our farmers </a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="img-item item-2">
            <img src="{{ asset('assets/images/item/grass-5.png') }}" alt="">
        </div>
    </div><!-- /.Page-title -->
@endsection

@section('content')
    <!-- Main-content -->
    <div class="main-content page-our-farmers pt-0 pb-0">
        <!-- Section testimonial -->
        <section class="s-testimonial style-2 type-2">
            <div class="wrap">
                <div class="image scroll-element wow fadeInLeft" data-wow-delay="0s">
                    <img class="" src="{{ asset('assets/images/item/s-testi.png') }}" alt="" />
                    <div class="sign scroll-element-3">
                        <img src="{{ asset('assets/images/item/sign.png') }}" alt="">
                    </div>
                </div>
                <div class="content-section">
                    <div class="heading-section ">
                        <p class="title text-anime-style-1">Creator Of Success</p>
                    </div>
                    <p class="quote font-snowfall fs-30 text-anime-style-1">
                        “Agriculture is our wisest pursuit, because it will in the end contribute most to real
                        wealth,
                        good
                        morals, and happiness. Farmers are the embodiment of hard work, dedication, and resilience.”
                    </p>
                    <div class="bot">
                        <div class="author-wrap">
                            <p class="author text-upper fw-6 font-worksans">
                                <a href="#" class="">
                                    Donald Christopher
                                </a>- Talk
                            </p>
                            <p class="duty">
                                Farm Owner Donald Farm Happiness
                            </p>
                        </div>
                        <a href="testimonial.html" class="tf-btn-read hover-text-4">
                            Read About Donald Christoper
                        </a>
                    </div>
                    <div class="icon tf-animate__box-2 animate__slow">
                        <i class="icon-quote "></i>
                    </div>
                </div>
            </div>
        </section><!-- /.Section testimonial -->

        <!-- Section meet farmer -->
        <section class="s-meet-farm">
            <div class="tf-container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="heading-section text-center has-text mb-81">
                            <p class="sub-title">Meet The Farmers </p>
                            <p class="title text-anime-style-2">
                                People Who Are Dedicated <br>
                                To Their Work And Love Nature

                            </p>
                            <p class="text">
                                Duis eleifend euismod arcu, nec faucibus mauris finibus id. Integer mattis, tellus
                                non finibus rutrum.
                            </p>
                            <div class="img-item">
                                <img class="tf-animate-1" src="{{ asset('assets/images/item/rice-plant-2.png') }}"
                                    alt="" />
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="box-farmer img-hover pb-30 wow fadeInUp" data-wow-delay="0s">
                            <div class="image hover-item">
                                <img src="{{ asset('assets/images/widget/farmer-1.jpg') }}"
                                    data-src="{{ asset('assets/images/widget/farmer-1.jpg') }}" alt=""
                                    class="lazyload">
                            </div>
                            <div class="content">
                                <div class="author-wrap">
                                    <div class="has-border">
                                        <a href="#" class="name fw-7 fs-23 hover-text-4 font-worksans">
                                            James Benjamin
                                        </a>
                                        <p class="duty">
                                            Crop Specialist
                                        </p>
                                    </div>
                                </div>
                                <p class="text font-nunito">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sodales
                                    faucibusrum ex libero
                                    sodales ex, cursus.
                                </p>
                                <div class="wg-social style-2">
                                    <ul class="list">
                                        <li><a href="#"><i class="icon-facebook1"></i></a></li>
                                        <li><a href="#"><i class="icon-twitter"></i></a></li>
                                        <li><a href="#"><i class="icon-instagram2"></i></a></li>
                                        <li><a href="#"><i class="fa-brands fa-skype"></i></a></li>
                                        <li><a href="#"><i class="fa-brands fa-telegram"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="say-hi">
                                <div class="img-item">
                                    <img src="{{ asset('assets/images/item/say-hi.png') }}" alt="">
                                    <p class="font-worksans fw-6 fs-30">Say Hi!</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="box-farmer img-hover pb-30 wow fadeInUp" data-wow-delay="0.1s">
                            <div class="image hover-item">
                                <img src="{{ asset('assets/images/widget/farmer-2.jpg') }}"
                                    data-src="{{ asset('assets/images/widget/farmer-2.jpg') }}" alt=""
                                    class="lazyload">
                            </div>
                            <div class="content">
                                <div class="author-wrap">
                                    <div class="has-border">
                                        <a href="#" class="name fw-7 fs-23 hover-text-4 font-worksans">
                                            Alexander Ethan
                                        </a>
                                        <p class="duty">
                                            Crop Specialist
                                        </p>
                                    </div>
                                </div>
                                <p class="text font-nunito">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sodales
                                    faucibusrum ex libero
                                    sodales ex, cursus.
                                </p>
                                <div class="wg-social style-2">
                                    <ul class="list">
                                        <li><a href="#"><i class="icon-facebook1"></i></a></li>
                                        <li><a href="#"><i class="icon-twitter"></i></a></li>
                                        <li><a href="#"><i class="icon-instagram2"></i></a></li>
                                        <li><a href="#"><i class="fa-brands fa-skype"></i></a></li>
                                        <li><a href="#"><i class="fa-brands fa-telegram"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="say-hi">
                                <div class="img-item">
                                    <img src="{{ asset('assets/images/item/say-hi.png') }}" alt="">
                                    <p class="font-worksans fw-6 fs-30">Say Hi!</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="box-farmer img-hover  wow fadeInUp" data-wow-delay="0.2s">
                            <div class="image hover-item">
                                <img src="{{ asset('assets/images/widget/farmer-3.jpg') }}"
                                    data-src="{{ asset('assets/images/widget/farmer-3.jpg') }}" alt=""
                                    class="lazyload">
                            </div>
                            <div class="content">
                                <div class="author-wrap">
                                    <div class="has-border">
                                        <a href="#" class="name fw-7 fs-23 hover-text-4 font-worksans">
                                            Isabella Camila
                                        </a>
                                        <p class="duty">
                                            Crop Specialist
                                        </p>
                                    </div>
                                </div>
                                <p class="text font-nunito">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sodales
                                    faucibusrum ex libero
                                    sodales ex, cursus.
                                </p>
                                <div class="wg-social style-2">
                                    <ul class="list">
                                        <li><a href="#"><i class="icon-facebook1"></i></a></li>
                                        <li><a href="#"><i class="icon-twitter"></i></a></li>
                                        <li><a href="#"><i class="icon-instagram2"></i></a></li>
                                        <li><a href="#"><i class="fa-brands fa-skype"></i></a></li>
                                        <li><a href="#"><i class="fa-brands fa-telegram"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="say-hi">
                                <div class="img-item">
                                    <img src="{{ asset('assets/images/item/say-hi.png') }}" alt="">
                                    <p class="font-worksans fw-6 fs-30">Say Hi!</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- /.Section meet farmer -->

        <!-- Section happy farm -->
        <section class="s-happy-farm-2 &.style-2 has-img-item tf-pt-0">
            <div class="tf-container w-1290">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="content-section">
                            <div class="heading-section style-3 has-text">
                                <div class="top">
                                    <p class="sub-title tf-animate-1">Happy Farming!</p>
                                    <div class="img-item item-2 wow zoomIn">
                                        <div class="tf-heartBeat">

                                            <img src="{{ asset('assets/images/item/happy.png') }}" alt="" />
                                        </div>
                                    </div>
                                </div>
                                <p class="title ">
                                    We Passionately Care About <br>
                                    Farmers, Consumers.


                                </p>
                                <p class="text ">
                                    If you need to buy clean agricultural products and learn about us, contact us
                                    now!
                                </p>

                                <a href="{{ url('contactus') }}" class="tf-btn bg-white scale-40">
                                    <span class="text-style cl-primary text-anime-style-1">
                                        Contact Us Today
                                    </span>
                                    <div class="icon">
                                        <i class="icon-arrow_right"></i>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="s-img-item item-1">
                <img src="{{ asset('assets/images/item/page-title-top.png') }}" alt="">
            </div>
            <div class="s-img-item item-2  tf-animate__rotate-right">
                <img class="up-down-move" src="{{ asset('assets/images/item/leaf-3.png') }}" alt="">
            </div>
        </section><!-- /.Section happy farm -->

    </div><!-- /.Main-content -->
@endsection
