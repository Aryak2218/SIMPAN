<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Artikel</title>
    <script src="https://cdn.tailwindcss.com"></script>
     <link rel="stylesheet" href="{{ asset('lte/plugins/fontawesome-free/css/all.min.css') }}">
     <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
</head>
<body class="bg-white text-gray-900">

    {{-- Breadcrumb --}}
    <div class="text-sm text-gray-500 p-6">
        <a href="{{ route('landing') }}" class="hover:underline">Beranda</a> &gt;
        <a href="#" class="hover:underline">Pengetahuan</a> &gt;
        <span>{{ $artikel->judul }}</span>
    </div>

    <div class="max-w-6xl mx-auto px-6 grid md:grid-cols-4 gap-10">
        {{-- Konten Utama --}}
        <div class="md:col-span-3">
            {{-- Badge Kategori --}}
            <div class="inline-block bg-gray-200 text-gray-800 px-3 py-1 rounded-full text-sm mb-3">
                {{ $artikel->kategori->nama_kategori }}
            </div>

            {{-- Judul --}}
            <h1 class="text-3xl font-bold mb-4">
                {{ $artikel->judul }}
            </h1>

            {{-- Metadata --}}
            <div class="flex items-center text-sm text-gray-500 space-x-4 mb-6">
                <span>📅 Diperbarui: {{ $artikel->updated_at->format('d-m-Y') }}</span>
                <span>👤 Dibuat oleh: {{ $artikel->user->name }}</span>
                <span></span>
            </div>

            {{-- Ringkasan --}}
            <h2 id="ringkasan" class="text-xl font-semibold mb-2">Ringkasan</h2>
            <p class="mb-6 text-gray-700 leading-relaxed">
                {{ $artikel->excerpt }}
            </p>

            {{-- Konten Lengkap (jika login) --}}
            {{-- auth --}}
            <p class="mb-6 text-gray-700 leading-relaxed">
                {{ $artikel->isi }}
            </p>

            {{-- Menampilkan File SPBE --}}
            {{-- @if($artikel->spbe && $artikel->spbe->file_path)
                <a href="{{ asset('storage/' . $artikel->spbe->file_path) }}" class="btn btn-success mt-3" target="_blank">
                    <i class="fas fa-download"></i> Download Dokumen
                </a>
            @else
                <p class="mt-3">Dokumen tidak tersedia.</p>
            @endif --}}
            {{-- endauth --}}

            {{-- Box login (jika belum login) --}}
            <div class="border border-gray-300 p-6 rounded-lg bg-gray-50 text-center">
                {{-- <p class="text-lg font-medium mb-4">🔒 Buat akun untuk membaca artikel lengkapnya</p> --}}
                {{-- <p class="mb-4 text-sm text-gray-600">Untuk membaca artikel lengkapnya, silahkan login terlebih dahulu</p> --}}
                <div class="flex justify-center gap-6">
                    {{-- <a href="{{ route('login') }}" class="bg-gray-800 text-white px-4 py-2 rounded hover:bg-gray-700">Masuk</a> --}}
                    {{-- <a href="{{ route('register') }}" class="text-blue-600 hover:underline">Daftar sekarang</a> --}}
                </div>
            </div>
        </div>

        {{-- Navigasi Kanan --}}
        <div class="hidden md:block space-y-4 text-sm">
            <p class="font-semibold mb-5">
                🕓 Terakhir dibaca:
                @if(session('last_read_at_' . $artikel->id))
                    {{ \Carbon\Carbon::parse(session('last_read_at_' . $artikel->id))->diffForHumans() }}
                @else
                    Belum dibaca
                @endif
            </p>
            @if($artikel->spbe && $artikel->spbe->file_path)
                <a href="{{ asset('storage/' . $artikel->spbe->file_path) }}"
                class="btn mt-3"
                style="background-color: #007bff; color: #fff; border-radius: 4px; padding: 10px 20px; text-decoration: none;"
                target="_blank">
                    <i class="fas fa-download"></i> Download Dokumen
                </a>
            @endif

        </div>
    </div>

</body>
</html>
