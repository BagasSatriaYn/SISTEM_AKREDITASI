@extends('layouts.template')

@section('content')
    <h2>Daftar Finalisasi</h2>

    @if($finalisasiIds->isEmpty())
        <p>Tidak ada data finalisasi.</p>
    @else
        <ul>
            @foreach($finalisasiIds as $final)
                <li>
                    Finalisasi ID: {{ $final->id_finalisasi }} - 
                    <a href="{{ route('direktur.finalisasi.pdf', $final->id_finalisasi) }}" target="_blank">Lihat PDF</a>
                </li>
            @endforeach
        </ul>
    @endif
@endsection
