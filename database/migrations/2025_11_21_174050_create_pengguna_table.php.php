<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengguna', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('email', 191)->unique();
            $table->string('katasandi');

            $table->enum('peran', ['admin', 'anggota', 'staff'])
                  ->default('anggota');

            $table->timestamps(); 
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengguna');
    }
};
