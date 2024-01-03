<?php
include "../koneksi.php";

?>
<link rel="stylesheet" type="text/css" href="../style.css">
<h3>Data Warga</h3></div>
<div id="content">
<table border="1" id="tabel-tampil">
		<tr>
			<th id="label-tampil-no">No</th>
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
		
		<?php		
		$nomor=1;
		$query="SELECT * FROM datawarga ORDER BY idwarga DESC";
		$q_tampil_warga = mysqli_query($db, $query);
		if(mysqli_num_rows($q_tampil_warga)>0)
		{
		while($r_tampil_warga=mysqli_fetch_array($q_tampil_warga)){
			if(empty($r_tampil_warga['foto'])or($r_tampil_warga['foto']=='-'))
				$foto = "admin-no-photo.jpg";
			else
				$foto = $r_tampil_warga['foto'];
		?>
		<tr>
			<td><?php echo $nomor; ?></td>
			<td><?php echo $r_tampil_warga['idwarga']; ?></td>
			<td><?php echo $r_tampil_warga['nama']; ?></td>
			<td><?php echo $r_tampil_warga['tanggal']; ?></td>
			<td><img src="../images/<?php echo $foto; ?>" width=70px height=70px></td>
			<td><?php echo $r_tampil_warga['jeniskelamin']; ?></td>
			<td><?php echo $r_tampil_warga['alamat']; ?></td>
			<td><?php echo $r_tampil_warga['agama']; ?></td>	
			<td><?php echo $r_tampil_warga['statu']; ?></td>
			<td><?php echo $r_tampil_warga['kerja']; ?></td>
			<td><?php echo $r_tampil_warga['warganegara']; ?></td>		
		</tr>		
		<?php $nomor++; } 
		}?>		
	</table>
</div>
