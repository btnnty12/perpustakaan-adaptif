<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengguna', function (Blueprint $table) {
            $table->id(); // id INT PK AUTO_INCREMENT
            $table->string('nama');
            $table->string('email')->unique();
            $table->string('kata_sandi');

            // Peran pengguna, ditambahkan 'staff'
            $table->enum('peran', ['admin', 'anggota', 'staff'])->default('anggota');

            // Timestamp
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')
                  ->useCurrent()
                  ->useCurrentOnUpdate();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengguna');
    }
};
