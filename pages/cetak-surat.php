<?php
include '../koneksi.php'; // pastikan path ke koneksi benar

$id = $_GET['id'];

// Ambil data surat + data warga (datawarga)
$sql = "
    SELECT s.*, w.nama, w.alamat
    FROM surat AS s
    JOIN datawarga AS w ON s.idwarga = w.idwarga
    WHERE s.id_surat = '$id'
";

$query = mysqli_query($db, $sql);

// Cek apakah query berhasil
if (!$query) {
    die('❌ Query gagal: ' . mysqli_error($db));
}

$data = mysqli_fetch_assoc($query);

// Jika data tidak ditemukan
if (!$data) {
    die('❌ Data tidak ditemukan untuk ID surat: ' . htmlspecialchars($id));
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cetak Surat</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 40px;
        }
        h2, h3, h4 {
            text-align: center;
            margin: 0;
        }
        p {
            text-align: justify;
        }
        .tanda-tangan {
            text-align: right;
            margin-top: 40px;
        }
    </style>
</head>
<body>
    <h2>PEMERINTAH KOTA DEPOK</h2>
    <h3>RUKUN TETANGGA 002/03</h3>
    <h4>Kelurahan Jatijajar, Kecamatan Tapos, Kota Depok</h4>
    <br>

    <h3>Surat <?= htmlspecialchars($data['jenis_surat']); ?></h3>

    <p>Yang bertanda tangan di bawah ini menerangkan bahwa:</p>

    <table>
        <tr>
            <td width="120">Nama</td>
            <td width="10">:</td>
            <td><?= htmlspecialchars($data['nama']); ?></td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>:</td>
            <td><?= htmlspecialchars($data['alamat']); ?></td>
        </tr>
        <tr>
            <td>Keperluan</td>
            <td>:</td>
            <td><?= htmlspecialchars($data['keperluan']); ?></td>
        </tr>
    </table>

    <br>

    <?php if ($data['jenis_surat'] == 'Surat Belum Menikah') { ?>
        <p>
            Berdasarkan keterangan dari yang bersangkutan, benar bahwa hingga saat ini 
            <b>yang bersangkutan belum pernah menikah</b>.
            Surat ini dibuat untuk keperluan <?= strtolower(htmlspecialchars($data['keperluan'])); ?>.
        </p>
    <?php } elseif ($data['jenis_surat'] == 'Surat Domisili') { ?>
        <p>
            Adalah benar warga yang berdomisili di alamat tersebut di atas.
            Surat keterangan domisili ini dibuat untuk keperluan <?= strtolower(htmlspecialchars($data['keperluan'])); ?>.
        </p>
    <?php } elseif ($data['jenis_surat'] == 'Surat Usaha') { ?>
        <p>
            Benar bahwa yang bersangkutan memiliki/mengelola usaha di wilayah kami.
            Surat keterangan usaha ini dibuat untuk keperluan <?= strtolower(htmlspecialchars($data['keperluan'])); ?>.
        </p>
    <?php } else { ?>
        <p>
            Demikian surat ini dibuat untuk dipergunakan sebagaimana mestinya.
        </p>
    <?php } ?>

    <div class="tanda-tangan">
        <p>Depok, <?= date('d-m-Y', strtotime($data['tanggal'])); ?></p>
         <p>Ketua RT 02/RW 03</p>
        <br><br><br>
        <p>(..................................)</p>
    </div>

    <a href="cetak-surat-pdf.php?id=<?= $data['id_surat']; ?>" target="_blank" class="btn btn-primary">
  Cetak PDF
</a>

</body>
</html>
