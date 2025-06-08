@extends('layouts.template')

@section('title', 'Dashboard - Anggota')

@section('content')

<!-- Breadcrumb -->
<div class="full-header header">
    <div class="header-content">
        <nav aria-label="breadcrumb" class="header-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Pages</a></li>
                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
            <h5 class="mb-0" style="font-size: 1.1rem; color: white;">Dashboard Kriteria</h5>
        </nav>
    </div>
</div>

<!-- Main Content -->
<div class="main-content">
    <!-- Welcome Alert -->
    <div class="login-alert" id="loginAlert">
        <div>
            <h5>Selamat Datang, {{ Auth::user()->name }}</h5>
        </div>
        <button class="close-btn" onclick="document.getElementById('loginAlert').style.display='none'">×</button>
    </div>  

    
    <!-- Pilih Menu -->
    <div class="menu-section">
        <div class="section-title">
            <i class="fas fa-bars"></i>
            <h5>Pilih Menu</h5>
        </div>

        <div class="menu-cards">
            <a href="#" class="menu-card kriteria-card">
                <span class="menu-card-badge">New</span>
                <div class="menu-card-image">
                    <i class="fas fa-list-check"></i>
                </div>
                <div class="menu-card-title">
                    <h5>Input Data Kriteria</h5>
                    <p class="text-muted mt-2 mb-0" style="font-size: 0.85rem;">Kelola kriteria penilaian dan parameter sistem</p>
                </div>
            </a>
        </div>
    </div>
</div>

@endsection

@push('css')
<!-- Jika butuh tambahan style -->
<style>
    .login-alert {
        background-color: #E6F2FF;
        padding: 15px;
        margin-bottom: 20px;
        border-radius: 5px;
        position: relative;
    }
    .close-btn {
        position: absolute;
        right: 10px;
        top: 10px;
        border: none;
        background: transparent;
        font-size: 18px;
        cursor: pointer;
    }
</style>
@endpush
