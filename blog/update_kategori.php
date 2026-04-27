<?php
// update_kategori.php
require_once 'koneksi.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? 0;
    $nama_kategori = $_POST['nama_kategori'] ?? '';
    $keterangan = $_POST['keterangan'] ?? '';
    
    try {
        $stmt = $koneksi->prepare("UPDATE kategori_artikel SET nama_kategori = ?, keterangan = ? WHERE id = ?");
        $stmt->bind_param("ssi", $nama_kategori, $keterangan, $id);
        
        if ($stmt->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'Kategori berhasil diperbarui']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Gagal memperbarui kategori']);
        }
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    }
}
?>
