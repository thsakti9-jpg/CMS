<?php
// update_penulis.php
require_once 'koneksi.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? 0;
    $nama_depan = $_POST['nama_depan'] ?? '';
    $nama_belakang = $_POST['nama_belakang'] ?? '';
    $user_name = $_POST['user_name'] ?? '';
    $password = $_POST['password'] ?? '';
    
    try {
        // Ambil data lama untuk foto
        $stmt_old = $koneksi->prepare("SELECT foto FROM penulis WHERE id = ?");
        $stmt_old->bind_param("i", $id);
        $stmt_old->execute();
        $old_data = $stmt_old->get_result()->fetch_assoc();
        $foto_name = $old_data['foto'];
        
        // Handle File Upload jika ada foto baru
        if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
            $file_tmp = $_FILES['foto']['tmp_name'];
            $file_name = time() . '_' . $_FILES['foto']['name'];
            
            // Validasi (finfo & size)
            $finfo = new finfo(FILEINFO_MIME_TYPE);
            $mime = $finfo->file($file_tmp);
            if (in_array($mime, ['image/jpeg', 'image/png']) && $_FILES['foto']['size'] <= 2 * 1024 * 1024) {
                if (move_uploaded_file($file_tmp, 'uploads_penulis/' . $file_name)) {
                    // Hapus foto lama jika bukan default
                    if ($foto_name != 'default.png' && file_exists('uploads_penulis/' . $foto_name)) {
                        unlink('uploads_penulis/' . $foto_name);
                    }
                    $foto_name = $file_name;
                }
            }
        }
        
        if (!empty($password)) {
            $password_hash = password_hash($password, PASSWORD_BCRYPT);
            $stmt = $koneksi->prepare("UPDATE penulis SET nama_depan=?, nama_belakang=?, user_name=?, password=?, foto=? WHERE id=?");
            $stmt->bind_param("sssssi", $nama_depan, $nama_belakang, $user_name, $password_hash, $foto_name, $id);
        } else {
            $stmt = $koneksi->prepare("UPDATE penulis SET nama_depan=?, nama_belakang=?, user_name=?, foto=? WHERE id=?");
            $stmt->bind_param("ssssi", $nama_depan, $nama_belakang, $user_name, $foto_name, $id);
        }
        
        if ($stmt->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'Data penulis berhasil diperbarui']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Gagal memperbarui data']);
        }
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    }
}
?>
