@extends('layouts.template')
@section('title', 'Edit Kriteria')
@section('content')
<div class="box-header">
    <h3 class="title">Edit Kriteria</h3>
</div>
<div class="box-content">
    <div class="box-informasi">
        <div class="informasi">
            <center>
                <h4><strong>Informasi</strong><br></h4>
                Form ini digunakan untuk <strong>mengubah nama kriteria</strong> dalam sistem.
            </center>
        </div>
    </div>

    <form action="{{ url('superadmin/kriteria/' . $kriteria->id_kriteria . '/update') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Nama Kriteria</label>
            <input type="text" name="nama" value="{{ old('nama', $kriteria->nama) }}" class="form-control" required>
            @error('nama')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="{{ route('superadmin.kriteria.index') }}" class="btn btn-danger">Batal</a>
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
        background-color:  #354868;
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
