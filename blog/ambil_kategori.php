<?php
// ambil_kategori.php
require_once 'koneksi.php';

header('Content-Type: application/json');

try {
    $result = $koneksi->query("SELECT * FROM kategori_artikel ORDER BY id DESC");
    $data = [];
    while ($row = $result->fetch_assoc()) {
        $row['nama_kategori'] = htmlspecialchars($row['nama_kategori']);
        $row['keterangan'] = htmlspecialchars($row['keterangan']);
        $data[] = $row;
    }
    echo json_encode($data);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
?>
