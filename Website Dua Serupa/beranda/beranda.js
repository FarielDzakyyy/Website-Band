document.addEventListener('DOMContentLoaded', function() {
    const menuToggle = document.querySelector('.menu-toggle');
    const navbar = document.querySelector('.navbar');

    menuToggle.addEventListener('click', function() {
        // Toggle class 'active' pada navbar untuk menampilkan/menyembunyikan menu
        navbar.classList.toggle('active');
        
        // Mengubah ikon menu (opsional)
        if (navbar.classList.contains('active')) {
            menuToggle.innerHTML = '&times;'; // Ikon 'X' saat terbuka
        } else {
            menuToggle.innerHTML = '&#9776;'; // Ikon hamburger saat tertutup
        }
    });

    // Menutup menu saat link diklik (untuk Single Page Application)
    const navLinks = document.querySelectorAll('.navbar a');
    navLinks.forEach(link => {
        link.addEventListener('click', () => {
            if (navbar.classList.contains('active')) {
                navbar.classList.remove('active');
                menuToggle.innerHTML = '&#9776;';
            }
        });
    });
});