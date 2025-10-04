<?php
require '../vendor/autoload.php';
use Dompdf\Dompdf;
use Dompdf\Options;

include "../koneksi.php";

$id_warga = $_GET['id'];
$q_tampil_warga = mysqli_query($db, "SELECT * FROM datawarga WHERE idwarga='$id_warga'");
$r_tampil_warga = mysqli_fetch_array($q_tampil_warga);

// --- Ambil foto ---
if (empty($r_tampil_warga['foto']) or ($r_tampil_warga['foto'] == '-')) {
    $foto = "admin-no-photo.jpg";
} else {
    $foto = $r_tampil_warga['foto'];
}

// Path absolut gambar
$fotoPath = realpath(__DIR__ . "/../images/" . $foto);

// Jika tidak ditemukan, fallback ke default
if (!file_exists($fotoPath)) {
    $fotoPath = realpath(__DIR__ . "/../images/admin-no-photo.jpg");
}

// === Solusi paling aman: ubah ke base64 ===
$type = pathinfo($fotoPath, PATHINFO_EXTENSION);
$data = file_get_contents($fotoPath);
$base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

// --- Konfigurasi Dompdf ---
$options = new Options();
$options->set('isRemoteEnabled', true);
$dompdf = new Dompdf($options);

// --- HTML output ---
$html = '
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<style>
  body { font-family: Arial, sans-serif; font-size: 12px; }
  .container {
    background: #0dcaf0;
    color: black;
    width: 360px;
    padding: 15px;
    margin: auto;
    border-radius: 8px;
  }
  .header { text-align: center; margin-bottom: 10px; font-size: 14px; }
  .row { width: 100%; }
  .col-left { float: left; width: 65%; }
  .col-right { float: right; width: 35%; text-align: center; }
  img { border: 1px solid #000; }
  table { font-size: 11px; }
</style>
</head>
<body>
  <div class="container">
    <div class="header">
      <strong>PROVINSI JAWA BARAT</strong><br>
      <sub>KOTA DEPOK</sub>
    </div>
    <div class="row">
      <div class="col-left">
        <table>
          <tr><td colspan="2">NIK : '.$r_tampil_warga['idwarga'].'</td></tr>
          <tr><td>Nama</td><td>: '.$r_tampil_warga['nama'].'</td></tr>
          <tr><td>Tanggal Lahir</td><td>: '.$r_tampil_warga['tanggal'].'</td></tr>
          <tr><td>Jenis Kelamin</td><td>: '.$r_tampil_warga['jeniskelamin'].'</td></tr>
          <tr><td>Alamat</td><td>: '.$r_tampil_warga['alamat'].'</td></tr>
          <tr><td>Agama</td><td>: '.$r_tampil_warga['agama'].'</td></tr>
          <tr><td>Status</td><td>: '.$r_tampil_warga['statu'].'</td></tr>
          <tr><td>Pekerjaan</td><td>: '.$r_tampil_warga['kerja'].'</td></tr>
          <tr><td>Kewarganegaraan</td><td>: '.$r_tampil_warga['warganegara'].'</td></tr>
        </table>
      </div>
      <div class="col-right">
        <img src="'.$base64.'" width="110" height="140">
      </div>
    </div>
    <div style="clear: both;"></div>
  </div>
</body>
</html>
';

$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream("kartu-".$r_tampil_warga['idwarga'].".pdf", ["Attachment" => true]);
