<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            margin: 0;
        }
        .container {
            padding: 20px;
        }
        .card {
            background-color: whitesmoke;
            border: 1px solid #ddd;
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 10px;
            transition: box-shadow 0.3s ease;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .card:hover {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .title {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 10px;
        }
    </style>
</head>

<body class="font-secondary bg-gray-100">
    <div class="container">
        <h2 class="font-primary text-3xl">
            Profil
        </h2>

        <a href="/biodata" style="text-decoration:none; color:black;">
            <div class="card">
                <div class="title">Biodata</div>
            </div>
        </a>

        <a href="/poin" style="text-decoration:none; color:black;">
            <div class="card">
                <div class="title">Poin Penilaian</div>
            </div>
        </a>

        <a href="/sertifikat" style="text-decoration:none; color:black;">
            <div class="card">
                <div class="title">Sertifikat</div>
            </div>
        </a>
    </div>

</body>
</html>