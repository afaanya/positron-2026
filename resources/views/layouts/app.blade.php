<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'POSITRON 2026')</title>

    @vite(['resources/css/app.css'])

    <style>
        *{ margin: 0; padding: 0; box-sizing: border-box; }
        html, body{ width: 100%; overflow-x: hidden; background: #081a12; font-family: system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', Arial; }

        .container{ max-width: 1200px; margin: 0 auto; padding: 0 18px; }

        main{ position: relative; z-index: 1; }

        @media (max-width: 900px){
            .main-nav{ display:none; }
        }
    </style>

    {{-- KUNCI UTAMA: Tempat untuk menyuntikkan CSS spesifik dari halaman manualbook --}}
    @yield('styles')
</head>
<body>

    <main>
        @yield('content')
    </main>

</body>
</html>
