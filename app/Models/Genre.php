<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    public $timestamps = false;
    protected $fillable = ['name'];

<<<<<<< Updated upstream
    public function items()
    {
        return $this->belongsToMany(Item::class, 'item_genres');
    }
=======
    protected $table = 'genres';

    protected $fillable = [
        'name',
    ];
public function items()
{
    return $this->belongsToMany(Item::class, 'item_genres', 'genre_id', 'item_id');
}

    public $timestamps = false; 
>>>>>>> Stashed changes
}