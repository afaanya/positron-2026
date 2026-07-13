<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POSITRON 2026</title>

    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
</head>
<body>

<div class="landing">

    <!-- Frame -->
    <img
        src="{{ asset('images/frame-landing.png') }}"
        alt=""
        class="frame"
    >

    <!-- Bagian kiri -->
    <div class="left-side">

        <img
            src="{{ asset('images/special-landing.png') }}"
            alt="Special"
            class="special"
        >

        <img
            src="{{ asset('images/invited-landing.png') }}"
            alt="You're Invited"
            class="invited"
        >

        <img
            src="{{ asset('images/garis-landing.png') }}"
            alt=""
            class="garis"
        >

        <img
            src="{{ asset('images/open-landing.png') }}"
            alt="Open Invitation"
            class="open-text"
        >

        <a
            href="{{ route('login') }}"
            class="open-button"
            aria-label="Open Invitation"
        ></a>

    </div>

    <!-- Bagian kanan -->
    <div class="right-side">

        <img
            src="{{ asset('images/amplop-landing.png') }}"
            alt="Amplop"
            class="amplop"
        >

    </div>

</div>

<script src="{{ asset('js/landing.js') }}"></script>

</body>
</html>