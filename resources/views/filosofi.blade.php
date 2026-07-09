<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Filosofi - POSITRON 2026</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @vite('resources/css/filosofi.css')
</head>
<body class="min-h-screen antialiased text-white" style="background:#0a1a10 url('{{ asset('images/page-bg.jpg') }}') center top / cover fixed no-repeat;">
    @include('layouts.partials.header')

     <div class="relative w-full max-w-[1230px] mx-auto">

        <img src="{{ asset('images/bg card.png') }}" alt="Background" class="w-full h-auto block">

        <img src="{{ asset('images/filosofi.text.png') }}" 
             alt="Filosofi Text"
             class="absolute top-20 left-20 h-auto"
             style="width: 420px; height: auto; max-width: 100%;">

        <div class="filosofi-atas-item absolute" style="top: 230px; left: 50%; transform: translateX(-50%); z-index: 10;">
            <img src="{{ asset('images/filosofi.atas.item.png') }}"
                 alt="Filosofi Atas Item"
                 class="petir-glow"
                 data-black-src="{{ asset('images/filosofi.atas.item.png') }}"
                 data-yellow-src="{{ asset('images/filosofi.atas.kuning.png') }}"
                 style="width: 260px; height: 241px; display: block;">
            <div class="overlay-text overlay-bawah" style="left: -350px; right: auto; transform: none;">The Symphony of the Ton: Menggambarkan bahwa dunia kampus diisi oleh berbagai macam karakter, latar belakang, dan keahlian. Jika dipadukan dengan baik, perbedaan ini akan menciptakan harmoni yang indah (simfoni).</div>
        </div>

        <div class="filosofi-bawah-item absolute" style="top: 265px; left: 415px; width: 700px; z-index: 5;">
            <div class="overlay-text overlay-atas" style="left: auto; right: 100px; transform: none;">Diverse in Origin, United in Vision: Menegaskan bahwa meskipun mahasiswa baru berasal dari "keluarga" yang berbeda-beda, mereka kini berdiri di bawah satu nama almamater dan harus berkolaborasi untuk mencapai visi bersama.
</div>
            <img src="{{ asset('images/filosofi.bawah.item.png') }}"
                 alt="Filosofi Bawah Item"
                 class="petir-glow"
                 data-black-src="{{ asset('images/filosofi.bawah.item.png') }}"
                 data-yellow-src="{{ asset('images/filosofi.bawah.kuning.png') }}"
                 style="width: 260px; height: auto; display: block;">
        </div>

    </div>

    <main class="w-full max-w-4xl mx-auto flex flex-col items-center z-10 px-4 py-6">
        {{-- konten filosofi nanti masuk sini --}}
    </main>


    @include('layouts.partials.footer')
    @vite('resources/js/filosofi.js')
</body>
</html>