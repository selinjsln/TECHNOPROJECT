<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TenantController;
use App\Models\Universitas;
use App\Models\Tenant;
use App\Models\Menu;

// ==============================================
// 1. RUTE AUTHENTICATION (LOGIN & REGISTER)
// ==============================================

// Kalau ada yang buka web pertama kali (/), langsung arahkan ke /login
Route::get('/', function () {
    return redirect('/login');
});

// Tampilkan halaman HTML Login di alamat /login
Route::get('/login', function () {
    return view('login');
})->name('login');

// Proses form submit (POST)
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

// Rute untuk Logout
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');


// ==========================================
// RUTE MAHASISWA
// ==========================================

// --- HOME MAHASISWA ---
Route::get('/home-mahasiswa', function () {
    if (!Auth::check() || Auth::user()->role !== 'mahasiswa')
        return redirect('/login');

    $user = Auth::user(); // Ambil data mahasiswa yang lagi login
    $daftar_kantin = App\Models\Tenant::all(); // Ambil semua data kantin

    return view('home-mahasiswa', compact('user', 'daftar_kantin')); // Kirim datanya ke view
})->name('mahasiswa.home');

// --- CART MAHASISWA ---
Route::get('/cart-mahasiswa', function () {
    if (!Auth::check() || Auth::user()->role !== 'mahasiswa')
        return redirect('/login');

    $user = Auth::user();
    return view('cart-mahasiswa', compact('user'));
})->name('mahasiswa.cart');

// --- ORDER MAHASISWA ---
Route::get('/order-mahasiswa', function () {
    if (!Auth::check() || Auth::user()->role !== 'mahasiswa')
        return redirect('/login');

    $user = Auth::user();
    return view('order-mahasiswa', compact('user'));
})->name('mahasiswa.order');

// --- PROFILE MAHASISWA ---
Route::get('/profile-mahasiswa', function () {
    if (!Auth::check() || Auth::user()->role !== 'mahasiswa')
        return redirect('/login');

    $user = Auth::user(); // Ambil data mahasiswa yang lagi login
    return view('profile-mahasiswa', compact('user')); // Kirim datanya ke view
})->name('mahasiswa.profile');


// ==============================================
// 3. RUTE TENANT
// ==============================================

// --- SETUP KANTIN (ONBOARDING) ---
Route::get('/setup-tenant', function () {
    if (!Auth::check() || Auth::user()->role !== 'tenant') {
        return redirect('/login');
    }

    // Kalau ternyata sudah punya kantin, usir ke Home Tenant
    if (Tenant::where('user_id', Auth::id())->exists()) {
        return redirect('/home-tenant');
    }

    $universitas = Universitas::all();
    return view('setup-tenant', compact('universitas'));
})->name('tenant.setup');

// Proses simpan data setup kantin
Route::post('/setup-tenant', function (Request $request) {
    $request->validate([
        'nama_kantin' => 'required',
        'universitas' => 'required',
        'lokasi_gedung' => 'required',
    ]);

    Tenant::create([
        'user_id' => Auth::id(),
        'nama_kantin' => $request->nama_kantin,
        'universitas' => $request->universitas,
        'lokasi_gedung' => $request->lokasi_gedung,
        'deskripsi' => $request->deskripsi,
        'is_open' => true,
    ]);

    return redirect('/home-tenant')->with('success', 'Kantin berhasil dibuka!');
})->name('tenant.setup.store');


// --- DASHBOARD TENANT (CANTEEN) ---
Route::get('/home-tenant', function () {
    if (!Auth::check() || Auth::user()->role !== 'tenant') {
        return redirect('/login');
    }

    // CEK: Punya kantin ga? Kalau belum, paksa ke halaman setup!
    $tenant = Tenant::where('user_id', Auth::id())->first();
    if (!$tenant) {
        return redirect('/setup-tenant');
    }

    $menus = Menu::where('tenant_id', $tenant->id)->get();
    return view('home-tenant', [
        'user' => Auth::user(),
        'tenant' => $tenant,
        'menus' => $menus
    ]);
})->name('tenant.home');


// --- ORDER TENANT ---
Route::get('/order-tenant', function () {
    if (!Auth::check() || Auth::user()->role !== 'tenant') {
        return redirect('/login');
    }
    return view('order-tenant');
})->name('tenant.order');


// --- PROFILE TENANT ---
Route::get('/profile-tenant', function () {
    if (!Auth::check() || Auth::user()->role !== 'tenant') {
        return redirect('/login');
    }

    $user = Auth::user();
    $tenant = Tenant::where('user_id', $user->id)->first();

    return view('profile-tenant', compact('user', 'tenant'));
})->name('tenant.profile');

// Proses Simpan Menu Baru
// Proses Simpan Menu Baru (Dengan Upload Foto)
Route::post('/tambah-menu', function (Illuminate\Http\Request $request) {
    // 1. Validasi inputan dengan Pesan Bahasa Indonesia
    $request->validate([
        'nama_menu' => 'required',
        'harga' => 'required|numeric',
        'deskripsi' => 'nullable',
        'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
    ], [
        'nama_menu.required' => 'Nama menu wajib diisi!',
        'harga.required' => 'Harga wajib diisi!',
        'foto.max' => 'Ukuran foto kegedean! Maksimal 2MB ya.',
        'foto.image' => 'File yang diupload harus berupa gambar (JPG/PNG).',
        'foto.mimes' => 'Format gambar harus JPEG, PNG, atau JPG.'
    ]);

    $tenant = App\Models\Tenant::where('user_id', Auth::id())->first();

    // 2. Logika Upload Foto
    $fotoPath = null;
    if ($request->hasFile('foto')) {
        $fotoPath = $request->file('foto')->store('menus', 'public');
    }

    // 3. Simpan ke database
    App\Models\Menu::create([
        'tenant_id' => $tenant->id,
        'nama_menu' => $request->nama_menu,
        'harga' => $request->harga,
        'deskripsi' => $request->deskripsi,
        'foto' => $fotoPath,
        'is_available' => true,
    ]);

    return redirect()->back()->with('success', 'Menu baru berhasil ditambahkan! 🍗');
})->name('tenant.menu.store');

// Proses Edit Menu
Route::post('/edit-menu/{id}', function (Illuminate\Http\Request $request, $id) {
    $request->validate([
        'nama_menu' => 'required',
        'harga' => 'required|numeric',
        'deskripsi' => 'nullable',
        'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
    ], [
        'nama_menu.required' => 'Nama menu wajib diisi!',
        'harga.required' => 'Harga wajib diisi!',
        'foto.max' => 'Ukuran foto kegedean! Maksimal 2MB ya.'
    ]);

    // Cari menu yang mau diedit (pastikan itu milik tenant yang lagi login)
    $tenant = App\Models\Tenant::where('user_id', Auth::id())->first();
    $menu = App\Models\Menu::where('id', $id)->where('tenant_id', $tenant->id)->firstOrFail();

    // Update data teks
    $menu->nama_menu = $request->nama_menu;
    $menu->harga = $request->harga;
    $menu->deskripsi = $request->deskripsi;

    // Update foto HANYA jika tenant mengupload foto baru
    if ($request->hasFile('foto')) {
        $fotoPath = $request->file('foto')->store('menus', 'public');
        $menu->foto = $fotoPath;
    }

    $menu->save();

    return redirect()->back()->with('success', 'Data menu berhasil diupdate! ✏️');
})->name('tenant.menu.update');

// Toggle Stok Makanan (Langsung simpan tanpa loading)
Route::post('/toggle-stok/{id}', function ($id) {
    $menu = App\Models\Menu::find($id);
    if ($menu) {
        $menu->is_available = !$menu->is_available;
        $menu->save();
        return response()->json(['success' => true]);
    }
    return response()->json(['success' => false]);
});

// Toggle Buka/Tutup Kantin Utama (Langsung simpan tanpa loading)
Route::post('/toggle-kantin', function () {
    $tenant = App\Models\Tenant::where('user_id', Auth::id())->first();
    if ($tenant) {
        $tenant->is_open = !$tenant->is_open;
        $tenant->save();
        return response()->json(['success' => true]);
    }
});

// --- INCOME TENANT ---
Route::get('/income-tenant', function () {
    if (!Auth::check() || Auth::user()->role !== 'tenant') {
        return redirect('/login');
    }
    return view('income-tenant');
})->name('tenant.income');

// --- HALAMAN METODE PEMBAYARAN (QRIS) ---
Route::get('/profile-tenant/payment', function () {
    if (!Auth::check() || Auth::user()->role !== 'tenant') return redirect('/login');
    $tenant = App\Models\Tenant::where('user_id', Auth::id())->first();
    return view('payment-tenant', compact('tenant'));
})->name('tenant.payment');

// Proses Simpan QRIS
Route::post('/profile-tenant/payment', function (Illuminate\Http\Request $request) {
    $request->validate([
        'qris_foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        'keterangan_bank' => 'nullable|string'
    ], [
        'qris_foto.image' => 'File harus berupa gambar (JPG/PNG)!',
        'qris_foto.max' => 'Ukuran QRIS maksimal 2MB ya.'
    ]);

    $tenant = App\Models\Tenant::where('user_id', Auth::id())->first();

    if ($request->hasFile('qris_foto')) {
        $fotoPath = $request->file('qris_foto')->store('qris', 'public');
        $tenant->qris_foto = $fotoPath;
    }
    
    $tenant->keterangan_bank = $request->keterangan_bank;
    $tenant->save();

    return redirect()->route('tenant.profile')->with('success', 'Metode pembayaran berhasil diupdate! 💳');
})->name('tenant.payment.update');

// --- DETAIL KANTIN (MENU LIST) ---
Route::get('/kantin/{id}', function ($id) {
    if (!Auth::check() || Auth::user()->role !== 'mahasiswa')
        return redirect('/login');

    $kantin = App\Models\Tenant::findOrFail($id);
    // Ambil menu yang stoknya tersedia saja
    $menus = App\Models\Menu::where('tenant_id', $id)->where('is_available', true)->get();

    return view('detail-kantin-mahasiswa', compact('kantin', 'menus'));
});