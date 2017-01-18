<?php
include '../koneksi.php';

function autonumber($tabel, $kolom, $lebar=0, $awalan='')
{
    $query= mysql_query("SELECT id_supir FROM supir ORDER BY id_supir DESC LIMIT 1");
    $jumlahrecord = mysql_num_rows($query);
    if($jumlahrecord == 0)
        $nomor=1;
    else
    {
        $row=mysql_fetch_array($query);
        $nomor=intval(substr($row[0],strlen($awalan)))+1;
    }
    if($lebar>0)
        $angka = $awalan.str_pad($nomor,$lebar,"0",STR_PAD_LEFT);
    else
        $angka = $awalan.$nomor;

    return $angka;
}

if (isset($_POST['submit'])) {
  $id_supir     = $_POST['id_supir'];
  $nama_supir   = ucwords($_POST['nama_supir']);
  $alamat_supir = ucwords($_POST['alamat_supir']);
  $telp_supir   = $_POST['telp_supir'];
  $tarif        = $_POST['tarif'];

  $cekno = mysql_query("SELECT * FROM supir WHERE nama_supir = '$nama_supir'");
  if (mysql_num_rows($cekno) <> 0) {
    echo "<script>alert('Supir Sudah di Input!');window.location='supir.php';</script>";
  } else {
    $simpan = mysql_query("INSERT INTO supir VALUES ('$id_supir', '$nama_supir', '$alamat_supir', '$telp_supir', '$tarif', 'Tersedia')");
  }

  if ($simpan) {
    echo "<script>alert('Data BERHASIL di Simpan!');window.location='supir.php';</script>";
  } else {
    echo "<script>alert('Data GAGAL di Simpan!');window.location='supir.php';</script>";
  }
}

$id_supir = $_GET['id_supir'];
mysql_query("DELETE FROM supir WHERE id_supir='$id_supir'");
?>

<div id="page-wrapper">
  <div class="row">
    <div class="col-lg-12">
      <h3 class="page-header"><span class="glyphicon glyphicon-briefcase"></span> Data Supir</h3>
      <button style='margin-bottom:20px' data-toggle='modal' data-target='#myModal' class="btn btn-info col-md-2"><span class="glyphicon glyphicon-plus"></span> Tambah Supir</button>
    </div>
    <!-- /.col-lg-12 -->
  </div>
  <!-- /.row -->
  <div class="row">
    <div class="col-lg-12">
      <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
        <thead>
          <tr>
            <th>ID Supir</th>
            <th>Nama Supir</th>
            <th>Alamat</th>
            <th>No. Telp</th>
            <th>Tarif</th>
            <th>Status</th>
            <th>Opsi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $get = mysql_query("SELECT * FROM supir");
          while ($tampil=mysql_fetch_array($get)) {
          ?>
          <tr>
            <td><?php echo $tampil['id_supir']; ?></td>
            <td><?php echo $tampil['nama_supir']; ?></td>
            <td><?php echo $tampil['alamat_supir']; ?></td>
            <td align="center"><?php echo $tampil['telp_supir']; ?></td>
            <td align="center">Rp. <?php echo $tampil['tarif']; ?></td>
            <td align="center"><?php echo $tampil['status']; ?></td>
            <td align="center">
              <a href="edit-supir.php?id_supir=<?php echo $tampil['id_supir'] ?>" class="btn btn-warning btn-sm">Edit</a>
              <a onclick="if(confirm('Apakah anda yakin ingin menghapus data ini?')){ location.href='supir.php?id_supir=<?php echo $tampil['id_supir']; ?>' }" class="btn btn-danger btn-sm">Hapus</a>
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

  <!-- modal input -->
  <div id="myModal" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Tambah Supir</h4>
        </div>
        <div class="modal-body">
          <form action="supir.php" method="POST">
            <div class="form-group">
              <label>ID Supir</label>
              <input name="id_supir" type="text" class="form-control" value="<?php echo autonumber("db_rentmobil", "id_supir", 2, "SP") ?>" readonly>
            </div>
            <div class="form-group">
              <label>Nama Supir</label>
              <input name="nama_supir" type="text" class="form-control" placeholder="Nama Supir" maxlength="50" onkeyup="validHuruf(this)" required>
            </div>
            <div class="form-group">
              <label>Alamat</label>
              <textarea id="textarea-input" name="alamat_supir" rows="3" class="form-control" placeholder="Alamat" maxlength="80" required></textarea>
            </div>
            <div class="form-group">
              <label>No. Telp</label>
              <input name="telp_supir" type="text" class="form-control" placeholder="Nomor Telepon" maxlength="12" onkeyup="validAngka(this)" required>
            </div>
            <div class="form-group">
              <label>Tarif</label>
              <input name="tarif" type="text" class="form-control" placeholder="Tarif" maxlength="12" onkeyup="validAngka(this)" required>
            </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <input name="submit" type="submit" class="btn btn-primary" value="Simpan">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- /#page-wrapper -->

<!--Code JS Validation-->
<script language='javascript'>
  //validasi angka
  function validAngka(a)
  {
    if(!/^[0-9.]+$/.test(a.value))
    {
      a.value = a.value.substring(0,a.value.length-1000);
    }
  }

  //validasi huruf
  function validHuruf(a)
  {
    if(!/^[a-zA-Z]+$/.test(a.value))
    {
      a.value = a.value.substring(0,a.value.length-1000);
    }
  }
</script>
<!--End of Code JS Validation-->
