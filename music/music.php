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
  <style>
    /* Modal Styles */
    .modal {
      display: none;
      position: fixed;
      z-index: 1000;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.9);
      animation: fadeIn 0.3s;
    }

    @keyframes fadeIn {
      from { opacity: 0; }
      to { opacity: 1; }
    }

    .modal-content {
      background: linear-gradient(135deg, #1a1a1a 0%, #2d1b1b 100%);
      margin: 2% auto;
      padding: 20px;
      border-radius: 15px;
      width: 90%;
      max-width: 800px;
      max-height: 90vh;
      overflow-y: auto;
      position: relative;
      color: white;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
      border: 1px solid #333;
    }

    .close {
      color: #aaa;
      float: right;
      font-size: 28px;
      font-weight: bold;
      cursor: pointer;
      position: absolute;
      right: 15px;
      top: 10px;
      z-index: 10;
      transition: color 0.3s;
    }

    .close:hover {
      color: white;
    }

    /* Lyrics Container */
    .lyrics-container {
      margin-top: 20px;
    }

    .song-info {
      display: flex;
      align-items: center;
      margin-bottom: 30px;
      padding-bottom: 20px;
      border-bottom: 1px solid #333;
    }

    .song-info img {
      width: 120px;
      height: 120px;
      border-radius: 10px;
      margin-right: 20px;
      object-fit: cover;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
    }

    .song-info-content h2 {
      margin: 0;
      font-size: 1.8rem;
      color: white;
      font-weight: bold;
    }

    .song-info-content p {
      margin: 5px 0 0 0;
      color: #ff6b35;
      font-size: 1rem;
    }

    /* Lyrics Content */
    .lyrics-content {
      max-height: 400px;
      overflow-y: auto;
      margin-bottom: 20px;
      padding: 20px;
      background: rgba(255, 255, 255, 0.05);
      border-radius: 10px;
      scroll-behavior: smooth;
    }

    #lyricsText {
      font-size: 1.2rem;
      line-height: 2;
      text-align: center;
      color: #e0e0e0;
      min-height: 200px;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    .lyrics-line {
      margin: 15px 0;
      transition: all 0.3s ease;
      opacity: 0.6;
      padding: 5px 10px;
      border-radius: 5px;
      min-height: 24px;
    }

    .lyrics-line.active {
      color: #ff6b35;
      font-weight: bold;
      opacity: 1;
      transform: scale(1.05);
      background: rgba(255, 107, 53, 0.1);
    }

    .lyrics-line.passed {
      opacity: 0.8;
      color: #cccccc;
    }

    /* Lyrics Controls */
    .lyrics-controls {
      display: flex;
      justify-content: center;
      margin-top: 20px;
      gap: 10px;
    }

    .lyrics-btn {
      background-color: #333;
      color: white;
      border: none;
      padding: 12px 25px;
      border-radius: 25px;
      cursor: pointer;
      transition: all 0.3s ease;
      font-weight: 500;
    }

    .lyrics-btn.active {
      background: linear-gradient(135deg, #ff6b35, #ff8c5a);
      color: white;
    }

    .lyrics-btn:hover {
      background-color: #555;
      transform: translateY(-2px);
    }

    .lyrics-btn.active:hover {
      background: linear-gradient(135deg, #ff8c5a, #ff6b35);
    }

    /* Sync Controls */
    .sync-controls {
      display: flex;
      justify-content: center;
      align-items: center;
      gap: 15px;
      margin: 15px 0;
      padding: 10px;
      background: rgba(255, 255, 255, 0.05);
      border-radius: 10px;
    }

    .sync-btn {
      background: #333;
      color: white;
      border: none;
      padding: 8px 15px;
      border-radius: 20px;
      cursor: pointer;
      font-size: 0.9rem;
      transition: all 0.3s ease;
    }

    .sync-btn:hover {
      background: #ff6b35;
    }

    .time-adjust {
      display: flex;
      align-items: center;
      gap: 10px;
      color: #ccc;
      font-size: 0.9rem;
    }

    .time-adjust button {
      background: #444;
      color: white;
      border: none;
      width: 30px;
      height: 30px;
      border-radius: 50%;
      cursor: pointer;
      font-weight: bold;
    }

    .time-adjust button:hover {
      background: #ff6b35;
    }

    /* Loading State */
    .lyrics-loading {
      text-align: center;
      color: #ff6b35;
      font-style: italic;
    }

    .lyrics-error {
      text-align: center;
      color: #ff6b35;
      padding: 20px;
    }

    .retry-btn {
      background: #ff6b35;
      color: white;
      border: none;
      padding: 10px 20px;
      border-radius: 20px;
      cursor: pointer;
      margin-top: 10px;
    }

    .retry-btn:hover {
      background: #ff8c5a;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
      .modal-content {
        width: 95%;
        margin: 5% auto;
        padding: 15px;
      }
      
      .song-info {
        flex-direction: column;
        text-align: center;
      }
      
      .song-info img {
        margin-right: 0;
        margin-bottom: 15px;
      }
      
      .lyrics-content {
        max-height: 300px;
        padding: 15px;
      }
      
      #lyricsText {
        font-size: 1.1rem;
      }
      
      .lyrics-controls, .sync-controls {
        flex-direction: column;
        align-items: center;
      }
      
      .lyrics-btn {
        width: 200px;
      }
    }

    /* Scrollbar Styling */
    .lyrics-content::-webkit-scrollbar {
      width: 6px;
    }

    .lyrics-content::-webkit-scrollbar-track {
      background: rgba(255, 255, 255, 0.1);
      border-radius: 3px;
    }

    .lyrics-content::-webkit-scrollbar-thumb {
      background: #ff6b35;
      border-radius: 3px;
    }

    .lyrics-content::-webkit-scrollbar-thumb:hover {
      background: #ff8c5a;
    }
  </style>
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
    <p><span class="orange">Dengarkan lagu-lagu terbaru</span> <span class="pink">dari Dua Serupa</span></p>
  </section>

  <!-- Music Section -->
  <section class="music-section">
    <div class="music-card">
      <img src="../kumpulan foto dan icon/Foto band.jpg" alt="Dreamer Cover" class="album-cover">
      <div class="music-info">
        <h2>Dreamer</h2>
        <audio id="audio1" src="../kumpulan musik/Dreamer.m4a"></audio>
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
      <img src="../kumpulan foto dan icon/Foto band.jpg" alt="Kita Kan Bertemu Lagi Cover" class="album-cover">
      <div class="music-info">
        <h2>Kita Kan Bertemu Lagi</h2>
        <audio id="audio2" src="../kumpulan musik/Kita Kan Bertemu Lagi.mp3"></audio>
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
      <img src="../kumpulan foto dan icon/Foto band.jpg" alt="Sakit Lagi Cover" class="album-cover">
      <div class="music-info">
        <h2>Sakit Lagi</h2>
        <audio id="audio3" src="../kumpulan musik/Sakit Lagi.mp3"></audio>
        <div class="player-controls">
          <button class="play-btn" data-audio="audio3">▶</button>
          <div class="progress-bar">
            <div class="progress"></div>
          </div>
          <span class="time">0:00</span>
        </div>
      </div>
    </div>

    <div class="music-card">
      <img src="../kumpulan foto dan icon/Foto band.jpg" alt="Sebuah Kata Cover" class="album-cover">
      <div class="music-info">
        <h2>Sebuah Kata</h2>
        <audio id="audio4" src="../kumpulan musik/Sebuah Kata.mp3"></audio>
        <div class="player-controls">
          <button class="play-btn" data-audio="audio4">▶</button>
          <div class="progress-bar">
            <div class="progress"></div>
          </div>
          <span class="time">0:00</span>
        </div>
      </div>
    </div>
  </section>

  <!-- Lyrics Modal -->
  <div id="lyricsModal" class="modal">
    <div class="modal-content">
      <span class="close">&times;</span>
      <div class="lyrics-container">
        <div class="song-info">
          <img id="modalAlbumCover" src="../kumpulan foto dan icon/Foto band.jpg" alt="Album Cover">
          <div class="song-info-content">
            <h2 id="modalSongTitle">Judul Lagu</h2>
            <p id="modalArtistName">Dua Serupa</p>
          </div>
        </div>
        
        <div class="sync-controls">
          <button id="syncLyricsBtn" class="sync-btn">🔄 Sinkronisasi Lirik</button>
          <div class="time-adjust">
            <span>Penyesuaian Waktu:</span>
            <button id="timeMinus">-</button>
            <span id="timeOffset">0.0s</span>
            <button id="timePlus">+</button>
          </div>
        </div>

        <div class="lyrics-content">
          <div id="lyricsText" class="lyrics-loading">
            Memuat lirik...
          </div>
          <div id="aboutContent" class="about-content" style="display: none;">
            <!-- Konten tentang lagu akan dimuat di sini -->
          </div>
        </div>
        
        <div class="lyrics-controls">
          <button id="showLyricsBtn" class="lyrics-btn active">🎵 Lirik</button>
          <button id="showAboutBtn" class="lyrics-btn">📝 Tentang Lagu</button>
        </div>
      </div>
    </div>
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

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Data lirik untuk setiap lagu dengan timestamp yang lebih akurat
      const lyricsData = {
        audio1: {
          title: "Dreamer",
          lyrics: [
            { time: 0, text: "[Intro musik]" },
            { time: 5, text: "Mimpi yang selalu ada" },
            { time: 10, text: "Dalam setiap langkahku" },
            { time: 15, text: "Tak pernah lelah untuk berharap" },
            { time: 20, text: "Di setiap detik waktu" },
            { time: 28, text: "Dreamer... oh dreamer..." },
            { time: 35, text: "Teruslah bermimpi walau dunia berkata tidak" },
            { time: 42, text: "Dreamer... oh dreamer..." },
            { time: 48, text: "Kau adalah cahaya dalam gelapnya malam" },
            { time: 55, text: "Jangan pernah menyerah" },
            { time: 60, text: "Pada semua mimpi indah" },
            { time: 67, text: "Terus melangkah maju" },
            { time: 72, text: "Hingga kau mencapainya" }
          ],
          about: `
            <h3>Tentang Lagu "Dreamer"</h3>
            <p><strong>Dreamer</strong> adalah lagu tentang semangat dan harapan yang tak pernah padam.</p>
            <p><strong>Inspirasi:</strong> Perjalanan band dalam mengejar passion di dunia musik.</p>
            <p><strong>Genre:</strong> Pop Rock</p>
            <p><strong>Durasi:</strong> 3:45 menit</p>
          `
        },
        audio2: {
          title: "Kita Kan Bertemu Lagi",
          lyrics: [
            { time: 0, text: "[Intro]" },
            { time: 8, text: "Di ujung jalan ini" },
            { time: 15, text: "Kita harus berpisah" },
            { time: 22, text: "Tapi yakinlah di hati" },
            { time: 28, text: "Ini bukan akhir cerita" },
            { time: 35, text: "Kita kan bertemu lagi" },
            { time: 42, text: "Di suatu hari nanti" },
            { time: 48, text: "Dengan senyuman yang sama" },
            { time: 55, text: "Dan cerita yang baru" },
            { time: 62, text: "Kita kan bertemu lagi" },
            { time: 68, text: "Di bawah langit biru" },
            { time: 75, text: "Dengan harapan yang tetap" },
            { time: 82, text: "Dalam dada ini" }
          ],
          about: `
            <h3>Tentang Lagu "Kita Kan Bertemu Lagi"</h3>
            <p>Lagu tentang harapan akan pertemuan kembali setelah perpisahan.</p>
          `
        },
        audio3: {
          title: "Sakit Lagi",
          lyrics: [
            { time: 0, text: "[Intro]" },
            { time: 7, text: "Hatiku sakit lagi" },
            { time: 14, text: "Mengingat semua tentangmu" },
            { time: 21, text: "Kenangan yang terukir" },
            { time: 28, text: "Dalam relung hatiku" },
            { time: 35, text: "Sakit lagi... oh sakit lagi..." },
            { time: 42, text: "Rasa ini tak pernah pergi" },
            { time: 49, text: "Sakit lagi... sakit lagi..." },
            { time: 56, text: "Di setiap malam yang sunyi" },
            { time: 63, text: "Kau selalu datang" },
            { time: 70, text: "Dalam mimpi dan angan" },
            { time: 77, text: "Membuat luka ini" },
            { time: 84, text: "Tak pernah sembuh" }
          ],
          about: `
            <h3>Tentang Lagu "Sakit Lagi"</h3>
            <p>Lagu balada tentang heartbreak dan kenangan yang tak bisa dilupakan.</p>
          `
        },
        audio4: {
          title: "Sebuah Kata",
          lyrics: [
            { time: 0, text: "ada banyak hal yang ingin kusampaikan padamu" },
            { time: 7, text: "namun aku buruk dalam merangkai kata" },
            { time: 12, text: "jika semua akan kusampaikan kepadamu" },
            { time: 18, text: "aku takut kau membenciku" },
            { time: 25, text: "bagaimana cara merubah kesan seseorang" },
            { time: 32, text: "ribuan cara telah tertanam dikepala" },
            { time: 38, text: "namun saat kumulai mencoba tuk sampaikan" },
            { time: 43.5, text: "aku berhenti di tengah kalimat" },
            { time: 51, text: "berapa malam yang kubutuhkan" },
            { time: 57, text: "sampai pada hari aku akan menyatakan" },
            { time: 64, text: "sebuah kata dari lubuk hati terdalam" }
          ],
          about: `
            <h3>Tentang Lagu "Sebuah Kata"</h3>
            <p>Lagu tentang kekuatan kata-kata dalam mengubah hubungan.</p>
          `
        }
      };

      // Variabel global
      let currentAudio = null;
      let currentAudioId = null;
      let lyricsInterval = null;
      let timeOffset = 0; // Penyesuaian waktu untuk sinkronisasi

      // Modal elements
      const modal = document.getElementById('lyricsModal');
      const closeBtn = document.querySelector('.close');
      const modalAlbumCover = document.getElementById('modalAlbumCover');
      const modalSongTitle = document.getElementById('modalSongTitle');
      const lyricsText = document.getElementById('lyricsText');
      const aboutContent = document.getElementById('aboutContent');
      const showLyricsBtn = document.getElementById('showLyricsBtn');
      const showAboutBtn = document.getElementById('showAboutBtn');
      const syncLyricsBtn = document.getElementById('syncLyricsBtn');
      const timeMinusBtn = document.getElementById('timeMinus');
      const timePlusBtn = document.getElementById('timePlus');
      const timeOffsetDisplay = document.getElementById('timeOffset');

      // Fungsi untuk mendapatkan waktu yang disesuaikan
      function getAdjustedTime() {
        if (!currentAudio) return 0;
        return Math.max(0, currentAudio.currentTime + timeOffset);
      }

      // Fungsi untuk memperbarui tampilan offset waktu
      function updateTimeOffsetDisplay() {
        timeOffsetDisplay.textContent = `${timeOffset > 0 ? '+' : ''}${timeOffset.toFixed(1)}s`;
      }

      // Fungsi untuk sinkronisasi manual
      function manualSync() {
        if (!currentAudio) return;
        
        // Tampilkan dialog sinkronisasi
        const currentTime = Math.floor(currentAudio.currentTime);
        const confirmSync = confirm(
          `Sinkronisasi Lirik\n\n` +
          `Waktu saat ini: ${Math.floor(currentTime/60)}:${(currentTime%60).toString().padStart(2, '0')}\n` +
          `Klik OK jika lirik saat ini seharusnya aktif pada waktu ini.\n` +
          `Sistem akan menyesuaikan timing lirik secara otomatis.`
        );
        
        if (confirmSync) {
          // Cari lirik yang seharusnya aktif
          const lyricsLines = document.querySelectorAll('.lyrics-line');
          let activeIndex = -1;
          
          lyricsLines.forEach((line, index) => {
            if (line.classList.contains('active')) {
              activeIndex = index;
            }
          });
          
          if (activeIndex !== -1) {
            const activeLineTime = parseInt(lyricsLines[activeIndex].dataset.time);
            timeOffset = activeLineTime - currentTime;
            updateTimeOffsetDisplay();
            alert(`Sinkronisasi berhasil! Offset: ${timeOffset.toFixed(1)} detik`);
          }
        }
      }

      // Event listeners untuk kontrol sinkronisasi
      syncLyricsBtn.addEventListener('click', manualSync);
      
      timeMinusBtn.addEventListener('click', function() {
        timeOffset -= 0.5;
        updateTimeOffsetDisplay();
      });
      
      timePlusBtn.addEventListener('click', function() {
        timeOffset += 0.5;
        updateTimeOffsetDisplay();
      });

      // Play buttons functionality
      document.querySelectorAll('.play-btn').forEach(button => {
        button.addEventListener('click', function() {
          const audioId = this.getAttribute('data-audio');
          const audio = document.getElementById(audioId);
          const musicCard = this.closest('.music-card');
          const albumCover = musicCard.querySelector('.album-cover').src;
          const songTitle = musicCard.querySelector('h2').textContent;

          // Reset offset ketika lagu diganti
          if (currentAudioId !== audioId) {
            timeOffset = 0;
            updateTimeOffsetDisplay();
          }

          // Jika audio yang sama diklik lagi, pause
          if (currentAudio === audio && !audio.paused) {
            audio.pause();
            this.textContent = '▶';
            clearInterval(lyricsInterval);
            return;
          }

          // Pause semua audio lainnya
          document.querySelectorAll('audio').forEach(a => {
            if (a !== audio) {
              a.pause();
              const otherBtn = a.parentElement.querySelector('.play-btn');
              otherBtn.textContent = '▶';
            }
          });

          // Play/pause audio yang dipilih
          if (audio.paused) {
            audio.play();
            this.textContent = '⏸';
            currentAudio = audio;
            currentAudioId = audioId;
            
            // Tampilkan modal lirik
            showLyricsModal(audioId, albumCover, songTitle);
            
            // Mulai update lirik
            startLyricsUpdate(audioId);
          } else {
            audio.pause();
            this.textContent = '▶';
            clearInterval(lyricsInterval);
          }
        });
      });

      // Progress bar functionality
      document.querySelectorAll('audio').forEach(audio => {
        audio.addEventListener('timeupdate', function() {
          const progress = this.parentElement.querySelector('.progress');
          const timeDisplay = this.parentElement.querySelector('.time');
          
          if (this.duration) {
            const percent = (this.currentTime / this.duration) * 100;
            progress.style.width = percent + '%';
            
            // Format waktu
            const currentMinutes = Math.floor(this.currentTime / 60);
            const currentSeconds = Math.floor(this.currentTime % 60);
            const durationMinutes = Math.floor(this.duration / 60);
            const durationSeconds = Math.floor(this.duration % 60);
            
            timeDisplay.textContent = 
              `${currentMinutes}:${currentSeconds < 10 ? '0' : ''}${currentSeconds} / ${durationMinutes}:${durationSeconds < 10 ? '0' : ''}${durationSeconds}`;
          }
        });
      });

      // Modal functionality
      function showLyricsModal(audioId, albumCover, songTitle) {
        modalAlbumCover.src = albumCover;
        modalSongTitle.textContent = songTitle;
        
        // Tampilkan lirik secara default
        showLyricsContent(audioId);
        
        modal.style.display = 'block';
      }

      closeBtn.addEventListener('click', function() {
        modal.style.display = 'none';
        clearInterval(lyricsInterval);
      });

      window.addEventListener('click', function(event) {
        if (event.target === modal) {
          modal.style.display = 'none';
          clearInterval(lyricsInterval);
        }
      });

      // Lyrics/About toggle
      showLyricsBtn.addEventListener('click', function() {
        if (!this.classList.contains('active')) {
          this.classList.add('active');
          showAboutBtn.classList.remove('active');
          lyricsText.style.display = 'flex';
          aboutContent.style.display = 'none';
          
          if (currentAudioId) {
            startLyricsUpdate(currentAudioId);
          }
        }
      });

      showAboutBtn.addEventListener('click', function() {
        if (!this.classList.contains('active')) {
          this.classList.add('active');
          showLyricsBtn.classList.remove('active');
          lyricsText.style.display = 'none';
          aboutContent.style.display = 'block';
          clearInterval(lyricsInterval);
          
          if (currentAudioId) {
            showAboutContent(currentAudioId);
          }
        }
      });

      // Fungsi untuk menampilkan konten lirik
      function showLyricsContent(audioId) {
        const songData = lyricsData[audioId];
        if (!songData) {
          lyricsText.innerHTML = '<div class="lyrics-error">Lirik tidak tersedia untuk lagu ini.</div>';
          return;
        }
        
        lyricsText.innerHTML = '';
        lyricsText.classList.remove('lyrics-loading');
        
        songData.lyrics.forEach(line => {
          const lineElement = document.createElement('div');
          lineElement.className = 'lyrics-line';
          lineElement.textContent = line.text;
          lineElement.dataset.time = line.time;
          lyricsText.appendChild(lineElement);
        });
      }

      // Fungsi untuk menampilkan konten tentang lagu
      function showAboutContent(audioId) {
        const songData = lyricsData[audioId];
        if (!songData) {
          aboutContent.innerHTML = '<div class="lyrics-error">Informasi tidak tersedia untuk lagu ini.</div>';
          return;
        }
        
        aboutContent.innerHTML = songData.about;
      }

      // Fungsi untuk memperbarui lirik berdasarkan waktu
      function startLyricsUpdate(audioId) {
        clearInterval(lyricsInterval);
        
        lyricsInterval = setInterval(() => {
          if (!currentAudio || currentAudio.paused) return;
          
          const currentTime = getAdjustedTime();
          const lyricsLines = document.querySelectorAll('.lyrics-line');
          
          // Reset semua lirik
          lyricsLines.forEach(line => {
            line.classList.remove('active', 'passed');
          });
          
          // Temukan lirik yang sesuai dengan waktu saat ini
          let activeLine = null;
          let lastPassedLine = null;
          
          for (let i = 0; i < lyricsLines.length; i++) {
            const lineTime = parseInt(lyricsLines[i].dataset.time);
            
            if (currentTime >= lineTime) {
              lastPassedLine = lyricsLines[i];
            }
            
            if (currentTime >= lineTime && 
                (i === lyricsLines.length - 1 || currentTime < parseInt(lyricsLines[i + 1].dataset.time))) {
              activeLine = lyricsLines[i];
              break;
            }
          }
          
          // Tandai lirik yang sudah lewat
          if (lastPassedLine) {
            lastPassedLine.classList.add('passed');
          }
          
          // Aktifkan lirik yang sesuai
          if (activeLine) {
            activeLine.classList.add('active');
            
            // Scroll ke lirik yang aktif
            activeLine.scrollIntoView({
              behavior: 'smooth',
              block: 'center'
            });
          }
        }, 100);
      }

      // Reset ketika audio selesai
      document.querySelectorAll('audio').forEach(audio => {
        audio.addEventListener('ended', function() {
          const playBtn = this.parentElement.querySelector('.play-btn');
          playBtn.textContent = '▶';
          clearInterval(lyricsInterval);
          
          // Reset progress bar
          const progress = this.parentElement.querySelector('.progress');
          progress.style.width = '0%';
          
          // Reset waktu
          const timeDisplay = this.parentElement.querySelector('.time');
          timeDisplay.textContent = '0:00';
        });
      });

      // Click on progress bar to seek
      document.querySelectorAll('.progress-bar').forEach(progressBar => {
        progressBar.addEventListener('click', function(e) {
          const audio = this.parentElement.parentElement.querySelector('audio');
          const rect = this.getBoundingClientRect();
          const percent = (e.clientX - rect.left) / rect.width;
          audio.currentTime = percent * audio.duration;
        });
      });

      // Inisialisasi tampilan offset
      updateTimeOffsetDisplay();
    });
  </script>
</body>
</html>