<?php include '../koneksi.php'; ?>
<div id="page-wrapper">
  <div class="row">
    <div class="col-lg-12">
      <h3 class="page-header"><span class="glyphicon glyphicon-briefcase"></span> Data Surat Perintah Kerja (SPK)</h3>
      <a href="tambah-spk.php" style="margin-bottom:20px" class="btn btn-info col-md-2"><span class="glyphicon glyphicon-plus"></span> Tambah SPK</a>
    </div>
    <!-- /.col-lg-12 -->
  </div>
  <!-- /.row -->
  <div class="row">
    <div class="col-lg-12">
      <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
        <thead>
          <tr>
            <th>No. SPK</th>
            <th>No. SPSK</th>
            <th>Nama Penyewa</th>
            <th>Nama Supir</th>
            <th>Opsi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $get = mysql_query("SELECT * FROM spk a JOIN supir b ON a.id_supir = b.id_supir JOIN spsk c ON a.no_spsk = c.no_spsk JOIN penyewa d ON c.id_penyewa = d.id_penyewa");
          while ($tampil=mysql_fetch_array($get)) {
          ?>
          <tr>
            <td><?php echo $tampil['no_spk']; ?></td>
            <td><?php echo $tampil['no_spsk']; ?></td>
            <td><?php echo $tampil['nama_penyewa']; ?></td>
            <td><?php echo $tampil['nama_supir']; ?></td>
            <td align="center">
              <a href="det-spk.php?no_spk=<?php echo $tampil['no_spk'] ?>" class="btn btn-info btn-sm">Detail</a>
            </td>
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
