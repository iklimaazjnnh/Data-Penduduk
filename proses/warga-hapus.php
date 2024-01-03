<?php
include'../koneksi.php';
$id_warga=$_GET['id'];

mysqli_query($db,
	"DELETE FROM datawarga
	WHERE idwarga='$id_warga'"
);

header("location:../index.php?p=warga");
?>