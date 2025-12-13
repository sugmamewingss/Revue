<?php

namespace App\Http\Controllers;

use App\Models\UserList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Genre;

class UserListController extends Controller
{
    /**
     * Simpan item ke My List
     */
public function toggle(Request $request)
{
    $request->validate([
        'item_id' => 'required|exists:items,id',
    ]);

    $userId = Auth::id();
    $itemId = $request->item_id;

    $existing = UserList::where('user_id', $userId)
        ->where('item_id', $itemId)
        ->first();

    if ($existing) {
        $existing->delete();
        return back()->with('success', 'Item dihapus dari My List');
    }

    UserList::create([
        'user_id' => $userId,
        'item_id' => $itemId,
        'status' => 'Planning',
        'personal_score' => null,
    ]);

    return back()->with('success', 'Item berhasil disimpan ke My List');
}


public function index(Request $request)
{
    $user = Auth::user();

    // 1️⃣ Ambil query parameter (INI YANG HILANG SELAMA INI)
    $sort = $request->query('sort');
    $genreId = $request->query('genre_id');
    $year = $request->query('year');
    $search = $request->query('search');

    // 2️⃣ Query dasar My List
    $query = $user->items()
        ->withAvg('reviews', 'rating');

    // 3️⃣ FILTER
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

    // 4️⃣ SORTING
    if ($sort === 'title_asc') {
        $query->orderBy('title', 'asc');
    } elseif ($sort === 'title_desc') {
        $query->orderBy('title', 'desc');
    } elseif ($sort === 'year_asc') {
        $query->orderBy('release_year', 'asc');
    } elseif ($sort === 'year_desc') {
        $query->orderBy('release_year', 'desc');
    } elseif ($sort === 'rating_desc') {
        $query->orderByDesc('reviews_avg_rating');
    } else {
        $query->orderBy('created_at', 'desc');
    }

    $items = $query->get();
    $genres = Genre::all();

    // 5️⃣ KIRIM SEMUA STATE KE VIEW (INI KUNCI)
    return view('mylist', [
        'items' => $items,
        'genres' => $genres,

        // 🔥 WAJIB ADA SEMUA
        'selectedSort' => $sort,
        'selectedGenre' => $genreId,
        'selectedYear' => $year,
        'selectedSearch' => $search,
    ]);
}



}
