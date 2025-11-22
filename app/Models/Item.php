<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'title',
        'type',
        'author_or_director',
        'release_year',
        'cover_image',
        'description',
    ];

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'item_genres');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function averageRating()
    {
        return $this->reviews()->avg('rating');
    }

    public function totalReviews()
    {
        return $this->reviews()->count();
    }
}