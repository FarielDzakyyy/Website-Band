// Simple demo interactivity
document.querySelectorAll(".menu li").forEach(item => {
  item.addEventListener("click", () => {
    document.querySelector(".menu li.active")?.classList.remove("active");
    item.classList.add("active");
  });
});

document.querySelector(".logout").addEventListener("click", () => {
  if (confirm("Yakin ingin logout dari admin panel?")) {
    window.location.href = "../beranda/beranda.html";
  }
});


