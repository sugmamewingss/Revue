<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REVUE - Home</title>
    <style>
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
            height: 40px;
        }
        
        .logo img {
            height: 100%;
            width: auto;
        }

        nav {
            display: flex;
            gap: 40px;
        }

        nav a {
            color: #ffffff;
            text-decoration: none;
            font-size: 16px;
            transition: color 0.3s;
        }

        nav a:hover {
            color: #ff0000;
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
            right: 0;
            top: 50%;
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

        .cards-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 20px;
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

        /* Footer */
        footer {
            background-color: #0d0d0d;
            padding: 20px 50px;
            margin-top: 50px;
            border-top: 1px solid #333;
        }

        .footer-content {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .footer-logo {
            height: 60px;
            margin-bottom: 10px;
        }
        
        .footer-logo img {
            height: 100%;
            width: auto;
        }

        .footer-description {
            color: #888;
            font-size: 13px;
            line-height: 1.6;
            max-width: 400px;
        }

        .footer-links {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .footer-links-title {
            color: #fff;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .footer-links a {
            color: #888;
            text-decoration: none;
            font-size: 13px;
            transition: color 0.3s;
        }

        .footer-links a:hover {
            color: #ff0000;
        }

        .footer-bottom {
            display: flex;
            justify-content: space-between;
            padding-top: 20px;
            border-top: 1px solid #333;
            font-size: 12px;
            color: #666;
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
    <!-- Header -->
    <header>
        <div class="logo">
            <img src="revuekecil.png" alt="REVUE" onerror="this.parentElement.innerHTML='<div style=\'color:#ff0000;font-size:32px;font-weight:bold;\'>REVUE</div>'">
        </div>
        <nav>
            <a href="#home">Home</a>
            <a href="#books">Books</a>
            <a href="#movie">Movie</a>
            <a href="#genre">Genre</a>
        </nav>
        <div class="search-container">
            <input type="text" class="search-box" placeholder="Search titles, authors...">
            <div class="user-icon">
                <svg viewBox="0 0 24 24">
                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                </svg>
            </div>
        </div>
    </header>

    <!-- Filters -->
    <div class="filters">
        <div class="filter-group">
            <label>Sort:</label>
            <select>
                <option>Select</option>
                <option>Title A-Z</option>
                <option>Title Z-A</option>
                <option>Year (Newest)</option>
                <option>Year (Oldest)</option>
            </select>
        </div>
        <div class="filter-group">
            <label>Genre:</label>
            <select>
                <option>Select</option>
                <option>Action</option>
                <option>Comedy</option>
                <option>Drama</option>
                <option>Horror</option>
                <option>Sci-Fi</option>
            </select>
        </div>
        <div class="filter-group">
            <label>Year:</label>
            <select>
                <option>Select</option>
                <option>2024</option>
                <option>2023</option>
                <option>2022</option>
                <option>2021</option>
                <option>2020</option>
            </select>
        </div>
    </div>

    <!-- Content -->
    <div class="content">
        <!-- New Arrival Section -->
        <section class="category-section">
            <div class="section-header">
                <h2 class="section-title">New Arrival</h2>
            </div>
            <div class="cards-grid two-rows">
                <div class="card"></div>
                <div class="card"></div>
                <div class="card"></div>
                <div class="card"></div>
                <div class="card"></div>
                <div class="card"></div>
                <div class="card"></div>
                <div class="card"></div>
                <div class="card"></div>
                <div class="card"></div>
            </div>
        </section>

        <!-- 2025's Best Section -->
        <section class="category-section">
            <div class="section-header">
                <h2 class="section-title">2025's Best</h2>
            </div>
            <div class="cards-grid">
                <div class="card"></div>
                <div class="card"></div>
                <div class="card"></div>
                <div class="card"></div>
                <div class="card"></div>
            </div>
            <div class="view-more">
                <svg viewBox="0 0 24 24">
                    <path d="M12 4l-1.41 1.41L16.17 11H4v2h12.17l-5.58 5.59L12 20l8-8z"/>
                </svg>
            </div>
        </section>

        <!-- Books Section -->
        <section class="category-section">
            <div class="section-header">
                <h2 class="section-title">Books</h2>
            </div>
            <div class="cards-grid">
                <div class="card"></div>
                <div class="card"></div>
                <div class="card"></div>
                <div class="card"></div>
                <div class="card"></div>
            </div>
            <div class="view-more">
                <svg viewBox="0 0 24 24">
                    <path d="M12 4l-1.41 1.41L16.17 11H4v2h12.17l-5.58 5.59L12 20l8-8z"/>
                </svg>
            </div>
        </section>

        <!-- Movies Section -->
        <section class="category-section">
            <div class="section-header">
                <h2 class="section-title">Movies</h2>
            </div>
            <div class="cards-grid">
                <div class="card"></div>
                <div class="card"></div>
                <div class="card"></div>
                <div class="card"></div>
                <div class="card"></div>
            </div>
            <div class="view-more">
                <svg viewBox="0 0 24 24">
                    <path d="M12 4l-1.41 1.41L16.17 11H4v2h12.17l-5.58 5.59L12 20l8-8z"/>
                </svg>
            </div>
        </section>
    </div>

    <!-- Footer -->
    <footer>
        <div class="footer-content">
            <div>
                <div class="footer-logo">
                    <img src="revuekecil.png" alt="REVUE" onerror="this.parentElement.innerHTML='<div style=\'color:#ff0000;font-size:28px;font-weight:bold;\'>REVUE</div>'">
                </div>
                <p class="footer-description">
                    Revue adalah platform review buku dan film yang memudahkan pengguna untuk menulis, membaca ulasan, dan mengatasi daftar tontonan atau bacaan secara personal.
                </p>
            </div>
            <div class="footer-links">
                <div class="footer-links-title">Follow Us</div>
                <a href="#">@dusjufandse</a>
                <a href="#">@justalffi</a>
                <a href="#">@rakapakpip</a>
            </div>
        </div>
        <div class="footer-bottom">
            <span>Copyright © 2025 by Kelompok 7 PAW TI-A</span>
            <span>11724 Fakultas Ilmu Komputer Universitas Brawijaya</span>
        </div>
    </footer>
</body>
</html>