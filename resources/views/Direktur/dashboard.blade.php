<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard-KJM, Direktur</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- League Spartan Font -->
    <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@400;700&display=swap" rel="stylesheet">
    <!-- Argon CSS -->
    <link id="pagestyle" href="{{ asset('Argon/assets/css/argon-dashboard.css') }}" rel="stylesheet" />
    <style>
        body {
            background-color: #f0f2f5;
            font-family: Arial, sans-serif;
        }

        .main-content {
            margin-left: 300px;
            padding: 20px;
            transition: margin 0.3s;
        }

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

        .alert-welcome {
            background-color: #e7f3eb;
            border-radius: 10px;
            padding: 15px;
            margin-top: 40px;
            margin-bottom: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

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

        .fixed-start {
            left: 0;
        }

        .navbar-nav .nav-item .nav-link {
            transition: all 0.3s ease;
            border-radius: 0.5rem;
            margin: 0 0.5rem;
            padding: 0.5rem 1rem;
        }

        .navbar-nav .nav-item .nav-link:hover {
            background-color: #f0f2f5;
            color: #2c4a72;
        }

        @media (max-width: 1199.98px) {
            .main-content {
                margin-left: 0;
            }

            .header-content {
                margin-left: 0;
            }

            .header-breadcrumb {
                margin-left: 0;
            }
        }

        .aksib-brand {
            font-family: 'League Spartan', sans-serif;
            font-size: 18px;
            font-weight: 900;
        }
    </style>
</head>

<body class="g-sidenav-show bg-gray-100">
    <!-- Sidebar -->
    <aside
        class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4"
        id="sidenav-main">
        <div class="sidenav-header">
            <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
                aria-hidden="true" id="iconSidenav"></i>
            <a class="navbar-brand m-0" href="#">
                <img src="{{ asset('img/logo.png') }}" width="30px" height="30px" class="navbar-brand-img h-100"
                    alt="main_logo">
                <span class="ms-1 aksib-brand">AKSIB</span>
            </a>
        </div>
        <hr class="horizontal dark mt-0">
        <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-user-circle text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Profil Pengguna</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="#">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-tachometer-alt text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-check-circle text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Validasi</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-file-alt text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Dokumen Final</span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="sidenav-footer mx-3">
            <div class="card card-plain shadow-none" id="sidenavCard">
                <div class="card-body text-center p-3 w-100 pt-0">
                    <a href="#" class="btn btn-danger btn-sm mb-0 w-100" type="button">Logout</a>
                </div>
            </div>
        </div>
    </aside>

    <!-- Full Width Header -->
    <div class="full-header header">
        <div class="header-content">
            <nav aria-label="breadcrumb" class="header-breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Pages</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                </ol>
                <h5 class="mb-0" style="font-size: 1.1rem; color: white;">Dashboard</h5>
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
        <div class="alert-welcome">
            <div>
                <strong style="color: #03476A; font-size: 0.95rem;">Selamat datang DIREKTUR! Anda bisa mengoperasikan
                    sistem dengan wewenang tertentu melalui pilihan menu di bawah.</strong>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

        <!-- Judul Pilih Menu -->
        <div class="menu-section">
            <div class="d-flex align-items-center mb-2">
                <i class="fas fa-bars me-2"></i>
                <h5 class="mb-0" style="font-size: 1rem;">Pilih Menu</h5>
            </div>
        </div>

        <!-- Kartu-kartu menu dipisah -->
        <div class="menu-cards">
            <a href="#" class="menu-card kriteria-card">
                <span class="menu-card-badge">New</span>
                <div class="menu-card-image">
                    <i class="fas fa-list-check"></i>
                </div>
                <div class="menu-card-title">
                    <h5>Kriteria</h5>
                    <p class="text-muted mt-2 mb-0" style="font-size: 0.85rem;">Kelola kriteria penilaian dan parameter
                        sistem</p>
                </div>
            </a>

            <a href="#" class="menu-card dokumen-card">
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
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Argon JS -->
    <script src="{{ asset('Argon/assets/js/argon-dashboard.min.js') }}"></script>
    <script>
        document.getElementById('iconSidenav').addEventListener('click', function () {
            document.body.classList.toggle('g-sidenav-pinned');
            document.body.classList.toggle('g-sidenav-hidden');
        });

        // Notification bell click handler
        document.querySelector('.notification-bell').addEventListener('click', function () {
            // You can add notification dropdown functionality here
            alert('Notification dropdown would appear here');
        });
    </script>
</body>

</html>