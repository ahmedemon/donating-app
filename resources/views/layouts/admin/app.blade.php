<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $pageTitle }} | Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('backend/css/plugin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/style.css') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('backend/img/favicon.png') }}">
    <style>
        .sub-icon{
            margin-right: 5px !important;
        }
    </style>
</head>

<body class="layout-dark side-menu overlayScroll">
    @auth
        <div class="mobile-search"></div>
        <div class="mobile-author-actions"></div>
        <header class="header-top">
            @include('layouts.user.topbar')
        </header>
    @endauth

    <main class="main-content">
        @auth
            <aside class="sidebar">
                @include('layouts.user.sidebar')
            </aside>
        @endauth

        @yield('content-without-menubar')

        <div class="contents vh-100">
            <div class="container-fluid">
                <div class="social-dash-wrap">
                    <div class="row pt-4">
                        <div class="col-lg-12">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <div id="overlayer">
        <span class="loader-overlay">
            <div class="atbd-spin-dots spin-lg">
                <span class="spin-dot badge-dot dot-success"></span>
                <span class="spin-dot badge-dot dot-success"></span>
                <span class="spin-dot badge-dot dot-success"></span>
                <span class="spin-dot badge-dot dot-success"></span>
            </div>
        </span>
    </div>

    <div class="overlay-dark-sidebar"></div>
    <div class="customizer-overlay"></div>

    <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDduF2tLXicDEPDMAtC6-NLOekX0A5vlnY"></script>
    <script src="{{ asset('backend/js/plugins.min.js') }}"></script>
    <script src="{{ asset('backend/js/script.min.js') }}"></script>
</body>
</html>