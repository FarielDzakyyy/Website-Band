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
  <title>Dua Serupa Admin Dashboard</title>
  <link rel="stylesheet" href="dashboard.css" />
</head>
<body>

  <!-- Sidebar -->
  <aside class="sidebar">
    <div class="logo">
      <img src="../kumpulan foto dan icon/logo ds.png" alt="Dua Serupa" />
      <h2>Dua Serupa</h2>
      <small>Admin Panel</small>
    </div>

    <ul class="menu">
      <li class="active" id="dashboard"><span>📊</span> Dashboard</li>
      <li id="beranda"><span>🏠</span> Beranda</li>
      <li id="member"><span>🎤</span> Member</li>
      <li id="history"><span>📜</span> History</li>
      <li id="music"><span>🎶</span> Music</li>
      <li id="agenda"><span>🗓️</span> Agenda</li>
      <li id="gallery"><span>🖼️</span> Gallery</li>
      <li id="merch"><span>🛍️</span> Merch</li>
      <li id="booking"><span>📩</span> Booking</li>
      <li id="news"><span>📰</span> News Update</li>
    </ul>

    <button class="logout">Logout</button>
  </aside>

  <!-- Main Content -->
  <main class="main" id="main-content">
    <header class="topbar">
      <h1>Dashboard Admin</h1>
      <div class="admin-info">
        <p>👤 Admin: <strong>Dua Serupa Team</strong></p>
      </div>
    </header>

    <section class="cards">
      <div class="card"><h3>Total Booking</h3><p class="value">42</p></div>
      <div class="card"><h3>Total Event</h3><p class="value">12</p></div>
      <div class="card"><h3>Member Aktif</h3><p class="value">3</p></div>
      <div class="card"><h3>Merch Terjual</h3><p class="value">157</p></div>
    </section>
  </main>

  <script>
// ------------------------------
// DASHBOARD ADMIN SCRIPT (FINAL TERINTEGRASI + HISTORY)
// ------------------------------

const main = document.getElementById("main-content");
const menuItems = document.querySelectorAll(".menu li");

// Ganti konten sesuai menu
menuItems.forEach(item => {
  item.addEventListener("click", () => {
    menuItems.forEach(i => i.classList.remove("active"));
    item.classList.add("active");

    switch (item.id) {

      // === DASHBOARD ===
      case "dashboard":
        const membersCount = (JSON.parse(localStorage.getItem("members")) || []).length;
        main.innerHTML = `
          <header class="topbar">
            <h1>Dashboard Admin</h1>
            <div class="admin-info">
              <p>👤 Admin: <strong>Dua Serupa Team</strong></p>
            </div>
          </header>
          <section class="cards">
            <div class="card"><h3>Total Booking</h3><p class="value">42</p></div>
            <div class="card"><h3>Total Event</h3><p class="value">12</p></div>
            <div class="card"><h3>Member Aktif</h3><p class="value">${membersCount}</p></div>
            <div class="card"><h3>Merch Terjual</h3><p class="value">157</p></div>
          </section>
        `;
        break;

      // === BERANDA ===
case "beranda":
  main.innerHTML = `
    <header class="topbar"><h1>Kelola Beranda</h1></header>
    <section class="content-section">
      <div class="card" style="
        background:#1e1e1e;
        border-radius:14px;
        padding:28px;
        box-shadow:0 0 10px rgba(0,0,0,0.4);
        color:#fff;
        max-width:900px;
        margin:auto;
        text-align:left;
      ">

        <!-- Header -->
        <div style="
          border-bottom:1px solid #333;
          padding-bottom:16px;
          margin-bottom:24px;
          text-align:left;
        ">
          <h2 style="font-size:1.5rem;color:#fff;font-weight:600;margin-bottom:6px;">🏠 Manajemen Beranda</h2>
          <p style="color:#aaa;font-size:14px;margin:0;">Atur semua konten halaman beranda website band kamu.</p>
        </div>

        <!-- Tabs Navigation -->
        <div style="display:flex;gap:10px;margin-bottom:25px;flex-wrap:wrap;">
          <button class="tab-button active" data-tab="hero">Hero Section</button>
          <button class="tab-button" data-tab="gallery">Gallery</button>
          <button class="tab-button" data-tab="history">History</button>
          <button class="tab-button" data-tab="news">News Update</button>
          <button class="tab-button" data-tab="merch">Merchandise</button>
        </div>

        <form id="berandaForm">
          <!-- Hero Section Tab -->
          <div class="tab-content active" id="hero-tab">
            <h3 style="color:#d6792f;margin-bottom:15px;">🎯 Hero Section</h3>
            <div style="display:flex;flex-direction:column;gap:18px;">
              <div>
                <label style="color:#ffb36b;font-weight:bold;">📝 Judul Hero</label>
                <input type="text" id="judulHero" placeholder="Masukkan judul utama"
                  style="width:100%;padding:10px;background:#2b2b2b;border:1px solid #444;border-radius:8px;color:#fff;margin-top:6px;">
              </div>
              <div>
                <label style="color:#ffb36b;font-weight:bold;">💬 Deskripsi Hero</label>
                <textarea rows="3" id="deskripsiHero" placeholder="Masukkan teks deskripsi..."
                  style="width:100%;padding:10px;background:#2b2b2b;border:1px solid #444;border-radius:8px;color:#fff;margin-top:6px;resize:vertical;"></textarea>
              </div>
              <div>
                <label style="color:#ffb36b;font-weight:bold;">🔘 Teks Tombol</label>
                <input type="text" id="ctaText" placeholder="Misal: AGENDA EVENT"
                  style="width:100%;padding:10px;background:#2b2b2b;border:1px solid #444;border-radius:8px;color:#fff;margin-top:6px;">
              </div>
              <div>
                <label style="color:#ffb36b;font-weight:bold;">🔗 Link Tombol</label>
                <input type="text" id="ctaLink" placeholder="../agenda/agenda.php"
                  style="width:100%;padding:10px;background:#2b2b2b;border:1px solid #444;border-radius:8px;color:#fff;margin-top:6px;">
              </div>
              <div>
                <label style="color:#ffb36b;font-weight:bold;">🖼️ Gambar Background Hero</label>
                <input type="file" id="heroImage" accept="image/*"
                  style="display:block;margin-top:10px;color:#ccc;background:#2b2b2b;padding:8px;border-radius:6px;">
              </div>
              <div id="heroPreviewContainer" style="display:none;text-align:center;margin-top:10px;">
                <img id="previewHero" style="width:300px;border-radius:12px;border:2px solid #333;object-fit:cover;">
                <br>
                <button type="button" id="deleteHeroImage" style="
                  background:#dc3545;color:white;border:none;padding:8px 14px;border-radius:8px;cursor:pointer;font-weight:600;margin-top:10px;">🗑️ Hapus Foto</button>
              </div>
            </div>
          </div>

          <!-- Gallery Tab -->
          <div class="tab-content" id="gallery-tab">
            <h3 style="color:#d6792f;margin-bottom:15px;">🖼️ Gallery Section</h3>
            <div style="display:flex;flex-direction:column;gap:18px;">
              <div>
                <label style="color:#ffb36b;font-weight:bold;">📝 Judul Gallery</label>
                <input type="text" id="galleryTitle" placeholder="GALLERY"
                  style="width:100%;padding:10px;background:#2b2b2b;border:1px solid #444;border-radius:8px;color:#fff;margin-top:6px;">
              </div>
              <div>
                <label style="color:#ffb36b;font-weight:bold;">🖼️ Upload Gambar Gallery (Max 3)</label>
                <input type="file" id="galleryImages" accept="image/*" multiple
                  style="display:block;margin-top:10px;color:#ccc;background:#2b2b2b;padding:8px;border-radius:6px;">
                <small style="color:#aaa;">Pilih maksimal 3 gambar</small>
              </div>
              <div id="galleryPreviewContainer" style="margin-top:15px;">
                <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:15px;" id="galleryImagesGrid"></div>
                <p id="noGalleryMessage" style="color:#aaa;text-align:center;padding:20px;">
                  Belum ada gambar gallery. Upload gambar atau akan menggunakan gambar default.
                </p>
              </div>
            </div>
          </div>

          <!-- History, News, Merch tabs (tetap sama) -->
          <div class="tab-content" id="history-tab">
            <h3 style="color:#d6792f;margin-bottom:15px;">📜 History Section</h3>
            <div style="display:flex;flex-direction:column;gap:18px;">
              <div>
                <label style="color:#ffb36b;font-weight:bold;">📝 Judul History</label>
                <input type="text" id="historyTitle" placeholder="HISTORY"
                  style="width:100%;padding:10px;background:#2b2b2b;border:1px solid #444;border-radius:8px;color:#fff;margin-top:6px;">
              </div>
              <div>
                <label style="color:#ffb36b;font-weight:bold;">📖 Konten History</label>
                <textarea rows="6" id="historyContent" placeholder="Masukkan teks history band..."
                  style="width:100%;padding:10px;background:#2b2b2b;border:1px solid #444;border-radius:8px;color:#fff;margin-top:6px;resize:vertical;"></textarea>
              </div>
              <div>
                <label style="color:#ffb36b;font-weight:bold;">🔗 Link Selengkapnya</label>
                <input type="text" id="historyLink" placeholder="../history/history.php"
                  style="width:100%;padding:10px;background:#2b2b2b;border:1px solid #444;border-radius:8px;color:#fff;margin-top:6px;">
              </div>
            </div>
          </div>

          <div class="tab-content" id="news-tab">
            <h3 style="color:#d6792f;margin-bottom:15px;">📰 News Update Section</h3>
            <div style="display:flex;flex-direction:column;gap:18px;">
              <div>
                <label style="color:#ffb36b;font-weight:bold;">📝 Judul Section</label>
                <input type="text" id="newsTitle" placeholder="NEWS UPDATE"
                  style="width:100%;padding:10px;background:#2b2b2b;border:1px solid #444;border-radius:8px;color:#fff;margin-top:6px;">
              </div>
              <div>
                <label style="color:#ffb36b;font-weight:bold;">📰 Berita Utama</label>
                <input type="text" id="mainNewsTitle" placeholder="Judul berita utama"
                  style="width:100%;padding:10px;background:#2b2b2b;border:1px solid #444;border-radius:8px;color:#fff;margin-top:6px;">
              </div>
              <div>
                <label style="color:#ffb36b;font-weight:bold;">🖼️ Gambar Berita Utama</label>
                <input type="file" id="mainNewsImage" accept="image/*"
                  style="display:block;margin-top:10px;color:#ccc;background:#2b2b2b;padding:8px;border-radius:6px;">
              </div>
              <div id="newsPreviewContainer" style="display:none;text-align:center;margin-top:10px;">
                <img id="previewNews" style="width:200px;border-radius:8px;border:2px solid #333;object-fit:cover;">
              </div>
            </div>
          </div>

          <div class="tab-content" id="merch-tab">
            <h3 style="color:#d6792f;margin-bottom:15px;">🛍️ Merchandise Section</h3>
            <div style="display:flex;flex-direction:column;gap:18px;">
              <div>
                <label style="color:#ffb36b;font-weight:bold;">📝 Judul Merchandise</label>
                <input type="text" id="merchTitle" placeholder="Official Merch"
                  style="width:100%;padding:10px;background:#2b2b2b;border:1px solid #444;border-radius:8px;color:#fff;margin-top:6px;">
              </div>
              <div>
                <label style="color:#ffb36b;font-weight:bold;">💬 Deskripsi 1</label>
                <input type="text" id="merchDesc1" placeholder="Official Merchandise Dua Serupa..."
                  style="width:100%;padding:10px;background:#2b2b2b;border:1px solid #444;border-radius:8px;color:#fff;margin-top:6px;">
              </div>
              <div>
                <label style="color:#ffb36b;font-weight:bold;">💬 Deskripsi 2</label>
                <input type="text" id="merchDesc2" placeholder="Jaminan 100% Original..."
                  style="width:100%;padding:10px;background:#2b2b2b;border:1px solid #444;border-radius:8px;color:#fff;margin-top:6px;">
              </div>
              <div>
                <label style="color:#ffb36b;font-weight:bold;">💬 Deskripsi 3</label>
                <input type="text" id="merchDesc3" placeholder="- Dua Serupa"
                  style="width:100%;padding:10px;background:#2b2b2b;border:1px solid #444;border-radius:8px;color:#fff;margin-top:6px;">
              </div>
              <div>
                <label style="color:#ffb36b;font-weight:bold;">🖼️ Logo/Gambar Merch</label>
                <input type="file" id="merchImage" accept="image/*"
                  style="display:block;margin-top:10px;color:#ccc;background:#2b2b2b;padding:8px;border-radius:6px;">
              </div>
              <div id="merchPreviewContainer" style="display:none;text-align:center;margin-top:10px;">
                <img id="previewMerch" style="width:150px;border-radius:8px;border:2px solid #333;object-fit:cover;">
              </div>
            </div>
          </div>

          <div style="text-align:right;margin-top:25px;border-top:1px solid #333;padding-top:20px;">
            <button type="submit" style="background:#d6792f;color:white;border:none;padding:12px 25px;border-radius:8px;cursor:pointer;font-weight:600;font-size:16px;">
              💾 Simpan Semua Perubahan
            </button>
          </div>
        </form>
      </div>
    </section>
  `;

  let berandaData = {};
  let currentGalleryImages = [];

  // Load data dari database
  async function loadBerandaData() {
    try {
      const response = await fetch('../beranda/get_beranda.php');
      const data = await response.json();
      berandaData = data;
      populateForm();
    } catch (error) {
      console.error('Error loading beranda data:', error);
      berandaData = {};
    }
  }

  function populateForm() {
    // Hero Section
    if (berandaData.hero) {
      document.getElementById('judulHero').value = berandaData.hero.title || '';
      document.getElementById('deskripsiHero').value = berandaData.hero.content || '';
      document.getElementById('ctaText').value = berandaData.hero.button_text || '';
      document.getElementById('ctaLink').value = berandaData.hero.button_link || '';
      if (berandaData.hero.image) {
        document.getElementById('previewHero').src = berandaData.hero.image;
        document.getElementById('heroPreviewContainer').style.display = 'block';
      }
    }

    // Gallery Section
    if (berandaData.gallery) {
      document.getElementById('galleryTitle').value = berandaData.gallery.title || '';
      // Load gallery images
      if (berandaData.gallery.gallery_images && berandaData.gallery.gallery_images !== '[]') {
        try {
          currentGalleryImages = JSON.parse(berandaData.gallery.gallery_images);
        } catch (e) {
          currentGalleryImages = [];
        }
      } else {
        currentGalleryImages = [];
      }
      renderGalleryPreview();
    }

    // History, News, Merch sections...
    if (berandaData.history) {
      document.getElementById('historyTitle').value = berandaData.history.title || '';
      document.getElementById('historyContent').value = berandaData.history.content || '';
      document.getElementById('historyLink').value = berandaData.history.button_link || '';
    }
    if (berandaData.news) {
      document.getElementById('newsTitle').value = berandaData.news.title || '';
      document.getElementById('mainNewsTitle').value = berandaData.news.content || '';
      if (berandaData.news.image) {
        document.getElementById('previewNews').src = berandaData.news.image;
        document.getElementById('newsPreviewContainer').style.display = 'block';
      }
    }
    if (berandaData.merch) {
      document.getElementById('merchTitle').value = berandaData.merch.title || '';
      const descLines = berandaData.merch.content ? berandaData.merch.content.split('\n') : ['', '', ''];
      document.getElementById('merchDesc1').value = descLines[0] || '';
      document.getElementById('merchDesc2').value = descLines[1] || '';
      document.getElementById('merchDesc3').value = descLines[2] || '';
      if (berandaData.merch.image) {
        document.getElementById('previewMerch').src = berandaData.merch.image;
        document.getElementById('merchPreviewContainer').style.display = 'block';
      }
    }
  }

  function renderGalleryPreview() {
    const galleryGrid = document.getElementById('galleryImagesGrid');
    const noGalleryMessage = document.getElementById('noGalleryMessage');
    
    galleryGrid.innerHTML = '';

    if (currentGalleryImages.length === 0) {
      galleryGrid.style.display = 'none';
      noGalleryMessage.style.display = 'block';
      return;
    }

    galleryGrid.style.display = 'grid';
    noGalleryMessage.style.display = 'none';

    currentGalleryImages.forEach((image, index) => {
      galleryGrid.innerHTML += `
        <div style="position:relative;">
          <img src="${image}" alt="Gallery ${index + 1}" style="width:100%;height:120px;object-fit:cover;border-radius:8px;border:2px solid #444;">
          <button type="button" class="delete-gallery-image" data-index="${index}" style="position:absolute;top:5px;right:5px;background:#dc3545;color:white;border:none;border-radius:50%;width:25px;height:25px;cursor:pointer;font-size:12px;display:flex;align-items:center;justify-content:center;">×</button>
        </div>
      `;
    });

    document.querySelectorAll('.delete-gallery-image').forEach(btn => {
      btn.addEventListener('click', (e) => {
        const index = parseInt(e.target.dataset.index);
        if (confirm('Hapus gambar ini dari gallery?')) {
          currentGalleryImages.splice(index, 1);
          renderGalleryPreview();
        }
      });
    });
  }

  // Tab functionality
  document.querySelectorAll('.tab-button').forEach(button => {
    button.addEventListener('click', () => {
      document.querySelectorAll('.tab-button').forEach(btn => btn.classList.remove('active'));
      document.querySelectorAll('.tab-content').forEach(content => content.classList.remove('active'));
      button.classList.add('active');
      document.getElementById(button.dataset.tab + '-tab').classList.add('active');
    });
  });

  // Image upload handlers
  document.getElementById('galleryImages').addEventListener('change', function(e) {
    const files = e.target.files;
    if (files.length > 3) {
      alert('Maksimal 3 gambar!');
      e.target.value = '';
      return;
    }

    let loadedCount = 0;
    const totalFiles = Math.min(files.length, 3 - currentGalleryImages.length);
    
    if (totalFiles === 0) {
      alert('Sudah mencapai batas maksimal 3 gambar!');
      e.target.value = '';
      return;
    }

    for (let i = 0; i < files.length; i++) {
      if (currentGalleryImages.length >= 3) break;

      const file = files[i];
      if (file.size > 2 * 1024 * 1024) {
        alert(`File "${file.name}" terlalu besar. Maksimal 2MB.`);
        continue;
      }

      if (!file.type.startsWith('image/')) {
        alert(`File "${file.name}" bukan gambar.`);
        continue;
      }

      const reader = new FileReader();
      reader.onload = (event) => {
        currentGalleryImages.push(event.target.result);
        loadedCount++;
        if (loadedCount === totalFiles) {
          renderGalleryPreview();
          alert(`Berhasil menambahkan ${loadedCount} gambar!`);
        }
      };
      reader.readAsDataURL(file);
    }
    e.target.value = '';
  });

  document.getElementById('heroImage').addEventListener('change', handleImageUpload('hero'));
  document.getElementById('mainNewsImage').addEventListener('change', handleImageUpload('news'));
  document.getElementById('merchImage').addEventListener('change', handleImageUpload('merch'));

  function handleImageUpload(type) {
    return function(e) {
      const file = e.target.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = () => {
          if (type === 'hero') {
            document.getElementById('previewHero').src = reader.result;
            document.getElementById('heroPreviewContainer').style.display = 'block';
          } else if (type === 'news') {
            document.getElementById('previewNews').src = reader.result;
            document.getElementById('newsPreviewContainer').style.display = 'block';
          } else if (type === 'merch') {
            document.getElementById('previewMerch').src = reader.result;
            document.getElementById('merchPreviewContainer').style.display = 'block';
          }
        };
        reader.readAsDataURL(file);
      }
    };
  }

  // Form submission
  document.getElementById('berandaForm').addEventListener('submit', async (e) => {
    e.preventDefault();
    
    const formData = {
      hero: {
        title: document.getElementById('judulHero').value,
        content: document.getElementById('deskripsiHero').value,
        button_text: document.getElementById('ctaText').value,
        button_link: document.getElementById('ctaLink').value,
        image: document.getElementById('previewHero').src || ''
      },
      gallery: {
        title: document.getElementById('galleryTitle').value,
        content: '',
        image: '',
        button_text: '',
        button_link: '',
        gallery_images: JSON.stringify(currentGalleryImages)
      },
      history: {
        title: document.getElementById('historyTitle').value,
        content: document.getElementById('historyContent').value,
        button_text: 'Baca Selengkapnya >',
        button_link: document.getElementById('historyLink').value,
        image: ''
      },
      news: {
        title: document.getElementById('newsTitle').value,
        content: document.getElementById('mainNewsTitle').value,
        button_text: '',
        button_link: '',
        image: document.getElementById('previewNews').src || ''
      },
      merch: {
        title: document.getElementById('merchTitle').value,
        content: [
          document.getElementById('merchDesc1').value,
          document.getElementById('merchDesc2').value,
          document.getElementById('merchDesc3').value
        ].filter(Boolean).join('\n'),
        button_text: '',
        button_link: '',
        image: document.getElementById('previewMerch').src || ''
      }
    };

    try {
      const response = await fetch('../beranda/upload_beranda.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify(formData)
      });
      
      const result = await response.json();
      if (result.success) {
        alert('✅ Data berhasil disimpan!');
        loadBerandaData();
      } else {
        alert('❌ Error: ' + result.message);
      }
    } catch (error) {
      alert('❌ Error: ' + error.message);
    }
  });

  // Load data
  loadBerandaData();

  // Add CSS
  const style = document.createElement('style');
  style.textContent = `
    .tab-button { background: #2b2b2b; color: #ccc; border: 1px solid #444; padding: 10px 20px; border-radius: 8px; cursor: pointer; transition: 0.3s; }
    .tab-button:hover { background: #333; }
    .tab-button.active { background: #d6792f; color: white; border-color: #d6792f; }
    .tab-content { display: none; }
    .tab-content.active { display: block; }
  `;
  document.head.appendChild(style);
  break;

    // === MEMBER ===
case "member":
  main.innerHTML = `
    <header class="topbar"><h1>Kelola Member Band</h1></header>
    <section class="content-section">
      <div class="card" style="
        background:#1e1e1e;border-radius:14px;padding:28px;
        box-shadow:0 0 10px rgba(0,0,0,0.4);color:#fff;
        max-width:900px;margin:auto;text-align:left;">
        <div style="border-bottom:1px solid #333;padding-bottom:16px;margin-bottom:24px;">
          <h2 style="font-size:1.5rem;color:#fff;font-weight:600;">👥 Manajemen Member Band</h2>
          <p style="color:#aaa;font-size:14px;">Tambah, ubah, dan keluali anggota band kamu di sini.</p>
        </div>
        <button id="addMemberBtn" style="
          background:#d6792f;color:white;border:none;padding:10px 18px;
          border-radius:8px;cursor:pointer;font-weight:600;margin-bottom:20px;">
          ➕ Tambah Member
        </button>
        <ul id="memberList" style="list-style:none;padding:0;display:flex;flex-direction:column;gap:18px;"></ul>
        <div style="text-align:right;margin-top:25px;">
          <button id="saveMemberBtn" style="
            background:#d6792f;color:white;border:none;padding:10px 20px;
            border-radius:8px;cursor:pointer;font-weight:600;">💾 Simpan ke Database</button>
        </div>
      </div>
    </section>

    <!-- Modal editor foto -->
    <div id="photoEditor" style="display:none;position:fixed;top:0;left:0;width:100%;height:100%;
      background:rgba(0,0,0,0.9);align-items:center;justify-content:center;z-index:999;">
      <div style="background:#222;padding:20px;border-radius:12px;max-width:90%;text-align:center;">
        <canvas id="editorCanvas" width="300" height="300" 
          style="background:#111;border:1px solid #555;cursor:grab;border-radius:8px;"></canvas>
        <div style="margin-top:10px;display:flex;justify-content:center;gap:10px;">
          <button id="rotateLeft" style="padding:8px 14px;">↩️ Putar Kiri</button>
          <button id="rotateRight" style="padding:8px 14px;">↪️ Putar Kanan</button>
          <button id="zoomIn" style="padding:8px 14px;">🔍+</button>
          <button id="zoomOut" style="padding:8px 14px;">🔍−</button>
        </div>
        <div style="margin-top:14px;">
          <button id="saveEdit" style="background:#d6792f;color:white;padding:8px 16px;border:none;border-radius:8px;">✅ Simpan</button>
          <button id="cancelEdit" style="background:#555;color:white;padding:8px 16px;border:none;border-radius:8px;">❌ Batal</button>
        </div>
      </div>
    </div>
  `;

  let members = [];
  const list = document.getElementById("memberList");
  const photoEditor = document.getElementById("photoEditor");
  const canvas = document.getElementById("editorCanvas");
  const ctx = canvas.getContext("2d");

  let img, scale = 1, rotation = 0, offsetX = 0, offsetY = 0;
  let isDragging = false, startX, startY, editingIndex = null;

  // Load members dari database
  async function loadMembers() {
    try {
      const response = await fetch('../member/get_members.php');
      if (!response.ok) {
        throw new Error('Network response was not ok');
      }
      const data = await response.json();
      
      if (data.error) {
        throw new Error(data.error);
      }
      
      members = data;
      renderMembers();
    } catch (error) {
      console.error('Error loading members:', error);
      alert('Error loading members: ' + error.message);
      members = [];
      renderMembers();
    }
  }

  // Render daftar member
  function renderMembers() {
    list.innerHTML = "";
    if (members.length === 0) {
      list.innerHTML = `<p style="color:#ccc;text-align:center;">Belum ada member ditambahkan.</p>`;
      return;
    }

    members.forEach((m, i) => {
      const li = document.createElement("li");
      li.style = `
        background:#2b2b2b;border:1px solid #444;border-radius:10px;padding:18px;
        display:flex;flex-wrap:wrap;align-items:center;gap:14px;justify-content:space-between;
        box-shadow:0 0 6px rgba(0,0,0,0.3);`;

      li.innerHTML = `
        <div style="flex:1;min-width:200px;display:flex;flex-direction:column;gap:10px;">
          <div>
            <label style="color:#d6792f;font-weight:bold;">👤 Nama:</label><br>
            <input type="text" class="name" data-index="${i}" value="${m.name || ''}"
              placeholder="Nama member"
              style="width:100%;padding:8px;background:#1e1e1e;border:1px solid #555;border-radius:6px;color:#fff;">
          </div>
          <div>
            <label style="color:#d6792f;font-weight:bold;">🎸 Posisi:</label><br>
            <input type="text" class="role" data-index="${i}" value="${m.role || ''}"
              placeholder="Posisi di band"
              style="width:100%;padding:8px;background:#1e1e1e;border:1px solid #555;border-radius:6px;color:#fff;">
          </div>
        </div>

        <div style="display:flex;flex-direction:column;align-items:center;gap:10px;">
          <div style="text-align:center;">
            <label style="color:#d6792f;font-weight:bold;">📸 Foto:</label><br>
            <input type="file" class="photo" data-index="${i}" accept="image/*" style="margin-top:6px;">
          </div>
          <img src="${m.photo || '../kumpulan foto dan icon/default.jpg'}"
               alt="Preview" style="width:100px;height:100px;object-fit:cover;border-radius:10px;border:1px solid #555;">
          <div style="display:flex;gap:6px;">
            <button class="editPhoto" data-index="${i}" style="background:#3a8fd9;color:white;border:none;padding:6px 10px;border-radius:6px;cursor:pointer;">✏️ Edit</button>
            <button class="deleteMember" data-index="${i}" style="background:#dc3545;color:white;border:none;padding:6px 10px;border-radius:6px;cursor:pointer;">🗑️ Hapus</button>
          </div>
        </div>
        <input type="hidden" class="member-id" value="${m.id || ''}">
      `;
      list.appendChild(li);
    });

    // Tombol hapus
    document.querySelectorAll(".deleteMember").forEach(btn => {
      btn.onclick = async e => {
        const idx = parseInt(e.target.dataset.index);
        const memberId = members[idx].id;
        
        if (confirm("Yakin hapus member ini?")) {
          try {
            const response = await fetch('../member/delete_member.php', {
              method: 'POST',
              headers: {
                'Content-Type': 'application/json',
              },
              body: JSON.stringify({ id: memberId })
            });
            
            const result = await response.json();
            if (result.success) {
              members.splice(idx, 1);
              renderMembers();
              alert('Member berhasil dihapus!');
            } else {
              alert('Error menghapus member: ' + result.message);
            }
          } catch (error) {
            alert('Error menghapus member: ' + error.message);
          }
        }
      };
    });

    // Tombol edit foto
    document.querySelectorAll(".editPhoto").forEach(btn => {
      btn.onclick = e => {
        const idx = parseInt(e.target.dataset.index);
        if (!members[idx].photo || members[idx].photo === '') {
          alert("Belum ada foto untuk diedit!");
          return;
        }
        openEditor(members[idx].photo, idx);
      };
    });

    // Upload foto baru
    document.querySelectorAll(".photo").forEach(input => {
      input.onchange = e => {
        const idx = parseInt(e.target.dataset.index);
        const file = e.target.files[0];
        if (!file) return;
        
        // Validasi file
        if (!file.type.startsWith('image/')) {
          alert('Harap pilih file gambar!');
          return;
        }
        
        const reader = new FileReader();
        reader.onload = () => openEditor(reader.result, idx);
        reader.onerror = () => alert('Error membaca file!');
        reader.readAsDataURL(file);
      };
    });
  }

  // === Editor Foto Manual ===
  function openEditor(src, index) {
    editingIndex = index;
    img = new Image();
    img.src = src;
    scale = 1; rotation = 0; offsetX = 0; offsetY = 0;
    img.onload = () => {
      drawImage();
      photoEditor.style.display = "flex";
    };
    img.onerror = () => {
      alert('Error memuat gambar!');
    };
  }

  function drawImage() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    ctx.save();
    ctx.translate(canvas.width / 2 + offsetX, canvas.height / 2 + offsetY);
    ctx.rotate(rotation * Math.PI / 180);
    ctx.scale(scale, scale);
    ctx.drawImage(img, -img.width / 2, -img.height / 2);
    ctx.restore();
  }

  // Geser manual
  canvas.onmousedown = e => {
    isDragging = true;
    startX = e.offsetX - offsetX;
    startY = e.offsetY - offsetY;
  };
  canvas.onmouseup = () => isDragging = false;
  canvas.onmousemove = e => {
    if (isDragging) {
      offsetX = e.offsetX - startX;
      offsetY = e.offsetY - startY;
      drawImage();
    }
  };

  document.getElementById("rotateLeft").onclick = () => { rotation -= 15; drawImage(); };
  document.getElementById("rotateRight").onclick = () => { rotation += 15; drawImage(); };
  document.getElementById("zoomIn").onclick = () => { scale += 0.1; drawImage(); };
  document.getElementById("zoomOut").onclick = () => { if (scale > 0.2) scale -= 0.1; drawImage(); };

  document.getElementById("cancelEdit").onclick = () => photoEditor.style.display = "none";

  document.getElementById("saveEdit").onclick = () => {
    const finalImg = canvas.toDataURL("image/jpeg", 0.8); // Kompresi 80%
    members[editingIndex].photo = finalImg;
    photoEditor.style.display = "none";
    renderMembers();
  };

  document.getElementById("addMemberBtn").onclick = () => {
    members.push({ name: "", role: "", photo: "" });
    renderMembers();
  };

  document.getElementById("saveMemberBtn").onclick = async () => {
    const names = document.querySelectorAll(".name");
    const roles = document.querySelectorAll(".role");
    
    // Validasi data
    let isValid = true;
    const updatedMembers = Array.from(names).map((nameInput, i) => {
      const name = nameInput.value.trim();
      const role = roles[i].value.trim();
      
      if (!name || !role) {
        isValid = false;
      }
      
      return {
        id: members[i]?.id || null,
        name: name,
        role: role,
        photo: members[i].photo || ""
      };
    });

    if (!isValid) {
      alert('Harap isi semua field nama dan posisi!');
      return;
    }

    members = updatedMembers;

    try {
      const response = await fetch('../member/save_members.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({ members: members })
      });
      
      if (!response.ok) {
        throw new Error('Network response was not ok');
      }
      
      const result = await response.json();
      if (result.success) {
        alert("✅ Data Member berhasil disimpan ke database!");
        loadMembers(); // Reload data dari database
      } else {
        throw new Error(result.message || 'Unknown error');
      }
    } catch (error) {
      console.error('Save error:', error);
      alert('Error menyimpan data ke database: ' + error.message);
    }
  };

  loadMembers();
  break;  

    // === HISTORY ===
case "history":
main.innerHTML = `
  <header class="topbar"><h1>Kelola History Band</h1></header>
  <section class="content-section">
    <div class="card" style="
      background:#1e1e1e;
      border-radius:14px;
      padding:28px;
      box-shadow:0 0 10px rgba(0,0,0,0.4);
      color:#fff;
      max-width:800px;
      margin:auto;
      text-align:left;
    ">

      <!-- Header -->
      <div style="
        border-bottom:1px solid #333;
        padding-bottom:16px;
        margin-bottom:24px;
        text-align:left;
      ">
        <h2 style="font-size:1.5rem;color:#fff;font-weight:600;margin-bottom:6px;text-align:left;">
          📖 Manajemen History Band
        </h2>
        <p style="color:#aaa;font-size:14px;margin:0;text-align:left;">
          Atur gambar utama dan isi sejarah band kamu di sini.
        </p>
      </div>

      <!-- Upload Gambar -->
      <div style="margin-bottom:20px;text-align:left;">
        <label style="color:#d6792f;font-weight:bold;">📸 Gambar Utama:</label><br>
        <input type="file" id="historyImage" accept="image/*" 
          style="margin-top:8px;background:#2b2b2b;border:1px solid #444;color:#ccc;padding:8px;border-radius:6px;width:100%;">
        
        <div id="previewContainer" style="display:none;margin-top:15px;">
          <img id="historyPreview" style="width:250px;border-radius:12px;border:1px solid #444;object-fit:cover;display:block;margin-bottom:10px;">
          <button type="button" id="deleteHistoryImage" style="
            background:#dc3545;
            color:white;
            border:none;
            padding:6px 12px;
            border-radius:6px;
            cursor:pointer;
          ">🗑️ Hapus Gambar</button>
        </div>
      </div>

      <!-- Kalimat Pembuka -->
      <div style="margin-bottom:20px;text-align:left;">
        <label style="color:#d6792f;font-weight:bold;">📝 Kalimat Pembuka:</label><br>
        <input type="text" id="historyIntro" placeholder="Kalimat pembuka sejarah..." 
          style="width:100%;margin-top:6px;padding:10px;background:#2b2b2b;border:1px solid #444;color:#fff;border-radius:6px;">
      </div>

      <!-- Isi Sejarah -->
      <div style="margin-bottom:20px;text-align:left;">
        <label style="color:#d6792f;font-weight:bold;">📜 Isi Sejarah:</label><br>
        <textarea id="historyContent" rows="8" placeholder="Tulis sejarah band di sini..." 
          style="width:100%;margin-top:6px;padding:10px;background:#2b2b2b;border:1px solid #444;color:#fff;border-radius:6px;resize:vertical;"></textarea>
      </div>

      <!-- Tombol Aksi -->
      <div style="text-align:right; display: flex; justify-content: space-between; align-items: center;">
        <button type="button" id="deleteAllHistoryBtn" style="
          background:#dc3545;
          color:white;
          border:none;
          padding:10px 20px;
          border-radius:8px;
          cursor:pointer;
          font-weight:600;
          transition:0.3s;
        " onmouseover="this.style.background='#e74c3c';"
          onmouseout="this.style.background='#dc3545';">
          🗑️ Hapus Semua Data
        </button>
        
        <button type="button" id="saveHistoryBtn" style="
          background:#d6792f;
          color:white;
          border:none;
          padding:10px 20px;
          border-radius:8px;
          cursor:pointer;
          font-weight:600;
          transition:0.3s;
        " onmouseover="this.style.background='#e88b42';"
          onmouseout="this.style.background='#d6792f';">
          💾 Simpan History
        </button>
      </div>

      <!-- Status Message -->
      <div id="historyStatus" style="margin-top:15px;"></div>
    </div>
  </section>
`;

// Tunggu sebentar agar DOM benar-benar ter-render
setTimeout(() => {
  initializeHistorySection();
}, 100);

function initializeHistorySection() {
  console.log("Initializing History Section...");
  
  const historyImage = document.getElementById("historyImage");
  const previewH = document.getElementById("historyPreview");
  const previewContainerH = document.getElementById("previewContainer");
  const deleteBtnH = document.getElementById("deleteHistoryImage");
  const introInput = document.getElementById("historyIntro");
  const contentInput = document.getElementById("historyContent");
  const saveBtn = document.getElementById("saveHistoryBtn");
  const deleteAllBtn = document.getElementById("deleteAllHistoryBtn");
  const statusDiv = document.getElementById("historyStatus");

  // Load data dari database saat dashboard dibuka
  loadHistoryData();

  // Upload dan preview gambar
  if (historyImage) {
    historyImage.addEventListener("change", e => {
      const file = e.target.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = () => {
          previewH.src = reader.result;
          previewContainerH.style.display = "block";
        };
        reader.readAsDataURL(file);
      }
    });
  }

  // Hapus gambar preview
  if (deleteBtnH) {
    deleteBtnH.addEventListener("click", () => {
      if (confirm("Hapus gambar history ini?")) {
        previewH.src = "";
        previewContainerH.style.display = "none";
        historyImage.value = "";
        alert("🗑️ Gambar berhasil dihapus dari preview!");
      }
    });
  }

  // Simpan data ke database
  if (saveBtn) {
    console.log("Save button found, adding event listener...");
    saveBtn.addEventListener("click", saveHistoryData);
  } else {
    console.error("Save button not found!");
  }

  // Hapus semua data history
  if (deleteAllBtn) {
    deleteAllBtn.addEventListener("click", deleteAllHistory);
  }

  async function saveHistoryData() {
    console.log("Save button clicked!");
    
    const saveBtn = document.getElementById("saveHistoryBtn");
    const originalText = saveBtn.innerHTML;
    
    try {
      saveBtn.innerHTML = "⏳ Menyimpan...";
      saveBtn.disabled = true;

      // Alert konfirmasi sebelum menyimpan
      const userConfirmation = confirm("Apakah Anda yakin ingin menyimpan data history?");
      if (!userConfirmation) {
        saveBtn.innerHTML = originalText;
        saveBtn.disabled = false;
        alert("❌ Penyimpanan dibatalkan!");
        return;
      }

      const formData = new FormData();
      formData.append('intro', introInput.value);
      formData.append('content', contentInput.value);
      
      // Jika ada file gambar yang dipilih
      if (historyImage.files[0]) {
        formData.append('image', historyImage.files[0]);
      } else if (previewH.src && previewH.src !== "" && !previewH.src.includes('data:,')) {
        // Jika menggunakan gambar yang sudah ada (base64)
        formData.append('image_base64', previewH.src);
      }

      console.log("Sending data to server...");
      
      // URL mengarah ke folder history
      const response = await fetch('../history/upload_history.php', {
        method: 'POST',
        body: formData
      });

      const result = await response.json();
      console.log("Server response:", result);

      if (result.success) {
        showStatus('✅ Data History berhasil disimpan!', 'success');
        // Alert sukses
        alert("🎉 Data History berhasil disimpan!\n\n📖 Lihat hasilnya di halaman History website Anda.");
        // Refresh data
        loadHistoryData();
      } else {
        showStatus('❌ Gagal menyimpan: ' + result.message, 'error');
        // Alert error
        alert("❌ Gagal menyimpan data history:\n" + result.message);
      }
    } catch (error) {
      console.error("Error saving history:", error);
      showStatus('❌ Error: ' + error.message, 'error');
      // Alert error network
      alert("❌ Terjadi kesalahan jaringan:\n" + error.message);
    } finally {
      saveBtn.innerHTML = originalText;
      saveBtn.disabled = false;
    }
  }

  async function deleteAllHistory() {
    if (!confirm("⚠️ PERINGATAN!\n\nApakah Anda yakin ingin menghapus SEMUA data history?\n\nTindakan ini tidak dapat dibatalkan dan semua data akan hilang permanen!")) {
      alert("✅ Penghapusan dibatalkan.");
      return;
    }

    // Konfirmasi kedua untuk keamanan
    const secondConfirmation = confirm("🚨 KONFIRMASI AKHIR!\n\nAnda akan menghapus SEMUA data history band.\n\nTekan OK untuk melanjutkan atau Cancel untuk membatalkan.");
    if (!secondConfirmation) {
      alert("✅ Penghapusan dibatalkan.");
      return;
    }

    try {
      const response = await fetch('../history/delete_history.php', {
        method: 'POST'
      });

      const result = await response.json();

      if (result.success) {
        showStatus('✅ Semua data history berhasil dihapus!', 'success');
        // Alert sukses hapus
        alert("✅ Semua data history berhasil dihapus permanen!");
        // Reset form
        introInput.value = '';
        contentInput.value = '';
        previewH.src = '';
        previewContainerH.style.display = 'none';
        historyImage.value = '';
      } else {
        showStatus('❌ Gagal menghapus: ' + result.message, 'error');
        // Alert error hapus
        alert("❌ Gagal menghapus data history:\n" + result.message);
      }
    } catch (error) {
      showStatus('❌ Error: ' + error.message, 'error');
      // Alert error network hapus
      alert("❌ Terjadi kesalahan jaringan saat menghapus:\n" + error.message);
    }
  }

  // Fungsi untuk load data dari database
  async function loadHistoryData() {
    try {
      console.log("Loading history data...");
      // URL mengarah ke folder history
      const response = await fetch('../history/get_history.php');
      const data = await response.json();
      console.log("Loaded data:", data);

      if (data.success && data.data) {
        const history = data.data;
        
        // Set nilai input
        introInput.value = history.intro || '';
        contentInput.value = history.content || '';
        
        // Set gambar jika ada
        if (history.image && history.image !== '') {
          previewH.src = history.image;
          previewContainerH.style.display = "block";
        } else {
          previewContainerH.style.display = "none";
        }
        
        // Alert jika data berhasil dimuat
        if (history.intro || history.content) {
          console.log("Data history berhasil dimuat dari database");
        }
      }
    } catch (error) {
      console.error('Error loading history data:', error);
      showStatus('❌ Error loading data: ' + error.message, 'error');
    }
  }

  // Fungsi untuk menampilkan status
  function showStatus(message, type) {
    if (statusDiv) {
      statusDiv.innerHTML = `
        <div style="
          padding: 10px;
          border-radius: 6px;
          background: ${type === 'success' ? '#d4edda' : '#f8d7da'};
          color: ${type === 'success' ? '#155724' : '#721c24'};
          border: 1px solid ${type === 'success' ? '#c3e6cb' : '#f5c6cb'};
        ">
          ${message}
        </div>
      `;
      
      setTimeout(() => {
        statusDiv.innerHTML = '';
      }, 5000);
    }
  }
}
break;

  // === AGENDA ===
case "agenda":
main.innerHTML = `
  <header class="topbar"><h1>Kelola Agenda Event</h1></header>
  <section class="content-section">
    <div class="card" style="
      background:#1e1e1e;
      border-radius:14px;
      padding:24px;
      box-shadow:0 0 10px rgba(0,0,0,0.4);
    ">
      
      <!-- Header Agenda -->
      <div style="
        display:flex;
        justify-content:space-between;
        align-items:flex-start;
        flex-wrap:wrap;
        gap:16px;
        margin-bottom:25px;
        border-bottom:1px solid #333;
        padding-bottom:15px;
      ">
        <div style="flex:1;min-width:260px;text-align:left;">
          <h2 style="
            color:#fff;
            font-size:1.4rem;
            font-weight:600;
            margin:0 0 6px 0;
          ">
            📅 Manajemen Agenda Event
          </h2>
          <p style="
            color:#aaa;
            font-size:14px;
            margin:0;
          ">
            Tambah, ubah, dan kelola jadwal acara band kamu di sini.
          </p>
        </div>
        <div style="flex-shrink:0;">
          <button type="button" id="addAgendaBtn" style="
            background:#d6792f;
            color:white;
            border:none;
            padding:10px 18px;
            border-radius:8px;
            cursor:pointer;
            font-weight:600;
            transition:0.3s;
          " onmouseover="this.style.background='#e88b42';"
            onmouseout="this.style.background='#d6792f';">
            ➕ Tambah Agenda
          </button>
        </div>
      </div>

      <!-- Daftar Agenda -->
      <div id="agendaList" style="margin-top:20px;display:flex;flex-direction:column;gap:20px;"></div>

      <!-- Status Message -->
      <div id="agendaStatus" style="margin-top:15px;"></div>
    </div>
  </section>
`;

// Tunggu sebentar agar DOM benar-benar ter-render
setTimeout(() => {
  initializeAgendaSection();
}, 100);

function initializeAgendaSection() {
  console.log("Initializing Agenda Section...");
  
  const agendaList = document.getElementById("agendaList");
  const addAgendaBtn = document.getElementById("addAgendaBtn");
  const statusDiv = document.getElementById("agendaStatus");

  let agendaData = [];

  // Load data dari database saat dashboard dibuka
  loadAgendaData();

  // Tambah agenda baru
  if (addAgendaBtn) {
    addAgendaBtn.addEventListener("click", () => {
      agendaData.push({ 
        id: null, 
        tanggal: "", 
        judul_acara: "", 
        lokasi: "", 
        gambar: "" 
      });
      renderAgenda();
    });
  }

  async function loadAgendaData() {
    try {
      console.log("Loading agenda data...");
      const response = await fetch('../agenda/get_agenda.php');
      const data = await response.json();
      console.log("Loaded agenda data:", data);

      if (data.success) {
        agendaData = data.data || [];
        renderAgenda();
      } else {
        showStatus('❌ Error loading agenda: ' + data.message, 'error');
      }
    } catch (error) {
      console.error('Error loading agenda data:', error);
      showStatus('❌ Error loading data: ' + error.message, 'error');
    }
  }

  function renderAgenda() {
    agendaList.innerHTML = "";

    if (agendaData.length === 0) {
      agendaList.innerHTML = `
        <p style="color:#ccc;text-align:center;padding:40px;">
          📝 Belum ada agenda ditambahkan. Klik "Tambah Agenda" untuk menambahkan event baru.
        </p>
      `;
      return;
    }

    agendaData.forEach((agenda, index) => {
      const item = document.createElement("div");
      item.className = "agenda-item";
      item.style = `
        background:#2b2b2b;
        border:1px solid #444;
        padding:18px;
        border-radius:10px;
        display:grid;
        grid-template-columns:1fr 1fr;
        gap:14px;
        align-items:start;
        box-shadow:0 0 6px rgba(0,0,0,0.3);
      `;

      item.innerHTML = `
        <div style="display:flex;flex-direction:column;gap:10px;">
          <div>
            <label style="color:#d6792f;font-weight:bold;">📅 Tanggal:</label><br>
            <input type="date" class="agenda-date" data-index="${index}" value="${agenda.tanggal}" 
              style="background:#1e1e1e;color:white;border:1px solid #555;padding:6px 10px;border-radius:6px;width:100%;">
          </div>

          <div>
            <label style="color:#d6792f;font-weight:bold;">🎤 Judul Acara:</label><br>
            <input type="text" class="agenda-title" data-index="${index}" value="${agenda.judul_acara}" placeholder="Judul event" 
              style="background:#1e1e1e;color:white;border:1px solid #555;padding:6px 10px;border-radius:6px;width:100%;">
          </div>

          <div>
            <label style="color:#d6792f;font-weight:bold;">📍 Lokasi:</label><br>
            <input type="text" class="agenda-location" data-index="${index}" value="${agenda.lokasi}" placeholder="Lokasi acara" 
              style="background:#1e1e1e;color:white;border:1px solid #555;padding:6px 10px;border-radius:6px;width:100%;">
          </div>

          <div style="display:flex;gap:10px;">
            <button type="button" class="saveAgendaBtn" data-index="${index}" style="
              background:#28a745;
              color:white;
              border:none;
              padding:8px 16px;
              border-radius:6px;
              cursor:pointer;
              font-weight:500;
            ">
              💾 Simpan
            </button>
            
            <button type="button" class="deleteAgendaBtn" data-index="${index}" style="
              background:#dc3545;
              color:white;
              border:none;
              padding:8px 16px;
              border-radius:6px;
              cursor:pointer;
              font-weight:500;
            ">
              🗑️ Hapus
            </button>
          </div>
        </div>

        <div style="display:flex;flex-direction:column;align-items:center;gap:10px;">
          <div style="text-align:center;">
            <label style="color:#d6792f;font-weight:bold;">📸 Foto Agenda:</label><br>
            <input type="file" class="agenda-photo" data-index="${index}" accept="image/*" style="margin-top:6px;">
          </div>
          <img src="${agenda.gambar || '../kumpulan foto dan icon/default.jpg'}" 
               class="agenda-preview" data-index="${index}"
               style="width:120px;height:120px;object-fit:cover;border-radius:10px;border:1px solid #555;">
        </div>
      `;
      agendaList.appendChild(item);
    });

    // Event listeners untuk foto
    document.querySelectorAll(".agenda-photo").forEach(input => {
      input.addEventListener("change", e => {
        const idx = e.target.dataset.index;
        const file = e.target.files[0];
        if (file) {
          const reader = new FileReader();
          reader.onload = () => {
            agendaData[idx].gambar = reader.result;
            // Update preview image
            const preview = document.querySelector(`.agenda-preview[data-index="${idx}"]`);
            if (preview) {
              preview.src = reader.result;
            }
          };
          reader.readAsDataURL(file);
        }
      });
    });

    // Event listeners untuk simpan
    document.querySelectorAll(".saveAgendaBtn").forEach(btn => {
      btn.addEventListener("click", async (e) => {
        const idx = e.target.dataset.index;
        await saveAgendaItem(idx);
      });
    });

    // Event listeners untuk hapus
    document.querySelectorAll(".deleteAgendaBtn").forEach(btn => {
      btn.addEventListener("click", async (e) => {
        const idx = e.target.dataset.index;
        await deleteAgendaItem(idx);
      });
    });
  }

  async function saveAgendaItem(index) {
    const dateInput = document.querySelector(`.agenda-date[data-index="${index}"]`);
    const titleInput = document.querySelector(`.agenda-title[data-index="${index}"]`);
    const locationInput = document.querySelector(`.agenda-location[data-index="${index}"]`);

    if (!dateInput.value || !titleInput.value || !locationInput.value) {
      alert("❌ Harap isi semua field (tanggal, judul acara, dan lokasi)!");
      return;
    }

    const agendaItem = {
      tanggal: dateInput.value,
      judul_acara: titleInput.value,
      lokasi: locationInput.value,
      gambar: agendaData[index].gambar || ''
    };

    try {
      const formData = new FormData();
      formData.append('tanggal', agendaItem.tanggal);
      formData.append('judul_acara', agendaItem.judul_acara);
      formData.append('lokasi', agendaItem.lokasi);
      
      if (agendaItem.gambar && agendaItem.gambar.startsWith('data:image')) {
        formData.append('gambar_base64', agendaItem.gambar);
      }

      const response = await fetch('../agenda/upload_agenda.php', {
        method: 'POST',
        body: formData
      });

      const result = await response.json();

      if (result.success) {
        showStatus('✅ Agenda berhasil disimpan!', 'success');
        alert("🎉 Agenda berhasil disimpan!\n\n📅 Lihat hasilnya di halaman Agenda website Anda.");
        // Refresh data
        loadAgendaData();
      } else {
        showStatus('❌ Gagal menyimpan agenda: ' + result.message, 'error');
        alert("❌ Gagal menyimpan agenda:\n" + result.message);
      }
    } catch (error) {
      console.error("Error saving agenda:", error);
      showStatus('❌ Error: ' + error.message, 'error');
      alert("❌ Terjadi kesalahan jaringan:\n" + error.message);
    }
  }

  async function deleteAgendaItem(index) {
    const agendaItem = agendaData[index];
    
    if (!confirm(`⚠️ Hapus agenda "${agendaItem.judul_acara}"?\n\nTindakan ini tidak dapat dibatalkan!`)) {
      return;
    }

    // Jika agenda sudah ada di database (punya ID), hapus dari database
    if (agendaItem.id) {
      try {
        const formData = new FormData();
        formData.append('id', agendaItem.id);

        const response = await fetch('../agenda/delete_agenda.php', {
          method: 'POST',
          body: formData
        });

        const result = await response.json();

        if (result.success) {
          showStatus('✅ Agenda berhasil dihapus!', 'success');
          alert("✅ Agenda berhasil dihapus!");
          // Refresh data
          loadAgendaData();
        } else {
          showStatus('❌ Gagal menghapus agenda: ' + result.message, 'error');
          alert("❌ Gagal menghapus agenda:\n" + result.message);
        }
      } catch (error) {
        showStatus('❌ Error: ' + error.message, 'error');
        alert("❌ Terjadi kesalahan jaringan saat menghapus:\n" + error.message);
      }
    } else {
      // Jika agenda belum disimpan, hapus dari array lokal
      agendaData.splice(index, 1);
      renderAgenda();
      alert("✅ Agenda berhasil dihapus!");
    }
  }

  // Fungsi untuk menampilkan status
  function showStatus(message, type) {
    if (statusDiv) {
      statusDiv.innerHTML = `
        <div style="
          padding: 10px;
          border-radius: 6px;
          background: ${type === 'success' ? '#d4edda' : '#f8d7da'};
          color: ${type === 'success' ? '#155724' : '#721c24'};
          border: 1px solid ${type === 'success' ? '#c3e6cb' : '#f5c6cb'};
        ">
          ${message}
        </div>
      `;
      
      setTimeout(() => {
        statusDiv.innerHTML = '';
      }, 5000);
    }
  }
}
break;
  
  // === Gallery === 
case "gallery":
  main.innerHTML = `
    <header class="topbar">
      <h1 style="font-size:1.8rem; color:#222;">Kelola Galeri</h1>
    </header>

    <section class="content-section">
      <div class="card" style="background:#111; padding:25px; border-radius:18px; box-shadow:0 4px 10px rgba(0,0,0,0.3);">
        
        <div style="display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; margin-bottom:20px;">
          <div>
            <h2 style="color:#fff; font-size:1.4rem; margin:0; display:flex; align-items:center; gap:8px;">
              <span>🖼️</span> <span>Manajemen Galeri</span>
            </h2>
            <p style="color:#aaa; font-size:0.9rem; margin-top:4px;">
              Unggah dan kelola foto-foto galeri band kamu di sini.
            </p>
          </div>

          <div style="display:flex; align-items:center; gap:10px; margin-top:10px;">
            <label for="uploadGallery" 
                   style="background:#222; color:#ddd; border:1px solid #333; padding:8px 12px; border-radius:8px; cursor:pointer;">
              📁 Pilih Gambar
            </label>
            <input type="file" id="uploadGallery" multiple accept="image/*" style="display:none;">
            <button id="uploadBtn"
                    style="background:#d6792f; color:white; border:none; padding:9px 18px; border-radius:8px; cursor:pointer; font-weight:600;">
              📤 Upload
            </button>
          </div>
        </div>

        <!-- Status Area -->
        <div id="uploadStatus"></div>

        <!-- Gallery Preview -->
        <div id="galleryPreview" style="display:grid; grid-template-columns:repeat(auto-fill,minmax(160px,1fr)); gap:18px;">
          <p style="color:#777; text-align:center; grid-column:1/-1;">Memuat galeri...</p>
        </div>
      </div>
    </section>
  `;

  const galleryPreview = document.getElementById("galleryPreview");
  const uploadStatus = document.getElementById("uploadStatus");

  // Fungsi tampilkan status
  function showStatus(message, isSuccess = true) {
    uploadStatus.innerHTML = `
      <div style="padding:10px; margin:10px 0; border-radius:5px; background:${isSuccess ? '#d4edda' : '#f8d7da'}; color:${isSuccess ? '#155724' : '#721c24'};">
        ${message}
      </div>
    `;
    setTimeout(() => uploadStatus.innerHTML = '', 5000);
  }

  // Load gallery dari server
  async function loadGallery() {
    try {
      const response = await fetch('../gallery/get_gallery.php');
      
      // Cek jika response bukan JSON
      const text = await response.text();
      let data;
      
      try {
        data = JSON.parse(text);
      } catch (e) {
        console.error('Response bukan JSON:', text);
        galleryPreview.innerHTML = `<p style="color:red; text-align:center;">Error: Server mengembalikan respons tidak valid</p>`;
        return;
      }
      
      galleryPreview.innerHTML = '';

      if (!data || data.length === 0) {
        galleryPreview.innerHTML = `<p style="color:#777; text-align:center; grid-column:1/-1;">Belum ada gambar di galeri.</p>`;
        return;
      }

      data.forEach((item) => {
        const wrapper = document.createElement("div");
        wrapper.className = "gallery-item";
        wrapper.style.position = "relative";
        wrapper.style.borderRadius = "12px";
        wrapper.style.overflow = "hidden";
        wrapper.style.boxShadow = "0 4px 10px rgba(0,0,0,0.5)";

        const img = document.createElement("img");
        img.src = '../gallery/' + item.image_path; // Sesuaikan path
        img.alt = "Foto Galeri";
        img.style.width = "100%";
        img.style.height = "160px";
        img.style.objectFit = "cover";

        const delBtn = document.createElement("button");
        delBtn.innerHTML = "🗑️";
        delBtn.title = "Hapus gambar";
        delBtn.style.position = "absolute";
        delBtn.style.top = "8px";
        delBtn.style.right = "8px";
        delBtn.style.background = "rgba(0,0,0,0.7)";
        delBtn.style.color = "white";
        delBtn.style.border = "none";
        delBtn.style.borderRadius = "5px";
        delBtn.style.padding = "5px";
        delBtn.style.cursor = "pointer";

        delBtn.onclick = async (e) => {
          e.stopPropagation();
          if (confirm("Hapus gambar ini?")) {
            try {
              const deleteResponse = await fetch('../gallery/delete_gallery.php', {
                method: 'POST',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify({id: item.id})
              });
              
              const result = await deleteResponse.json();
              if (result.success) {
                showStatus("✅ Gambar dihapus");
                loadGallery();
              } else {
                showStatus("❌ Gagal menghapus: " + result.message, false);
              }
            } catch (error) {
              showStatus("❌ Error: " + error.message, false);
            }
          }
        };

        wrapper.appendChild(img);
        wrapper.appendChild(delBtn);
        galleryPreview.appendChild(wrapper);
      });

    } catch (error) {
      console.error('Error:', error);
      galleryPreview.innerHTML = `<p style="color:red; text-align:center;">Gagal memuat galeri: ${error.message}</p>`;
    }
  }

  // Upload handler
  document.getElementById("uploadBtn").onclick = async () => {
    const files = document.getElementById("uploadGallery").files;
    if (files.length === 0) {
      showStatus("📁 Pilih gambar dulu!", false);
      return;
    }

    const formData = new FormData();
    for (let file of files) {
      formData.append('images[]', file);
    }

    try {
      showStatus("⏳ Mengupload...", true);
      
      const response = await fetch('../gallery/upload_gallery.php', {
        method: 'POST',
        body: formData
      });

      const result = await response.json();
      
      if (result.success) {
        showStatus("✅ " + result.message);
        loadGallery();
      } else {
        showStatus("❌ " + result.message, false);
      }
    } catch (error) {
      showStatus("❌ Upload gagal: " + error.message, false);
    }

    document.getElementById("uploadGallery").value = "";
  };

  // Initial load
  loadGallery();
  break;

  // === MERCH ===
case "merch":
  main.innerHTML = `
    <header class="topbar"><h1>Kelola Merchandise</h1></header>
    <section class="content-section">
      <div class="card" style="background:#1e1e1e;border-radius:14px;padding:20px;box-shadow:0 0 10px rgba(0,0,0,0.4);">
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;">
          <h2 style="color:#fff;">🛍️ Daftar Merchandise</h2>
          <button id="addMerchBtn" class="btn" style="background:#d6792f;color:white;border:none;padding:10px 18px;border-radius:8px;cursor:pointer;font-weight:bold;">+ Tambah Produk</button>
        </div>

        <div id="merchList" class="merch-grid" style="display:grid;grid-template-columns:repeat(auto-fill,minmax(240px,1fr));gap:20px;"></div>

        <div style="text-align:center;margin-top:25px;">
          <button id="saveMerchBtn" class="btn" style="background:#d6792f;color:white;border:none;padding:10px 20px;border-radius:10px;font-weight:bold;cursor:pointer;">💾 Simpan Merchandise</button>
        </div>
      </div>
    </section>
  `;

  let merchData = [];
  const merchList = document.getElementById("merchList");

  // Load data dari database
  async function loadMerchData() {
    try {
      console.log('Loading merch data...');
      const response = await fetch('../merch/get_merch.php');
      
      // Cek jika response ok
      if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
      }
      
      const responseText = await response.text();
      console.log('Raw response:', responseText);
      
      // Coba parse JSON
      let data;
      try {
        data = JSON.parse(responseText);
      } catch (parseError) {
        console.error('JSON Parse Error:', parseError);
        throw new Error('Response bukan JSON valid: ' + responseText.substring(0, 100));
      }
      
      merchData = data;
      renderMerch();
    } catch (error) {
      console.error('Error loading merch data:', error);
      alert('Error loading data: ' + error.message);
      merchData = [];
      renderMerch();
    }
  }

  function renderMerch() {
    merchList.innerHTML = "";

    if (merchData.length === 0) {
      merchList.innerHTML = `<p style="color:#aaa;text-align:center;">Belum ada produk merchandise.</p>`;
      return;
    }

    merchData.forEach((m, i) => {
      const merchId = m.id || `new_${i}`;
      merchList.innerHTML += `
        <div class="merch-card" style="background:#2b2b2b;padding:14px;border-radius:12px;display:flex;flex-direction:column;align-items:center;box-shadow:0 0 6px rgba(0,0,0,0.3);">
          
          <div style="width:100%;position:relative;">
            <img src="${m.image || '../kumpulan foto dan icon/default.jpg'}" 
                 alt="Foto Produk" 
                 style="width:100%;height:160px;object-fit:cover;border-radius:10px;border:1px solid #444;">
            <input type="file" class="merchPhoto" data-index="${i}" accept="image/*"
                   style="margin-top:8px;width:100%;background:#1e1e1e;color:#ccc;padding:6px;border:none;border-radius:6px;cursor:pointer;font-size:12px;">
          </div>

          <div style="width:100%;margin-top:10px;">
            <label style="font-size:13px;color:#ffb36b;">Nama Produk</label>
            <input type="text" class="merchName" data-index="${i}" value="${m.name}" 
                   placeholder="Nama produk" 
                   style="width:100%;margin-bottom:10px;padding:6px 8px;border-radius:6px;border:none;background:#3a3a3a;color:#fff;">

            <label style="font-size:13px;color:#ffb36b;">Harga (Rp)</label>
            <input type="number" class="merchPrice" data-index="${i}" value="${m.price}" 
                   placeholder="150000" 
                   style="width:100%;margin-bottom:10px;padding:6px 8px;border-radius:6px;border:none;background:#3a3a3a;color:#fff;">

            <button class="deleteMerch" data-id="${merchId}" data-index="${i}" 
                    style="width:100%;background:#dc3545;color:white;border:none;padding:8px;border-radius:8px;cursor:pointer;">🗑️ Hapus Produk</button>
          </div>
        </div>
      `;
    });

    // === Ganti gambar ===
    document.querySelectorAll(".merchPhoto").forEach(input => {
      input.addEventListener("change", e => {
        const idx = parseInt(e.target.dataset.index);
        const file = e.target.files[0];
        if (file) {
          // Validasi ukuran file (max 2MB)
          if (file.size > 2 * 1024 * 1024) {
            alert('Ukuran file terlalu besar. Maksimal 2MB.');
            return;
          }
          
          const reader = new FileReader();
          reader.onload = () => {
            merchData[idx].image = reader.result;
            renderMerch();
          };
          reader.onerror = () => {
            alert('Error membaca file gambar');
          };
          reader.readAsDataURL(file);
        }
      });
    });

    // === Hapus produk ===
    document.querySelectorAll(".deleteMerch").forEach(btn => {
      btn.addEventListener("click", async e => {
        const id = e.target.dataset.id;
        const idx = parseInt(e.target.dataset.index);
        
        if (confirm("Yakin ingin menghapus produk ini?")) {
          if (id && !id.startsWith('new_')) {
            // Hapus dari database
            try {
              const response = await fetch(`../merch/delete_merch.php?id=${id}`);
              const responseText = await response.text();
              let result;
              
              try {
                result = JSON.parse(responseText);
              } catch (parseError) {
                throw new Error('Response tidak valid: ' + responseText);
              }
              
              if (!result.success) {
                alert('Error menghapus produk: ' + result.message);
                return;
              }
            } catch (error) {
              alert('Error menghapus produk: ' + error.message);
              return;
            }
          }
          
          // Hapus dari data lokal
          merchData.splice(idx, 1);
          renderMerch();
          alert('Produk berhasil dihapus!');
        }
      });
    });
  }

  // === Tambah Produk Baru ===
  document.getElementById("addMerchBtn").addEventListener("click", () => {
    merchData.push({ 
      name: "Produk Baru", 
      price: "100000", 
      image: "" 
    });
    renderMerch();
  });

  // === Simpan ke Database ===
  document.getElementById("saveMerchBtn").addEventListener("click", async () => {
    const names = document.querySelectorAll(".merchName");
    const prices = document.querySelectorAll(".merchPrice");

    // Update data lokal dengan validasi
    merchData = Array.from(names).map((nameInput, i) => {
      const name = nameInput.value.trim();
      const price = prices[i].value.trim();
      const priceNumber = parseFloat(price);
      
      return {
        id: merchData[i]?.id || null,
        name: name,
        price: priceNumber,
        image: merchData[i]?.image || ""
      };
    });

    // Validasi data
    const invalidData = merchData.filter(item => !item.name || isNaN(item.price) || item.price <= 0);
    if (invalidData.length > 0) {
      alert("❌ Semua produk harus memiliki:\n- Nama tidak boleh kosong\n- Harga harus angka lebih dari 0");
      return;
    }

    // Show loading
    const saveBtn = document.getElementById("saveMerchBtn");
    const originalText = saveBtn.innerHTML;
    saveBtn.innerHTML = "⏳ Menyimpan...";
    saveBtn.disabled = true;

    try {
      console.log('Sending data:', merchData);
      
      const response = await fetch('../merch/upload_merch.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify(merchData)
      });
      
      // Handle response
      const responseText = await response.text();
      console.log('Raw response:', responseText);
      
      let result;
      try {
        result = JSON.parse(responseText);
      } catch (parseError) {
        console.error('JSON Parse Error:', parseError);
        // Coba debug apa yang dikembalikan server
        if (responseText.includes('error') || responseText.includes('Error')) {
          throw new Error('Server error: ' + responseText.substring(0, 200));
        } else {
          throw new Error('Response tidak valid dari server. Pastikan file PHP benar.');
        }
      }
      
      if (result.success) {
        alert("✅ Data merchandise berhasil disimpan!");
        await loadMerchData(); // Reload data fresh dari database
      } else {
        throw new Error(result.message || 'Terjadi kesalahan saat menyimpan');
      }
      
    } catch (error) {
      console.error('Save error:', error);
      alert("❌ Error menyimpan data: " + error.message);
    } finally {
      // Reset button
      saveBtn.innerHTML = originalText;
      saveBtn.disabled = false;
    }
  });

  // Debug function untuk testing
  async function testConnection() {
    try {
      console.log('Testing connection to get_merch.php...');
      const response = await fetch('../merch/get_merch.php');
      const text = await response.text();
      console.log('Test response:', text);
    } catch (error) {
      console.error('Test connection failed:', error);
    }
  }

  // Load data saat pertama kali
  loadMerchData();
  // testConnection(); // Uncomment untuk debugging
  break;

    }
  });
});
</script>

</body>
</html>
