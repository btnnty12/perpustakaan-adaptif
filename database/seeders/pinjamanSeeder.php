<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class pinjamanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    \App\Models\Pinjaman::create([
        'pengguna_id' => 1,
        'buku_id' => 1,
        'status' => 'dibaca'
    ]);

    \App\Models\Pinjaman::create([
        'pengguna_id' => 2,
        'buku_id' => 2,
        'status' => 'sedang_dibaca'
    ]);
    }
}
