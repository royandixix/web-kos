<?php
    require 'config/fungsi.php';

    // Koneksi ke database
    $db = mysqli_connect("localhost", "root", "", "222271_royandi");

    // Fungsi untuk mengambil data transaksi berdasarkan ID
    function getTransaksiById($db, $id_transaksi) {
        $query = "
            SELECT 
                transaksi_222271.id_222271 AS id_transaksi,
                penyewaan_kos_222271.nama_222271 AS nama,
                penyewaan_kos_222271.metode_pembayaran_222271 AS metode_pembayaran,
                penyewaan_kos_222271.harga_222271 AS harga,
                transaksi_222271.penghuni_id_222271 AS penghuni_id,
                transaksi_222271.kamar_id_222271 AS kamar_id,
                transaksi_222271.tanggal_transaksi_222271 AS tanggal_transaksi,
                transaksi_222271.jenis_transaksi_222271 AS jenis_transaksi,
                transaksi_222271.jumlah_222271 AS jumlah,
                transaksi_222271.status_222271 AS status
            FROM 
                transaksi_222271
            JOIN 
                penyewaan_kos_222271 
            ON 
                transaksi_222271.penghuni_id_222271 = penyewaan_kos_222271.id_222271
            WHERE 
                transaksi_222271.id_222271 = $id_transaksi
        ";

        $result = mysqli_query($db, $query);
        
        // Cek jika ada hasil
        if ($result && mysqli_num_rows($result) > 0) {
            return mysqli_fetch_assoc($result);
        }
        return null;
    }

    // Fungsi untuk mengambil daftar metode pembayaran
    function getMetodePembayaran($db) {
        $query = "SELECT DISTINCT metode_pembayaran_222271 FROM penyewaan_kos_222271";
        $result = mysqli_query($db, $query);

        $metode_pembayaran = [];
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $metode_pembayaran[] = $row['metode_pembayaran_222271'];
            }
        }
        return $metode_pembayaran;
    }

    // Dapatkan data transaksi berdasarkan ID yang diberikan
    $id_transaksi = 1; // ID transaksi yang ingin ditampilkan
    $transaksi = getTransaksiById($db, $id_transaksi);

    // Dapatkan daftar metode pembayaran
    $metodePembayaranList = getMetodePembayaran($db);
?>

<div class="container mt-5">
    <h3 class="text-center">Edit Transaksi</h3>
    <form action="" method="POST">
        <div class="form-group mb-3">
            <label for="penghuni_id">ID Penghuni</label>
            <input type="number" name="penghuni_id" id="penghuni_id" class="form-control" value="<?php echo htmlspecialchars($transaksi['penghuni_id']); ?>" required>
        </div>
        <div class="form-group mb-3">
            <label for="kamar_id">ID Kamar</label>
            <input type="number" name="kamar_id" id="kamar_id" class="form-control" value="<?php echo htmlspecialchars($transaksi['kamar_id']); ?>" required>
        </div>
        <div class="form-group mb-3">
            <label for="tanggal_transaksi">Tanggal Transaksi</label>
            <input type="date" name="tanggal_transaksi" id="tanggal_transaksi" class="form-control" value="<?php echo htmlspecialchars($transaksi['tanggal_transaksi']); ?>" required>
        </div>
        <div class="form-group mb-3">
            <label for="jenis_transaksi">Jenis Transaksi</label>
            <select name="jenis_transaksi" id="jenis_transaksi" class="form-control" required>
                <?php foreach ($metodePembayaranList as $metode): ?>
                    <option value="<?php echo htmlspecialchars($metode); ?>" <?php echo ($transaksi['jenis_transaksi'] == $metode) ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($metode); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group mb-3">
            <label for="jumlah">Jumlah</label>
            <input type="number" step="0.01" name="jumlah" id="jumlah" class="form-control" value="<?php echo htmlspecialchars($transaksi['jumlah']); ?>" required>
        </div>
        <div class="form-group mb-3">
            <label for="status">Status</label>
            <select name="status" id="status" class="form-control" required>
                <option value="lunas" <?php echo ($transaksi['status'] == 'lunas') ? 'selected' : ''; ?>>Lunas</option>
                <option value="belum lunas" <?php echo ($transaksi['status'] == 'belum lunas') ? 'selected' : ''; ?>>Belum Lunas</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Perbarui</button>
        <a href="admin.php" class="btn btn-secondary">Kembali</a>
    </form>
</div> 
