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
        // Ambil semua Genre untuk dropdown filter
        $genres = Genre::all(); 

        // Ambil parameter filter dari request
        $sort = $request->query('sort');
        $genreId = $request->query('genre_id');
        $year = $request->query('year');
        $search = $request->query('search'); // Tambahkan variabel search jika ada

        // Query Dasar: Hanya ambil item bertipe 'book'
        $itemsQuery = Item::query()->where('type', 'book');

        // --- 1. Implementasi Filter ---
        
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

        // Filter Berdasarkan Pencarian (Jika diperlukan)
        if ($search) {
            $itemsQuery->where('title', 'like', '%' . $search . '%')
                       ->orWhere('author_or_director', 'like', '%' . $search . '%');
        }


        // --- 2. Implementasi Sorting ---
        
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
        
        // Ambil semua hasil (kita akan menampilkannya di grid besar, bukan paginasi)
        $allBooks = $itemsQuery->get(); 

        // Melewatkan data ke View
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