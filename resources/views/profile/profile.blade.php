@extends('layouts.template')

@section('title', 'Profil Pengguna')

@section('content')

<div class="profile-container">
    <div class="profile-card">
        <div class="profile-image">
            <img src="{{ $user->profile ? asset('storage/' . ltrim($user->profile, '/')) : 'https://via.placeholder.com/160' }}" alt="Profile Picture">

        </div>

        <form action="{{ route('profile.upload') }}" method="POST" enctype="multipart/form-data" class="upload-form">
            @csrf
            <input type="file" name="profile" id="profile" accept="image/*" onchange="this.form.submit()" style="display: none;">
            <label for="profile" class="upload-btn">Upload Foto</label>
            @error('profile')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </form>

        <div class="profile-info">
            <div class="info-item">
                <span class="label">Username</span>
                <span class="value">{{ $user->username }}</span>
            </div>
            <div class="info-item">
                <span class="label">Nama</span>
                <span class="value">{{ $user->name }}</span>
            </div>
            <div class="info-item">
                <span class="label">Role</span>
                <span class="value">{{ $user->getRoleName() ?? 'Unknown Role' }}</span>
            </div>

        </div>

        <a href="{{ route('logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
           class="logout-btn">
           Keluar <i class="fas fa-sign-out-alt"></i>
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
</div>

@if(session('success'))
    <div class="alert-welcome">
        <strong>{{ session('success') }}</strong>
        <button type="button" class="close-btn" onclick="this.parentElement.style.display='none';">&times;</button>
    </div>
@endif
@endsection
<style>
    .profile-container {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 60px 20px;
        background-color: #F5F6F8;
        min-height: 100vh;
    }

    .profile-card {
        background-color: #ffffff;
        border-radius: 20px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        padding: 40px;
        width: 100%;
        max-width: 600px;
        text-align: center;
    }

    .profile-image img {
        width: 300px;
        height: 300px;
        object-fit: cover;
        border-radius: 50%;
        border: 5px solid #ffffff;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
    }

    .upload-btn {
        display: inline-block;
        background-color: transparent;
        color: #007BFF;
        text-decoration: underline;
        cursor: pointer;
        margin-bottom: 20px;
        font-weight: 500;
    }

    .profile-info {
        text-align: left;
        margin-top: 20px;
    }

    .info-item {
        display: flex;
        justify-content: space-between;
        margin-bottom: 15px;
        padding: 10px 15px;
        background-color: #f0f2f5;
        border-radius: 8px;
        font-size: 15px;
    }

    .info-item .label {
        font-weight: bold;
        color: #333;
    }

    .info-item .value {
        color: #555;
    }

    .logout-btn {
        display: inline-block;
        background-color: #e53935;
        color: white;
        padding: 12px 24px;
        margin-top: 30px;
        font-weight: 600;
        border-radius: 10px;
        text-decoration: none;
        transition: background-color 0.3s ease;
    }

    .logout-btn:hover {
        background-color: #c62828;
    }

    .alert-welcome {
        margin-top: 20px;
        background-color: #d4edda;
        color: #155724;
        padding: 15px;
        border-radius: 6px;
        border: 1px solid #c3e6cb;
    }

    .close-btn {
        float: right;
        background: none;
        border: none;
        font-size: 20px;
        color: #155724;
        cursor: pointer;
    }
</style>