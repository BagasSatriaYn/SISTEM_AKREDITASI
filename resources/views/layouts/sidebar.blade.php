<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4" id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="https://demos.creative-tim.com/argon-dashboard/pages/dashboard.html" target="_blank">
            <img src="{{ asset('Argon/assets/img/LogoAksib.png') }}" width="30px" height="30px" class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-1 font-weight-bold">AKSIB</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link active" href="{{ asset('Argon/pages/dashboard.html') }}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-tv-2 text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#kriteriaDropdown" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="kriteriaDropdown">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-folder-17 text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Kriteria</span>
                </a>
                <div class="collapse" id="kriteriaDropdown">
                    <ul class="navbar-nav ms-3">
                        <li class="nav-item">
                            <a class="nav-link" href="#">Kriteria 1</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Kriteria 2</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Kriteria 3</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Kriteria 4</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Kriteria 5</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Kriteria 6</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Kriteria 7</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Kriteria 8</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Kriteria 9</a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
    <div class="sidenav-footer mx-3">
        <div class="card card-plain shadow-none" id="sidenavCard">
            <div class="card-body text-center p-3 w-100 pt-0">
                <a href="{{ route('logout') }}" class="btn btn-danger btn-sm mb-0 w-100" type="button">Logout</a>
            </div>
        </div>
    </div>
</aside>
