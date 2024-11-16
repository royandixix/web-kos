<?php
require 'config/fungsi.php';

// Query untuk mendapatkan data
$query = "SELECT * FROM kamar_222271";
$result = mysqli_query($db, $query);

// Periksa apakah ada data
if (!$result) {
    die("Query error: " . mysqli_error($db));
}

// Simpan hasil query ke dalam array menggunakan mysqli_fetch_all
$data_kamar = mysqli_fetch_all($result, MYSQLI_ASSOC);
$rows = query("SELECT * FROM penyewaan_kos_222271");

$totalPenghuniQuery = query("SELECT COUNT(*) AS total FROM pengguna_222271");
$totalPenghuni = $totalPenghuniQuery[0]['total'] ?? 0; // Mengambil total atau default ke 0 jika tidak ada
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
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> -->
</head>
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
                        <h2>Data Admin</h2>
                        <a href="addKamar.php" class="btn-tambah">Tambah Data Kamar Kost</a>
                    </div>

                    <table>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Alamat</th>
                                <th>Harga</th>
                                <th>Status</th>
                                <th>Deskripsi</th>
                                <th>Tanggal Tersedia</th>
                                <th>Fasilitas</th>
                                <th>Foto</th>
                                <th>Ukuran</th>
                                <th>Rating</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data_kamar as $row): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($row['id_222271']); ?></td>
                                    <td><?php echo htmlspecialchars($row['alamat_222271']); ?></td>
                                    <td><?php echo htmlspecialchars(number_format($row['harga_222271'], 2)); ?></td>
                                    <td><?php echo htmlspecialchars($row['status_222271']); ?></td>
                                    <td><?php echo htmlspecialchars($row['deskripsi_222271']); ?></td>
                                    <td><?php echo htmlspecialchars($row['tanggal_tersedia_222271']); ?></td>
                                    <td><?php echo htmlspecialchars($row['fasilitas_222271']); ?></td>
                                    <td>
                                        <?php
                                        // Mengambil nama file gambar dari kolom foto_222271
                                        $foto_path = htmlspecialchars($row['foto_222271']);

                                        // Membuat path gambar lengkap dari folder 'uploads/'
                                        $upload_dir = 'uploads/';
                                        $full_path = $upload_dir . $foto_path;

                                        // Cek apakah gambar ada dan bisa diakses
                                        if (!empty($foto_path) && file_exists($full_path)) {
                                            echo '<img src="' . $full_path . '" alt="Foto Kamar" style="max-width: 100px; height: auto;">';
                                        } else {
                                            // Menampilkan gambar placeholder jika gambar tidak ditemukan
                                            echo '<img src="uploads/placeholder.jpg" alt="Foto Kamar" style="max-width: 100px; height: auto;">';
                                        }
                                        ?>
                                    </td>

                                    <td><?php echo htmlspecialchars($row['ukuran_222271']); ?></td>
                                    <td><?php echo htmlspecialchars($row['rating_222271']); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Konfirmasi Hapus -->
            <div id="deleteConfirmation" style="display:none; position:absolute; background:#fff; border:1px solid #ccc; padding:20px; z-index:1000;">
                <p>Apakah Anda yakin ingin menghapus data ini?</p>
                <button onclick="deleteData()">Ya, Hapus</button>
                <button onclick="cancelDelete()">Batal</button>
            </div>

            <script>
                let deleteId;

                function confirmDelete(id) {
                    deleteId = id;
                    document.getElementById('deleteConfirmation').style.display = 'block';
                }

                function cancelDelete() {
                    document.getElementById('deleteConfirmation').style.display = 'none';
                }

                function deleteData() {
                    window.location.href = 'delete.php?id=' + deleteId; // Redirect to delete script
                }
            </script>

            <style>
                #deleteConfirmation {
                    top: 50%;
                    left: 50%;
                    transform: translate(-50%, -50%);
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                }

                #deleteConfirmation button {
                    margin-right: 10px;
                }
            </style>




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