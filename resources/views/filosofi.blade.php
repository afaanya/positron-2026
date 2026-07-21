@extends('layouts.app')

@section('title', 'Filosofi - POSITRON 2026')

@section('styles')
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <script src="https://cdn.tailwindcss.com"></script>
  @vite('resources/css/filosofi.css')
@endsection

@section('content')
<div class="min-h-screen antialiased text-white" style="background:#0a1a10 url('{{ asset('images/bg card.png') }}') center top / cover fixed no-repeat;">

    <div class="relative w-full max-w-[1230px] mx-auto px-4 py-10 lg:py-0">

        <!-- Desktop Wrapper -->
        <div class="hidden lg:block relative w-full filosofi-board">

            <img src="{{ asset('images/filosofi.text.png') }}" 
                 alt="Filosofi Text"
                 class="filosofi-title-img">

            <div class="filosofi-atas-item absolute">
                <img src="{{ asset('images/filosofi.atas.item.png') }}"
                     alt="Filosofi Atas Item"
                     class="petir-glow"
                     data-black-src="{{ asset('images/filosofi.atas.item.png') }}"
                     data-yellow-src="{{ asset('images/filosofi.atas.kuning.png') }}">
                <div class="overlay-text overlay-bawah">The Symphony of the Ton: Menggambarkan bahwa dunia kampus diisi oleh berbagai macam karakter, latar belakang, dan keahlian. Jika dipadukan dengan baik, perbedaan ini akan menciptakan harmoni yang indah (simfoni).</div>
            </div>

            <div class="filosofi-bawah-item absolute">
                <div class="overlay-text overlay-atas">Diverse in Origin, United in Vision: Menegaskan bahwa meskipun mahasiswa baru berasal dari "keluarga" yang berbeda-beda, mereka kini berdiri di bawah satu nama almamater dan harus berkolaborasi untuk mencapai visi bersama.</div>
                <img src="{{ asset('images/filosofi.bawah.item.png') }}"
                     alt="Filosofi Bawah Item"
                     class="petir-glow"
                     data-black-src="{{ asset('images/filosofi.bawah.item.png') }}"
                     data-yellow-src="{{ asset('images/filosofi.bawah.kuning.png') }}">
            </div>
        </div>

        <!-- Mobile Stacked Layout -->
        <div class="lg:hidden flex flex-col items-center gap-12 w-full">
            <img src="{{ asset('images/filosofi.text.png') }}" alt="Filosofi Text" class="w-full max-w-[280px] mt-8">
            
            <div class="flex flex-col items-center text-center gap-4 w-full max-w-md px-2">
                <img src="{{ asset('images/filosofi.atas.kuning.png') }}" class="w-44 petir-glow filter drop-shadow-[0_0_12px_rgba(248,215,148,0.5)]">
                <div class="p-5 pt-6 rounded-xl border border-[rgba(248,215,148,0.25)] bg-[rgba(6,20,12,0.8)] backdrop-blur-md">
                    <h3 class="text-[#f8d794] font-secondary font-bold text-base mb-3 mt-1">The Symphony of the Ton</h3>
                    <p class="text-sm font-secondary text-[#f0e2c6] leading-relaxed">Menggambarkan bahwa dunia kampus diisi oleh berbagai macam karakter, latar belakang, dan keahlian. Jika dipadukan dengan baik, perbedaan ini akan menciptakan harmoni yang indah (simfoni).</p>
                </div>
            </div>

            <div class="flex flex-col items-center text-center gap-4 w-full max-w-md px-2">
                <img src="{{ asset('images/filosofi.bawah.kuning.png') }}" class="w-44 petir-glow filter drop-shadow-[0_0_12px_rgba(248,215,148,0.5)]">
                <div class="p-5 rounded-xl border border-[rgba(248,215,148,0.25)] bg-[rgba(6,20,12,0.8)] backdrop-blur-md">
                    <h3 class="text-[#f8d794] font-secondary font-bold text-base mb-2">Diverse in Origin, United in Vision</h3>
                    <p class="text-sm font-secondary text-[#f0e2c6] leading-relaxed">Menegaskan bahwa meskipun mahasiswa baru berasal dari "keluarga" yang berbeda-beda, mereka kini berdiri di bawah satu nama almamater dan harus berkolaborasi untuk mencapai visi bersama.</p>
                </div>
            </div>
        </div>

    </div>

    <main class="w-full max-w-4xl mx-auto flex flex-col items-center z-10 px-4 py-6">
        {{-- konten filosofi nanti masuk sini --}}
    </main>

</div>

@vite('resources/js/filosofi.js')
@endsection