<?php
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Tambah Item Baru</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #1E1E1E; color: #D9D9D9; margin: 0; padding: 0; }
        .admin-wrapper { max-width: 800px; margin: 40px auto; padding: 30px; background: #0d0d0d; border-radius: 10px; }
        .admin-header h1 { color: #ff0000; font-size: 24px; margin-bottom: 20px; }
        .back-link { color: #D9D9D9; text-decoration: none; padding: 8px 15px; border: 1px solid #555; border-radius: 5px; transition: background 0.3s; }
        .back-link:hover { background: #1a1a1a; }
        
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; margin-bottom: 8px; font-weight: bold; }
        .form-group input:not([type="checkbox"]), .form-group select, .form-group textarea { 
            width: 100%; padding: 10px; border: 1px solid #555; border-radius: 5px; background: #333; color: #D9D9D9; box-sizing: border-box; 
        }
        .form-group textarea { resize: vertical; min-height: 100px; }
        
        .checkbox-group { display: flex; flex-wrap: wrap; gap: 10px; margin-top: 10px; }
        .checkbox-group label { display: flex; align-items: center; background: #333; padding: 8px 12px; border-radius: 5px; cursor: pointer; transition: background 0.2s; }
        .checkbox-group input[type="checkbox"] { margin-right: 8px; }
        .checkbox-group label:hover { background: #444; }
        
        .btn-submit { background: #C10D0D; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; transition: background 0.3s; margin-top: 10px; }
        .btn-submit:hover { background: #AA0000; }
        .error-message { color: #ffcccc; font-size: 12px; margin-top: 5px; display: block; }
        
    </style>
</head>
<body>
    <div class="admin-wrapper">
        <div class="admin-header">
            <h1>Tambah Item Baru (Buku / Film)</h1>
            <a href="{{ route('admin.genre.index') }}" class="back-link">Kelola Genre</a>
        </div>
        
        @if ($errors->any())
            <div style="background:#C10D0D; padding: 15px; border-radius:5px; margin-bottom: 20px;">
                <strong>Gagal!</strong> Harap periksa kembali input Anda.
            </div>
        @endif

        <form action="{{ route('admin.item.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="form-group">
                <label for="type">Tipe Item</label>
                <select id="type" name="type" required>
                    <option value="book" {{ old('type') == 'book' ? 'selected' : '' }}>Buku</option>
                    <option value="movie" {{ old('type') == 'movie' ? 'selected' : '' }}>Film</option>
                </select>
                @error('type') <span class="error-message">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="title">Judul Item</label>
                <input type="text" id="title" name="title" value="{{ old('title') }}" required>
                @error('title') <span class="error-message">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="author_or_director">Penulis / Sutradara</label>
                <input type="text" id="author_or_director" name="author_or_director" value="{{ old('author_or_director') }}">
                @error('author_or_director') <span class="error-message">{{ $message }}</span> @enderror
            </div>
            
            <div class="form-group">
                <label for="release_year">Tahun Rilis</label>
                <input type="number" id="release_year" name="release_year" value="{{ old('release_year') }}" required min="1800" max="{{ date('Y') + 1 }}">
                @error('release_year') <span class="error-message">{{ $message }}</span> @enderror
            </div>
            
            <div class="form-group">
                <label for="description">Deskripsi / Sinopsis</label>
                <textarea id="description" name="description">{{ old('description') }}</textarea>
                @error('description') <span class="error-message">{{ $message }}</span> @enderror
            </div>
            
            <div class="form-group">
                <label for="cover_image">Cover Image (Poster)</label>
                <input type="file" id="cover_image" name="cover_image" accept="image/*" required>
                @error('cover_image') <span class="error-message">{{ $message }}</span> @enderror
                <small style="color:#aaa; display:block; margin-top:5px;">File harus berupa gambar (JPEG, PNG, dll.)</small>
            </div>
            
            <div class="form-group">
                <label>Pilih Genre (Minimal 1)</label>
                <div class="checkbox-group">
                    @forelse ($genres as $genre)
                        <label>
                            <input type="checkbox" name="genres[]" value="{{ $genre->id }}"
                                {{ in_array($genre->id, old('genres', [])) ? 'checked' : '' }}>
                            {{ $genre->name }}
                        </label>
                    @empty
                        <p style="color:#ff0000;">ERROR: Belum ada genre di database. Tambahkan genre terlebih dahulu.</p>
                    @endforelse
                </div>
                @error('genres') <span class="error-message">Wajib memilih minimal satu genre.</span> @enderror
            </div>

            <button type="submit" class="btn-submit">Simpan Item</button>
        </form>
    </div>
</body>
</html>