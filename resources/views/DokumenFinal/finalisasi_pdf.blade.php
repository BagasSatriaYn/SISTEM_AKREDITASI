<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: "Times New Roman", Times, serif;
            margin: 6px 20px;
            line-height: 1.5;
        }
        .text-center { text-align: center; }
        .font-10 { font-size: 10pt; }
        .font-11 { font-size: 11pt; }
        .font-13 { font-size: 13pt; }
        h3 {
            font-size: 16pt;
            margin: 20px 0 10px;
            text-align: center;
        }
        h4 {
            font-size: 13pt;
            margin-top: 15px;
            margin-bottom: 5px;
        }
        .kriteria {
            padding-bottom: 20px;
        }
        .page-break {
            page-break-before: always;
        }
        .section { margin-top: 10px; }
        p { margin: 4px 0; }
        img { max-width: 100%; height: auto; }
        .header-table {
            border-bottom: 1px solid black;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    {{-- HEADER --}}
    <table class="header-table" width="100%">
        <tr>
            <td width="15%" class="text-center">
                @php
                    $logoPath = public_path('Argon/assets/img/logopolinema.png');
                    $logoBase64 = file_exists($logoPath)
                        ? 'data:image/png;base64,' . base64_encode(file_get_contents($logoPath))
                        : null;
                @endphp
                @if($logoBase64)
                    <img src="{{ $logoBase64 }}" alt="Logo Polinema" style="width: 90px;">
                @endif
            </td>
            <td width="85%" class="text-center">
                <div class="font-11">KEMENTERIAN PENDIDIKAN, KEBUDAYAAN, RISET, DAN TEKNOLOGI</div>
                <div class="font-13"><strong>POLITEKNIK NEGERI MALANG</strong></div>
                <div class="font-10">Jl. Soekarno-Hatta No. 9 Malang 65141</div>
                <div class="font-10">Telepon (0341) 404424 Pes. 101–105, Fax. (0341) 404420</div>
                <div class="font-10">Laman: www.polinema.ac.id</div>
            </td>
        </tr>
    </table>

    {{-- Kriteria 1 + Judul --}}
    @foreach ($details as $index => $detail)
    <div class="kriteria {{ $index > 0 ? 'page-break' : '' }}">
        @if ($index === 0)
            <h3>Dokumen Final Akreditasi</h3>
        @endif

        {{-- Judul nama lengkap kriteria --}}
        <h4>{{ strtoupper($detail->kriteria->nama ?? '-') }}</h4>

        <div class="section">
            <h4>1. Penetapan</h4>
            <p>{!! $detail->penetapan->deskripsi ?? '-' !!}</p>
        </div>

        <div class="section">
            <h4>2. Pelaksanaan</h4>
            <p>{!! $detail->pelaksanaan->deskripsi ?? '-' !!}</p>
        </div>

        <div class="section">
            <h4>3. Evaluasi</h4>
            <p>{!! $detail->evaluasi->deskripsi ?? '-' !!}</p>
        </div>

        <div class="section">
            <h4>4. Pengendalian</h4>
            <p>{!! $detail->pengendalian->deskripsi ?? '-' !!}</p>
        </div>

        <div class="section">
            <h4>5. Peningkatan</h4>
            <p>{!! $detail->peningkatan->deskripsi ?? '-' !!}</p>
        </div>
    </div>
@endforeach


</body>
</html>
