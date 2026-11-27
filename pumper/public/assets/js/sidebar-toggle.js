document.addEventListener('DOMContentLoaded', function () {
    const shell = document.querySelector('.app-shell');
    const toggle = document.getElementById('sidebarToggle');

    if (!shell || !toggle) {
        return;
    }

    function setSidebarHidden(hidden) {
        shell.classList.toggle('sidebar-hidden', hidden);
        toggle.setAttribute('aria-expanded', String(!hidden));
        toggle.setAttribute('aria-label', hidden ? 'Show menu' : 'Hide menu');
        localStorage.setItem('pumper-sidebar-hidden', String(hidden));
    }

    setSidebarHidden(localStorage.getItem('pumper-sidebar-hidden') === 'true');

    toggle.addEventListener('click', function () {
        setSidebarHidden(!shell.classList.contains('sidebar-hidden'));
    });
});