<?php
/**
 * File Koneksi Database
 * Menggunakan mysqli dengan mode exception untuk kemudahan debugging
 */

$host = "localhost";
$user = "root";
$pass = "Malang123_";
$db   = "db_blog";

// Matikan error reporting di produksi, aktifkan di development
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $koneksi = new mysqli($host, $user, $pass, $db);
    $koneksi->set_charset("utf8mb4");
    
    // Set Timezone Asia/Jakarta
    $koneksi->query("SET time_zone = '+07:00'");
} catch (Exception $e) {
    // Jika koneksi gagal, kirim response JSON error karena kita menggunakan Fetch API
    header('Content-Type: application/json');
    echo json_encode([
        'status' => 'error',
        'message' => 'Koneksi database gagal: ' . $e->getMessage()
    ]);
    exit();
}
?>
