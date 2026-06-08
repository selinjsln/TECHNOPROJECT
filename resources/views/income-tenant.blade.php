<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Income Report - UnivBite</title>
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
            background: #f8fafc;
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
        <div
            class="w-full h-7 z-50 flex justify-between items-center px-6 text-[11px] font-bold text-white bg-orange-500 pt-4 relative">
            <span>09:41</span>
            <div class="flex space-x-1 items-center tracking-widest"><span>📶</span><span>🔋</span></div>
        </div>

        <div class="bg-orange-500 px-6 pt-6 pb-12 rounded-b-[40px] text-white shadow-md relative z-10">
            <h1 class="text-sm font-medium opacity-90 text-center">Total Penjualan Bulan Ini</h1>
            <div class="text-4xl font-extrabold text-center mt-2 mb-4 tracking-tight">Rp 1.250.000</div>
            <p class="text-[10px] text-center opacity-80 italic">Uang masuk langsung ke QRIS Kantin Anda</p>
        </div>

        <div class="flex-1 px-6 pt-6 pb-24 overflow-y-auto hide-scroll -mt-6">

            <div class="bg-white p-4 rounded-3xl shadow-sm border border-gray-100 mb-6 flex justify-between">
                <div class="text-center w-1/2 border-r border-gray-100">
                    <p class="text-[10px] text-gray-400 font-bold uppercase tracking-wider">Hari Ini</p>
                    <p class="text-lg font-extrabold text-gray-800 mt-1">Rp 120.000</p>
                </div>
                <div class="text-center w-1/2">
                    <p class="text-[10px] text-gray-400 font-bold uppercase tracking-wider">Total Pesanan</p>
                    <p class="text-lg font-extrabold text-gray-800 mt-1">42</p>
                </div>
            </div>

            <div class="flex justify-between items-center mb-4">
                <h2 class="text-sm font-bold text-gray-800">Riwayat Penjualan</h2>
                <button onclick="showFilterModal()"
                    class="text-[10px] font-bold text-orange-500 flex items-center gap-1 bg-orange-50 px-2.5 py-1.5 rounded-lg hover:bg-orange-100 transition-colors">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z">
                        </path>
                    </svg>
                    Filter
                </button>
            </div>

            <div class="space-y-3">
                <div class="bg-white p-3.5 rounded-2xl border border-gray-50 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div
                            class="w-10 h-10 bg-orange-50 text-orange-500 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-gray-800">Ayam Geprek (2x)</p>
                            <p class="text-[10px] text-gray-400">Order #ORD-9821 • 12:30</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <span class="text-xs font-bold text-orange-600">+Rp 30.000</span>
                        <p class="text-[8px] text-green-500 font-bold uppercase">Paid via QRIS</p>
                    </div>
                </div>

                <div class="bg-white p-3.5 rounded-2xl border border-gray-100 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div
                            class="w-10 h-10 bg-orange-50 text-orange-500 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-gray-800">Es Milo Dino (2x)</p>
                            <p class="text-[10px] text-gray-400">Order #ORD-9820 • 11:15</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <span class="text-xs font-bold text-orange-600">+Rp 16.000</span>
                        <p class="text-[8px] text-green-500 font-bold uppercase">Paid via QRIS</p>
                    </div>
                </div>

                <div class="bg-white p-3.5 rounded-2xl border border-gray-50 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-red-50 text-red-500 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-gray-800">Nasi Goreng (Ditolak)</p>
                            <p class="text-[10px] text-gray-400">Order #ORD-9815 • 09:45</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <span class="text-xs font-bold text-gray-400 line-through">Rp 15.000</span>
                        <p class="text-[8px] text-red-500 font-bold uppercase">Refunded</p>
                    </div>
                </div>
            </div>

            <p class="text-[9px] text-gray-400 text-center mt-8 px-4 leading-relaxed">
                Data ini sinkron dengan jumlah pesanan yang diselesaikan di UnivBite.
            </p>
        </div>

        <div
            class="absolute bottom-0 w-full bg-white border-t border-gray-100 pt-3 pb-8 px-6 flex justify-between items-center z-40 rounded-b-[25px] shadow-[0_-10px_20px_rgba(0,0,0,0.03)]">
            <a href="{{ route('tenant.home') }}"
                class="flex flex-col items-center gap-1 text-gray-400 hover:text-orange-500 transition-colors w-12"><svg
                    class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-width="2"
                        d="M4 6h16v2H4zm2-4h12v2H6zm14 8H4c-1.1 0-2 .9-2 2v8h20v-8c0-1.1-.9-2-2-2zm-9 8H9v-2h2v2zm5 0h-2v-2h2v2z" />
                </svg><span class="text-[10px] font-medium">Canteen</span></a>
            <a href="{{ route('tenant.order') }}"
                class="flex flex-col items-center gap-1 text-gray-400 hover:text-orange-500 transition-colors w-12 relative"><svg
                    class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4">
                    </path>
                </svg><span class="text-[10px] font-medium">Order</span></a>
            <a href="{{ route('tenant.income') }}"
                class="flex flex-col items-center gap-1 text-orange-500 transition-colors w-12"><svg class="w-6 h-6"
                    fill="currentColor" viewBox="0 0 24 24">
                    <path
                        d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1.41 16.09V20h-2.67v-1.93c-1.71-.36-3.16-1.46-3.27-3.4h1.96c.1 1.05.82 1.87 2.65 1.87 1.96 0 2.4-.98 2.4-1.59 0-.83-.44-1.61-2.67-2.14-2.48-.6-4.18-1.62-4.18-3.67 0-1.72 1.39-2.84 3.11-3.21V4h2.67v1.95c1.86.45 2.79 1.86 2.85 3.39H14.3c-.05-1.11-.64-1.87-2.22-1.87-1.5 0-2.4.68-2.4 1.64 0 .84.65 1.39 2.67 1.91s4.18 1.39 4.18 3.91c-.01 1.83-1.38 2.83-3.12 3.16z">
                    </path>
                </svg><span class="text-[10px] font-bold">Income</span></a>
            <a href="{{ route('tenant.profile') }}"
                class="flex flex-col items-center gap-1 text-gray-400 hover:text-orange-500 transition-colors w-12"><svg
                    class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg><span class="text-[10px] font-medium">Profile</span></a>
        </div>

        <div id="modal-filter"
            class="absolute inset-0 bg-black bg-opacity-60 z-[100] hidden flex items-end justify-center">
            <div class="absolute inset-0" onclick="hideFilterModal()"></div>

            <div class="bg-white rounded-t-[35px] w-full p-6 shadow-2xl transform transition-transform translate-y-full z-10"
                id="modal-content-filter">
                <div class="flex justify-between items-center mb-6 border-b border-gray-100 pb-4">
                    <h3 class="text-lg font-bold text-gray-800">Filter Riwayat</h3>
                    <button onclick="hideFilterModal()"
                        class="text-gray-400 hover:text-gray-600 bg-gray-100 rounded-full p-1"><svg class="w-5 h-5"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg></button>
                </div>

                <div class="space-y-6">
                    <div>
                        <h4 class="text-xs font-bold text-gray-400 uppercase mb-3 tracking-wider">Periode Waktu</h4>
                        <div class="flex flex-wrap gap-2" id="filter-waktu">
                            <button
                                class="bg-orange-500 text-white px-4 py-2 rounded-full text-xs font-bold border border-orange-500 transition-colors"
                                onclick="selectPill(this, 'filter-waktu')">Hari Ini</button>
                            <button
                                class="bg-white text-gray-500 px-4 py-2 rounded-full text-xs font-bold border border-gray-200 transition-colors"
                                onclick="selectPill(this, 'filter-waktu')">7 Hari Terakhir</button>
                            <button
                                class="bg-white text-gray-500 px-4 py-2 rounded-full text-xs font-bold border border-gray-200 transition-colors"
                                onclick="selectPill(this, 'filter-waktu')">Bulan Ini</button>
                        </div>
                    </div>

                    <div>
                        <h4 class="text-xs font-bold text-gray-400 uppercase mb-3 tracking-wider">Status Pesanan</h4>
                        <div class="flex flex-wrap gap-2" id="filter-status">
                            <button
                                class="bg-orange-500 text-white px-4 py-2 rounded-full text-xs font-bold border border-orange-500 transition-colors"
                                onclick="selectPill(this, 'filter-status')">Semua Selesai</button>
                            <button
                                class="bg-white text-gray-500 px-4 py-2 rounded-full text-xs font-bold border border-gray-200 transition-colors"
                                onclick="selectPill(this, 'filter-status')">Dibatalkan</button>
                        </div>
                    </div>
                </div>

                <button onclick="terapkanFilter()"
                    class="w-full bg-[#f6aa3d] hover:bg-orange-500 text-black font-extrabold py-3.5 rounded-xl shadow-md transition-colors mt-8 mb-2">
                    Terapkan Filter
                </button>
            </div>
        </div>

        <div id="toast-notification"
            class="absolute top-12 left-1/2 transform -translate-x-1/2 bg-green-500 text-white text-xs font-bold py-2 px-4 rounded-full shadow-lg z-[110] transition-opacity duration-300 opacity-0 pointer-events-none w-10/12 text-center">
            Pesan
        </div>

        <div
            class="w-full h-6 absolute bottom-0 z-50 flex justify-center items-center pb-2 bg-transparent pointer-events-none">
            <div class="w-1/3 h-1.5 bg-gray-300 rounded-full"></div>
        </div>
    </div>

    <script>
        // --- Logika Buka/Tutup Modal Filter ---
        const modalFilter = document.getElementById('modal-filter');
        const modalContentFilter = document.getElementById('modal-content-filter');

        function showFilterModal() {
            modalFilter.classList.remove('hidden');
            setTimeout(() => { modalContentFilter.classList.remove('translate-y-full'); }, 10);
        }

        function hideFilterModal() {
            modalContentFilter.classList.add('translate-y-full');
            setTimeout(() => { modalFilter.classList.add('hidden'); }, 300);
        }

        // --- Logika Pilihan Tombol Pill (Kapsul) ---
        function selectPill(clickedBtn, groupId) {
            // Ambil semua tombol di dalam grup yang sama (Waktu atau Status)
            const group = document.getElementById(groupId);
            const buttons = group.querySelectorAll('button');

            // Reset semua tombol di grup itu jadi abu-abu
            buttons.forEach(btn => {
                btn.className = "bg-white text-gray-500 px-4 py-2 rounded-full text-xs font-bold border border-gray-200 transition-colors";
            });

            // Jadikan tombol yang diklik warna oranye
            clickedBtn.className = "bg-orange-500 text-white px-4 py-2 rounded-full text-xs font-bold border border-orange-500 transition-colors";
        }

        // --- Logika Terapkan Filter ---
        function terapkanFilter() {
            hideFilterModal();
            // Munculkan Toast pop up
            const toast = document.getElementById('toast-notification');
            toast.innerText = "Filter berhasil diterapkan!";
            toast.classList.remove('opacity-0', 'bg-red-500');
            toast.classList.add('bg-green-500');
            setTimeout(() => { toast.classList.add('opacity-0'); }, 3000);
        }
    </script>
</body>

</html>