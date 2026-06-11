<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

<div class="bg-white rounded-xl shadow p-8 w-full max-w-md">
    <h1 class="text-xl font-semibold text-center mb-6">Masuk ke Akun</h1>

    {{-- Pesan error global --}}
    @if ($errors->any())
        <div class="bg-red-50 text-red-700 text-sm p-3 rounded-lg mb-4">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        {{-- Email atau NIM --}}
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-600 mb-1">
                Email atau NIM
            </label>
            <input
                type="text"
                name="identifier"
                value="{{ old('identifier') }}"
                placeholder="Masukkan email atau NIM"
                class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 {{ $errors->has('identifier') ? 'ring-2 ring-red-400' : '' }}"
                autofocus
            />
            @error('identifier')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Input Password --}}
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-600 mb-1">Kata sandi</label>
            <div class="relative">
                <input
                    type="password"
                    name="password"
                    id="password"
                    placeholder="Masukkan kata sandi"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 pr-10 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 {{ $errors->has('password') ? 'ring-2 ring-red-400' : '' }}"
                />
                <button type="button" onclick="togglePassword()"
                    class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                    <svg id="eye-open" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                    <svg id="eye-closed" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 hidden" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a9.97 9.97 0 012.084-3.415M6.53 6.53A9.97 9.97 0 0112 5c4.477 0 8.268 2.943 9.542 7a9.97 9.97 0 01-1.357 2.632M6.53 6.53L3 3m3.53 3.53l11 11M17.47 17.47L21 21" />
                    </svg>
                </button>
            </div>
            @error('password')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Remember Me --}}
        <div class="flex items-center justify-between mb-5">
            <label class="flex items-center gap-2 text-sm text-gray-500 cursor-pointer">
                <input type="checkbox" name="remember" class="accent-blue-600" />
                Ingat saya
            </label>
            <a href="#" class="text-sm text-blue-600 hover:underline">Lupa kata sandi?</a>
        </div>

        <button type="submit"
            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 rounded-lg transition">
            Masuk
        </button>
    </form>
</div>

<script>
    function togglePassword() {
        const input   = document.getElementById('password');
        const eyeOpen = document.getElementById('eye-open');
        const eyeOff  = document.getElementById('eye-closed');

        if (input.type === 'password') {
            input.type = 'text';
            eyeOpen.classList.add('hidden');
            eyeOff.classList.remove('hidden');
        } else {
            input.type = 'password';
            eyeOpen.classList.remove('hidden');
            eyeOff.classList.add('hidden');
        }
    }
</script>

</body>
</html>