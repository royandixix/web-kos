<?php
require 'templates/header.php';
require 'templates/navbar.php';
require 'config/fungsi.php';

// Check if the form is submitted via POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input
    $name = mysqli_real_escape_string($db, trim($_POST['name']));
    $email = mysqli_real_escape_string($db, trim($_POST['email']));
    $phone = mysqli_real_escape_string($db, trim($_POST['phone']));
    $address = mysqli_real_escape_string($db, trim($_POST['address']));
    $paymentMethod = mysqli_real_escape_string($db, trim($_POST['paymentMethod']));
    $price = mysqli_real_escape_string($db, trim($_POST['price']));
    $id_kamar_222271 = isset($_POST['id_kamar_222271']) && !empty($_POST['id_kamar_222271'])
        ? mysqli_real_escape_string($db, trim($_POST['id_kamar_222271']))
        : null;

    // Validate payment method
    if (empty($paymentMethod)) {
        echo "<p style='color:red;'>Error: Harap pilih metode pembayaran.</p>";
        exit;
    }

    // Validate required fields
    if (empty($name) || empty($email) || empty($phone) || empty($address)) {
        echo "<p style='color:red;'>Error: Semua kolom wajib diisi.</p>";
        exit;
    }

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<p style='color:red;'>Error: Format email tidak valid.</p>";
        exit;
    }

    // Validate phone number (if needed, for example, numeric check)
    if (!preg_match("/^[0-9]+$/", $phone)) {
        echo "<p style='color:red;'>Error: Nomor telepon hanya boleh angka.</p>";
        exit;
    }

    // Insert rental data
    $query = "INSERT INTO penyewaan_kos_222271 (nama_222271, email_222271, telepon_222271, alamat_222271, metode_pembayaran_222271, harga_222271) 
              VALUES ('$name', '$email', '$phone', '$address', '$paymentMethod', '$price')";

    if (mysqli_query($db, $query)) {
        $last_id = mysqli_insert_id($db);

        if ($id_kamar_222271) {
            // Insert transaction data if room ID is available
            $transaksiQuery = "INSERT INTO transaksi_222271 (penghuni_id_222271, id_kamar_222271, tanggal_transaksi_222271, jenis_transaksi_222271, jumlah_222271, status_222271) 
                               VALUES ('$last_id', '$id_kamar_222271', NOW(), 's', '$price', 'belum lunas')";

            if (!mysqli_query($db, $transaksiQuery)) {
                echo "<p style='color:orange;'>Data penyewaan berhasil disimpan, tetapi data transaksi gagal disimpan: " . mysqli_error($db) . "</p>";
            } else {
                echo "<script>
                        alert('Penyewaan berhasil! Kami akan menghubungi Anda untuk detail lebih lanjut.');
                        window.location.href='index.php';
                      </script>";
            }
        } else {
            // If room ID is not available
            echo "<p style='color:green;'>Data penyewaan berhasil disimpan tanpa ID kamar.</p>";
        }
    } else {
        echo "<p style='color:red;'>Gagal menyimpan data: " . mysqli_error($db) . "</p>";
    }
}

// Function to format price
function format_harga($harga)
{
    if ($harga >= 1000000) {
        return number_format($harga / 1000000, 1, ',', '.') . ' juta';
    } elseif ($harga >= 1000) {
        return number_format($harga / 1000, 0, ',', '.') . ' ribu';
    } else {
        return number_format($harga, 0, ',', '.');
    }
}
?>

<div class="container mt-5">
    <?php
    // Fetch rooms from the database
    $query = "SELECT * FROM kamar_222271";
    $result = mysqli_query($db, $query);

    // Check if there are any rooms available
    if ($result && mysqli_num_rows($result) > 0) {
        foreach ($result as $row) {
    ?>
            <div class="card d-flex flex-row mb-3" style="width: 100%;">
                <img src="uploads/<?php echo htmlspecialchars($row['foto_222271']); ?>" alt="Gambar Kamar Kos" style="width: 50%; object-fit: cover;">
                <div class="card-body d-flex flex-column justify-content-center" style="width: 50%;">
                    <h5 class="card-title"><?php echo htmlspecialchars($row['alamat_222271']); ?></h5>
                    <p class="card-text"><?php echo htmlspecialchars($row['deskripsi_222271']); ?></p>
                    <p class="card-text"><strong>Harga:</strong> Rp <?php echo number_format((int)$row['harga_222271'], 0, ',', '.'); ?> / bulan</p>

                    <!-- Modal button for renting -->
                    <button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#buyKosModal" 
                        data-price="<?php echo (int)$row['harga_222271']; ?>" data-id="<?php echo (int)$row['id_222271']; ?>">
                        <i class="fa-solid fa-cart-shopping"></i>&nbsp;Sewa Kamar
                    </button>

                    <!-- Modal button for room facilities -->
                    <button type="button" class="btn btn-dark mt-2" data-bs-toggle="modal" data-bs-target="#fasilitasKosModal"
                        data-fasilitas="<?php echo htmlspecialchars($row['fasilitas_222271']); ?>"
                        data-kos-image="<?php echo htmlspecialchars($row['foto_222271']); ?>">
                        <i class="fa-solid fa-info-circle"></i>&nbsp;Lihat Fasilitas
                    </button>
                </div>
            </div>
    <?php
        }
    } else {
        echo "<p>Tidak ada data kamar tersedia.</p>";
    }
    ?>
</div>


<!-- Modal Fasilitas -->
<div class="modal fade" id="fasilitasKosModal" tabindex="-1" aria-labelledby="fasilitasKosModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="fasilitasKosModalLabel">Fasilitas Kos</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul id="fasilitasList"></ul>
                <img id="fasilitasImage" src="" class="card-img-left" alt="Gambar Fasilitas Kos" style="width: 50%; object-fit: cover;">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Formulir Penyewaan Kos -->
<div class="modal fade" id="buyKosModal" tabindex="-1" aria-labelledby="buyKosModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="buyKosModalLabel">Formulir Penyewaan Kos</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="sewaKosForm" action="" method="POST">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Nomor Telepon</label>
                        <input type="tel" class="form-control" id="phone" name="phone" required>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Alamat Tinggal</label>
                        <textarea class="form-control" id="address" name="address" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="paymentMethod" class="form-label">Metode Pembayaran</label>
                        <select class="form-control" id="paymentMethod" name="paymentMethod" required>
                            <option value="">Pilih Metode Pembayaran</option>
                            <option value="Bank Transfer">Bank Transfer</option>
                            <option value="Cash">Cash</option>
                        </select>
                    </div>
                    <input type="hidden" id="id_kamar_222271" name="id_kamar_222271">
                    <input type="hidden" id="price" name="price">
                    <button type="submit" class="btn btn-primary">Sewa Kamar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Show the room price and ID in the modal
    var buyKosModal = document.getElementById('buyKosModal');
    buyKosModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var price = button.getAttribute('data-price');
        var idKamar = button.getAttribute('data-id');
        
        var modalPrice = buyKosModal.querySelector('#price');
        var modalIdKamar = buyKosModal.querySelector('#id_kamar_222271');
        
        modalPrice.value = price;
        modalIdKamar.value = idKamar;
    });

    // Show the facilities in the modal
    var fasilitasKosModal = document.getElementById('fasilitasKosModal');
    fasilitasKosModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var fasilitas = button.getAttribute('data-fasilitas');
        var imageSrc = button.getAttribute('data-kos-image');
        
        var fasilitasList = fasilitasKosModal.querySelector('#fasilitasList');
        var fasilitasImage = fasilitasKosModal.querySelector('#fasilitasImage');
        
        fasilitasList.innerHTML = '<li>' + fasilitas + '</li>';
        fasilitasImage.src = 'uploads/' + imageSrc;
    });
</script>

<?php require 'templates/footer.php'; ?>
