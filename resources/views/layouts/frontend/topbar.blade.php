    <nav class="navbar navbar-expand-lg bg-dark navbar-dark">
        <a class="navbar-brand" href="{{ route('user.frontend') }}">
            <img class="rounded-lg" src="{{ asset('frontend/img/logo.png') }}" alt="logo">
            <strong>Donate For Re-Use</strong>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#headerMenu" aria-controls="headerMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="headerMenu">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="btn shadow-none {{ Request::is('/') ? 'btn-danger' : 'btn-outline-dark' }} text-light mx-1" href="{{ route('user.frontend') }}">
                        Home
                    </a>
                </li>
                @auth
                    <li class="nav-item">
                        <a class="btn shadow-none btn-outline-dark text-light mx-1" href="{{ route('donation.create') }}">
                            Donate
                        </a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="btn shadow-none btn-outline-dark text-light mx-1" href="{{ route('register') }}">
                            Register
                        </a>
                    </li>
                @endauth

                <li class="nav-item">
                    <a class="btn shadow-none {{ Request::is('about') ? 'btn-danger' : 'btn-outline-dark' }} text-light mx-1" href="{{ route('about') }}">
                        About Us
                    </a>
                </li>

                <li class="nav-item">
                    <a class="btn shadow-none btn-outline-dark text-light mx-1" href="{{ route('category.categories') }}">
                        Free Shelf
                    </a>
                </li>
                <li class="nav-item">
                    <a class="btn shadow-none btn-outline-dark text-light mx-1" href="{{ route('sponsored-shop.index') }}">
                        Sponsored Shop
                    </a>
                </li>
                <li class="nav-item">
                    <a class="btn shadow-none {{ Request::is('how') ? 'btn-danger' : 'btn-outline-dark' }} text-light mx-1" href="{{ route('how') }}">
                        How It Works
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <ul class="navbar-nav m-0">
                    <li class="nav-item my-auto">
                        <form action="{{ route('search.search') }}" method="GET" class="d-flex mx-1 my-md-auto my-1">
                            @csrf
                            <input name="search" class="form-control rounded-0" type="search" placeholder="Ex: Smarphones" aria-label="Search" value="{{ request()->search }}">
                            <button class="btn btn-danger rounded-0" type="submit">
                                <i class="lni lni-search-alt font-weight-bolder"></i>
                            </button>
                        </form>
                    </li>
                    @auth
                        <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
                            <ul class="navbar-nav">
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <img height="50" width="50" class="rounded-circle" src="{{ Auth::user()->image == !null ? asset('storage/user/' . Auth::user()->image) : asset('avatar.png') }}" alt="">
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
                        <a href="{{ route('login') }}" class="btn btn-outline-success mx-1 my-md-auto my-1 rounded-sm text-white">Login</a>
                        <a href="{{ route('register') }}" class="btn btn-outline-success mx-1 my-md-auto my-1 rounded-sm active">Register</a>
                    @endauth
                </ul>
        </div>
    </nav>
