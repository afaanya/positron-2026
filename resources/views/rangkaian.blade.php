<style>
    /* Mengatur area utama */
    .rangkaian-section {
        width: 100%;
        min-height: 100vh;
        background-image: url('{{ asset('images/bg card.png') }}');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 40px 20px;
        position: relative;
    }

    .logo-top {
        width: 700px;
        position: absolute;
        top: 100px; 
        filter: drop-shadow(0 0 15px rgba(212, 175, 55, 0.3));
        animation: floatAnimation 4s ease-in-out infinite;
    }

    .cards-container {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 30px;
        flex-wrap: wrap;
        margin-top: 150px;
    }

    /* FLIP CARD STYLES */
    .flip-card {
        background-color: transparent;
        width: 200px;
        height: 350px;
        perspective: 1000px;
        cursor: pointer;
    }

    .flip-card-inner {
        position: relative;
        width: 100%;
        height: 100%;
        transition: transform 0.8s;
        transform-style: preserve-3d;
    }

    .flip-card.flipped .flip-card-inner {
        transform: rotateY(180deg);
    }

    .flip-card-front, .flip-card-back {
        position: absolute;
        width: 100%;
        height: 100%;
        backface-visibility: hidden;
        border-radius: 10px;
        overflow: hidden;
    }

    .flip-card-back {
        transform: rotateY(180deg);
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
    }

    /* Styling Teks di dalam kartu */
    .card-text-overlay {
        position: absolute;
        padding: 20px;
        text-align: justify;
        color: #000000;
        line-height: 1.3;
        z-index: 2;
    }

    .text-normal { font-size: 11px; }
    .text-long { font-size: 8px; }

    .card-img { width: 100%; height: 100%; object-fit: cover; display: block; }
    
    @keyframes floatAnimation {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
    }
</style>

<div class="rangkaian-section">
    <img src="{{ asset('images/logo-positron.png') }}" class="logo-top" alt="Logo">
    
    <div class="cards-container">
        <div class="flip-card" onclick="this.classList.toggle('flipped')">
            <div class="flip-card-inner">
                <div class="flip-card-front"><img src="{{ asset('images/kartu 1.png') }}" class="card-img"></div>
                <div class="flip-card-back">
                    <img src="{{ asset('images/fm.png') }}" class="card-img">
                    <div class="card-text-overlay text-normal">
                        Forum Mahasiswa Baru (Forum Maba) merupakan kegiatan dalam rangka menyambut mahasiswa baru. Kegiatan ini menjadi wadah awal bagi mahasiswa baru untuk mengenal dunia perkuliahan, nilai-nilai akademik, serta lingkungan sosial di jurusan.
                    </div>
                </div>
            </div>
        </div>
        
        <div class="flip-card" onclick="this.classList.toggle('flipped')">
            <div class="flip-card-inner">
                <div class="flip-card-front"><img src="{{ asset('images/kartu 2.png') }}" class="card-img"></div>
                <div class="flip-card-back">
                    <img src="{{ asset('images/ldk.png') }}" class="card-img">
                    <div class="card-text-overlay text-long">
                        Latihan Dasar Kepemimpinan (LDK) adalah kegiatan pelatihan yang bertujuan untuk mengasah kepemimpinan serta keterampilan mahasiswa baru. <br><br>
                        Dalam pelaksanaanya LDK memadukan pembelajaran melalui pendekatan teori, dimana mahasiswa baru dibekali dengan konsep dasar kepemimpinan, serta praktik langsung yang memberikan pengalaman nyata untuk melatih kemampuan berpikir kritis, kerja sama tim, komunikasi, dan manajemen konflik. <br><br>
                        Dengan konsep yang interaktif, kegiatan ini menjadi wadah bagi mahasiswa baru untuk tidak hanya memahami apa itu kepemimpinan, tetapi juga mengaplikasikannya dalam situasi yang menyerupai tantangan di dunia nyata, dan membekali mahasiswa baru dengan kepercayaan diri serta tanggung jawab untuk menjadi pemimpin yang kompeten di masa depan.
                    </div>
                </div>
            </div>
        </div>

        <div class="flip-card" onclick="this.classList.toggle('flipped')">
            <div class="flip-card-inner">
                <div class="flip-card-front"><img src="{{ asset('images/kartu 3.png') }}" class="card-img"></div>
                <div class="flip-card-back">
                    <img src="{{ asset('images/ioh.png') }}" class="card-img">
                    <div class="card-text-overlay text-normal">
                        Introduction of Himpunan (IoH) merupakan kegiatan yang bertujuan untuk memperkenalkan mahasiswa baru pada berbagai organisasi yang ada di lingkungan Departemen Teknik Elektro dan Informatika. <br><br>
                        Melalui kegiatan ini, mahasiswa baru tidak hanya dikenalkan dengan struktur dan peran organisasi, tetapi juga diberikan pemahaman mengenai program kerja serta tanggung jawab yang dijalankan selama periode kepengurusan.
                    </div>
                </div>
            </div>
        </div>
        
        <div class="flip-card" onclick="this.classList.toggle('flipped')">
            <div class="flip-card-inner">
                <div class="flip-card-front"><img src="{{ asset('images/kartu 4.png') }}" class="card-img"></div>
                <div class="flip-card-back">
                    <img src="{{ asset('images/NAKO.png') }}" class="card-img">
                    <div class="card-text-overlay text-long">
                        NAKO merupakan acara peresmian mahasiswa baru sebagai mahasiswa resmi di Departemen Teknik Elektro dan Informatika. <br><br>
                        Kegiatan ini menjadi penutup rangkaian ospek departemen yang dirancang untuk memberikan pengalaman akhir yang berkesan bagi mahasiswa baru. <br><br>
                        Melalui NAKO, mahasiswa baru diberi ruang untuk mengembangkan keterampilan serta bakat yang dimiliki, sekaligus menumbuhkan semangat kerja sama dan mempererat hubungan antaranggota angkatan. <br><br>
                        Dengan demikian, tercipta rasa kebersamaan, solidaritas, serta kekompakan yang kuat di antara mahasiswa baru, yang kemudian dikenal dengan sebutan UNITY.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>