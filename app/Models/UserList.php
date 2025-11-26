<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserList extends Model
{
    // Tabel ini memiliki created_at dan updated_at
    protected $table = 'user_lists';

    protected $fillable = [
        'user_id',
        'item_id',
        'status', // Planning, On-Going, Completed, Dropped
        'personal_score',
    ];

    /**
     * Relasi BelongsTo ke Model User.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relasi BelongsTo ke Model Item.
     */
    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class, 'item_id');
    }
}