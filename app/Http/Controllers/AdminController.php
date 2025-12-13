<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genre;
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
            'title' => 'required|string|max:255',
            'author_or_director' => 'nullable|string|max:150',
            'release_year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'description' => 'nullable|string',
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
        }
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
