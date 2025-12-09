<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rekomendasi', function (Blueprint $table) {
            $table->id();

            // Relasi ke tabel pengguna
            $table->foreignId('pengguna_id')
                  ->constrained('pengguna')
                  ->onDelete('cascade')
                  ->index();

            // Relasi ke tabel buku
            $table->foreignId('buku_id')
                  ->constrained('buku')
                  ->onDelete('cascade')
                  ->index();

            // Skor dapat berupa desimal (misal KNN similarity)
            $table->decimal('skor_rekomendasi', 5, 2)->nullable();

            $table->timestamps();

            // UNIQUE agar tidak ada rekomendasi ganda untuk user yang sama
            $table->unique(['pengguna_id', 'buku_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rekomendasi');
    }
};
