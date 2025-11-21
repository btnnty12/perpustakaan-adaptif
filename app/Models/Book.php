<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'genre',
        'description',
        'publication_year',
    ];

    // Relasi: book bisa punya banyak ratings
    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    // Relasi: book bisa punya banyak reading_history / borrowing
    public function borrowings()
    {
        return $this->hasMany(Borrowing::class);
    }
}
