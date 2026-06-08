<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login / Sign Up - UnivBite</title>
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

        .input-underline {
            width: 100%;
            padding: 0.5rem 2rem 0.5rem 2rem;
            background-color: transparent;
            border: none;
            border-bottom: 2px solid #e5e7eb;
            font-size: 0.875rem;
            color: #374151;
            outline: none;
            transition: border-color 0.3s ease;
        }

        .input-underline:focus {
            border-bottom-color: #f97316;
        }

        .input-underline::placeholder {
            color: #d1d5db;
        }

        .icon-left {
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            color: #fb923c;
        }

        .icon-right {
            position: absolute;
            right: 0;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
            cursor: pointer;
            transition: color 0.2s;
        }

        .icon-right:hover {
            color: #f97316;
        }
    </style>
</head>

<body class="flex items-center justify-center min-h-screen">

    <div class="phone-frame">
        <div
            class="absolute top-0 w-full h-7 z-50 flex justify-between items-center px-6 text-[11px] font-bold text-gray-700 bg-transparent">
            <span>09:41</span>
            <div class="flex space-x-1 items-center tracking-widest">
                <span>📶</span><span>🔋</span>
            </div>
        </div>

        <div class="absolute top-0 left-0 w-full h-[400px] z-0 overflow-hidden pointer-events-none">
            <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg"
                class="w-full h-full transform -translate-y-12 opacity-80">
                <path fill="#fed7aa"
                    d="M29.6,-45.5C39.6,-33.5,49.8,-23.4,55.8,-10.3C61.8,2.8,63.6,18.8,56.7,31.7C49.8,44.5,34.2,54.1,17.2,60.8C0.3,67.4,-18,71,-32.8,64.6C-47.5,58.3,-58.8,41.9,-63.3,24C-67.9,6.1,-65.7,-13.4,-57.4,-29C-49.1,-44.5,-34.7,-56.1,-20.9,-61C-7,-65.9,6.2,-64,18.5,-58.5L29.6,-45.5Z"
                    transform="translate(60 30) scale(1.6)" />
            </svg>
        </div>

        <div class="relative z-10 flex-1 px-8 pt-12 pb-8 overflow-y-auto hide-scroll flex flex-col">
            <div class="flex mt-2 mb-10">
                <div class="flex items-center gap-1 text-orange-500">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                    </svg>
                </div>
            </div>

            <div id="login-view" class="transition-all duration-300 mt-4 flex-1">
                <h2 class="text-[32px] font-extrabold text-black mb-10">Login</h2>

                <form id="login-form" action="{{ route('login.post') }}" method="POST" class="space-y-8" novalidate>
                    @csrf
                    <div class="relative">
                        <span class="icon-left"><svg class="w-5 h-5" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                </path>
                            </svg></span>
                        <input type="email" name="email" class="input-underline" placeholder="Email" required>
                    </div>

                    <div class="relative">
                        <span class="icon-left"><svg class="w-5 h-5" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                </path>
                            </svg></span>
                        <input type="password" id="login-password" name="password" class="input-underline"
                            placeholder="Password" required>
                        <span class="icon-right" onclick="togglePassword('login-password')">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                </path>
                            </svg>
                        </span>
                    </div>

                    <div class="flex items-center justify-between text-xs mt-2">
                        <label class="flex items-center text-gray-500 cursor-pointer">
                            <input type="checkbox" name="remember"
                                class="mr-2 rounded text-orange-400 focus:ring-orange-400 border-gray-300 w-3 h-3">
                            Remember me
                        </label>
                        <a href="#" onclick="showForgotModal()" class="text-gray-500 hover:text-orange-500">Forgot
                            password?</a>
                    </div>

                    <button type="submit"
                        class="w-full bg-[#f6aa3d] hover:bg-orange-500 text-black font-bold py-3.5 px-4 rounded-lg shadow-md transition-colors mt-8 uppercase tracking-wide">
                        Login
                    </button>
                </form>

                <div class="text-center mt-6 text-xs text-black">
                    Don't have an account ? <button onclick="toggleView('register')"
                        class="text-orange-500 font-bold hover:underline">Sign Up</button>
                </div>
            </div>

            <div id="register-view" class="hidden transition-all duration-300 mt-0 flex-1">
                <h2 class="text-2xl font-extrabold text-black mb-6">Create an account</h2>

                <form action="{{ route('register') }}" method="POST" class="space-y-5">
                    @csrf

                    <div class="flex gap-2 bg-white p-1 rounded-lg border border-gray-100 shadow-sm">
                        <label class="flex-1 cursor-pointer">
                            <input type="radio" name="role" value="mahasiswa" class="peer hidden" {{ old('role', 'mahasiswa') == 'mahasiswa' ? 'checked' : '' }}>
                            <div
                                class="text-center py-1.5 text-xs font-semibold rounded-md peer-checked:bg-[#f6aa3d] peer-checked:text-black text-gray-400 transition-all">
                                Mahasiswa</div>
                        </label>
                        <label class="flex-1 cursor-pointer">
                            <input type="radio" name="role" value="tenant" class="peer hidden" {{ old('role') == 'tenant' ? 'checked' : '' }}>
                            <div
                                class="text-center py-1.5 text-xs font-semibold rounded-md peer-checked:bg-[#f6aa3d] peer-checked:text-black text-gray-400 transition-all">
                                Tenant</div>
                        </label>
                    </div>

                    <div class="relative">
                        <span class="icon-left"><svg class="w-4 h-4" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg></span>
                        <input type="text" name="nama_lengkap" class="input-underline" placeholder="Name"
                            value="{{ old('nama_lengkap') }}" required>
                    </div>

                    <div class="relative">
                        <span class="icon-left"><svg class="w-4 h-4" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                </path>
                            </svg></span>
                        <input type="email" name="email" class="input-underline" placeholder="Email"
                            value="{{ old('email') }}" required>
                    </div>

                    <div class="relative">
                        <span class="icon-left"><svg class="w-4 h-4" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                </path>
                            </svg></span>
                        <input type="tel" name="nomor_telepon" class="input-underline" placeholder="Phone Number"
                            value="{{ old('nomor_telepon') }}" required>
                    </div>

                    <div class="relative">
                        <span class="icon-left"><svg class="w-4 h-4" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                </path>
                            </svg></span>
                        <input type="password" id="reg-password" name="password" class="input-underline"
                            placeholder="Password" required>
                        <span class="icon-right" onclick="togglePassword('reg-password')">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                </path>
                            </svg>
                        </span>
                    </div>

                    <div class="relative">
                        <span class="icon-left"><svg class="w-4 h-4" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                </path>
                            </svg></span>
                        <input type="password" id="reg-confirm-password" name="password_confirmation"
                            class="input-underline" placeholder="Confirm Password" required>
                        <span class="icon-right" onclick="togglePassword('reg-confirm-password')">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                </path>
                            </svg>
                        </span>
                    </div>

                    <button type="submit"
                        class="w-full bg-[#f6aa3d] hover:bg-orange-500 text-black font-bold py-3.5 px-4 rounded-lg shadow-md transition-colors mt-6 uppercase tracking-wide">
                        Sign Up
                    </button>
                </form>

                <div class="text-center mt-6 text-xs text-black pb-4">
                    Already have an account ? <button onclick="toggleView('login')"
                        class="text-orange-500 font-bold hover:underline">Login</button>
                </div>
            </div>
        </div>

        <div
            class="w-full h-6 absolute bottom-0 z-50 flex justify-center items-center pb-2 bg-transparent pointer-events-none">
            <div class="w-1/3 h-1.5 bg-gray-300 rounded-full"></div>
        </div>
        <div id="toast-error"
            class="absolute top-12 left-1/2 transform -translate-x-1/2 bg-red-500 text-white text-xs font-bold py-2 px-4 rounded-full shadow-lg z-999 transition-opacity duration-300 opacity-0 pointer-events-none w-10/12 text-center">
            Pesan error di sini
        </div>
    </div>

    <div id="modal-forgot" class="fixed inset-0 bg-black bg-opacity-50 z-100 hidden items-center justify-center">
        <div class="bg-white rounded-2xl w-11/12 max-w-sm p-6 shadow-xl text-center">
            <h3 class="text-lg font-bold mb-2 text-gray-800">Reset Password</h3>
            <p class="text-xs text-gray-500 mb-4">Masukkan email Anda. Kami akan mengirimkan instruksi ke email
                tersebut.</p>
            <input type="email" class="input-underline mb-6 text-center pl-4 pr-4" placeholder="Email Address">
            <div class="flex gap-3">
                <button onclick="hideForgotModal()"
                    class="flex-1 bg-gray-100 text-gray-700 py-2.5 rounded-lg font-semibold text-sm">Cancel</button>
                <button onclick="sendResetCode()"
                    class="flex-1 bg-[#f6aa3d] text-black py-2.5 rounded-lg font-bold text-sm">Send</button>
            </div>
        </div>
    </div>

    <script>
        // Fitur Toggle Password Mata
        function togglePassword(inputId) {
            const input = document.getElementById(inputId);
            input.type = input.type === "password" ? "text" : "password";
        }

        // Transisi Halaman Login ke Sign Up
        function toggleView(viewType) {
            const loginView = document.getElementById('login-view');
            const registerView = document.getElementById('register-view');
            if (viewType === 'register') {
                loginView.classList.add('hidden');
                registerView.classList.remove('hidden');
            } else {
                registerView.classList.add('hidden');
                loginView.classList.remove('hidden');
            }
        }

        // Fungsi Modal Lupa Password
        function showForgotModal() { document.getElementById('modal-forgot').classList.remove('hidden'); }
        function hideForgotModal() { document.getElementById('modal-forgot').classList.add('hidden'); }
        function sendResetCode() {
            alert("Instruksi reset password telah dikirim ke email Anda!");
            hideForgotModal();
        }

        // Fitur Pop Up Notifikasi Cantik (Toast)
        function showToast(message, isError = true) {
            const toast = document.getElementById('toast-error');
            toast.innerText = message;

            // Atur warna berdasarkan status (hijau sukses, merah error)
            if (!isError) {
                toast.classList.remove('bg-red-500');
                toast.classList.add('bg-green-500');
            } else {
                toast.classList.remove('bg-green-500');
                toast.classList.add('bg-red-500');
            }

            // Munculkan lalu hilangkan otomatis setelah 3 detik
            toast.classList.remove('opacity-0');
            setTimeout(() => { toast.classList.add('opacity-0'); }, 3000);
        }

        // -------------------------------------------------------------
        // MENANGKAP PESAN DARI LARAVEL BACKEND
        // -------------------------------------------------------------

        // Tangkap Pesan Sukses (Saat berhasil Sign Up)
        @if (session('success'))
            toggleView('login');
            showToast("{{ session('success') }}", false); // false = warnanya hijau
        @endif

        // Tangkap Pesan Error Validasi (Saat Sign Up / Login Gagal)
        @if ($errors->any())
            // Cek jika errornya datang dari proses form Login
            @if(Session::has('errors') && request()->is('login') && request()->method() == 'POST')
                showToast("{{ $errors->first() }}", true);
                // Jika errornya datang dari proses form Sign Up
            @else
                toggleView('register');
                showToast("{{ $errors->first() }}", true);
            @endif
        @endif

        // Validasi Dasar HTML untuk Form Login agar tidak kosong saat di-submit
        document.getElementById('login-form').addEventListener('submit', function (e) {
            const emailInput = document.querySelector('#login-form input[name="email"]').value;
            const passwordInput = document.querySelector('#login-form input[name="password"]').value;

            if (emailInput.trim() === "" || !emailInput.includes('@') || passwordInput.trim() === "") {
                e.preventDefault(); // Tahan pengiriman
                showToast("Harap isi email dan password dengan benar!");
                return;
            }
        });
    </script>
</body>

</html>