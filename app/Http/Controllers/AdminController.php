<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Genre;
<<<<<<< Updated upstream
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
=======
use App\Models\Item;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        $genres = Genre::all();
        return view('admin.genre.index', compact('genres'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:genres,name',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        Genre::create([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.genre.index')->with('success', 'Genre baru berhasil ditambahkan!');
    }

    public function edit(Genre $genre)
    {
        $genres = Genre::all();
        return view('admin.genre.index', [
            'genres' => $genres,
            'editingGenre' => $genre
        ]);
    }

    public function update(Request $request, Genre $genre)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:genres,name,' . $genre->id,
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $genre->update([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.genre.index')->with('success', 'Genre ' . $genre->name . ' berhasil diperbarui.');
    }

    public function destroy(Genre $genre)
    {
        $genre->delete();
        return redirect()->route('admin.genre.index')->with('success', 'Genre berhasil dihapus.');
    }

    public function createItem()
    {
        $genres = Genre::all();
        return view('admin.item.create', compact('genres'));
    }

    public function destroyItem($id)
    {
        $item = Item::findOrFail($id);

        $item->genres()->detach();
        $item->reviews()->delete();
        $item->userLists()->delete();

        if ($item->cover_image && file_exists(public_path('assets/covers/' . $item->cover_image))) {
            unlink(public_path('assets/covers/' . $item->cover_image));
        }

        $item->delete();

        return back()->with('success', 'Item deleted successfully.');
    }

    public function storeItem(Request $request)
    {
        $validatedData = $request->validate([
            'type' => 'required|in:book,movie',
>>>>>>> Stashed changes
            'title' => 'required|string|max:255',
            'type' => 'required|in:book,movie',
            'author_or_director' => 'nullable|string|max:150',
            'release_year' => 'nullable|integer|min:1800|max:' . (date('Y') + 5),
            'description' => 'nullable|string',
<<<<<<< Updated upstream
            'cover_image' => 'nullable|image|max:2048',
            'genres' => 'array'
        ]);
        
        if ($request->hasFile('cover_image')) {
            $validated['cover_image'] = $request->file('cover_image')
                                                ->store('covers', 'public');
=======
            'cover_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:10000',
            'genres' => 'required|array|min:1',
            'genres.*' => 'exists:genres,id',
        ]);

        DB::beginTransaction();

        try {
            $imageFile = $request->file('cover_image');
            $extension = $imageFile->getClientOriginalExtension();
            $fileName = time() . '_' . uniqid() . '.' . $extension;
            $destinationPath = public_path('assets/covers');

            $imageFile->move($destinationPath, $fileName);

            $item = Item::create([
                'title' => $validatedData['title'],
                'type' => $validatedData['type'],
                'author_or_director' => $validatedData['author_or_director'],
                'release_year' => $validatedData['release_year'],
                'description' => $validatedData['description'],
                'cover_image' => $fileName,
            ]);

            $item->genres()->attach($validatedData['genres']);

            DB::commit();

            return redirect()->route('homepage')
                ->with('success', 'Item ' . $item->title . ' berhasil dibuat.');

        } catch (\Exception $e) {
            DB::rollBack();

            if (isset($fileName) && file_exists($destinationPath . '/' . $fileName)) {
                unlink($destinationPath . '/' . $fileName);
            }

            dd($e->getMessage());
>>>>>>> Stashed changes
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

    public function indexItem()
    {
        $items = Item::latest()->get();
        return view('admin.item.index', compact('items'));
    }

    public function editItem($id)
    {
        $item = Item::findOrFail($id);
        $genres = Genre::all();

        return view('admin.item.edit', compact('item', 'genres'));
    }

    public function updateItem(Request $request, $id)
    {
        $item = Item::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:book,movie',
            'release_year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'description' => 'nullable|string',
            'cover_image' => 'nullable|image|mimes:jpg,jpeg,png|max:10000',
        ]);

        $item->update([
            'title' => $request->title,
            'type' => $request->type,
            'release_year' => $request->release_year,
            'description' => $request->description,
        ]);

        if ($request->hasFile('cover_image')) {
            $image = $request->file('cover_image');
            $newName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $destination = public_path('assets/covers');

            $image->move($destination, $newName);

            if ($item->cover_image && file_exists($destination . '/' . $item->cover_image)) {
                unlink($destination . '/' . $item->cover_image);
            }

            $item->update([
                'cover_image' => $newName
            ]);
        }

        return redirect()
            ->route('admin.item.index')
            ->with('success', 'Item berhasil diperbarui');
    }
}
