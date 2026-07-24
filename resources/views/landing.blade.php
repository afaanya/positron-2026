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
        <img src="{{ asset('images/login-bg.webp') }}" alt="Background" class="layer-bg">

        <!-- Amplop versi desktop (miring, posisi absolute kanan) -->
        <img src="{{ asset('images/amplop-landing-miring.webp') }}" alt="Amplop" class="layer-amplop layer-amplop-desktop">

        <!-- Frame border emas -->
        <img src="{{ asset('images/frame-landing.webp') }}" alt="Frame" class="layer-frame">

        <!-- Konten teks kiri -->
        <div class="content">
            <img src="{{ asset('images/invited-landing.webp') }}" alt="You're Invited" class="layer-invited">

            <!-- Amplop versi mobile: nyempil di antara invited & garis, jadi link login khusus mobile -->
            <a href="{{ route('login') }}" class="amplop-link-mobile" aria-label="Login">
                <img src="{{ asset('images/amplop-landing.webp') }}" alt="Amplop" class="layer-amplop layer-amplop-mobile">
            </a>

            <img src="{{ asset('images/garis-landing.webp') }}" alt="Divider" class="layer-garis">
            <img src="{{ asset('images/special-landing.webp') }}" alt="A special invitation awaits you" class="layer-special">

            <a href="{{ route('login') }}" class="open-invitation" id="openInvitation" aria-label="Open Invitation">
                <img src="{{ asset('images/open-landing.webp') }}" alt="Open Invitation">
            </a>
        </div>
    </div>
</body>
</html>