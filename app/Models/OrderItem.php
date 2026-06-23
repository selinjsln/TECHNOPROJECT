<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $guarded = ['id'];

    // Relasi ke tabel Menu untuk mengambil nama menu dan fotonya
    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
    
    // Relasi kembali ke nota utama
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}