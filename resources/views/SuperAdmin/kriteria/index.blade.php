@extends('layouts.template')
@section('title', 'Kelola Kriteria')
@section('content')
<div class="box-header">
    <h3 class="title">Kelola Kriteria</h3>
</div>
<div class="box-content">
    <div class="box-informasi">
        <div class="informasi">
            <center>
                <h4><strong>Informasi</strong><br></h4>
                Halaman ini digunakan untuk <strong>mengelola data kriteria akreditasi</strong> dalam sistem.
                Anda dapat menambahkan, mengedit, menghapus, dan melihat detail kriteria.
            </center>
        </div>
    </div>

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                        <h6>{{ $page->title }}</h6>
                        <a href="{{ url('superadmin/kriteriainput') }}" class="btn btn-sm btn-success">
                            Tambah Data
                        </a>
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
                        <div class="table-responsive p-3">
                            <table class="table align-items-center mb-0" id="table_kriteria">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 text-center">No</th>
                                        <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Nama Kriteria</th>
                                        <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 text-center">Aksi</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Preview - Detail Kriteria -->
    <div class="modal fade" id="previewModal" tabindex="-1" role="dialog" aria-labelledby="previewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Kriteria</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="fw-bold">ID Kriteria:</label>
                        <input type="text" id="id_kriteria" class="form-control" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold">Nama Kriteria:</label>
                        <input type="text" id="nama_kriteria" class="form-control" readonly>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    $(document).ready(function () {
        $('#table_kriteria').DataTable({
            serverSide: true,
            processing: true,
            ajax: {
                url: "{{ url('superadmin/kriterialist') }}",
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            },
            columns: [
                {
                    data: "DT_RowIndex",
                    name: "DT_RowIndex",
                    className: "text-center",
                    orderable: false,
                    searchable: false
                },
                {
                    data: "nama",
                    name: "nama"
                },
                {
                    data: "aksi",
                    name: "aksi",
                    className: "text-center",
                    orderable: false,
                    searchable: false
                }
            ]
        });
    });

    function showPreviewModal(id) {
        const url = `/superadmin/kriteria/${id}/show`;

        $.get(url, function(data) {
            $('#id_kriteria').val(data.id_kriteria);
            $('#nama_kriteria').val(data.nama);
            $('#previewModal').modal('show');
        });
    }

    function modalActionDelete(id) {
        Swal.fire({
            title: 'Hapus kriteria ini?',
            text: 'Data tidak dapat dikembalikan!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch(`/superadmin/kriteria/${id}/delete`, {
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
                        $('#table_kriteria').DataTable().ajax.reload();
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
