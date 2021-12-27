<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Donate For Re-Use</title>
  <link rel="icon" href="{{ asset('frontend/img/favicon.png') }}" type="image/x-icon">
  <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('frontend/css/background.animated.css') }}">
  @stack('css')
</head>

<body id="dark">
  <header>
    @include('layouts.partials.frontend.topbar')
  </header>

  <div class="container-fluid px-0 my-3">
    @yield('content')
  </div>

  <div class="footer">
    @include('layouts.partials.frontend.footer')
  </div>


  <script src="{{ asset('frontend/js/jquery-3.4.1.min.js') }}"></script>
  @stack('js')
  <script src="{{ asset('frontend/js/popper.min.js') }}"></script>
  <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('frontend/js/amcharts-core.min.js') }}"></script>
  <script src="{{ asset('frontend/js/amcharts.min.js') }}"></script>
  <script src="{{ asset('frontend/js/custom.js') }}"></script>
</body>

</html>