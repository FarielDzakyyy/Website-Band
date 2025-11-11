<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../Register dan login/login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dua Serupa - Gallery</title>
  <link rel="stylesheet" href="gallery.css" />
</head>

<body>

  <!-- Navbar -->
  <header>
    <nav class="navbar">
      <div class="logo">
        <img src="../kumpulan foto dan icon/logo ds.png" alt="Dua Serupa Logo" class="logo-img">
      </div>
      <ul class="nav-links">
        <li><a href="../beranda/beranda.php">HOME</a></li>
        <li><a href="../member/member.php">MEMBER</a></li>
        <li><a href="../history/history.php">HISTORY</a></li>
        <li><a href="../music/music.php">MUSIC</a></li>
        <li><a href="../agenda/agenda.php">AGENDA</a></li>
        <li><a href="../gallery/gallery.php" class="active">GALLERY</a></li>
        <li><a href="../merch/merch.php">MERCH</a></li>
        <li><a href="../Booking/booking.php">BOOKING</a></li>
      </ul>
    </nav>
  </header>

  <!-- Gallery Section -->
  <section class="gallery-header">
    <h1>GALLERY</h1>
  </section>

  <!-- Container yang akan diisi otomatis -->
  <div class="gallery-container" id="galleryContainer">
    <p style="text-align:center;width:100%;color:#aaa;">Memuat galeri...</p>
  </div>

  <!-- Footer -->
  <footer>
    <div class="footer-container">
      <div class="footer-left">
        <img src="../kumpulan foto dan icon/logo ds.png" alt="Logo" class="logo" />
        <p>Musik bukan sekadar nada, tapi bahasa jiwa yang sejati adanya.</p>
        <hr />
        <small>Jl. Garuda No.171A Manukan Condongcatur Depok Sleman Yogyakarta 55283 Indonesia</small>
      </div>

      <div class="footer-center">
        <h4>Follow us</h4>
        <div class="social-icons">
          <img src="../kumpulan foto dan icon/tiktok.png" alt="TikTok" />
          <img src="../kumpulan foto dan icon/instagram.png" alt="Instagram" />
          <img src="../kumpulan foto dan icon/youtube.png" alt="YouTube" />
        </div>
        <h4>Call us</h4>
        <p>085778409829</p>
      </div>

      <div class="footer-right">
        <h4>Tentang kami</h4>
        <ul>
          <li><a href="../history/history.php">History</a></li>
          <li><a href="../member/member.php">Member</a></li>
          <li><a href="../music/music.php">Music</a></li>
        </ul>
      </div>

      <div class="footer-right">
        <h4>Fitur</h4>
        <ul>
          <li><a href="../member/member.php">Member</a></li>
          <li><a href="../history/history.php">History</a></li>
          <li><a href="../agenda/agenda.php">Agenda</a></li>
          <li><a href="../gallery/gallery.php">Gallery</a></li>
        </ul>
      </div>
    </div>

    <div class="footer-bottom">
      <p>© 2025 Semua Hak Dilindungi</p>
    </div>
  </footer>

  <script>
    // Ambil data galeri dari localStorage (yang disimpan di dashboard)
    document.addEventListener("DOMContentLoaded", () => {
      const galleryContainer = document.getElementById("galleryContainer");
      const galleryData = JSON.parse(localStorage.getItem("galleryData")) || [];

      if (galleryData.length === 0) {
        galleryContainer.innerHTML = `<p style="text-align:center;width:100%;color:#aaa;">Belum ada foto di galeri. Tambahkan dari dashboard admin.</p>`;
        return;
      }

      galleryContainer.innerHTML = "";
      galleryData.forEach(src => {
        const div = document.createElement("div");
        div.className = "gallery-item";
        div.innerHTML = `<img src="${src}" alt="Foto Galeri">`;
        galleryContainer.appendChild(div);
      });
    });
  </script>

</body>

</html>
