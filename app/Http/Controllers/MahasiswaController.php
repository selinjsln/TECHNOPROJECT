<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Universitas;
use App\Models\Tenant;
use Illuminate\Support\Facades\Auth;

class MahasiswaController extends Controller
{
    // Fungsi untuk menampilkan halaman Home Mahasiswa
    public function home(Request $request)
    {
        // 1. Ambil data user yang sedang login
        $user = Auth::user();

        // 2. Ambil semua daftar universitas untuk dropdown
        $universitas = Universitas::all();

        // 3. Tangkap ID universitas yang dipilih (Default: 1 untuk Petra)
        $univ_id = $request->query('univ_id', 1);

        // 4. Cari kantin yang berlokasi di universitas tersebut
        $daftar_kantin = Tenant::where('universitas', $univ_id)->get();

        // 5. Kirim semua data ke halaman home-mahasiswa.blade.php
        return view('home-mahasiswa', compact('user', 'universitas', 'daftar_kantin'));
    }
}