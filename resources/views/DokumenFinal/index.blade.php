@extends('layouts.template')

@section('title', 'Dokumen Final')

@section('content')
<div class="box-header">
    <h3 class="title">Dokumen Final</h3>
</div>

<div class="box-content">
    <div class="box-informasi">
        <div class="informasi">
            <center>
                <h4><strong>Informasi</strong><br></h4>
                Halaman ini menampilkan <strong>dokumen hasil finalisasi</strong> yang telah selesai diproses.
                Anda dapat memilih dokumen untuk melihat preview PDF-nya.
            </center>
        </div>
    </div>

    <div class="container-fluid py-4">
        <div class="row">
            <!-- Sidebar List -->
            <div class="col-md-3">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Daftar Finalisasi</h6>
                    </div>
                    <div class="card-body px-3 pt-2">
                        <ul class="list-group">
                            @foreach($finalisasiIds->sortBy('id_finalisasi') as $item)
                                    <a href="{{ url('/direktur/finalisasi/' . $item->id_finalisasi . '/preview') }}"
                                    class="list-group-item list-group-item-action {{ $activeId == $item->id_finalisasi ? 'active' : '' }}">
                                        Dokumen Final Tahun: {{ $item->id_finalisasi }}
                                    </a>
                                @endforeach
                                        

                        </ul>
                    </div>
                </div>
            </div>

            <!-- PDF Viewer -->
            <div class="col-md-9">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Preview Dokumen</h6>
                    </div>
                    <div class="card-body px-3 pt-3">
                        @if($pdfUrl)
                            <iframe src="{{ $pdfUrl }}" width="100%" height="800px" style="border: none;"></iframe>
                        @else
                            <p class="text-muted">Silakan pilih dokumen finalisasi dari daftar di sebelah kiri.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('css')
<style>
    .box-content {
        background-color: white;
        padding: 20px;
        border-radius: 5px;
        margin-bottom: 20px;
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
    }
    .box-header {
        background-color: #354868;
        padding: 15px;
        border-radius: 5px;
        margin-bottom: 20px;
        margin-top: 1%;
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
    }
    .title {
        color: white;
        font-size: 20px;
        font-weight: bold;
        margin-top: 8px;
    }
    .box-informasi {
        background-color: #E6F2FF;
        padding: 50px;
        border-radius: 5px;
        margin-bottom: 20px;
    }
    .informasi {
        color: #1F4265;
    }
    .h4 {
        font-weight: bold;
        margin-bottom: 20px;
    }
</style>
@endpush
