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
                                                        <img src="{{ $service->image ? asset('uploads/services/' . $service->image) : asset('assets/images/widget/commitment.jpg') }}"
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

    @if ($products->count() > 0)
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
                                            <img class="tf-animate-1"
                                                src="{{ asset('assets/images/item/rice-plant-2.png') }}"
                                                data-src="{{ asset('assets/images/item/rice-plant-2.png') }}"
                                                alt="" />
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

                                        @foreach ($products as $product)
                                            <div class="swiper-slide">
                                                <div class="card-product mw-unset style-2 type-2 wow fadeInUp"
                                                    data-wow-delay="0.1s">

                                                    {{-- Sale Badge (optional) --}}
                                                    @if ($product->sale_price)
                                                        <ul class="trendy-list">
                                                            <li class="trendy-item">
                                                                <p class="color-1">Sale!</p>
                                                            </li>
                                                        </ul>
                                                    @endif

                                                    {{-- Image --}}
                                                    <div class="image">
                                                        <img src="{{ $product->images->first()
                                                            ? asset('storage/' . $product->images->first()->image)
                                                            : asset('assets/images/item/eggs.png') }}"
                                                            data-src="{{ $product->images->first()
                                                                ? asset('storage/' . $product->images->first()->image)
                                                                : asset('assets/images/item/eggs.png') }}"
                                                            alt="" class="lazyload">
                                                    </div>

                                                    {{-- Product Name --}}
                                                    <a href="{{ route('products.show', $product->slug) }}"
                                                        class="name-product font-worksans hover-text-4">
                                                        {{ $product->name }}
                                                    </a>

                                                    {{-- Price --}}
                                                    <div class="pricing-star">
                                                        <div class="price-wrap">

                                                            @if ($product->sale_price)
                                                                <span class="price-1">PKR {{ $product->price }}</span>
                                                                <span class="price-2">PKR
                                                                    {{ $product->sale_price }}</span>
                                                            @else
                                                                <span class="price-2">PKR {{ $product->price }}</span>
                                                            @endif

                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        @endforeach

                                    </div>

                                </div>
                            </div>
                            <div class="btn-slide-wrap">
                                <div class="btn-prev btn-slider-shopping">
                                    <!-- SVG code -->
                                </div>
                                <div class="btn-next btn-slider-shopping">
                                    <!-- SVG code -->
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section><!-- /.Section shopping today  -->
    @endif
    
    <!-- Section testimonial -->
    @php
        $ceo = $teams->where('is_ceo', 1)->first();
    @endphp

    @if ($ceo)
        <section class="s-testimonial style-2">
            <div class="wrap">
                <div class="image wow fadeInLeft" data-wow-delay="0s">
                    <div class="scroll-element-2">
                        @if ($ceo->image)
                            <img src="{{ asset('uploads/teams/' . $ceo->image) }}" alt="{{ $ceo->name }}"
                                style="height: 10em; left: 50px; width: 55em; object-fit: cover; " />
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
        </section>
    @endif
    {{-- <section class="s-testimonial style-2">
        @php
            $ceo = $teams->where('is_ceo', 1)->first();
        @endphp

        @if ($ceo)
            <div class="wrap">
                <div class="image wow fadeInLeft" data-wow-delay="0s">
                    <div class="scroll-element-2">
                        @if ($ceo->image)
                            <img src="{{ asset('uploads/teams/' . $ceo->image) }}" alt="{{ $ceo->name }}"
                                style="height: 10em; left: 50px; width: 55em;" />
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
                            <span class="text-style">View All The Teams</span>
                            <div class="icon">
                                <i class="icon-arrow_right"></i>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        @endif
    </section> --}}

    <!-- Section testimonial 3 -->
    @if ($testimonials->count())
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
                                        {{-- Dynamic Thumbs --}}
                                        @foreach ($testimonials as $t)
                                            <div class="swiper-slide">
                                                <div class="image-avt">
                                                    @if ($t->image)
                                                        <img src="{{ asset('storage/' . $t->image) }}" class="rounded">
                                                    @else
                                                        <img src="{{ asset('assets/images/section/customer-say-3.jpg') }}"
                                                            alt="">
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                {{-- Main Slider --}}
                                <div class="swiper-container slider-testimonial-3">
                                    <div class="swiper-wrapper">
                                        {{-- Dynamic Testimonials --}}
                                        @foreach ($testimonials as $t)
                                            <div class="swiper-slide">
                                                <div class="testimonial style-3">

                                                    <div class="comment">
                                                        <p class="caption fs-30 font-snowfall">
                                                            {{ $t->review }}
                                                        </p>
                                                    </div>

                                                    <div class="infor">
                                                        <div class="name-wrap">
                                                            <span class="name fs-18 fw-6 text-upper">
                                                                {{ strtoupper($t->name) }}
                                                            </span>

                                                            <div class="wg-rating">
                                                                @for ($i = 1; $i <= 5; $i++)
                                                                    <i
                                                                        class="fa-solid fa-star {{ $i <= $t->rating ? '' : 'text-muted' }}"></i>
                                                                @endfor
                                                            </div>
                                                        </div>

                                                        <p class="duty">
                                                            {{ $t->design }}{{ $t->company ? ', ' . $t->company : '' }}
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
                </div>
            </div>

            {{-- <div class="s-img-item scroll-element-3">
            <img class="scale-1-1 lazyload" src="./images/section/yellow-f.png"
                data-src="{{ asset('assets/images/section/yellow-f.png') }}" alt="">
        </div> --}}
        </section><!-- /.Section testimonial 3 -->
    @endif
    <!-- Section testimonial 3 -->
    {{-- <section class="s-testimonial-3 overflow-hidden">
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

                                    @if ($testimonials->count())
                                        @foreach ($testimonials as $t)
                                            <div class="swiper-slide">
                                                <div class="image-avt">
                                                    @if ($t->image)
                                                        <img src="{{ asset('storage/' . $t->image) }}" class="rounded">
                                                    @else
                                                        <img src="{{ asset('assets/images/section/customer-say-3.jpg') }}"
                                                            alt="">
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
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
                                    @endif

                                </div>
                            </div>

                            <div class="swiper-container slider-testimonial-3">
                                <div class="swiper-wrapper">

                                    @if ($testimonials->count())
                                        @foreach ($testimonials as $t)
                                            <div class="swiper-slide">
                                                <div class="testimonial style-3">

                                                    <div class="comment">
                                                        <p class="caption fs-30 font-snowfall">
                                                            {{ $t->review }}
                                                        </p>
                                                    </div>

                                                    <div class="infor">
                                                        <div class="name-wrap">
                                                            <span class="name fs-18 fw-6 text-upper">
                                                                {{ strtoupper($t->name) }}
                                                            </span>

                                                            <div class="wg-rating">
                                                                @for ($i = 1; $i <= 5; $i++)
                                                                    <i
                                                                        class="fa-solid fa-star {{ $i <= $t->rating ? '' : 'text-muted' }}"></i>
                                                                @endfor
                                                            </div>
                                                        </div>

                                                        <p class="duty">
                                                            {{ $t->design }}{{ $t->company ? ', ' . $t->company : '' }}
                                                        </p>
                                                    </div>

                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        @for ($i = 0; $i < 3; $i++)
                                            <div class="swiper-slide">
                                                <div class="testimonial style-3">

                                                    <div class="comment">
                                                        <p class="caption fs-30 font-snowfall">
                                                            Having been a host farmer for three seasons, we’ve seen
                                                            firsthand
                                                            the difference this internship makes...
                                                        </p>
                                                    </div>

                                                    <div class="infor">
                                                        <div class="name-wrap">
                                                            <span class="name fs-18 fw-6 text-upper">
                                                                CHRISTINE ROSE
                                                            </span>
                                                            <div class="wg-rating">
                                                                <i class="fa-solid fa-star"></i>
                                                                <i class="fa-solid fa-star"></i>
                                                                <i class="fa-solid fa-star"></i>
                                                                <i class="fa-solid fa-star"></i>
                                                                <i class="fa-solid fa-star"></i>
                                                            </div>
                                                        </div>
                                                        <p class="duty">Director, Radical Orange Pty Ltd.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endfor
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}

    <!-- Section faq -->
    @if (isset($faqs) && count($faqs) > 0)
        <section class="s-faq has-img-item tf-pt-0">
            <div class="tf-container w-1290">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="content-section">

                            <div class="heading-section style-2 has-text mb-43">
                                <div class="img-item">
                                    <div class="item mr-16">
                                        <img class="tf-animate-1"
                                            src="{{ asset('assets/images/item/rice-plant-2.png') }}" alt="" />
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
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-5">
                        <div class="s-right img-hover">
                            <div class="image-wrap hover-item">
                                <div class="image">
                                    <img src="{{ asset('assets/images/item/fas.jpg') }}"
                                        data-src="{{ asset('assets/images/item/fas.jpg') }}" alt=""
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
    @endif
    {{-- <section class="s-faq has-img-item tf-pt-0">
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
                                <img src="{{ asset('assets/images/item/fas.jpg') }}"
                                    data-src="{{ asset('assets/images/item/fas.jpg') }}" alt=""
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
    </section> --}}

    <!-- Section contact us -->
    <section class="s-contact-us has-img-item">
        <div class="section-wrap">
            <div class="tf-container w-1290">
                <div class="row">
                    <div class="col-lg-5">
                        <div class="content-left">
                            <div class="image mb-30 mh-unset">
                                <iframe src="https://www.google.com/maps?q=33.5261858,73.1330973&hl=en&z=18&output=embed"
                                    width="520" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                                    referrerpolicy="no-referrer-when-downgrade"></iframe>
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
                                        @if ($variables->isNotEmpty())
                                            <p class="text">
                                                {{ $variables->first()->map }}
                                            </p>
                                        @else
                                            <p class="text">
                                                N/A
                                            </p>
                                        @endif
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
                                        @if ($variables->isNotEmpty())
                                            <p class="text">
                                                {{ $variables->first()->email }} <br>
                                                Call Us 24/7: {{ $variables->first()->phone }}
                                            </p>
                                        @else
                                            <p class="text">
                                                N/A
                                            </p>
                                        @endif
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
                                        @if ($variables->isNotEmpty())
                                            <p class="text">
                                                Mon - Fri: {{ $variables->first()->working_hours }}
                                                {{-- <br> Sat: {{ $variables->first()->working_hours}} Holidays: Closes --}}
                                            </p>
                                        @else
                                            N/A
                                        @endif
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

                                <!-- Success Message (Initially Hidden) -->
                                <div id="msg" class="success-message-box" style="display: none;">
                                    <div class="success-content">
                                        <div class="success-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                                <polyline points="22 4 12 14.01 9 11.01"></polyline>
                                            </svg>
                                        </div>
                                        <div>
                                            <strong>Message Sent Successfully!</strong>
                                            <p>We will reply you within 24 hours via email, thank you for contacting</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Error Message (Initially Hidden) -->
                                <div id="error-msg" class="error-message-box" style="display: none;">
                                    <div class="error-content">
                                        <div class="error-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <circle cx="12" cy="12" r="10"></circle>
                                                <line x1="12" y1="8" x2="12" y2="12">
                                                </line>
                                                <line x1="12" y1="16" x2="12.01" y2="16">
                                                </line>
                                            </svg>
                                        </div>
                                        <div>
                                            <strong>Error!</strong>
                                            <p>Something went wrong. Please try again.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="img-item">
                                    <img class="tf-animate-1" src="{{ asset('assets/images/item/rice-plant-2.png') }}"
                                        alt="" />
                                </div>
                            </div>

                            <form id="contactform" method="post" action="{{ url('/contact-submit') }}"
                                novalidate="novalidate" class="form-send-message">
                                @csrf

                                <div class="cols style-2 mb-15">
                                    <fieldset>
                                        <input type="text" class="form-control" id="full_name" name="name"
                                            placeholder="Enter Full Name *" required />
                                    </fieldset>

                                    <fieldset>
                                        <input type="text" class="form-control" id="subject" name="subject"
                                            placeholder="Enter Subject *" required />
                                    </fieldset>
                                </div>

                                <div class="cols style-2 mb-15">
                                    <fieldset>
                                        <input type="email" class="form-control email" id="email" name="email"
                                            placeholder="Enter Email *" required />
                                    </fieldset>

                                    <fieldset>
                                        <input type="text" class="form-control" id="phone" name="phone"
                                            placeholder="Enter Phone *" required />
                                    </fieldset>
                                </div>

                                <div class="cols mb-30">
                                    <fieldset>
                                        <textarea name="message" id="message" placeholder="Enter Message * ....." required></textarea>
                                    </fieldset>
                                </div>

                                <div class="checkbox-item send-wrap">
                                    <label class="mb-0">
                                        <span class="text font-nunito">Agree to our terms and conditions</span>
                                        <input type="checkbox" name="terms" class="checkbox-item" required>
                                        <span class="btn-checkbox"></span>
                                    </label>

                                    <button type="submit" class="tf-btn bg-white" id="submit-btn">
                                        <span class="text-style cl-primary">Send Message</span>
                                        <span class="icon"><i class="icon-arrow_right"></i></span>
                                    </button>
                                </div>

                                <div class="footer-recaptcha mt-5">
                                    <p class="recaptcha-text text-light">
                                        This site is protected by reCAPTCHA and the Google
                                        <a href="https://policies.google.com/privacy" class="text-warning"
                                            target="_blank">
                                            Privacy Policy
                                        </a>
                                        and
                                        <a href="https://policies.google.com/terms" class="text-warning" target="_blank">
                                            Terms of Service
                                        </a>
                                        apply.
                                    </p>
                                </div>

                                <input type="hidden" name="recaptcha_token" id="recaptcha_token">

                                <span class="text-danger" id="recaptcha-error" style="display: none;"></span>
                            </form>

                            <!-- reCAPTCHA v3 Script -->
                            <script src="https://www.google.com/recaptcha/api.js?render={{ config('services.recaptcha.site_key') }}"></script>
                            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

                            <script>
                                document.getElementById('contactform').addEventListener('submit', function(e) {
                                    e.preventDefault(); // Page reload stop

                                    const submitBtn = document.getElementById('submit-btn');
                                    submitBtn.disabled = true; // Button disable during submit
                                    submitBtn.querySelector('.text-style').textContent = 'Sending...';

                                    grecaptcha.ready(function() {
                                        grecaptcha.execute('{{ config('services.recaptcha.site_key') }}', {
                                            action: 'contact_form'
                                        }).then(function(token) {
                                            document.getElementById('recaptcha_token').value = token;

                                            // AJAX Request
                                            const formData = new FormData(document.getElementById('contactform'));

                                            fetch('{{ url('/contact-submit') }}', {
                                                    method: 'POST',
                                                    body: formData,
                                                    headers: {
                                                        'X-Requested-With': 'XMLHttpRequest'
                                                    }
                                                })
                                                .then(response => response.json())
                                                .then(data => {
                                                    if (data.success) {
                                                        // Success message show
                                                        document.getElementById('msg').style.display = 'block';
                                                        document.getElementById('error-msg').style.display = 'none';

                                                        // Form reset 
                                                        document.getElementById('contactform').reset();

                                                        // Smooth scroll to message
                                                        document.getElementById('msg').scrollIntoView({
                                                            behavior: 'smooth',
                                                            block: 'center'
                                                        });

                                                        setTimeout(function() {
                                                            $("#msg").fadeOut(600);
                                                        }, 5000);
                                                    } else {
                                                        // Error message
                                                        const errorBox = document.getElementById('error-msg');
                                                        errorBox.querySelector('p').textContent = data.message ||
                                                            'Something went wrong';
                                                        errorBox.style.display = 'block';
                                                        document.getElementById('msg').style.display = 'none';

                                                        // Smooth scroll to error
                                                        errorBox.scrollIntoView({
                                                            behavior: 'smooth',
                                                            block: 'center'
                                                        });
                                                    }

                                                    // Button enable return
                                                    submitBtn.disabled = false;
                                                    submitBtn.querySelector('.text-style').textContent = 'Send Message';
                                                })
                                                .catch(error => {
                                                    console.error('Error:', error);

                                                    const errorBox = document.getElementById('error-msg');

                                                    // Check if validation errors exist
                                                    if (error.response && error.response.status === 422) {
                                                        const errors = error.response.data.errors;
                                                        let errorMessage = 'Please fix the following errors:\n';
                                                        for (let field in errors) {
                                                            errorMessage += '- ' + errors[field][0] + '\n';
                                                        }
                                                        errorBox.querySelector('p').textContent = errorMessage;
                                                    } else {
                                                        errorBox.querySelector('p').textContent =
                                                            'Network error. Please try again.';
                                                    }

                                                    errorBox.style.display = 'block';

                                                    // Smooth scroll to error
                                                    errorBox.scrollIntoView({
                                                        behavior: 'smooth',
                                                        block: 'center'
                                                    });

                                                    // Button enable return
                                                    submitBtn.disabled = false;
                                                    submitBtn.querySelector('.text-style').textContent = 'Send Message';
                                                });
                                        });
                                    });
                                });
                            </script>

                            <style>
                                .grecaptcha-badge {
                                    visibility: hidden !important;
                                }

                                /* Success Message Styling */
                                .success-message-box {
                                    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                                    border-left: 5px solid #28a745;
                                    padding: 20px 25px;
                                    border-radius: 12px;
                                    margin-bottom: 25px;
                                    box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3);
                                    animation: slideDown 0.5s ease-out;
                                }

                                .success-content {
                                    display: flex;
                                    align-items: center;
                                    gap: 15px;
                                    color: #ffffff;
                                }

                                .success-icon,
                                .error-icon {
                                    background: rgba(255, 255, 255, 0.2);
                                    padding: 10px;
                                    border-radius: 50%;
                                    min-width: 50px;
                                    min-height: 50px;
                                    display: flex;
                                    align-items: center;
                                    justify-content: center;
                                    flex-shrink: 0;
                                }

                                .success-icon svg {
                                    color: #28a745;
                                    stroke: #28a745;
                                }

                                .error-icon svg {
                                    color: #dc3545;
                                    stroke: #dc3545;
                                }

                                .success-content strong {
                                    font-size: 18px;
                                    font-weight: 600;
                                    display: block;
                                    margin-bottom: 5px;
                                }

                                .success-content p {
                                    margin: 0;
                                    font-size: 14px;
                                    opacity: 0.9;
                                    line-height: 1.5;
                                }

                                /* Error Message Styling */
                                .error-message-box {
                                    background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
                                    border-left: 5px solid #dc3545;
                                    padding: 20px 25px;
                                    border-radius: 12px;
                                    margin-bottom: 25px;
                                    box-shadow: 0 8px 20px rgba(245, 87, 108, 0.3);
                                    animation: slideDown 0.5s ease-out;
                                }

                                .error-content {
                                    display: flex;
                                    align-items: center;
                                    gap: 15px;
                                    color: #ffffff;
                                }

                                .error-content strong {
                                    font-size: 18px;
                                    font-weight: 600;
                                    display: block;
                                    margin-bottom: 5px;
                                }

                                .error-content p {
                                    margin: 0;
                                    font-size: 14px;
                                    opacity: 0.9;
                                    line-height: 1.5;
                                }

                                /* Slide Down Animation */
                                @keyframes slideDown {
                                    from {
                                        opacity: 0;
                                        transform: translateY(-20px);
                                    }

                                    to {
                                        opacity: 1;
                                        transform: translateY(0);
                                    }
                                }

                                /* Responsive */
                                @media (max-width: 768px) {

                                    .success-message-box,
                                    .error-message-box {
                                        padding: 15px 20px;
                                    }

                                    .success-content,
                                    .error-content {
                                        gap: 12px;
                                    }

                                    .success-icon,
                                    .error-icon {
                                        min-width: 40px;
                                        min-height: 40px;
                                        padding: 8px;
                                    }

                                    .success-icon svg,
                                    .error-icon svg {
                                        width: 24px;
                                        height: 24px;
                                    }

                                    .success-content strong,
                                    .error-content strong {
                                        font-size: 16px;
                                    }

                                    .success-content p,
                                    .error-content p {
                                        font-size: 13px;
                                    }
                                }
                            </style>

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
    <style>
        .s-contact-us {
            margin-top: 10em !important;
        }
    </style>
    {{-- Company logo --}}
    {{-- @if ($partners->count() > 0)
        <section class="s-partner pb-100">
            <div class="tf-container w-1780">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="slider-wrap">
                            <div class="swiper-container slider-partner">
                                <div class="swiper-wrapper">

                                    @foreach ($partners as $partner)
                                        <div class="swiper-slide">
                                            <div class="slide-partner">
                                                <div class="image">
                                                    <a href="#">
                                                        <img src="{{ asset('storage/' . $partner->image) }}"
                                                            alt="{{ $partner->name }}" class="lazyload">
                                                        <p class="text-center mt-2">{{ $partner->name }}</p>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif --}}
    @if ($partners->count() > 0)
        <section class="s-partner pb-100">
            <div class="tf-container w-1780">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="slider-wrap">
                            <div class="swiper-container slider-partner">
                                <div class="swiper-wrapper">

                                    @foreach ($partners as $partner)
                                        <div class="swiper-slide">
                                            <div class="slide-partner">
                                                <div class="image">
                                                    <a href="#">
                                                        <img src="{{ asset('storage/' . $partner->image) }}"
                                                            alt="{{ $partner->name }}" class="lazyload">
                                                        <p class="text-center mt-2">{{ $partner->name }}</p>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @else
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
                                                    <img src="{{ asset('assets/images/partner/sollio.png') }}"
                                                        alt="" class="lazyload">
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
        </section>
    @endif

@endsection
