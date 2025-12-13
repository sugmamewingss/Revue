<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REVUE - My Profile</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;700&family=Poppins:wght@400;700&display=swap');

        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background-color: #1a1a1a; color: #ffffff; }

        header { display: flex; justify-content: space-between; align-items: center; padding: 20px 50px; background-color: #0d0d0d; border-bottom: 1px solid #333; }
        .logo { width: 180px; height: 60px; background-size: contain; background-repeat: no-repeat; background-position: center; }
        nav { display: flex; gap: 40px; }
        nav a { color: #ffffff; text-decoration: none; font-size: 16px; font-family: 'Poppins'; transition: color 0.3s; }
        nav a:hover { color: #ff0000; }
        .search-container { display: flex; align-items: center; }
        .search-box { background-color: #2a2a2a; border: 1px solid #444; border-radius: 5px; padding: 8px 15px; color: #ffffff; width: 200px; margin-right: 20px; }
        .user-icon { width: 40px; height: 40px; background-color: #ff0000; border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer; }
        .user-icon svg { width: 20px; height: 20px; fill: white; }
        .logout-btn { border: none; background: none; cursor: pointer; color: #ffffff; font-size: 16px; font-family: 'Poppins'; text-decoration: none; transition: color 0.3s; padding: 0; }
        .logout-btn:hover { color: #ff0000; }

        .profile-section {
            padding: 50px;
        }

        .section-title {
            font-size: 28px;
            margin-bottom: 30px;
            border-left: 4px solid #ff0000;
            padding-left: 15px;
        }

        .profile-content {
            display: flex;
            gap: 50px;
            align-items: flex-start;
        }

        .profile-image {
    width: 220px;
    height: 220px;
    border-radius: 10px;

    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;

    border: 2px solid #444;
}


        .profile-form {
            flex: 1;
            max-width: 700px;
        }

        .form-group {
            margin-bottom: 30px;
        }

        .form-group label {
            display: block;
            font-size: 24px;
            margin-bottom: 10px;
            font-weight: 500;
        }

        .form-group input {
            width: 80%;
            background-color: #d3d3d3;
            border: none;
            border-radius: 10px;
            padding: 15px 20px;
            font-size: 16px;
            color: #333;
            pointer-events: none;
            cursor: default;
        }

        .list-section {
            padding: 50px;
        }

        .list-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .list-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }

        .list-card {
    position: relative;
    background-color: #1a1a1a;
    border-radius: 10px;
    overflow: hidden;
    cursor: pointer;
    aspect-ratio: 2 / 3;
    transition: transform 0.3s, box-shadow 0.3s;
}

       .list-card img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}

        .list-card p {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;

    padding: 10px;
    margin: 0;

    font-size: 14px;
    color: #fff;

    background: linear-gradient(
        to top,
        rgba(0, 0, 0, 0.85),
        rgba(0, 0, 0, 0)
    );

    pointer-events: none;
}

        .list-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 20px rgba(255, 0, 0, 0.3);
        }

        .view-all-btn {
            display: flex;
            align-items: center;
            gap: 10px;
            background-color: #ff0000;
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 25px;
            font-size: 16px;
            cursor: pointer;
            margin-left: auto;
            transition: background-color 0.3s;
        }

        .view-all-btn:hover {
            background-color: #cc0000;
        }

        .view-all-btn svg {
            width: 20px;
            height: 20px;
            fill: white;
        }

        

        .footer-section {
            position: relative;
            margin-top: auto;
            width: 100%;
            height: 232px;
            z-index: 20;
        }

        .footer-line {
            width: 100%;
            height: 0;
            border-top: 1px solid #655C5C;
            position: absolute;
            left: 0;
            top: 0;
        }
        
        .footer-content {
            padding-top: 25px;
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
            width: 100%;
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

        @media (max-width: 1200px) { .genre-grid { grid-template-columns: repeat(3, 1fr); } }
        @media (max-width: 768px) { .genre-grid { grid-template-columns: repeat(2, 1fr); } }
    
    </style>
</head>
<body>
    
    <header>
        <div class="logo" style="background-image: url('{{ asset('assets/revuekecil.png') }}')"></div> 
        
        <nav>
            <a href="{{ route('homepage') }}" class="nav-link">Home</a>
            <a href="{{ url('/books') }}" class="nav-link">Books</a> 
            <a href="{{ url('/movies') }}" class="nav-link">Movie</a>
            <a href="{{ url('/genre') }}" class="nav-link">Genre</a>
        </nav>
        
        <div class="search-container">
            <input type="text" class="search-box" placeholder="Search titles, authors...">
            
            <a href="{{ url('/user/profile') }}" class="user-icon">
                <svg viewBox="0 0 24 24">
                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                </svg>
            </a>
            
            
        </div>
    </header>
    

    <section class="profile-section">
        <h2 class="section-title">My Profile</h2>
        <div class="profile-content">
            <div class="profile-image"
     style="background-image: url('{{ asset('assets/pp.jpg') }}');">
</div>

            <div class="profile-form">
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" value="{{ $user->name }}" readonly>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" value="{{ $user->email }}" readonly>
                </div>
            </div>
        </div>
    </section>

    <section class="list-section">
    <div class="list-header">
        <h2 class="section-title">My List</h2>
    </div>

    <div class="list-grid">
        @forelse($myListPreview as $item)
            <div class="list-card"
                 onclick="location.href='{{ route('item.detail', $item->id) }}'"
                 style="cursor:pointer;">
                 
                <img src="{{ asset('assets/covers/' . $item->cover_image) }}"
                     alt="{{ $item->title }}">

                <p>{{ $item->title }}</p>
            </div>
        @empty
            <p style="color:#aaa;">Belum ada item di My List.</p>
        @endforelse
    </div>

    @if($myListPreview->count() > 0)
        <button class="view-all-btn"
            onclick="location.href='{{ route('user.mylist') }}'">
            View All
        </button>
    @endif
</section>

    <footer class="footer-section">
                <div class="footer-line"></div>
                <div class="footer-content">
                    <div class="footer-left">
                <div class="footer-logo" style="background-image: url('{{ asset('assets/revuekecil.png') }}');"></div>
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
                    <div class="footer-line2"></div>
                    <div class="tulisan">
                    <p>Copyright © 2025 by Kelompok 7 PAW TI-A</p>
                    <p>TI'24 Fakultas Ilmu Komputer Universitas Brawijaya</p>
                    </div>
                    
                </div>
    </footer>
</body>
</html>