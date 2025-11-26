<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../Register dan login/login.php");
    exit;
}

include 'db.php'; // Sesuaikan path dengan struktur folder Anda
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
  </section>

  <div class="member-container">
    <?php
    // Ambil data member dari database
    $result = $conn->query("SELECT * FROM members ORDER BY id DESC");
    
    if ($result->num_rows === 0) {
        echo '<p style="text-align:center; color:gray; width:100%;">Belum ada data member yang ditambahkan.</p>';
    } else {
        while ($row = $result->fetch_assoc()) {
            echo '
            <div class="member-card">
              <div class="member-visual">
                <img src="' . ($row['photo'] ?: '../kumpulan foto dan icon/default.jpg') . '" alt="' . htmlspecialchars($row['name']) . '" class="member-photo-img">
              </div>
              <h3>' . htmlspecialchars($row['name']) . '</h3>
              <p>' . htmlspecialchars($row['role']) . '</p>
            </div>';
        }
    }
    $conn->close();
    ?>
  </div>

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

</body>
</html>