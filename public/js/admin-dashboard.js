document.addEventListener('DOMContentLoaded', function() {
    const voirPlusButtons = document.querySelectorAll('.voir-plus');
    voirPlusButtons.forEach(button => {
        button.addEventListener('click', function() {
            const description = this.closest('.card-body').querySelector('.description');
            if (description.style.display === 'none') {
                description.style.display = 'block';
                this.textContent = 'Voir moins';
            } else {
                description.style.display = 'none';
                this.textContent = 'Voir plus';
            }
        });
    });
});
