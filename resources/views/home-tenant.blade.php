<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Tenant Dashboard - UnivBite</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { background-color: #cbd5e1; } 
        .phone-frame { 
            width: 100%; max-width: 390px; height: 844px; max-height: 95vh;
            margin: 2vh auto; background: #fffcf8; position: relative; overflow: hidden; 
            border-radius: 40px; border: 14px solid #1e293b; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            display: flex; flex-direction: column;
        }
        .hide-scroll::-webkit-scrollbar { display: none; }
        .hide-scroll { -ms-overflow-style: none; scrollbar-width: none; }
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
    <div class="w-full h-7 z-50 flex justify-between items-center px-6 text-[11px] font-bold text-gray-700 bg-transparent pt-4">
        <span>09:41</span><div class="flex space-x-1 items-center tracking-widest"><span>📶</span><span>🔋</span></div>
    </div>

    <div class="px-6 pt-4 pb-4 bg-white shadow-sm z-40 rounded-b-3xl mb-2 flex justify-between items-center">
        <div class="flex-1 overflow-hidden pr-2">
            <h1 class="font-extrabold text-xl text-black truncate">{{ $tenant->nama_kantin ?? 'Kantin Baru' }}</h1>
            <p class="text-xs text-gray-500 truncate">{{ $tenant->universitas ?? 'Lokasi belum diatur' }}</p>
        </div>
        <div class="flex flex-col items-center">
            <span class="text-[9px] font-bold mb-1 {{ $tenant->is_open ? 'text-gray-400' : 'text-red-500' }}" id="status-kantin-text">
                {{ $tenant->is_open ? 'Buka Kantin' : 'Kantin Tutup' }}
            </span>
            <label class="inline-flex relative items-center cursor-pointer">
                <input type="checkbox" id="toggle-kantin-btn" class="sr-only peer" {{ $tenant->is_open ? 'checked' : '' }}>
                <div class="w-11 h-6 bg-gray-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-orange-500 shadow-inner"></div>
            </label>
        </div>
    </div>

    <div class="flex-1 px-6 pt-2 pb-24 overflow-y-auto hide-scroll">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-sm font-bold text-gray-800">Daftar Menu Makanan</h2>
            <button onclick="showModal()" class="bg-orange-100 hover:bg-orange-200 text-orange-600 text-xs font-bold px-3 py-1.5 rounded-full transition-colors flex items-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg> Tambah
            </button>
        </div>

        <div class="space-y-4">
            @forelse($menus as $menu)
                <div class="bg-white p-3 rounded-2xl shadow-sm border border-gray-100 flex gap-3 relative">
                    <div class="w-20 h-20 bg-orange-50 rounded-xl flex items-center justify-center text-3xl overflow-hidden border border-gray-100">
                        @if($menu->foto)
                            <img src="{{ asset('storage/' . $menu->foto) }}" class="w-full h-full object-cover" alt="Foto Menu">
                        @else
                            🍛
                        @endif
                    </div>
                    <div class="flex-1">
                        <div class="flex justify-between items-start">
                            <h3 class="font-bold text-gray-800 text-sm w-3/4 truncate">{{ $menu->nama_menu }}</h3>
                            <button onclick="showEditModal({{ $menu->id }}, '{{ addslashes($menu->nama_menu) }}', '{{ $menu->harga }}', '{{ addslashes($menu->deskripsi) }}', '{{ $menu->foto ? asset('storage/' . $menu->foto) : '' }}')" class="text-gray-400 hover:text-orange-500">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                            </button>
                        </div>
                        <p class="text-[10px] text-gray-500 line-clamp-1 mt-0.5">{{ $menu->deskripsi }}</p>
                        <p class="text-xs font-bold text-orange-500 mt-1">Rp {{ number_format($menu->harga, 0, ',', '.') }}</p>
                        
                        <div class="mt-2 flex items-center justify-between">
                            <span id="stok-text-{{ $menu->id }}" class="text-[10px] font-semibold {{ $menu->is_available ? 'text-green-600' : 'text-red-500' }}">
                                {{ $menu->is_available ? 'Stok Tersedia' : 'Stok Habis' }}
                            </span>
                            <label class="inline-flex relative items-center cursor-pointer transform scale-75 origin-right">
                                <input type="checkbox" onchange="toggleStok({{ $menu->id }}, this)" class="sr-only peer" {{ $menu->is_available ? 'checked' : '' }}>
                                <div class="w-11 h-6 bg-gray-300 rounded-full peer peer-checked:bg-green-500 after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:after:translate-x-full"></div>
                            </label>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-20 bg-white rounded-3xl border-2 border-dashed border-gray-200 mt-4">
                    <div class="text-5xl mb-4 text-gray-300">🥗</div>
                    <h3 class="font-bold text-gray-800 text-sm">Kantinmu belum ada menu</h3>
                    <p class="text-[11px] text-gray-400 mt-1 px-10">Yuk tambah sekarang!</p>
                    <button onclick="showModal()" class="mt-5 bg-orange-500 text-white text-xs font-bold px-6 py-2.5 rounded-full shadow-md shadow-orange-200 hover:bg-orange-600">Tambah Menu Pertama</button>
                </div>
            @endforelse
        </div>
    </div>

    <div class="absolute bottom-0 w-full bg-white border-t border-gray-100 pt-3 pb-8 px-6 flex justify-between items-center z-40 rounded-b-[25px] shadow-[0_-10px_20px_rgba(0,0,0,0.03)]">
        <a href="{{ route('tenant.home') }}" class="flex flex-col items-center gap-1 text-orange-500 w-12"><svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M4 6h16v2H4zm2-4h12v2H6zm14 8H4c-1.1 0-2 .9-2 2v8h20v-8c0-1.1-.9-2-2-2zm-9 8H9v-2h2v2zm5 0h-2v-2h2v2z"/></svg><span class="text-[10px] font-bold">Canteen</span></a>
        <a href="{{ route('tenant.order') }}" class="flex flex-col items-center gap-1 text-gray-400 hover:text-orange-500 transition-colors w-12 relative"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg><span class="absolute -top-1 -right-1 bg-red-500 text-white text-[8px] font-bold px-1.5 py-0.5 rounded-full border border-white">1</span><span class="text-[10px] font-medium">Order</span></a>
        <a href="{{ route('tenant.income') }}" class="flex flex-col items-center gap-1 text-gray-400 hover:text-orange-500 transition-colors w-12"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg><span class="text-[10px] font-medium">Income</span></a>
        <a href="{{ route('tenant.profile') }}" class="flex flex-col items-center gap-1 text-gray-400 hover:text-orange-500 transition-colors w-12"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg><span class="text-[10px] font-medium">Profile</span></a>
    </div>

    <div id="modal-menu" class="absolute inset-0 bg-black bg-opacity-60 z-[100] hidden flex items-end justify-center">
        <div class="absolute inset-0" onclick="hideModal()"></div>
        <div class="bg-white rounded-t-[35px] w-full p-6 shadow-2xl transform transition-transform translate-y-full z-10" id="modal-content">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-bold text-gray-800">Tambah Menu Baru</h3>
                <button onclick="hideModal()" class="text-gray-400 hover:text-gray-600 bg-gray-100 rounded-full p-1"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></button>
            </div>
            <form action="{{ route('tenant.menu.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <label for="foto-upload" class="w-full h-28 border-2 border-dashed rounded-xl flex flex-col items-center justify-center cursor-pointer transition-colors bg-white relative overflow-hidden group @error('foto') border-red-500 text-red-500 bg-red-50 @else border-orange-200 text-orange-400 hover:bg-orange-50 @enderror">
                    <img id="preview-img" class="absolute inset-0 w-full h-full object-cover hidden" alt="Preview">
                    <div id="upload-placeholder" class="flex flex-col items-center">
                        <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                        <span class="text-[10px] font-bold">Tap untuk Pilih Foto (Max 2MB)</span>
                    </div>
                    <input type="file" id="foto-upload" name="foto" class="hidden" accept="image/*" onchange="previewImage(event, 'preview-img', 'upload-placeholder')">
                </label>
                
                <div>
                    <label class="text-[10px] font-bold text-gray-400 uppercase ml-1 mb-1 block">Nama Menu</label>
                    <input type="text" name="nama_menu" class="input-style py-2.5 font-bold" placeholder="Cth: Nasi Goreng Gila" required>
                </div>
                <div>
                    <label class="text-[10px] font-bold text-gray-400 uppercase ml-1 mb-1 block">Harga</label>
                    <div class="relative">
                        <span class="absolute left-3 top-2.5 font-bold text-gray-500">Rp</span>
                        <input type="text" class="input-style py-2.5 pl-9 font-bold" placeholder="15.000" onkeyup="formatRupiah(this, 'harga-real')" required>
                        <input type="hidden" name="harga" id="harga-real" required>
                    </div>
                </div>
                <div>
                    <label class="text-[10px] font-bold text-gray-400 uppercase ml-1 mb-1 block">Deskripsi (Opsional)</label>
                    <textarea name="deskripsi" class="input-style h-16 py-2.5" placeholder="Isian, Porsi, dll"></textarea>
                </div>
                <button type="submit" class="w-full bg-[#f6aa3d] hover:bg-orange-500 text-black font-extrabold py-3.5 rounded-xl shadow-md transition-colors mt-2 mb-2">Simpan Menu</button>
            </form>
        </div>
    </div>

    <div id="modal-edit-menu" class="absolute inset-0 bg-black bg-opacity-60 z-[100] hidden flex items-end justify-center">
        <div class="absolute inset-0" onclick="hideEditModal()"></div>
        <div class="bg-white rounded-t-[35px] w-full p-6 shadow-2xl transform transition-transform translate-y-full z-10" id="modal-content-edit">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-bold text-gray-800">Edit Menu</h3>
                <button onclick="hideEditModal()" class="text-gray-400 hover:text-gray-600 bg-gray-100 rounded-full p-1"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></button>
            </div>
            
            <form id="form-edit" action="" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <label for="edit-foto-upload" class="w-full h-28 border-2 border-dashed border-orange-200 text-orange-400 hover:bg-orange-50 rounded-xl flex flex-col items-center justify-center cursor-pointer transition-colors bg-white relative overflow-hidden group">
                    <img id="edit-preview-img" class="absolute inset-0 w-full h-full object-cover hidden" alt="Preview">
                    <div id="edit-upload-placeholder" class="flex flex-col items-center">
                        <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                        <span class="text-[10px] font-bold">Ganti Foto (Opsional)</span>
                    </div>
                    <input type="file" id="edit-foto-upload" name="foto" class="hidden" accept="image/*" onchange="previewImage(event, 'edit-preview-img', 'edit-upload-placeholder')">
                </label>
                
                <div>
                    <label class="text-[10px] font-bold text-gray-400 uppercase ml-1 mb-1 block">Nama Menu</label>
                    <input type="text" id="edit-nama" name="nama_menu" class="input-style py-2.5 font-bold" required>
                </div>
                <div>
                    <label class="text-[10px] font-bold text-gray-400 uppercase ml-1 mb-1 block">Harga</label>
                    <div class="relative">
                        <span class="absolute left-3 top-2.5 font-bold text-gray-500">Rp</span>
                        <input type="text" id="edit-harga-display" class="input-style py-2.5 pl-9 font-bold" onkeyup="formatRupiah(this, 'edit-harga-real')" required>
                        <input type="hidden" name="harga" id="edit-harga-real" required>
                    </div>
                </div>
                <div>
                    <label class="text-[10px] font-bold text-gray-400 uppercase ml-1 mb-1 block">Deskripsi (Opsional)</label>
                    <textarea id="edit-deskripsi" name="deskripsi" class="input-style h-16 py-2.5"></textarea>
                </div>
                <button type="submit" class="w-full bg-[#f6aa3d] hover:bg-orange-500 text-black font-extrabold py-3.5 rounded-xl shadow-md transition-colors mt-2 mb-2">Simpan Perubahan</button>
            </form>
        </div>
    </div>

    <div class="w-full h-6 absolute bottom-0 z-[110] flex justify-center items-center pb-2 bg-transparent pointer-events-none"><div class="w-1/3 h-1.5 bg-gray-300 rounded-full"></div></div>
</div>

<script>
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

    // --- LOGIKA MODAL ---
    const modal = document.getElementById('modal-menu');
    const modalContent = document.getElementById('modal-content');
    const modalEdit = document.getElementById('modal-edit-menu');
    const modalContentEdit = document.getElementById('modal-content-edit');

    function showModal() {
        modal.classList.remove('hidden');
        setTimeout(() => { modalContent.classList.remove('translate-y-full'); }, 10);
    }
    function hideModal() {
        modalContent.classList.add('translate-y-full');
        setTimeout(() => { modal.classList.add('hidden'); }, 300);
    }
    
    function showEditModal(id, nama, harga, deskripsi, fotoUrl) {
        document.getElementById('form-edit').action = '/edit-menu/' + id;
        document.getElementById('edit-nama').value = nama;
        document.getElementById('edit-harga-real').value = harga;
        document.getElementById('edit-harga-display').value = new Intl.NumberFormat('id-ID').format(harga);
        document.getElementById('edit-deskripsi').value = deskripsi;

        const preview = document.getElementById('edit-preview-img');
        const placeholder = document.getElementById('edit-upload-placeholder');
        if(fotoUrl) {
            preview.src = fotoUrl; preview.classList.remove('hidden'); placeholder.classList.add('hidden');
        } else {
            preview.classList.add('hidden'); placeholder.classList.remove('hidden');
        }
        modalEdit.classList.remove('hidden');
        setTimeout(() => { modalContentEdit.classList.remove('translate-y-full'); }, 10);
    }
    function hideEditModal() {
        modalContentEdit.classList.add('translate-y-full');
        setTimeout(() => { modalEdit.classList.add('hidden'); }, 300);
    }

    // --- FUNGSI GLOBAL (FOTO & RUPIAH) ---
    function previewImage(event, previewId, placeholderId) {
        const input = event.target;
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById(previewId).src = e.target.result;
                document.getElementById(previewId).classList.remove('hidden');
                document.getElementById(placeholderId).classList.add('hidden');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function formatRupiah(input, hiddenId) {
        let angkaAsli = input.value.replace(/[^,\d]/g, '').toString();
        document.getElementById(hiddenId).value = angkaAsli;
        if (angkaAsli) { input.value = new Intl.NumberFormat('id-ID').format(angkaAsli); } 
        else { input.value = ''; }
    }

    // --- AJAX: TOGGLE KANTIN (BUKA/TUTUP) ---
    const toggleKantin = document.getElementById('toggle-kantin-btn');
    const textKantin = document.getElementById('status-kantin-text');
    
    toggleKantin.addEventListener('change', function() {
        // 1. Ubah tulisan secara visual
        if(this.checked) {
            textKantin.innerText = "Buka Kantin";
            textKantin.classList.remove('text-red-500');
            textKantin.classList.add('text-gray-400');
        } else {
            textKantin.innerText = "Kantin Tutup";
            textKantin.classList.remove('text-gray-400');
            textKantin.classList.add('text-red-500');
        }
        
        // 2. Simpan ke Database
        fetch('/toggle-kantin', {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': csrfToken, 'Content-Type': 'application/json' }
        });
    });

    // --- AJAX: TOGGLE STOK MAKANAN ---
    function toggleStok(id, checkboxEl) {
        const textSpan = document.getElementById('stok-text-' + id);
        
        // 1. Ubah tulisan dan warna secara visual
        if(checkboxEl.checked) {
            textSpan.innerText = 'Stok Tersedia';
            textSpan.className = 'text-[10px] font-semibold text-green-600';
        } else {
            textSpan.innerText = 'Stok Habis';
            textSpan.className = 'text-[10px] font-semibold text-red-500';
        }

        // 2. Simpan ke Database tanpa loading
        fetch('/toggle-stok/' + id, {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': csrfToken, 'Content-Type': 'application/json' }
        });
    }

    // --- TOAST NOTIFICATION ---
    function showToast(message, isError = false) {
        let toast = document.getElementById('toast-notification');
        if(!toast) {
            toast = document.createElement('div'); toast.id = 'toast-notification';
            toast.className = 'absolute top-12 left-1/2 transform -translate-x-1/2 text-white text-[11px] leading-tight font-bold py-2.5 px-4 rounded-xl shadow-lg z-[999] transition-opacity duration-300 opacity-0 pointer-events-none w-10/12 text-center flex items-center justify-center gap-2';
            document.querySelector('.phone-frame').appendChild(toast);
        }
        toast.innerHTML = (isError ? '⚠️ ' : '✅ ') + message;
        if(isError) { toast.classList.remove('bg-green-500'); toast.classList.add('bg-red-500'); } 
        else { toast.classList.remove('bg-red-500'); toast.classList.add('bg-green-500'); }
        toast.classList.remove('opacity-0'); 
        setTimeout(() => { toast.classList.add('opacity-0'); }, 4000);
    }

    @if(session('success')) showToast("{{ session('success') }}"); @endif
    @if($errors->any()) showToast("{{ $errors->first() }}", true); @endif
</script>
</body>
</html>