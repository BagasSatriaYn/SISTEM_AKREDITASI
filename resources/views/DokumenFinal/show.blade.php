@extends('layouts.template')

@section('content')
<div class="container">
    <h1>Detail Finalisasi #{{ $idFinalisasi }}</h1>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID Kriteria</th>
                <th>Status</th>
                <th>Validasi By</th>
                <th>Updated At</th>
            </tr>
        </thead>
        <tbody>
            @foreach($dokumenList as $dokumen)
            <tr>
                <td>{{ $dokumen->id_kriteria }}</td>
                <td>{{ $dokumen->status }}</td>
                <td>{{ $dokumen->validated_by }}</td>
                <td>{{ $dokumen->updated_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <form action="{{ route('DokumenFinal.merge', $idFinalisasi) }}" method="POST">

        @csrf
        <button type="submit" class="btn btn-primary">Gabungkan PDF</button>
    </form>

</div>
@endsection
