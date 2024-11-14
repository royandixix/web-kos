<?php
  require 'templates/header.php';   
  require 'templates/navbar.php'; 
?>
    <div class="container my-5">
      <h3 class="text-3xl font-semibold zoom-text">
        Platform Komunikasi Penghuni Kos<br />
        <span class="text-primary">
          Temukan Informasi, Fasilitas, dan Komunikasi Antar Penghuni!
        </span>
      </h3>

      <p class="mt-3 font-semibold zoom-text">
        <strong>
          <b class="text-primary">Berbagai kemudahan dalam satu platform</b> 
          Kami menyediakan platform ini agar penghuni kos dapat saling terhubung, 
          mendapatkan informasi penting, serta memanfaatkan fasilitas yang disediakan oleh pengelola kos.
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
                src="img/kos/20210621-003531_miliki-usaha-koskosan-sendiri-dengan-pinjaman-online-ikuti-tips-ini-agar-lancar-mewujudkannya.jpeg"
                class="d-block w-100 zoom-image"
                alt="Gambar 1"
              />
              <div class="carousel-caption d-none d-md-block">
                <h5 class="zoom-text">Lorong Kos</h5>
                <p>
                  Tampilan lorong kos yang nyaman dan aman.
                </p>
              </div>
            </div>
            <div class="carousel-item">
              <img
                src="img/kos/859964_720.jpg"
                class="d-block w-100 zoom-image"
                alt="Gambar 2"
              />
              <div class="carousel-caption d-none d-md-block">
                <h5 class="zoom-text">Kamar Penghuni</h5>
                <p>
                  Kamar dengan fasilitas lengkap dan modern.
                </p>
              </div>
            </div>
            <div class="carousel-item">
              <img
                src="img/kos/contoh-gambar-desain-koskosan-lahan-sempit-46.jpeg"
                class="d-block w-100 zoom-image"
                alt="Gambar 3"
              />
              <div class="carousel-caption d-none d-md-block">
                <h5 class="zoom-text">Ruang Bersama</h5>
                <p>
                  Ruang untuk berkumpul dan berkomunikasi dengan sesama penghuni.
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
          <!-- Teks di sebelah kiri -->
          <div class="zoom-text fs-5">
            Informasi Lengkap: Dapatkan akses informasi terkini terkait fasilitas kos, kegiatan penghuni, dan pengumuman penting dari pengelola kos.
            <br />
            <span class="text-primary">
              Kami selalu menyediakan informasi yang Anda butuhkan untuk menikmati kenyamanan tinggal di kos.
              <b class="text-dark">
                Dapatkan juga akses ke fitur komunikasi dengan penghuni lainnya, sehingga Anda bisa saling membantu dan berinteraksi dengan mudah.
              </b>
            </span>
          </div>

          <!-- Gambar di sebelah kanan -->
          <div class="mt-5 row">
            <div class="col-lg-6 col-md-12">
              <img
                src="img/kos/859964_720.jpg "
                class="img-thumbnail rounded-3 w-100"
                alt="Gambar Ruang Bersama"
              />
              <figcaption class="mt-3 figure-caption zoom-text">
                Ruang bersama untuk komunikasi antar penghuni.
              </figcaption>
            </div>

            <div class="col-lg-6 col-md-12 d-flex align-items-center">
              <div class="p-3">
                <h3 class="fw-bold mb-3 interactive-text">Gabung Sekarang!</h3>
                <p class="mb-4 interactive-text">
                  Dapatkan kemudahan komunikasi dan informasi dengan sesama penghuni kos dan pengelola kos. Kami menyediakan berbagai fitur yang mempermudah kehidupan sehari-hari Anda di kos.
                </p>
                <a href="login.php" class="btn btn-primary w-100 interactive-btn">
                  Login untuk bergabung
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>


    <!-- Seksi Testimoni Penghuni -->
<div class="container mt-5">
  <h3 class="text-center">Apa Kata Penghuni?</h3>
  <div class="row mt-4">
    <div class="col-lg-4 col-md-6">
      <div class="card shadow-sm">
        <img src="img/penghuni1.jpg" class="card-img-top" alt="Penghuni 1" />
        <div class="card-body">
          <h5 class="card-title">John Doe</h5>
          <p class="card-text">
            "Kos ini sangat nyaman dan aman. Fasilitasnya lengkap dan penghuni sangat ramah."
          </p>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-md-6">
      <div class="card shadow-sm">
        <img src="img/penghuni2.jpg" class="card-img-top" alt="Penghuni 2" />
        <div class="card-body">
          <h5 class="card-title">Jane Smith</h5>
          <p class="card-text">
            "Lokasinya strategis dan lingkungan kos bersih. Pengelola kos sangat responsif!"
          </p>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-md-6">
      <div class="card shadow-sm">
        <img src="img/penghuni3.jpg" class="card-img-top" alt="Penghuni 3" />
        <div class="card-body">
          <h5 class="card-title">Mark Lee</h5>
          <p class="card-text">
            "Fasilitas yang disediakan sangat membantu aktivitas sehari-hari. Ruang bersama sangat nyaman untuk bersosialisasi."
          </p>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Seksi Statistik Kos -->
<div class="container mt-5">
  <h3 class="text-center">Statistik Kos</h3>
  <div class="row mt-4 text-center">
    <div class="col-lg-4 col-md-6">
      <div class="stat-box">
        <h1>150+</h1>
        <p>Penghuni Terdaftar</p>
      </div>
    </div>
    <div class="col-lg-4 col-md-6">
      <div class="stat-box">
        <h1>50+</h1>
        <p>Kamar Tersedia</p>
      </div>
    </div>
    <div class="col-lg-4 col-md-6">
      <div class="stat-box">
        <h1>10+</h1>
        <p>Fasilitas Utama</p>
      </div>
    </div>
  </div>
</div>

<footer class="bg-dark text-light py-4 mt-5">
  <div class="container">
    <div class="row">
      <div class="col-lg-6">
        <h5>Tentang Kami</h5>
        <p>Kos XYZ adalah tempat tinggal nyaman yang dilengkapi dengan berbagai fasilitas untuk memudahkan kehidupan sehari-hari penghuni.</p>
      </div>
      <div class="col-lg-6 text-end">
        <h5>Ikuti Kami</h5>
        <a href="#" class="text-light">Facebook</a> | <a href="#" class="text-light">Instagram</a>
      </div>
    </div>
  </div>
</footer>



<?php 
  require 'templates/footer.php';
?>