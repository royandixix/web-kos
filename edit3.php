<?php
// Koneksi ke database
require 'config/fungsi.php';

// Ambil ID pengguna dari URL atau form
$id_pengguna = isset($_GET['id']) ? intval($_GET['id']) : 0; // ID dari URL, pastikan menggunakan method GET

// Periksa apakah ID valid
if ($id_pengguna <= 0) {
    die("ID tidak valid.");
}

// Ambil data pengguna berdasarkan ID
$query = "SELECT * FROM pengguna_222271 WHERE id_222271 = $id_pengguna";
$result = mysqli_query($db, $query);

// Periksa apakah data ditemukan
if (!$result || mysqli_num_rows($result) === 0) {
    die("Data tidak ditemukan.");
}

$data = mysqli_fetch_assoc($result);

// Proses update data
if (isset($_POST['update'])) {
    // Ambil data dari form
    $nama = mysqli_real_escape_string($db, $_POST['nama_222271']);
    $email = mysqli_real_escape_string($db, $_POST['email_222271']);
    $username = mysqli_real_escape_string($db, $_POST['username_222271']);
    $nomorTelepon = mysqli_real_escape_string($db, $_POST['nomorTelepon_222271']);
    $role = mysqli_real_escape_string($db, $_POST['role_222271']);

    // Handle upload foto baru
    $foto = $data['foto_222271']; // Foto lama sebagai default
    if (isset($_FILES['foto_222271']) && $_FILES['foto_222271']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/';
        $fotoName = basename($_FILES['foto_222271']['name']);
        $targetFile = $uploadDir . $fotoName;

        if (move_uploaded_file($_FILES['foto_222271']['tmp_name'], $targetFile)) {
            $foto = $targetFile; // Update dengan foto baru
        } else {
            echo "<script>alert('Gagal mengupload foto.');</script>";
        }
    }

    // Query update
    $update_query = "UPDATE pengguna_222271 SET 
        nama_222271 = '$nama', 
        email_222271 = '$email', 
        username_222271 = '$username', 
        nomorTelepon_222271 = '$nomorTelepon', 
        foto_222271 = '$foto', 
        role_222271 = '$role'
        WHERE id_222271 = $id_pengguna";

    // Eksekusi query
    if (mysqli_query($db, $update_query)) {
        echo "<script>alert('Data berhasil diperbarui!'); window.location.href='dataUser2.php';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui data: " . mysqli_error($db) . "');</script>";
    }
}

// Mengambil data pengguna untuk ditampilkan di form
$rows = mysqli_query($db, "SELECT * FROM pengguna_222271");

// Menghitung total pengguna
$totalPenghuniQuery = mysqli_query($db, "SELECT COUNT(*) AS total FROM pengguna_222271");
$totalPenghuni = mysqli_fetch_assoc($totalPenghuniQuery)['total'] ?? 0;
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Quixlab - Bootstrap Admin Dashboard Template Free</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="main/images/favicon.png" />
    <!-- Pignose Calender -->
    <link href="main/css/pignose.calendar.min.css" rel="stylesheet" />
    <!-- Chartist -->
    <link rel="stylesheet" href="main/css/chartist.min.css" />
    <link rel="stylesheet" href="css/chartist-plugin-tooltip.css" />
    <!-- Custom Stylesheet -->
    <link href="main/css/style.css" rel="stylesheet" />
</head>
<style>
    .table-responsive {
        max-height: 500px;
        overflow-y: auto;
    }

    .table th,
    .table td {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    @media (max-width: 768px) {
        .table-responsive {
            max-height: none;
        }

        .table th,
        .table td {
            font-size: 12px;
            padding: 8px;
        }
    }
</style>

<body>
    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle
                    class="path"
                    cx="50"
                    cy="50"
                    r="20"
                    fill="none"
                    stroke-width="3"
                    stroke-miterlimit="10" />
            </svg>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">
        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
            <div class="brand-logo">
                <a href="index.html">
                    <b class="logo-abbr"><img src="images/logo.png" alt="" /> </b>
                    <span class="logo-compact"><img src="main/images/logo-compact.png" alt="" /></span>
                    <span class="brand-title">
                        <img src="main/images/logo-text.png" alt="" />
                    </span>
                </a>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->

        <!--**********************************
            Header start
        ***********************************-->
        <div class="header">
            <div class="header-content clearfix">
                <div class="nav-control">
                    <div class="hamburger">
                        <span class="toggle-icon"><i class="icon-menu"></i></span>
                    </div>
                </div>
                <div class="header-left">
                    <div class="input-group icons">
                        <div class="input-group-prepend">
                            <span
                                class="input-group-text bg-transparent border-0 pr-2 pr-sm-3"
                                id="basic-addon1"><i class="mdi mdi-magnify"></i></span>
                        </div>
                        <input
                            type="search"
                            class="form-control"
                            placeholder="Search Dashboard"
                            aria-label="Search Dashboard" />
                        <div class="drop-down animated flipInX d-md-none">
                            <form action="#">
                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder="Search" />
                            </form>
                        </div>
                    </div>
                </div>
                <div class="header-right">
                    <ul class="clearfix">
                        <li class="icons dropdown">
                            <a href="javascript:void(0)" data-toggle="dropdown">
                                <i class="mdi mdi-email-outline"></i>
                                <span class="badge badge-pill gradient-1">3</span>
                            </a>
                            <div class="drop-down animated fadeIn dropdown-menu">
                                <div
                                    class="dropdown-content-heading d-flex justify-content-between">
                                    <span class="">3 New Messages</span>
                                    <a href="javascript:void()" class="d-inline-block">
                                        <span class="badge badge-pill gradient-1">3</span>
                                    </a>
                                </div>
                                <div class="dropdown-content-body">
                                    <ul>
                                        <li class="notification-unread">
                                            <a href="javascript:void()">
                                                <img
                                                    class="float-left mr-3 avatar-img"
                                                    src="main/images/avatar/1.jpg"
                                                    alt="" />
                                                <div class="notification-content">
                                                    <div class="notification-heading">Saiful Islam</div>
                                                    <div class="notification-timestamp">
                                                        08 Hours ago
                                                    </div>
                                                    <div class="notification-text">
                                                        Hi Teddy, Just wanted to let you ...
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="notification-unread">
                                            <a href="javascript:void()">
                                                <img
                                                    class="float-left mr-3 avatar-img"
                                                    src="main/images/avatar/2.jpg"
                                                    alt="" />
                                                <div class="notification-content">
                                                    <div class="notification-heading">Adam Smith</div>
                                                    <div class="notification-timestamp">
                                                        08 Hours ago
                                                    </div>
                                                    <div class="notification-text">
                                                        Can you do me a favour?
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void()">
                                                <img
                                                    class="float-left mr-3 avatar-img"
                                                    src="main/images/avatar/3.jpg"
                                                    alt="" />
                                                <div class="notification-content">
                                                    <div class="notification-heading">Barak Obama</div>
                                                    <div class="notification-timestamp">
                                                        08 Hours ago
                                                    </div>
                                                    <div class="notification-text">
                                                        Hi Teddy, Just wanted to let you ...
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void()">
                                                <img
                                                    class="float-left mr-3 avatar-img"
                                                    src="main/images/avatar/4.jpg"
                                                    alt="" />
                                                <div class="notification-content">
                                                    <div class="notification-heading">
                                                        Hilari Clinton
                                                    </div>
                                                    <div class="notification-timestamp">
                                                        08 Hours ago
                                                    </div>
                                                    <div class="notification-text">Hello</div>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <li class="icons dropdown">
                            <a href="javascript:void(0)" data-toggle="dropdown">
                                <i class="mdi mdi-bell-outline"></i>
                                <span class="badge badge-pill gradient-2">3</span>
                            </a>
                            <div
                                class="drop-down animated fadeIn dropdown-menu dropdown-notfication">
                                <div
                                    class="dropdown-content-heading d-flex justify-content-between">
                                    <span class="">2 New Notifications</span>
                                    <a href="javascript:void()" class="d-inline-block">
                                        <span class="badge badge-pill gradient-2">5</span>
                                    </a>
                                </div>
                                <div class="dropdown-content-body">
                                    <ul>
                                        <li>
                                            <a href="javascript:void()">
                                                <span class="mr-3 avatar-icon bg-success-lighten-2"><i class="icon-present"></i></span>
                                                <div class="notification-content">
                                                    <h6 class="notification-heading">
                                                        Events near you
                                                    </h6>
                                                    <span class="notification-text">Within next 5 days</span>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void()">
                                                <span class="mr-3 avatar-icon bg-danger-lighten-2"><i class="icon-present"></i></span>
                                                <div class="notification-content">
                                                    <h6 class="notification-heading">Event Started</h6>
                                                    <span class="notification-text">One hour ago</span>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void()">
                                                <span class="mr-3 avatar-icon bg-success-lighten-2"><i class="icon-present"></i></span>
                                                <div class="notification-content">
                                                    <h6 class="notification-heading">
                                                        Event Ended Successfully
                                                    </h6>
                                                    <span class="notification-text">One hour ago</span>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void()">
                                                <span class="mr-3 avatar-icon bg-danger-lighten-2"><i class="icon-present"></i></span>
                                                <div class="notification-content">
                                                    <h6 class="notification-heading">Events to Join</h6>
                                                    <span class="notification-text">After two days</span>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <li class="icons dropdown d-none d-md-flex">
                            <a
                                href="javascript:void(0)"
                                class="log-user"
                                data-toggle="dropdown">
                                <span>English</span>
                                <i class="fa fa-angle-down f-s-14" aria-hidden="true"></i>
                            </a>
                            <div
                                class="drop-down dropdown-language animated fadeIn dropdown-menu">
                                <div class="dropdown-content-body">
                                    <ul>
                                        <li><a href="javascript:void()">English</a></li>
                                        <li><a href="javascript:void()">Dutch</a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <li class="icons dropdown">
                            <div
                                class="user-img c-pointer position-relative"
                                data-toggle="dropdown">
                                <span class="activity active"></span>
                                <img src="main/images/users/1.png" height="40" width="40" alt="" />
                            </div>
                            <div
                                class="drop-down dropdown-profile animated fadeIn dropdown-menu">
                                <div class="dropdown-content-body">
                                    <ul>
                                        <li>
                                            <a href="app-profile.html"><i class="icon-user"></i> <span>Profile</span></a>
                                        </li>
                                        <li>
                                            <a href="javascript:void()">
                                                <i class="icon-envelope-open"></i> <span>Inbox</span>
                                                <div class="badge gradient-3 badge-pill gradient-1">
                                                    3
                                                </div>
                                            </a>
                                        </li>

                                        <hr class="my-2" />
                                        <li>
                                            <a href="page-lock.html"><i class="icon-lock"></i> <span>Lock Screen</span></a>
                                        </li>
                                        <li>
                                            <a href="page-login.html"><i class="icon-key"></i> <span>Logout</span></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="nk-sidebar">
            <div class="nk-nav-scroll">
                <ul class="metismenu" id="menu">
                    <li class="nav-label">Selamat Datang Di</li>
                    <li>
                        <a href="dhasboard2.php">
                            <i class="fa fa-tachometer menu-icon"></i><span class="nav-text">Dashboard</span>
                        </a>
                    </li>

                    <li>
                        <a href="dataUser2.php">
                            <i class="fa fa-users menu-icon"></i><span class="nav-text">Penghuni Kost</span>
                        </a>
                    </li>
                    <li>
                        <a href="dataAdmin2.php">
                            <i class="fa fa-user-circle menu-icon"></i><span class="nav-text">Data Admin Kost</span>
                        </a>
                    </li>
                    <li>
                        <a href="./pesan.html">
                            <i class="fa fa-envelope menu-icon"></i><span class="nav-text">Pesan</span>
                        </a>
                    </li>
                    <li>
                        <a href="addTransaksi2.php">
                            <i class="fa fa-credit-card menu-icon"></i><span class="nav-text">Transaksi Pembayaran</span>
                        </a>
                    </li>
                    <li>
                        <a href="dataKost2.php">
                            <i class="fa fa-bed menu-icon"></i><span class="nav-text">Kategori Kamar</span>
                        </a>
                    </li>
                    <li>
                        <a href="logout.php">
                            <i class="fa fa-sign-out menu-icon"></i><span class="nav-text">Logout</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!--**********************************
            Sidebar end
        ***********************************-->

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid mt-3">
                <div class="row">
                    <div class="col-lg-3 col-sm-6">
                        <div class="card gradient-1">
                            <div class="card-body">
                                <h3 class="card-title text-white">Pengguna</h3>
                                <div class="d-inline-block">
                                    <h2 class="numbers text-white"><?php echo $totalPenghuni; ?></h2>
                                    <p class="text-white mb-0">Jan - March 2019</p>
                                </div>
                                <span class="float-right display-5 opacity-5"><i class="fa fa-users"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card gradient-2">
                            <div class="card-body">
                                <h3 class="card-title text-white">Net Profit</h3>
                                <div class="d-inline-block">
                                    <h2 class="text-white">$ 8541</h2>
                                    <p class="text-white mb-0">Jan - March 2019</p>
                                </div>
                                <span class="float-right display-5 opacity-5"><i class="fa fa-money"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card gradient-3">
                            <div class="card-body">
                                <h3 class="card-title text-white">New Customers</h3>
                                <div class="d-inline-block">
                                    <h2 class="text-white">4565</h2>
                                    <p class="text-white mb-0">Jan - March 2019</p>
                                </div>
                                <span class="float-right display-5 opacity-5"><i class="fa fa-users"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card gradient-4">
                            <div class="card-body">
                                <h3 class="card-title text-white">Customer Satisfaction</h3>
                                <div class="d-inline-block">
                                    <h2 class="text-white">99%</h2>
                                    <p class="text-white mb-0">Jan - March 2019</p>
                                </div>
                                <span class="float-right display-5 opacity-5"><i class="fa fa-heart"></i></span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-12"></div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <div class="active-member">
                                    <div class="details">
                                        <div class="recentOrders">
                                            <div class="cardHeader">
                                                <h2>Edit Kamar Kos</h2>
                                            </div>

                                            <!-- Formulir Edit -->
                                            <!-- Formulir Edit -->
                                            <form action="" method="POST" enctype="multipart/form-data">
                                                <!-- Nama -->
                                                <div class="form-group mb-3">
                                                    <label for="nama_222271">Nama</label>
                                                    <input type="text" name="nama_222271" id="nama_222271" class="form-control" value="<?= htmlspecialchars($data['nama_222271']); ?>" required>
                                                </div>

                                                <!-- Email -->
                                                <div class="form-group mb-3">
                                                    <label for="email_222271">Email</label>
                                                    <input type="email" name="email_222271" id="email_222271" class="form-control" value="<?= htmlspecialchars($data['email_222271']); ?>" required>
                                                </div>

                                                <!-- Username -->
                                                <div class="form-group mb-3">
                                                    <label for="username_222271">Username</label>
                                                    <input type="text" name="username_222271" id="username_222271" class="form-control" value="<?= htmlspecialchars($data['username_222271']); ?>" required>
                                                </div>

                                                <!-- Nomor Telepon -->
                                                <div class="form-group mb-3">
                                                    <label for="nomorTelepon_222271">Nomor Telepon</label>
                                                    <input type="text" name="nomorTelepon_222271" id="nomorTelepon_222271" class="form-control" value="<?= htmlspecialchars($data['nomorTelepon_222271']); ?>" required>
                                                </div>

                                                <!-- Role -->
                                                <div class="form-group mb-3">
                                                    <label for="role_222271">Role</label>
                                                    <select name="role_222271" id="role_222271" class="form-control" required>
                                                        <option value="user" <?= $data['role_222271'] === 'user' ? 'selected' : ''; ?>>User</option>
                                                        <option value="admin" <?= $data['role_222271'] === 'admin' ? 'selected' : ''; ?>>Admin</option>
                                                    </select>
                                                </div>

                                                <!-- Foto -->
                                                <div class="form-group mb-3">
                                                    <label for="foto_222271">Foto</label>
                                                    <input type="file" name="foto_222271" id="foto_222271" class="form-control" accept="image/*">
                                                    <p>Foto saat ini: <img src="<?= htmlspecialchars($data['foto_222271']); ?>" alt="Foto" width="100"></p>
                                                </div>

                                                <!-- Tombol Submit -->
                                                <button type="submit" class="btn btn-primary" name="update">Update</button>

                                                <!-- Tombol Kembali -->
                                                <button type="button" class="btn btn-dark" onclick="window.location.href='dataUser2.php'">Kembali</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                <!-- Tambahkan Script jQuery -->
                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <script>
                    $(document).ready(function() {
                        // Memuat data tabel pertama kali
                        loadData();

                        // Fungsi untuk memuat data tabel melalui AJAX
                        function loadData() {
                            $.ajax({
                                url: 'ambil_data.php', // File PHP untuk mengambil data
                                type: 'GET',
                                success: function(response) {
                                    $('#tabelData').html(response);
                                }
                            });
                        }
                    });
                </script>
                <script src="main/js/common.min.js"></script>
                <script src="main/js/custom.min.js"></script>
                <script src="main/js/settings.js"></script>
                <script src="main/js/gleek.js"></script>
                <script src="main/js/styleSwitcher.js"></script>

                <!-- Chartjs -->
                <script src="main/js/Chart.bundle.min.js"></script>
                <!-- Circle progress -->
                <script src="main/js/circle-progress.min.js"></script>
                <!-- Datamap -->
                <script src="main/js/index.js"></script>
                <script src="main/js/topojson.min.js"></script>
                <script src="main/js/datamaps.world.min.js"></script>
                <!-- Morrisjs -->
                <script src="main/js/raphael.min.js"></script>
                <script src="main/js/morris.min.js"></script>
                <!-- Pignose Calender -->
                <script src="main/js/moment.min.js"></script>
                <script src="main/js/pignose.calendar.min.js"></script>
                <!-- ChartistJS -->
                <script src="main/js/chartist.min.js"></script>
                <script src="main/js/chartist-plugin-tooltip.min.js"></script>

                <script src="main/js/dashboard-1.js"></script>
</body>

</html>