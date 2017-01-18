<?php
include '../koneksi.php';
?>
<div id="page-wrapper">
  <div class="row">
    <div class="col-lg-12">
      <h3 class="page-header"><span class="glyphicon glyphicon-briefcase"></span> Data Pengembalian</h3>
      <a href="tambah-pengembalian.php" style="margin-bottom:20px" class="btn btn-info col-md-2"><span class="glyphicon glyphicon-plus"></span> Tambah Kembalian</a>
    </div>
    <!-- /.col-lg-12 -->
  </div>
  <!-- /.row -->
  <div class="row">
    <div class="col-lg-12">
      <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
        <thead>
          <tr>
            <th>No. Pengembalian</th>
            <th>No. STK</th>
            <th>No. SPSK</th>
            <th>ID Mobil</th>
            <th>Opsi</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $get = mysql_query("SELECT a.no_pengembalian, b.no_stk, c.no_spsk, d.id_mobil FROM pengembalian a JOIN stk b ON a.no_stk = b.no_stk JOIN spsk c ON b.no_spsk = c.no_spsk JOIN detail_mobil d ON c.no_spsk = d.no_spsk WHERE b.id_mobil = d.id_mobil GROUP BY a.no_pengembalian");
            while ($tampil=mysql_fetch_array($get)) {
          ?>
          <tr>
            <td><?php echo $tampil['no_pengembalian']; ?></td>
            <td><?php echo $tampil['no_stk']; ?></td>
            <td><?php echo $tampil['no_spsk']; ?></td>
            <td><?php echo $tampil['id_mobil']; ?></td>
            <td align="center">
              <a href="det-pengembalian.php?no_pengembalian=<?php echo $tampil['no_pengembalian'] ?>" class="btn btn-info btn-sm">Detail</a>
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
