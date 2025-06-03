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
        
        <!-- Status Pengajuan Section - Modified -->
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
                        <tr>
                            <td>1</td>
                            <td>Kriteria 1</td>
                            <td>
                                <span class="status-badge badge-active">
                                    <i class="fas fa-check-circle me-1"></i> Active
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Kriteria 2</td>
                            <td>
                                <span class="status-badge badge-inactive">
                                    <i class="fas fa-times-circle me-1"></i> Inactive
                                </span>
                            </td>
                        </tr>
                    </tbody>
                </table>
                
                <!-- Pagination -->
                <div class="pagination-container">
                    <p class="pagination-info">Showing 1 to 2 of 2 entries</p>
                    <div class="pagination-nav">
                        <button class="page-nav-btn disabled">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <button class="page-nav-btn disabled">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

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