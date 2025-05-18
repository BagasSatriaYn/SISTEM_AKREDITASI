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

        .supporting-image {
            max-width: 100%;
            height: auto;
            margin-top: 10px;
            border: 1px solid #ddd;
            padding: 5px;
        }

        .image-container {
            text-align: center;
            margin: 10px 0;
        }

        .image-caption {
            font-style: italic;
            font-size: 11px;
            margin-top: 5px;
        }
    </style>
</head>

<body>

    <div class="header">
        <div class="university">POLITEKNIK NEGERI MALANG</div>
        <div class="document-title">DOKUMEN PPEPP</div>
    </div>

    <div class="criteria-title">{{ $details->kriteria->nama_kriteria ?? 'Tanpa Kriteria' }}</div>

    <div class="ppepp-section">
        <div class="ppepp-number">1. Penetapan</div>
        <div class="ppepp-content">
            {!! $details->penetapan->penetapan ?? '<i>Tidak ada data</i>' !!}
            @if ($details->penetapan && $details->penetapan->pendukung)
                <div class="image-container">
                    <img src="{{ storage_path('app/public/' . $details->penetapan->pendukung) }}"
                        class="supporting-image">
                    <div class="image-caption">Dokumen Pendukung Penetapan</div>
                </div>
            @endif
        </div>
    </div>

    <div class="ppepp-section">
        <div class="ppepp-number">2. Pelaksanaan</div>
        <div class="ppepp-content">
            {!! $details->pelaksanaan->pelaksanaan ?? '<i>Tidak ada data</i>' !!}
            @if ($details->pelaksanaan && $details->pelaksanaan->pendukung)
                <div class="image-container">
                    <img src="{{ storage_path('app/public/' . $details->pelaksanaan->pendukung) }}"
                        class="supporting-image">
                    <div class="image-caption">Dokumen Pendukung Pelaksanaan</div>
                </div>
            @endif
        </div>
    </div>

    <div class="ppepp-section">
        <div class="ppepp-number">3. Evaluasi</div>
        <div class="ppepp-content">
            {!! $details->evaluasi->evaluasi ?? '<i>Tidak ada data</i>' !!}
            @if ($details->evaluasi && $details->evaluasi->pendukung)
                <div class="image-container">
                    <img src="{{ storage_path('app/public/' . $details->evaluasi->pendukung) }}"
                        class="supporting-image">
                    <div class="image-caption">Dokumen Pendukung Evaluasi</div>
                </div>
            @endif
        </div>
    </div>

    <div class="ppepp-section">
        <div class="ppepp-number">4. Pengendalian</div>
        <div class="ppepp-content">
            {!! $details->pengendalian->pengendalian ?? '<i>Tidak ada data</i>' !!}
            @if ($details->pengendalian && $details->pengendalian->pendukung)
                <div class="image-container">
                    <img src="{{ storage_path('app/public/' . $details->pengendalian->pendukung) }}"
                        class="supporting-image">
                    <div class="image-caption">Dokumen Pendukung Pengendalian</div>
                </div>
            @endif
        </div>
    </div>

    <div class="ppepp-section">
        <div class="ppepp-number">5. Peningkatan</div>
        <div class="ppepp-content">
            {!! $details->peningkatan->peningkatan ?? '<i>Tidak ada data</i>' !!}
            @if ($details->peningkatan && $details->peningkatan->pendukung)
                <div class="image-container">
                    <img src="{{ storage_path('app/public/' . $details->peningkatan->pendukung) }}"
                        class="supporting-image">
                    <div class="image-caption">Dokumen Pendukung Peningkatan</div>
                </div>
            @endif
        </div>
    </div>

</body>

</html>