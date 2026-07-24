<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:wght@400;700&display=swap" rel="stylesheet">

@vite(['resources/css/rangkaian.css', 'resources/js/rangkaian.js'])

<div class="rangkaian-section" style="font-family: 'Libre Baskerville', serif;">
    <img src="{{ asset('images/logo-positron.webp') }}" class="logo-top" alt="Logo">

    {{-- ========== DESKTOP / TABLET: flip-card hover ========== --}}
    <div class="cards-container">
        <div class="flip-card">
            <div class="flip-card-inner">
                <div class="flip-card-front"><img src="{{ asset('images/kartu 1.webp') }}" class="card-img"></div>
                <div class="flip-card-back">
                    <img src="{{ asset('images/fm.webp') }}" class="card-img">
                    <div class="card-text-overlay text-normal">
                        Forum Mahasiswa Baru (Forum Maba) merupakan kegiatan dalam rangka menyambut mahasiswa baru. Kegiatan ini menjadi wadah awal bagi mahasiswa baru untuk mengenal dunia perkuliahan, nilai-nilai akademik, serta lingkungan sosial di jurusan.
                    </div>
                </div>
            </div>
        </div>

        <div class="flip-card">
            <div class="flip-card-inner">
                <div class="flip-card-front"><img src="{{ asset('images/kartu 2.webp') }}" class="card-img"></div>
                <div class="flip-card-back">
                    <img src="{{ asset('images/ldk.webp') }}" class="card-img">
                    <div class="card-text-overlay text-normal">
                        Latihan Dasar Kepemimpinan (LDK) adalah kegiatan pelatihan interaktif bagi mahasiswa baru yang mengintegrasikan teori dan praktik untuk mengasah keterampilan kepemimpinan. <br><br>
                        Kegiatan ini bertujuan untuk membangun kepercayaan diri, kerja sama, dan kemampuan manajemen konflik untuk menciptakan pemimpin yang kompeten.
                    </div>
                </div>
            </div>
        </div>

        <div class="flip-card">
            <div class="flip-card-inner">
                <div class="flip-card-front"><img src="{{ asset('images/kartu 3.webp') }}" class="card-img"></div>
                <div class="flip-card-back">
                    <img src="{{ asset('images/ioh.webp') }}" class="card-img">
                    <div class="card-text-overlay text-medium">
                        Introduction of Himpunan (IoH) merupakan kegiatan yang bertujuan untuk memperkenalkan mahasiswa baru pada berbagai organisasi yang ada di lingkungan Departemen Teknik Elektro dan Informatika. <br><br>
                        Melalui kegiatan ini, mahasiswa baru tidak hanya dikenalkan dengan struktur dan peran organisasi, tetapi juga diberikan pemahaman mengenai program kerja serta tanggung jawab yang dijalankan selama periode kepengurusan.
                    </div>
                </div>
            </div>
        </div>

        <div class="flip-card">
            <div class="flip-card-inner">
                <div class="flip-card-front"><img src="{{ asset('images/kartu 4.webp') }}" class="card-img"></div>
                <div class="flip-card-back">
                    <img src="{{ asset('images/nako.webp') }}" class="card-img">
                    <div class="card-text-overlay text-normal">
                        NAKO merupakan acara peresmian mahasiswa baru Departemen Teknik Elektro dan Informatika yang menjadi penutup dari serangkaian ospek departemen. <br><br>
                        Kegiatan ini bertujuan untuk mengembangkan bakat dan juga tempat untuk mempererat hubungan dan kekompakan angkatan, yang kemudian dikenal dengan sebutan UNITY.
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ========== MOBILE (<=768px): kubus 3D, tap buat lihat detail, tombol/swipe buat putar ========== --}}
    <div class="cube-wrapper">
        <div class="cube-scene">
            <div class="cube" id="rangkaianCube">
                <div class="cube-face cube-face--1 cube-face--flip">
                    <div class="cube-face-inner">
                        <div class="cube-face-front"><img src="{{ asset('images/kartu 1.webp') }}" class="card-img"></div>
                        <div class="cube-face-back">
                            <img src="{{ asset('images/fm.webp') }}" class="card-img">
                            <div class="card-text-overlay text-normal">
                                Forum Mahasiswa Baru (Forum Maba) merupakan kegiatan dalam rangka menyambut mahasiswa baru. Kegiatan ini menjadi wadah awal bagi mahasiswa baru untuk mengenal dunia perkuliahan, nilai-nilai akademik, serta lingkungan sosial di jurusan.
                            </div>
                        </div>
                    </div>
                </div>

                <div class="cube-face cube-face--2 cube-face--flip">
                    <div class="cube-face-inner">
                        <div class="cube-face-front"><img src="{{ asset('images/kartu 2.webp') }}" class="card-img"></div>
                        <div class="cube-face-back">
                            <img src="{{ asset('images/ldk.webp') }}" class="card-img">
                            <div class="card-text-overlay text-normal">
                                Latihan Dasar Kepemimpinan (LDK) adalah kegiatan pelatihan interaktif bagi mahasiswa baru yang mengintegrasikan teori dan praktik untuk mengasah keterampilan kepemimpinan. <br><br>
                                Kegiatan ini bertujuan untuk membangun kepercayaan diri, kerja sama, dan kemampuan manajemen konflik untuk menciptakan pemimpin yang kompeten.
                            </div>
                        </div>
                    </div>
                </div>

                <div class="cube-face cube-face--3 cube-face--flip">
                    <div class="cube-face-inner">
                        <div class="cube-face-front"><img src="{{ asset('images/kartu 3.webp') }}" class="card-img"></div>
                        <div class="cube-face-back">
                            <img src="{{ asset('images/ioh.webp') }}" class="card-img">
                            <div class="card-text-overlay text-medium">
                                Introduction of Himpunan (IoH) merupakan kegiatan yang bertujuan untuk memperkenalkan mahasiswa baru pada berbagai organisasi yang ada di lingkungan Departemen Teknik Elektro dan Informatika. <br><br>
                                Melalui kegiatan ini, mahasiswa baru tidak hanya dikenalkan dengan struktur dan peran organisasi, tetapi juga diberikan pemahaman mengenai program kerja serta tanggung jawab yang dijalankan selama periode kepengurusan.
                            </div>
                        </div>
                    </div>
                </div>

                <div class="cube-face cube-face--4 cube-face--flip">
                    <div class="cube-face-inner">
                        <div class="cube-face-front"><img src="{{ asset('images/kartu 4.webp') }}" class="card-img"></div>
                        <div class="cube-face-back">
                            <img src="{{ asset('images/nako.webp') }}" class="card-img">
                            <div class="card-text-overlay text-normal">
                                NAKO merupakan acara peresmian mahasiswa baru Departemen Teknik Elektro dan Informatika yang menjadi penutup dari serangkaian ospek departemen. <br><br>
                                Kegiatan ini bertujuan untuk mengembangkan bakat dan juga tempat untuk mempererat hubungan dan kekompakan angkatan, yang kemudian dikenal dengan sebutan UNITY.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="cube-nav">
            <button id="cubePrev" aria-label="Sebelumnya">&#8592;</button>
            <div class="cube-dots" id="cubeDots">
                <span class="active"></span>
                <span></span>
                <span></span>
                <span></span>
            </div>
            <button id="cubeNext" aria-label="Berikutnya">&#8594;</button>
        </div>
    </div>
</div>