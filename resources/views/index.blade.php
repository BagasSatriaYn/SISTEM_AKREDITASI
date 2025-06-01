<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

  <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
  <meta name="viewport" content="width=device-width" />

  <title>Time Lapse</title>

  <!-- Bootstrap & custom CSS -->
  <link href="{{ asset('coming/css/bootstrap.css') }}" rel="stylesheet" />
  <link href="{{ asset('coming/css/coming-sssoon.css') }}" rel="stylesheet" />
  <link href="http://netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="http://fonts.googleapis.com/css?family=Grand+Hotel" rel="stylesheet" type="text/css">

  <!-- Google Fonts: Montserrat -->
  <link
    href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap"
    rel="stylesheet"
  />

  <!-- Custom Styles -->
  <style>
    :root {
      --primary: #1d3557;
      --secondary: #457b9d;
      --accent: #a8dadc;
      --light: #f1faee;
      --dark: #0d1b2a;
      --highlight: #e63946;
      --transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
      --hover-color: #cadefc;
    }
    
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }
    
    html {
      scroll-behavior: smooth;
    }

    body {
      font-family: 'Montserrat', sans-serif;
      background-color: #f8f9fa;
      color: #333;
      line-height: 1.6;
    }

    /* --- Global Montserrat Font --- */
    .montserrat {
      font-family: 'Montserrat', sans-serif;
    }

    /* --- HERO SECTION --- */
    .hero {
      position: relative;
      height: 100vh;
      overflow: hidden;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    
    .hero-video {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      object-fit: cover;
      z-index: -1;
      pointer-events: none;
    }
    
    .hero-overlay {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: linear-gradient(to bottom, rgba(13, 27, 42, 0.85), rgba(29, 53, 87, 0.4));
      z-index: -1;
    }
    
    .hero-content {
      text-align: center;
      max-width: 900px;
      padding: 0 20px;
      z-index: 10;
    }
    
    .hero-logo {
      width: 130px;
      height: 130px;
      margin-bottom: 25px;
      opacity: 0;
      animation: fadeInDown 1.2s ease-out forwards;
    }
    
    .hero-subtitle {
      color: var(--accent) !important;
      font-size: 1.4rem;
      font-weight: 400;
      letter-spacing: 1px;
      margin-bottom: 15px;
      text-transform: uppercase;
      opacity: 0;
      animation: fadeInUp 0.8s ease-out 0.4s forwards;
    }
    
    .hero-title {
      color: white !important;
      font-size: 2.5rem;
      font-weight: 700;
      line-height: 1.25;
      margin-bottom: 30px;
      opacity: 0;
      animation: fadeInUp 0.8s ease-out 0.6s forwards;
    }
    
    .hero-btn {
      background-color: var(--accent);
      color: var(--dark) !important;
      border-radius: 50px;
      padding: 14px 40px;
      font-size: 1.1rem;
      font-weight: 600;
      transition: var(--transition);
      border: none;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
      position: relative;
      overflow: hidden;
      opacity: 0;
      animation: fadeInUp 0.8s ease-out 0.8s forwards;
    }
    
    .hero-btn:hover {
      transform: scale(1.05);
      box-shadow: 0 12px 25px rgba(0, 0, 0, 0.4);
    }
    
    /* --- KEYFRAMES for animations --- */
    @keyframes fadeInDown {
      0% {
        opacity: 0;
        transform: translateY(-40px);
      }
      100% {
        opacity: 1;
        transform: translateY(0);
      }
    }
    
    @keyframes fadeInUp {
      0% {
        opacity: 0;
        transform: translateY(40px);
      }
      100% {
        opacity: 1;
        transform: translateY(0);
      }
    }
    
    @keyframes fadeIn {
      0% {
        opacity: 0;
      }
      100% {
        opacity: 1;
      }
    }
    
    @keyframes pulse {
      0% { transform: scale(1); }
      50% { transform: scale(1.1); }
      100% { transform: scale(1); }
    }
    
    @keyframes titleAnimation {
      0% {
        transform: translateY(-30px) scale(0.8);
        opacity: 0;
        letter-spacing: 20px;
      }
      60% {
        transform: translateY(0) scale(1.05);
        opacity: 1;
        letter-spacing: 5px;
      }
      100% {
        transform: translateY(0) scale(1);
        opacity: 1;
        letter-spacing: normal;
      }
    }
    
    @keyframes popUp {
      0% {
        transform: translateY(100px);
        opacity: 0;
      }
      100% {
        transform: translateY(0);
        opacity: 1;
      }
    }
    
    @keyframes waveAnimation {
      0% { background-position-x: 0; }
      100% { background-position-x: 1200px; }
    }
    
    @keyframes float {
      0% { transform: translateY(0px) rotate(0deg); }
      50% { transform: translateY(-20px) rotate(5deg); }
      100% { transform: translateY(0px) rotate(0deg); }
    }
    
    @keyframes borderGradient {
      0% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
      100% { background-position: 0% 50%; }
    }
    
    /* --- Navbar override (optional) --- */
    .navbar-fixed-top {
      background-color: #1d3557 !important;
      border: none;
    }

    /* --- Footer Styling --- */
    .footer {
      background-color: var(--dark);
      color: white;
      padding: 20px 0;
      text-align: center;
    }
    
    .footer p {
      font-size: 1rem;
      margin: 0;
    }
    
    .footer a {
      color: var(--accent);
      text-decoration: none;
      transition: var(--transition);
    }
    
    .footer a:hover {
      color: white;
      text-decoration: underline;
    }
    
    .heart {
      color: var(--highlight);
      animation: pulse 1.5s infinite;
    }

    /* --- SECTION 1: PROFIL PROGRAM STUDI --- */
    #section1 {
      position: relative;
      padding: 150px 15px;
      background-image: url('{{ asset('Argon/assets/img/bgprofil.png') }}');
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      overflow: hidden;
    }

    /* Wave Background */
    .wave-bg {
      position: absolute;
      bottom: 0;
      left: 0;
      width: 100%;
      height: 100px;
      background: url('data:image/svg+xml;utf8,<svg viewBox="0 0 1200 120" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none"><path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" opacity=".25" fill="%23354868"/><path d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z" opacity=".5" fill="%23354868"/><path d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z" fill="%23354868"/></svg>');
      background-size: 1200px 100px;
      z-index: 1;
      animation: waveAnimation 15s linear infinite;
    }

    /* Floating elements */
    .floating {
      position: absolute;
      z-index: 0;
      opacity: 0.1;
    }
    
    .floating.circle {
      width: 100px;
      height: 100px;
      border-radius: 50%;
      background: linear-gradient(135deg, #FF6B6B, #4ECDC4);
    }
    
    .floating.triangle {
      width: 0;
      height: 0;
      border-left: 60px solid transparent;
      border-right: 60px solid transparent;
      border-bottom: 100px solid #4ECDC4;
    }
    
    /* Judul Section */
    .section-title {
      animation-delay: 3s !important;
      position: relative;
      font-size: 4.5rem;
      font-weight: 800;
      color: #354868;
      text-transform: uppercase;
      margin-bottom: 60px;
      padding: 15px 0;
      display: inline-block;
      text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
      animation: titleAnimation 1.2s ease-out forwards;
      opacity: 0;
    }
    
    .section-title::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 50%;
      transform: translateX(-50%);
      width: 80%;
      height: 4px;
      background: linear-gradient(90deg, transparent, #FF6B6B, transparent);
      border-radius: 2px;
    }
    
    /* Box Content */
    .content-box {
      background: linear-gradient(135deg, #FFF8DC 0%, #fff1c2 100%);
      padding: 35px;
      border-radius: 20px;
      box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
      position: relative;
      overflow: hidden;
      z-index: 2;
      animation: popUp 1s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
      opacity: 0;
      transform: translateY(100px);
    }
    
    .content-box::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 4px;
      background: linear-gradient(90deg, #457b9d, #a8dadc, #1d3557);
      animation: borderGradient 3s linear infinite;
      background-size: 200% 200%;
    }
    
    .content-box p {
      text-align: justify;
      line-height: 1.8;
      font-size: 1.1rem;
      margin-bottom: 0;
      position: relative;
      z-index: 2;
    }
    
    /* Logo Box */
    .logo-box {
      display: flex;
      align-items: center;
      justify-content: center;
      perspective: 1000px;
      z-index: 2;
    }
    
    .logo-img {
      width: 290px;
      height: auto;
      transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
      position: relative;
      z-index: 2;
      filter: drop-shadow(0 5px 15px rgba(0, 0, 0, 0.2));
    }
    
    .logo-img:hover {
      transform: rotate(5deg) scale(1.05);
      filter: drop-shadow(0 10px 25px rgba(0, 0, 0, 0.3));
    }

    /* --- SECTION 2: VISI MISI TUJUAN --- */
    /* Styling untuk wave effect */
    .wave-container {
      position: relative;
      height: 200px;
      width: 100%;
      overflow: hidden;
      margin-top: 50px;
    }
    
    .wave {
      position: absolute;
      left: 0;
      right: 0;
      top: 0;
      bottom: 0;
      z-index: 1;
    }
    
    .wave + .wave {
      z-index: 2;
    }
    
    .btn-wrapper {
      position: absolute;
      bottom: 30px;
      left: 50%;
      transform: translateX(-50%);
      z-index: 10;
      display: flex;
      gap: 15px;
    }
    
    .btn-control {
      display: inline-block;
      background-color: white;
      color: #2c3e50;
      font-size: 16px;
      font-weight: 600;
      border-radius: 30px;
      padding: 10px 20px;
      text-decoration: none;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
      transition: all 0.3s ease;
      border: 2px solid var(--primary);
      cursor: pointer;
    }
    
    .btn-control:hover {
      background-color: var(--primary);
      color: white;
      transform: translateY(-3px);
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
    }
    
    /* Styling untuk Visi, Misi, Tujuan */
    .visi-misi-section {
      background-color: #f2f2f2; 
      padding: 100px 15px 70px;
      position: relative;
    }
    
    .visi-misi-section .section-title {
      position: relative;
      font-size: 4.5rem;
      font-weight: 700;
      color: #354868;
      text-align: center;
      margin-bottom: 60px;
      padding: 15px 0;
      display: inline-block;
      width: 100%;
      text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
    }
    
    .visi-misi-section .section-title::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 50%;
      transform: translateX(-50%);
      width: 50%;
      height: 4px;
      background: linear-gradient(90deg, transparent, #FF6B6B, transparent);
      border-radius: 2px;
    }

    .vm-box {
      background-color: #ffffff;
      padding: 30px;
      border-radius: 15px;
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
      min-height: 320px;
      transition: all 0.4s ease;
      position: relative;
      overflow: hidden;
      z-index: 1;
      height: 100%;
      display: flex;
      flex-direction: column;
    }
    
    .vm-box::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 5px;
      background: linear-gradient(90deg, #457b9d, #a8dadc, #1d3557);
      z-index: 2;
    }
    
    .vm-box:hover {
      background-color: var(--hover-color);
      transform: translateY(-10px);
      box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
    }
    
    .vm-icon {
      width: 60px;
      height: 60px;
      display: flex;
      align-items: center;
      justify-content: center;
      background: linear-gradient(135deg, #1d3557, #457b9d);
      border-radius: 50%;
      margin: 0 auto 20px;
      color: white;
      font-size: 24px;
      transition: all 0.3s ease;
    }
    
    .vm-box:hover .vm-icon {
      transform: scale(1.1);
      background: linear-gradient(135deg, #457b9d, #1d3557);
    }
    
    .vm-title {
      color: #354868;
      text-align: center;
      font-weight: 700;
      margin-bottom: 20px;
      font-size: 1.5rem;
      position: relative;
      padding-bottom: 10px;
    }
    
    .vm-title::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 50%;
      transform: translateX(-50%);
      width: 50px;
      height: 3px;
      background: #457b9d;
      border-radius: 2px;
    }
    
    .vm-box:hover .vm-title::after {
      background: #1d3557;
    }
    
    .vm-content {
      flex-grow: 1;
    }
    
    .vm-content p {
      text-align: center;
      margin-top: 15px;
      font-size: 1.1rem;
      color: #444;
    }
    
    .vm-content ol {
      padding-left: 20px;
      margin-top: 15px;
    }
    
    .vm-content li {
      margin-bottom: 10px;
      font-size: 1.05rem;
      position: relative;
    }
    
    .vm-content li::before {
      content: '✓';
      color: #457b9d;
      font-weight: bold;
      position: absolute;
      left: -20px;
    }
    
    .vm-box:hover .vm-content li::before {
      color: #1d3557;
    }
    
    /* Responsive styles */
    @media (max-width: 992px) {
      .vm-box {
        min-height: auto;
        margin-bottom: 25px;
      }
      
      .visi-misi-section .section-title {
        font-size: 2.4rem;
        margin-bottom: 40px;
      }
    }
    
    @media (max-width: 768px) {
      .visi-misi-section .section-title {
        font-size: 2rem;
      }
      
      .visi-misi-section {
        padding: 70px 15px 50px;
      }
      
      .vm-title {
        font-size: 1.3rem;
      }
      
      .vm-content li {
        font-size: 1rem;
      }
      
      .btn-wrapper {
        flex-direction: column;
        align-items: center;
        bottom: 20px;
      }
    }
    
    @media (max-width: 576px) {
      .visi-misi-section .section-title {
        font-size: 1.7rem;
      }
      
      .vm-box {
        padding: 25px 20px;
      }
      
      .vm-icon {
        width: 50px;
        height: 50px;
        font-size: 30px;
      }
      
      .wave-container {
        height: 150px;
      }
    }
  </style>
</head>

<body>
  <!-- Navbar -->
  <nav class="navbar navbar-fixed-top" role="navigation">
    <div class="container">
      <div class="navbar-header">
        <!-- Logo -->
        <a class="navbar-brand" href="#">
          <img src="{{ asset('Argon/assets/img/aksib.png') }}" alt="Logo"
               style="height: 28px; display: inline-block; margin-top: -5px; margin-left: -170px;">
          <span style="color: white; font-weight: bold; margin-left: 5px;" class="montserrat">
            Akreditasi Sistem Informasi Bisnis
          </span>
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
            <a href="{{ url('/') }}" class="btn btn-default montserrat" style="margin-top:8px; color: rgb(255, 255, 255); border: none;">
              <i class="fa fa-home"></i> Beranda
            </a>
          </li>
          <li>
            <a href="{{ url('/login1') }}" class="btn btn-primary montserrat"
               style="margin-top:8px; margin-right:-110px; color: white;">
              <i class="fa fa-sign-in"></i> Login
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Hero Section with Video Background -->
  <section class="hero">
    <!-- Local Video Background -->
    <video class="hero-video" autoplay muted loop playsinline>
      <source src="{{ asset('videos/akreditasii.mp4') }}" type="video/mp4" />
      Your browser does not support the video tag.
    </video>
    <div class="hero-overlay"></div>
    <div class="hero-content">
      <img src="{{ asset('Argon/assets/img/logopolinema.png') }}"
           alt="Logo Politeknik Negeri Malang"
           class="hero-logo" />
      <h5 class="hero-subtitle montserrat">
        SELAMAT DATANG DI
      </h5>
      <h1 class="hero-title montserrat">
        AKREDITASI D4 SISTEM INFORMASI BISNIS<br />
        POLITEKNIK NEGERI MALANG
      </h1>
      <a href="#section1" class="btn hero-btn montserrat">
        Lihat Profil <i class="fas fa-arrow-down ms-2"></i>
      </a>
    </div>
  </section>

  <!-- Footer -->
  <div class="footer">
    <div class="container">
      <p>Made with <i class="fas fa-heart heart"></i> by <a href="#">Kelompok 3 - AKSIB</a></p>
      <p class="mt-2">Politeknik Negeri Malang &copy; 2023</p>
    </div>
  </div>

  <!-- SECTION 1: PROFIL PROGRAM STUDI -->
  <section id="section1">
    <div class=""></div>
    
    <!-- Floating elements -->
    <div class="floating circle" style="top: 10%; left: 5%; animation: float 30s ease-in-out infinite;"></div>
    <div class="floating triangle" style="top: 20%; right: 10%; animation: float 30s ease-in-out infinite;"></div>
    <div class="floating circle" style="bottom: 20%; right: 10%; width: 70px; height: 70px; animation: float 30s ease-in-out infinite;"></div>
    
    <div class="container">
      <div class="row">
        <div class="col-md-12 text-center mb-5">
          <h2 class="montserrat section-title">
            PROFIL PROGRAM STUDI
          </h2>
        </div>
      </div>

      <div class="row">
        <div class="col-md-9">
          <div class="content-box">
            <p class="montserrat" style="font-size: 1.5rem;">
              Pada tahun 2022, Program Studi Manajemen Informatika mengikuti program upgrading prodi yang
              dilaksanakan oleh Kemendikbudristek. Program Upgrading merupakan peningkatan program studi dari
              Diploma Tiga menjadi Diploma Empat atau Sarjana Terapan. Berdasarkan pada Surat Keputusan
              Mendikbudristek Nomor 33/D/OT/2022, izin pembukaan Program Studi Sarjana Terapan Sistem Informasi
              Bisnis secara resmi disetujui. Selanjutnya pada Semester Ganjil Tahun Ajaran 2022/2023, Prodi
              Sarjana Terapan Sistem Informasi Bisnis Jurusan Teknologi Informasi Politeknik Negeri Malang menerima
              mahasiswa baru. Dan mulai tahun 2009 s/d sekarang sudah diterapkan kurikulum berbasis proyek untuk
              semakin mendekatkan mahasiswa pada pengalaman praktik di lapangan.
            </p>
          </div>
        </div>
        <div class="col-md-3 d-flex align-items-center justify-content-center">
         <div class="mt-4">
          <img src="{{ asset('Argon/assets/img/JTI-LOGO.png') }}"
               alt="Logo JTI"
               class="logo-img">
        </div>
        </div>
      </div>
    </div>
  </section>

  <!-- SECTION 2: VISI MISI TUJUAN -->
  <section class="visi-misi-section">
    <div class="container">
      <div class="row">
        <div class="col-md-12 text-center mb-5">
          <h2 class="montserrat section-title">
            VISI, MISI, TUJUAN PROGRAM STUDI
          </h2>
        </div>
      </div>

      <div class="row">
        <!-- VISI -->
        <div class="col-md-4 mb-4">
          <div class="vm-box">
            <div class="vm-icon">
              <i class="fas fa-lightbulb"></i>
            </div>
            <h4 class="montserrat vm-title">VISI</h4>
            <div class="vm-content">
              <p class="montserrat">
                Menjadi Program Studi Unggul dalam Bidang Sistem Informasi Bisnis di Tingkat Nasional dan Internasional.
              </p>
            </div>
          </div>
        </div>

        <!-- MISI -->
        <div class="col-md-4 mb-4">
          <div class="vm-box">
            <div class="vm-icon">
              <i class="fas fa-bullseye"></i>
            </div>
            <h4 class="montserrat vm-title">MISI</h4>
            <div class="vm-content">
              <ol class="montserrat">
                <li>Pendidikan vokasi terapan berbasis teknologi di bidang Sistem Informasi Bisnis.</li>
                <li>Penelitian terapan berbasis produk dan jasa Sistem Informasi Bisnis.</li>
                <li>Pengabdian masyarakat melalui Sistem Informasi Bisnis.</li>
                <li>Kerja sama nasional dan internasional di bidang Sistem Informasi Bisnis.</li>
              </ol>
            </div>
          </div>
        </div>

        <!-- TUJUAN -->
        <div class="col-md-4 mb-4">
          <div class="vm-box">
            <div class="vm-icon">
              <i class="fas fa-flag"></i>
            </div>
            <h4 class="montserrat vm-title">TUJUAN</h4>
            <div class="vm-content">
              <ol class="montserrat">
                <li>Menghasilkan lulusan Sistem Informasi Bisnis yang etis dan kompeten secara global.</li>
                <li>Menghasilkan riset terapan yang mendukung industri HaKI dan kesejahteraan.</li>
                <li>Pengabdian masyarakat berbasis ilmu yang berdampak langsung.</li>
                <li>Kerja sama nasional dan internasional untuk daya saing bidang Sistem Informasi Bisnis.</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Wave Effect Container -->
  <div class="wave-container">
    <svg width="100%" height="100%" version="1.1" xmlns="http://www.w3.org/2000/svg" class="wave" id="wave1">
      <defs></defs>
      <path id="feel-the-wave" d=""/>
    </svg>
    
    <svg width="100%" height="100%" version="1.1" xmlns="http://www.w3.org/2000/svg" class="wave" id="wave2">
      <defs></defs>
      <path id="feel-the-wave-two" d=""/>
    </svg>
    
  </div>

  <!-- Footer -->
  <div class="footer">
    <div class="container">
      <p>Made with <i class="fas fa-heart heart"></i> by <a href="#">Kelompok 3 - AKSIB</a></p>
      <p class="mt-2">Politeknik Negeri Malang &copy; 2023</p>
    </div>
  </div>

  <!-- jQuery & Bootstrap JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="{{ asset('coming/js/bootstrap.min.js') }}" type="text/javascript"></script>
  <script src="https://cdn.jsdelivr.net/npm/wavify"></script>

  <!-- Additional Scripts -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Menambahkan efek parallax pada video background
      window.addEventListener('scroll', function() {
        const scrollPosition = window.scrollY;
        const video = document.querySelector('.hero-video');
        if (video) {
          video.style.transform = `translateY(${scrollPosition * 0.5}px)`;
        }
      });

      // Inisialisasi wave effect
      var wave1 = $('#feel-the-wave').wavify({
        height: 80,
        bones: 4,
        amplitude: 60,
        color: '#1d3557',
        speed: .15
      });

      var wave2 = $('#feel-the-wave-two').wavify({
        height: 60,
        bones: 3,
        amplitude: 40,
        color: 'rgba(69, 123, 157, 0.8)',
        speed: .25
      });

      // Array warna untuk efek acak
      var colors = [
        '#1d3557', 
        '#457b9d', 
        '#a8dadc', 
        '#e63946', 
        '#ff9a8b', 
        '#9d9ade', 
        '#6cd7ee', 
        '#aceeae'
      ];

      // Event listener untuk tombol kontrol
      $("[data-pause]").on('click', function(e){
        e.preventDefault();
        wave1.pause();
        wave2.pause();
        $(this).html('<i class="fas fa-play"></i> Play').attr('data-play', '').removeAttr('data-pause');
        $("[data-play]").html('<i class="fas fa-pause"></i> Pause').attr('data-pause', '').removeAttr('data-play');
      });

      $("[data-play]").on('click', function(e){
        e.preventDefault();
        wave1.play();
        wave2.play();
        $(this).html('<i class="fas fa-pause"></i> Pause').attr('data-pause', '').removeAttr('data-play');
        $("[data-pause]").html('<i class="fas fa-play"></i> Play').attr('data-play', '').removeAttr('data-pause');
      });

      $("[data-color]").on('click', function(e){
        e.preventDefault();
        const color1 = colors[Math.floor(Math.random() * colors.length)];
        const color2 = colors[Math.floor(Math.random() * colors.length)];
        
        wave1.updateColor({
          color: color1,
          timing: 4
        });
        
        wave2.updateColor({
          color: `${color2}80`,
          timing: 3
        });
      });
    });
  </script>
</body>
</html>