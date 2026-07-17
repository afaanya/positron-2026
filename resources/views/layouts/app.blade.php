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

    @include('layouts.partials.transisi')

    @include('layouts.partials.header')

    <main class="@yield('main-class', '')">
        @yield('content')
    </main>

    @include('layouts.partials.footer')

    {{-- JS khusus setiap halaman --}}
    @yield('scripts')
</body>
</html>