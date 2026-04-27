<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bento CMS Blog - Admin Panel</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --sidebar-width: 260px;
            --primary-color: #4361ee;
            --sidebar-bg: #15192b;
            --content-bg: #f4f7fe;
            --text-muted: #a3aed0;
            --card-shadow: 0px 20px 40px rgba(112, 144, 176, 0.08);
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--content-bg);
            color: #2b3674;
            overflow-x: hidden;
        }

        /* Sidebar Styles */
        #sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            background-color: var(--sidebar-bg);
            color: #fff;
            position: fixed;
            left: 0;
            top: 0;
            display: flex;
            flex-direction: column;
            z-index: 1000;
        }

        .brand-section {
            padding: 40px 30px;
        }

        .brand-title {
            font-size: 24px;
            font-weight: 800;
            font-style: italic;
            margin-bottom: 0;
        }

        .brand-title span {
            color: #4361ee;
        }

        .brand-subtitle {
            font-size: 10px;
            font-weight: 700;
            color: var(--text-muted);
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        #sidebar .nav-link {
            color: var(--text-muted);
            padding: 15px 25px;
            font-size: 14px;
            font-weight: 500;
            display: flex;
            align-items: center;
            margin: 5px 15px;
            border-radius: 12px;
            transition: all 0.3s;
            position: relative;
        }

        #sidebar .nav-link i {
            margin-right: 15px;
            font-size: 18px;
            width: 20px;
            text-align: center;
        }

        #sidebar .nav-link:hover {
            color: #fff;
            background: rgba(255, 255, 255, 0.05);
        }

        #sidebar .nav-link.active {
            background-color: rgba(255, 255, 255, 0.08);
            color: #fff;
            font-weight: 600;
        }

        #sidebar .nav-link.active::after {
            content: '';
            width: 6px;
            height: 6px;
            background-color: #6c5ce7;
            border-radius: 50%;
            position: absolute;
            right: 15px;
        }

        /* Profile Sidebar Section */
        .sidebar-profile {
            margin-top: auto;
            padding: 30px;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
            display: flex;
            align-items: center;
        }

        .avatar-circle {
            width: 40px;
            height: 40px;
            background: #4361ee;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 14px;
            margin-right: 12px;
        }

        .profile-info .name {
            font-size: 12px;
            font-weight: 700;
            line-height: 1;
        }

        .profile-info .status {
            font-size: 10px;
            color: #01b574;
            font-weight: 600;
        }

        /* Main Content */
        #main-content {
            margin-left: var(--sidebar-width);
            padding: 30px 40px;
            min-height: 100vh;
        }

        .header-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .breadcrumb {
            font-size: 14px;
            font-weight: 500;
            color: #707ebe;
            margin-bottom: 0;
        }

        .breadcrumb a {
            color: #707ebe;
            text-decoration: none;
        }

        .breadcrumb .active {
            color: #2b3674;
            font-weight: 700;
        }

        .server-badge {
            background: #111c44;
            color: #4361ee;
            font-size: 10px;
            font-weight: 700;
            padding: 8px 16px;
            border-radius: 8px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* Stat Cards */
        .stat-card {
            background: #fff;
            border-radius: 20px;
            padding: 25px;
            box-shadow: var(--card-shadow);
            border: none;
            height: 100%;
            display: flex;
            align-items: center;
        }

        .stat-card.active {
            background: #4361ee;
            color: #fff;
        }

        .stat-content {
            flex-grow: 1;
        }

        .stat-label {
            font-size: 11px;
            font-weight: 700;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 5px;
        }

        .stat-card.active .stat-label {
            color: rgba(255, 255, 255, 0.7);
        }

        .stat-value {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 0;
        }

        .stat-icon {
            width: 45px;
            height: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            color: var(--text-muted);
        }

        .stat-card.active .stat-icon {
            color: rgba(255, 255, 255, 0.7);
        }

        /* Welcome Section */
        .welcome-card {
            background: #fff;
            border-radius: 20px;
            padding: 60px;
            margin-top: 30px;
            box-shadow: var(--card-shadow);
            position: relative;
            overflow: hidden;
        }

        .welcome-card::after {
            content: '';
            position: absolute;
            right: 0;
            bottom: 0;
            width: 300px;
            height: 100%;
            background: url('https://www.transparenttextures.com/patterns/cubes.png');
            opacity: 0.03;
            pointer-events: none;
        }

        .welcome-card h1 {
            font-size: 44px;
            font-weight: 700;
            margin-bottom: 25px;
        }

        .welcome-card p {
            font-size: 18px;
            color: #707ebe;
            line-height: 1.6;
            max-width: 800px;
        }

        .welcome-card p u {
            color: #2b3674;
            font-weight: 700;
            text-decoration-thickness: 2px;
        }

        /* Data Section */
        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-bottom: 25px;
        }

        .section-header h2 {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .section-header p {
            font-size: 14px;
            color: var(--text-muted);
            margin-bottom: 0;
        }

        .btn-add {
            background: #4361ee;
            color: #fff;
            font-size: 14px;
            font-weight: 700;
            padding: 12px 25px;
            border-radius: 12px;
            border: none;
            box-shadow: 0px 4px 12px rgba(67, 97, 238, 0.3);
            transition: all 0.3s;
        }

        .btn-add:hover {
            background: #3950d1;
            color: #fff;
            transform: translateY(-2px);
        }

        /* Table Styles */
        .table-container {
            background: #fff;
            border-radius: 20px;
            box-shadow: var(--card-shadow);
            overflow: hidden;
            padding-bottom: 20px;
        }

        .table thead th {
            font-size: 10px;
            font-weight: 700;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 1.5px;
            padding: 25px 20px;
            border-bottom: 1px solid #f1f4f9;
        }

        .table tbody td {
            padding: 20px;
            font-size: 14px;
            vertical-align: middle;
            border-bottom: 1px solid #f1f4f9;
        }

        .badge-entity {
            background: #f4f7fe;
            color: #4361ee;
            font-size: 10px;
            font-weight: 700;
            padding: 6px 12px;
            border-radius: 10px;
            text-transform: uppercase;
        }

        .table .action-btn {
            color: var(--text-muted);
            font-size: 18px;
            transition: all 0.2s;
            margin: 0 5px;
            text-decoration: none;
        }

        .table .action-btn:hover {
            color: #4361ee;
        }

        .table .action-btn.delete:hover {
            color: #ee5d50;
        }

        /* Footer */
        .main-footer {
            margin-top: 50px;
            padding-top: 20px;
            border-top: 1px solid #e9edf7;
            display: flex;
            justify-content: space-between;
            font-size: 11px;
            font-weight: 600;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .main-footer span.bold {
            color: #2b3674;
            font-weight: 700;
        }

        /* Modal Customization */
        .modal-content {
            border-radius: 25px;
            border: none;
            padding: 10px;
        }

        .modal-header {
            border-bottom: none;
            padding: 30px 30px 10px;
        }

        .modal-title {
            font-weight: 700;
            color: #2b3674;
        }

        .modal-body {
            padding: 30px;
        }

        .form-label {
            font-size: 12px;
            font-weight: 700;
            color: #2b3674;
            margin-bottom: 10px;
        }

        .form-control, .form-select {
            border-radius: 12px;
            border: 1px solid #e0e5f2;
            padding: 12px 15px;
            font-size: 14px;
            color: #2b3674;
        }

        .form-control:focus {
            box-shadow: 0 0 0 4px rgba(67, 97, 238, 0.1);
            border-color: #4361ee;
        }

        .thumbnail-preview {
            width: 80px;
            height: 80px;
            background: #f4f7fe;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .thumbnail-preview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div id="sidebar">
        <div class="brand-section">
            <h1 class="brand-title">CMS<span>Blog</span></h1>
            <p class="brand-subtitle">PHP Native Edition</p>
        </div>
        
        <nav class="nav flex-column">
            <a class="nav-link active" href="#" onclick="showSection('dashboard')">
                <i class="fas fa-th-large"></i> Dashboard
            </a>
            <a class="nav-link" href="#" onclick="showSection('penulis')">
                <i class="fas fa-users"></i> Kelola Penulis
            </a>
            <a class="nav-link" href="#" onclick="showSection('artikel')">
                <i class="fas fa-file-alt"></i> Kelola Artikel
            </a>
            <a class="nav-link" href="#" onclick="showSection('kategori')">
                <i class="fas fa-layer-group"></i> Kelola Kategori
            </a>
        </nav>

        <div class="sidebar-profile">
            <div class="avatar-circle">AD</div>
            <div class="profile-info">
                <div class="name">Admin Panel</div>
                <div class="status"><i class="fas fa-circle me-1" style="font-size: 8px;"></i> SERVER ONLINE</div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div id="main-content">
        <header class="header-top">
            <nav class="breadcrumb">
                <a href="#">Bento CMS</a> &nbsp; / &nbsp; <span class="active" id="breadcrumb-active">Overview</span>
            </nav>
            <div class="server-badge">
                LOCALHOST: MYSQL
            </div>
        </header>

        <!-- Dynamic Content Area -->
        <div id="content-area">
            
            <!-- Dashboard Section -->
            <section id="section-dashboard">
                <div class="row g-4">
                    <div class="col-md-3">
                        <div class="stat-card">
                            <div class="stat-content">
                                <p class="stat-label">Total Artikel</p>
                                <h2 class="stat-value" id="stat-artikel">0</h2>
                            </div>
                            <div class="stat-icon"><i class="far fa-file-alt"></i></div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stat-card active">
                            <div class="stat-content">
                                <p class="stat-label">Penulis Aktif</p>
                                <h2 class="stat-value" id="stat-penulis">0</h2>
                            </div>
                            <div class="stat-icon"><i class="fas fa-users-cog"></i></div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stat-card">
                            <div class="stat-content">
                                <p class="stat-label">Kategori</p>
                                <h2 class="stat-value" id="stat-kategori">0</h2>
                            </div>
                            <div class="stat-icon"><i class="fas fa-layer-group"></i></div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stat-card">
                            <div class="stat-content">
                                <p class="stat-label">Storage</p>
                                <h2 class="stat-value">84%</h2>
                            </div>
                            <div class="stat-icon"><i class="fas fa-border-all"></i></div>
                        </div>
                    </div>
                </div>

                <div class="welcome-card">
                    <h1>Selamat Datang di CMS Blog</h1>
                    <p>
                        Dashboard manajemen konten Anda telah siap. Seluruh operasional CRUD dilakukan secara <u>Asynchronous</u> menggunakan Fetch API sesuai spesifikasi teknis modern.
                    </p>
                </div>
            </section>

            <!-- Penulis Section -->
            <section id="section-penulis" style="display:none;">
                <div class="section-header">
                    <div>
                        <h2>Penulis Konten</h2>
                        <p>Kelola data administrator dan kontributor blog</p>
                    </div>
                    <button class="btn-add" data-bs-toggle="modal" data-bs-target="#modalPenulis" onclick="resetForm('formPenulis')">
                        <i class="fas fa-plus me-2"></i> Tambah Penulis
                    </button>
                </div>
                <div class="table-container">
                    <table class="table table-hover align-middle mb-0" id="table-penulis">
                        <thead>
                            <tr>
                                <th style="width: 15%">BIO</th>
                                <th style="width: 35%">NAMA LENGKAP</th>
                                <th style="width: 25%">IDENTITAS</th>
                                <th class="text-center" style="width: 25%">AKSI</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </section>

            <!-- Artikel Section -->
            <section id="section-artikel" style="display:none;">
                <div class="section-header">
                    <div>
                        <h2>Daftar Artikel</h2>
                        <p>Kelola konten publikasi blog utama Anda</p>
                    </div>
                    <button class="btn-add" data-bs-toggle="modal" data-bs-target="#modalArtikel" onclick="initArtikelForm()">
                        <i class="fas fa-plus me-2"></i> Tulis Artikel
                    </button>
                </div>
                <div class="table-container">
                    <table class="table table-hover align-middle mb-0" id="table-artikel">
                        <thead>
                            <tr>
                                <th style="width: 15%">GAMBAR</th>
                                <th style="width: 45%">JUDUL ARTIKEL</th>
                                <th style="width: 20%">KATEGORI</th>
                                <th class="text-center" style="width: 20%">AKSI</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </section>

            <!-- Kategori Section -->
            <section id="section-kategori" style="display:none;">
                <div class="section-header">
                    <div>
                        <h2>Kategori Artikel</h2>
                        <p>Klasifikasikan topik konten blog Anda</p>
                    </div>
                    <button class="btn-add" data-bs-toggle="modal" data-bs-target="#modalKategori" onclick="resetForm('formKategori')">
                        <i class="fas fa-plus me-2"></i> Tambah Kategori
                    </button>
                </div>
                <div class="table-container">
                    <table class="table table-hover align-middle mb-0" id="table-kategori">
                        <thead>
                            <tr>
                                <th style="width: 30%">NAMA KATEGORI</th>
                                <th style="width: 50%">KETERANGAN</th>
                                <th class="text-center" style="width: 20%">AKSI</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </section>

        </div>

        <footer class="main-footer">
            <div>SYSTEM READY &nbsp; | &nbsp; PHP NATIVE STRUCTURE (MYSQL READY)</div>
            <div>TIMEZONE: <span class="bold">ASIA/JAKARTA</span></div>
        </footer>
    </div>

    <!-- Modals -->
    
    <!-- Modal Penulis -->
    <div class="modal fade" id="modalPenulis" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content shadow-lg border-0">
                <form id="formPenulis">
                    <div class="modal-header">
                        <h5 class="modal-title" id="titlePenulis">Tambah Penulis Baru</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="penulis-id">
                        <div class="row mb-3">
                            <div class="col-6">
                                <label class="form-label">Nama Depan</label>
                                <input type="text" name="nama_depan" id="penulis-nama-depan" class="form-control" required>
                            </div>
                            <div class="col-6">
                                <label class="form-label">Nama Belakang</label>
                                <input type="text" name="nama_belakang" id="penulis-nama-belakang" class="form-control" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" name="user_name" id="penulis-username" class="form-control" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" id="penulis-password" class="form-control" placeholder="Isi untuk ubah password">
                        </div>
                        <div class="mb-0">
                            <label class="form-label">Foto Profil</label>
                            <div class="d-flex align-items-center gap-3">
                                <div class="thumbnail-preview" id="preview-penulis">
                                    <i class="fas fa-camera text-muted fa-2x"></i>
                                </div>
                                <input type="file" name="foto" class="form-control flex-grow-1" onchange="previewImg(this, 'preview-penulis')">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-link text-muted text-decoration-none fw-bold" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-add px-4">Simpan Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Kategori -->
    <div class="modal fade" id="modalKategori" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content shadow-lg border-0">
                <form id="formKategori">
                    <div class="modal-header">
                        <h5 class="modal-title" id="titleKategori">Tambah Kategori</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="kategori-id">
                        <div class="mb-3">
                            <label class="form-label">Nama Kategori</label>
                            <input type="text" name="nama_kategori" id="kategori-nama" class="form-control" required>
                        </div>
                        <div class="mb-0">
                            <label class="form-label">Keterangan</label>
                            <textarea name="keterangan" id="kategori-keterangan" class="form-control" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-link text-muted text-decoration-none fw-bold" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-add px-4">Simpan Kategori</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Artikel -->
    <div class="modal fade" id="modalArtikel" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content shadow-lg border-0">
                <form id="formArtikel">
                    <div class="modal-header">
                        <h5 class="modal-title" id="titleArtikel">Tulis Artikel Baru</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="artikel-id">
                        <div class="mb-4">
                            <label class="form-label">Judul Artikel</label>
                            <input type="text" name="judul" id="artikel-judul" class="form-control form-control-lg fw-bold" placeholder="Masukkan judul..." required>
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label class="form-label">Pilih Penulis</label>
                                <select name="id_penulis" id="artikel-penulis" class="form-select" required>
                                    <option value="">-- Pilih Penulis --</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Pilih Kategori</label>
                                <select name="id_kategori" id="artikel-kategori" class="form-select" required>
                                    <option value="">-- Pilih Kategori --</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Isi Artikel</label>
                            <textarea name="isi" id="artikel-isi" class="form-control" rows="8" placeholder="Mulai menulis..." required></textarea>
                        </div>
                        <div class="mb-0 border p-3 rounded-4 bg-light">
                            <label class="form-label">Gambar Cover</label>
                            <div class="d-flex align-items-center gap-4">
                                <div class="thumbnail-preview" id="preview-artikel" style="width: 120px; height: 80px;">
                                    <i class="far fa-image text-muted fa-2x"></i>
                                </div>
                                <input type="file" name="gambar" id="artikel-file" class="form-control flex-grow-1" onchange="previewImg(this, 'preview-artikel')">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-link text-muted text-decoration-none fw-bold" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-add px-5">Terbitkan Artikel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Konfirmasi Hapus -->
    <div class="modal fade" id="modalHapus" tabindex="-1">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content shadow-lg border-0 text-center">
                <div class="modal-body p-5">
                    <div class="text-danger mb-4">
                        <i class="fas fa-exclamation-triangle fa-3x"></i>
                    </div>
                    <h5 class="fw-bold mb-3">Konfirmasi Hapus</h5>
                    <p class="text-muted small mb-4">Tindakan ini permanen. Ingin melanjutkan?</p>
                    <div class="d-grid gap-2">
                        <button type="button" class="btn btn-danger py-2 rounded-3 fw-bold" id="btn-konfirmasi-hapus">Hapus Sekarang</button>
                        <button type="button" class="btn btn-light py-2 rounded-3 border fw-bold" data-bs-dismiss="modal">Batalkan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        let currentDeleteId = null;
        let currentDeleteType = null;

        document.addEventListener('DOMContentLoaded', () => {
            loadStats();
            loadAllData();
            
            document.getElementById('formPenulis').addEventListener('submit', (e) => handleForm(e, 'penulis'));
            document.getElementById('formKategori').addEventListener('submit', (e) => handleForm(e, 'kategori'));
            document.getElementById('formArtikel').addEventListener('submit', (e) => handleForm(e, 'artikel'));
            
            document.getElementById('btn-konfirmasi-hapus').addEventListener('click', () => {
                executeDelete(currentDeleteId, currentDeleteType);
            });
        });

        function showSection(section) {
            const sections = ['dashboard', 'penulis', 'artikel', 'kategori'];
            sections.forEach(s => {
                document.getElementById('section-' + s).style.display = s === section ? 'block' : 'none';
                const navLink = document.querySelector(`.nav-link[onclick="showSection('${s}')"]`);
                if (s === section) navLink.classList.add('active');
                else navLink.classList.remove('active');
            });

            document.getElementById('breadcrumb-active').innerText = section === 'dashboard' ? 'Overview' : section.charAt(0).toUpperCase() + section.slice(1);
        }

        async function fetchData(url) {
            try {
                const res = await fetch(url);
                return await res.json();
            } catch (err) { return null; }
        }

        async function loadStats() {
            const [p, a, k] = await Promise.all([
                fetchData('ambil_penulis.php'),
                fetchData('ambil_artikel.php'),
                fetchData('ambil_kategori.php')
            ]);
            if (p) document.getElementById('stat-penulis').innerText = p.length;
            if (a) document.getElementById('stat-artikel').innerText = a.length;
            if (k) document.getElementById('stat-kategori').innerText = k.length;
        }

        async function loadAllData() {
            renderPenulis();
            renderArtikel();
            renderKategori();
            loadStats();
        }

        async function renderPenulis() {
            const data = await fetchData('ambil_penulis.php');
            const tbody = document.querySelector('#table-penulis tbody');
            tbody.innerHTML = '';
            if (!data) return;

            data.forEach(p => {
                tbody.innerHTML += `
                    <tr>
                        <td>
                            <div class="thumbnail-preview" style="width: 45px; height: 45px; border-radius: 12px;">
                                <img src="uploads_penulis/${p.foto}" onerror="this.src='https://ui-avatars.com/api/?name=${p.nama_depan}&background=random'">
                            </div>
                        </td>
                        <td>
                            <div class="fw-bold">${p.nama_lengkap}</div>
                            <div class="text-primary fw-bold" style="font-size: 10px; text-transform: uppercase;">Penulis Aktif</div>
                        </td>
                        <td>
                            <span class="badge-entity">@${p.user_name}</span>
                        </td>
                        <td class="text-center">
                            <a href="javascript:;" onclick="editPenulis(${p.id})" class="action-btn"><i class="far fa-edit"></i></a>
                            <a href="javascript:;" onclick="confirmDelete(${p.id}, 'penulis')" class="action-btn delete"><i class="far fa-trash-alt"></i></a>
                        </td>
                    </tr>
                `;
            });
        }

        async function renderKategori() {
            const data = await fetchData('ambil_kategori.php');
            const tbody = document.querySelector('#table-kategori tbody');
            tbody.innerHTML = '';
            if (!data) return;

            data.forEach(k => {
                tbody.innerHTML += `
                    <tr>
                        <td><span class="badge-entity">${k.nama_kategori}</span></td>
                        <td class="text-muted italic">"${k.keterangan || '-'}"</td>
                        <td class="text-center">
                            <a href="javascript:;" onclick="editKategori(${k.id})" class="text-primary text-decoration-none fw-bold small me-2">Edit</a>
                            <a href="javascript:;" onclick="confirmDelete(${k.id}, 'kategori')" class="text-danger text-decoration-none fw-bold small">Hapus</a>
                        </td>
                    </tr>
                `;
            });
        }

        async function renderArtikel() {
            const data = await fetchData('ambil_artikel.php');
            const tbody = document.querySelector('#table-artikel tbody');
            tbody.innerHTML = '';
            if (!data) return;

            data.forEach(a => {
                tbody.innerHTML += `
                    <tr>
                        <td>
                            <img src="uploads_artikel/${a.gambar}" width="60" height="40" style="border-radius: 8px; object-fit: cover;">
                        </td>
                        <td>
                            <div class="fw-bold">${a.judul}</div>
                            <div class="text-muted" style="font-size: 11px;">
                                <span class="text-primary fw-bold">@${a.nama_depan} ${a.nama_belakang}</span> &bull; ${a.hari_tanggal}
                            </div>
                        </td>
                        <td><span class="badge-entity">${a.nama_kategori}</span></td>
                        <td class="text-center">
                            <a href="javascript:;" onclick="editArtikel(${a.id})" class="action-btn"><i class="far fa-edit"></i></a>
                            <a href="javascript:;" onclick="confirmDelete(${a.id}, 'artikel')" class="action-btn delete"><i class="far fa-trash-alt"></i></a>
                        </td>
                    </tr>
                `;
            });
        }

        async function handleForm(e, type) {
            e.preventDefault();
            const form = e.target;
            const res = await fetch(document.getElementById(type + '-id').value ? `update_${type}.php` : `simpan_${type}.php`, {
                method: 'POST',
                body: new FormData(form)
            });
            const result = await res.json();
            if (result.status === 'success') {
                bootstrap.Modal.getInstance(form.closest('.modal')).hide();
                loadAllData();
            } else alert(result.message);
        }

        async function editPenulis(id) {
            const p = await fetchData(`ambil_satu_penulis.php?id=${id}`);
            if (p) {
                document.getElementById('titlePenulis').innerText = 'Ubah Data Penulis';
                document.getElementById('penulis-id').value = p.id;
                document.getElementById('penulis-nama-depan').value = p.nama_depan;
                document.getElementById('penulis-nama-belakang').value = p.nama_belakang;
                document.getElementById('penulis-username').value = p.user_name;
                document.getElementById('penulis-password').value = '';
                document.getElementById('preview-penulis').innerHTML = `<img src="uploads_penulis/${p.foto}">`;
                new bootstrap.Modal(document.getElementById('modalPenulis')).show();
            }
        }

        async function editKategori(id) {
            const k = await fetchData(`ambil_satu_kategori.php?id=${id}`);
            if (k) {
                document.getElementById('titleKategori').innerText = 'Ubah Kategori';
                document.getElementById('kategori-id').value = k.id;
                document.getElementById('kategori-nama').value = k.nama_kategori;
                document.getElementById('kategori-keterangan').value = k.keterangan;
                new bootstrap.Modal(document.getElementById('modalKategori')).show();
            }
        }

        async function editArtikel(id) {
            await initArtikelForm();
            const a = await fetchData(`ambil_satu_artikel.php?id=${id}`);
            if (a) {
                document.getElementById('titleArtikel').innerText = 'Ubah Artikel';
                document.getElementById('artikel-id').value = a.id;
                document.getElementById('artikel-judul').value = a.judul;
                document.getElementById('artikel-penulis').value = a.id_penulis;
                document.getElementById('artikel-kategori').value = a.id_kategori;
                document.getElementById('artikel-isi').value = a.isi;
                document.getElementById('preview-artikel').innerHTML = `<img src="uploads_artikel/${a.gambar}">`;
                new bootstrap.Modal(document.getElementById('modalArtikel')).show();
            }
        }

        function confirmDelete(id, type) {
            currentDeleteId = id;
            currentDeleteType = type;
            new bootstrap.Modal(document.getElementById('modalHapus')).show();
        }

        async function executeDelete(id, type) {
            const res = await fetch(`hapus_${type}.php?id=${id}`);
            const result = await res.json();
            bootstrap.Modal.getInstance(document.getElementById('modalHapus')).hide();
            if (result.status === 'success') loadAllData();
            else alert(result.message);
        }

        function resetForm(id) {
            document.getElementById(id).reset();
            const type = id.replace('form', '').toLowerCase();
            document.getElementById(type + '-id').value = '';
            document.getElementById('title' + type.charAt(0).toUpperCase() + type.slice(1)).innerText = 'Tambah ' + type.charAt(0).toUpperCase() + type.slice(1);
            if (document.getElementById('preview-' + type)) document.getElementById('preview-' + type).innerHTML = '<i class="fas fa-camera text-muted fa-2x"></i>';
        }

        async function initArtikelForm() {
            resetForm('formArtikel');
            const [penulis, kategori] = await Promise.all([fetchData('ambil_penulis.php'), fetchData('ambil_kategori.php')]);
            const sP = document.getElementById('artikel-penulis');
            const sK = document.getElementById('artikel-kategori');
            sP.innerHTML = '<option value="">-- Pilih Penulis --</option>';
            sK.innerHTML = '<option value="">-- Pilih Kategori --</option>';
            penulis.forEach(p => sP.innerHTML += `<option value="${p.id}">${p.nama_lengkap}</option>`);
            kategori.forEach(k => sK.innerHTML += `<option value="${k.id}">${k.nama_kategori}</option>`);
        }

        function previewImg(input, target) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = (e) => document.getElementById(target).innerHTML = `<img src="${e.target.result}">`;
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</body>
</html>
