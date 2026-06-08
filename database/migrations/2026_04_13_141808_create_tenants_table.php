<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tenants', function (Blueprint $table) {
            $table->id();

            // Relasi ke tabel users (Siapa pemilik kantin ini?)
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            // Data Profil Kantin
            $table->string('nama_kantin');
            $table->string('universitas'); // Contoh: "Universitas Kristen Petra"
            $table->string('lokasi_gedung'); // Contoh: "Gedung P (P1)"
            $table->string('deskripsi')->nullable(); // Contoh: "Nasi Campur, Soto..."
            $table->boolean('is_open')->default(true); // Status Buka/Tutup
            $table->string('foto')->nullable(); // URL/Nama file foto kantin

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tenants');
    }
};
