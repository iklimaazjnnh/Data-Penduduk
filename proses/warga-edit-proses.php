<?php
include'../koneksi.php';

$id_warga=$_POST['id_warga'];
$nama=$_POST['nama'];
$tanggal=$_POST['tanggal'];
$jeniskelamin=$_POST['jeniskelamin'];
$alamat=$_POST['alamat'];
$agama=$_POST['agama'];
$status=$_POST['statu'];
$kerja=$_POST['kerja'];
$warganegara=$_POST['warganegara'];

If(isset($_POST['simpan'])){
	
		extract($_POST);
		$nama_file   = $_FILES['foto']['name'];
		if(!empty($nama_file)){
		// Baca lokasi file sementar dan nama file dari form (fupload)
		$lokasi_file = $_FILES['foto']['tmp_name'];
		$tipe_file = pathinfo($nama_file, PATHINFO_EXTENSION);
		$file_foto = $id_warga.".".$tipe_file;
		// Tentukan folder untuk menyimpan file
		$folder = "../images/$file_foto";
		@unlink ("$folder");
		// Apabila file berhasil di upload
		move_uploaded_file($lokasi_file,"$folder");
		}
		else
			$file_foto=$foto_awal;
	
	mysqli_query($db,
		"UPDATE datawarga
		SET nama='$nama',jeniskelamin='$jeniskelamin',alamat='$alamat',agama='$agama',statu='$status',kerja='$kerja',warganegara='$warganegara',foto='$file_foto'
		WHERE idwarga='$id_warga'"
	);
	header("location:../index.php?p=warga");
}
?>