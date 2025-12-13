<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Genre;

class HomepageController extends Controller
{
    public function index()
    {
        $genres = Genre::all();

        $newArrivals = Item::orderBy('created_at', 'desc')
                           ->limit(10)
                           ->get();

        $booksSection = Item::where('type', 'book')
                            ->orderBy('created_at', 'desc')
                            ->limit(5)
                            ->get();

        $moviesSection = Item::where('type', 'movie')
                             ->orderBy('created_at', 'desc')
                             ->limit(5)
                             ->get();

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
