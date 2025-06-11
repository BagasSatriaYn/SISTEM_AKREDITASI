<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Dokumen PPEPP</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
        }

        .university {
            font-size: 14px;
            font-weight: bold;
        }

        .document-title {
            font-size: 16px;
            margin: 10px 0;
        }

        .criteria-title {
            text-align: center;
            font-size: 14px;
            font-weight: bold;
            margin: 15px 0;
        }

        .ppepp-section {
            margin-bottom: 15px;
            page-break-inside: avoid;
        }

        .ppepp-number {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .ppepp-content {
            text-align: justify;
            margin-left: 20px;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>

    <div class="header">
        <div class="university">POLITEKNIK NEGERI MALANG</div>
        <div class="document-title">DOKUMEN PPEPP</div>
    </div>

    <div class="criteria-title">{{ $details->kriteria->nama ?? 'Tanpa Kriteria' }}</div>

    <!-- Penetapan -->
    <div class="ppepp-section">
    <div class="ppepp-number">1. Penetapan</div>
    <div class="ppepp-content">
        {!! $details->penetapan->deskripsi ?? '<i>Tidak ada data</i>' !!}
                @php
            $img = $details->penetapan->pendukung;
        @endphp

        @if(Str::contains($img, 'base64'))
            {!! $img !!}
        @endif

    </div>
</div>

    <!-- Pelaksanaan -->
    <div class="ppepp-section">
        <div class="ppepp-number">2. Pelaksanaan</div>
        <div class="ppepp-content">
            {!! $details->pelaksanaan->deskripsi ?? '<i>Tidak ada data</i>' !!}
            {!! $details->pelaksanaan->pendukung ?? '' !!}
        </div>
    </div>

    <!-- Evaluasi -->
    <div class="ppepp-section">
        <div class="ppepp-number">3. Evaluasi</div>
        <div class="ppepp-content">
            {!! $details->evaluasi->deskripsi ?? '<i>Tidak ada data</i>' !!}
            {!! $details->evaluasi->pendukung ?? '' !!}
        </div>
    </div>

    <!-- Pengendalian -->
    <div class="ppepp-section">
        <div class="ppepp-number">4. Pengendalian</div>
        <div class="ppepp-content">
            {!! $details->pengendalian->deskripsi ?? '<i>Tidak ada data</i>' !!}
            {!! $details->pengendalian->pendukung ?? '' !!}
        </div>
    </div>

    <!-- Peningkatan -->
    <div class="ppepp-section">
        <div class="ppepp-number">5. Peningkatan</div>
        <div class="ppepp-content">
            {!! $details->peningkatan->deskripsi ?? '<i>Tidak ada data</i>' !!}
            {!! $details->peningkatan->pendukung ?? '' !!}
        </div>
    </div>


</body>

</html>
