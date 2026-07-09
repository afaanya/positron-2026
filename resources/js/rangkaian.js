window.flipCard = function (selectedcard) {
    const allCards = document.querySelectorAll('.flip-card');
    allCards.forEach(card => {
        if (card !== selectedcard) {
            card.classList.remove('flipped');
        }
    });
    selectedcard.classList.toggle('flipped');
};
