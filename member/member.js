// member.js
const container = document.querySelector(".member-container");
const members = JSON.parse(localStorage.getItem("members")) || [];

if (members.length > 0) {
  container.innerHTML = "";
  members.forEach(m => {
    const div = document.createElement("div");
    div.className = "member-card";
    div.innerHTML = `
      <div class="member-visual">
        <img src="${m.photo || '../kumpulan foto dan icon/default.png'}" alt="${m.name}" class="member-photo-img">
      </div>
      <h3>${m.name || 'Nama Member'}</h3>
      <p>${m.role || 'Posisi'}</p>
    `;
    container.appendChild(div);
  });
}
