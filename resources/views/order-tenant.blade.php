<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Management - UnivBite</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { background-color: #cbd5e1; }
        .phone-frame {
            width: 100%; max-width: 390px; height: 844px; max-height: 95vh;
            margin: 2vh auto; background: #fffcf8; position: relative;
            overflow: hidden; border-radius: 40px; border: 14px solid #1e293b;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            display: flex; flex-direction: column;
        }
        .hide-scroll::-webkit-scrollbar { display: none; }
        .hide-scroll { -ms-overflow-style: none; scrollbar-width: none; }
        .tab-content { display: none; animation: fadeIn 0.3s ease-in-out; }
        .tab-content.active { display: block; }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(5px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>

<body class="flex items-center justify-center min-h-screen">

    <div class="phone-frame">
        <div class="w-full h-7 z-50 flex justify-between items-center px-6 text-[11px] font-bold text-gray-700 bg-transparent pt-4">
            <span>09:41</span>
            <div class="flex space-x-1 items-center tracking-widest"><span>📶</span><span>🔋</span></div>
        </div>

        <div class="px-6 pt-4 pb-2 bg-white shadow-sm z-40 rounded-b-3xl mb-2">
            <h1 class="font-extrabold text-2xl text-black">Pesanan Masuk</h1>
            <p class="text-xs text-gray-500 mt-1">Kelola pesanan dari mahasiswa di sini.</p>

            @php
                $countBaru = $orders->where('order_status', 'pending')->count();
                $countProses = $orders->whereIn('order_status', ['processing', 'ready'])->count();
            @endphp

            <div class="flex mt-4 bg-gray-50 p-1 rounded-xl">
                <button onclick="switchTab('baru')" id="tab-baru" class="flex-1 py-2 text-xs font-bold rounded-lg bg-white text-orange-500 shadow-sm transition-all">Baru ({{ $countBaru }})</button>
                <button onclick="switchTab('proses')" id="tab-proses" class="flex-1 py-2 text-xs font-bold rounded-lg text-gray-400 hover:text-gray-600 transition-all">Proses ({{ $countProses }})</button>
                <button onclick="switchTab('riwayat')" id="tab-riwayat" class="flex-1 py-2 text-xs font-bold rounded-lg text-gray-400 hover:text-gray-600 transition-all">Riwayat</button>
            </div>
        </div>

        @if(session('success'))
        <div class="mx-6 mt-2 bg-green-500 text-white text-xs font-bold py-2 px-4 rounded-full text-center">
            {{ session('success') }}
        </div>
        @endif

        <div class="flex-1 px-6 pt-2 pb-24 overflow-y-auto hide-scroll relative">

            <div id="content-baru" class="tab-content active space-y-4">
                @forelse($orders->where('order_status', 'pending') as $order)
                <div class="bg-white p-4 rounded-2xl shadow-sm border border-orange-100 relative">
                    <div class="absolute -top-2 -right-2 bg-red-500 text-white text-[10px] font-bold px-2 py-1 rounded-full animate-pulse">Baru Saja</div>

                    <div class="flex justify-between items-start mb-2 border-b border-gray-50 pb-2">
                        <div>
                            <p class="text-[10px] text-gray-400 font-bold">Order ID: #ORD-{{ $order->id }}</p>
                            <h3 class="font-bold text-gray-800 text-sm mt-0.5">{{ $order->user->name ?? 'Mahasiswa' }}</h3>
                        </div>
                        <p class="text-xs font-bold text-orange-500">Rp {{ number_format($order->grand_total, 0, ',', '.') }}</p>
                    </div>

                    <div class="space-y-1 mb-4">
                        <p class="text-xs text-gray-600 flex justify-between">
                            <span>Total Tagihan Item</span>
                            <span>Rp {{ number_format($order->subtotal, 0, ',', '.') }}</span>
                        </p>
                        @if($order->discount > 0)
                            <p class="text-xs text-green-500 flex justify-between">
                                <span>Diskon Voucher</span>
                                <span>-Rp {{ number_format($order->discount, 0, ',', '.') }}</span>
                            </p>
                        @endif
                    </div>

                    <div class="flex gap-3 mt-3">
                        <form action="{{ route('tenant.order.update_status', $order->id) }}" method="POST" class="w-1/3">
                            @csrf
                            <input type="hidden" name="status" value="cancelled">
                            <button type="submit" class="w-full py-2.5 rounded-xl text-xs font-bold text-red-500 bg-red-50 hover:bg-red-100 transition-colors">Tolak</button>
                        </form>
                        
                        <form action="{{ route('tenant.order.update_status', $order->id) }}" method="POST" class="flex-1">
                            @csrf
                            <input type="hidden" name="status" value="processing">
                            <button type="submit" class="w-full py-2.5 rounded-xl text-xs font-bold text-white bg-orange-500 hover:bg-orange-600 transition-colors shadow-md shadow-orange-200">Terima Pesanan</button>
                        </form>
                    </div>
                </div>
                @empty
                <div class="text-center text-gray-400 text-xs py-10">Belum ada pesanan baru hari ini.</div>
                @endforelse
            </div>

            <div id="content-proses" class="tab-content space-y-4">
                @forelse($orders->whereIn('order_status', ['processing', 'ready']) as $order)
                <div class="bg-white p-4 rounded-2xl shadow-sm border border-gray-100 relative">
                    
                    @if($order->order_status == 'processing')
                        <div class="absolute -top-2 -right-2 bg-blue-500 text-white text-[10px] font-bold px-2 py-1 rounded-full">Dimasak</div>
                    @else
                        <div class="absolute -top-2 -right-2 bg-yellow-400 text-white text-[10px] font-bold px-2 py-1 rounded-full">Siap Diambil</div>
                    @endif

                    <div class="flex justify-between items-start mb-2 border-b border-gray-50 pb-2">
                        <div>
                            <p class="text-[10px] text-gray-400 font-bold">Order ID: #ORD-{{ $order->id }}</p>
                            <h3 class="font-bold text-gray-800 text-sm mt-0.5">{{ $order->user->name ?? 'Mahasiswa' }}</h3>
                        </div>
                        <p class="text-xs font-bold text-orange-500">Rp {{ number_format($order->grand_total, 0, ',', '.') }}</p>
                    </div>

                    @if($order->order_status == 'processing')
                        <form action="{{ route('tenant.order.update_status', $order->id) }}" method="POST" class="mt-4">
                            @csrf
                            <input type="hidden" name="status" value="ready">
                            <button type="submit" class="w-full py-3 rounded-xl text-xs font-bold text-white bg-blue-500 hover:bg-blue-600 transition-colors shadow-md flex justify-center items-center gap-1">
                                Tandai Siap Diambil
                            </button>
                        </form>
                    @elseif($order->order_status == 'ready')
                        <form action="{{ route('tenant.order.update_status', $order->id) }}" method="POST" class="mt-4">
                            @csrf
                            <input type="hidden" name="status" value="completed">
                            <button type="submit" class="w-full py-3 rounded-xl text-xs font-bold text-white bg-green-500 hover:bg-green-600 transition-colors shadow-md shadow-green-200 flex justify-center items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                Pesanan Sudah Diambil (Selesai)
                            </button>
                        </form>
                    @endif
                </div>
                @empty
                <div class="text-center text-gray-400 text-xs py-10">Tidak ada pesanan yang sedang diproses.</div>
                @endforelse
            </div>

            <div id="content-riwayat" class="tab-content space-y-4">
                @forelse($orders->whereIn('order_status', ['completed', 'cancelled'])->sortByDesc('updated_at') as $order)
                <div class="bg-gray-50 p-4 rounded-2xl border border-gray-100 opacity-75">
                    <div class="flex justify-between items-center mb-2">
                        <p class="text-[10px] text-gray-400 font-bold">{{ $order->updated_at->format('d M, H:i') }}</p>
                        
                        @if($order->order_status == 'completed')
                            <span class="text-[10px] font-bold text-green-600 bg-green-100 px-2 py-0.5 rounded">Selesai</span>
                        @else
                            <span class="text-[10px] font-bold text-red-600 bg-red-100 px-2 py-0.5 rounded">Ditolak/Batal</span>
                        @endif
                    </div>
                    
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="font-bold text-gray-700 text-sm">{{ $order->user->name ?? 'Mahasiswa' }}</h3>
                            <p class="text-[10px] text-gray-500">Order ID: #ORD-{{ $order->id }}</p>
                        </div>
                        <p class="text-xs font-bold text-gray-600">Rp {{ number_format($order->grand_total, 0, ',', '.') }}</p>
                    </div>
                </div>
                @empty
                <div class="text-center text-gray-400 text-xs py-10">Belum ada riwayat pesanan.</div>
                @endforelse
            </div>

        </div>

        <div class="absolute bottom-0 w-full bg-white border-t border-gray-100 pt-3 pb-8 px-6 flex justify-between items-center z-40 rounded-b-[25px] shadow-[0_-10px_20px_rgba(0,0,0,0.03)]">
            <a href="{{ route('tenant.home') }}" class="flex flex-col items-center gap-1 text-gray-400 hover:text-orange-500 transition-colors w-12"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="2" d="M4 6h16v2H4zm2-4h12v2H6zm14 8H4c-1.1 0-2 .9-2 2v8h20v-8c0-1.1-.9-2-2-2zm-9 8H9v-2h2v2zm5 0h-2v-2h2v2z" /></svg><span class="text-[10px] font-medium">Canteen</span></a>
            <a href="{{ route('tenant.order') }}" class="flex flex-col items-center gap-1 text-orange-500 w-12 relative"><svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-8 14H7v-2h4v2zm4-4H7v-2h8v2zm0-4H7V7h8v2z" /></svg>
                @if($countBaru > 0)
                    <span class="absolute -top-1 -right-1 bg-red-500 text-white text-[8px] font-bold px-1.5 py-0.5 rounded-full border border-white">{{ $countBaru }}</span>
                @endif
                <span class="text-[10px] font-bold">Order</span>
            </a>
            <a href="{{ route('tenant.income') }}" class="flex flex-col items-center gap-1 text-gray-400 hover:text-orange-500 transition-colors w-12"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg><span class="text-[10px] font-medium">Income</span></a>
            <a href="{{ route('tenant.profile') }}" class="flex flex-col items-center gap-1 text-gray-400 hover:text-orange-500 transition-colors w-12"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg><span class="text-[10px] font-medium">Profile</span></a>
        </div>

        <div class="w-full h-6 absolute bottom-0 z-50 flex justify-center items-center pb-2 bg-transparent pointer-events-none">
            <div class="w-1/3 h-1.5 bg-gray-300 rounded-full"></div>
        </div>
    </div>

    <script>
        function switchTab(tabName) {
            document.querySelectorAll('[id^="tab-"]').forEach(btn => {
                btn.className = "flex-1 py-2 text-xs font-bold rounded-lg text-gray-400 hover:text-gray-600 transition-all";
            });
            document.querySelectorAll('.tab-content').forEach(content => {
                content.classList.remove('active');
            });

            const activeBtn = document.getElementById('tab-' + tabName);
            activeBtn.className = "flex-1 py-2 text-xs font-bold rounded-lg bg-white text-orange-500 shadow-sm transition-all";
            document.getElementById('content-' + tabName).classList.add('active');
        }
    </script>
</body>

</html>