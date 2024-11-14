<?php
require 'templates/header.php';
require 'templates/navbar.php';
?>

<!-- Kos Cards -->
<div class="container mt-5">
    <div class="card d-flex flex-row mb-3" style="width: 100%;">
        <img src="img/kos/photo-stair-pabuaran-resident-desain-arsitek-oleh-dtarchitekt.jpeg" class="card-img-left" alt="Gambar Kos" style="width: 50%; object-fit: cover;">
        <div class="card-body d-flex flex-column justify-content-center" style="width: 50%;">
            <h5 class="card-title">Pabuaran Resident</h5>
            <p class="card-text">Kos nyaman dengan fasilitas lengkap dan harga terjangkau. Segera sewa kos impian Anda!</p>
            <p class="card-text"><strong>Nama Kos:</strong> Pabuaran Resident</p>
            <p class="card-text"><strong>Harga:</strong> Rp 1.500.000 / bulan</p>
            <p class="card-text"><strong>Lokasi:</strong> Jl. Pabuaran No. 23, Jakarta</p>
            <button type="button" class="btn btn-dark mb-2" data-bs-toggle="modal" data-bs-target="#fasilitasKosModal">Fasilitas</button>
            <button type="button" class="btn btn-warning mb-2" data-bs-toggle="modal" data-bs-target="#infoKosModal">Info</button>
            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#cekBarangKosModal">
                <i class="fa-solid fa-triangle-exclamation"></i>&nbsp;Cek Kos Sebelum Sewa
            </button>
            <button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#buyKosModal" data-kos-name="Pabuaran Resident" data-kos-price="Rp 1.500.000 / bulan">
                <i class="fa-solid fa-cart-shopping"></i>&nbsp;Sewa
            </button>
        </div>
    </div>
    <!-- Repeat similar structure for other kos -->
</div>

<div class="container mt-5">

    <!-- Modal for Kos Conditions -->
    <div class="modal fade" id="infoKosModal" tabindex="-1" aria-labelledby="infoKosModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="infoKosModalLabel">Syarat dan Ketentuan Penyewaan Kos</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>1. Dokumen yang Diperlukan:</strong></p>
                    <ul>
                        <li>KTP asli dan salinan</li>
                        <li>NPWP (jika ada)</li>
                        <li>Surat keterangan pekerjaan atau slip gaji</li>
                    </ul>
                    <p><strong>2. Persyaratan Umum:</strong></p>
                    <ul>
                        <li>Usia minimal 18 tahun</li>
                        <li>Memiliki pekerjaan atau penghasilan tetap</li>
                        <li>Mematuhi aturan kos</li>
                    </ul>
                    <p><strong>3. Proses Penyewaan:</strong></p>
                    <ul>
                        <li>Verifikasi dokumen dan data pribadi</li>
                        <li>Penandatanganan kontrak sewa</li>
                        <li>Proses pembayaran dan penyerahan kunci</li>
                    </ul>
                    <p><strong>4. Kebijakan Pembatalan:</strong></p>
                    <ul>
                        <li>Pembatalan hanya dapat dilakukan sebelum pembayaran dilakukan</li>
                        <li>Biaya pembatalan sesuai dengan ketentuan yang berlaku</li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Fasilitas Modal -->
    <div class="modal fade" id="fasilitasKosModal" tabindex="-1" aria-labelledby="fasilitasKosModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="fasilitasKosModalLabel">Fasilitas Kos</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ul>
                        <li>Kamar ber-AC</li>
                        <li>Tempat tidur dan lemari pakaian</li>
                        <li>Kamar mandi dalam</li>
                        <li>Wi-Fi gratis</li>
                        <li>Dapur bersama</li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Check Kos -->
    <div class="modal fade" id="cekBarangKosModal" tabindex="-1" aria-labelledby="cekBarangKosModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cekBarangKosModalLabel">Cek Kos Sebelum Sewa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Berikut adalah beberapa hal yang perlu diperiksa sebelum menyewa kos:</p>
                    <ul>
                        <li>Periksa kondisi kamar dan fasilitas secara langsung</li>
                        <li>Tanyakan tentang aturan kos</li>
                        <li>Pastikan tidak ada masalah terkait sewa sebelumnya</li>
                    </ul>
                    <img src="img/shop/pqebnptdvxbzjqfpg6xc.jpg" alt="Cek Kos" class="img-fluid mt-3">
                    <p class="mt-3">Jika Anda memiliki pertanyaan lebih lanjut atau butuh bantuan, silakan hubungi kami.</p>
                    <p>081347018612</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Formulir Penyewaan Kos Modal -->
    <div class="modal fade" id="buyKosModal" tabindex="-1" aria-labelledby="buyKosModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="buyKosModalLabel">Formulir Penyewaan Kos</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="rentForm" action="sewa.php" method="POST">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan nama lengkap Anda" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan alamat email Anda" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Nomor Telepon</label>
                            <input type="tel" class="form-control" id="phone" name="phone" placeholder="Masukkan nomor telepon Anda" required>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Alamat Tinggal</label>
                            <textarea class="form-control" id="address" name="address" rows="3" placeholder="Masukkan alamat tinggal Anda" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="kosName" class="form-label">Nama Kos</label>
                            <input type="text" class="form-control" id="kosName" name="kosName" placeholder="Nama kos" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="paymentMethod" class="form-label">Metode Pembayaran</label>
                            <select class="form-select" id="paymentMethod" name="paymentMethod" required>
                                <option value="" disabled selected>Pilih metode pembayaran</option>
                                <option value="cash">Tunai</option>
                                <option value="transfer">Transfer</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Kirim</button>
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
        <div id="rentToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <strong class="me-auto">Pemberitahuan</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                Terima kasih telah melakukan penyewaan! Kami akan segera memproses pesanan Anda.
            </div>
        </div>
    </div>

<?php
require 'templates/footer.php';
?>
