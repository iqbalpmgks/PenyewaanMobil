<?php
include '../koneksi.php';
?>
<div id="page-wrapper">
  <div class="row">
    <div class="col-lg-12">
      <h3 class="page-header"><span class="glyphicon glyphicon-briefcase"></span> Data Bukti Denda</h3>
      <a href="tambah-bukden.php" style="margin-bottom:20px" class="btn btn-info col-md-2"><span class="glyphicon glyphicon-plus"></span> Tambah Bukti Denda</a>
    </div>
    <!-- /.col-lg-12 -->
  </div>
  <!-- /.row -->
  <div class="row">
    <div class="col-lg-12">
      <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
        <thead>
          <tr>
            <th>No. Bukti Denda</th>
            <th>No. Pengembalian</th>
            <th>No. STK</th>
            <th>No. SPSK</th>
            <th>Opsi</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $get = mysql_query("SELECT a.no_bukden, b.no_pengembalian, c.no_stk, d.no_spsk FROM bukti_denda a JOIN pengembalian b ON a.no_pengembalian = b.no_pengembalian JOIN stk c ON b.no_stk = c.no_stk JOIN spsk d ON c.no_spsk = d.no_spsk");
            while ($tampil=mysql_fetch_array($get)) {
          ?>
          <tr>
            <td><?php echo $tampil['no_bukden']; ?></td>
            <td><?php echo $tampil['no_pengembalian']; ?></td>
            <td><?php echo $tampil['no_stk']; ?></td>
            <td><?php echo $tampil['no_spsk']; ?></td>
            <td align="center">
              <a href="det-bukden.php?no_bukden=<?php echo $tampil['no_bukden'] ?>" class="btn btn-info btn-sm">Detail</a>
            </td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
      <!-- /.table-responsive -->
    </div>
    <!-- /.col-lg-12 -->
  </div>
  <!-- /.row -->
</div>
<!-- /#page-wrapper -->
