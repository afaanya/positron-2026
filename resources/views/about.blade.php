<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About - POSITRON 2026</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Gaya & Tekstur Meja Klasik */
        .desk-background {
            background: radial-gradient(circle, #1a3a2a 0%, #0d1f16 100%);
            position: relative;
            overflow: hidden;
        }
        
        /* Pola Damask/Ornamental pada Meja (Simulasi Mat Hijau di Gambar) */
        .desk-background::before {
            content: "";
            position: absolute;
            inset: 0;
            opacity: 0.08;
            background-image: radial-gradient(circle at 50% 50%, #fff 10%, transparent 20%),
                              radial-gradient(circle at 0 0, #fff 5%, transparent 10%);
            background-size: 40px 40px;
        }

        /* Tekstur Kertas Kuno/Kusam */
        .parchment {
            background-color: #f1e4c3;
            background-image: linear-gradient(rgba(0,0,0,0.03) 1px, transparent 1px);
            background-size: 100% 2rem;
            box-shadow: inset 0 0 40px rgba(139, 90, 43, 0.3), 5px 5px 15px rgba(0,0,0,0.5);
        }

        /* Garis Tengah Buku (Lipatan) */
        .book-spine {
            background: linear-gradient(to right, rgba(0,0,0,0.3) 0%, rgba(0,0,0,0) 10%, rgba(0,0,0,0) 90%, rgba(0,0,0,0.4) 100%);
        }
    </style>
</head>
<body class="desk-background min-h-screen flex flex-col items-center justify-center p-4 antialiased text-[#3d2b1f]">

    <div class="absolute top-8 left-12 text-yellow-200/40 hidden md:block select-none pointer-events-none text-xs font-serif">
        🕯️ Candlelight Atmosphere
    </div>
    <div class="absolute top-8 right-12 text-yellow-200/40 hidden md:block select-none pointer-events-none text-xs font-serif">
        📜 Sealed Scrolls
    </div>

    <div class="w-full max-w-5xl aspect-[16/10] md:aspect-[16/9] flex flex-col justify-between z-10">
        
        <div class="text-center mb-4">
            <h1 class="font-serif text-2xl md:text-4xl text-[#dfc48c] tracking-widest uppercase font-bold drop-shadow-md">
                POSITRON 2026
            </h1>
            <p class="text-[#a1bfa8] text-xs md:text-sm font-sans tracking-wider mt-1">Departemen Teknik Elektro dan Informatika UM</p>
        </div>

        <div class="relative flex-1 grid grid-cols-2 parchment rounded-lg border-4 border-[#5c4028] relative">
            
            <div class="absolute inset-y-0 left-1/2 w-8 -ml-4 book-spine z-20 pointer-events-none"></div>

            <div class="p-6 md:p-12 flex flex-col justify-between border-r border-[#d4c29a] relative z-10">
                <div class="font-serif text-xs md:text-base leading-relaxed text-justify overflow-y-auto max-h-[75vh]">
                    <span class="text-3xl font-bold font-serif float-left mr-2 mt-1 text-[#8b5a2b]">P</span>
                    OSITRON hadir sebagai wadah orientasi mahasiswa baru Departemen Teknik Elektro dan Informatika Universitas Negeri Malang. 
                    <br><br>
                    Tahun ini, POSITRON mengusung tema besar yang berarti **menyalakan obor harapan** di dalam diri setiap mahasiswa agar mampu melangkah menuju masa depan yang mereka bentuk sendiri—bukan sekadar mengikuti jalur yang ditentukan orang lain.
                </div>
                <div class="text-xs font-serif opacity-60 mt-4 text-left border-t border-[#8b5a2b]/20 pt-2">
                    Halaman <span id="page-left-num">1</span>
                </div>
            </div>

            <div class="p-6 md:p-12 flex flex-col justify-between relative z-10">
                <div id="page-right-content" class="font-serif text-xs md:text-base leading-relaxed text-justify transition-opacity duration-300">
                    Kampus menjadi ruang untuk menempa integritas, memperluas wawasan, dan menyusun arah hidup dengan kesadaran. 
                    <br><br>
                    Pendidikan sejati mengingatkan bahwa pembelajaran sejati tak berhenti di dalam kelas. Pendidikan tidak berakhir saat tugas dikumpulkan atau ujian selesai.
                </div>
                
                <div class="flex justify-between items-center text-xs font-serif mt-4 border-t border-[#8b5a2b]/20 pt-2">
                    <button id="btn-prev" onclick="changePage(-1)" class="opacity-40 hover:opacity-100 transition-all font-bold disabled:opacity-20 cursor-pointer" disabled>
                        &larr; Sebelumnya
                    </button>
                    
                    <span class="opacity-60">Halaman <span id="page-right-num">2</span></span>
                    
                    <button id="btn-next" onclick="changePage(1)" class="hover:text-[#8b5a2b] transition-all font-bold cursor-pointer">
                        Selanjutnya &rarr;
                    </button>
                </div>
            </div>

        </div>

        <div class="flex justify-between items-center mt-4 text-[#a1bfa8] text-xs font-serif px-2">
            <div>&copy; 2026 HMD TEI UM</div>
            <div class="italic opacity-80 flex items-center gap-1">
                <span>Klik tanda panah di dalam buku untuk membalik halaman</span> ✒️
            </div>
        </div>
    </div>

    <script>
        // Data konten per halaman (Halaman 1 kiri & kanan statis/awal)
        // Kita pecah teks sisa ke halaman berikutnya (Halaman 3 & 4)
        const pages = [
            {
                leftNum: 1,
                rightNum: 2,
                leftText: `<span class="text-3xl font-bold font-serif float-left mr-2 mt-1 text-[#8b5a2b]">P</span>OSITRON hadir sebagai wadah orientasi mahasiswa baru Departemen Teknik Elektro dan Informatika Universitas Negeri Malang.<br><br>Tahun ini, POSITRON mengusung tema besar yang berarti <strong>menyalakan obor harapan</strong> di dalam diri setiap mahasiswa agar mampu melangkah menuju masa depan yang mereka bentuk sendiri—bukan sekadar mengikuti jalur yang ditentukan orang lain.`,
                rightText: `Kampus menjadi ruang untuk menempa integritas, memperluas wawasan, dan menyusun arah hidup dengan kesadaran.<br><br>Pendidikan sejati mengingatkan bahwa pembelajaran sejati tak berhenti di dalam kelas. Pendidikan tidak berakhir saat tugas dikumpulkan atau ujian selesai.`
            },
            {
                leftNum: 3,
                rightNum: 4,
                leftText: `Justru setelah fase akademik itulah, kita semua akan diuji dalam bentuk yang sesungguhnya—yaitu ujian karakter, kejujuran, keberanian, serta nilai-nilai kemanusiaan di tengah masyarakat.<br><br>Oleh karena itu, persiapkan diri sebaik-baiknya untuk menjadi agen perubahan yang solutif.`,
                rightText: `Bergabunglah dengan kami dalam perjalanan menuju transformasi diri dan pencapaian prestasi yang membanggakan.<br><br><span class="block text-center italic mt-6 font-bold text-[#8b5a2b]">Selamat Datang di Keluarga Besar TEI UM!</span>`
            }
        ];

        let currentPageGroup = 0;

        const leftTextContainer = document.querySelector('.border-r div');
        const rightTextContainer = document.getElementById('page-right-content');
        const leftPageNum = document.getElementById('page-left-num');
        const rightPageNum = document.getElementById('page-right-num');
        const btnPrev = document.getElementById('btn-prev');
        const btnNext = document.getElementById('btn-next');

        function changePage(direction) {
            // Animasi transisi teks menghilang sedikit
            leftTextContainer.style.opacity = 0;
            rightTextContainer.style.opacity = 0;

            setTimeout(() => {
                currentPageGroup += direction;

                // Update Konten Teks
                leftTextContainer.innerHTML = pages[currentPageGroup].leftText;
                rightTextContainer.innerHTML = pages[currentPageGroup].rightText;

                // Update Nomor Halaman
                leftPageNum.innerText = pages[currentPageGroup].leftNum;
                rightPageNum.innerText = pages[currentPageGroup].rightNum;

                // Validasi Tombol Navigasi
                btnPrev.disabled = currentPageGroup === 0;
                btnNext.disabled = currentPageGroup === pages.length - 1;

                // Kembalikan Opacity (Efek Muncul)
                leftTextContainer.style.opacity = 1;
                rightTextContainer.style.opacity = 1;
            }, 200);
        }
    </script>
</body>
</html>