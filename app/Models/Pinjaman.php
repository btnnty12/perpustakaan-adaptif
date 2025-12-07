<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class Pinjaman extends Model
{
    use HasFactory;
    // use SoftDeletes;

    protected $table = 'pinjaman';

    protected $fillable = [
        'pengguna_id',
        'buku_id',
        'status',
    ];

    protected $casts = [
        'status' => 'string',
    ];

    // Eager load otomatis (opsional)
    // protected $with = ['pengguna', 'buku'];

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
