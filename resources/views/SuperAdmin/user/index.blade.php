    @extends('layouts.template')
    @section('title', 'Kelola User')
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

        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                            <h6>{{ $page->title }}</h6>
                            <button onclick="modalAction('{{ url('superadmin/userinput') }}')" class="btn btn-sm btn-success">
                                Tambah Data
                            </button>
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
                                <table class="table align-items-center mb-0" id="table_user">
                                    <thead>
                                        <tr>
                                            <th
                                                class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 text-center">
                                                ID
                                            </th>
                                            <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                                Nama
                                            </th>
                                            <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                                Username
                                            </th>
                                            <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                                Role
                                            </th>
                                            <th
                                                class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 text-center">
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
        <!-- Modal Preview - Hanya Detail User -->
    <div class="modal fade" id="previewModal" tabindex="-1" role="dialog" aria-labelledby="previewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <!-- Informasi Detail User -->
                        <div class="col-md-12">
                            <div class="mb-2">
                                <label for="username" class="form-label fw-bold">Username:</label>
                                <input type="text" class="form-control" id="username" readonly>
                            </div>
                            <div class="mb-2">  
                                <label for="name" class="form-label fw-bold">Name:</label>
                                <input type="text" class="form-control" id="name" readonly>
                            </div>
                            <div class="mb-2">
                                <label for="role" class="form-label fw-bold">Role:</label>
                                <input type="text" class="form-control" id="role" readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
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
        dataUser = $('#table_user').DataTable({
            serverSide: true,
            processing: true,
            ajax: {
                url: "{{ url('superadmin/userlist') }}",
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
                    data: "name",  // Changed from 'nama' to match your model's 'name' field
                    name: "name",
                    className: "text-sm"
                },
                {
                    data: "username",
                    name: "username",
                    className: "text-sm"
                },
                {
                    data: "level_name",  // Using the accessor we created
                    name: "level.level_nama",
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
        const infoUrl = `${base_url}/user/${id}/show`;  // URL yang sesuai dengan route di web.php

        $.get(infoUrl, function(data) {
            // Isi form dengan data pengguna
            $('#username').val(data.username ?? '-');
            $('#name').val(data.name ?? '-');
            $('#role').val(data.role ?? '-');  // Sesuaikan dengan nama kolom role yang ada di model

            // Tampilkan modal dengan data pengguna
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
                fetch(`${base_url}/user/${id}/delete`, {  // <-- Pastikan URL ini sesuai
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
                            dataUser.ajax.reload();  // Refresh DataTable setelah hapus
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