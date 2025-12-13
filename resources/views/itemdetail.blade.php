{{-- resources/views/item-detail.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REVUE - {{ $item->title }}</title>

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

        /* FILTERS & GENRE SPECIFIC */

        /* Filters (Hanya tampilan, tidak dipakai untuk detail item) */
        .filters {
            display: flex; gap: 30px;
            padding: 30px 50px; background-color: #0d0d0d;
            margin: 20px 50px; border-radius: 10px;
            border: 1px solid #444;
        }

        .filter-group { display: flex; align-items: center; gap: 15px; }
        .filter-group select {
            background-color: #2a2a2a;
            border: 1px solid #444;
            border-radius: 5px;
            padding: 8px 30px 8px 15px;
            color: #ffffff; cursor: pointer;
            min-width: 150px;
        }

        /* Content */
        .content { padding: 0 50px 50px; }

        .movie-detail { margin-bottom: 50px; }
        .section-title {
            font-size: 28px; margin-bottom: 30px;
            border-left: 4px solid #ff0000; padding-left: 15px;
            margin-top: 2.5rem;
        }

        .detail-container {
            display: grid;
            grid-template-columns: 280px 1fr;
            gap: 30px; margin-bottom: 30px;
        }

        .poster {
            background-color: #d3d3d3;
            border-radius: 10px;
            aspect-ratio: 2/3;
            width: 100%;
            background-size: cover;
            background-position: center;
        }

        .info-section { display: flex; flex-direction: column; gap: 20px; }

        .movie-title {
            font-size: 36px; font-weight: bold; margin-bottom: 10px;
        }

        .info-box {
            background-color: #131212ff; border-radius: 10px;
            padding: 20px; height: 60px; color: #ccc;
            display: flex; align-items: center; gap: 10px;
            font-size: 16px;
        }

        .synopsis-box {
            background-color: #131212ff;
            border-radius: 10px; padding: 30px;
            min-height: 200px; color: #ccc;
        }

        /* Reviews */
        .reviews-section { margin-bottom: 30px; }

        .reviews-box {
            background-color: #131212ff;
            border-radius: 10px;
            padding: 40px;
            min-height: 300px;
            margin-bottom: 20px;
            color: #ccc;
        }

        .add-review {
            display: flex; gap: 15px; align-items: center;
            margin-bottom: 20px;
        }

        .review-input {
            flex: 1; background-color: #1a1a1a;
            border: 1px solid #555; border-radius: 8px;
            padding: 15px 20px; color: #ccc; font-size: 14px;
        }

        .submit-button {
            background-color: #cc0000; color: white;
            border: none; border-radius: 8px;
            padding: 15px 40px; font-size: 14px;
            font-weight: bold; cursor: pointer;
        }
        .submit-button:hover { background-color: #ff0000; }

        /* ⭐ STAR RATING */
        .star-rating {
    direction: rtl;
    display: flex;
    gap: 10px;
}

.star-rating input {
    display: none;
}

.star-rating label {
    font-size: 35px;
    color: #555;
    cursor: pointer;
    transition: color 0.2s;
}

.star-rating input:checked ~ label {
    color: gold;
}

.star-rating label:hover,
.star-rating label:hover ~ label {
    color: gold;
}


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

        
        /* Tambahkan CSS responsive dari template Anda di sini */
        @media (max-width: 1200px) { .genre-grid { grid-template-columns: repeat(3, 1fr); } }
        @media (max-width: 768px) { .genre-grid { grid-template-columns: repeat(2, 1fr); } }
    </style>
</head>

<body>

<!-- HEADER -->
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


<!-- CONTENT -->
<div class="content">

    <!-- DETAIL ITEM -->
    <section class="movie-detail">
        <h2 class="section-title">{{ $item->title }}</h2>

        <div class="detail-container">
            <div class="poster"
                style="background-image: url('{{ asset('assets/covers/' . $item->cover_image) }}')">
            </div>

            <div class="info-section">

    <h1 class="movie-title">{{ $item->title }}</h1>

    <div class="info-box">
        ⭐ <strong>{{ number_format($item->rating, 1) }}</strong> / 5
    </div>

    <div class="synopsis-box">
        {!! nl2br(e($item->description ?? 'No description available.')) !!}
    </div>

    {{-- SAVE TO MY LIST --}}
    @php
        use Illuminate\Support\Facades\Auth;
        $saved = Auth::check()
        ? \App\Models\UserList::where('user_id', Auth::id())
        ->where('item_id', $item->id)
        ->exists()
        : false;
    @endphp

@auth
<form action="{{ route('userlist.toggle') }}" method="POST" style="margin-top:20px;">
    @csrf
    <input type="hidden" name="item_id" value="{{ $item->id }}">

    <button type="submit"
        style="
            background: {{ $saved ? '#555' : '#C10D0D' }};
            color: white;
            padding: 10px 18px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        ">
        {{ $saved ? '✓ Saved in My List' : '+ Save to My List' }}
    </button>
</form>
@endauth

</div>

            
        </div>

        
    </section>

    <!-- ⭐ RATING -->
    <section class="reviews-section">
    <h2 class="section-title">Give Your Review</h2>

    <form action="{{ route('item.review', $item->id) }}" method="POST" class="add-review">
        @csrf

        <!-- ⭐ STAR RATING -->
        <div class="star-rating">
            @for ($i = 5; $i >= 1; $i--)
                <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}">
                <label for="star{{ $i }}">★</label>
            @endfor
        </div>

        <!-- 📝 REVIEW TEXT -->
        <textarea name="review_text" class="review-input" placeholder="Tambahkan ulasan Anda (opsional)..."></textarea>

        <button class="submit-button">Submit</button>
    </form>

    <!-- DAFTAR REVIEW -->
    <div class="reviews-box">
        @forelse ($item->reviews as $review)
            <div style="margin-bottom: 20px; color:#ccc;">
                <strong>{{ $review->user->name }}</strong> — 
                <span>{{ str_repeat('★', $review->rating) }}</span>
                <p>{{ $review->review_text }}</p>
            </div>
        @empty
            <p style="color:#333;">Belum ada review.</p>
        @endforelse
    </div>
</section>

</div>

<!-- FOOTER -->
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
