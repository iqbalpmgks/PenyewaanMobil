<?php
include '../koneksi.php';

function autonumber($tabel, $kolom, $lebar=0, $awalan='')
{
    $query= mysql_query("SELECT id_jnsdenda FROM jenis_denda ORDER BY id_jnsdenda DESC LIMIT 1");
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
  $id_jnsdenda  = $_POST['id_jnsdenda'];
  $nama_jnsdenda= ucwords($_POST['nama_jnsdenda']);
  $nominal      = $_POST['nominal'];

  $cekno = mysql_query("SELECT * FROM jenis_denda WHERE nama_jnsdenda = '$nama_jnsdenda'");
  if (mysql_num_rows($cekno) <> 0) {
    echo "<script>alert('Jenis Denda Sudah di Input!');window.location='jns_denda.php';</script>";
  } else {
    $simpan = mysql_query("INSERT INTO jenis_denda VALUES('$id_jnsdenda', '$nama_jnsdenda', '$nominal')");
  }

  if ($simpan) {
    echo "Data BERHASIL di Simpan!";
  } else {
    echo "Data GAGAL di Simpan!";
  }
}

if (isset($_POST['update'])) {
  $id_jnsdenda  = $_POST['id_jnsdenda'];
  $nama_jnsdenda= ucwords($_POST['nama_jnsdenda']);
  $nominal      = $_POST['nominal'];

  $update = mysql_query("UPDATE jenis_denda SET id_jnsdenda='$id_jnsdenda', nama_jnsdenda='$nama_jnsdenda', nominal='$nominal' WHERE id_jnsdenda='$id_jnsdenda'");
  if ($update) {
    echo "<script>alert('Data BERHASIL di Update!');window.location='jns_denda.php';</script>";
  } else {
    echo "<script>alert('Data GAGAL di Update!');window.location='jns_denda.php';</script>";
  }
}

$id_jnsdenda = $_GET['id_jnsdenda'];
mysql_query("DELETE FROM jenis_denda WHERE id_jnsdenda='$id_jnsdenda'");
?>
<div id="page-wrapper">
  <div class="row">
    <div class="col-lg-12">
      <h3 class="page-header"><span class="glyphicon glyphicon-briefcase"></span> Data Jenis Denda</h3>
      <button style='margin-bottom:20px' data-toggle='modal' data-target='#myModal' class="btn btn-info col-md-2"><span class="glyphicon glyphicon-plus"></span> Tambah Jenis Denda</button>
    </div>
    <!-- /.col-lg-12 -->
  </div>
  <!-- /.row -->
  <div class="row">
    <div class="col-lg-12">
      <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
        <thead>
          <tr>
            <th>ID Jenis Denda</th>
            <th>Nama Jenis Denda</th>
            <th>Nominal</th>
            <th>Opsi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $get = mysql_query("SELECT * FROM jenis_denda");
          while ($tampil=mysql_fetch_array($get)) {
          ?>
          <tr>
            <td id='id_jnsdenda_<?php echo $tampil['id_jnsdenda'];?>'><?php echo $tampil['id_jnsdenda']; ?></td>
            <td id='nama_jnsdenda_<?php echo $tampil['id_jnsdenda'];?>'><?php echo $tampil['nama_jnsdenda']; ?></td>
            <td id='nominal_<?php echo $tampil['id_jnsdenda'];?>'>Rp. <?php echo $tampil['nominal']; ?></td>
            <td align="center">
              <button onclick="pilihJnsDenda('<?php echo $tampil['id_jnsdenda']; ?>')" data-toggle="modal" data-target="#ModalEdit" class="btn btn-warning btn-sm">Edit</button>
              <a onclick="if(confirm('Apakah anda yakin ingin menghapus data ini?')){ location.href='jns_denda.php?id_jnsdenda=<?php echo $tampil['id_jnsdenda']; ?>' }" class="btn btn-danger btn-sm">Hapus</a>
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
        <h4 class="modal-title">Tambah Jenis Denda</h4>
      </div>
      <div class="modal-body">
        <form action="jns_denda.php" method="POST">
          <div class="form-group">
            <label>ID Jenis Denda</label>
            <input name="id_jnsdenda" type="text" class="form-control" placeholder="ID Jenis Denda" value="<?php echo autonumber("db_rentmobil", "id_jnsdenda", 2, "JD") ?>" readonly>
          </div>
          <div class="form-group">
            <label>Nama Jenis Denda</label>
            <input name="nama_jnsdenda" type="text" class="form-control" placeholder="Nama Jenis Denda" onkeyup="validHuruf(this)" maxlength="50" required>
          </div>
        <div class="form-group">
          <label>Nominal</label>
          <input name="nominal" type="text" class="form-control" placeholder="Nominal Denda" onkeyup="validAngka(this)" maxlength="12" required>
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
        <h4 class="modal-title">Edit Jenis Denda</h4>
      </div>
      <div class="modal-body">
        <form action="jns_denda.php" method="POST">
          <div class="form-group">
            <label>ID Perlengkapan</label>
            <input id="id_jnsdenda" name="id_jnsdenda" type="text" class="form-control" placeholder="ID Jenis Denda" readonly>
          </div>
          <div class="form-group">
            <label>Nama Perlengkapan</label>
            <input id="nama_jnsdenda" name="nama_jnsdenda" type="text" class="form-control" placeholder="Nama Jenis Denda" onkeyup="validHuruf(this)" maxlength="50" required>
          </div>
          <div class="form-group">
            <label>Nominal</label>
            <input id="nominal" name="nominal" type="text" class="form-control" placeholder="Nominal Denda" onkeyup="validAngka(this)" maxlength="12" required>
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

  //ambil data dari tabel
  function pilihJnsDenda(id_jnsdenda){
    id_jnsdenda     = $('#id_jnsdenda_'+id_jnsdenda).html();
    nama_jnsdenda   = $('#nama_jnsdenda_'+id_jnsdenda).html();
    nominal         = $('#nominal_'+id_jnsdenda).html();
    $('#id_jnsdenda').val(id_jnsdenda);
    $('#nama_jnsdenda').val(nama_jnsdenda);
    $('#nominal').val(nominal);
  }

</script
