<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Website Maba</title>
</head>
<body>

@auth
<nav>
    <a href="/home">Home</a>
    <a href="/about">About</a>
    <a href="/filosofi">Filosofi</a>
    <a href="/timeline">Timeline</a>
    <a href="/contact">Contact</a>
    <a href="/profil">Profil</a>

    <form method="POST" action="{{ route('logout') }}" style="display:inline;">
        @csrf
        <button type="submit">Logout</button>
    </form>
</nav>
@endauth

<hr>

@yield('content')

</body>
</html>