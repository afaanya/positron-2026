<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POSITRON 2026</title>
    @vite(['resources/css/landing.css', 'resources/js/landing.js'])
</head>
<body>
    <div class="landing">
        <!-- Background -->
        <img src="{{ asset('images/login-bg.png') }}" alt="Background" class="layer-bg">

        <!-- Amplop versi desktop (miring, posisi absolute kanan) -->
        <a href="{{ route('login') }}" class="amplop-link amplop-link-desktop" aria-label="Login">
            <img src="{{ asset('images/amplop-landing-miring.png') }}" alt="Amplop" class="layer-amplop layer-amplop-desktop">
        </a>

        <!-- Frame border emas -->
        <img src="{{ asset('images/frame-landing.png') }}" alt="Frame" class="layer-frame">

        <!-- Konten teks kiri -->
        <div class="content">
            <img src="{{ asset('images/invited-landing.png') }}" alt="You're Invited" class="layer-invited">

            <!-- Amplop versi mobile: nyempil di antara invited & garis -->
            <a href="{{ route('login') }}" class="amplop-link amplop-link-mobile" aria-label="Login">
                <img src="{{ asset('images/amplop-landing.png') }}" alt="Amplop" class="layer-amplop layer-amplop-mobile">
            </a>

            <img src="{{ asset('images/garis-landing.png') }}" alt="Divider" class="layer-garis">
            <img src="{{ asset('images/special-landing.png') }}" alt="A special invitation awaits you" class="layer-special">
        </div>
    </div>
</body>
</html>