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
        'katasandi',  
        'peran',
    ];

    protected $hidden = [
        'katasandi',
        'remember_token',
    ];

    /**
     * Override agar Laravel menggunakan 'katasandi'
     * sebagai kolom password untuk login.
     */
    public function getAuthPassword()
    {
        return $this->katasandi;
    }

    /**
     * Mutator untuk meng-hash katasandi otomatis
     * saat diset dari controller atau seeder.
     */
    public function setKatasandiAttribute($value)
    {
        $this->attributes['katasandi'] = bcrypt($value);
    }

    // ======================
    //       RELASI
    // ======================
    public function pinjaman()
    {
        return $this->hasMany(Pinjaman::class, 'pengguna_id');
    }

    // ======================
    //     HELPER ROLE
    // ======================
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
