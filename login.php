<?php
session_start(); // Pastikan sesi dimulai

require 'config/fungsi.php'; 
require 'templates/header.php';   
// require 'templates/navbar.php'; 
require 'templates/footer.php'; 

// Proses Registrasi
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['registerName'])) {
    $name = $db->real_escape_string($_POST['registerName']);
    $email = $db->real_escape_string($_POST['registerEmail']);
    $phone = $db->real_escape_string($_POST['registerPhone']);
    $username = $db->real_escape_string($_POST['registerUsername']);
    $password = $db->real_escape_string($_POST['registerPassword']);
    $passwordConfirm = $db->real_escape_string($_POST['registerPasswordConfirm']);
    $foto = $_FILES['foto'];

    // Panggil fungsi registrasi
    $registrasiResult = registrasiPengguna($db, $name, $email, $phone, $username, $password, $passwordConfirm, $foto);
    
    // Set variabel sesi untuk foto pengguna jika registrasi berhasil
    if ($registrasiResult === true) {
        $_SESSION['userPhoto'] = $foto['name']; // Atur path foto yang diunggah di sesi
    }
    echo "<script>alert('$registrasiResult');</script>";
}

// Proses Login
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['loginUsername'])) {
    $loginUsername = $db->real_escape_string($_POST['loginUsername']);
    $loginPassword = $db->real_escape_string($_POST['loginPassword']);

    // Panggil fungsi login
    $loginResult = loginPengguna($db, $loginUsername, $loginPassword);

    if ($loginResult !== false) {
        // Set session untuk pengguna
        $_SESSION['user'] = $loginResult; // Menyimpan data pengguna
        $_SESSION['userPhoto'] = $loginResult['foto_222271']; // Menyimpan path foto
        echo "<script>alert('Login berhasil!');</script>";
        header("Location: admin.php"); // Arahkan ke halaman admin
        exit;
    } else {
        echo "<script>alert('Username atau password salah!');</script>";
        
    }
}

// Tutup koneksi jika diperlukan
mysqli_close($db);
?>

<!-- Halaman Login -->
<style>
    body {
        background-image: url('img/kos/hilmy-jaya-architect-contractor-desain-interior-kos-kosan1606295687-m.png');
        background-size: cover;
        background-position: center;
    }
</style>
<div class="login">
    <div class="container mt-5">
        <div class="login-form-container">
            <h3 class="login-title mt-4">Anda Harus Login Dulu</h3>
            <form method="POST" action="">
                <div class="mb-3">
                    <label for="loginUsername" class="form-label">Username</label>
                    <input type="text" class="form-control" id="loginUsername" name="loginUsername" placeholder="Masukan username anda" required>
                </div>
                <div class="mb-3">
                    <label for="loginPassword" class="form-label">Password</label>
                    <input type="password" class="form-control" id="loginPassword" name="loginPassword" placeholder="Masukkan password Anda" required>
                </div>
                <p>Belum punya akun?</p>
                <button type="button" class="btn btn-primary" data-bs-target="#exampleModalToggle" data-bs-toggle="modal">Daftar di sini</button>
                <button type="submit" class="btn btn-outline-success">Login</button>
                <a href="index.php" class="btn btn-warning">Kembali</a> <!-- Tombol kembali -->
            </form>
        </div>
    </div>
</div>



<!-- Halaman Register -->
<div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalToggleLabel">Registrasi Akun</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form Registrasi -->
                <form method="POST" action="" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="registerName" class="form-label">Nama</label>
                        <input type="text" class="form-control" name="registerName" placeholder="Masukkan nama" required>
                    </div>
                    <div class="mb-3">
                        <label for="registerEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" name="registerEmail" placeholder="Masukkan email" required>
                    </div>
                    <div class="mb-3">
                        <label for="registerPhone" class="form-label">No HP</label>
                        <input type="text" class="form-control" name="registerPhone" placeholder="Masukkan nomor HP" required>
                    </div>
                    <div class="mb-3">
                        <label for="registerUsername" class="form-label">Username</label>
                        <input type="text" class="form-control" name="registerUsername" placeholder="Masukkan username" required>
                    </div>
                    <div class="mb-3">
                        <label for="registerPassword" class="form-label">Password</label>
                        <input type="password" class="form-control" name="registerPassword" placeholder="Masukkan password" required>
                    </div>
                    <div class="mb-3">
                        <label for="registerPasswordConfirm" class="form-label">Konfirmasi Password</label>
                        <input type="password" class="form-control" name="registerPasswordConfirm" placeholder="Masukkan kembali password" required>
                    </div>
                    <div class="mb-3">
                        <label for="foto" class="form-label">Upload Foto</label>
                        <input type="file" class="form-control" id="foto" name="foto" accept="image/*" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Daftar</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
