<?php
include '../koneksi.php';

?>
<div id="page-wrapper">
  <div class='row'>
    <div class='col-lg-12'>
      <h3 class="page-header">
        <a class="btn btn-defaul" href="lapsupir.php">Kembali</a>
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
            <b><u>LAPORAN SUPIR</u></b>
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
    <td align="center"><b>No. SPK</b></td>
    <td align="center"><b>Tanggal SPK</b></td>
    <td align="center"><b>Nama Supir</b></td>
    <td align="center"><b>Jasa Supir</b></td>
    <td align="center"><b>Lama Kerja</b></td>
    <td align="center"><b>Tanggal Keluar</b></td>
    <td align="center"><b>Tanggal Masuk</b></td>
    <td align="center"><b>No. Polisi</b></td>
    <td align="center"><b>Penyewa</b></td>
    <td align="center"><b>Total Biaya</b></td>
  </tr>
  <tr>
    <?php
    $no = 1;
    $get = mysql_query("SELECT * FROM spk a JOIN supir b ON a.id_supir = b.id_supir JOIN spsk c ON a.no_spsk = c.no_spsk JOIN detail_mobil d ON c.no_spsk = d.no_spsk JOIN mobil e ON d.id_mobil = e.id_mobil JOIN penyewa f ON c.id_penyewa = f.id_penyewa WHERE d.jasa_supir='Ya' AND tgl_spk >= '$date1' AND tgl_spk <= '$date2'");
    while ($tampil=mysql_fetch_array($get)) {
    ?>
    <td align="center"><?php echo $no++; ?></td>
    <td align="center"><?php echo $tampil['no_spk']; ?></td>
    <?php
    $tgl_spk  = Date_create($tampil['tgl_spk']);
    $date     = Date_format($tgl_spk, "d-m-Y");
    ?>
    <td align="center"><?php echo $date; ?></td>
    <td><?php echo $tampil['nama_supir']; ?></td>
    <?php
      $q = mysql_query("SELECT tarif FROM supir");
      $data = mysql_fetch_array($q);
      if($tampil['jasa_supir'] == "Ya"){
        $x = $data['tarif'];
      }else{
        $x = 0;
      }
    ?>
    <td>Rp. <?php echo $x; ?></td>
    <td align="center"><?php echo $tampil['lama_sewa']; ?> hari</td>
    <?php
    $tgl_mulai  = Date_create($tampil['tgl_mulai']);
    $tgl_selesai= Date_create($tampil['tgl_selesai']);
    $d1         = Date_format($tgl_mulai, "d-m-Y");
    $d2         = Date_format($tgl_selesai, "d-m-Y");
    ?>
    <td align="center"><?php echo $d1; ?></td>
    <td align="center"><?php echo $d2; ?></td>
    <td align="center"><?php echo $tampil['no_pol']; ?></td>
    <td><?php echo $tampil['nama_penyewa']; ?></td>
    <td>Rp. <?php echo $tampil['lama_sewa'] * $x; ?></td>
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
