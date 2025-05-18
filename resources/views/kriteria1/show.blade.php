@empty($details)
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Kesalahan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger">
                    <h5><i class="icon fas fa-ban"></i> Kesalahan!!!</h5>
                    Data detail tidak ditemukan.
                </div>
                <a href="{{ url('kriteria1') }}" class="btn btn-warning">Kembali</a>
            </div>
        </div>
    </div>
@else
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Data Kriteria</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="alert alert-info">
                    <h5><i class="icon fas fa-info-circle"></i> Informasi</h5>
                    Berikut adalah detail data kriteria dan isian PPEPP:
                </div>
                <div class="row g-3">
                    <div class="col-md-5">
                        <table class="table table-sm table-bordered table-striped">
                            <tr>
                                <th class="text-right col-4">Nama Kriteria:</th>
                                <td class="col-8">{{ $details->kriteria->nama_kriteria ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th class="text-right">Status:</th>
                                <td>{{ ucfirst($details->status) }}</td>
                            </tr>
                            <tr>
                                <th class="text-right">Komentar:</th>
                                <td>{{ $details->komentar->komentar ?? 'Belum ada komentar' }}</td>
                            </tr>
                        </table>
                    </div>

                    <div class="col-md-2 d-none d-md-block"></div>

                    <div class="col-md-5">
                        <iframe src="{{ url('/kriteria1/preview/' . $id) }}" width="100%" height="400px"
                            style="border: 1px solid #ccc; border-radius: 4px;">
                        </iframe>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>

    <script>
        $('.close, .btn-secondary').on('click', function() {
            $('#myModal').modal('hide');
        });
    </script>
@endempty