document.addEventListener('DOMContentLoaded', () => {
    const root = document.documentElement;
    const themeToggle = document.querySelector('[data-theme-toggle]');
    const themeLabel = document.querySelector('[data-theme-label]');
    const savedTheme = localStorage.getItem('theme');

    const applyTheme = (theme) => {
        if (theme === 'dark') {
            root.dataset.theme = 'dark';
            if (themeLabel) themeLabel.textContent = 'Tema claro';
        } else {
            root.removeAttribute('data-theme');
            if (themeLabel) themeLabel.textContent = 'Tema oscuro';
        }
    };

    applyTheme(savedTheme === 'dark' ? 'dark' : 'light');

    themeToggle?.addEventListener('click', () => {
        const nextTheme = root.dataset.theme === 'dark' ? 'light' : 'dark';
        applyTheme(nextTheme);
        localStorage.setItem('theme', nextTheme);
    });

    const sidebarToggle = document.querySelector('[data-sidebar-toggle]');
    const sidebar = document.querySelector('.sidebar');

    sidebarToggle?.addEventListener('click', () => {
        sidebar?.classList.toggle('is-open');
    });

    document.querySelectorAll('.sidebar .nav-link').forEach((link) => {
        link.addEventListener('click', () => sidebar?.classList.remove('is-open'));
    });

    document.querySelectorAll('[data-password-toggle]').forEach((button) => {
        button.addEventListener('click', () => {
            const input = document.getElementById(button.dataset.passwordToggle);
            if (!input) return;
            input.type = input.type === 'password' ? 'text' : 'password';
            button.setAttribute('aria-label', input.type === 'password' ? 'Mostrar contraseña' : 'Ocultar contraseña');
        });
    });

    document.querySelectorAll('[data-confirm-delete]').forEach((form) => {
        form.addEventListener('submit', (event) => {
            if (!window.confirm('¿Estás seguro de que deseas eliminar esta publicación?')) {
                event.preventDefault();
            }
        });
    });

    document.querySelectorAll('textarea[maxlength]').forEach((textarea) => {
        const counter = textarea.closest('.form-group')?.querySelector('[data-character-count]');
        if (!counter) return;

        const updateCounter = () => {
            counter.textContent = `${textarea.value.length} / ${textarea.maxLength}`;
        };

        textarea.addEventListener('input', updateCounter);
        updateCounter();
    });

    setTimeout(() => {
        document.querySelectorAll('.alert[data-auto-dismiss]').forEach((alert) => {
            alert.classList.add('is-hidden');
        });
    }, 5000);
});
