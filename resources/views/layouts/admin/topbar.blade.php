        <nav class="navbar navbar-dark">
            {{-- topbar start--}}
            <div class="navbar-left">
                <a href="#" class="sidebar-toggle">
                    <img class="svg" src="{{ asset('backend/img/svg/bars.svg') }}" alt="img">
                </a>
                <a class="navbar-brand" href="#">
                    Admin Dashboard
                </a>
                <form action="https://demo.jsnorm.com/" class="search-form">
                    <span data-feather="search"></span>
                    <input class="form-control mr-sm-2 box-shadow-none" type="search" placeholder="Search..." aria-label="Search">
                </form>
            </div>
            {{-- topbar start--}}

            <div class="navbar-right">
                <ul class="navbar-right__menu">
                    <li class="nav-notification">
                        <div class="dropdown-custom">
                            <a href="javascript:void();" class="nav-item-toggle">
                                <span data-feather="bell"></span></a>
                            <div class="dropdown-wrapper bg-dark">
                                <h2 class="dropdown-wrapper__title bg-dark border border-light text-white">Notifications <span class="badge-circle badge-warning ml-1">4</span></h2>
                                <ul>
                                    <li class="nav-notification__single nav-notification__single--unread d-flex flex-wrap">
                                        <div class="nav-notification__type nav-notification__type--primary">
                                            <span data-feather="inbox"></span>
                                        </div>
                                        <div class="nav-notification__details bg-dark text-white">
                                            <p>
                                                <a href="#" class="text-success" style="max-width: 180px;">James</a>
                                                <span>sent you a message</span>
                                            </p>
                                            <p>
                                                <span class="time-posted">5 hours ago</span>
                                            </p>
                                        </div>
                                    </li>
                                </ul>
                                <a href="#" class="dropdown-wrapper__more">See all incoming activity</a>
                            </div>
                        </div>
                    </li>
                    <li class="nav-author">
                        <div class="dropdown-custom">
                            <a href="javascript:void();" class="nav-item-toggle"><img src="{{ asset('backend/img/author-nav.jpg') }}" alt="" class="rounded-circle"></a>
                            <div class="dropdown-wrapper bg-dark rounded">
                                <div class="nav-author__info bg-dark border border-light">
                                    <div class="author-img">
                                        <img src="{{ asset('backend/img/author-nav.jpg') }}" alt="" class="rounded-circle">
                                    </div>
                                    <div>
                                        <h6 class="text-white">{{ Auth::user()->name }}</h6>
                                    </div>
                                </div>
                                <div class="nav-author__options">
                                    <ul>
                                        <li>
                                            <a href="#" class="text-white"><span data-feather="user"></span> Profile</a>
                                        </li>
                                        <li>
                                            <a href="#" class="text-white"><span data-feather="settings"></span> Settings</a>
                                        </li>
                                        <li>
                                            <a href="#" class="text-white"><span data-feather="key"></span> Billing</a>
                                        </li>
                                        <li>
                                            <a href="#" class="text-white"><span data-feather="users"></span> Activity</a>
                                        </li>
                                        <li>
                                            <a href="#" class="text-white"><span data-feather="bell"></span> Help</a>
                                        </li>
                                    </ul>
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"class="nav-author__signout bg-dark rounded-bottom border-top border-light">
                                        <span data-feather="log-out"></span> Sign Out
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                            <!-- ends: .dropdown-wrapper -->
                        </div>
                    </li>
                    <!-- ends: .nav-author -->
                </ul>
                <!-- ends: .navbar-right__menu -->
                <div class="navbar-right__mobileAction d-md-none">
                    <a href="#" class="btn-search">
                        <span data-feather="search"></span>
                        <span data-feather="x"></span></a>
                    <a href="#" class="btn-author-action">
                        <span data-feather="more-vertical"></span></a>
                </div>
            </div>
            <!-- ends: .navbar-right -->
        </nav>