<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biodata</title>
    @vite(['resources/css/app.css'])

    <style>
       body {
            margin: 0;
            min-height:100vh;
            background-image: url('{{ asset('images/login-bg.png') }}'); 
            background-size: cover;
            background-position: center;
            font-family:'Times New Roman', serif;
        }

        .wrapper {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px 20px;
        }
        

        .container {
            max-width:700px;
            width:100%;
        }

        .card {
            background: rgba(225,225,225,0.95);
            border: 2px solid #b89a63;
            padding: 20px 25px;
            border-radius: 10px;
            box-shadow: 0 6px 16px rgba(0,0,0,0.25);
        }

        .page-title {
            font-size: 32px;
            font-weight: bold;
            color: #d4af37;
            margin-bottom: 20px;
            text-align: center;
        } 

        .card-title {
            background: rgba(225,225,225,0.95);
            border: 2px solid #b89a63;
            border-radius: 10px;
            padding: 20px 25px;
            box-shadow: 0 6px 16px rgba(0,0,0,0.25);
        }

        .row {
            margin-bottom: 10px;
            font-size: 16px;
        }

        .wa-link {
            color: green;
            text-decoration: underline;
            font-weight: bold;
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