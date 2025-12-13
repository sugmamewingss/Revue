<?php
// Catatan: File ini TIDAK menggunakan layout penuh karena ini adalah panel konsol Admin sederhana.
// Sebagian besar CSS akan dimuat secara terpisah atau secara inline untuk kesederhanaan.
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Kelola Genre</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #1E1E1E; color: #D9D9D9; margin: 0; padding: 0; }
        .admin-wrapper { max-width: 1200px; margin: 40px auto; padding: 20px; background: #0d0d0d; border-radius: 10px; }
        .admin-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; border-bottom: 2px solid #333; padding-bottom: 15px; }
        .admin-header h1 { color: #ff0000; font-size: 24px; }
        .back-link { color: #D9D9D9; text-decoration: none; padding: 8px 15px; border: 1px solid #555; border-radius: 5px; transition: background 0.3s; }
        .back-link:hover { background: #1a1a1a; }

        .admin-actions {
        display: flex;
        gap: 12px; /* jarak antar tombol */
        align-items: center;
        }

        .admin-actions .back-link:last-child {
    background: #C10D0D;
    border-color: #C10D0D;
}

.admin-actions .back-link:last-child:hover {
    background: #AA0000;
}


        /* Form Styling */
        .form-add-genre { background: #1a1a1a; padding: 20px; border-radius: 8px; margin-bottom: 30px; }
        .form-add-genre h2 { color: #D9D9D9; border-bottom: 1px solid #555; padding-bottom: 10px; margin-bottom: 15px; }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; margin-bottom: 5px; font-weight: bold; }
        .form-group input[type="text"] { width: 100%; padding: 10px; border: 1px solid #555; border-radius: 5px; background: #333; color: #D9D9D9; box-sizing: border-box; }
        .btn-submit { background: #C10D0D; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; transition: background 0.3s; }
        .btn-submit:hover { background: #AA0000; }
        
        /* Table Styling */
        .genre-table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .genre-table th, .genre-table td { border: 1px solid #333; padding: 12px; text-align: left; }
        .genre-table th { background: #1a1a1a; color: #ff0000; }
        .btn-edit, .btn-delete { padding: 5px 10px; border: none; border-radius: 3px; cursor: pointer; margin-right: 5px; font-size: 12px; }
        .btn-edit { background: #007bff; color: white; }
        .btn-delete { background: #C10D0D; color: white; }
        .btn-edit:hover { background: #0056b3; }
        .btn-delete:hover { background: #AA0000; }

        
        /* Alert/Errors */
        .alert-success { background: #28a745; color: white; padding: 15px; border-radius: 5px; margin-bottom: 15px; }
        .alert-danger { background: #C10D0D; color: white; padding: 15px; border-radius: 5px; margin-bottom: 15px; }
    </style>
</head>


<body>
    <div class="admin-wrapper">
        <div class="admin-header">
            <h1>Panel Admin: Kelola Genre</h1>
            <div  class="admin-actions">
                <a href="{{ route('homepage') }}" class="back-link">Kembali ke Homepage</a>
            <a href="{{ route('admin.item.index') }}" class="back-link">
            Kelola Item
            </a>

            </div>
            
        </div>

        @if (session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert-danger">
                Harap periksa kembali input Anda.
            </div>
        @endif

        
        <!-- Form Tambah Genre -->
        <div class="form-add-genre">
            <h2>{{ isset($editingGenre) ? 'Edit Genre: ' . $editingGenre->name : 'Tambah Genre Baru' }}</h2>
            
            <!-- Form ini menangani CREATE dan UPDATE (jika editingGenre ada) -->
            <form action="{{ isset($editingGenre) ? route('admin.genre.update', $editingGenre->id) : route('admin.genre.store') }}" 
                  method="POST">
                @csrf
                @if (isset($editingGenre))
                    @method('PUT') 
                @endif

                <div class="form-group">
                    <label for="name">Nama Genre</label>
                    <input type="text" id="name" name="name" 
                           value="{{ old('name', $editingGenre->name ?? '') }}" required>
                    <!-- Tampilkan error validasi spesifik -->
                    @error('name')
                        <small style="color: #ffcccc; display: block; margin-top: 5px;">{{ $message }}</small>
                    @enderror
                </div>
                
                <button type="submit" class="btn-submit">
                    {{ isset($editingGenre) ? 'Update Genre' : 'Simpan Genre' }}
                </button>
                
                @if (isset($editingGenre))
                    <a href="{{ route('admin.genre.index') }}" class="back-link" style="margin-left: 10px;">Batal Edit</a>
                @endif
            </form>
        </div>

        <!-- Daftar Genre yang Ada -->
        <h2>Daftar Semua Genre</h2>
        <table class="genre-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Genre</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($genres as $genre)
                    <tr>
                        <td>{{ $genre->id }}</td>
                        <td>{{ $genre->name }}</td>
                        <td>
                            <!-- Tombol Edit (Mengarah ke route yang sama dengan parameter ID) -->
                            <a href="{{ route('admin.genre.edit', $genre->id) }}" class="btn-edit">Edit</a>
                            
                            <!-- Tombol Delete (Menggunakan Form DELETE) -->
                            <form action="{{ route('admin.genre.destroy', $genre->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete" onclick="return confirm('Apakah Anda yakin ingin menghapus genre {{ $genre->name }}? Genre yang terhapus tidak dapat dikembalikan.')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" style="text-align: center; color: #aaa;">Belum ada genre yang dibuat. Silakan tambahkan di atas.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</body>
</html>