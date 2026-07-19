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
    // Semua sisi kubus bisa di-tap untuk lihat detail (flip 3D)
    faces.forEach(function (face, i) {
        face.addEventListener('click', function () {
            if (i !== getCurrentIndex()) return; // hanya wajah aktif yang bisa di-tap
            face.classList.toggle('flipped');
        });
    });
    
    // Swipe kiri/kanan untuk memutar kubus
    let touchStartX = 0;
    const cubeScene = cube.closest('.cube-scene');

    cubeScene.addEventListener('touchstart', function (e) {
        touchStartX = e.changedTouches[0].screenX;
    }, { passive: true });

    cubeScene.addEventListener('touchend', function (e) {
        const touchEndX = e.changedTouches[0].screenX;
        const diff = touchEndX - touchStartX;
        const threshold = 40;

        if (Math.abs(diff) < threshold) return;

        if (diff < 0) {
            next(); // swipe kiri -> next
        } else {
            prev(); // swipe kanan -> prev
        }
    }, { passive: true });

    updateCube();
});