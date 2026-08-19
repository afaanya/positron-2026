@extends('layouts.app')

@section('title', 'Timeline - POSITRON 2026')

@section('styles')
<meta name="viewport" content="width=device-width, initial-scale=1.0">

@vite(['resources/css/timeline.css'])
@endsection

@section('content')
<div class="min-h-screen flex flex-col justify-between antialiased text-white">
    <img src="{{ asset('images/login-bg.webp') }}" 
         alt="Background" 
         class="fixed inset-0 w-full h-full object-cover -z-10">

    <!-- Bingkai emas tipis -->
    <div class="timeline-gold-frame" aria-hidden="true"></div>

    <main class="w-full max-w-6xl mx-auto flex flex-col justify-center items-center z-10 px-4 py-6 my-auto">
        
        <div class="text-center mb-32 timeline-title-wrap">
            <h1 class="font-secondary text-4xl md:text-6xl text-[#F8D794] tracking-wide drop-shadow-md">
                TIMELINE KEGIATAN
            </h1>
        </div>


        {{-- Responsive container: kolom di mobile, baris di desktop --}}
        <div class="timeline-main-wrap">
        <div class="timeline-row">
            <div class="clock-wrapper relative timeline-clock-wrap">
                
                <img src="{{ asset('images/Timeline-1.webp') }}" alt="Timeline Clock" class="w-full h-auto block opacity-95">

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

            {{-- Peta perjalanan: blok besar full-width di bawah jam & kotak acara --}}
            <div class="map-box">
                    <div class="map-title">Peta Perjalanan Positron</div>
                    <svg viewBox="0 0 1500 320" xmlns="http://www.w3.org/2000/svg">
                        <!-- Kompas hias: mata angin -->
                        <image href="{{ asset('images/mata angin.webp') }}"
                               x="1340" y="200" width="130" height="130"
                               opacity="0.85" />

                        <!-- Jalur perjalanan (zig-zag) -->
                        <path class="map-route"
                              d="M120,220 C280,165 420,100 560,90 C700,70 840,175 980,205 C1120,235 1280,100 1400,90"/>

                        <!-- Titik 1: Forum Maba (bawah) -->
                        <circle class="map-pin-circle" cx="120" cy="220" r="32"/>
                        <text class="map-pin-number" x="120" y="230">1</text>
                        <text class="map-pin-label" x="120" y="286">FORUM MABA</text>

                        <!-- Titik 2: LDK (atas) -->
                        <circle class="map-pin-circle" cx="560" cy="90" r="32"/>
                        <text class="map-pin-number" x="560" y="100">2</text>
                        <text class="map-pin-label" x="560" y="48">LDK</text>

                        <!-- Titik 3: IoH (bawah) -->
                        <circle class="map-pin-circle" cx="980" cy="205" r="32"/>
                        <text class="map-pin-number" x="980" y="215">3</text>
                        <text class="map-pin-label" x="980" y="286">IOH</text>

                        <!-- Titik 4: NAKO (atas) -->
                        <circle class="map-pin-circle" cx="1400" cy="90" r="32"/>
                        <text class="map-pin-number" x="1400" y="100">4</text>
                        <text class="map-pin-label" x="1400" y="48">NAKO</text>
                    </svg>
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
            { day: 28, month: 7, year: 2026 },
            { day: 29, month: 7, year: 2026 },
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
            '<strong class="text-xl md:text-2xl" style="line-height:1.8; display:block; text-align:center;">TIDAK ADA<br>ACARA<br>PADA BULAN INI</strong>';
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
                            <strong style="font-size:18px;">${event.name} sedang berlangsung</strong>
                            ${linkCaption}
                            ${docCaption}
                        </div>`;
            }

            // Gerbang H-7: sebelum 7 hari menuju acara, sembunyikan countdown &
            // link — cukup tampilkan "COMING SOON". Countdown baru dibuka saat
            // sisa waktu <= 7 hari.
            const H7 = 7 * 24 * 60 * 60 * 1000;
            if (diff > H7) {
                return `<div style="margin-bottom:10px;">
                            <strong style="font-size:18px;">${event.name}</strong><br>
                            <span style="display:inline-block; margin-top:8px; font-size:13px; letter-spacing:3px; color:#F8D794; opacity:.8;">✦ COMING SOON ✦</span>
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