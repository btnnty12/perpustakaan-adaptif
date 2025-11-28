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
        'remember_token',
    ];

    /**
     * Gunakan kolom kata_sandi untuk autentikasi
     */
    public function getAuthPassword()
    {
        return $this->kata_sandi;
    }

    /**
     * Mutator hash password otomatis
     */
    public function setKataSandiAttribute($value)
    {
        $this->attributes['kata_sandi'] = bcrypt($value);
    }

    // RELASI
    public function pinjaman()
    {
        return $this->hasMany(Pinjaman::class, 'pengguna_id');
    }

    // HELPER ROLE
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
