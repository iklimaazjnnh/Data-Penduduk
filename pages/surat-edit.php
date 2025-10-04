<?php
include 'koneksi.php';
$id = $_GET['id'];
$q = mysqli_query($db, "SELECT * FROM surat WHERE id_surat='$id'");
$r = mysqli_fetch_array($q);
?>

<div id="label-page"><h3>Edit Data Surat</h3></div>
<div id="content">
  <form method="POST" action="proses/surat-edit-proses.php">
    <input type="hidden" name="id_surat" value="<?= $r['id_surat']; ?>">
    <table id="tabel-input">
      <tr>
        <td class="label-formulir">Jenis Surat</td>
        <td class="isian-formulir">
          <input type="text" name="jenis_surat" value="<?= $r['jenis_surat']; ?>" required>
        </td>
      </tr>
      <tr>
        <td class="label-formulir">Keperluan</td>
        <td class="isian-formulir">
          <textarea name="keperluan" rows="3" required><?= $r['keperluan']; ?></textarea>
        </td>
      </tr>
      <tr>
        <td class="label-formulir">Status</td>
        <td class="isian-formulir">
          <select name="status">
            <option value="Menunggu" <?= $r['status']=="Menunggu"?"selected":""; ?>>Menunggu</option>
            <option value="Disetujui" <?= $r['status']=="Disetujui"?"selected":""; ?>>Disetujui</option>
            <option value="Dicetak" <?= $r['status']=="Dicetak"?"selected":""; ?>>Dicetak</option>
          </select>
        </td>
      </tr>
      <tr>
        <td colspan="2"><input type="submit" name="simpan" value="Simpan Perubahan" class="tombol"></td>
      </tr>
    </table>
  </form>
</div>
