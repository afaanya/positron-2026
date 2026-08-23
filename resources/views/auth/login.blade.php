<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
    <title>POSITRON 2026 — Login</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.webp') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/login.css'])
</head>
<body>

    {{-- Layer 1: Background --}}
    <div class="bg-layer"></div>

    {{-- Border --}}
    <div class="border-layer"></div>

    {{-- Layer 2: Amplop --}}
    <div class="envelope-layer"></div>

    {{-- Layer 3: Logo POSITRON 2026 --}}
    {{-- Desktop-only: logo dipindahkan ke dalam form-panel di bawah --}}

    {{-- Layer 4: Form login --}}
    <div class="form-panel">

        {{-- Logo POSITRON 2026 (mobile: di dalam form, desktop: fixed kanan atas) --}}
        <div class="logo-layer">
            <img src="/images/logo-positron.webp" alt="POSITRON 2026">
        </div>

        <div class="ornament-line"></div>

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
                <a
                    class="forgot"
                    href="https://wa.me/6282189368169"
                    target="_blank"
                    rel="noopener noreferrer"
                >Lupa kata sandi?</a>
            </div>

            {{-- Tombol --}}
            <button type="submit" class="btn-login">
                <span>LOG IN</span>
                <span class="chevron">›</span>
            </button>

            <a
                class="contact-link"
                href="https://wa.me/6282189368169"
                target="_blank"
                rel="noopener noreferrer"
            >
                <span class="contact-icon" aria-hidden="true">
                    <svg viewBox="0 0 24 24" focusable="false">
                        <path fill="currentColor" d="M12 2a9.9 9.9 0 0 0-8.58 14.85L2 22l5.3-1.39A10 10 0 1 0 12 2Zm0 18a8 8 0 0 1-4.08-1.12l-.3-.18-3.15.83.84-3.07-.2-.32A8 8 0 1 1 12 20Zm4.39-5.98c-.24-.12-1.42-.7-1.64-.78-.22-.08-.38-.12-.55.12-.16.24-.63.78-.77.94-.14.16-.29.18-.53.06-.24-.12-1-.37-1.91-1.18-.7-.62-1.18-1.39-1.32-1.63-.14-.24-.01-.37.1-.49.1-.1.24-.28.36-.42.12-.14.16-.24.24-.4.08-.16.04-.3-.02-.42-.06-.12-.55-1.31-.75-1.8-.2-.47-.4-.41-.55-.42h-.47c-.16 0-.42.06-.64.3-.22.24-.84.82-.84 2s.86 2.32.98 2.48c.12.16 1.69 2.58 4.1 3.62.57.25 1.02.4 1.37.51.58.18 1.1.15 1.51.09.46-.07 1.42-.58 1.62-1.14.2-.56.2-1.04.14-1.14-.06-.1-.22-.16-.46-.28Z"/>
                    </svg>
                </span>
                <span>CP Website</span>
            </a>
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