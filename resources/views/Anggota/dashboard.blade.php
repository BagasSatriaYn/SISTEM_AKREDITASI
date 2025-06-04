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

            <div class="user-profile">
                <div class="notification-bell">
                    <i class="fas fa-bell"></i>
                    <span class="notification-badge">3</span>
                </div>
                <a href="#" class="text-white dropdown-toggle" data-bs-toggle="dropdown">
                    <img src="{{ asset('images/profile.jpg') }}" alt="User Profile">
                </a>
                <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="#">Profile</a>
                    <a class="dropdown-item" href="#">Settings</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Logout</a>
                </div>
            </div>
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

                <a href="#" class="menu-card dokumen-card">
                    <div class="menu-card-image">
                        <i class="fas fa-file-pdf"></i>
                    </div>
                    <div class="menu-card-title">
                        <h5>Lihat Dokumen Final</h5>
                        <p class="text-muted mt-2 mb-0" style="font-size: 0.85rem;">Akses dokumen hasil akhir yang telah divalidasi</p>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Notification bell click handler
        document.querySelector('.notification-bell').addEventListener('click', function () {
            // You can add notification dropdown functionality here
            alert('Notification dropdown would appear here');
        });
    </script>
</body>
</html>
 
@endsection