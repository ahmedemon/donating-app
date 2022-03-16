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
  @if(!route('home'))
    <link rel="stylesheet" href="{{ asset('frontend/css/background.animated.css') }}">
  @endif
  @stack('css')
</head>

<body id="light">
  <header>
    @include('layouts.frontend.topbar')
  </header>

  <div class="container-fluid px-0">
    @yield('content')
  </div>

  <div class="footer">
    @include('layouts.frontend.footer')
  </div>

  <script src="{{ asset('frontend/js/jquery-3.4.1.min.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  @stack('js')
  <script src="{{ asset('frontend/js/popper.min.js') }}"></script>
  <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('frontend/js/amcharts-core.min.js') }}"></script>
  <script src="{{ asset('frontend/js/amcharts.min.js') }}"></script>
  <script src="{{ asset('frontend/js/custom.js') }}"></script>
</body>

</html>
