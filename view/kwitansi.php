<?php include '../koneksi.php'; ?>
<div id="page-wrapper">
  <div class="row">
    <div class="col-lg-12">
      <h3 class="page-header"><span class="glyphicon glyphicon-briefcase"></span> Data Kwitansi</h3>
      <a href="tambah-kwitansi.php" style="margin-bottom:20px" class="btn btn-info col-md-2"><span class="glyphicon glyphicon-plus"></span> Tambah Kwitansi</a>
    </div>
    <!-- /.col-lg-12 -->
  </div>
  <!-- /.row -->
  <div class="row">
    <div class="col-lg-12">
      <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
        <thead>
          <tr>
            <th>No. Kwitansi</th>
            <th>No. SPSK</th>
            <th>Nama Penyewa</th>
            <th>Total Harga</th>
            <th>Opsi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $get = mysql_query("SELECT * FROM kwitansi a JOIN spsk b ON a.no_spsk = b.no_spsk JOIN penyewa c ON b.id_penyewa = c.id_penyewa");
          while ($tampil=mysql_fetch_array($get)) {
          ?>
          <tr>
            <td><?php echo $tampil['no_kwitansi']; ?></td>
            <td><?php echo $tampil['no_spsk']; ?></td>
            <td><?php echo $tampil['nama_penyewa']; ?></td>
            <td align="center">Rp. <?php echo $tampil['subtotal']; ?></td>
            <td align="center">
              <a href="det-kwitansi.php?no_kwitansi=<?php echo $tampil['no_kwitansi'] ?>" class="btn btn-info btn-sm">Detail</a>
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
