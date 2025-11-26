<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

// Menggunakan BelongsTo, bukan Model, karena ini adalah tabel perantara (pivot)
class ItemGenre extends Pivot 
{
    // Tabel pivot biasanya tidak memerlukan timestamps
    public $timestamps = false;
    protected $table = 'item_genres';

    protected $fillable = [
        'item_id',
        'genre_id',
    ];

    // Relasi opsional untuk referensi balik
    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class);
    }
    
    public function genre(): BelongsTo
    {
        return $this->belongsTo(Genre::class);
    }
}