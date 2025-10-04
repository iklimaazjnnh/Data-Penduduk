<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Cetak Kartu</title>
  <link rel="stylesheet" href="../assets/css/bootstrap.min.css">


  <style>
    /* CSS khusus cetak */
    @media print {
      button, a {
        display: none; /* tombol hilang saat dicetak */
      }
      body {
        margin: 0;
        padding: 0;
      }
      .container {
        margin: 0;
        padding: 0;
        border: none;
        box-shadow: none;
      }
    }
  </style>
</head>
<body>
<?php
  include "../koneksi.php";
  $id_warga = $_GET['id'];
  $q_tampil_warga = mysqli_query($db,"SELECT * FROM datawarga WHERE idwarga='$id_warga'");
  $r_tampil_warga = mysqli_fetch_array($q_tampil_warga);

  if(empty($r_tampil_warga['foto']) or ($r_tampil_warga['foto']=='-'))
    $foto = "admin-no-photo.jpg";
  else
    $foto = $r_tampil_warga['foto'];
?>

<div class="container bg-info text-black col-4 mt-5 p-3">
  <div class="col-12 text-center mb-2">
    <strong>PROVINSI JAWA BARAT</strong><br>
    <sub>KOTA DEPOK</sub>
  </div>
  <div class="row">
    <div class="col-6">
      <table>
        <tr><td colspan="2">NIK : <?php echo $r_tampil_warga['idwarga']; ?></td></tr>
        <tr><td>Nama</td><td>: <?php echo $r_tampil_warga['nama']; ?></td></tr>
        <tr><td>Tanggal Lahir</td><td>: <?php echo $r_tampil_warga['tanggal']; ?></td></tr>
        <tr><td>Jenis Kelamin</td><td>: <?php echo $r_tampil_warga['jeniskelamin']; ?></td></tr>
        <tr><td>Alamat</td><td>: <?php echo $r_tampil_warga['alamat']; ?></td></tr>
        <tr><td>Agama</td><td>: <?php echo $r_tampil_warga['agama']; ?></td></tr>
        <tr><td>Status</td><td>: <?php echo $r_tampil_warga['statu']; ?></td></tr>
        <tr><td>Pekerjaan</td><td>: <?php echo $r_tampil_warga['kerja']; ?></td></tr>
        <tr><td>Kewarganegaraan</td><td>: <?php echo $r_tampil_warga['warganegara']; ?></td></tr>
      </table>
    </div>
    <div class="col-6 text-center">
      <img src="../images/<?php echo $foto; ?>" width="120" height="150" style="margin-top:20px;">
    </div>
  </div>
</div>

<!-- Tombol print -->
<div class="text-center mt-3">
  <a href="cetak-kartu-pdf.php?id=<?php echo $r_tampil_warga['idwarga']; ?>" 
     class="btn btn-success">Cetak / Download PDF</a>
</div>


</body>
</html>
