<?php
// hapus_kategori.php
require_once 'koneksi.php';

header('Content-Type: application/json');

$id = $_GET['id'] ?? 0;

try {
    // Cek apakah kategori masih digunakan dalam artikel
    $stmt_check = $koneksi->prepare("SELECT COUNT(*) as total FROM artikel WHERE id_kategori = ?");
    $stmt_check->bind_param("i", $id);
    $stmt_check->execute();
    $total = $stmt_check->get_result()->fetch_assoc()['total'];
    
    if ($total > 0) {
        echo json_encode(['status' => 'error', 'message' => 'Kategori tidak dapat dihapus karena masih digunakan dalam artikel']);
        exit();
    }
    
    $stmt_del = $koneksi->prepare("DELETE FROM kategori_artikel WHERE id = ?");
    $stmt_del->bind_param("i", $id);
    
    if ($stmt_del->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Kategori berhasil dihapus']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Gagal menghapus kategori']);
    }
} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
?>
