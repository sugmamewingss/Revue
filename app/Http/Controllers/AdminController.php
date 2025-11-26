<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genre;
use App\Models\Item; // Diperlukan untuk CRUD Item
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    // ===================================
    // 1. KELOLA GENRE (CRUD)
    // ===================================

    /**
     * READ: Menampilkan daftar Genre (Admin Console)
     */
    public function index()
    {
        // Mendapatkan semua genre untuk ditampilkan di tabel
        $genres = Genre::all();
        // Mengembalikan view admin/genre/index.blade.php
        return view('admin.genre.index', compact('genres'));
    }

    /**
     * CREATE: Menyimpan Genre Baru
     */
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

    /**
     * READ/FORM: Menampilkan Form Edit Genre
     */
    public function edit(Genre $genre)
    {
        $genres = Genre::all();
        // Mengirim data genre yang akan diedit sebagai 'editingGenre' ke view yang sama
        return view('admin.genre.index', [
            'genres' => $genres,
            'editingGenre' => $genre // Genre yang sedang di edit
        ]);
    }

    /**
     * UPDATE: Memperbarui Genre
     */
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

    /**
     * DELETE: Menghapus Genre
     */
    public function destroy(Genre $genre)
    {
        $genre->delete();
        return redirect()->route('admin.genre.index')->with('success', 'Genre berhasil dihapus.');
    }

    // ===================================
    // 2. KELOLA ITEM (CREATE / Kerangka Awal)
    // ===================================
    
    /**
     * CREATE: Menampilkan form untuk menambah Item baru (Buku/Film).
     */
    public function createItem()
    {
        // Ambil semua Genre yang ada untuk ditampilkan di dropdown/checkbox
        $genres = Genre::all(); 
        
        // Return view form Create Item (admin/item/create.blade.php)
        return view('admin.item.create', compact('genres'));
    }

    /**
     * CREATE: Menyimpan Item baru ke database, termasuk upload gambar.
     */
    public function storeItem(Request $request)
    {
        // 1. VALIDASI
        $validatedData = $request->validate([
            'type' => 'required|in:book,movie',
            'title' => 'required|string|max:255',
            'author_or_director' => 'nullable|string|max:150',
            'release_year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'description' => 'nullable|string',
            'cover_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:10000', 
            'genres' => 'required|array|min:1',
            'genres.*' => 'exists:genres,id', 
        ], [
            'genres.required' => 'Wajib memilih minimal satu genre.',
            'cover_image.required' => 'Cover image wajib diupload.',
        ]);

        DB::beginTransaction();
        $imagePath = null; 

        try {
            // 2. UPLOAD FILE GAMBAR
            $imageFile = $request->file('cover_image');
            $imagePath = $imageFile->store('covers', 'public'); 

            // 3. CREATE ITEM di tabel 'items'
            $item = Item::create([
                'title' => $validatedData['title'],
                'type' => $validatedData['type'],
                'author_or_director' => $validatedData['author_or_director'],
                'release_year' => $validatedData['release_year'],
                'description' => $validatedData['description'],
                'cover_image' => basename($imagePath), 
            ]);

            // 4. MENGHUBUNGKAN RELASI MANY-TO-MANY (Genre)
            $item->genres()->attach($validatedData['genres']);

            DB::commit(); 

            // Jika semua berhasil, redirect ke homepage dengan alert sukses
            return redirect()->route('homepage')->with('success', 'Item ' . $item->title . ' berhasil dibuat dan poster diupload.');

        } catch (\Exception $e) {
            DB::rollBack();

            if (isset($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }
            
            // KOREKSI DEBUGGING: Hentikan eksekusi dan tampilkan error
            // Ini akan memunculkan layar error Laravel yang detail.
            dd('Kegagalan Fatal Terjadi. Error:', $e->getMessage()); 
            // Setelah error teridentifikasi, kita akan ganti dd() dengan return back()
        }
    }
}