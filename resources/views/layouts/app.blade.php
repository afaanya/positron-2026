<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'POSITRON 2026')</title>

    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">

    {{-- CSS Global --}}
    @vite([
        'resources/css/app.css',
        'resources/css/app-layout.css'
    ])

    {{-- CSS khusus setiap halaman --}}
    @yield('styles')
</head>
<body>

    @include('layouts.partials.header')

    <main class="@yield('main-class', '')">
        @yield('content')
    </main>

    @include('layouts.partials.footer')

<<<<<<< HEAD
=======
    {{-- JS khusus setiap halaman --}}
    @yield('scripts')

>>>>>>> ef482eca1d7b2b71a76d9b7ff6a6183d6fb123df
</body>
</html>