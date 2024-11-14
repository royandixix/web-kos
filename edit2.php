<?php
session_start(); // Pastikan ini di awal file

require 'config/fungsi.php'; // Pindahkan ini setelah session_start()

// Cek jika pengguna sudah login
if (!isset($_SESSION['user'])) {
    header("Location: login.php"); // Redirect ke halaman login jika belum login
    exit;
}

// Ambil semua data dari tabel 'pengguna'
$rows = query("SELECT * FROM pengguna_222271");

$totalPenghuniQuery = query("SELECT COUNT(*) AS total FROM pengguna_222271");
$totalPenghuni = $totalPenghuniQuery[0]['total'] ?? 0; // Mengambil total atau default ke 0 jika tidak ada

// Proses login pengguna
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $user = loginPengguna($username, $password); // Hapus parameter $db
    if ($user) {
        // Simpan informasi pengguna ke dalam sesi
        $_SESSION['user'] = [
            'name' => $user['nama_222271'],
            'role' => $user['role_222271'],
            'profile_pic' => 'uploads/' . $user['foto_222271'] // Menyimpan path lengkap ke foto
        ];
        header("Location: dhasboard.php"); // Redirect ke halaman dashboard
        exit;
    } else {
        $error = "Username atau password salah!";
    }
}

// Cek apakah ID ada dalam URL
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($db, $_GET['id']);
    $user = ambilDataPengguna($id); // Hapus parameter $db

    if (!$user) {
        header("Location: dhasboard.php"); // Redirect ke halaman dashboard jika pengguna tidak ditemukan
        exit;
    }
} else {
    header("Location: dhasboard.php"); // Redirect ke halaman dashboard jika ID tidak valid
    exit;
}

// Proses pengiriman form
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = mysqli_real_escape_string($db, $_POST['name']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $phone = mysqli_real_escape_string($db, $_POST['phone']);
    $role = mysqli_real_escape_string($db, $_POST['role']);

    // Perbarui pengguna di database
    if (perbaruiPengguna($id, $name, $email, $phone, $role)) { // Hapus parameter $db
        header("Location: dhasboard.php"); // Redirect ke halaman dashboard setelah perbaruan
        exit;
    } else {
        echo "Error: " . mysqli_error($db);
    }
}

// Tutup koneksi database di sini, setelah semua proses selesai
mysqli_close($db);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Admin Dashboard | Korsat X Parmaga</title>
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="dhasboard/assets/css/style.css">
    <style>
        /* Atur box-sizing untuk semua elemen */
        * {
            box-sizing: border-box;
        }

        /* Container Styling */
        .details {
            display: flex;
            justify-content: center;
            align-items: center;

            padding: 10px;
            max-width: 100%;
            overflow-y: auto;
        }

        .recentOrders {
            width: 100%;
            max-width: 900px;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow-x: auto;
        }

        .cardHeader {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .cardHeader h2 {
            font-size: 1.5em;
            font-weight: bold;
            color: #333333;
        }

        .cardHeader .btn {
            background-color: #007bff;
            color: #ffffff;
            padding: 8px 16px;
            border-radius: 4px;
            text-decoration: none;
        }

        .cardHeader .btn:hover {
            background-color: #0056b3;
        }

        /* Form Styling */
        form {
            display: flex;
            flex-direction: column;
            max-width: 100%;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            font-weight: 600;
            margin-bottom: 5px;
            display: block;
        }

        .form-control {
            padding: 10px;
            font-size: 1em;
            border-radius: 4px;
            border: 1px solid #ddd;
            width: 100%;
            box-sizing: border-box;
        }

        .form-control:focus {
            outline: none;
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }

        select.form-control {
            appearance: none;
        }

        /* Button Styling */
        .btn-primary {
            background-color: #007bff;
            color: #ffffff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1em;
            width: 100%;
            margin-top: 10px;
            text-decoration: none;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .btn-secondary {
            background-color: #6c757d;
            color: #ffffff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1em;
            width: 100%;
            margin-top: 10px;
            text-decoration: none;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
        }

        /* Responsiveness */
        @media (max-width: 768px) {
            .details {
                flex-direction: column;
                padding: 5px;
            }

            .recentOrders {
                width: 95%;
                margin: 0 auto;
            }
        }

        .welcome-text {
            margin-left: 50px;
            /* Jarak ke kiri */
            margin-top: 60px;
            /* Jarak ke atas */
        }

        .details {
            display: flex;
            justify-content: flex-start;
            padding-right: 20px;
            /* untuk memberikan ruang */
        }

        .details .recentOrders {
            width: 100%;
            overflow-x: auto;
            /* Memungkinkan scrolling horizontal jika tabel lebih lebar dari layar */
        }

        .details .recentOrders table {
            width: 100%;
            /* Buat tabel memenuhi kontainer */
            border-collapse: collapse;
            text-align: left;
        }

        .details .recentOrders table th,
        .details .recentOrders table td {
            padding: 12px 15px;
        }

        .details .recentOrders .cardHeader h2 {
            text-align: left;
            padding: 10px 0;
        }
    </style>


</head>

<body>
    <!-- =============== Navigation ================ -->
    <div class="">
        <div class="navigation">
            <ul>
                <li>
                    <a href="#" class="d-flex align-items-center">

                        <span class="col-md-4 text-left welcome-text">Selamat Datang Di <br> Dashboard</span>
                    </a>

                </li>

                <li>
                    <a href="dhasboard.php">
                        <span class="icon">
                            <ion-icon name="logo-apple"></ion-icon>
                        </span>
                        <span class="title">Kembali Ke Halaman Utama</span>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="people-outline"></ion-icon>
                        </span>
                        <span class="title">Penghuni Kost</span>
                    </a>
                </li>


                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="people-outline"></ion-icon>
                        </span>
                        <span class="title">Data Admin Kost</span>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="chatbubble-outline"></ion-icon>
                        </span>
                        <span class="title">Pesan</span>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="cash-outline"></ion-icon>
                        </span>
                        <span class="title">Transaksi Pembayaran</span>
                    </a>
                </li>

                <li>
                    <a href="dataKost.php">
                        <span class="icon">
                            <ion-icon name="settings-outline"></ion-icon>
                        </span>
                        <span class="title">Kateori Kamar</span>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="lock-closed-outline"></ion-icon>
                        </span>
                        <span class="title">Ubah Password</span>
                    </a>
                </li>

                <li>
                    <a href="logout.php">
                        <span class="icon">
                            <ion-icon name="log-out-outline"></ion-icon>
                        </span>
                        <span class="title">Keluar</span>
                    </a>
                </li>

            </ul>
        </div>

        <!-- ========================= Main ==================== -->
        <div class="main">
            <div class="topbar">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>

                <div class="search">
                    <label>
                        <input type="text" placeholder="Search here">
                        <ion-icon name="search-outline"></ion-icon>
                    </label>
                </div>
                <div class="user flex items-center">
                    <img class="profile-pic" src="<?php echo $_SESSION['user']['foto_222271'] ?? 'default.jpg'; ?>" alt="Profile Picture">
                    <span class="username ml-2"><?php echo $_SESSION['user']['nama_222271'] ?? 'Nama Pengguna'; ?></span>
                </div>



            </div>

            <!-- ======================= Cards ================== -->
            <div class="cardBox">
                <div class="card">
                    <div>
                        <div class="numbers"><?php echo $totalPenghuni; ?></div>
                        <div class="cardName">Penghuni Saat Ini</div>
                    </div>
                    <div class="iconBx">
                        <ion-icon name="people-outline"></ion-icon>
                    </div>
                </div>

                <div class="card">
                    <div>
                        <div class="numbers">20</div>
                        <div class="cardName">Kamar Tersedia</div>
                    </div>
                    <div class="iconBx">
                        <ion-icon name="home-outline"></ion-icon>
                    </div>
                </div>

                <div class="card">
                    <div>
                        <div class="numbers">50</div>
                        <div class="cardName">Pesan Masuk</div>
                    </div>
                    <div class="iconBx">
                        <ion-icon name="chatbubble-outline"></ion-icon>
                    </div>
                </div>

                <div class="card">
                    <div>
                        <div class="numbers">$5,200</div>
                        <div class="cardName">Total Pendapatan</div>
                    </div>
                    <div class="iconBx">
                        <ion-icon name="cash-outline"></ion-icon>
                    </div>
                </div>
            </div>


            <!-- ================ Order Details List ================= -->
            <div class="details">
                <div class="recentOrders">
                    <div class="cardHeader">
                        <h2>Edit Pengguna</h2>
                        <a href="dhasboard.php" class="btn">Kembali</a>
                    </div>
                    <h3 class="text-center"></h3>
                    <form action="" method="POST" id="updateForm">
                        <div class="form-group mb-3">
                            <label for="name">Nama</label>
                            <input type="text" name="name" id="name" class="form-control" value="<?php echo htmlspecialchars($user['nama_222271']); ?>" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control" value="<?php echo htmlspecialchars($user['email_222271']); ?>" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="phone">No HP</label>
                            <input type="text" name="phone" id="phone" class="form-control" value="<?php echo htmlspecialchars($user['nomorTelepon_222271']); ?>" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="role">Role</label>
                            <select name="role" id="role" class="form-control" required>
                                <option value="penghuni" <?php echo ($user['role_222271'] == 'penghuni') ? 'selected' : ''; ?>>Penghuni</option>
                                <option value="pemilik" <?php echo ($user['role_222271'] == 'pemilik') ? 'selected' : ''; ?>>Pemilik</option>
                                <option value="admin" <?php echo ($user['role_222271'] == 'admin') ? 'selected' : ''; ?>>Admin</option>
                            </select>
                        </div>
                        <button type="button" id="submitButton" class="btn btn-primary">Perbarui</button>
                    </form>

                </div>

                <!-- ================= New Customers ================ -->
                <!-- <div class="recentCustomers">
                    <div class="cardHeader">
                        <h2>Profil Penguni Kos</h2>
                    </div>

                    <table>
                        <?php foreach ($rows as $row): ?>
                            <tr>
                                <td width="60px">
                                    <div class="imgBx"><img src="<?php echo $row['foto_222271']; ?>" alt="Foto Profil"></div>
                                </td>
                                <td>
                                    <h4><?php echo $row['nama_222271']; ?></span></h4>
                                </td>
                            </tr>
                        <?php endforeach; ?>


                    </table>
                </div> -->
            </div>
        </div>
    </div>

    <!-- =========== Scripts =========  -->
    <script>
        document.getElementById('submitButton').addEventListener('click', function() {
            // Tampilkan SweetAlert untuk konfirmasi
            Swal.fire({
                title: "Apakah Anda yakin?",
                text: "Data akan diperbarui!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: 'Ya, perbarui!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika pengguna mengkonfirmasi, kirim form
                    document.getElementById('updateForm').submit();

                    // Tampilkan SweetAlert sukses setelah form disubmit
                    Swal.fire({
                        title: "Sukses!",
                        text: "Pengguna berhasil diperbarui.",
                        icon: "success",
                        confirmButtonText: 'OK',
                        timer: 9000, // Durasi dalam milidetik (3 detik)
                        timerProgressBar: true // Menampilkan progress bar
                    }).then(() => {
                        window.location.href = 'dhasboard.php'; // Arahkan ke dashboard
                    });
                }
            });
        });
    </script>


    <script src="dhasboard/assets/js/main.js"></script>
    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>