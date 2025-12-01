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

            // Relasi pengguna
            $table->foreignId('pengguna_id')
                  ->constrained('pengguna')
                  ->onDelete('cascade');

            // Relasi buku
            $table->foreignId('buku_id')
                  ->constrained('buku')
                  ->onDelete('cascade');

            // Status konsisten dengan controller
            $table->enum('status', ['wishlist', 'sedang_dipinjam', 'dikembalikan'])
                  ->default('wishlist')
                  ->comment('wishlist → sedang_dipinjam → dikembalikan');

            $table->timestamps();

            // $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pinjaman');
    }
};
