<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $guarded = ['id'];

    // Relasi ke tabel Menu untuk mengambil nama & harga makanan
    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}
