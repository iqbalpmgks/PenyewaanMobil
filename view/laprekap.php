<?php
include '../koneksi.php';

if (isset($_POST['submit'])) {
  $tahun   = $_POST['tahun'];

  $simpan = mysql_query("SELECT c.merk,
                         COUNT(b.id_mobil) AS total
                         FROM spsk a JOIN detail_mobil b ON a.no_spsk = b.no_spsk JOIN mobil c ON b.id_mobil = c.id_mobil
                         WHERE YEAR(a.tgl_spsk) = '$tahun'
                         GROUP BY c.merk");
  if ($simpan) {
    echo "<script>alert('Laporan Rekap Siap di Cetak!');window.location='cetaklaprekap.php?tahun=$tahun';</script>";
  } else {
    echo "<script>alert('Laporan Rekap Gagal di Cetak!');window.location='laprekap.php';</script>";
  }
}
?>

<div id="page-wrapper">
  <div class='row'>
    <div class='col-lg-12'>
      <h3 class="page-header"><span class="glyphicon glyphicon-file"></span> Cetak Laporan Rekapitulasi Mobil</h3>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-12">
      <form action="laprekap.php" method="POST" enctype="multipart/form-data" class="form-horizontal">
        <div class="form-group row">
          <label class="col-md-2 form-control-label" for="text-input">Tahun</label>
          <div class="col-md-3">
            <select id="tahun" name="tahun" class="form-control">
              <script>
              //menampilkan tahun
              var date  = new Date();
              var tahun = date.getFullYear();
              for (var i = 2012; i < tahun+1; i++) {
                document.write('<option value="'+i+'">'+i+'</option>');
              }
              </script>
            </select>
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
