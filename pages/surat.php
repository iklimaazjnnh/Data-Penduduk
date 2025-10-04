<div id="label-page"><h3>Data Surat</h3></div>
<div id="content">

  <!-- 🔍 Form Search -->
  <form class="form-inline" method="POST" style="text-align:right; margin-bottom:10px;">
    <input type="text" name="pencarian" placeholder="Cari surat..." class="tombol" style="padding:6px;">
    <input type="submit" name="search" value="Search" class="tombol">
  </form>

  <table id="tabel-tampil">
    <tr>
      <th>No</th>
      <th>Nama Warga</th>
      <th>Jenis Surat</th>
      <th>Keperluan</th>
      <th>Tanggal</th>
      <th>Status</th>
      <th id="label-opsi">Opsi</th>
    </tr>

    <?php
    include 'koneksi.php';
    $no = 1;

    // batas pagination
    $batas = 5;
    $hal = isset($_GET['hal']) ? $_GET['hal'] : 1;
    $posisi = ($hal - 1) * $batas;

    // jika tombol search ditekan
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
      $pencarian = trim(mysqli_real_escape_string($db, $_POST['pencarian']));
      if ($pencarian != "") {
        $query = "SELECT s.*, w.nama 
                  FROM surat s 
                  JOIN datawarga w ON s.idwarga = w.idwarga
                  WHERE w.nama LIKE '%$pencarian%' 
                     OR s.jenis_surat LIKE '%$pencarian%' 
                     OR s.keperluan LIKE '%$pencarian%' 
                  ORDER BY s.id_surat DESC";
        $queryJml = $query;
      } else {
        $query = "SELECT s.*, w.nama FROM surat s 
                  JOIN datawarga w ON s.idwarga = w.idwarga 
                  ORDER BY s.id_surat DESC LIMIT $posisi, $batas";
        $queryJml = "SELECT * FROM surat";
      }
    } else {
      $query = "SELECT s.*, w.nama FROM surat s 
                JOIN datawarga w ON s.idwarga = w.idwarga 
                ORDER BY s.id_surat DESC LIMIT $posisi, $batas";
      $queryJml = "SELECT * FROM surat";
    }

    // hitung jumlah data
    $jml = mysqli_num_rows(mysqli_query($db, $queryJml));
    echo "<div style='float:left;'>Jumlah Data : <b>$jml</b></div>";

    // tampilkan hasil
    $q = mysqli_query($db, $query);
    if (mysqli_num_rows($q) > 0) {
      while ($r = mysqli_fetch_array($q)) {
    ?>
    <tr>
      <td><?= $no++; ?></td>
      <td><?= $r['nama']; ?></td>
      <td><?= $r['jenis_surat']; ?></td>
      <td><?= $r['keperluan']; ?></td>
      <td><?= $r['tanggal']; ?></td>
      <td><?= $r['status']; ?></td>
      <td>
        <div class="tombol-opsi-container">
          <a href="pages/cetak-surat.php?id=<?= $r['id_surat']; ?>" target="_blank" class="tombol">Cetak</a>
        </div>
        <div class="tombol-opsi-container">
          <a href="index.php?p=surat-edit&id=<?= $r['id_surat']; ?>" class="tombol">Edit</a>
        </div>
        <div class="tombol-opsi-container">
          <a href="proses/surat-hapus.php?id=<?= $r['id_surat']; ?>" 
             onclick="return confirm('Apakah Anda yakin ingin menghapus surat ini?')" 
             class="tombol">Hapus</a>
        </div>
      </td>
    </tr>
    <?php
      }
    } else {
      echo "<tr><td colspan='7'>Data Tidak Ditemukan</td></tr>";
    }
    ?>
  </table>

  <!-- Pagination -->
  <div class="pagination" style="margin-top:20px; margin-bottom:40px;">
    <?php
    $jml_hal = ceil($jml / $batas);
    for ($i = 1; $i <= $jml_hal; $i++) {
      if ($i != $hal) {
        echo "<a href=\"?p=surat&hal=$i\">$i</a>";
      } else {
        echo "<a class=\"active\">$i</a>";
      }
    }
    ?>
  </div>
</div>
