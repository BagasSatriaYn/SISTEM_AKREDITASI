<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Dokumen Kriteria</title>
    <style>
        body { font-family: sans-serif; }
        h1 { text-align: center; }
        .section { margin-bottom: 20px; }
    </style>
</head>
<body>
    <h1>Dokumen Kriteria {{ $detail->kriteria->nama ?? '-' }}</h1>

    <div class="section">
        <strong>Penetapan:</strong>
        {!! $detail->penetapan->deskripsi ?? '-' !!}
    </div>
    <div class="section">
        <strong>Pelaksanaan:</strong>
        {!! $detail->pelaksanaan->deskripsi ?? '-' !!}
    </div>
    <div class="section">
        <strong>Evaluasi:</strong>
        {!! $detail->evaluasi->deskripsi ?? '-' !!}
    </div>
    <div class="section">
        <strong>Pengendalian:</strong>
        {!! $detail->pengendalian->deskripsi ?? '-' !!}
    </div>
    <div class="section">
        <strong>Peningkatan:</strong>
        {!! $detail->peningkatan->deskripsi ?? '-' !!}
    </div>
</body>
</html>
