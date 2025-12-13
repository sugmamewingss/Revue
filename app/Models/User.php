<?php

namespace App\Models;

<<<<<<< Updated upstream
=======
use Illuminate\Database\Eloquent\Factories\HasFactory;
>>>>>>> Stashed changes
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\UserList;
use App\Models\Item;

class User extends Authenticatable
{
<<<<<<< Updated upstream
    use Notifiable;
=======
    use HasFactory, Notifiable;
>>>>>>> Stashed changes

    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

<<<<<<< Updated upstream
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function reviews()
=======
    protected function casts(): array
>>>>>>> Stashed changes
    {
        return $this->hasMany(Review::class);
    }

<<<<<<< Updated upstream
    public function isAdmin()
    {
        return $this->role === 'admin';
    }
}
=======
    public function myList()
    {
        return $this->hasMany(UserList::class, 'user_id');
    }

    public function myListItems()
    {
        return $this->belongsToMany(
            Item::class,
            'user_lists',
            'user_id',
            'item_id'
        )->withPivot(['status', 'personal_score'])
         ->withTimestamps();
    }
}
>>>>>>> Stashed changes
