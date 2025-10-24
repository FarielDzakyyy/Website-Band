document.getElementById("loginForm").addEventListener("submit", function(e) {
  e.preventDefault();

  const email = document.getElementById("email").value.trim();
  const password = document.getElementById("password").value.trim();

  if (email === "" || password === "") {
    alert("Harap isi semua kolom!");
  } else {
    alert(`Selamat datang, ${email}!`);
    // Di sini bisa diarahkan ke halaman lain:
    // window.location.href = "dashboard.html";
  }
});
