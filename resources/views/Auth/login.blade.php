<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
    <title>POSITRON 2026 — Login</title>
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/login.css'])
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

        // Blokir Ctrl + scroll mouse
        document.addEventListener('wheel', function(e) {
            if (e.ctrlKey) {
                e.preventDefault();
            }
        }, { passive: false });

        // Blokir Ctrl + / Ctrl - / Ctrl 0 (keyboard zoom)
        document.addEventListener('keydown', function(e) {
            if (e.ctrlKey && (e.key === '+' || e.key === '-' || e.key === '0' || e.key === '=')) {
                e.preventDefault();
            }
        }, false);
    </script>

</body>
</html>