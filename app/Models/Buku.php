<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    protected $table = 'buku';

    protected $fillable = [
        'judul',
        'penulis',
        'genre',
        'deskripsi',
        'tahun_terbit',
        'stok', // stok buku
    ];

    // Relasi: buku bisa punya banyak pinjaman
    public function pinjaman()
    {
        return $this->hasMany(Pinjaman::class, 'buku_id');
    }
}
