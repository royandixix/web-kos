<?php require 'header.php' ?>

<nav class="navbar navbar-expand-lg navbar-custom sticky-top shadow">
    <div class="container">
        <a class="navbar-brand nav-link text-dark fw-bold" href="#">
            <i class="fas fa-house-user"></i>&nbsp;Platform Penyewaan Kost
        </a>
        <button
            class="navbar-toggler border-0"
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
                    <a class="nav-link text-dark" href="index.php">
                        <i class="fa-solid fa-map-marked-alt"></i>&nbsp;Beranda
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="beli.php">
                        <i class="fa-solid fa-key"></i>&nbsp;Sewa Kost
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="dhasboard.php">
                        <i class="fas fa-chart-line"></i>&nbsp;Dashboard
                    </a>
                </li>
                <li class="nav-item d-flex align-items-center">
                    <?php if (isset($_SESSION['user']['profile_pic']) && isset($_SESSION['user']['name'])): ?>
                        <img
                            src="<?php echo htmlspecialchars($_SESSION['user']['profile_pic']); ?>"
                            alt="Foto Pengguna"
                            class="rounded-circle profile-pic"
                            id="profile">
                        <span
                            class="profile-name text-dark"
                            id="profile-name">
                            <?php echo htmlspecialchars($_SESSION['user']['name']); ?>
                        </span>
                    <?php else: ?>
                        <a class="nav-link text-dark" href="login.php">
                            <i class="fas fa-user-circle"></i>&nbsp;Login
                        </a>
                    <?php endif; ?>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="akun.php">
                        <i class="fa-solid fa-key"></i>&nbsp;Edit Akun
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>


<!-- CSS -->
<style>
    body {
        font-family: 'Poppins', sans-serif;
        /* Menggunakan Poppins sebagai default font */
    }

    .navbar-custom {
        background-color: rgba(255, 255, 255, 0.8);
        padding: 1rem 1.5rem;
        transition: background-color 0.5s ease, box-shadow 0.5s ease;
        backdrop-filter: blur(10px);
        font-family: 'Poppins', sans-serif;
    }

    .navbar-custom.scrolled {
        background-color: rgba(255, 255, 255, 1);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .navbar-brand {
        font-size: 1.5rem;
        font-family: 'Poppins', sans-serif;
        font-weight: 600;
    }

    .nav-link {
        font-size: 1rem;
        font-weight: 500;
        font-family: 'Poppins', sans-serif;
        transition: color 0.3s ease, transform 0.3s ease;
    }

    .nav-link:hover {
        color: #007bff !important;
        transform: scale(1.1);
    }

    .profile-pic {
        width: 40px;
        height: 40px;
        object-fit: cover;
        margin-right: 10px;
        border: 2px solid #007bff;
        transition: transform 0.3s ease, border-color 0.3s ease;
    }

    .profile-pic:hover {
        transform: scale(1.1);
        border-color: #ffdf00;
    }

    .profile-name {
        font-size: 1rem;
        font-weight: 500;
        font-family: 'Poppins', sans-serif;
        cursor: pointer;
        transition: color 0.3s ease;
    }

    .profile-name:hover {
        color: #007bff;
    }

    .navbar-toggler {
        background-color: white;
    }

    .navbar-toggler-icon {
        filter: invert(0.8);
    }
</style>


<!-- JavaScript -->
<script>
    // Tambahkan event scroll untuk mengubah background navbar
    document.addEventListener('scroll', function() {
        const navbar = document.querySelector('.navbar-custom');
        if (window.scrollY > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    });

    // SweetAlert2 untuk logout
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
                    window.location.href = 'logout.php';
                } else if (result.isDenied) {
                    Swal.fire("Logout dibatalkan", "", "info");
                }
            });
        });
    }
</script>