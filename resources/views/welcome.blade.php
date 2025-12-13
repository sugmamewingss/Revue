<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Revue — Review Buku dan Film</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&family=Poppins:wght@400;700&display=swap" rel="stylesheet">

    <style>
        *, *::before, *::after { box-sizing: border-box; }

        body {
            margin: 0;
            background: #1E1E1E;
            color: #FFFFFF;
            font-family: 'Inter', sans-serif;
            overflow-x: hidden;
        }

        .wrapper {
            max-width: 2300px;
            margin: 0 auto;
            position: relative;
        }

        .landing-page-container {
            position: relative;
            width: 100%;
            height: 1531px;
            overflow: hidden;
        }

        .background-gradient {
            position: absolute;
            width: 4000px;
            height: 2200px;
            left: -75px;
            top: -22rem;
            background: linear-gradient(171.72deg, #571313 6.61%, #1E1E1E 76.19%);
            transform: rotate(38.76deg);
            z-index: 1;
        }

        .header {
            position: absolute;
            top: 40px;
            right: 80px;
            z-index: 20;
            display: flex;
            gap: 90px;
        }
        .nav-link {
            font-size: 30px;
            font-weight: 700;
            text-decoration: none;
            color: #FFFFFF;
            transition: color .3s;
        }
        .nav-link:hover { color: #C10D0D; }

        .main-logo-container {
            position: absolute;
            left: 7.2rem;
            top: 400px;
            width: 350px;
            height: 120px;
            z-index: 15;
        }
        .main-logo-container img {
            width: 300%;
            height: 800%;
            object-fit: fill;
            transform-origin: top left;
            margin-left: -9.56rem;
            margin-top: -28rem;
        }

        .explore-button {
            position: absolute;
            width: 260px;
            height: 82px;
            left: 7.2rem;
            top: 36rem;
            background: #C21B16;
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            text-decoration: none;
            z-index: 15;
            transition: .2s;
        }
        .explore-button:hover { background: #AA0000; transform: scale(1.05); }
        .explore-button span {
            font-size: 30px;
            font-weight: 700;
            color: #F6F6F6;
        }

        .cards-group {
            position: absolute;
            width: 2930.72px;
            height: 1609.77px;
            left: 600px;
            top: -280px;
            transform: rotate(-26.14deg);
            opacity: .85;
            z-index: 5;
            pointer-events: none;
        }
        .card {
            position: absolute;
            background-position: center;
            background-size: cover;
            border-radius: 20px;
            box-shadow: 0 4px 60px rgba(0,0,0,.4);
        }

        .card-loki         { width:450.77px;height:260.19px;left:706.97px;top:-150.05px;background-image:url("{{ asset('assets/loki.jpg') }}"); }
        .card-oppenheimer  { width:450.77px;height:260.19px;left:621.94px;top:225.88px;background-image:url("{{ asset('assets/oppenheimer.jpg') }}"); }
        .card-avengers     { width:450.77px;height:260.19px;left:1063.86px;top:9.89px;background-image:url("{{ asset('assets/rat.jpg') }}"); }
        .card-ratatouille  { width:450.77px;height:260.19px;left:1034.03px;top:350.18px;background-image:url("{{ asset('assets/avenger.jpg') }}"); }
        .card-antman       { width:450.77px;height:260.19px;left:592px;top:566px;background-image:url("{{ asset('assets/ant.jpg') }}"); }
        .card-atomic       { width:200px;height:260.19px;left:895px;top:863px;background-image:url("{{ asset('assets/atomic.jpg') }}"); }
        .card-subtle       { width:210px;height:260.19px;left:1111px;top:753.59px;background-image:url("{{ asset('assets/the.jpeg') }}"); }
        .card-red-small-left { width:82.14px;height:260.19px;left:758px;top:974px;background:#C10D0D; }
        .card-red-small-top  { width:170.81px;height:260.19px;left:520px;top:65px;background:#C10D0D; }

        .footer-section {
            position: absolute;
            top: 1299px;
            width: 100%;
            height: 232px;
            z-index: 20;
        }
        .footer-line { width:100%;border-top:1px solid #655C5C; }
        .footer-content {
            padding-top:25px;
            display:flex;
            justify-content:space-between;
            padding-left:53px;
            padding-right:50px;
        }
        .footer-left { width:350px; }
        .footer-logo {
            width:9rem;height:3rem;
            background-image:url("{{ asset('assets/revuekecil.png') }}");
            background-size:contain;
            background-repeat:no-repeat;
            background-position:center;
        }
        .footer-description {
            font-size:13px;
            line-height:18px;
            margin-top:.2rem;
            margin-bottom:2rem;
            font-family:'Poppins';
        }
        .footer-right {
            font-family:'Poppins';
            text-align:right;
        }
        .footer-right a {
            color:#FFFFFF;
            text-decoration:none;
            margin-bottom:4px;
            display:block;
        }
        .footer-right a:hover { color:#C10D0D; }
        .footer-bottom {
            font-family:'Poppins';
            font-size:13px;
            display:flex;
            justify-content:space-between;
            padding:0 50px;
            margin-top:30px;
        }
    </style>
</head>
<body>

<div class="wrapper">
    <div class="landing-page-container">
        <div class="background-gradient"></div>

        <header class="header">
        <a href="{{ route('register') }}" class="nav-link">Sign Up</a> 
        <a href="{{ route('login') }}" class="nav-link">Log In</a>
        </header>

        <div class="main-logo-container">
            <img src="{{ asset('assets/LOGO-REVUE.png') }}" alt="Revue Logo">
        </div>

        <a href="{{ route('register') }}" class="explore-button">
            <span>Explore More</span>
        </a>

        <div class="cards-group">
            <div class="card card-red-small-top"></div>
            <div class="card card-red-small-left"></div>
            <div class="card card-loki"></div>
            <div class="card card-oppenheimer"></div>
            <div class="card card-avengers"></div>
            <div class="card card-ratatouille"></div>
            <div class="card card-antman"></div>
            <div class="card card-atomic"></div>
            <div class="card card-subtle"></div>
        </div>

        <footer class="footer-section">
            <div class="footer-line"></div>
            <div class="footer-content">
                <div class="footer-left">
                    <div class="footer-logo"></div>
                    <p class="footer-description">
                        Revue adalah platform review buku dan film yang memudahkan pengguna untuk menilai, menulis ulasan, dan mengatur daftar tontonan atau bacaan secara personal.
                    </p>
                </div>
                <div class="footer-right">
                    <p class="follow-us-title">Follow Us</p>
                    <a href="https://instagram.com/deuphanide" class="social-link" target="_blank">@deuphanide</a>
                    <a href="https://instagram.com/just.alfii" class="social-link" target="_blank">@just.alfii</a>
                    <a href="https://instagram.com/rakapaksisp" class="social-link" target="_blank">@rakapaksisp</a>
                </div>
            </div>
            <div class="footer-bottom">
                <p>Copyright © 2025 by Kelompok 7 PAW TI-A</p>
                <p>Fakultas Ilmu Komputer Universitas Brawijaya</p>
            </div>
        </footer>
    </div>
</div>

</body>
</html>