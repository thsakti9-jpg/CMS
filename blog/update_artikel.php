<?php
// update_artikel.php
require_once 'koneksi.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? 0;
    $id_penulis = $_POST['id_penulis'] ?? 0;
    $id_kategori = $_POST['id_kategori'] ?? 0;
    $judul = $_POST['judul'] ?? '';
    $isi = $_POST['isi'] ?? '';
    
    try {
        // Ambil info gambar lama
        $stmt_old = $koneksi->prepare("SELECT gambar FROM artikel WHERE id = ?");
        $stmt_old->bind_param("i", $id);
        $stmt_old->execute();
        $old_img = $stmt_old->get_result()->fetch_assoc()['gambar'];
        
        $img_name = $old_img;
        
        // Handle Gambar baru jika ada
        if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === UPLOAD_ERR_OK) {
            $file_tmp = $_FILES['gambar']['tmp_name'];
            $file_name = time() . '_' . $_FILES['gambar']['name'];
            
            $finfo = new finfo(FILEINFO_MIME_TYPE);
            if (in_array($finfo->file($file_tmp), ['image/jpeg', 'image/png']) && $_FILES['gambar']['size'] <= 2*1024*1024) {
                if (move_uploaded_file($file_tmp, 'uploads_artikel/' . $file_name)) {
                    if (file_exists('uploads_artikel/' . $old_img)) {
                        unlink('uploads_artikel/' . $old_img);
                    }
                    $img_name = $file_name;
                }
            }
        }
        
        $stmt = $koneksi->prepare("UPDATE artikel SET id_penulis=?, id_kategori=?, judul=?, isi=?, gambar=? WHERE id=?");
        $stmt->bind_param("iisssi", $id_penulis, $id_kategori, $judul, $isi, $img_name, $id);
        
        if ($stmt->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'Artikel berhasil diperbarui']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Gagal memperbarui artikel']);
        }
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    }
}
?>
