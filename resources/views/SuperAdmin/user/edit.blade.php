@extends('layouts.template')
@section('title', 'Edit User')
@section('content')
<div class="box-header">
    <h3 class="title">Edit User</h3>
</div>
<div class="box-content">
    <div class="box-informasi">
        <div class="informasi">
            <center>
                <h4><strong>Informasi</strong><br></h4>
                Halaman ini digunakan untuk <strong>mengedit data user</strong> dalam sistem.
            </center>
        </div>
    </div>

    <!-- Form Edit -->
    <form action="{{ route('superadmin.user.update', $user->id_user) }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Level Pengguna</label>
            <select name="id_level" class="form-control" required>
                <option value="">- Pilih Level -</option>
                @foreach ($levels as $level)
                    <option value="{{ $level->id_level }}" {{ $user->id_level == $level->id_level ? 'selected' : '' }}>
                        {{ $level->level_nama }}
                    </option>
                @endforeach
            </select>
            @error('id_level')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" value="{{ old('username', $user->username) }}" class="form-control" required>
            @error('username')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control" required>
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Password (Kosongkan jika tidak diubah)</label>
            <input type="password" name="password" class="form-control">
            @error('password')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="{{ route('superadmin.user.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection

@push('css')
<style>
    .box-content {
        background-color: white;
        padding: 20px;
        border-radius: 5px;
        margin-bottom: 20px;
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
    }
    .box-header {
        background-color: #354868;
        padding: 15px;
        border-radius: 5px;
        margin-bottom: 20px;
        margin-top: 1%;
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
    }
    .title {
        color: white;
        font-size: 20px;
        font-weight: bold;
        margin-top: 8px;
    }
    .box-informasi {
        background-color: #E6F2FF;
        padding: 50px;
        border-radius: 5px;
        margin-bottom: 20px;
    }
    .informasi {
        color: #1F4265;
    }
    .h4 {
        font-weight: bold;
        margin-bottom: 20px;
    }
</style>
@endpush
