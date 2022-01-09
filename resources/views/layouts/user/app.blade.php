<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- PAGE TITLE HERE -->
    <title>{{ ($pageTitle ?? 'User Panel') . ' | ' }} Forex E-coin</title>
    <!-- FAVICONS ICON -->
    <link rel="shortcut icon" type="image/png" href="{{ asset('favicon.png') }}" />
    <link href="{{ asset('backend/vendor/jquery-nice-select/css/nice-select.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/vendor/owl-carousel/owl.carousel.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('backend/vendor/toastr/css/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/vendor/sweetalert2/dist/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/icons/font-awesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/logo_animation.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Style css -->
    <link href="{{ asset('backend/css/style.css') }}" rel="stylesheet">
    <style>
        ::-webkit-scrollbar {
            width: 10px;
            height: 10px;
            border-radius: 50%;
        }

        ::-webkit-scrollbar-track {
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb {
            background: rgb(87, 87, 87);
            border-radius: 10px;
        }

        .form-control.is-invalid {
            border-top-right-radius: 1rem !important;
            border-bottom-right-radius: 1rem !important;
        }

        [data-sidebar-style="full"][data-layout="vertical"] .dlabnav .metismenu>li>a {
            padding: 0.55rem 2.1875rem;
        }

        .card-body {
            z-index: 0 !important;
        }
    </style>

    @stack('css')

    @if (Request::is('user'))
        <link rel="stylesheet" href="{{ asset('backend/css/style.ext.css') }}">
    @endif

</head>

<body class="{{ Request::is('login') || Request::is('password/*') || !Request::is('guest/register') ? 'vh-100' : '' }}">

    @if (!Request::is('login') && !Request::is('password/*') && !Request::is('register'))
        <!-- Preloader start -->
        <div id="preloader">
            <div class="lds-ripple">
                <div></div>
                <div></div>
            </div>
        </div>
        <!-- Preloader end -->

        <!-- Main  -->
        <div id="main-wrapper">
            <!-- Nav  -->
            @auth
                <div class="nav-header">
                    <a href="{{ route('user.dashboard') }}" class="brand-logo">
                        <img style="height: 60%; width: 100%;" class="border rounded" src="{{ asset('logo.png') }}" alt="Logo">
                    </a>
                    <div class="nav-control d-lg-none">
                        <div class="hamburger">
                            <span class="line"></span><span class="line"></span><span class="line"></span>
                        </div>
                    </div>
                </div>
                <!-- Nav  -->

                <!-- Header start -->
                <div class="header">
                    <div class="header-content" style="padding-left: 0rem;">
                        <nav class="navbar navbar-expand">
                            <div class="collapse navbar-collapse justify-content-between">
                                    <marquee behavior="" direction="">Notice Slider</marquee>
                                <div class="header-left">
                                </div>
                                @include('layouts.user.header-right')
                            </div>
                        </nav>
                    </div>
                </div>
                <!-- Header end -->
                <!-- Sidebar start -->
                @include('layouts.user.sidebar')
                <!-- Sidebar end -->

            @endauth
            <!-- Content body start -->
            <div class="content-body">
                @yield('content')
            </div>
            <!-- Content body end -->


        </div>
        <!--
        Main wrapper end -->
    @else
        @yield('content')
    @endif

    <!-- Scripts -->
    <!-- Required vendors -->
    <script src="{{ asset('backend/vendor/global/global.min.js') }}"></script>

    @if (!Request::is('login'))

        <script src="{{ asset('backend/vendor/jquery-nice-select/js/jquery.nice-select.min.js') }}"></script>


        @if (Request::is('user/wallet*'))
            <!-- Apex Chart -->
            <script src="{{ asset('backend/vendor/apexchart/apexchart.js') }}"></script>
            <script src="{{ asset('backend/vendor/chart.js/Chart.bundle.min.js') }}"></script>
            <!-- Chart piety plugin files -->
            <script src="{{ asset('backend/vendor/peity/jquery.peity.min.js') }}"></script>
            <script src="{{ asset('backend/js/dashboard/dashboard-1.js') }}"></script>
        @endif
        <!-- Dashboard 1 -->

        <script src="{{ asset('backend/vendor/owl-carousel/owl.carousel.js') }}"></script>

    @endif

    <script src="{{ asset('backend/js/custom.min.js') }}"></script>
    <script src="{{ asset('backend/js/dlabnav-init.js') }}"></script>

    <script src="{{ asset('backend/vendor/toastr/js/toastr.min.js') }}"></script>
    <!-- All init script -->
    <script src="{{ asset('backend/js/plugins-init/toastr-init.js') }}"></script>
    {{-- {!! Toastr::message() !!} --}}

    @stack('js')

    @if (!Request::is('login') && !Request::is('password/*'))
        <script>
            jQuery(document).ready(function() {
                setTimeout(function() {
                    dlabSettingsOptions.version = 'dark';
                    new dlabSettings(dlabSettingsOptions);
                }, 500)
            });
        </script>
    @endif

    {{-- @include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"]) --}}
    {{-- @include('sweetalert::alert') --}}
    {{-- @include('sweetalert::alert', ['cdn' => asset('backend/vendor/sweetalert2/dist/sweetalert2.min.js')]) --}}

    <div class="fixed-bottom">
        {{-- @include('home.tradingview.widget') --}}
    </div>

</body>

</html>
