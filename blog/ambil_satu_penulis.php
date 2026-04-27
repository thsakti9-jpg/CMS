<?php
// ambil_satu_penulis.php
require_once 'koneksi.php';

header('Content-Type: application/json');

$id = $_GET['id'] ?? 0;

try {
    $stmt = $koneksi->prepare("SELECT id, nama_depan, nama_belakang, user_name, foto FROM penulis WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
    
    if ($data) {
        echo json_encode($data);
    } else {
        http_response_code(404);
        echo json_encode(['error' => 'Data tidak ditemukan']);
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
?>
