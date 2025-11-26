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

            $table->foreignId('pengguna_id')
                  ->constrained('pengguna')
                  ->onDelete('cascade');

            $table->foreignId('buku_id')
                  ->constrained('buku')
                  ->onDelete('cascade');

            $table->decimal('skor_rekomendasi', 5, 2)->nullable();

            $table->timestamps();

            // Cegah rekomendasi duplikat
            $table->unique(['pengguna_id', 'buku_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rekomendasi');
    }
};
