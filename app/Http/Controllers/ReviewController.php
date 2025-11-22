<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'item_id' => 'required|exists:items,id',
            'rating' => 'required|integer|min:1|max:10',
            'review_text' => 'nullable|string|max:5000'
        ]);
        
        $validated['user_id'] = auth()->id();
        
        try {
            Review::create($validated);
            return back()->with('success', 'Review berhasil ditambahkan!');
        } catch (\Exception $e) {
            return back()->with('error', 'Anda sudah memberikan review untuk item ini.');
        }
    }
    
    public function update(Request $request, $id)
    {
        $review = Review::findOrFail($id);
        
        // Check if user owns this review
        if ($review->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }
        
        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:10',
            'review_text' => 'nullable|string|max:5000'
        ]);
        
        $review->update($validated);
        
        return back()->with('success', 'Review berhasil diupdate!');
    }
    
    public function destroy($id)
    {
        $review = Review::findOrFail($id);
        
        // Check if user owns this review or is admin
        if ($review->user_id !== auth()->id() && !auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }
        
        $review->delete();
        
        return back()->with('success', 'Review berhasil dihapus!');
    }
}