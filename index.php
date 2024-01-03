<?php
include'koneksi.php';
$tgl=date('Y-m-d');
session_start();
if(isset($_SESSION['sesi'])){
?>
<!doctype html>
<html>
<head>
	<title>Sistem Informasi Data Warga</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body >
	<div id="container">
		<div id="header">
			<div id="lambang-depok-container">
				<image id="lambang-depok" src="images/Lambang_Kota_Depok.png" border=0 style="border:0; text-decoration:none; outline:none"> 
			</div>
			<div id="nama-alamat-kelurahan-container">
				<div class="nama-alamat-kelurahan">
					<h1> PROVINSI JAWA BARAT </h1>
				</div>
				<div class="nama-alamat-kelurahan">
					<h4>KOTA DEPOK</h4>
				</div>
			</div>
		</div>
		<div id="header2">
			<div id="nama-user">Hai <?php echo $_SESSION['sesi']; ?>!</div>
		</div>
		<div id="sidebar">
			<a href="index.php?p=beranda">Beranda</a>
			<p class="label-navigasi">Data Warga</p>
			<ul>
				<li><a href="index.php?p=form-input">Form Data Warga</a></li>
				<li><a href="index.php?p=warga">Data warga</a></li>
			</ul>
			<p class="label-navigasi"></p>
			<a href="logout.php">Logout</a>
		</div>
		<div id="content-container">
			    <div class="container">
		<div class="row"><br/><br/><br/>
			<div class="col-md-10 col-md-offset-1" style="background-image:url('../asanoer-background.jpg')">
				<div class="col-md-4 col-md-offset-4">
					<div class="panel panel-warning login-panel" style="background-color:rgba(255, 255, 255, 0.6);position:relative;">
						
						<div class="panel-footer">
							
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>
		<?php
			$pages_dir='pages';
			if(!empty($_GET['p'])){
				$pages=scandir($pages_dir,0);
				unset($pages[0],$pages[1]);
				$p=$_GET['p'];
				if(in_array($p.'.php',$pages)){
					include($pages_dir.'/'.$p.'.php');
				}else{
					echo'Halaman Tidak Ditemukan';
				}
			}else{
				include($pages_dir.'/beranda.php');
			}
		?>
		</div>
		<div id="footer"><h3>Pemerintah Kota Depok </h3></div>
	</div>
</body>
</html>
<?php
}
else {
	echo "<script>
		alert('Anda Harus Login Dahulu!');
	</script>";
	header('location:login.php');
}
?>