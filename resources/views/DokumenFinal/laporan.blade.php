{{-- @extends('layouts.template')

@section('content')
<div class="container-fluid mt--6">
    <div class="row">
        <div class="col">
            <div class="card">
                <!-- Header -->
                <div class="card-header border-0">
                    <h1 class="mb-0 text-center">AKSIB</h1>
                </div>
                
                <div class="card-body">
                    <!-- Login Section -->
                    <div class="mb-5">
                        <h3>Login</h3>
                        <ul class="list-unstyled">
                            <li>{{ $user['name'] }}</li>
                            <li>Dashboard: <a href="{{ $user['dashboard_url'] }}" target="_blank">{{ $user['dashboard_url'] }}</a></li>
                        </ul>
                    </div>
                    
                    <!-- Notes Section -->
                    <div class="mb-5">
                        <h3>Notes</h3>
                        <ul>
                            @foreach($notes as $note)
                                <li>{{ $note }}</li>
                            @endforeach
                        </ul>
                    </div>
                    
                    <div class="mb-4">
                        <h3>Columns Final</h3>
                        <hr>
                    </div>
                    
                    <!-- Laporan Section -->
                    <div class="mt-5 text-center">
                        <h2>LAPORAN PRAKTIKUM JOBSHEET 5</h2>
                        <h3>{{ $laporan['judul'] }}</h3>
                        <p class="lead">{{ $laporan['deskripsi'] }}</p>
                        
                        <div class="mt-5 text-left">
                            <p><strong>Olda :</strong></p>
                            <p>{{ $laporan['penulis']['nama'] }}</p>
                            <p>{{ $laporan['penulis']['nim'] }}</p>
                            <p>{{ $laporan['penulis']['kelas'] }}</p>
                            <p>{{ $laporan['penulis']['tanggal'] }}</p>
                        </div>
                        
                        <div class="mt-5">
                            <p>PROGRAM STUDI D-IV SISTEM INFORMASI BISNIS</p>
                            <p>POLITEKNIK NEGERI MALANG TAHUN AJARAN 2024/2025</p>
                        </div>
                    </div>
                </div>
                
                <!-- Footer -->
                <div class="card-footer py-4 text-center">
                    <footer class="footer">
                        Copyright ©2025. Designed by Microsoft 3.
                    </footer>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}