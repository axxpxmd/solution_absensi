<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                {{-- <li class="breadcrumb-item text-white text-sm"><a class="opacity-5 text-white font-weight-bold" href="javascript:;">Halaman</a></li> --}}
            </ol>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            </div>
            <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                <a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
                    <div class="sidenav-toggler-inner">
                        <i class="sidenav-toggler-line bg-white"></i>
                        <i class="sidenav-toggler-line bg-white"></i>
                        <i class="sidenav-toggler-line bg-white"></i>
                    </div>
                </a>
            </li>
            <ul class="navbar-nav  justify-content-end">
                <li class="nav-item dropdown pe-2 d-flex align-items-center">
                    <span class="text-white fw-bold fs-14 mx-3">Administrator</span>
                    <a href="javascript:;" class="nav-link text-white p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        <img class="img-fluid mx-auto d-block rounded-circle img-circular" width="40" src="{{ asset('images/default.png') }}" alt="Foto Profil">
                    </a>
                    <ul class="dropdown-menu  dropdown-menu-end px-2 py-2 me-sm-n4" style="margin-top: 30px !important; margin-right: -8px !important" aria-labelledby="dropdownMenuButton">
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item">
                            <i class="fa-solid fa-right-from-bracket" style="margin-right: 10px !important"></i><span class="fw-bold fs-14">Log Out</span>
                        </a>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

