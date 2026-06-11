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

        {{-- Password --}}
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-600 mb-1">
                Kata sandi
            </label>
            <input
                type="password"
                name="password"
                placeholder="Masukkan kata sandi"
                class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 {{ $errors->has('password') ? 'ring-2 ring-red-400' : '' }}"
            />
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

</body>
</html>