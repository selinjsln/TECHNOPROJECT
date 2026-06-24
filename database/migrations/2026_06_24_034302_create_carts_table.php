<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();

            // Relasi ke tabel users (Siapa yang punya keranjang ini?)
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            // Relasi ke tabel menus (Makanan apa yang dimasukkan?)
            $table->foreignId('menu_id')->constrained('menus')->onDelete('cascade');

            // Jumlah pesanan (default-nya 1)
            $table->integer('quantity')->default(1);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};