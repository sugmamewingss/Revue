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

    public function destroyItem($id)
{
    $item = Item::findOrFail($id);

    // hapus relasi dulu (AMAN)
    $item->genres()->detach();
    $item->reviews()->delete();
    $item->userLists()->delete();

    // hapus file cover
    if ($item->cover_image && file_exists(public_path('assets/covers/' . $item->cover_image))) {
        unlink(public_path('assets/covers/' . $item->cover_image));
    }

    $item->delete();

    return back()->with('success', 'Item deleted successfully.');
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
            'cover_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:10000', // Max 10MB
            'genres' => 'required|array|min:1',
            'genres.*' => 'exists:genres,id', 
        ], [
            'genres.required' => 'Wajib memilih minimal satu genre.',
            'cover_image.required' => 'Cover image wajib diupload.',
        ]);

        // START DEBUGGING KRITIS UNTUK MENGIDENTIFIKASI POST SIZE/FILE UPLOAD ERROR
        if (!$request->hasFile('cover_image') || !$request->file('cover_image')->isValid()) {
            dd([
                'STATUS' => 'Gagal di validasi File/Post Size (Cek php.ini).',
                'Validasi Data Lolos' => true,
                'File Ada di Request' => $request->hasFile('cover_image') ? 'Ya' : 'TIDAK',
                'File Valid' => $request->hasFile('cover_image') ? $request->file('cover_image')->isValid() : 'N/A',
                'Pesan' => 'Jika File Ada/Valid adalah TIDAK, periksa post_max_size dan upload_max_filesize di php.ini Anda!',
                'POST Data' => $request->except(['cover_image', '_token']),
            ]);
        }
        // END DEBUGGING KRITIS
        
        DB::beginTransaction();
        $fileNameToStore = null; // Ganti $path menjadi $fileNameToStore untuk kejelasan
        $tempPath = null;

        try {
            // 2. UPLOAD FILE: Menggunakan Metode move() untuk stabilitas di XAMPP
            $imageFile = $request->file('cover_image');
            
            // Buat nama file unik (hash based)
            $extension = $imageFile->getClientOriginalExtension();
            $fileNameToStore = time() . '_' . uniqid() . '.' . $extension; // Nama hash + timestamp
            
            // Lokasi tujuan fisik di public/assets/covers
            $destinationPath = public_path('assets/covers');
            
            // Pindahkan file ke lokasi tujuan
            $imageFile->move($destinationPath, $fileNameToStore);
            
            // Simpan nama file (path relatif dari public/assets/covers)
            $path = $fileNameToStore; 
            
            // 3. CREATE ITEM di tabel 'items'
            $item = Item::create([
                'title' => $validatedData['title'],
                'type' => $validatedData['type'],
                'author_or_director' => $validatedData['author_or_director'],
                'release_year' => $validatedData['release_year'],
                'description' => $validatedData['description'],
                // Menyimpan nama file unik
                'cover_image' => $path, 
            ]);

            // 4. MENGHUBUNGKAN RELASI MANY-TO-MANY (Genre)
            $item->genres()->attach($validatedData['genres']);

            DB::commit(); 

            // Redirect ke homepage dengan alert sukses
            return redirect()->route('homepage')->with('success', 'Item ' . $item->title . ' berhasil dibuat dan poster diupload.');

        } catch (\Exception $e) {
            DB::rollBack();
            
            // Jika file sudah dipindahkan, coba hapus (opsional)
            if (isset($path) && file_exists($destinationPath . '/' . $path)) {
                @unlink($destinationPath . '/' . $path); // Gunakan unlink native PHP
            }

            // Tampilkan Error Exception jika berhasil mencapai blok catch
            dd('ERROR KRITIS: Exception Database/Storage Gagal. Pesan Server:', $e->getMessage()); 
        }
    }

    // ======================
// ITEM MANAGEMENT
// ======================

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

    // UPDATE DATA TEXT DULU
    $item->update([
        'title' => $request->title,
        'type' => $request->type,
        'release_year' => $request->release_year,
        'description' => $request->description,
    ]);

    // JIKA ADA FILE BARU
    if ($request->hasFile('cover_image')) {

        $image = $request->file('cover_image');
        $newName = time().'_'.uniqid().'.'.$image->getClientOriginalExtension();
        $destination = public_path('assets/covers');

        // PINDAHKAN FILE BARU DULU
        $image->move($destination, $newName);

        // HAPUS FILE LAMA SETELAH SUKSES
        if ($item->cover_image &&
            file_exists($destination.'/'.$item->cover_image)) {
            unlink($destination.'/'.$item->cover_image);
        }

        // UPDATE DB
        $item->update([
            'cover_image' => $newName
        ]);
    }

    return redirect()
        ->route('admin.item.index')
        ->with('success', 'Item berhasil diperbarui');
}


}