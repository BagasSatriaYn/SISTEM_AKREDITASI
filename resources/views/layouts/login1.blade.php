<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page - AKSIB</title>
    <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            overflow-x: hidden;
            background-color: #f0f2f5;
        }

        .container {
            position: relative;
            width: 100%;
            height: 100vh;
            overflow: hidden;
        }

        /* Background styling */
        .background {
            position: absolute;
            width: 100%;
            height: 100%;
            background-image: url('img/begron.png'); 
            background-size: cover;
            background-position: center;
            z-index: -2;
        }

        .background-image {
            position: absolute;
            bottom: 0;
            right: 0;
            width: 100%;
            height: 100%;
            background-size: cover;
            opacity: 0.3;
            z-index: -1;
        }

        /* Navbar styling */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 40px;
            background-color: #1d3557;
            color: white;
        }

        .navbar-brand-container {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .navbar-logo {
            height: 40px; 
            width: auto;
        }

        .navbar-brand {
            font-weight: 500;
            font-size: 20px;
            color: white;
            text-decoration: none;
            font-family: 'League Spartan', sans-serif;
            letter-spacing: 0.5px;
        }

        .navbar-right {
            display: flex;
            gap: 20px;
        }

        .navbar-btn {
            padding: 8px 20px;
            background-color: transparent;
            border: none;
            border-radius: 5px;
            color: white;
            cursor: pointer;
            font-size: 16px;
            font-family: 'League Spartan', sans-serif;
            text-decoration: none;
            transition: all 0.3s ease;
            position: relative;
        }

        /* Underline effect on hover */
        .navbar-btn::after {
            content: '';
            position: absolute;
            left: 50%;
            bottom: 0;
            width: 0;
            height: 2px;
            background-color: #35B1F6;
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }

        .navbar-btn:hover::after {
            width: 100%;
        }

        .navbar-btn:hover {
            color: #35B1F6;
        }

        /* Login card styling */
        .login-card {
            position: absolute;
            top: 55%;
            right: 8%;
            transform: translateY(-50%);
            width: 450px;
            background-color: rgba(255, 255, 255, 0.2);
            border-radius: 15px;
            backdrop-filter: blur(7px);
            padding: 40px;
            z-index: 1;
            color: white;
            height: auto;
            min-height: 500px; 
            display: flex;
            flex-direction: column;
            justify-content: center; 
        }

        .login-title {
            color: white;
            font-size: 28px;
            text-align: left;
            margin-top: 0;
            margin-bottom: 30px; 
            font-weight: 700;
            font-family: 'League Spartan', sans-serif;
            letter-spacing: 1px;
            position: relative;
            padding-bottom: 15px;
        }

        .login-title::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 100px;
            height: 1px;
            background-color: #ffffff;
        }

        .login-subtitle {
            font-size: 16px;
            color: white;
            text-align: left;
            margin-bottom: 40px; 
            line-height: 1.5;
        }

        .form-group {
            margin-bottom: 30px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            color: white;
            font-size: 16px;
        }

        .form-control {
            width: 100%;
            padding: 15px;
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
            background-color: rgba(255, 255, 255, 0.15);
            color: white;
            height: 50px;
        }

        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }

        .login-button {
            width: 100%;
            padding: 15px;
            background-color: #35B1F6;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            margin-top: 30px;
            text-transform: uppercase;
            height: 50px;
            transition: all 0.3s ease;
        }

        .login-button:hover {
            background-color: #2a8dc7;
            box-shadow: 0 4px 12px rgba(53, 177, 246, 0.3);
            transform: translateY(-2px);
        }

        .login-button:active {
            transform: translateY(0);
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="background"></div>
        <div class="background-image"></div>

        <!-- Navbar with logo -->
        <div class="navbar">
            <div class="navbar-brand-container">
                <!-- Tambahkan logo di sini -->
                <img src="img/logo.png" alt="Logo AKSIB" class="navbar-logo">
                <a href="#" class="navbar-brand">Akreditasi D4 Sistem Informasi Bisnis</a>
            </div>
            <div class="navbar-right">
                <a href="#" class="navbar-btn">
                    <i class="fas fa-home"></i>
                    Beranda
                </a>
                <a href="#" class="navbar-btn">
                    <i class="fas fa-sign-in-alt"></i>
                    Login
                </a>
            </div>
        </div>

        <!-- Login card -->
        <div class="login-card">
            <h2 class="login-title">Login</h2>
            <p class="login-subtitle">
                Selamat datang di Website AKSIB.<br>
                Silahkan masukkan akun Anda.
            </p>
    
            <form id="login-form" method="POST" action="{{ route('login.post') }}">
                @csrf
    
                <div class="form-group">
                    <label class="form-label" for="username">Username</label>
                    <input
                        id="username"
                        name="username"
                        type="text"
                        class="form-control @error('username') is-invalid @enderror"
                        value="{{ old('username') }}"
                        placeholder="Masukkan username Anda"
                        required
                    >
                    @error('username')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
    
                <div class="form-group">
                    <label class="form-label" for="password">Password</label>
                    <input
                        id="password"
                        name="password"
                        type="password"
                        class="form-control @error('password') is-invalid @enderror"
                        placeholder="Masukkan password Anda"
                        required
                    >
                    @error('password')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
    
                <button type="submit" class="login-button">LOGIN</button>
            </form>
        </div>
    
        <!-- (Opsional) jika mau AJAX, tambahkan script di bawah ini -->
        <script>
        document.querySelector('#login-form').addEventListener('submit', function(e){
            e.preventDefault();
            const form = e.target;
            const data = new FormData(form);
    
            fetch(form.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': data.get('_token'),
                    'Accept': 'application/json'
                },
                body: data
            })
            .then(res => res.json())
            .then(json => {
                if (json.status) {
                    window.location = json.redirect;
                } else {
                    alert(json.message);
                }
            })
            .catch(err => console.error(err));
        });
        </script>
    </body>
    </html>