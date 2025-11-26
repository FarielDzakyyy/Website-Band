<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../Register dan login/login.php");
    exit;
}

// Koneksi database
require_once 'db.php';

// Ambil data dari database
$query = "SELECT id, tanggal, judul_acara, lokasi, gambar FROM agenda ORDER BY tanggal ASC";
$result = mysqli_query($conn, $query);
$agendaData = [];
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $agendaData[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dua Serupa - Agenda</title>
  <link rel="stylesheet" href="agenda.css">
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
        <li><a href="../agenda/agenda.php" class="active">AGENDA</a></li>
        <li><a href="../gallery/gallery.php">GALLERY</a></li>
        <li><a href="../merch/merch.php">MERCH</a></li>
        <li><a href="../Booking/booking.php">BOOKING</a></li>
      </ul>
    </nav>
  </header>

  <!-- Agenda Header -->
  <section class="agenda-header">
    <h1>AGENDA <span></span></h1>
  </section>

  <!-- Agenda Section -->
  <section class="agenda-list" id="agendaListContainer">
    <?php if (empty($agendaData)): ?>
      <p style="text-align:center;margin-top:30px;color:#666;">
        Belum ada agenda yang tersedia. Silakan check back later.
      </p>
    <?php else: ?>
      <?php foreach ($agendaData as $agenda): ?>
        <?php
        $date = new DateTime($agenda['tanggal']);
        $day = $date->format('d');
        $month = strtoupper($date->format('M'));
        ?>
        <div class="agenda-card">
          <div class="agenda-date">
            <div class="day"><?php echo $day; ?></div>
            <div class="month"><?php echo $month; ?></div>
          </div>
          <div class="agenda-details">
            <h2><?php echo htmlspecialchars($agenda['judul_acara']); ?></h2>
            <p>Lokasi: <?php echo htmlspecialchars($agenda['lokasi']); ?></p>
          </div>
          <div class="agenda-image">
            <img src="<?php echo $agenda['gambar'] ? $agenda['gambar'] : '../kumpulan foto dan icon/default.jpg'; ?>" 
                 alt="<?php echo htmlspecialchars($agenda['judul_acara']); ?>">
          </div>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
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

</body>
</html>