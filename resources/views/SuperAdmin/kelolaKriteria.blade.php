<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<style>
    .box-content{
      background-color: white;
      padding: 20px;
      border-radius: 5px;
      margin-bottom: 20px;
      box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
    }
    .box-header{
      background-color: #00437F;
      padding: 15px;
      border-radius: 5px;
      margin-bottom: 20px;
      margin-top: 1%;
      box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
    }
    .title{
      color: white;
      font-size: 20px;
      font-weight: bold;
      margin-top: 8px;
    }
    .box-informasi{
      background-color: #E6F2FF;
      padding: 50px;
      border-radius: 5px;
      margin-bottom: 20px;
    }
    .informasi{
      color:#1F4265;
    }
    .h4{
      font-weight: bold;
      margin-bottom: 20px;
    }
</style>
<body>
    @extends('layouts.template')
    
@section('title', 'Kelola Kriteria-SuperAdmin')

@section('content')

<div class="box-header">
      <h3 class="title">Kelola Kriteria</h3>
    </div>
  <div class="box-content">
    <div class="box-informasi">
          <div class="informasi">
            <center>
            <h4><strong>Informasi</strong><br></h4>
            Halaman ini digunakan untuk <strong>mengelola data kriteria</strong> dalam sistem.  
            Anda dapat menambahkan, mengedit, menghapus, dan melihat detail setiap kriteria.  
            Pastikan setiap data kriteria yang dikelola sudah sesuai dengan peran dan hak akses yang diberikan.
          </div>
        </div>

        
          <div class="card-body">
      <!-- untuk Filter data -->
        <div id="filter" class="form-horizontal filter-date p-2 border-bottom mb-2">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group form-group-sm row text-sm mb-0">
                        <label for="filter_date" class="col-md-1 col-form-label">Filter</label>
                        <div class="col-md-3">
                            <select name="filter_kategori" class="form-control form-control-sm filter_kategori">
                                <option value="">- Semua -</option>
                                    <option>Pelaksana</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mb-3 text-end">
          <button type="button" class="btn btn-primary" id="btnShowModalKriteria">
            <i class="fas fa-plus"></i> Tambah Kriteria
          </button>
        </div>

        <table id="tableKriteria" class="table" style="text-align: center; width: 100%;">
        <thead class="table-primary">
          <tr>
            <th>NO</th>
            <th>Nama Kriteria</th>
            <th>Pelaksana</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody id="tableBody">
          <!-- Data akan diisi JS -->
        </tbody>
      </table>

        <!-- Modal Tambah Kriteria -->
<div class="modal fade" id="modalTambahKriteria" tabindex="-1" role="dialog" aria-labelledby="modalTambahUserLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <form id="formTambahKriteria" enctype="multipart/form-data">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Tambah Kriteria</h5>
        </div>

        <div class="modal-body">
          <div class="row">
            <div class="col-md-14 mb-3">
              <label>Nama Kriteria</label>
              <input type="text" name="nama_kriteria" class="form-control" required>
            </div>
            <div class="col-md-14 mb-3">
              <label>Penanggung Jawab</label>
              <select name="user_id" class="form-control" required>
                <option value="">-- Pilih Penanggung Jawab --</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
              </select>
            </div>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-danger" id="btnBatalTambahUser">Batal</button>
          <button type="submit" class="btn btn-success" id="btnSimpanUser">Simpan</button>
        </div>
      </div>
    </form>
  </div>
</div>
@push('js')
<script>
$(document).ready(function() {
    // Tampilkan modal saat tombol tambah diklik
    $('#btnShowModalKriteria').on('click', function () {
        $('#formTambahKriteria')[0].reset();
        $('#modalTambahKriteria').modal('show');
    });

    // Tutup modal
    $('#btnBatalTambahUser').on('click', function () {
        $('#modalTambahKriteria').modal('hide');
    });

    // Simpan data dengan AJAX
    $('#formTambahKriteria').on('submit', function (e) {
        e.preventDefault();

        let form = $(this);
        let formData = form.serialize();

        // Validasi sederhana
        let nama = $('input[name="nama_kriteria"]').val().trim();
        let pelaksana = $('input[name="pelaksana"]').val().trim();

        if (nama === '' || pelaksana === '') {
            alert('Nama Kriteria dan Pelaksana wajib diisi!');
            return;
        }

        $.ajax({
            url: "{{ route('kriteria.store') }}", // Ganti sesuai route
            method: 'POST',
            data: formData,
            success: function (res) {
                $('#modalTambahKriteria').modal('hide');
                $('#formTambahKriteria')[0].reset();
                alert('Data berhasil disimpan!');
                // reloadTabelKriteria(); // Kalau pakai DataTables
            },
            error: function (xhr) {
                alert('Gagal menyimpan data!');
            }
        });
    });
});
</script>
@endpush

@endsection
</body>
</html>
