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
                  ->onDelete('cascade')
                  ->index(); // index untuk mempercepat query

            // Relasi ke tabel buku
            $table->foreignId('buku_id')
                  ->constrained('buku')
                  ->onDelete('cascade')
                  ->index(); // index untuk mempercepat query

            // Status pinjaman
            $table->enum('status', ['daftar_keinginan', 'sedang_dibaca', 'dibaca'])
                  ->default('daftar_keinginan')
                  ->comment('daftar_keinginan → sedang_dibaca → dibaca');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pinjaman');
    }
};
