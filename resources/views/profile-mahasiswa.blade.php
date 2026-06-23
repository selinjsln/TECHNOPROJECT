<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - UnivBite</title>
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
            background: #f8f9fa;
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

        .input-style {
            width: 100%;
            padding: 0.75rem;
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 0.75rem;
            font-size: 0.875rem;
            outline: none;
            transition: border-color 0.2s;
        }

        .input-style:focus {
            border-color: #f97316;
        }
    </style>
</head>

<body class="flex items-center justify-center min-h-screen">
    <div class="phone-frame">
        <div
            class="w-full h-7 z-50 flex justify-between items-center px-6 text-[11px] font-bold text-gray-400 bg-white pt-4 absolute top-0">
            <span class="text-gray-800">09:41</span>
            <div class="flex space-x-1 items-center text-blue-400"><span>📶</span><span class="text-green-500">🔋</span>
            </div>
        </div>

        <div class="bg-white pt-16 pb-8 rounded-b-[35px] flex flex-col items-center shadow-sm relative z-10">
            <div class="relative">
                <div
                    class="w-24 h-24 bg-[#ed8936] rounded-full flex items-center justify-center text-white text-3xl font-normal shadow-md overflow-hidden border-2 border-white">
                    <img id="main_profile_photo"
                        src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=f9fafb&color=f97316&size=150"
                        class="w-full h-full object-cover" alt="Profile">
                </div>

                <button type="button" onclick="showEditModal()"
                    class="absolute bottom-0 right-0 bg-[#ed8936] p-1.5 rounded-full border-2 border-white text-white shadow-sm hover:bg-orange-600 transition-colors">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                        </path>
                    </svg>
                </button>
            </div>

            <h1 class="font-extrabold text-xl text-gray-800 mt-4 tracking-tight">{{ $user->name }}</h1>
            <p class="text-[11px] text-gray-500 mt-0.5">Mahasiswa • {{ $user->email }}</p>
        </div>

        <div class="flex-1 px-6 pt-6 pb-24 overflow-y-auto hide-scroll">

            <div class="mb-6 bg-gradient-to-r from-[#f0a656] to-[#ed8936] rounded-2xl p-4 shadow-md shadow-orange-200 flex justify-between items-center text-white">
                <div class="flex items-center gap-3">
                    <div class="bg-white/20 p-2.5 rounded-xl backdrop-blur-sm">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-[11px] font-bold text-orange-50 tracking-wide">TOTAL POIN UNIVBITE</p>
                        <p class="text-2xl font-extrabold mt-0.5">{{ number_format(Auth::user()->points ?? 0, 0, ',', '.') }} <span class="text-xs font-medium">Pts</span></p>
                    </div>
                </div>
            </div>

            <div class="mb-6">
                <h3 class="text-[10px] font-extrabold text-gray-400 tracking-widest mb-3">ACCOUNT & SECURITY</h3>
                <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
                    <div
                        class="p-3.5 flex items-center justify-between border-b border-gray-50 cursor-pointer hover:bg-gray-50 transition-colors">
                        <div class="flex items-center gap-3">
                            <div class="bg-green-50 p-2 rounded-xl text-green-500">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                                    </path>
                                </svg>
                            </div>
                            <span class="text-[13px] font-bold text-gray-800">Account Safety</span>
                        </div>
                        <svg class="w-4 h-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                            </path>
                        </svg>
                    </div>
                    <div
                        class="p-3.5 flex items-center justify-between cursor-pointer hover:bg-gray-50 transition-colors">
                        <div class="flex items-center gap-3">
                            <div class="bg-purple-50 p-2 rounded-xl text-purple-500">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9">
                                    </path>
                                </svg>
                            </div>
                            <span class="text-[13px] font-bold text-gray-800">Languages</span>
                        </div>
                        <div class="flex items-center gap-1.5">
                            <span class="text-[11px] font-bold text-gray-400">Indonesia</span>
                            <svg class="w-4 h-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                </path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-8">
                <h3 class="text-[10px] font-extrabold text-gray-400 tracking-widest mb-3">PREFERENCE</h3>
                <div class="bg-white rounded-2xl p-3.5 flex items-center justify-between shadow-sm">
                    <div class="flex items-center gap-3">
                        <div class="bg-orange-50 p-2 rounded-xl text-orange-500">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12 3a9 9 0 109 9c0-.46-.04-.92-.1-1.36a5.389 5.389 0 01-4.4 2.26 5.403 5.403 0 01-3.14-9.8c-.44-.06-.9-.1-1.36-.1z">
                                </path>
                            </svg>
                        </div>
                        <span class="text-[13px] font-bold text-gray-800">Dark Mode</span>
                    </div>
                    <label class="inline-flex relative items-center cursor-pointer">
                        <input type="checkbox" class="sr-only peer">
                        <div
                            class="w-10 h-5 bg-gray-200 rounded-full peer peer-checked:bg-[#ed8936] peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:rounded-full after:h-4 after:w-4 after:transition-all shadow-inner">
                        </div>
                    </label>
                </div>
            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="w-full bg-white text-red-500 font-bold py-3.5 rounded-2xl shadow-sm border border-red-50 hover:bg-red-50 transition-colors text-sm">
                    Log Out
                </button>
            </form>

        </div>

        <div
            class="absolute bottom-0 w-full bg-white border-t border-gray-100 pt-3 pb-8 px-6 flex justify-between items-center z-40 rounded-b-[25px] shadow-[0_-10px_20px_rgba(0,0,0,0.03)]">
            <a href="{{ route('mahasiswa.home') }}"
                class="flex flex-col items-center gap-1 text-gray-400 hover:text-orange-500 transition-colors w-12"><svg
                    class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-width="2"
                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg><span class="text-[10px] font-medium">Home</span></a>
            <a href="{{ route('mahasiswa.cart') }}"
                class="flex flex-col items-center gap-1 text-gray-400 hover:text-orange-500 transition-colors w-12 relative"><svg
                    class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63-.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z">
                    </path>
                </svg><span
                    class="absolute -top-1 -right-1 bg-red-500 text-white text-[8px] font-bold px-1.5 py-0.5 rounded-full border border-white">2</span><span
                    class="text-[10px] font-medium">Cart</span></a>
            <a href="{{ route('mahasiswa.order') }}"
                class="flex flex-col items-center gap-1 text-gray-400 hover:text-orange-500 transition-colors w-12"><svg
                    class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4">
                    </path>
                </svg><span class="text-[10px] font-medium">Order</span></a>
            <a href="{{ route('mahasiswa.profile') }}" class="flex flex-col items-center gap-1 text-[#ed8936] w-12"><svg
                    class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                    <path
                        d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                </svg><span class="text-[10px] font-bold">Profile</span></a>
        </div>

        <div id="modal-edit-profile"
            class="absolute inset-0 bg-black bg-opacity-60 z-[100] hidden flex items-end justify-center">
            <div class="absolute inset-0" onclick="hideEditModal()"></div>

            <div class="bg-white rounded-t-[35px] w-full p-6 shadow-2xl transform transition-transform translate-y-full z-10"
                id="modal-content-profile">
                <div class="flex justify-between items-center mb-5 border-b border-gray-100 pb-4">
                    <h3 class="text-lg font-bold text-gray-800">Edit Profil</h3>
                    <button onclick="hideEditModal()"
                        class="text-gray-400 hover:text-gray-600 bg-gray-100 rounded-full p-1"><svg class="w-5 h-5"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg></button>
                </div>

                <form action="#" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf

                    <div class="flex items-center gap-4 p-3 bg-gray-50 rounded-xl border border-gray-100 cursor-pointer group"
                        onclick="document.getElementById('modal_photo_upload_input').click()">
                        <div
                            class="w-14 h-14 bg-orange-500 rounded-full flex items-center justify-center text-white relative overflow-hidden">
                            <img id="modal_photo_preview"
                                src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=f9fafb&color=f97316&size=150"
                                class="w-full h-full object-cover">
                            <div
                                class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center group-hover:bg-opacity-50 transition-all">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <p class="text-[12px] font-bold text-gray-800">Ganti Foto Profil</p>
                            <p class="text-[10px] text-gray-500">Tap untuk upload gambar (Max 2MB)</p>
                        </div>
                        <input type="file" id="modal_photo_upload_input" name="foto_profil" class="hidden"
                            accept="image/*">
                    </div>

                    <div>
                        <label class="text-[10px] font-bold text-gray-400 uppercase ml-1 mb-1 block">Nama
                            Lengkap</label>
                        <input type="text" name="name" value="{{ $user->name }}" class="input-style py-2.5 font-bold"
                            required>
                    </div>
                    <div>
                        <label class="text-[10px] font-bold text-gray-400 uppercase ml-1 mb-1 block">Email</label>
                        <input type="email" name="email" value="{{ $user->email }}"
                            class="input-style py-2.5 text-gray-500 bg-gray-100" readonly>
                        <p class="text-[9px] text-gray-400 ml-1 mt-1">*Email kampus tidak dapat diubah</p>
                    </div>

                    <button type="submit"
                        class="w-full bg-[#ed8936] hover:bg-orange-600 text-white font-extrabold py-3.5 rounded-xl shadow-md transition-colors mt-4">
                        Simpan Perubahan
                    </button>
                </form>
            </div>
        </div>

        <div
            class="w-full h-6 absolute bottom-0 z-[110] flex justify-center items-center pb-2 bg-transparent pointer-events-none">
            <div class="w-1/3 h-1.5 bg-gray-300 rounded-full"></div>
        </div>
    </div>

    <script>
        // JS UNTUK MODAL
        const modalProfile = document.getElementById('modal-edit-profile');
        const modalContentProfile = document.getElementById('modal-content-profile');

        function showEditModal() {
            modalProfile.classList.remove('hidden');
            setTimeout(() => { modalContentProfile.classList.remove('translate-y-full'); }, 10);
        }

        function hideEditModal() {
            modalContentProfile.classList.add('translate-y-full');
            setTimeout(() => { modalProfile.classList.add('hidden'); }, 300);
        }

        // JS UNTUK PREVIEW FOTO DI DALAM MODAL
        document.getElementById('modal_photo_upload_input').addEventListener('change', function (event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    document.getElementById('modal_photo_preview').src = e.target.result;
                    document.getElementById('main_profile_photo').src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>

</html>