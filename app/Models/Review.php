<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'user_id',
        'item_id',
        'rating',
        'review_text',
    ];

<<<<<<< Updated upstream
    public function user()
=======
    public function user(): BelongsTo
>>>>>>> Stashed changes
    {
        return $this->belongsTo(User::class);
    }

<<<<<<< Updated upstream
    public function item()
=======
    public function item(): BelongsTo
>>>>>>> Stashed changes
    {
        return $this->belongsTo(Item::class);
    }
}