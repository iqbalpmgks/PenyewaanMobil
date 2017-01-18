<?php
include '../koneksi.php';

$id_penyewa = $_GET['id_penyewa'];
mysql_query("DELETE FROM penyewa WHERE id_penyewa='$id_penyewa'");
?>

<div id="page-wrapper">
  <div class="row">
    <div class="col-lg-12">
      <h3 class="page-header"><span class="glyphicon glyphicon-briefcase"></span> Data Penyewa</h3>
      <a href="tambah-penyewa.php" style="margin-bottom:20px" class="btn btn-info col-md-2"><span class="glyphicon glyphicon-plus"></span> Tambah Penyewa</a>
    </div>
    <!-- /.col-lg-12 -->
  </div>
  <!-- /.row -->
  <div class="row">
    <div class="col-lg-12">
      <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
        <thead>
          <tr>
            <th>ID Penyewa</th>
            <th>Nama Penyewa</th>
            <th>No. KTP/SIM</th>
            <th>No. Telp</th>
            <th>Opsi</th>
          </tr>
        </thead>
        <tbody>
          <?php $get = mysql_query("SELECT * FROM penyewa");
          while ($tampil=mysql_fetch_array($get)) {
          ?>
          <tr>
            <td><?php echo $tampil['id_penyewa']; ?></td>
            <td><?php echo $tampil['nama_penyewa']; ?></td>
            <td align="center"><?php echo $tampil['no_ktpsim']; ?></td>
            <td align="center"><?php echo $tampil['telp_penyewa']; ?></td>
            <td align="center">
              <a href="det-penyewa.php?id_penyewa=<?php echo $tampil['id_penyewa']; ?>" class="btn btn-info btn-sm">Detail</a>
              <a href="edit-penyewa.php?id_penyewa=<?php echo $tampil['id_penyewa']; ?>" class="btn btn-warning btn-sm">Edit</a>
              <a onclick="if(confirm('Apakah anda yakin ingin menghapus data ini?')){ location.href='penyewa.php?id_penyewa=<?php echo $tampil['id_penyewa']; ?>' }" class="btn btn-danger btn-sm">Hapus</a>
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
