    <nav class="navbar navbar-expand-lg bg-dark navbar-dark">
      <a class="navbar-brand" href="exchange-dark.html">
        <img src="{{ asset('frontend/img/logo.png') }}" alt="logo">
        <strong>Donate For Re-Use</strong>
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#headerMenu"
        aria-controls="headerMenu" aria-expanded="false" aria-label="Toggle navigation">
        <i class="icon ion-md-menu"></i>
      </button>

      <div class="collapse navbar-collapse" id="headerMenu">
        <ul class="navbar-nav mx-auto">
          <li class="nav-item">
            <a class="btn btn-sm btn-outline-dark text-light mx-1 {{ Request::is('/') ? 'active' : '' }}" href="{{ route('user.frontend') }}">
              Home
            </a>
          </li>
          <li class="nav-item">
            <a class="btn btn-sm btn-outline-dark text-light mx-1" href="#">
              Register
            </a>
          </li>
          <li class="nav-item">
            <a class="btn btn-sm btn-outline-dark text-light mx-1" href="#">
              About Us
            </a>
          </li>

          <li class="nav-item">
            <a class="btn btn-sm btn-outline-dark text-light mx-1" href="#">
              Free Shelf
            </a>
          </li>
          <li class="nav-item">
            <a class="btn btn-sm btn-outline-dark text-light mx-1" href="#">
              Sponsored Shop
            </a>
          </li>
          <li class="nav-item">
            <a class="btn btn-sm btn-outline-dark text-light mx-1" href="#">
              How It Works
            </a>
          </li>
        </ul>
        <ul class="navbar-nav ml-auto">
          <a href="javascript:void()" class="btn btn-outline-success mx-1 rounded-sm text-white">Login</a>
          <a href="javascript:void()" class="btn btn-outline-success mx-1 rounded-sm active">Register</a>
        </ul>
      </div>
    </nav>