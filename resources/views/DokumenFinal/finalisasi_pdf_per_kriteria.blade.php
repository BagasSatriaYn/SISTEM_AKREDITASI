<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Kriteria {{ $detail->kriteria->id_kriteria ?? 'Tanpa Nama' }}</title>
</head>
<body>
    <h2>Kriteria {{ $detail->kriteria->id_kriteria ?? 'Tanpa Nama' }}</h2>

    <p><strong>Status:</strong> {{ strtoupper($detail->status) }}</p>
    <p><strong>Validator:</strong> {{ $detail->komentar ? 'Direktur' : '-' }}</p>
    <p><strong>Catatan:</strong> {{ $detail->komentar->komen ?? '-' }}</p>

    <h4>Penetapan</h4>
    {!! $detail->penetapan->deskripsi ?? '-' !!}

    <h4>Pelaksanaan</h4>
    {!! $detail->pelaksanaan->deskripsi ?? '-' !!}

    <h4>Evaluasi</h4>
    {!! $detail->evaluasi->deskripsi ?? '-' !!}

    <h4>Pengendalian</h4>
    {!! $detail->pengendalian->deskripsi ?? '-' !!}

    <h4>Peningkatan</h4>
    {!! $detail->peningkatan->deskripsi ?? '-' !!}

    <hr>
</body>
</html>
