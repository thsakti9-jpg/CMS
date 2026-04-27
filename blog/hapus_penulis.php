<?php
// hapus_penulis.php
require_once 'koneksi.php';

header('Content-Type: application/json');

$id = $_GET['id'] ?? 0;

try {
    // Cek apakah penulis masih memiliki artikel
    $stmt_check = $koneksi->prepare("SELECT COUNT(*) as total FROM artikel WHERE id_penulis = ?");
    $stmt_check->bind_param("i", $id);
    $stmt_check->execute();
    $total = $stmt_check->get_result()->fetch_assoc()['total'];
    
    if ($total > 0) {
        echo json_encode(['status' => 'error', 'message' => 'Penulis tidak bisa dihapus karena masih memiliki artikel']);
        exit();
    }
    
    // Ambil foto untuk dihapus dari storage
    $stmt_foto = $koneksi->prepare("SELECT foto FROM penulis WHERE id = ?");
    $stmt_foto->bind_param("i", $id);
    $stmt_foto->execute();
    $foto = $stmt_foto->get_result()->fetch_assoc()['foto'] ?? 'default.png';
    
    $stmt_del = $koneksi->prepare("DELETE FROM penulis WHERE id = ?");
    $stmt_del->bind_param("i", $id);
    
    if ($stmt_del->execute()) {
        if ($foto != 'default.png' && file_exists('uploads_penulis/' . $foto)) {
            unlink('uploads_penulis/' . $foto);
        }
        echo json_encode(['status' => 'success', 'message' => 'Penulis berhasil dihapus']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Gagal menghapus penulis']);
    }
} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
?>
