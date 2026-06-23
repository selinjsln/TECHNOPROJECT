<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Voucher;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;

class CheckoutController extends Controller
{
    // 1. Fungsi untuk klaim/memasukkan kode voucher
    public function applyVoucher(Request $request)
    {
        $request->validate([
            'voucher_code' => 'required|string'
        ]);

        $voucher = Voucher::where('code', $request->voucher_code)->first();

        // Cek apakah voucher ada dan valid
        if (!$voucher) {
            return back()->with('error', 'Kode voucher tidak ditemukan.');
        }

        if ($voucher->valid_until && now()->gt($voucher->valid_until)) {
            return back()->with('error', 'Voucher sudah kadaluarsa.');
        }

        if ($voucher->used_count >= $voucher->usage_limit) {
            return back()->with('error', 'Kuota voucher sudah habis.');
        }

        // Simpan voucher ke session agar bisa dipakai saat checkout
        session()->put('applied_voucher', [
            'id' => $voucher->id,
            'code' => $voucher->code,
            'discount' => $voucher->discount_amount
        ]);

        return back()->with('success', 'Voucher berhasil digunakan!');
    }

    // 2. Fungsi untuk menampilkan halaman checkout/cart
    public function index()
    {
        // Catatan: Karena kamu menampilkan cart langsung dari routes/web.php,
        // fungsi index ini bisa dibiarkan saja sebagai cadangan.
        
        $subtotal = 50000; 
        $adminFee = 3000;
        $discount = 0;

        if (session()->has('applied_voucher')) {
            $discount = session('applied_voucher')['discount'];
        }

        $foodTotalAfterDiscount = max(0, $subtotal - $discount);
        $grandTotal = $foodTotalAfterDiscount + $adminFee;

        return view('checkout.index', compact('subtotal', 'adminFee', 'discount', 'grandTotal'));
    }

    // 3. Fungsi untuk memproses pembayaran (SUDAH INCLUDE LOGIKA POTONG POIN BERAPAPUN)
    public function processPayment(Request $request)
    {
        // 1. Ambil semua item di keranjang mahasiswa yang sedang login
        $cartItems = Cart::with('menu')->where('user_id', auth()->id())->get();

        // Cek kalau keranjang kosong
        if ($cartItems->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Keranjang belanja Anda kosong.'
            ], 400);
        }

        // 2. Hitung Subtotal secara dinamis dari tabel carts
        $subtotal = 0;
        foreach ($cartItems as $item) {
            $subtotal += $item->quantity * $item->menu->harga;
        }

        $adminFee = 3000;
        $discount = session()->has('applied_voucher') ? session('applied_voucher')['discount'] : 0;
        
        // Pastikan diskon tidak membuat total harga makanan jadi minus
        $foodTotalAfterDiscount = max(0, $subtotal - $discount);
        $grandTotal = $foodTotalAfterDiscount + $adminFee;

        // --- INTEGRASI LOGIKA POTONG POIN ---
        $user = auth()->user();
        $usePoints = session('use_points', false);
        $pointsUsed = 0;

        // Potong dari saldo poin jika tombol diaktifkan DAN saldo poin mahasiswa lebih dari 0
        if ($usePoints && $user->points > 0) {
            $pointsUsed = min($user->points, $grandTotal);
            $grandTotal -= $pointsUsed;
            
            // Kurangi saldo poin asli milik mahasiswa di database
            $user->points -= $pointsUsed;
            $user->save();
        }
        // -------------------------------------

        // Ambil tenant_id dari salah satu menu yang ada di keranjang
        $tenantId = $cartItems->first()->menu->tenant_id;

        // 4. Simpan data ke tabel Orders (Nota Utama)
        $order = Order::create([
            'user_id' => $user->id,
            'tenant_id' => $tenantId,
            'voucher_id' => session()->has('applied_voucher') ? session('applied_voucher')['id'] : null,
            'subtotal' => $subtotal,
            'admin_fee' => $adminFee,
            'discount' => $discount,
            'points_used' => $pointsUsed, // Menyimpan jumlah poin yang terpakai ke dalam nota order
            'grand_total' => $grandTotal,
            'payment_status' => 'paid', // Anggap QRIS langsung lunas
            'order_status' => 'pending' // Menunggu disiapkan tenant
        ]);

        // 5. Pindahkan item dari keranjang ke tabel Order Items (Detail Makanan)
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'menu_id' => $item->menu_id,
                'quantity' => $item->quantity,
                'price' => $item->menu->harga // Mengunci harga saat ini
            ]);
        }

        // 6. Bersihkan keranjang belanja karena checkout sudah sukses
        Cart::where('user_id', $user->id)->delete();
        
        // 7. Hapus session voucher dan sesi pemakaian poin
        session()->forget(['applied_voucher', 'use_points']);

        return response()->json([
            'success' => true,
            'message' => 'Pesanan berhasil dibuat dan diteruskan ke kantin!'
        ]);
    }
}