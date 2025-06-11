@extends('layouts.template')

@section('title', 'Dokumen Final')

@section('content')
<div class="row">
    <div class="col-md-3">
        <h5>Daftar Dokumen Finalisasi</h5>
        <ul class="list-group">
            @foreach($finalisasiIds as $item)
                <a href="{{ url('/direktur/finalisasi/' . $item->id_finalisasi . '/preview') }}"
                   class="list-group-item list-group-item-action {{ $activeId == $item->id_finalisasi ? 'active' : '' }}">
                    Finalisasi ID: {{ $item->id_finalisasi }}
                </a>
            @endforeach
        </ul>
    </div>

    <div class="col-md-9">
        @if($pdfUrl)
            <iframe src="{{ $pdfUrl }}" width="100%" height="800px" style="border: none;"></iframe>
        @else
            <p class="text-muted">Silakan pilih dokumen finalisasi dari daftar di kiri.</p>
        @endif
    </div>
</div>
@endsection
