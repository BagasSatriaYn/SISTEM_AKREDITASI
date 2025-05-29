<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4" id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="#">
            <img src="{{ asset('img/logo.png') }}" width="30px" height="30px" class="navbar-brand-img h-100"
                alt="main_logo">
            <span class="ms-1 aksib-brand">AKSIB</span>
        </a>
    </div>

    <hr class="horizontal dark mt-0">

    <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            @php
                $user = Auth::user();
                $levelKode = $user->level->level_kode ?? null;
                
                // Kategorisasi role
                $isAdminAnggota = in_array($levelKode, ['A1','A2','A3','A4','A5','A6','A7','A8','A9']);
                $isValidator = in_array($levelKode, ['KJR','SPI','DKT']); // Kajur, KPS, Direktur
                
                // Tentukan route validasi berdasarkan role
                $validasiRoute = '';
                if (in_array($levelKode, ['KJR','SPI'])) {
                    $validasiRoute = route('validasi.1'); // Untuk KPS dan Kajur
                } elseif ($levelKode === 'DKT') {
                    $validasiRoute = route('validasi.2'); // Untuk Direktur/KJM
                }
            @endphp

            <!-- Dashboard (Semua Role) -->
            <li class="nav-item">
                <a class="nav-link active" href="#">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-tachometer-alt text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>

            <!-- Menu Kriteria (Hanya untuk Admin/Anggota) -->
            @if($isAdminAnggota)
            <li class="nav-item">
                <a class="nav-link" href="#kriteriaDropdown" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="kriteriaDropdown">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-folder text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Kriteria</span>
                </a>

                <div class="collapse" id="kriteriaDropdown">
                    @php
                        $kriteriaList = [
                            'A1' => 1,
                            'A2' => 2,
                            'A3' => 3,
                            'A4' => 4,
                            'A5' => 5,
                            'A6' => 6,
                            'A7' => 7,
                            'A8' => 8,
                            'A9' => 9,
                        ];
                        $aktifKriteria = $kriteriaList[$levelKode] ?? null;
                    @endphp

                    <ul class="navbar-nav ms-3">
                        @for($i = 1; $i <= 9; $i++)
                            @php
                                $isActive = ($aktifKriteria == $i);
                                $url = $isActive ? url("/kriteria{$i}/index/") : '#';
                            @endphp
                            
                            <li class="nav-item">
                                <a class="nav-link {{ $isActive ? '' : 'disabled text-muted' }}" 
                                   href="{{ $url }}"
                                   @if(!$isActive) aria-disabled="true" tabindex="-1" @endif>
                                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                        <i class="fas fa-file-alt {{ $isActive ? 'text-primary' : 'text-secondary' }} text-sm opacity-10"></i>
                                    </div>
                                    <span class="nav-link-text ms-1">Kriteria {{ $i }}</span>
                                </a>
                            </li>
                        @endfor
                    </ul>   
                </div>
            </li>
            @endif

            <!-- Menu Validasi (Hanya untuk Validator) -->
            @if($isValidator)
            <li class="nav-item">
                <a class="nav-link" href="{{ $validasiRoute }}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-check-circle text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Validasi</span>
                </a>
            </li>
            @endif

            <!-- Dokumen Final (Hanya untuk Validator) -->
            @if($isValidator)
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('dokumen-final*') ? 'active' : '' }}" 
                href="{{ route('dokumen-final.index') }}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-file-alt text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text">Dokumen Final</span>
                </a>
            </li>
            @endif
        </ul>
    </div>
    
    <div style="height:180px !important">&nbsp;</div>
    <!-- Logout -->
    <div class="sidenav-footer mx-3">
        <div class="card card-plain shadow-none" id="sidenavCard">
            <div class="card-body text-center p-3 w-100 pt-0">
                <a href="{{ route('logout') }}" class="btn btn-danger btn-sm mb-0 w-100" type="button">Logout</a>
            </div>
        </div>
    </div>
</aside>