<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order - UnivBite</title>
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
            background: #fffcf8;
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
    <div class="phone-frame">
        <div class="w-full h-7 z-50 flex justify-between items-center px-6 text-[11px] font-bold text-gray-700 pt-4">
            <span>09:41</span>
            <div class="flex space-x-1 items-center text-blue-400"><span>📶</span><span class="text-green-500">🔋</span>
            </div>
        </div>

        <div class="px-6 pt-4 pb-2 bg-white shadow-sm z-40 rounded-b-3xl mb-2">
            <h1 class="font-extrabold text-2xl text-black">Pesanan Saya</h1>
            <div class="flex mt-4 bg-gray-50 p-1 rounded-xl">
                <button
                    class="flex-1 py-2 text-xs font-bold rounded-lg bg-white text-orange-500 shadow-sm">Aktif</button>
                <button class="flex-1 py-2 text-xs font-bold rounded-lg text-gray-400">Riwayat</button>
            </div>
        </div>

        <div class="flex-1 px-6 pt-2 pb-24 overflow-y-auto hide-scroll">
            <div class="bg-white p-4 rounded-2xl shadow-sm border border-blue-100 relative mb-4">
                <div
                    class="absolute -top-2 -right-2 bg-blue-500 text-white text-[10px] font-bold px-3 py-1 rounded-full animate-pulse">
                    Sedang Dimasak</div>

                <p class="text-[10px] text-gray-400 font-bold mb-3 mt-1">Ayam Geprek Best • #ORD-9821</p>

                <div class="space-y-1.5 mb-3">
                    <p class="text-xs text-gray-600 flex justify-between font-bold"><span>2x Nasi Ayam Geprek</span>
                        <span>Rp 30.000</span>
                    </p>
                    <p class="text-xs text-gray-600 flex justify-between font-bold"><span>2x Es Teh Manis</span>
                        <span>Rp 6.000</span>
                    </p>
                    <p class="text-xs text-gray-600 flex justify-between font-bold"><span>Biaya Layanan</span>
                        <span>Rp 3.000</span>
                    </p>
                </div>

                <div class="h-px bg-gray-100 my-3"></div>
                <div class="flex justify-between items-center mb-4">
                    <span class="text-xs font-bold text-gray-500">Total Pembayaran</span>
                    <span class="text-sm font-extrabold text-[#ed8936]">Rp 39.000</span>
                </div>

                <div class="flex items-center gap-3 bg-blue-50/70 p-3 rounded-xl mb-3 border border-blue-100/50">
                    <div class="bg-blue-100 text-blue-500 p-2 rounded-lg">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-[9px] text-gray-500 font-bold uppercase tracking-wider mb-0.5">Estimasi
                            Pengambilan</p>
                        <p class="text-xs font-extrabold text-blue-600">10 - 15 Menit</p>
                    </div>
                </div>

                <p class="text-[10px] text-gray-500 italic leading-relaxed mt-2">Mohon tunggu, pesananmu sedang
                    disiapkan. Siapkan
                    pembayaran QRIS saat mengambil!</p>
            </div>
        </div>

        <div
            class="absolute bottom-0 w-full bg-white border-t border-gray-100 pt-3 pb-8 px-6 flex justify-between items-center z-40 rounded-b-[25px] shadow-[0_-10px_20px_rgba(0,0,0,0.03)]">
            <a href="{{ route('mahasiswa.home') }}"
                class="flex flex-col items-center gap-1 text-gray-400 hover:text-orange-500 transition-colors w-12">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-width="2"
                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                <span class="text-[10px] font-medium">Home</span>
            </a>
            <a href="{{ route('mahasiswa.cart') }}"
                class="flex flex-col items-center gap-1 text-gray-400 hover:text-orange-500 transition-colors w-12 relative">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z">
                    </path>
                </svg>
                <span
                    class="absolute -top-1 -right-1 bg-red-500 text-white text-[8px] font-bold px-1.5 py-0.5 rounded-full border border-white">2</span>
                <span class="text-[10px] font-medium">Cart</span>
            </a>
            <a href="{{ route('mahasiswa.order') }}" class="flex flex-col items-center gap-1 text-orange-500 w-12">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                    <path
                        d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-8 14H7v-2h4v2zm4-4H7v-2h8v2zm0-4H7V7h8v2z" />
                </svg>
                <span class="text-[10px] font-bold">Order</span>
            </a>
            <a href="{{ route('mahasiswa.profile') }}"
                class="flex flex-col items-center gap-1 text-gray-400 hover:text-orange-500 transition-colors w-12">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
                <span class="text-[10px] font-medium">Profile</span>
            </a>
        </div>

        <div class="w-full h-6 absolute bottom-0 z-[110] flex justify-center items-center pb-2 bg-transparent">
            <div class="w-1/3 h-1.5 bg-gray-300 rounded-full"></div>
        </div>
    </div>
</body>

</html>