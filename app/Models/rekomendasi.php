<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rekomendasi extends Model
{
    use HasFactory;

    protected $table = 'rekomendasi';

    protected $fillable = [
        'pengguna_id',
        'buku_id',
        'skor_rekomendasi',
    ];

    protected $casts = [
        'skor_rekomendasi' => 'float', // agar auto jadi float
    ];

    // Relasi ke pengguna
    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'pengguna_id');
    }

    // Relasi ke buku
    public function buku()
    {
        return $this->belongsTo(Buku::class, 'buku_id');
    }
}
