<?php
session_start(); // Pastikan ini di awal file

require 'config/fungsi.php'; // Pindahkan ini setelah session_start()

// Cek jika pengguna sudah login
if (!isset($_SESSION['user'])) {
    header("Location: login.php"); // Redirect ke halaman login jika belum login
    exit;
}

require 'templates/header.php';
require 'templates/navbar.php';


// Ambil semua data dari tabel 'barang'
$rows = query("SELECT * FROM pengguna_222271");

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $user = loginPengguna($db, $username, $password);
    if ($user) {
        // Simpan informasi pengguna ke dalam sesi
        $_SESSION['user'] = [
            'name' => $user['nama_222271'],
            'role' => $user['role_222271'],
            // Asumsikan 'foto_222271' menyimpan nama file foto
            'profile_pic' => 'uploads/' . $user['profile_pic']
            // Menyimpan path lengkap ke foto
        ];
        // Redirect atau proses lain setelah login berhasil
        header("Location: admin.php"); // Redirect ke halaman dashboard
        exit;
    } else {
        $error = "Username atau password salah!";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

</head>

<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->

        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-light navbar-light">
                <a href="admin.php" class="navbar-brand mx-4 mb-3">
                    <p class="text-primary mt-5"><i class="fa fa-hashtag me-2"></i>Penjualan mobil <br> bekas</p>
                </a>
                <div class="position-relative">
                    <!-- Menampilkan foto profil -->
                    <div class="position-relative">
                        <img class="rounded-circle" src="<?php echo $_SESSION['user']['profile_pic'] ?? 'default.jpg'; ?>" alt="Profile Picture" style="width: 40px; height: 40px; object-fit: cover;">
                        <!-- Status indikator (online/offline) -->
                        <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                    </div>
                    <!-- Menampilkan nama dan role pengguna -->
                    <div class="ms-3">
                        <h6 class="mb-0"><?php echo htmlspecialchars($_SESSION['user']['name'] ?? 'Guest'); ?></h6>
                        <span><?php echo htmlspecialchars($_SESSION['user']['role'] ?? ''); ?></span>
                    </div>

                </div>

                <div class="navbar-nav w-100">
                    <a href="index.html" class="nav-item nav-link active"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>Elements</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="button.html" class="dropdown-item">Buttons</a>
                            <a href="typography.html" class="dropdown-item">Typography</a>
                            <a href="element.html" class="dropdown-item">Other Elements</a>
                        </div>
                    </div>
                    <a href="widget.html" class="nav-item nav-link"><i class="fa fa-th me-2"></i>Widgets</a>
                    <a href="form.html" class="nav-item nav-link"><i class="fa fa-keyboard me-2"></i>Forms</a>
                    <a href="table.html" class="nav-item nav-link"><i class="fa fa-table me-2"></i>Tables</a>
                    <a href="chart.html" class="nav-item nav-link"><i class="fa fa-chart-bar me-2"></i>Charts</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="far fa-file-alt me-2"></i>Pages</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="signin.html" class="dropdown-item">Sign In</a>
                            <a href="signup.html" class="dropdown-item">Sign Up</a>
                            <a href="404.html" class="dropdown-item">404 Error</a>
                            <a href="blank.html" class="dropdown-item">Blank Page</a>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->

        <!-- Content Start -->
        <div class="content">
            <!-- Sale & Revenue Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-line fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Today Sale</p>
                                <h6 class="mb-0">$1234</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-bar fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Total Sale</p>
                                <h6 class="mb-0">$1234</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-area fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Today Revenue</p>
                                <h6 class="mb-0">$1234</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-pie fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Total Revenue</p>
                                <h6 class="mb-0">$1234</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Sale & Revenue End -->

            <!-- Recent Sales Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-light text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Data Pengguna</h6>
                        <button type="button" class="btn btn-primary" id="btnTambah">Tambah</button>
                        <a href="">Show All</a>
                    </div>

                    <div class="table-responsive">
                        <table class="table text-start align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr class="text-dark">
                                    <th>ID</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>No HP</th>
                                    <th>Role</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="userTableBody">
                                <?php foreach ($rows as $row): ?>
                                    <tr>
                                        <td><?php echo $row['id_222271']; ?></td>
                                        <td><?php echo $row['nama_222271']; ?></td>
                                        <td><?php echo $row['email_222271']; ?></td>
                                        <td><?php echo $row['no_hp_222271']; ?></td>
                                        <td><?php echo $row['role_222271']; ?></td>
                                        <td>
                                            <a href="edit.php?id=<?php echo $row['id_222271']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                            <a href="delete.php?id=<?php echo $row['id_222271']; ?>" class="btn btn-danger btn-sm">Hapus</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Recent Sales End -->

            <!-- Back to Top -->
            <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
        </div>

        <!-- JavaScript Libraries -->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="lib/chart/chart.min.js"></script>
        <script src="lib/easing/easing.min.js"></script>
        <script src="lib/waypoints/waypoints.min.js"></script>
        <script src="lib/owlcarousel/owl.carousel.min.js"></script>
        <script src="lib/tempusdominus/js/moment.min.js"></script>
        <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
        <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

        <!-- Template Javascript -->
        <script src="js/main.js"></script>
        <?php
        require 'templates/footer.php';
        ?>
</body>

</html>