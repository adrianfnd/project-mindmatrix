<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4"
    id="sidenav-main">
    <div class="sidenav-header d-flex justify-content-center">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="#">
            <img src="{{ asset('assets/image_asset/logo.png') }}" class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-1 font-weight-bold">Mind Matrix</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                    href="{{ route('admin.dashboard') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.minat.dashboard') ? 'active' : '' }}"
                    href="{{ route('admin.minat.dashboard', ['limit_per_page' => '10']) }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-hat-3 text-warning text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Minat Bakat - User Test</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.minat.setting.dashboard') ? 'active' : '' }}"
                    href="{{ route('admin.minat.setting.dashboard', ['limit_per_page' => '10']) }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-settings text-success text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Minat Bakat - Setting Page</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.user.dashboard') ? 'active' : '' }}"
                    href="{{ route('admin.user.dashboard', ['limit_per_page' => 10]) }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-circle-08 text-info text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Setting Website - User</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.role.dashboard') ? 'active' : '' }}"
                    href="{{ route('admin.role.dashboard', ['limit_per_page' => 10]) }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-badge text-danger text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Setting Website - Role</span>
                </a>
            </li>
            <hr class="horizontal dark mt-3">
            <li class="nav-item mt-auto">
                <a class="nav-link" href="{{ route('admin.logout') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-user-run text-danger text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Logout</span>
                </a>
            </li>
        </ul>
    </div>
</aside>
