<!-- Load Google Font 'Libre Baskerville' -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:wght@400;700&display=swap" rel="stylesheet">

<!-- Elemen Tirai Transisi (Background Hijau) -->
<div id="transition-overlay" style="
    position: fixed;
    top: 0;
    left: 0;
    width: 100vw;
    height: 100vh;
    background-color: #0F2812;
    z-index: 9999;
    display: flex;
    justify-content: center;
    align-items: center;
    pointer-events: all;
    transform: scale(1); /* Tetap menutup layar penuh saat awal load page baru */
    opacity: 1;
    transition: transform 0.7s cubic-bezier(0.85, 0, 0.15, 1), opacity 0.7s cubic-bezier(0.85, 0, 0.15, 1);
">
    <!-- Video animasi pembuka (fullscreen). src dipilih via JS sesuai orientasi:
         HP/portrait pakai video portrait, laptop/landscape pakai video landscape.
         Hanya video yang terpakai yang diunduh (sekali per sesi). -->
    <video id="transition-video"
           data-src-landscape="{{ asset('videos/AnimasiPositron.mp4') }}?v=6"
           data-src-portrait="{{ asset('videos/AnimasiPositronPortrait.mp4') }}?v=1"
           muted playsinline
           style="
               position: absolute;
               top: 0;
               left: 0;
               width: 100%;
               height: 100%;
               object-fit: cover;
               display: block;
           ">
    </video>
</div>

<style>
    /* Animasi muncul untuk setiap huruf pada tulisan 'ositron' */
    @keyframes letter-appear {
        0% {
            opacity: 0;
            transform: translateY(15px) scale(0.85);
            filter: blur(3px);
        }
        100% {
            opacity: 1;
            transform: translateY(0) scale(1);
            filter: blur(0);
        }
    }

    .transition-letter {
        display: inline-block;
        opacity: 0;
        animation: letter-appear 0.4s cubic-bezier(0.25, 1, 0.5, 1) forwards;
    }

    /* Efek keluar untuk konten utama halaman lama */
    .page-exit-zoom {
        transform: scale(0.85) !important;
        opacity: 0 !important;
        filter: blur(8px) !important;
    }

    /* object-fit:cover fullscreen untuk kedua orientasi — video sudah dipilih
       sesuai orientasi (portrait/landscape) via JS, jadi tidak ada crop aneh. */
</style>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const overlay = document.getElementById('transition-overlay');
        const video = document.getElementById('transition-video');
        const mainContent = document.querySelector('main');

        if (mainContent) {
            mainContent.style.transition = 'transform 0.7s cubic-bezier(0.85, 0, 0.15, 1), opacity 0.7s cubic-bezier(0.85, 0, 0.15, 1), filter 0.7s ease';
            mainContent.style.transform = 'scale(1)';
            mainContent.style.opacity = '1';
        }

        // =========================================================
        // FUNGSI RESET — dipanggil setiap kali halaman "muncul",
        // baik fresh load maupun restore dari bfcache (back/forward)
        // =========================================================
        function forceReset() {
            overlay.style.transition = 'none';
            overlay.style.transform = 'scale(1.2)';
            overlay.style.opacity = '0';
            overlay.style.pointerEvents = 'none';
            if (video) video.style.opacity = '1';

            if (mainContent) {
                mainContent.classList.remove('page-exit-zoom');
                mainContent.style.transform = 'scale(1)';
                mainContent.style.opacity = '1';
                mainContent.style.filter = 'none';
            }

            // aktifkan lagi transisinya setelah reset diterapkan,
            // supaya animasi tutup berikutnya tetap mulus
            requestAnimationFrame(() => {
                overlay.style.transition = 'transform 0.7s cubic-bezier(0.85, 0, 0.15, 1), opacity 0.7s cubic-bezier(0.85, 0, 0.15, 1)';
            });
        }

        // =========================================================
        // 1. ANIMASI MASUK — putar video, lalu buka tirai
        // =========================================================
        let revealed = false;
        function reveal() {
            if (revealed) return;
            revealed = true;
            try { sessionStorage.setItem('positronIntroPlayed', '1'); } catch (_) {}
            overlay.style.transform = 'scale(1.2)';
            overlay.style.opacity = '0';
            overlay.style.pointerEvents = 'none';
        }

        let introPlayed = false;
        try { introPlayed = sessionStorage.getItem('positronIntroPlayed') === '1'; } catch (_) {}

        if (video && !introPlayed) {
            const isPortrait = window.matchMedia('(orientation: portrait)').matches;
            video.src = video.getAttribute(isPortrait ? 'data-src-portrait' : 'data-src-landscape');
            video.addEventListener('ended', reveal);
            video.addEventListener('error', () => setTimeout(reveal, 300));
            const p = video.play();
            if (p && typeof p.catch === 'function') {
                p.catch(() => setTimeout(reveal, 500));
            }
            setTimeout(reveal, 15000);
        } else {
            if (video) video.style.display = 'none';
            setTimeout(reveal, 150);
        }

        // =========================================================
        // 2. ANIMASI KELUAR — tutup layar hijau polos lalu pindah
        // =========================================================
        const links = document.querySelectorAll('a');
        links.forEach(link => {
            if (link.hostname === window.location.hostname && link.target !== '_blank') {
                link.addEventListener('click', (e) => {
                    const href = link.getAttribute('href');
                    if (!href || href.startsWith('#') || href.startsWith('javascript:')) return;

                    e.preventDefault();
                    const targetUrl = link.href;

                    if (video) { video.style.opacity = '0'; try { video.pause(); } catch (_) {} }

                    overlay.style.transition = 'none';
                    overlay.style.transform = 'scale(0.8)';
                    overlay.style.opacity = '0';
                    overlay.style.pointerEvents = 'all';

                    setTimeout(() => {
                        overlay.style.transition = 'transform 0.7s cubic-bezier(0.85, 0, 0.15, 1), opacity 0.7s cubic-bezier(0.85, 0, 0.15, 1)';
                        if (mainContent) {
                            mainContent.classList.add('page-exit-zoom');
                        }
                        overlay.style.transform = 'scale(1)';
                        overlay.style.opacity = '1';
                    }, 50);

                    setTimeout(() => {
                        window.location.href = targetUrl;
                    }, 700);
                });
            }
        });
    });

    // =========================================================
    // 3. SAFETY NET — kalau browser restore halaman dari bfcache
    //    (misal lewat history.back()), paksa reset overlay
    // =========================================================
    window.addEventListener('pageshow', (event) => {
        const overlay = document.getElementById('transition-overlay');
        const mainContent = document.querySelector('main');
        if (event.persisted) {
            if (overlay) {
                overlay.style.transition = 'none';
                overlay.style.transform = 'scale(1.2)';
                overlay.style.opacity = '0';
                overlay.style.pointerEvents = 'none';
            }
            if (mainContent) {
                mainContent.classList.remove('page-exit-zoom');
                mainContent.style.transform = 'scale(1)';
                mainContent.style.opacity = '1';
                mainContent.style.filter = 'none';
            }
        }
    });
</script>