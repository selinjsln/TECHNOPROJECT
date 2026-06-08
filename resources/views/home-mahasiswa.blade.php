<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - UnivBite</title>
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
            /* Background cream pastel khas aplikasimu */
            position: relative;
            overflow: hidden;
            border-radius: 40px;
            border: 14px solid #1e293b;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            display: flex;
            flex-direction: column;
        }

        .hide-scroll {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        .hide-scroll::-webkit-scrollbar {
            display: none;
        }
    </style>
</head>

<body class="flex items-center justify-center min-h-screen">

    <div class="phone-frame">
        <div
            class="w-full h-7 z-50 flex justify-between items-center px-6 text-[11px] font-bold text-gray-700 bg-transparent pt-4">
            <span>09:41</span>
            <div class="flex space-x-1 items-center tracking-widest text-blue-400"><span>📶</span><span
                    class="text-green-500">🔋</span></div>
        </div>

        <div class="px-6 pt-6 pb-2 relative z-10">
            <p class="text-xs text-gray-400 font-medium">Lokasi Kampus Saat Ini</p>
            <div class="flex items-center gap-1 mt-0.5 cursor-pointer">
                <h1 class="font-extrabold text-xl text-black">Universitas Kristen Petra</h1>
                <svg class="w-4 h-4 text-orange-500 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7"></path>
                </svg>
            </div>

            <p class="text-sm text-gray-600 mt-4">
                Halo, <span class="font-bold text-orange-500">{{ $user->name }}</span>! Mau makan apa hari ini?
            </p>
        </div>

        <div class="flex-1 px-6 pt-4 pb-24 overflow-y-auto hide-scroll">
            <div class="space-y-4">

                @forelse($daftar_kantin as $kantin)
                    <div class="bg-white p-4 rounded-[24px] shadow-[0_4px_20px_rgba(0,0,0,0.03)] border border-gray-50">
                        <div class="w-20 h-20 bg-orange-50 rounded-2xl flex items-center justify-center text-4xl mb-3">
                            🍲
                        </div>

                        <h3 class="font-extrabold text-gray-800 text-[17px]">{{ $kantin->nama_kantin }}</h3>
                        <p class="text-[10px] text-gray-500 mt-1">
                            {{ $kantin->lokasi_gedung }} • {{ $kantin->deskripsi ?? 'Kantin favorit mahasiswa' }}
                        </p>

                        <div class="flex justify-between items-center mt-4 pt-4 border-t border-gray-50">
                            <a href="/kantin/{{ $kantin->id }}"
                                class="text-orange-500 font-bold text-[13px] flex items-center gap-1 hover:text-orange-600 transition-colors">
                                Kunjungi Kantin
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                        d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                </svg>
                            </a>

                            @if($kantin->is_open)
                                <span
                                    class="bg-green-50 text-green-500 text-[11px] font-extrabold px-3 py-1 rounded-lg tracking-wide">Buka</span>
                            @else
                                <span
                                    class="bg-red-50 text-red-500 text-[11px] font-extrabold px-3 py-1 rounded-lg tracking-wide">Tutup</span>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="text-center py-10">
                        <p class="text-gray-400 text-sm">Belum ada kantin yang terdaftar 😔</p>
                    </div>
                @endforelse

            </div>
        </div>

        <div
            class="absolute bottom-0 w-full bg-white border-t border-gray-100 pt-3 pb-8 px-6 flex justify-between items-center z-40 rounded-b-[25px] shadow-[0_-10px_20px_rgba(0,0,0,0.03)]">
            <a href="{{ route('mahasiswa.home') }}" class="flex flex-col items-center gap-1 text-orange-500 w-12">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z" />
                </svg>
                <span class="text-[10px] font-bold">Home</span>
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
            <a href="{{ route('mahasiswa.order') }}"
                class="flex flex-col items-center gap-1 text-gray-400 hover:text-orange-500 transition-colors w-12">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4">
                    </path>
                </svg>
                <span class="text-[10px] font-medium">Order</span>
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

        <div
            class="w-full h-6 absolute bottom-0 z-[110] flex justify-center items-center pb-2 bg-transparent pointer-events-none">
            <div class="w-1/3 h-1.5 bg-gray-300 rounded-full"></div>
        </div>
    </div>

</body>

</html>