<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('buku', function (Blueprint $table) {
            $table->id(); // id INT PK AI
            $table->string('judul');
            $table->string('penulis');
            $table->string('genre')->nullable();
            $table->text('deskripsi')->nullable();
            $table->integer('tahun_terbit')->nullable();
            $table->integer('stok')->default(0);
            $table->timestamps(); // created_at & updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('buku');
    }
};
