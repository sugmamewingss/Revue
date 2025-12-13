<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ItemGenre extends Pivot 
{
    public $timestamps = false;
    protected $table = 'item_genres';

    protected $fillable = [
        'item_id',
        'genre_id',
    ];

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class);
    }
    
    public function genre(): BelongsTo
    {
        return $this->belongsTo(Genre::class);
    }
}