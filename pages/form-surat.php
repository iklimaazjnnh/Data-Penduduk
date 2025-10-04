<div id="label-page"><h3>Form Pembuatan Surat</h3></div>
<div id="content">
  <form method="POST" action="proses/surat-input.php">
    <table id="tabel-input">
      <tr>
        <td class="label-formulir">Pilih Warga</td>
        <td class="isian-formulir">
          <select name="idwarga" required>
            <option value="">-- Pilih Warga --</option>
            <?php
              $q = mysqli_query($db, "SELECT * FROM datawarga ORDER BY nama ASC");
              while($r = mysqli_fetch_array($q)){
                echo "<option value='$r[idwarga]'>$r[nama] - $r[idwarga]</option>";
              }
            ?>
          </select>
        </td>
      </tr>
      <tr>
        <td class="label-formulir">Jenis Surat</td>
        <td class="isian-formulir">
          <select name="jenis_surat" required>
            <option value="">-- Pilih Jenis Surat --</option>
            <option value="Surat Domisili">Surat Domisili</option>
            <option value="Surat Belum Menikah">Surat Belum Menikah</option>
            <option value="Surat Keterangan RT/RW">Surat Pengantar RT/RW</option>
          </select>
        </td>
      </tr>
      <tr>
        <td class="label-formulir">Keperluan</td>
        <td class="isian-formulir"><textarea name="keperluan" rows="3" required></textarea></td>
      </tr>
      <tr>
        <td colspan="2"><input type="submit" name="simpan" value="Simpan" class="tombol"></td>
      </tr>
    </table>
  </form>
</div>
