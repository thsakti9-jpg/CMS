-- Database: db_blog
CREATE DATABASE IF NOT EXISTS db_blog;
USE db_blog;

-- Table Penulis
CREATE TABLE IF NOT EXISTS penulis (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_depan VARCHAR(50) NOT NULL,
    nama_belakang VARCHAR(50) NOT NULL,
    user_name VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    foto VARCHAR(255) DEFAULT 'default.png'
);

-- Table Kategori Artikel
CREATE TABLE IF NOT EXISTS kategori_artikel (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_kategori VARCHAR(100) NOT NULL,
    keterangan TEXT
);

-- Table Artikel
CREATE TABLE IF NOT EXISTS artikel (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_penulis INT NOT NULL,
    id_kategori INT NOT NULL,
    judul VARCHAR(255) NOT NULL,
    isi TEXT NOT NULL,
    gambar VARCHAR(255) NOT NULL,
    hari_tanggal DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_penulis) REFERENCES penulis(id),
    FOREIGN KEY (id_kategori) REFERENCES kategori_artikel(id)
);

-- Insert Default Data for Testing
INSERT INTO kategori_artikel (id, nama_kategori, keterangan) VALUES (1, 'Umum', 'Kategori Berita Umum');
INSERT INTO penulis (id, nama_depan, nama_belakang, user_name, password, foto) VALUES (1, 'Admin', 'User', 'admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'default.png'); -- password: password
INSERT INTO artikel (id, id_penulis, id_kategori, judul, isi, gambar, hari_tanggal) VALUES (1, 1, 1, 'Selamat Datang di CMS Blog!', 'Ini adalah artikel pertama kontribusi dari sistem.', 'default_article.jpg', '2023-10-27 10:00:00');
