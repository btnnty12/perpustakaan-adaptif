<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('log_pencarian', function (Blueprint $table) {
            $table->id(); // PK

            $table->foreignId('pengguna_id')
                  ->constrained('pengguna')
                  ->onDelete('cascade');

            $table->string('kata_kunci');
            $table->integer('jumlah_hasil')->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('log_pencarian');
    }
};
