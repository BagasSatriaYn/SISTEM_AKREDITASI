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
</head>

<body>
<nav class="navbar navbar-transparent navbar-fixed-top" role="navigation">
  <div class="container">
    <div class="navbar-header">
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
      <a href="#" class="btn btn-primary" style="margin-top:8px;">
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
    <source src="{{ asset('videos/akreditasi.mp4') }}" type="video/mp4">
    Your browser does not support the video tag.
  </video>

  <!-- Overlay Gelap (Opsional, biar tulisan lebih jelas) -->
  <div class="cover black" data-color="black" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 2;"></div>
    <div style="height:100px !important">&nbsp;</div>
  <!-- Konten di atas video -->
<div class="container-fluid d-flex flex-column justify-content-center align-items-center text-center" 
style="position: relative; height: 100vh; z-index: 3;"
>
  <h1 class="logo cursive text-white mb-4">
    Sistem Informasi Akreditasi
  </h1>
  <h5 class="info-text text-white" style="color:#fff !important;">
    Silahkan Login.
  </h5>
  <a href="{{ url('/template') }}" class="btn btn-warning btn-fill btn-lg">
    <i class="fa fa-sign-in"></i> Login
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

<script src="{{ asset('coming/js/jquery-1.10.2.js') }}" type="text/javascript"></script>
<script src="{{ asset('coming/js/bootstrap.min.js') }}" type="text/javascript"></script>
</body>
</html>
