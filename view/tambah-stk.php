<?php
include '../koneksi.php';

$tgl    = date('Y-m-d');
function autonumber($tabel, $kolom, $lebar=0, $awalan='')
{
    $query= mysql_query("SELECT no_stk FROM stk ORDER BY no_stk DESC LIMIT 1");
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

if (isset($_POST['tambah'])) {
  $id_perkap  = $_POST['id_perkap'];
  $nama_perkap= $_POST['nama_perkap'];
  $kondisi    = $_POST['kondisi'];
  $keterangan = ucwords($_POST['keterangan']);

  $cekid = mysql_query("SELECT * FROM temp_kondisi WHERE id_perkap = '$id_perkap'");
  if (mysql_num_rows($cekid) <> 0) {
    echo "<script>alert('Perlengkapan Sudah Dipesan!');window.location='tambah-stk.php';</script>";
  } elseif (empty($id_perkap) || empty($kondisi)) {
    echo "<script>alert('Silahkan isi semua data!');window.location='tambah-stk.php';</script>";
  } else {
  $tambah = mysql_query("INSERT INTO temp_kondisi VALUES('$id_perkap', '$nama_perkap', '$kondisi', '$keterangan')");
  }
}

if (isset($_POST['submit'])) {
  $getidperkap  = mysql_fetch_array(mysql_query("SELECT id_perkap FROM temp_kondisi"));
  $getnmperkap  = mysql_fetch_array(mysql_query("SELECT nama_perkap FROM temp_kondisi"));
  $getkondisi   = mysql_fetch_array(mysql_query("SELECT kondisi FROM temp_kondisi"));
  $id_perkap    = $getidperkap['id_perkap'];
  $nama_perkap  = $getnmperkap['nama_perkap'];
  $kondisi      = $getkondisi['kondisi_keluar'];
  $no_stk       = $_POST['no_stk'];
  $tgl_stk      = $_POST['tgl_stk'];
  $pemeriksa    = ucwords($_POST['pemeriksa']);
  $no_spsk      = $_POST['no_spsk'];
  $lama_sewa    = $_POST['lama_sewa'];
  $id_mobil     = $_POST['id_mobil'];
  $nama_penyewa = $_POST['nama_penyewa'];

  if (empty($no_spsk) || empty($id_perkap)) {
    echo "<script>alert('Silahkan isi semua data!');window.location='tambah-stk.php';</script>";
  } else {
    $simpan = mysql_query("INSERT INTO stk VALUES ('$no_stk', '$tgl_stk', '$pemeriksa', '$no_spsk', '$id_mobil')");
  }


  if ($simpan) {
  $simdet = mysql_query("SELECT * FROM temp_kondisi");
  while ($r=mysql_fetch_row($simdet)) {
    mysql_query("INSERT INTO periksa_keluar VALUES ('$no_stk', '$r[0]', '$r[2]', '$r[3]')");
  }
  mysql_query("TRUNCATE TABLE temp_kondisi");
  echo "<script>alert('Data STK Siap di Cetak!');window.location='cetakstk.php?no_stk=$no_stk';</script>";
} else {
  echo "<script>alert('Data GAGAL di Simpan!');window.location='tambah-stk.php';</script>";
}
}

$id_perkap = $_GET['id_perkap'];
mysql_query("DELETE FROM temp_kondisi WHERE id_perkap='$id_perkap'");

?>
<div id="page-wrapper">
  <div class='row'>
    <div class='col-lg-12'>
      <h3 class="page-header"><span class="glyphicon glyphicon-file"></span> Form Surat Terima Kendaraan (STK)</h3>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>Tambah STK</strong>
        </div>
        <div class="panel-body">
          <div class="row">
            <div class="col-lg-12">
              <form action="tambah-stk.php" method="POST" enctype="multipart/form-data" class="form-horizontal" id="form-perkap">
                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input">ID Perlengkapan</label>
                  <div class="col-md-3">
                    <input type="text" id="id_perkap" name="id_perkap" class="form-control" placeholder="ID Perlengkapan" readonly>
                  </div>
                  <button type="button" class="btn btn-default" data-toggle="modal" data-target="#ModalPerkap">CARI</button>
                </div>
                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input">Nama Perlengkapan</label>
                  <div class="col-md-5">
                    <input type="text" id="nama_perkap" name="nama_perkap" class="form-control" placeholder="Nama Perlengkapan" readonly>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input">Kondisi Keluar</label>
                    <div class="col-md-3">
                      <select type="text" id="kondisi" name="kondisi" class="form-control">
                        <option value="">-- Pilih Kondisi --</option>
                        <option value="Baik">Baik</option>
                        <option value="Rusak">Rusak</option>
                        <option value="Hilang">Hilang</option>
                        <option value="Baret">Baret</option>
                        <option value="Penyok">Penyok</option>
                        <option value="Pecah">Pecah</option>
                        <option value="Retak">Retak</option>
                        <option value="Buram">Buram</option>
                      </select>
                    </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input">Keterangan</label>
                  <div class="col-md-3">
                    <textarea type="text" id="keterangan" name="keterangan" class="form-control" placeholder="Keterangan"></textarea>
                  </div>
                  <button name="tambah" type="submit" id="tambah" class="btn btn-default">TAMBAH</button>
                </div>

                <div class="form-group row" id="tampil">
                  <label class="col-md-2 form-control-label" for="text-input"></label>
                <div class="col-md-10 table-responsive">
                  <table class="table">
                    <tr>
                      <th>No.</th>
                      <th>ID Perlengkapan</th>
                      <th>Nama Perlengkapan</th>
                      <th>Kondisi Keluar</th>
                      <th>Keterangan</th>
                      <th>Opsi</th>
                    </tr>
                    <tr>
                      <?php
                      $no = 1;
                      $get = mysql_query("SELECT * FROM temp_kondisi");
                      while ($tampil=mysql_fetch_array($get)) {
                      ?>
                      <td><?php echo $no++; ?></td>
                      <td><?php echo $tampil['id_perkap']; ?></td>
                      <td><?php echo $tampil['nama_perkap']; ?></td>
                      <td><?php echo $tampil['kondisi']; ?></td>
                      <td><?php echo $tampil['keterangan'];?></td>
                      <td><a onclick="{ location.href='tambah-stk.php?id_perkap=<?php echo $tampil['id_perkap']; ?>' }" class="btn btn-danger btn-xs">Hapus</a></td>
                    </tr>
                    <?php } ?>
                  </table>
                </div>
              </div>
            </form>

              <form action="tambah-stk.php" method="POST" enctype="multipart/form-data" class="form-horizontal ">
                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input">No. STK</label>
                  <div class="col-md-3">
                    <input type="text" id="no_stk" name="no_stk" class="form-control" placeholder="Nomor STK" value="<?php echo autonumber("db_rentmobil", "no_stk", 4, "STK") ?>" readonly>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input">Tanggal</label>
                  <div class="col-md-4">
                    <input type="date" id="tgl_stk" name="tgl_stk" value="<?php echo $tgl; ?>" class="form-control" readonly>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input">Pemeriksa</label>
                  <div class="col-md-4">
                    <input type="text" id="pemeriksa" name="pemeriksa" class="form-control" placeholder="Pemeriksa" onkeyup="validHuruf(this)" required>
                  </div>
                </div>

                <hr>

                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input">No. SPSK</label>
                  <div class="col-md-3">
                    <input type="text" id="no_spsk" name="no_spsk" class="form-control" placeholder="Nomor SPSK" readonly>
                  </div>
                  <button type="button" class="btn btn-default" data-toggle="modal" data-target="#ModalSPSK">CARI</button>
                </div>
                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input">Lama Sewa</label>
                  <div class="col-md-2">
                    <input type="text" id="lama_sewa" name="lama_sewa" class="form-control" placeholder="Lama Sewa" readonly>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input">ID Mobil</label>
                  <div class="col-md-3">
                    <input type="text" id="id_mobil" name="id_mobil" class="form-control" placeholder="ID Mobil" readonly>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input">Nama Penyewa</label>
                  <div class="col-md-5">
                    <input type="text" id="nama_penyewa" name="nama_penyewa" class="form-control" placeholder="Nama Penyewa" readonly>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input"></label>
                  <div class="col-md-5">
                    <a href="stk.php" type="reset" class="btn btn-default">BATAL</a>
                    <button name="submit" type="submit" class="btn btn-primary">CETAK</button>
                  </div>
                </div>
              </form>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal SPSK -->
  <div class="modal fade" id="ModalSPSK" tabindex="-1" role="dialog" aria-labelledby="ModalSPSKLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Pilih SPSK</h4>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-lg-12">
              <div class="table-responsive">
              <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-spsk">
                <thead>
                  <tr>
                    <th>No. SPSK</th>
                    <th>Lama Sewa</th>
                    <th>ID Mobil</th>
                    <th>Nama Penyewa</th>
                    <th>Opsi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $get = mysql_query("SELECT a.no_spsk, a.lama_sewa, c.id_mobil, b.nama_penyewa FROM spsk a JOIN penyewa b ON a.id_penyewa = b.id_penyewa JOIN detail_mobil c ON a.no_spsk = c.no_spsk JOIN mobil d ON c.id_mobil = d.id_mobil");
                  while ($tampil=mysql_fetch_array($get)) {
                  ?>
                  <tr>
                    <td id='no_spsk_<?php echo $tampil['id_mobil'];?>'><?php echo $tampil['no_spsk']; ?></td>
                    <td align="center" id='lama_sewa_<?php echo $tampil['id_mobil'];?>'><?php echo $tampil['lama_sewa']; ?> hari</td>
                    <td id='id_mobil_<?php echo $tampil['id_mobil'];?>'><?php echo $tampil['id_mobil']; ?></td>
                    <td id='nama_penyewa_<?php echo $tampil['id_mobil'];?>'><?php echo $tampil['nama_penyewa']; ?></td>
                    <td align="center"><button onclick="pilihSPSK('<?php echo $tampil['id_mobil']; ?>')" class="btn btn-info btn-xs">Pilih</button></td>
                  </tr>
                  <?php
                    $temp = $tampil['no_spsk'];
                  } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>

  <!-- Modal Perkap -->
  <div class="modal fade" id="ModalPerkap" tabindex="-1" role="dialog" aria-labelledby="ModalPerkapLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Pilih Perlengkapan</h4>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-lg-12">
              <div class="table-responsive">
              <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-perkap">
                <thead>
                  <tr>
                    <th>ID Perlengkapan</th>
                    <th>Nama Perlengkapan</th>
                    <th>Opsi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $get = mysql_query("SELECT * FROM perlengkapan WHERE id_perkap NOT IN (SELECT id_perkap FROM temp_kondisi)");
                  while ($tampil=mysql_fetch_array($get)) {
                  ?>
                  <tr>
                    <td id='id_perkap_<?php echo $tampil['id_perkap'];?>'><?php echo $tampil['id_perkap']; ?></td>
                    <td id='nama_perkap_<?php echo $tampil['id_perkap'];?>'><?php echo $tampil['nama_perkap']; ?></td>
                    <td align="center"><button onclick="pilihPerkap('<?php echo $tampil['id_perkap']; ?>')" class="btn btn-info btn-xs">Pilih</button></td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
  </div>
</div>

  <!-- /#page-wrapper -->

  <!--Code JS Validation-->
  <script type="text/javascript">
  function validAngka(a)
  {
    if(!/^[0-9.]+$/.test(a.value))
    {
      a.value = a.value.substring(0,a.value.length-1000);
    }
  }

  function validHuruf(a)
  {
    if(!/^[a-zA-Z]+$/.test(a.value))
    {
      a.value = a.value.substring(0,a.value.length-1000);
    }
  }

  //ambil data dari modal spsk
  function pilihSPSK(id_mobil){
    no_spsk        = $('#no_spsk_'+id_mobil).html();
    lama_sewa      = $('#lama_sewa_'+id_mobil).html();
    id_mobil       = $('#id_mobil_'+id_mobil).html();
    nama_penyewa   = $('#nama_penyewa_'+id_mobil).html();
    $('#no_spsk').val(no_spsk);
    $('#lama_sewa').val(lama_sewa);
    $('#id_mobil').val(id_mobil);
    $('#nama_penyewa').val(nama_penyewa);
    $('#ModalSPSK').modal('hide');
  }

  //ambil data dari modal perkap
  function pilihPerkap(id_perkap){
    id_perkap      = $('#id_perkap_'+id_perkap).html();
    nama_perkap    = $('#nama_perkap_'+id_perkap).html();
    $('#id_perkap').val(id_perkap);
    $('#nama_perkap').val(nama_perkap);
    $('#ModalPerkap').modal('hide');
  }
  </script>
  <!--End of Code JS Validation-->
</body>
</html>
