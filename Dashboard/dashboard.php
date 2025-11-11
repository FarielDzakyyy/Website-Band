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
        max-width:850px;
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
          <p style="color:#aaa;font-size:14px;margin:0;">Atur teks dan tampilan bagian utama (hero) halaman depan website band kamu.</p>
        </div>

        <form id="berandaForm" style="display:flex;flex-direction:column;gap:18px;">
          
          <div>
            <label style="color:#d6792f;font-weight:bold;">📝 Judul Hero Section</label>
            <input type="text" id="judulHero" placeholder="Masukkan judul utama"
              style="width:100%;padding:10px;background:#2b2b2b;border:1px solid #444;border-radius:8px;color:#fff;margin-top:6px;">
          </div>

          <div>
            <label style="color:#d6792f;font-weight:bold;">💬 Deskripsi</label>
            <textarea rows="4" id="deskripsiHero" placeholder="Masukkan teks beranda..."
              style="width:100%;padding:10px;background:#2b2b2b;border:1px solid #444;border-radius:8px;color:#fff;margin-top:6px;resize:vertical;"></textarea>
          </div>

          <div>
            <label style="color:#d6792f;font-weight:bold;">🔘 Teks Tombol (CTA)</label>
            <input type="text" id="ctaText" placeholder="Misal: AGENDA EVENT"
              style="width:100%;padding:10px;background:#2b2b2b;border:1px solid #444;border-radius:8px;color:#fff;margin-top:6px;">
          </div>

          <div>
            <label style="color:#d6792f;font-weight:bold;">🔗 Link Tombol (CTA URL)</label>
            <input type="text" id="ctaLink" placeholder="../agenda/agenda.html"
              style="width:100%;padding:10px;background:#2b2b2b;border:1px solid #444;border-radius:8px;color:#fff;margin-top:6px;">
          </div>

          <div>
            <label style="color:#d6792f;font-weight:bold;">🖼️ Gambar Hero</label>
            <input type="file" id="heroImage" accept="image/*"
              style="display:block;margin-top:10px;color:#ccc;">
          </div>

          <div id="heroPreviewContainer" style="display:none;text-align:center;margin-top:10px;">
            <img id="previewHero" style="width:300px;border-radius:12px;border:2px solid #333;object-fit:cover;">
            <br>
            <button type="button" id="deleteHeroImage" style="
              background:#dc3545;
              color:white;
              border:none;
              padding:8px 14px;
              border-radius:8px;
              cursor:pointer;
              font-weight:600;
              margin-top:10px;
            ">🗑️ Hapus Foto</button>
          </div>

          <div style="text-align:right;margin-top:25px;">
            <button type="submit" style="
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
              💾 Simpan Perubahan
            </button>
          </div>
        </form>
      </div>
    </section>
  `;

  const judulInput = document.getElementById("judulHero");
  const deskripsiInput = document.getElementById("deskripsiHero");
  const ctaText = document.getElementById("ctaText");
  const ctaLink = document.getElementById("ctaLink");
  const heroImage = document.getElementById("heroImage");
  const previewContainer = document.getElementById("heroPreviewContainer");
  const preview = document.getElementById("previewHero");
  const deleteBtn = document.getElementById("deleteHeroImage");

  // Load data dari localStorage
  judulInput.value = localStorage.getItem("judulHero") || "";
  deskripsiInput.value = localStorage.getItem("deskripsiHero") || "";
  ctaText.value = localStorage.getItem("ctaText") || "";
  ctaLink.value = localStorage.getItem("ctaLink") || "";
  const imgData = localStorage.getItem("heroImage");

  if (imgData) {
    preview.src = imgData;
    previewContainer.style.display = "block";
  }

  heroImage.addEventListener("change", e => {
    const file = e.target.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = () => {
        preview.src = reader.result;
        previewContainer.style.display = "block";
      };
      reader.readAsDataURL(file);
    }
  });

  deleteBtn.addEventListener("click", () => {
    if (confirm("Yakin ingin menghapus foto hero?")) {
      localStorage.removeItem("heroImage");
      preview.src = "";
      previewContainer.style.display = "none";
      heroImage.value = "";
    }
  });

  document.getElementById("berandaForm").addEventListener("submit", e => {
    e.preventDefault();
    localStorage.setItem("judulHero", judulInput.value);
    localStorage.setItem("deskripsiHero", deskripsiInput.value);
    localStorage.setItem("ctaText", ctaText.value);
    localStorage.setItem("ctaLink", ctaLink.value);
    if (preview.src) localStorage.setItem("heroImage", preview.src);
    alert("✅ Perubahan Beranda berhasil disimpan!");
  });
  break;

      // === MEMBER ===
      case "member":
  main.innerHTML = `
    <header class="topbar"><h1>Kelola Member Band</h1></header>
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
          <h2 style="font-size:1.5rem;color:#fff;font-weight:600;margin-bottom:6px;text-align:left;">
            👥 Manajemen Member Band
          </h2>
          <p style="color:#aaa;font-size:14px;margin:0;text-align:left;">
            Tambah, ubah, dan kelola anggota band kamu di sini.
          </p>
        </div>

        <!-- Tombol Tambah -->
        <button id="addMemberBtn" style="
          background:#d6792f;
          color:white;
          border:none;
          padding:10px 18px;
          border-radius:8px;
          cursor:pointer;
          font-weight:600;
          transition:0.3s;
          margin-bottom:20px;
        " onmouseover="this.style.background='#e88b42';"
          onmouseout="this.style.background='#d6792f';">
          ➕ Tambah Member
        </button>

        <!-- Daftar Member -->
        <ul id="memberList" style="list-style:none;padding:0;display:flex;flex-direction:column;gap:18px;"></ul>

        <!-- Tombol Simpan -->
        <div style="text-align:right;margin-top:25px;">
          <button id="saveMemberBtn" style="
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
            💾 Simpan Perubahan
          </button>
        </div>

      </div>
    </section>
  `;

  let members = JSON.parse(localStorage.getItem("members")) || [];
  const list = document.getElementById("memberList");

  function renderMembers() {
    list.innerHTML = "";

    if (members.length === 0) {
      list.innerHTML = `<p style="color:#ccc;text-align:center;">Belum ada member ditambahkan.</p>`;
      return;
    }

    members.forEach((m, i) => {
      const li = document.createElement("li");
      li.style = `
        background:#2b2b2b;
        border:1px solid #444;
        border-radius:10px;
        padding:18px;
        display:flex;
        flex-wrap:wrap;
        align-items:center;
        gap:14px;
        justify-content:space-between;
        box-shadow:0 0 6px rgba(0,0,0,0.3);
      `;

      li.innerHTML = `
        <div style="flex:1;min-width:200px;display:flex;flex-direction:column;gap:10px;">
          <div>
            <label style="color:#d6792f;font-weight:bold;">👤 Nama:</label><br>
            <input type="text" class="name" data-index="${i}" value="${m.name || ''}" placeholder="Nama member"
              style="width:100%;padding:8px;background:#1e1e1e;border:1px solid #555;border-radius:6px;color:#fff;">
          </div>
          <div>
            <label style="color:#d6792f;font-weight:bold;">🎸 Posisi:</label><br>
            <input type="text" class="role" data-index="${i}" value="${m.role || ''}" placeholder="Posisi di band"
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
          <button class="deleteMember" data-index="${i}" style="
            background:#dc3545;
            color:white;
            border:none;
            padding:6px 12px;
            border-radius:6px;
            cursor:pointer;
            font-weight:600;
          ">🗑️ Hapus</button>
        </div>
      `;

      list.appendChild(li);
    });

    // Tombol hapus member
    document.querySelectorAll(".deleteMember").forEach(btn => {
      btn.addEventListener("click", e => {
        const idx = e.target.dataset.index;
        if (confirm("Yakin hapus member ini?")) {
          members.splice(idx, 1);
          renderMembers();
        }
      });
    });

    // Ubah foto member
    document.querySelectorAll(".photo").forEach(input => {
      input.addEventListener("change", e => {
        const idx = e.target.dataset.index;
        const file = e.target.files[0];
        if (file) {
          const reader = new FileReader();
          reader.onload = () => {
            members[idx].photo = reader.result;
            renderMembers();
          };
          reader.readAsDataURL(file);
        }
      });
    });
  }

  renderMembers();

  document.getElementById("addMemberBtn").addEventListener("click", () => {
    members.push({ name: "", role: "", photo: "" });
    renderMembers();
  });

  document.getElementById("saveMemberBtn").addEventListener("click", () => {
    const names = document.querySelectorAll(".name");
    const roles = document.querySelectorAll(".role");

    members = Array.from(names).map((_, i) => ({
      name: names[i].value,
      role: roles[i].value,
      photo: members[i].photo || ""
    }));

    localStorage.setItem("members", JSON.stringify(members));
    alert("✅ Data Member berhasil disimpan!\n👥 Lihat hasil di halaman member.html");
  });
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
        text-align:left; /* seluruh isi card jadi rata kiri */
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
            Atur gambar utama, isi sejarah, dan daftar anggota band kamu di sini.
          </p>
        </div>

        <!-- Upload Gambar -->
        <div style="margin-bottom:20px;text-align:left;">
          <label style="color:#d6792f;font-weight:bold;">📸 Gambar Utama:</label><br>
          <input type="file" id="historyImage" accept="image/*" 
            style="margin-top:8px;background:#2b2b2b;border:1px solid #444;color:#ccc;padding:8px;border-radius:6px;width:100%;">
          
          <div id="previewContainer" style="display:none;margin-top:15px;">
            <img id="historyPreview" style="width:250px;border-radius:12px;border:1px solid #444;object-fit:cover;display:block;margin-bottom:10px;">
            <button id="deleteHistoryImage" style="
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

        <!-- Daftar Anggota -->
        <div style="margin-bottom:25px;text-align:left;">
          <label style="color:#d6792f;font-weight:bold;">🎸 Daftar Anggota:</label><br>
          <textarea id="historyList" rows="4" placeholder="Contoh: Malfa (Vocalist)&#10;Navarro (Keyboardist)" 
            style="width:100%;margin-top:6px;padding:10px;background:#2b2b2b;border:1px solid #444;color:#fff;border-radius:6px;resize:vertical;"></textarea>
        </div>

        <!-- Tombol Simpan -->
        <div style="text-align:right;">
          <button id="saveHistoryBtn" style="
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
      </div>
    </section>
  `;

  // === Logika JavaScript ===
  const historyImage = document.getElementById("historyImage");
  const previewH = document.getElementById("historyPreview");
  const previewContainerH = document.getElementById("previewContainer");
  const deleteBtnH = document.getElementById("deleteHistoryImage");
  const introInput = document.getElementById("historyIntro");
  const contentInput = document.getElementById("historyContent");
  const listInput = document.getElementById("historyList");

  const savedHistory = JSON.parse(localStorage.getItem("historyData")) || {};
  if (savedHistory.image) {
    previewH.src = savedHistory.image;
    previewContainerH.style.display = "block";
  }
  introInput.value = savedHistory.intro || "";
  contentInput.value = savedHistory.content || "";
  listInput.value = savedHistory.list || "";

  // Upload dan preview gambar
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

  // Hapus gambar
  deleteBtnH.addEventListener("click", () => {
    if (confirm("Hapus gambar history ini?")) {
      previewH.src = "";
      previewContainerH.style.display = "none";
      localStorage.removeItem("historyImage");
    }
  });

  // Simpan data
  document.getElementById("saveHistoryBtn").addEventListener("click", () => {
    const data = {
      image: previewH.src || "",
      intro: introInput.value,
      content: contentInput.value,
      list: listInput.value
    };
    localStorage.setItem("historyData", JSON.stringify(data));
    alert("✅ Data History berhasil disimpan!\n📜 Lihat hasil di halaman history.html");
  });
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
            <button id="addAgendaBtn" style="
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

        <!-- Tombol Simpan -->
        <div style="margin-top:25px;text-align:right;">
          <button id="saveAgendaBtn" style="
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
            💾 Simpan Agenda
          </button>
        </div>
      </div>
    </section>
  `;

  let agendaData = JSON.parse(localStorage.getItem("agendaData")) || [];
  const listA = document.getElementById("agendaList");

  function renderAgenda() {
    listA.innerHTML = "";

    if (agendaData.length === 0) {
      listA.innerHTML = `<p style="color:#ccc;text-align:center;">Belum ada agenda ditambahkan.</p>`;
      return;
    }

    agendaData.forEach((a, i) => {
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
            <input type="date" class="date" data-index="${i}" value="${a.date}" 
              style="background:#1e1e1e;color:white;border:1px solid #555;padding:6px 10px;border-radius:6px;width:100%;">
          </div>

          <div>
            <label style="color:#d6792f;font-weight:bold;">🎤 Judul Acara:</label><br>
            <input type="text" class="title" data-index="${i}" value="${a.title}" placeholder="Judul event" 
              style="background:#1e1e1e;color:white;border:1px solid #555;padding:6px 10px;border-radius:6px;width:100%;">
          </div>

          <div>
            <label style="color:#d6792f;font-weight:bold;">📍 Lokasi:</label><br>
            <input type="text" class="location" data-index="${i}" value="${a.location}" placeholder="Lokasi acara" 
              style="background:#1e1e1e;color:white;border:1px solid #555;padding:6px 10px;border-radius:6px;width:100%;">
          </div>
        </div>

        <div style="display:flex;flex-direction:column;align-items:center;gap:10px;">
          <div style="text-align:center;">
            <label style="color:#d6792f;font-weight:bold;">📸 Foto Agenda:</label><br>
            <input type="file" class="photo" data-index="${i}" accept="image/*" style="margin-top:6px;">
          </div>
          <img src="${a.image || '../kumpulan foto dan icon/default.jpg'}" 
               style="width:120px;height:120px;object-fit:cover;border-radius:10px;border:1px solid #555;">
          <button class="deleteAgenda" data-index="${i}" 
            style="background:#dc3545;color:white;border:none;padding:6px 12px;border-radius:6px;cursor:pointer;">
            🗑️ Hapus
          </button>
        </div>
      `;
      listA.appendChild(item);
    });

    document.querySelectorAll(".photo").forEach(input => {
      input.addEventListener("change", e => {
        const idx = e.target.dataset.index;
        const file = e.target.files[0];
        if (file) {
          const reader = new FileReader();
          reader.onload = () => {
            agendaData[idx].image = reader.result;
            renderAgenda();
          };
          reader.readAsDataURL(file);
        }
      });
    });

    document.querySelectorAll(".deleteAgenda").forEach(btn => {
      btn.addEventListener("click", e => {
        const idx = e.target.dataset.index;
        if (confirm("Yakin hapus agenda ini?")) {
          agendaData.splice(idx, 1);
          renderAgenda();
        }
      });
    });
  }

  renderAgenda();

  document.getElementById("addAgendaBtn").addEventListener("click", () => {
    agendaData.push({ date: "", title: "", location: "", image: "" });
    renderAgenda();
  });

  document.getElementById("saveAgendaBtn").addEventListener("click", () => {
    const dates = document.querySelectorAll(".date");
    const titles = document.querySelectorAll(".title");
    const locs = document.querySelectorAll(".location");

    agendaData = Array.from(dates).map((_, i) => ({
      date: dates[i].value,
      title: titles[i].value,
      location: locs[i].value,
      image: agendaData[i].image || ""
    }));

    localStorage.setItem("agendaData", JSON.stringify(agendaData));
    alert("✅ Data Agenda berhasil disimpan!\n📅 Lihat hasil di halaman agenda.html");
  });
  break;

 // === Gallery === 
case "gallery":
  main.innerHTML = `
    <header class="topbar">
      <h1 style="font-size:1.8rem; color:#222;">Kelola Galeri</h1>
    </header>

    <section class="content-section">
      <div class="card" 
           style="background:#111; padding:25px; border-radius:18px; box-shadow:0 4px 10px rgba(0,0,0,0.3);">
        
        <!-- Header Manajemen Galeri -->
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
                    style="background:#d6792f; color:white; border:none; padding:9px 18px; border-radius:8px; cursor:pointer; font-weight:600; transition:0.3s;">
              📤 Upload
            </button>
          </div>
        </div>

        <!-- Galeri -->
        <div id="galleryPreview" 
             style="display:grid; grid-template-columns:repeat(auto-fill,minmax(160px,1fr)); gap:18px;">
        </div>
      </div>
    </section>
  `;

  const galleryPreview = document.getElementById("galleryPreview");
  let galleryData = JSON.parse(localStorage.getItem("galleryData")) || [];

  // Fungsi render ulang tampilan galeri
  function renderGallery() {
    galleryPreview.innerHTML = "";

    if (galleryData.length === 0) {
      galleryPreview.innerHTML = `<p style="color:#777; text-align:center; grid-column:1 / -1;">Belum ada gambar di galeri.</p>`;
      return;
    }

    galleryData.forEach((src, i) => {
      const wrapper = document.createElement("div");
      wrapper.className = "gallery-item";
      wrapper.style.position = "relative";
      wrapper.style.overflow = "hidden";
      wrapper.style.borderRadius = "12px";
      wrapper.style.boxShadow = "0 4px 10px rgba(0,0,0,0.5)";
      wrapper.style.transition = "transform 0.3s ease";

      const img = document.createElement("img");
      img.src = src;
      img.alt = "Foto Galeri";
      img.style.width = "100%";
      img.style.height = "160px";
      img.style.objectFit = "cover";
      img.style.display = "block";

      const delBtn = document.createElement("button");
      delBtn.innerHTML = "🗑️";
      delBtn.title = "Hapus gambar ini";
      delBtn.style.position = "absolute";
      delBtn.style.top = "8px";
      delBtn.style.right = "8px";
      delBtn.style.background = "rgba(0,0,0,0.6)";
      delBtn.style.color = "#fff";
      delBtn.style.border = "none";
      delBtn.style.cursor = "pointer";
      delBtn.style.borderRadius = "6px";
      delBtn.style.padding = "5px 7px";
      delBtn.style.transition = "0.2s";

      delBtn.addEventListener("mouseover", () => (delBtn.style.background = "rgba(255,0,0,0.7)"));
      delBtn.addEventListener("mouseout", () => (delBtn.style.background = "rgba(0,0,0,0.6)"));

      wrapper.addEventListener("mouseenter", () => (wrapper.style.transform = "scale(1.04)"));
      wrapper.addEventListener("mouseleave", () => (wrapper.style.transform = "scale(1)"));

      delBtn.addEventListener("click", (e) => {
        e.stopPropagation();
        if (confirm("Yakin ingin menghapus gambar ini?")) {
          galleryData.splice(i, 1);
          localStorage.setItem("galleryData", JSON.stringify(galleryData));
          renderGallery();
        }
      });

      wrapper.appendChild(img);
      wrapper.appendChild(delBtn);
      galleryPreview.appendChild(wrapper);
    });
  }

  // Render pertama kali
  renderGallery();

  // Upload gambar baru
  document.getElementById("uploadBtn").addEventListener("click", () => {
    const files = document.getElementById("uploadGallery").files;
    if (!files.length) return alert("📁 Pilih gambar terlebih dahulu!");

    Array.from(files).forEach(file => {
      const reader = new FileReader();
      reader.onload = e => {
        galleryData.push(e.target.result);
        localStorage.setItem("galleryData", JSON.stringify(galleryData));
        renderGallery();
      };
      reader.readAsDataURL(file);
    });

    alert("✅ Gambar berhasil ditambahkan!");
    document.getElementById("uploadGallery").value = "";
  });
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

  let merchData = JSON.parse(localStorage.getItem("merchData")) || [];
  const merchList = document.getElementById("merchList");

  function renderMerch() {
    merchList.innerHTML = "";

    if (merchData.length === 0) {
      merchList.innerHTML = `<p style="color:#aaa;text-align:center;">Belum ada produk merchandise.</p>`;
      return;
    }

    merchData.forEach((m, i) => {
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

            <button class="deleteMerch" data-index="${i}" 
                    style="width:100%;background:#dc3545;color:white;border:none;padding:8px;border-radius:8px;cursor:pointer;">🗑️ Hapus Produk</button>
          </div>
        </div>
      `;
    });

    // === Ganti gambar ===
    document.querySelectorAll(".merchPhoto").forEach(input => {
      input.addEventListener("change", e => {
        const idx = e.target.dataset.index;
        const file = e.target.files[0];
        if (file) {
          const reader = new FileReader();
          reader.onload = () => {
            merchData[idx].image = reader.result;
            renderMerch();
          };
          reader.readAsDataURL(file);
        }
      });
    });

    // === Hapus produk ===
    document.querySelectorAll(".deleteMerch").forEach(btn => {
      btn.addEventListener("click", e => {
        const idx = e.target.dataset.index;
        if (confirm("Yakin ingin menghapus produk ini?")) {
          merchData.splice(idx, 1);
          renderMerch();
        }
      });
    });
  }

  renderMerch();

  // === Tambah Produk Baru ===
  document.getElementById("addMerchBtn").addEventListener("click", () => {
    merchData.push({ name: "", price: "", image: "" });
    renderMerch();
  });

  // === Simpan ke LocalStorage ===
  document.getElementById("saveMerchBtn").addEventListener("click", () => {
    const names = document.querySelectorAll(".merchName");
    const prices = document.querySelectorAll(".merchPrice");

    merchData = Array.from(names).map((_, i) => ({
      name: names[i].value.trim(),
      price: prices[i].value.trim(),
      image: merchData[i].image || ""
    }));

    localStorage.setItem("merchData", JSON.stringify(merchData));
    alert("✅ Data merchandise berhasil disimpan!\n🛍️ Cek hasil di halaman merch.html");
  });
  break;

    }
  });
});
</script>

</body>
</html>
