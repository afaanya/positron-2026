document.addEventListener('DOMContentLoaded', function () {
    const openInvitation = document.getElementById('openInvitation');

    if (openInvitation) {
        openInvitation.addEventListener('click', function () {
            console.log('Open Invitation clicked');
        });
    }
});