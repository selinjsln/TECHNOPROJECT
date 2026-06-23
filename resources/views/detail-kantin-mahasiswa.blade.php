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
                        <h3 class="font-extrabold text-gray-800 text-[15px]">{{ $menu->nama_menu }}</h3>
                        <p class="text-[12px] text-gray-500 mb-1">{{ $menu->deskripsi }}</p>
                        <p class="font-extrabold text-[#ed8936] text-[13px]">Rp {{ number_format($menu->harga, 0, ',', '.') }}</p>
                    </div>

                    <form action="{{ route('mahasiswa.cart.add') }}" method="POST">
                        @csrf
                        <input type="hidden" name="menu_id" value="{{ $menu->id }}">
                        <input type="hidden" name="quantity" value="1">
                        <button type="submit" class="bg-orange-100 text-orange-500 font-extrabold text-[11px] px-3 py-1.5 rounded-lg hover:bg-orange-200 transition-colors">
                            + Tambah
                        </button>
                    </form>
                </div>
                @empty
                <p class="text-center text-gray-400 text-sm mt-10">Belum ada menu di kantin ini.</p>
                @endforelse
            </div>
        </div>

        <div class="px-6 pb-8">
            <a href="{{ route('mahasiswa.cart') }}" class="w-full bg-[#1e293b] text-white font-extrabold py-4 rounded-2xl block text-center shadow-lg hover:bg-black transition-colors">
                Lihat Keranjang
            </a>
        </div>
    </div>
</body>
</html>