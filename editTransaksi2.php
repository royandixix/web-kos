<?php
require 'config/fungsi.php';

// Koneksi ke database
$db = mysqli_connect("localhost", "root", "", "222271_royandi");

$rows = query("SELECT * FROM pengguna_222271");

$totalPenghuniQuery = query("SELECT COUNT(*) AS total FROM pengguna_222271");
$totalPenghuni = $totalPenghuniQuery[0]['total'] ?? 0; // Mengambil total atau default ke 0 jika tidak ada

// Fungsi untuk mengambil data transaksi berdasarkan ID
function getTransaksiById($db, $id_transaksi)
{
    $query = "
        SELECT 
            transaksi_222271.id_222271 AS id_transaksi,
            penyewaan_kos_222271.nama_222271 AS nama,
            penyewaan_kos_222271.metode_pembayaran_222271 AS metode_pembayaran,
            penyewaan_kos_222271.harga_222271 AS harga,
            transaksi_222271.penghuni_id_222271 AS penghuni_id,
            transaksi_222271.kamar_id_222271 AS kamar_id,
            transaksi_222271.tanggal_transaksi_222271 AS tanggal_transaksi,
            transaksi_222271.jenis_transaksi_222271 AS jenis_transaksi,
            transaksi_222271.jumlah_222271 AS jumlah,
            transaksi_222271.status_222271 AS status
        FROM 
            transaksi_222271
        JOIN 
            penyewaan_kos_222271 
        ON 
            transaksi_222271.penghuni_id_222271 = penyewaan_kos_222271.id_222271
        WHERE 
            transaksi_222271.id_222271 = $id_transaksi
    ";

    $result = mysqli_query($db, $query);

    // Cek jika ada hasil
    if ($result && mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result);
    }
    return null;
}

// Fungsi untuk mengambil daftar metode pembayaran
function getMetodePembayaran($db)
{
    $query = "SELECT DISTINCT metode_pembayaran_222271 FROM penyewaan_kos_222271";
    $result = mysqli_query($db, $query);

    $metode_pembayaran = [];
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $metode_pembayaran[] = $row['metode_pembayaran_222271'];
        }
    }
    return $metode_pembayaran;
}

// Dapatkan data transaksi berdasarkan ID yang diberikan
$id_transaksi = 1; // ID transaksi yang ingin ditampilkan
$transaksi = getTransaksiById($db, $id_transaksi);

// Dapatkan daftar metode pembayaran
$metodePembayaranList = getMetodePembayaran($db);
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
                    <form action="" method="POST">
                        <!-- ID Penghuni dan ID Kamar disembunyikan -->
                        <input type="hidden" name="penghuni_id" id="penghuni_id" value="<?php echo htmlspecialchars($transaksi['penghuni_id']); ?>">
                        <input type="hidden" name="kamar_id" id="kamar_id" value="<?php echo htmlspecialchars($transaksi['kamar_id']); ?>">

                        <div class="form-group mb-3">
                            <label for="tanggal_transaksi">Tanggal Transaksi</label>
                            <input type="date" name="tanggal_transaksi" id="tanggal_transaksi" class="form-control" value="<?php echo htmlspecialchars($transaksi['tanggal_transaksi']); ?>" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="jenis_transaksi">Jenis Transaksi</label>
                            <select name="jenis_transaksi" id="jenis_transaksi" class="form-control" required>
                                <?php foreach ($metodePembayaranList as $metode): ?>
                                    <option value="<?php echo htmlspecialchars($metode); ?>" <?php echo ($transaksi['jenis_transaksi'] == $metode) ? 'selected' : ''; ?>>
                                        <?php echo htmlspecialchars($metode); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="jumlah">Jumlah</label>
                            <input type="number" step="0.01" name="jumlah" id="jumlah" class="form-control" value="<?php echo htmlspecialchars($transaksi['jumlah']); ?>" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control" required>
                                <option value="lunas" <?php echo ($transaksi['status'] == 'lunas') ? 'selected' : ''; ?>>Lunas</option>
                                <option value="belum lunas" <?php echo ($transaksi['status'] == 'belum lunas') ? 'selected' : ''; ?>>Belum Lunas</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Perbarui</button>
                        <a href="admin.php" class="btn btn-secondary">Kembali</a>
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