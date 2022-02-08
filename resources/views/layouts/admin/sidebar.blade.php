<div class="dlabnav">
    <div class="dlabnav-scroll">
        <div class="dropdown header-profile2" style="margin-left: 20px !important;">
            <div class="header-info2 d-inline-flex align-items-center">
                <img class="rounded-circle" src="{{ asset('frontend/img/avatar.svg') }}" alt="" />
                <div class="d-flex align-items-center sidebar-info">
                    <div>
                        <span class="font-w400 d-block">{{ Auth::guard('admin')->user()->name }}</span>
                        <small class="font-w400 d-block">User ID: {{ Auth::guard('admin')->user()->username }}</small>
                        <small class="font-w400 d-none d-lg-block">E-mail: {{ Auth::guard('admin')->user()->email }}</small>
                    </div>
                </div>
            </div>
        </div>
        <ul class="metismenu" id="menu">
            <li>
                <a href="{{ route('admin.index') }}">
                    <span data-feather="user-check" class="nav-icon"></span>
                    <span class="nav-text">Dashboard</span>
                </a>
            </li>
            <li>
                <a class="has-arrow " href="javascript:void()" aria-expanded="false">
                    <i class="fas fa-credit-card"></i>
                    <span class="nav-text">Categories</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('admin.category.create') }}">Add Category</a></li>
                    <li><a href="{{ route('admin.category.index') }}">Category List</a></li>
                </ul>
            </li>
            <li>
                <a class="has-arrow " href="javascript:void()" aria-expanded="false">
                    <i class="fas fa-credit-card"></i>
                    <span class="nav-text">Buy Product Request</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="javascript:void();">Pending</a></li>
                    <li><a href="javascript:void();">Approved</a></li>
                    <li><a href="javascript:void();">Rejected</a></li>
                </ul>
            </li>
            <li>
                <a class="has-arrow " href="javascript:void()" aria-expanded="false">
                    <i class="fas fa-credit-card"></i>
                    <span class="nav-text">Donation Request</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="javascript:void();">Pending</a></li>
                    <li><a href="javascript:void();">Approved</a></li>
                    <li><a href="javascript:void();">Rejected</a></li>
                </ul>
            </li>
            <li>
                <a class="has-arrow " href="javascript:void();" aria-expanded="false">
                    <i class="fas fa-credit-card"></i>
                    <span class="nav-text">Sponsor</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('admin.sponsor.create') }}">Add Sponsor</a></li>
                    <li><a href="{{ route('admin.sponsor.index') }}">Sponsor List</a></li>
                </ul>
            </li>
            <li>
                <a class="has-arrow " href="javascript:void()" aria-expanded="false">
                    <i class="fas fa-credit-card"></i>
                    <span class="nav-text">Sponsored Item</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('admin.sponsor-item.create') }}">Add Product</a></li>
                    <li><a href="{{ route('admin.sponsor-item.index') }}">Sponsored Products</a></li>
                    <li><a href="{{ route('admin.sponsor-item.paused') }}">Paused Products</a></li>
                </ul>
            </li>
            <li>
                <a href="#logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i>
                    <span class="ms-2">Logout </span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
        </ul>
    </div>
</div>
