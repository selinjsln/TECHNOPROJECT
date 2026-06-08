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
        Schema::create('menus', function (Blueprint $table) {
            $table->id();

            // Relasi ke kantin siapa menu ini milik (Menyambung ke tabel tenants)
            $table->foreignId('tenant_id')->constrained('tenants')->onDelete('cascade');

            $table->string('nama_menu');
            $table->text('deskripsi')->nullable();
            $table->integer('harga');
            $table->string('foto')->nullable(); // Untuk menyimpan nama file foto
            $table->boolean('is_available')->default(true); // Status Ada/Habis

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
