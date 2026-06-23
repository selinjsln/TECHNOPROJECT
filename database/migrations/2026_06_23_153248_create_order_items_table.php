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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade'); // Terhubung ke nota mana
            $table->foreignId('menu_id')->constrained('menus')->onDelete('cascade'); // Menu apa yang dibeli
            
            $table->integer('quantity'); // Beli berapa porsi
            $table->decimal('price', 10, 2); // Harga per porsi (disimpan agar kalau harga menu berubah, nota lama tidak ikut berubah)
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
