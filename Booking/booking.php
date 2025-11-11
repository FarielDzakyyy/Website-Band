<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Booking - Dua Serupa</title>
  <link rel="stylesheet" href="booking.css">
</head>

<body>
  <!-- Navbar -->
  <header>
    <nav class="navbar">
      <div class="logo">
        <img src="../kumpulan foto dan icon/logo ds.png" alt="Dua Serupa Logo" class="logo-img">
      </div>
      <ul class="nav-links">
        <li><a href="../beranda/beranda.html">HOME</a></li>
        <li><a href="../member/member.html">MEMBER</a></li>
        <li><a href="../history/history.html">HISTORY</a></li>
        <li><a href="../music/music.html">MUSIC</a></li>
        <li><a href="../agenda/agenda.html">AGENDA</a></li>
        <li><a href="../gallery/gallery.html">GALLERY</a></li>
        <li><a href="../merch/merch.html">MERCH</a></li>
        <li><a href="../booking/booking.html" class="active">BOOKING</a></li>
      </ul>
    </nav>
  </header>

  <!-- Booking Section -->
  <section class="booking-section">
    <div class="booking-container">
      <h1>Booking Dua Serupa</h1>
      <p>Isi formulir di bawah ini untuk memesan penampilan band Dua Serupa pada acara Anda.</p>

      <form class="booking-form" action="#" method="post">
        <div class="form-group">
          <label for="name">Nama Lengkap</label>
          <input type="text" id="name" name="name" placeholder="Masukkan nama lengkap" required>
        </div>

        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" id="email" name="email" placeholder="Masukkan email aktif" required>
        </div>

        <div class="form-group">
          <label for="phone">Nomor Telepon</label>
          <input type="tel" id="phone" name="phone" placeholder="08xxxxxxxxxx" required>
        </div>

        <div class="form-group">
          <label for="event">Jenis Acara</label>
          <select id="event" name="event" required>
            <option value="">Pilih jenis acara</option>
            <option value="konser">Konser</option>
            <option value="wedding">Wedding</option>
            <option value="kampus">Event Kampus</option>
            <option value="festival">Festival Musik</option>
            <option value="lainnya">Lainnya</option>
          </select>
        </div>

        <div class="form-group">
          <label for="date">Tanggal Acara</label>
          <input type="date" id="date" name="date" required>
        </div>

        <div class="form-group">
          <label for="location">Lokasi Acara</label>
          <input type="text" id="location" name="location" placeholder="Contoh: Gedung Sabuga, Bandung" required>
        </div>

        <div class="form-group">
          <label for="message">Catatan Tambahan</label>
          <textarea id="message" name="message" rows="4" placeholder="Tulis permintaan atau detail tambahan..."></textarea>
        </div>

        <button type="submit" class="btn-submit">Kirim Permintaan</button>
      </form>
    </div>
  </section>

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
          <li><a href="../gallery/gallery.html">Gallery</a></li>
        </ul>
      </div>
    </div>

    <div class="footer-bottom">
      <p>© 2025 Semua Hak Dilindungi</p>
    </div>
  </footer>
</body>
</html>
