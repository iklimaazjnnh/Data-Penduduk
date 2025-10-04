<?php
include '../koneksi.php';

$id = $_POST['id_surat'];
$jenis_surat = $_POST['jenis_surat'];
$keperluan = $_POST['keperluan'];
$status = $_POST['status'];

$sql = "UPDATE surat 
        SET jenis_surat='$jenis_surat', keperluan='$keperluan', status='$status'
        WHERE id_surat='$id'";
$query = mysqli_query($db, $sql);

if($query){
  echo "<script>alert('Data surat berhasil diperbarui');window.location='../index.php?p=surat';</script>";
}else{
  echo "<script>alert('Gagal memperbarui data surat');window.history.back();</script>";
}
?>
