<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function show($id)
    {
        $item = Item::with(['genres', 'reviews.user'])->findOrFail($id);
        
        // Get user's review if authenticated
        $userReview = null;
        if (auth()->check()) {
            $userReview = $item->reviews()
                              ->where('user_id', auth()->id())
                              ->first();
        }
        
        // Get average rating
        $averageRating = $item->averageRating();
        $totalReviews = $item->totalReviews();
        
        // Get rating distribution
        $ratingDistribution = [];
        for ($i = 10; $i >= 1; $i--) {
            $count = $item->reviews()->where('rating', $i)->count();
            $ratingDistribution[$i] = [
                'count' => $count,
                'percentage' => $totalReviews > 0 ? ($count / $totalReviews) * 100 : 0
            ];
        }
        
        return view('items.show', compact(
            'item', 
            'userReview', 
            'averageRating', 
            'totalReviews', 
            'ratingDistribution'
        ));
    }
}