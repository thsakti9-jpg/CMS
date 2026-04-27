# Bento CMS Blog - PHP Native

Aplikasi CMS Blog sederhana yang dikembangkan menggunakan PHP Native, MySQL, dan JavaScript (Fetch API).

## Fitur Utama
- **CRUD Asynchronous**: Semua operasi tulis/baca dilakukan tanpa reload halaman.
- **Modern UI**: Menggunakan Bootstrap 5 dengan desain dashboard yang bersih.
- **Keamanan**:
  - Hashing password dengan Bcrypt.
  - Prepared Statements (mysqli) untuk mencegah SQL Injection.
  - Validasi File Upload (MIME Check dengan finfo).
  - Pembatasan ukuran upload (max 2MB).
  - Proteksi folder upload dengan `.htaccess`.
- **Relasi Database**: Validasi penghapusan data (tidak bisa hapus penulis/kategori jika masih ada artikel terkait).

## Cara Instalasi (Localhost/XAMPP)
1. Pindahkan seluruh folder `blog/` ke dalam direktori `htdocs` XAMPP Anda.
2. Jalankan Apache dan MySQL melalui XAMPP Control Panel.
3. Buka **phpMyAdmin** (`http://localhost/phpmyadmin`).
4. Buat database baru bernama `db_blog`.
5. Import file `db_blog.sql` yang tersedia di dalam folder aplikasi.
6. Sesuaikan konfigurasi database di `koneksi.php` jika diperlukan (default: blank password).
7. Akses aplikasi melalui browser di: `http://localhost/blog/`.

## Struktur Folder
```text
blog/
├── index.php             (Frontend Utama + JS Fetch)
├── koneksi.php           (Koneksi MySQL)
├── db_blog.sql           (Skema Database)
├── *.php                 (Backend CRUD APIs)
├── uploads_penulis/      (Folder Foto Penulis)
└── uploads_artikel/      (Folder Gambar Artikel)
```
