<?php


// Koneksi ke database
$db = mysqli_connect('localhost', 'root', '', '222271_royandi');
if (!$db) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}

// Fungsi untuk menjalankan query
function query($query)
{
    global $db;
    $result = mysqli_query($db, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function hapusPengguna($id) {
    global $conn; // Pastikan koneksi database sudah tersedia
    $query = "DELETE FROM users WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    return $stmt->affected_rows; // Mengembalikan jumlah baris yang terpengaruh
}

