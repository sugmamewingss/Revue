<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genre; 
use App\Models\Item; 

class BookController extends Controller
{
    /**
     * Menampilkan semua item dengan type 'book' dengan filter dan sorting.
     */
    public function index(Request $request)
    {
        // 1. Pengambilan Data Dasar (Untuk Filter Dropdown)
        $genres = Genre::all(); 

        // 2. Pengambilan Filter Input dari URL (Query Parameter)
        $sort = $request->query('sort');
        $genreId = $request->query('genre_id');
        $year = $request->query('year');
        $search = $request->query('search'); // Variabel search

        // 3. Query Dasar: Hanya ambil item bertipe 'book'
        $itemsQuery = Item::query()->where('type', 'book'); // <--- FILTER KRITIS UNTUK BOOKS

        // --- 4. Implementasi Logika Filtering ---
        
        // Filter Berdasarkan Genre
        if ($genreId) {
            $itemsQuery->whereHas('genres', function ($query) use ($genreId) {
                $query->where('genre_id', $genreId);
            });
        }
        
        // Filter Berdasarkan Tahun
        if ($year) {
            $itemsQuery->where('release_year', $year);
        }

        // Filter Berdasarkan Pencarian
        if ($search) {
            $itemsQuery->where('title', 'like', '%' . $search . '%')
                         ->orWhere('author_or_director', 'like', '%' . $search . '%');
        }


        // --- 5. Implementasi Logika Sorting ---
        
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
        $allBooks = $itemsQuery->get(); 

        // 6. Melewatkan data ke View
        $data = [
            'genres' => $genres,
            'allBooks' => $allBooks,
            
            // Variabel terpilih untuk mempertahankan status filter di Blade
            'selectedSort' => $sort, 
            'selectedGenre' => $genreId,
            'selectedYear' => $year,
            'selectedSearch' => $search,
        ];

        return view('books', $data);
    }
}