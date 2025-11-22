<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Genre;
use App\Models\User;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_items' => Item::count(),
            'total_users' => User::where('role', 'user')->count(),
            'total_reviews' => Review::count(),
            'total_genres' => Genre::count(),
        ];
        
        $recentReviews = Review::with(['user', 'item'])
                               ->latest()
                               ->take(5)
                               ->get();
        
        return view('admin.dashboard', compact('stats', 'recentReviews'));
    }
    
    // Items Management
    public function items()
    {
        $items = Item::with('genres')->latest()->paginate(20);
        return view('admin.items.index', compact('items'));
    }
    
    public function createItem()
    {
        $genres = Genre::all();
        return view('admin.items.create', compact('genres'));
    }
    
    public function storeItem(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:book,movie',
            'author_or_director' => 'nullable|string|max:150',
            'release_year' => 'nullable|integer|min:1800|max:' . (date('Y') + 5),
            'description' => 'nullable|string',
            'cover_image' => 'nullable|image|max:2048',
            'genres' => 'array'
        ]);
        
        if ($request->hasFile('cover_image')) {
            $validated['cover_image'] = $request->file('cover_image')
                                                ->store('covers', 'public');
        }
        
        $item = Item::create($validated);
        
        if (!empty($validated['genres'])) {
            $item->genres()->attach($validated['genres']);
        }
        
        return redirect()->route('admin.items')
                        ->with('success', 'Item berhasil ditambahkan!');
    }
    
    public function editItem($id)
    {
        $item = Item::with('genres')->findOrFail($id);
        $genres = Genre::all();
        return view('admin.items.edit', compact('item', 'genres'));
    }
    
    public function updateItem(Request $request, $id)
    {
        $item = Item::findOrFail($id);
        
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:book,movie',
            'author_or_director' => 'nullable|string|max:150',
            'release_year' => 'nullable|integer|min:1800|max:' . (date('Y') + 5),
            'description' => 'nullable|string',
            'cover_image' => 'nullable|image|max:2048',
            'genres' => 'array'
        ]);
        
        if ($request->hasFile('cover_image')) {
            // Delete old image
            if ($item->cover_image) {
                Storage::disk('public')->delete($item->cover_image);
            }
            $validated['cover_image'] = $request->file('cover_image')
                                                ->store('covers', 'public');
        }
        
        $item->update($validated);
        
        if (isset($validated['genres'])) {
            $item->genres()->sync($validated['genres']);
        }
        
        return redirect()->route('admin.items')
                        ->with('success', 'Item berhasil diupdate!');
    }
    
    public function deleteItem($id)
    {
        $item = Item::findOrFail($id);
        
        if ($item->cover_image) {
            Storage::disk('public')->delete($item->cover_image);
        }
        
        $item->delete();
        
        return back()->with('success', 'Item berhasil dihapus!');
    }
    
    // Genres Management
    public function genres()
    {
        $genres = Genre::withCount('items')->get();
        return view('admin.genres.index', compact('genres'));
    }
    
    public function storeGenre(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100|unique:genres'
        ]);
        
        Genre::create($validated);
        
        return back()->with('success', 'Genre berhasil ditambahkan!');
    }
    
    public function deleteGenre($id)
    {
        $genre = Genre::findOrFail($id);
        $genre->delete();
        
        return back()->with('success', 'Genre berhasil dihapus!');
    }
    
    // Users Management
    public function users()
    {
        $users = User::withCount('reviews')->latest()->paginate(20);
        return view('admin.users.index', compact('users'));
    }
    
    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Anda tidak bisa menghapus akun sendiri!');
        }
        
        $user->delete();
        
        return back()->with('success', 'User berhasil dihapus!');
    }
}