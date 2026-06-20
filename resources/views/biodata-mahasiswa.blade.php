<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biodata</title>
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
            background: white;
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 10px;
        }

        .title {
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 10px;
        } 
    </style>

</head>
<body class="font-secondary bg-gray-100">
    <div class="container">
        <h2 class="font-primary text-3xl mb-4">
            Biodata
        </h2>
        <div class="card">
            <div class="title">Data Diri</div>
            <p><b>Nama:</b> {{ $biodata->nama }}</p>
            <p><b>NIM:</b> {{ $biodata->nim }}</p>
            <p><b>Program Studi:</b> {{ $biodata->program_studi }}</p>
            <p><b>Offering:</b> {{ $biodata->offering }}</p>
            <p><b>Kakak Mentor:</b> {{ $biodata->kakak_mentor }}</p>
            <p>
                <b>Contact:</b>
                <a href="https://wa.me/62{{ ltrim($biodata->contact, '0') }}"
                    target="_blank"
                    style="color:green; text-decoration:underline;">
                    Chat WhatsApp
                </a>
            <p><b>Kelompok:</b> {{ $biodata->kelompok }}</p>
            <p><b>Mentor Kelompok:</b> {{ $biodata->mentor_kelompok }}</p>
        </div>

    </div>
</body>
</html>