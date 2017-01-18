<?php
include '../koneksi.php';

$id_mobil = $_GET['id_mobil'];
mysql_query("DELETE FROM mobil WHERE id_mobil='$id_mobil'");
?>

<div id="page-wrapper">
  <div class="row">
    <div class="col-lg-12">
      <h3 class="page-header"><span class="glyphicon glyphicon-briefcase"></span> Data Mobil</h3>
      <a href="tambah-mobil.php" style="margin-bottom:20px" class="btn btn-info col-md-2"><span class="glyphicon glyphicon-plus"></span> Tambah Mobil</a>
    </div>
    <!-- /.col-lg-12 -->
  </div>
  <!-- /.row -->
  <div class="row">
    <div class="col-lg-12">
      <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
        <thead>
          <tr>
            <th>ID Mobil</th>
            <th>Merk Mobil</th>
            <th>Nomor Polisi</th>
            <th>Harga</th>
            <th>Opsi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $get = mysql_query("SELECT * FROM mobil");
          while ($tampil=mysql_fetch_array($get)) {
          ?>
          <tr>
            <td><?php echo $tampil['id_mobil']; ?></td>
            <td><?php echo $tampil['merk']; ?></td>
            <td align="center"><?php echo $tampil['no_pol']; ?></td>
            <td align="center">Rp. <?php echo $tampil['harga']; ?></td>
            <td align="center">
              <a href="det-mobil.php?id_mobil=<?php echo $tampil['id_mobil'] ?>" class="btn btn-info btn-sm">Detail</a>
              <a href="edit-mobil.php?id_mobil=<?php echo $tampil['id_mobil'] ?>" class="btn btn-warning btn-sm">Edit</a>
              <a onclick="if(confirm('Apakah anda yakin ingin menghapus data ini?')){ location.href='mobil.php?id_mobil=<?php echo $tampil['id_mobil']; ?>' }" class="btn btn-danger btn-sm">Hapus</a>
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
