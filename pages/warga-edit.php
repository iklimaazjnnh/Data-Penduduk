<?php
	$id_warga=$_GET['id'];
	$q_tampil_warga=mysqli_query($db,"SELECT * FROM datawarga WHERE idwarga='$id_warga'");
	$r_tampil_warga=mysqli_fetch_array($q_tampil_warga);
	if(empty($r_tampil_warga['foto'])or($r_tampil_warga['foto']=='-'))
				$foto = "admin-no-photo.jpg";
			else
				$foto = $r_tampil_warga['foto'];
?>
<div id="label-page"><h3>Edit Data warga</h3></div>
<div id="content">
	<form action="proses/warga-edit-proses.php" method="post" enctype="multipart/form-data">
	<table id="tabel-input">
		<tr>
			<td class="label-formulir">FOTO</td>
			<td class="isian-formulir">
			<img src="images/<?php echo $foto; ?>" width=70px height=75px>
			<input type="file" name="foto" class="isian-formulir isian-formulir-border">
			<input type="hidden" name="foto_awal" value="<?php echo $r_tampil_warga['foto']; ?>">
			</td>
		</tr>
		<tr>
			<td class="label-formulir">NIK</td>
			<td class="isian-formulir"><input type="text" name="id_warga" value="<?php echo $r_tampil_warga['idwarga']; ?>" class="isian-formulir isian-formulir-border"></td>
		</tr>
		<tr>
			<td class="label-formulir">Nama</td>
			<td class="isian-formulir"><input type="text" name="nama" value="<?php echo $r_tampil_warga['nama']; ?>" class="isian-formulir isian-formulir-border"></td>
		</tr>
		<tr>
			<td class="label-formulir">Tanggal Lahir</td>
			<td class="isian-formulir"><input type="date" name="tanggal" value="<?php echo $r_tampil_warga['tanggal']; ?>" class="isian-formulir isian-formulir-border"></td>
		</tr>
		<tr>
            <td class="label-formulir">Jenis Kelamin</td>
            <td class="isian-formulir"><select name="jeniskelamin">
            <option value="<?php echo $r_tampil_warga['jeniskelamin']; ?>"><?php echo $r_tampil_warga['jeniskelamin']; ?></option>
            <option value="Laki-laki">Laki-laki</option>
            <option value="Perempuan">Perempuan</option>
            </select> </td>
        </tr>
		<tr>
			<td class="label-formulir">Alamat</td>
			<td class="isian-formulir"><textarea rows="2" cols="40" name="alamat" class="isian-formulir isian-formulir-border"><?php echo $r_tampil_warga['alamat']; ?></textarea></td>
		</tr>
		<tr>
			<td class="label-formulir">Agama</td>
			<td class="isian-formulir"><input type="text" name="agama" value="<?php echo $r_tampil_warga['agama']; ?>" class="isian-formulir isian-formulir-border"></td>
		</tr>
		<tr>
			<td class="label-formulir">Status Perkawinan</td>
			<td class="isian-formulir"><input type="text" name="statu" value="<?php echo $r_tampil_warga['statu']; ?>" class="isian-formulir isian-formulir-border"></td>
		</tr>
		<tr>
			<td class="label-formulir">Pekerjaan</td>
			<td class="isian-formulir"><input type="text" name="kerja" value="<?php echo $r_tampil_warga['kerja']; ?>" class="isian-formulir isian-formulir-border"></td>
		</tr>
		<tr>
			<td class="label-formulir">Kewarganegaraan</td>
			<td class="isian-formulir"><input type="text" name="warganegara" value="<?php echo $r_tampil_warga['warganegara']; ?>" class="isian-formulir isian-formulir-border"></td>
		</tr>
		<tr>
			<td class="label-formulir"></td>
			<td class="isian-formulir"><input type="submit" name="simpan" value="Simpan" id="tombol-simpan"></td>
		</tr>
	</table>
	</form>
</div>