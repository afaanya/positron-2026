<section id="dashboard" class="bg-[#F7F0E4] min-h-screen">

<div class="flex">

    {{-- ================= SIDEBAR ================= --}}
    <aside class="w-72 min-h-screen bg-[#163B2E] text-white shadow-xl flex flex-col">

        {{-- Logo --}}
        <div class="py-8 text-center border-b border-white/10">

            <img src="{{ asset('images/logo.png') }}"
                class="w-16 mx-auto mb-3">

            <h1 class="text-3xl font-bold tracking-wide">
                MENTOR
            </h1>

            <p class="text-green-200 text-sm">
                Panel Penilaian
            </p>

        </div>

        {{-- Menu --}}
        <nav class="mt-6 flex-1">

            <a href="#dashboard"
                class="flex items-center gap-3 mx-5 mb-3 rounded-xl px-5 py-3 bg-[#D6A74F] text-[#163B2E] font-semibold">

                <span>🏠</span>
                Dashboard

            </a>

            <a href="#mahasiswa"
                class="flex items-center gap-3 mx-5 mb-3 rounded-xl px-5 py-3 hover:bg-white/10">

                👨‍🎓
                Daftar Mahasiswa

            </a>

            <a href="#penilaian"
                class="flex items-center gap-3 mx-5 mb-3 rounded-xl px-5 py-3 hover:bg-white/10">

                ⭐
                Penilaian

            </a>

            <a href="#rekap"
                class="flex items-center gap-3 mx-5 mb-3 rounded-xl px-5 py-3 hover:bg-white/10">

                📊
                Rekap Penilaian

            </a>

            <a href="#panduan"
                class="flex items-center gap-3 mx-5 mb-3 rounded-xl px-5 py-3 hover:bg-white/10">

                📖
                Panduan Poin

            </a>

            <a href="#profil"
                class="flex items-center gap-3 mx-5 rounded-xl px-5 py-3 hover:bg-white/10">

                👤
                Profil Mentor

            </a>

        </nav>

        {{-- Logout --}}
        <div class="p-5">

            <button
                class="w-full rounded-xl border border-[#D6A74F] text-[#D6A74F] py-3 hover:bg-[#D6A74F] hover:text-[#163B2E] transition">

                Logout

            </button>

        </div>

    </aside>

    {{-- ================= CONTENT ================= --}}

    <main class="flex-1">

        {{-- HEADER --}}
        <div class="bg-[#1A4635] p-8">

            <div class="bg-[#F6E4BE] rounded-2xl p-8 shadow-lg">

                <div class="flex justify-between items-center">

                    <div>

                        <h1 class="text-4xl font-bold text-[#4A3216]">

                            Selamat Datang,
                            {{ auth()->user()->username ?? 'Mentor' }}

                        </h1>

                        <p class="mt-2 text-[#70573A]">

                            Berikut adalah data mahasiswa offering yang Anda pegang.

                        </p>

                    </div>

                    <div>

                        <img src="{{ asset('images/books.png') }}"
                            class="h-24">

                    </div>

                </div>

            </div>

        </div>

        {{-- ================= ISI ================= --}}

        <div class="p-8">

            {{-- CARD --}}
            <div class="grid grid-cols-4 gap-6">

                {{-- CARD 1 --}}
                <div class="bg-white rounded-2xl shadow p-6">

                    <div class="flex justify-between">

                        <div>

                            <p class="text-gray-500">

                                Total Mahasiswa

                            </p>

                            <h2 class="text-5xl font-bold mt-3 text-[#214F3D]">

                                24

                            </h2>

                            <p class="text-gray-400 mt-2">

                                Mahasiswa Bimbingan

                            </p>

                        </div>

                        <div
                            class="w-16 h-16 rounded-xl bg-green-100 flex items-center justify-center text-3xl">

                            👥

                        </div>

                    </div>

                </div>

                {{-- CARD 2 --}}
                <div class="bg-white rounded-2xl shadow p-6">

                    <div class="flex justify-between">

                        <div>

                            <p class="text-gray-500">

                                Sedang Dikerjakan

                            </p>

                            <h2 class="text-5xl font-bold mt-3 text-yellow-500">

                                8

                            </h2>

                            <p class="text-gray-400 mt-2">

                                Penilaian

                            </p>

                        </div>

                        <div
                            class="w-16 h-16 rounded-xl bg-yellow-100 flex items-center justify-center text-3xl">

                            ✏️

                        </div>

                    </div>

                </div>

                {{-- CARD 3 --}}
                <div class="bg-white rounded-2xl shadow p-6">

                    <div class="flex justify-between">

                        <div>

                            <p class="text-gray-500">

                                Belum Dinilai

                            </p>

                            <h2 class="text-5xl font-bold mt-3 text-red-500">

                                7

                            </h2>

                            <p class="text-gray-400 mt-2">

                                Penilaian

                            </p>

                        </div>

                        <div
                            class="w-16 h-16 rounded-xl bg-red-100 flex items-center justify-center text-3xl">

                            ⏳

                        </div>

                    </div>

                </div>

                {{-- CARD 4 --}}
                <div class="bg-white rounded-2xl shadow p-6">

                    <div class="flex justify-between">

                        <div>

                            <p class="text-gray-500">

                                Selesai Dinilai

                            </p>

                            <h2 class="text-5xl font-bold mt-3 text-green-600">

                                9

                            </h2>

                            <p class="text-gray-400 mt-2">

                                Penilaian

                            </p>

                        </div>

                        <div
                            class="w-16 h-16 rounded-xl bg-green-100 flex items-center justify-center text-3xl">

                            ✅

                        </div>

                    </div>

                </div>

            </div>

            {{-- Progress --}}
            <div class="mt-8 bg-white rounded-2xl p-6 shadow">

                <div class="flex justify-between">

                    <h2 class="font-bold text-xl text-[#214F3D]">

                        Progress Penilaian Keseluruhan

                    </h2>

                    <span class="font-bold text-green-700">

                        68%

                    </span>

                </div>

                <div class="w-full bg-gray-200 rounded-full h-5 mt-5">

                    <div
                        class="bg-green-600 h-5 rounded-full"
                        style="width:68%">

                    </div>

                </div>

            </div>

        </div>

    </main>

</div>

</section>