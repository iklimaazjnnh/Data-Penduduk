<?php
require '../vendor/autoload.php';
use Dompdf\Dompdf;
use Dompdf\Options;

include "../koneksi.php";

if (!isset($_GET['id'])) {
    die("ID surat tidak ditemukan.");
}

$id_surat = $_GET['id'];

// Ambil data surat + warga
$sql = "
    SELECT s.*, w.nama, w.alamat, w.foto
    FROM surat AS s
    JOIN datawarga AS w ON s.idwarga = w.idwarga
    WHERE s.id_surat = '$id_surat'
";
$query = mysqli_query($db, $sql);
if (!$query) {
    die("Query gagal: " . mysqli_error($db));
}
$data = mysqli_fetch_assoc($query);

if (!$data) {
    die("Data surat tidak ditemukan.");
}


// --- Dompdf config ---
$options = new Options();
$options->set('isRemoteEnabled', true);
$dompdf = new Dompdf($options);

$jenis = strtolower($data['jenis_surat']);

// --- HTML surat ---
$html = '
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<style>
body {
  font-family: Arial, sans-serif;
  line-height: 1.6;
  font-size: 12pt;
  margin: 40px;
}
h1, h2, h3 { text-align: center; margin: 0; }
.header { text-align: center; border-bottom: 3px solid #000; padding-bottom: 10px; margin-bottom: 20px; }
.data-table td { padding: 4px 10px; }
.ttd { text-align: right; margin-top: 50px; }
img { border: 1px solid #000; margin-top: 10px; }
</style>
</head>
<body>

<div class="header">
  <h2>PEMERINTAH KOTA DEPOK</h2>
  <h3>RUKUN TETANGGA 002/03</h3>
  <p>Kelurahan Jatijajar, Kecamatan Tapos, Kota Depok</p>
</div>

<h3><u>'.htmlspecialchars($data['jenis_surat']).'</u></h3>

<p>Yang bertanda tangan di bawah ini menerangkan bahwa:</p>

<table class="data-table">
  <tr><td>Nama</td><td>:</td><td>'.htmlspecialchars($data['nama']).'</td></tr>
  <tr><td>Alamat</td><td>:</td><td>'.htmlspecialchars($data['alamat']).'</td></tr>
  <tr><td>Keperluan</td><td>:</td><td>'.htmlspecialchars($data['keperluan']).'</td></tr>
</table>
<br>';

if ($jenis == 'surat belum menikah') {
    $html .= '<p>Berdasarkan keterangan dari yang bersangkutan, benar bahwa hingga saat ini <b>yang bersangkutan belum pernah menikah</b>. Surat ini dibuat untuk keperluan '.strtolower(htmlspecialchars($data['keperluan'])).'.</p>';
} elseif ($jenis == 'surat domisili') {
    $html .= '<p>Adalah benar warga yang berdomisili di alamat tersebut di atas. Surat keterangan domisili ini dibuat untuk keperluan '.strtolower(htmlspecialchars($data['keperluan'])).'.</p>';
} elseif ($jenis == 'surat usaha') {
    $html .= '<p>Benar bahwa yang bersangkutan memiliki/mengelola usaha di wilayah kami. Surat keterangan usaha ini dibuat untuk keperluan '.strtolower(htmlspecialchars($data['keperluan'])).'.</p>';
} else {
    $html .= '<p>Demikian surat ini dibuat untuk dipergunakan sebagaimana mestinya.</p>';
}

$html .= '
<div class="ttd">
  <p>Depok, '.date("d-m-Y", strtotime($data['tanggal'])).'</p>
  <p>Ketua RT 02/RW 03</p>
  <br><br><br>
  <p>(..................................)</p>
</div>

</body>
</html>
';

$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream("surat-".$data['id_surat'].".pdf", ["Attachment" => false]);
