<?php
include '../koneksi.php';

if (isset($_POST['submit'])) {
  $tgl_awal   = $_POST['tgl_awal'];
  $tgl_akhir  = $_POST['tgl_akhir'];

  $simpan = mysql_query("SELECT * FROM spsk a JOIN penyewa b ON a.id_penyewa = b.id_penyewa JOIN detail_mobil c ON a.no_spsk = c.no_spsk JOIN mobil d ON c.id_mobil = d.id_mobil WHERE tgl_spsk >= '2016-12-06' AND tgl_spsk <= '2016-12-17'");
  if ($simpan) {
    echo "<script>alert('Laporan Denda Siap di Cetak!');window.location='cetaklapdenda.php?tgl_awal=$tgl_awal&&tgl_akhir=$tgl_akhir';</script>";
  } else {
    echo "<script>alert('Laporan Denda Gagal di Cetak!');window.location='lapdenda.php';</script>";
  }
}
?>

<div id="page-wrapper">
  <div class='row'>
    <div class='col-lg-12'>
      <h3 class="page-header"><span class="glyphicon glyphicon-file"></span> Cetak Laporan Denda</h3>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-12">
      <form action="lapdenda.php" method="POST" enctype="multipart/form-data" class="form-horizontal">
        <div class="form-group row">
          <label class="col-md-2 form-control-label" for="text-input">Tanggal Awal</label>
          <div class="col-md-3">
            <input type="date" id="tgl_awal" name="tgl_awal" class="form-control" required>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-md-2 form-control-label" for="text-input">Tanggal Akhir</label>
          <div class="col-md-3">
            <input type="date" id="tgl_akhir" name="tgl_akhir" class="form-control" required>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-md-2 form-control-label" for="text-input"></label>
          <div class="col-md-5">
            <button type="submit" name="submit" class="btn btn-primary">CETAK</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- /#page-wrapper -->

<!--Code JS Validation-->
<script language='javascript'>
function validAngka(a)
{
  if(!/^[0-9.]+$/.test(a.value))
  {
    a.value = a.value.substring(0,a.value.length-1000);
  }
}
</script>
<!--End of Code JS Validation-->
