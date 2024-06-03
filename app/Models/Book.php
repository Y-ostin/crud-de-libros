<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'author', 'publication_year', 'synopsis', 'cover_url', 'status'];

    // Relación con el usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}