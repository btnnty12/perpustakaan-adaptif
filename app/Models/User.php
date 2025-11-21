<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory;

    // Kolom yang bisa diisi massal
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    // Kolom yang disembunyikan saat serialisasi
    protected $hidden = [
        'password',
    ];

    // Relasi ke ratings
    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    // Relasi ke borrowings / reading_history
    public function borrowings()
    {
        return $this->hasMany(Borrowing::class);
    }

    // Relasi ke search_logs
    public function searchLogs()
    {
        return $this->hasMany(SearchLog::class);
    }

    // Relasi ke recommendations
    public function recommendations()
    {
        return $this->hasMany(Recommendation::class);
    }
}
