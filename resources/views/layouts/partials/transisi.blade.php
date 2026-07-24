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
    <!-- Kontainer Logo P + Teks ositron -->
    <div id="transition-brand-container" style="
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 15px;
    ">
        <!-- 1. Logo P (Image) -->
        <img id="transition-logo-p" 
             src="{{ asset('images/P.webp') }}" 
             alt="P" 
             style="
                 height: 110px;
                 width: auto;
                 opacity: 0;
                 transform: scale(0.8);
                 transition: transform 0.5s cubic-bezier(0.25, 1, 0.5, 1), opacity 0.5s ease;
             "
        >

        <!-- 2. Kontainer Teks 'ositron' -->
        <div id="transition-text" style="
            font-family: 'Libre Baskerville', cursive;
            font-size: 4.2rem;
            color: #F1C776;
            display: flex;
            align-items: center;
            gap: 10px;
        ">
            <!-- Huruf o-s-i-t-r-o-n akan di-render di sini -->
        </div>
    </div>
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
</style>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const overlay = document.getElementById('transition-overlay');
        const logoP = document.getElementById('transition-logo-p');
        const textContainer = document.getElementById('transition-text');
        const mainContent = document.querySelector('main');
        const remainingLetters = "OSITRON";
        
        if (mainContent) {
            mainContent.style.transition = 'transform 0.7s cubic-bezier(0.85, 0, 0.15, 1), opacity 0.7s cubic-bezier(0.85, 0, 0.15, 1), filter 0.7s ease';
            mainContent.style.transform = 'scale(1)';
            mainContent.style.opacity = '1';
        }

        // Fungsi animasi brand (Hanya dipanggil setelah halaman baru selesai dimuat)
        function playBrandAnimation() {
            textContainer.innerHTML = ''; // Pastikan bersih
            
            // A. Munculkan logo P (Pop-up)
            setTimeout(() => {
                logoP.style.opacity = '1';
                logoP.style.transform = 'scale(1)';
            }, 100);

            // B. Ketik tulisan 'ositron' satu per satu
            remainingLetters.split('').forEach((char, index) => {
                const span = document.createElement('span');
                span.textContent = char;
                span.classList.add('transition-letter');
                span.style.animationDelay = `${200 + (index * 80)}ms`;
                textContainer.appendChild(span);
            });
        }

        // =========================================================
        // 1. ANIMASI MASUK (Halaman Baru Terbuka)
        // =========================================================
        // Mainkan animasi logo dan teks setelah mendarat di rute baru
        playBrandAnimation();

        // Setelah animasi teks selesai diketik (sekitar 1.3 detik), buka tirai hijau
        setTimeout(() => {
            overlay.style.transform = 'scale(1.2)';
            overlay.style.opacity = '0';
            overlay.style.pointerEvents = 'none';
        }, 1300);


        // =========================================================
        // 2. ANIMASI KELUAR (Saat Meninggalkan Halaman Lama)
        // =========================================================
        const links = document.querySelectorAll('a');
        links.forEach(link => {
            if (link.hostname === window.location.hostname && link.target !== '_blank') {
                link.addEventListener('click', (e) => {
                    const href = link.getAttribute('href');
                    if (!href || href.startsWith('#') || href.startsWith('javascript:')) return;

                    e.preventDefault();
                    const targetUrl = link.href;

                    // Siapkan overlay polos (Tanpa Logo P dan Tanpa Teks) di belakang layar
                    overlay.style.transition = 'none';
                    overlay.style.transform = 'scale(0.8)';
                    overlay.style.opacity = '0';
                    overlay.style.pointerEvents = 'all';
                    
                    // Kita sembunyikan logo P dan kosongkan teks agar layar benar-benar hijau polos saat menutup
                    logoP.style.opacity = '0';
                    logoP.style.transform = 'scale(0.8)';
                    textContainer.innerHTML = '';

                    // Mulai animasi penutupan hijau polos
                    setTimeout(() => {
                        overlay.style.transition = 'transform 0.7s cubic-bezier(0.85, 0, 0.15, 1), opacity 0.7s cubic-bezier(0.85, 0, 0.15, 1)';
                        
                        // Buat halaman lama mengecil ke belakang
                        if (mainContent) {
                            mainContent.classList.add('page-exit-zoom');
                        }

                        // Tarik tirai hijau polos menutup layar penuh
                        overlay.style.transform = 'scale(1)';
                        overlay.style.opacity = '1';
                    }, 50);

                    // Pindah rute Laravel setelah layar tertutup hijau polos (700ms)
                    setTimeout(() => {
                        window.location.href = targetUrl;
                    }, 700); 
                });
            }
        });
    });
</script>