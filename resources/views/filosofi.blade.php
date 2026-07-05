<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filosofi - POSITRON 2026</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Libre+Baskerville:wght@400;700&family=Praise&display=swap');

<<<<<<< HEAD
        .hover-zone {
            position: absolute;
            cursor: pointer;
        }

        .home{ 
            top:22%;
            left:22%;
            width:8%;
            height:35%;
        }
=======
@section('title', 'POSITRON 2026')

@section('content')

{{-- Pastikan semua CSS Framer ada di sini --}}
<style data-framer-css-ssr>
    #main { margin: 0; padding: 0; box-sizing: border-box; }
    /* Masukkan sisa CSS Framer lainnya di sini */
    #main .framer-19x1pli,
    #main .framer-fvioy7,
    #main .framer-pminup,
    #main .framer-ja1rm5,
    #main .framer-sndbxq,
    #main .framer-1dc1xbn,
    #main .framer-ibtkzf,
    #main .framer-1uu9s9d {
        display: none !important;
    }
</style>

<div id="main"></div>

<script type="module" async data-framer-bundle="main" fetchPriority="low" src="https://framerusercontent.com/sites/2OlsEc6bTAzSITpQNhK9Mi/script_main.TRnTmZmM.mjs"></script>

<script>
    document.title = "Filosofi | POSITRON 2026";

    const replacementContent = '<h2>The Symphony of the Ton dan Diverse in Origin, United in Vision:</h2>' +
        '<p>Menggambarkan bahwa dunia kampus diisi oleh berbagai macam karakter, latar belakang, dan keahlian. Jika dipadukan dengan baik, perbedaan ini akan menciptakan harmoni yang indah (simfoni). Menegaskan bahwa meskipun mahasiswa baru berasal dari "keluarga" yang berbeda-beda, mereka kini berdiri di bawah satu nama almamater dan harus berkolaborasi untuk mencapai visi bersama.</p>';
    const searchRegex = /A special invitation awaits you\.[\s\S]*?Discover smething extraordinary inside\./i;

    function replaceFramerText() {
        const allElements = document.querySelectorAll('body *');
        for (const el of allElements) {
            if (el.children.length === 0 && el.innerHTML && searchRegex.test(el.innerHTML)) {
                el.innerHTML = replacementContent;
            }
        }
    }

    function observeFramer() {
        const observer = new MutationObserver(() => {
            replaceFramerText();
        });
        observer.observe(document.body, {
            childList: true,
            subtree: true,
            characterData: true
        });
        replaceFramerText();
    }

    if (document.readyState === 'complete') {
        observeFramer();
    } else {
        window.addEventListener('load', observeFramer);
    }
</script>
>>>>>>> b7c90692dd0e26e48346bc02c6bab145d9d52e52

        .about{
            top:22%;
            left:34%;
            width:8%;
            height:35%;
        }

        .filosofi{
            top:22%;
            left:46%;
            width:9%;
            height:35%;
        }

        .timeline{
            top:22%;
            left:59%;
            width:9%;
            height:35%;
        }

        .profil{
            top:12%;
            right:2.5%;
            width:4%;
            height:60%;
            border-radius:50%;
            z-index:99999;
            cursor:pointer;
            display:block;
        }

        .profile-panel{
            position:fixed;
            top:0;
            right:-340px;
            width:340px;
            height:100vh;
            background:#0f1f17;
            color:white;
            z-index:999999;
            transition:0.3s ease;
            padding:20px;
            box-shadow:-10px 0 30px rgba(0,0,0,0.4);
        }

        .profile-panel.active{
            right:0;
        }

        .profile-header{
            display:flex;
            justify-content:space-between;
            align-items:center;
            margin-bottom:20px;
        }

        .profile-header span{
            cursor:pointer;
            font-size:20px;
        }

        .profile-menu button{
            width:100%;
            margin-bottom:10px;
            padding:10px;
            background:#1c2f25;
            border:none;
            color:white;
            cursor:pointer;
            border-radius:6px;
        }

        .profile-menu button:hover{
            background:#2a4a38;
        }
    </style>
</head>
<body class="min-h-screen antialiased text-white overflow-hidden">

    {{-- Background --}}
    <img src="{{ asset('images/login-bg.png') }}"
         alt="Background"
         class="fixed inset-0 w-full h-full object-cover -z-10">

    {{-- Header --}}
    <div class="header-container">
        <img src="{{ asset('images/header.png') }}" class="header">
        <a href="{{ route('homepage') }}" class="menu home"></a>
        <a href="{{ url('/about') }}" class="menu about"></a>
        <a href="{{ route('filosofi') }}" class="menu filosofi"></a>
        <a href="{{ url('/timeline') }}" class="menu timeline"></a>
        <div class="menu profil" onclick="toggleProfile()"></div>
    </div>

    {{-- Main area --}}
    <div class="relative w-full" style="height: 100vh;">

        {{-- Gambar utama --}}
        <img src="{{ asset('images/filosofi1.png') }}"
             alt="Filosofi"
             id="filosofi-img"
             class="absolute inset-0 w-full h-full object-cover">

        {{-- Hover zone petir atas --}}
        <div class="hover-zone"
             style="top: 15%; left: 40%; width: 20%; height: 25%;"
             onmouseenter="gantiGambar('filosofi3.png')"
             onmouseleave="resetGambar()"
             onclick="clickPetir()">
        </div>

        {{-- Hover zone petir bawah --}}
        <div class="hover-zone"
             style="top: 40%; left: 38%; width: 18%; height: 28%;"
             onmouseenter="gantiGambar('filosofi2.png')"
             onmouseleave="resetGambar()"
             onclick="clickPetir()">
        </div>

    </div>

    {{-- Footer --}}
    <footer class="fixed bottom-0 w-full z-20">
        <img src="{{ asset('images/footer.png') }}" alt="Footer" class="w-full h-auto object-cover block">
    </footer>

    {{-- Profile Panel --}}
    <div id="profilePanel" class="profile-panel">
        <div class="profile-header">
            <h3>Mahasiswa</h3>
            <span onclick="toggleProfile()">✕</span>
        </div>
        <div class="profile-menu">
            <button onclick="window.location.href='{{ route('biodata') }}'">Biodata</button>
            <button onclick="window.location.href='{{ route('poin') }}'">Poin</button>
            <button onclick="window.location.href='{{ route('sertifikat') }}'">Sertifikat</button>
        </div>
    </div>

    <script>
        let isClicked = false;

        function gantiGambar(nama) {
            if (isClicked) return;
            document.getElementById('filosofi-img').src = "{{ asset('images/') }}" + nama;
        }

        function resetGambar() {
            if (isClicked) return;
            document.getElementById('filosofi-img').src = "{{ asset('images/filosofi1.png') }}";
        }

        function clickPetir() {
            isClicked = !isClicked;
            if (isClicked) {
                document.getElementById('filosofi-img').src = "{{ asset('images/filosofi4.png') }}";
            } else {
                document.getElementById('filosofi-img').src = "{{ asset('images/filosofi1.png') }}";
            }
        }

        function toggleProfile() {
            document.getElementById('profilePanel').classList.toggle('active');
        }
    </script>

</body>
</html>