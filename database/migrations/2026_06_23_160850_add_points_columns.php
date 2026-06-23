<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Tambah kolom poin di tabel users (mahasiswa)
        Schema::table('users', function (Blueprint $table) {
            $table->integer('points')->default(0);
        });

        // Tambah kolom untuk mencatat berapa poin yang dipakai di nota
        Schema::table('orders', function (Blueprint $table) {
            $table->integer('points_used')->default(0)->after('discount');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('points');
        });
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('points_used');
        });
    }
};
