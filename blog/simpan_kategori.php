<?php
// simpan_kategori.php
require_once 'koneksi.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_kategori = $_POST['nama_kategori'] ?? '';
    $keterangan = $_POST['keterangan'] ?? '';
    
    try {
        $stmt = $koneksi->prepare("INSERT INTO kategori_artikel (nama_kategori, keterangan) VALUES (?, ?)");
        $stmt->bind_param("ss", $nama_kategori, $keterangan);
        
        if ($stmt->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'Kategori berhasil ditambahkan']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Gagal menyimpan kategori']);
        }
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    }
}
?>
