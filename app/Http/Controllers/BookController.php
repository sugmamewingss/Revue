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
        $genres = Genre::all();

        $sort = $request->query('sort');
        $genreId = $request->query('genre_id');
        $year = $request->query('year');
        $search = $request->query('search');

        $query = Item::where('type', 'book')
            ->withAvg('reviews', 'rating');

        // FILTER
        if ($genreId) {
            $query->whereHas('genres', function ($q) use ($genreId) {
                $q->where('genre_id', $genreId);
            });
        }

        if ($year) {
            $query->where('release_year', $year);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('author_or_director', 'like', "%{$search}%");
            });
        }

        // SORTING
        match ($sort) {
            'title_asc'   => $query->orderBy('title', 'asc'),
            'title_desc'  => $query->orderBy('title', 'desc'),
            'year_asc'    => $query->orderBy('release_year', 'asc'),
            'year_desc'   => $query->orderBy('release_year', 'desc'),
            'rating_desc' => $query->orderByDesc('reviews_avg_rating'),
            default       => $query->orderBy('release_year', 'desc'),
        };

        return view('books', [
            'allBooks' => $query->get(),
            'genres' => $genres,
            'selectedSort' => $sort,
            'selectedGenre' => $genreId,
            'selectedYear' => $year,
            'selectedSearch' => $search,
        ]);
    }

}