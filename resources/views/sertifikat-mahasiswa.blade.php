<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sertifikat Mahasiswa</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: url('{{ asset('images/page-bg.jpg') }}') center/cover no-repeat;
            color: #f8eed0;
        }

        .overlay {
            min-height: 100vh;
            display: grid;
            place-items: center;
            padding: 24px;
            background: rgba(5, 14, 12, 0.6);
        }

        .card {
            width: min(900px, 100%);
            padding: 40px 32px;
            border-radius: 24px;
            background: rgba(8, 20, 16, 0.82);
            border: 1px solid rgba(240, 201, 99, 0.25);
            box-shadow: 0 20px 45px rgba(0, 0, 0, 0.35);
            text-align: center;
            backdrop-filter: blur(6px);
        }

        .badge {
            display: inline-block;
            margin-bottom: 16px;
            padding: 8px 14px;
            border-radius: 999px;
            background: rgba(240, 201, 99, 0.16);
            color: #f6d061;
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 0.2em;
            text-transform: uppercase;
        }

        .title {
            font-size: clamp(22px, 3.2vw, 36px);
            line-height: 1.4;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            color: #fff3c5;
        }

        .subtext {
            margin-top: 16px;
            font-size: 16px;
            line-height: 1.7;
            color: #e5dcc1;
        }

        @media (max-width: 600px) {
            .card {
                padding: 28px 20px;
            }

            .title {
                font-size: 22px;
            }

            .subtext {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    @include('layouts.partials.header')
    <div class="overlay">
        <div class="card">
            <div class="badge">Positron 2026</div>
            <div class="title">SERTIFIKAT ANDA DAPAT DIUNDUH SETELAH SERANGKAIAN POSITRON SELESAI</div>
            <p class="subtext">Sertifikat akan tersedia setelah seluruh rangkaian kegiatan selesai dan dapat diakses pada halaman ini.</p>
        </div>
    </div>
    @include('layouts.partials.footer')
</body>
</html>
