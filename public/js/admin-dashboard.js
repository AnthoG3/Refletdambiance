document.addEventListener('DOMContentLoaded', function() {
    console.log("JavaScript chargé et prêt.");

    const buttons = document.querySelectorAll('.voir-plus');

    buttons.forEach(function(button) {
        button.addEventListener('click', function(event) {
            event.preventDefault();
            const detailUrl = button.getAttribute('href');
            if (detailUrl) {
                window.location.href = detailUrl;
            } else {
                console.error("URL de détail non trouvée");
            }
        });
    });
});
