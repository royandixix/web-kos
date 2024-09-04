<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Bootstrap Navbar Demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <link rel="stylesheet" href="css/main.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/beli.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-custom sticky-top">
        <div class="container">
            <a class="navbar-brand" href="#">Kapan Lagi Yok Beli Segera</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
                    <li class="nav-item">
                        <img src="img/profil/profile.jpg" alt="User Icon" class="rounded-circle" style="width: 40px; height: 40px; object-fit: cover; margin-left: 10px;">
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Car Cards -->
    <div class="container mt-5">
        <div class="card d-flex flex-row mb-3" style="width: 100%;">
            <img src="img/shop/q0vflat0axhqz0pulfzy.jpg" class="card-img-left" alt="Gambar Mobil" style="width: 50%; object-fit: cover;">
            <div class="card-body d-flex flex-column justify-content-center" style="width: 50%;">
                <h5 class="card-title">Pajero Esport</h5>
                <p class="card-text">Mobil bekas dengan kualitas terbaik dan harga terjangkau. Segera miliki mobil impian Anda!</p>
                <p class="card-text"><strong>Nama Mobil:</strong> Pajero Esport</p>
                <p class="card-text"><strong>Harga:</strong> Rp 100.000.000</p>
                <p class="card-text"><strong>Lama Pemakaian:</strong> 6 bulan</p>
                <button type="button" class="btn btn-warning mb-2" data-bs-toggle="modal" data-bs-target="#infoModal">
                    Info
                </button>
                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#cekBarangModal">
                    <i class="fa-solid fa-triangle-exclamation"></i>&nbsp;Cek Barang Dulu Sebelum Beli
                </button>
                <button type="button" class="btn btn-primary mt-3 buy-btn" data-bs-toggle="modal" data-bs-target="#buyModal" data-car-model="Pajero Esport" data-car-price="Rp 100.000.000">
                    <i class="fa-solid fa-cart-shopping"></i>&nbsp;Beli
                </button>
            </div>
        </div>
        <!-- Repeat similar structure for other cars -->
    </div>

    <!-- Modal for Purchase Conditions -->
    <div class="modal fade" id="infoModal" tabindex="-1" aria-labelledby="infoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="infoModalLabel">Syarat dan Ketentuan Pembelian</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>1. Dokumen yang Diperlukan:</strong></p>
                    <ul>
                        <li>KTP asli dan salinan</li>
                        <li>NPWP (jika ada)</li>
                        <li>Surat keterangan penghasilan atau slip gaji</li>
                        <li>Fotokopi rekening koran 3 bulan terakhir</li>
                    </ul>
                    <p><strong>2. Persyaratan Umum:</strong></p>
                    <ul>
                        <li>Usia minimal 21 tahun</li>
                        <li>Memiliki penghasilan tetap</li>
                        <li>Alamat tinggal yang jelas dan dapat diverifikasi</li>
                    </ul>
                    <p><strong>3. Proses Pembelian:</strong></p>
                    <ul>
                        <li>Verifikasi dokumen dan data pribadi</li>
                        <li>Pengajuan kredit (jika diperlukan)</li>
                        <li>Penandatanganan kontrak pembelian</li>
                        <li>Proses pengiriman atau pengambilan mobil</li>
                    </ul>
                    <p><strong>4. Kebijakan Pembatalan:</strong></p>
                    <ul>
                        <li>Pembatalan hanya dapat dilakukan dalam waktu 24 jam setelah pemesanan</li>
                        <li>Biaya pembatalan dapat dikenakan sesuai dengan ketentuan yang berlaku</li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Check Car -->
    <div class="modal fade" id="cekBarangModal" tabindex="-1" aria-labelledby="cekBarangModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cekBarangModalLabel">Cek Barang Sebelum Beli</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Berikut adalah beberapa hal yang perlu diperiksa sebelum membeli mobil:</p>
                    <ul>
                        <li>Periksa kondisi fisik mobil secara menyeluruh</li>
                        <li>Periksa dokumen kendaraan dan pastikan semuanya lengkap dan sah</li>
                        <li>Lakukan test drive untuk memastikan kondisi mesin dan performa mobil</li>
                        <li>Periksa riwayat servis dan pemeliharaan mobil</li>
                        <li>Pastikan tidak ada masalah hukum terkait mobil</li>
                    </ul>
                    <!-- Tambahkan gambar di sini -->
                    <img src="img/shop/pqebnptdvxbzjqfpg6xc.jpg" alt="Cek Barang" class="img-fluid mt-3">
                    <p class="mt-3">Jika Anda memiliki pertanyaan lebih lanjut atau butuh bantuan, silakan hubungi kami.</p>
                    <p>081347018612</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Formulir Pembelian Mobil Modal -->
    <div class="modal fade" id="buyModal" tabindex="-1" aria-labelledby="buyModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="buyModalLabel">Formulir Pembelian Mobil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="purchaseForm">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" id="name" placeholder="Masukkan nama lengkap Anda" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" placeholder="Masukkan alamat email Anda" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Nomor Telepon</label>
                            <input type="tel" class="form-control" id="phone" placeholder="Masukkan nomor telepon Anda" required>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Alamat Pengiriman</label>
                            <textarea class="form-control" id="address" rows="3" placeholder="Masukkan alamat pengiriman Anda" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="carModel" class="form-label">Model Mobil</label>
                            <input type="text" class="form-control" id="carModel" placeholder="Model mobil" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="paymentMethod" class="form-label">Metode Pembayaran</label>
                            <select class="form-select" id="paymentMethod" required>
                                <option value="" disabled selected>Pilih metode pembayaran</option>
                                <option value="cash">Tunai</option>
                                <option value="credit">Kredit</option>
                                <option value="leasing">Leasing</option>
                            </select>
                        </div>
                        <a href="beli.php">
                        <button type="submit" class="btn btn-primary">Kirim</button>
                        </a>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Toast Notification -->
    <div class="position-fixed top-0 end-0 p-3" style="z-index: 1050;">
        <div id="purchaseToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <strong class="me-auto">Pemberitahuan</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                Terima kasih telah melakukan pembelian! Kami akan segera memproses pesanan Anda.
            </div>
        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->
    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script>
      
    </script>
</body>
</html>
