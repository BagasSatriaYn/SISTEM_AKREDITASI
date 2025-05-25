{{-- <div class="modal-header">
    <h5 class="modal-title">Detail Validasi Kriteria</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>

<div class="modal-body">
    <table class="table table-borderless">
        <tr>
            <th width="30%">Pelaksana:</th>
            <td>{{ $data->penanggung_jawab ?? '-' }}</td>
        </tr>
        <tr>
            <th>Judul Kriteria:</th>
            <td>{{ $data->judul_kriteria ?? '-' }}</td>
        </tr>
        <tr>
            <th>Di-submit pada:</th>
            <td>{{ \Carbon\Carbon::parse($data->created_at)->format('Y-m-d H:i') }}</td>
        </tr>
        <tr>
            <th>Status Validasi:</th>
            <td>
                @if ($data->status == 'diterima')
                    <span class="badge bg-success">Pengajuan Tahap 1 Diterima</span>
                @elseif ($data->status == 'ditolak')
                    <span class="badge bg-danger">Pengajuan Tahap 1 Ditolak</span>
                @else
                    <span class="badge bg-secondary">Belum divalidasi</span>
                @endif
            </td>
        </tr>
        <tr>
            <th>Catatan:</th>
            <td>
                <em>
                    Mohon Bapak/Ibu pembimbing utama agar melakukan <strong>validasi (pengecekan)</strong> terhadap laporan yang di-submit oleh mahasiswa beserta bukti Lembar Pengesahan yang telah ditandatangani secara lengkap dan benar sesuai pedoman (sebagai bukti remu dikumpulkan harian).
                </em>
            </td>
        </tr>
    </table>
</div> --}}
