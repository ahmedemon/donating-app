<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- PAGE TITLE HERE -->
    <title>{{ ($pageTitle ?? 'Admin Panel')}} Forex E-coin</title>

    <!-- FAVICONS ICON -->
    <link rel="shortcut icon" type="image/png" href="{{ asset('favicon.png') }}" />
    <link href="{{ asset('backend/vendor/jquery-nice-select/css/nice-select.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/vendor/owl-carousel/owl.carousel.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('backend/vendor/toastr/css/toastr.min.css') }}">

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
            padding: 0.75rem 2.1875rem;
        }

    </style>

    @stack('css')

    {{-- @if (Auth::guard('admin')->check())
        <script>
            var timeout = ({{ config('session.lifetime') }} * 60000) - 5000;
            setTimeout(function() {
                window.location.reload(1);
            }, timeout);
        </script>
    @endif --}}
</head>

<body class="{{ Request::is(env('ADMIN_URL_PREFIX', 'admin') . '/login') ? 'vh-100' : '' }}">

    @if (!Request::is(env('ADMIN_URL_PREFIX', 'admin') . '/login'))
        {{-- Preloader start --}}
        {{-- <div id="preloader">
        <div class="lds-ripple">
            <div></div>
            <div></div>
        </div>
    </div> --}}
        {{-- Preloader end --}}

        <!-- Main wrapper start -->
        <div id="main-wrapper">

            <!-- Nav header start -->
                <div class="nav-header">
                    <a href="{{ route('admin.index') }}" class="brand-logo">
                        <img style="height: 60%; width: 100%;" class="border rounded" src="{{ asset('logo.png') }}" alt="Logo">
                    </a>
                    <div class="nav-control d-lg-none">
                        <div class="hamburger">
                            <span class="line"></span><span class="line"></span><span class="line"></span>
                        </div>
                    </div>
                </div>
            <!-- Nav header end -->

            <!-- Header start -->
            <div class="header">
                <div class="header-content">
                    <nav class="navbar navbar-expand">
                        <div class="collapse navbar-collapse justify-content-between">
                            <div class="header-left">
                            </div>
                            @include('layouts.admin.header-right')
                        </div>
                    </nav>
                </div>
            </div>
            <!-- Header end ti-comment-alt -->

            <!-- Sidebar start -->
            @include('layouts.admin.sidebar')
            <!-- Sidebar end -->

            <!-- Content body start -->
            <div class="content-body">
                @yield('content')
            </div>
            <!-- Content body end -->

            <div class="footer"></div>

        </div>

    @else
        @yield('content')
    @endif

    <!-- Required vendors -->
    <script src="{{ asset('backend/vendor/global/global.min.js') }}"></script>

    @if (!Request::is(env('ADMIN_URL_PREFIX', 'admin') . '/login'))

        {{-- <script src="{{ asset('backend/vendor/chart.js/Chart.bundle.min.js') }}"></script> --}}
        <script src="{{ asset('backend/vendor/jquery-nice-select/js/jquery.nice-select.min.js') }}"></script>

        {{-- <!-- Apex Chart --> --}}
        {{-- <script src="{{ asset('backend/vendor/apexchart/apexchart.js') }}"></script>

    <script src="{{ asset('backend/vendor/chart.js/Chart.bundle.min.js') }}"></script> --}}

        {{-- <!-- Chart piety plugin files --> --}}
        {{-- <script src="{{ asset('backend/vendor/peity/jquery.peity.min.js') }}"></script> --}}

        <!-- Dashboard 1 -->
        <script src="{{ asset('backend/js/dashboard/dashboard-1.js') }}"></script>

        {{-- <script src="{{ asset('backend/vendor/owl-carousel/owl.carousel.js') }}"></script> --}}

    @endif


    <script src="{{ asset('backend/js/custom.min.js') }}"></script>
    <script src="{{ asset('backend/js/dlabnav-init.js') }}"></script>

    <script src="{{ asset('backend/vendor/toastr/js/toastr.min.js') }}"></script>
    <script src="{{ asset('backend/js/plugins-init/toastr-init.js') }}"></script>
    {{-- {!! Toastr::message() !!} --}}

    @stack('js')

    {{-- @if (!Request::is(env('ADMIN_URL_PREFIX', 'admin') . '/login')) --}}
    <script>
        jQuery(document).ready(function() {
            dlabSettingsOptions.version = 'dark';
            new dlabSettings(dlabSettingsOptions);
        });
    </script>
    {{-- @endif --}}

</body>

</html>