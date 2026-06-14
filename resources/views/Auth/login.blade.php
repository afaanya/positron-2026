<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POSITRON 2026 — Login</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* ── Reset & base ── */
        *, *::before, *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html {
            width: 100%;
            height: 100%;
            overflow: hidden;
        }

        body {
            min-height: 100dvh;
            width: 100vw;
            overflow: hidden;
            margin: 0;
            padding: 0;
            font-family: 'Georgia', serif;
            background: #000000 ;
        }

        /* ── Background layer ── */
        .bg-layer {
            position: fixed;
            inset: 0;
            background-image: url('/images/login-page.png');
            background-size: cover;
            background-position: center;
            width: 100vw;
            height: 100dvh;
            opacity: 0;
            animation: fadeIn 1.0s ease forwards;
        }

        /* ── Border ── */
        .border-layer {
            position: fixed;
            inset: 0;
            width: 100vw;
            height: 100dvh;
            background-image: url('/images/border-layer.png');
            background-size: 100% 100%;
            background-repeat: no-repeat;
            background-position: center;
            pointer-events: none;
            opacity: 0;
            animation: fadeIn 1.0s ease 0.5s forwards;
            z-index: 0;
        }

        /* ── Amplop (kanan) ── */
        .envelope-layer {
            position: fixed;
            right: -220px;
            top: 60%;
            width: 150%;
            max-width: 1440px;
            opacity: 0;
            animation: fadeInSlideLeft 1.4s ease 0.4s forwards;
        }
        .envelope-layer img {
            width: 100%;
            height: auto;
            display: block;
        }

        /* ── Logo POSITRON 2026 (kanan atas) ── */
        .logo-layer {
            position: fixed;
            top: 52px;
            right: 55px;
            opacity: 0;
            animation: fadeIn 1s ease 0.8s forwards;
        }
        .logo-layer img {
            height: 34px;
            width: auto;
        }

        /* ── Panel form (kiri) ── */
        .form-panel {
            position: fixed;
            left: 45px;
            top: 0;
            bottom: 90px;
            width: 42%;
            max-width: 520px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 3rem 4rem;
            opacity: 0;
            animation: fadeInSlideRight 1.2s ease 0.6s forwards;
        }

        /* ── Ornamen garis ── */
        .ornament-line {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 5.5rem;
        }
        .ornament-line::before,
        .ornament-line::after {
            content: '';
            flex: 1;
            height: 1px;
            background: linear-gradient(to right, transparent, rgba(180,140,40,0.6), transparent);
        }

        /* ── Input fields ── */
        .field {
            margin-bottom: 16px;
        }
        .field input {
            width: 100%;
            background: rgba(227, 190, 115, 0.4);
            color: #FAEDD5;
            padding: 15px 40px 15px 15px;
            font-size: 24px;
            font-family: 'libre-baskerville', serif;
            letter-spacing: 0.1em;
            transition: border-color 0.2s, background 0.2s;
            -webkit-text-fill-color: #f0d98a;
        }
        .field input:-webkit-autofill,
        .field input:-webkit-autofill:hover,
        .field input:-webkit-autofill:focus,
        .field input:-webkit-autofill:active {
            -webkit-text-fill-color: #f0d98a !important;
            -webkit-box-shadow: 0 0 0px 1000px rgba(101, 76, 30, 0.8) inset !important;
            transition: background-color 5000s ease-in-out 0s;
            caret-color: #f0d98a;
        }
        .field input::placeholder {
            color: #FAEDD5;
        }
        .field input:focus {
            outline: none;
            border-color: #c9a84c;
            background: rgba(101, 76, 30, 0.6);
        }
        .field input::selection {
            background: rgba(180, 140, 40, 0.4); /* warna highlight */
            color: #f0d98a;
        }
        .field.has-error input {
            border-color: rgba(220, 80, 80, 0.7);
        }

        /* ── Password wrapper ── */
        .pw-wrap { position: relative; }
        .pw-toggle {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            color: rgba(180, 140, 40, 0.7);
            padding: 0;
            display: flex;
        }
        .pw-toggle:hover { color: #c9a84c; }
        .pw-toggle svg { width: 16px; height: 16px; }

        /* ── Error message ── */
        .error-msg {
            font-size: 12px;
            color: #f87171;
            margin-top: 6px;
            display: none;
        }
        .field.has-error .error-msg { display: block; }

        /* ── Remember + Forgot ── */
        .row-extra {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 28px;
        }
        .remember {
            display: flex;
            align-items: center;
            gap: 7px;
            font-size: 12px;
            color: rgba(180, 140, 40, 0.75);
            cursor: pointer;
            letter-spacing: 0.04em;
        }
        .remember input { accent-color: #c9a84c; }
        .forgot {
            font-size: 12px;
            color: rgba(180, 140, 40, 0.6);
            text-decoration: none;
            letter-spacing: 0.04em;
        }
        .forgot:hover { color: #c9a84c; }

        /* ── Tombol login ── */
        .btn-login {
            width: 100%;
            padding: 14px 20px;
            background: linear-gradient(180deg, #E1BB70, #99623B);
            border: none;
            color: #FAEDD5;
            font-family: 'libre-baskerville', serif;
            font-size: 20px;
            letter-spacing: 0.25em;
            text-transform: uppercase;
            cursor: pointer;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            transition: filter 0.2s, transform 0.15s;
        }
        .btn-login:hover { filter: brightness(1.1); }
        .btn-login:active { transform: scale(0.98); }
        .btn-login .chevron { font-size: 18px; }

        /* ── Animations ── */
        @keyframes fadeIn {
            from { opacity: 0; }
            to   { opacity: 1; }
        }
        @keyframes fadeInSlideLeft {
            from { opacity: 0; transform: translateY(-50%) translateX(40px); }
            to   { opacity: 1; transform: translateY(-50%) translateX(0); }
        }
        @keyframes fadeInSlideRight {
            from { opacity: 0; transform: translateX(-30px); }
            to   { opacity: 1; transform: translateX(0); }
        }
    </style>
</head>
<body>

    {{-- Layer 1: Background --}}
    <div class="bg-layer"></div>

    {{-- Border --}}
    <div class="border-layer"></div>

    {{-- Layer 2: Amplop --}}
    <div class="envelope-layer">
        <img src="/images/envelope.png" alt="Amplop POSITRON">
    </div>

    {{-- Layer 3: Logo POSITRON 2026 --}}
    <div class="logo-layer">
        <img src="/images/logo-positron.png" alt="POSITRON 2026">
    </div>

    {{-- Layer 4: Form login --}}
    <div class="form-panel">

        <div class="ornament-line">
            <img src="/images/ornament.png" alt="Ornament">
        </div>

        {{-- Error global --}}
        @if ($errors->any())
            <div style="margin-bottom:16px; padding:10px 14px; background:rgba(180,40,40,0.25);
                        border:1px solid rgba(220,80,80,0.4); border-radius:2px;
                        font-size:13px; color:#fca5a5; letter-spacing:0.03em;">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            {{-- ID / NIM / Email --}}
            <div class="field {{ $errors->has('identifier') ? 'has-error' : '' }}">
                <input
                    type="text"
                    name="identifier"
                    value="{{ old('identifier') }}"
                    placeholder="ID :"
                    autofocus
                    autocomplete="username"
                />
                <p class="error-msg">{{ $errors->first('identifier') }}</p>
            </div>

            {{-- Password --}}
            <div class="field {{ $errors->has('password') ? 'has-error' : '' }}">
                <div class="pw-wrap">
                    <input
                        type="password"
                        name="password"
                        id="password"
                        placeholder="Password :"
                        autocomplete="current-password"
                    />
                    <button type="button" class="pw-toggle" onclick="togglePw()" aria-label="Tampilkan kata sandi">
                        <svg id="eye-show" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                        <svg id="eye-hide" style="display:none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a9.97 9.97 0 012.084-3.415M6.53 6.53A9.97 9.97 0 0112 5c4.477 0 8.268 2.943 9.542 7a9.97 9.97 0 01-1.357 2.632M6.53 6.53L3 3m3.53 3.53l11 11M17.47 17.47L21 21"/>
                        </svg>
                    </button>
                </div>
                <p class="error-msg">{{ $errors->first('password') }}</p>
            </div>

            {{-- Remember + Lupa sandi --}}
            <div class="row-extra">
                <label class="remember">
                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }} />
                    Ingat saya
                </label>
                <a href="#" class="forgot">Lupa kata sandi?</a>
            </div>

            {{-- Tombol --}}
            <button type="submit" class="btn-login">
                <span>LOG IN</span>
                <span class="chevron">›</span>
            </button>
        </form>
    </div>

    <script>
        function togglePw() {
            const input   = document.getElementById('password');
            const eyeShow = document.getElementById('eye-show');
            const eyeHide = document.getElementById('eye-hide');
            if (input.type === 'password') {
                input.type = 'text';
                eyeShow.style.display = 'none';
                eyeHide.style.display = 'block';
            } else {
                input.type = 'password';
                eyeShow.style.display = 'block';
                eyeHide.style.display = 'none';
            }
        }
    </script>

</body>
</html>