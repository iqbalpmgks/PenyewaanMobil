<?php
include '../koneksi.php';

function autonumber($tabel, $kolom, $lebar=0, $awalan='')
{
    $query= mysql_query("SELECT id_penyewa FROM penyewa ORDER BY id_penyewa DESC LIMIT 1");
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
  $id_penyewa   = $_POST['id_penyewa'];
  $nama_penyewa = ucwords($_POST['nama_penyewa']);
  $no_ktpsim    = $_POST['no_ktpsim'];
  $jenkel       = $_POST['jenkel'];
  $alamat       = ucwords($_POST['alamat']);
  $no_telp      = $_POST['no_telp'];
  $email        = $_POST['email'];

  $cekno = mysql_query("SELECT * FROM penyewa WHERE no_ktpsim = '$no_ktpsim'");
  if (mysql_num_rows($cekno) <> 0) {
    echo "<script>alert('Penyewa Sudah di Input!');window.location='tambah-penyewa.php';</script>";
  } else {
    $simpan = mysql_query("INSERT INTO penyewa VALUES ('$id_penyewa', '$nama_penyewa', '$no_ktpsim', '$jenkel', '$alamat', '$no_telp', '$email')");
  }

  if ($simpan) {
    echo "<script>alert('Data BERHASIL di Simpan!');window.location='penyewa.php';</script>";
  } else {
    echo "<script>alert('Data GAGAL di Simpan!');window.location='tambah-penyewa.php';</script>";
  }
}
?>

<div id="page-wrapper">
  <div class='row'>
    <div class='col-lg-12'>
      <h3 class="page-header"><span class="glyphicon glyphicon-file"></span> Form Penyewa</h3>
    </div>
  </div>

      <div class="row">
        <div class="col-lg-12">
          <div class="panel panel-default">
            <div class="panel-heading">
              <strong>Tambah Penyewa</strong>
            </div>
            <div class="panel-body">
              <div class="row">
                <div class="col-lg-12">
              <form action="tambah-penyewa.php" method="POST" enctype="multipart/form-data" class="form-horizontal ">
                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input">ID Penyewa</label>
                  <div class="col-md-3">
                    <input type="text" id="text-input" name="id_penyewa" class="form-control" value="<?php echo autonumber("db_rentmobil", "id_penyewa", 4, "PM") ?>" readonly>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input">Nama Penyewa</label>
                  <div class="col-md-5">
                    <input type="text" id="text-input" name="nama_penyewa" class="form-control" placeholder="Nama Penyewa" maxlength="50" onkeyup="validHuruf(this)" required>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input">No. KTP/SIM</label>
                  <div class="col-md-4">
                    <input type="text" id="text-input" name="no_ktpsim" class="form-control" placeholder="Nomor KTP/SIM" maxlength="16" onkeyup="validAngka(this)" required>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input">Jenis Kelamin</label>
                  <div class="col-md-3">
                    <select id="select" name="jenkel" class="form-control">
                      <option value="">Pilih Jenis Kelamin</option>
                      <option value="Laki-laki">Laki-laki</option>
                      <option value="Perempuan">Perempuan</option>
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input">Alamat</label>
                  <div class="col-md-6">
                    <textarea id="textarea-input" name="alamat" rows="3" class="form-control" placeholder="Alamat" maxlength="80" required></textarea>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input">No. Telepon</label>
                  <div class="col-md-3">
                    <input type="text" id="text-input" name="no_telp" class="form-control" placeholder="Nomor Telepon" maxlength="16" onkeyup="validAngka(this)" required>
                    <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input">Email</label>
                  <div class="col-md-4">
                    <input type="email" id="text-input" name="email" class="form-control" placeholder="Email" maxlength="50">
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input"></label>
                  <div class="col-md-5">
                    <a href="penyewa.php" type="reset" class="btn btn-default">BATAL</a>
                    <button type="submit" name="submit" class="btn btn-primary">SIMPAN</button>
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

  //valiadasi huruf
  function validHuruf(a)
  {
    if(!/^[a-zA-Z]+$/.test(a.value))
    {
      a.value = a.value.substring(0,a.value.length-1000);
    }
  }
</script>
<!--End of Code JS Validation-->
