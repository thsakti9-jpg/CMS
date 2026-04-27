<?php
// simpan_penulis.php
require_once 'koneksi.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_depan = $_POST['nama_depan'] ?? '';
    $nama_belakang = $_POST['nama_belakang'] ?? '';
    $user_name = $_POST['user_name'] ?? '';
    $password = $_POST['password'] ?? '';
    
    // Hash password
    $password_hash = password_hash($password, PASSWORD_BCRYPT);
    
    $foto_name = 'default.png';
    
    // Handle File Upload
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $file_tmp = $_FILES['foto']['tmp_name'];
        $file_name = time() . '_' . $_FILES['foto']['name'];
        $file_size = $_FILES['foto']['size'];
        
        // Validasi ukuran 2MB
        if ($file_size > 2 * 1024 * 1024) {
            echo json_encode(['status' => 'error', 'message' => 'Ukuran file maksimal 2MB']);
            exit();
        }
        
        // Validasi tipe file dengan finfo
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $mime = $finfo->file($file_tmp);
        $allowed = ['image/jpeg', 'image/png', 'image/gif'];
        
        if (!in_array($mime, $allowed)) {
            echo json_encode(['status' => 'error', 'message' => 'Tipe file tidak didukung (harus JPG/PNG)']);
            exit();
        }
        
        if (move_uploaded_file($file_tmp, 'uploads_penulis/' . $file_name)) {
            $foto_name = $file_name;
        }
    }
    
    try {
        $stmt = $koneksi->prepare("INSERT INTO penulis (nama_depan, nama_belakang, user_name, password, foto) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $nama_depan, $nama_belakang, $user_name, $password_hash, $foto_name);
        
        if ($stmt->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'Penulis berhasil ditambahkan']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Gagal menyimpan data']);
        }
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    }
}
?>
