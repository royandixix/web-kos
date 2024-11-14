<?php
session_start();
require 'config/fungsi.php';

// Cek apakah parameter 'id' tersedia dan valid
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // Panggil fungsi hapus data
    if (hapusPengguna($id) > 0) {
        // Redirect ke halaman dashboard setelah berhasil menghapus
        header("Location: dhasboard.php?pesan=sukses");
        exit;
    } else {
        // Jika gagal menghapus, beri pesan error
        echo "<script>alert('Gagal menghapus data!');</script>";
    }
} else {
    header("Location: dhasboard.php"); // Jika tidak ada 'id', kembali ke dashboard
    exit;
}


?>

