<div id="label-page"><h3>Tampil Data Penduduk</h3></div>
<div id="content">
	

<a target="_blank" href="pages/cetak.php"><img src="print.png" height="50px" height="50px"></a>
	<FORM CLASS="form-inline" METHOD="POST">
	<div align="right"><form method=get><input type="text" name="pencarian"><input type="submit" name="search" value="search" class="tombol"></form>
	</FORM>
	<table id="tabel-tampil">
		<tr>
			<th id="label-tampil-no">No</td>
			<th>NIK</th>
			<th>Nama</th>
			<th>Tanggal Lahir</th>
			<th>Foto</th>
			<th>Jenis Kelamin</th>
			<th>Alamat</th>
			<th>Agama</th>
			<th>Status Perkawinan</th>
			<th>Pekerjaan</th>
			<th>Kewarganegaraan</th>
			<th id="label-opsi">Opsi</th>
		</tr>

		<?php
		$batas = 5;
		extract($_GET);
		if(empty($hal)){
			$posisi = 0;
			$hal = 1;
			$nomor = 1;
		}
		else {
			$posisi = ($hal - 1) * $batas;
			$nomor = $posisi+1;
		}	
		if($_SERVER['REQUEST_METHOD'] == "POST"){
			$pencarian = trim(mysqli_real_escape_string($db, $_POST['pencarian']));
			if($pencarian != ""){
				$sql = "SELECT * FROM datawarga WHERE nik LIKE '%$pencarian%'
						OR idwarga LIKE '%$pencarian%'
						OR jeniskelamin LIKE '%$pencarian%'
						OR alamat LIKE '%$pencarian%'";
				
				$query = $sql;
				$queryJml = $sql;	
						
			}
			else {
				$query = "SELECT * FROM datawarga LIMIT $posisi, $batas";
				$queryJml = "SELECT * FROM datawarga";
				$no = $posisi * 1;
			}			
		}
		else {
			$query = "SELECT * FROM datawarga LIMIT $posisi, $batas";
			$queryJml = "SELECT * FROM datawarga";
			$no = $posisi * 1;
		}
		?>
		
		<?php
	if(isset($_POST['pencarian'])){
		if($_POST['pencarian']!=''){
			echo "<div style=\"float:left;\">";
			$jml = mysqli_num_rows(mysqli_query($db, $queryJml));
			echo "Data Hasil Pencarian: <b>$jml</b>";
			echo "</div>";
		}
	}
	else{ ?>
		<div style="float:left;">		
		<?php
			$jml = mysqli_num_rows(mysqli_query($db, $queryJml));
			echo "Jumlah Data : <b>$jml</b>";
		?>			

	<?php
	}
	?>
		<?php
		//$sql="SELECT * FROM dtwarga ORDER BY idwarga DESC";
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
			<td><img src="images/<?php echo $foto; ?>" width=70px height=70px></td>
			<td><?php echo $r_tampil_warga['jeniskelamin']; ?></td>
			<td><?php echo $r_tampil_warga['alamat']; ?></td>
			<td><?php echo $r_tampil_warga['agama']; ?></td>
			<td><?php echo $r_tampil_warga['statu']; ?></td>
			<td><?php echo $r_tampil_warga['kerja']; ?></td>
			<td><?php echo $r_tampil_warga['warganegara']; ?></td>
			<td>
				<div class="tombol-opsi-container"><a target="_blank" href="pages/cetak-kartu.php?id=<?php echo $r_tampil_warga['idwarga'];?>" class="tombol">Cetak Kartu</a></div>
				<div class="tombol-opsi-container"><a href="index.php?p=warga-edit&id=<?php echo $r_tampil_warga['idwarga'];?>" class="tombol">Edit</a></div>
				<div class="tombol-opsi-container"><a href="proses/warga-hapus.php?id=<?php echo $r_tampil_warga['idwarga']; ?>" onclick = "return confirm ('Apakah Anda Yakin Akan Menghapus Data Ini?')" class="tombol">Hapus</a></div>
			</td>			
		</tr>		
		<?php $nomor++; } 
		}
		else {
			echo "<tr><td colspan=6>Data Tidak Ditemukan</td></tr>";
		}?>	
	</table>
	<div class="pagination" style="margin-bottom:40px;">		
				<?php
				$jml_hal = ceil($jml/$batas);
				for($i=1; $i<=$jml_hal; $i++){
					if($i != $hal){
						echo "<a href=\"?p=warga&hal=$i\">$i</a>";
					}
					else {
						echo "<a class=\"active\">$i</a>";
					}
				}
				?>
		</div>
</div>
</div>