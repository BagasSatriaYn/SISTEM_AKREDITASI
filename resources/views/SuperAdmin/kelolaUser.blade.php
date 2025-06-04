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
    
@section('title', 'Kelola User-SuperAdmin')

@section('content')

<div class="box-header">
      <h3 class="title">Kelola User</h3>
    </div>
  <div class="box-content">
    <div class="box-informasi">
          <div class="informasi">
            <center>
            <h4><strong>Informasi</strong><br></h4>
            Halaman ini digunakan untuk <strong>mengelola data user</strong> dalam sistem.  
            Anda dapat menambahkan, mengedit, menghapus, dan melihat detail setiap user.  
            Pastikan setiap data user yang dikelola sudah sesuai dengan peran dan hak akses yang diberikan.
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
                                  <option>ID User</option>
                                  <option>Nama</option>
                                  <option>Role</option>
                                  <option>Hak Akses</option>
                          </select>
                      </div>
                      <div class="col-md-15 text-end">
                          <button class="btn btn-primary mb-2" id="btnTambahUser">
                              <i class="fas fa-plus"></i> Tambah User
                          </button>
                      </div>
                    </div>
              </div>
          </div>
      </div>


        <table id="tableKriteria" class="table" style="text-align: center; width: 100%;">
        <thead class="table-primary">
          <tr>
            <th>ID User</th>
            <th>Nama</th>
            <th>Role</th>
            <th>Hak Akses</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody id="tableBody">
          <!-- Data akan diisi JS -->
        </tbody>
      </table>

<!-- Modal Tambah User -->
<div class="modal fade" id="modalTambahUser" tabindex="-1" role="dialog" aria-labelledby="modalTambahUserLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <form id="formTambahUser" enctype="multipart/form-data">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Tambah User</h5>
        </div>

        <div class="modal-body">
          <div class="row">
            <div class="col-md-6 mb-3">
              <label>Nama</label>
              <input type="text" name="nama" class="form-control" required>
            </div>
            <div class="col-md-6 mb-3">
              <label>Password</label>
              <input type="password" name="password" class="form-control" required>
            </div>
            <div class="col-md-6 mb-3">
              <label>Role</label>
              <select name="role" class="form-control" required>
                <option value="">-- Pilih Role --</option>
                <option value="admin">Admin</option>
                <option value="superadmin">Superadmin</option>
                <option value="validator">Validator</option>
              </select>
            </div>
            <div class="col-md-6 mb-3">
              <label>Konfirmasi Password</label>
              <input type="password" name="password_confirmation" class="form-control" required>
            </div>
            <div class="col-md-6 mb-3">
              <label>Hak Akses</label>
              <select name="hak_akses" class="form-control" required>
                <option value="">-- Pilih --</option>
                <option value="full">Full Akses</option>
                <option value="kriteria1">Kriteria 1</option>
                <option value="kriteria2">Kriteria 2</option>
                <option value="kriteria3">Kriteria 3</option>
                <option value="kriteria4">Kriteria 4</option>
                <option value="kriteria5">Kriteria 5</option>
                <option value="kriteria6">Kriteria 6</option>
                <option value="kriteria7">Kriteria 7</option>
                <option value="kriteria8">Kriteria 8</option>
                <option value="kriteria9">Kriteria 9</option>
                <option value="dokumentFinal">Dokument Final</option>
                <option value="validasi">Validasi</option>
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

<script>
$(document).ready(function() {
    // Tampilkan modal saat tombol diklik
    $('#btnTambahUser').on('click', function() {
        $('#formTambahUser')[0].reset(); // reset form
        $('#modalTambahUser').modal('show');
    });

    // Simpan data via AJAX
    $('#formTambahUser').on('submit', function(e) {
        e.preventDefault();

        let formData = new FormData(this);

        $.ajax({
            type: 'POST',
            url: '{{ route("simpanUser") }}',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                $('#modalTambahUser').modal('hide');
                $('#formTambahUser')[0].reset();
                // Refresh DataTable (jika pakai Yajra)
                $('#tableKriteria').DataTable().ajax.reload();
                Swal.fire('Sukses!', 'User berhasil ditambahkan.', 'success');
            },
            error: function(xhr) {
                let errors = xhr.responseJSON.errors;
                let message = '';
                $.each(errors, function(key, value) {
                    message += `${value}<br>`;
                });
                Swal.fire('Gagal!', message, 'error');
            }
        });
    });
    $('#btnBatalTambahUser').on('click', function() {
        $('#modalTambahUser').modal('hide');
    });

});
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>

@endsection
</body>
</html>
