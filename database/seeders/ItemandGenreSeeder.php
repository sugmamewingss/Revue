<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Genre;
use App\Models\Item;

class ItemAndGenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // === LANGKAH 1: NONAKTIFKAN FOREIGN KEY CHECKS ===
        // Wajib untuk TRUNCATE tabel yang memiliki relasi Foreign Key
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Urutan TRUNCATE: Tabel anak/pivot sebelum tabel induk
        DB::table('user_lists')->truncate(); 
        DB::table('reviews')->truncate(); 
        DB::table('item_genres')->truncate();
        
        // Tabel utama
        DB::table('items')->truncate();
        DB::table('genres')->truncate();
        
        // === LANGKAH 2: GENERATE DATA ===

        // 1. GENERATE GENRE
        $genresData = [
            'Action', 'Sci-Fi', 'Fantasy', 'Romance', 'Horror', 'Biography', 
            'Self Help', 'Thriller', 'Drama', 'Comedy'
        ];
        $genres = [];
        foreach ($genresData as $name) {
            $genres[] = Genre::create(['name' => $name]);
        }

        // Ambil ID Genre yang sering digunakan
        $genreIds = [
            'action' => $genres[0]->id,
            'scifi' => $genres[1]->id,
            'fantasy' => $genres[2]->id,
            'romance' => $genres[3]->id,
            'horror' => $genres[4]->id,
            'drama' => $genres[8]->id, 
            'selfhelp' => $genres[6]->id,
            'biography' => $genres[5]->id,
        ];
        
        // 2. GENERATE ITEM (Buku & Film)
        
        $itemsData = [
            // NEW ARRIVAL & 2025's BEST
            ['title' => 'Oppenheimer', 'type' => 'movie', 'release_year' => 2023, 
             'author_or_director' => 'Christopher Nolan', 'description' => 'Film biografi fisika nuklir.',
             'cover_image' => 'oppenheimer.jpg', 'genre_id' => $genreIds['drama']],

            ['title' => 'Quantum Mania', 'type' => 'movie', 'release_year' => 2023, 
             'author_or_director' => 'Peyton Reed', 'description' => 'Petualangan di Quantum Realm.',
             'cover_image' => 'antman.jpg', 'genre_id' => $genreIds['scifi']],
             
            ['title' => 'The Subtle Art', 'type' => 'book', 'release_year' => 2017, 
             'author_or_director' => 'Mark Manson', 'description' => 'Buku self-help kontroversial.',
             'cover_image' => 'subtleart.jpg', 'genre_id' => $genreIds['selfhelp']],
            
            // BOOKS
            ['title' => 'Atomic Habits', 'type' => 'book', 'release_year' => 2018, 
             'author_or_director' => 'James Clear', 'description' => 'Membangun kebiasaan baik.',
             'cover_image' => 'atomic_habits.jpg', 'genre_id' => $genreIds['selfhelp']],

            ['title' => 'Dune: Part One', 'type' => 'movie', 'release_year' => 2021, 
             'author_or_director' => 'Denis Villeneuve', 'description' => 'Film fiksi ilmiah epik.',
             'cover_image' => 'dune.jpg', 'genre_id' => $genreIds['scifi']],
             
            ['title' => 'Interstellar', 'type' => 'movie', 'release_year' => 2014, 
             'author_or_director' => 'Christopher Nolan', 'description' => 'Perjalanan luar angkasa mencari rumah baru.',
             'cover_image' => 'interstellar.jpg', 'genre_id' => $genreIds['scifi']],
             
            ['title' => 'The Martian', 'type' => 'book', 'release_year' => 2011, 
             'author_or_director' => 'Andy Weir', 'description' => 'Astronot terdampar di Mars.',
             'cover_image' => 'the_martian.jpg', 'genre_id' => $genreIds['scifi']],
             
            ['title' => 'The Haunting', 'type' => 'movie', 'release_year' => 2022, 
             'author_or_director' => 'Mike Flanagan', 'description' => 'Seri horor di rumah berhantu.',
             'cover_image' => 'haunting.jpg', 'genre_id' => $genreIds['horror']],

            ['title' => 'A Thousand Splendid Suns', 'type' => 'book', 'release_year' => 2007, 
             'author_or_director' => 'Khaled Hosseini', 'description' => 'Kisah dua wanita di Afghanistan.',
             'cover_image' => 'splendid_suns.jpg', 'genre_id' => $genreIds['romance']],
             
            ['title' => 'The Godfather', 'type' => 'movie', 'release_year' => 1972, 
             'author_or_director' => 'Francis Ford Coppola', 'description' => 'Kisah keluarga mafia Italia-Amerika.',
             'cover_image' => 'godfather.jpg', 'genre_id' => $genreIds['drama']],
        ];

        $createdItems = [];
        foreach ($itemsData as $data) {
            // Menggunakan Item::create()
            $item = Item::create($data);
            $createdItems[] = $item;
            
            // 3. RELASI ITEM KE GENRE (Many-to-Many)
            // Misalnya, Item pertama (Oppenheimer) juga memiliki genre Biography
            if ($item->title === 'Oppenheimer') {
                $item->genres()->attach($genreIds['biography']); 
            }
            // Item Science Fiction
            if ($item->genre_id === $genreIds['scifi']) {
                $item->genres()->attach($genreIds['action']);
            }
            // Item Self Help juga drama
            if ($item->genre_id === $genreIds['selfhelp']) {
                $item->genres()->attach($genreIds['drama']);
            }

            // Atur relasi dasar (relasi yang sudah ada di kolom genre_id)
            $item->genres()->attach($data['genre_id']);
        }
        
        // === LANGKAH 3: AKTIFKAN FOREIGN KEY CHECKS KEMBALI ===
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}