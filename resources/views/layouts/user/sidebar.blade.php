            <div class="sidebar__menu-group">
                <ul class="sidebar_nav">
                    <li class="">
                        <a href="{{ route('user.dashboard') }}" class="{{ route('user.dashboard') ? 'active' : '' }}">
                            <span data-feather="home" class="nav-icon"></span>
                            <span class="menu-text">Dashboard</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="#" class="">
                            <span data-feather="user-check" class="nav-icon"></span>
                            <span class="menu-text">Register</span>
                        </a>
                    </li>
                    <li class="has-child">
                        <a href="#" class="">
                            <span data-feather="shopping-cart" class="nav-icon"></span>
                            <span class="menu-text">Free Shelf</span>
                            <span class="toggle-icon"></span>
                        </a>
                        <ul class="bg-dark">
                            <li>
                                <a href="products.html" class="">Products</a>
                            </li>
                            <li>
                                <a href="products.html" class="">Products</a>
                            </li>
                            <li>
                                <a href="products.html" class="">Products</a>
                            </li>
                            <li>
                                <a href="products.html" class="">Products</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <span data-feather="log-out" class="nav-icon"></span>
                            <span class="menu-text">Sign out</span>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>