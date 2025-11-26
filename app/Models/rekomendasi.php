<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rekomendasi extends Model
{
    protected $table = 'rekomendasi';

    protected $fillable = [
        'pengguna_id',
        'buku_id',
        'skor_rekomendasi',
    ];

    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'pengguna_id');
    }

    public function buku()
    {
        return $this->belongsTo(Buku::class, 'buku_id');
    }
}
