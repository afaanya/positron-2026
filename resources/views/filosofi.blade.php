<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filosofi - POSITRON 2026</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Libre+Baskerville:wght@400;700&family=Praise&display=swap');

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