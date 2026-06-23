<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = ['id'];

    // Relasi ke rincian pesanan (makanan apa saja yang dibeli)
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Relasi ke Kantin (Tenant) tempat mahasiswa memesan
    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    // Relasi ke Mahasiswa (User) yang melakukan pemesanan
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}