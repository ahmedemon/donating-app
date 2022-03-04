    <nav class="navbar navbar-expand-lg bg-dark navbar-dark">
      <a class="navbar-brand" href="{{ route('user.frontend') }}">
        <img src="{{ asset('frontend/img/logo.png') }}" alt="logo">
        <strong>Donate For Re-Use</strong>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#headerMenu" aria-controls="headerMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="headerMenu">
        <ul class="navbar-nav mx-auto">
          <li class="nav-item">
            <a class="btn btn-sm shadow-none {{ Request::is('/') ? 'btn-danger' : 'btn-outline-dark' }} text-light mx-1" href="{{ route('user.frontend') }}">
              Home
            </a>
          </li>
          <li class="nav-item">
            <a class="btn btn-sm shadow-none btn-outline-dark text-light mx-1" href="{{ route('register') }}">
              Register
            </a>
          </li>
          <li class="nav-item">
            <a class="btn btn-sm shadow-none btn-outline-dark text-light mx-1" href="#">
              About Us
            </a>
          </li>

          <li class="nav-item">
            <a class="btn btn-sm shadow-none btn-outline-dark text-light mx-1" href="#">
              Free Shelf
            </a>
          </li>
          <li class="nav-item">
            <a class="btn btn-sm shadow-none btn-outline-dark text-light mx-1" href="#">
              Sponsored Shop
            </a>
          </li>
          <li class="nav-item">
            <a class="btn btn-sm shadow-none btn-outline-dark text-light mx-1" href="#">
              How It Works
            </a>
          </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            @auth
                <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img height="50" width="50" class="rounded-circle" src="{{ Auth::user()->image == !null ? asset('storage/user/'. Auth::user()->image) : asset('avatar.png') }}" alt="">
                            </a>
                            <ul class="dropdown-menu bg-dark dropdown-menu-end" aria-labelledby="navbarDarkDropdownMenuLink">
                                <li>
                                    <a class="dropdown-item bg-dark text-white" href="{{ route('user.dashboard') }}">Account</a>
                                </li>
                                <li>
                                    <a class="dropdown-item bg-dark text-white" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            @else
                <a href="{{ route('login') }}" class="btn btn-outline-success mx-1 rounded-sm text-white">Login</a>
                <a href="{{ route('register') }}" class="btn btn-outline-success mx-1 rounded-sm active">Register</a>
            @endauth
        </ul>
      </div>
    </nav>
