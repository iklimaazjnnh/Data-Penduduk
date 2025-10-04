<?php
require '../vendor/autoload.php';
use Dompdf\Dompdf;
use Dompdf\Options;

include "../koneksi.php";

// Ambil semua data warga
$query = mysqli_query($db, "SELECT * FROM datawarga");

// Siapkan isi tabel HTML
$html = '
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<style>
  body {
    font-family: Arial, sans-serif;
    font-size: 12px;
  }
  table {
    border-collapse: collapse;
    width: 100%;
  }
  th, td {
    border: 1px solid #000;
    padding: 5px;
    text-align: left;
  }
  th {
    background-color: #006400;
    color: #fff;
  }
  td img {
    width: 60px;
    height: 80px;
    object-fit: cover;
  }
  h2 {
    text-align: center;
    margin-bottom: 10px;
  }
</style>
</head>
<body>
  <h2>Data Warga</h2>
  <table>
    <thead>
      <tr>
        <th>No</th>
        <th>NIK</th>
        <th>Nama</th>
        <th>Tanggal</th>
        <th>Foto</th>
        <th>Jenis Kelamin</th>
        <th>Alamat</th>
        <th>Agama</th>
        <th>Status</th>
        <th>Pekerjaan</th>
        <th>Kewarganegaraan</th>
      </tr>
    </thead>
    <tbody>';

$no = 1;
while ($r = mysqli_fetch_array($query)) {

    // --- Tentukan path gambar ---
    if (empty($r['foto']) || $r['foto'] == '-') {
        $fotoPath = realpath(__DIR__ . "/../images/admin-no-photo.jpg");
    } else {
        $fotoPath = realpath(__DIR__ . "/../images/" . $r['foto']);
    }

    // --- Pastikan file ada ---
    if (!file_exists($fotoPath)) {
        $fotoPath = realpath(__DIR__ . "/../images/admin-no-photo.jpg");
    }

    // --- Ubah ke base64 biar tampil di PDF ---
    $type = pathinfo($fotoPath, PATHINFO_EXTENSION);
    $data = file_get_contents($fotoPath);
    $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

    // Tambahkan ke tabel HTML
    $html .= '
      <tr>
        <td>'.$no++.'</td>
        <td>'.$r['idwarga'].'</td>
        <td>'.$r['nama'].'</td>
        <td>'.$r['tanggal'].'</td>
        <td><img src="'.$base64.'"></td>
        <td>'.$r['jeniskelamin'].'</td>
        <td>'.$r['alamat'].'</td>
        <td>'.$r['agama'].'</td>
        <td>'.$r['statu'].'</td>
        <td>'.$r['kerja'].'</td>
        <td>'.$r['warganegara'].'</td>
      </tr>';
}

$html .= '
    </tbody>
  </table>
</body>
</html>';

// --- Generate PDF ---
$options = new Options();
$options->set('isRemoteEnabled', true);
$dompdf = new Dompdf($options);

$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();
$dompdf->stream("data-warga.pdf", ["Attachment" => true]);
