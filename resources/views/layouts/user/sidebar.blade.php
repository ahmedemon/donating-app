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
                    <i class="flaticon-025-dashboard"></i>
                    <span class="nav-text">Dashboard</span>
                </a>
            </li>
            <li>
                <a class="has-arrow " href="javascript:void()" aria-expanded="false">
                    <i class="fas fa-credit-card"></i>
                    <span class="nav-text">Shelf</span>
                </a>
                <ul aria-expanded="false">
                    @php
                        $categories = \App\Models\Category::where('status', 1)->get();
                    @endphp
                    @foreach($categories as $category)
                        <li><a href="{{ route('category.index', $category->id) }}">{{ $category->name }}</a></li>
                    @endforeach
                </ul>
            </li>
            <li>
                <a class="has-arrow " href="javascript:void()" aria-expanded="false">
                    <i class="fas fa-credit-card"></i>
                    <span class="nav-text">Ordered Items</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('my-order.pending.request') }}">Pending</a></li>
                    <li><a href="{{ route('my-order.approved.request') }}">Approved</a></li>
                    <li><a href="{{ route('my-order.rejected.request') }}">Rejected</a></li>
                </ul>
            </li>
            <li>
                <a class="has-arrow " href="javascript:void()" aria-expanded="false">
                    <i class="fas fa-credit-card"></i>
                    <span class="nav-text">Donate</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('donation.create') }}">Donate Product</a></li>
                    <li><a href="{{ route('donation.pending') }}">Pending</a></li>
                    <li><a href="{{ route('donation.approved') }}">Approved</a></li>
                    <li><a href="{{ route('donation.rejected') }}">Rejected</a></li>
                </ul>
            </li>
            <li>
                <a class=" " href="{{ route('donation.index') }}" aria-expanded="false">
                    <i class="fas fa-credit-card"></i>
                    <span class="nav-text">Total Sales Item</span>
                </a>
            </li>
            <li>
                <a class="has-arrow " href="javascript:void()" aria-expanded="false">
                    <i class="fas fa-credit-card"></i>
                    <span class="nav-text">Buyer Request</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('buyer-request.pending.request') }}">Pending</a></li>
                    <li><a href="{{ route('buyer-request.completed.request') }}">Completed</a></li>
                    <li><a href="{{ route('buyer-request.rejected.request') }}">Rejected</a></li>
                </ul>
            </li>
            <li>
                <a href="{{ route('sponsored-shop.index') }}" aria-expanded="false">
                    <i class="fas fa-user"></i>
                    <span class="nav-text">Sponsored Shop</span>
                </a>
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
