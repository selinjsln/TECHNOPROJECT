<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    // Ini adalah kunci agar form bisa menyimpan data ke kolom-kolom ini
    protected $fillable = [
        'tenant_id',
        'nama_menu',
        'deskripsi',
        'harga',
        'foto',
        'is_available'
    ];

    // Relasi balik ke Tenant
    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }
}