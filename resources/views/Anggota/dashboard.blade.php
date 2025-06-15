@extends('layouts.template')

@section('title', 'Dashboard Anggota')

@section('content')


<div class="container-fluid py-4">

    {{-- Greeting --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="alert alert-success shadow">
                <h4>Selamat datang, {{ auth()->user()->name }}!</h4>
                <p>Anda adalah {{ auth()->user()->getRoleName() }}. Anda bisa mengoperasikan sistem dengan wewenang tertentu.</p>
            </div>
        </div>
    </div>

    {{-- Statistika Ringkasan --}}
    <div class="row">
        {{-- Total Kriteria --}}
        <div class="col-md-3 col-sm-6 mb-4">
            <div class="card border-start border-primary border-5 shadow h-100">
                <div class="card-body text-center">
                    <h5>Total Kriteria</h5>
                    <h2 class="fw-bold text-primary">{{ $total ?? 0 }}</h2>
                </div>
            </div>
        </div>

        {{-- Submitted --}}
        <div class="col-md-3 col-sm-6 mb-4">
            <div class="card border-start border-info border-5 shadow h-100">
                <div class="card-body text-center">
                    <h5>Submitted</h5>
                    <h2 class="fw-bold text-info">{{ $submitted ?? 0 }}</h2>
                </div>
            </div>
        </div>

        {{-- ACC 1 --}}
        <div class="col-md-3 col-sm-6 mb-4">
            <div class="card border-start border-success border-5 shadow h-100">
                <div class="card-body text-center">
                    <h5>ACC 1</h5>
                    <h2 class="fw-bold text-success">{{ $acc1 ?? 0 }}</h2>
                </div>
            </div>
        </div>

        {{-- ACC 2 --}}
        <div class="col-md-3 col-sm-6 mb-4">
            <div class="card border-start border-warning border-5 shadow h-100">
                <div class="card-body text-center">
                    <h5>ACC 2</h5>
                    <h2 class="fw-bold text-warning">{{ $acc2 ?? 0 }}</h2>
                </div>
            </div>
        </div>
    </div>

    {{-- Progress Keseluruhan --}}
    <div class="row mb-5">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-body">
                    <h5>Progress Pengisian</h5>
                    <div class="progress" style="height: 30px;">
                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-success"
                            role="progressbar" style="width: {{ round($averageProgress ?? 0, 0) }}%" 
                            aria-valuenow="{{ round($averageProgress ?? 0, 0) }}" aria-valuemin="0" aria-valuemax="100">
                            {{ round($averageProgress ?? 0, 0) }}%
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Menu Aksi --}}
    <div class="row mb-4">
        <div class="col-md-4 mb-4">
            @if(auth()->user()->getRole() == 'A1')
                <a href="{{ route('kriteria1.index') }}" class="text-decoration-none">
                    <div class="card shadow text-center p-4 h-100">
                        <i class="fas fa-tasks fa-3x text-primary mb-3"></i>
                        <h5>Input Data Kriteria 1</h5>
                    </div>
                </a>
            @elseif(auth()->user()->getRole() == 'A2')
                <a href="{{ route('kriteria2.index') }}" class="text-decoration-none">
                    <div class="card shadow text-center p-4 h-100">
                        <i class="fas fa-tasks fa-3x text-primary mb-3"></i>
                        <h5>Input Data Kriteria 2</h5>
                    </div>
                </a>
            @elseif(auth()->user()->getRole() == 'A3')
                <a href="{{ route('kriteria3.index') }}" class="text-decoration-none">
                    <div class="card shadow text-center p-4 h-100">
                        <i class="fas fa-tasks fa-3x text-primary mb-3"></i>
                        <h5>Input Data Kriteria 3</h5>
                    </div>
                </a>
            @elseif(auth()->user()->getRole() == 'A4')
                <a href="{{ route('kriteria4.index') }}" class="text-decoration-none">
                    <div class="card shadow text-center p-4 h-100">
                        <i class="fas fa-tasks fa-3x text-primary mb-3"></i>
                        <h5>Input Data Kriteria 4</h5>
                    </div>
                </a>
            @elseif(auth()->user()->getRole() == 'A5')
                <a href="{{ route('kriteria5.index') }}" class="text-decoration-none">
                    <div class="card shadow text-center p-4 h-100">
                        <i class="fas fa-tasks fa-3x text-primary mb-3"></i>
                        <h5>Input Data Kriteria 5</h5>
                    </div>
                </a>
            @elseif(auth()->user()->getRole() == 'A6')
                <a href="{{ route('kriteria6.index') }}" class="text-decoration-none">
                    <div class="card shadow text-center p-4 h-100">
                        <i class="fas fa-tasks fa-3x text-primary mb-3"></i>
                        <h5>Input Data Kriteria 6</h5>
                    </div>
                </a>
            @elseif(auth()->user()->getRole() == 'A7')
                <a href="{{ route('kriteria7.index') }}" class="text-decoration-none">
                    <div class="card shadow text-center p-4 h-100">
                        <i class="fas fa-tasks fa-3x text-primary mb-3"></i>
                        <h5>Input Data Kriteria 7</h5>
                    </div>
                </a>
            @elseif(auth()->user()->getRole() == 'A8')
                <a href="{{ route('kriteria8.index') }}" class="text-decoration-none">
                    <div class="card shadow text-center p-4 h-100">
                        <i class="fas fa-tasks fa-3x text-primary mb-3"></i>
                        <h5>Input Data Kriteria 8</h5>
                    </div>
                </a>
            @elseif(auth()->user()->getRole() == 'A9')
                <a href="{{ route('kriteria9.index') }}" class="text-decoration-none">
                    <div class="card shadow text-center p-4 h-100">
                        <i class="fas fa-tasks fa-3x text-primary mb-3"></i>
                        <h5>Input Data Kriteria 9</h5>
                    </div>
                </a>
            @endif
        </div>
    </div>

    {{-- Notifikasi Terbaru --}}
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    Notifikasi Terbaru
                </div>
                <div class="card-body">
                    @if ($notifications->isEmpty())
                        <p class="text-muted">Tidak ada notifikasi baru.</p>
                    @else
                        <ul class="list-group list-group-flush">
                            @foreach ($notifications as $notif)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ $notif->title }} - {{ $notif->message }}
                                    <small class="text-muted">{{ $notif->created_at->diffForHumans() }}</small>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
