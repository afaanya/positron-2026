@vite(['resources/css/rangkaian.css', 'resources/js/rangkaian.js'])

<div class="rangkaian-section">
    <img src="{{ asset('images/logo-positron.png') }}" class="logo-top" alt="Logo">
    
    <div class="cards-container">
        <div class="flip-card" onclick="flipCard(this)">
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
        
        <div class="flip-card" onclick="flipCard(this)">
            <div class="flip-card-inner">
                <div class="flip-card-front"><img src="{{ asset('images/kartu 2.png') }}" class="card-img"></div>
                <div class="flip-card-back">
                    <img src="{{ asset('images/ldk.png') }}" class="card-img">
                    <div class="card-text-overlay text-normal">
                        Latihan Dasar Kepemimpinan (LDK) adalah kegiatan pelatihan interaktif bagi mahasiswa baru yang mengintegrasikan teori dan praktik untuk mengasah keterampilan kepemimpinan. <br><br>
                        Kegiatan ini bertujuan untuk membangun kepercayaan diri, kerja sama, dan kemampuan manajemen konflik untuk menciptakan pemimpin yang kompeten.
                    </div>
                </div>
            </div>
        </div>

        <div class="flip-card" onclick="flipCard(this)">
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
        
        <div class="flip-card" onclick="flipCard(this)">
            <div class="flip-card-inner">
                <div class="flip-card-front"><img src="{{ asset('images/kartu 4.png') }}" class="card-img"></div>
                <div class="flip-card-back">
                    <img src="{{ asset('images/nako.png') }}" class="card-img">
                    <div class="card-text-overlay text-normal">
                        NAKO merupakan acara peresmian mahasiswa baru Departemen Teknik Elektro dan Informatika yang menjadi penutup dari serangkaian ospek departemen. <br><br>
                        Kegiatan ini bertujuan untuk mengembangkan bakat dan juga tempat untuk mempererat hubungan dan kekompakan angkatan, yang kemudian dikenal dengan sebutan UNITY.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>