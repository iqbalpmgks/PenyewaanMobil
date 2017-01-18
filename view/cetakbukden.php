<?php
include '../koneksi.php';

?>
<div id="page-wrapper">
  <div class='row'>
    <div class='col-lg-12'>
      <h3 class="page-header">
        <a class="btn btn-defaul" href="bukden.php">Kembali</a>
        <a class="btn btn-default no-print" href="javascript:printDiv('area-1');">Print</a>
      </h3>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-12">
      <div id="area-1">
        <div>
          <div align="center">
            <img src="../img/cop.jpg" width="400px" alt="Logo Artha Laras"/>
          <hr>
          </br>
            <!-- Jl. Dr. Ciptomangunkusumo, No. 11, Ciledug - Tangerang 15153,<br>
            Telp: 021-7319980 / 0812-1341-1361 <br><br> -->
          </div>
          <div align="center">
            <b>BUKTI DENDA</b>
          </div>
        </div>
      </br>
    </br>

  <?php
    $no_bukden = $_GET['no_bukden'];
    $get       = mysql_fetch_array(mysql_query("SELECT a.no_bukden, a.tgl_bukden, b.no_pengembalian, b.tgl_pengembalian, b.jam_masuk, d.no_spsk, d.lama_sewa, d.tgl_mulai, d.jam_keluar, e.nama_penyewa, e.alamat_penyewa FROM bukti_denda a JOIN pengembalian b ON a.no_pengembalian = b.no_pengembalian JOIN stk c ON b.no_stk = c.no_stk JOIN spsk d ON c.no_spsk = d.no_spsk JOIN penyewa e ON d.id_penyewa = e.id_penyewa WHERE a.no_bukden = '$no_bukden'"));
  ?>
  <table border="0" width="100%" cellspacing="0">
    <tr>
      <td><b>No. Bukti Denda</b> </td>
      <td>:</td>
      <td><?php echo $get['no_bukden']; ?></td>
      <td><b>Berdasarkan.</b> </td>
      <td></td>
      <td></td>
    </tr>
    <tr>
      <td><b>Tanggal</b> </td>
      <td>:</td>
      <td><?php echo $get['tgl_bukden']; ?></td>
      <td><b>No. SPSK</b></td>
      <td>:</td>
      <td><?php echo $get['no_spsk']; ?></td>
    </tr>
    <tr>
      <td colspan="3"></td>
      <td><b>Lama Sewa</b></td>
      <td>:</td>
      <td><?php echo $get['lama_sewa']; ?> hari</td>
    </tr>
    <tr>
      <td><b>Kepada.</b></td>
      <td></td>
      <td></td>
      <td><b>Tanggal Keluar</b></td>
      <td>:</td>
      <td><?php echo $get['tgl_mulai']; ?></td>
    </tr>
    <tr>
      <td><b>Nama Penyewa</b></td>
      <td>:</td>
      <td><?php echo $get['nama_penyewa']; ?></td>
      <td><b>Jam Keluar</b></td>
      <td>:</td>
      <td><?php echo $get['jam_keluar']; ?></td>
    </tr>
    <tr>
      <td><b>Alamat</b></td>
      <td>:</td>
      <td><?php echo $get['alamat_penyewa']; ?></td>
      <td><b></b></td>
      <td></td>
      <td></td>
    </tr>
    <tr>
      <td><b></b></td>
      <td></td>
      <td></td>
      <td><b>No. Pengembalian</b></td>
      <td>:</td>
      <td><?php echo $get['no_pengembalian']; ?></td>
    </tr>
    <?php
      $tgl_masuk  = date_create($get['jam_masuk']);
      $tglmasuk   = date_format($tgl_masuk, "d-m-Y");
      $jammasuk   = date_format($tgl_masuk, "H:i");
    ?>
    <tr>
      <td><b></b></td>
      <td></td>
      <td></td>
      <td><b>Tanggal Masuk</b></td>
      <td>:</td>
      <td><?php echo $tglmasuk; ?></td>
    </tr>
    <tr>
      <td><b></b></td>
      <td></td>
      <td></td>
      <td><b>Jam Masuk</b></td>
      <td>:</td>
      <td><?php echo $jammasuk; ?></td>
    </tr>
  </table>

<hr>
<?php
  $no_bukden = $_GET['no_bukden'];
  $tampil    = mysql_fetch_array(mysql_query("SELECT c.nama_jnsdenda, b.telat, c.nominal, a.jml_denda FROM bukti_denda a JOIN pengembalian b ON a.no_pengembalian = b.no_pengembalian JOIN jenis_denda c ON a.id_jnsdenda = c.id_jnsdenda WHERE a.no_bukden = '$no_bukden'"));
?>
  <table width="300px" border="0">
    <tr>
      <td><b>Keterangan Denda</b></td>
      <td>:</td>
      <td><?php echo $tampil['nama_jnsdenda']; ?></td>
    </tr>
    <tr>
      <td><b>Lama Denda</b></td>
      <td>:</td>
      <td><?php echo $tampil['telat']; ?> Jam</td>
    </tr>
    <tr>
      <td><b>Harga Denda</b></td>
      <td>:</td>
      <td>Rp. <?php echo $tampil['nominal']; ?> /Jam</td>
    </tr>
    <tr>
      <td></br></td>
      <td></td>
      <td></td>
    </tr>
    <tr>
      <td><b>Total Harga</b></td>
      <td>:</td>
      <td>Rp. <?php echo $tampil['jml_denda']; ?></td>
    </tr>

  </table>
<hr>
<table width="100%" border="0" height="150px">
  <tr>
    <td align="center" width="250px"><b>Penyewa</b></td>
    <th></th>
    <td align="center" width="250px"><b>Staff Admin</b></td>
  </tr>
  <tr>
    <td align="center"></td>
    <td align="center"><b><i>Terima Kasih,</b><br>Sudah Memakai Jasa Kami.</i></td>
    <td align="center"></td>
  </tr>
  <tr>
    <td align="center">( <?php echo $get['nama_penyewa']; ?> )</td>
    <td align="center"></td>
    <td align="center">( <?php echo $_SESSION['login_user']; ?> )</td>
  </tr>
</table>
</div>
        </div>
      </div>
    </div>
  </div>
  <!-- /#page-wrapper -->

<textarea id="printing-css" style="display:none;">.no-print{display:none}</textarea>
<iframe id="printing-frame" name="print_frame" src="about:blank" style="display:none;"></iframe>
<script type="text/javascript">
//<![CDATA[
function printDiv(elementId) {
    var a = document.getElementById('printing-css').value;
    var b = document.getElementById(elementId).innerHTML;
    window.frames["print_frame"].document.title = document.title;
    window.frames["print_frame"].document.body.innerHTML = '<style>' + a + '</style>' + b;
    window.frames["print_frame"].window.focus();
    window.frames["print_frame"].window.print();
}
//]]>
</script>
