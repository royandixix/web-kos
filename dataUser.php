<?php
session_start();  // Mulai sesi sebelum menggunakan $_SESSION
require 'config/fungsi.php'; // Pindahkan ini setelah session_start()

// Ambil data pengguna dari sesi jika sudah login
$nama = $_SESSION['user']['name'] ?? ''; // Gunakan null coalescing jika tidak ada data di sesi
$role = $_SESSION['user']['role'] ?? ''; // Gunakan null coalescing jika tidak ada data di sesi

// Ambil data pengguna yang memiliki role 'user'
$rows = query("SELECT * FROM pengguna_222271 WHERE role_222271 = 'user'");

$nama = $_SESSION['user']['nama_222271'];
$role = $_SESSION['user']['role_222271'];
// Mengambil jumlah penghuni
$totalPenghuniQuery = query("SELECT COUNT(*) AS total FROM pengguna_222271");
$totalPenghuni = $totalPenghuniQuery[0]['total'] ?? 0; // Default ke 0 jika tidak ada data

// Proses login pengguna
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Panggil fungsi loginPengguna untuk memverifikasi kredensial
    $user = loginPengguna($db, $username, $password);
    if ($user) {
        // Simpan informasi pengguna ke dalam sesi
        $_SESSION['user'] = [
            'name' => $user['nama_222271'],
            'role' => $user['role_222271'],
            'profile_pic' => 'uploads/' . $user['foto_222271'] // Menyimpan path lengkap ke foto
        ];
        header("Location: dashboard.php"); // Redirect ke halaman dashboard
        exit;
    } else {
        $error = "Username atau password salah!";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="admin/images/favicon.ico">

    <title>CRMi - Dashboard</title>

    <!-- Vendors Style-->
    <link rel="stylesheet" href="admin/css/vendors_css.css">

    <!-- Style-->
    <link rel="stylesheet" href="admin/css/style.css">
    <link rel="stylesheet" href="admin/css/skin_color.css">
    <!-- Font Awesome Free CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">


</head>
<style>
    .hover-scale:hover {
        transform: scale(1.1);
        transition: all 0.3s ease;
    }
    

    .status-indicator {
        position: absolute;
        bottom: 0;
        right: 0;
        width: 10px;
        height: 10px;
        background-color: #28a745;
        /* Warna hijau */
        border: 2px solid #fff;
        border-radius: 50%;
    }
</style>

<body class="hold-transition light-skin sidebar-mini theme-primary fixed">

    <div class="wrapper">
        <div id="loader"></div>

        <header class="main-header">
            <div class="d-flex align-items-center logo-box justify-content-start d-md-none d-block">
                <!-- Logo -->
                <a href="index.html" class="logo">
                    <!-- logo-->
                    <div class="logo-mini w-30">
                        <span class="light-logo"><img src="admin/images/logo-letter.png" alt="logo"></span>
                        <span class="dark-logo"><img src="admin/images/logo-letter-white.png" alt="logo"></span>
                    </div>
                    <div class="logo-lg">
                        <span class="light-logo"><img src="admin/images/logo-dark-text.png" alt="logo"></span>
                        <span class="dark-logo"><img src="admin/images/logo-light-text.png" alt="logo"></span>
                    </div>
                </a>
            </div>
            <!-- Header Navbar -->
            <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow">

                <h3>
                    <i class="fas fa-user-shield me-2"></i> Selamat Datang di Halaman Admin
                </h3>



            </nav>

        </header>

        <aside class="main-sidebar">
            <!-- sidebar-->
            <section class="sidebar position-relative">
                <div class="user-profile my-15 px-20 py-10 b-1 rounded10 mx-15">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="image d-flex align-items-center">
                            <img src="admin/images/avatar/avatar-13.png" class="rounded-0 me-10" alt="User Image">
                            <div>
                                <h4 class="mb-0 fw-600"><?php echo htmlspecialchars($nama); ?></h4>
                                <p class="mb-0"><?php echo htmlspecialchars($role); ?></p> <!-- Menampilkan role pengguna -->
                            </div>
                        </div>
                        <div class="info">
                            <a class="dropdown-toggle p-15 d-grid" data-bs-toggle="dropdown" href="#"></a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="#"><i class="ti-user"></i> Profile</a>
                                <a class="dropdown-item" href="#"><i class="ti-email"></i> Inbox</a>
                                <a class="dropdown-item" href="#"><i class="ti-link"></i> Conversation</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#"><i class="ti-lock"></i> Logout</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="multinav">
                    <div class="multinav-scroll" style="height: 97%;">
                        <!-- sidebar menu-->
                        <ul class="sidebar-menu" data-widget="tree">
                            <li class="header">Main Menu</li>
                            <li>
                                <a href="dhasboard.php">
                                    <i class="icon-Layout-4-blocks"><span class="path1"></span><span class="path2"></span></i>
                                    <span>Dashboard</span>
                                </a>
                            </li>
                            <li>
                                <a href="dataUser.php">
                                    <i class="icon-Chart-pie"><span class="path1"></span><span class="path2"></span></i>
                                    <span>Penghuni Kost</span>
                                </a>
                            </li>
                            <li>
                                <a href="detailpenyewaan.php">
                                    <i class="icon-Wallet"><span class="path1"></span><span class="path2"></span></i>
                                    <span>Data Penyewaan</span>
                                </a>
                            </li>
                            <li>
                                <a href="addTransaksi.php">
                                    <i class="icon-User"><span class="path1"></span><span class="path2"></span></i>
                                    <span>Transaksi Pembayaran</span>
                                </a>
                            </li>
                            <li>
                                <a href="dataKost.php">
                                    <i class="icon-Chat2"></i>
                                    <span>Kategori Kamar</span>
                                </a>
                            </li>
                            <li>
                                <a href="logout.php">
                                    <i class="icon-Add-user"><span class="path1"></span><span class="path2"></span></i>
                                    <span>Logout</span>
                                </a>
                            </li>
                            <!-- <li>
                                <a href="#">
                                    <i class="icon-Add-user"><span class="path1"></span><span class="path2"></span></i>
                                    <span>Logout</span>
                                </a>
                            </li> -->
                            <li class="header">Components</li>
                            <li class="treeview">
                                <a href="#">
                                    <i class="icon-Library"><span class="path1"></span><span class="path2"></span></i>
                                    <span>Features</span>
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-right pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li class="treeview">
                                        <a href="#">
                                            <i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Card
                                            <span class="pull-right-container">
                                                <i class="fa fa-angle-right pull-right"></i>
                                            </span>
                                        </a>
                                        <ul class="treeview-menu">
                                            <li><a href="#"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>User Card</a></li>
                                            <li><a href="#"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Advanced Card</a></li>

                                        </ul>
                                    </li>





                                    <li class="treeview">
                                        <a href="#">
                                            <i class="icon-Globe"><span class="path1"></span><span class="path2"></span></i>
                                            <span>Apps & Widgets</span>
                                            <span class="pull-right-container">
                                                <i class="fa fa-angle-right pull-right"></i>
                                            </span>
                                        </a>
                                        <ul class="treeview-menu">
                                            <li class="treeview">
                                                <a href="#">
                                                    <i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Apps
                                                    <span class="pull-right-container">
                                                        <i class="fa fa-angle-right pull-right"></i>
                                                    </span>
                                                </a>
                                                <ul class="treeview-menu">
                                                    <li><a href="#"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Calendar</a></li>
                                                    <li><a href="#"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Contact List</a></li>
                                                    <li><a href="#"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Todo</a></li>
                                                    <li><a href="#"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Mailbox</a></li>
                                                </ul>
                                            </li>
                                            <li class="treeview">
                                                <a href="#">
                                                    <i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Widgets
                                                    <span class="pull-right-container">
                                                        <i class="fa fa-angle-right pull-right"></i>
                                                    </span>
                                                </a>
                                                <ul class="treeview-menu">
                                                    <li class="treeview">
                                                        <a href="#">
                                                            <i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Custom
                                                            <span class="pull-right-container">
                                                                <i class="fa fa-angle-right pull-right"></i>
                                                            </span>
                                                        </a>
                                                        <ul class="treeview-menu">
                                                            <li><a href="#"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Blog</a></li>
                                                            <li><a href="#"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Chart</a></li>
                                                            <li><a href="#"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>List</a></li>
                                                            <li><a href="#"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Social</a></li>

                                                        </ul>
                                                    </li>
                                                    <li class="treeview">
                                                        <a href="#">
                                                            <i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Maps
                                                            <span class="pull-right-container">
                                                                <i class="fa fa-angle-right pull-right"></i>
                                                            </span>
                                                        </a>
                                                        <ul class="treeview-menu">
                                                            <li><a href="#"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Google Map</a></li>
                                                            <li><a href="$"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Vector Map</a></li>
                                                        </ul>
                                                    </li>
                                                    <li class="treeview">
                                                        <a href="#">
                                                            <i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Modals
                                                            <span class="pull-right-container">
                                                                <i class="fa fa-angle-right pull-right"></i>
                                                            </span>
                                                        </a>
                                                        <ul class="treeview-menu">
                                                            <li><a href="#"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Modals</a></li>
                                                            <li><a href="#"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Sweet Alert</a></li>
                                                            <li><a href="#"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Toastr</a></li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="treeview">
                                                <a href="#">
                                                    <i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Ecommerce
                                                    <span class="pull-right-container">
                                                        <i class="fa fa-angle-right pull-right"></i>
                                                    </span>
                                                </a>
                                                <ul class="treeview-menu">
                                                    <li><a href="#"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Products</a></li>
                                                    <li><a href="#"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Products Cart</a></li>
                                                    <li><a href="#"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Products Edit</a></li>
                                                    <li><a href="#"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Product Details</a></li>
                                                    <li><a href="#"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Product Orders</a></li>
                                                    <li><a href="#"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Products Checkout</a></li>
                                                </ul>
                                            </li>
                                            <li class="treeview">
                                                <a href="#">
                                                    <i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Sample Pages
                                                    <span class="pull-right-container">
                                                        <i class="fa fa-angle-right pull-right"></i>
                                                    </span>
                                                </a>
                                                <ul class="treeview-menu">
                                                    <li><a href="#"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Invoice</a></li>
                                                    <li><a href="#"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Invoice List</a></li>
                                                    <li><a href="#"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>User Profile</a></li>
                                                    <li><a href="#"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Userlist</a></li>
                                                    <li><a href="#"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>FAQs</a></li>
                                                    <li><a href="#"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Blank</a></li>
                                                    <li><a href="#"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Coming Soon</a></li>
                                                    <li><a href="#"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Custom Scrolls</a></li>
                                                    <li><a href="#"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Gallery</a></li>
                                                    <li><a href="#"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Lightbox Popup</a></li>
                                                    <li><a href="#"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Pricing</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="treeview">
                                        <a href="#">
                                            <i class="icon-Lock-overturning"><span class="path1"></span><span class="path2"></span></i>
                                            <span>Authentication</span>
                                            <span class="pull-right-container">
                                                <i class="fa fa-angle-right pull-right"></i>
                                            </span>
                                        </a>
                                        <ul class="treeview-menu">
                                            <li><a href="#"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Login</a></li>
                                            <li><a href="#"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Register</a></li>
                                            <li><a href="#"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Lockscreen</a></li>
                                            <li><a href="#"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Recover password</a></li>
                                        </ul>
                                    </li>
                                    <li class="treeview">
                                        <a href="#">
                                            <i class="icon-Warning-2"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                                            <span>Miscellaneous</span>
                                            <span class="pull-right-container">
                                                <i class="fa fa-angle-right pull-right"></i>
                                            </span>
                                        </a>
                                        <ul class="treeview-menu">
                                            <li><a href="#"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Error 404</a></li>
                                            <li><a href="#"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Error 500</a></li>
                                            <li><a href="#"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Maintenance</a></li>
                                        </ul>
                                    </li>
                                </ul>

                                <div class="sidebar-widgets">
                                    <div class="mx-25 mb-30 pb-20 side-bx bg-primary-light rounded20">
                                        <div class="text-center">
                                            <img src="admin/images/svg-icon/color-svg/custom-17.svg" class="sideimg p-5" alt="">
                                            <h4 class="title-bx text-primary">View Full Report</h4>
                                            <a href="#" class="py-10 fs-14 mb-0 text-primary">
                                                Best CRM App here <i class="mdi mdi-arrow-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="copyright text-center m-25">
                                        <p><strong class="d-block">Jassa</strong>
                                            <script>
                                                document.write(new Date().getFullYear())
                                            </script>
                                        </p>
                                    </div>
                                </div>
                    </div>
                </div>
            </section>
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <div class="container-full">
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xl-3 col-md-6 col-12">
                            <div class="box bg-gradient-primary">
                                <div class="box-body">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <div id="progressbar11" class="mx-auto w-80 position-relative"></div>
                                        </div>
                                        <div>
                                            <h4 class="mt-0 text-white">Pengguna</h4>
                                            <h3 class="fw-500 my-0 text-white">Good</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 col-12">
                            <div class="box">
                                <div class="box-body">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="w-80 h-80 rounded-circle bg-primary-light fs-40 text-center l-h-80">
                                            <span class="icon-Equalizer"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></span>
                                        </div>
                                        <div>
                                            <h4 class="mt-0">Total Sales</h4>
                                            <h3 class="fw-500 my-0">$314k</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 col-12">
                            <div class="box">
                                <div class="box-body">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="w-80 h-80 rounded-circle bg-success-light fs-40 text-center l-h-85">
                                            <span class="icon-Dollar"><span class="path1"></span><span class="path2"></span><span class="path3"></span></span>
                                        </div>
                                        <div>
                                            <h4 class="mt-0">Total Profit</h4>
                                            <h3 class="fw-500 my-0">$90k</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 col-12">
                            <div class="box">
                                <div class="box-body">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="w-80 h-80 rounded-circle bg-danger-light fs-40 text-center l-h-85">
                                            <span class="icon-Money"><span class="path1"></span><span class="path2"></span></span>
                                        </div>
                                        <div>
                                            <h4 class="mt-0">Total Revenue</h4>
                                            <h3 class="fw-500 my-0">$9102k</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card shadow-sm">
                                    <div class="card-body">
                                        <div class="active-member">
                                            <!-- Judul -->
                                            <h4 class="card-title text-left mb-4">Data Penghuni Kos</h4>
                                            <a href="cetak_pdf.php" class="btn btn-danger mb-2">Cetak PDF</a>
                                            <!-- Tabel -->
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Nama</th>
                                                            <th>Email</th>
                                                            <th>No HP</th>
                                                            <th>Role</th>
                                                            <th>Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php if (!empty($rows)): ?>
                                                            <?php $no = 1; ?>
                                                            <?php foreach ($rows as $row): ?>
                                                                <tr>
                                                                    <td><?php echo $no++; ?></td>
                                                                    <td><?php echo htmlspecialchars($row['nama_222271'] ?? ''); ?></td>
                                                                    <td><?php echo htmlspecialchars($row['email_222271'] ?? ''); ?></td>
                                                                    <td><?php echo htmlspecialchars($row['nomorTelepon_222271'] ?? ''); ?></td>
                                                                    <td><?php echo htmlspecialchars($row['role_222271'] ?? ''); ?></td>
                                                                    <td>
                                                                        <a href="edit4.php?id=<?php echo urlencode($row['id_222271'] ?? ''); ?>" class="btn btn-warning btn-sm">Edit</a>
                                                                        <a href="delete.php?id=<?php echo urlencode($row['id_222271'] ?? ''); ?>"
                                                                            class="btn btn-danger btn-sm"
                                                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
                                                                    </td>
                                                                </tr>
                                                            <?php endforeach; ?>
                                                        <?php else: ?>
                                                            <tr>
                                                                <td colspan="6" class="text-center">Tidak ada data</td>
                                                            </tr>
                                                        <?php endif; ?>
                                                    </tbody>

                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                    </div>
                </section>
                <!-- /.content -->
            </div>
        </div>
        <!-- /.content-wrapper -->

        <footer class="main-footer">
            <div class="pull-right d-none d-sm-inline-block">
                <ul class="nav nav-primary nav-dotted nav-dot-separated justify-content-center justify-content-md-end">
                    <li class="nav-item">
                        <a class="nav-link" href="https://therichpost.com/category/free-admin-dashboard-templates/">More Demos</a>
                    </li>
                </ul>
            </div>
        </footer>
        <!-- Side panel -->
        <!-- quick_actions_toggle -->
        <div class="modal modal-right fade" id="quick_actions_toggle" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content slim-scroll">
                    <div class="modal-body bg-white p-30">
                        <div class="d-flex align-items-center justify-content-between pb-30">
                            <h4 class="m-0">Quick Actions<br>
                                <small class="badge fs-12 badge-primary mt-10">23 tasks pending</small>
                            </h4>
                            <a href="#" class="btn btn-icon btn-danger-light btn-sm no-shadow" data-bs-dismiss="modal">
                                <span class="fa fa-close"></span>
                            </a>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <a class="waves-effect waves-light btn btn-app btn btn-primary-light btn-flat mx-0 mb-20 no-shadow py-35 h-auto d-block" href="#">
                                    <i class="icon-Euro fs-36"><span class="path1"></span><span class="path2"></span></i>
                                    <span class="fs-16">Accounting</span>
                                </a>
                            </div>
                            <div class="col-6">
                                <a class="waves-effect waves-light btn btn-app btn btn-primary-light btn-flat mx-0 mb-20 no-shadow py-35 h-auto d-block" href="#">
                                    <i class="icon-Mail-attachment fs-36"><span class="path1"></span><span class="path2"></span></i>
                                    <span class="fs-16">Members</span>
                                </a>
                            </div>
                            <div class="col-6">
                                <a class="waves-effect waves-light btn btn-app btn btn-primary-light btn-flat mx-0 mb-20 no-shadow py-35 h-auto d-block" href="#">
                                    <i class="icon-Box2 fs-36"><span class="path1"></span><span class="path2"></span></i>
                                    <span class="fs-16">Projects</span>
                                </a>
                            </div>
                            <div class="col-6">
                                <a class="waves-effect waves-light btn btn-app btn btn-primary-light btn-flat mx-0 mb-20 no-shadow py-35 h-auto d-block" href="#">
                                    <i class="icon-Group fs-36"><span class="path1"></span><span class="path2"></span></i>
                                    <span class="fs-16">Customers</span>
                                </a>
                            </div>
                            <div class="col-6">
                                <a class="waves-effect waves-light btn btn-app btn btn-primary-light btn-flat mx-0 mb-20 no-shadow py-35 h-auto d-block" href="#">
                                    <i class="icon-Chart-bar fs-36"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></i>
                                    <span class="fs-16">Email</span>
                                </a>
                            </div>
                            <div class="col-6">
                                <a class="waves-effect waves-light btn btn-app btn btn-primary-light btn-flat mx-0 mb-20 no-shadow py-35 h-auto d-block" href="#">
                                    <i class="icon-Color-profile fs-36"><span class="path1"></span><span class="path2"></span></i>
                                    <span class="fs-16">Settings</span>
                                </a>
                            </div>
                            <div class="col-6">
                                <a class="waves-effect waves-light btn btn-app btn btn-primary-light btn-flat mx-0 mb-20 no-shadow py-35 h-auto d-block" href="#">
                                    <i class="icon-Euro fs-36"><span class="path1"></span><span class="path2"></span></i>
                                    <span class="fs-18">Orders</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /quick_actions_toggle -->

        <!-- quick_panel_toggle -->
        <div class="modal modal-right fade" id="quick_panel_toggle" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content slim-scroll2">
                    <div class="modal-body bg-white py-20 px-0">
                        <div class="d-flex align-items-center justify-content-between pb-30">
                            <ul class="nav nav-tabs customtab3 px-30" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#quick_panel_logs">Audit Logs</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#quick_panel_notifications">Notifications</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#quick_panel_settings">Settings</a>
                                </li>
                            </ul>
                            <div class="offcanvas-close">
                                <a href="#" class="btn btn-icon btn-danger-light btn-sm no-shadow" data-bs-dismiss="modal">
                                    <span class="fa fa-close"></span>
                                </a>
                            </div>
                        </div>
                        <div class="px-30">
                            <div class="tab-content">
                                <div class="tab-pane active" id="quick_panel_logs" role="tabpanel">
                                    <div class="mb-30">
                                        <h5 class="fw-500 mb-15">System Messages</h5>
                                        <div class="d-flex align-items-center mb-30">
                                            <div class="me-15 bg-lightest h-50 w-50 l-h-50 rounded text-center">
                                                <img src="admin/images/svg-icon/color-svg/001-glass.svg" class="h-30" alt="">
                                            </div>
                                            <div class="d-flex flex-column flex-grow-1 me-2 fw-500">
                                                <a href="#" class="text-dark hover-primary mb-1 fs-16">Duis faucibus lorem</a>
                                                <span class="text-fade">Pharetra, Nulla</span>
                                            </div>
                                            <span class="badge badge-xl badge-light"><span class="fw-600">+125$</span></span>
                                        </div>
                                        <div class="d-flex align-items-center mb-30">
                                            <div class="me-15 bg-lightest h-50 w-50 l-h-50 rounded text-center">
                                                <img src="admin/images/svg-icon/color-svg/002-google.svg" class="h-30" alt="">
                                            </div>
                                            <div class="d-flex flex-column flex-grow-1 me-2 fw-500">
                                                <a href="#" class="text-dark hover-danger mb-1 fs-16">Mauris varius augue</a>
                                                <span class="text-fade">Pharetra, Nulla</span>
                                            </div>
                                            <span class="badge badge-xl badge-light"><span class="fw-600">+125$</span></span>
                                        </div>
                                        <div class="d-flex align-items-center mb-30">
                                            <div class="me-15 bg-lightest h-50 w-50 l-h-50 rounded text-center">
                                                <img src="admin/images/svg-icon/color-svg/003-settings.svg" class="h-30" alt="">
                                            </div>
                                            <div class="d-flex flex-column flex-grow-1 me-2 fw-500">
                                                <a href="#" class="text-dark hover-success mb-1 fs-16">Aliquam in magna</a>
                                                <span class="text-fade">Pharetra, Nulla</span>
                                            </div>
                                            <span class="badge badge-xl badge-light"><span class="fw-600">+125$</span></span>
                                        </div>
                                        <div class="d-flex align-items-center mb-30">
                                            <div class="me-15 bg-lightest h-50 w-50 l-h-50 rounded text-center">
                                                <img src="admin/images/svg-icon/color-svg/004-dad.svg" class="h-30" alt="">
                                            </div>
                                            <div class="d-flex flex-column flex-grow-1 me-2 fw-500">
                                                <a href="#" class="text-dark hover-info mb-1 fs-16">Phasellus venenatis nisi</a>
                                                <span class="text-fade">Pharetra, Nulla</span>
                                            </div>
                                            <span class="badge badge-xl badge-light"><span class="fw-600">+125$</span></span>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="me-15 bg-lightest h-50 w-50 l-h-50 rounded text-center">
                                                <img src="admin/images/svg-icon/color-svg/005-paint-palette.svg" class="h-30" alt="">
                                            </div>
                                            <div class="d-flex flex-column flex-grow-1 me-2 fw-500">
                                                <a href="#" class="text-dark hover-warning mb-1 fs-16">Vivamus consectetur</a>
                                                <span class="text-fade">Pharetra, Nulla</span>
                                            </div>
                                            <span class="badge badge-xl badge-light"><span class="fw-600">+125$</span></span>
                                        </div>
                                    </div>
                                    <div class="mb-30">
                                        <h5 class="fw-500 mb-15">Tasks Overview</h5>
                                        <div class="d-flex align-items-center mb-30">
                                            <div class="me-15 bg-primary-light h-50 w-50 l-h-60 rounded text-center">
                                                <span class="icon-Library fs-24"><span class="path1"></span><span class="path2"></span></span>
                                            </div>
                                            <div class="d-flex flex-column fw-500">
                                                <a href="#" class="text-dark hover-primary mb-1 fs-16">Project Briefing</a>
                                                <span class="text-fade">Project Manager</span>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center mb-30">
                                            <div class="me-15 bg-danger-light h-50 w-50 l-h-60 rounded text-center">
                                                <span class="icon-Write fs-24"><span class="path1"></span><span class="path2"></span></span>
                                            </div>
                                            <div class="d-flex flex-column fw-500">
                                                <a href="#" class="text-dark hover-danger mb-1 fs-16">Concept Design</a>
                                                <span class="text-fade">Art Director</span>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center mb-30">
                                            <div class="me-15 bg-success-light h-50 w-50 l-h-60 rounded text-center">
                                                <span class="icon-Group-chat fs-24"><span class="path1"></span><span class="path2"></span></span>
                                            </div>
                                            <div class="d-flex flex-column fw-500">
                                                <a href="#" class="text-dark hover-success mb-1 fs-16">Functional Logics</a>
                                                <span class="text-fade">Lead Developer</span>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center mb-30">
                                            <div class="me-15 bg-info-light h-50 w-50 l-h-60 rounded text-center">
                                                <span class="icon-Attachment1 fs-24"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></span>
                                            </div>
                                            <div class="d-flex flex-column fw-500">
                                                <a href="#" class="text-dark hover-info mb-1 fs-16">Development</a>
                                                <span class="text-fade">DevOps</span>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="me-15 bg-warning-light h-50 w-50 l-h-60 rounded text-center">
                                                <span class="icon-Shield-user fs-24"></span>
                                            </div>
                                            <div class="d-flex flex-column fw-500">
                                                <a href="#" class="text-dark hover-warning mb-1 fs-16">Testing</a>
                                                <span class="text-fade">QA Managers</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="quick_panel_notifications" role="tabpanel">
                                    <div>
                                        <div class="media-list">
                                            <a class="media media-single px-0" href="#">
                                                <h4 class="w-50 text-gray fw-500">10:10</h4>
                                                <div class="media-body ps-15 bs-5 rounded border-primary">
                                                    <p>Morbi quis ex eu arcu auctor sagittis.</p>
                                                    <span class="text-fade">by Johne</span>
                                                </div>
                                            </a>

                                            <a class="media media-single px-0" href="#">
                                                <h4 class="w-50 text-gray fw-500">08:40</h4>
                                                <div class="media-body ps-15 bs-5 rounded border-success">
                                                    <p>Proin iaculis eros non odio ornare efficitur.</p>
                                                    <span class="text-fade">by Amla</span>
                                                </div>
                                            </a>

                                            <a class="media media-single px-0" href="#">
                                                <h4 class="w-50 text-gray fw-500">07:10</h4>
                                                <div class="media-body ps-15 bs-5 rounded border-info">
                                                    <p>In mattis mi ut posuere consectetur.</p>
                                                    <span class="text-fade">by Josef</span>
                                                </div>
                                            </a>

                                            <a class="media media-single px-0" href="#">
                                                <h4 class="w-50 text-gray fw-500">01:15</h4>
                                                <div class="media-body ps-15 bs-5 rounded border-danger">
                                                    <p>Morbi quis ex eu arcu auctor sagittis.</p>
                                                    <span class="text-fade">by Rima</span>
                                                </div>
                                            </a>

                                            <a class="media media-single px-0" href="#">
                                                <h4 class="w-50 text-gray fw-500">23:12</h4>
                                                <div class="media-body ps-15 bs-5 rounded border-warning">
                                                    <p>Morbi quis ex eu arcu auctor sagittis.</p>
                                                    <span class="text-fade">by Alaxa</span>
                                                </div>
                                            </a>
                                            <a class="media media-single px-0" href="#">
                                                <h4 class="w-50 text-gray fw-500">10:10</h4>
                                                <div class="media-body ps-15 bs-5 rounded border-primary">
                                                    <p>Morbi quis ex eu arcu auctor sagittis.</p>
                                                    <span class="text-fade">by Johne</span>
                                                </div>
                                            </a>

                                            <a class="media media-single px-0" href="#">
                                                <h4 class="w-50 text-gray fw-500">08:40</h4>
                                                <div class="media-body ps-15 bs-5 rounded border-success">
                                                    <p>Proin iaculis eros non odio ornare efficitur.</p>
                                                    <span class="text-fade">by Amla</span>
                                                </div>
                                            </a>

                                            <a class="media media-single px-0" href="#">
                                                <h4 class="w-50 text-gray fw-500">07:10</h4>
                                                <div class="media-body ps-15 bs-5 rounded border-info">
                                                    <p>In mattis mi ut posuere consectetur.</p>
                                                    <span class="text-fade">by Josef</span>
                                                </div>
                                            </a>

                                            <a class="media media-single px-0" href="#">
                                                <h4 class="w-50 text-gray fw-500">01:15</h4>
                                                <div class="media-body ps-15 bs-5 rounded border-danger">
                                                    <p>Morbi quis ex eu arcu auctor sagittis.</p>
                                                    <span class="text-fade">by Rima</span>
                                                </div>
                                            </a>

                                            <a class="media media-single px-0" href="#">
                                                <h4 class="w-50 text-gray fw-500">23:12</h4>
                                                <div class="media-body ps-15 bs-5 rounded border-warning">
                                                    <p>Morbi quis ex eu arcu auctor sagittis.</p>
                                                    <span class="text-fade">by Alaxa</span>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="quick_panel_settings" role="tabpanel">
                                    <div>
                                        <form class="form">
                                            <!--begin::Section-->
                                            <div>
                                                <h5 class="fw-500 mb-15">Customer Care</h5>
                                                <div class="form-group mb-0 row align-items-center">
                                                    <label class="col-8 col-form-label">Enable Notifications:</label>
                                                    <div class="col-4 d-flex justify-content-end">
                                                        <button type="button" class="btn btn-sm btn-toggle btn-primary active" data-bs-toggle="button">
                                                            <span class="handle"></span>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="form-group mb-0 row align-items-center">
                                                    <label class="col-8 col-form-label">Enable Case Tracking:</label>
                                                    <div class="col-4 d-flex justify-content-end">
                                                        <button type="button" class="btn btn-sm btn-toggle btn-primary" data-bs-toggle="button">
                                                            <span class="handle"></span>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="form-group mb-0 row align-items-center">
                                                    <label class="col-8 col-form-label">Support Portal:</label>
                                                    <div class="col-4 d-flex justify-content-end">
                                                        <button type="button" class="btn btn-sm btn-toggle btn-primary active" data-bs-toggle="button">
                                                            <span class="handle"></span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end::Section-->
                                            <div class="dropdown-divider"></div>
                                            <!--begin::Section-->
                                            <div class="pt-2">
                                                <h5 class="fw-500 mb-15">Reports</h5>
                                                <div class="form-group mb-0 row align-items-center">
                                                    <label class="col-8 col-form-label">Generate Reports:</label>
                                                    <div class="col-4 d-flex justify-content-end">
                                                        <button type="button" class="btn btn-sm btn-toggle btn-danger active" data-bs-toggle="button">
                                                            <span class="handle"></span>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="form-group mb-0 row align-items-center">
                                                    <label class="col-8 col-form-label">Enable Report Export:</label>
                                                    <div class="col-4 d-flex justify-content-end">
                                                        <button type="button" class="btn btn-sm btn-toggle btn-danger active" data-bs-toggle="button">
                                                            <span class="handle"></span>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="form-group mb-0 row align-items-center">
                                                    <label class="col-8 col-form-label">Allow Data Collection:</label>
                                                    <div class="col-4 d-flex justify-content-end">
                                                        <button type="button" class="btn btn-sm btn-toggle btn-danger active" data-bs-toggle="button">
                                                            <span class="handle"></span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end::Section-->
                                            <div class="dropdown-divider"></div>
                                            <!--begin::Section-->
                                            <div class="pt-2">
                                                <h5 class="fw-500 mb-15">Memebers</h5>
                                                <div class="form-group mb-0 row align-items-center">
                                                    <label class="col-8 col-form-label">Enable Member singup:</label>
                                                    <div class="col-4 d-flex justify-content-end">
                                                        <button type="button" class="btn btn-sm btn-toggle btn-warning active" data-bs-toggle="button">
                                                            <span class="handle"></span>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="form-group mb-0 row align-items-center">
                                                    <label class="col-8 col-form-label">Allow User Feedbacks:</label>
                                                    <div class="col-4 d-flex justify-content-end">
                                                        <button type="button" class="btn btn-sm btn-toggle btn-warning active" data-bs-toggle="button">
                                                            <span class="handle"></span>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="form-group mb-0 row align-items-center">
                                                    <label class="col-8 col-form-label">Enable Customer Portal:</label>
                                                    <div class="col-4 d-flex justify-content-end">
                                                        <button type="button" class="btn btn-sm btn-toggle btn-warning active" data-bs-toggle="button">
                                                            <span class="handle"></span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end::Section-->
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /quick_panel_toggle -->

        <!-- quick_shop_toggle -->
        <div class="modal modal-right fade" id="quick_shop_toggle" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="px-15 d-flex w-p100 align-items-center justify-content-between">
                            <h4 class="m-0">Shopping Cart</h4>
                            <a href="#" class="btn btn-icon btn-danger-light btn-sm no-shadow" data-bs-dismiss="modal">
                                <span class="fa fa-close"></span>
                            </a>
                        </div>
                    </div>
                    <div class="modal-body px-30 pb-30 bg-white slim-scroll4">
                        <div class="d-flex align-items-center justify-content-between pb-15">
                            <div class="d-flex flex-column me-2">
                                <a href="#" class="fw-600 fs-18 text-hover-primary">Product Name</a>
                                <span class="text-muted">When an unknown printer</span>
                                <div class="d-flex align-items-center mt-2">
                                    <span class="fw-600 me-5 fs-18">$ 125</span>
                                    <span class="text-muted me-5">for</span>
                                    <span class="fw-600 me-2 fs-18">4</span>
                                    <a href="#" class="btn btn-sm btn-success-light btn-icon me-2">
                                        <i class="fa fa-minus"></i>
                                    </a>
                                    <a href="#" class="btn btn-sm btn-success-light btn-icon">
                                        <i class="fa fa-plus"></i>
                                    </a>
                                </div>
                            </div>
                            <a href="#" class="flex-shrink-0">
                                <img src="admin/images/product/product-1.png" class="avatar h-100 w-100" alt="" />
                            </a>
                        </div>
                        <div class="dropdown-divider"></div>
                        <div class="d-flex align-items-center justify-content-between py-15">
                            <div class="d-flex flex-column me-2">
                                <a href="#" class="fw-600 fs-18 text-hover-primary">Product Name</a>
                                <span class="text-muted">When an unknown printer</span>
                                <div class="d-flex align-items-center mt-2">
                                    <span class="fw-600 me-5 fs-18">$ 125</span>
                                    <span class="text-muted me-5">for</span>
                                    <span class="fw-600 me-2 fs-18">4</span>
                                    <a href="#" class="btn btn-sm btn-success-light btn-icon me-2">
                                        <i class="fa fa-minus"></i>
                                    </a>
                                    <a href="#" class="btn btn-sm btn-success-light btn-icon">
                                        <i class="fa fa-plus"></i>
                                    </a>
                                </div>
                            </div>
                            <a href="#" class="flex-shrink-0">
                                <img src="admin/images/product/product-2.png" class="avatar h-100 w-100" alt="" />
                            </a>
                        </div>
                        <div class="dropdown-divider"></div>
                        <div class="d-flex align-items-center justify-content-between py-15">
                            <div class="d-flex flex-column me-2">
                                <a href="#" class="fw-600 fs-18 text-hover-primary">Product Name</a>
                                <span class="text-muted">When an unknown printer</span>
                                <div class="d-flex align-items-center mt-2">
                                    <span class="fw-600 me-5 fs-18">$ 125</span>
                                    <span class="text-muted me-5">for</span>
                                    <span class="fw-600 me-2 fs-18">4</span>
                                    <a href="#" class="btn btn-sm btn-success-light btn-icon me-2">
                                        <i class="fa fa-minus"></i>
                                    </a>
                                    <a href="#" class="btn btn-sm btn-success-light btn-icon">
                                        <i class="fa fa-plus"></i>
                                    </a>
                                </div>
                            </div>
                            <a href="#" class="flex-shrink-0">
                                <img src="admin/images/product/product-3.png" class="avatar h-100 w-100" alt="" />
                            </a>
                        </div>
                        <div class="dropdown-divider"></div>
                        <div class="d-flex align-items-center justify-content-between py-15">
                            <div class="d-flex flex-column me-2">
                                <a href="#" class="fw-600 fs-18 text-hover-primary">Product Name</a>
                                <span class="text-muted">When an unknown printer</span>
                                <div class="d-flex align-items-center mt-2">
                                    <span class="fw-600 me-5 fs-18">$ 125</span>
                                    <span class="text-muted me-5">for</span>
                                    <span class="fw-600 me-2 fs-18">4</span>
                                    <a href="#" class="btn btn-sm btn-success-light btn-icon me-2">
                                        <i class="fa fa-minus"></i>
                                    </a>
                                    <a href="#" class="btn btn-sm btn-success-light btn-icon">
                                        <i class="fa fa-plus"></i>
                                    </a>
                                </div>
                            </div>
                            <a href="#" class="flex-shrink-0">
                                <img src="admin/images/product/product-4.png" class="avatar h-100 w-100" alt="" />
                            </a>
                        </div>
                        <div class="dropdown-divider"></div>
                        <div class="d-flex align-items-center justify-content-between py-15">
                            <div class="d-flex flex-column me-2">
                                <a href="#" class="fw-600 fs-18 text-hover-primary">Product Name</a>
                                <span class="text-muted">When an unknown printer</span>
                                <div class="d-flex align-items-center mt-2">
                                    <span class="fw-600 me-5 fs-18">$ 125</span>
                                    <span class="text-muted me-5">for</span>
                                    <span class="fw-600 me-2 fs-18">4</span>
                                    <a href="#" class="btn btn-sm btn-success-light btn-icon me-2">
                                        <i class="fa fa-minus"></i>
                                    </a>
                                    <a href="#" class="btn btn-sm btn-success-light btn-icon">
                                        <i class="fa fa-plus"></i>
                                    </a>
                                </div>
                            </div>
                            <a href="#" class="flex-shrink-0">
                                <img src="admin/images/product/product-5.png" class="avatar h-100 w-100" alt="" />
                            </a>
                        </div>
                        <div class="dropdown-divider"></div>
                        <div class="d-flex align-items-center justify-content-between py-15">
                            <div class="d-flex flex-column me-2">
                                <a href="#" class="fw-600 fs-18 text-hover-primary">Product Name</a>
                                <span class="text-muted">When an unknown printer</span>
                                <div class="d-flex align-items-center mt-2">
                                    <span class="fw-600 me-5 fs-18">$ 125</span>
                                    <span class="text-muted me-5">for</span>
                                    <span class="fw-600 me-2 fs-18">4</span>
                                    <a href="#" class="btn btn-sm btn-success-light btn-icon me-2">
                                        <i class="fa fa-minus"></i>
                                    </a>
                                    <a href="#" class="btn btn-sm btn-success-light btn-icon">
                                        <i class="fa fa-plus"></i>
                                    </a>
                                </div>
                            </div>
                            <a href="#" class="flex-shrink-0">
                                <img src="admin/images/product/product-6.png" class="avatar h-100 w-100" alt="" />
                            </a>
                        </div>
                    </div>
                    <div class="modal-footer modal-footer-uniform">
                        <div class="d-flex align-items-center justify-content-between mb-10">
                            <span class="fw-600 text-muted fs-16 me-2">Total</span>
                            <span class="fw-600 text-end">$1248.00</span>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-15">
                            <span class="fw-600 text-muted fs-16 me-2">Sub total</span>
                            <span class="fw-600 text-primary text-end">$4125.00</span>
                        </div>
                        <div class="text-end">
                            <button type="button" class="btn btn-primary">Place Order</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /quick_shop_toggle -->

    </div>
    <!-- ./wrapper -->

    <!-- ./side demo panel -->
    <div class="sticky-toolbar">
        <a href="#" data-bs-toggle="tooltip" data-bs-placement="left" title="Buy Now" class="waves-effect waves-light btn btn-success btn-flat mb-5 btn-sm" target="_blank">
            <span class="icon-Money"><span class="path1"></span><span class="path2"></span></span>
        </a>
        <a href="#" data-bs-toggle="tooltip" data-bs-placement="left" title="Portfolio" class="waves-effect waves-light btn btn-danger btn-flat mb-5 btn-sm" target="_blank">
            <span class="icon-Image"></span>
        </a>
        <a id="chat-popup" href="#" data-bs-toggle="tooltip" data-bs-placement="left" title="Live Chat" class="waves-effect waves-light btn btn-warning btn-flat btn-sm">
            <span class="icon-Group-chat"><span class="path1"></span><span class="path2"></span></span>
        </a>
    </div>
    <!-- Sidebar -->

    <div id="chat-box-body">
        <div id="chat-circle" class="waves-effect waves-circle btn btn-circle btn-sm btn-warning l-h-50">
            <div id="chat-overlay"></div>
            <span class="icon-Group-chat fs-18"><span class="path1"></span><span class="path2"></span></span>
        </div>

        <div class="chat-box">
            <div class="chat-box-header p-15 d-flex justify-content-between align-items-center">
                <div class="btn-group">
                    <button class="waves-effect waves-circle btn btn-circle btn-primary-light h-40 w-40 rounded-circle l-h-45" type="button" data-bs-toggle="dropdown">
                        <span class="icon-Add-user fs-22"><span class="path1"></span><span class="path2"></span></span>
                    </button>
                    <div class="dropdown-menu min-w-200">
                        <a class="dropdown-item fs-16" href="#">
                            <span class="icon-Color me-15"></span>
                            New Group</a>
                        <a class="dropdown-item fs-16" href="#">
                            <span class="icon-Clipboard me-15"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></span>
                            Contacts</a>
                        <a class="dropdown-item fs-16" href="#">
                            <span class="icon-Group me-15"><span class="path1"></span><span class="path2"></span></span>
                            Groups</a>
                        <a class="dropdown-item fs-16" href="#">
                            <span class="icon-Active-call me-15"><span class="path1"></span><span class="path2"></span></span>
                            Calls</a>
                        <a class="dropdown-item fs-16" href="#">
                            <span class="icon-Settings1 me-15"><span class="path1"></span><span class="path2"></span></span>
                            Settings</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item fs-16" href="#">
                            <span class="icon-Question-circle me-15"><span class="path1"></span><span class="path2"></span></span>
                            Help</a>
                        <a class="dropdown-item fs-16" href="#">
                            <span class="icon-Notifications me-15"><span class="path1"></span><span class="path2"></span></span>
                            Privacy</a>
                    </div>
                </div>
                <div class="text-center flex-grow-1">
                    <div class="text-dark fs-18">Mayra Sibley</div>
                    <div>
                        <span class="badge badge-sm badge-dot badge-primary"></span>
                        <span class="text-muted fs-12">Active</span>
                    </div>
                </div>
                <div class="chat-box-toggle">
                    <button id="chat-box-toggle" class="waves-effect waves-circle btn btn-circle btn-danger-light h-40 w-40 rounded-circle l-h-45" type="button">
                        <span class="icon-Close fs-22"><span class="path1"></span><span class="path2"></span></span>
                    </button>
                </div>
            </div>
            <div class="chat-box-body">
                <div class="chat-box-overlay">
                </div>
                <div class="chat-logs">
                    <div class="chat-msg user">
                        <div class="d-flex align-items-center">
                            <span class="msg-avatar">
                                <img src="admin/images/avatar/2.jpg" class="avatar avatar-lg" alt="">
                            </span>
                            <div class="mx-10">
                                <a href="#" class="text-dark hover-primary fw-bold">Mayra Sibley</a>
                                <p class="text-muted fs-12 mb-0">2 Hours</p>
                            </div>
                        </div>
                        <div class="cm-msg-text">
                            Hi there, I'm Jesse and you?
                        </div>
                    </div>
                    <div class="chat-msg self">
                        <div class="d-flex align-items-center justify-content-end">
                            <div class="mx-10">
                                <a href="#" class="text-dark hover-primary fw-bold">You</a>
                                <p class="text-muted fs-12 mb-0">3 minutes</p>
                            </div>
                            <span class="msg-avatar">
                                <img src="admin/images/avatar/3.jpg" class="avatar avatar-lg" alt="">
                            </span>
                        </div>
                        <div class="cm-msg-text">
                            My name is Anne Clarc.
                        </div>
                    </div>
                    <div class="chat-msg user">
                        <div class="d-flex align-items-center">
                            <span class="msg-avatar">
                                <img src="admin/images/avatar/2.jpg" class="avatar avatar-lg" alt="">
                            </span>
                            <div class="mx-10">
                                <a href="#" class="text-dark hover-primary fw-bold">Mayra Sibley</a>
                                <p class="text-muted fs-12 mb-0">40 seconds</p>
                            </div>
                        </div>
                        <div class="cm-msg-text">
                            Nice to meet you Anne.<br>How can i help you?
                        </div>
                    </div>
                </div><!--chat-log -->
            </div>
            <div class="chat-input">
                <form>
                    <input type="text" id="chat-input" placeholder="Send a message..." />
                    <button type="submit" class="chat-submit" id="chat-submit">
                        <span class="icon-Send fs-22"></span>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Page Content overlay -->


    <!-- Vendor JS -->
    <script src="admin/js/vendors.min.js"></script>
    <script src="admin/js/chat-popup.js"></script>
    <script src="admin/js/feather.min.js"></script>

    <script src="admin/js/apexcharts.js"></script>
    <script src="admin/js/progressbar.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/core.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/maps.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/geodata/worldLow.js"></script>

    <!-- CRMi App -->
    <script src="admin/js/template.js"></script>
    <script src="admin/js/dashboard.js"></script>

</body>

</html>