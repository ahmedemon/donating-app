{{-- @php
$notices = App\Models\Notice::latest()->get();
@endphp --}}

<style>
    .navbar-nav.header-right a {
        position: relative;
    }

    .navbar-nav.header-right a .zoom-popup {
        position: absolute;
        background: #fdfdfd;
        width: max-content;
        border-radius: 5px;
        padding: 10px 20px;
        color: #007bff;
        top: calc(100% + 15px);
        right: 0;
        display: none;
    }

    .navbar-nav.header-right a:hover .zoom-popup {
        display: block;
    }

    .navbar-nav.header-right a .zoom-popup::after {
        content: '';
        position: absolute;
        top: -10px;
        right: 10px;
        width: 0;
        height: 0;
        border-left: 10px solid transparent;
        border-right: 10px solid transparent;
        border-bottom: 10px solid #fdfdfd;
    }

</style>

<ul class="navbar-nav header-right">
    <li style='display: flex; align-items: center; height: 100%'>
{{--         @php
            $zoomMeeting = \App\Models\ZoomMeeting::where('is_active', 'upcoming')
                ->latest()
                ->first();
        @endphp
        @if (isset($zoomMeeting) == !null)
            <a href="{{ $zoomMeeting->meeting_url == null ? '#' : $zoomMeeting->meeting_url }}" target="_blank" style="height: 40px">
                <img src="{{ asset('frontend/zoom.svg') }}" alt="" style="height: 100%">
                <div class="zoom-popup">
                    <strong>Date:</strong> {{ $zoomMeeting->meeting_date }},
                    <strong>Time:</strong> {{ $zoomMeeting->start_time }}
                </div>
            </a>
        @else
            <a href="#" style="height: 40px">
                <img src="{{ asset('frontend/zoom.svg') }}" alt="" style="height: 100%">
            </a>
        @endif --}}
    </li>
    <li class="nav-item dropdown notification_dropdown">
        <a class="nav-link" href="" role="button">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                <g data-name="Layer 2" transform="translate(-2 -2)">
                    <path id="Path_20" data-name="Path 20"
                        d="M22.571,15.8V13.066a8.5,8.5,0,0,0-7.714-8.455V2.857a.857.857,0,0,0-1.714,0V4.611a8.5,8.5,0,0,0-7.714,8.455V15.8A4.293,4.293,0,0,0,2,20a2.574,2.574,0,0,0,2.571,2.571H9.8a4.286,4.286,0,0,0,8.4,0h5.23A2.574,2.574,0,0,0,26,20,4.293,4.293,0,0,0,22.571,15.8ZM7.143,13.066a6.789,6.789,0,0,1,6.78-6.78h.154a6.789,6.789,0,0,1,6.78,6.78v2.649H7.143ZM14,24.286a2.567,2.567,0,0,1-2.413-1.714h4.827A2.567,2.567,0,0,1,14,24.286Zm9.429-3.429H4.571A.858.858,0,0,1,3.714,20a2.574,2.574,0,0,1,2.571-2.571H21.714A2.574,2.574,0,0,1,24.286,20a.858.858,0,0,1-.857.857Z" />
                </g>
            </svg>
        </a>
    </li>

    <li class="nav-item dropdown notification_dropdown">
        <a class="nav-link " href="javascript:void(0);">
            <svg xmlns="http://www.w3.org/2000/svg" width="23.262" height="24" viewBox="0 0 23.262 24">
                <g id="icon" transform="translate(-1565 90)">
                    <path id="setting_1_" data-name="setting (1)"
                        d="M30.45,13.908l-1-.822a1.406,1.406,0,0,1,0-2.171l1-.822a1.869,1.869,0,0,0,.432-2.385L28.911,4.293a1.869,1.869,0,0,0-2.282-.818l-1.211.454a1.406,1.406,0,0,1-1.88-1.086l-.213-1.276A1.869,1.869,0,0,0,21.475,0H17.533a1.869,1.869,0,0,0-1.849,1.567L15.47,2.842a1.406,1.406,0,0,1-1.88,1.086l-1.211-.454a1.869,1.869,0,0,0-2.282.818L8.126,7.707a1.869,1.869,0,0,0,.432,2.385l1,.822a1.406,1.406,0,0,1,0,2.171l-1,.822a1.869,1.869,0,0,0-.432,2.385L10.1,19.707a1.869,1.869,0,0,0,2.282.818l1.211-.454a1.406,1.406,0,0,1,1.88,1.086l.213,1.276A1.869,1.869,0,0,0,17.533,24h3.943a1.869,1.869,0,0,0,1.849-1.567l.213-1.276a1.406,1.406,0,0,1,1.88-1.086l1.211.454a1.869,1.869,0,0,0,2.282-.818l1.972-3.415a1.869,1.869,0,0,0-.432-2.385ZM27.287,18.77l-1.211-.454a3.281,3.281,0,0,0-4.388,2.533l-.213,1.276H17.533l-.213-1.276a3.281,3.281,0,0,0-4.388-2.533l-1.211.454L9.75,15.355l1-.822a3.281,3.281,0,0,0,0-5.067l-1-.822L11.721,5.23l1.211.454A3.281,3.281,0,0,0,17.32,3.151l.213-1.276h3.943l.213,1.276a3.281,3.281,0,0,0,4.388,2.533l1.211-.454,1.972,3.414h0l-1,.822a3.281,3.281,0,0,0,0,5.067l1,.822ZM19.5,7.375A4.625,4.625,0,1,0,24.129,12,4.63,4.63,0,0,0,19.5,7.375Zm0,7.375A2.75,2.75,0,1,1,22.254,12,2.753,2.753,0,0,1,19.5,14.75Z"
                        transform="translate(1557.127 -90)" />
                </g>
            </svg>
        </a>
    </li>

    <li class="nav-item dropdown header-profile">
        <a class="nav-link" href="javascript:void(0);" role="button" data-bs-toggle="dropdown">
            <img src="{{ Auth::user()->image == !null ? asset('storage/user/' . Auth::user()->image) : asset('frontend/img/avatar.svg') }}" width="20" alt="" />
        </a>
        <div class="dropdown-menu dropdown-menu-end" style="z-index: 99">
            <a href="" class="dropdown-item ai-icon">
                <svg id="icon-user2" xmlns="http://www.w3.org/2000/svg" class="text-primary" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                    <circle cx="12" cy="7" r="4"></circle>
                </svg>
                <span class="ms-2">Profile </span>
            </a>
            <a href="" class="dropdown-item ai-icon">
                <i class="fa fa-key text-primary"></i>
                <span class="ms-2">Change Password </span>
            </a>
            <a href="#logout" class="dropdown-item ai-icon" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <svg xmlns="http://www.w3.org/2000/svg" class="text-danger" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                    <polyline points="16 17 21 12 16 7"></polyline>
                    <line x1="21" y1="12" x2="9" y2="12"></line>
                </svg>
                <span class="ms-2">Logout </span>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
    </li>
</ul>
