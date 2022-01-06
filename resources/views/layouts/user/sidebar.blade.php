<div class="dlabnav">
    <div class="dlabnav-scroll">
        <div class="dropdown header-profile2" style="margin-left: 20px !important;">
            <div class="header-info2 d-inline-flex align-items-center">
                <img class="rounded-circle" src="{{ Auth::user()->image == !null ? asset('storage/user/' . Auth::user()->image) : asset('frontend/img/avatar.svg') }}" alt="" />
                <div class="d-flex align-items-center sidebar-info">
                    <div>
                        <span class="font-w400 d-block">{{ Auth::user()->name }}</span>
                        <small class="d-block text-danger"><strong>{{ Auth::user()->is_active ? 'Active' : 'Inactive Account' }}</strong></small>
                        <small class="font-w400 d-block">User ID: {{ Auth::user()->username }}</small>
                        <small class="font-w400 d-none d-lg-block">E-mail: {{ Auth::user()->email }}</small>
                    </div>
                </div>
            </div>
        </div>
        <ul class="metismenu" id="menu">
            <li>
                <a href="{{ route('user.dashboard') }}">
                    <span data-feather="user-check" class="nav-icon"></span>
                    <span class="nav-text">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="javascript:void();" aria-expanded="false">
                    <i class="fas fa-user"></i>
                    <span class="nav-text">Create Account</span>
                </a>
            </li>
            <li>
                <a class="has-arrow " href="javascript:void()" aria-expanded="false">
                    <i class="fas fa-credit-card"></i>
                    <span class="nav-text">Menu</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="javascript:void();">Sub Menu</a></li>
                    <li><a href="javascript:void();">Sub Menu</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>
