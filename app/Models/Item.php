<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
<<<<<<< Updated upstream
=======
    use HasFactory;

    protected $table = 'items';
    public $timestamps = false;
    
>>>>>>> Stashed changes
    protected $fillable = [
        'title',
        'type',
        'author_or_director',
        'release_year',
        'cover_image',
        'description',
    ];

<<<<<<< Updated upstream
    public function genres()
=======
    public function reviews(): HasMany
>>>>>>> Stashed changes
    {
        return $this->belongsToMany(Genre::class, 'item_genres');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

<<<<<<< Updated upstream
    public function averageRating()
    {
        return $this->reviews()->avg('rating');
    }

    public function totalReviews()
    {
        return $this->reviews()->count();
=======
    public function savedByUsers()
{
    return $this->belongsToMany(
        User::class,
        'user_lists',
        'item_id',
        'user_id'
    )->withPivot(['status', 'personal_score'])
     ->withTimestamps();
>>>>>>> Stashed changes
    }
}