<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // PROSES SIGN UP
    public function register(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'nomor_telepon' => 'required|string|max:20',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:mahasiswa,tenant',
        ]);

        $user = User::create([
            'name' => $request->nama_lengkap,
            'email' => $request->email,
            'nomor_telepon' => $request->nomor_telepon,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        Auth::login($user);

        return redirect('/login')->with('success', 'Akun berhasil dibuat! Silakan login.');
    }

    // PROSES LOGIN
    // app/Http/Controllers/AuthController.php

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();

            if ($user->role === 'mahasiswa') {
                return redirect()->intended('/home-mahasiswa');
            }

            if ($user->role === 'tenant') {
                // CEK: Apakah sudah ada profil kantin di database?
                $tenant = \App\Models\Tenant::where('user_id', $user->id)->first();

                if (!$tenant) {
                    // Jika belum punya profil, wajib setup dulu
                    return redirect('/setup-tenant');
                }

                return redirect()->intended('/home-tenant');
            }
        }

        return back()->withErrors(['email' => 'Email atau password salah.'])->withInput();
    }
}