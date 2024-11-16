<?php
require 'config/fungsi.php';

// Proses form ketika data dikirim dengan method POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Menangkap data dari form
    $alamat = mysqli_real_escape_string($db, $_POST['alamat_222271']);
    $harga = (int)$_POST['harga_222271'];  // Konversi ke integer
    $deskripsi = mysqli_real_escape_string($db, $_POST['deskripsi_222271']);
    $tanggalTersedia = mysqli_real_escape_string($db, $_POST['tanggal_tersedia_222271']);
    $fasilitas = mysqli_real_escape_string($db, $_POST['fasilitas_222271']);
    $ukuran = mysqli_real_escape_string($db, $_POST['ukuran_222271']);
    $rating = (float)$_POST['rating_222271'];  // Konversi ke float

    // Proses gambar (untuk multiple file)
    $fotoPaths = [];
    if (isset($_FILES['foto_222271'])) {
        $foto = $_FILES['foto_222271'];

        for ($i = 0; $i < count($foto['name']); $i++) {
            $fileName = basename($foto['name'][$i]);
            $fileTmp = $foto['tmp_name'][$i];
            $fileSize = $foto['size'][$i];
            $fileType = $foto['type'][$i];
            $fileError = $foto['error'][$i];

            // Validasi jenis file
            $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
            if (!in_array($fileType, $allowedTypes)) {
                echo "File {$fileName} bukan gambar yang diperbolehkan.";
                continue;
            }

            // Validasi ukuran file (maksimal 2 MB)
            if ($fileSize > 2 * 1024 * 1024) {
                echo "File {$fileName} terlalu besar (maksimal 2 MB).";
                continue;
            }

            // Tentukan nama unik untuk file
            $uniqueName = uniqid() . '_' . $fileName;
            $fotoPath = 'uploads/' . $uniqueName;

            // Pindahkan file ke folder uploads
            if (move_uploaded_file($fileTmp, $fotoPath)) {
                $fotoPaths[] = $uniqueName;
            } else {
                echo "Gagal mengupload file {$fileName}.";
            }
        }
    }

    // Gabungkan foto yang diupload menjadi string yang dipisahkan koma
    $fotoPathsString = implode(',', $fotoPaths);

    // SQL query untuk memasukkan data ke database
    $sql = "INSERT INTO kamar_222271 (alamat_222271, harga_222271, deskripsi_222271, tanggal_tersedia_222271, fasilitas_222271, foto_222271, ukuran_222271, rating_222271) 
            VALUES ('$alamat', '$harga', '$deskripsi', '$tanggalTersedia', '$fasilitas', '$fotoPathsString', '$ukuran', '$rating')";

    // Eksekusi query
    if ($db->query($sql) === TRUE) {
        echo "Kamar berhasil ditambahkan!";
    } else {
        echo "Error: " . $db->error;
    }
}

// Mengambil data pengguna dari database
$rows = mysqli_query($db, "SELECT * FROM pengguna_222271");

// Menghitung total penghuni
$totalPenghuniQuery = mysqli_query($db, "SELECT COUNT(*) AS total FROM pengguna_222271");
$totalPenghuni = mysqli_fetch_assoc($totalPenghuniQuery)['total'] ?? 0;
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
                    <a href="dataKost.php#">
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
            <!-- ================ Order Details List ================= -->
            <div class="details">
                <div class="recentOrders">
                    <div class="cardHeader">
                        <h2>Tambah Kamar Kos</h2>
                        <a href="dashboard.php" class="btn">Kembali</a>
                    </div>
                    <form action="" method="POST" id="addRoomForm" enctype="multipart/form-data">
                        <!-- Form Fields -->
                        <div class="form-group mb-3">
                            <label for="alamat_222271">Alamat Kos</label>
                            <textarea name="alamat_222271" id="alamat_222271" class="form-control" placeholder="Masukkan alamat lengkap kos" required></textarea>
                        </div>
                        <div class="form-group mb-3">
                            <label for="harga_222271">Harga per Bulan</label>
                            <input type="text" name="harga_222271" id="harga_222271" class="form-control" placeholder="Contoh: 1.000.000" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="deskripsi_222271">Deskripsi Kamar</label>
                            <textarea name="deskripsi_222271" id="deskripsi_222271" class="form-control" placeholder="Masukkan deskripsi kamar" required></textarea>
                        </div>
                        <div class="form-group mb-3">
                            <label for="tanggal_tersedia_222271">Tanggal</label>
                            <input type="date" name="tanggal_tersedia_222271" id="tanggal_tersedia_222271" class="form-control" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="fasilitas_222271">Fasilitas</label>
                            <textarea name="fasilitas_222271" id="fasilitas_222271" class="form-control" placeholder="Contoh: AC, Wi-Fi, Kamar Mandi Dalam" required></textarea>
                        </div>
                        <div class="form-group mb-3">
                            <label for="foto_222271">Foto Kamar</label>
                            <input type="file" name="foto_222271[]" id="foto_222271" class="form-control" accept="image/*" multiple required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="ukuran_222271">Ukuran Kamar</label>
                            <input type="text" name="ukuran_222271" id="ukuran_222271" class="form-control" placeholder="Contoh: 3x4 meter" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="rating_222271">Rating Kamar</label>
                            <input type="number" step="0.1" name="rating_222271" id="rating_222271" class="form-control" placeholder="Contoh: 4.5" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Tambah Kamar</button>
                    </form>

                </div>
            </div>

            <!-- =========== Scripts =========  -->
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script src="dhasboard/assets/js/main.js"></script>
            <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
            <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
            <script>
                // // Fungsi untuk format input harga
                // function formatHarga(input) {
                //     // Hapus karakter selain angka dan koma/titik
                //     let value = input.value.replace(/[^0-9,\.]/g, '');

                //     // Jika terdapat lebih dari satu koma atau titik, hanya ambil yang pertama
                //     if (value.indexOf(',') !== value.lastIndexOf(',')) {
                //         value = value.substring(0, value.indexOf(',') + 1) + value.substring(value.lastIndexOf(',') + 1);
                //     }

                //     if (value.indexOf('.') !== value.lastIndexOf('.')) {
                //         value = value.substring(0, value.indexOf('.') + 1) + value.substring(value.lastIndexOf('.') + 1);
                //     }

                //     // Format angka dengan titik untuk ribuan
                //     value = value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');

                //     // Jika ada koma, pastikan hanya ada 2 digit setelah koma
                //     let parts = value.split(',');
                //     if (parts.length > 1) {
                //         parts[1] = parts[1].slice(0, 2); // Membatasi dua digit setelah koma
                //         value = parts.join(',');
                //     }

                //     input.value = value;
                // }
            </script>

</body>

</html>