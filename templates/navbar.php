<nav class="navbar navbar-expand-lg navbar-custom sticky-top">
    <div class="container">
        <a class="navbar-brand nav-link" href="#">Platform Penyewaan Kost</a>
        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent"
            aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="index.php"><i class="fa-solid fa-house"></i>&nbsp;Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="beli.php"><i class="fa-solid fa-info-circle"></i>&nbsp;Sewa Kost</a>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link" href="kontak.php"><i class="fa-solid fa-phone"></i>&nbsp;Kontak</a>
                </li> -->
                <li class="nav-item">
                    <a class="nav-link" href="dhasboard.php"><i class="fas fa-tachometer-alt"></i>&nbsp;Dashboard</a>
                </li>

                <!-- Profil dan Logout -->
                <li class="nav-item d-flex align-items-center">
                    <?php if (isset($_SESSION['user']['profile_pic']) && isset($_SESSION['user']['name'])): ?>
                        <img src="<?php echo htmlspecialchars($_SESSION['user']['profile_pic']); ?>" alt="Foto Pengguna" class="rounded-circle" style="width: 40px; height: 40px; object-fit: cover; margin-right: 10px; cursor: pointer;" id="profile">
                        <span style="cursor: pointer;" id="profile-name"><?php echo htmlspecialchars($_SESSION['user']['name']); ?></span>
                    <?php else: ?>
                        <a class="nav-link" href="login.php">Login</a>
                    <?php endif; ?>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- JavaScript untuk Konfirmasi Logout -->
<script>
    // Tambahkan event listener ke elemen gambar profil dan nama profil
    const profileElement = document.getElementById('profile');
    const profileNameElement = document.getElementById('profile-name');

    if (profileElement && profileNameElement) {
        profileElement.addEventListener('click', function() {
            Swal.fire({
                title: "Apakah Anda yakin ingin logout?",
                showDenyButton: true,
                confirmButtonText: "Logout",
                denyButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika dikonfirmasi, arahkan ke halaman logout
                    window.location.href = 'logout.php';
                } else if (result.isDenied) {
                    Swal.fire("Logout dibatalkan", "", "info");
                }
            });
        });
    }
</script>



    

<?php
// Menghitung total penghuni
?>