<?php include '../koneksi.php';

$id_staff = $_GET['id_staff'];
mysql_query("DELETE FROM staff WHERE id_staff='$id_staff'");
?>
<div id="page-wrapper">
  <div class="row">
    <div class="col-lg-12">
      <h3 class="page-header"><span class="glyphicon glyphicon-briefcase"></span> Data Staff</h3>
      <a href="tambah-staff.php" style="margin-bottom:20px" class="btn btn-info col-md-2"><span class="glyphicon glyphicon-plus"></span> Tambah Staff</a>
    </div>
    <!-- /.col-lg-12 -->
  </div>
  <!-- /.row -->
  <div class="row">
    <div class="col-lg-12">
      <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
        <thead>
          <tr>
            <th>ID Staff</th>
            <th>Nama Staff</th>
            <th>Username</th>
            <th>Alamat</th>
            <th>No. Telp</th>
            <th>Opsi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $get = mysql_query("SELECT * FROM staff");
          while ($tampil=mysql_fetch_array($get)) {
          ?>
          <tr>
            <td><?php echo $tampil['id_staff']; ?></td>
            <td><?php echo $tampil['nama_staff']; ?></td>
            <td><?php echo $tampil['username']; ?></td>
            <td><?php echo $tampil['alamat_staff']; ?></td>
            <td align="center"><?php echo $tampil['telp_staff']; ?></td>
            <td align="center">
              <a href="edit-staff.php?id_staff=<?php echo $tampil['id_staff']; ?>" class="btn btn-warning btn-sm">Edit</a>
              <a onclick="if(confirm('Apakah anda yakin ingin menghapus data ini?')){ location.href='staff.php?id_staff=<?php echo $tampil['id_staff']; ?>' }" class="btn btn-danger btn-sm">Hapus</a>
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
