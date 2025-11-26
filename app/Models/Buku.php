<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Buku extends Model
{
    use HasFactory;
    // Jika memakai soft delete di migration
    // use SoftDeletes;

    protected $table = 'buku';

    protected $fillable = [
        'judul',
        'penulis',
        'genre',
        'deskripsi',
        'tahun_terbit',
        'stok',
    ];

    // Cast agar angka otomatis jadi integer
    protected $casts = [
        'tahun_terbit' => 'integer',
        'stok' => 'integer',
    ];

    // Relasi: satu buku banyak dipinjam
    public function pinjaman()
    {
        return $this->hasMany(Pinjaman::class, 'buku_id');
    }
}
