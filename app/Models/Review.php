<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    // Tabel 'reviews' memiliki created_at, tetapi tidak ada updated_at di skema Anda.
    public $timestamps = false;
    const CREATED_AT = 'created_at';
    
    protected $table = 'reviews';

    protected $fillable = [
        'user_id',
        'item_id',
        'rating',
        'review_text',
    ];

    /**
     * Relasi BelongsTo ke Model User.
     * Mengetahui siapa yang menulis review ini.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relasi BelongsTo ke Model Item.
     * Mengetahui item mana yang sedang diulas.
     */
    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class, 'item_id');
    }
}