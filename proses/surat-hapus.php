<?php
include '../koneksi.php';
$id = $_GET['id'];

$sql = "DELETE FROM surat WHERE id_surat='$id'";
$query = mysqli_query($db, $sql);

if($query){
  echo "<script>alert('Data surat berhasil dihapus');window.location='../index.php?p=surat';</script>";
}else{
  echo "<script>alert('Gagal menghapus data surat');window.history.back();</script>";
}
?>
