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

// Fungsi untuk registrasi pengguna/admin
function registrasiPengguna($name, $email, $phone, $username, $password, $passwordConfirm, $foto, $role = 'user')
{
    global $db;

    // Validasi password
    if ($password !== $passwordConfirm) {
        return "Kata sandi tidak sama.";
    }

    // Escape string
    $name = mysqli_real_escape_string($db, trim($name));
    $email = mysqli_real_escape_string($db, trim($email));
    $phone = mysqli_real_escape_string($db, trim($phone));
    $username = mysqli_real_escape_string($db, trim($username));
    $role = mysqli_real_escape_string($db, trim($role));
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Cek keberadaan username atau email
    $result = mysqli_query($db, "SELECT * FROM pengguna_222271 WHERE username_222271 = '$username' OR email_222271 = '$email'");
    if (mysqli_num_rows($result) > 0) {
        return "Username atau email sudah terdaftar!";
    }

    // Upload foto
    $targetDir = "uploads/";
    $targetFile = $targetDir . basename($foto['name']);
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    if (!getimagesize($foto['tmp_name']) || !in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
        return "File yang diunggah bukan gambar atau format tidak didukung.";
    }

    if (!move_uploaded_file($foto['tmp_name'], $targetFile)) {
        return "Terjadi kesalahan saat mengunggah foto.";
    }

    // Simpan data pengguna
    $queryPengguna = "INSERT INTO pengguna_222271 (nama_222271, email_222271, nomorTelepon_222271, username_222271, foto_222271, role_222271) 
                      VALUES ('$name', '$email', '$phone', '$username', '$targetFile', '$role')";
    if ($db->query($queryPengguna)) {
        $penggunaId = $db->insert_id;

        // Simpan data login
        $queryLogin = "INSERT INTO login_222271 (pengguna_id_222271, username_222271, password_222271) 
                       VALUES ('$penggunaId', '$username', '$hashedPassword')";
        if ($db->query($queryLogin)) {
            return "Registrasi berhasil.";
        } else {
            return "Terjadi kesalahan saat menyimpan login: " . $db->error;
        }
    } else {
        return "Terjadi kesalahan saat registrasi: " . $db->error;
    }
}

// Fungsi untuk login pengguna/admin
function loginPengguna($username, $password)
{
    global $db;
    $username = mysqli_real_escape_string($db, $username);

    $query = "SELECT * FROM login_222271 l 
              JOIN pengguna_222271 p ON l.pengguna_id_222271 = p.id_222271 
              WHERE l.username_222271 = '$username'";
    $result = mysqli_query($db, $query);

    if ($result && mysqli_num_rows($result) === 1) {
        $user = mysqli_fetch_assoc($result);
        if (password_verify($password, $user['password_222271'])) {
            return [
                'id' => $user['pengguna_id_222271'],
                'username' => $user['username_222271'],
                'role' => $user['role_222271'],
                'foto' => $user['foto_222271']
            ];
        }
    }
    return false;
}

// Fungsi untuk mengambil data pengguna
function ambilDataPengguna($id)
{
    global $db; // Mengambil variabel $db dari scope global
    $query = "SELECT * FROM pengguna_222271 WHERE id_222271 = '$id'";
    $result = mysqli_query($db, $query);
    return mysqli_fetch_assoc($result);
}


// Fungsi untuk memperbarui pengguna
function perbaruiPengguna($id, $name, $email, $phone, $role)
{
    global $db;
    $name = mysqli_real_escape_string($db, $name);
    $email = mysqli_real_escape_string($db, $email);
    $phone = mysqli_real_escape_string($db, $phone);
    $role = mysqli_real_escape_string($db, $role);
    $id = mysqli_real_escape_string($db, $id);

    $query = "UPDATE pengguna_222271 SET nama_222271 = '$name', email_222271 = '$email', nomorTelepon_222271 = '$phone', role_222271 = '$role' WHERE id_222271 = '$id'";

    if (mysqli_query($db, $query)) {
        return true;
    } else {
        echo "Error: " . mysqli_error($db);
        return false;
    }
}

// Fungsi untuk menghapus pengguna
function hapusPengguna($id)
{
    global $db; // Pastikan $db adalah variabel koneksi database

    // Query SQL untuk menghapus data
    $query = "DELETE FROM pengguna_222271 WHERE id_222271 = $id";

    // Eksekusi query dan periksa keberhasilannya
    if ($db->query($query) === TRUE) {
        return true; // Mengembalikan true jika berhasil
    } else {
        return false; // Mengembalikan false jika gagal
    }
}

// Fungsi untuk menambahkan barang barang ke database
function kamar($post)
{
    global $db;

    // Mengambil data dari form dan mengamankannya
    $pemilik_kost_id = mysqli_real_escape_string($db, $post['pemilik_kost_id']);
    $nomor_kamar = mysqli_real_escape_string($db, $post['nomor_kamar']);
    $harga = mysqli_real_escape_string($db, $post['harga']);
    $status = isset($post['status']) ? mysqli_real_escape_string($db, $post['status']) : 'tersedia';
    $deskripsi = mysqli_real_escape_string($db, $post['deskripsi']);
    $tanggal_tersedia = isset($post['tanggal_tersedia']) ? mysqli_real_escape_string($db, $post['tanggal_tersedia']) : date('Y-m-d');
    $fasilitas = mysqli_real_escape_string($db, $post['fasilitas']);
    $foto = mysqli_real_escape_string($db, $post['foto']);
    $rating = isset($post['rating']) ? mysqli_real_escape_string($db, $post['rating']) : null;

    // Menambahkan barcode dengan nilai acak
    $barcode = mt_rand(10000, 99999);

    // Query INSERT dengan kolom yang diperbarui
    $query = "INSERT INTO barang (pemilik_kost_id_222271, nomor_kamar_222271, harga_222271, status_222271, deskripsi_222271, 
                                  tanggal_tersedia_222271, fasilitas_222271, foto_222271, rating_222271, barcode, tanggal)
              VALUES ('$pemilik_kost_id', '$nomor_kamar', '$harga', '$status', '$deskripsi', 
                      '$tanggal_tersedia', '$fasilitas', '$foto', '$rating', '$barcode', CURRENT_TIMESTAMP)";

    // Menjalankan query dan memeriksa kesalahan
    if (!mysqli_query($db, $query)) {
        die("Error: " . mysqli_error($db));
    }

    return mysqli_affected_rows($db);
}

function sanitizeInput($data)
{
    global $db;
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return mysqli_real_escape_string($db, $data);
}
