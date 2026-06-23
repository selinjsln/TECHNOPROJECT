<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order - UnivBite</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { background-color: #cbd5e1; }
        .phone-frame {
            width: 100%; max-width: 390px; height: 844px; max-height: 95vh;
            margin: 2vh auto; background: #fffcf8; position: relative;
            overflow: hidden; border-radius: 40px; border: 14px solid #1e293b;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5); display: flex; flex-direction: column;
        }
        .hide-scroll::-webkit-scrollbar { display: none; }
        .hide-scroll { -ms-overflow-style: none; scrollbar-width: none; }
        
        /* Animasi Tab */
        .tab-content { display: none; }
        .tab-content.active { display: block; animation: fadeIn 0.3s ease-in-out; }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(5px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>

<body class="flex items-center justify-center min-h-screen">
    <div class="phone-frame">
        <div class="w-full h-7 z-50 flex justify-between items-center px-6 text-[11px] font-bold text-gray-700 pt-4">
            <span>09:41</span>
            <div class="flex space-x-1 items-center text-blue-400"><span>📶</span><span class="text-green-500">🔋</span></div>
        </div>

        <div class="px-6 pt-4 pb-2 bg-white shadow-sm z-40 rounded-b-3xl mb-2">
            <h1 class="font-extrabold text-2xl text-black">Pesanan Saya</h1>
            <div class="flex mt-4 bg-gray-50 p-1 rounded-xl border border-gray-100">
                <button onclick="switchTab('aktif')" id="tab-aktif" class="flex-1 py-2 text-xs font-bold rounded-lg bg-white text-orange-500 shadow-sm transition-all">Aktif</button>
                <button onclick="switchTab('riwayat')" id="tab-riwayat" class="flex-1 py-2 text-xs font-bold rounded-lg text-gray-400 hover:text-gray-600 transition-all">Riwayat</button>
            </div>
        </div>

        <div class="flex-1 px-6 pt-2 pb-24 overflow-y-auto hide-scroll">
            
            <div id="content-aktif" class="tab-content active space-y-4 mt-2">
                @forelse($orders->whereIn('order_status', ['pending', 'processing', 'ready']) as $order)
                <div class="bg-white p-5 rounded-3xl shadow-sm border border-gray-100 relative">
                    @if($order->order_status == 'pending')
                        <div class="absolute -top-3 -right-2 bg-orange-500 text-white text-[10px] font-bold px-3 py-1.5 rounded-full">Menunggu Kantin</div>
                    @elseif($order->order_status == 'processing')
                        <div class="absolute -top-3 -right-2 bg-blue-500 text-white text-[10px] font-bold px-3 py-1.5 rounded-full">Sedang Dimasak</div>
                    @elseif($order->order_status == 'ready')
                        <div class="absolute -top-3 -right-2 bg-green-500 text-white text-[10px] font-bold px-3 py-1.5 rounded-full animate-pulse">Siap Diambil</div>
                    @endif

                    <p class="text-[11px] text-gray-400 font-bold mb-3 border-b border-gray-50 pb-2">{{ $order->tenant->nama_kantin ?? 'Kantin' }} • #ORD-{{ $order->id }}</p>

                    <div class="space-y-2 mb-4">
                        @foreach($order->orderItems as $item)
                        <div class="flex justify-between items-center text-[12px] font-bold text-gray-700">
                            <span>{{ $item->quantity }}x {{ $item->menu->nama_menu ?? 'Menu' }}</span>
                            <span>Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</span>
                        </div>
                        @endforeach
                    </div>

                    <div class="h-px bg-gray-100 my-3"></div>
                    <div class="flex justify-between items-center mb-4">
                        <span class="text-xs font-bold text-gray-500">Total Pembayaran</span>
                        <span class="text-sm font-extrabold text-[#ed8936]">Rp {{ number_format($order->grand_total, 0, ',', '.') }}</span>
                    </div>

                    @if($order->order_status == 'ready')
                    <div class="bg-green-50 border border-green-100 rounded-xl p-3 text-center">
                        <p class="text-xs font-extrabold text-green-600">Makananmu sudah siap! 🍽️</p>
                    </div>
                    @endif
                </div>
                @empty
                <div class="text-center py-10">
                    <p class="text-sm font-bold text-gray-400">Belum ada pesanan aktif.</p>
                </div>
                @endforelse
            </div>

            <div id="content-riwayat" class="tab-content space-y-4 mt-2">
                @forelse($orders->whereIn('order_status', ['completed', 'cancelled']) as $order)
                <div class="bg-gray-50 p-5 rounded-3xl border border-gray-100 opacity-80">
                    <div class="flex justify-between items-center mb-2 border-b border-gray-200 pb-2">
                        <p class="text-[10px] text-gray-400 font-bold">{{ $order->created_at->format('d M, H:i') }}</p>
                        <span class="text-[10px] font-bold {{ $order->order_status == 'completed' ? 'text-green-600' : 'text-red-600' }}">{{ ucfirst($order->order_status) }}</span>
                    </div>
                    <p class="text-xs font-extrabold text-gray-700">{{ $order->tenant->nama_kantin ?? 'Kantin' }}</p>
                    <p class="text-[12px] font-bold text-gray-700 mt-2">Total: Rp {{ number_format($order->grand_total, 0, ',', '.') }}</p>
                </div>
                @empty
                <div class="text-center py-10">
                    <p class="text-sm font-bold text-gray-400">Belum ada riwayat pesanan.</p>
                </div>
                @endforelse
            </div>
        </div>

        <div class="absolute bottom-0 w-full bg-white border-t border-gray-100 pt-3 pb-8 px-6 flex justify-between items-center z-40 rounded-b-[25px] shadow-[0_-10px_20px_rgba(0,0,0,0.03)]">
            <a href="{{ route('mahasiswa.home') }}" class="flex flex-col items-center gap-1 text-gray-400 hover:text-orange-500 transition-colors w-12"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" /></svg><span class="text-[10px] font-medium">Home</span></a>
            <a href="{{ route('mahasiswa.cart') }}" class="flex flex-col items-center gap-1 text-gray-400 hover:text-orange-500 transition-colors w-12"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg><span class="text-[10px] font-medium">Cart</span></a>
            <a href="{{ route('mahasiswa.order') }}" class="flex flex-col items-center gap-1 text-orange-500 w-12"><svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-8 14H7v-2h4v2zm4-4H7v-2h8v2zm0-4H7V7h8v2z" /></svg><span class="text-[10px] font-bold">Order</span></a>
            <a href="{{ route('mahasiswa.profile') }}" class="flex flex-col items-center gap-1 text-gray-400 hover:text-orange-500 transition-colors w-12"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg><span class="text-[10px] font-medium">Profile</span></a>
        </div>
    </div>

    <script>
        function switchTab(tabName) {
            // Reset semua tombol
            document.getElementById('tab-aktif').className = "flex-1 py-2 text-xs font-bold rounded-lg text-gray-400 hover:text-gray-600 transition-all";
            document.getElementById('tab-riwayat').className = "flex-1 py-2 text-xs font-bold rounded-lg text-gray-400 hover:text-gray-600 transition-all";
            // Sembunyikan semua konten
            document.getElementById('content-aktif').classList.remove('active');
            document.getElementById('content-riwayat').classList.remove('active');

            // Aktifkan tab terpilih
            document.getElementById('tab-' + tabName).className = "flex-1 py-2 text-xs font-bold rounded-lg bg-white text-orange-500 shadow-sm transition-all";
            document.getElementById('content-' + tabName).classList.add('active');
        }
    </script>
</body>
</html>