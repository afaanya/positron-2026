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
