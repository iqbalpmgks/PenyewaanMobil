<?php
include '../koneksi.php';

function autonumber($tabel, $kolom, $lebar=0, $awalan='')
{
    $query= mysql_query("SELECT id_mobil FROM mobil ORDER BY id_mobil DESC LIMIT 1");
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
  $id_mobil     = $_POST['id_mobil'];
  $merk         = ucwords($_POST['merk']);
  $no_pol       = strtoupper($_POST['no_pol']);
  $warna        = ucwords($_POST['warna']);
  $thn_buat     = $_POST['thn_buat'];
  $harga        = $_POST['harga'];
  $no_rangka    = strtoupper($_POST['no_rangka']);
  $no_mesin     = strtoupper($_POST['no_mesin']);

  $cekno = mysql_query("SELECT * FROM mobil WHERE no_pol = '$no_pol'");
  if (mysql_num_rows($cekno) <> 0) {
    echo "<script>alert('Mobil Sudah di Input!');window.location='tambah-mobil.php';</script>";
  } else {
    $simpan = mysql_query("INSERT INTO mobil VALUES ('$id_mobil', '$merk', '$no_pol', '$warna', '$thn_buat', '$harga', '$no_rangka', '$no_mesin', 'Tersedia')");
  }

  if ($simpan) {
    echo "<script>alert('Data BERHASIL di Simpan!');window.location='mobil.php';</script>";
  } else {
    echo "<script>alert('Data GAGAL di Simpan!');window.location='tambah-mobil.php';</script>";
  }
}
?>

<div id="page-wrapper">
  <div class='row'>
    <div class='col-lg-12'>
      <h3 class="page-header"><span class="glyphicon glyphicon-file"></span> Form Mobil</h3>
    </div>
  </div>

      <div class="row">
        <div class="col-lg-12">
          <div class="panel panel-default">
            <div class="panel-heading">
              <strong>Tambah Mobil</strong>
            </div>
            <div class="panel-body">
              <div class="row">
                <div class="col-lg-12">
              <form action="tambah-mobil.php" method="POST" enctype="multipart/form-data" class="form-horizontal ">
                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input">ID Mobil</label>
                  <div class="col-md-3">
                    <input type="text" id="id_mobil" name="id_mobil" class="form-control" value="<?php echo autonumber("db_rentmobil", "id_mobil", 2, "MB") ?>" readonly>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input">Merk/Type</label>
                  <div class="col-md-5">
                    <input type="text" id="merk" name="merk" class="form-control" placeholder="Merk/Type Mobil" maxlength="35" onkeyup="validHuruf(this)" required>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input">No. Polisi</label>
                  <div class="col-md-3">
                    <input type="text" id="no_pol" name="no_pol" class="form-control" placeholder="Nomor Polisi" maxlength="10" required>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input">Warna Mobil</label>
                  <div class="col-md-4">
                    <input type="text" id="warna" name="warna" class="form-control" placeholder="Warna Mobil" maxlength="10" onkeyup="validHuruf(this)">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input">Tahun</label>
                  <div class="col-md-2">
                    <input type="text" id="thn_buat" name="thn_buat" class="form-control" placeholder="Tahun" maxlength="4" onkeyup="validAngka(this)" required>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input">Harga Sewa</label>
                  <div class="col-md-4">
                    <input type="text" id="harga" name="harga" class="form-control" placeholder="Harga Sewa" maxlength="12" onkeyup="validAngka(this)" required>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input">No. Rangka</label>
                  <div class="col-md-5">
                    <input type="text" id="no_rangka" name="no_rangka" class="form-control" placeholder="Nomor Rangka" maxlength="25" required>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input">No. Mesin</label>
                  <div class="col-md-5">
                    <input type="text" id="no_mesin" name="no_mesin" class="form-control" placeholder="Nomor Mesin" maxlength="25" required>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input"></label>
                  <div class="col-md-5">
                    <a href="mobil.php" type="reset" class="btn btn-default">BATAL</a>
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
