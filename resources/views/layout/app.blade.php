<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
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
    <!-- Include Sidebar -->
    @include('layout.sidebar')
    
    <!-- Include Header -->
    @include('layout.headerdirektur')

    <!-- Main Content -->
    <div class="main-content">
        @yield('content')
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
    @stack('scripts')
</body>

</html>