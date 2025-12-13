<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\UserList;
use App\Models\Item;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

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

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

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
