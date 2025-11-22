<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Genre;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $query = Item::with(['genres', 'reviews']);
        
        // Filter by type
        if ($request->has('type') && in_array($request->type, ['book', 'movie'])) {
            $query->where('type', $request->type);
        }
        
        // Filter by genre
        if ($request->has('genre')) {
            $query->whereHas('genres', function($q) use ($request) {
                $q->where('genres.id', $request->genre);
            });
        }
        
        // Sort by rating or latest
        if ($request->sort === 'rating') {
            $query->withAvg('reviews', 'rating')
                  ->orderByDesc('reviews_avg_rating');
        } else {
            $query->latest();
        }
        
        $items = $query->paginate(12);
        $genres = Genre::all();
        
        return view('home', compact('items', 'genres'));
    }
    
    public function search(Request $request)
    {
        $keyword = $request->input('q');
        
        $items = Item::where('title', 'LIKE', "%{$keyword}%")
                     ->orWhere('author_or_director', 'LIKE', "%{$keyword}%")
                     ->with(['genres', 'reviews'])
                     ->paginate(12);
        
        return view('search', compact('items', 'keyword'));
    }
}