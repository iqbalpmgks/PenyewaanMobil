<?php
include '../koneksi.php';

?>
<div id="page-wrapper">
  <div class='row'>
    <div class='col-lg-12'>
      <h3 class="page-header">
        <a class="btn btn-defaul" href="lapsewa.php">Kembali</a>
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
            <b><u>LAPORAN PENYEWAAN</u></b>
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
    <td align="center"><b>No. SPSK</b></td>
    <td align="center"><b>Tanggal SPSK</b></td>
    <td align="center"><b>Nama Penyewa</b></td>
    <td align="center"><b>No. KTP/SIM</b></td>
    <td align="center"><b>Alamat</b></td>
    <td align="center"><b>Merk Mobil</b></td>
    <td align="center"><b>No. Polisi</b></td>
    <td align="center"><b>Lama Sewa</b></td>
    <td align="center"><b>Tanggal Keluar</b></td>
    <td align="center"><b>Pembayaran</b></td>
    <<td align="center"><b>Jenis Kelamin</b></td>
  </tr>
  <tr>
    <?php
    $no = 1;
    $i=1;
    $get = mysql_query("SELECT * FROM spsk a JOIN penyewa b ON a.id_penyewa = b.id_penyewa JOIN detail_mobil c ON a.no_spsk = c.no_spsk JOIN mobil d ON c.id_mobil = d.id_mobil WHERE tgl_spsk >= '$date1' AND tgl_spsk <= '$date2'");
    while ($tampil=mysql_fetch_array($get)) {
      $spsk[$i] = $tampil['no_spsk'];
    ?>
    <td align="center">
      <?php
      if($spsk[$i] == $spsk[$i-1]){
        echo " ";
      }else{
        echo $no++;
      }
      ?></td>
    <td align="center">
      <?php
        if($spsk[$i] == $spsk[$i-1]){
          echo " ";
        }else{
          echo $tampil['no_spsk'];
        }
      ?></td>
    <?php
    $tgl_spsk = Date_create($tampil['tgl_spsk']);
    $date     = Date_format($tgl_spsk, "d-m-Y");
    ?>
    <td align="center">
      <?php
        if($spsk[$i] == $spsk[$i-1]){
          echo " ";
        }else{
          echo $date;
        }
      ?>
    </td>
    <td>
      <?php
        if($spsk[$i] == $spsk[$i-1]){
          echo " ";
        }else{
          echo $tampil['nama_penyewa'];
        }
      ?>
    </td>
    <td>
      <?php
        if($spsk[$i] == $spsk[$i-1]){
          echo " ";
        }else{
          echo $tampil['no_ktpsim'];
        }
      ?>
    </td>
    <td>
      <?php
        if($spsk[$i] == $spsk[$i-1]){
          echo " ";
        }else{
          echo $tampil['alamat_penyewa'];
        }
      ?>
    </td>
    <td><?php echo $tampil['merk']; ?></td>
    <td><?php echo $tampil['no_pol']; ?></td>
    <td align="center">
      <?php
        if($spsk[$i] == $spsk[$i-1]){
          echo " ";
        }else{
          echo $tampil['lama_sewa']." Hari";
        }
      ?>
    </td>
    <td>
      <?php
        if($spsk[$i] == $spsk[$i-1]){
          echo " ";
        }else{
          echo $tampil['tgl_mulai'];
        }
      ?>
    </td>
    <td>
      <?php
        if($spsk[$i] == $spsk[$i-1]){
          echo " ";
        }else{
          echo $tampil['jns_bayar'];
        }
      ?>
    </td>
    <td>
      <?php
        if($spsk[$i] == $spsk[$i-1]){
          echo " ";
        }else{
          echo $tampil['jenkel'];
        }
      ?>
    </td>
  </tr>
  <?php $i++; } ?>
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
