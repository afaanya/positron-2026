<!DOCTYPE html>

<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>POSITRON - Jurnal Real-Life Flip</title>

   

    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600;800&family=Playfair+Display:ital,wght@0,500;0,600;1,500&display=swap" rel="stylesheet">



    <style>

        :root {

            --font-title: 'Cinzel', serif;

            --font-body: 'Playfair Display', serif;

            --color-paper: #e5d3b3;

        }



        * {

            box-sizing: border-box;

            margin: 0;

            padding: 0;

        }



        body {

            height: 100vh;

            display: flex;

            justify-content: center;

            align-items: center;

            overflow: hidden;

            background-color: #050b07;

        }



        /* Latar Belakang Meja Kerja Klasik */

        .desk-background {

            width: 100%;

            height: 100%;

            background: radial-gradient(circle at center, #1b3524 0%, #0d1a11 60%, #040805 100%);

            background-image:

                repeating-linear-gradient(rgba(0,0,0,0.15) 0px, rgba(0,0,0,0.15) 2px, transparent 2px, transparent 10px),

                radial-gradient(circle at center, #22442e 0%, #050b07 100%);

            display: flex;

            flex-direction: column;

            justify-content: center;

            align-items: center;

            position: relative;

            border: 20px solid #08120d;

            box-shadow: inset 0 0 150px rgba(0,0,0,0.95);

        }



        /* Tumpukan Buku Tua di Kiri Atas */

        .decor-books {

            position: absolute;

            top: 40px;

            left: 50px;

            width: 160px;

            height: 100px;

            background: linear-gradient(to bottom, #4a1515 20px, #2b3a42 25px, #2b3a42 45px, #5c3a21 50px, #5c3a21 80px, #1a3322 85px);

            border-radius: 4px;

            box-shadow: 10px 15px 25px rgba(0,0,0,0.6);

            transform: rotate(-15deg);

            opacity: 0.75;

        }

        .decor-books::before {

            content: "ARCHIVES";

            position: absolute;

            font-family: var(--font-title);

            font-size: 0.6rem;

            color: #d4af37;

            top: 55px; left: 15px;

            letter-spacing: 2px;

        }



        /* Cangkir Kopi di Kanan Atas */

        .decor-coffee {

            position: absolute;

            top: 50px;

            right: 80px;

            width: 70px;

            height: 70px;

            background: radial-gradient(circle at 30% 30%, #3a3a3a, #1a1a1a);

            border-radius: 50%;

            box-shadow: 10px 15px 20px rgba(0,0,0,0.5), inset -5px -5px 10px rgba(0,0,0,0.4);

            display: flex;

            justify-content: center;

            align-items: center;

            opacity: 0.8;

        }

        .decor-coffee::after {

            content: "";

            width: 45px;

            height: 45px;

            background: radial-gradient(circle at center, #4b2e1e, #26140a);

            border-radius: 50%;

        }



        /* Container Luar Buku dengan Bayangan Tebal Hardcover */

        .book-wrapper {

            position: relative;

            padding: 12px 20px;

            background: #09140e;

            border-radius: 16px;

            box-shadow:

                0 40px 90px rgba(0,0,0,0.95),

                0 20px 35px rgba(0,0,0,0.7),

                inset 0 0 25px rgba(0,0,0,0.9);

            border: 4px solid #14281c;

        }



        /* JURNAL UTAMA */

        #flipbook {

            box-shadow: 0 0 20px rgba(0,0,0,0.5);

            background-color: var(--color-paper);

            width: 920px;

            height: 600px;

            position: relative;

            display: flex;

            perspective: 2500px;

            overflow: hidden;

        }



        /* Lapisan Kertas Dasar dan Lembaran Kertas */

        .base-page,

        .leaf-front,

        .leaf-back {

            width: 460px;

            height: 100%;

            position: absolute;

            top: 0;

            background-color: var(--color-paper);

            background-image:

                radial-gradient(rgba(0,0,0,0.02) 15%, transparent 20%),

                linear-gradient(rgba(120, 90, 50, 0.06) 1px, transparent 1px);

            background-size: 6px 6px, 100% 2.3rem;

            padding: 55px 45px;

            display: flex;

            flex-direction: column;

            justify-content: space-between;

        }



        .base-page {

            z-index: 1;

        }

        .base-left { left: 0; border-radius: 6px 0 0 6px; box-shadow: inset -30px 0 40px rgba(0,0,0,0.15); }

        .base-right { right: 0; border-radius: 0 6px 6px 0; box-shadow: inset 30px 0 40px rgba(0,0,0,0.15); }



        /* LEMBARAN TENGAH YANG BERGERAK (FLIPPING LEAF) */

        .flipper-leaf {

            width: 460px;

            height: 100%;

            position: absolute;

            top: 0;

            right: 0;

            transform-origin: left center;

            transform-style: preserve-3d;

            transition: transform 1.2s cubic-bezier(0.4, 0, 0.2, 1);

            z-index: 10;

            backface-visibility: hidden;

        }



        /* Dua Sisi Lembaran Tengah (Depan & Belakang) */

        .leaf-front,

        .leaf-back {

            width: 100%;

            height: 100%;

            position: absolute;

            top: 0;

            left: 0;

            backface-visibility: hidden;

        }



        .leaf-front {

            z-index: 2;

            border-radius: 0 6px 6px 0;

            box-shadow: inset 30px 0 40px rgba(0,0,0,0.15);

        }



        .leaf-back {

            transform: rotateY(180deg);

            z-index: 1; /* Halaman belakang di bawah front secara default */

            border-radius: 6px 0 0 6px;

            box-shadow: inset -30px 0 40px rgba(0,0,0,0.15);

        }



        /* ANIMASI MEMBALIK BUKU SMOOTH */

        .flipper-leaf.flipped {

            transform: rotateY(-180deg) scaleX(0.98);

        }



        /* Efek Bayangan Melengkung Tengah Jurnal */

        #flipbook::after {

            content: "";

            position: absolute;

            top: 0; bottom: 0; left: 50%;

            width: 40px;

            transform: translateX(-50%);

            background: linear-gradient(to right, rgba(0,0,0,0.25) 0%, transparent 40%, transparent 60%, rgba(0,0,0,0.25) 100%);

            z-index: 100;

            pointer-events: none;

        }



        /* Bingkai Klasik Di setiap Halaman */

        .page-content::after {

            content: "";

            position: absolute;

            inset: 22px;

            border: 1px solid rgba(84, 65, 42, 0.35);

            pointer-events: none;

            border-radius: 4px;

        }



        /* Ornamen Sudut Lembaran */

        .corner-ornament {

            position: absolute;

            width: 12px;

            height: 12px;

            border: 2px solid rgba(84, 65, 42, 0.45);

            pointer-events: none;

            z-index: 5;

        }

        .top-left { top: 26px; left: 26px; border-right: none; border-bottom: none; }

        .top-right { top: 26px; right: 26px; border-left: none; border-bottom: none; }

        .bottom-left { bottom: 26px; left: 26px; border-right: none; border-top: none; }

        .bottom-right { bottom: 26px; right: 26px; border-left: none; border-top: none; }

       

        /* Tulisan Menyerap/Menempel Alami di Kertas */

        .text-container {

            font-family: var(--font-body);

            color: rgba(38, 28, 18, 0.88);

            text-align: justify;

            font-weight: 500;

            text-shadow: 0.3px 0.3px 0px rgba(0, 0, 0, 0.15), 0.5px 0.5px 1px rgba(255,255,255,0.4);

            position: relative;

            z-index: 2;

        }



        .size-normal { font-size: 1.05rem; line-height: 2.05rem; }



        .title-style {

            font-family: var(--font-title);

            font-size: 1.55rem;

            color: rgba(45, 32, 18, 0.95);

            text-align: center;

            margin-bottom: 20px;

            letter-spacing: 2px;

            font-weight: 600;

        }



        .subtitle-style {

            font-family: var(--font-title);

            font-size: 1.1rem;

            color: rgba(55, 40, 25, 0.95);

            margin-top: 10px;

            margin-bottom: 6px;

            font-weight: 600;

            border-bottom: 1px solid rgba(84, 65, 42, 0.25);

        }



        .page-number {

            font-family: var(--font-title);

            font-size: 0.85rem;

            color: rgba(90, 73, 54, 0.6);

            text-align: center;

            z-index: 10;

        }



        /* Aksesoris Fountain Pen Klasik */

        .fountain-pen {

            position: absolute;

            bottom: 30px;

            right: -20px;

            width: 13px;

            height: 220px;

            background: linear-gradient(90deg, #091710 0%, #193a28 50%, #091710 100%);

            border-radius: 2px;

            transform: rotate(52deg);

            box-shadow: 25px 25px 15px rgba(0,0,0,0.5);

            z-index: 110;

            pointer-events: none;

            border: 1px solid #050d09;

        }

        .fountain-pen::before {

            content: "";

            position: absolute;

            top: 35px; left: 0; right: 0;

            height: 5px;

            background: linear-gradient(90deg, #9a7432, #ffd700, #9a7432);

        }

        .fountain-pen::after {

            content: "";

            position: absolute;

            top: -24px; left: 0.5px;

            width: 0; height: 0;

            border-left: 6px solid transparent;

            border-right: 6px solid transparent;

            border-bottom: 24px solid #bba16c;

        }



        /* Navigasi Kontrol */

        .controls {

            margin-top: 30px;

            display: flex;

            gap: 25px;

            z-index: 110;

        }



        button {

            padding: 12px 30px;

            font-family: var(--font-title);

            font-size: 0.85rem;

            background-color: #162f20;

            color: #dfccab;

            border: 1px solid #2d5039;

            border-radius: 4px;

            cursor: pointer;

            letter-spacing: 1px;

            box-shadow: 0 10px 20px rgba(0,0,0,0.5);

            transition: all 0.3s ease;

        }



        button:hover {

            background-color: #21442e;

            color: #ffffff;

            transform: translateY(-2px);

        }



        /* PENGATURAN LOGO AIR TRANSPARAN & TIMBUL (EMBOSS) */

        /* Ensure page content has its own paper-like background

           and sits above the watermark logo element */

        .page-content {

            position: relative;

            z-index: 1;

            background: linear-gradient(180deg, #fbf7ee 0%, #f6efe0 100%); /* subtle paper tone */

            display: flex;

            align-items: center;

            justify-content: center;

            overflow: hidden;

        }



        /* Logo watermark: placed centered, faint, behind the page text */

        .page-watermark {

            position: absolute;

            top: 50%;

            left: 50%;

            transform: translate(-50%, -50%);

            width: 65%;

            height: 65%;

            background-image: url('{{ asset("images/logo buku.png") }}'); /* logo file */

            background-size: contain;

            background-repeat: no-repeat;

            background-position: center;

            opacity: 0.08; /* faint watermark */

            pointer-events: none;

            z-index: 0; /* behind page text */

        }

    </style>

</head>

<body>



    <div class="desk-background">

       

        <div class="decor-books"></div>

        <div class="decor-coffee"></div>

       

        <div class="book-wrapper">

           

            <div id="flipbook">

               

                <div class="base-page base-left page-content">

                    <div class="page-watermark"></div>

                    <div class="corner-ornament top-left"></div>

                    <div class="corner-ornament bottom-left"></div>

                    <div class="text-container size-normal">

                        <h1 class="title-style">POSITRON</h1>

                        <p>Kampus menjadi ruang untuk menempa integritas, memperluas wawasan, dan menyusun arah hidup dengan kesadaran. Sedangkan mengingatkan bahwa pembelajaran sejati tak berhenti di dalam kelas. Pendidikan tidak berakhir saat tugas dikumpulkan atau ujian selesai. Justru setelah itu, kita akan diuji dalam bentuk lain ujian karakter, kejujuran, keberanian, dan nilai-nilai kemanusiaan.</p>

                        <p style="margin-top: 12px;">Bergabunglah dengan kami dalam perjalanan menuju transformasi diri dan pencapaian prestasi yang membanggakan.</p>

                    </div>

                    <div class="page-number">— I —</div>

                </div>



                <div class="flipper-leaf" id="leaf3">

                    <div class="leaf-front page-content">

                        <div class="page-watermark"></div>

                        <div class="corner-ornament top-right"></div>

                        <div class="corner-ornament bottom-right"></div>

                        <div class="text-container size-normal">

                            <h2 class="title-style">Misi</h2>

                            <p style="margin-bottom: 12px;"><strong>Pendidikan Profesional:</strong><br>Menyelenggarakan pendidikan akademik, vokasi, dan profesi di bidang teknik elektro, elektronika, dan informatika untuk menghasilkan lulusan yang cerdas, kompetitif, berkarakter, dan adaptif terhadap perkembangan teknologi industri.</p>

                            <p><strong>Penelitian & Inovasi:</strong><br>Melaksanakan penelitian ilmiah dan terapan guna menghasilkan inovasi teknologi cerdas (smart technology) yang ramah lingkungan serta berkontribusi pada pengembangan IPTEK.</p>

                        </div>

                        <div class="page-number">— IV —</div>

                    </div>

                    <div class="leaf-back page-content">

                        <div class="page-watermark"></div>

                        <div class="corner-ornament top-left"></div>

                        <div class="corner-ornament bottom-left"></div>

                        <div class="text-container size-normal">

                            <h2 class="title-style">Misi</h2>

                            <p style="margin-bottom: 12px;"><strong>Pengabdian Masyarakat:</strong><br>Menyelenggarakan program pengabdian kepada masyarakat berbasis penerapan hasil riset dan teknologi tepat guna untuk mendukung produktivitas serta kesejahteraan masyarakat.</p>

                            <p><strong>Tata Kelola Akuntabel:</strong><br>Membangun tata kelola departemen yang transparan, akuntabel, dan berbasis teknologi guna menjamin pelayanan akademik yang prima.</p>

                        </div>

                        <div class="page-number">— V —</div>

                    </div>

                </div>



                <div class="flipper-leaf" id="leaf2">

                    <div class="leaf-front page-content">

                        <div class="page-watermark"></div>

                        <div class="corner-ornament top-right"></div>

                        <div class="corner-ornament bottom-right"></div>

                        <div class="text-container size-normal">

                            <h2 class="title-style">DEPARTEMEN</h2>

                            <p>Pada tahun 2022, seiring dengan resminya Universitas Negeri Malang beralih status menjadi Perguruan Tinggi Negeri Badan Hukum (PTNBH), istilah "Jurusan" disesuaikan menjadi Departemen.</p>

                            <p style="margin-top: 12px;">Nama departemen ini resmi menjadi Departemen Teknik Elektro dan Informatika (DTEI) untuk merepresentasikan cakupan keilmuannya yang luas di bidang teknologi informasi dan ketenagalistrikan.</p>

                        </div>

                        <div class="page-number">— III —</div>

                    </div>

                    <div class="leaf-back page-content">

                        <div class="page-watermark"></div>

                        <div class="corner-ornament top-left"></div>

                        <div class="corner-ornament bottom-left"></div>

                        <div class="text-container size-normal">

                            <h2 class="title-style">VISI </h2>

                            <p>Mewujudkan Departemen Teknik Elektro dan Informatika sebagai departemen yang unggul and menjadi rujukan nasional dalam pengembangan bidang pendidikan dan sains.</p>

                            <p style="margin-top: 12px;">Khususnya dalam bidang pendidikan teknik elektro dan informatika yang relevan dengan kebutuhan pembangunan, masyarakat, dan kemanusiaan.</p>

                        </div>

                        <div class="page-number">— VI —</div>

                    </div>

                </div>



                <div class="flipper-leaf" id="leaf1">

                    <div class="leaf-front page-content">

                        <div class="page-watermark"></div>

                        <div class="corner-ornament top-right"></div>

                        <div class="corner-ornament bottom-right"></div>

                        <div class="text-container size-normal">

                            <h2 class="title-style">DEPARTEMEN</h2>

                            <p>Akar dari DTEI UM tidak lepas dari sejarah Fakultas Teknik (FT) UM yang awalnya didirikan pada 1 September 1965 dengan nama Fakultas Keguruan Teknik (FKT) IKIP Malang.</p>

                            <p style="margin-top: 12px;">Seiring dengan perluasan mandat lembaga dari IKIP menjadi universitas (UM) pada tahun 1999, penataan program studi di bidang elektro mulai diperkuat. Jurusan Teknik Elektro awalnya berfokus pada program Diploma (D3) Teknik Elektro (Teknik Tenaga Listrik) dan D3 Teknik Elektronika.</p>

                        </div>

                        <div class="page-number">— II —</div>

                    </div>

                    <div class="leaf-back page-content">

                        <div class="page-watermark"></div>

                        <div class="corner-ornament top-left"></div>

                        <div class="corner-ornament bottom-left"></div>

                        <div class="text-container size-normal">

                            <h2 class="title-style">DEPARTEMEN</h2>

                            <p>Keahlian informatika kemudian dikembangkan mulai tahun 2004 lewat program peminatan Diploma (D3).</p>

                            <p style="margin-top: 12px;">Langkah strategis ini disusul dengan pembukaan program Sarjana (S1) Pendidikan Teknik Elektro serta program S1 Pendidikan Teknik Informatika untuk menjawab kebutuhan era digital.</p>

                        </div>

                        <div class="page-number">— VII —</div>

                    </div>

                </div>



                <div class="base-page base-right page-content">

                    <div class="page-watermark"></div>

                    <div class="corner-ornament top-right"></div>

                    <div class="corner-ornament bottom-right"></div>

                    <div class="text-container size-normal">

                        <h2 class="title-style">TERIMA KASIH</h2>

                        <p>Terima kasih sudah menjelajahi visi, misi, dan perjalanan Departemen Teknik Elektro dan Informatika.</p>

                        <p style="margin-top: 12px;">Semoga setiap halaman memberi inspirasi untuk terus bergerak maju dengan semangat pengetahuan dan kebersamaan.</p>

                    </div>

                    <div class="page-number">— VIII —</div>

                </div>



            </div>



            <div class="fountain-pen"></div>

        </div>



        <div class="controls">

            <button onclick="turnToPrevPage()">◀ SEBELUMNYA</button>

            <button onclick="turnToNextPage()">SELANJUTNYA ▶</button>

        </div>



    </div>



    <script>

        const leaves = [

            document.getElementById('leaf1'),

            document.getElementById('leaf2'),

            document.getElementById('leaf3')

        ];



        const topLeafZ = leaves.length + 10;

        const getOriginalZ = index => topLeafZ - index;

        const getFlippedZ = index => 10 + index;



        let currentLeafIndex = 0;



        function initBook() {

            for (let i = 0; i < leaves.length; i++) {

                leaves[i].style.zIndex = getOriginalZ(i);

            }

        }

        initBook();



        function turnToNextPage() {

            if (currentLeafIndex >= leaves.length) return;



            const activeLeaf = leaves[currentLeafIndex];

            const leafIndex = currentLeafIndex;



            activeLeaf.style.zIndex = topLeafZ;

            activeLeaf.classList.add('flipped');



            activeLeaf.addEventListener('transitionend', function handle(event) {

                if (event.propertyName !== 'transform') return;

                activeLeaf.style.zIndex = getFlippedZ(leafIndex);

            }, { once: true });



            currentLeafIndex++;

        }



        function turnToPrevPage() {

            if (currentLeafIndex <= 0) return;



            currentLeafIndex--;

            const activeLeaf = leaves[currentLeafIndex];

            const leafIndex = currentLeafIndex;



            activeLeaf.style.zIndex = topLeafZ;

            activeLeaf.classList.remove('flipped');



            activeLeaf.addEventListener('transitionend', function handle(event) {

                if (event.propertyName !== 'transform') return;

                activeLeaf.style.zIndex = getOriginalZ(leafIndex);

            }, { once: true });

        }

    </script>

</body>

</html>