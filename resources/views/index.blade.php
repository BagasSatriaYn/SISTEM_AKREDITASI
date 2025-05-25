<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

  <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
  <meta name="viewport" content="width=device-width" />

  <title>Time Lapse</title>

  <link href="{{ asset('coming/css/bootstrap.css') }}" rel="stylesheet" />
  <link href="{{ asset('coming/css/coming-sssoon.css') }}" rel="stylesheet" />
  <link href="http://netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.css" rel="stylesheet">
  <link href="http://fonts.googleapis.com/css?family=Grand+Hotel" rel="stylesheet" type="text/css">

  <style>
    iframe.video-bg {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: -1;
      pointer-events: none;
    }
  </style>
  <style>
  html {
    scroll-behavior: smooth;
  }
</style>

</head>

<body>
<nav class="navbar navbar-fixed-top" role="navigation" style="background-color: #354868;">
  <div class="container">
    <div class="navbar-header">
      <!-- Logo -->
      <a class="navbar-brand" href="#">
      <img src="{{ asset('Argon/assets/img/aksib.png') }}" alt="Logo" style="height: 40px; display: inline-block; margin-top: -5px; margin-left: -170px">
        <span style="color: white; font-weight: bold; margin-left: 8px;">Akreditasi Sistem Informasi Bisnis</span>
      </a>
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>

    <div class="collapse navbar-collapse" id="navbar-collapse">
      <ul class="nav navbar-nav navbar-right">
        <li>
          <a href="{{ url('/') }}" class="btn btn-default" style="margin-top:8px; color: white; border: none;">
            <i class="fa fa-home"></i> Beranda
          </a>
        </li>
        <li>
        <a href="{{ url('/') }}" class="btn btn-primary" style="margin-top:8px; color: white; border: none;">
            <i class="fa fa-list"></i> Kriteria
        </a>
      </li>
      <li>
        <a href="{{ url('login1') }}" class="btn btn-primary" style="margin-top:8px; margin-right:-110px; background-color:rgb(74, 127, 205); color: white;">
    <i class="fa fa-sign-in"></i> Login

  </a>
</li>

      </ul>
    </div>
  </div>
</nav>


<!-- Background Video Lokal -->
<!-- <div class="main" style="position: relative; overflow: hidden; height: 100vh;">
<video class="video-bg" autoplay muted loop playsinline style="width: 100%; height: 100%; object-fit: cover; position: absolute; top: 0; left: 0;">
    <source src="{{ asset('videos/akreditasi.mp4') }}" type="video/mp4">
    Your browser does not support the video tag.
</video>

</div> -->


  <!-- Background Video Lokal -->
<div class="main" style="position: relative; overflow: hidden; height: 100vh;">
  <video class="video-bg" autoplay muted loop playsinline style="width: 100%; height: 100%; object-fit: cover; position: absolute; top: 0; left: 0; z-index: 1;">
    <source src="{{ asset('videos/akreditasii.mp4') }}" type="video/mp4">
    Your browser does not support the video tag.
  </video>  

  <!-- Overlay Gelap (Opsional, biar tulisan lebih jelas) -->
  <div class="cover black" data-color="black" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 2;"></div>
    <div style="height:100px !important">&nbsp;</div>
  <!-- Konten di atas video -->
  <div class="container-fluid d-flex flex-column justify-content-center align-items-center text-center" style="position: relative; height: 100vh; z-index: 3;">
  <div style="position: absolute; top: 30%; transform: translateY(-50%); margin-left:700px;">
    <img src="{{ asset('Argon/assets/img/logopolinema.png') }}" alt="Logo Politeknik Negeri Malang" class="mb-3" style="width: 130px; height: 130px;">
  </div>
  <div style="height:290px !important">&nbsp;</div>
  <h5 class="text-white mb-2" style="color:#fff !important;">
    SELAMAT DATANG DI
  </h5>
  
  <h2 class="text-white mb-4" style="color:#fff !important;">
    AKREDITASI D4 SISTEM INFORMASI BISNIS<br>POLITEKNIK NEGERI MALANG
  </h2>
  
  <a href="#section1" class="btn btn-primary btn-fill btn-lg" style="color:#fff !important; border-radius: 30px;">
    Lihat Profil
</a>
</div>
</div>
</div>
  <div class="footer" style="text-align: center;">
    <div class="container">
      Made with <i class="fa fa-heart heart"></i> by <a href="http://www.creative-tim.com">Kelompok 3. AKSIB </a>
    </div>
  </div>
</div>

<!-- SECTION 1: PROFIL PROGRAM STUDI -->
<section id="section1" style="padding: 150px 15px; background-image: url('{{ asset('Argon/assets/img/bgprofil.png') }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">
  <div class="container">
    <div class="row">
      <div class="col-md-12 text-center mb-5">
        <h2 style="color: #354868; font-weight: bold; padding: 10px; display: inline-block; border-radius: 5px;">PROFIL PROGRAM STUDI</h2>
      </div>
    </div>
    
    <div class="row">
      <div class="col-md-9">
        <div style="background-color: #FFF8DC; padding: 25px; border-radius: 15px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
          <p style="text-align: justify; line-height: 1.6;">
            <!-- Isi paragraf profil program studi -->
            Pada tahun 2022, Program Studi Manajemen Informatika mengikuti program upgrading prodi yang dilaksanakan oleh Kemendikbudristek. Program Upgrading merupakan peningkatan program studi dari Diploma Tiga menjadi Diploma Empat atau Sarjana Terapan. Berdasarkan pada Surat Keputusan Mendikbudristek Nomor 33/D/OT/2022, izin pembukaan Program Studi Sarjana Terapan Sistem Informasi Bisnis secara resmi disetujui. Selanjutnya pada Semester Ganjil Tahun Ajaran 2022/2023, Prodi Sarjana Terapan Sistem Informasi Bisnis Jurusan Teknologi Informasi Politeknik Negeri Malang menerima mahasiswa baru. Dan mulai tahun 2009 s/d sekarang sudah diterapkan kurikulum berbasis proyek untuk semakin mendekatkan mahasiswa pada pengalaman praktik di lapangan.
          </p>
        </div>
      </div>
      <div class="col-md-3 d-flex align-items-center justify-content-center">
        <img src="{{ asset('Argon/assets/img/jti_polinema.png') }}" alt="Program Studi Image" style="width: 250px; height: 250px; object-fit: cover;">
      </div>
    </div>
  </div>
</section>

<!-- SECTION 2: VISI MISI TUJUAN -->
<section style="background-color: #f2f2f2; padding: 130px 15px;">
  <div class="container">
    <div class="row" style=margin-top: -30px>
      <div class="col-md-12 text-center mb-4">
        <h2 style="color: #354868; font-weight: bold; margin-bottom: 70px;">VISI, MISI, TUJUAN PROGRAM STUDI</h2>
      </div>
    </div>
    
    <div class="row">
  <!-- VISI -->
  <div class="col-md-4 mb-4">
    <div style="background-color: #ffffff; padding: 20px; border-radius: 15px; min-height: 300px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); text-align: center;">
      <img src="{{ asset('Argon/assets/img/lamp.png') }}" alt="Visi Icon" style="width: 40px; margin-bottom: 10px;">
      <h4 style="color: #354868; font-weight: bold;">VISI</h4>
      <p style="margin-top: 10px;">Menjadi Program Studi Unggul dalam Bidang Sistem Informasi Bisnis di Tingkat Nasional dan Internasional.</p>
    </div>
  </div>

  <!-- MISI -->
  <div class="col-md-4 mb-4">
    <div style="background-color: #ffffff; padding: 20px; border-radius: 15px; min-height: 300px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
      <img src="{{ asset('Argon/assets/img/lamp.png') }}" alt="Misi Icon" style="width: 40px; display: block; margin: 0 auto 10px;">
      <h4 style="color: #354868; text-align: center; font-weight: bold;">MISI</h4>
      <ol style="padding-left: 18px; margin-top: 10px;">
        <li>Pendidikan vokasi terapan berbasis teknologi di bidang Sistem Informasi Bisnis.</li>
        <li>Penelitian terapan berbasis produk dan jasa Sistem Informasi Bisnis.</li>
        <li>Pengabdian masyarakat melalui Sistem Informasi Bisnis.</li>
        <li>Kerja sama nasional dan internasional di bidang Sistem Informasi Bisnis.</li>
      </ol>
    </div>
  </div>

  <!-- TUJUAN -->
  <div class="col-md-4 mb-4">
    <div style="background-color: #ffffff; padding: 20px; border-radius: 15px; min-height: 300px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
      <img src="{{ asset('Argon/assets/img/lamp.png') }}" alt="Tujuan Icon" style="width: 40px; display: block; margin: 0 auto 10px;">
      <h4 style="color: #354868; text-align: center; font-weight: bold;">TUJUAN</h4>
      <ol style="padding-left: 18px; margin-top: 10px;">
        <li>Menghasilkan lulusan Sistem Informasi Bisnis yang etis dan kompeten secara global.</li>
        <li>Menghasilkan riset terapan yang mendukung industri HaKI dan kesejahteraan.</li>
        <li>Pengabdian masyarakat berbasis ilmu yang berdampak langsung.</li>
        <li>Kerja sama nasional dan internasional untuk daya saing bidang Sistem Informasi Bisnis.</li>
      </ol>
    </div>
  </div>
</div>

  </div>
</section>




<script src="{{ asset('coming/js/jquery-1.10.2.js') }}" type="text/javascript"></script>
<script src="{{ asset('coming/js/bootstrap.min.js') }}" type="text/javascript"></script>
</body>
</html>
