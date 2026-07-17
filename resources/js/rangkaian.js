document.addEventListener('DOMContentLoaded', function () {
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
                // Klik saat locked -> buka kunci
                card.classList.remove('locked');
                // Kalau kursor sudah tidak di atas kartu, balik ke depan
                // Kalau kursor masih di atas kartu, tetap flipped (ikut state hover)
                if (!hovering) {
                    card.classList.remove('flipped');
                }
            } else {
                // Klik saat belum locked -> kunci kalau memang sedang flipped
                if (card.classList.contains('flipped')) {
                    card.classList.add('locked');
                }
            }
        });
    });
});