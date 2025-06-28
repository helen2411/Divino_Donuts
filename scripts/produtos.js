document.addEventListener('DOMContentLoaded', () => {
    // --- LÓGICA DO MENU HAMBÚRGUER (MANTER) ---
    const menuToggle = document.querySelector('.menu-toggle');
    const mainNavigation = document.getElementById('mainNavigation');

    if (menuToggle && mainNavigation) {
        menuToggle.addEventListener('click', () => {
            mainNavigation.classList.toggle('is-open');
            const isExpanded = menuToggle.getAttribute('aria-expanded') === 'true';
            menuToggle.setAttribute('aria-expanded', !isExpanded);
        });

        // Opcional: fechar ao clicar em um link
        mainNavigation.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', () => {
                if (mainNavigation.classList.contains('is-open')) {
                    mainNavigation.classList.remove('is-open');
                    menuToggle.setAttribute('aria-expanded', 'false');
                }
            });
        });

        // Opcional: fechar ao redimensionar a tela
        window.addEventListener('resize', () => {
            if (window.innerWidth > 768 && mainNavigation.classList.contains('is-open')) {
                mainNavigation.classList.remove('is-open');
                menuToggle.setAttribute('aria-expanded', 'false');
            }
        });
    }

    // O restante da lógica (filtros, busca, add to cart) foi removido
    // porque agora é gerenciado pelo PHP através de links e formulários.
});