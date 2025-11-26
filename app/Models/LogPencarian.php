<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogPencarian extends Model
{
    protected $table = 'log_pencarian';

    protected $fillable = [
        'pengguna_id',
        'kata_kunci',
        'jumlah_hasil',
    ];

    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'pengguna_id');
    }
}
