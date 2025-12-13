<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genre; 
use App\Models\Item; 

class MovieController extends Controller
{
    public function index(Request $request)
    {
        $genres = Genre::all(); 

        $sort = $request->query('sort');
        $genreId = $request->query('genre_id');
        $year = $request->query('year');
        $search = $request->query('search');

$itemsQuery = Item::query()
    ->where('type', 'movie')
    ->withAvg('reviews', 'rating');

        if ($genreId) {
            $itemsQuery->whereHas('genres', function ($query) use ($genreId) {
                $query->where('genre_id', $genreId);
            });
        }
        
        if ($year) {
            $itemsQuery->where('release_year', $year);
        }

        if ($search) {
    $itemsQuery->where(function ($q) use ($search) {
        $q->where('title', 'like', '%' . $search . '%')
          ->orWhere('author_or_director', 'like', '%' . $search . '%');
    });
}
        
        if ($sort === 'title_asc') {
            $itemsQuery->orderBy('title', 'asc');
        } elseif ($sort === 'title_desc') {
            $itemsQuery->orderBy('title', 'desc');
        } elseif ($sort === 'year_desc') {
            $itemsQuery->orderBy('release_year', 'desc');
        } elseif ($sort === 'year_asc') {
            $itemsQuery->orderBy('release_year', 'asc');
        } elseif ($sort === 'rating_desc') {
            $itemsQuery->orderByDesc('reviews_avg_rating');
        }
        else {
             $itemsQuery->orderBy('release_year', 'desc');
        }
        
        $allMovies = $itemsQuery->get();

        $data = [
            'genres' => $genres,
            'allMovies' => $allMovies,
            
            'selectedSort' => $sort, 
            'selectedGenre' => $genreId,
            'selectedYear' => $year,
            'selectedSearch' => $search,
        ];


        return view('movies', $data);
    }
}