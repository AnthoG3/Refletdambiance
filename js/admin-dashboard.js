document.addEventListener('DOMContentLoaded', function() {
    console.log("JavaScript chargé et prêt.");

    const buttons = document.querySelectorAll('.voir-plus');

    buttons.forEach(function(button) {
        button.addEventListener('click', function() {
            const targetId = button.getAttribute('data-target');
            const contentElement = document.getElementById(targetId);

            console.log(`Clic sur le bouton : ${targetId}`);

            if (contentElement.style.display === 'none' || contentElement.style.display === '') {
                contentElement.style.display = 'block';
                button.textContent = 'Voir moins';
            } else {
                contentElement.style.display = 'none';
                button.textContent = 'Voir plus';
            }
        });
    });
});
