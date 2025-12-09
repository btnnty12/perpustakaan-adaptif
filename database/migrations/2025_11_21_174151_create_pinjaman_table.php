<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pinjaman', function (Blueprint $table) {
            $table->date('tanggal_pinjam')->nullable()->after('buku_id');
            $table->date('tanggal_jatuh_tempo')->nullable()->after('tanggal_pinjam');
            $table->date('tanggal_kembali')->nullable()->after('tanggal_jatuh_tempo');
            $table->decimal('denda', 10, 2)->nullable()->after('tanggal_kembali');
        });
    }

    public function down(): void
    {
        Schema::table('pinjaman', function (Blueprint $table) {
            $table->dropColumn([
                'tanggal_pinjam',
                'tanggal_jatuh_tempo',
                'tanggal_kembali',
                'denda'
            ]);
        });
    }
};