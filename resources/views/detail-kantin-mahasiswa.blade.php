<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}"> <title>{{ $kantin->nama_kantin }} - UnivBite</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { background-color: #cbd5e1; }
        .phone-frame { width: 100%; max-width: 390px; height: 844px; max-height: 95vh; margin: 2vh auto; background: #f8f9fa; position: relative; overflow: hidden; border-radius: 40px; border: 14px solid #1e293b; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5); display: flex; flex-direction: column; }
        .hide-scroll::-webkit-scrollbar { display: none; }
        .hide-scroll { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>

<body class="flex items-center justify-center min-h-screen">
    <div class="phone-frame">
        
        <div class="px-6 pt-10 pb-4 bg-white rounded-b-[40px] shadow-sm z-20 relative">
            <div class="absolute top-4 left-6 right-6 flex justify-between items-center text-[11px] font-bold text-gray-700">
                <span>09:41</span>
                <div class="flex space-x-1 items-center text-blue-400"><span>📶</span><span class="text-green-500">🔋</span></div>
            </div>
            <div class="mt-6 flex items-center gap-3">
                <a href="{{ route('mahasiswa.home') }}" class="w-8 h-8 bg-gray-50 rounded-full flex items-center justify-center text-gray-600 hover:bg-gray-100 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"></path></svg>
                </a>
                <div>
                    <h1 class="font-extrabold text-2xl text-black leading-none">{{ $kantin->nama_kantin }}</h1>
                    <p class="text-[11px] text-gray-400 font-bold mt-1">{{ $kantin->lokasi_gedung }}</p>
                </div>
            </div>
        </div>

        <div class="flex-1 px-6 pt-6 pb-10 overflow-y-auto hide-scroll relative z-10">
            <h2 class="font-extrabold text-lg text-gray-800 mb-4">Daftar Menu</h2>
            
            <div class="space-y-4">
                @forelse($menus as $menu)
                <div class="bg-white p-4 rounded-3xl shadow-sm border border-gray-100 flex gap-4 items-center">
                    
                    <div class="w-[75px] h-[75px] bg-orange-50 rounded-2xl flex items-center justify-center overflow-hidden flex-shrink-0 shadow-inner">
                        @if($menu->foto)
                            <img src="{{ asset('storage/' . $menu->foto) }}" class="w-full h-full object-cover" alt="Menu">
                        @else
                            <span class="text-2xl">🍲</span>
                        @endif
                    </div>
                    
                    <div class="flex-1">
                        <h3 class="font-extrabold text-gray-800 text-[15px] leading-tight">{{ $menu->nama_menu }}</h3>
                        <p class="text-[11px] text-gray-400 mb-1 mt-0.5 line-clamp-1">{{ $menu->deskripsi ?? 'Tanpa deskripsi' }}</p>
                        
                        <div class="flex justify-between items-center mt-2">
                            <p class="font-extrabold text-[#ed8936] text-[13px]">Rp {{ number_format($menu->harga, 0, ',', '.') }}</p>
                            
                            <div class="flex items-center gap-3 bg-gray-50 px-2 py-1.5 rounded-full border border-gray-100">
                                <button type="button" onclick="updateQty({{ $menu->id }}, 'decrease')" class="w-7 h-7 bg-white rounded-full text-gray-500 font-extrabold flex items-center justify-center shadow-sm hover:bg-gray-200 transition-colors">-</button>
                                
                                <span id="qty-{{ $menu->id }}" class="w-4 text-center text-sm font-extrabold text-gray-800">0</span>
                                
                                <button type="button" onclick="updateQty({{ $menu->id }}, 'increase')" class="w-7 h-7 bg-[#ed8936] rounded-full text-white font-extrabold flex items-center justify-center shadow-sm hover:bg-orange-600 transition-colors">+</button>
                            </div>

                        </div>
                    </div>
                </div>
                @empty
                <p class="text-center text-gray-400 text-sm mt-10">Belum ada menu di kantin ini.</p>
                @endforelse
            </div>
        </div>

        <div class="px-6 pb-8 relative z-20">
            <a href="{{ route('mahasiswa.cart') }}" class="w-full bg-[#1e293b] text-white font-extrabold py-4 rounded-2xl block text-center shadow-xl shadow-gray-300 hover:bg-black transition-transform active:scale-95 relative overflow-hidden group">
                <span class="absolute left-6 top-1/2 transform -translate-y-1/2">🛒</span>
                Lihat Keranjang
                <svg class="w-5 h-5 absolute right-6 top-1/2 transform -translate-y-1/2 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </a>
        </div>

        <div id="action-toast" class="absolute top-12 left-1/2 transform -translate-x-1/2 bg-gray-800 text-white text-[11px] leading-snug font-bold py-2.5 px-5 rounded-full shadow-lg z-[200] transition-all duration-300 opacity-0 -translate-y-4 pointer-events-none whitespace-nowrap flex items-center gap-2">
            <span id="toast-message">Diupdate!</span>
        </div>
    </div>

    <script>
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        let toastTimeout;

        function updateQty(menuId, action) {
            let qtySpan = document.getElementById('qty-' + menuId);
            let currentQty = parseInt(qtySpan.innerText);

            // Mencegah angka minus
            if (action === 'decrease' && currentQty === 0) return;

            // Update angka secara visual seketika (UX yang responsif)
            if (action === 'increase') {
                qtySpan.innerText = currentQty + 1;
                showToast("Dimasukkan ke keranjang!");
            } else if (action === 'decrease') {
                qtySpan.innerText = currentQty - 1;
                showToast("Dikeluarkan dari keranjang!");
            }

            // Kirim data ke backend Laravel di belakang layar
            let formData = new FormData();
            formData.append('_token', csrfToken);
            formData.append('menu_id', menuId);
            formData.append('quantity', 1); // Kirim 1 per klik
            formData.append('action', action); 

            fetch("{{ route('mahasiswa.cart.add') }}", {
                method: 'POST',
                body: formData
            }).catch(error => {
                console.error("Terjadi kesalahan:", error);
            });
        }

        function showToast(message) {
            const toast = document.getElementById('action-toast');
            document.getElementById('toast-message').innerText = message;
            
            toast.classList.remove('opacity-0', '-translate-y-4');
            toast.classList.add('opacity-100', 'translate-y-0');
            
            clearTimeout(toastTimeout);
            toastTimeout = setTimeout(() => { 
                toast.classList.remove('opacity-100', 'translate-y-0');
                toast.classList.add('opacity-0', '-translate-y-4');
            }, 1500);
        }
    </script>
</body>
</html>