// Tambahan interaktif sederhana untuk navbar
document.addEventListener("DOMContentLoaded", () => {
  const links = document.querySelectorAll("nav ul li a");

  links.forEach(link => {
    link.addEventListener("click", () => {
      links.forEach(l => l.classList.remove("active"));
      link.classList.add("active");
    });
  });
});

// File untuk interaksi JavaScript di halaman history
document.addEventListener('DOMContentLoaded', function() {
    console.log('History page loaded');
    
    // Tambahkan interaksi tambahan di sini jika diperlukan
});