<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Bootstrap Navbar Demo</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
  <link rel="stylesheet" href="css/login.css">
  <link rel="stylesheet" href="css/main.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
    integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <style>
    body {
      background-image: url(img/login/c14d3a9c6cf248aa9ce2f61c77a5f425_1608x906.jpg);
      background-size: cover;
    }

    .login-form-container {
      max-width: 400px;
      margin: auto;
      background: rgba(255, 255, 255, 0.8);
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .login-form-container .form-control {
      height: 45px;
    }

    .login-form-container .form-label {
      font-weight: bold;
    }

    .login {
      margin-top: 140px;
    }

    .login-title {
      text-align: center;
      font-size: 1.5rem;
      font-weight: bold;
      margin-bottom: 20px;
      color: #333;
    }

    .register-link {
      text-align: center;
      margin-top: 20px;
    }
  </style>
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-custom sticky-top">
        <div class="container">
            <a class="navbar-brand nav-link" href="#">Ayoh Cepetan Login</a>
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
                        <a class="nav-link" href="index.php"><i class="fa-solid fa-house"></i>&nbsp;Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="beli.php"><i class="fa-solid fa-bag-shopping"></i>&nbsp;Pembelian</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Disabled</a>
                    </li>
                    <li>
                        <img src="img/profil/profile.jpg" alt="User Icon" class="rounded-circle" style="width: 40px; height: 40px; object-fit: cover; margin-left: 10px;">
                    </li>
                </ul>
            </div>
        </div>
    </nav>


  <!-- halaman login -->
  <div class="login">
    <div class="container mt-5">
      <div class="login-form-container">
        <h3 class="login-title mt-4">Anda Harus Login Dulu</h3>
        <div class="mb-3">
          <label for="exampleFormControlInput1" class="form-label">Username</label>
          <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="Masukan username anda">
        </div>
        <div class="mb-3">
          <label for="exampleFormControlInput2" class="form-label">Password</label>
          <input type="password" class="form-control" id="exampleFormControlInput2" placeholder="Masukan password anda">
        </div>

        <!-- Tambahkan link registrasi di sini -->
        <div class="register-link">
          <p>Belum punya akun?</p>
          <button class="btn btn-primary" data-bs-target="#exampleModalToggle" data-bs-toggle="modal">Daftar di
            sini</button>

        </div>
      </div>
    </div>
  </div>






  <!-- Halaman register -->
  <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel"
    tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalToggleLabel">Registrasi Akun</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!-- Form Registrasi -->
          <form>
            <div class="mb-3">
              <label for="registerUsername" class="form-label">Username</label>
              <input type="text" class="form-control" id="registerUsername" placeholder="Masukan username">
            </div>
            <div class="mb-3">
              <label for="registerEmail" class="form-label">Email</label>
              <input type="email" class="form-control" id="registerEmail" placeholder="Masukan email">
            </div>
            <div class="mb-3">
              <label for="registerPassword" class="form-label">Password</label>
              <input type="password" class="form-control" id="registerPassword" placeholder="Masukan password">
            </div>
            <div class="mb-3">
              <label for="registerPasswordConfirm" class="form-label">Konfirmasi Password</label>
              <input type="password" class="form-control" id="registerPasswordConfirm"
                placeholder="Masukan kembali password">
            </div>
            <button type="submit" class="btn btn-primary w-100">Daftar</button>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
        </div>
      </div>
    </div>
  </div>






  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
  <script src="js/login.js"></script>
</body>

</html>