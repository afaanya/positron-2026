<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Timeline - POSITRON 2026</title>
    <script src="https://cdn.tailwindcss.com"></script>
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Libre+Baskerville:wght@400;700&family=Praise&display=swap');

        :root {
            --font-primary: 'Praise', cursive;
            --font-secondary: 'Libre Baskerville', serif;
            --color-accent: #F8D794;
        }

        .font-primary { font-family: var(--font-primary); }
        .font-secondary { font-family: var(--font-secondary); }

        /* Menggunakan file background dari Anda */
        .royal-bg {
    background-image: url("{{ asset('images/login-bg.png') }}");
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
}

        /* --- LOGIK JARUM JAM INTERAKTIF --- */
        .clock-wrapper {
            position: relative;
            display: inline-block;
        }

        /* Titik poros tengah untuk menutupi jarum asli bawaan gambar */
        .clock-center-pin {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 14px;
            height: 14px;
            background: #c5a880;
            border: 2px solid #54432b;
            border-radius: 50%;
            transform: translate(-50%, -50%);
            z-index: 30;
            box-shadow: 0 2px 4px rgba(0,0,0,0.5);
        }

        /* Base style untuk jarum jam baru */
        .clock-hand {
            position: absolute;
            bottom: 50%;
            left: 50%;
            transform-origin: bottom center;
            z-index: 20;
            border-radius: 4px 4px 0 0;
            background: linear-gradient(to top, #7d613b, #f5dfbb);
            box-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }

        /* Jarum Jam (Pendek & Lebih Tebal) */
        .hand-hour {
            width: 4px;
            height: 18%;
            margin-left: -2px;
        }

        /* Jarum Menit (Panjang & Sedang) */
        .hand-minute {
            width: 3px;
            height: 25%;
            margin-left: -1.5px;
        }

        /* Jarum Detik (Tipis & Warna Emas/Kuning) */
        .hand-second {
            width: 1.5px;
            height: 28%;
            margin-left: -0.75px;
            background: #f1c40f;
            z-index: 25;
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

        .profile-content{
            margin-top:20px;
            font-size:14px;
        }
    </style>
</head>
<body class="min-h-screen flex flex-col justify-between antialiased text-white">
    <img src="{{ asset('images/login-bg.png') }}" 
         alt="Background" 
         class="fixed inset-0 w-full h-full object-cover -z-10">

    <div class="header-container">
        <img src="{{ asset('images/header.png') }}" class="header">

        <a href="{{ route('homepage') }}" class="menu home"></a>
        <a href="{{ url('/about') }}" class="menu about"></a>
        <a href="{{ route('filosofi') }}" class="menu filosofi"></a>
        <a href="{{ url('/timeline') }}" class="menu timeline"></a>

        <div class="menu profil" onclick="toggleProfile()"></div>
    </div>

    <main class="w-full max-w-4xl mx-auto flex flex-col justify-center items-center z-10 px-4 py-6 my-auto">
        
        <div class="text-center mb-6">
            <h1 class="font-primary text-5xl md:text-7xl text-[#F8D794] tracking-wide drop-shadow-md">
                Timeline Kegiatan
            </h1>
        </div>

        <div class="clock-wrapper w-1/2 mx-auto" style="position: relative;">
            
            <img src="{{ asset('images/timeline2.png') }}" alt="Timeline Clock" class="w-full h-auto block opacity-95">

            {{-- Overlay Kalender --}}
    <div id="calendar-overlay" style="
        position: absolute;
        top: 53%;
        left: 50%;
        transform: translateX(-50%);
        width: 35%;
        text-align: center;
        color: #c8a96e;
        font-family: 'Libre Baskerville', serif;
        pointer-events: none;
    ">
        <div id="cal-header" style="font-size: 0.6vw; letter-spacing: 1px; margin-bottom: 2px;"></div>
        <table id="cal-table" style="width: 100%; border-collapse: collapse; font-size: 0.65vw;"></table>
    </div>

    <div class="clock-center-pin"></div>
    <div id="js-hour" class="clock-hand hand-hour"></div>
    <div id="js-minute" class="clock-hand hand-minute"></div>
    <div id="js-second" class="clock-hand hand-second"></div>

</div>

        <div class="text-center mt-6 font-secondary text-[11px] md:text-xs text-[#F8D794]/80 tracking-widest bg-black/40 px-4 py-1.5 rounded-full backdrop-blur-sm">
        </div>

    </main>

    <footer class="w-full z-20 mt-auto">
        <img src="{{ asset('images/footer.png') }}" alt="Footer" class="w-full h-auto object-cover block">
    </footer>

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
        function updateClock() {
            const now = new Date();
            
            const seconds = now.getSeconds();
            const minutes = now.getMinutes();
            const hours = now.getHours();

            // Hitung derajat rotasi masing-masing jarum
            const secondsDegrees = (seconds / 60) * 360;
            const minutesDegrees = (minutes / 60) * 360 + (seconds / 60) * 6;
            const hoursDegrees = (hours / 12) * 360 + (minutes / 60) * 30;

            // Terapkan style transform rotasi ke elemen DOM
            document.getElementById('js-second').style.transform = `rotate(${secondsDegrees}deg)`;
            document.getElementById('js-minute').style.transform = `rotate(${minutesDegrees}deg)`;
            document.getElementById('js-hour').style.transform = `rotate(${hoursDegrees}deg)`;
        }

        // Jalankan fungsi setiap 1 detik sekali
        setInterval(updateClock, 1000);
        
        // Panggil di awal agar langsung render posisi pas halaman di-load
        updateClock();

        function updateCalendar() {
    const now = new Date();
    const year = now.getFullYear();
    const month = now.getMonth();

    const monthNames = ["JANUARI","FEBRUARI","MARET","APRIL","MEI","JUNI",
                        "JULI","AGUSTUS","SEPTEMBER","OKTOBER","NOVEMBER","DESEMBER"];
    const dayNames = ["M","S","S","R","K","J","S"];

    document.getElementById('cal-header').innerText = monthNames[month] + ' ' + year;

    const firstDay = new Date(year, month, 1).getDay();
    const startDay = (firstDay === 0) ? 6 : firstDay - 1;
    const daysInMonth = new Date(year, month + 1, 0).getDate();

    let html = '<tr>';
    dayNames.forEach(d => {
        html += `<td style="padding:1px 3px; color:#c8a96e; font-weight:bold;">${d}</td>`;
    });
    html += '</tr><tr>';

    let day = 1;
    for (let i = 0; i < startDay; i++) html += '<td></td>';

    for (let i = startDay; i < 42; i++) {
        if (day > daysInMonth) break;
        if (i % 7 === 0 && i !== startDay) html += '</tr><tr>';
        const isToday = day === now.getDate();
        html += `<td style="padding:1px 3px; ${isToday ? 'color:#fff; font-weight:bold;' : ''}">${day}</td>`;
        day++;
    }
    html += '</tr>';

    document.getElementById('cal-table').innerHTML = html;
}

updateCalendar();
    </script>
</body>
</html>