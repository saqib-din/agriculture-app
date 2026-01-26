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
                                            alt="{{ $company['company_name'] ?? 'Logo' }}" />
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h5 class="text-dark mb-0 fw-5">
                                            {{ $company['company_name'] ?? 'Company Name' }}
                                        </h5>
                                        <span class="text-dark">{{ $company['company_slogan'] ?? '' }}</span>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="main-nav">
                            <ul class="nav-list">
                                <li class="item has-child {{ request()->is('/') ? 'current-menu' : '' }}">
                                    <a href="{{ url('/') }}">Home</a>
                                </li>
                                <li class="item has-child {{ request()->is('products') ? 'current-menu' : '' }}">
                                    <a href="{{ url('/products') }}">Products</a>
                                </li>
                                <li class="item has-child {{ request()->is('services') ? 'current-menu' : '' }}">
                                    <a href="{{ url('/services') }}">Services</a>
                                </li>
                                <li class="item has-child {{ request()->is('teams') ? 'current-menu' : '' }}">
                                    <a href="{{ url('/teams') }}">Team</a>
                                </li>
                                <li class="item has-child {{ request()->is('aboutus') ? 'current-menu' : '' }}">
                                    <a href="{{ url('aboutus') }}">About us</a>
                                </li>
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
                                <a href="{{ url('/') }}" rel="home" class="main-logo">
                                    <img id="mobile-logo_header" alt="{{ $company['company_name'] ?? 'Logo' }}"
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
                                    <li
                                        class="menu-item menu-item-has-children-mobile {{ request()->is('products') ? 'current-nav' : '' }}">
                                        <a class="item-menu-mobile {{ request()->is('products') ? 'current' : '' }}"
                                            href="{{ url('/products') }}">
                                            Products
                                        </a>
                                    </li>
                                    <li
                                        class="menu-item menu-item-has-children-mobile {{ request()->is('services') ? 'current-nav' : '' }}">
                                        <a class="item-menu-mobile {{ request()->is('services') ? 'current' : '' }}"
                                            href="{{ url('/services') }}">
                                            Services
                                        </a>
                                    </li>
                                    <li
                                        class="menu-item menu-item-has-children-mobile {{ request()->is('teams') ? 'current-nav' : '' }}">
                                        <a class="item-menu-mobile {{ request()->is('teams') ? 'current' : '' }}"
                                            href="{{ url('/teams') }}">
                                            Teams
                                        </a>
                                    </li>
                                    <li
                                        class="menu-item menu-item-has-children-mobile {{ request()->is('aboutus') ? 'current-nav' : '' }}">
                                        <a class="item-menu-mobile {{ request()->is('aboutus') ? 'current' : '' }}"
                                            href="{{ url('/aboutus') }}">
                                            About Us
                                        </a>
                                    </li>
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
                                        <h5 class="title">Address:</h5>
                                        <p>{{ $company['company_address'] ?? 'N/A' }}</p>
                                    </li>
                                    <li>
                                        <h5 class="title">Phone:</h5>
                                        <p>{{ $company['company_phone'] ?? 'N/A' }}</p>
                                    </li>
                                    <li>
                                        <h5 class="title">Email:</h5>
                                        <p>{{ $company['company_email'] ?? 'N/A' }}</p>
                                    </li>
                                </ul>
                            </div>
                            <div class="wg-social">
                                <ul class="list">
                                    @if (!empty($company['facebook']))
                                        <li class="item">
                                            <a href="{{ $company['facebook'] }}" target="_blank"><i
                                                    class="icon-facebook"></i></a>
                                        </li>
                                    @endif
                                    @if (!empty($company['twitter']))
                                        <li class="item">
                                            <a href="{{ $company['twitter'] }}" target="_blank"><i
                                                    class="icon-twitter"></i></a>
                                        </li>
                                    @endif
                                    @if (!empty($company['instagram']))
                                        <li class="item">
                                            <a href="{{ $company['instagram'] }}" target="_blank"><i
                                                    class="icon-instagram"></i></a>
                                        </li>
                                    @endif
                                    @if (!empty($company['linkedin']))
                                        <li class="item">
                                            <a href="{{ $company['linkedin'] }}" target="_blank"><i
                                                    class="icon-linkedin"></i></a>
                                        </li>
                                    @endif
                                    @if (!empty($company['youtube']))
                                        <li class="item">
                                            <a href="{{ $company['youtube'] }}" target="_blank"><i
                                                    class="icon-youtube"></i></a>
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
                                <a href="{{ url('/') }}">
                                    <img src="{{ asset('assets/images/logo/logo.png') }}"
                                        alt="{{ $company['company_name'] ?? 'Logo' }}" />
                                </a>
                            </div>
                            <div class="main-nav">
                                <ul class="nav-list">
                                    <li class="item has-child {{ request()->is('/') ? 'current-menu' : '' }}">
                                        <a href="{{ url('/') }}">Home</a>
                                    </li>
                                    <li class="item has-child {{ request()->is('products') ? 'current-menu' : '' }}">
                                        <a href="{{ url('/products') }}">Products</a>
                                    </li>
                                    <li class="item has-child {{ request()->is('services') ? 'current-menu' : '' }}">
                                        <a href="{{ url('/services') }}">Services</a>
                                    </li>
                                    <li class="item has-child {{ request()->is('teams') ? 'current-menu' : '' }}">
                                        <a href="{{ url('/teams') }}">Team</a>
                                    </li>
                                    <li class="item has-child {{ request()->is('aboutus') ? 'current-menu' : '' }}">
                                        <a href="{{ url('/aboutus') }}">About Us</a>
                                    </li>
                                    <li class="item has-child {{ request()->is('contactus') ? 'current-menu' : '' }}">
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
