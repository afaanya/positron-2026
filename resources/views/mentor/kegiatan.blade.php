<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PILIH KEGIATAN</title>
    @vite(['resources/css/app.css'])
    
    <style>
        body{
            margin:0;
            min-height:100vh;
            background-image: url('{{ asset('images/login-bg.png') }}'); 
            background-size: cover;
            background-position: center;
            font-family:'Times New Roman', serif;
        }

        .navbar{
            height:70px;
            border-bottom:2px solid #00AEEF;
            display:flex;
            align-items:center;
            justify-content:space-around;
            color:#d4af37;
            background: rgba(0,0,0,04.);
            backdrop-filter: blur(2px);
        }

        .container{
            max-width:1200px;
            width:100%;
            margin:40px auto;
            padding:0 40px;
        }

        .grid-prodi{
            display:grid;
            grid-template-columns:repeat(2, 320px);
            gap:80px 120px;
            justify-items:center;
        }

        .card-prodi{
            width:280px;
            height:170px;
            background:#f4ead6;
            border:3px solid #b89a63;
            border-radius:2px;
            display:flex;
            justify-content:center;
            align-items:center;
            text-align:center;
            text-decoration:none;
            color:#1d1308;
            transition:.3s;
            box-shadow:
                0 0 0 2px #d6c39a inset,
                0 4px 12px rgba(0,0,0,.3);
        }

        .card-prodi:hover{
            transform:scale(1.05);
        }

        .judul{
            font-size:28px;
            font-weight:bold;
            line-height:1;
        }

        .sub{
            font-size:12px;
            margin-top:5px;
        }
    </style>
</head>
<body class="min-h-screen flex flex-col m-0"
style="background-image: url('{{ asset('images/login-bg.png') }}');
background-sezi: cover; background-position: center;
font-family:'Times New Roman', serif;">

        <div class="navbar">
        <span>POSITRON 2026</span>
        <span>HOME</span>
        <span>ABOUT</span>
        <span>FILOSOFI</span>
        <span>TIMELINE</span>
        <span>GROUP</span>
        <span>CONTACT</span>
    </div>

    <div class="container flex-1 flex items-center justify-center">
        <div class="grid-prodi">

            <a href="{{ route('mentor.offering', ['prodi' => 'forum-maba']) }}" class="card-prodi">
                <div>
                    <div class="judul">FORUM<br>MABA</div>
                </div>
            </a>

            <a href="{{ route('mentor.offering', ['prodi' => 'ldk']) }}" class="card-prodi">
                <div>
                    <div class="judul">LDK</div>
                    <div class="sub">Latihan Dasar Kepemimpinan</div>
                </div>
            </a>

            <a href="{{ route('mentor.offering',  ['prodi' => 'ioh']) }}" class="card-prodi">
                <div>
                    <div class="judul">IoH</div>
                    <div class="sub">Introduction of Himpunan</div>
                </div>
            </a>

            <a href="{{ route('mentor.offering',  ['prodi' => 'nako']) }}" class="card-prodi">
                <div>
                    <div class="judul">NAKO 10.0</div>
                </div>
            </a>

        </div>

    </div>

</body>

<footer class="mt-auto">
    <img src="{{ asset('images/footer.png') }}" class="w-full block">
</footer>

</html>