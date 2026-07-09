<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* ── Reset & base ── */
        *, *::before, *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            min-height: 100vh;
            width: 100vw;
            overflow-x: hidden;
            margin: 0;
            padding: 0;
            font-family: 'Georgia', serif;
            background: #000000 url('/images/page-bg.jpg') center top / cover fixed no-repeat;
        }

        .bg-layer {
            position: fixed;
            inset: 0;
            background-image: url('/images/home-page.png');
            background-size: cover;
            background-position: center;
            width: 100vw;
            height: 100vh;
            opacity: 0;
            animation: fadeIn 1.2s ease forwards;
            z-index: -1;
        }


        /* ── Animations ── */
        @keyframes fadeIn {
            from { opacity: 0; }
            to   { opacity: 1; }
        }
    </style>
</head>
<body class="min-h-screen">
    @include('layouts.partials.header')
    <div class="bg-layer"></div>

    <div style="min-height:calc(100vh - 58px - 90px);display:flex;align-items:center;justify-content:center;">
        <div class="bg-white rounded-xl shadow p-8 w-full max-w-md text-center">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit">Keluar</button>
            </form>
        </div>
    </div>

    @include('layouts.partials.footer')
</body>
</html>