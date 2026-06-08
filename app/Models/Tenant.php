<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['user_id', 'nama_kantin', 'universitas', 'lokasi_gedung', 'deskripsi', 'is_open'])]
class Tenant extends Model
{
    // Relasi balik ke User (Satu kantin dimiliki satu user)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // 1 Tenant punya Banyak Menu
    public function menus()
    {
        return $this->hasMany(Menu::class);
    }
}