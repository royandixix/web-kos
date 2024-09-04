<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Bootstrap Navbar Demo</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="css/main.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
      integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <style></style>
  </head>
  <body>
  <nav class="navbar navbar-expand-lg navbar-custom sticky-top">
        <div class="container">
            <a class="navbar-brand nav-link" href="#">Kapan Lagi yok Beli Segerah</a>
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

    <div class="container my-5">
      <h3 class="text-3xl font-semibold zoom-text">
        Penjualan mobil bekas<br />
        <span class="text-primary">
          Temukan Mobil Bekas Berkualitas yang Anda Impikan!
        </span>
      </h3>

      <p class="mt-3 font-semibold zoom-text">
        <strong>
          <b class="text-primary">Kualitas sangat terjamin</b> Setiap mobil
          bekas di situs kami telah diperiksa oleh teknisi berpengalaman. Kami
          hanya menawarkan mobil yang telah memenuhi standar kualitas tinggi,
          sehingga Anda bisa membeli dengan percaya diri. Tempat terbaik untuk
          menemukan berbagai pilihan mobil bekas dengan harga yang terjangkau
          dan kualitas yang tak tertandingi!
        </strong>
      </p>

      <!-- gambar slider -->
      <div class="mt-5">
        <div
          id="carouselExampleCaptions"
          class="carousel slide"
          data-bs-ride="carousel"
          data-bs-interval="2000"
        >
          <div class="carousel-indicators">
            <button
              type="button"
              data-bs-target="#carouselExampleCaptions"
              data-bs-slide-to="0"
              class="active"
              aria-current="true"
              aria-label="Slide 1"
            ></button>
            <button
              type="button"
              data-bs-target="#carouselExampleCaptions"
              data-bs-slide-to="1"
              aria-label="Slide 2"
            ></button>
            <button
              type="button"
              data-bs-target="#carouselExampleCaptions"
              data-bs-slide-to="2"
              aria-label="Slide 3"
            ></button>
          </div>
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img
                src="img/mobil/p06whvul8rouwww9fpu4.jpg"
                class="d-block w-100 zoom-image"
                alt="Gambar 1"
              />
              <div class="carousel-caption d-none d-md-block">
                <h5 class="zoom-text">Halaman depan samping mobil</h5>
                <p>
                  Beberapa konten placeholder yang representatif untuk slide
                  pertama.
                </p>
              </div>
            </div>
            <div class="carousel-item">
              <img
                src="img/mobil/pqebnptdvxbzjqfpg6xc.jpg"
                class="d-block w-100 zoom-image"
                alt="Gambar 2"
              />
              <div class="carousel-caption d-none d-md-block">
                <h5 class="zoom-text">Halaman belakang mobil</h5>
                <p>
                  Beberapa konten placeholder yang representatif untuk slide
                  kedua.
                </p>
              </div>
            </div>
            <div class="carousel-item">
              <img
                src="img/mobil/q0vflat0axhqz0pulfzy.jpg"
                class="d-block w-100 zoom-image"
                alt="Gambar 3"
              />
              <div class="carousel-caption d-none d-md-block">
                <h5 class="zoom-text">Halaman full samping mobil</h5>
                <p>
                  Beberapa konten placeholder yang representatif untuk slide
                  ketiga.
                </p>
              </div>
            </div>
          </div>
          <button
            class="carousel-control-prev"
            type="button"
            data-bs-target="#carouselExampleCaptions"
            data-bs-slide="prev"
          >
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Sebelumnya</span>
          </button>
          <button
            class="carousel-control-next"
            type="button"
            data-bs-target="#carouselExampleCaptions"
            data-bs-slide="next"
          >
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Selanjutnya</span>
          </button>
        </div>
      </div>

      <!-- Konten tambahan -->
      <div class="container mt-5">
        <div class="row">
          <!-- Teks di sebelah kiri pada layar besar dan di atas gambar pada layar kecil -->
          <div class=" zoom-text fs-5 ">
            Harga Terbaik: Nikmati harga yang sangat bersaing dan sesuai dengan
            anggaran Anda.
            <br />
            <span class="text-primary">
              Kami menawarkan berbagai pilihan yang dapat memenuhi kebutuhan dan
              preferensi Anda
              <b class="text-dark">
                tanpa mengorbankan kualitas. Selain itu, kami selalu berusaha
                memberikan penawaran terbaik, dengan berbagai paket pembiayaan
                fleksibel yang dapat disesuaikan dengan kondisi keuangan Anda.
              </b>
              Dengan koleksi mobil bekas berkualitas dan layanan purna jual yang
              unggul, Anda dapat menikmati kenyamanan dan ketenangan pikiran
              saat memilih kendaraan yang tepat untuk Anda.
            </span>
          </div>

          <!-- Gambar di sebelah kanan pada layar besar dan di bawah teks pada layar kecil -->
          <div class="mt-5 row">
            <!-- Gambar Mobil -->
            <div class="col-lg-6 col-md-12">
              <img
                src="img/mobil/yrtawcck1dh2do53jsy3.jpg"
                class="img-thumbnail rounded-3 w-100"
                alt="Gambar Mobil"
              />
              <figcaption class="mt-3 figure-caption zoom-text">
                A caption for the above image.
              </figcaption>
            </div>
          
            <!-- Teks di Samping Kanan -->
            <div class="col-lg-6 col-md-12 d-flex align-items-center">
              <div class="p-3">
                <h3 class="fw-bold mb-3 interactive-text">Temukan Mobil Impian Anda!</h3>
                <p class="mb-4 interactive-text">
                  Dapatkan penawaran terbaik untuk mobil bekas berkualitas tinggi dengan harga yang sangat bersaing. Kami menyediakan berbagai pilihan yang memenuhi standar kualitas tinggi dan fleksibilitas dalam pembiayaan.
                </p>
                <a href="login.php" class="btn btn-primary w-100 interactive-btn">
                  Mau beli yok !! Login dulu
                </a>
              </div>
            </div>
            
          
         

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>
    <script src="js/main.js"></script>
  </body>
</html>
