@extends('layouts.template')

@section('content')
<div class="container">
    <h4 class="mb-4">Dokumen Final Akreditasi D4 Sistem Informasi Bisnis</h4>

   @foreach ($data as $item)
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">
                Kriteria {{ $item->kriteria->id_kriteria }} - {{ $item->kriteria->nama }}
            </h5>

            <iframe 
                src="{{ asset('storage/final/dokumen_kriteria_' . $item->id_detail_kriteria . '.pdf') }}" 
                width="100%" height="500px"></iframe>

            <!-- 🟢 Tambahkan Tombol Generate di sini -->
            <a href="{{ route('dokumen.generate', $item->id_detail_kriteria) }}" 
               class="btn btn-primary mt-3" 
               target="_blank">
                Generate Ulang PDF
            </a>

        </div>
    </div>
@endforeach

</div>
@endsection
