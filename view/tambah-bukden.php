<?php
include '../koneksi.php';

$tgl    = date('Y-m-d');
function autonumber($tabel, $kolom, $lebar=0, $awalan='')
{
    $query= mysql_query("SELECT no_bukden FROM bukti_denda ORDER BY no_bukden DESC LIMIT 1");
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
  $no_bukden        = $_POST['no_bukden'];
  $tgl_bukden       = $_POST['tgl_bukden'];
  $no_pengembalian  = $_POST['no_pengembalian'];
  $jns_denda        = $_POST['jns_denda'];
  $jml_denda      = $_POST['jml_denda'];

  $idjns = ""; // inisialiasi nominal ke id jenis denda
  $sql   = mysql_query("SELECT * FROM jenis_denda");
  while ($data = mysql_fetch_array($sql)) {
    if ($jns_denda == $data['nominal']) {
      $idjns = $data['id_jnsdenda'];
    }
  }

  $cekno = mysql_query("SELECT * FROM bukti_denda WHERE no_pengembalian = '$no_pengembalian'"); //cek pengembalian di buktidenda
  if (mysql_num_rows($cekno) <> 0) {
    echo "<script>alert('Pengembalian Sudah Dicetak!');window.location='tambah-bukden.php';</script>";
  } elseif (empty($no_pengembalian) || empty($jml_denda)) { //jika nomor pengembalian atau total denda kosong
    echo "<script>alert('Silahkan isi semua data!');window.location='tambah-bukden.php';</script>";
  } else {
  $simpan = mysql_query("INSERT INTO bukti_denda VALUES ('$no_bukden', '$tgl_bukden', '$no_pengembalian', '$jml_denda', '$idjns')");
  }

  if ($simpan) {
    echo "<script>alert('Data Bukti Denda Siap di Cetak!');window.location='cetakbukden.php?no_bukden=$no_bukden';</script>";
  } else {
    echo "<script>alert('Data GAGAL di Simpan!');window.location='tambah-bukden.php';</script>";
  }
}
?>
<div id="page-wrapper">
  <div class='row'>
    <div class='col-lg-12'>
      <h3 class="page-header"><span class="glyphicon glyphicon-file"></span> Form Bukti Denda</h3>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>Tambah Bukti Denda</strong>
        </div>
        <div class="panel-body">
          <div class="row">
            <div class="col-lg-12">
              <form action="tambah-bukden.php" method="POST" enctype="multipart/form-data" class="form-horizontal ">
                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input">No. Bukti Denda</label>
                  <div class="col-md-3">
                    <input type="text" id="no_bukden" name="no_bukden" class="form-control" placeholder="Nomor Bukti Denda" value="<?php echo autonumber("db_rentmobil", "no_bukden", 4, "BTD") ?>" readonly>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input">Tanggal</label>
                  <div class="col-md-4">
                    <input type="date" id="tgl_bukden" name="tgl_bukden" class="form-control" value="<?php echo $tgl; ?>" readonly>
                  </div>
                </div>

                <hr>
                <?php
                  $no_pengembalian = $_GET['no_pengembalian'];
                  $get = mysql_fetch_array(mysql_query("SELECT a.no_pengembalian, a.telat, d.nama_penyewa, e.jasa_supir FROM pengembalian a JOIN stk b ON a.no_stk = b.no_stk JOIN spsk c ON b.no_spsk = c.no_spsk JOIN penyewa d ON c.id_penyewa = d.id_penyewa JOIN detail_mobil e ON c.no_spsk = e.no_spsk WHERE a.no_pengembalian='$no_pengembalian'"));
                ?>
                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input">No. Pengembalian</label>
                  <div class="col-md-3">
                    <input type="text" id="no_pengembalian" name="no_pengembalian" class="form-control" placeholder="Nomor Pengembalian" value="<?php echo $get['no_pengembalian']; ?>" readonly>
                  </div>
                    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal">CARI</button>
                </div>
                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input">Keterlambatan</label>
                  <div class="col-md-2">
                    <input type="text" id="telat" name="telat" class="form-control" placeholder="Jumlah Telat" value="<?php echo $get['telat']; ?>" readonly>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input">Nama Penyewa</label>
                  <div class="col-md-5">
                    <input type="text" id="nama_penyewa" name="nama_penyewa" class="form-control" placeholder="Nama Penyewa" value="<?php echo $get['nama_penyewa']; ?>" readonly>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input">Jasa Supir</label>
                  <div class="col-md-3">
                    <input type="text" id="jasa_supir" name="jasa_supir" class="form-control" placeholder="Jasa Supir" value="<?php echo $get['jasa_supir']; ?>" readonly>
                  </div>
                </div>

                <hr>
                <?php

                ?>
                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input">Jenis Denda</label>
                    <div class="col-md-3">
                      <select type="text" id="jns_denda" name="jns_denda" class="form-control" onchange="tdenda();">
                        <option value="0">-- Jenis Denda --</option>
                        <?php
                            $sql = mysql_query("SELECT * FROM jenis_denda");
                            while ($data = mysql_fetch_array($sql)) {
                              echo "<option value=$data[nominal]>$data[nama_jnsdenda]</option>";
                            }
                        ?>
                      </select>
                    </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input">Total Biaya Telat</label>
                  <div class="col-md-5">
                    <input type="text" id="jml_denda" name="jml_denda" class="form-control" placeholder="Jumlah Biaya Telat" readonly>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input"></label>
                  <div class="col-md-5">
                    <a href="bukden.php" type="reset" class="btn btn-default">BATAL</a>
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
  <!-- Modal -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Pilih Pengembalian</h4>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-lg-12">
              <div class="table-responsive">
              <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                  <tr>
                    <th>No. Kembali</th>
                    <th>Telat</th>
                    <th>Nama Penyewa</th>
                    <th>Jasa Supir</th>
                    <th>Opsi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $get = mysql_query("SELECT a.no_pengembalian, a.telat, d.nama_penyewa, e.jasa_supir FROM pengembalian a JOIN stk b ON a.no_stk = b.no_stk JOIN spsk c ON b.no_spsk = c.no_spsk JOIN penyewa d ON c.id_penyewa = d.id_penyewa JOIN detail_mobil e ON c.no_spsk = e.no_spsk WHERE no_pengembalian NOT IN (SELECT no_pengembalian FROM bukti_denda)");
                  while ($tampil=mysql_fetch_array($get)) {
                  ?>
                  <tr>
                    <td align="center" id='no_pengembalian_<?php echo $tampil['no_pengembalian'];?>'><?php echo $tampil['no_pengembalian']; ?></td>
                    <td align="center" id='telat_<?php echo $tampil['no_pengembalian'];?>'><?php echo $tampil['telat']; ?></td>
                    <td id='nama_penyewa_<?php echo $tampil['no_pengembalian'];?>'><?php echo $tampil['nama_penyewa']; ?></td>
                    <td align="center" id='jasa_supir_<?php echo $tampil['no_pengembalian'];?>'><?php echo $tampil['jasa_supir']; ?></td>
                    <td align="center"><button onclick="pilihPengembalian('<?php echo $tampil['no_pengembalian']; ?>')" class="btn btn-info btn-xs">Pilih</button></td>
                  </tr>
                  <?php } ?>

                </tbody>
              </table>
            </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.col-lg-12 -->
          </div>
        </div>
      </div>
    </div>
  </div>

</div>
  <!-- /#page-wrapper -->

  <!--Code JS Validation-->
  <script language='javascript'>
  function validAngka(a)
  {
    if(!/^[0-9.]+$/.test(a.value))
    {
      a.value = a.value.substring(0,a.value.length-1000);
    }
  }

  //hitung harga sewa, supir, dan lama sewa
  function tdenda(){
      var telat      = parseInt($("#telat").val());
      var jns_denda  = parseInt($("#jns_denda").val());
      var total      = (telat*jns_denda);
      $("#jml_denda").val(total);
  }

  //ambil data dari modal mobil
  function pilihPengembalian(no_pengembalian){
    no_pengembalian = $('#no_pengembalian_'+no_pengembalian).html();
    telat           = $('#telat_'+no_pengembalian).html();
    nama_penyewa    = $('#nama_penyewa_'+no_pengembalian).html();
    jasa_supir      = $('#jasa_supir_'+no_pengembalian).html();
    $('#no_pengembalian').val(no_pengembalian);
    $('#telat').val(telat);
    $('#nama_penyewa').val(nama_penyewa);
    $('#jasa_supir').val(jasa_supir);
    $('#myModal').modal('hide');
  }
  </script>
  <!--End of Code JS Validation-->
