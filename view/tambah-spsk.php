<?php
include '../koneksi.php';

$tgl    = date('Y-m-d');
function autonumber($tabel, $kolom, $lebar=0, $awalan='')
{
    $query= mysql_query("SELECT no_spsk FROM spsk ORDER BY no_spsk DESC LIMIT 1");
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

//hapus mobil dari temp_spsk
$id_mobil = $_GET['id_mobil'];
mysql_query("DELETE FROM temp_spsk WHERE id_mobil='$id_mobil'");
//menambahkan mobil ke dalam temp_spsk
if (isset($_POST['tambah'])) {
  $id_mobil   = $_POST['id_mobil'];
  $no_pol     = $_POST['no_pol'];
  $merk       = $_POST['merk'];
  $warna      = $_POST['warna'];
  $harga      = $_POST['harga'];
  $jasa_supir = $_POST['jasa_supir'];
  $total_harga= $_POST['total_harga'];

  $cekid = mysql_query("SELECT * FROM temp_spsk WHERE id_mobil = '$id_mobil'"); //cek mobil di temp_spsk
  if (mysql_num_rows($cekid) <> 0) {
    echo "<script>alert('Mobil Sudah Dipesan!');window.location='tambah-spsk.php';</script>";
  } elseif (empty($id_mobil) && empty($jasa_supir) && empty($total_harga)) { //tidak boleh kosong
    echo "<script>alert('Silahkan isi semua data!');window.location='tambah-spsk.php';</script>";
  } else {
  $tambah   = mysql_query("INSERT INTO temp_spsk VALUES('$id_mobil', '$no_pol', '$merk', '$warna', '$harga', '$jasa_supir', '$total_harga')");
}
}

if (isset($_POST['submit'])) {
  $getmob     = mysql_fetch_array(mysql_query("SELECT id_mobil FROM temp_spsk"));
  $getharga   = mysql_fetch_array(mysql_query("SELECT harga FROM temp_spsk"));
  $gettot     = mysql_fetch_array(mysql_query("SELECT SUM(total_harga) AS subtotal FROM temp_spsk"));
  $id_mobil   = $getmob['id_mobil'];
  $harga      = $getharga['harga'];
  $no_spsk    = $_POST['no_spsk'];
  $tgl_spsk   = $_POST['tgl_spsk'];
  $id_penyewa = $_POST['id_penyewa'];
  $tgl_mulai  = $_POST['tgl_mulai'];
  $tgl_selesai= $_POST['tgl_selesai'];
  $lama_sewa  = $_POST['lama_sewa'];
  $jam_keluar = $_POST['jam_keluar'];
  $subtotal   = $gettot['subtotal'];
  $jns_bayar  = $_POST['jns_bayar'];
  $jml_bayar  = $_POST['jml_bayar'];
  $lokasi     = ucwords($_POST['lokasi']);
  $jaminan    = ucwords($_POST['jaminan']);

  $jnsb = "";
  if($jns_bayar == 1){
    $jnsb = "DP";
  }elseif ($jns_bayar == 2) {
    $jnsb = "LUNAS";
  } else {
    $jnsb = "-";
  }
  // $jnsb = "Jenis Bayar";

  if (empty($id_mobil) || empty($id_penyewa)) {
    echo "<script>alert('Silahkan isi semua data!');window.location:'tambah-spsk.php';</script>";
  } else {
    $simpan   = mysql_query("INSERT INTO spsk VALUES ('$no_spsk', '$tgl_spsk', '$lama_sewa', '$tgl_mulai', '$tgl_selesai', '$jam_keluar', '$subtotal', '$jnsb', '$jml_bayar', '$lokasi', '$jaminan', '$id_penyewa')");
  }

  if ($simpan) {
    $simdet  = mysql_query("SELECT * FROM temp_spsk");
    while ($r=mysql_fetch_row($simdet)) {
      $a = "";
      if($r[5] != 0){
        $a = "Ya";
      }else{
        $a = "Tidak";
      }
      mysql_query("UPDATE mobil SET status='Terpakai' WHERE id_mobil='$r[0]'");
      mysql_query("INSERT INTO detail_mobil VALUES ('$no_spsk','$r[0]','$r[4]','$a', '$r[7]')");
    }
    mysql_query("TRUNCATE TABLE temp_spsk");
    echo "<script>alert('Data SPSK Siap di Cetak!');window.location='cetakspsk.php?no_spsk=$no_spsk';</script>";
  } else {
    echo "<script>alert('Data GAGAL di Simpan!');window.location='tambah-spsk.php';</script>";
  }
}

?>

<div id="page-wrapper">
  <div class='row'>
    <div class='col-lg-12'>
      <h3 class="page-header"><span class="glyphicon glyphicon-file"></span> Form Surat Perjanjian Sewa Kendaraan (SPSK)</h3>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>Tambah SPSK</strong>
        </div>
        <div class="panel-body">
          <div class="row">
            <div class="col-lg-12">
              <form action="tambah-spsk.php" method="POST" enctype="multipart/form-data" class="form-horizontal ">
                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input">ID Mobil</label>
                  <div class="col-md-3">
                    <input type="text" id="id_mobil" name="id_mobil" class="form-control" placeholder="ID Mobil" readonly>
                  </div>
                  <button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal">CARI</button>
                </div>
                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input">Merk/Type</label>
                  <div class="col-md-5">
                    <input type="text" id="merk" name="merk" class="form-control" placeholder="Merk/Type Mobil" readonly>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input">No. Polisi</label>
                  <div class="col-md-3">
                    <input type="text" id="no_pol" name="no_pol" class="form-control" placeholder="No. Polisi" readonly>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input">Warna</label>
                  <div class="col-md-4">
                    <input type="text" id="warna" name="warna" class="form-control" placeholder="Warna" readonly>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input">Harga Sewa</label>
                  <div class="col-md-5">
                    <input type="text" id="harga" name="harga" class="form-control" placeholder="Harga Sewa" readonly>
                  </div>
                </div>

                <?php
                  $tarif = mysql_fetch_array(mysql_query("SELECT tarif FROM supir"));
                ?>
                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input">Jasa Supir</label>
                    <div class="col-md-3">
                      <select type="text" id="jasa_supir" name="jasa_supir" class="form-control" onchange="tharga();" required>
                        <option value="0">-- Pakai Jasa Supir --</option>
                        <option value="<?php echo $tarif['tarif']; ?>">Ya</option>
                        <option value="0">Tidak</option>
                      </select>
                    </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input">Total Harga</label>
                  <div class="col-md-5">
                    <input type="text" id="total_harga" name="total_harga" class="form-control" placeholder="Total Harga" readonly required>
                  </div>
                  <button name="tambah" type="submit" id="tambah" class="btn btn-default">TAMBAH</button>
                </div>

                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input"></label>
                <div class="col-md-10 table-responsive">
                  <table class="table">
                    <tr>
                      <th>No.</th>
                      <th>ID Mobil</th>
                      <th>Merk</th>
                      <th>No. Polisi</th>
                      <th>Warna</th>
                      <th>Harga</th>
                      <th>Jasa Supir</th>
                      <th>Total harga</th>
                      <th>Opsi</th>
                    </tr>
                    <tr>
                      <?php
                      $no = 1;
                      $get = mysql_query("SELECT * FROM temp_spsk");
                      while ($tampil=mysql_fetch_array($get)) {
                      ?>
                      <td><?php echo $no++; ?></td>
                      <td><?php echo $tampil['id_mobil']; ?></td>
                      <td><?php echo $tampil['merk']; ?></td>
                      <td><?php echo $tampil['no_pol']; ?></td>
                      <td><?php echo $tampil['warna']; ?></td>
                      <td><?php echo $tampil['harga']; ?></td>
                      <td><?php echo $tampil['jasa_supir']; ?></td>
                      <td><?php echo $tampil['total_harga']; ?></td>
                      <td><a onclick="{ location.href='tambah-spsk.php?id_mobil=<?php echo $tampil['id_mobil']; ?>' }" class="btn btn-danger btn-xs">Hapus</a></td>
                    </tr>
                    <?php } ?>
                  </table>
                </div>
              </div>
              </form>

              <!-- Modal -->
              <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="myModalLabel">Pilih Mobil</h4>
                    </div>
                    <div class="modal-body">
                      <div class="row">
                        <div class="col-lg-12">
                          <div class="table-responsive">
                          <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                              <tr>
                                <th>ID</th>
                                <th>Merk</th>
                                <th>Plat</th>
                                <th>Warna</th>
                                <th>Harga</th>
                                <th>Status</th>
                                <th>Opsi</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php
                              $get = mysql_query("SELECT * FROM mobil WHERE status='Tersedia' AND id_mobil NOT IN (SELECT id_mobil FROM temp_spsk)");
                              while ($tampil=mysql_fetch_array($get)) {
                              ?>
                              <tr>
                                <td id='id_mobil_<?php echo $tampil['id_mobil'];?>'><?php echo $tampil['id_mobil']; ?></td>
                                <td id='merk_<?php echo $tampil['id_mobil'];?>'><?php echo $tampil['merk']; ?></td>
                                <td id='no_pol_<?php echo $tampil['id_mobil'];?>'><?php echo $tampil['no_pol']; ?></td>
                                <td id='warna_<?php echo $tampil['id_mobil'];?>'><?php echo $tampil['warna']; ?></td>
                                <td id='harga_<?php echo $tampil['id_mobil'];?>'><?php echo $tampil['harga']; ?></td>
                                <td id='status_<?php echo $tampil['id_mobil'];?>'><?php echo $tampil['status']; ?></td>
                                <td><button onclick="pilihMobil('<?php echo $tampil['id_mobil']; ?>')" class="btn btn-info btn-xs">Pilih Mobil</button></td>
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

              <hr>

              <form action="tambah-spsk.php" method="POST" enctype="multipart/form-data" class="form-horizontal ">
                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input">No. SPSK</label>
                  <div class="col-md-3">
                    <input type="text" id="no_spsk" name="no_spsk" class="form-control" placeholder="No. SPSK" value="<?php echo autonumber("db_rentmobil", "no_spsk", 4, "SPSK") ?>" readonly>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input">Tanggal</label>
                  <div class="col-md-4">
                    <input type="date" id="tgl_spsk" name="tgl_spsk" class="form-control" value="<?php echo $tgl; ?>" readonly>
                  </div>
                </div>

                <hr>

                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input">ID Penyewa</label>
                  <div class="col-md-3">
                    <input type="text" id="id_penyewa" name="id_penyewa" class="form-control" placeholder="ID Penyewa" readonly>
                  </div>
                  <button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal2">CARI</button>
                </div>
                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input">Nama Penyewa</label>
                  <div class="col-md-5">
                    <input type="text" id="nama_penyewa" name="nama_penyewa" class="form-control" placeholder="Nama Penyewa" readonly>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input">No. KTP/SIM</label>
                  <div class="col-md-5">
                    <input type="text" id="no_ktpsim" name="no_ktpsim" class="form-control" placeholder="Nomor KTP/SIM" onkeyup="validAngka(this)" readonly>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input">Alamat</label>
                  <div class="col-md-6">
                    <textarea rows="3" type="text" id="alamat_penyewa" name="alamat_penyewa" class="form-control" placeholder="Alamat" readonly></textarea>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input">No. Telp</label>
                  <div class="col-md-3">
                    <input type="text" id="telp_penyewa" name="telp_penyewa" class="form-control" placeholder="Nomor Telepon" onkeyup="validAngka(this)" readonly>
                  </div>
                </div>

                <hr>

                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input">Tanggal Pinjam</label>
                  <div class="col-md-4">
                    <input type="date" id="tgl_mulai" name="tgl_mulai" class="form-control" required>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input">Tanggal Kembali</label>
                  <div class="col-md-4">
                    <input type="date" id="tgl_selesai" name="tgl_selesai" class="form-control" onchange="total_hari();" required>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input">Lama Sewa</label>
                  <div class="col-md-2">
                    <input type="text" id="lama_sewa" name="lama_sewa" class="form-control" readonly="">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input">Jam Keluar</label>
                  <div class="col-md-2">
                    <input type="time" id="jam_keluar" name="jam_keluar" class="form-control" required>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input">Sub Total</label>
                  <div class="col-md-5">
                    <input type="text" id="subtotal" name="subtotal" class="form-control" placeholder="Sub Total" readonly>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input">Jenis Bayar</label>
                  <div class="col-md-2">
                    <select id="jns_bayar" name="jns_bayar" class="form-control" onchange="bayar();">
                      <option value="0">Jenis Bayar</option>
                      <option value="1">DP</option>
                      <option value="2">LUNAS</option>
                    </select>
                  </div>
                  <div class="col-md-4">
                    <input type="text" id="jml_bayar" name="jml_bayar" class="form-control" placeholder="Jumlah Bayar" readonly>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input">Lokasi Terima</label>
                  <div class="col-md-6">
                    <textarea rows="3" type="text" id="lokasi" name="lokasi" class="form-control" placeholder="Lokasi Serah Terima" maxlength="30" required></textarea>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input">Jaminan</label>
                  <div class="col-md-4">
                    <input type="text" id="jaminan" name="jaminan" class="form-control" placeholder="Jaminan Sewa" maxlength="30" required>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input"></label>
                  <div class="col-md-5">
                    <a href="spsk.php" type="reset" class="btn btn-default">BATAL</a>
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

  <!-- Modal Penyewa -->
  <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Modal title</h4>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-lg-12">
              <div class="table-responsive">
              <table class="table table-striped table-bordered table-hover" id="dataTablesPenyewa">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>No. KTP/SIM</th>
                    <th>Alamat</th>
                    <th>No. Telp</th>
                    <th>Opsi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $get = mysql_query("SELECT * FROM penyewa");
                  while ($tampil=mysql_fetch_array($get)) {
                  ?>
                  <tr>
                    <td id='id_penyewa_<?php echo $tampil['id_penyewa'];?>'><?php echo $tampil['id_penyewa']; ?></td>
                    <td id='nama_penyewa_<?php echo $tampil['id_penyewa'];?>'><?php echo $tampil['nama_penyewa']; ?></td>
                    <td id='no_ktpsim_<?php echo $tampil['id_penyewa'];?>'><?php echo $tampil['no_ktpsim']; ?></td>
                    <td id='alamat_penyewa_<?php echo $tampil['id_penyewa'];?>'><?php echo $tampil['alamat_penyewa']; ?></td>
                    <td id='telp_penyewa_<?php echo $tampil['id_penyewa'];?>'><?php echo $tampil['telp_penyewa']; ?></td>
                    <td><button onclick="pilihPenyewa('<?php echo $tampil['id_penyewa']; ?>')" class="btn btn-info btn-xs">Pilih</button></td>
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
  <!-- /#page-wrapper -->

  <?php
  $subtotal = mysql_fetch_array(mysql_query("SELECT SUM(total_harga) as jml FROM temp_spsk"));
  ?>

  <!--Code JS Validation-->
  <script language='javascript'>
  function validAngka(a)
  {
    if(!/^[0-9.]+$/.test(a.value))
    {
      a.value = a.value.substring(0,a.value.length-1000);
    }
  }

  //hitung untuk jenis bayar
  function bayar(){
      jns_bayar = $('#jns_bayar').val();
      jml_bayar = $('#jml_bayar').html();
      total_harga = $('#subtotal').val();
      total_bayar = 0;
      if(jns_bayar == 1){
        total_bayar = total_harga * 0.5;
      }else if(jns_bayar == 2){
        total_bayar = total_harga;
      }
      $('#jml_bayar').val(total_bayar);
  }

  //hitung harga sewa, supir, dan lama sewa
  function tharga(){
      var harga      = parseInt($("#harga").val());
      var jasa_supir = parseInt($("#jasa_supir").val());
      var total      = (harga+jasa_supir);
      $("#total_harga").val(total);
  }

  //fungsi lama sewa dari tanggal
  function total_hari(){
	    date_1 = $('#tgl_mulai').val();
	    date_2 = $('#tgl_selesai').val();
			var date1 = new Date(date_1);
			var date2 = new Date(date_2);
			var timeDiff = Math.abs(date2.getTime() - date1.getTime());
			var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));
      // if(diffDays == 0){
      //   diffDays = 1;
      // }
			var x = diffDays * parseInt('<?php echo $subtotal['jml']; ?>');
      $('#lama_sewa').val(diffDays);
	    $('#subtotal').val(x);
	}

  //ambil data dari modal mobil
  function pilihMobil(id_mobil){
  	id_mobil = $('#id_mobil_'+id_mobil).html();
  	merk     = $('#merk_'+id_mobil).html();
  	no_pol   = $('#no_pol_'+id_mobil).html();
    warna    = $('#warna_'+id_mobil).html();
    harga    = $('#harga_'+id_mobil).html();
    status   = $('#status_'+id_mobil).html();
  	$('#id_mobil').val(id_mobil);
  	$('#merk').val(merk);
  	$('#no_pol').val(no_pol);
    $('#warna').val(warna);
    $('#harga').val(harga);
    $('#status').val(status);
    $('#myModal').modal('hide');
  }

  //ambil data dari modal penyewa
  function pilihPenyewa(id_penyewa){
    id_penyewa    = $('#id_penyewa_'+id_penyewa).html();
    nama_penyewa  = $('#nama_penyewa_'+id_penyewa).html();
    no_ktpsim     = $('#no_ktpsim_'+id_penyewa).html();
    alamat_penyewa= $('#alamat_penyewa_'+id_penyewa).html();
    telp_penyewa  = $('#telp_penyewa_'+id_penyewa).html();
    $('#id_penyewa').val(id_penyewa);
    $('#nama_penyewa').val(nama_penyewa);
    $('#no_ktpsim').val(no_ktpsim);
    $('#alamat_penyewa').val(alamat_penyewa);
    $('#telp_penyewa').val(telp_penyewa);
    $('#myModal2').modal('hide');
  }
  </script>
  <!--End of Code JS Validation-->
