<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Pengguna extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'pengguna';

    protected $fillable = [
        'nama',
        'email',
        'kata_sandi',
        'peran',
    ];

    protected $hidden = [
        'kata_sandi',
    ];

    // Relasi: pengguna bisa punya banyak pinjaman
    public function pinjaman()
    {
        return $this->hasMany(Pinjaman::class, 'pengguna_id');
    }
}
