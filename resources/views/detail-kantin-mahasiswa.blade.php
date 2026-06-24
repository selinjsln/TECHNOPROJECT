<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $kantin->nama_kantin }} - UnivBite</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { background-color: #cbd5e1; }
        .phone-frame { width: 100%; max-width: 390px; height: 844px; max-height: 95vh; margin: 2vh auto; background: #f8f9fa; position: relative; overflow: hidden; border-radius: 40px; border: 14px solid #1e293b; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5); display: flex; flex-direction: column; }
        .hide-scroll::-webkit-scrollbar { display: none; }
        .hide-scroll { -ms-overflow-style: none; scrollbar-width: none; }
        /* Hilangkan panah naik turun bawaan browser di input number */
        input[type="number"]::-webkit-inner-spin-button, 
        input[type="number"]::-webkit-outer-spin-button { -webkit-appearance: none; margin: 0; }
    </style>
</head>

<body class="flex items-center justify-center min-h-screen">
    <div class="phone-frame">
        <div class="px-6 pt-10 pb-4 bg-white rounded-b-[40px] shadow-sm z-20">
            <h1 class="font-extrabold text-2xl text-black">{{ $kantin->nama_kantin }}</h1>
            <p class="text-xs text-gray-400 font-medium mt-1">{{ $kantin->lokasi_gedung }}</p>
        </div>

        <div class="flex-1 px-6 pt-6 pb-10 overflow-y-auto hide-scroll">
            <h2 class="font-extrabold text-lg text-gray-800 mb-4">Daftar Menu</h2>
            
            <div class="space-y-4">
                @forelse($menus as $menu)
                <div class="bg-white p-4 rounded-3xl shadow-sm border border-gray-100 flex gap-4 items-center">
                    <div class="w-20 h-20 bg-orange-50 rounded-2xl flex items-center justify-center overflow-hidden flex-shrink-0">
                        @if($menu->foto)
                            <img src="{{ asset('storage/' . $menu->foto) }}" class="w-full h-full object-cover" alt="Menu">
                        @else
                            <span class="text-2xl">🍲</span>
                        @endif
                    </div>
                    <div class="flex-1">
                        <h3 class="font-extrabold text-gray-800 text-[15px] leading-tight">{{ $menu->nama_menu }}</h3>
                        <p class="text-[11px] text-gray-500 mb-1 mt-0.5 line-clamp-1">{{ $menu->deskripsi ?? 'Tanpa deskripsi' }}</p>
                        <p class="font-extrabold text-[#ed8936] text-[13px]">Rp {{ number_format($menu->harga, 0, ',', '.') }}</p>
                    </div>

                    <form action="{{ route('mahasiswa.cart.add') }}" method="POST" class="flex flex-col items-end gap-2">
                        @csrf
                        <input type="hidden" name="menu_id" value="{{ $menu->id }}">
                        
                        <div class="flex items-center gap-2 bg-gray-50 px-2 py-1 rounded-full border border-gray-100">
                            <button type="button" onclick="decreaseQty({{ $menu->id }})" class="w-6 h-6 bg-white rounded-full text-gray-500 font-extrabold flex items-center justify-center pb-0.5 shadow-sm hover:bg-gray-100">-</button>
                            <input type="number" name="quantity" id="qty-{{ $menu->id }}" value="1" class="w-4 text-center text-xs font-extrabold text-gray-800 bg-transparent outline-none pointer-events-none" readonly>
                            <button type="button" onclick="increaseQty({{ $menu->id }})" class="w-6 h-6 bg-[#ed8936] rounded-full text-white font-extrabold flex items-center justify-center pb-0.5 shadow-sm hover:bg-orange-600">+</button>
                        </div>
                        
                        <button type="submit" class="bg-orange-100 text-orange-500 font-extrabold text-[10px] px-3 py-1.5 rounded-lg hover:bg-orange-200 transition-colors w-full text-center">
                            + Keranjang
                        </button>
                    </form>
                </div>
                @empty
                <p class="text-center text-gray-400 text-sm mt-10">Belum ada menu di kantin ini.</p>
                @endforelse
            </div>
        </div>

        <div class="px-6 pb-8">
            <a href="{{ route('mahasiswa.cart') }}" class="w-full bg-[#1e293b] text-white font-extrabold py-4 rounded-2xl block text-center shadow-lg hover:bg-black transition-colors relative">
                <span class="absolute left-6 top-1/2 transform -translate-y-1/2">🛒</span>
                Lihat Keranjang
            </a>
        </div>
    </div>

    <script>
        function increaseQty(id) {
            let input = document.getElementById('qty-' + id);
            input.value = parseInt(input.value) + 1;
        }
        function decreaseQty(id) {
            let input = document.getElementById('qty-' + id);
            if (parseInt(input.value) > 1) {
                input.value = parseInt(input.value) - 1;
            }
        }
    </script>
</body>
</html>