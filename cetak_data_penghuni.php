<?php
// Include autoloader (jika menggunakan Composer)
require_once __DIR__ . '/vendor/autoload.php'; 
use Spipu\Html2Pdf\Html2Pdf;

// Mengambil data yang sama seperti di halaman sebelumnya
$pdo = new PDO('mysql:host=localhost;dbname=kos', 'username', 'password');
$stmt = $pdo->query("SELECT * FROM penghuni");
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

try {
    // Membuat instance Html2Pdf
    $html2pdf = new Html2Pdf('P', 'A4', 'en');
    
    // Menyiapkan konten HTML untuk PDF
    ob_start();
    ?>
    <html>
    <head>
        <style>
            body { font-family: Arial, sans-serif; }
            table { width: 100%; border-collapse: collapse; }
            th, td { padding: 8px; text-align: left; border: 1px solid #ddd; }
            th { background-color: #f2f2f2; }
        </style>
    </head>
    <body>
        <h2>Data Penghuni Kos</h2>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>No HP</th>
                    <th>Role</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($rows)): ?>
                    <?php $no = 1; ?>
                    <?php foreach ($rows as $row): ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo htmlspecialchars($row['nama_222271']); ?></td>
                            <td><?php echo htmlspecialchars($row['email_222271']); ?></td>
                            <td><?php echo htmlspecialchars($row['nomorTelepon_222271']); ?></td>
                            <td><?php echo htmlspecialchars($row['role_222271']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center">Tidak ada data</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </body>
    </html>
    <?php
    $content = ob_get_clean();

    // Memasukkan HTML ke dalam PDF
    $html2pdf->writeHTML($content);

    // Output PDF
    $html2pdf->output('data_penghuni_kos.pdf');
} catch (Html2PdfException $e) {
    echo $e;
    exit;
}
?>
