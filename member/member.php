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
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dua Serupa - Member</title>
  <link rel="stylesheet" href="member.css">
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
        <li><a href="../member/member.php" class="active">MEMBER</a></li>
       <li><a href="../history/history.php">HISTORY</a></li>
        <li><a href="../music/music.php">MUSIC</a></li>
        <li><a href="../agenda/agenda.php">AGENDA</a></li>
        <li><a href="../gallery/gallery.php">GALLERY</a></li>
        <li><a href="../merch/merch.php">MERCH</a></li>
         <li><a href="../Booking/booking.php">BOOKING</a></li>
      </ul>
    </nav>
  </header>

  <!-- Member Section -->
  <section class="member-header">
    <h1> MEMBER <span></span></h1>
    <!-- <p><span class="orange">Mari</span> Kenali anggota band Kami <span class="blue">sekarang.</span></p> -->
  </section>

    <div class="member-container">
    <div class="member-card">
      <div class="member-visual">
        <img src="../kumpulan foto dan icon/rivo.jpg" alt="Errivo" class="member-photo-img"> <img src="../kumpulan foto dan icon/Gitar.png" alt="Guitar Icon" class="instrument-icon"> </div>
      <h3>Errivo</h3>
      <p>Guitarist</p>
    </div>

    <div class="member-card">
      <div class="member-visual">
        <img src="../kumpulan foto dan icon/faro.jpg" alt="Navarro" class="member-photo-img"> <img src="../kumpulan foto dan icon/Keyboard.png" alt="Keyboard Icon" class="instrument-icon"> </div>
      <h3>Navarro</h3>
      <p>Keyboardist</p>
    </div>

    <div class="member-card">
      <div class="member-visual">
        <img src="../kumpulan foto dan icon/malpa.jpg" alt="Malfa" class="member-photo-img"> <img src="../kumpulan foto dan icon/Mic.png" alt="Microphone Icon" class="instrument-icon"> </div>
      <h3>Malfa</h3>
      <p>Vocalist</p>
    </div>

    <div class="member-card">
      <div class="member-visual">
        <img src="../kumpulan foto dan icon/rara.jpg" alt="Febrian" class="member-photo-img"> <img src="../kumpulan foto dan icon/drum.png" alt="Drum Icon" class="instrument-icon"> </div>
      <h3>Rara</h3>
      <p>Drummer</p>
    </div>

    <div class="member-card">
      <div class="member-visual">
        <img src="../kumpulan foto dan icon/lala.jpg" alt="Jeremy" class="member-photo-img"> <img src="../kumpulan foto dan icon/Gitar.png" alt="Bass Icon" class="instrument-icon"> </div>
      <h3>Lala</h3>
      <p>Bassist</p>
    </div>
  </div>
  </section>

  <!-- Footer -->
<footer>
  <div class="footer-container">
    <!-- Kiri -->
    <div class="footer-left">
      <img src="../kumpulan foto dan icon/logo ds.png" alt="Logo" class="logo" />
      <p>Musik bukan sekadar nada,tapi bahasa jiwa yang sejati adanya.</p>
      <hr />
      <small>Jl. Garuda No.171A Manukan Condongcatur Depok Sleman Yogyakarta 55283 Indonesia</small>
    </div>

    <!-- Tengah -->
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

    <!-- Kanan -->
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
document.addEventListener("DOMContentLoaded", () => {
  const container = document.querySelector(".member-container");
  const members = JSON.parse(localStorage.getItem("members")) || [];

  // Kalau belum ada member tersimpan, tampilkan pesan default
  if (members.length === 0) {
    container.innerHTML = `
      <p style="text-align:center; color:gray;">Belum ada data member yang ditambahkan.</p>
    `;
    return;
  }

  // Kosongkan kontainer dulu
  container.innerHTML = "";

  // Tampilkan setiap member dari localStorage
  members.forEach(m => {
    container.innerHTML += `
      <div class="member-card">
        <div class="member-visual">
          <img src="${m.photo || '../kumpulan foto dan icon/default.jpg'}" alt="${m.name}" class="member-photo-img">
        </div>
        <h3>${m.name || 'Tanpa Nama'}</h3>
        <p>${m.role || 'Tanpa Posisi'}</p>
      </div>
    `;
  });
});
</script>

</body>
</html>
