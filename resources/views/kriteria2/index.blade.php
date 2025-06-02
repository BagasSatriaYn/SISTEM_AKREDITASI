@extends('layouts.template')

@section('content') 

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                        <h6>{{ $page->title }}</h6>
                        <a href="{{ url('kriteria2/input') }}" class="btn btn-sm btn-success">
                            {{ __(' input') }}
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
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0" id="table_detail_kriteria">
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
                                            Status
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
    </div>
    <!-- Modal Preview PDF -->
<!-- Modal Preview PDF - dengan komentar validator di samping kiri -->
<div class="modal fade" id="previewModal" tabindex="-1" role="dialog" aria-labelledby="previewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Preview Dokumen dan Komentar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <!-- Informasi komentar validator -->
                    <div class="col-md-4 border-end pe-3">
                        <div class="mb-2">
                            <label for="validatorName" class="form-label fw-bold">Validator:</label>
                            <input type="text" class="form-control" id="validatorName" readonly>
                        </div>
                        <div class="mb-2">
                            <label for="validationStatus" class="form-label fw-bold">Status Validasi:</label>
                            <input type="text" class="form-control" id="validationStatus" readonly>
                        </div>
                        <div class="mb-2">
                            <label for="validatorNotes" class="form-label fw-bold">Catatan:</label>
                            <textarea class="form-control" id="validatorNotes" rows="8" readonly></textarea>
                        </div>
                    </div>

                    <!-- Iframe PDF viewer -->
                    <div class="col-md-8">
                        <div style="height: 60vh;">
                            <iframe id="modal-pdf-frame" src="" style="width:100%; height:100%;" frameborder="0"></iframe>
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
@endpush

@push('js')
    <script>
    ffunction showPreviewModal(id) {
    const url = `/kriteria/${id}/preview`;

    $.get(url, function(data) {
        // Isi form komentar
        $('#validatorName').val(data.validator ?? '-');
        $('#validationStatus').val(data.status ?? '-');
        $('#validatorNotes').val(data.catatan ?? '-');

        // Tampilkan PDF
        $('#modal-pdf-frame').attr('src', data.pdf_url);

        // Buka modal
        $('#previewModal').modal('show');
    });
}


</script>


 <script>
    var dataDetail;
    const base_url = "{{ url('kriteria2') }}";

    function modalAction(url = '') {
        $('#myModal').load(url, function () {
            $('#myModal').modal('show');
        });
    }

    $(document).ready(function () {
        dataDetail = $('#table_detail_kriteria').DataTable({
            serverSide: true,
            processing: true,
            ajax: {
                url: "{{ url('kriteria2/list') }}",
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: function (d) {
                    d.id_detail_kriteria = $('#id_detail_kriteria').val();
                }
            },
            columns: [
                {
                    data: "DT_RowIndex",
                    className: "text-center text-sm",
                    orderable: false,
                    searchable: false
                },
                {
                    data: "kriteria.nama",
                    className: "text-sm",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "status",
                    className: "text-sm",
                    orderable: true,
                    searchable: true,
                    render: function (data) {
                        let badgeClass = 'bg-secondary';
                        switch (data) {
                            case 'save':
                                badgeClass = 'bg-secondary';
                                break;
                            case 'submit':
                                badgeClass = 'bg-primary';
                                break;
                            case 'revisi':
                                badgeClass = 'bg-warning text-dark';
                                break;
                            case 'acc1':
                                badgeClass = 'bg-success';
                                break;
                            case 'acc2':
                                badgeClass = 'bg-info';
                                break;
                        }
                        return `<span class="badge ${badgeClass}">${data}</span>`;
                    }
                },
                {
                    data: "aksi",
                    className: "text-center text-xs",
                    orderable: false,
                    searchable: false,
                    render: function (data, type, row) {
                        let id = row.id_detail_kriteria;
                        let status = row.status;

                        let previewBtn = `<button class="btn btn-info btn-xs" onclick="showPreviewModal(${id})">Preview</button>`;

                        let editBtn = (status === 'submit')
                            ? `<a class="btn btn-secondary btn-xs disabled" href="#">Edit</a>`
                            : `<a class="btn btn-warning btn-xs" href="${base_url}/${id}/edit">Edit</a>`;

                        let deleteBtn = `<button class="btn btn-danger btn-xs" onclick="modalActionDelete(${id})">Delete</button>`;

                        return `${previewBtn} ${editBtn} ${deleteBtn}`;
                    }
                }
            ]
        });

        $('#id_detail_kriteria').on('change', function () {
            dataDetail.ajax.reload();
        });
    });

    function showPreviewModal(id) {
    const infoUrl = `/kriteria2/${id}/preview/json`; // JSON detail (komentar, status)
    
    $.get(infoUrl, function(data) {
        $('#validatorName').val(data.validator ?? '-');
        $('#validationStatus').val(data.status ?? '-');
        $('#validatorNotes').val(data.catatan ?? '-');

        // tampilkan PDF setelah info didapat
        $('#modal-pdf-frame').attr('src', data.pdf_url);
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
                fetch(`${base_url}/${id}/delete`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        'Accept': 'application/json'
                    }
                })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire('Berhasil!', data.message, 'success');
                            dataDetail.ajax.reload();
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