<?php
include '../koneksi.php';

?>
<div id="page-wrapper">
  <div class='row'>
    <div class='col-lg-12'>
      <h3 class="page-header">
        <a class="btn btn-defaul" href="lapkembali.php">Kembali</a>
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
            <b><u>LAPORAN PENGEMBALIAN</u></b>
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
    <td align="center"><b>No. PNG</b></td>
    <td align="center"><b>Tgl Kembali</b></td>
    <td align="center"><b>No. STK</b></td>
    <td align="center"><b>No. Polisi</b></td>
    <td align="center"><b>Tgl Keluar</b></td>
    <td align="center"><b>Tgl Masuk</b></td>
    <td align="center"><b>Jam Keluar</b></td>
    <td align="center"><b>Jam Masuk</b></td>
    <td align="center"><b>Lama Telat</b></td>
    <td align="center"><b>Pemeriksa</b></td>
  </tr>
  <tr>
    <?php
    $no = 1;
    $get = mysql_query("SELECT a.no_pengembalian, a.tgl_pengembalian, b.no_stk,  e.no_pol, c.tgl_mulai, c.tgl_selesai, c.jam_keluar, a.jam_masuk, a.telat, a.pemeriksa_masuk
                        FROM pengembalian a JOIN stk b ON a.no_stk = b.no_stk JOIN spsk c ON b.no_spsk = c.no_spsk JOIN detail_mobil d ON c.no_spsk = d.no_spsk JOIN mobil e ON d.id_mobil = e.id_mobil WHERE tgl_pengembalian >= '$date1' AND tgl_pengembalian <= '$date2' AND b.id_mobil = d.id_mobil GROUP BY a.no_stk");
    while ($tampil=mysql_fetch_array($get)) {
    ?>
    <td align="center"><?php echo $no++; ?>.</td>
    <td align="center"><?php echo $tampil['no_pengembalian']; ?></td>
    <?php
      $tgl_pengembalian = Date_create($tampil['tgl_pengembalian']);
      $tgl_mulai        = Date_create($tampil['tgl_mulai']);
      $tgl_selesai      = Date_create($tampil['tgl_selesai']);
      $jam_masuk        = Date_create($tampil['jam_masuk']);
      $jam_keluar       = Date_create($tampil['jam_keluar']);
      $date             = Date_format($tgl_pengembalian, "d-m-Y");
      $d1               = Date_format($tgl_mulai, "d-m-Y");
      $d2               = Date_format($tgl_selesai, "d-m-Y");
      $jamin            = Date_format($jam_masuk, "H:i");
      $jamout           = Date_format($jam_keluar, "H:i");
    ?>
    <td align="center"><?php echo $date; ?></td>
    <td align="center"><?php echo $tampil['no_stk']; ?></td>
    <td align="center"><?php echo $tampil['no_pol']; ?></td>
    <td align="center"><?php echo $d1; ?></td>
    <td align="center"><?php echo $d2; ?></td>
    <td align="center"><?php echo $jamout; ?></td>
    <td align="center"><?php echo $jamin; ?></td>
    <td align="center"><?php echo $tampil['telat']; ?> jam</td>
    <td><?php echo $tampil['pemeriksa_masuk']; ?></td>
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
