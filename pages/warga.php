<div id="label-page"><h3>Tampil Data Penduduk</h3></div>
<div id="content">

	<!-- Tombol Cetak -->
	<a target="_blank" href="pages/cetak.php">
		<img src="print.png" height="50px" width="50px">
	</a>

	<!-- Form Pencarian -->
	<form class="form-inline" method="POST" style="text-align:right; margin:10px 0;">
		<input type="text" name="pencarian" placeholder="Cari data warga..." value="<?php echo isset($_POST['pencarian']) ? $_POST['pencarian'] : ''; ?>" style="padding:5px; border-radius:5px; border:1px solid #ccc;">
		<input type="submit" name="search" value="Search" class="tombol">
	</form>

	<table id="tabel-tampil">
		<tr>
			<th id="label-tampil-no">No</th>
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
		$hal = isset($_GET['hal']) ? $_GET['hal'] : 1;
		$posisi = ($hal - 1) * $batas;
		$nomor = $posisi + 1;

		// Cek apakah ada pencarian
		if ($_SERVER['REQUEST_METHOD'] == "POST") {
			$pencarian = trim(mysqli_real_escape_string($db, $_POST['pencarian']));
			if ($pencarian != "") {
				$sql = "SELECT * FROM datawarga 
						WHERE idwarga LIKE '%$pencarian%' 
						OR nama LIKE '%$pencarian%' 
						OR jeniskelamin LIKE '%$pencarian%' 
						OR alamat LIKE '%$pencarian%' 
						OR agama LIKE '%$pencarian%' 
						OR statu LIKE '%$pencarian%' 
						OR kerja LIKE '%$pencarian%' 
						OR warganegara LIKE '%$pencarian%'";
			} else {
				$sql = "SELECT * FROM datawarga LIMIT $posisi, $batas";
			}
		} else {
			$sql = "SELECT * FROM datawarga LIMIT $posisi, $batas";
		}

		$query = mysqli_query($db, $sql);

		if (!$query) {
			echo "<tr><td colspan='12'>Terjadi kesalahan pada query: " . mysqli_error($db) . "</td></tr>";
			exit;
		}

		// Tampilkan jumlah data
		$totalQuery = mysqli_query($db, "SELECT * FROM datawarga");
		$jml = mysqli_num_rows($totalQuery);

		echo "<div style='float:left; margin-bottom:10px;'>";
		if (!empty($pencarian)) {
			echo "Data hasil pencarian: <b>" . mysqli_num_rows($query) . "</b>";
		} else {
			echo "Jumlah data: <b>$jml</b>";
		}
		echo "</div>";

		if (mysqli_num_rows($query) > 0) {
			while ($r_tampil_warga = mysqli_fetch_array($query)) {
				$foto = (!empty($r_tampil_warga['foto']) && $r_tampil_warga['foto'] != '-') ? $r_tampil_warga['foto'] : "admin-no-photo.jpg";
		?>
				<tr>
					<td><?php echo $nomor; ?></td>
					<td><?php echo $r_tampil_warga['idwarga']; ?></td>
					<td><?php echo $r_tampil_warga['nama']; ?></td>
					<td><?php echo $r_tampil_warga['tanggal']; ?></td>
					<td><img src="images/<?php echo $foto; ?>" width="70px" height="70px"></td>
					<td><?php echo $r_tampil_warga['jeniskelamin']; ?></td>
					<td><?php echo $r_tampil_warga['alamat']; ?></td>
					<td><?php echo $r_tampil_warga['agama']; ?></td>
					<td><?php echo $r_tampil_warga['statu']; ?></td>
					<td><?php echo $r_tampil_warga['kerja']; ?></td>
					<td><?php echo $r_tampil_warga['warganegara']; ?></td>
					<td>
						<div class="tombol-opsi-container">
							<a target="_blank" href="pages/cetak-kartu.php?id=<?php echo $r_tampil_warga['idwarga']; ?>" class="tombol">Cetak Kartu</a>
						</div>
						<div class="tombol-opsi-container">
							<a href="index.php?p=warga-edit&id=<?php echo $r_tampil_warga['idwarga']; ?>" class="tombol">Edit</a>
						</div>
						<div class="tombol-opsi-container">
							<a href="proses/warga-hapus.php?id=<?php echo $r_tampil_warga['idwarga']; ?>" onclick="return confirm('Apakah Anda yakin akan menghapus data ini?')" class="tombol">Hapus</a>
						</div>
					</td>
				</tr>
		<?php
				$nomor++;
			}
		} else {
			echo "<tr><td colspan='12' style='text-align:center;'>Data tidak ditemukan</td></tr>";
		}
		?>
	</table>

	<!-- PAGINATION -->
	<div class="pagination" style="margin-bottom:40px; text-align:center;">
		<?php
		$jml_hal = ceil($jml / $batas);
		for ($i = 1; $i <= $jml_hal; $i++) {
			if ($i != $hal) {
				echo "<a href='?p=warga&hal=$i'>$i</a>";
			} else {
				echo "<a class='active'>$i</a>";
			}
		}
		?>
	</div>
</div>
</div>
