@extends('layouts.template')

@section('content')
    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm">
                    <!-- Header -->
                    {{-- <div class="card-header text-white" style="background-color: #321269;">
                        <h4 class="mb-0 text-white">AKSIB</h4>
                    </div>
                    <div class="card-body"> --}}

                        <!-- Laporan Section -->
                        <div class="mb-5">
                            <h5 class="py-2 px-2" style="background-color: #00437F; color: white">Dokumen Final Akreditasi D4
                                Sistem Informasi Bisnis</h5>
                                <div class="text-center">
                                    <iframe src="{{ asset('pdfsample/sample-1.pdf') }}" frameborder="0" class="d-block mx-auto" style="width: 90%; height: 975px;"></iframe>
                                </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection