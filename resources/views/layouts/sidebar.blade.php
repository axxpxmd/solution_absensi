<aside class="sidenav bg-white shadow navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main">
    <div class="sidenav-header text-center p-4">
        <p class="font-weight-bolder fs-20 text-black mb-n5">SOLUTION</p>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link {{ Request::segment(1) == '' ? 'active' : '' }}" href="{{ route('home') }}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Menu</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::segment(1) == 'data-user' ? 'active' : '' }}" href="{{ route('user.index') }}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-single-02 text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Data User</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::segment(1) == 'data-absen' ? 'active' : '' }}" href="{{ route('absen.index') }}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-clipboard-user text-warning text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Data Absen</span>
                </a>
            </li>
        </ul>
    </div>
</aside>
