<?php
include '../koneksi.php';

function autonumber($tabel, $kolom, $lebar=0, $awalan='')
{
    $query= mysql_query("SELECT id_perkap FROM perlengkapan ORDER BY id_perkap DESC LIMIT 1");
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
  $id_perkap  = $_POST['id_perkap'];
  $nama_perkap= ucwords($_POST['nama_perkap']);

  $cekno = mysql_query("SELECT * FROM perlengkapan WHERE nama_perkap = '$nama_perkap'");
  if (mysql_num_rows($cekno) <> 0) {
    echo "<script>alert('Perlengkapan Sudah di Input!');window.location='perlengkapan.php';</script>";
  } else {
    $simpan = mysql_query("INSERT INTO perlengkapan VALUES('$id_perkap', '$nama_perkap')");
  }

  if ($simpan) {
    echo "Data BERHASIL di Simpan!";
  } else {
    echo "Data GAGAL di Simpan!";
  }
}

if (isset($_POST['update'])) {
  $id_perkap  = $_POST['id_perkap'];
  $nama_perkap= ucwords($_POST['nama_perkap']);

  $update = mysql_query("UPDATE perlengkapan SET id_perkap='$id_perkap', nama_perkap='$nama_perkap' WHERE id_perkap='$id_perkap'");
  if ($update) {
    echo "<script>alert('Data BERHASIL di Update!');window.location='perlengkapan.php';</script>";
  } else {
    echo "<script>alert('Data GAGAL di Update!');window.location='perlengkapan.php';</script>";
  }
}

$id_perkap = $_GET['id_perkap'];
mysql_query("DELETE FROM perlengkapan WHERE id_perkap='$id_perkap'");
?>
<div id="page-wrapper">
  <div class="row">
    <div class="col-lg-12">
      <h3 class="page-header"><span class="glyphicon glyphicon-briefcase"></span> Data Perlengkapan</h3>
      <button style='margin-bottom:20px' data-toggle='modal' data-target='#myModal' class="btn btn-info col-md-2"><span class="glyphicon glyphicon-plus"></span> Tambah Perkap</button>
    </div>
    <!-- /.col-lg-12 -->
  </div>
  <!-- /.row -->
  <div class="row">
    <div class="col-lg-12">
      <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
        <thead>
          <tr>
            <th>ID Perlengkapan</th>
            <th>Nama Perlengkapan</th>
            <th>Opsi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $get = mysql_query("SELECT * FROM perlengkapan");
          while ($tampil=mysql_fetch_array($get)) {
          ?>
          <tr>
            <td id='id_perkap_<?php echo $tampil['id_perkap'];?>'><?php echo $tampil['id_perkap']; ?></td>
            <td id='nama_perkap_<?php echo $tampil['id_perkap'];?>'><?php echo $tampil['nama_perkap']; ?></td>
            <td align="center">
              <button onclick="pilihPerkap('<?php echo $tampil['id_perkap']; ?>')" data-toggle="modal" data-target="#ModalEdit" class="btn btn-warning btn-sm">Edit</button>
              <a onclick="if(confirm('Apakah anda yakin ingin menghapus data ini?')){ location.href='perlengkapan.php?id_perkap=<?php echo $tampil['id_perkap']; ?>' }" class="btn btn-danger btn-sm">Hapus</a>
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
        <h4 class="modal-title">Tambah Perlengkapan</h4>
      </div>
      <div class="modal-body">
        <form action="perlengkapan.php" method="POST">
          <div class="form-group">
            <label>ID Perlengkapan</label>
            <input name="id_perkap" type="text" class="form-control" placeholder="ID Perlengkapan" value="<?php echo autonumber("db_rentmobil", "id_perkap", 2, "PK") ?>" readonly>
          </div>
          <div class="form-group">
            <label>Nama Perlengkapan</label>
            <input name="nama_perkap" type="text" class="form-control" placeholder="Nama Perlengkapan" maxlength="50" onkeyup="validHuruf(this)" required>
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

<!-- modal edit -->
<div id="ModalEdit" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Edit Perlengkapan</h4>
      </div>
      <div class="modal-body">
        <form action="perlengkapan.php" method="POST">
          <div class="form-group">
            <label>ID Perlengkapan</label>
            <input id="id_perkap" name="id_perkap" type="text" class="form-control" placeholder="ID Perlengkapan" readonly>
          </div>
          <div class="form-group">
            <label>Nama Perlengkapan</label>
            <input id="nama_perkap" name="nama_perkap" type="text" class="form-control" placeholder="Nama Perlengkapan" onkeyup="validHuruf(this)" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <input name="update" type="submit" class="btn btn-primary" value="Update">
        </div>
      </form>
    </div>
  </div>
</div>

</div>
<!-- /#page-wrapper -->

<script>
  //ambil data dari tabel
  function pilihPerkap(id_perkap){
    id_perkap     = $('#id_perkap_'+id_perkap).html();
    nama_perkap   = $('#nama_perkap_'+id_perkap).html();
    $('#id_perkap').val(id_perkap);
    $('#nama_perkap').val(nama_perkap);
  }


  //validasi huruf
  function validHuruf(a)
  {
    if(!/^[a-zA-Z]+$/.test(a.value))
    {
      a.value = a.value.substring(0,a.value.length-1000);
    }
  }
</script
