            <div class="sidebar__menu-group">
                <ul class="sidebar_nav">
                    <li class="">
                        <a href="{{ route('user.dashboard') }}" class="{{ route('user.dashboard') ? 'active' : '' }}">
                            <span data-feather="home" class="nav-icon"></span>
                            <span class="menu-text">Dashboard</span>
                        </a>
                    </li>
                    <li class="has-child">
                        <a href="#" class="">
                            <span data-feather="gift" class="nav-icon"></span>
                            <span class="menu-text">Donated Products</span>
                            <span class="toggle-icon"></span>
                        </a>
                        <ul class="bg-dark">
                            <li>
                                <a href="javascript:void();" class="">
                                    <span data-feather="pause" class="nav-icon sub-icon"></span> Pending
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void();" class="">
                                    <span data-feather="check-square" class="nav-icon sub-icon"></span> Success
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void();" class="">
                                    <span data-feather="x" class="nav-icon sub-icon"></span> Rejected
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="has-child">
                        <a href="#" class="">
                            <span data-feather="shopping-bag" class="nav-icon"></span>
                            <span class="menu-text">Ordered List</span>
                            <span class="toggle-icon"></span>
                        </a>
                        <ul class="bg-dark">
                            <li>
                                <a href="javascript:void();" class="">
                                    <span data-feather="pause" class="nav-icon sub-icon"></span> Pending
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void();" class="">
                                    <span data-feather="check-square" class="nav-icon sub-icon"></span> Success
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void();" class="">
                                    <span data-feather="x" class="nav-icon sub-icon"></span> Rejected
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="has-child">
                        <a href="#" class="">
                            <span data-feather="layers" class="nav-icon"></span>
                            <span class="menu-text">Categories</span>
                            <span class="toggle-icon"></span>
                        </a>
                        <ul class="bg-dark">
                            <li>
                                <a href="javascript:void();" class="">
                                    <span data-feather="plus-circle" class="nav-icon sub-icon"></span> Add
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void();" class="">
                                    <span data-feather="list" class="nav-icon sub-icon"></span> Category List
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="has-child">
                        <a href="#" class="">
                            <span data-feather="shopping-cart" class="nav-icon"></span>
                            <span class="menu-text">Sponsor</span>
                            <span class="toggle-icon"></span>
                        </a>
                        <ul class="bg-dark">
                            <li>
                                <a href="javascript:void();" class="">
                                    <span data-feather="menu" class="nav-icon sub-icon"></span> Sponsor List
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void();" class="">
                                    <span data-feather="plus-circle" class="nav-icon sub-icon"></span> Add Items
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void();" class="">
                                    <span data-feather="list" class="nav-icon sub-icon"></span> Sponsored Items
                                </a>
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