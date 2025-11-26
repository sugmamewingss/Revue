<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REVUE - Home</title>
    <!-- ... (Semua kode CSS Anda) ... -->
    <style>
                @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;700&family=Poppins:wght@400;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #1a1a1a;
            color: #ffffff;
        }

        /* Header */
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
    background-image: url("css/img/revuekecil.png");
    background-size: contain;
    background-repeat: no-repeat;
    background-position: center;
}


        
        .logo img {
            height: 100%;
            width: auto;
        }

        nav {
            display: flex;
            gap: 40px;
            left: 6rem;
        }

        nav a {
            color: #ffffff;
            text-decoration: none;
            font-size: 16px;
            font-family: 'Poppins';
            transition: color 0.3s;
        }

        nav a:hover {
            color: #ff0000;
        }

        .search-container {
            display: flex;
            align-items: center;
            font-family: 'Poppins';
        }

        .search-box {
            background-color: #2a2a2a;
            border: 1px solid #444;
            border-radius: 5px;
            padding: 8px 15px;
            color: #ffffff;
            width: 200px;
            margin-right: 20px;
        }

        .user-icon {
            width: 40px;
            height: 40px;
            background-color: #ff0000;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        .user-icon svg {
            width: 20px;
            height: 20px;
            fill: white;
        }

        /* Filters */
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
            font-family: 'Poppins';
            gap: 15px;
        }

        .filter-group label {
            color: #ffffff;
            font-size: 14px;
        }

        .filter-group select {
            background-color: #2a2a2a;
            border: 1px solid #444;
            border-radius: 5px;
            padding: 8px 30px 8px 15px;
            color: #ffffff;
            cursor: pointer;
            min-width: 150px;
        }

        /* Content Section */
        .content {
            padding: 0 50px 50px;
        }

        .category-section {
            margin-bottom: 60px;
            position: relative;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .section-title {
            font-size: 28px;
            border-left: 4px solid #ff0000;
            padding-left: 15px;
        }

        .view-more {
            width: 50px;
            height: 50px;
            background-color: #ff0000;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: transform 0.3s;
            position: absolute;
            right: -25px;
            top: 56.5%;
            transform: translateY(-50%);
            z-index: 10;
        }

        .view-more:hover {
            transform: translateY(-50%) scale(1.1);
        }

        .view-more svg {
            width: 24px;
            height: 24px;
            fill: white;
        }

        /* Pastikan ini ada di CSS Anda */
.cards-grid {
    display: grid;
    /* Ganti repeat(5, 1fr) jika Anda ingin scrolling */
    /* Gunakan grid-auto-flow: column untuk mengatur item secara horizontal */
    grid-auto-flow: column; 
    grid-template-rows: minmax(0, 1fr); /* Membatasi tinggi ke satu baris */
    grid-template-columns: repeat(var(--card-count, 5), minmax(200px, 1fr)); /* Atur lebar minimal card */
    
    overflow-x: auto; /* Memungkinkan scrolling horizontal */
    scroll-snap-type: x mandatory; /* Membuat scroll berhenti di item tertentu */
    gap: 20px;
    padding-bottom: 20px; /* Jaga agar bayangan card tidak terpotong */
}

/* Sembunyikan scrollbar di Webkit/Chrome/Safari */
.cards-grid::-webkit-scrollbar {
    display: none;
}
.cards-grid {
    -ms-overflow-style: none;  /* IE and Edge */
    scrollbar-width: none;  /* Firefox */
}

/* Agar card menempel saat digeser */
.cards-grid .card {
    scroll-snap-align: start;
    flex-shrink: 0; /* Agar card tidak menyusut */
}

/* PERBAIKAN: Tombol View More seharusnya di luar cards-grid dan tidak position:absolute jika ada scrolling */
/* Tombol View More hanya akan menjadi LINK ke halaman utama (Books/Movies) */
.view-more {
    /* Ganti logika position: absolute jika Anda ingin tombolnya di dalam viewport normal */
    /* Jika Anda ingin tombolnya MENGGESER, Anda perlu JS */
}

        .cards-grid.two-rows {
            grid-template-rows: repeat(2, 1fr);
        }

        .card {
            background-color: #d3d3d3;
            border-radius: 10px;
            aspect-ratio: 2/3;
            cursor: pointer;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 20px rgba(255, 0, 0, 0.3);
        }
        

        /* .footer-section {
            position: absolute;
            top: 2900px;
            width: 100%;
            height: 232px;
            z-index: 20;
        } */
        .footer-section {
            position: relative;
            margin-top: auto;
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

        /* Responsive */
        @media (max-width: 1200px) {
            .cards-grid {
                grid-template-columns: repeat(4, 1fr);
            }
        }

        @media (max-width: 768px) {
            header, .filters, .content, footer {
                padding-left: 20px;
                padding-right: 20px;
            }

            .cards-grid {
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

            .view-more {
                position: static;
                transform: none;
                margin-left: auto;
            }

            .view-more:hover {
                transform: scale(1.1);
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
            <a href="{{ route('admin.genre.index') }}" class="nav-link" style="color: #4CAF50; margin-right: 20px; font-weight: bold;">
                Admin Panel
            </a>
            <a href="{{ route('admin.item.create') }}" class="nav-link" style="color: #4CAF50; margin-right: 20px;">
                + Tambah Item
            </a>
        @endif
            <input type="text" class="search-box" placeholder="Search titles, authors...">
            
            <a href="{{ url('/user/profile') }}" class="user-icon">
                <svg viewBox="0 0 24 24">
                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                </svg>
            </a>
            
        </div>
        <div class="content">
    
        
    </header>

    <!-- Container utama Content Anda (Biasanya ini adalah container yang dapat di-scroll) -->
<div class="content"> 

    <!-- DISPLAY ALERT SUKSES DARI SESSIONS -->
    @if (session('success'))
        <div style="background: #28a745; color: white; padding: 15px 50px; border-radius: 5px; margin-top: 20px; margin-bottom: 20px; margin-left: 50px; margin-right: 50px;">
            <strong>Sukses!</strong> {{ session('success') }}
        </div>
    @endif
    
    <!-- DISPLAY ALERT GAGAL DARI SESSIONS -->
    @if (session('error'))
        <div style="background: #C10D0D; color: white; padding: 15px 50px; border-radius: 5px; margin-top: 20px; margin-bottom: 20px; margin-left: 50px; margin-right: 50px;">
            <strong>GAGAL!</strong> {{ session('error') }}
        </div>
    @endif

    <!-- END ALERT SESI -->
    <!-- FORM FILTER - Menggunakan method GET -->
    <form method="GET" action="{{ route('homepage') }}">
        <div class="filters">
            
            <!-- 1. FILTER SORTING -->
            <div class="filter-group">
                <label>Sort:</label>
                <select name="sort">
                    {{-- Nilai yang dipilih dipertahankan dengan 'selected' --}}
                    <option value="">Select</option>
                    <option value="title_asc" {{ $selectedSort == 'title_asc' ? 'selected' : '' }}>Title A-Z</option>
                    <option value="title_desc" {{ $selectedSort == 'title_desc' ? 'selected' : '' }}>Title Z-A</option>
                    <option value="year_desc" {{ $selectedSort == 'year_desc' ? 'selected' : '' }}>Year (Newest)</option>
                    <option value="year_asc" {{ $selectedSort == 'year_asc' ? 'selected' : '' }}>Year (Oldest)</option>
                </select>
            </div>
            
            <!-- 2. FILTER GENRE (Dinamis dari DB) -->
            <div class="filter-group">
                <label>Genre:</label>
                <select name="genre_id"> 
                    <option value="">Select</option>
                    @isset($genres)
                        @foreach ($genres as $genre)
                            <option value="{{ $genre->id }}" {{ $selectedGenre == $genre->id ? 'selected' : '' }}>
                                {{ $genre->name }}
                            </option>
                        @endforeach
                    @endisset
                </select>
            </div>

            <!-- 3. FILTER YEAR (Dinamis Statis) -->
            <div class="filter-group">
                <label>Year:</label>
                <select name="year"> 
                    <option value="">Select</option>
                    @php
                        $currentYear = date('Y');
                        $startYear = $currentYear - 25;
                    @endphp
                    @for ($year = $currentYear; $year >= $startYear; $year--)
                        <option value="{{ $year }}" {{ $selectedYear == $year ? 'selected' : '' }}>
                            {{ $year }}
                        </option>
                    @endfor
                </select>
            </div>
            
            <button type="submit" style="display:none;">Apply Filters</button>
            
        </div> 
    </form>

    <div class="content">
        <!-- New Arrival Section -->
        <section class="category-section">
            <div class="section-header">
                <h2 class="section-title">New Arrival</h2>
            </div>
            
            <div class="cards-grid two-rows"> 
                {{-- Menggunakan data aktual yang dikirim dari Controller --}}
                @forelse ($newArrivals as $item)
                    <div class="card" title="{{ $item->title }}">
                        {{-- Placeholder image atau cover_image di sini --}}
                    </div>
                @empty
                    @for ($i = 0; $i < 10; $i++)
                        <div class="card"></div> {{-- Tampilkan placeholder jika kosong --}}
                    @endfor
                @endforelse
            </div>
        </section>

        <!-- 2025's Best Section (Dapat dikloning dari New Arrival) -->
        <section class="category-section">
            <div class="section-header">
                <h2 class="section-title">2025's Best</h2>
            </div>
            <div class="cards-grid">
                @for ($i = 0; $i < 5; $i++)
                    <div class="card"></div>
                @endfor
            </div>
            <!-- <div class="view-more">
                 <svg viewBox="0 0 24 24"><path d="M12 4l-1.41 1.41L16.17 11H4v2h12.17l-5.58 5.59L12 20l8-8z"/></svg>
            </div> -->
        </section>

         <!-- Books Section -->
        <section class="category-section">
            <div class="section-header">
                <h2 class="section-title">Books</h2>
            </div>
            <div class="cards-grid">
                @forelse ($booksSection as $item)
                    <div class="card" title="{{ $item->title }}" style="background-image: url('{{ asset('covers/' . $item->cover_image) }}');"></div>
                @empty
                    @for ($i = 0; $i < 5; $i++) <div class="card"></div> @endfor
                @endforelse
            </div>
            <!-- LINK VIEW MORE -->
            <a href="{{ url('/books') }}" class="view-more" title="Lihat Lebih Banyak Buku">
                 <svg viewBox="0 0 24 24"><path d="M12 4l-1.41 1.41L16.17 11H4v2h12.17l-5.58 5.59L12 20l8-8z"/></svg>
            </a>
        </section>

        <!-- Movies Section -->
        <section class="category-section">
            <div class="section-header">
                <h2 class="section-title">Movies</h2>
            </div>
            <div class="cards-grid">
                @forelse ($moviesSection as $item)
                    <div class="card" title="{{ $item->title }}" style="background-image: url('{{ asset('covers/' . $item->cover_image) }}');"></div>
                @empty
                    @for ($i = 0; $i < 5; $i++) <div class="card"></div> @endfor
                @endforelse
            </div>
            <!-- LINK VIEW MORE -->
            <a href="{{ url('/movies') }}" class="view-more" title="Lihat Lebih Banyak Film">
                 <svg viewBox="0 0 24 24"><path d="M12 4l-1.41 1.41L16.17 11H4v2h12.17l-5.58 5.59L12 20l8-8z"/></svg>
            </a>
        </section>
        
    </div> 

    <form action="{{ route('logout') }}" method="POST" id="logout-form" style="position:fixed; bottom: 0; left: 0; padding: 10px; background: red; z-index: 9999;">
    @csrf
    <button type="submit" style="color: white; border: none; background: none; cursor: pointer;">
        Klik Di Sini Untuk FORCE LOGOUT
    </button>
</form>

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


