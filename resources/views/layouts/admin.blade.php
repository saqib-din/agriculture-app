<!doctype html>
<html lang="en">

<head>
    <title>Agriculture App Admin Site</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="description"
        content="Basic Agriculture App to manage products, their categories and tests and farmers data" />
    <meta name="keywords" content="agriculture, categories, products, contact, crops, farmers" />
    <meta name="author" content="ScrumAD" />

    {{-- Icon Agriculture App --}}
    <link rel="shortcut icon" href="{{ asset('assets/images/logo/logo3x.png') }}" />
    <link rel="apple-touch-icon-precomposed" href="{{ asset('assets/images/logo/logo3x.png') }}" />

    {{-- [CSS Files] --}}
    <link rel="stylesheet" href="{{ asset('admin/assets/css/plugins/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/assets/fonts/inter/inter.css') }}" id="main-font-link" />
    <link rel="stylesheet" href="{{ asset('admin/assets/fonts/phosphor/duotone/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/assets/fonts/tabler-icons.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/assets/fonts/feather.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/assets/fonts/fontawesome.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/assets/fonts/material.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/assets/css/style.css') }}" id="main-style-link" />
    <script src="{{ asset('admin/assets/js/tech-stack.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('admin/assets/css/style-preset.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset(path: 'admin/assets/css/plugins/animate.min.css') }}" />

    {{-- Stack for additional styles from child pages --}}
    @stack('styles')

</head>

<body data-pc-preset="preset-1" data-pc-sidebar-caption="true" data-pc-layout="vertical" data-pc-direction="ltr"
    data-pc-theme_contrast="">

    {{-- Page loader --}}
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>

    @if (!in_array(Route::currentRouteName(), ['password.request', 'login', 'password.reset', 'register', 'landing.home']))
        @include('partials.landing.admin.sidebar')
        @include('partials.landing.admin.topbar')
    @endif

    {{-- @include('components.alerts') Show all alert messages --}}

    {{-- main contents --}}
    @yield('content')

    {{-- js files --}}
    <script src="{{ asset('admin/assets/js/plugins/popper.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/plugins/simplebar.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/plugins/bootstrap.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/icon/custom-font.js') }}"></script>
    <script src="{{ asset('admin/assets/js/script.js') }}"></script>
    {{-- Dark mode and light mode --}}
    <script src="{{ asset('admin/assets/js/theme.js') }}"></script>
    <script src="{{ asset('admin/assets/js/custom_pages/inputdateclickevent.js') }}"></script>

    <script src="{{ asset('admin/assets/js/plugins/feather.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/plugins/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/elements/ac-alert.js') }}"></script>
    <script src="{{ asset('admin/assets/js/plugins/apexcharts.min.js') }}"></script>

    {{-- @if (Route::currentRouteName() === 'dashboard')
        <script src="{{ asset('admin/assets/js/widgets/course-report-bar-chart.js') }}"></script>
        <script src="{{ asset('admin/assets/js/widgets/invoice-chart.js') }}"></script>
        <script src="{{ asset('admin/assets/js/widgets/payroll-report-bar-chart.js') }}"></script>
    @endif --}}

    <!-- jQuery + DataTables JS -->
    {{-- <script src="{{ asset('admin/assets/js/plugins/simple-datatables.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script> --}}

    {{-- jQuery for Select2 and other plugins --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    {{-- Stack for additional scripts from child pages --}}
    @stack('scripts')

    {{-- Stats Counter --}}

</body>

</html>
