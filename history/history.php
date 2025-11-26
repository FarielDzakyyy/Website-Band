<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../Register dan login/login.php");
    exit;
}

// Koneksi database
require_once 'db.php';

// Ambil data dari database dengan error handling
$history = null;
try {
    $query = "SELECT image, intro, content FROM history ORDER BY id DESC LIMIT 1";
    $result = mysqli_query($conn, $query);
    if ($result) {
        $history = mysqli_fetch_assoc($result);
    }
} catch (Exception $e) {
    // Jika error, buat tabel otomatis
    createHistoryTable($conn);
}

// Fungsi untuk membuat tabel jika tidak ada
function createHistoryTable($conn) {
    $createTableQuery = "
        CREATE TABLE IF NOT EXISTS history (
            id INT PRIMARY KEY AUTO_INCREMENT,
            image LONGTEXT,
            intro TEXT,
            content TEXT,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )
    ";
    
    if (mysqli_query($conn, $createTableQuery)) {
        // Tabel berhasil dibuat, coba query lagi
        $query = "SELECT image, intro, content FROM history ORDER BY id DESC LIMIT 1";
        $result = mysqli_query($conn, $query);
        if ($result) {
            $GLOBALS['history'] = mysqli_fetch_assoc($result);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dua Serupa - History</title>
  <link rel="stylesheet" href="history.css">
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
        <li><a href="../history/history.php" class="active">HISTORY</a></li>
        <li><a href="../music/music.php">MUSIC</a></li>
        <li><a href="../agenda/agenda.php">AGENDA</a></li>
        <li><a href="../gallery/gallery.php">GALLERY</a></li>
        <li><a href="../merch/merch.php">MERCH</a></li>
        <li><a href="../Booking/booking.php">BOOKING</a></li>
      </ul>
    </nav>
  </header>

  <!-- History Section -->
  <section class="history-header">
    <h1>HISTORY <span></span></h1>
  </section>

  <div class="history-img" id="history-img-container">
    <img id="history-image" 
         src="<?php echo (isset($history['image']) && !empty($history['image'])) ? $history['image'] : '../kumpulan foto dan icon/Foto band.jpg'; ?>" 
         alt="Dua Serupa Band"><br>
    <p id="history-intro">
      <?php 
      if (isset($history['intro']) && !empty($history['intro'])) {
          echo htmlspecialchars($history['intro']);
      } else {
          echo '<span class="orange">Sejarah</span> singkat perjalanan kami dari awal hingga <span class="blue">sekarang.</span>';
      }
      ?>
    </p>
  </div>
    
  <div class="history-text" id="history-text-container">
    <p id="history-content">
      <?php
      if (isset($history['content']) && !empty($history['content'])) {
          echo nl2br(htmlspecialchars($history['content']));
      } else {
          echo "DUA SERUPA lahir pada tanggal 18 Desember 2022 di Semarang. Band ini awalnya dibentuk oleh lima remaja dengan talenta musik sejak SMA. 
          Nama DUA SERUPA terinspirasi dari ciri khas awal band yang menampilkan formasi unik dengan dua pasang anak kembar.";
      }
      ?>
    </p>
    
    <br>
  </div>

  <!-- Footer -->
  <footer>
    <div class="footer-container">
      <!-- Kiri -->
      <div class="footer-left">
        <img src="../kumpulan foto dan icon/logo ds.png" alt="Logo" class="logo" />
        <p>Musik bukan sekadar nada, tapi bahasa jiwa yang sejati adanya.</p>
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

</body>
</html>