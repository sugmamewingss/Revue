<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Halaman profil user (user.blade.php)
     */
    public function showProfile()
    {
        $user = Auth::user();

        // Preview 5 item My List
        $myListPreview = $user->myListItems()
            ->latest('user_lists.created_at')
            ->take(5)
            ->get();

        return view('user', compact('user', 'myListPreview'));
    }

    /**
     * Halaman My List (mylist.blade.php)
     */
    public function mylist(Request $request)
{
    $user = Auth::user();

    $genres = \App\Models\Genre::all();

    $sort = $request->query('sort');
    $genreId = $request->query('genre_id');
    $year = $request->query('year');
    $search = $request->query('search');

    $query = $user->myListItems()
        ->with('genres')
        ->withAvg('reviews', 'rating');

    if ($search) {
        $query->where('title', 'like', '%' . $search . '%');
    }

    if ($genreId) {
        $query->whereHas('genres', function ($q) use ($genreId) {
            $q->where('genres.id', $genreId);
        });
    }

    if ($year) {
        $query->where('release_year', $year);
    }

    if ($sort === 'rating_desc') {
        $query->orderByDesc('reviews_avg_rating');
    } elseif ($sort === 'title_asc') {
        $query->orderBy('title');
    } else {
        $query->latest('user_lists.created_at');
    }

    $myListItems = $query->get();

    return view('mylist', compact(
        'user',
        'myListItems',
        'genres',
        'sort',
        'genreId',
        'year',
        'search'
    ));
}

}