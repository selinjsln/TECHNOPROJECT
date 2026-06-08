<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - UnivBite</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { background-color: #cbd5e1; } 
        .phone-frame { 
            width: 100%; max-width: 390px; height: 844px; max-height: 95vh;
            margin: 2vh auto; background: #f8fafc;
            position: relative; overflow: hidden; border-radius: 40px;
            border: 14px solid #1e293b; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            display: flex; flex-direction: column;
        }
        .hide-scroll { -ms-overflow-style: none; scrollbar-width: none; }
        .hide-scroll::-webkit-scrollbar { display: none; }
        /* Style untuk input style bawaan modal (dipertahankan kalau kamu butuh di form lain) */
        .input-style {
            width: 100%; padding: 0.75rem; background: #f9fafb;
            border: 1px solid #e5e7eb; border-radius: 0.75rem;
            font-size: 0.875rem; outline: none; transition: border-color 0.2s;
        }
        .input-style:focus { border-color: #f97316; }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen">

<div class="phone-frame">
    <div class="w-full h-7 z-50 flex justify-between items-center px-6 text-[11px] font-bold text-white bg-orange-500 pt-4 relative">
        <span>09:41</span>
        <div class="flex space-x-1 items-center tracking-widest"><span>📶</span><span>🔋</span></div>
    </div>

    <div class="bg-orange-500 px-6 pt-8 pb-12 rounded-b-[40px] text-white shadow-md relative z-10 flex flex-col items-center">
        <div class="relative">
            <div class="w-24 h-24 bg-white rounded-full p-1 shadow-lg flex items-center justify-center overflow-hidden cursor-pointer" id="profile_photo_container">
                <img id="profile_photo_preview" src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=f9fafb&color=f97316&size=150" alt="Profile" class="w-full h-full rounded-full object-cover">
            </div>
            <button id="profile_edit_pencil_btn" class="absolute bottom-0 right-0 bg-white text-orange-500 p-2 rounded-full shadow-md hover:bg-gray-50 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
            </button>
        </div>
        
        <h1 class="font-extrabold text-2xl mt-4 tracking-tight text-center">{{ $tenant->nama_kantin ?? 'Kantin Belum Diatur' }}</h1>
        <p class="text-xs opacity-90 mt-1 flex items-center gap-1">
            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path></svg>
            Pemilik: {{ $user->name }}
        </p>
    </div>

    <div class="flex-1 px-6 pt-6 pb-24 overflow-y-auto hide-scroll -mt-6">
        
        <div class="bg-white p-5 rounded-3xl shadow-sm border border-gray-100 mb-6 space-y-4">
            <div>
                <p class="text-[10px] text-gray-400 font-bold uppercase tracking-wider mb-1">Kampus</p>
                <p class="text-sm font-bold text-gray-800">{{ $tenant->universitas ?? '-' }}</p>
            </div>
            <div class="h-px w-full bg-gray-50"></div>
            <div>
                <p class="text-[10px] text-gray-400 font-bold uppercase tracking-wider mb-1">Lokasi Gedung</p>
                <p class="text-sm font-bold text-gray-800">{{ $tenant->lokasi_gedung ?? '-' }}</p>
            </div>
            <div class="h-px w-full bg-gray-50"></div>
            <div>
                <p class="text-[10px] text-gray-400 font-bold uppercase tracking-wider mb-1">Deskripsi Kantin</p>
                <p class="text-xs text-gray-600 leading-relaxed">{{ $tenant->deskripsi ?? 'Belum ada deskripsi.' }}</p>
            </div>

            <div class="h-px w-full bg-gray-50 my-4"></div>
            <div id="payment_qris_container" class="flex justify-between items-center bg-orange-50 hover:bg-orange-100 transition-colors p-3 rounded-xl border border-orange-100 cursor-pointer">
                <div class="flex items-center gap-3">
                    <div class="bg-orange-500 text-white p-1.5 rounded-lg">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm14 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path></svg>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-gray-800">Metode Pembayaran (QRIS)</p>
                        <p class="text-[9px] text-gray-500" id="payment_qris_status_text">Atur QRIS untuk transaksi</p>
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <img id="qris_photo_preview" src="" class="h-6 w-auto hidden rounded shadow-inner" alt="Preview QRIS">
                    <svg class="w-4 h-4 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </div>
            </div>
        </div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full bg-red-50 hover:bg-red-100 text-red-500 font-extrabold py-3.5 rounded-2xl transition-colors flex items-center justify-center gap-2 border border-red-100">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                Keluar dari Aplikasi
            </button>
        </form>
    </div>

    <input type="file" id="profile_photo_upload_input" style="display: none;" accept="image/*">
    <input type="file" id="qris_photo_upload_input" style="display: none;" accept="image/*">

    <div class="absolute bottom-0 w-full bg-white border-t border-gray-100 pt-3 pb-8 px-6 flex justify-between items-center z-40 rounded-b-[25px] shadow-[0_-10px_20px_rgba(0,0,0,0.03)]">
        <a href="{{ route('tenant.home') }}" class="flex flex-col items-center gap-1 text-gray-400 hover:text-orange-500 transition-colors w-12"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="2" d="M4 6h16v2H4zm2-4h12v2H6zm14 8H4c-1.1 0-2 .9-2 2v8h20v-8c0-1.1-.9-2-2-2zm-9 8H9v-2h2v2zm5 0h-2v-2h2v2z"/></svg><span class="text-[10px] font-medium">Canteen</span></a>
        
        <a href="{{ route('tenant.order') }}" class="flex flex-col items-center gap-1 text-gray-400 hover:text-orange-500 transition-colors w-12 relative"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg><span class="text-[10px] font-medium">Order</span></a>
        
        <a href="{{ route('tenant.income') }}" class="flex flex-col items-center gap-1 text-gray-400 hover:text-orange-500 transition-colors w-12"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg><span class="text-[10px] font-medium">Income</span></a>
        
        <a href="{{ route('tenant.profile') }}" class="flex flex-col items-center gap-1 text-orange-500 w-12"><svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg><span class="text-[10px] font-bold">Profile</span></a>
    </div>

    <div class="w-full h-6 absolute bottom-0 z-50 flex justify-center items-center pb-2 bg-transparent pointer-events-none"><div class="w-1/3 h-1.5 bg-gray-300 rounded-full"></div></div>
</div>

<script>
    // --- JAVASCRIPT UNTUK UPLOAD FOTO PROFIL ---
    const profileContainer = document.getElementById('profile_photo_container');
    const profilePencilBtn = document.getElementById('profile_edit_pencil_btn');
    const profileInput = document.getElementById('profile_photo_upload_input');
    const profilePreview = document.getElementById('profile_photo_preview');

    // Klik foto atau pensil untuk trigger upload
    profileContainer.addEventListener('click', () => profileInput.click());
    profilePencilBtn.addEventListener('click', () => profileInput.click());

    profileInput.addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                // Tampilkan preview langsung di halaman
                profilePreview.src = e.target.result;
            }
            reader.readAsDataURL(file);
        }
    });

    // --- JAVASCRIPT UNTUK UPLOAD QRIS ---
    const qrisContainer = document.getElementById('payment_qris_container');
    const qrisInput = document.getElementById('qris_photo_upload_input');
    const qrisPreview = document.getElementById('qris_photo_preview');
    const qrisStatusText = document.getElementById('payment_qris_status_text');

    // Klik bagian payment untuk trigger upload QRIS
    qrisContainer.addEventListener('click', () => qrisInput.click());

    qrisInput.addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                // Tampilkan preview foto QRIS kecil di samping tanda panah
                qrisPreview.src = e.target.result;
                qrisPreview.classList.remove('hidden');
                
                // Ubah teks status
                qrisStatusText.innerText = "Ganti QRIS QR";
            }
            reader.readAsDataURL(file);
        }
    });
</script>
</body>
</html>