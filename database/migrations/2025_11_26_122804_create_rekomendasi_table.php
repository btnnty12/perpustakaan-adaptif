<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rekomendasi', function (Blueprint $table) {
            $table->id(); // PK

            $table->foreignId('pengguna_id')
                  ->constrained('pengguna')
                  ->onDelete('cascade')
                  ->index();

            $table->foreignId('buku_id')
                  ->constrained('buku')
                  ->onDelete('cascade')
                  ->index();

            // Nilai rekomendasi, misal dari algoritma rekomendasi
            $table->decimal('skor_rekomendasi', 5, 2)->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rekomendasi');
    }
};
