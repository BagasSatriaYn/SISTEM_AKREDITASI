@extends('layouts.template')
@section('title', 'Edit Level')
@section('content')
<div class="box-header">
    <h3 class="title">Edit Level</h3>
</div>

<!-- Menampilkan pesan success atau error -->
@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
@if (session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

<div class="box-content">
    <form action="{{ route('superadmin.level.update', $level->id_level) }}" method="POST">
        @csrf
        @method('POST') <!-- Gantilah ini jika menggunakan PUT atau PATCH -->

        <div class="form-group">
            <label for="level_kode" class="fw-bold">Kode Level</label>
            <input type="text" name="level_kode" id="level_kode" class="form-control" value="{{ old('level_kode', $level->level_kode) }}" required>
            @error('level_kode') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="level_nama" class="fw-bold">Nama Level</label>
            <input type="text" name="level_nama" id="level_nama" class="form-control" value="{{ old('level_nama', $level->level_nama) }}" required>
            @error('level_nama') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="{{ route('superadmin.level.index') }}" class="btn btn-secondary">Batal</a>
        </div>
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
    .form-group {
        margin-bottom: 20px;
    }
    .btn-primary {
        background-color: #00437F;
        border: none;
    }
    .btn-secondary {
        background-color: #6c757d;
        border: none;
    }
    .alert {
        margin-top: 20px;
    }
</style>
@endpush
