@extends('layouts.template')

@section('content')
    <div class="judul-finalisasi mb-4 mt-4">
        Dokumen Final Akreditasi D4 Sistem Informasi Bisnis
    </div>

    <div style="display: flex; justify-content: center;">
        <iframe src="{{ $pdf_url }}" style="width: 100%; height: 1075px;" frameborder="0"></iframe>
    </div>

    <style>
        .judul-finalisasi {
            background-color: #004080;
            /* biru gelap */
            color: white;
            padding: 10px 20px;
            border-radius: 3px;
            font-weight: bold;
            font-family: sans-serif;
            font-size: 16px;
        }
    </style>

@endsection
