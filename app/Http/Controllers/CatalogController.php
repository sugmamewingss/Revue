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
        // 1. Pengambilan Data Dasar (Untuk Filter Dropdown)
        $genres = Genre::all(); 

        // 2. Pengambilan Filter Input dari URL (Query Parameter)
        $sort = $request->query('sort');
        $genreId = $request->query('genre_id');
        $year = $request->query('year');
        
        // 3. Query Dasar Item
        $itemsQuery = Item::query()->orderBy('created_at', 'desc');        
        // --- Implementasi Logika Filtering ---
        
        // Filter Berdasarkan Genre (Jika genreId dipilih)
        if ($genreId) {
            $itemsQuery->whereHas('genres', function ($query) use ($genreId) {
                // Relasi many-to-many: mencari Item yang memiliki ID Genre ini
                $query->where('genre_id', $genreId);
            });
        }
        
        // Filter Berdasarkan Tahun (Jika year dipilih)
        if ($year) {
            $itemsQuery->where('release_year', $year);
        }

        // --- Implementasi Logika Sorting ---
        
        if ($sort === 'title_asc') {
            $itemsQuery->orderBy('title', 'asc');
        } elseif ($sort === 'title_desc') {
            $itemsQuery->orderBy('title', 'desc');
        } elseif ($sort === 'year_desc') {
            $itemsQuery->orderBy('release_year', 'desc');
        } elseif ($sort === 'year_asc') {
            $itemsQuery->orderBy('release_year', 'asc');
        } 
        
        // 5. Pembagian Data per Kategori Homepage
        
        // New Arrival (Item terbaru, 10 item)
        // Kloning query yang sudah difilter/sort, lalu tambahkan orderBy untuk waktu dibuat
        $newArrivals = (clone $itemsQuery)->orderBy('created_at', 'desc')->limit(10)->get();

        // Books Section (Hanya Item dengan type 'book', 5 item)
        // Kloning query, lalu tambahkan filter WHERE type
        $booksSection = (clone $itemsQuery)->where('type', 'book')->limit(5)->get();

        // Movies Section (Hanya Item dengan type 'movie', 5 item)
        // Kloning query, lalu tambahkan filter WHERE type
        $moviesSection = (clone $itemsQuery)->where('type', 'movie')->limit(5)->get();

        // NOTE: Untuk '2025\'s Best', kita asumsikan item rilis tahun depan
        $bestOf2025 = (clone $itemsQuery)->where('release_year', date('Y') + 1)->limit(5)->get();

            
        // 6. Melewatkan Data ke View
        $data = [
            'genres' => $genres,
            'newArrivals' => $newArrivals,
            'booksSection' => $booksSection,
            'moviesSection' => $moviesSection,
            'bestOf2025' => $bestOf2025, 
            
            // Variabel terpilih untuk mempertahankan status filter di Blade
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

    // Insert review
    Review::create([
        'item_id' => $itemId,
        'user_id' => auth()->id(),
        'rating'  => $request->rating,
        'review_text' => $request->review_text,
    ]);

    // Update average rating item
    $avg = Review::where('item_id', $itemId)->avg('rating');
    Item::where('id', $itemId)->update(['rating' => $avg]);

    return back()->with('success', 'Review submitted!');
}


public function storeRating(Request $request, $itemId)
{
    $request->validate([
        'rating' => 'required|integer|min:1|max:5',
    ]);

    // Simpan rating sebagai review tanpa teks
    Review::create([
        'item_id'     => $itemId,
        'user_id'     => $request->user()->id,
        'rating'      => $request->rating,
        'review_text' => null,
    ]);

    // Hitung rata-rata rating terbaru
    $avg = Review::where('item_id', $itemId)->avg('rating');

    Item::where('id', $itemId)->update(['rating' => $avg]);

    return back()->with('success', 'Rating submitted!');
}

    // Tempat untuk metode Detail Item Show
    // public function showItemDetail($itemId) {}
}