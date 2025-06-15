@extends('layouts.template')

@section('title', 'Dashboard Super Admin')

@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    .header-nav {
        display: flex;
        align-items: center;
        gap: 20px;
        margin-left: auto;
    }
    .header-content {
        display: flex;
        align-items: center;
        justify-content: space-between;
        width: 100%;
    }
    .profile-dropdown, .notification-dropdown {
        position: relative;
    }
    .profile-btn, .notification-btn {
        background: none;
        border: none;
        color: white;
        cursor: pointer;
        padding: 8px 12px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .profile-avatar {
        width: 35px;
        height: 35px;
        border-radius: 50%;
        background: linear-gradient(45deg, #007bff, #0056b3);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 600;
    }
    .profile-info {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
    }
    .profile-name { font-size: 0.9rem; font-weight: 500; }
    .profile-role { font-size: 0.75rem; opacity: 0.8; }
    .profile-dropdown-menu {
        position: absolute;
        top: 100%;
        right: 0;
        background: white;
        border-radius: 8px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
        width: 200px;
        z-index: 1000;
        display: none;
        margin-top: 8px;
    }
    .profile-dropdown-menu.show { display: block; }
    .profile-dropdown-item {
        display: block;
        padding: 12px 16px;
        color: #333;
        text-decoration: none;
        border-bottom: 1px solid #f0f0f0;
    }
    .profile-dropdown-item.logout { color: #dc3545; }
    .profile-dropdown-item:last-child { border-bottom: none; }

    /* Ini untuk horizontal fade scroll */
    .menu-cards {
        display: flex;
        gap: 20px;
        overflow-x: auto;
        padding-bottom: 15px;
        scroll-snap-type: x mandatory;
        -webkit-overflow-scrolling: touch;
    }

    .menu-cards::-webkit-scrollbar {
        height: 8px;
    }
    .menu-cards::-webkit-scrollbar-thumb {
        background: #007bff;
        border-radius: 4px;
    }

    .menu-card {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        width: 350px;
        padding: 20px;
        text-align: center;
        transition: transform 0.3s, opacity 0.5s ease;
        flex-shrink: 0;
        scroll-snap-align: center;
        opacity: 0;
        transform: translateX(50px);
        animation: fadeInSlide 0.8s forwards;
    }

    @keyframes fadeInSlide {
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    .menu-card:hover {
        transform: scale(1.05);
    }

    .menu-card-image {
        font-size: 50px;
        margin-bottom: 10px;
        color: #007bff;
    }

    .menu-card-title h5 {
        margin: 10px 0 5px 0;
        font-size: 1rem;
    }
</style>

<body>
    <div class="full-header header">
        <div class="header-content">
            <nav aria-label="breadcrumb" class="header-breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Pages</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Dashboard Super Admin</li>
                </ol>
                <h5 class="mb-0" style="font-size: 1.1rem; color: white;">Dashboard Super Admin</h5>
            </nav>

            <div class="header-nav">
                <div class="profile-dropdown">
                    <button class="profile-btn" onclick="toggleProfileDropdown()">
                        <div class="profile-avatar">
                            @if(Auth::user()->gambar)
                                <img src="{{ asset('storage/gambar/' . Auth::user()->gambar) }}" alt="Gambar Profil" width="35" height="35" style="border-radius: 50%;">
                            @else
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            @endif
                        </div>
                        <div class="profile-info">
                            <span class="profile-name">{{ Auth::user()->name }}</span>
                            <span class="profile-role">{{ Auth::user()->level->level_nama }}</span>
                        </div>
                        <i class="fas fa-chevron-down" style="font-size: 0.8rem;"></i>
                    </button>
                    <div class="profile-dropdown-menu" id="profileDropdown">
                        <a href="/profil" class="profile-dropdown-item"><i class="fas fa-user"></i> Lihat Profil</a>
                        <a href="/logout" class="profile-dropdown-item logout" onclick="return confirm('Apakah Anda yakin ingin keluar?')">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="main-content">
        <div class="login-alert" id="loginAlert">
            <div>
                <h3>Selamat datang, {{ Auth::user()->name }}!</h3>
                <h6>Anda adalah Super Admin. Anda bisa mengoperasikan sistem dengan wewenang tertentu melalui pilihan menu di bawah.</h6>
            </div>
            <button class="close-btn" onclick="document.getElementById('loginAlert').style.display='none'">×</button>
        </div>

        <div class="menu-section">
            <div class="section-title">
                <i class="fas fa-bars"></i>
                <h5>Pilih Menu</h5>
            </div>

            <div class="menu-cards">
                <a href="{{ route('superadmin.user.index') }}" class="menu-card kriteria-card">
                    <span class="menu-card-badge">New</span>
                    <div class="menu-card-image"><i class="fas fa-users-cog"></i></div>
                    <div class="menu-card-title">
                        <h5>Manajemen User</h5>
                        <p class="text-muted mt-2 mb-0" style="font-size: 0.85rem;">Kelola data user</p>
                    </div>
                </a>

                <a href="{{ route('superadmin.level.index') }}" class="menu-card kriteria-card">
                    <span class="menu-card-badge">New</span>
                    <div class="menu-card-image"><i class="fas fa-layer-group"></i></div>
                    <div class="menu-card-title">
                        <h5>Manajemen Level</h5>
                        <p class="text-muted mt-2 mb-0" style="font-size: 0.85rem;">Kelola level akses</p>
                    </div>
                </a>

                <a href="{{ route('superadmin.kriteria.index') }}" class="menu-card kriteria-card">
                    <span class="menu-card-badge">New</span>
                    <div class="menu-card-image"><i class="fas fa-list-check"></i></div>
                    <div class="menu-card-title">
                        <h5>Manajemen Kriteria</h5>
                        <p class="text-muted mt-2 mb-0" style="font-size: 0.85rem;">Kelola kriteria penilaian</p>
                    </div>
                </a>
            </div>
        </div>
    </div>

<script>
    function toggleProfileDropdown() {
        const dropdown = document.getElementById("profileDropdown");
        dropdown.classList.toggle("show");
    }

    document.addEventListener('click', function(event) {
        const profileDropdown = document.getElementById("profileDropdown");
        const profileBtn = document.querySelector('.profile-btn');
        if (!profileBtn.contains(event.target)) {
            profileDropdown.classList.remove("show");
        }
    });
</script>

@endsection
