<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tenant;
use Illuminate\Support\Facades\Auth;

class TenantController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nama_kantin' => 'required|string|max:255',
            'universitas' => 'required|string',
            'lokasi_gedung' => 'required|string',
            'deskripsi' => 'nullable|string',
        ]);

        // Simpan atau update profil kantin milik user yang sedang login
        Tenant::updateOrCreate(
            ['user_id' => Auth::id()],
            [
                'nama_kantin' => $request->nama_kantin,
                'universitas' => $request->universitas,
                'lokasi_gedung' => $request->lokasi_gedung,
                'deskripsi' => $request->deskripsi,
                'is_open' => true,
            ]
        );

        return back()->with('success', 'Profil kantin berhasil diperbarui!');
    }
}