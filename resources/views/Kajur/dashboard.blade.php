@extends('layouts.template')

@section('title', 'Dashboard - Kajur')

@section('content')

@php
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

$notifications = Notification::where('user_id', Auth::user()->id_user)->latest()->take(5)->get();
$unreadCount = Notification::where('user_id', Auth::user()->id_user)->where('is_read', false)->count();
@endphp

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<!-- Additional CSS for notification and profile -->
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
        
        /* Notification styles */
        .notification-dropdown {
            position: relative;
        }
        
        .notification-btn {
            background: none;
            border: none;
            color: white;
            font-size: 1.2rem;
            cursor: pointer;
            padding: 8px;
            border-radius: 50%;
            position: relative;
            transition: all 0.3s ease;
        }
        
        .notification-btn:hover {
            background-color: rgba(255, 255, 255, 0.1);
            box-shadow: 0 0 15px rgba(255, 255, 255, 0.3);
            animation: bellRing 0.8s ease-in-out infinite;
        }
        
        /* Bell ringing animation */
        @keyframes bellRing {
            0%, 50%, 100% {
                transform: rotate(0deg);
            }
            10%, 30% {
                transform: rotate(-10deg);
            }
            20%, 40% {
                transform: rotate(10deg);
            }
        }
        
        .notification-badge {
            position: absolute;
            top: 0;
            right: 0;
            background-color: #dc3545;
            color: white;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            font-size: 0.7rem;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid white;
        }
        
        .notification-dropdown-menu {
            position: absolute;
            top: 100%;
            right: 0;
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
            width: 320px;
            max-height: 400px;
            overflow-y: auto;
            z-index: 1000;
            display: none;
            margin-top: 8px;
        }
        
        .notification-dropdown-menu.show {
            display: block;
        }
        
        .notification-header {
            padding: 12px 16px;
            border-bottom: 1px solid #eee;
            font-weight: 600;
            color: #333;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .notification-item {
            padding: 12px 16px;
            border-bottom: 1px solid #f0f0f0;
            cursor: pointer;
            transition: background-color 0.2s;
        }
        
        .notification-item:hover {
            background-color: #f8f9fa;
        }
        
        .notification-item:last-child {
            border-bottom: none;
        }
        
        .notification-item.unread {
            background-color: #f8f9ff;
            border-left: 3px solid #007bff;
        }
        
        .notification-content {
            color: #333;
            font-size: 0.9rem;
        }
        
        .notification-time {
            color: #666;
            font-size: 0.8rem;
            margin-top: 4px;
        }
        
        /* Profile dropdown styles */
        .profile-dropdown {
            position: relative;
        }
        
        .profile-btn {
            background: none;
            border: none;
            color: white;
            cursor: pointer;
            padding: 8px 12px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
        }
        
        .profile-btn:hover {
            background-color: rgba(255, 255, 255, 0.1);
            box-shadow: 0 4px 12px rgba(255, 255, 255, 0.2);
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
            font-size: 0.9rem;
        }
        
        .profile-info {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }
        
        .profile-name {
            font-size: 0.9rem;
            font-weight: 500;
            margin: 0;
        }
        
        .profile-role {
            font-size: 0.75rem;
            opacity: 0.8;
            margin: 0;
        }
        
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
        
        .profile-dropdown-menu.show {
            display: block;
        }
        
        .profile-dropdown-item {
            display: block;
            padding: 12px 16px;
            color: #333;
            text-decoration: none;
            transition: background-color 0.2s;
            border-bottom: 1px solid #f0f0f0;
        }
        
        .profile-dropdown-item:hover {
            background-color: #f8f9fa;
            color: #333;
        }
        
        .profile-dropdown-item:last-child {
            border-bottom: none;
        }
        
        .profile-dropdown-item i {
            margin-right: 8px;
            width: 16px;
        }
        
        .profile-dropdown-item.logout {
            color: #dc3545;
        }
        
        .profile-dropdown-item.logout:hover {
            background-color: #fff5f5;
        }
    </style>

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<!-- Notification and Profile CSS -->
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

    .notification-dropdown { position: relative; }
    .notification-btn {
        background: none;
        border: none;
        color: white;
        font-size: 1.2rem;
        cursor: pointer;
        padding: 8px;
        border-radius: 50%;
        position: relative;
        transition: all 0.3s ease;
    }
    .notification-btn:hover {
        background-color: rgba(255,255,255,0.1);
        box-shadow: 0 0 15px rgba(255,255,255,0.3);
        animation: bellRing 0.8s ease-in-out infinite;
    }
    @keyframes bellRing {
        0%, 50%, 100% { transform: rotate(0deg); }
        10%, 30% { transform: rotate(-10deg); }
        20%, 40% { transform: rotate(10deg); }
    }
    .notification-badge {
        position: absolute;
        top: 0;
        right: 0;
        background-color: #dc3545;
        color: white;
        border-radius: 50%;
        width: 18px;
        height: 18px;
        font-size: 0.7rem;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 2px solid white;
    }
    .notification-dropdown-menu {
        position: absolute;
        top: 100%;
        right: 0;
        background: white;
        border-radius: 8px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
        width: 320px;
        max-height: 400px;
        overflow-y: auto;
        z-index: 1000;
        display: none;
        margin-top: 8px;
    }
    .notification-dropdown-menu.show { display: block; }
    .notification-item {
        padding: 12px 16px;
        border-bottom: 1px solid #f0f0f0;
        cursor: pointer;
    }
    .notification-item.unread {
        background-color: #f8f9ff;
        border-left: 3px solid #007bff;
    }
    .notification-content { color: #333; font-size: 0.9rem; }
    .notification-time { color: #666; font-size: 0.8rem; margin-top: 4px; }

    .profile-dropdown { position: relative; }
    .profile-btn {
        background: none;
        border: none;
        color: white;
        cursor: pointer;
        padding: 8px 12px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
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
    .profile-name { font-size: 0.9rem; font-weight: 500; margin: 0; }
    .profile-role { font-size: 0.75rem; opacity: 0.8; margin: 0; }
    .profile-dropdown-menu {
        position: absolute;
        top: 100%;
        right: 0;
        background: white;
        border-radius: 8px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.15);
        width: 200px;
        display: none;
        margin-top: 8px;
    }
    .profile-dropdown-menu.show { display: block; }
</style>

<!-- Header Bar -->
<div class="full-header header">
    <div class="header-content">
        <nav aria-label="breadcrumb" class="header-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Pages</a></li>
                <li class="breadcrumb-item active">Dashboard Kajur</li>
            </ol>
            <h5 class="mb-0" style="font-size: 1.1rem; color: white;">Dashboard Kajur</h5>
        </nav>

        <div class="header-nav">
            <div class="notification-dropdown">
                <button class="notification-btn" onclick="toggleNotificationDropdown()">
                    <i class="fas fa-bell"></i>
                    @if($unreadCount > 0)
                        <span class="notification-badge">{{ $unreadCount }}</span>
                    @endif
                </button>
                <div class="notification-dropdown-menu" id="notificationDropdown">
                    <div class="notification-header">
                        <span>Notifikasi</span>
                        <small class="text-muted">{{ $unreadCount }} baru</small>
                    </div>
                    @forelse($notifications as $notif)
                        <div class="notification-item {{ !$notif->is_read ? 'unread' : '' }}">
                            <div class="notification-content">
                                <strong>{{ $notif->title }}</strong>
                                <p class="mb-0 text-muted">{{ $notif->message }}</p>
                            </div>
                            <div class="notification-time">{{ $notif->created_at->diffForHumans() }}</div>
                        </div>
                    @empty
                        <div class="notification-item">
                            <div class="notification-content">
                                <strong>Tidak ada notifikasi</strong>
                                <p class="mb-0 text-muted">Belum ada notifikasi terbaru</p>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>

            <div class="profile-dropdown">
                <button class="profile-btn" onclick="toggleProfileDropdown()">
                    <div class="profile-avatar">
                        @if(Auth::user()->gambar)
                            <img src="{{ asset('storage/gambar/' . Auth::user()->gambar) }}" alt="Profil" width="35" height="35" style="border-radius: 50%;">
                        @else
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        @endif
                    </div>
                    <div class="profile-info">
                        <span class="profile-name">{{ Auth::user()->name }}</span>
                        <span class="profile-role">{{ Auth::user()->level->level_nama }}</span>
                    </div>
                    <i class="fas fa-chevron-down" style="font-size: 0.8rem; margin-left: 4px;"></i>
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

<!-- Main Content -->
<div class="main-content">
    <div class="login-alert" id="loginAlert">
        <div>
            <h3>Selamat Datang, {{ Auth::user()->name }}!</h3>
            <h6>Anda adalah {{ Auth::user()->level->level_nama }}. Anda bisa mengoperasikan sistem dengan wewenang tertentu melalui pilihan menu di bawah.</h6>
        </div>
        <button class="close-btn" onclick="document.getElementById('loginAlert').style.display='none'">×</button>
    </div>

    <div class="menu-sectionn">
        <div class="d-flex align-items-center mb-2">
            <i class="fas fa-bars me-2"></i>
            <h5 class="mb-0" style="font-size: 1rem;">Pilih Menu</h5>
        </div>
    </div>

    <div class="menu-cards">
        <a href="{{ route('validasi1') }}" class="menu-card kriteria-card">
            <span class="menu-card-badge">New</span>
            <div class="menu-card-image">
                <i class="fas fa-list-check"></i>
            </div>
            <div class="menu-card-title">
                <h5>Validasi Tahap 1</h5>
                <p class="text-muted mt-2 mb-0" style="font-size: 0.85rem;">Kelola kriteria penilaian dan parameter akreditasi</p>
            </div>
        </a>
    </div>
</div>

<script>
    function toggleNotificationDropdown() {
        const dropdown = document.getElementById('notificationDropdown');
        const profileDropdown = document.getElementById('profileDropdown');
        profileDropdown.classList.remove('show');
        dropdown.classList.toggle('show');
        fetch("{{ url('/notifications/mark-as-read') }}");
    }

    function toggleProfileDropdown() {
        const dropdown = document.getElementById('profileDropdown');
        const notificationDropdown = document.getElementById('notificationDropdown');
        notificationDropdown.classList.remove('show');
        dropdown.classList.toggle('show');
    }

    document.addEventListener('click', function(event) {
        const notificationDropdown = document.getElementById('notificationDropdown');
        const profileDropdown = document.getElementById('profileDropdown');
        const notificationBtn = document.querySelector('.notification-btn');
        const profileBtn = document.querySelector('.profile-btn');

        if (!notificationBtn.contains(event.target) && !notificationDropdown.contains(event.target)) {
            notificationDropdown.classList.remove('show');
        }
        if (!profileBtn.contains(event.target) && !profileDropdown.contains(event.target)) {
            profileDropdown.classList.remove('show');
        }
    });
</script>
@endsection
