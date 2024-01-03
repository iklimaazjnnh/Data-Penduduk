<div id="label-page"><h3>Input Data Penduduk</h3></div>
<div id="content">
	<form action="proses/form-input-proses.php" method="post" enctype="multipart/form-data">
	
	<table id="tabel-input">
		<tr>
			<td class="label-formulir">Foto</td>
			<td class="isian-formulir"><input type="file" name="foto" class="isian-formulir isian-formulir-border"></td>
		</tr>
		<tr>
			<td class="label-formulir">NIK</td>
			<td class="isian-formulir"><input type="text" name="id_warga" class="isian-formulir isian-formulir-border"></td>
		</tr>
		<tr>
			<td class="label-formulir">Nama</td>
			<td class="isian-formulir"><input type="text" name="nama" class="isian-formulir isian-formulir-border"></td>
		</tr>
		<tr> 
			<td class="label-formulir">Tanggal Lahir</td>
			<td class="isian-formulir"><input type="date" name="tanggal" class="isian-formulir isian-formulir-border"></td>
		</tr>
		<tr>
            <td class="label-formulir">Jenis Kelamin</td>
            <td class="isian-formulir"><select name="jeniskelamin">
            <option value="laki-laki">Laki-laki</option>
            <option value="perempuan">Perempuan</option>
            </select> </td>
        </tr>
		<tr>
			<td class="label-formulir">Alamat</td>
			<td class="isian-formulir"><textarea rows="2" cols="40" name="alamat" class="isian-formulir isian-formulir-border"></textarea></td>
		</tr>
			<td class="label-formulir">Agama</td>
			<td class="isian-formulir"><input type="text" name="agama" class="isian-formulir isian-formulir-border"></td>
		</tr>
		<tr>
			<td class="label-formulir">Status Perkawinan</td>
			<td class="isian-formulir"><input type="text" name="statu" class="isian-formulir isian-formulir-border"></td>
		</tr>
		</tr>
			<td class="label-formulir">Pekerjaan</td>
			<td class="isian-formulir"><input type="text" name="kerja" class="isian-formulir isian-formulir-border"></td>
		</tr>
		</tr>
			<td class="label-formulir">Kewarganegaraan</td>
			<td class="isian-formulir"><input type="text" name="warganegara" class="isian-formulir isian-formulir-border"></td>
		</tr>
		<tr>
			<td class="label-formulir"></td>
			<td class="isian-formulir"><input type="submit" name="simpan" value="Simpan" class="tombol"></td>
			<td class="isian-formulir" ><a href="index.php"><input  type="button" name="batal" value="Cancel"></a></td>
		</tr>
		</table>
	</form>
</div>
