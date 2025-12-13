<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REVUE - Movie Catalog</title>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;700&family=Poppins:wght@400;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #1a1a1a;
            color: white;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 50px;
            background-color: #0d0d0d;
            border-bottom: 1px solid #333;
        }

        .logo {
            width: 180px;
            height: 60px;
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center;
        }

        nav {
            display: flex;
            gap: 40px;
        }

        nav a {
            color: white;
            text-decoration: none;
            font-size: 16px;
            transition: color 0.3s;
        }

        nav a:hover {
            color: red;
        }

        .search-container {
            display: flex;
            align-items: center;
        }

        .search-box {
            background-color: #2a2a2a;
            border: 1px solid #444;
            border-radius: 5px;
            padding: 8px 15px;
            color: white;
            width: 200px;
            margin-right: 20px;
        }

        .user-icon {
            width: 40px;
            height: 40px;
            background-color: red;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .user-icon svg {
            width: 20px;
            height: 20px;
            fill: white;
        }

        .filters {
            display: flex;
            gap: 30px;
            padding: 30px 50px;
            background-color: #0d0d0d;
            margin: 20px 50px;
            border-radius: 10px;
            border: 1px solid #333;
        }

        .filter-group {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .filter-group select {
            background-color: #2a2a2a;
            border: 1px solid #444;
            border-radius: 5px;
            padding: 8px 15px;
            color: white;
        }
        
        .clear-filter-btn {
    background-color: transparent;
    border: 1px solid #ff0000;
    color: #ff0000;
    padding: 8px 18px;
    border-radius: 20px;
    cursor: pointer;
    font-size: 14px;
    transition: all 0.3s ease;
}

.clear-filter-btn:hover {
    background-color: #ff0000;
    color: white;
}

        .movie-section {
            padding: 0 50px 50px;
        }

        .section-title {
            font-size: 28px;
            margin-bottom: 30px;
            border-left: 4px solid red;
            padding-left: 15px;
        }

        .movie-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 20px;
        }

        .movie-card {
            border-radius: 10px;
            aspect-ratio: 2 / 3;
            cursor: pointer;
            background-size: cover;
            background-position: center;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .movie-card:hover {
            transform: translateY(-5px);
            box-shadow: 0px 8px 25px rgba(255, 0, 0, 0.25);
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

        @media (max-width: 1200px) {
            .books-grid {
                grid-template-columns: repeat(4, 1fr);
            }
        }

        @media (max-width: 768px) {
            header, .filters, .books-section, footer {
                padding-left: 20px;
                padding-right: 20px;
            }

            .books-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            nav {
                gap: 20px;
            }

            .filters {
                flex-direction: column;
                gap: 15px;
                margin: 20px;
            }

            .footer-content {
                flex-direction: column;
                gap: 30px;
            }
        }

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

    @if (Auth::check() && Auth::user()->role === 'admin')
        <a href="{{ route('admin.genre.index') }}" class="nav-link" style="color:#4CAF50; margin-right:20px;">
            Admin Panel
        </a>
        <a href="{{ route('admin.item.create') }}" class="nav-link" style="color:#4CAF50; margin-right:20px;">
            + Tambah Item
        </a>
    @endif

    <form method="GET" action="{{ url()->current() }}">
        <input
            type="text"
            name="search"
            class="search-box"
            placeholder="Search..."
            value="{{ request('search') }}"
        >
    </form>

    <a href="{{ url('/user/profile') }}" class="user-icon">
                <svg viewBox="0 0 24 24">
                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                </svg>
            </a>

</div>
  
    </header>

    <form method="GET" action="{{ url('/movies') }}">
        <input type="hidden" name="search" value="{{ request('search') }}">

        <div class="filters">

            <div class="filter-group">
                <label>Sort:</label>
                    <select name="sort" onchange="this.form.submit()">
                    <option value="">Select</option>
                    <option value="title_asc" {{ $selectedSort == 'title_asc' ? 'selected' : '' }}>Title A-Z</option>
                    <option value="title_desc" {{ $selectedSort == 'title_desc' ? 'selected' : '' }}>Title Z-A</option>
                    <option value="year_desc" {{ $selectedSort == 'year_desc' ? 'selected' : '' }}>Newest</option>
                    <option value="year_asc" {{ $selectedSort == 'year_asc' ? 'selected' : '' }}>Oldest</option>
                    <option value="rating_desc" {{ $selectedSort == 'rating_desc' ? 'selected' : '' }}>
                    Highest Rating
                </option>

                </select>
            </div>

            <div class="filter-group">
                <label>Genre:</label>
                <select name="genre_id" onchange="this.form.submit()">
                    <option value="">Select</option>
                    @foreach ($genres as $genre)
                        <option value="{{ $genre->id }}" {{ $selectedGenre == $genre->id ? 'selected' : '' }}>
                            {{ $genre->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="filter-group">
                <label>Year:</label>
                <select name="year" onchange="this.form.submit()">
                    <option value="">Select</option>
                    @php
                        $currentYear = date('Y');
                    @endphp
                    @for ($y = $currentYear; $y >= $currentYear - 25; $y--)
                        <option value="{{ $y }}" {{ $selectedYear == $y ? 'selected' : '' }}>{{ $y }}</option>
                    @endfor
                </select>
            </div>

        </div>
    </form>

    <section class="movie-section">
        <h1 class="section-title">Semua Film</h1>

        <div class="movie-grid">
            @forelse ($allMovies as $item)
                <a href="{{ route('item.detail', $item->id) }}" 
                    class="movie-card"
                    style="background-image: url('{{ asset('assets/covers/' . $item->cover_image) }}');">
                </a>
            @empty
                <div style="grid-column: 1/-1; text-align:center; color:#aaa; padding:40px;">
                    Tidak ada film ditemukan.
                </div>
            @endforelse
        </div>
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
