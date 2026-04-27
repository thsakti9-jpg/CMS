<?php
// Script Upload Aman (Logic Helper)
// Fungsi ini diintegrasikan langsung ke dalam simpan/update PHP files
// untuk memastikan validitas file.

function uploadFile($file, $targetDir, $allowedTypes = ['image/jpeg', 'image/png'], $maxSize = 2097152) {
    if ($file['error'] !== UPLOAD_ERR_OK) return false;

    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $mime = $finfo->file($file['tmp_name']);
    
    if (!in_array($mime, $allowedTypes)) return false;
    if ($file['size'] > $maxSize) return false;

    $newName = time() . '_' . basename($file['name']);
    if (move_uploaded_file($file['tmp_name'], $targetDir . $newName)) {
        return $newName;
    }
    return false;
}
?>
