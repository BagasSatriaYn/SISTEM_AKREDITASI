document.addEventListener('DOMContentLoaded', function() {
    // Alert close functionality
    const alertCloseButtons = document.querySelectorAll('.alert-welcome .btn-close');
    alertCloseButtons.forEach(button => {
        button.addEventListener('click', function() {
            const alert = this.closest('.alert-welcome');
            alert.style.display = 'none';
        });
    });

    // Sidebar submenu toggle
    const submenuToggles = document.querySelectorAll('[data-bs-toggle="collapse"]');
    submenuToggles.forEach(toggle => {
        toggle.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('data-bs-target'));
            if (target.classList.contains('show')) {
                target.classList.remove('show');
            } else {
                target.classList.add('show');
            }
        });
    });

    // User profile dropdown
    const profileDropdown = document.querySelector('.user-profile .dropdown-toggle');
    if (profileDropdown) {
        profileDropdown.addEventListener('click', function(e) {
            e.preventDefault();
            const dropdownMenu = this.nextElementSibling;
            if (dropdownMenu.classList.contains('show')) {
                dropdownMenu.classList.remove('show');
            } else {
                dropdownMenu.classList.add('show');
            }
        });
    }
});