<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Tenant - UnivBite</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background-color: #cbd5e1;
            transition: all 0.3s;
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
            transition: background 0.3s;
        }

        /* Dark Mode Support */
        .dark-mode .phone-frame {
            background: #1a1a1a;
            color: white;
        }

        .dark-mode .bg-white {
            background: #2d2d2d !important;
            border-color: #444 !important;
        }

        .dark-mode .text-black,
        .dark-mode h1,
        .dark-mode h2,
        .dark-mode h3 {
            color: white !important;
        }

        .dark-mode .text-gray-800,
        .dark-mode .text-gray-700 {
            color: #e5e7eb !important;
        }

        .dark-mode .bg-gray-50,
        .dark-mode .bg-gray-100 {
            background: #3d3d3d !important;
        }

        .hide-scroll::-webkit-scrollbar {
            display: none;
        }

        .hide-scroll {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        .menu-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1rem;
            border-bottom: 1px solid #f3f4f6;
            cursor: pointer;
            transition: background 0.2s;
        }

        .menu-item:active {
            background: #fff7ed;
        }

        .sub-page {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: #fffcf8;
            z-index: 60;
            transform: translateX(100%);
            transition: transform 0.3s ease-in-out;
        }

        .dark-mode .sub-page {
            background: #1a1a1a;
        }

        .sub-page.active {
            transform: translateX(0);
        }

        .input-style {
            width: 100%;
            padding: 0.75rem;
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 0.75rem;
            font-size: 0.875rem;
            outline: none;
            margin-top: 0.5rem;
        }

        .dark-mode .input-style {
            background: #3d3d3d;
            border-color: #555;
            color: white;
        }
    </style>
</head>

<body class="flex items-center justify-center min-h-screen">

    <div class="phone-frame" id="appFrame">
        <div
            class="w-full h-7 z-50 flex justify-between items-center px-6 text-[11px] font-bold text-gray-700 bg-transparent pt-4 dark:text-gray-300">
            <span>09:41</span>
            <div class="flex space-x-1 items-center tracking-widest">
                <span>📶</span><span>🔋</span>
            </div>
        </div>

        <div class="flex-1 overflow-y-auto hide-scroll pb-24">
            <div class="flex flex-col items-center pt-8 pb-6 bg-white rounded-b-[40px] shadow-sm relative">
                <div class="relative">
                    <div class="w-24 h-24 rounded-full border-4 border-orange-100 overflow-hidden bg-gray-200">
                        <img id="profileImage"
                            src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=f97316&color=fff"
                            class="w-full h-full object-cover">
                    </div>
                    <button onclick="openSubPage('page-edit-profile')"
                        class="absolute bottom-0 right-0 bg-orange-500 text-white p-2 rounded-full shadow-lg">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                            </path>
                        </svg>
                    </button>
                </div>
                <h2 class="mt-4 font-extrabold text-xl text-gray-800">{{ $tenant->nama_kantin ?? 'Tenant UnivBite' }}
                </h2>
                <p class="text-xs text-gray-500">{{ $user->email }}</p>
            </div>

            <div class="px-6 mt-6">
                <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Operational</h3>
                <div class="bg-white rounded-2xl overflow-hidden shadow-sm border border-gray-50">
                    <div class="menu-item" onclick="openSubPage('page-payment')">
                        <div class="flex items-center gap-3">
                            <span class="p-2 bg-blue-50 text-blue-500 rounded-lg">💳</span>
                            <span class="text-sm font-semibold">Payment Settings</span>
                        </div>
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M9 5l7 7-7 7"></path>
                        </svg>
                    </div>
                </div>

                <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-2 mt-6">Account & Security</h3>
                <div class="bg-white rounded-2xl overflow-hidden shadow-sm border border-gray-50">
                    <div class="menu-item" onclick="openSubPage('page-safety')">
                        <div class="flex items-center gap-3">
                            <span class="p-2 bg-green-50 text-green-500 rounded-lg">🛡️</span>
                            <span class="text-sm font-semibold">Account Safety</span>
                        </div>
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M9 5l7 7-7 7"></path>
                        </svg>
                    </div>
                    <div class="menu-item" onclick="openSubPage('page-language')">
                        <div class="flex items-center gap-3">
                            <span class="p-2 bg-purple-50 text-purple-500 rounded-lg">🌐</span>
                            <span class="text-sm font-semibold">Languages</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="text-[10px] text-gray-400 font-bold" id="currentLangLabel">Indonesia</span>
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M9 5l7 7-7 7"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-2 mt-6">Preference</h3>
                <div class="bg-white rounded-2xl overflow-hidden shadow-sm border border-gray-50">
                    <div class="menu-item">
                        <div class="flex items-center gap-3">
                            <span class="p-2 bg-yellow-50 text-yellow-500 rounded-lg">🌓</span>
                            <span class="text-sm font-semibold">Dark Mode</span>
                        </div>
                        <label class="inline-flex relative items-center cursor-pointer">
                            <input type="checkbox" id="darkModeToggle" class="sr-only peer" onchange="toggleDarkMode()">
                            <div
                                class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:after:translate-x-full peer-checked:bg-orange-500 after:content-[''] after:absolute after:top-0.5 after:left-0.5 after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all">
                            </div>
                        </label>
                    </div>
                </div>

                <button onclick="openSubPage('page-manage')"
                    class="w-full mt-8 mb-10 p-4 bg-red-50 text-red-500 rounded-2xl font-bold text-sm flex items-center justify-center gap-2 active:scale-95 transition-transform">
                    <span>⚙️</span> Manage Account
                </button>
            </div>
        </div>

        <div id="page-edit-profile" class="sub-page p-8">
            <button onclick="closeSubPage('page-edit-profile')" class="mb-6 text-gray-400 flex items-center gap-1">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg> Kembali
            </button>
            <h2 class="text-xl font-extrabold mb-6">Edit Profil</h2>
            <div class="space-y-4">
                <div>
                    <label class="text-xs font-bold text-gray-400 uppercase">Nama Kantin</label>
                    <input type="text" class="input-style" value="{{ $tenant->nama_kantin ?? '' }}">
                </div>
                <div>
                    <label class="text-xs font-bold text-gray-400 uppercase">Nomor Telepon</label>
                    <input type="tel" class="input-style" value="{{ $user->nomor_telepon ?? '' }}">
                </div>
                <button onclick="saveSimulated()"
                    class="w-full bg-orange-500 text-white font-bold py-3 rounded-xl mt-4">Simpan Perubahan</button>
            </div>
        </div>

        <div id="page-payment" class="sub-page p-8">
            <button onclick="closeSubPage('page-payment')" class="mb-6 text-gray-400 flex items-center gap-1">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg> Kembali
            </button>
            <h2 class="text-xl font-extrabold mb-2">Metode Pembayaran</h2>
            <p class="text-xs text-gray-500 mb-6">QRIS akan muncul pada struk pesanan mahasiswa.</p>

            <div
                class="p-6 border-2 border-dashed border-gray-200 rounded-2xl flex flex-col items-center justify-center bg-gray-50 mb-6">
                <span class="text-4xl mb-2">📷</span>
                <span class="text-[10px] font-bold text-gray-400 uppercase">Ganti QRIS QR</span>
            </div>

            <div>
                <label class="text-xs font-bold text-gray-400 uppercase">Keterangan Bank (Opsional)</label>
                <input type="text" class="input-style" placeholder="Cth: BCA - 123456789">
            </div>
            <button onclick="saveSimulated()"
                class="w-full bg-orange-500 text-white font-bold py-3 rounded-xl mt-6">Update Payment</button>
        </div>

        <div id="page-safety" class="sub-page p-8">
            <button onclick="closeSubPage('page-safety')" class="mb-6 text-gray-400 flex items-center gap-1">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg> Kembali
            </button>
            <h2 class="text-xl font-extrabold mb-6">Keamanan Akun</h2>
            <div class="space-y-4">
                <div>
                    <label class="text-xs font-bold text-gray-400 uppercase">Email Terdaftar</label>
                    <input type="email" class="input-style" value="{{ $user->email }}">
                </div>
                <div>
                    <label class="text-xs font-bold text-gray-400 uppercase">PIN / Password Baru</label>
                    <input type="password"
                        class="input-underline border-b border-gray-200 w-full py-2 outline-none dark:bg-transparent"
                        placeholder="••••••••">
                </div>
                <button onclick="saveSimulated()"
                    class="w-full bg-orange-500 text-white font-bold py-3 rounded-xl mt-4">Update Security</button>
            </div>
        </div>

        <div id="page-language" class="sub-page p-8">
            <button onclick="closeSubPage('page-language')" class="mb-6 text-gray-400 flex items-center gap-1">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg> Kembali
            </button>
            <h2 class="text-xl font-extrabold mb-6">Pilih Bahasa</h2>
            <div class="space-y-3">
                <button onclick="setLang('Indonesia')"
                    class="w-full p-4 border border-orange-500 rounded-xl flex justify-between items-center text-orange-500 font-bold">
                    Bahasa Indonesia <span>🇮🇩</span>
                </button>
                <button onclick="setLang('English')"
                    class="w-full p-4 border border-gray-100 rounded-xl flex justify-between items-center font-bold">
                    English <span>🇺🇸</span>
                </button>
            </div>
        </div>

        <div id="page-manage" class="sub-page p-8">
            <button onclick="closeSubPage('page-manage')" class="mb-6 text-gray-400 flex items-center gap-1">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg> Kembali
            </button>
            <h2 class="text-xl font-extrabold mb-6 text-red-500">Manage Account</h2>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit"
                    class="w-full p-4 bg-gray-100 text-gray-700 rounded-xl font-bold flex items-center justify-center gap-2 mb-4">
                    🚪 Logout dari Aplikasi
                </button>
            </form>

            <div class="mt-12 p-4 border border-red-100 rounded-2xl bg-red-50">
                <h4 class="font-bold text-red-600 text-sm mb-1">Hapus Akun Permanen</h4>
                <p class="text-[10px] text-red-400 mb-4">Tindakan ini tidak bisa dibatalkan. Semua data menu dan riwayat
                    pendapatan akan hilang.</p>
                <button class="w-full py-2 bg-red-500 text-white rounded-lg font-bold text-xs uppercase">Delete
                    Account</button>
            </div>
        </div>

        <div
            class="absolute bottom-0 w-full bg-white border-t border-gray-100 pt-3 pb-8 px-6 flex justify-between items-center z-50 rounded-b-[25px] shadow-[0_-10px_20px_rgba(0,0,0,0.03)]">
            <a href="{{ route('tenant.home') }}" class="flex flex-col items-center gap-1 text-gray-400 w-12">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-width="2"
                        d="M4 6h16v2H4zm2-4h12v2H6zm14 8H4c-1.1 0-2 .9-2 2v8h20v-8c0-1.1-.9-2-2-2zm-9 8H9v-2h2v2zm5 0h-2v-2h2v2z" />
                </svg>
                <span class="text-[10px] font-medium">Canteen</span>
            </a>
            <button class="flex flex-col items-center gap-1 text-gray-400 w-12"><svg class="w-6 h-6" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-width="2"
                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4">
                    </path>
                </svg><span class="text-[10px] font-medium">Order</span></button>
            <button class="flex flex-col items-center gap-1 text-gray-400 w-12"><svg class="w-6 h-6" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-width="2"
                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                    </path>
                </svg><span class="text-[10px] font-medium">Income</span></button>
            <button class="flex flex-col items-center gap-1 text-orange-500 w-12">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                    <path
                        d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                </svg>
                <span class="text-[10px] font-bold">Profile</span>
            </button>
        </div>

        <div
            class="w-full h-6 absolute bottom-0 z-50 flex justify-center items-center pb-2 bg-transparent pointer-events-none">
            <div class="w-1/3 h-1.5 bg-gray-300 rounded-full"></div>
        </div>
    </div>

    <script>
        function openSubPage(id) {
            document.getElementById(id).classList.add('active');
        }
        function closeSubPage(id) {
            document.getElementById(id).classList.remove('active');
        }

        // Toggle Dark Mode
        function toggleDarkMode() {
            const isChecked = document.getElementById('darkModeToggle').checked;
            if (isChecked) {
                document.body.classList.add('dark-mode');
            } else {
                document.body.classList.remove('dark-mode');
            }
        }

        // Set Language Simulation
        function setLang(lang) {
            document.getElementById('currentLangLabel').innerText = lang;
            alert("Bahasa diganti menjadi " + lang);
            closeSubPage('page-language');
        }

        function saveSimulated() {
            alert("Data berhasil diperbarui!");
            // Tutup semua sub-page yang sedang aktif
            document.querySelectorAll('.sub-page').forEach(page => page.classList.remove('active'));
        }
    </script>
</body>

</html>