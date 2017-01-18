<?php
include '../koneksi.php';
?>
<!-- Chart Style -->
<script type="text/javascript" src="../dist/js/loader.js"></script>
<!-- End Chart Style -->
<div id="page-wrapper">
  <div class='row'>
    <div class='col-lg-12'>
      <h3 class="page-header">
        <a class="btn btn-defaul" href="laprekap.php">Kembali</a>
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
            <b><u>LAPORAN REKAPITULASI PENGGUNAAN MOBIL</u></b>
          </div>
        </div>

<div>
  <?php
    $tahun   = $_GET['tahun'];
  ?>
    <center><b>Periode:</b> <?php echo $tahun; ?></center>

  <!-- Google Chart -->
  <div align="center">
    <div id="rekapmobil"></div>
  </div>
  <!-- End Google Chart -->

  <br>

          <table width="400px" border="1" cellspacing="0" align="center">
            <tr>
              <td align="center"><b>No.</b></td>
              <td align="center"><b>Merk Mobil</b></td>
              <td align="center"><b>Total</b></td>
            </tr>
            <tr>
              <?php
              $no = 1;
              $get = mysql_query("SELECT c.no_pol,
                                  COUNT(b.id_mobil) AS total
                                  FROM spsk a JOIN detail_mobil b ON a.no_spsk = b.no_spsk JOIN mobil c ON b.id_mobil = c.id_mobil
                                  WHERE YEAR(a.tgl_spsk) = '$tahun'
                                  GROUP BY c.merk");
              while ($tampil=mysql_fetch_array($get)) {
              ?>
              <td align="center"><?php echo $no++; ?></td>
              <td><?php echo $tampil['no_pol']; ?></td>
              <td align="center"><?php echo $tampil['total']; ?></td>
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

  //Google Chart
  <?php
    $list = array();
    $dens = array();
    $i = 0;
    $get = mysql_query("SELECT c.no_pol,
                        COUNT(b.id_mobil) AS total
                        FROM spsk a JOIN detail_mobil b ON a.no_spsk = b.no_spsk JOIN mobil c ON b.id_mobil = c.id_mobil
                        WHERE YEAR(a.tgl_spsk) = '$tahun'
                        GROUP BY c.merk");
    while ($row = mysql_fetch_object($get)) {
      $no_pol   = $row->no_pol;
      $total    = $row->total;
      $list[$i] = $no_pol;
      $dens[$i] = $total;
      $i = $i + 1;
    }
  ?>
  google.charts.load("current", {packages:['corechart']});
  google.charts.setOnLoadCallback(drawChart);
  function drawChart() {
  var data = google.visualization.arrayToDataTable([
  ["Element", "Total", { role: "style" } ],
  <?php
    $k = $i;
    for($i = 0; $i<$k; $i++){
  ?>
  ['<?php echo $list[$i]?>', <?php echo $dens[$i]?>, 'stroke-color: #FF7470; stroke-width: 2; opacity:0.5; fill-color: #FF7470'],
  <?php } ?>

  ]);
  var view = new google.visualization.DataView(data);
  view.setColumns([0, 1,
               { calc: "stringify",
                 sourceColumn: 1,
                 type: "string",
                 role: "annotation" },
               2]);

  var options = {
  title: "",
  width: 1000,
  height: 300,
  bar: {groupWidth: "60%"},
  legend: { position: "none" },
  };
  var chart = new google.visualization.ColumnChart(document.getElementById("rekapmobil"));
  chart.draw(view, options);
  }
</script>
