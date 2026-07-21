document.addEventListener('DOMContentLoaded', function () {

    /* ==========================================================
       FLIP CARD (desktop / tablet, hover-to-flip) — tidak diubah
       ========================================================== */
    document.querySelectorAll('.flip-card').forEach(function (card) {
        let hovering = false;

        card.addEventListener('mouseenter', function () {
            hovering = true;
            if (!card.classList.contains('locked')) {
                card.classList.add('flipped');
            }
        });

        card.addEventListener('mouseleave', function () {
            hovering = false;
            if (!card.classList.contains('locked')) {
                card.classList.remove('flipped');
            }
        });

        card.addEventListener('click', function () {
            if (card.classList.contains('locked')) {
                card.classList.remove('locked');
                if (!hovering) {
                    card.classList.remove('flipped');
                }
            } else {
                if (card.classList.contains('flipped')) {
                    card.classList.add('locked');
                }
            }
        });
    });

    /* ==========================================================
       KUBUS MOBILE (RUBIK) — rotasi + tap untuk detail
       ========================================================== */
    const cube = document.getElementById('rangkaianCube');
    if (!cube) return; // markup kubus tidak ada di halaman ini, skip

    const faces = Array.from(cube.querySelectorAll('.cube-face'));
    const dots = Array.from(document.querySelectorAll('#cubeDots span'));
    const btnPrev = document.getElementById('cubePrev');
    const btnNext = document.getElementById('cubeNext');

    // rotationStep TIDAK di-modulo — terus bertambah/berkurang supaya
    // arah putaran selalu konsisten (dari sisi 4 -> next tetap lanjut ke 1,
    // tidak pernah "muter balik" ke arah sebaliknya).
    let rotationStep = 0;

    function getCurrentIndex() {
        return ((rotationStep % faces.length) + faces.length) % faces.length;
    }

    function resetFlips() {
        faces.forEach(function (face) {
            face.classList.remove('flipped');
        });
    }

    function updateCube() {
        const angle = rotationStep * -90;
        cube.style.transform = 'rotateY(' + angle + 'deg)';

        const currentIndex = getCurrentIndex();
        dots.forEach(function (dot, i) {
            dot.classList.toggle('active', i === currentIndex);
        });
    }

    function next() {
        rotationStep += 1;
        resetFlips();
        updateCube();
    }

    function prev() {
        rotationStep -= 1;
        resetFlips();
        updateCube();
    }

    // Dipakai saat klik dot: lompat ke index tertentu lewat rute TERPENDEK
    // (tetap tidak pernah "reset" balik ke 0 secara tiba-tiba).
    function goToIndex(targetIndex) {
        const currentIndex = getCurrentIndex();
        let diff = targetIndex - currentIndex;

        if (diff > faces.length / 2) diff -= faces.length;
        if (diff < -faces.length / 2) diff += faces.length;

        rotationStep += diff;
        resetFlips();
        updateCube();
    }

    if (btnNext) {
        btnNext.addEventListener('click', next);
    }

    if (btnPrev) {
        btnPrev.addEventListener('click', prev);
    }

    dots.forEach(function (dot, i) {
        dot.addEventListener('click', function () {
            goToIndex(i);
        });
    });

    // Tap pada wajah yang sedang menghadap depan -> muter (flip 3D) buat lihat detail.
    // PENTING: listener dipasang di cubeScene (bukan di cube-face langsung) karena
    // face-2 & face-4 dirotasi 90°/270° dalam 3D space sehingga browser mobile
    // tidak bisa mendeteksi tap pada elemen yang sudah berubah orientasi.
    
    // Swipe kiri/kanan untuk memutar kubus, tap untuk flip face aktif
    let touchStartX = 0;
    let touchStartY = 0;
    const cubeScene = cube.closest('.cube-scene');

    cubeScene.addEventListener('touchstart', function (e) {
        touchStartX = e.changedTouches[0].screenX;
        touchStartY = e.changedTouches[0].screenY;
    }, { passive: true });

    cubeScene.addEventListener('touchend', function (e) {
        const touchEndX = e.changedTouches[0].screenX;
        const touchEndY = e.changedTouches[0].screenY;
        const diffX = touchEndX - touchStartX;
        const diffY = touchEndY - touchStartY;
        const threshold = 40;

        // Jika gerakannya kecil (tap, bukan swipe) -> flip face aktif
        if (Math.abs(diffX) < threshold && Math.abs(diffY) < threshold) {
            const activeFace = faces[getCurrentIndex()];
            if (activeFace) activeFace.classList.toggle('flipped');
            return;
        }

        // Swipe horizontal -> putar kubus
        if (Math.abs(diffX) >= threshold && Math.abs(diffX) > Math.abs(diffY)) {
            if (diffX < 0) {
                next(); // swipe kiri -> next
            } else {
                prev(); // swipe kanan -> prev
            }
        }
    }, { passive: true });

    updateCube();
});