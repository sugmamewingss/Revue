<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;

    protected $table = 'genres';

    /**
     * Atribut yang dapat diisi secara massal (Mass Assignable).
     * Kolom 'name' wajib ada untuk fungsi create() di AdminController.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    // Karena tabel genres di skema Anda tidak memiliki kolom created_at atau updated_at
    public $timestamps = false; 
}