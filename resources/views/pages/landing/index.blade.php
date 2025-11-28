@extends('layouts.landing')

@section('hero')
    <!-- Page-title-home-3 -->
    <div class="page-title-home-3">
        <div class="swiper-container slider-home-3">
            <div class="swiper-wrapper">

                @forelse ($heroSections as $hero)
                    <div class="swiper-slide">
                        <div class="slide-home-3 overflow-hidden">

                            <!-- Image -->
                            <div class="image tf-animate-zoom-in-out">
                                <img src="{{ $hero->image ? asset('uploads/hero/' . $hero->image) : asset('assets/images/page-title/home-3-1.jpg') }}"
                                    data-src="{{ $hero->image ? asset('uploads/hero/' . $hero->image) : asset('assets/images/page-title/home-3-1.jpg') }}"
                                    alt="" class="lazyload">
                            </div>

                            <div class="content-wrap">
                                <div class="content">

                                    <!-- Subtitle -->
                                    <p class="sub-title font-snowfall">
                                        <img src="{{ asset('assets/images/item/leaves-2.png') }}" alt=""
                                            class="tf-trainsition-draw-left access-trainsition">
                                        <span class="tf-fade-top fade-item-1">
                                            {{ $hero->hero_subtitle ?? 'Better Agriculture for Better Future' }}
                                        </span>
                                    </p>

                                    <!-- Title -->
                                    <h1 class="title font-farmhouse tf-fade-right fade-item-2">
                                        {!! nl2br(e($hero->hero_title ?? 'Every Crop Counts, <br> Every Farmer Matters.')) !!}
                                    </h1>

                                    <!-- Line under title -->
                                    <div class="img-item">
                                        <img src="{{ asset('assets/images/item/line-throw-title.png') }}" alt=""
                                            class="tf-trainsition-draw-left access-trainsition">
                                    </div>

                                    <!-- Description -->
                                    <p class="text font-nunito tf-fade-left fade-item-4">
                                        {!! nl2br(
                                            e(
                                                $hero->description ??
                                                    'The paramount doctrine of the economic and technological euphoria of recent <br> decades has been that everything depends on innovation.',
                                            ),
                                        ) !!}
                                    </p>

                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <!-- Fallback if no hero slides exist -->
                    <div class="swiper-slide">
                        <div class="slide-home-3 overflow-hidden">
                            <div class="image tf-animate-zoom-in-out">
                                <img src="{{ asset('assets/images/page-title/home-3-1.jpg') }}"
                                    data-src="{{ asset('assets/images/page-title/home-3-1.jpg') }}" alt=""
                                    class="lazyload">
                            </div>
                            <div class="content-wrap">
                                <div class="content">
                                    <p class="sub-title font-snowfall">
                                        <img src="{{ asset('assets/images/item/leaves-2.png') }}" alt=""
                                            class="tf-trainsition-draw-left access-trainsition">
                                        <span class="tf-fade-top fade-item-1">
                                            Better Agriculture for Better Future
                                        </span>
                                    </p>
                                    <h1 class="title font-farmhouse tf-fade-right fade-item-2">
                                        Every Crop Counts, <br> Every Farmer Matters.
                                    </h1>
                                    <div class="img-item">
                                        <img src="{{ asset('assets/images/item/line-throw-title.png') }}" alt=""
                                            class="tf-trainsition-draw-left access-trainsition">
                                    </div>
                                    <p class="text font-nunito tf-fade-left fade-item-4">
                                        The paramount doctrine of the economic and technological euphoria of recent <br>
                                        decades has been that everything depends on innovation.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforelse

            </div>

            <!-- Slider navigation buttons -->
            <div class="btn-slide-home-3 btn-next"> ... </div>
            <div class="btn-slide-home-3 btn-prev"> ... </div>

        </div>

        <!-- Extra decorative images -->
        <div class="img-item item-2">
            <img src="{{ asset('assets/images/item/rice-plant.png') }}" alt="">
        </div>
        <div class="img-item item-3">
            <img src="{{ asset('assets/images/item/corn.png') }}" alt="">
        </div>
        <div class="img-item item-2">
            <img src="{{ asset('assets/images/item/grass-6.png') }}" alt="">
        </div>
    </div><!-- /.Page-title-home-3 -->
@endsection

@section('content')
    <!-- Section our expertise -->
    @if ($services->where('featured_service', 1)->count() > 0)
        <!-- Section our expertise -->
        <section class="s-our-expertise">
            <div class="heading-section text-center has-text has-img-item mt-0">
                <p class="sub-title">What Is Our Expertise?</p>
                <p class="title text-anime-style-1 overflow-hidden">
                    We Providing The <br> Best Agricultural Services
                </p>
                <p class="text">
                    Duis eleifend euismod arcu, nec faucibus mauris finibus id. Integer mattis, tellus non finibus rutrum.
                </p>
            </div>
            <div class="s-slider">
                <div class="tf-container w-1290">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="swiper-container slider-provide">
                                <div class="swiper-wrapper">
                                    @foreach ($services->where('featured_service', 1) as $service)
                                        <div class="swiper-slide">
                                            <div class="card-provide img-hover">
                                                <div class="has-border">
                                                    <div class="image hover-item"
                                                        style="height:250px; width:65%; overflow:hidden;">
                                                        <img src="{{ $service->image ? asset('uploads/services/' . $service->image) : asset('assets/images/widget/default.jpg') }}"
                                                            alt="{{ $service->service_name }}" class="lazyload"
                                                            style="width:100%; height:100%;">
                                                    </div>
                                                    <a href="{{ url('/services') }}"
                                                        class="title text-upper font-worksans hover-text-secondary">
                                                        {{ $service->service_name }}
                                                    </a>
                                                    <span class="break-line"></span>
                                                    <p class="text" style="white-space: pre-line;">
                                                        {!! nl2br(e($service->description)) !!}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-pagination style-1 pagination-slider-provide"></div>
                <div class="btn-slider-provide style-2 btn-next">
                    <img src="{{ asset('assets/icons/slide-next-2.svg') }}" alt="">
                </div>
                <div class="btn-slider-provide style-2 btn-prev">
                    <img src="{{ asset('assets/icons/slide-prev-2.svg') }}" alt="">
                </div>
            </div>
        </section><!-- /.Section our expertise -->
    @endif
    <!-- /.Section our expertise -->

    <!-- Section shopping today  -->
    <section class="s-shopping">
        <div class="tf-container w-1620">
            <div class="row">
                <div class="col-lg-12">
                    <div class="content-wrap">
                        <div class="content-section">
                            <div class="heading-section style-2 has-text">
                                <div class="img-item">
                                    <div class="item">
                                        <img class="tf-animate-1" src="{{ asset('assets/images/item/rice-plant-2.png') }}"
                                            data-src="{{ asset('assets/images/item/rice-plant-2.png') }}" alt="" />
                                    </div>
                                    <p class="sub-title">
                                        Shopping Today
                                    </p>
                                </div>

                                <p class="title  wow fadeInLeft" data-wow-delay="0s">
                                    We Provide High <br>
                                    Quality Agricultural <br>
                                    Products.
                                </p>
                                <p class="text">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas ex
                                    igula, pulvinar ultrices justo sed, bibendum lobortis nibh. Pellentesque
                                    mattis eros sit amet lorem tristique faucibus.
                                </p>
                            </div>
                            <a href="{{ url('/products') }}" class="tf-btn scale-40">
                                <span class="text-style ">
                                    View All The Shop
                                </span>

                                <div class="icon">
                                    <i class="icon-arrow_right"></i>
                                </div>
                            </a>
                        </div>
                        <div class="s-slider">
                            <div class="swiper-container slider-shopping-card">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <div class="card-product mw-unset style-2 type-2 wow fadeInUp"
                                            data-wow-delay="0s">
                                            <ul class="trendy-list">
                                                <li class="trendy-item ">
                                                    <p class="color-1">Sale!</p>
                                                </li>
                                            </ul>
                                            <div class="image">
                                                <img src="{{ asset('assets/images/item/strawberry.png') }}"
                                                    data-src="{{ asset('assets/images/item/strawberry.png') }}"
                                                    alt="" class=" lazyload">
                                            </div>
                                            <a href="{{ url('/singleproduct') }}"
                                                class="name-product font-worksans hover-text-4">
                                                Organic Strawberries
                                            </a>
                                            <div class="pricing-star">
                                                <div class="price-wrap">
                                                    <span class=" price-1">$6.25</span>
                                                    <span class=" price-2">$5.11</span>
                                                </div>
                                                <div class="wg-rating">
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                </div>
                                            </div>
                                            <div class="product-btn-list">
                                                <a href="#addcart" class="icon shoping" data-bs-toggle="modal">
                                                    <div class="tt-text">
                                                        <p>
                                                            Add to card
                                                        </p>
                                                    </div>
                                                    <i class="fa-solid fa-cart-shopping"></i>
                                                </a>
                                                <a href="#wishlist" class="icon white-list" data-bs-toggle="modal">
                                                    <div class="tt-text">
                                                        <p>
                                                            Add Wishlist
                                                        </p>
                                                    </div>
                                                    <i class="fa-solid fa-heart"></i>
                                                </a>
                                                <a href="#" class="icon view-product">
                                                    <div class="tt-text">
                                                        <p>
                                                            Quick View
                                                        </p>
                                                    </div>
                                                    <i class="fa-solid fa-eye"></i>
                                                </a>
                                                <a href="#" class="icon">
                                                    <div class="tt-text">
                                                        <p>
                                                            Compare
                                                        </p>
                                                    </div>
                                                    <i class="fa-solid fa-repeat"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="card-product mw-unset style-2 type-2 wow fadeInUp"
                                            data-wow-delay="0.1s">
                                            <ul class="trendy-list">
                                                <li class="trendy-item ">
                                                    <p class="color-1">Sale!</p>
                                                </li>
                                            </ul>
                                            <div class="image">
                                                <img src="{{ asset('assets/images/item/eggs.png') }}"
                                                    data-src="{{ asset('assets/images/item/eggs.png') }}" alt=""
                                                    class=" lazyload">
                                            </div>
                                            <a href="{{ url('/singleproduct') }}"
                                                class="name-product font-worksans hover-text-4">
                                                Free-Range Chicken Eggs

                                            </a>
                                            <div class="pricing-star">
                                                <div class="price-wrap">
                                                    <span class=" price-1">$5.25</span>
                                                    <span class=" price-2">$3.00</span>
                                                </div>
                                                <div class="wg-rating">
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                </div>
                                            </div>
                                            <div class="product-btn-list">
                                                <a href="#addcart" class="icon shoping" data-bs-toggle="modal">

                                                    <div class="tt-text">

                                                        <p>
                                                            Add to card
                                                        </p>
                                                    </div>
                                                    <i class="fa-solid fa-cart-shopping"></i>
                                                </a>
                                                <a href="#wishlist" class="icon white-list" data-bs-toggle="modal">
                                                    <div class="tt-text">

                                                        <p>
                                                            Add Whitelist
                                                        </p>
                                                    </div>
                                                    <i class="fa-solid fa-heart"></i>
                                                </a>
                                                <a href="#" class="icon view-product">
                                                    <div class="tt-text">

                                                        <p>
                                                            Quick View
                                                        </p>
                                                    </div>
                                                    <i class="fa-solid fa-eye"></i>
                                                </a>
                                                <a href="#" class="icon">
                                                    <div class="tt-text">

                                                        <p>
                                                            Compare
                                                        </p>
                                                    </div>
                                                    <i class="fa-solid fa-repeat"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="btn-slide-wrap">
                            <div class="btn-prev btn-slider-shopping">
                                <svg version="1.0" xmlns="http://www.w3.org/2000/svg" width="68px" height="18px"
                                    viewBox="0 0 68 18" preserveAspectRatio="xMidYMid meet">

                                    <g fill="#0d401c">
                                        <path
                                            d="M6.3 14.3 c-3.5 -2.1 -6.3 -4.2 -6.3 -4.9 0 -0.6 2.7 -3 6 -5.3 6.4 -4.5 8.3 -4.1 2.6 0.6 l-3.5 2.8 24.7 0 c23.6 0 38.2 0.9 38.2 2.3 0 0.4 -7.3 0.3 -16.3 -0.1 -9 -0.5 -23.3 -0.5 -31.8 0 l-15.4 0.8 5.3 2.9 c5 2.8 6.6 4.6 4 4.6 -0.7 0 -4.1 -1.7 -7.5 -3.7z" />
                                    </g>
                                </svg>
                            </div>
                            <div class="btn-next btn-slider-shopping">
                                <svg version="1.0" xmlns="http://www.w3.org/2000/svg" width="68px" height="18px"
                                    viewBox="0 0 80 20" preserveAspectRatio="xMidYMid meet">
                                    <g fill="#0d401c">
                                        <path
                                            d="M63 19 c0 -0.5 2.6 -2.4 5.8 -4.2 l5.7 -3.3 -19.5 -0.8 c-11 -0.5 -27.1 -0.5 -37 0.1 -9.6 0.5 -17.7 0.7 -17.9 0.5 -2.4 -1.9 22 -3.5 48.7 -3.1 l25.2 0.3 -4.6 -3.9 c-2.5 -2.1 -4.3 -4 -4 -4.3 0.7 -0.7 14.6 8.9 14.6 10.2 0 1.1 -14.3 9.5 -16.2 9.5 -0.4 0 -0.8 -0.4 -0.8 -1z" />
                                    </g>
                                </svg>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        {{-- <div class="s-img-item item-1">
            <img src="{{ asset('assets/images/item/page-title-top.png') }}"alt="">
        </div> --}}
        {{-- <div class="s-img-item item-2 wow zoomIn">
            <div class="nhapNhap">

                <img src="{{ asset('assets/images/item/house-mountain-3.png') }}" alt="">
            </div>
        </div> --}}
    </section><!-- /.Section shopping today  -->

    <!-- Section testimonial -->
    <section class="s-testimonial style-2">
        @php
            $ceo = $teams->where('is_ceo', 1)->first();
        @endphp

        @if ($ceo)
            {{-- CEO exists, show CEO data --}}
            <div class="wrap">
                <div class="image wow fadeInLeft" data-wow-delay="0s">
                    <div class="scroll-element-2">
                        @if ($ceo->image)
                            <img src="{{ asset('uploads/teams/' . $ceo->image) }}" alt="{{ $ceo->name }}" />
                        @else
                            <img src="{{ asset('assets/images/item/s-testi.png') }}" alt="" />
                        @endif
                    </div>
                </div>
                <div class="content-section">
                    <div class="heading-section has-text mb-35">
                        <p class="sub-title">Meet The Farmer</p>
                        <p class="title mb-18 text-anime-style-1">
                            {{ $ceo->designation ?? 'We Are Dedicated Farmers' }}
                        </p>
                        <p class="quote font-snowfall fs-30">
                            {{ $ceo->description ?? 'Agriculture is our wisest pursuit, because it will in the end contribute most to real wealth, good morals, and happiness. Farmers are the embodiment of hard work, dedication, and resilience.' }}
                        </p>
                        <div class="img-item">
                            <img class="tf-animate-1" src="{{ asset('assets/images/item/rice-plant-2.png') }}"
                                alt="" />
                        </div>
                    </div>
                    <div class="bot">
                        <div class="author-wrap">
                            <p class="author text-upper fw-6 font-worksans">
                                <a href="#" target="_blank">{{ $ceo->name }}</a> - Talk
                            </p>
                            <p class="duty">
                                {{ $ceo->designation }} CEO
                            </p>
                        </div>
                        <a href="{{ url('/teams') }}" class="tf-btn scale-40">
                            <span class="text-style">View All The Teams</span>
                            <div class="icon">
                                <i class="icon-arrow_right"></i>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        @else
            {{-- CEO not found, show default/static data --}}
            <div class="wrap">
                <div class="image wow fadeInLeft" data-wow-delay="0s">
                    <div class="scroll-element-2">
                        <img src="{{ asset('assets/images/item/s-testi.png') }}" alt="" />
                    </div>
                </div>
                <div class="content-section">
                    <div class="heading-section has-text mb-35">
                        <p class="sub-title">Meet The Farmer</p>
                        <p class="title mb-18 text-anime-style-1">We Are Dedicated Farmers</p>
                        <p class="quote font-snowfall fs-30">
                            Agriculture is our wisest pursuit, because it will in the end contribute most to real wealth,
                            good morals, and happiness. Farmers are the embodiment of hard work, dedication, and resilience.
                        </p>
                        <div class="img-item">
                            <img class="tf-animate-1" src="{{ asset('assets/images/item/rice-plant-2.png') }}"
                                alt="" />
                        </div>
                    </div>
                    <div class="bot">
                        <div class="author-wrap">
                            <p class="author text-upper fw-6 font-worksans">
                                <a href="#" target="_blank">Donald Christopher</a> - Talk
                            </p>
                            <p class="duty">Farm Owner Donald Farm Happiness</p>
                        </div>
                        <a href="{{ url('/teams') }}" class="tf-btn scale-40">
                            <span class="text-style">View All The Farmers</span>
                            <div class="icon">
                                <i class="icon-arrow_right"></i>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        @endif
    </section>



    <!-- Section testimonial 3 -->
    <section class="s-testimonial-3 overflow-hidden">
        <div class="tf-container w-1290">
            <div class="row">
                <div class="col-lg-12">
                    <div class="heading-section text-center has-text relative">
                        <p class="sub-title ">Testimonials From People Who Have
                            Experienced It
                            <i class="icon-quote tf-animate__box-2 "></i>

                        </p>
                        <p class="title wow fadeInUp" data-wow-delay="0s">What Customers Says?
                        </p>
                        <p class="text">
                            Duis eleifend euismod arcu, nec faucibus mauris finibus id. Integer mattis, tellus non
                            finibus rutrum.

                        </p>
                        <div class="img-item">
                            <img class="tf-animate-1" src="{{ asset('assets/images/item/rice-plant-2.png') }}"
                                alt="" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="s-slider">
            <div class="tf-container w-1290">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="testimonial-thumbs">
                            <div class="swiper-container slider-testimonial-3-thumb">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <div class="image-avt">
                                            <img src="{{ asset('assets/images/section/customer-say-3.jpg') }}"
                                                alt="">
                                        </div>


                                    </div>
                                    <div class="swiper-slide">
                                        <div class="image-avt">
                                            <img src="{{ asset('assets/images/widget/author-comment.jpg') }}"
                                                alt="">
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="image-avt">
                                            <img src="{{ asset('assets/images/section/customer-say-4.jpg') }}"
                                                alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-container slider-testimonial-3">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <div class="testimonial style-3">

                                            <div class="comment">
                                                <p class="caption fs-30 font-snowfall">
                                                    Having been a host farmer for three seasons, we’ve seen
                                                    firsthand
                                                    the difference this
                                                    internship makes in beginning <br>
                                                    farmers and host farms alike. As a farmer it is difficult to
                                                    weigh
                                                    the benefits of
                                                    hosting young farmers. Fresh energy <br>
                                                    and enthusiasm. Mauris id lorem facilisis lectus facilisis
                                                    egestas.
                                                </p>
                                            </div>
                                            <div class="infor">
                                                <div class="name-wrap">
                                                    <a href="#" class="name fs-18 fw-6 text-upper hover-text-4">
                                                        CHRISTINE Rose
                                                    </a>
                                                    <div class="wg-rating">
                                                        <i class="fa-solid fa-star"></i>
                                                        <i class="fa-solid fa-star"></i>
                                                        <i class="fa-solid fa-star"></i>
                                                        <i class="fa-solid fa-star"></i>
                                                        <i class="fa-solid fa-star"></i>
                                                    </div>
                                                </div>
                                                <p class="duty">
                                                    Director, Radical Orange Pty Ltd.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="testimonial style-3">

                                            <div class="comment">
                                                <p class="caption fs-30 font-snowfall">
                                                    Having been a host farmer for three seasons, we’ve seen
                                                    firsthand
                                                    the difference this
                                                    internship makes in beginning
                                                    farmers and host farms alike. As a farmer it is difficult to
                                                    weigh
                                                    the benefits of
                                                    hosting young farmers. Fresh energy
                                                    and enthusiasm. Mauris id lorem facilisis lectus facilisis
                                                    egestas.
                                                </p>
                                            </div>
                                            <div class="infor">
                                                <div class="name-wrap">
                                                    <a href="#" class="name fs-18 fw-6 text-upper hover-text-4">
                                                        CHRISTINE Rose
                                                    </a>
                                                    <div class="wg-rating">
                                                        <i class="fa-solid fa-star"></i>
                                                        <i class="fa-solid fa-star"></i>
                                                        <i class="fa-solid fa-star"></i>
                                                        <i class="fa-solid fa-star"></i>
                                                        <i class="fa-solid fa-star"></i>
                                                    </div>
                                                </div>
                                                <p class="duty">
                                                    Director, Radical Orange Pty Ltd.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="testimonial style-3">

                                            <div class="comment">
                                                <p class="caption fs-30 font-snowfall">
                                                    Having been a host farmer for three seasons, we’ve seen
                                                    firsthand
                                                    the difference this
                                                    internship makes in beginning
                                                    farmers and host farms alike. As a farmer it is difficult to
                                                    weigh
                                                    the benefits of
                                                    hosting young farmers. Fresh energy
                                                    and enthusiasm. Mauris id lorem facilisis lectus facilisis
                                                    egestas.
                                                </p>
                                            </div>
                                            <div class="infor">
                                                <div class="name-wrap">
                                                    <a href="#" class="name fs-18 fw-6 text-upper hover-text-4">
                                                        CHRISTINE Rose
                                                    </a>
                                                    <div class="wg-rating">
                                                        <i class="fa-solid fa-star"></i>
                                                        <i class="fa-solid fa-star"></i>
                                                        <i class="fa-solid fa-star"></i>
                                                        <i class="fa-solid fa-star"></i>
                                                        <i class="fa-solid fa-star"></i>
                                                    </div>
                                                </div>
                                                <p class="duty">
                                                    Director, Radical Orange Pty Ltd.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="btn-slide-testimonial-3 btn-prev">
                <svg version="1.0" xmlns="http://www.w3.org/2000/svg" width="50px" height="15px"
                    viewBox="0 0 68 18" preserveAspectRatio="xMidYMid meet">
                    <g fill="#0d401c">
                        <path
                            d="M6.3 14.3 c-3.5 -2.1 -6.3 -4.2 -6.3 -4.9 0 -0.6 2.7 -3 6 -5.3 6.4 -4.5 8.3 -4.1 2.6 0.6 l-3.5 2.8 24.7 0 c23.6 0 38.2 0.9 38.2 2.3 0 0.4 -7.3 0.3 -16.3 -0.1 -9 -0.5 -23.3 -0.5 -31.8 0 l-15.4 0.8 5.3 2.9 c5 2.8 6.6 4.6 4 4.6 -0.7 0 -4.1 -1.7 -7.5 -3.7z" />
                    </g>
                </svg>
            </div>
            <div class="btn-slide-testimonial-3 btn-next">
                <svg version="1.0" xmlns="http://www.w3.org/2000/svg" width="50px" height="15px"
                    viewBox="0 0 80 20" preserveAspectRatio="xMidYMid meet">
                    <g fill="#0d401c">
                        <path
                            d="M63 19 c0 -0.5 2.6 -2.4 5.8 -4.2 l5.7 -3.3 -19.5 -0.8 c-11 -0.5 -27.1 -0.5 -37 0.1 -9.6 0.5 -17.7 0.7 -17.9 0.5 -2.4 -1.9 22 -3.5 48.7 -3.1 l25.2 0.3 -4.6 -3.9 c-2.5 -2.1 -4.3 -4 -4 -4.3 0.7 -0.7 14.6 8.9 14.6 10.2 0 1.1 -14.3 9.5 -16.2 9.5 -0.4 0 -0.8 -0.4 -0.8 -1z" />
                    </g>
                </svg>
            </div>
        </div>
        {{-- <div class="s-img-item scroll-element-3">
            <img class="scale-1-1 lazyload" src="./images/section/yellow-f.png"
                data-src="{{ asset('assets/images/section/yellow-f.png') }}" alt="">
        </div> --}}
    </section><!-- /.Section testimonial 3 -->

    <!-- Section faq -->
    <section class="s-faq has-img-item tf-pt-0">
        <div class="tf-container w-1290">
            <div class="row">
                <div class="col-lg-7">
                    <div class="content-section">

                        <div class="heading-section style-2 has-text mb-43">
                            <div class="img-item">
                                <div class="item mr-16">
                                    <img class="tf-animate-1" src="{{ asset('assets/images/item/rice-plant-2.png') }}"
                                        alt="" />
                                </div>
                                <p class="sub-title">
                                    Frequently Asked Questions
                                </p>
                            </div>

                            <p class="title wow fadeInUp" data-wow-delay="0s">
                                Most Frequently Asked Questions About The Farm.
                            </p>
                            <p class="text">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sodales faucibus.
                            </p>
                        </div>

                        <div class="tf-accordion accordion" id="accordionExample">

                            {{-- ******************** --}}
                            {{-- If FAQs exist → show dynamic --}}
                            {{-- Else → show static default --}}
                            {{-- ******************** --}}

                            @if (isset($faqs) && count($faqs) > 0)
                                @foreach ($faqs as $index => $faq)
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button {{ $index == 0 ? '' : 'collapsed' }}"
                                                type="button" data-bs-toggle="collapse"
                                                data-bs-target="#faq{{ $faq->id }}"
                                                aria-expanded="{{ $index == 0 ? 'true' : 'false' }}"
                                                aria-controls="faq{{ $faq->id }}">
                                                {{ $faq->title }}
                                            </button>
                                        </h2>

                                        <div id="faq{{ $faq->id }}"
                                            class="accordion-collapse collapse {{ $index == 0 ? 'show' : '' }}"
                                            data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                {{ $faq->content }}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                {{-- ******** STATIC DEFAULT TEMPLATE ******** --}}

                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseOne" aria-expanded="true"
                                            aria-controls="collapseOne">
                                            What proof do you need for Carer’s tickets?
                                        </button>
                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse show"
                                        data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            Under 2’s are free and need a ticket...
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false"
                                            aria-controls="collapseTwo">
                                            Do I have to pay extra for the shows?
                                        </button>
                                    </h2>
                                    <div id="collapseTwo" class="accordion-collapse collapse"
                                        data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            Under 2’s are free and need a ticket...
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseThree"
                                            aria-expanded="false" aria-controls="collapseThree">
                                            Can I bring my team or friends?
                                        </button>
                                    </h2>
                                    <div id="collapseThree" class="accordion-collapse collapse"
                                        data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            Under 2’s are free and need a ticket...
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseFour"
                                            aria-expanded="false" aria-controls="collapseFour">
                                            Can I join the farm as a permanent member?
                                        </button>
                                    </h2>
                                    <div id="collapseFour" class="accordion-collapse collapse"
                                        data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            Under 2’s are free and need a ticket...
                                        </div>
                                    </div>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="s-right img-hover">
                        <div class="image-wrap hover-item">
                            <div class="image">
                                <img src="{{ asset('assets/images/section/s-faq.jpg') }}"
                                    data-src="{{ asset('assets/images/section/s-faq.jpg') }}" alt=""
                                    class="lazyload tf-animate-2" />
                            </div>
                        </div>

                        <div class="img-item tf-animate__box-2">
                            <img class="up-down-move" src="{{ asset('assets/images/item/question.png') }}"
                                alt="" />
                        </div>

                        <div class="content">
                            <p class="text fs-30 font-snowfall">
                                You didn't find your question? See more questions and ask us today!
                            </p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section contact us -->
    <section class="s-contact-us has-img-item">
        <div class="section-wrap">
            <div class="tf-container w-1290">
                <div class="row">
                    <div class="col-lg-5">
                        <div class="content-left">
                            <div class="image mb-30 mh-unset">
                                <img src="{{ asset('assets/images/section/s-contact.jpg') }}"
                                    alt="{{ asset('assets/images/section/s-contact.jpg') }}" class="lazyload" />
                                <img src="{{ asset('assets/images/item/leaf.png') }}"
                                    alt="{{ asset('assets/images/item/leaf.png') }}"
                                    class="img-item tf-animate__rotate-left" />
                            </div>
                            <ul class="contact-list">
                                <li class="wow fadeInUp" data-wow-duration="1.4s">
                                    <div class="icon style-circle">
                                        <i class="fa-solid fa-location-dot"></i>
                                    </div>
                                    <div class="infor">
                                        <p class="title">
                                            Farm Address
                                        </p>
                                        <p class="text">
                                            Prinsengracht 250, 2501016 PM <br>
                                            Amsterdam Netherlands
                                        </p>
                                    </div>
                                </li>
                                <li class="wow fadeInUp" data-wow-duration="1.4s">
                                    <div class="icon style-circle">
                                        <i class="fa-solid fa-address-book"></i>
                                    </div>
                                    <div class="infor">
                                        <p class="title">
                                            Contact Us
                                        </p>
                                        <p class="text">
                                            Donalfarms@gmail.com <br>
                                            Call Us 24/7: +1 987 654 3210
                                        </p>
                                    </div>
                                </li>
                                <li class="wow fadeInUp" data-wow-duration="1.4s">
                                    <div class="icon style-circle">
                                        <i class="fa-solid fa-clock"></i>
                                    </div>
                                    <div class="infor">

                                        <p class="title">
                                            Working Hours
                                        </p>
                                        <p class="text">
                                            Mon - Fri: 8.00am - 18.00pm <br>
                                            Sat: 9.00am - 17.00pm Holidays: Closes
                                        </p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="content-section">
                            <div class="heading-section mb-50 style-3 has-text">
                                <p class="sub-title">Let's Cooperate Together</p>
                                <p class="title tf-animate-1 transition-1s">
                                    Contact Us Today!
                                </p>
                                <p class="text">
                                    We will reply you within 24 hours via email, thank you for contacting
                                </p>
                                <div class="img-item">
                                    <img class="tf-animate-1" src="{{ asset('assets/images/item/rice-plant-2.png') }}"
                                        alt="" />
                                </div>
                            </div>
                            <form id="contactform" method="post" action="./contact/contact-process.php"
                                novalidate="novalidate" class="form-send-message">
                                <div class="cols style-2 mb-15">
                                    <fieldset>
                                        <input type="text" class="form-control" id="name" name="name"
                                            placeholder="Enter a Full Name*" aria-required="true" required
                                            class="name" />
                                    </fieldset>

                                </div>
                                <div class="cols style-2 mb-15">
                                    <fieldset>
                                        <input type="email" class="form-control email" id="mail" name="mail"
                                            placeholder="Enter a Email*" required />
                                    </fieldset>
                                    <fieldset>
                                        <input type="text" class="form-control" id="phone" name="phone"
                                            placeholder="Enter a Phone*" aria-required="true" required />
                                    </fieldset>
                                    {{-- <fieldset class="dropdown">
                                        <select name="text" id="Support">
                                            <option value="You need support?" selected="">You need suport?
                                            </option>
                                            <option value="You need support? 1">You need suport? 1
                                            </option>
                                            <option value="You need support? 2">You need suport? 2
                                            </option>
                                            <option value="You need support? 3">You need suport? 3
                                            </option>
                                        </select>
                                    </fieldset> --}}
                                </div>
                                <div class="cols mb-30">
                                    <fieldset>
                                        <textarea name="message" id="message" placeholder="Enter a Message..."></textarea>
                                    </fieldset>
                                </div>
                                <div class="checkbox-item send-wrap">
                                    <label class="mb-0">
                                        <span class="text font-nunito">Agree to our terms and
                                            conditions</span>
                                        <input type="checkbox" class="checkbox-item" checked>
                                        <span class="btn-checkbox"></span>
                                    </label>
                                    <button type="submit" class="tf-btn bg-white">
                                        <span class="text-style cl-primary">
                                            Send Message
                                        </span>
                                        <span class="icon">
                                            <i class="icon-arrow_right"></i>
                                        </span>
                                    </button>
                                </div>
                            </form>
                            <div class="img-item item-1 up-down-move">
                                <img src="{{ asset('assets/images/item/rice-plant-2.png') }}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="s-img-item item-1">
            <img src="{{ asset('assets/images/item/page-title-top.png') }}" alt="" />
        </div>
    </section><!-- /.Section contact us -->

    <!-- Section partner -->
    <section class="s-partner pb-100">
        <div class="tf-container w-1780">
            <div class="row">
                <div class="col-lg-12">
                    <div class="slider-wrap">
                        <div class="swiper-container slider-partner">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <div class="slide-partner">
                                        <div class="image">
                                            <a href="#">

                                                <img src="{{ asset('assets/images/partner/wide-open.png') }}"
                                                    alt="" class="lazyload">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="slide-partner">

                                        <div class="image">
                                            <a href="#">
                                                <img src="{{ asset('assets/images/partner/sollio.png') }}" alt=""
                                                    class="lazyload">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="slide-partner">
                                        <div class="image">
                                            <a href="#">

                                                <img src="{{ asset('assets/images/partner/syngenta.png') }}"
                                                    alt="" class="lazyload">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="slide-partner">

                                        <div class="image">
                                            <a href="#">

                                                <img src="{{ asset('assets/images/partner/strachan-valley.png') }}"
                                                    alt="" class="lazyload">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="slide-partner">


                                        <div class="image">
                                            <a href="#">
                                                <img src="{{ asset('assets/images/partner/new-holland.png') }}"
                                                    alt="" class="lazyload">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="slide-partner">

                                        <div class="image">
                                            <a href="#">
                                                <img src="{{ asset('assets/images/partner/stony-field.png') }}"
                                                    alt="" class="lazyload">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- /.Section partner -->
@endsection
