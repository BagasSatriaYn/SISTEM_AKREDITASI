@extends('layouts.template')
    
@section('title', 'Dashboard-KJM, Direktur')

@section('content')

    
    <div class="alert-welcome">
        <div>
            <strong style="color: #03476A; font-size: 0.95rem;">Selamat datang DIREKTUR! Anda bisa mengoperasikan
                sistem dengan wewenang tertentu melalui pilihan menu di bawah.</strong>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    <!-- Judul Pilih Menu -->
    <div class="menu-sectionn">
        <div class="d-flex align-items-center mb-2">
            <i class="fas fa-bars me-2"></i>
            <h5 class="mb-0" style="font-size: 1rem;">Pilih Menu</h5>
        </div>
    </div>

    <!-- Kartu-kartu menu dipisah -->
    <div class="menu-cards">
        <a href="{{ route('validasi2') }}" class="menu-card kriteria-card">
            <span class="menu-card-badge">New</span>
            <div class="menu-card-image">
                <i class="fas fa-list-check"></i>
            </div>
            <div class="menu-card-title">
                <h5>Finalisasi Kriteria</h5>
                <p class="text-muted mt-2 mb-0" style="font-size: 0.85rem;">Kelola kriteria penilaian dan parameter
                    akreditasi</p>
            </div>
        </a>

        <a href="{{ route('direktur.finalisasi.pdf', ['idFinalisasi' => 1]) }}" class="menu-card dokumen-card">
            <div class="menu-card-image">
                <i class="fas fa-file-pdf"></i>
            </div>
            <div class="menu-card-title">
                <h5>Lihat Dokumen Final</h5>
                <p class="text-muted mt-2 mb-0" style="font-size: 0.85rem;">Akses dokumen hasil akhir yang telah
                    divalidasi</p>
            </div>
        </a>
    </div>
@endsection