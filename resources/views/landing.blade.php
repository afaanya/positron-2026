<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POSITRON — Sistem Informasi Akademik</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white font-sans">

    {{-- Navbar --}}
    <nav class="flex items-center justify-between px-8 py-4 border-b border-gray-100">
        <div class="flex items-center gap-3">
            <div class="w-9 h-9 bg-blue-100 rounded-lg flex items-center justify-center">
                <svg class="w-5 h-5 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M12 14l9-5-9-5-9 5 9 5z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M12 14l6.16-3.422A12.083 12.083 0 0121 17.25c0 .864-.3 1.66-.8 2.285L12 22l-8.2-2.465A3.75 3.75 0 013 17.25c0-1.18.43-2.258 1.14-3.086L12 14z"/>
                </svg>
            </div>
            <div>
                <p class="text-sm font-semibold text-gray-800 leading-none">POSITRON</p>
                <p class="text-xs text-gray-400 mt-0.5">Sistem Informasi Akademik</p>
            </div>
        </div>
        <a href="{{ route('login') }}"
            class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-5 py-2 rounded-lg transition">
            Masuk
        </a>
    </nav>

    {{-- Hero --}}
    <section class="bg-blue-50 text-center px-6 py-20">
        <span class="inline-flex items-center gap-1.5 bg-blue-100 text-blue-800 text-xs font-medium px-3 py-1 rounded-full mb-5">
            ✦ Tahun Akademik 2025/2026
        </span>
        <h1 class="text-4xl font-bold text-blue-950 leading-tight max-w-xl mx-auto mb-4">
            Portal Akademik Mahasiswa Universitas
        </h1>
        <p class="text-blue-700 text-base max-w-md mx-auto mb-8">
            Akses informasi akademik, jadwal kuliah, nilai, dan layanan kampus dalam satu platform.
        </p>
        <div class="flex gap-3 justify-center flex-wrap">
            <a href="{{ route('login') }}"
                class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-7 py-3 rounded-lg transition">
                Masuk ke Sistem
            </a>
            <a href="#fitur"
                class="border border-blue-600 text-blue-600 hover:bg-blue-50 font-medium px-7 py-3 rounded-lg transition">
                Panduan Penggunaan
            </a>
        </div>
    </section>

    {{-- Stats --}}
    <div class="grid grid-cols-2 md:grid-cols-4 divide-x divide-y md:divide-y-0 divide-gray-100 border-y border-gray-100">
        @foreach([
            ['12.400+', 'Mahasiswa aktif'],
            ['420+',    'Dosen pengajar'],
            ['38',      'Program studi'],
            ['99.8%',   'Uptime sistem'],
        ] as [$num, $label])
        <div class="text-center py-8 px-4">
            <p class="text-2xl font-semibold text-blue-600">{{ $num }}</p>
            <p class="text-xs text-gray-400 mt-1">{{ $label }}</p>
        </div>
        @endforeach
    </div>

    {{-- Fitur --}}
    <section id="fitur" class="px-8 py-16">
        <h2 class="text-xl font-semibold text-center text-gray-800 mb-2">Fitur unggulan</h2>
        <p class="text-sm text-gray-400 text-center mb-10">Semua kebutuhan akademik tersedia dalam satu portal</p>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 max-w-4xl mx-auto">
            @foreach([
                ['bg-blue-50',   'text-blue-700',   'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z', 'Jadwal kuliah',    'Lihat dan kelola jadwal perkuliahan setiap semester.'],
                ['bg-teal-50',   'text-teal-700',   'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z', 'Nilai & transkrip', 'Pantau nilai dan unduh transkrip resmi kapan saja.'],
                ['bg-amber-50',  'text-amber-700',  'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z', 'Pengajuan surat',  'Ajukan surat keterangan mahasiswa secara online.'],
                ['bg-purple-50', 'text-purple-700', 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z', 'Data mahasiswa',   'Kelola data diri dan informasi akademik secara mandiri.'],
            ] as [$bg, $tc, $path, $title, $desc])
            <div class="bg-gray-50 rounded-xl p-5">
                <div class="w-9 h-9 {{ $bg }} {{ $tc }} rounded-lg flex items-center justify-center mb-4">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $path }}"/>
                    </svg>
                </div>
                <h3 class="text-sm font-semibold text-gray-800 mb-1">{{ $title }}</h3>
                <p class="text-xs text-gray-400 leading-relaxed">{{ $desc }}</p>
            </div>
            @endforeach
        </div>
    </section>

    {{-- CTA --}}
    <section class="bg-blue-50 text-center px-6 py-16">
        <h2 class="text-xl font-semibold text-blue-950 mb-2">Siap mengakses portal akademik?</h2>
        <p class="text-sm text-blue-700 mb-6">Masuk menggunakan email institusi atau NIM kamu.</p>
        <a href="{{ route('login') }}"
            class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-8 py-3 rounded-lg transition">
            Masuk sekarang
        </a>
    </section>

    {{-- Footer --}}
    <footer class="flex items-center justify-between flex-wrap gap-3 px-8 py-5 border-t border-gray-100">
        <p class="text-xs text-gray-400">© 2026 POSITRON — Universitas. Hak cipta dilindungi.</p>
        <div class="flex gap-5">
            <a href="#" class="text-xs text-gray-400 hover:text-gray-600">Bantuan</a>
            <a href="#" class="text-xs text-gray-400 hover:text-gray-600">Kebijakan privasi</a>
            <a href="#" class="text-xs text-gray-400 hover:text-gray-600">Kontak</a>
        </div>
    </footer>

</body>
</html>