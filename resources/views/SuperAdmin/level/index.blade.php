@extends('layouts.template')
@section('title', 'Kelola Level')
@section('content') 
<div class="box-header">
    <h3 class="title">Kelola Level</h3>
</div>
<div class="box-content">
    <div class="box-informasi">
        <div class="informasi">
            <center>
                <h4><strong>Informasi</strong><br></h4>
                Halaman ini digunakan untuk <strong>mengelola data level</strong> dalam sistem.  
                Anda dapat menambahkan, mengedit, menghapus, dan melihat detail setiap level.  
                Pastikan setiap data level yang dikelola sudah sesuai dengan kebutuhan sistem.
            </center>
        </div>
    </div>  

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                        <h6>{{ $page->title }}</h6>
                        <!-- <button onclick="modalAction('{{ url('superadmin/levelinput') }}')" class="btn btn-sm btn-success">
                            Tambah Data
                        </button> -->
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="px-3 mt-3">
                            @if (session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif
                            @if (session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif
                        </div>
                        <div class="table-responsive p-0">
                           <table class="table align-items-center mb-0" id="table_level">
                          <thead>
                              <tr>
                                  <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 text-center">
                                      ID
                                  </th>
                                  <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                      Kode Level
                                  </th>
                                  <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                      Nama Level
                                  </th>
                                  <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 text-center">
                                      Aksi
                                  </th>
                              </tr>
                          </thead>
                      </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div id="myModal" class="modal fade animate shake" tabindex="-1" role="dialog" data-backdrop="static"
        data-keyboard="false" data-width="75%" aria-hidden="true" style="display: none;">
    </div>
    <!-- Modal Preview - Hanya Detail Level -->
   <!-- Modal Preview - Hanya Detail Level -->
<div id="myModal" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Level</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form Tambah Level -->
                <form action="{{ route('superadmin.level.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="level_kode" class="fw-bold">Kode Level</label>
                        <input type="text" name="level_kode" id="level_kode" class="form-control" value="{{ old('level_kode') }}" required>
                        @error('level_kode') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label for="level_nama" class="fw-bold">Nama Level</label>
                        <input type="text" name="level_nama" id="level_nama" class="form-control" value="{{ old('level_nama') }}" required>
                        @error('level_nama') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>    


@endsection

@push('css')
<style>
    .box-content{
        background-color: white;
        padding: 20px;
        border-radius: 5px;
        margin-bottom: 20px;
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
    }
    .box-header{
        background-color: #354868;
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
@endpush

@push('js')

<script>
    var dataDetail;
    const base_url = "{{ url('superadmin') }}";

    function modalAction(url = '') {
        $('#myModal').load(url, function () {
            $('#myModal').modal('show');
        });
    }

    $(document).ready(function () {
    dataLevel = $('#table_level').DataTable({
        serverSide: true,
        processing: true,
        ajax: {
            url: "{{ url('superadmin/levellist') }}",
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        },
        columns: [
            {
                data: "DT_RowIndex",
                name: "DT_RowIndex",
                className: "text-center text-sm",
                orderable: false,
                searchable: false
            },
            {
                data: "level_kode",  // Menambahkan kolom level_kode
                name: "level_kode",
                className: "text-sm"
            },
            {
                data: "level_nama",
                name: "level_nama",
                className: "text-sm"
            },
            {
                data: "aksi",
                name: "aksi",
                className: "text-center text-xs",
                orderable: false,
                searchable: false
            }
        ]
    });
});

    function showPreviewModal(id) {
    const url = "{{ url('superadmin/level') }}/" + id;  // URL untuk mengambil data level

    $.get(url, function(data) {
        // Isi form modal dengan data level
        $('#level_nama').val(data.level_nama ?? '-');
        $('#level_kode').val(data.level_kode ?? '-');
        
        // Tampilkan modal dengan data level
        $('#previewModal').modal('show');
    });
}


function modalActionDelete(id) {
    Swal.fire({
        title: 'Hapus data ini?',
        text: 'Data tidak dapat dikembalikan!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(`${base_url}/level/${id}/delete`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'Accept': 'application/json'
                }
            })
            .then(res => res.json())
            .then(data => {
                if (data.status) {
                    Swal.fire('Berhasil!', data.message, 'success');
                    dataLevel.ajax.reload();  
                } else {
                    Swal.fire('Gagal!', data.message, 'error');
                }
            })
            .catch(error => {
                console.error(error);
                Swal.fire('Error', 'Terjadi kesalahan saat menghapus.', 'error');
            });
        }
    });
}
</script>

@endpush
