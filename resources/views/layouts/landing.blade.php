<!DOCTYPE html>
<!--[if IE 8]><html class="ie" xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<!--<![endif]-->

<head>
    <!-- Basic Page Needs -->
    <meta charset="utf-8" />
    <title>Agriculture App</title>
    <!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
    <meta name="description"
        content="DonalFarm is a minimal, clean, and modern One Page HTML Template designed for farms and other agriculture-related businesses, such as organic farms, agricultural research centers, or produce stores.">
    <meta name="keywords"
        content=" dairy farm, poultry farm, livestock, organic produce, fresh vegetables, fruits, grains, sustainable agriculture, eco-friendly farming, farm machinery, irrigation, tractor">

    @yield('meta')

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

    <!-- Bootstrap  -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.css') }}" />

    @yield('styles')

    <!-- Theme Style -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/magnific-popup.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/odometer.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/swiper-bundle.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/styles.css') }}" />

    <!-- Animation Style -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/animate.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/animate2.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/textanimation.css') }}" />

    <!-- Font -->
    <link rel="stylesheet" href="{{ asset('assets/font/fonts.css') }}" />

    <!-- Icon -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/icons/icomoon/style.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/icons/fontawesome/css/all.min.css') }}" />

    <!-- Favicon and Touch Icons  -->
    <link rel="shortcut icon" href="{{ asset('assets/images/logo/logo3x.png') }}" />
    <link rel="apple-touch-icon-precomposed" href="{{ asset('assets/images/logo/logo3x.png') }}" />

    <!--[if lt IE 9]>
        <script src="javascript/html5shiv.js"></script>
        <script src="javascript/respond.min.js"></script>
    <![endif]-->
</head>

<body class="counter-scroll">

    <!-- Wrapper -->
    <div id="wrapper">

        <!-- Preloader -->
        <div id="loading">
            <div id="loading-center">
                <div class="loader-container">
                    <div class="wrap-loader">
                        <div class="loader">
                        </div>
                        <div class="icon">
                            <img src="./images/logo/logo3x.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.Preloader -->

        @include('partials.landing.header')

        @yield('hero')

        <!-- Main-content -->
        <div class="main-content pt-0 page-index">

            @yield('content')

        </div>
        <!-- /.Main-content -->

        @include('partials.landing.footer')

    </div>
    <!-- /#Wapper -->

    <!-- Open-search -->
    <div class="offcanvas offcanvas-top offcanvas-search" id="canvasSearch">
        <button class="btn-close-search" type="button" data-bs-dismiss="offcanvas" aria-label="Close">
            <i class="icon-close"></i>
        </button>
        <div class="tf-container">
            <div class="row">
                <div class="col-12">
                    <div class="offcanvas-body">
                        <form action="#" class="form-search-courses">
                            <div class="icon">
                                <i class="icon-keyboard"></i>
                            </div>
                            <fieldset>
                                <input class="" type="text" placeholder="Search for anything" name="text" tabindex="2"
                                    value="" aria-required="true" required="" />
                            </fieldset>
                            <div class="button-submit">
                                <button class="" type="submit">
                                    <i class="icon-magnifying-glass"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.Open-search -->

    <!-- Prograss -->
    <div class="progress-wrap">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98"
                style="transition: stroke-dashoffset 10ms linear; stroke-dasharray: 307.919, 307.919; stroke-dashoffset: 307.919;">
            </path>
        </svg>
    </div>
    <!-- /.Prograss -->

    <!-- Javascript -->
    <script type="text/javascript" src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/lazysize.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/wow.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/magnific-popup.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/swiper-bundle.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/swiper.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/odometer.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/counter.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/count-down.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/jquery-validate.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/gsap-animation.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/gsap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/ScrollTrigger.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/Splitetext.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/main.js') }}"></script>
    <!-- /Javascript -->

    @yield('scripts')


</body>

</html>