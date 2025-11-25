<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genre; 
use App\Models\Item; // Pastikan Model Item sudah dibuat

class CatalogController extends Controller
{
    public function index(Request $request)
    {
        // 1. Pengambilan Data Dasar (Untuk Filter Dropdown)
        // Mengambil semua Genre
        $genres = Genre::all(); 

        // 2. Pengambilan Filter Input dari URL (Query Parameter)
        $sort = $request->query('sort');
        $genreId = $request->query('genre_id');
        $year = $request->query('year');
        
        // 3. Query Dasar Item
        // Gunakan Item::with('reviews', 'genres') untuk optimasi Eager Loading
        $itemsQuery = Item::query();

        // 4. Implementasi Logika Filter/Sorting
        
        // Filter Berdasarkan Genre (Jika genreId dipilih)
        if ($genreId) {
            $itemsQuery->whereHas('genres', function ($query) use ($genreId) {
                // Pastikan filter hanya mengambil Item dengan ID Genre ini
                $query->where('genre_id', $genreId);
            });
        }
        
        // Filter Berdasarkan Tahun (Jika year dipilih)
        if ($year) {
            $itemsQuery->where('release_year', $year);
        }

        // Sorting Logik
        if ($sort === 'title_asc') {
            $itemsQuery->orderBy('title', 'asc');
        } elseif ($sort === 'title_desc') {
            $itemsQuery->orderBy('title', 'desc');
        } elseif ($sort === 'year_desc') {
            $itemsQuery->orderBy('release_year', 'desc');
        } elseif ($sort === 'year_asc') {
            $itemsQuery->orderBy('release_year', 'asc');
        } 
        
        // 5. Pembagian Data per Kategori Homepage
        
        // New Arrival (Item terbaru, 10 item)
        // Kloning query yang sudah difilter/sort, lalu tambahkan orderBy untuk waktu dibuat
        $newArrivals = (clone $itemsQuery)->orderBy('created_at', 'desc')->limit(10)->get();

        // Books Section (Hanya Item dengan type 'book', 5 item)
        $booksSection = (clone $itemsQuery)->where('type', 'book')->limit(5)->get();

        // Movies Section (Hanya Item dengan type 'movie', 5 item)
        $moviesSection = (clone $itemsQuery)->where('type', 'movie')->limit(5)->get();

        // NOTE: Untuk '2025\'s Best', kita asumsikan item rilis 2025
        $bestOf2025 = (clone $itemsQuery)->where('release_year', date('Y') + 1)->limit(5)->get();


        // 6. Melewatkan Data ke View
        $data = [
            'genres' => $genres,
            'newArrivals' => $newArrivals,
            'booksSection' => $booksSection,
            'moviesSection' => $moviesSection,
            'bestOf2025' => $bestOf2025, // Variabel baru
            
            // Variabel terpilih untuk mempertahankan status filter di Blade
            'selectedSort' => $sort, 
            'selectedGenre' => $genreId,
            'selectedYear' => $year,
        ];

        return view('homepage', $data);
    }
}