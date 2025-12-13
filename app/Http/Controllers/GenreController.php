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
    public function showItemsByGenre(Request $request, Genre $genre)
{

    $sort = $request->query('sort');
    $year = $request->query('year');

    $itemsQuery = Item::whereHas('genres', function ($q) use ($genre) {
        $q->where('genres.id', $genre->id);
    });

    if ($year) {
        $itemsQuery->where('release_year', $year);
    }

    if ($sort === 'title_asc') {
        $itemsQuery->orderBy('title', 'asc');
    } elseif ($sort === 'title_desc') {
        $itemsQuery->orderBy('title', 'desc');
    } elseif ($sort === 'year_desc') {
        $itemsQuery->orderBy('release_year', 'desc');
    } elseif ($sort === 'year_asc') {
        $itemsQuery->orderBy('release_year', 'asc');
    } else {
        // DEFAULT PENTING
        $itemsQuery->orderBy('title', 'asc');
    }

    return view('genredetail', [
        'selectedGenre' => $genre,
        'items' => $itemsQuery->get(),
        'selectedSort' => $sort,
        'selectedYear' => $year,
    ]);
}
}