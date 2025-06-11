@php
    $user = Auth::user();
    $level = $user->level->level_kode ?? null;
@endphp

<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4" id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="#">
            <img src="{{ asset('img/logo.png') }}" width="30" height="30" class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-1 aksib-brand">AKSIB</span>
        </a>
    </div>

    <hr class="horizontal dark mt-0">

    <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">

            {{-- Dashboard --}}
            <li class="nav-item">
                <a class="nav-link active" href="{{
                    $level === 'SUPER' ? route('superadmin.dashboard') :
                    ($level === 'KJR' ? route('kajur.dashboard') :
                    ($level === 'DKT' ? route('direktur.dashboard') :
                    route('anggota.dashboard')))
                }}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-tachometer-alt text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>

            {{-- Profil Pengguna --}}
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('profile.show') ? 'active' : '' }}" href="{{ route('profile.show') }}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-user text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Profil Pengguna</span>
                </a>
            </li>

            {{-- Anggota: hanya akses kriteria masing-masing --}}
            @if(Str::startsWith($level, 'A'))
                @php $kriteriaNomor = substr($level, 1); @endphp
                <li class="nav-item">
                    <a class="nav-link" href="{{ url("/kriteria$kriteriaNomor/index") }}">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-file-alt text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Kriteria {{ $kriteriaNomor }}</span>
                    </a>
                </li>
            @endif

            {{-- Kajur: akses validasi 1 --}}
            @if($level === 'KJR')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('validasi1') }}">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-check-circle text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Validasi 1</span>
                    </a>
                </li>
            @endif

            {{-- Direktur: akses validasi 2 & dokumen final --}}
            @if($level === 'DKT')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('validasi2') }}">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-check-double text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Validasi 2</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('direktur.finalisasi.pdf', ['idFinalisasi' => 1]) }}">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-file-pdf text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Dokumen Final</span>
                    </a>
                </li>
            @endif

            {{-- Superadmin --}}
            @if($level === 'SUPER')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('superadmin.user.index') }}">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-user-gear text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Kelola User</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('superadmin.level.index') }}">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-list-check text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Kelola Level</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('superadmin.kriteria.index') }}">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-server text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Kelola Kriteria</span>
                    </a>
                </li>
            @endif

            

        </ul>
    </div>

    {{-- Logout Button --}}
    <div class="sidenav-footer mx-3">
        <div class="card card-plain shadow-none" id="sidenavCard">
            <div class="card-body text-center p-3 w-100 pt-0">
                <a href="{{ route('logout') }}" class="btn btn-danger btn-sm mb-0 w-100" type="button">
                    Logout
                </a>
            </div>
        </div>
    </div>
</aside>
