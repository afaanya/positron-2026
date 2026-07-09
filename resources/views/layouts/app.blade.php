<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'POSITRON 2026')</title>

    @vite(['resources/css/app.css', 'resources/css/app-layout.css'])

    {{-- KUNCI UTAMA: Tempat untuk menyuntikkan CSS spesifik dari halaman manualbook --}}
    @yield('styles')
</head>
<body>

    @include('layouts.partials.header')

    <main>
        @yield('content')
    </main>

    @include('layouts.partials.footer')

</body>
</html>
