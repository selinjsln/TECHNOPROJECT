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
       Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Mahasiswa yang beli
            $table->foreignId('tenant_id')->constrained('tenants')->onDelete('cascade'); // Beli di kantin mana
            $table->foreignId('voucher_id')->nullable()->constrained('vouchers')->onDelete('set null'); // Voucher yang dipakai (kalau ada)
            
            // Rincian Biaya
            $table->decimal('subtotal', 10, 2); // Total harga makanan saja
            $table->decimal('admin_fee', 10, 2)->default(3000); // Biaya layanan aplikasimu
            $table->decimal('discount', 10, 2)->default(0); // Potongan harga
            $table->decimal('grand_total', 10, 2); // Uang yang harus dibayar mahasiswa
            
            // Status Transaksi
            $table->enum('payment_status', ['pending', 'paid', 'failed'])->default('pending'); // Status bayar QRIS
            $table->enum('order_status', ['pending', 'processing', 'ready', 'completed', 'cancelled'])->default('pending'); // Status makanan
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
