<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        // Ubah kolom ke VARCHAR sementara untuk memungkinkan update data
        DB::statement("ALTER TABLE pengguna MODIFY COLUMN peran VARCHAR(20) NOT NULL DEFAULT 'pengguna'");
        
        // Update nilai 'anggota' menjadi 'pengguna'
        DB::table('pengguna')
            ->where('peran', 'anggota')
            ->update(['peran' => 'pengguna']);
        
        // Ubah kolom `peran` kembali ke ENUM dengan nilai baru
        DB::statement("ALTER TABLE pengguna MODIFY COLUMN peran ENUM('admin','pengguna','staff') NOT NULL DEFAULT 'pengguna'");
    }

    public function down(): void
    {
        // Kembalikan ke tipe yang lebih umum jika rollback (VARCHAR agar aman)
        DB::statement("ALTER TABLE pengguna MODIFY COLUMN peran VARCHAR(20) NOT NULL DEFAULT 'pengguna'");
    }
};