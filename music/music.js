// Placeholder for future interactions like hover animations or logo transitions
const playButtons = document.querySelectorAll('.play-btn');

playButtons.forEach(btn => {
  btn.addEventListener('click', () => {
    const audioId = btn.getAttribute('data-audio');
    const audio = document.getElementById(audioId);
    const progress = btn.parentElement.querySelector('.progress');
    const timeLabel = btn.parentElement.querySelector('.time');

    // Pause semua audio lain
    document.querySelectorAll('audio').forEach(a => {
      if (a !== audio) {
        a.pause();
        a.currentTime = 0;
        const otherBtn = document.querySelector(`[data-audio="${a.id}"]`);
        if (otherBtn) otherBtn.textContent = '▶';
      }
    });

    // Toggle play/pause
    if (audio.paused) {
      audio.play();
      btn.textContent = '⏸';
    } else {
      audio.pause();
      btn.textContent = '▶';
    }

    // Update progress bar dan waktu
    audio.addEventListener('timeupdate', () => {
      const progressPercent = (audio.currentTime / audio.duration) * 100;
      progress.style.width = `${progressPercent}%`;

      // Format waktu (menit:detik)
      const minutes = Math.floor(audio.currentTime / 60);
      const seconds = Math.floor(audio.currentTime % 60)
        .toString()
        .padStart(2, '0');
      timeLabel.textContent = `${minutes}:${seconds}`;
    });

    // Reset setelah lagu selesai
    audio.addEventListener('ended', () => {
      btn.textContent = '▶';
      progress.style.width = '0%';
      timeLabel.textContent = '0:00';
    });
  });
});

