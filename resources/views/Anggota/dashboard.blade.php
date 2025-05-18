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
                font-family: Arial, sans-serif;
            }

            body {
                background-color: #f5f5f5;
            }

            .login-alert {
                background-color: #e8f4f0;
                border: 1px solid #d1e7dd;
                color: #0f5132;
                padding: 0.75rem 1rem;
                border-radius: 4px;
                margin-bottom: 1rem;
                display: flex;
                justify-content: space-between;
                align-items: center;
            }

            .login-alert .close-btn {
                background: transparent;
                border: none;
                color: #0f5132;
                cursor: pointer;
                font-size: 1.25rem;
                line-height: 1;
                padding: 0;
            }

            .header {
                background-color: #f8f0bf;
                padding: 15px 20px;
                display: flex;
                align-items: center;
                margin-bottom: 20px;
            }

            .header h2 {

                color: #0a5275;
                font-size: 20px;
                font-weight: bold;
                margin-left: 10px;
            }

            .hamburger {
                width: 25px;
                display: flex;
                flex-direction: column;
                cursor: pointer;
                margin-right: 10px;
            }

            .hamburger span {
                height: 3px;
                width: 25px;
                background-color: #0a5275;
                margin-bottom: 5px;
                border-radius: 2px;
            }

            .container {
                padding: 0 15px;
            }

            table {
                width: 100%;
                border-collapse: collapse;
                margin-bottom: 20px;
            }

            th {
                background-color: #fff;
                padding: 15px 10px;
                text-align: left;
                color: #333;
                font-weight: bold;
            }

            td {
                background-color: #fff;
                padding: 15px 10px;
                border-top: 15px solid #f5f5f5;
            }

            .badge {
                display: inline-block;
                padding: 5px 15px;
                border-radius: 15px;
                font-size: 14px;
                color: #fff;
            }

            .active {
                background-color: rgba(0, 180, 160, 0.2);
                color: rgb(0, 180, 160);
            }

            .pagination {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 10px 0;
            }

            .pagination-info {
                color: #555;
            }

            .pagination-controls {
                display: flex;
            }

            .pagination-btn {
                width: 30px;
                height: 30px;
                display: flex;
                align-items: center;
                justify-content: center;
                background-color: #fff;
                border-radius: 50%;
                margin: 0 5px;
                cursor: pointer;
                color: #999;
            }

            .action-icons {
                display: flex;
                justify-content: flex-end;
            }

            .action-icon {
                margin-left: 15px;
                width: 20px;
                height: 20px;
                cursor: pointer;
                color: #aaa;
            }

            .menu-options {
                display: flex;
                flex-wrap: wrap;
                gap: 20px;
                margin-top: 20px;
            }

            .menu-card {
                flex: 1;
                min-width: 300px;
                background-color: white;
                border-radius: 10px;
                overflow: hidden;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            }

            .menu-image {
                height: 150px;
                background-color: #2c6d8b;
                display: flex;
                align-items: center;
                justify-content: center;
                position: relative;
            }

            .menu-image img {
                width: 100%;
                height: 100%;
                object-fit: cover;
            }

            .menu-image::after {
                content: "";
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.3);
            }

            .icon-overlay {
                position: absolute;
                z-index: 1;
                color: white;
                font-size: 40px;
            }

            .menu-title {
                padding: 15px;
                text-align: center;
                color: #2c6d8b;
                font-weight: bold;
            }

            .page-header {
                background-color: #f8f9d2;
                padding: 0.75rem 1rem;
                display: flex;
                align-items: center;
                margin-bottom: 1.5rem;
                border-radius: 4px;
            }

            .page-header h5 {
                margin-bottom: 0;
                font-weight: 500;
                color: #333;
                margin-left: 0.5rem;
            }

            .table-container {
                background-color: #fff;
                border-radius: 8px;
                box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
                overflow: hidden;
            }

            .status-table th {
                font-weight: 500;
                color: #333;
                border-bottom-width: 1px;
                padding: 0.75rem 1rem;
            }

            .status-table td {
                padding: 0.75rem 1rem;
                border-bottom: 1px solid #f0f0f0;
            }

            .status-table tr:last-child td {
                border-bottom: none;
            }

            .status-badge {
                padding: 0.3rem 0.6rem;
                border-radius: 50px;
                font-size: 0.75rem;
                font-weight: 500;
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
                padding: 0.3rem;
                cursor: pointer;
                transition: color 0.2s;
            }

            .action-btn:hover {
                color: #0d6efd;
            }

            .pagination-container {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 0.5rem 1rem;
                font-size: 0.875rem;
                color: #6c757d;
            }

            .pagination-info {
                margin: 0;
            }

            .pagination-nav {
                display: flex;
                gap: 0.5rem;
            }

            .page-nav-btn {
                background: #fff;
                border: 1px solid #dee2e6;
                border-radius: 4px;
                padding: 0.25rem 0.5rem;
                cursor: pointer;
                color: #6c757d;
            }

            .page-nav-btn.disabled {
                opacity: 0.5;
                cursor: not-allowed;
            }
        </style>
    </head>

    <body>
        <div class="login-alert" id="loginAlert">
            <span>Selamat datang <strong>Admin Kriteria 1!</strong> Anda bisa mengoperasikan sistem dengan wewenang tertentu
                melalui pilihan menu di bawah.</span>
            <button class="close-btn" onclick="document.getElementById('loginAlert').style.display='none'">×</button>
        </div>
        <div class="header">

            <div class="hamburger">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <h2>Status Pengajuan</h2>
        </div>
        <div class="table-container">
            <table class="table status-table mb-0">
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
                            <span class="status-badge badge-active">Active</span>
                        </td>
                        <td>
                            <div class="d-flex gap-2 justify-content-center">
                                <button class="action-btn" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button class="action-btn" title="View">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Kriteria 2</td>
                        <td>
                            <span class="status-badge badge-inactive">Inactive</span>
                        </td>
                        <td>
                            <div class="d-flex gap-2 justify-content-center">
                                <button class="action-btn" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button class="action-btn" title="View">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="pagination-container">
                <p class="pagination-info">1 of 1</p>
                <div class="pagination-nav">
                    <button class="page-nav-btn disabled">
                        <i class="bi bi-chevron-left"></i>
                    </button>
                    <button class="page-nav-btn disabled">
                        <i class="bi bi-chevron-right"></i>
                    </button>
                </div>
            </div>
        </div>
        </div>

        <div class="header ps-3">
            <div class="hamburger me-2">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <h2>Pilih Menu</h2>
        </div>

        <div class="container py-4">
            <div class="row g-3">
                <div class="col-6 col-sm-4 col-md-3">
                    <div class="card text-center shadow-sm">
                        <div class="card-body">
                            <img src="{{ asset('argon/assets/img/foto-menu.png') }}" alt="Input Data" class="img-fluid mb-2"
                                style="max-height: 120px;">
                            <h6 class="card-title mt-2">Input Data Kriteria</h6>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-sm-4 col-md-3">
                    <div class="card text-center shadow-sm">
                        <div class="card-body">
                            <img src="{{ asset('argon/assets/img/foto-menu.png') }}" alt="Lihat Data" class="img-fluid mb-2"
                                style="max-height: 120px;">
                            <h6 class="card-title mt-2">Lihat Dokumen Final</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container py-4">
            <div class="row">
                <h4>Komentar</h4>
                <div class="card shadow-sm" style="width: 80rem;">
                    <div class="px-2 py-4">
                        <a href="javascript:;" class="card-title d-block text-md" style="color: #323232">
                            <img src="https://th.bing.com/th/id/OIP.tjFlJ96qI6uzt1gXH0Im0wHaHa?rs=1&pid=ImgDetMain"
                                class="rounded-circle" style="max-height: 30px; margin-right: 0.5rem">
                            KPS
                            <span class="py-1 px-3" style="background-color: #DDDAED; display: inline-block; border-radius: 6px; margin-left: 1rem">22 Maret 2025</span>
                        </a>
                        <p class="" style="color: #323232">
                            It is a long established fact that a reader will be distracted by the readable content of a page
                            when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal
                            distribution of letters, as opposed to using 'Content here, content here', making it look like
                            readable English. Many desktop publishing packages and web page...
                        </p>
                        <div class="">
                            <div class="col text-end">
                                <span style="color: #72479C">Baca Selengkapnya</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        </div>

    </body>

    </html>
@endsection
