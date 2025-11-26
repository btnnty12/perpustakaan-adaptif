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

    // Agar Laravel authentication membaca 'kata_sandi' sebagai password
    public function getAuthPassword()
    {
        return $this->kata_sandi;
    }

    // Mutator otomatis hashing password
    public function setKataSandiAttribute($value)
    {
        $this->attributes['kata_sandi'] = bcrypt($value);
    }

    // Relasi: 1 pengguna punya banyak pinjaman
    public function pinjaman()
    {
        return $this->hasMany(Pinjaman::class, 'pengguna_id');
    }

    // Helper role
    public function isAdmin()
    {
        return $this->peran === 'admin';
    }

    public function isStaff()
    {
        return $this->peran === 'staff';
    }

    public function isAnggota()
    {
        return $this->peran === 'anggota';
    }
}
