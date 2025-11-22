<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    public $timestamps = false;
    protected $fillable = ['name'];

    public function items()
    {
        return $this->belongsToMany(Item::class, 'item_genres');
    }
}