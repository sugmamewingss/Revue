<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genre; 
use App\Models\Item; 
use App\Models\Review;

class CatalogController extends Controller
{
    public function index(Request $request)
    {
        $genres = Genre::all(); 

        $sort = $request->query('sort');
        $genreId = $request->query('genre_id');
        $year = $request->query('year');
        
        $itemsQuery = Item::query()->orderBy('created_at', 'desc'); 
        
        if ($genreId) {
            $itemsQuery->whereHas('genres', function ($query) use ($genreId) {
                $query->where('genre_id', $genreId);
            });
        }
        
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
        } 
        
        $newArrivals = (clone $itemsQuery)->orderBy('created_at', 'desc')->limit(10)->get();

        $booksSection = (clone $itemsQuery)->where('type', 'book')->limit(5)->get();

        $moviesSection = (clone $itemsQuery)->where('type', 'movie')->limit(5)->get();

        $bestOf2025 = (clone $itemsQuery)->where('release_year', date('Y') + 1)->limit(5)->get();

            
        $data = [
            'genres' => $genres,
            'newArrivals' => $newArrivals,
            'booksSection' => $booksSection,
            'moviesSection' => $moviesSection,
            'bestOf2025' => $bestOf2025, 
            
            'selectedSort' => $sort, 
            'selectedGenre' => $genreId,
            'selectedYear' => $year,
        ];

        return view('homepage', $data);
    }
    
    public function showItemDetail($itemId)
{
    $item = Item::with(['genres', 'reviews.user'])->findOrFail($itemId);

    return view('itemdetail', compact('item'));
}

public function storeReview(Request $request, $itemId)
{
    $request->validate([
        'rating' => 'required|integer|min:1|max:5',
        'review_text' => 'nullable|string|max:1000',
    ]);

    Review::create([
        'item_id' => $itemId,
        'user_id' => auth()->id(),
        'rating'  => $request->rating,
        'review_text' => $request->review_text,
    ]);

    $avg = Review::where('item_id', $itemId)->avg('rating');
    Item::where('id', $itemId)->update(['rating' => $avg]);

    return back()->with('success', 'Review submitted!');
}


public function storeRating(Request $request, $itemId)
{
    $request->validate([
        'rating' => 'required|integer|min:1|max:5',
    ]);

    Review::create([
        'item_id'     => $itemId,
        'user_id'     => $request->user()->id,
        'rating'      => $request->rating,
        'review_text' => null,
    ]);

    $avg = Review::where('item_id', $itemId)->avg('rating');

    Item::where('id', $itemId)->update(['rating' => $avg]);

    return back()->with('success', 'Rating submitted!');
}
}