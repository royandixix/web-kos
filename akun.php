    <?php
    session_start();
    require 'config/fungsi.php';
    require 'templates/navbar.php';

    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['editAccount'])) {
        $userId = $_SESSION['user']['id_222271'];
        $name = mysqli_real_escape_string($db, $_POST['editName']);
        $email = mysqli_real_escape_string($db, $_POST['editEmail']);
        $phone = mysqli_real_escape_string($db, $_POST['editPhone']);
        $username = mysqli_real_escape_string($db, $_POST['editUsername']);
        $password = $_POST['editPassword'];
        $foto = $_FILES['editFoto']['name'];
        $fotoPath = 'uploads/profile/' . $foto;
        $hashedPassword = !empty($password) ? password_hash($password, PASSWORD_BCRYPT) : null;

        // Periksa apakah pengguna sudah mengedit dalam 7 hari terakhir
        $checkQuery = "SELECT last_updated FROM pengguna_222271 WHERE id_222271 = '$userId'";
        $result = mysqli_query($db, $checkQuery);
        $row = mysqli_fetch_assoc($result);

        if ($row && strtotime($row['last_updated']) > strtotime('-7 days')) {
            echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Anda hanya dapat mengedit akun setiap 7 hari sekali.'
                    });
                </script>";
        } else {
            // Validasi email dan telepon
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo "<script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Format email tidak valid!'
                        });
                    </script>";
            } elseif (!preg_match('/^[0-9]{12}$/', $phone)) {
                echo "<script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Nomor HP harus 12 digit!'
                        });
                    </script>";
            } elseif ($_FILES['editFoto']['size'] > 5000000) { // 5MB limit
                echo "<script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'File gambar terlalu besar!'
                        });
                    </script>";
            } else {
                if (!empty($foto)) {
                    move_uploaded_file($_FILES['editFoto']['tmp_name'], $fotoPath);
                } else {
                    $fotoPath = $_SESSION['userPhoto']; // Gunakan foto lama jika tidak ada upload baru
                }

                // Update data pengguna
                $updateQuery = "UPDATE pengguna_222271 SET 
                                nama_222271 = '$name',
                                email_222271 = '$email',
                                nomorTelepon_222271 = '$phone',
                                username_222271 = '$username',
                                foto_222271 = '$fotoPath',
                                last_updated = NOW()";

                if (!empty($hashedPassword)) {
                    $updateQuery .= ", password_222271 = '$hashedPassword'";
                }

                $updateQuery .= " WHERE id_222271 = '$userId'";

                if (mysqli_query($db, $updateQuery)) {
                    $_SESSION['user']['nama_222271'] = $name;
                    $_SESSION['user']['email_222271'] = $email;
                    $_SESSION['user']['nomorTelepon_222271'] = $phone;
                    $_SESSION['user']['username_222271'] = $username;
                    $_SESSION['userPhoto'] = $fotoPath;

                    echo "<script>
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: 'Data akun berhasil diperbarui!'
                            }).then(() => {
                                window.location.href = 'akun.php';
                            });
                        </script>";
                } else {
                    echo "<script>
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: 'Terjadi kesalahan saat memperbarui data.'
                            });
                        </script>";
                }
            }
        }
    }
    ?>


    <div class="container my-5">
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="editName" class="form-label">Nama</label>
                <input type="text" class="form-control" id="editName" name="editName" value="<?= $_SESSION['user']['nama_222271']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="editEmail" class="form-label">Email</label>
                <input type="email" class="form-control" id="editEmail" name="editEmail" value="<?= $_SESSION['user']['email_222271']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="editPhone" class="form-label">Nomor Telepon</label>
                <input type="text" class="form-control" id="editPhone" name="editPhone" value="<?= $_SESSION['user']['nomorTelepon_222271']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="editUsername" class="form-label">Username</label>
                <input type="text" class="form-control" id="editUsername" name="editUsername" value="<?= $_SESSION['user']['username_222271']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="editPassword" class="form-label">Password Baru (Opsional)</label>
                <input type="password" class="form-control" id="editPassword" name="editPassword">
            </div>
            <div class="mb-3">
                <label for="editFoto" class="form-label">Foto Profil</label>
                <input type="file" class="form-control" id="editFoto" name="editFoto">
            </div>
            <button type="submit" name="editAccount" class="btn btn-warning">Simpan Perubahan</button>
        </form>
    </div>
