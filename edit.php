<?php 

require 'config/fungsi.php';


// Cek koneksi
if (!$db) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Cek apakah ID ada dalam URL
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($db, $_GET['id']);
    $user = ambilDataPengguna($db, $id);

    if (!$user) {
        echo "<script>alert('Pengguna tidak ditemukan.'); window.location.href='admin.php';</script>";
        exit;
        
    }
} else {
    echo "<script>alert('ID tidak valid.'); window.location.href='admin.php';</script>";
    exit;
}

// Proses pengiriman form
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = mysqli_real_escape_string($db, $_POST['name']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $phone = mysqli_real_escape_string($db, $_POST['phone']);
    $role = mysqli_real_escape_string($db, $_POST['role']);

    // Perbarui pengguna di database
    if (perbaruiPengguna($db, $id, $name, $email, $phone, $role)) {
        echo "<script>alert('Data berhasil diperbarui!'); window.location.href='admin.php';</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($db) . "');</script>";
    }
}

// Tutup koneksi database di sini, setelah semua proses selesai
mysqli_close($db);
?>

<!-- Form HTML untuk Mengedit -->
<div class="container mt-5">
    <h3 class="text-center">Edit Pengguna</h3>
    <form action="" method="POST">
        <div class="form-group mb-3 ">
            <label for="name">Nama</label>
            <input type="text" name="name" id="name" class="form-control" value="<?php echo htmlspecialchars($user['nama_222271']); ?>" required>
        </div>
        <div class="form-group mb-3">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="<?php echo htmlspecialchars($user['email_222271']); ?>" required>
        </div>
        <div class="form-group mb-3">
            <label for="phone">No HP</label>
            <input type="text" name="phone" id="phone" class="form-control" value="<?php echo htmlspecialchars($user['no_hp_222271']); ?>" required>
        </div>
        <div class="form-group mb-3 ">
            <label for="role">Role</label>
            <select name="role" id="role" class="form-control" required>
                <option value="penghuni" <?php echo ($user['role_222271'] == 'penghuni') ? 'selected' : ''; ?>>Penghuni</option>
                <option value="pemilik" <?php echo ($user['role_222271'] == 'pemilik') ? 'selected' : ''; ?>>Pemilik</option>
                <option value="admin" <?php echo ($user['role_222271'] == 'admin') ? 'selected' : ''; ?>>Admin</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Perbarui</button>
        <a href="admin.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>
