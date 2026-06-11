<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

<div class="bg-white rounded-xl shadow p-8 w-full max-w-md text-center">
    <h1 class="text-2xl font-semibold text-gray-800 mb-2">
        Selamat datang, {{ Auth::user()->name }}! 👋
    </h1>
    <p class="text-gray-500 text-sm mb-6">Kamu berhasil masuk ke sistem.</p>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit"
            class="bg-red-500 hover:bg-red-600 text-white px-6 py-2 rounded-lg text-sm transition">
            Keluar
        </button>
    </form>
</div>

</body>
</html>