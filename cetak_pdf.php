<?php
require 'vendor/autoload.php'; // Pastikan Dompdf sudah terinstal
require 'config/fungsi.php';
use Dompdf\Dompdf;
use Dompdf\Options;

// Ambil semua data dari tabel kamar_222271
$query = "SELECT * FROM kamar_222271";
$result = $db->query($query);

if (!$result || $result->num_rows === 0) {
    die("Tidak ada data yang ditemukan di tabel kamar_222271.");
}

// Inisialisasi Dompdf
$options = new Options();
$options->set('isRemoteEnabled', true); // Aktifkan remote resource untuk gambar
$dompdf = new Dompdf($options);

// Bangun konten HTML untuk semua data
$html = '<h1>Daftar Kamar</h1>';
$html .= '<table border="1" cellspacing="0" cellpadding="5" style="width:100%; border-collapse:collapse;">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Alamat</th>
                    <th>Harga</th>
                    <th>Status</th>
                    <th>Deskripsi</th>
                    <th>Tanggal Tersedia</th>
                    <th>Fasilitas</th>
                    <th>Ukuran</th>
                    <th>Rating</th>
                    <th>Foto</th>
                </tr>
            </thead>
            <tbody>';

while ($row = $result->fetch_assoc()) {
    $foto_path = !empty($row['foto_222271']) ? 'uploads/' . $row['foto_222271'] : '';
    $foto_html = $foto_path && file_exists($foto_path) 
        ? '<img src="' . $foto_path . '" style="width:50px; height:auto;">' 
        : 'Tidak ada';

    $html .= '<tr>
                <td>' . htmlspecialchars($row['id_222271']) . '</td>
                <td>' . htmlspecialchars($row['alamat_222271']) . '</td>
                <td>Rp' . number_format($row['harga_222271'], 2, ',', '.') . '</td>
                <td>' . htmlspecialchars($row['status_222271']) . '</td>
                <td>' . htmlspecialchars($row['deskripsi_222271']) . '</td>
                <td>' . htmlspecialchars($row['tanggal_tersedia_222271']) . '</td>
                <td>' . htmlspecialchars($row['fasilitas_222271']) . '</td>
                <td>' . htmlspecialchars($row['ukuran_222271']) . '</td>
                <td>' . htmlspecialchars($row['rating_222271']) . '</td>
                <td>' . $foto_html . '</td>
              </tr>';
}

$html .= '</tbody></table>';

// Load konten ke Dompdf
$dompdf->loadHtml($html);

// Set ukuran kertas
$dompdf->setPaper('A4', 'landscape');

// Render PDF
$dompdf->render();

// Kirim ke browser
$dompdf->stream("daftar_kamar.pdf", ["Attachment" => false]);
?>
