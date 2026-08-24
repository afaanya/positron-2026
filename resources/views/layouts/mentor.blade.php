<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>@yield('title', 'POSITRON 2026 – Portal Mentor')</title>

    <link rel="icon" type="image/png" href="{{ asset('images/logo.webp') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:wght@400;700&display=swap" rel="stylesheet">

    @vite(['resources/css/mentor-portal.css', 'resources/js/mentor-portal.js'])
</head>
<body>
    @yield('content')

    @vite('resources/js/app.js')
</body>
</html>
