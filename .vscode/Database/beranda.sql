CREATE TABLE IF NOT EXISTS beranda (
    id INT AUTO_INCREMENT PRIMARY KEY,
    section_type VARCHAR(50) NOT NULL UNIQUE, -- hero, gallery, history, news, merch
    title VARCHAR(255),
    content TEXT,
    image VARCHAR(255),
    button_text VARCHAR(100),
    button_link VARCHAR(255),
    gallery_images TEXT, -- Menyimpan array JSON gambar gallery
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);