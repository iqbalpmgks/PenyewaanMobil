<?php
include '../koneksi.php';

?>
<div id="page-wrapper">
  <div class="row">
    <div class="col-lg-12">
      <h3 class="page-header"><span class="glyphicon glyphicon-briefcase"></span> Data Surat Perjanjian Sewa Kendaraan (SPSK)</h3>
      <a href="tambah-spsk.php" style="margin-bottom:20px" class="btn btn-info col-md-2"><span class="glyphicon glyphicon-plus"></span> Tambah SPSK</a>
    </div>
    <!-- /.col-lg-12 -->
  </div>
  <!-- /.row -->
  <div class="row">
    <div class="col-lg-12">
      <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
        <thead>
          <tr>
            <th>No. SPSK</th>
            <th>Tanggal SPSK</th>
            <th>Nama Penyewa</th>
            <th>Lama Sewa</th>
            <th>Opsi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $get = mysql_query("SELECT * FROM spsk a JOIN penyewa b ON a.id_penyewa = b.id_penyewa");
          while ($tampil=mysql_fetch_array($get)) {
          ?>
          <tr>
            <td><?php echo $tampil['no_spsk']; ?></td>
            <td><?php echo $tampil['tgl_spsk']; ?></td>
            <td><?php echo $tampil['nama_penyewa']; ?></td>
            <td align="center"><?php echo $tampil['lama_sewa']; ?> hari</td>
            <td align="center">
              <a href="det-spsk.php?no_spsk=<?php echo $tampil['no_spsk'] ?>" class="btn btn-info btn-sm">Detail</a>
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
