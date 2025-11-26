<?php 
session_start(); 
// Jika halaman ini bisa diakses publik tanpa login, baris check session di bawah bisa dihapus/dikomentari
/* if (!isset($_SESSION['username'])) { 
    header("Location: ../Register dan login/login.php"); 
    exit; 
} 
*/

require_once 'db.php';

// --- FUNGSI HELPER UNTUK MENCEGAH ERROR UNDEFINED ---
function getVal($arr, $key, $default = '') {
    return isset($arr[$key]) && !empty($arr[$key]) ? htmlspecialchars($arr[$key]) : $default;
}

// Ambil data dari database
$sql = "SELECT * FROM beranda";
$result = $conn->query($sql);

$berandaData = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $berandaData[$row['section_type']] = $row;
    }
}

// Inisialisasi variabel section dengan data default kosong jika DB kosong
$hero = $berandaData['hero'] ?? [];
$gallery = $berandaData['gallery'] ?? [];
$history = $berandaData['history'] ?? [];
$news = $berandaData['news'] ?? [];
$merch = $berandaData['merch'] ?? [];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dua Serupa Official</title>
    <link rel="stylesheet" href="beranda.css">
</head>
<body>
    <header>
        <nav class="navbar">
            <div class="logo">
                <img src="../kumpulan foto dan icon/logo ds.png" alt="Dua Serupa Logo" class="logo-img">
            </div>
            <ul class="nav-links">
                <li><a href="../beranda/beranda.php" class="active">HOME</a></li>
                <li><a href="../member/member.php">MEMBER</a></li>
                <li><a href="../history/history.php">HISTORY</a></li>
                <li><a href="../music/music.php">MUSIC</a></li>
                <li><a href="../agenda/agenda.php">AGENDA</a></li>
                <li><a href="../gallery/gallery.php">GALLERY</a></li>
                <li><a href="../merch/merch.php">MERCH</a></li>
                <li><a href="../Booking/booking.php">BOOKING</a></li>
            </ul>
        </nav>
    </header>

    <?php 
        // Logic gambar: Prioritas gambar DB, fallback ke default
        $heroBg = !empty($hero['image']) ? $hero['image'] : '../kumpulan foto dan icon/Foto band.jpg';
    ?>
    <section class="hero" style="background-image: url('<?= $heroBg ?>'); background-size: cover; background-position: center;">
        <div class="hero-text">
            <h1><?= getVal($hero, 'title', 'Selamat datang,<br>di official website Dua Serupa') ?></h1>
            <p><?= getVal($hero, 'content', 'Hi DS Lovers, dapatkan informasi official paling up to date dari Dua Serupa hanya disini') ?></p>
            <a href="<?= !empty($hero['button_link']) ? $hero['button_link'] : '../agenda/agenda.php' ?>" class="btn">
                <?= getVal($hero, 'button_text', 'AGENDA EVENT') ?>
            </a>
        </div>
    </section>

    <section class="gallery">
        <h2><?= getVal($gallery, 'title', 'GALLERY') ?></h2>
        <div class="gallery-container">
            <?php
            $displayedImages = 0;
            
            // Decode JSON Gallery
            if (!empty($gallery['gallery_images'])) {
                $galleryImages = json_decode($gallery['gallery_images'], true);
                
                // Pastikan hasil decode adalah array yang valid
                if (is_array($galleryImages) && count($galleryImages) > 0) {
                    foreach ($galleryImages as $image) {
                        if ($displayedImages < 3) {
                            // Pastikan path gambar valid
                            echo '<img src="' . htmlspecialchars($image) . '" alt="Gallery Image" style="object-fit:cover;">';
                            $displayedImages++;
                        }
                    }
                }
            }
            
            // Tampilkan gambar default jika user belum upload gambar gallery
            while ($displayedImages < 3) {
                echo '<img src="../kumpulan foto dan icon/Foto band.jpg" alt="Gallery Default">';
                $displayedImages++;
            }
            ?>
        </div>
    </section>

    <section class="history">
        <h2><?= getVal($history, 'title', 'HISTORY') ?></h2>
        <div style="max-width: 800px; margin: 0 auto;">
            <p>
                <?= !empty($history['content']) ? nl2br(htmlspecialchars($history['content'])) : 'Dua Serupa yang sekarang adalah Band of Eross (guitar), Duta (vocal), Adam (bass). "B.E.D.A." Well, they are.. different :)' ?>
            </p>
        </div>
        <?php if (!empty($history['button_link'])): ?>
            <br>
            <a href="<?= $history['button_link'] ?>" class="more">Baca Selengkapnya &gt;</a>
        <?php endif; ?>
    </section>

    <section class="events">
        <h2>Booking</h2>
        <a href="../booking/booking.php" class="btn">Booking</a>
    </section>

    <section class="news">
        <h2><?= getVal($news, 'title', 'NEWS UPDATE') ?></h2>
        <div class="news-container">
            <div class="main-news">
                <?php $newsImg = !empty($news['image']) ? $news['image'] : '../kumpulan foto dan icon/Foto band.jpg'; ?>
                <img src="<?= $newsImg ?>" alt="News Main">
                <p><?= getVal($news, 'content', 'Dua Serupa Bagikan Kisah Memori Baik') ?></p>
            </div>
            <div class="side-news">
                <div class="news-item">
                    <img src="../kumpulan foto dan icon/Foto band.jpg" alt="News 1">
                    <p>DUA SERUPA Telah merilis singel ke-3 berjudul "DREAMER"</p>
                </div>
                <div class="news-item">
                    <img src="../kumpulan foto dan icon/Foto band.jpg" alt="News 2">
                    <p>DUA SERUPA Telah merilis singel ke-3 berjudul "DREAMER"</p>
                </div>
                <div class="news-item">
                    <img src="../kumpulan foto dan icon/Foto band.jpg" alt="News 3">
                    <p>DUA SERUPA Telah merilis singel ke-3 berjudul "DREAMER"</p>
                </div>
            </div>
        </div>
    </section>

    <section class="merch">
        <div class="merch-left">
            <?php $merchImg = !empty($merch['image']) ? $merch['image'] : '../kumpulan foto dan icon/logo ds.png'; ?>
            <img src="<?= $merchImg ?>" alt="Merch Image">
        </div>
        <div class="merch-right">
            <h2><?= getVal($merch, 'title', 'Official Merch') ?></h2>
            <?php
            if (!empty($merch['content'])) {
                $lines = explode("\n", $merch['content']);
                foreach ($lines as $line) {
                    if (!empty(trim($line))) {
                        echo '<p>' . htmlspecialchars($line) . '</p>';
                    }
                }
            } else {
                echo '
                    <p>Official Merchandise Dua Serupa hanya bisa didapatkan melalui official website kami.</p>
                    <p>Jaminan 100% Original Merchandise</p>
                    <p>- Dua Serupa</p>
                ';
            }
            ?>
        </div>
    </section>

    <footer>
        <div class="footer-container">
            <div class="footer-left">
                <img src="../kumpulan foto dan icon/logo ds.png" alt="Logo" class="logo" />
                <p>Musik bukan sekadar nada,tapi bahasa jiwa yang sejati adanya.</p>
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
                    <li><a href="../history/history.php">History</a></li>
                    <li><a href="../member/member.php">Member</a></li>
                    <li><a href="../music/music.php">Music</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>© 2025 Semua Hak Dilindungi</p>
        </div>
    </footer>
</body>
</html>
<?php $conn->close(); ?>