<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pinjaman', function (Blueprint $table) {
            $table->id();

            // Relasi ke tabel pengguna
            $table->foreignId('pengguna_id')
                  ->constrained('pengguna')
                  ->onDelete('cascade');

            // Relasi ke tabel buku
            $table->foreignId('buku_id')
                  ->constrained('buku')
                  ->onDelete('cascade');

            // Status pinjaman
            $table->enum('status', ['dibaca', 'sedang_dibaca', 'daftar_keinginan'])
                  ->default('daftar_keinginan');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pinjaman');
    }
};
