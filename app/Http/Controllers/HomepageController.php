<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Genre;

class HomepageController extends Controller
{
    public function index()
    {
        // Ambil semua genre untuk dropdown
        $genres = Genre::all();

        // NEW ARRIVALS — item terbaru
        $newArrivals = Item::orderBy('created_at', 'desc')
                           ->limit(10)
                           ->get();

        // BOOKS SECTION — 5 buku terbaru
        $booksSection = Item::where('type', 'book')
                            ->orderBy('created_at', 'desc')
                            ->limit(5)
                            ->get();

        // MOVIES SECTION — 5 movie terbaru
        $moviesSection = Item::where('type', 'movie')
                             ->orderBy('created_at', 'desc')
                             ->limit(5)
                             ->get();

        // BEST OF 2025 — sementara ambil berdasarkan release_year (belum pakai rating)
        $bestOf2025 = Item::where('release_year', date('Y') + 1)
                          ->limit(5)
                          ->get();

        return view('homepage', [
            'genres'        => $genres,
            'newArrivals'   => $newArrivals,
            'booksSection'  => $booksSection,
            'moviesSection' => $moviesSection,
            'bestOf2025'    => $bestOf2025,
        ]);
    }
}
