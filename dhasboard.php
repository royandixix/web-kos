<?php


require 'config/fungsi.php'; // Pindahkan ini setelah session_start()

// // Cek jika pengguna sudah login
// if (!isset($_SESSION['user'])) {
//     header("Location: login.php"); // Redirect ke halaman login jika belum login
//     exit;
// }

// // Cek apakah pengguna adalah admin
// if ($_SESSION['user']['role'] !== 'admin') {
//     header("Location: index.php"); // Redirect ke halaman beranda jika bukan admin
//     exit;
// }

// Ambil semua data dari tabel 'barang'
// Query untuk mengambil semua data dari transaksi_222271
// Ambil data dari kedua tabel dengan JOIN berdasarkan penghuni_id_222271

// Ambil data transaksi dan penghuni
$sql = "SELECT t.id_222271, t.nama_222271, p.email_222271, p.telepon_222271
        FROM transaksi_222271 t
        LEFT JOIN penyewaan_kos_222271 p ON t.penghuni_id_222271 = p.id_222271";
$rows = query($sql);  // Mengambil hasil query

// Ambil total penghuni
$totalPenghuniQuery = query("SELECT COUNT(*) AS total FROM pengguna_222271");
$totalPenghuni = $totalPenghuniQuery[0]['total'] ?? 0; // Mengambil total atau default ke 0 jika tidak ada

// Proses login
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Pastikan fungsi loginPengguna() benar-benar ada dan berfungsi dengan baik
    $user = loginPengguna($db, $username, $password);

    if ($user) {
        // Simpan informasi pengguna ke dalam sesi
        $_SESSION['user'] = [
            'name' => $user['nama_222271'],
            'role' => $user['role_222271'],
            'profile_pic' => 'uploads/' . $user['profile_pic'] // Menyimpan path lengkap ke foto
        ];

        // Redirect ke halaman dashboard setelah login berhasil
        header("Location: dashboard.php"); // Pastikan nama file yang benar
        exit;
    } else {
        // Jika login gagal, beri pesan error
        $error = "Username atau password salah!";
    }
}
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
</head>
<style>
    /* Button Edit Styling */
    .btn-warning {
        background-color: #ffc107;
        color: #ffffff;
        padding: 5px 10px;
        border: none;
        border-radius: 4px;
        font-size: 0.9em;
        cursor: pointer;
        text-decoration: none;
    }

    .btn-warning:hover {
        background-color: #e0a800;
    }

    /* Button Hapus Styling */
    .btn-danger {
        background-color: #dc3545;
        color: #ffffff;
        padding: 5px 10px;
        border: none;
        border-radius: 4px;
        font-size: 0.9em;
        cursor: pointer;
        text-decoration: none;
    }

    .btn-danger:hover {
        background-color: #c82333;
    }

    /* Small Button Styling */
    .btn-sm {
        padding: 5px 8px;
        font-size: 0.85em;
    }

    /* Add spacing between buttons */
    td a.btn {
        margin-right: 5px;
        /* Adds a small space between the buttons */
    }

    /* For smaller screens, increase margin slightly for clarity */
    @media (max-width: 500px) {
        td a.btn {
            margin-right: 10px;
            margin-bottom: 5px;
            /* Adds space below each button */
        }
    }

    .welcome-text {
        margin-left: 50px;
        /* Jarak ke kiri */
        margin-top: 60px;
        /* Jarak ke atas */
    }
</style>


<body>
    <!-- =============== Navigation ================ -->
    <div class="container">
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
                    <a href="dataUser.php">
                        <span class="icon">
                            <ion-icon name="people-outline"></ion-icon>
                        </span>
                        <span class="title">Penghuni Kost</span>
                    </a>
                </li>


                <li>
                    <a href="dataAdmin.php">
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
                    <a href="addTransaksi.php">
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
                    <a href="index.php">
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
                        <h2>Semua Pengguna yang Telah Bergabung dan Aktif di Sistem</h2>

                    </div>

                    <table>
                        <thead>
                            <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>No HP</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($rows as $row): ?>
                                <tr>
                                    
                                    <td><?php echo $row['nama_222271']; ?></td>
                                    <td><?php echo $row['email_222271']; ?></td>
                                    <td><?php echo $row['telepon_222271']; ?></td> <!-- Menampilkan nomor telepon -->
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>


                </div>

                <!-- ================= New Customers ================ -->
                <div class="recentCustomers">
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
                </div>
            </div>
        </div>
    </div>

    <!-- =========== Scripts =========  -->
    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Hapus Data?',
                text: "Data ini akan dihapus!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirect ke delete.php jika konfirmasi
                    window.location.href = 'delete.php?id=' + id;

                    // Tampilkan SweetAlert sukses setelah penghapusan
                    Swal.fire({
                        title: "Sukses!",
                        text: "Data berhasil dihapus.",
                        icon: "success",
                        confirmButtonText: 'OK',
                        timer: 9000, // Durasi dalam milidetik (3 detik)
                        timerProgressBar: true // Menampilkan progress bar
                    }).then(() => {
                        window.location.reload(); // Muat ulang halaman setelah alert ditutup
                    });
                }
            });
        }
    </script>
    <script src="dhasboard/assets/js/main.js"></script>

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>