<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Item extends Model
{
    use HasFactory;

    protected $table = 'items';
    public $timestamps = false;
    
    protected $fillable = [
        'title',                
        'type', 
        'author_or_director',
        'release_year',
        'cover_image',          
        'description',
    ];

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class, 'item_id');
    }
    
    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(Genre::class, 'item_genres', 'item_id', 'genre_id');
    }

    public function userLists(): HasMany
    {
        return $this->hasMany(UserList::class, 'item_id');
    }

    public function savedByUsers()
{
    return $this->belongsToMany(
        User::class,
        'user_lists',
        'item_id',
        'user_id'
    )->withPivot(['status', 'personal_score'])
     ->withTimestamps();
    }
}