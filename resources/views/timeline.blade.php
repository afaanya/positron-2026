@extends('layouts.app')

@section('title', 'Timeline - POSITRON 2026')

@section('styles')
<meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        transition: transform 0.2s linear;
        pointer-events: none;
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

    .countdown-box{
        width: 320px;
        min-height:170px;
        display:flex;
        justify-content:center;
        align-items:center;
        background:rgba(0,0,0,.25);
        border:2px solid rgba(248,215,148,.35);
        border-radius:18px;
        padding:20px;
        text-align:center;
        color:#F8D794;
        font-family:'Libre Baskerville', serif;
        backdrop-filter:blur(5px);
        flex-shrink: 0;
    }

    /* ═══ Responsive timeline layout ═══ */
    .timeline-main-wrap {
        display: flex;
        align-items: center;
        gap: 40px;
        flex-wrap: wrap;
        justify-content: center;
        width: 100%;
    }

    .timeline-clock-wrap {
        width: 100%;
        max-width: 700px;
    }

    @media (max-width: 900px) {
        .timeline-main-wrap {
            flex-direction: column;
            gap: 24px;
        }
        .timeline-clock-wrap {
            max-width: 100%;
            width: 100%;
        }
        .countdown-box {
            width: 100%;
            max-width: 420px;
        }
    }

    @media (max-width: 560px) {
        .countdown-box {
            width: 100%;
        }
    }

    #countdownDisplay{
        width:100%;
        line-height:1.8;
    }

    @keyframes pulse{
        0%{ transform:scale(1); }
        50%{ transform:scale(1.25); }
        100%{ transform:scale(1); }
    }
</style>
@endsection

@section('content')
<div class="min-h-screen flex flex-col justify-between antialiased text-white">
    <img src="{{ asset('images/login-bg.png') }}" 
         alt="Background" 
         class="fixed inset-0 w-full h-full object-cover -z-10">

    <main class="w-full max-w-4xl mx-auto flex flex-col justify-center items-center z-10 px-4 py-6 my-auto">
        
        <div class="text-center mb-6">
            <h1 class="font-primary text-5xl md:text-7xl text-[#F8D794] tracking-wide drop-shadow-md">
            </h1>
        </div>

        {{-- Responsive container: kolom di mobile, baris di desktop --}}
        <div class="timeline-main-wrap">
            <div class="clock-wrapper relative timeline-clock-wrap">
                
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
        pointer-events: auto;
        line-height: 1.4;
    ">
    <div style="display:flex; justify-content:center; align-items:center; gap:6px; margin-bottom:6px;">
        <button type="button" id="prevMonthBtn" style="border:none; background:rgba(248,215,148,0.15); color:#f8d794; border-radius:50%; width:18px; height:18px; cursor:pointer; font-size:11px; line-height:1;">‹</button>
        <div id="cal-header" style="
            font-size: 9px;
            font-weight: bold;
            letter-spacing: 1.2px;
        "></div>
        <button type="button" id="nextMonthBtn" style="border:none; background:rgba(248,215,148,0.15); color:#f8d794; border-radius:50%; width:18px; height:18px; cursor:pointer; font-size:11px; line-height:1;">›</button>
    </div>

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

 <div class="countdown-box">
    <div id="countdownDisplay">
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

</div>

<script>
    let lastSecondAngle = 0;
    let revolution = 0;

    function updateClock() {
        const now = new Date();
        const ms = now.getMilliseconds();
        const sec = now.getSeconds() + ms / 1000;
        const min = now.getMinutes() + sec / 60;
        const hour = (now.getHours() % 12) + min / 60;

        let secondAngle = sec * 6;
        if (secondAngle < lastSecondAngle) { revolution += 360; }
        lastSecondAngle = secondAngle;

        const secondRotation = revolution + secondAngle;
        const minuteRotation = revolution / 60 + min * 6;
        const hourRotation = revolution / 720 + hour * 30;

        document.getElementById("js-second").style.transform = `rotate(${secondRotation}deg)`;
        document.getElementById("js-minute").style.transform = `rotate(${minuteRotation}deg)`;
        document.getElementById("js-hour").style.transform   = `rotate(${hourRotation}deg)`;

        requestAnimationFrame(updateClock);
    }

    requestAnimationFrame(updateClock);

    function toggleProfile(){
        document.getElementById("profilePanel").classList.toggle("active");
    }

    let currentCalendarDate = new Date();

    function updateCalendar() {
        const now = new Date();
        const year = currentCalendarDate.getFullYear();
        const month = currentCalendarDate.getMonth();

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

        const eventDates = [
            { day: 19, month: 7, year: 2026 },
            { day: 20, month: 7, year: 2026 },
            { day: 11, month: 9, year: 2026 },
            { day: 24, month: 9, year: 2026 },
            { day: 20, month: 10, year: 2026 }
        ];

        for (let i = startDay; i < 42; i++) {
            if (day > daysInMonth) break;
            if (i % 7 === 0 && i !== startDay) html += '</tr><tr>';
            const isToday = day === now.getDate() && month === now.getMonth() && year === now.getFullYear();
            const isSunday = i % 7 === 0;
            const isEventDate = eventDates.some(event => event.day === day && event.month === month && event.year === year);
            const textColor = isSunday ? '#ff4444' : (isToday ? '#fff' : '#c8a96e');
            const fontWeight = isToday || isSunday ? 'bold' : 'normal';

            const dayContent = isEventDate
                ? `<span style="display:inline-block; border:2px solid rgba(248,215,148,0.3); border-radius:50%; padding:2px; min-width:13px; text-align:center;">${day}</span>`
                : `${day}`;

            html += `<td style="padding:0 4px; height:12px; width:13px; color:${textColor}; font-weight:${fontWeight}; text-align:center;">${dayContent}</td>`;
            day++;
        }
        html += '</tr>';

        document.getElementById('cal-table').innerHTML = html;
    }

    function updateCountdown() {
        const now = new Date();
        const currentYear = currentCalendarDate.getFullYear();
        const currentMonth = currentCalendarDate.getMonth();

        const events = [
            { name: 'FORUM MABA 2026', day: 19, month: 7, year: 2026,
              link: 'https://link-manual-book-forum-maba.com',
              docLink: 'https://link-dokumentasi-forum-maba.com' },
            { name: 'LDK 2026', day: 11, month: 9, year: 2026,
              link: 'https://link-manual-book-ldk.com',
              docLink: 'https://link-dokumentasi-ldk.com' },
            { name: 'IOH 2026', day: 24, month: 9, year: 2026,
              link: 'https://link-manual-book-ioh.com',
              docLink: 'https://link-dokumentasi-ioh.com' },
            { name: 'NAKO 2026', day: 20, month: 10, year: 2026,
              link: 'https://link-manual-book-nako.com',
              docLink: 'https://link-dokumentasi-nako.com' }
        ];

        const monthEvents = events.filter(event => event.year === currentYear && event.month === currentMonth);

        if (monthEvents.length === 0) {
            document.getElementById('countdownDisplay').innerHTML = 
            '<strong style="font-size:18px; line-height:1.6; display:block; text-align:center;">TIDAK ADA<br>ACARA<br>PADA BULAN INI</strong>';
            return;
        }

        const buildCountdown = (event) => {
            const targetDate = new Date(currentYear, event.month, event.day);
            const diff = targetDate - now;
            const isToday = now.getDate() === event.day && now.getMonth() === event.month && now.getFullYear() === event.year;

            const linkCaption = event.link
                ? `<div onclick="window.open('${event.link}', '_blank')" style="margin-top:4px; font-size:11px; color:#F8D794; opacity:.7; text-decoration:underline; cursor:pointer; letter-spacing:0.5px;">klik untuk lihat manual book</div>`
                : '';

            const docCaption = event.docLink
                ? `<div onclick="window.open('${event.docLink}', '_blank')" style="margin-top:2px; font-size:11px; color:#F8D794; opacity:.7; text-decoration:underline; cursor:pointer; letter-spacing:0.5px;">klik untuk lihat dokumentasi</div>`
                : '';

            if (diff < 0 || isToday) {
                return `<div style="margin-bottom:10px;">
                            <strong style="font-size:18px;">${event.name} sedang berlangsung 🎉</strong>
                            ${linkCaption}
                            ${docCaption}
                        </div>`;
            }

            const days    = Math.floor(diff / (1000 * 60 * 60 * 24));
            const hours   = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));

            return `
                <div style="margin-bottom:10px;">
                    <span style="font-size:16px;">${days} hari | ${hours} jam | ${minutes} menit</span><br>
                    <strong style="font-size:18px;">${event.name}</strong>
                    ${linkCaption}
                    ${docCaption}
                </div>`;
        };

        document.getElementById('countdownDisplay').innerHTML = monthEvents.map(buildCountdown).join('');
    }

    updateCountdown();
    setInterval(updateCountdown, 1000);

    updateCalendar();

    document.getElementById('prevMonthBtn').addEventListener('click', function() {
        currentCalendarDate.setMonth(currentCalendarDate.getMonth() - 1);
        updateCalendar();
        updateCountdown();
    });

    document.getElementById('nextMonthBtn').addEventListener('click', function() {
        currentCalendarDate.setMonth(currentCalendarDate.getMonth() + 1);
        updateCalendar();
        updateCountdown();
    });

    const timelineEvents = [
        new Date(2026,7,19),   // Forum Maba
        new Date(2026,9,11),   // LDK
        new Date(2026,9,24),   // IOH
        new Date(2026,10,20)   // NAKO
    ];

    function updateTimeline(){
        const now = new Date();

        document.querySelectorAll('.step').forEach(step => {
            step.classList.remove('completed','active');
        });

        document.querySelectorAll('.line').forEach(line => {
            line.style.background='#7c6741';
        });

        for(let i = 0; i < timelineEvents.length; i++){
            if(now >= timelineEvents[i]){
                document.getElementById('step-'+i).classList.add('completed');
                if(i < timelineEvents.length-1){
                    document.getElementById('line-'+i).style.background='#F8D794';
                }
            }
        }

        for(let i = 0; i < timelineEvents.length; i++){
            if(now < timelineEvents[i]){
                document.getElementById('step-'+i).classList.remove('completed');
                document.getElementById('step-'+i).classList.add('active');
                break;
            }
        }
    }

    updateTimeline();
    setInterval(updateTimeline, 60000);
</script>
@endsection