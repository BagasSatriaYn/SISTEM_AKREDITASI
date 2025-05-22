@extends('layouts.template')

@section('content')

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Pengajuan</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }

        body {
            background-color: #f5f5f5;
        }
        
        
        /* Updated Welcome Alert */
        .login-alert {
            background-color: #e7f3eb;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .login-alert strong {
            color: #03476A;
            font-size: 0.95rem;
            font-weight: 600;
        }
        
        .login-alert .close-btn {
            background: transparent;
            border: none;
            color: #03476A;
            cursor: pointer;
            font-size: 1.25rem;
            line-height: 1;
            padding: 0;
        }
        
        /* Full Width Header */
        .full-header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: auto;
            z-index: 1000;
            background-color: #354868;
            color: white;
            padding: 18px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header-content {
            width: 100%;
            display: flex;
            justify-content: space-between;
            margin-left: 300px;
        }

        .header-breadcrumb {
            margin-left: 20px;
        }

        .main-content {
            margin-top: 70px;
        }

        .header .breadcrumb {
            margin-bottom: 0;
            background: transparent;
            color: white;
            font-size: 0.85rem;
            padding: 0;
        }

        .header .breadcrumb-item a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
        }

        .header .breadcrumb-item.active {
            color: white;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .user-profile img {
            width: 30px;
            height: 30px;
            border-radius: 50%;
        }

        .notification-bell {
            position: relative;
            color: white;
            font-size: 1.2rem;
            cursor: pointer;
        }

        .notification-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background-color: #ff4757;
            color: white;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.65rem;
            font-weight: bold;
        }

        /* Status Pengajuan Section */
        .status-section {
            background-color: rgba(53, 72, 104, 0.1);
            padding: 12px;
            border-radius: 10px;
            margin-bottom: 15px;
        }

        /* Table Container - Updated to match menu style */
        .table-container {
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            overflow: hidden;
            margin-bottom: 20px;
            transition: all 0.3s ease;
        }
        
        .table-container:hover {
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }
        
        .status-table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .status-table th {
            font-weight: 600;
            color: #333;
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid #f0f0f0;
            font-size: 0.9rem;
        }
        
        .status-table td {
            padding: 1rem;
            border-bottom: 1px solid #f0f0f0;
            font-size: 0.9rem;
        }
        
        .status-table tr:last-child td {
            border-bottom: none;
        }
        
        .status-badge {
            padding: 0.4rem 0.8rem;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 600;
            display: inline-block;
        }
        
        .badge-active {
            background-color: #e6f7f2;
            color: #28a745;
        }
        
        .badge-inactive {
            background-color: #fbe7e6;
            color: #dc3545;
        }
        
        .action-btn {
            background: transparent;
            border: none;
            color: #6c757d;
            padding: 0.5rem;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 1rem;
            border-radius: 50%;
            width: 35px;
            height: 35px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        
        .action-btn:hover {
            color: #0d6efd;
            background-color: rgba(13, 110, 253, 0.1);
            transform: translateY(-2px);
        }
        
        .pagination-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem;
            font-size: 0.875rem;
            color: #6c757d;
            border-top: 1px solid #f0f0f0;
        }
        
        .pagination-info {
            margin: 0;
            font-weight: 500;
        }
        
        .pagination-nav {
            display: flex;
            gap: 0.5rem;
        }
        
        .page-nav-btn {
            background: #fff;
            border: 1px solid #dee2e6;
            border-radius: 50%;
            width: 35px;
            height: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: #6c757d;
            transition: all 0.3s ease;
        }
        
        .page-nav-btn:hover:not(.disabled) {
            background-color: #f8f9fa;
            color: #0d6efd;
        }
        
        .page-nav-btn.disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        /* Menu Cards Section */
        .menu-section {
            background-color: rgba(250, 210, 1, 0.3);
            padding: 12px;
            border-radius: 10px;
            margin-bottom: 15px;
        }

        .menu-cards {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-top: 20px;
        }

        .menu-card {
            background-color: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            width: calc(50% - 10px);
            max-width: 380px;
            transition: all 0.3s ease;
            text-decoration: none;
            color: inherit;
            position: relative;
            border: none;
        }

        .menu-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .menu-card-image {
            height: 160px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        /* Kriteria Card */
        .kriteria-card .menu-card-image {
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
        }

        /* Dokumen Final Card */
        .dokumen-card .menu-card-image {
            background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
        }

        .menu-card-image i {
            font-size: 60px;
            color: white;
            z-index: 1;
            transition: all 0.3s ease;
        }

        .menu-card:hover .menu-card-image i {
            transform: scale(1.1);
        }

        .menu-card-image::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.1);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .menu-card:hover .menu-card-image::after {
            opacity: 1;
        }

        .menu-card-title {
            padding: 20px;
            text-align: center;
            border-top: none;
            position: relative;
        }

        .menu-card-title h5 {
            margin: 0;
            color: #333;
            font-size: 1.1rem;
            font-weight: 600;
            position: relative;
            display: inline-block;
        }

        .menu-card-title h5::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 50%;
            transform: translateX(-50%);
            width: 40px;
            height: 3px;
            background: #2c4a72;
            transition: width 0.3s ease;
        }

        .menu-card:hover .menu-card-title h5::after {
            width: 60px;
        }

        .menu-card-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            background-color: rgba(255, 255, 255, 0.9);
            color: #2c4a72;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: bold;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .dropdown-toggle::after {
            display: none;
        }

        .aksib-brand {
            font-family: 'League Spartan', sans-serif;
            font-size: 18px;
            font-weight: 900;
        }

        .section-title {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        .section-title i {
            margin-right: 10px;
            color: #354868;
        }

        .section-title h5 {
            margin: 0;
            font-size: 1rem;
            font-weight: 600;
            color: #354868;
        }
    </style>
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
                    <li class="breadcrumb-item active" aria-current="page">Status Pengajuan</li>
                </ol>
                <h5 class="mb-0" style="font-size: 1.1rem; color: white;">Status Pengajuan</h5>
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
        
        <!-- Status Pengajuan Section -->
        <div class="menu-section">
            <div class="section-title">
                <i class="fas fa-bars"></i>
                <h5>Status Pengajuan</h5>
            </div>
        </div>
            
            <div class="table-container">
                <table class="status-table">
                    <thead>
                        <tr>
                            <th style="width: 10%">ID</th>
                            <th style="width: 50%">Data Kriteria</th>
                            <th style="width: 20%">Status</th>
                            <th style="width: 20%">Actions</th>
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
                            <td>
                                <div class="d-flex gap-2 justify-content-center">
                                    <button class="action-btn" title="Edit">
                                        <i class="fas fa-pencil-alt"></i>
                                    </button>
                                    <button class="action-btn" title="View">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
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
                            <td>
                                <div class="d-flex gap-2 justify-content-center">
                                    <button class="action-btn" title="Edit">
                                        <i class="fas fa-pencil-alt"></i>
                                    </button>
                                    <button class="action-btn" title="View">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
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