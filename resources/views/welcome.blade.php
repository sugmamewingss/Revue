<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REVUE | Portal Ulasan Buku & Film</title>
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@700&family=Poppins:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="landing-page">
        <!-- Gradient Background -->
        <div class="gradient-bg"></div>

        <!-- Auth Buttons -->
        <div class="auth-buttons">
            <a href="{{ route('register') }}" class="signup-btn">Sign Up</a>
            <a href="{{ route('login') }}" class="login-btn">Log in</a>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Logo Besar -->
            <img src="{{ asset('images/LOGO_REVUE.png') }}" alt="Revue Logo" class="logo-main">

            <!-- Explore Button -->
            <a href="{{ route('items.index') }}" class="explore-btn">
                <span>Explore More</span>
            </a>
        </div>

        <!-- Card Group Images -->
        <div class="card-group">
            <!-- Row 1 - Top -->
            <div class="card card-top-1" style="background-image: url('{{ asset('images/pirate.jpg') }}');"></div>
            <div class="card card-top-2 red-accent"></div>
            <div class="card card-top-3" style="background-image: url('{{ asset('images/oppenheimer.jpg') }}');"></div>
            <div class="card card-top-4" style="background-image: url('{{ asset('images/loki.jpg') }}');"></div>
            <div class="card card-top-5 red-accent"></div>
            
            <!-- Row 2 - Middle -->
            <div class="card card-mid-1 red-accent"></div>
            <div class="card card-mid-2" style="background-image: url('{{ asset('images/ant.jpg') }}');"></div>
            <div class="card card-mid-3" style="background-image: url('{{ asset('images/the.jpg') }}');"></div>
            
            <!-- Row 3 - Bottom -->
            <div class="card card-bot-1 red-accent"></div>
            <div class="card card-bot-2" style="background-image: url('{{ asset('images/avenger.jpg') }}');"></div>
            <div class="card card-bot-3" style="background-image: url('{{ asset('images/atomic.jpg') }}');"></div>
            <div class="card card-bot-4" style="background-image: url('{{ asset('images/rat.jpg') }}');"></div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-content">
            <div class="footer-left">
                <img src="{{ asset('images/LOGO_REVUE.png') }}" alt="Revue Logo" class="logo-footer">
                <p class="footer-desc">Revue adalah platform review buku dan film yang memudahkan pengguna untuk menilai, menulis ulasan, dan mengatur daftar tontonan atau bacaan secara personal.</p>
            </div>

            <div class="footer-right">
                <p class="follow-title">Follow Us</p>
                <p class="social-handle">@deuphanide</p>
                <p class="social-handle">@just.alfii</p>
                <p class="social-handle">@rakapaksisp</p>
            </div>
        </div>

        <div class="footer-bottom">
            <p class="copyright">Copyright © 2025 by Kelompok 7 PAW TI-A</p>
            <p class="university">Fakultas Ilmu Komputer Universitas Brawijaya</p>
        </div>
    </footer>
</body>
</html>