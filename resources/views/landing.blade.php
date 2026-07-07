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

        .landing {
            position: relative;
            width: 100vw;
            height: 100vh;
            background: #081A12;
        }

        .landing-image {
            width: 100%;
            height: 100%;
            display: block;
            object-fit: cover;
        }

        .open-invitation {
            position: absolute;
            left: 8%;
            bottom: 17%;
            width: 25%;
            height: 10%;
            z-index: 10;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="landing">
        <img src="{{ asset('images/landing.png') }}" alt="Landing Page" class="landing-image">
        <a href="{{ route('login') }}" class="open-invitation" aria-label="Open Invitation"></a>
    </div>
</body>
</html>