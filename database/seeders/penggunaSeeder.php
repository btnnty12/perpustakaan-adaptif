<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class penggunaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    \App\Models\Pengguna::create([
        'nama' => 'Admin Perpustakaan',
        'email' => 'admin@mail.com',
        'kata_sandi' => bcrypt('password'),
        'peran' => 'admin'
    ]);

    \App\Models\Pengguna::create([
        'nama' => 'Member Satu',
        'email' => 'member1@mail.com',
        'kata_sandi' => bcrypt('password'),
        'peran' => 'pengguna'
    ]);
    }
}
