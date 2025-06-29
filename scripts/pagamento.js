document.addEventListener('DOMContentLoaded', () => {
    // A única lógica que permanece é a do menu hambúrguer.
    const menuToggle = document.querySelector('.menu-toggle');
    const mainNavigation = document.getElementById('mainNavigation');

    if (menuToggle && mainNavigation) {
        menuToggle.addEventListener('click', () => {
            mainNavigation.classList.toggle('is-open');
        });
    }
    // O resto da lógica foi removido pois agora é um formulário padrão.
});