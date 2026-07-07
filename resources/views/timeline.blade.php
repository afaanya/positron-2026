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
            border-radius: 3px 4px 0 0;
            background: linear-gradient(to top, #7d613b, #f5dfbb);
            box-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }

        /* Jarum Jam (Pendek & Lebih Tebal) */
        .hand-hour {
            width: 4px;
            height: 12%;
            margin-left: -2px;
        }

        /* Jarum Menit (Panjang & Sedang) */
        .hand-minute {
            width: 3px;
            height: 18%;
            margin-left: -1.5px;
        }

        /* Jarum Detik (Tipis & Warna Emas/Kuning) */
        .hand-second {
            width: 1.5px;
            height: 20%;
            margin-left: -0.75px;
            background: #f1c40f;
            z-index: 25;
        }

        .header-container {
            position: relative;
            width: 100%;
            z-index: 10;
        }

        .header {
            width: 100%;
            display: block;
        }

        .menu {
            position: absolute;
            display: block;
            cursor: pointer;
            z-index: 9999;
        }

        .home{ 
        top:22%;
        left:60%;
        width:8%;
        height:35%;
        }

        .about{
            top:22%;
            left:68%;
            width:8%;
            height:35%;
        }

        .filosofi{
            top:22%;
            left:76%;
            width:9%;
            height:35%;
        }

        .timeline{
            top:22%;
            left:84%;
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
        display:flex;
        flex-direction:column;
        }

        .profile-panel.active{
            right:0;
        }

        .profile-menu{
            flex:1;
            overflow-y:auto;
            display:flex;
            flex-direction:column;
            gap:10px;
        }

        .profile-menu-bottom{
            margin-top:auto;
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

        <a href="{{ route('home') }}" class="menu home"></a>
        <a href="{{ route('about') }}" class="menu about"></a>
        <a href="{{ route('filosofi') }}" class="menu filosofi"></a>
        <a href="{{ route('timeline') }}" class="menu timeline"></a>

        <a href="javascript:void(0)" onclick="toggleProfile()" class="menu profil"></a>
    </div>

    <main class="w-full max-w-4xl mx-auto flex flex-col justify-center items-center z-10 px-4 py-6 my-auto">
        
        <div class="text-center mb-6">
            <h1 class="font-primary text-5xl md:text-7xl text-[#F8D794] tracking-wide drop-shadow-md">
            </h1>
        </div>

        <div style="display:flex; align-items:center; gap:40px;">
            <div class="clock-wrapper w-[800px] relative" style="margin-left:-400px;">
                
                <img src="{{ asset('images/timeline-1.png') }}" alt="Timeline Clock" class="w-full h-auto block opacity-95">

            {{-- Overlay Kalender --}}
    <div id="calendar-overlay" style="
        position: absolute;
        top: 62%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: min(240px, 36%);
        max-width: 260px;
        margin: 0 auto;
        text-align: center;
        color: #c8a96e;
        font-family: 'Libre Baskerville', serif;
        pointer-events: none;
        line-height: 1.4;
    ">
    <div id="cal-header" style="
        font-size: 11px;
        font-weight: bold;
        letter-spacing: 1.2px;
        margin-bottom: 4px;
    "></div>

    <table id="cal-table" style="
        width: auto;
        margin: 0 auto;
        border-collapse: separate;
        border-spacing: 4px 1px;
        font-size: 7px;
        line-height: 1.4;
        letter-spacing: 0.5px;
    "></table>
    </div>

    <div class="clock-center-pin"></div>
    <div id="js-hour" class="clock-hand hand-hour"></div>
    <div id="js-minute" class="clock-hand hand-minute"></div>
    <div id="js-second" class="clock-hand hand-second"></div>

            </div>

            <div style="text-align:left; color:#F8D794; font-family:'Libre Baskerville', serif;">
                <div id="countdownDisplay" style="font-size:16px; margin:0; line-height:1.8;">
                    <strong>Menghitung...</strong>
                </div>
            </div>
        </div>

        <div class="text-center mt-6 font-secondary text-[11px] md:text-xs text-[#F8D794]/80 tracking-widest bg-black/40 px-4 py-1.5 rounded-full backdrop-blur-sm">
        </div>

    </main>

    <div id="profilePanel" class="profile-panel">
        <div class="profile-header">
            <h3>Mahasiswa</h3>
            <span onclick="toggleProfile()">✕</span>
        </div>

        <div class="profile-menu">
            <button onclick="window.location.href='{{ route('biodata') }}'">Biodata</button>
            <button onclick="window.location.href='{{ route('poin') }}'">Poin</button>
            <button onclick="window.location.href='{{ route('sertifikat') }}'">Sertifikat</button>
            
            <div class="profile-menu-bottom">
                <button onclick="window.open('https://docs.google.com/forms/d/e/1FAIpQLSfmCmaEVXqK1s1E3H0XGTLKYiFSYI0ciSAoy1iGQyDEYdWjBQ/viewform?usp=dialog', '_blank')" style="background:#1c2f25;">Kritik dan Saran</button>
                <form id="logoutForm" action="{{ route('logout') }}" method="POST" style="display:none;">
                    @csrf
                </form>
                <button onclick="document.getElementById('logoutForm').submit()" style="background:#c5453d;">Logout</button>
            </div>
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
            document.getElementById('js-second').style.transform = rotate(${secondsDegrees}deg);
            document.getElementById('js-minute').style.transform = rotate(${minutesDegrees}deg);
            document.getElementById('js-hour').style.transform = rotate(${hoursDegrees}deg);
        }

        // Jalankan fungsi setiap 1 detik sekali
        setInterval(updateClock, 1000);
        
        // Panggil di awal agar langsung render posisi pas halaman di-load
        updateClock();

        function toggleProfile(){
            document.getElementById("profilePanel").classList.toggle("active");
        }

        function updateCalendar() {
    const now = new Date();
    const year = now.getFullYear();
    const month = now.getMonth();

    const monthNames = ["JANUARI","FEBRUARI","MARET","APRIL","MEI","JUNI",
                        "JULI","AGUSTUS","SEPTEMBER","OKTOBER","NOVEMBER","DESEMBER"];
    const dayNames = ["M","S","S","R","K","J","S"];

    document.getElementById('cal-header').innerText = monthNames[month] + ' ' + year;

    const firstDay = new Date(year, month, 1).getDay();
    const startDay = firstDay;
    const daysInMonth = new Date(year, month + 1, 0).getDate();

    let html = '<tr>';
    dayNames.forEach((d, idx) => {
        const color = idx === 0 ? '#ff4444' : '#c8a96e';
        html += `<td style="padding:0px 1px; color:${color}; font-weight:bold;">${d}</td>`;
    });
    html += '</tr><tr>';

    let day = 1;
    for (let i = 0; i < startDay; i++) html += '<td style="padding:0 4px; height:12px; width:13px"></td>';

    for (let i = startDay; i < 42; i++) {
        if (day > daysInMonth) break;
        if (i % 7 === 0 && i !== startDay) html += '</tr><tr>';
        const isToday = day === now.getDate();
        const isSunday = i % 7 === 0;
        const isTargetDate = day === 21; // Tanggal 21 Juli
        const textColor = isSunday ? '#ff4444' : (isToday ? '#fff' : '#c8a96e');
        const fontWeight = isToday || isSunday ? 'bold' : 'normal';
        const borderStyle = isTargetDate ? 'border:2px solid #F8D794; border-radius:50%; padding:2px;' : '';
        html += `<td style="padding:0 4px; height:12px; width:13px; color:${textColor}; font-weight:${fontWeight}; ${borderStyle}">${day}</td>`;
        day++;
    }
    html += '</tr>';

    document.getElementById('cal-table').innerHTML = html;
}

function updateCountdown() {
    const now = new Date();
    const currentYear = now.getFullYear();
    const birthdayDate = new Date(currentYear, 6, 21); // Juli adalah bulan ke-6 (0-indexed)
    
    // Jika ulang tahun sudah lewat tahun ini, hitung untuk tahun depan
    if (now > birthdayDate) {
        birthdayDate.setFullYear(currentYear + 1);
    }
    
    const diff = birthdayDate - now;
    
    // Jika sudah hari H
    if (diff < 0 || (now.getDate() === 21 && now.getMonth() === 6)) {
        document.getElementById('countdownDisplay').innerHTML = '<strong style="font-size:20px;">Hari-H Ulang Tahun Arsyad 🎉</strong>';
        return;
    }
    
    const days = Math.floor(diff / (1000 * 60 * 60 * 24));
    const hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
    
    document.getElementById('countdownDisplay').innerHTML = `
        <span style="font-size:20px;">
            ${days} hari | ${hours} jam | ${minutes} menit
        </span><br>
        <strong style="font-size:22px;">Menuju Ulang Tahun Arsyad</strong><br> 
    `;
}

updateCountdown();
setInterval(updateCountdown, 1000);

updateCalendar();
    </script>
@include('layouts.partials.footer')
</body>
</html>