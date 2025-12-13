<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Item</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body { font-family:'Poppins',sans-serif; background:#1E1E1E; color:#D9D9D9; }
        .wrapper { max-width:700px; margin:40px auto; background:#0d0d0d; padding:30px; border-radius:10px; }
        label { display:block; margin-top:15px; }
        input, textarea, select {
            width:100%; padding:10px; margin-top:5px;
            background:#333; border:1px solid #555; color:white;
        }
        button {
            margin-top:20px;
            background:#C10D0D; color:white;
            padding:10px 20px; border:none; border-radius:5px;
            cursor:pointer;
        }
        a { color:#aaa; text-decoration:none; margin-left:15px; }
    </style>
</head>
<body>

<div class="wrapper">
    <h1>Edit Item</h1>

    <form action="{{ route('admin.item.update', $item->id) }}"
      method="POST"
      enctype="multipart/form-data"
    >        
    @csrf
    @method('PUT')

        <label>Judul</label>
        <input type="text" name="title" value="{{ $item->title }}" required>

        <label>Cover Baru (opsional)</label>
        <input type="file" name="cover_image" accept="image/*">

        @if($item->cover_image)
        <p style="margin-top:10px;color:#aaa;">Cover saat ini:</p>
        <img src="{{ asset('assets/covers/'.$item->cover_image) }}"
         style="width:120px;border-radius:6px;">
        @endif

        <label>Tipe</label>
        <select name="type">
            <option value="book" {{ $item->type === 'book' ? 'selected' : '' }}>Book</option>
            <option value="movie" {{ $item->type === 'movie' ? 'selected' : '' }}>Movie</option>
        </select>

        <label>Tahun Rilis</label>
        <input type="number" name="release_year" value="{{ $item->release_year }}">

        <label>Deskripsi</label>
        <textarea name="description" rows="5">{{ $item->description }}</textarea>

        <button type="submit">Update Item</button>
        <a href="{{ route('admin.item.index') }}">Batal</a>
    </form>
</div>

</body>
</html>
