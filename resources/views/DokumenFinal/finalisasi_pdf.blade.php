<!DOCTYPE html>
<html>
<head>
    <title>Dokumen Finalisasi {{ $idFinalisasi }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        h2 { border-bottom: 1px solid #000; padding-bottom: 5px; }
        .kriteria { margin-bottom: 30px; }
        .section { margin-top: 10px; }
    </style>
</head>
<body>
    <h1>Finalisasi ID: {{ $idFinalisasi }}</h1>

    @foreach ($details as $detail)
        <div class="kriteria">
            <h2>{{ $detail->kriteria->nama_kriteria ?? '-' }}</h2>
            <p><strong>Status:</strong> {{ strtoupper($detail->status) }}</p>
            <p><strong>Validator:</strong> 
                @if($detail->status === 'acc1') Kajur
                @elseif($detail->status === 'acc2') Direktur
                @elseif($detail->status === 'revisi') Kajur
                @else -
                @endif
            </p>
            <p><strong>Catatan:</strong> {{ $detail->komentar->komen ?? '-' }}</p>

            <div class="section">
                <h3>Penetapan</h3>
                <p>{{ $detail->penetapan->deskripsi ?? '-' }}</p>
            </div>

            <div class="section">
                <h3>Pelaksanaan</h3>
                <p>{{ $detail->pelaksanaan->deskripsi ?? '-' }}</p>
            </div>

            <div class="section">
                <h3>Evaluasi</h3>
                <p>{{ $detail->evaluasi->deskripsi ?? '-' }}</p>
            </div>

            <div class="section">
                <h3>Pengendalian</h3>
                <p>{{ $detail->pengendalian->deskripsi ?? '-' }}</p>
            </div>

            <div class="section">
                <h3>Peningkatan</h3>
                <p>{{ $detail->peningkatan->deskripsi ?? '-' }}</p>
            </div>
        </div>
    @endforeach
</body>
</html>
