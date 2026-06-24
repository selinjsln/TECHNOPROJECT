<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\CheckoutController;
use App\Models\Universitas;
use App\Models\Tenant;
use App\Models\Order;
use App\Models\Menu;
use App\Models\Cart;

// ==============================================
// 1. RUTE AUTHENTICATION (LOGIN & REGISTER)
// ==============================================
Route::get('/', function () { return redirect('/login'); });
Route::get('/login', function () { return view('login'); })->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');

// ==========================================
// RUTE MAHASISWA
// ==========================================
Route::get('/home-mahasiswa', [MahasiswaController::class, 'home'])->name('mahasiswa.home');

Route::get('/profile-mahasiswa', function () {
    if (!Auth::check() || Auth::user()->role !== 'mahasiswa') return redirect('/login');
    $user = Auth::user();
    return view('profile-mahasiswa', compact('user'));
})->name('mahasiswa.profile');

Route::get('/order-mahasiswa', function () {
    if (!Auth::check() || Auth::user()->role !== 'mahasiswa') return redirect('/login');
    $user = Auth::user();
    $orders = App\Models\Order::with(['tenant', 'orderItems.menu'])
                ->where('user_id', $user->id)
                ->orderBy('created_at', 'desc')
                ->get();
    return view('order-mahasiswa', compact('user', 'orders'));
})->name('mahasiswa.order');

// --- KERANJANG & PEMBAYARAN MAHASISWA ---

// 1. Rute Tambah ke Keranjang (INI YANG KEMARIN HILANG)
Route::post('/cart-mahasiswa/add', function (Request $request) {
    $request->validate(['menu_id' => 'required|exists:menus,id', 'quantity' => 'required|integer|min:1']);
    $cart = Cart::where('user_id', Auth::id())->where('menu_id', $request->menu_id)->first();
    if ($cart) {
        $cart->quantity += $request->quantity;
        $cart->save();
    } else {
        Cart::create(['user_id' => Auth::id(), 'menu_id' => $request->menu_id, 'quantity' => $request->quantity]);
    }
    return back()->with('success', 'Makanan berhasil ditambahkan ke keranjang! 🛒');
})->name('mahasiswa.cart.add');

// 2. Rute Tampil Keranjang
Route::get('/cart-mahasiswa', function () {
    if (!Auth::check() || Auth::user()->role !== 'mahasiswa') return redirect('/login');
    $user = Auth::user();
    $cartItems = Cart::with('menu')->where('user_id', $user->id)->get();
    
    $subtotal = 0;
    foreach ($cartItems as $item) {
        $subtotal += $item->quantity * $item->menu->harga;
    }

    $adminFee = 3000;
    $discount = session()->has('applied_voucher') ? session('applied_voucher')['discount'] : 0;
    $userPoints = $user->points;
    $usePoints = session('use_points', false);
    $pointsUsed = 0;

    $foodTotalAfterDiscount = max(0, $subtotal - $discount);
    $grandTotal = $foodTotalAfterDiscount + $adminFee;

    if ($usePoints && $userPoints > 0) {
        $pointsUsed = min($userPoints, $grandTotal);
        $grandTotal -= $pointsUsed;
    } else {
        session(['use_points' => false]);
    }

    return view('cart-mahasiswa', compact('user', 'cartItems', 'subtotal', 'adminFee', 'discount', 'grandTotal', 'userPoints', 'usePoints', 'pointsUsed'));
})->name('mahasiswa.cart');

// 3. Rute Update Porsi (+ dan -)
Route::post('/cart-mahasiswa/update/{id}', function (Request $request, $id) {
    $cart = Cart::where('id', $id)->where('user_id', Auth::id())->first();
    if ($cart) {
        if ($request->action == 'increase') {
            $cart->quantity += 1;
            $cart->save();
        } elseif ($request->action == 'decrease') {
            if ($cart->quantity > 1) {
                $cart->quantity -= 1;
                $cart->save();
            } else {
                $cart->delete();
            }
        }
    }
    return back();
})->name('mahasiswa.cart.update');

Route::post('/cart-mahasiswa/apply-voucher', [CheckoutController::class, 'applyVoucher'])->name('mahasiswa.apply_voucher');
Route::post('/cart-mahasiswa/toggle-points', function () { session(['use_points' => !session('use_points', false)]); return back(); })->name('mahasiswa.toggle_points');
Route::post('/cart-mahasiswa/process-payment', [CheckoutController::class, 'processPayment'])->name('mahasiswa.process_payment');

Route::get('/kantin/{id}', function ($id) {
    if (!Auth::check() || Auth::user()->role !== 'mahasiswa') return redirect('/login');
    $kantin = App\Models\Tenant::findOrFail($id);
    $menus = App\Models\Menu::where('tenant_id', $id)->where('is_available', true)->get();
    return view('detail-kantin-mahasiswa', compact('kantin', 'menus'));
});


// ==============================================
// 3. RUTE TENANT
// ==============================================
Route::get('/setup-tenant', function () {
    if (!Auth::check() || Auth::user()->role !== 'tenant') return redirect('/login');
    if (Tenant::where('user_id', Auth::id())->exists()) return redirect('/home-tenant');
    $universitas = Universitas::all();
    return view('setup-tenant', compact('universitas'));
})->name('tenant.setup');

Route::post('/setup-tenant', function (Request $request) {
    $request->validate(['nama_kantin' => 'required', 'universitas' => 'required', 'lokasi_gedung' => 'required']);
    Tenant::create([
        'user_id' => Auth::id(), 'nama_kantin' => $request->nama_kantin, 'universitas' => $request->universitas,
        'lokasi_gedung' => $request->lokasi_gedung, 'deskripsi' => $request->deskripsi, 'is_open' => true,
    ]);
    return redirect('/home-tenant')->with('success', 'Kantin berhasil dibuka!');
})->name('tenant.setup.store');

Route::get('/home-tenant', function () {
    if (!Auth::check() || Auth::user()->role !== 'tenant') return redirect('/login');
    $tenant = Tenant::where('user_id', Auth::id())->first();
    if (!$tenant) return redirect('/setup-tenant');
    $menus = Menu::where('tenant_id', $tenant->id)->get();
    return view('home-tenant', ['user' => Auth::user(), 'tenant' => $tenant, 'menus' => $menus]);
})->name('tenant.home');

Route::get('/order-tenant', function () {
    if (!Auth::check() || Auth::user()->role !== 'tenant') return redirect('/login');
    $tenant = Tenant::where('user_id', Auth::id())->first();
    if (!$tenant) return redirect('/setup-tenant');
    $orders = Order::with('user')->where('tenant_id', $tenant->id)->orderBy('created_at', 'desc')->get();
    return view('order-tenant', compact('orders'));
})->name('tenant.order');

Route::post('/order-tenant/update-status/{id}', function (Request $request, $id) {
    $order = App\Models\Order::findOrFail($id);
    if ($request->status == 'completed' && $order->order_status != 'completed') {
        $user = App\Models\User::find($order->user_id);
        if ($user) { $user->points += 100; $user->save(); }
    }
    $order->update(['order_status' => $request->status]);
    return back()->with('success', 'Status pesanan berhasil diperbarui!');
})->name('tenant.order.update_status');

Route::get('/profile-tenant', function () {
    if (!Auth::check() || Auth::user()->role !== 'tenant') return redirect('/login');
    $user = Auth::user();
    $tenant = Tenant::where('user_id', $user->id)->first();
    return view('profile-tenant', compact('user', 'tenant'));
})->name('tenant.profile');

Route::post('/tambah-menu', function (Request $request) {
    $request->validate(['nama_menu' => 'required', 'harga' => 'required|numeric', 'deskripsi' => 'nullable', 'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048']);
    $tenant = App\Models\Tenant::where('user_id', Auth::id())->first();
    $fotoPath = null;
    if ($request->hasFile('foto')) { $fotoPath = $request->file('foto')->store('menus', 'public'); }
    App\Models\Menu::create([
        'tenant_id' => $tenant->id, 'nama_menu' => $request->nama_menu, 'harga' => $request->harga, 'deskripsi' => $request->deskripsi, 'foto' => $fotoPath, 'is_available' => true,
    ]);
    return redirect()->back()->with('success', 'Menu baru berhasil ditambahkan! 🍗');
})->name('tenant.menu.store');

Route::post('/edit-menu/{id}', function (Request $request, $id) {
    $request->validate(['nama_menu' => 'required', 'harga' => 'required|numeric', 'deskripsi' => 'nullable', 'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048']);
    $tenant = App\Models\Tenant::where('user_id', Auth::id())->first();
    $menu = App\Models\Menu::where('id', $id)->where('tenant_id', $tenant->id)->firstOrFail();
    $menu->nama_menu = $request->nama_menu; $menu->harga = $request->harga; $menu->deskripsi = $request->deskripsi;
    if ($request->hasFile('foto')) { $fotoPath = $request->file('foto')->store('menus', 'public'); $menu->foto = $fotoPath; }
    $menu->save();
    return redirect()->back()->with('success', 'Data menu berhasil diupdate! ✏️');
})->name('tenant.menu.update');

Route::post('/toggle-stok/{id}', function ($id) {
    $menu = App\Models\Menu::find($id);
    if ($menu) { $menu->is_available = !$menu->is_available; $menu->save(); return response()->json(['success' => true]); }
    return response()->json(['success' => false]);
});

Route::post('/toggle-kantin', function () {
    $tenant = App\Models\Tenant::where('user_id', Auth::id())->first();
    if ($tenant) { $tenant->is_open = !$tenant->is_open; $tenant->save(); return response()->json(['success' => true]); }
});

Route::get('/income-tenant', function () {
    if (!Auth::check() || Auth::user()->role !== 'tenant') return redirect('/login');
    return view('income-tenant');
})->name('tenant.income');

Route::get('/profile-tenant/payment', function () {
    if (!Auth::check() || Auth::user()->role !== 'tenant') return redirect('/login');
    $tenant = App\Models\Tenant::where('user_id', Auth::id())->first();
    return view('payment-tenant', compact('tenant'));
})->name('tenant.payment');

Route::post('/profile-tenant/payment', function (Request $request) {
    $request->validate(['qris_foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', 'keterangan_bank' => 'nullable|string']);
    $tenant = App\Models\Tenant::where('user_id', Auth::id())->first();
    if ($request->hasFile('qris_foto')) { $fotoPath = $request->file('qris_foto')->store('qris', 'public'); $tenant->qris_foto = $fotoPath; }
    $tenant->keterangan_bank = $request->keterangan_bank;
    $tenant->save();
    return redirect()->route('tenant.profile')->with('success', 'Metode pembayaran berhasil diupdate! 💳');
})->name('tenant.payment.update');