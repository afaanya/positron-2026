<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About - POSITRON 2026</title>
    <script src="https://cdn.tailwindcss.com"></script>
    
    <style>
        /* Import Google Fonts sesuai app.css tim */
        @import url('https://fonts.googleapis.com/css2?family=Libre+Baskerville:wght@400;700&family=Praise&display=swap');

        /* Simulasi variabel v4 untuk inline style & fallback */
        :root {
            --font-primary: 'Praise', cursive;
            --font-secondary: 'Libre Baskerville', serif;
            --color-primary: #284139;
            --color-secondary: #809076;
            --color-accent: #F8D794;
            --color-warning: #BB6B30;
            --color-dark: #111A19;
        }

        /* Utility Class Font custom dari app.css */
        .font-primary { font-family: var(--font-primary); }
        .font-secondary { font-family: var(--font-secondary); }

        /* Gaya & Tekstur Meja Klasik */
        .desk-background {
            background: radial-gradient(circle, var(--color-primary) 0%, var(--color-dark) 100%);
            position: relative;
            overflow: hidden;
        }
        
        .desk-background::before {
            content: "";
            position: absolute;
            inset: 0;
            opacity: 0.05;
            background-image: radial-gradient(circle at 50% 50%, #fff 10%, transparent 20%),
                              radial-gradient(circle at 0 0, #fff 5%, transparent 10%);
            background-size: 40px 40px;
        }

        /* Tekstur Kertas Kuno + Penyelarasan Garis */
        .parchment {
            background-color: #f1e4c3;
            /* Garis horizontal berjarak 2.25rem (36px) untuk presisi Libre Baskerville */
            background-image: linear-gradient(rgba(0,0,0,0.06) 1px, transparent 1px);
            background-size: 100% 2.25rem;
            box-shadow: inset 0 0 40px rgba(139, 90, 43, 0.3), 5px 5px 15px rgba(0,0,0,0.5);
            color: var(--color-dark);
        }

        /* Menyelaraskan baris kalimat agar menempel pas di atas garis */
        .line-aligned {
            line-height: 2.25rem; 
            padding-top: 0.45rem; /* Menurunkan awal baris teks agar pas di atas garis pertama */
        }

        /* Garis Tengah Buku (Lipatan) */
        .book-spine {
            background: linear-gradient(to right, rgba(0,0,0,0.2) 0%, rgba(0,0,0,0) 10%, rgba(0,0,0,0) 90%, rgba(0,0,0,0.3) 100%);
        }

        /* --- SISTEM ANIMASI PAGE FLIP 3D --- */
        .book-container {
            perspective: 1500px; 
        }

        .animated-page {
            position: absolute;
            top: 0;
            bottom: 0;
            width: 50%;
            background-color: #ebdcb9;
            background-image: linear-gradient(rgba(0,0,0,0.03) 1px, transparent 1px);
            background-size: 100% 2.25rem;
            transform-style: preserve-3d;
            transition: transform 1.2s cubic-bezier(0.25, 1, 0.5, 1), 
                        box-shadow 1.2s cubic-bezier(0.25, 1, 0.5, 1), 
                        background-color 1.2s ease;
            z-index: 50;
            pointer-events: none;
            opacity: 0;
        }

        .page-flip-right {
            right: 0;
            transform-origin: left center;
        }

        .page-flip-left {
            left: 0;
            transform-origin: right center;
        }

        .page-flip-right.flipped {
            opacity: 1;
            transform: rotateY(-180deg) translateZ(1px); 
            background-color: #d8c69d;
            box-shadow: 20px 20px 40px rgba(0,0,0,0.3);
        }

        .page-flip-left.flipped {
            opacity: 1;
            transform: rotateY(180deg) translateZ(1px);
            background-color: #d8c69d;
            box-shadow: -20px 20px 40px rgba(0,0,0,0.3);
        }

        .page-shadow {
            position: absolute;
            inset: 0;
            background: linear-gradient(to right, rgba(0,0,0,0.08), rgba(0,0,0,0));
            pointer-events: none;
        }
    </style>
</head>
<body class="desk-background min-h-screen flex flex-col justify-between antialiased">

    <header class="w-full z-20">
        <img src="{{ asset('images/header.png') }}" alt="Header" class="w-full h-auto object-cover block">
    </header>

    <main class="w-full max-w-4xl mx-auto flex flex-col justify-center items-center z-10 book-container px-4 py-4 my-auto">
        
        <div class="text-center mb-4">
            <h1 class="font-primary text-4xl md:text-6xl text-[#F8D794] tracking-wide drop-shadow-md">
                Positron 2026
            </h1>
            <p class="text-[#809076] text-[10px] md:text-xs font-secondary tracking-wider -mt-1">
                Departemen Teknik Elektro dan Informatika UM
            </p>
        </div>

        <div class="relative flex-1 grid grid-cols-2 parchment rounded-lg border-4 border-[#284139] overflow-hidden max-w-2xl md:max-w-3xl w-full aspect-[16/10] md:aspect-[16/9] max-h-[50vh] md:max-h-[460px]">
            
            <div id="flip-sheet-right" class="animated-page page-flip-right border-l border-[#d4c29a]">
                <div class="page-shadow"></div>
            </div>
            <div id="flip-sheet-left" class="animated-page page-flip-left border-r border-[#d4c29a]">
                <div class="page-shadow" style="background: linear-gradient(to left, rgba(0,0,0,0.08), rgba(0,0,0,0))"></div>
            </div>

            <div class="absolute inset-y-0 left-1/2 w-8 -ml-4 book-spine z-40 pointer-events-none"></div>

            <div class="p-4 md:p-8 flex flex-col justify-between border-r border-[#d4c29a] relative z-10 overflow-hidden">
                <div id="page-left-content" class="font-secondary text-xs md:text-[13px] line-aligned text-justify overflow-y-auto max-h-full pr-1 transition-opacity duration-300">
                    <span class="text-5xl font-primary float-left mr-2 -mt-1 text-[#BB6B30] leading-[2.5rem]">P</span>
                    POSITRON hadir sebagai wadah orientasi mahasiswa baru Departemen Teknik Elektro dan Informatika Universitas Negeri Malang. 
                    <br><br>
                    Tahun ini, POSITRON mengusung tema besar yang berarti <strong>menyalakan obor harapan</strong> di dalam diri setiap mahasiswa agar mampu melangkah menuju masa depan yang mereka bentuk sendiri—bukan sekadar mengikuti jalur yang ditentukan orang lain.
                </div>
                
                <div class="flex justify-between items-center text-[10px] md:text-xs font-secondary mt-2 border-t border-[#284139]/10 pt-1 bg-[#f1e4c3] z-20">
                    <button id="btn-back" onclick="changePage(-1)" class="opacity-20 transition-all font-bold cursor-not-allowed text-[#BB6B30]" disabled>
                        &larr; Back
                    </button>
                    <span class="opacity-60">Halaman <span id="page-left-num">1</span></span>
                </div>
            </div>

            <div class="p-4 md:p-8 flex flex-col justify-between relative z-10 overflow-hidden">
                <div id="page-right-content" class="font-secondary text-xs md:text-[13px] line-aligned text-justify overflow-y-auto max-h-full pr-1 transition-opacity duration-300">
                    Kampus menjadi ruang untuk menempa integritas, memperluas wawasan, dan menyusun arah hidup dengan kesadaran. 
                    <br><br>
                    Pendidikan sejati mengingatkan bahwa pembelajaran sejati tak berhenti di dalam kelas. Pendidikan tidak berakhir saat tugas dikumpulkan atau ujian selesai.
                </div>
                
                <div class="flex justify-between items-center text-[10px] md:text-xs font-secondary mt-2 border-t border-[#284139]/10 pt-1 bg-[#f1e4c3] z-20">
                    <span class="opacity-60">Halaman <span id="page-right-num">2</span></span>
                    
                    <button id="btn-next" onclick="changePage(1)" class="text-[#284139] hover:text-[#BB6B30] transition-all font-bold cursor-pointer">
                        Next &rarr;
                    </button>
                </div>
            </div>

        </div>

        <div class="flex justify-center items-center mt-3 text-[#809076] text-[10px] md:text-xs font-secondary px-2">
            <div class="italic opacity-80 flex items-center gap-1">
                <span>Klik tanda panah di bawah halaman untuk membalik lembaran</span> ✒️
            </div>
        </div>
    </main>

    <footer class="w-full z-20 mt-auto">
        <img src="{{ asset('images/footer.png') }}" alt="Footer" class="w-full h-auto object-cover block">
    </footer>

    <script>
        const pages = [
            {
                leftNum: 1,
                rightNum: 2,
                leftText: `<span class="text-5xl font-primary float-left mr-2 -mt-1 text-[#BB6B30] leading-[2.5rem]">P</span>POSITRON hadir sebagai wadah orientasi mahasiswa baru Departemen Teknik Elektro dan Informatika Universitas Negeri Malang.<br><br>Tahun ini, POSITRON mengusung tema besar yang berarti <strong>menyalakan obor harapan</strong> di dalam diri setiap mahasiswa agar mampu melangkah menuju masa depan yang mereka bentuk sendiri—bukan sekadar mengikuti jalur yang ditentukan orang lain.`,
                rightText: `Kampus menjadi ruang untuk menempa integritas, memperluas wawasan, dan menyusun arah hidup dengan kesadaran.<br><br>Pendidikan sejati mengingatkan bahwa pembelajaran sejati tak berhenti di dalam kelas. Pendidikan tidak berakhir saat tugas dikumpulkan atau ujian selesai.`
            },
            {
                leftNum: 3,
                rightNum: 4,
                leftText: `Justru setelah fase akademik itulah, kita semua akan diuji dalam bentuk yang sesungguhnya—yaitu ujian karakter, kejujuran, keberanian, serta nilai-nilai kemanusiaan di tengah masyarakat.<br><br>Oleh karena itu, persiapkan diri sebaik-baiknya untuk menjadi agen perubahan yang solutif.`,
                rightText: `Bergabunglah dengan kami dalam perjalanan menuju transformasi diri dan pencapaian prestasi yang membanggakan.<br><br><span class="block text-center italic mt-4 font-bold text-[#BB6B30] text-lg font-primary">Selamat Datang di Keluarga Besar TEI UM!</span>`
            }
        ];

        let currentPageGroup = 0;
        let isAnimating = false;

        const leftTextContainer = document.getElementById('page-left-content');
        const rightTextContainer = document.getElementById('page-right-content');
        const leftPageNum = document.getElementById('page-left-num');
        const rightPageNum = document.getElementById('page-right-num');
        const btnBack = document.getElementById('btn-back');
        const btnNext = document.getElementById('btn-next');
        
        const flipSheetRight = document.getElementById('flip-sheet-right');
        const flipSheetLeft = document.getElementById('flip-sheet-left');

        function changePage(direction) {
            if (isAnimating) return;
            isAnimating = true;

            const nextGroup = currentPageGroup + direction;
            if (nextGroup < 0 || nextGroup >= pages.length) {
                isAnimating = false;
                return;
            }

            if (direction === 1) {
                flipSheetRight.style.opacity = "1";
                setTimeout(() => {
                    flipSheetRight.classList.add('flipped');
                }, 20);
                rightTextContainer.style.opacity = "0";
            } else {
                flipSheetLeft.style.opacity = "1";
                setTimeout(() => {
                    flipSheetLeft.classList.add('flipped');
                }, 20);
                leftTextContainer.style.opacity = "0";
            }

            setTimeout(() => {
                if (direction === 1) {
                    leftTextContainer.style.opacity = "0";
                } else {
                    rightTextContainer.style.opacity = "0";
                }

                currentPageGroup = nextGroup;

                leftTextContainer.innerHTML = pages[currentPageGroup].leftText;
                rightTextContainer.innerHTML = pages[currentPageGroup].rightText;
                leftPageNum.innerText = pages[currentPageGroup].leftNum;
                rightPageNum.innerText = pages[currentPageGroup].rightNum;

                btnBack.disabled = currentPageGroup === 0;
                if (btnBack.disabled) {
                    btnBack.classList.add('opacity-20', 'cursor-not-allowed');
                    btnBack.classList.remove('opacity-40', 'hover:opacity-100', 'cursor-pointer');
                } else {
                    btnBack.classList.remove('opacity-20', 'cursor-not-allowed');
                    btnBack.classList.add('opacity-40', 'hover:opacity-100', 'cursor-pointer');
                }

                btnNext.disabled = currentPageGroup === pages.length - 1;
                if (btnNext.disabled) {
                    btnNext.classList.add('opacity-20', 'cursor-not-allowed');
                    btnNext.classList.remove('cursor-pointer');
                } else {
                    btnNext.disabled = false;
                    btnNext.classList.remove('opacity-20', 'cursor-not-allowed');
                    btnNext.classList.add('cursor-pointer');
                }
            }, 600);

            setTimeout(() => {
                flipSheetRight.style.transition = "none";
                flipSheetLeft.style.transition = "none";
                
                flipSheetRight.classList.remove('flipped');
                flipSheetLeft.classList.remove('flipped');
                
                flipSheetRight.style.opacity = "0";
                flipSheetLeft.style.opacity = "0";
                
                leftTextContainer.style.opacity = "1";
                rightTextContainer.style.opacity = "1";

                setTimeout(() => {
                    flipSheetRight.style.transition = "transform 1.2s cubic-bezier(0.25, 1, 0.5, 1), box-shadow 1.2s cubic-bezier(0.25, 1, 0.5, 1), background-color 1.2s ease";
                    flipSheetLeft.style.transition = "transform 1.2s cubic-bezier(0.25, 1, 0.5, 1), box-shadow 1.2s cubic-bezier(0.25, 1, 0.5, 1), background-color 1.2s ease";
                    isAnimating = false;
                }, 50);

            }, 1200);
        }
    </script>
</body>
</html>