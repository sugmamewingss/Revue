<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genre;
use App\Models\Item;
use App\Models\User; // Digunakan jika ingin menampilkan nama user di detail item

class GenreController extends Controller
{
    /**
     * Menampilkan daftar semua Genre yang ada (untuk genre.blade.php).
     */
    public function index()
    {
        // Ambil semua Genre dari database
        $genres = Genre::all();
        
        // Memeriksa jika ada data user yang login (meskipun tidak digunakan di sini)
        // $user = Auth::user(); 

        return view('genre', [
            'genres' => $genres,
        ]);
    }

    /**
     * Menampilkan semua Item (Buku & Film) berdasarkan Genre ID tertentu.
     */
    public function showItemsByGenre(Request $request, $genreId)
    {
        $selectedGenre = Genre::findOrFail($genreId);
        
        // Ambil parameter filter dari request
        $sort = $request->query('sort');
        $year = $request->query('year');
        
        // Query Dasar: Item yang memiliki Genre ID ini.
        $itemsQuery = Item::whereHas('genres', function ($query) use ($genreId) {
            $query->where('genre_id', $genreId);
        });
        
        // --- Implementasi Filter pada Hasil Genre ---
        
        if ($year) {
            $itemsQuery->where('release_year', $year);
        }

        // Implementasi Sorting
        if ($sort === 'title_asc') {
            $itemsQuery->orderBy('title', 'asc');
        } elseif ($sort === 'title_desc') {
            $itemsQuery->orderBy('title', 'desc');
        } elseif ($sort === 'year_desc') {
            $itemsQuery->orderBy('release_year', 'desc');
        } elseif ($sort === 'year_asc') {
            $itemsQuery->orderBy('release_year', 'asc');
        } 
        
        $itemsByGenre = $itemsQuery->get();
        
        // Ambil semua genre lagi untuk dropdown di halaman detail
        $genres = Genre::all(); 

        return view('genredetail', [ // Menggunakan nama file genredetail.blade.php
            'selectedGenre' => $selectedGenre,
            'items' => $itemsByGenre,
            'genres' => $genres, // Untuk dropdown filter di halaman detail
            
            // Mengirim variabel yang dipilih untuk mempertahankan status filter
            'selectedSort' => $sort, 
            'selectedYear' => $year,
        ]);
    }
}