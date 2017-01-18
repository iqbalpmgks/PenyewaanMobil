<?php
include '../koneksi.php';

function autonumber($tabel, $kolom, $lebar=0, $awalan='')
{
    $query= mysql_query("SELECT id_staff FROM staff ORDER BY id_staff DESC LIMIT 1");
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
  $id_staff   = $_POST['id_staff'];
  $nama_staff = ucwords($_POST['nama_staff']);
  $alamat     = ucwords($_POST['alamat']);
  $no_telp    = $_POST['no_telp'];
  $username   = $_POST['username'];
  $password   = $_POST['password'];

  $cekuser = mysql_query("SELECT * FROM staff WHERE username = '$username'");
  if (mysql_num_rows($cekuser) <> 0) {
    echo "<script>alert('Staf Sudah di Input!');window.location='tambah-staff.php';</script>";
  } else {
    $simpan = mysql_query("INSERT INTO staff VALUES ('$id_staff', '$nama_staff', '$alamat', '$no_telp', '$username', '$password')");
  }

  if ($simpan) {
    echo "<script>alert('Data BERHASIL di Simpan!');window.location='staff.php';</script>";
  } else {
    echo "<script>alert('Data BERHASIL di Simpan!');window.location='tambah-staff.php';</script>";
  }
}
?>
<div id="page-wrapper">
  <div class='row'>
    <div class='col-lg-12'>
      <h3 class="page-header"><span class="glyphicon glyphicon-file"></span> Form Staff</h3>
    </div>
  </div>

      <div class="row">
        <div class="col-lg-12">
          <div class="panel panel-default">
            <div class="panel-heading">
              <strong>Tambah Staff</strong>
            </div>
            <div class="panel-body">
              <div class="row">
                <div class="col-lg-12">
              <form action="#" method="post" enctype="multipart/form-data" class="form-horizontal ">
                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input">ID Staff</label>
                  <div class="col-md-3">
                    <input type="text" id="text-input" name="id_staff" class="form-control" value="<?php echo autonumber("db_rentmobil", "id_staff", 2, "ST") ?>" readonly>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input">Nama Staff</label>
                  <div class="col-md-5">
                    <input type="text" id="text-input" name="nama_staff" class="form-control" placeholder="Nama Staff" maxlength="50" onkeyup="validHuruf(this)" required>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input">Alamat</label>
                  <div class="col-md-5">
                    <textarea id="textarea-input" name="alamat" rows="3" class="form-control" placeholder="Alamat" maxlength="80" required></textarea>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input">No. Telepon</label>
                  <div class="col-md-3">
                    <input type="text" id="text-input" name="no_telp" class="form-control" placeholder="Nomor Telepon" maxlength="12" onkeyup="validAngka(this)" required>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input">Username</label>
                  <div class="col-md-5">
                    <input type="text" id="text-input" name="username" class="form-control" placeholder="Username" maxlength="15" required>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input">Password</label>
                  <div class="col-md-5">
                    <input type="password" id="text-input" name="password" class="form-control" placeholder="Password" maxlength="20" required>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input"></label>
                  <div class="col-md-5">
                    <a href="staff.php" type="reset" class="btn btn-default">BATAL</a>
                    <button name="submit" type="submit" class="btn btn-primary">SIMPAN</button>
                  </div>
                </div>
              </form>
            </div>

            </div>
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
