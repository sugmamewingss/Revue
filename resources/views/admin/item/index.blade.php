<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin - Kelola Item</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background:#1E1E1E; color:#D9D9D9; }
        .admin-wrapper { max-width:1200px; margin:40px auto; padding:20px; background:#0d0d0d; border-radius:10px; }
        h1 { color:#ff0000; }
        table { width:100%; border-collapse:collapse; margin-top:20px; }
        th, td { border:1px solid #333; padding:12px; }
        th { background:#1a1a1a; color:#ff0000; }
        img { width:60px; border-radius:5px; }
        .btn-edit { background:#007bff; color:white; padding:5px 10px; border-radius:4px; text-decoration:none; }
        .btn-delete { background:#C10D0D; color:white; padding:5px 10px; border:none; border-radius:4px; cursor:pointer; text-decoration:none;}
    </style>
</head>
<body>

<div class="admin-wrapper">
    <div style="display:flex;justify-content:space-between;align-items:center;">
        <h1>Panel Admin: Daftar Item</h1>
        <div style="display:flex;gap:10px;">
            <a href="{{ route('admin.genre.index') }}" class="btn-delete">Kelola Genre</a>
            <a href="{{ route('homepage') }}" class="btn-delete">Homepage</a>
        </div>
    </div>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Cover</th>
                <th>Judul</th>
                <th>Tipe</th>
                <th>Rating</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        @forelse($items as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>
                    <img src="{{ asset('assets/covers/'.$item->cover_image) }}">
                </td>
                <td>{{ $item->title }}</td>
                <td>{{ ucfirst($item->type) }}</td>
                <td>{{ number_format($item->rating, 1) }}</td>
                <td>
                    <a href="{{ route('admin.item.edit', $item->id) }}" class="btn-edit">Edit</a>

                    <form action="{{ route('admin.item.destroy', $item->id) }}"
                          method="POST"
                          style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn-delete"
                            onclick="return confirm('Yakin hapus item {{ $item->title }}?')">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" style="text-align:center;color:#aaa;">
                    Belum ada item.
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>

</body>
</html>
