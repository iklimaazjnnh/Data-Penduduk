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

	
if(isset($_POST['simpan'])){
		extract($_POST);
		$nama_file   = $_FILES['foto']['name'];
		if(!empty($nama_file)){
		// Baca lokasi file sementar dan nama file dari form (fupload)
		$lokasi_file = $_FILES['foto']['tmp_name'];
		$tipe_file = pathinfo($nama_file, PATHINFO_EXTENSION);
		$file_foto = $id_warga.".".$tipe_file;

		// Tentukan folder untuk menyimpan file
		$folder = "../images/$file_foto";
		// Apabila file berhasil di upload
		move_uploaded_file($lokasi_file,"$folder");
		}
		else
			$file_foto="-";
	
	$sql = 
	"INSERT INTO datawarga
		VALUES('$id_warga','$nama','$tanggal','$jeniskelamin','$alamat','$agama','$status','$kerja','$warganegara','$file_foto')";
	$query = mysqli_query($db, $sql);

	header("location:../index.php?p=warga");
}
?>