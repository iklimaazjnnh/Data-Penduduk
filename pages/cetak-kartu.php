<!doctype html>
<html lang="en">

<head>
  <title>Title</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.0-beta1 -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css"
	integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

</head>

<body>
  <header>
	<!-- place navbar here -->
  </header>
  <main>
  <?php
	include "../koneksi.php";
	$id_warga=$_GET['id'];
	$q_tampil_warga=mysqli_query($db,"SELECT * FROM datawarga WHERE idwarga='$id_warga'");
	$r_tampil_warga=mysqli_fetch_array($q_tampil_warga);
	if(empty($r_tampil_warga['foto'])or($r_tampil_warga['foto']=='-'))
		$foto = "admin-no-photo.jpg";
	else
		$foto = $r_tampil_warga['foto'];
?>
<div class="container bg-info text-black col-4">
            <div class="col-12 text-center mt-5 mb-2">
                PROVINSI JAWA BARAT<br>
                <sub>KOTA DEPOK</sub>
            </div>
            <div class="row">
                <div class="col-6">
                    <table>
                        <tr>
                            <td colspan="2"> <div> NIK : <?php echo $r_tampil_warga['idwarga']; ?> </div> </td>
                        </tr>
                        <tr>
                            <td> <div>Nama</div> </td>
                            <td> <div>: <?php echo $r_tampil_warga['nama']; ?> </td>

                        </tr>
                        <tr>
                            <td> <div>Tanggal Lahir</td>
                            <td> <div>: <?php echo $r_tampil_warga['tanggal']; ?> </td>
                        </tr>
                        <tr>
                            <td> <div>Jenis Kelamin </td>
                            <td> <div>: <?php echo$r_tampil_warga['jeniskelamin']; ?> </td>
                        </tr>
                        <tr>
                            <td> <div>Alamat </td>
                            <td> <div>: <?php echo $r_tampil_warga['alamat']; ?> </td>
                        </tr>
                        <tr>
                            <td> <div>Agama </td>
                            <td> <div>: <?php echo $r_tampil_warga['agama']; ?> </td>
                        </tr>
                        <tr>
                            <td> <div>Status</td>
                            <td>  <div>: <?php echo $r_tampil_warga['statu']; ?> </td>
                        </tr>
                        <tr>
                            <td> <div>Pekerjaan </td>
                            <td> <div>: <?php echo $r_tampil_warga['kerja']; ?> </td>
                        </tr>
                        <tr>
                            <td> <div>Kewarganegaraan </td>
                            <td>  <div>: <?php echo$r_tampil_warga['warganegara']; ?> </td>
                        </tr>
                    </table>
                </div>
                <div class="col-6">
                    <table>
                        <tr>
                            <td><img src="../images/<?php echo $foto; ?>" width=120px height=150px style="margin-top:40px;"><br></td>
                        </tr>
                    </table>
                </div>
            </div>
			</div>

        </div>
</body>

</html>
