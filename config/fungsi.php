<?php
// Koneksi ke database
$db = mysqli_connect('localhost', 'root', '', '222271_royandi');

// Cek koneksi
if (!$db) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}

// Fungsi untuk menjalankan query dan mengembalikan hasil sebagai array
function query($query)
{
    global $db; // Menggunakan variabel global $db
    $result = mysqli_query($db, $query); // Menjalankan query
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) { // Mengambil hasil query
        $rows[] = $row; // Menyimpan hasil ke dalam array
    }
    return $rows; // Mengembalikan array hasil
}

// Fungsi untuk registrasi pengguna
function registrasiPengguna($db, $name, $email, $phone, $username, $password, $passwordConfirm, $foto)
{
    // Cek apakah kata sandi sama
    if ($password !== $passwordConfirm) {
        return "Kata sandi tidak sama."; // Mengembalikan pesan jika kata sandi tidak sama
    }

    // Cek apakah username atau email sudah ada
    $result = $db->query("SELECT * FROM pengguna_222271 WHERE username_222271 = '$username' OR email_222271 = '$email'");
    if ($result->num_rows > 0) {
        return "Username atau email sudah terdaftar!"; // Mengembalikan pesan jika sudah terdaftar
    }

    // Hash kata sandi
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Menangani foto
    $targetDir = "uploads/"; // Direktori penyimpanan foto
    $targetFile = $targetDir . basename($foto["name"]); // Nama file untuk disimpan
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION)); // Mendapatkan ekstensi file

    // Cek apakah file yang diunggah adalah gambar
    $check = getimagesize($foto["tmp_name"]);
    if ($check === false) {
        return "File yang diunggah bukan gambar."; // Mengembalikan pesan jika bukan gambar
    }

    // Cek ukuran file (maksimal 2MB)
    if ($foto["size"] > 2000000) {
        return "Maaf, ukuran file terlalu besar."; // Mengembalikan pesan jika ukuran file terlalu besar
    }

    // Memastikan format file yang diizinkan
    if (!in_array($imageFileType, ["jpg", "png", "jpeg", "gif"])) {
        return "Maaf, hanya file JPG, JPEG, PNG & GIF yang diizinkan."; // Mengembalikan pesan jika format tidak diizinkan
    }

    // Mengunggah file gambar
    if (move_uploaded_file($foto["tmp_name"], $targetFile)) {
        // Simpan pengguna baru ke database
        $query = "INSERT INTO pengguna_222271 (nama_222271, email_222271, no_hp_222271, foto_222271) 
                  VALUES ('$name', '$email', '$phone', '$targetFile')";
        if (mysqli_query($db, $query)) {
            $penggunaId = mysqli_insert_id($db); // Mendapatkan id pengguna yang baru dibuat

            // Simpan login ke tabel login_222271
            $loginQuery = "INSERT INTO login_222271 (pengguna_id_222271, username_222271, password_222271) 
                           VALUES ('$penggunaId', '$username', '$hashedPassword')";

            if (mysqli_query($db, $loginQuery)) {
                return "Registrasi berhasil."; // Mengembalikan pesan sukses
            } else {
                return "Terjadi kesalahan saat menyimpan login: " . mysqli_error($db); // Mengembalikan pesan kesalahan
            }
        } else {
            return "Terjadi kesalahan saat registrasi: " . mysqli_error($db); // Mengembalikan pesan kesalahan
        }
    } else {
        return "Maaf, terjadi kesalahan saat mengunggah gambar."; // Mengembalikan pesan kesalahan
    }
}

// Fungsi untuk login pengguna
function loginPengguna($db, $loginUsername, $loginPassword)
{
    // Query untuk mencari username
    $query = "SELECT * FROM login_222271 WHERE username_222271 = '$loginUsername'";
    $result = mysqli_query($db, $query);

    // Cek apakah username ditemukan
    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result); // Mengambil data pengguna

        // Memverifikasi kata sandi
        if (password_verify($loginPassword, $user['password_222271'])) {
            // Mengambil informasi pengguna yang terkait
            $penggunaId = $user['pengguna_id_222271'];
            $userDetailsQuery = "SELECT * FROM pengguna_222271 WHERE id_222271 = '$penggunaId'";
            $userDetailsResult = mysqli_query($db, $userDetailsQuery);

            // Mengembalikan data pengguna
            if (mysqli_num_rows($userDetailsResult) == 1) {
                return mysqli_fetch_assoc($userDetailsResult); // Mengembalikan data pengguna
            }
        } else {
            return false; // Kata sandi salah
        }
    } else {
        return false; // Username tidak ditemukan
    }
}
?>
