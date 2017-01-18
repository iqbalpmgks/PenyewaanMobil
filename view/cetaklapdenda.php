<?php
include '../koneksi.php';

?>
<div id="page-wrapper">
  <div class='row'>
    <div class='col-lg-12'>
      <h3 class="page-header">
        <a class="btn btn-defaul" href="lapdenda.php">Kembali</a>
        <a class="btn btn-default no-print" href="javascript:printDiv('area-1');">Print</a>
      </h3>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-12">
      <div id="area-1">
        <div>
          <div align="center">
            <img src="../img/cop.jpg" width="400px" alt="Logo Artha Laras"/><br>
            <!-- Jl. Dr. Ciptomangunkusumo, No. 11, Ciledug - Tangerang 15153,<br>
            Telp: 021-7319980 / 0812-1341-1361 <br><br> -->
          </div>
          <hr>
          <div align="center">
            <b><u>LAPORAN DENDA</u></b>
          </div>
        </div>

<div>
  <?php
  $tgl_awal = Date_create($_GET['tgl_awal']);
  $tgl_akhir= Date_create($_GET['tgl_akhir']);
  $tawal    = Date_format($tgl_awal, "d-m-Y");
  $takhir   = Date_format($tgl_akhir, "d-m-Y");
  $date1    = Date_format($tgl_awal, "Y-m-d");
  $date2    = Date_format($tgl_akhir, "Y-m-d");
  ?>
  <br>
    <b>Periode :</b> <?php echo $tawal; ?> <b>S.D.</b> <?php echo $takhir; ?>
  <br>

<table width="100%" border="1" cellspacing="0">
  <tr>
    <td align="center"><b>No.</b></td>
    <td align="center"><b>No. Bukti Denda</b></td>
    <td align="center"><b>Tgl Bukti Denda</b></td>
    <td align="center"><b>No. Kembali</b></td>
    <td align="center"><b>No. Polisi</b></td>
    <td align="center"><b>Nama Penyewa</b></td>
    <td align="center"><b>Jenis Denda</b></td>
    <td align="center"><b>Lama Denda</b></td>
    <td align="center"><b>Total Denda</b></td>
  </tr>
  <tr>
    <?php
    $no = 1;
    $get = mysql_query("SELECT a.no_bukden, a.tgl_bukden, c.no_pengembalian, g.no_pol, h.nama_penyewa, b.nama_jnsdenda, c.telat, a.jml_denda
                        FROM bukti_denda a JOIN jenis_denda b ON a.id_jnsdenda = b.id_jnsdenda
                        JOIN pengembalian c ON a.no_pengembalian = c.no_pengembalian
                        JOIN stk d ON c.no_stk = d.no_stk
                        JOIN spsk e ON d.no_spsk = e.no_spsk
                        JOIN detail_mobil f ON e.no_spsk = f.no_spsk
                        JOIN mobil g ON f.id_mobil = g.id_mobil
                        JOIN penyewa h ON e.id_penyewa = h.id_penyewa
                        WHERE tgl_bukden >= '$date1' AND tgl_bukden <= '$date2' AND d.id_mobil = f.id_mobil
                        GROUP BY a.no_pengembalian");
    while ($tampil=mysql_fetch_array($get)) {
    ?>
    <td align="center"><?php echo $no++; ?></td>
    <td align="center"><?php echo $tampil['no_bukden']; ?></td>
    <?php
    $tgl_bukden = Date_create($tampil['tgl_bukden']);
    $date       = Date_format($tgl_bukden, "d-m-Y");
    ?>
    <td align="center"><?php echo $date; ?></td>
    <td align="center"><?php echo $tampil['no_pengembalian']; ?></td>
    <td align="center"><?php echo $tampil['no_pol']; ?></td>
    <td><?php echo $tampil['nama_penyewa']; ?></td>
    <td><?php echo $tampil['nama_jnsdenda']; ?></td>
    <td align="center"><?php echo $tampil['telat']; ?> jam</td>
    <td>Rp. <?php echo $tampil['jml_denda']; ?></td>
  </tr>
  <?php } ?>
</table>

<div align="right">
  <table width="150px" border="0" height="150px">
    <tr>
      <td align="center"><b>Staff Admin</b></td>
    </tr>
    <tr>
      <td align="center">( <?php echo $_SESSION['login_user']; ?> )</td>
    </tr>
  </table>
</div>
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
