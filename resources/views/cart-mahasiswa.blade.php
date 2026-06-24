<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang - UnivBite</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background-color: #cbd5e1;
        }

        .phone-frame {
            width: 100%;
            max-width: 390px;
            height: 844px;
            max-height: 95vh;
            margin: 2vh auto;
            background: #f8f9fa;
            position: relative;
            overflow: hidden;
            border-radius: 40px;
            border: 14px solid #1e293b;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            display: flex;
            flex-direction: column;
        }

        .hide-scroll::-webkit-scrollbar {
            display: none;
        }

        .hide-scroll {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        input[type="radio"]:checked+div .radio-indicator {
            background-color: #f97316;
            border-color: #f97316;
        }

        input[type="radio"]:checked+div .radio-inner {
            transform: scale(1);
        }
    </style>
</head>

<body class="flex items-center justify-center min-h-screen">
    <div class="phone-frame relative">

        <div
            class="w-full h-7 z-50 flex justify-between items-center px-6 text-[11px] font-bold text-gray-700 pt-4 bg-[#f8f9fa]">
            <span>09:41</span>
            <div class="flex space-x-1 items-center text-blue-400"><span>📶</span><span class="text-green-500">🔋</span>
            </div>
        </div>

        <div class="px-6 pt-6 pb-2 bg-[#f8f9fa] z-40 relative">
            <h1 class="font-extrabold text-3xl text-black tracking-tight">Keranjang</h1>
            <p class="text-sm text-gray-500 mt-1">Pesanan Anda</p>
        </div>

        <div class="flex-1 px-6 pt-4 pb-32 overflow-y-auto hide-scroll">

            @forelse($cartItems as $item)
                <div class="bg-white p-4 rounded-3xl shadow-sm border border-gray-100 flex gap-4 mb-4 items-center">
                    <div
                        class="w-[70px] h-[70px] bg-[#fff8ef] rounded-2xl flex items-center justify-center shadow-inner overflow-hidden flex-shrink-0">
                        @if($item->menu->foto)
                            <img src="{{ asset('storage/' . $item->menu->foto) }}" class="w-full h-full object-cover"
                                alt="Foto">
                        @else
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($item->menu->nama_menu) }}&background=fff8ef&color=ed8936"
                                class="w-full h-full object-cover" alt="Foto Default">
                        @endif
                    </div>
                    <div class="flex-1">
                        <h3 class="font-extrabold text-gray-800 text-[15px]">{{ $item->menu->nama_menu }}</h3>
                        <p class="text-[13px] font-bold text-[#ed8936] mt-0.5">Rp
                            {{ number_format($item->menu->harga, 0, ',', '.') }}</p>

                        <div class="flex items-center gap-3 mt-2">
                            <form action="{{ route('mahasiswa.cart.update', $item->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="action" value="decrease">
                                <button type="submit"
                                    class="w-6 h-6 bg-gray-100 rounded-full text-gray-500 font-extrabold flex items-center justify-center pb-0.5 hover:bg-gray-200">-</button>
                            </form>
                            <span class="text-sm font-extrabold text-gray-800">{{ $item->quantity }}</span>
                            <form action="{{ route('mahasiswa.cart.update', $item->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="action" value="increase">
                                <button type="submit"
                                    class="w-6 h-6 bg-[#ed8936] rounded-full text-white font-extrabold flex items-center justify-center pb-0.5 shadow-sm hover:bg-orange-600">+</button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-10">
                    <p class="text-sm font-bold text-gray-500">Keranjang masih kosong.</p>
                    <a href="{{ route('mahasiswa.home') }}" class="text-[#ed8936] text-xs font-bold mt-2 inline-block">Cari
                        Makanan Dulu Yuk!</a>
                </div>
            @endforelse

            @if(isset($cartItems) && $cartItems->isNotEmpty())
                <form action="{{ route('mahasiswa.apply_voucher') }}" method="POST" class="mb-4 flex gap-2">
                    @csrf
                    <input type="text" name="voucher_code" placeholder="Punya kode promo?"
                        class="flex-1 text-sm border-0 bg-white rounded-2xl px-4 shadow-sm focus:ring-2 focus:ring-orange-300 outline-none"
                        required>
                    <button type="submit"
                        class="bg-gray-800 text-white font-extrabold text-sm px-5 py-3 rounded-2xl shadow-md hover:bg-gray-900 transition-colors">Pakai</button>
                </form>

                <div
                    class="bg-blue-50 p-4 rounded-2xl mb-4 flex justify-between items-center border border-blue-100 shadow-sm">
                    <div>
                        <p class="text-[13px] font-extrabold text-blue-800">Poin UnivBite:
                            {{ number_format($userPoints ?? 0, 0, ',', '.') }}</p>
                        <p class="text-[10px] font-bold text-blue-600 mt-0.5">Dapat memotong Rp
                            {{ number_format($userPoints ?? 0, 0, ',', '.') }}</p>
                    </div>
                    <form action="{{ route('mahasiswa.toggle_points') }}" method="POST">
                        @csrf
                        @if(isset($userPoints) && $userPoints > 0)
                            <button type="submit"
                                class="text-xs font-extrabold px-4 py-2 rounded-xl shadow-sm transition-colors {{ $usePoints ? 'bg-red-500 text-white hover:bg-red-600' : 'bg-blue-600 text-white hover:bg-blue-700' }}">{{ $usePoints ? 'Batal Pakai' : 'Pakai Poin' }}</button>
                        @else
                            <button type="button" disabled
                                class="text-xs font-extrabold px-4 py-2 rounded-xl shadow-sm bg-gray-300 text-gray-500 cursor-not-allowed">Pakai
                                Poin</button>
                        @endif
                    </form>
                </div>

                <div class="bg-[#fff8ef] p-5 rounded-3xl border border-orange-100 mt-2 shadow-sm">
                    <div class="flex justify-between text-[13px] font-bold text-gray-600 mb-2"><span>Subtotal
                            Makanan</span><span>Rp {{ number_format($subtotal ?? 0, 0, ',', '.') }}</span></div>
                    @if(isset($discount) && $discount > 0)
                        <div class="flex justify-between text-[13px] font-bold text-green-600 mb-2"><span>Diskon
                                Voucher</span><span>-Rp {{ number_format($discount, 0, ',', '.') }}</span></div>
                    @endif
                    @if(isset($pointsUsed) && $pointsUsed > 0)
                        <div class="flex justify-between text-[13px] font-bold text-blue-600 mb-2"><span>Potongan
                                Poin</span><span>-Rp {{ number_format($pointsUsed, 0, ',', '.') }}</span></div>
                    @endif
                    <div class="flex justify-between text-[13px] font-bold text-gray-600 mb-4"><span>Biaya
                            Layanan</span><span>Rp {{ number_format($adminFee ?? 0, 0, ',', '.') }}</span></div>
                    <div class="h-px w-full bg-orange-200 my-3"></div>
                    <div class="flex justify-between text-[15px] font-extrabold text-gray-900 mt-2"><span>Total
                            Pembayaran</span><span class="text-[#ed8936]">Rp
                            {{ number_format($grandTotal ?? 0, 0, ',', '.') }}</span></div>
                </div>

                <div class="mt-6 mb-2">
                    <h3 class="text-[14px] font-extrabold text-gray-800 mb-3">Metode Pembayaran</h3>
                    <div class="space-y-2.5">

                        <label class="block relative group cursor-pointer">
                            <input type="radio" name="payment_method" value="qris" class="peer sr-only" checked>
                            <div
                                class="flex items-center justify-between p-3.5 bg-white border-2 border-gray-100 rounded-2xl transition-all peer-checked:border-orange-500 peer-checked:bg-orange-50/50 hover:bg-gray-50">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-9 h-9 bg-blue-50 text-blue-500 rounded-xl flex items-center justify-center text-lg">
                                        📱</div>
                                    <div>
                                        <p class="text-[13px] font-extrabold text-gray-800">QRIS</p>
                                        <p class="text-[10px] font-medium text-gray-400">Scan via M-Banking / E-Wallet</p>
                                    </div>
                                </div>
                                <div
                                    class="w-5 h-5 rounded-full border-2 border-gray-300 flex items-center justify-center radio-indicator transition-colors">
                                    <div
                                        class="w-2.5 h-2.5 bg-white rounded-full transform scale-0 transition-transform radio-inner">
                                    </div>
                                </div>
                            </div>
                        </label>

                        <label class="block relative group cursor-pointer">
                            <input type="radio" name="payment_method" value="ewallet" class="peer sr-only">
                            <div
                                class="flex items-center justify-between p-3.5 bg-white border-2 border-gray-100 rounded-2xl transition-all peer-checked:border-orange-500 peer-checked:bg-orange-50/50 hover:bg-gray-50">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-9 h-9 bg-green-50 text-green-500 rounded-xl flex items-center justify-center text-lg">
                                        💳</div>
                                    <div>
                                        <p class="text-[13px] font-extrabold text-gray-800">E-Wallet</p>
                                        <p class="text-[10px] font-medium text-gray-400">ShopeePay, OVO, Dana, GoPay</p>
                                    </div>
                                </div>
                                <div
                                    class="w-5 h-5 rounded-full border-2 border-gray-300 flex items-center justify-center radio-indicator transition-colors">
                                    <div
                                        class="w-2.5 h-2.5 bg-white rounded-full transform scale-0 transition-transform radio-inner">
                                    </div>
                                </div>
                            </div>
                        </label>

                        <label class="block relative group cursor-pointer">
                            <input type="radio" name="payment_method" value="card" class="peer sr-only">
                            <div
                                class="flex items-center justify-between p-3.5 bg-white border-2 border-gray-100 rounded-2xl transition-all peer-checked:border-orange-500 peer-checked:bg-orange-50/50 hover:bg-gray-50">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-9 h-9 bg-purple-50 text-purple-500 rounded-xl flex items-center justify-center text-lg">
                                        🏦</div>
                                    <div>
                                        <p class="text-[13px] font-extrabold text-gray-800">Kartu Kredit / Debit</p>
                                        <p class="text-[10px] font-medium text-gray-400">Visa, Mastercard, JCB</p>
                                    </div>
                                </div>
                                <div
                                    class="w-5 h-5 rounded-full border-2 border-gray-300 flex items-center justify-center radio-indicator transition-colors">
                                    <div
                                        class="w-2.5 h-2.5 bg-white rounded-full transform scale-0 transition-transform radio-inner">
                                    </div>
                                </div>
                            </div>
                        </label>

                    </div>
                </div>

                <button type="button" onclick="handlePayment()"
                    class="w-full bg-[#f0a656] hover:bg-[#ed8936] text-white font-extrabold py-4 rounded-2xl shadow-md shadow-orange-200 mt-6 transition-colors text-sm">Pesan
                    Sekarang</button>
            @endif
        </div>

        <div
            class="absolute bottom-0 w-full bg-white border-t border-gray-100 pt-3 pb-8 px-6 flex justify-between items-center z-40 rounded-b-[25px] shadow-[0_-10px_20px_rgba(0,0,0,0.03)]">
            <a href="{{ route('mahasiswa.home') }}"
                class="flex flex-col items-center gap-1 text-gray-400 hover:text-orange-500 transition-colors w-12"><svg
                    class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-width="2"
                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg><span class="text-[10px] font-medium">Home</span></a>
            <a href="{{ route('mahasiswa.cart') }}"
                class="flex flex-col items-center gap-1 text-[#ed8936] w-12 relative"><svg class="w-6 h-6"
                    fill="currentColor" viewBox="0 0 24 24">
                    <path
                        d="M7 18c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zM1 2v2h2l3.6 7.59-1.35 2.45c-.16.28-.25.61-.25.96 0 1.1.9 2 2 2h12v-2H7.42c-.14 0-.25-.11-.25-.25l.03-.12.9-1.63h7.45c.75 0 1.41-.41 1.75-1.03l3.58-6.49c.08-.14.12-.31.12-.48 0-.55-.45-1-1-1H5.21l-.94-2H1zm16 16c-1.1 0-1.99.9-1.99 2s.89 2 1.99 2 2-.9 2-2-.9-2-2-2z" />
                </svg>
                @if(isset($cartItems) && $cartItems->count() > 0)
                    <span
                        class="absolute -top-1 -right-1 bg-red-500 text-white text-[8px] font-bold px-1.5 py-0.5 rounded-full border border-white">{{ $cartItems->count() }}</span>
                @endif
                <span class="text-[10px] font-bold">Cart</span>
            </a>
            <a href="{{ route('mahasiswa.order') }}"
                class="flex flex-col items-center gap-1 text-gray-400 hover:text-orange-500 transition-colors w-12"><svg
                    class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4">
                    </path>
                </svg><span class="text-[10px] font-medium">Order</span></a>
            <a href="{{ route('mahasiswa.profile') }}"
                class="flex flex-col items-center gap-1 text-gray-400 hover:text-orange-500 transition-colors w-12"><svg
                    class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg><span class="text-[10px] font-medium">Profile</span></a>
        </div>

        @if(isset($grandTotal))
            <div id="payment-modal"
                class="absolute inset-0 bg-black bg-opacity-70 z-[100] hidden flex items-center justify-center backdrop-blur-sm px-6">
                <div id="payment-content"
                    class="bg-white w-full rounded-3xl p-6 shadow-2xl transform scale-95 opacity-0 transition-all duration-300">
                    <div class="text-center mb-6">
                        <h3 class="text-lg font-extrabold text-gray-800">Scan QRIS</h3>
                        <p class="text-xs text-gray-500 mt-1">Selesaikan pembayaran dalam <span
                                class="font-bold text-red-500">10:00</span> menit</p>
                    </div>
                    <div class="w-48 h-48 mx-auto bg-gray-50 rounded-2xl p-2 border-2 border-gray-100 shadow-inner mb-6">
                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=PembayaranUnivBiteRp{{ $grandTotal }}"
                            class="w-full h-full object-contain mix-blend-multiply" alt="QRIS Code">
                    </div>
                    <div class="bg-gray-50 rounded-xl p-4 mb-6 border border-gray-100">
                        <p class="text-[11px] text-gray-500 text-center uppercase tracking-widest font-bold mb-1">Total
                            Tagihan</p>
                        <p class="text-2xl text-center font-extrabold text-[#ed8936]">Rp
                            {{ number_format($grandTotal, 0, ',', '.') }}</p>
                    </div>
                    <div class="flex flex-col gap-3">
                        <button onclick="processPayment('qris')"
                            class="w-full bg-[#ed8936] text-white font-extrabold py-3.5 rounded-xl shadow-md hover:bg-orange-600 transition-colors text-sm flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg> Saya Sudah Bayar
                        </button>
                        <button onclick="hidePaymentModal()"
                            class="w-full bg-white text-gray-400 font-bold py-3.5 rounded-xl border border-gray-200 hover:bg-gray-50 transition-colors text-sm">Batal</button>
                    </div>
                </div>
            </div>
        @endif

        <div id="success-toast"
            class="absolute top-10 left-1/2 transform -translate-x-1/2 bg-green-500 text-white text-xs leading-snug font-bold py-3.5 px-6 rounded-3xl shadow-xl z-[200] transition-all duration-300 opacity-0 -translate-y-4 pointer-events-none w-10/12 text-center flex items-center justify-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path>
            </svg> <span id="toast-text">Pembayaran Berhasil!</span>
        </div>
    </div>

    <script>
        const paymentModal = document.getElementById('payment-modal');
        const paymentContent = document.getElementById('payment-content');
        const successToast = document.getElementById('success-toast');

        function handlePayment() {
            // Ambil metode pembayaran yang sedang dicentang
            const selectedMethod = document.querySelector('input[name="payment_method"]:checked').value;

            if (selectedMethod === 'qris') {
                // Tampilkan pop-up QR Code khusus QRIS
                showPaymentModal();
            } else {
                // Untuk E-Wallet & Card, langsung sukses tanpa pop-up QR
                document.getElementById('toast-text').innerText = 'Pembayaran Berhasil diproses!';
                processPayment(selectedMethod);
            }
        }

        function showPaymentModal() { if (paymentModal) { paymentModal.classList.remove('hidden'); setTimeout(() => { paymentContent.classList.remove('scale-95', 'opacity-0'); paymentContent.classList.add('scale-100', 'opacity-100'); }, 10); } }
        function hidePaymentModal() { if (paymentContent) { paymentContent.classList.remove('scale-100', 'opacity-100'); paymentContent.classList.add('scale-95', 'opacity-0'); setTimeout(() => { paymentModal.classList.add('hidden'); }, 300); } }

        // Fungsi ini menerima parameter 'method' agar dikirim ke database
        function processPayment(method) {
            hidePaymentModal();

            fetch("{{ route('mahasiswa.process_payment') }}", {
                method: "POST",
                headers: { "Content-Type": "application/json", "X-CSRF-TOKEN": "{{ csrf_token() }}" },
                body: JSON.stringify({ payment_method: method }) // Mengirim metode pembayaran ke Laravel
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        successToast.classList.remove('opacity-0', '-translate-y-4');
                        successToast.classList.add('opacity-100', 'translate-y-0');
                        setTimeout(() => { window.location.href = "{{ route('mahasiswa.order') }}"; }, 1500);
                    } else { alert(data.message || 'Terjadi kesalahan, pesanan gagal dibuat.'); }
                }).catch(error => { console.error('Error:', error); alert('Terjadi kesalahan sistem.'); });
        }
    </script>
</body>

</html>