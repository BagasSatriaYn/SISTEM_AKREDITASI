@extends('layouts.template')

@section('title', 'Profil Pengguna')

@section('content')
<div class="profile-container">
    <div class="profile-card">
        <div class="profile-image">
            <img src="{{ $user->profile_picture ? asset('storage/' . $user->profile_picture) : 'https://via.placeholder.com/120' }}" alt="Profile Picture">
        </div>
        <form action="{{ route('profile.upload') }}" method="POST" enctype="multipart/form-data" class="upload-form">
            @csrf
            <input type="file" name="profile_picture" id="profile_picture" accept="image/*" onchange="this.form.submit()" style="display: none;">
            <label for="profile_picture" class="upload-btn">Upload Foto</label>
            @error('profile_picture')
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
                <span class="label">Level</span>
                <span class="value">{{ $level }}</span>
            </div>
        </div>
    </div>
</div>

@if(session('success'))
    <div class="alert-welcome">
        <strong>{{ session('success') }}</strong>
        <button type="button" class="close-btn"></button>
    </div>
@endif
@endsection