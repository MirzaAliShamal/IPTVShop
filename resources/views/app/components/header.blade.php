<div class="header-wrapper">
    <div class="container-fluid w-100 d-flex align-items-stretch justify-content-between justify-content-lg-end">
        <div class="header-logo d-flex d-lg-none justify-content-center align-items-center gap-3">
            <div class="header-toggle" data-bs-toggle="offcanvas" data-bs-target="#sidebar-wrapper" aria-controls="sidebar-wrapper">
                <svg width="40" height="31" viewBox="0 0 40 31" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect width="40" height="5" rx="2.5" fill="#111111"/>
                    <rect y="13" width="40" height="5" rx="2.5" fill="#111111"/>
                    <rect y="26" width="40" height="5" rx="2.5" fill="#111111"/>
                </svg>
            </div>
            <a href="{{ url('/') }}">
                <img src="{{ asset('app/images/iptv-shop-logo.png') }}" alt="Logo" class="logo">
            </a>
        </div>
        <div class="dropdown d-flex align-items-center">
            <div class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                <span class="header-menu">{{ Auth::user()->username }}</span>
            </div>
            <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="{{ route('edit.profile') }}">Edit Profile</a></li>
                <li><a class="dropdown-item" href="{{ route('change.password') }}">Change Password</a></li>
                <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>
            </ul>
        </div>
    </div>
</div>
