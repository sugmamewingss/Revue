<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genre; 
use App\Models\Item; // Import Model Item

class MovieController extends Controller
{
    /**
     * Menampilkan semua item dengan type 'movie' dengan filter dan sorting.
     */
    public function index(Request $request)
    {
        // 1. Pengambilan Data Dasar (Untuk Filter Dropdown)
        $genres = Genre::all(); 

        // 2. Pengambilan Filter Input dari request
        $sort = $request->query('sort');
        $genreId = $request->query('genre_id');
        $year = $request->query('year');
        $search = $request->query('search');

        // 3. Query Dasar: Hanya ambil item bertipe 'movie'
        $itemsQuery = Item::query()->where('type', 'movie');

        // --- 4. Implementasi Filter ---
        
        if ($genreId) {
            $itemsQuery->whereHas('genres', function ($query) use ($genreId) {
                $query->where('genre_id', $genreId);
            });
        }
        
        if ($year) {
            $itemsQuery->where('release_year', $year);
        }

        if ($search) {
            $itemsQuery->where('title', 'like', '%' . $search . '%')
                       ->orWhere('author_or_director', 'like', '%' . $search . '%');
        }


        // --- 5. Implementasi Sorting ---
        
        if ($sort === 'title_asc') {
            $itemsQuery->orderBy('title', 'asc');
        } elseif ($sort === 'title_desc') {
            $itemsQuery->orderBy('title', 'desc');
        } elseif ($sort === 'year_desc') {
            $itemsQuery->orderBy('release_year', 'desc');
        } elseif ($sort === 'year_asc') {
            $itemsQuery->orderBy('release_year', 'asc');
        } else {
             // Default sorting: Tahun terbaru
             $itemsQuery->orderBy('release_year', 'desc');
        }
        
        // Ambil semua hasil
        $allMovies = $itemsQuery->get(); 

        // 6. Melewatkan data ke View
        $data = [
            'genres' => $genres,
            'allBooks' => $allMovies, // WARNING: Menggunakan nama variabel allBooks
                                       // untuk konsistensi view, TAPI isinya adalah Movie
            
            // Variabel terpilih untuk mempertahankan status filter di Blade
            'selectedSort' => $sort, 
            'selectedGenre' => $genreId,
            'selectedYear' => $year,
            'selectedSearch' => $search,
        ];

        return view('movies', $data); // Render view movies.blade.php
    }
}