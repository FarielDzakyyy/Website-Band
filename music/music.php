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
  <title>Dua Serupa - Music</title>
  <link rel="stylesheet" href="music.css">
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
        <li><a href="../music/music.php" class="active">MUSIC</a></li>
        <li><a href="../agenda/agenda.php">AGENDA</a></li>
        <li><a href="../gallery/gallery.php">GALLERY</a></li>
        <li><a href="../merch/merch.php">MERCH</a></li>
         <li><a href="../Booking/booking.php">BOOKING</a></li>
      </ul>
    </nav>
  </header>

  <!-- Music Header -->
  <section class="music-header">
    <h1>MUSIC <span></span></h1>
    <!-- <p><span class="orange">Dapatkan Informasi</span> <span class="pink">Single & Album kami di sini.</span></p> -->
  </section>

  <!-- Music Section -->
  <section class="music-section">
  <div class="music-card">
    <img src="../kumpulan foto dan icon/Foto band.jpg" alt="Album Cover 1" class="album-cover">
    <div class="music-info">
      <h2>Lagu 1</h2>
      <audio id="audio1" src="../kumpulan musik/lagu1.mp3"></audio>
      <div class="player-controls">
        <button class="play-btn" data-audio="audio1">▶</button>
        <div class="progress-bar">
          <div class="progress"></div>
        </div>
        <span class="time">0:00</span>
      </div>
    </div>
  </div>

  <div class="music-card">
    <img src="../kumpulan foto dan icon/Foto band.jpg" alt="Album Cover 2" class="album-cover">
    <div class="music-info">
      <h2>Lagu 2</h2>
      <audio id="audio2" src="../kumpulan musik/lagu2.mp3"></audio>
      <div class="player-controls">
        <button class="play-btn" data-audio="audio2">▶</button>
        <div class="progress-bar">
          <div class="progress"></div>
        </div>
        <span class="time">0:00</span>
      </div>
    </div>
  </div>

  <div class="music-card">
    <img src="../kumpulan foto dan icon/Foto band.jpg" alt="Album Cover 2" class="album-cover">
    <div class="music-info">
      <h2>Lagu 2</h2>
      <audio id="audio2" src="../kumpulan musik/lagu2.mp3"></audio>
      <div class="player-controls">
        <button class="play-btn" data-audio="audio2">▶</button>
        <div class="progress-bar">
          <div class="progress"></div>
        </div>
        <span class="time">0:00</span>
      </div>
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
        <li><a href="#">History</a></li>
        <li><a href="#">Member</a></li>
        <li><a href="#">Music</a></li>
      </ul>
    </div>

    <div class="footer-right">
      <h4>Fitur</h4>
      <ul>
        <li><a href="#">Member</a></li>
        <li><a href="#">History</a></li>
        <li><a href="#">Agenda</a></li>
        <li><a href="../gallery/gallery.php">Gallery</a></li>
      </ul>
    </div>
  </div>

  <div class="footer-bottom">
    <p>© 2025 Semua Hak Dilindungi</p>
  </div>
</footer>

<script src="music.js" defer></script>

</body>
</html>
