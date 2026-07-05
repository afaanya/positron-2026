<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Filosofi - POSITRON 2026</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Libre+Baskerville:wght@400;700&family=Praise&display=swap');

        :root {
            --font-primary: 'Praise', cursive;
            --font-secondary: 'Libre Baskerville', serif;
            --color-accent: #F8D794;
        }

        .font-primary { font-family: var(--font-primary); }
        .font-secondary { font-family: var(--font-secondary); }

        .filosofi-atas-item,
        .filosofi-bawah-item {
            cursor: pointer;
            display: inline-block;
        }

        .overlay-text {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            padding: 10px 14px;
            background: transparent;
            border: 1px solid rgba(255, 215, 0, 0.6);
            border-radius: 8px;
            color: #f8d794;
            font-family: var(--font-secondary);
            font-size: 0.9rem;
            text-align: center;
            max-width: 300px;
            width: auto;
            white-space: normal;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.2s ease, transform 0.2s ease;
        }

        .overlay-bawah {
            top: calc(100% - 17px);
        }

        .overlay-atas {
            bottom: calc(100% + 10px);
            left: auto;
            right: 100px;
            transform: none;
        }

        .overlay-text.visible {
            opacity: 1;
            pointer-events: auto;
        }

        .filosofi-atas-item .petir-glow,
        .filosofi-bawah-item .petir-glow {
            filter: drop-shadow(0 0 8px rgba(255, 215, 0, 0.4));
            transition: filter 0.3s ease, transform 0.3s ease;
        }

        .filosofi-atas-item:hover .petir-glow,
        .filosofi-bawah-item:hover .petir-glow {
            filter: drop-shadow(0 0 20px rgba(255, 215, 0, 0.9));
            transform: scale(1.05);
        }

        .filosofi-atas-item.active .petir-glow,
        .filosofi-bawah-item.active .petir-glow {
            filter: drop-shadow(0 0 20px rgba(255, 215, 0, 0.9)) !important;
            transform: scale(1.05) !important;
        }
    </style>
</head>
<body class="min-h-screen antialiased text-white bg-black">

     <div class="relative w-full max-w-[1230px] mx-auto">

        <img src="{{ asset('images/bg card.png') }}" alt="Background" class="w-full h-auto block">

        <img src="{{ asset('images/filosofi.text.png') }}" 
             alt="Filosofi Text"
             class="absolute top-20 left-20 h-auto"
             style="width: 420px; height: auto; max-width: 100%;">

        <div class="filosofi-atas-item absolute" style="top: 230px; left: 50%; transform: translateX(-50%); z-index: 10;">
            <img src="{{ asset('images/filosofi.atas.item.png') }}"
                 alt="Filosofi Atas Item"
                 class="petir-glow"
                 data-black-src="{{ asset('images/filosofi.atas.item.png') }}"
                 data-yellow-src="{{ asset('images/filosofi.atas.kuning.png') }}"
                 style="width: 260px; height: 241px; display: block;">
            <div class="overlay-text overlay-bawah" style="left: -350px; right: auto; transform: none;">The Symphony of the Ton: Menggambarkan bahwa dunia kampus diisi oleh berbagai macam karakter, latar belakang, dan keahlian. Jika dipadukan dengan baik, perbedaan ini akan menciptakan harmoni yang indah (simfoni).</div>
        </div>

        <div class="filosofi-bawah-item absolute" style="top: 265px; left: 415px; width: 700px; z-index: 5;">
            <div class="overlay-text overlay-atas" style="left: auto; right: 100px; transform: none;">Diverse in Origin, United in Vision: Menegaskan bahwa meskipun mahasiswa baru berasal dari "keluarga" yang berbeda-beda, mereka kini berdiri di bawah satu nama almamater dan harus berkolaborasi untuk mencapai visi bersama.
</div>
            <img src="{{ asset('images/filosofi.item.bawah.png') }}"
                 alt="Filosofi Bawah Item"
                 class="petir-glow"
                 data-black-src="{{ asset('images/filosofi.item.bawah.png') }}"
                 data-yellow-src="{{ asset('images/filosofi.bawah.kuning.png') }}"
                 style="width: 260px; height: auto; display: block;">
        </div>

    </div>

    <main class="w-full max-w-4xl mx-auto flex flex-col items-center z-10 px-4 py-6">
        {{-- konten filosofi nanti masuk sini --}}
    </main>

    <script>
        document.querySelectorAll('.filosofi-atas-item, .filosofi-bawah-item').forEach(function(item) {
            var img = item.querySelector('img.petir-glow');
            var overlay = item.querySelector('.overlay-text');
            var blackSrc = img.getAttribute('data-black-src');
            var yellowSrc = img.getAttribute('data-yellow-src');

            function showOverlay() {
                if (overlay) {
                    overlay.classList.add('visible');
                }
            }

            function hideOverlay() {
                if (overlay && !item.classList.contains('active')) {
                    overlay.classList.remove('visible');
                }
            }

            item.addEventListener('mouseenter', function() {
                if (!item.classList.contains('active')) {
                    img.src = yellowSrc;
                }
                showOverlay();
            });

            item.addEventListener('mouseleave', function() {
                if (!item.classList.contains('active')) {
                    img.src = blackSrc;
                }
                hideOverlay();
            });

            item.addEventListener('click', function() {
                item.classList.toggle('active');
                img.src = item.classList.contains('active') ? yellowSrc : blackSrc;
                if (item.classList.contains('active')) {
                    showOverlay();
                } else {
                    hideOverlay();
                }
            });
        });
    </script>
</body>
</html>