<?php
include '../koneksi.php';

?>
<div id="page-wrapper">
  <div class='row'>
    <div class='col-lg-12'>
      <h3 class="page-header">
        <a class="btn btn-defaul" href="kwitansi.php">Kembali</a>
        <a class="btn btn-default no-print" href="javascript:printDiv('area-1');">Print</a>
      </h3>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-12">
      <div id="area-1">
        <div>
          <div align="left">
            <img src="../img/cop.jpg" width="400px" alt="Logo Artha Laras"/><br>
            <!-- Jl. Dr. Ciptomangunkusumo, No. 11, Ciledug - Tangerang 15153,<br>
            Telp: 021-7319980 / 0812-1341-1361 <br><br> -->
          </div>
          <div align="right">
            <b><u>KWITANSI</u></b>
          </div>
        </div>
<?php
$no_kwitansi	= $_GET['no_kwitansi'];
$get = mysql_query("SELECT * FROM kwitansi a JOIN spsk b ON a.no_spsk = b.no_spsk JOIN penyewa c ON b.id_penyewa = c.id_penyewa JOIN detail_mobil d ON b.no_spsk = d.no_spsk JOIN mobil e ON d.id_mobil = e.id_mobil WHERE a.no_kwitansi='$no_kwitansi'");
while ($tampil=mysql_fetch_array($get)) {
?>
<div>
<table border="0" width="100%">
  <tr>
    <td><b>No. Kwitansi</b> </td>
    <td>:</td>
    <td><?php echo $tampil['no_kwitansi']; ?></td>
    <td><b>Telah terima dari</b> </td>
    <td>:</td>
    <td><?php echo $tampil['nama_penyewa']; ?></td>
  </tr>
  <tr>
    <td><b>Tanggal</b> </td>
    <td>:</td>
    <?php
      $tgl_kwitansi = Date_create($tampil['tgl_kwitansi']);
      $tglkwt       = Date_format($tgl_kwitansi, 'd/m/Y');
    ?>
    <td><?php echo $tglkwt; ?></td>
    <td><b>Sejumlah Uang</b> </td>
    <td>:</td>
    <td>Rp. <?php echo $tampil['subtotal']; ?></td>
  </tr>
  <tr>
    <td><b>Lama Sewa</b> </td>
    <td>:</td>
    <td><?php echo $tampil['lama_sewa']; ?> hari</td>
  </tr>
  <tr>
    <td><b>Pembayaran</b></td>
    <td>:</td>
    <td>Bank BCA 54907111696 a/n Dwi Patdianto</td>
  </tr>
</div>

<table width="100%" border="1" cellspacing="0">
  <tr>
    <td align="center"><b>No.</b></td>
    <td align="center"><b>Merk Mobil</b></td>
    <td align="center"><b>Harga Sewa</b></td>
    <td align="center"><b>Jasa Supir</b></td>
    <td align="center"><b>Total Harga</b></td>
  </tr>
  <tr>
    <?php
    $no = 1;
    $get = mysql_query("SELECT * FROM kwitansi a JOIN spsk b ON a.no_spsk = b.no_spsk JOIN penyewa c ON b.id_penyewa = c.id_penyewa JOIN detail_mobil d ON b.no_spsk = d.no_spsk JOIN mobil e ON d.id_mobil = e.id_mobil WHERE a.no_kwitansi='$no_kwitansi'");
    while ($tampil=mysql_fetch_array($get)) {
    ?>
    <td align="center"><?php echo $no++; ?>.</td>
    <td align="center"><?php echo $tampil['merk']; ?></td>
    <td align="center">Rp. <?php echo $tampil['harga']; ?></td>
    <?php
      $q = mysql_query("SELECT tarif FROM supir");
      $data = mysql_fetch_array($q);
      if($tampil['jasa_supir'] == "Ya"){
        $x = $data['tarif'];
      }else{
        $x = 0;
      }
    ?>
    <td align="center">Rp. <?php echo $x; ?></td>
    <td align="center">Rp. <?php echo $tampil['harga'] + $x; ?></td>
  </tr>
  <?php } ?>

  <?php
  $tampil = mysql_fetch_array(mysql_query("SELECT * FROM kwitansi a JOIN spsk b ON a.no_spsk = b.no_spsk JOIN penyewa c ON b.id_penyewa = c.id_penyewa JOIN detail_mobil d ON b.no_spsk = d.no_spsk JOIN mobil e ON d.id_mobil = e.id_mobil WHERE no_kwitansi='$no_kwitansi'"));
  ?>
  <tr>
    <td colspan="3" rowspan="3"></td>
    <td><b>S U B T O T A L</b></td>
    <td align="center"><b>Rp. <?php echo $tampil['subtotal']; ?></b></td>
  </tr>
</table>
<br>

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
    <td align="center">( <?php echo $tampil['nama_penyewa']; ?> )</td>
    <td align="center"></td>
    <td align="center">( <?php echo $_SESSION['login_user']; ?> )</td>
  </tr>
</table>
</div>

      </div>
    </div>
  </div>
  <!-- /#page-wrapper -->

<?php } ?>

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
