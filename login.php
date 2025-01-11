<?php
session_start();
require 'config/fungsi.php';

// Include footer
require 'templates/footer.php';

// Fungsi Registrasi
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['registerName'])) {
    $name = mysqli_real_escape_string($db, $_POST['registerName']);
    $email = mysqli_real_escape_string($db, $_POST['registerEmail']);
    $phone = mysqli_real_escape_string($db, $_POST['registerPhone']);
    $username = mysqli_real_escape_string($db, $_POST['registerUsername']);
    $password = mysqli_real_escape_string($db, $_POST['registerPassword']);
    $passwordConfirm = mysqli_real_escape_string($db, $_POST['registerPasswordConfirm']);
    $role = mysqli_real_escape_string($db, $_POST['registerRole']);
    $foto = $_FILES['foto']['name'];
    $fotoPath = 'uploads/profile/' . $foto;

    // Validasi: Periksa apakah password dan konfirmasi password cocok
    if ($password !== $passwordConfirm) {
        echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Password tidak cocok!'
                });
              </script>";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Validasi: Periksa format email
        echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Format email tidak valid!'
                });
              </script>";
    } elseif (!preg_match('/^[0-9]{12}$/', $phone)) {
        // Validasi: Periksa format nomor telepon (harus 12 digit)
        echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Nomor HP harus 12 digit!'
                });
              </script>";
    } elseif ($_FILES['foto']['size'] > 5000000) { // 5MB limit
        // Validasi: Ukuran gambar
        echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'File gambar terlalu besar!'
                });
              </script>";
    } else {
        // Cek apakah email sudah digunakan
        $emailCheckQuery = "SELECT id_222271 FROM pengguna_222271 WHERE email_222271 = '$email'";
        $result = mysqli_query($db, $emailCheckQuery);

        if (mysqli_num_rows($result) > 0) {
            echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Email sudah terdaftar!'
                    });
                  </script>";
        } else {
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            move_uploaded_file($_FILES['foto']['tmp_name'], $fotoPath);

            // Insert ke tabel pengguna_222271
            $queryPengguna = "INSERT INTO pengguna_222271 
                              (nama_222271, email_222271, username_222271, nomorTelepon_222271, foto_222271, role_222271)
                              VALUES ('$name', '$email', '$username', '$phone', '$fotoPath', '$role')";

            if (mysqli_query($db, $queryPengguna)) {
                // Ambil ID pengguna yang baru dibuat
                $penggunaId = mysqli_insert_id($db);

                // Insert ke tabel login_222271
                $queryLogin = "INSERT INTO login_222271 
                              (pengguna_id_222271, username_222271, password_222271, nama_222271, email_222271, nomorTelepon_222271, foto_222271, role_222271)
                              VALUES ('$penggunaId', '$username', '$hashedPassword', '$name', '$email', '$phone', '$foto', '$role')";

                if (mysqli_query($db, $queryLogin)) {
                    echo "<script>
                            Swal.fire({
                                icon: 'success',
                                title: 'Registrasi berhasil',
                                text: 'Silakan login!'
                            });
                          </script>";
                } else {
                    // Hapus data di pengguna_222271 jika gagal insert di login_222271
                    mysqli_query($db, "DELETE FROM pengguna_222271 WHERE id_222271 = '$penggunaId'");

                    echo "<script>
                            Swal.fire({
                                icon: 'error',
                                title: 'Registrasi gagal',
                                text: 'Terjadi kesalahan saat menyimpan data login.'
                            });
                          </script>";
                }
            } else {
                echo "<script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Registrasi gagal',
                            text: '" . mysqli_error($db) . "'
                        });
                      </script>";
            }
        }
    }
}

// Fungsi Login
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['loginUsername'])) {
    $username = mysqli_real_escape_string($db, $_POST['loginUsername']);
    $password = $_POST['loginPassword'];

    $query = "SELECT * FROM login_222271 WHERE username_222271 = '$username'";
    $result = mysqli_query($db, $query);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        if (password_verify($password, $user['password_222271'])) {
            $_SESSION['user'] = $user;
            $_SESSION['userPhoto'] = $user['foto_222271'];

            // Redirect berdasarkan peran
            $redirectUrl = ($user['role_222271'] === 'admin') ? 'dhasboard.php  ' : 'index.php';
            $greeting = ($user['role_222271'] === 'admin')
                ? "Selamat datang, Admin {$user['nama_222271']}!"
                : "Selamat datang, {$user['nama_222271']}!";

            echo "<script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Login berhasil',
                        text: '$greeting'
                    }).then(() => {
                        window.location.href = '$redirectUrl';
                    });
                  </script>";
        } else {
            echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Password salah!',
                        text: 'Silakan coba lagi.'
                    });
                  </script>";
        }
    } else {
        echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Login gagal!',
                    text: 'Username tidak ditemukan.'
                });
              </script>";
    }
}
?>



    <!DOCTYPE html>
    <html lang="id">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login & Registrasi</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="<link rel=" preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">">
        <style>
            body {


                margin: 0;
                /* Hilangkan margin bawaan */
                padding: 0;
                /* Hilangkan padding bawaan */
                overflow: hidden;
                /* Hindari scrolling */
                width: 100%;
                /* Pastikan elemen mengisi seluruh lebar viewport */
                height: 100%;
                /* Pastikan elemen mengisi seluruh tinggi viewport */


                background-image: url('img/Arsitag-1536x864.webp');
                background-size: cover;
                background-repeat: no-repeat;
                background-position: center;
                height: 100vh;
                font-family: "Poppins",
                    serif;
                font-weight: 100;
                font-style: normal;
            }

            .card {
                backdrop-filter: blur(10px);
                background-color: rgba(255, 255, 255, 0.85);
                border-radius: 12px;
                box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
                transition: transform 0.3s ease, box-shadow 0.3s ease;
            }

            .card:hover {
                transform: translateY(-10px);
                box-shadow: 0 15px 30px rgba(0, 0, 0, 0.4);
            }

            .btn-primary {
                background-color: #007bff;
                border: none;
                transition: background-color 0.3s ease, transform 0.2s ease;
                border-radius: 8px;
            }

            .btn-primary:hover {
                background-color: #0056b3;
                transform: scale(1.05);
            }

            .form-control:focus {
                border-color: #007bff;
                box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
            }

            h3 {
                font-weight: bold;
                color: #333;
            }

            label {
                font-weight: 500;
            }

            .modal-content {
                border-radius: 10px;
                box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            }

            .modal-header {
                border-bottom: none;
            }

            .btn-close {
                background-color: #007bff;
                border: none;
                border-radius: 50%;
                padding: 0.4rem;
                color: white;
            }

            .btn-close:hover {
                background-color: #0056b3;
            }

            .btn-secondary {
                background-color: #6c757d;
                border: none;
                border-radius: 8px;
                transition: background-color 0.3s ease, transform 0.2s ease;
            }

            .btn-secondary:hover {
                background-color: #5a6268;
                transform: scale(1.05);
            }

            .ripple {
                position: absolute;
                width: 100px;
                height: 100px;
                background: rgba(255, 255, 255, 0.5);
                border-radius: 50%;
                transform: scale(0);
                animation: ripple-effect 0.6s linear;
            }

            @keyframes ripple-effect {
                to {
                    transform: scale(4);
                    opacity: 0;
                }
            }

            .btn {
                position: relative;
                overflow: hidden;
            }
        </style>
    </head>

    <body>
        <div class="container d-flex justify-content-center align-items-center vh-100">
            <div class="card shadow-lg p-4" style="width: 24rem;">
                <h3 class="text-center mb-4">Silakan Login</h3>
                <form method="POST" action="">
                    <div class="mb-3">
                        <label for="loginUsername" class="form-label">Username</label>
                        <input type="text" class="form-control" id="loginUsername" name="loginUsername" required>
                    </div>
                    <div class="mb-3">
                        <label for="loginPassword" class="form-label">Password</label>
                        <input type="password" class="form-control" id="loginPassword" name="loginPassword" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 mb-2" id="loginButton">Login</button>
                    <button type="button" class="btn btn-secondary w-100" data-bs-toggle="modal" data-bs-target="#registerModal">Daftar</button>
                </form>
            </div>
        </div>

        <!-- Modal Registrasi -->
        <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="registerModalLabel">Registrasi Akun</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="registerName" class="form-label">Nama</label>
                                <input type="text" class="form-control" id="registerName" name="registerName" required>
                            </div>
                            <div class="mb-3">
                                <label for="registerEmail" class="form-label">Email</label>
                                <input type="email" class="form-control" id="registerEmail" name="registerEmail" required>
                            </div>
                            <div class="mb-3">
                                <label for="registerPhone" class="form-label">No HP</label>
                                <input type="text" class="form-control" id="registerPhone" name="registerPhone" required>
                            </div>
                            <div class="mb-3">
                                <label for="registerUsername" class="form-label">Username</label>
                                <input type="text" class="form-control" id="registerUsername" name="registerUsername" required>
                            </div>
                            <div class="mb-3">
                                <label for="registerPassword" class="form-label">Password</label>
                                <input type="password" class="form-control" id="registerPassword" name="registerPassword" required>
                            </div>
                            <div class="mb-3">
                                <label for="registerPasswordConfirm" class="form-label">Konfirmasi Password</label>
                                <input type="password" class="form-control" id="registerPasswordConfirm" name="registerPasswordConfirm" required>
                            </div>
                            <div class="mb-3">
                                <label for="registerRole" class="form-label">Role</label>
                                <select class="form-select" id="registerRole" name="registerRole" required>
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
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>
            document.querySelector('form').addEventListener('submit', function(e) {
                const username = document.getElementById('loginUsername');
                const password = document.getElementById('loginPassword');

                if (username.value.trim() === '' || password.value.trim() === '') {
                    e.preventDefault();
                    Swal.fire({
                        icon: 'warning',
                        title: 'Kolom kosong!',
                        text: 'Harap isi semua kolom!'
                    });
                }
            });

            // Animasi Klik Tombol
            document.getElementById('loginButton').addEventListener('click', function() {
                this.innerHTML = "Loading...";
                setTimeout(() => {
                    this.innerHTML = "Login";
                }, 2000);
            });

            // Efek Ripple pada tombol
            document.querySelectorAll('.btn').forEach(button => {
                button.addEventListener('click', function(e) {
                    let rect = button.getBoundingClientRect();
                    let ripple = document.createElement('span');
                    ripple.style.left = e.clientX - rect.left + "px";
                    ripple.style.top = e.clientY - rect.top + "px";
                    ripple.className = "ripple";
                    button.appendChild(ripple);

                    setTimeout(() => {
                        ripple.remove();
                    }, 600);
                });
            });

            // Validasi Form Login
            const loginForm = document.querySelector('form');
            loginForm.addEventListener('submit', function(e) {
                const username = document.getElementById('loginUsername');
                const password = document.getElementById('loginPassword');

                if (username.value.trim() === '' || password.value.trim() === '') {
                    e.preventDefault();
                    alert('Harap isi semua kolom!');
                }
            });

            // Animasi Transisi Modal
            const modal = document.getElementById('registerModal');
            modal.addEventListener('show.bs.modal', function() {
                modal.style.opacity = '0';
                setTimeout(() => {
                    modal.style.opacity = '1';
                    modal.style.transition = 'opacity 0.5s';
                }, 100);
            });

            // Highlight Input Field Aktif
            const inputs = document.querySelectorAll('.form-control');
            inputs.forEach(input => {
                input.addEventListener('focus', () => {
                    input.style.boxShadow = '0 0 10px rgba(0, 123, 255, 0.8)';
                });
                input.addEventListener('blur', () => {
                    input.style.boxShadow = '';
                });
            });
        </script>
    </body>

    </html>