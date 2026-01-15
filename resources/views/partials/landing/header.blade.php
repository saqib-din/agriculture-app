<!-- Header  -->
<header class="header has-item-bot" id="header-main">
    <div class="tf-container w-1780">
        <div class="row">
            <div class="col-lg-12">
                <div class="header-inner">
                    <div class="header-left">
                        <div class="logo-site">
                            <a href="{{ url('/') }}">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <img src="{{ asset('assets/images/logo/logo3x.png') }}" style="height: 3em;"
                                            alt="" />
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        @if (isset($variables) && $variables->isNotEmpty())
                                            <h5 class="text-dark mb-0 fw-5">{{ $variables->first()->name ?? 'N/A' }}
                                            </h5>
                                            {{-- <span class="text-dark">{{ $variables->first()->slogan ?? 'N/A' }}</span> --}}
                                        @else
                                            <h5 class="text-dark mb-0 fw-5">Scrumad</h5>
                                        @endif
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="main-nav">
                            <ul class="nav-list">
                                <li class="item has-child {{ request()->is('/') ? 'current-menu' : '' }}">
                                    <a href="{{ url('/') }}">Home</a>
                                </li>
                                {{-- @if (isset($products) && $products->isNotEmpty()) --}}
                                    <li class="item has-child {{ request()->is('products') ? 'current-menu' : '' }}">
                                        <a href="{{ url('/products') }}">Products</a>
                                    </li>
                                {{-- @endif --}}
                                {{-- @if (isset($services) && $services->isNotEmpty()) --}}
                                    <li class="item has-child {{ request()->is('services') ? 'current-menu' : '' }}">
                                        <a href="{{ url('/services') }}">Services</a>
                                    </li>
                                {{-- @endif --}}
                                {{-- @if (isset($teams) && $teams->isNotEmpty()) --}}
                                    <li class="item has-child {{ request()->is('teams') ? 'current-menu' : '' }}">
                                        <a href="{{ url('/teams') }}">Team</a>
                                    </li>
                                {{-- @endif --}}
                                @if ($hasAboutData)
                                    <li class="item has-child {{ request()->is('aboutus') ? 'current-menu' : '' }}">
                                        <a href="{{ url('aboutus') }}">About us</a>
                                    </li>
                                @endif
                                <li class="item has-child {{ request()->is('contactus') ? 'current-menu' : '' }}">
                                    <a href="{{ url('/contactus') }}">Contact us</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="header-right">
                        <div class="icon-wrap">
                            <a href="{{ route('login') }}" class="icon style-circle bg-light">
                                <i class="icon-user"></i>
                            </a>
                        </div>

                        <div class="mobile-button">
                            <span></span>
                        </div>
                    </div>
                </div>
                <div class="mobile-nav-wrap">
                    <div class="overlay-mobile-nav"></div>
                    <div class="inner-mobile-nav overflow-y-auto">
                        <div class="top">
                            <div class="logo">
                                <a href="index.html" rel="home" class="main-logo">
                                    <img id="mobile-logo_header" alt=""
                                        src="{{ asset('assets/images/logo/logo-2.png') }}" />
                                </a>
                                <div class="mobile-nav-close">
                                    <i class="icon-close"></i>
                                </div>
                            </div>
                            <nav id="mobile-main-nav" class="mobile-main-nav">
                                <ul id="menu-mobile-menu" class="menu">
                                    <li
                                        class="menu-item menu-item-has-children-mobile {{ request()->is('/') ? 'current-nav' : '' }}">
                                        <a class="item-menu-mobile {{ request()->is('/') ? 'current' : '' }}"
                                            href="{{ url('/') }}">
                                            Home
                                        </a>
                                    </li>
                                    {{-- @if (isset($products) && $products->isNotEmpty()) --}}
                                        <li
                                            class="menu-item menu-item-has-children-mobile {{ request()->is('products') ? 'current-nav' : '' }}">
                                            <a class="item-menu-mobile {{ request()->is('products') ? 'current' : '' }}"
                                                href="{{ url('/products') }}">
                                                Products
                                            </a>
                                        </li>
                                    {{-- @endif --}}
                                    {{-- @if (isset($services) && $services->isNotEmpty()) --}}
                                        <li
                                            class="menu-item menu-item-has-children-mobile {{ request()->is('services') ? 'current-nav' : '' }}">
                                            <a class="item-menu-mobile {{ request()->is('services') ? 'current' : '' }}"
                                                href="{{ url('/services') }}">
                                                Services
                                            </a>
                                        </li>
                                    {{-- @endif --}}
                                    {{-- @if (isset($teams) && $teams->isNotEmpty()) --}}
                                        <li
                                            class="menu-item menu-item-has-children-mobile {{ request()->is('teams') ? 'current-nav' : '' }}">
                                            <a class="item-menu-mobile {{ request()->is('teams') ? 'current' : '' }}"
                                                href="{{ url('/teams') }}">
                                                Teams
                                            </a>
                                        </li>
                                    {{-- @endif --}}
                                    @if ($hasAboutData)
                                        <li
                                            class="menu-item menu-item-has-children-mobile {{ request()->is('aboutus') ? 'current-nav' : '' }}">
                                            <a class="item-menu-mobile {{ request()->is('aboutus') ? 'current' : '' }}"
                                                href="{{ url('/aboutus') }}">
                                                About Us
                                            </a>
                                        </li>
                                    @endif
                                    <li
                                        class="menu-item menu-item-has-children-mobile {{ request()->is('contactus') ? 'current-nav' : '' }}">
                                        <a class="item-menu-mobile {{ request()->is('contactus') ? 'current' : '' }}"
                                            href="{{ url('/contactus') }}">
                                            Contact Us
                                        </a>
                                    </li>
                                </ul>

                            </nav>
                        </div>
                        <div class="bottom">
                            <div class="infor-list">
                                <ul>
                                    <li>
                                        <h5 class="title">
                                            Address:
                                        </h5>
                                        <p>
                                            @if (isset($variables) && $variables->isNotEmpty())
                                                {{ $variables->first()->address ?? 'Prinsengracht 250, Amsterdam Netherlands' }}
                                            @else
                                                Prinsengracht 250, Amsterdam Netherlands
                                            @endif
                                        </p>
                                    </li>
                                    <li>
                                        <h5 class="title">
                                            Phone:
                                        </h5>
                                        <p>
                                            @if (isset($variables) && $variables->isNotEmpty())
                                                {{ $variables->first()->phone ?? '+1 987 654 3210' }}
                                            @else
                                                +1 987 654 3210
                                            @endif
                                        </p>
                                    </li>
                                    <li>
                                        <h5 class="title">
                                            Email:
                                        </h5>
                                        <p>
                                            @if (isset($variables) && $variables->isNotEmpty())
                                                {{ $variables->first()->email ?? 'Donalfarms@gmail.com' }}
                                            @else
                                                Donalfarms@gmail.com
                                            @endif
                                        </p>
                                    </li>
                                </ul>
                            </div>
                            <div class="wg-social">
                                <ul class="list">
                                    @if (isset($variables) && $variables->isNotEmpty() && $variables->first()->facebook)
                                        <li class="item">
                                            <a href="{{ $variables->first()->facebook }}"><i
                                                    class="icon-facebook1"></i></a>
                                        </li>
                                    @endif
                                    @if (isset($variables) && $variables->isNotEmpty() && $variables->first()->twitter)
                                        <li class="item">
                                            <a href="{{ $variables->first()->twitter }}"><i
                                                    class="icon-twitter"></i></a>
                                        </li>
                                    @endif
                                    @if (isset($variables) && $variables->isNotEmpty() && $variables->first()->instagram)
                                        <li class="item">
                                            <a href="{{ $variables->first()->instagram }}"><i
                                                    class="icon-instagram2"></i></a>
                                        </li>
                                    @endif
                                    @if (isset($variables) && $variables->isNotEmpty() && $variables->first()->pinterest)
                                        <li class="item">
                                            <a href="{{ $variables->first()->pinterest }}"><i
                                                    class="icon-pinterest"></i></a>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="fixed-header style-absolute">
        <div class="tf-container w-1780">
            <div class="row">
                <div class="col-lg-12">
                    <div class="header-inner ">
                        <div class="header-left">
                            <div class="logo-site">
                                <a href="index.html">
                                    <img src="{{ asset('assets/images/logo/logo.png') }}" alt="" />
                                </a>
                            </div>
                            <div class="main-nav">
                                <ul class="nav-list">
                                    <li class="item has-child current-menu">
                                        <a href="{{ url('/') }}">Home</a>
                                    </li>
                                    {{-- @if (isset($products) && $products->isNotEmpty()) --}}
                                        <li class="item has-child">
                                            <a href="{{ url('/products') }}">Products</a>
                                        </li>
                                    {{-- @endif --}}
                                    {{-- @if (isset($services) && $services->isNotEmpty()) --}}
                                        <li class="item has-child">
                                            <a href="{{ url('/services') }}">Services</a>
                                        </li>
                                    {{-- @endif --}}
                                    {{-- @if (isset($teams) && $teams->isNotEmpty()) --}}
                                        <li class="item has-child">
                                            <a href="{{ url('/team') }}">Team</a>
                                        </li>
                                    {{-- @endif --}}
                                    @if ($hasAboutData)
                                        <li class="item has-child">
                                            <a href="{{ url('/aboutus') }}">About Us</a>
                                        </li>
                                    @endif
                                    <li class="item has-child">
                                        <a href="{{ url('/contactus') }}">Contact Us</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="header-right">
                            <div class="icon-wrap">
                                <a href="{{ route('login') }}" class="icon style-circle">
                                    <i class="icon-user"></i>
                                </a>
                            </div>
                            <div class="mobile-button">
                                <span></span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="header-item children">
            <img src="{{ asset('assets/images/item/page-title-top.png') }}" alt="">
        </div>
    </div>

    <div class="header-item">
        <img src="{{ asset('assets/images/item/page-title-top.png') }}" alt="">
    </div>
</header><!-- /.Header -->
