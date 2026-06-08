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
            <p class="text-sm text-gray-500 mt-1">Ayam Geprek Best</p>
        </div>

        <div class="flex-1 px-6 pt-4 pb-32 overflow-y-auto hide-scroll">
            <div class="bg-white p-4 rounded-3xl shadow-sm border border-gray-100 flex gap-4 mb-4 items-center">
                <div
                    class="w-[70px] h-[70px] bg-[#fff8ef] rounded-2xl flex items-center justify-center shadow-inner overflow-hidden flex-shrink-0">
                    <img src="{{ asset('menus/ayam-geprek.jpg') }}" class="w-full h-full object-cover"
                        alt="Nasi Ayam Geprek">
                </div>
                <div class="flex-1">
                    <h3 class="font-extrabold text-gray-800 text-[15px]">Nasi Ayam Geprek</h3>
                    <p class="text-[13px] font-bold text-[#ed8936] mt-0.5">Rp 15.000</p>
                    <div class="flex items-center gap-4 mt-2">
                        <button
                            class="w-6 h-6 bg-gray-100 rounded-full text-gray-500 font-extrabold flex items-center justify-center pb-0.5 hover:bg-gray-200">-</button>
                        <span class="text-sm font-extrabold text-gray-800">2</span>
                        <button
                            class="w-6 h-6 bg-[#ed8936] rounded-full text-white font-extrabold flex items-center justify-center pb-0.5 shadow-sm hover:bg-orange-600">+</button>
                    </div>
                </div>
            </div>

            <div class="bg-white p-4 rounded-3xl shadow-sm border border-gray-100 flex gap-4 mb-4 items-center">
                <div
                    class="w-[70px] h-[70px] bg-[#fff8ef] rounded-2xl flex items-center justify-center shadow-inner overflow-hidden flex-shrink-0">
                    <img src="{{ asset('menus/es-teh.jpg') }}" class="w-full h-full object-cover" alt="Es Teh Manis">
                </div>
                <div class="flex-1">
                    <h3 class="font-extrabold text-gray-800 text-[15px]">Es Teh Manis</h3>
                    <p class="text-[13px] font-bold text-[#ed8936] mt-0.5">Rp 3.000</p>
                    <div class="flex items-center gap-4 mt-2">
                        <button
                            class="w-6 h-6 bg-gray-100 rounded-full text-gray-500 font-extrabold flex items-center justify-center pb-0.5 hover:bg-gray-200">-</button>
                        <span class="text-sm font-extrabold text-gray-800">2</span>
                        <button
                            class="w-6 h-6 bg-[#ed8936] rounded-full text-white font-extrabold flex items-center justify-center pb-0.5 shadow-sm hover:bg-orange-600">+</button>
                    </div>
                </div>
            </div>

            <div class="bg-[#fff8ef] p-5 rounded-3xl border border-orange-100 mt-6 shadow-sm">
                <div class="flex justify-between text-[13px] font-bold text-gray-600 mb-2"><span>Subtotal</span><span>Rp
                        36.000</span></div>
                <div class="flex justify-between text-[13px] font-bold text-gray-600 mb-4"><span>Biaya
                        Layanan</span><span>Rp 3.000</span></div>
                <div class="h-px w-full bg-orange-200 my-3"></div>
                <div class="flex justify-between text-[15px] font-extrabold text-gray-900 mt-2"><span>Total</span><span
                        class="text-[#ed8936]">Rp 39.000</span></div>
            </div>

            <button onclick="showPaymentModal()"
                class="w-full bg-[#f0a656] hover:bg-[#ed8936] text-white font-extrabold py-4 rounded-2xl shadow-md shadow-orange-200 mt-6 transition-colors text-sm">
                Pesan Sekarang
            </button>
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
                </svg><span
                    class="absolute -top-1 -right-1 bg-red-500 text-white text-[8px] font-bold px-1.5 py-0.5 rounded-full border border-white">2</span><span
                    class="text-[10px] font-bold">Cart</span></a>
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

        <div
            class="w-full h-6 absolute bottom-0 z-[110] flex justify-center items-center pb-2 bg-transparent pointer-events-none">
            <div class="w-1/3 h-1.5 bg-gray-300 rounded-full"></div>
        </div>

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
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=PembayaranUnivBiteRp39000"
                        class="w-full h-full object-contain mix-blend-multiply" alt="QRIS Code">
                </div>

                <div class="bg-gray-50 rounded-xl p-4 mb-6 border border-gray-100">
                    <p class="text-[11px] text-gray-500 text-center uppercase tracking-widest font-bold mb-1">Total
                        Tagihan</p>
                    <p class="text-2xl text-center font-extrabold text-[#ed8936]">Rp 39.000</p>
                </div>

                <div class="flex flex-col gap-3">
                    <button onclick="processPayment()"
                        class="w-full bg-[#ed8936] text-white font-extrabold py-3.5 rounded-xl shadow-md hover:bg-orange-600 transition-colors text-sm flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Saya Sudah Bayar
                    </button>
                    <button onclick="hidePaymentModal()"
                        class="w-full bg-white text-gray-400 font-bold py-3.5 rounded-xl border border-gray-200 hover:bg-gray-50 transition-colors text-sm">
                        Batal
                    </button>
                </div>

            </div>
        </div>

        <div id="success-toast"
            class="absolute top-10 left-1/2 transform -translate-x-1/2 bg-green-500 text-white text-xs leading-snug font-bold py-3.5 px-6 rounded-3xl shadow-xl z-[200] transition-all duration-300 opacity-0 -translate-y-4 pointer-events-none w-10/12 text-center flex items-center justify-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path>
            </svg>
            Pembayaran Berhasil!
        </div>

    </div>

    <script>
        const paymentModal = document.getElementById('payment-modal');
        const paymentContent = document.getElementById('payment-content');
        const successToast = document.getElementById('success-toast');

        // Tampilkan pop-up QRIS
        function showPaymentModal() {
            paymentModal.classList.remove('hidden');
            setTimeout(() => {
                paymentContent.classList.remove('scale-95', 'opacity-0');
                paymentContent.classList.add('scale-100', 'opacity-100');
            }, 10);
        }

        // Sembunyikan pop-up QRIS
        function hidePaymentModal() {
            paymentContent.classList.remove('scale-100', 'opacity-100');
            paymentContent.classList.add('scale-95', 'opacity-0');
            setTimeout(() => {
                paymentModal.classList.add('hidden');
            }, 300);
        }

        // Proses "Saya Sudah Bayar"
        function processPayment() {
            hidePaymentModal(); // Tutup modal dulu

            // Tampilkan Toast Success
            setTimeout(() => {
                successToast.classList.remove('opacity-0', '-translate-y-4');
                successToast.classList.add('opacity-100', 'translate-y-0');

                // Tunggu 1.5 detik, lalu redirect ke halaman Order
                setTimeout(() => {
                    window.location.href = "{{ route('mahasiswa.order') }}";
                }, 1500);
            }, 300); // Jeda bentar biar smooth
        }
    </script>
</body>

</html>