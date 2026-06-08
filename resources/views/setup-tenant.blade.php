<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buka Kantin Baru - UnivBite</title>
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
            border-radius: 40px;
            border: 14px solid #1e293b;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        .input-style {
            width: 100%;
            padding: 0.8rem;
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 0.8rem;
            font-size: 0.875rem;
            outline: none;
            transition: border 0.3s;
        }

        .input-style:focus {
            border-color: #f97316;
        }
    </style>
</head>

<body class="flex items-center justify-center min-h-screen">
    <div class="phone-frame">
        <div class="absolute top-0 w-full h-40 bg-orange-500 rounded-b-[40px] z-0"></div>

        <div class="p-8 z-10 mt-16 flex-1 overflow-y-auto">
            <div class="bg-white p-6 rounded-3xl shadow-lg border border-gray-100">
                <div class="text-4xl mb-2 text-center">🏪</div>
                <h2 class="text-xl font-extrabold text-center text-black leading-tight">Satu langkah lagi!</h2>
                <p class="text-xs text-center text-gray-500 mt-2 mb-6">Lengkapi profil kantinmu untuk mulai berjualan.
                </p>

                <form action="{{ route('tenant.setup.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="text-[10px] font-bold text-gray-400 uppercase ml-1">Nama Kantin</label>
                        <input type="text" name="nama_kantin" class="input-style mt-1"
                            placeholder="Cth: Ayam Geprek Best" required>
                    </div>

                    <div>
                        <label class="text-[10px] font-bold text-gray-400 uppercase ml-1">Pilih Universitas</label>
                        <select name="universitas" class="input-style mt-1" required>
                            <option value="" disabled selected>Pilih Kampus...</option>
                            @foreach($universitas as $univ)
                                <option value="{{ $univ->nama_univ }}">{{ $univ->nama_univ }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="text-[10px] font-bold text-gray-400 uppercase ml-1">Lokasi Gedung / Lantai</label>
                        <input type="text" name="lokasi_gedung" class="input-style mt-1"
                            placeholder="Cth: Gedung P, Lantai 1" required>
                    </div>

                    <div>
                        <label class="text-[10px] font-bold text-gray-400 uppercase ml-1">Deskripsi Pendek</label>
                        <textarea name="deskripsi" class="input-style mt-1 h-20"
                            placeholder="Cth: Jagonya ayam pedas di kampus!"></textarea>
                    </div>

                    <button type="submit"
                        class="w-full bg-[#f6aa3d] text-black font-bold py-3.5 rounded-xl shadow-md mt-4 transition-transform active:scale-95 uppercase tracking-wide">
                        Buka Kantin Sekarang
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>