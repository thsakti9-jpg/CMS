<?php
// ambil_penulis.php
require_once 'koneksi.php';

header('Content-Type: application/json');

try {
    $query = "SELECT id, nama_depan, nama_belakang, user_name, foto FROM penulis ORDER BY id DESC";
    $result = $koneksi->query($query);
    
    $data = [];
    while ($row = $result->fetch_assoc()) {
        $row['nama_lengkap'] = htmlspecialchars($row['nama_depan'] . ' ' . $row['nama_belakang']);
        $row['user_name'] = htmlspecialchars($row['user_name']);
        $data[] = $row;
    }
    
    echo json_encode($data);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
?>
