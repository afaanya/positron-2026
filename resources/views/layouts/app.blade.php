<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POSITRON 2026</title>
    <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:wght@400;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <nav>
        <a href="/">Home</a> 
        <a href="/timeline">Timeline</a> 
        <a href="/filosofi">Filosofi</a> 
        <a href="/group">Group</a> 
        <a href="/contact">Contact</a>
    </nav>
    @yield('content')
</body>
</html>