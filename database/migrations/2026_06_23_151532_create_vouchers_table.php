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
        Schema::create('vouchers', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique(); // Kode voucher (misal: DISKON50K)
            $table->decimal('discount_amount', 10, 2); // Nominal diskon
            $table->date('valid_until')->nullable(); // Masa berlaku
            $table->integer('usage_limit')->default(1); // Kuota penggunaan voucher
            $table->integer('used_count')->default(0); // Berapa kali sudah dipakai
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vouchers');
    }
};
