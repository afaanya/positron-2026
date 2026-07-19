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

    let currentIndex = 0; // 0 = cube-face--1, dst

    function closeAllInfo() {
        faces.forEach(function (face) {
            face.classList.remove('show-info');
        });
    }

    function updateCube() {
        const angle = currentIndex * -90;
        cube.style.transform = 'rotateY(' + angle + 'deg)';

        dots.forEach(function (dot, i) {
            dot.classList.toggle('active', i === currentIndex);
        });
    }

    function goTo(index) {
        currentIndex = (index + faces.length) % faces.length;
        closeAllInfo();
        updateCube();
    }

    if (btnNext) {
        btnNext.addEventListener('click', function () {
            goTo(currentIndex + 1);
        });
    }

    if (btnPrev) {
        btnPrev.addEventListener('click', function () {
            goTo(currentIndex - 1);
        });
    }

    dots.forEach(function (dot, i) {
        dot.addEventListener('click', function () {
            goTo(i);
        });
    });

    // Tap pada wajah yang sedang menghadap depan -> tampilkan detail
    faces.forEach(function (face, i) {
        face.addEventListener('click', function () {
            if (i !== currentIndex) return; // hanya wajah aktif yang bisa di-tap
            face.classList.toggle('show-info');
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
            goTo(currentIndex + 1); // swipe kiri -> next
        } else {
            goTo(currentIndex - 1); // swipe kanan -> prev
        }
    }, { passive: true });

    updateCube();
});