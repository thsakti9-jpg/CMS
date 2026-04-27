<?php
// hapus_artikel.php
require_once 'koneksi.php';

header('Content-Type: application/json');

$id = $_GET['id'] ?? 0;

try {
    // Ambil info gambar untuk dihapus
    $stmt_img = $koneksi->prepare("SELECT gambar FROM artikel WHERE id = ?");
    $stmt_img->bind_param("i", $id);
    $stmt_img->execute();
    $img = $stmt_img->get_result()->fetch_assoc()['gambar'] ?? '';
    
    $stmt_del = $koneksi->prepare("DELETE FROM artikel WHERE id = ?");
    $stmt_del->bind_param("i", $id);
    
    if ($stmt_del->execute()) {
        if ($img && file_exists('uploads_artikel/' . $img)) {
            unlink('uploads_artikel/' . $img);
        }
        echo json_encode(['status' => 'success', 'message' => 'Artikel berhasil dihapus']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Gagal menghapus artikel']);
    }
} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
?>
