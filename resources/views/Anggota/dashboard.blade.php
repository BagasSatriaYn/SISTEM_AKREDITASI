@extends('layouts.template')

@section('title', 'Dashboard-Admin')

@section('content')

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <!-- Full Width Header -->
    <div class="full-header header">
        <div class="header-content">
            <nav aria-label="breadcrumb" class="header-breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Pages</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Dashboard Admin</li>
                </ol>
                <h5 class="mb-0" style="font-size: 1.1rem; color: white;">Dashboard Admin</h5>
            </nav>

        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Welcome Alert -->
        <div class="login-alert" id="loginAlert">
            <div>
                <strong>Selamat datang Admin Kriteria 1! Anda bisa mengoperasikan sistem dengan wewenang tertentu melalui pilihan menu di bawah.
            </div>
            <button class="close-btn" onclick="document.getElementById('loginAlert').style.display='none'">×</button>
        </div>  
        
 @extends('layouts.app')

@section('content')
<div class="status-section">
    <div class="section-title">
        <i class="fas fa-bars"></i>
        <h5>Status Pengajuan</h5>
    </div>
    
    <div class="table-container">
        <table class="status-table">
            <thead>
                <tr>
                    <th style="width: 15%">ID</th>
                    <th style="width: 65%">Data Kriteria</th>
                    <th style="width: 20%">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($detailKriteria as $detail)
                @php
                    // Ambil nama kriteria dari tabel kriteria
                    $kriteria = App\Models\Kriteria::find($detail->id_kriteria);
                    
                    // Tentukan class badge berdasarkan status
                    $badgeClass = '';
                    $iconClass = '';
                    
                    if(in_array($detail->status, ['acc1', 'acc2'])) {
                        $badgeClass = 'badge-active';
                        $iconClass = 'fa-check-circle';
                    } else {
                        $badgeClass = 'badge-inactive';
                        $iconClass = 'fa-paper-plane';
                    }
                @endphp
                <tr>
                    <td>{{ $detail->id_detail_kriteria }}</td>
                    <td>{{ $kriteria->nama ?? 'Kriteria tidak ditemukan' }}</td>
                    <td>
                        <span class="status-badge {{ $badgeClass }}">
                            <i class="fas {{ $iconClass }} me-1"></i>
                            {{ ucfirst($detail->status) }}
                        </span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
        <!-- Pagination -->
        <div class="pagination-container">
            <p class="pagination-info">
                Showing {{ $detailKriteria->firstItem() }} to {{ $detailKriteria->lastItem() }} 
                of {{ $detailKriteria->total() }} entries
            </p>
            <div class="pagination-nav">
                <a href="{{ $detailKriteria->previousPageUrl() }}" 
                   class="page-nav-btn {{ $detailKriteria->onFirstPage() ? 'disabled' : '' }}">
                    <i class="fas fa-chevron-left"></i>
                </a>
                <a href="{{ $detailKriteria->nextPageUrl() }}" 
                   class="page-nav-btn {{ !$detailKriteria->hasMorePages() ? 'disabled' : '' }}">
                    <i class="fas fa-chevron-right"></i>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .status-section {
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        padding: 20px;
        margin-bottom: 30px;
    }
    
    .section-title {
        display: flex;
        align-items: center;
        margin-bottom: 20px;
    }
    
    .section-title i {
        font-size: 24px;
        color: #3498db;
        margin-right: 10px;
    }
    
    .section-title h5 {
        font-size: 18px;
        font-weight: 600;
        margin: 0;
        color: #2c3e50;
    }
    
    .status-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 15px;
    }
    
    .status-table th {
        background-color: #f8f9fa;
        padding: 12px 15px;
        text-align: left;
        font-weight: 600;
        color: #495057;
        border-bottom: 2px solid #dee2e6;
    }
    
    .status-table td {
        padding: 12px 15px;
        border-bottom: 1px solid #dee2e6;
        color: #495057;
    }
    
    .status-table tr:last-child td {
        border-bottom: none;
    }
    
    .status-table tr:hover td {
        background-color: #f8f9fa;
    }
    
    .status-badge {
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 14px;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }
    
    .badge-active {
        background-color: #d4edda;
        color: #155724;
    }
    
    .badge-inactive {
        background-color: #fff3cd;
        color: #856404;
    }
    
    .pagination-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 0;
    }
    
    .pagination-info {
        margin: 0;
        font-size: 14px;
        color: #6c757d;
    }
    
    .pagination-nav {
        display: flex;
        gap: 5px;
    }
    
    .page-nav-btn {
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid #dee2e6;
        border-radius: 4px;
        background-color: #fff;
        color: #007bff;
        cursor: pointer;
        transition: all 0.2s;
    }
    
    .page-nav-btn:hover:not(.disabled) {
        background-color: #e9ecef;
    }
    
    .page-nav-btn.disabled {
        color: #6c757d;
        cursor: not-allowed;
        opacity: 0.65;
    }
</style>
@endpush

        <!-- Pilih Menu Section -->
        <div class="menu-section">
            <div class="section-title">
                <i class="fas fa-bars"></i>
                <h5>Pilih Menu</h5>
            </div>

            <div class="menu-cards">
                <a href="#" class="menu-card kriteria-card">
                    <span class="menu-card-badge">New</span>
                    <div class="menu-card-image">
                        <i class="fas fa-list-check"></i>
                    </div>
                    <div class="menu-card-title">

                        <h5>Input Data Kriteria</h5>
                        <p class="text-muted mt-2 mb-0" style="font-size: 0.85rem;">Kelola kriteria penilaian dan parameter sistem</p>
                    </div>
                </a>

            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>

    </script>
</body>
</html>
 
@endsection