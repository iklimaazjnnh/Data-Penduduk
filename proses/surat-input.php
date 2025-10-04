<?php
include '../koneksi.php';

$idwarga = $_POST['idwarga'];
$jenis_surat = $_POST['jenis_surat'];
$keperluan = $_POST['keperluan'];

$sql = "INSERT INTO surat (idwarga, jenis_surat, keperluan) 
        VALUES ('$idwarga', '$jenis_surat', '$keperluan')";
$query = mysqli_query($db, $sql);

if($query){
  echo "<script>alert('Surat berhasil dibuat');window.location='../index.php?p=surat';</script>";
}else{
  echo "<script>alert('Gagal membuat surat');window.history.back();</script>";
}
?>
