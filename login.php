<?php
session_start(); // Pastikan sesi dimulai

require 'config/fungsi.php';
require 'templates/header.php';
// require 'templates/navbar.php'; 
require 'templates/footer.php';

// Proses Registrasi
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['registerName'])) {
    $name = trim($_POST['registerName']);
    $email = trim($_POST['registerEmail']);
    $phone = trim($_POST['registerPhone']);
    $username = trim($_POST['registerUsername']);
    $password = $_POST['registerPassword'];
    $passwordConfirm = $_POST['registerPasswordConfirm'];
    $foto = $_FILES['foto'];

    $registrasiResult = registrasiPengguna($name, $email, $phone, $username, $password, $passwordConfirm, $foto);

    if ($registrasiResult === "Registrasi berhasil.") {
        $_SESSION['userPhoto'] = $foto['name'];
    }
    echo "<script>alert('$registrasiResult');</script>";
}

// Proses Login
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['loginUsername'])) {
    $loginUsername = trim($_POST['loginUsername']);
    $loginPassword = $_POST['loginPassword'];

    $loginResult = loginPengguna($loginUsername, $loginPassword);

    if ($loginResult) {
        $_SESSION['user'] = $loginResult;
        $_SESSION['userPhoto'] = $loginResult['foto'];
        $_SESSION['userRole'] = $loginResult['role'];
        header("Location: dhasboard2.php");
        exit;
    } else {
        echo "<script>alert('Username atau password salah!');</script>";
    }
}
?>
<style>
    body {
        background-image: url('img/kos/hilmy-jaya-architect-contractor-desain-interior-kos-kosan1606295687-m.png');

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
                <a href="dhasboard.php" class="btn btn-warning">Kembali</a> <!-- Tombol kembali -->
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
                        <label for="registerRole" class="form-label">Role</label>
                        <select class="form-select" name="registerRole" required>
                            <option value="user">User</option>
                            <option value="admin">Admin</option>
                        </select>
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