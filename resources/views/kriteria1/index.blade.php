@extends('layouts.template')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                        <h4>{{ $page->title }}</h4>
                        <a href="{{ url('kriteria1/input') }}" class="btn btn-sm btn-success">
                            Input Kriteria
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
                                            Nama Kriteria
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
@endsection

@push('css')
@endpush

@push('js')
    <script>
        var dataDetail;
        const base_url = "{{ url('kriteria1') }}";

        function modalAction(url = '') {
            $('#myModal').load(url, function() {
                $('#myModal').modal('show');
            });
        }

        $(document).ready(function() {
            dataDetail = $('#table_detail_kriteria').DataTable({
                serverSide: true,
                ajax: {
                    url: "{{ url('kriteria1/list') }}",
                    type: "POST",
                    data: function(d) {
                        d.id_detail_kriteria = $('#id_detail_kriteria').val();
                    }
                },
                columns: [{
                        data: "DT_RowIndex",
                        className: "text-center text-sm",
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: "kriteria.nama_kriteria",
                        className: "text-sm",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "status",
                        className: "text-sm",
                        orderable: true,
                        searchable: true,
                        render: function(data, type, row, meta) {
                            let badgeClass = 'bg-secondary'; // default

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
                        render: function(data, type, row, meta) {
                            let id = row.id_detail_kriteria;
                            return `
                                <button class="btn btn-info btn-xs" onclick="modalAction('${base_url}/${id}/show')">Detail</button>
                                <button class="btn btn-warning btn-xs" onclick="modalAction('${base_url}/${id}/edit')">Edit</button>
                                <button class="btn btn-danger btn-xs" onclick="modalAction('${base_url}/${id}/delete')">Hapus</button>
                            `;
                        }

                    }
                ]
            });

            $('#id_detail_kriteria').on('change', function() {
                dataDetail.ajax.reload();
            });
        });
    </script>
@endpush