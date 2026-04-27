<?php
// ambil_artikel.php
require_once 'koneksi.php';

header('Content-Type: application/json');

try {
    $query = "SELECT a.*, p.nama_depan, p.nama_belakang, k.nama_kategori 
              FROM artikel a 
              JOIN penulis p ON a.id_penulis = p.id 
              JOIN kategori_artikel k ON a.id_kategori = k.id 
              ORDER BY a.hari_tanggal DESC";
    $result = $koneksi->query($query);
    
    $data = [];
    while ($row = $result->fetch_assoc()) {
        $row['judul'] = htmlspecialchars($row['judul']);
        $row['penulis_display'] = htmlspecialchars($row['nama_depan'] . ' ' . $row['nama_belakang']);
        $row['kategori_display'] = htmlspecialchars($row['nama_kategori']);
        $data[] = $row;
    }
    echo json_encode($data);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
?>
