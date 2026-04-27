<?php
require_once 'koneksi.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_penulis = $_POST['id_penulis'] ?? 0;
    $id_kategori = $_POST['id_kategori'] ?? 0;
    $judul = $_POST['judul'] ?? '';
    $isi = $_POST['isi'] ?? '';

    // DEFAULT GAMBAR
    $file_name = 'default.png';

    // CEK apakah user upload gambar
    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === UPLOAD_ERR_OK) {

        $file_tmp = $_FILES['gambar']['tmp_name'];
        $file_size = $_FILES['gambar']['size'];

        // Validasi size
        if ($file_size > 2 * 1024 * 1024) {
            echo json_encode(['status' => 'error', 'message' => 'Ukuran gambar maksimal 2MB']);
            exit();
        }

        // Validasi tipe file
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $mime = $finfo->file($file_tmp);

        if (!in_array($mime, ['image/jpeg', 'image/png'])) {
            echo json_encode(['status' => 'error', 'message' => 'Hanya JPG/PNG']);
            exit();
        }

        // Rename file
        $file_name = time() . '_' . $_FILES['gambar']['name'];

        // Upload file
        if (!move_uploaded_file($file_tmp, 'uploads_artikel/' . $file_name)) {
            echo json_encode(['status' => 'error', 'message' => 'Gagal upload gambar']);
            exit();
        }
    }

    // SIMPAN KE DATABASE
    try {
        $stmt = $koneksi->prepare("INSERT INTO artikel (id_penulis, id_kategori, judul, isi, gambar) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("iisss", $id_penulis, $id_kategori, $judul, $isi, $file_name);

        if ($stmt->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'Artikel berhasil diterbitkan']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Gagal menyimpan artikel']);
        }
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    }
}
?>