{{-- ========== DESKTOP VIEW ========== --}}
<section class="sambutan-desktop relative w-screen h-screen flex items-center justify-center overflow-hidden">
    <div class="relative w-full h-full">
        {{-- Background Image (Sambutan) --}}
        <img src="{{ asset('images/sambutan.webp') }}" class="w-full h-full object-cover">

        {{-- Video YouTube Overlay di Papan Tulis --}}
        <div class="absolute" style="top: 56%; left: 59%; width: 35%; aspect-ratio: 16/9; transform: translate(-50%, -50%); overflow: hidden; border-radius: 0.375rem;">
            <iframe
                id="videoSambutan"
                style="position: absolute; top: -60px; left: -20px; width: calc(100% + 40px); height: calc(100% + 120px); pointer-events: none;"
                class="rounded shadow-2xl"
                src="https://www.youtube.com/embed/Aidp0F_1a4s?si=NT_tlJ4WrwgsrUUE&autoplay=1&mute=1&loop=1&playlist=Aidp0F_1a4s&controls=0&rel=0&enablejsapi=1&playsinline=1"
                title="Sambutan"
                frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                allowfullscreen>
            </iframe>
            <button id="btnMuteSambutan" style="position: absolute; bottom: 10px; right: 10px; z-index: 999; background: rgba(0,0,0,0.7); border: none; border-radius: 50%; width: 40px; height: 40px; cursor: pointer; font-size: 18px;">
                🔇
            </button>
        </div>
    </div>
</section>

{{-- ========== MOBILE VIEW ========== --}}
<section class="smb-section">
    {{-- Background --}}
    <div class="smb-bg">
        <img src="{{ asset('images/login-bg.webp') }}" alt="">
    </div>

    <div class="smb-outer">
        {{-- Judul di atas kertas --}}
        <div class="smb-title-wrap">
            <img src="{{ asset('images/sambutan/textsambutan.webp') }}" alt="Sambutan" class="smb-title-img">
        </div>

        {{-- KERTAS BESAR - semua konten di dalam --}}
        <div class="smb-kertas-wrap">
            <img src="{{ asset('images/sambutan/kertas-sambutan.webp') }}" alt="" class="smb-kertas-bg">

            <div class="smb-kertas-inner">
                {{-- Ornamen atas --}}
                <img src="{{ asset('images/sambutan/elemen1.webp') }}" alt="" class="smb-orn smb-orn-top">
                <img src="{{ asset('images/sambutan/elemen2.webp') }}" alt="" class="smb-divider">

                {{-- Heading --}}
                <h2 class="smb-heading">SELAMAT DATANG<br>MAHASISWA BARU</h2>

                {{-- Teks pengantar --}}
                <p class="smb-para">
                    Selamat datang di keluarga besar Departemen Teknik<br>
                    Elektro dan Informatika.
                </p>
                <p class="smb-para" style="margin-top: 6px;">
                    Simak pesan dan sambutan berikut sebagai awal dari<br>
                    perjalanan hebat kalian bersama POSITRON 2026
                </p>

                {{-- Frame + Video --}}
                <div class="smb-frame-wrap">
                    {{-- Frame dekoratif sebagai background --}}
                    <img src="{{ asset('images/sambutan/frame.webp') }}" alt="" class="smb-frame-img">
                    {{-- Video overlay di atas frame --}}
                    <div class="smb-video-box">
                        <iframe
                            id="videoSambutanMobile"
                            src="https://www.youtube.com/embed/Aidp0F_1a4s?si=NT_tlJ4WrwgsrUUE&autoplay=1&mute=1&loop=1&playlist=Aidp0F_1a4s&controls=0&rel=0&enablejsapi=1&playsinline=1"
                            title="Sambutan"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            allowfullscreen>
                        </iframe>
                        <button id="btnMuteSambutanMobile" class="smb-mute-btn">🔇</button>
                    </div>
                </div>

                {{-- Quote --}}
                <p class="smb-quote">
                    " Perjalanan besar selalu dimulai dari langkah pertama.<br>
                    Mari bersama menciptakan cerita terbaik di POSITRON 2026 "
                </p>

                {{-- Tanda tangan --}}
                <div class="smb-signature">
                    <img src="{{ asset('images/sambutan/elemen3.webp') }}" alt="" class="smb-feather">
                    <div class="smb-sig-text">
                        <span>KOORDINATOR</span>
                        <span>POSITRON 2026</span>
                    </div>
                </div>

                {{-- Ornamen bawah --}}
                <img src="{{ asset('images/sambutan/elemen2.webp') }}" alt="" class="smb-divider" style="margin-top:10px;">
                <img src="{{ asset('images/sambutan/elemen1.webp') }}" alt="" class="smb-orn smb-orn-bot">
            </div>
        </div>
    </div>
</section>

<style>
/* ===== Show/hide per device ===== */
.sambutan-desktop { display: flex; }
.smb-section      { display: none; }

@media (max-width: 767px) {
    .sambutan-desktop { display: none !important; }
    .smb-section      { display: block; }

    /* Wrapper section */
    .smb-section {
        position: relative;
        width: 100%;
        min-height: 100svh;
        overflow: hidden;
        background: #0a0f1e;
    }

    /* Background batik */
    .smb-bg {
        position: absolute;
        inset: 0;
        z-index: 0;
    }
    .smb-bg img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* Outer scroll container */
    .smb-outer {
        position: relative;
        z-index: 1;
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 28px 18px 48px;
        gap: 16px;
    }

    /* ---- Judul "SAMBUTAN" ---- */
    .smb-title-wrap {
        width: 85%;
        max-width: 300px;
    }
    .smb-title-img {
        width: 100%;
        height: auto;
        filter: drop-shadow(0 2px 10px rgba(0,0,0,0.6));
    }

    /* ---- Kertas besar ---- */
    .smb-kertas-wrap {
        position: relative;
        width: 92%;
        max-width: 360px;
    }
    .smb-kertas-bg {
        width: 100%;
        height: auto;
        display: block;
    }

    /* Inner konten di atas kertas */
    .smb-kertas-inner {
        position: absolute;
        inset: 0;
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 8% 10% 10%;
        gap: 0;
        overflow: hidden;
    }

    /* Ornamen */
    .smb-orn {
        width: 22px;
        height: auto;
    }
    .smb-orn-top { margin-bottom: 3px; }
    .smb-orn-bot { margin-top: 3px; }

    .smb-divider {
        width: 78%;
        height: auto;
        opacity: 0.8;
        margin: 4px 0;
    }

    /* Heading */
    .smb-heading {
        font-family: 'Georgia', serif;
        font-size: 11px;
        font-weight: 700;
        color: #3b1f06;
        text-align: center;
        letter-spacing: 0.04em;
        margin: 6px 0 6px;
        line-height: 1.4;
    }

    /* Paragraf */
    .smb-para {
        font-family: 'Georgia', serif;
        font-size: 8.5px;
        color: #4a2e0a;
        text-align: center;
        line-height: 1.5;
        margin: 0;
    }

    /* ---- Frame + Video ---- */
    .smb-frame-wrap {
        position: relative;
        width: 90%;
        margin: 10px 0 8px;
    }
    /* Frame gambar sebagai background (block normal, menentukan tinggi wrapper) */
    .smb-frame-img {
        width: 100%;
        height: auto;
        display: block;
        position: relative;
        z-index: 1;
        pointer-events: none;
    }
    /* Video overlay di ATAS frame */
    .smb-video-box { 
        position: absolute;
        top: 47%;
        left: 49%;
        transform: translate(-50%, -50%);
        width: 84%;
        aspect-ratio: 16 / 9;
        z-index: 5;
        overflow: hidden;
        border-radius: 4px;
        background: #000;
        box-shadow: 0 4px 20px rgba(0,0,0,0.6);
    }
    .smb-video-box iframe {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        border: none;
        display: block;
    }
    .smb-mute-btn {
        position: absolute;
        bottom: 6px;
        right: 6px;
        z-index: 10;
        background: rgba(0,0,0,0.65);
        border: none;
        border-radius: 50%;
        width: 28px;
        height: 28px;
        cursor: pointer;
        font-size: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Quote */
    .smb-quote {
        font-family: 'Georgia', serif;
        font-style: italic;
        font-size: 7.5px;
        color: #4a2e0a;
        text-align: center;
        line-height: 1.6;
        margin: 0 0 6px;
    }

    /* Tanda tangan */
    .smb-signature {
        display: flex;
        align-items: center;
        gap: 6px;
    }
    .smb-feather {
        width: 16px;
        height: auto;
        opacity: 0.85;
    }
    .smb-sig-text {
        display: flex;
        flex-direction: column;
        font-family: 'Georgia', serif;
        font-size: 7.5px;
        color: #3b1f06;
        font-weight: 600;
        letter-spacing: 0.05em;
    }
}
</style>

<script>
let playerSambutan;
let playerSambutanMobile;

if (!window.YT) {
    let tag = document.createElement('script');
    tag.src = "https://www.youtube.com/iframe_api";
    document.body.appendChild(tag);
}

function onYouTubeIframeAPIReady() {
    if (document.getElementById('videoSambutan')) {
        playerSambutan = new YT.Player('videoSambutan', {
            events: { 'onReady': function(e) { console.log('Desktop player ready'); } }
        });
    }
    if (document.getElementById('videoSambutanMobile')) {
        playerSambutanMobile = new YT.Player('videoSambutanMobile', {
            events: { 'onReady': function(e) { console.log('Mobile player ready'); } }
        });
    }
}

const btnDesktop = document.getElementById('btnMuteSambutan');
if (btnDesktop) {
    btnDesktop.addEventListener('click', function() {
        if (!playerSambutan || typeof playerSambutan.isMuted !== 'function') return;
        if (playerSambutan.isMuted()) {
            playerSambutan.unMute(); playerSambutan.setVolume(100);
            this.innerText = '🔊';
        } else {
            playerSambutan.mute();
            this.innerText = '🔇';
        }
    });
}

const btnMobile = document.getElementById('btnMuteSambutanMobile');
if (btnMobile) {
    btnMobile.addEventListener('click', function() {
        if (!playerSambutanMobile || typeof playerSambutanMobile.isMuted !== 'function') return;
        if (playerSambutanMobile.isMuted()) {
            playerSambutanMobile.unMute(); playerSambutanMobile.setVolume(100);
            this.innerText = '🔊';
        } else {
            playerSambutanMobile.mute();
            this.innerText = '🔇';
        }
    });
}
</script>