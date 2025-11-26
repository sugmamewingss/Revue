<?php

?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Revue – Sign Up</title>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&family=Poppins:wght@400;700&display=swap" rel="stylesheet">

<style>
    *, *::before, *::after { box-sizing: border-box; }

    body {
        margin: 0;
        background: #1E1E1E;
        color: #D9D9D9;
        font-family: "Inter", sans-serif;
        overflow-x: hidden;
    }

    .wrapper {
        max-width: 1920px;
        margin: 0 auto;
        position: relative;
        min-height: 80vh;
    }

    /* GRADIENT */
    .bg-gradient {
        position: absolute;
        width: 2000px;
        height: 1600px;
        left: 10%;
        top: -900px;
        background: linear-gradient(171.72deg, #571313 6.61%, #1E1E1E 76.19%);
        transform: rotate(27.55deg);
        z-index: 1;
    }

    /* LOGO */
    .logo {
        position: absolute;
        margin-left: 39%;
        margin-top: 2.9rem;
        width: 350px;
        height: 150px;
        background-image:url("{{ asset('assets/revuekecil.png') }}");
        background-size: contain;
        background-repeat: no-repeat;
        z-index: 5;
    }

    /* TITLE */
    .title {
        position: absolute;
        top: 160px;
        left: 50%;
        transform: translateX(-50%);
        font-size: 32px;
        font-weight: 700;
        z-index: 5;
    }
    .subtitle {
        position: absolute;
        top: 205px;
        left: 50%;
        transform: translateX(-50%);
        font-size: 16px;
        font-weight: 400;
        z-index: 5;
    }

    /* FORM CARD */
    .form-box {
        position: absolute;
        width: 390px;
        height: 460px;
        background: #313032;
        border-radius: 13px;
        top: 245px;
        left: 50.5%;
        transform: translateX(-50%);
        padding: 35px 30px;
        z-index: 5;
    }

    label {
        font-size: 14px;
        margin-top: -15px;
        margin-bottom: -6px;
        display: block;
    }

    .input {
        width: 100%;
        height: 40px;
        background: #313032;
        border: 1px solid #5E5E5E;
        border-radius: 8px;
        margin-bottom: 30px;
        margin-top: 15px;
        padding: 0 12px;
        color: #D9D9D9;
        font-size: 15px;
    }

    .note {
        margin-top: -20px;
        margin-bottom: 28px;
        font-size: 10px;
        color: #A1A1A1;
    }

    .btn {
        width: 100%;
        height: 46px;
        border-radius: 10px;
        background: #9F0202;
        color: #D9D9D9;
        font-weight: 700;
        font-size: 20px;
        cursor: pointer;
        margin-top: -10px;
    }
    .btn:hover {
        background: #7c0000;
    }

    .login-link-box {
        text-align: center;
        margin-top: 14px;
        margin-bottom: -10px;
        font-size: 14px;
    }
    .login-link-box a {
        font-weight: 700;
        color: #D9D9D9;
        text-decoration: none;
    }
    .login-link-box a:hover {
        color: #9F0202;
    }

    .footer-section {
            position: absolute;
            top: 1000px; /* Posisi footer dimulai dari sini */
            width: 100%;
            height: 232px;
            z-index: 20;
        }

        /* Line 1 (Garis pemisah) */
        .footer-line {
            width: 100%; /* Disesuaikan agar penuh */
            height: 0;
            border-top: 1px solid #655C5C;
            position: absolute;
            left: 0;
            top: 0;
        }
        
        /* Konten Footer Bawah */
        .footer-content {
            padding-top: 25px; /* Spasi dari garis */
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            padding-left: 53px;
            padding-right: 50px;
        }

        .footer-left {
            display: flex;
            flex-direction: column;
            width: 350px;
        }
        
        .footer-logo {
            background-image: url('css/img/revuekecil.png'); 
            width: 9rem;
            height: 3rem;
            margin-top: -0.8rem;
            margin-bottom: 0.2rem;
            background-size: contain; 
            background-repeat: no-repeat;
            background-position: center;
        }

        .footer-description {
            font-weight: 400;
            font-size: 14px;
            line-height: 18px;
            margin-bottom: 2rem;
            margin-top: 0.2rem;
            width: 276px;
        }
        
        .footer-right {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            font-size: 18px;
            line-height: 28px;
            padding: -20px 0px 30px 53px;
            
        }
        
        .follow-us-title {
            font-weight: 700;
            margin-bottom: 15px;
            margin-top: -0.5rem;
        }
        
        .social-link {
            color: #FFFFFF;
            text-decoration: none;
            margin-bottom: 3px;
            transition: color 0.2s;
        }

        .social-link:hover {
            color: #C10D0D;
        }
        
        .footer-line2{
            width: 100%; /* Disesuaikan agar penuh */
            height: 0;
            border-top: 1px solid #655C5C;
            position: absolute;
            left: 0;
            bottom: 3.2rem;
            
        }

        .tulisan{
            position: absolute;
            bottom: -1.2rem;
            right : 0;
            left: 0;
            width: 100%;
            display: flex;
            justify-content: space-between;
            padding: 0 50px 10px 53px;
            font-family: 'Poppins', sans-serif;
            font-weight: 400;
            font-size: 20px;
        }
        .footer-bottom {
            position: absolute;
            bottom: 0;
            width: 100%;
            display: flex;
            justify-content: space-between;
            padding: 0 50px 5px 53px;
            font-family: 'Poppins', sans-serif;
            font-weight: 400;
            font-size: 13px;
        }
</style>
</head>
<body>

<div class="wrapper">

    <div class="bg-gradient"></div>

    <div class="logo"></div>

    <div class="title">Create Account</div>
    <div class="subtitle">Join our community of reviewers</div>

<form method="POST" action="{{ route('register') }}"> @csrf
    <div class="form-box">

        <label>Username</label>
        <input type="text" name="username" class="input" required>

        <label>Email</label>
        <input type="email" name="email" class="input" required>

        <label>Password</label>
        <input type="password" name="password" class="input" required>
        <p class="note">Minimum 8 characters</p>

        <label>Confirm Password</label>
        <input type="password" name="password_confirmation" class="input" required>

        <button type="submit" class="btn">Create Account</button>

        <div class="login-link-box">
            Already have an account?
                <a href="{{ route('login') }}">Login here</a>
        </div>
    </div>
</form>

    <footer class="footer-section">
                <div class="footer-line"></div>
                <div class="footer-content">
                    <div class="footer-left">SZS
                        <div class="footer-logo"></div>
                        <p class="footer-description">
                            Revue adalah platform review buku dan film yang memudahkan pengguna untuk menilai, menulis ulasan, dan mengatur daftar tontonan atau bacaan secara personal.
                        </p>
                    </div>
                    <div class="footer-right">
                        <p class="follow-us-title">Follow Us</p>
                        <a href="#" class="social-link">@deuphanide</a>
                        <a href="#" class="social-link">@just.alfii</a>
                        <a href="#" class="social-link">@rakapaksisp</a>
                    </div>
                </div>
                
                <div class="footer-bottom">
                    <div class="footer-line2"></div>
                    <div class="tulisan">
                    <p>Copyright © 2025 by Kelompok 7 PAW TI-A</p>
                    <p>TI'24 Fakultas Ilmu Komputer Universitas Brawijaya</p>
                    </div>
                    
                </div>
    </footer>
</body>
</html>


