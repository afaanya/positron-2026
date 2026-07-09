<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Timeline - POSITRON 2026</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @vite('resources/css/timeline.css')
</head>
<body class="min-h-screen flex flex-col justify-between antialiased text-white">
    <img src="{{ asset('images/page-bg.jpg') }}"
         alt="Background"
         class="fixed inset-0 w-full h-full object-cover -z-10">

    @include('layouts.partials.header')

    <main class="w-full max-w-4xl mx-auto flex flex-col justify-center items-center z-10 px-4 py-6 my-auto">
        
        <div class="text-center mb-6">
            <h1 class="font-primary text-5xl md:text-7xl text-[#F8D794] tracking-wide drop-shadow-md">
            </h1>
        </div>

        <div style="display:flex; align-items:center; gap:40px;">
            <div class="clock-wrapper w-[900px] relative" style="margin-left:-400px;">
                
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

            <div style="text-align:left; color:#F8D794; font-family:'Libre Baskerville', serif;">
                <div id="countdownDisplay" style="font-size:16px; margin:0; line-height:1.8;">
                    <strong>Menghitung...</strong>
                </div>
            </div>
        </div>

        <div class="text-center mt-6 font-secondary text-[11px] md:text-xs text-[#F8D794]/80 tracking-widest bg-black/40 px-4 py-1.5 rounded-full backdrop-blur-sm">
        </div>

    </main>

@include('layouts.partials.footer')
@vite('resources/js/timeline.js')
</body>
</html>