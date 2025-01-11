<?php
require 'config/fungsi.php';

// Cek apakah parameter 'id' tersedia dan valid
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk menghapus data
    $query = "DELETE FROM pengguna_222271 WHERE id_222271 = $id";
    $result = mysqli_query($db, $query);

    if ($result && mysqli_affected_rows($db) > 0) {
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
