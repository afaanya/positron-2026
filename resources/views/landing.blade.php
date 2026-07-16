<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POSITRON 2026</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html, body {
            width: 100%;
            height: 100%;
            overflow: hidden;
            background: #081A12;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /*
         * Container 16:9 yang memaksimalkan ruang layar tanpa memotong gambar.
         * Lebar  max = 100vw  → tinggi max = 56.25vw  (16:9)
         * Tinggi max = 100vh  → lebar max = 177.78vh (16:9)
         * CSS min() memilih nilai terkecil sehingga gambar selalu muat penuh.
         */
        .landing {
            position: relative;
            width:  min(100vw, 177.78vh);
            height: min(100vh, 56.25vw);
            background: #081A12;
        }

        .landing-image {
            width: 100%;
            height: 100%;
            display: block;
            object-fit: fill; /* gambar mengisi penuh container 16:9 tanpa crop */
        }

        /* Tombol invisible — posisi % relatif terhadap container 16:9 */
        .open-invitation {
            position: absolute;
            left:   8%;
            bottom: 17%;
            width:  25%;
            height: 10%;
            z-index: 10;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="landing">
        <img src="{{ asset('images/landing2.png') }}" alt="Landing Page" class="landing-image">
        <a href="{{ route('login') }}" class="open-invitation" aria-label="Open Invitation"></a>
    </div>
</body>
</html>
