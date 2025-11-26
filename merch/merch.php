<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../Register dan login/login.php");
    exit;
}

require_once 'db.php';
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dua Serupa - Merchandise</title>
  <link rel="stylesheet" href="merch.css" />
  <style>
    .merch-container {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
      gap: 25px;
      padding: 30px 20px;
      max-width: 1200px;
      margin: 0 auto;
    }

    .merch-card {
      background: #2b2b2b;
      border-radius: 12px;
      padding: 18px;
      text-align: center;
      box-shadow: 0 4px 15px rgba(0,0,0,0.3);
      transition: transform 0.3s ease;
      border: 1px solid #444;
    }

    .merch-card:hover {
      transform: translateY(-5px);
    }

    .merch-img {
      width: 100%;
      height: 200px;
      object-fit: cover;
      border-radius: 8px;
      margin-bottom: 15px;
      border: 1px solid #555;
    }

    .merch-card h3 {
      color: #fff;
      margin: 10px 0;
      font-size: 1.2em;
    }

    .merch-card p {
      color: #d6792f;
      font-weight: bold;
      font-size: 1.1em;
      margin: 5px 0;
    }

    @media (max-width: 768px) {
      .merch-container {
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 20px;
        padding: 20px 15px;
      }
    }
  </style>
</head>

<body>

  <!-- Navbar -->
  <header>
    <nav class="navbar">
      <div class="logo">
        <img src="../kumpulan foto dan icon/logo ds.png" alt="Dua Serupa Logo" class="logo-img" />
      </div>
      <ul class="nav-links">
        <li><a href="../beranda/beranda.php">HOME</a></li>
        <li><a href="../member/member.php">MEMBER</a></li>
        <li><a href="../history/history.php">HISTORY</a></li>
        <li><a href="../music/music.php">MUSIC</a></li>
        <li><a href="../agenda/agenda.php">AGENDA</a></li>
        <li><a href="../gallery/gallery.php">GALLERY</a></li>
        <li><a href="../merch/merch.php" class="active">MERCH</a></li>
        <li><a href="../Booking/booking.php">BOOKING</a></li>
      </ul>
    </nav>
  </header>

  <!-- Merch Section -->
  <section class="merch-header">
    <h1>Merchandise</h1>
  </section>

  <div class="merch-container" id="merchContainer">
    <?php
    $sql = "SELECT id, name, price, image FROM merchandise ORDER BY id DESC";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $imageSrc = $row['image'] ?: '../kumpulan foto dan icon/default.jpg';
            $price = number_format($row['price'], 0, ',', '.');
            
            echo "
            <div class='merch-card'>
              <img src='{$imageSrc}' alt='{$row['name']}' class='merch-img'>
              <h3>{$row['name']}</h3>
              <p>Rp {$price}</p>
            </div>";
        }
    } else {
        echo '<p style="color:#ccc;text-align:center;grid-column:1/-1;margin-top:40px;font-size:1.1em;">
                Belum ada merchandise tersedia.
              </p>';
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