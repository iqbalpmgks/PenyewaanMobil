<?php
include '../koneksi.php';
date_default_timezone_set("Asia/Bangkok");
$tgl    = date('d-m-Y');

function autonumber($tabel, $kolom, $lebar=0, $awalan='')
{
    $query= mysql_query("SELECT no_pengembalian FROM pengembalian ORDER BY no_pengembalian DESC LIMIT 1");
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
    echo "<script>alert('Perlengkapan Sudah Dipesan!');window.location='tambah-pengembalian.php';</script>";
  } elseif (empty($id_perkap) || empty($kondisi)) {
    echo "<script>alert('Silahkan isi semua data!');window.location='tambah-pengembalian.php';</script>";
  } else {
  $tambah = mysql_query("INSERT INTO temp_kondisi VALUES('$id_perkap', '$nama_perkap', '$kondisi', '$keterangan')");
  }
}

if (isset($_POST['submit'])) {
  $getidperkap     = mysql_fetch_array(mysql_query("SELECT id_perkap FROM temp_kondisi"));
  $getnmperkap     = mysql_fetch_array(mysql_query("SELECT nama_perkap FROM temp_kondisi"));
  $getkondisi      = mysql_fetch_array(mysql_query("SELECT kondisi FROM temp_kondisi"));
  $getketerangan   = mysql_fetch_array(mysql_query("SELECT keterangan FROM temp_kondisi"));
  $id_perkap       = $getidperkap['id_perkap'];
  $nama_perkap     = $getnmperkap['nama_perkap'];
  $kondisi         = $getkondisi['kondisi_masuk'];
  $keterangan      = $getketerangan['keterangan'];
  $no_pengembalian = $_POST['no_pengembalian'];
  $tgl_pengembalian= $_POST['tgl_pengembalian'];
  $no_stk          = $_POST['no_stk'];
  $tgl_mulai       = $_POST['tgl_mulai'];
  $tgl_selesai     = $_POST['tgl_selesai'];
  $jam_keluar      = $_POST['jam_keluar'];
  $id_mobil        = $_POST['id_mobil'];
  $jasa_supir      = $_POST['jasa_supir'];
  $pemeriksa_masuk = ucwords($_POST['pemeriksa_masuk']);

  $cekid = mysql_query("SELECT * FROM pengembalian WHERE no_stk='$no_stk'");
  if (mysql_num_rows($cekid) <> 0) {
    echo "<script>alert('Pengembalian Sudah di Input!');window.location='tambah-pengembalian.php';</script>";
  } elseif (empty($no_stk) || empty($id_perkap)) { // Jika nomor STK atau id Perkap kosong
    echo "<script>alert('Silahkan isi semua data!');window.location='tambah-pengembalian.php';</script>";
  }

  //cek kondisi tanggal
  if(date("Y-m-d") >= date("Y-m-d", strtotime($tgl_selesai))){ // Jika tanggal sekarang lebih besar sama dengan tanggal pengembalian
    $pengembalian = date("Y-m-d H:i:s", strtotime($tgl_selesai." ".$jam_keluar)); // inisialiasi dengan waktu
    $tgl_skrg = date("Y-m-d H:i:s"); // inisialisasi dengan waktu
    if($tgl_skrg > $pengembalian){ // jika tanggal&waktu sekarang lebih besar dari tanggal&waktu pengembalian
      $from_time = strtotime($tgl_skrg);
      $to_time = strtotime($pengembalian);
      $tot = round(abs($from_time - $to_time) / 60,2);
      $tot2 =  round($tot/ 60);
      if($tot > $tot2){ // pembulatan jam
        $tot2 = $tot2+1;
      }
      $tglkembali = date("Y-m-d", strtotime($tgl_pengembalian)); // inisialisasi timecurrent db
      $dt_current = date("Y-m-d H:i:s"); // inisialisasi timecurrent db
      // Kondisi Jika Kena Denda
        $simpan = mysql_query("INSERT INTO pengembalian VALUES ('$no_pengembalian', '$tglkembali', '$dt_current', '$tot2', '$pemeriksa_masuk', '$no_stk')");
        if ($simpan) {
        $simdet = mysql_query("SELECT * FROM temp_kondisi");
        while ($r=mysql_fetch_row($simdet)) {
          mysql_query("UPDATE mobil SET status='Tersedia' WHERE id_mobil='$id_mobil'");
          mysql_query("INSERT INTO periksa_masuk VALUES ('$no_pengembalian', '$r[0]', '$r[2]', '$r[3]')");
        }
        mysql_query("TRUNCATE TABLE temp_kondisi");
        echo "<script>alert('Maaf, Pengembalian Melebihi Waktu. Silahkan Membayar Denda!');window.location='tambah-bukden.php?no_pengembalian=$no_pengembalian';</script>";
        } else {
          echo "<script>alert('Data Gagal di Simpan!');window.location='tambah-pengembalian.php';</script>";
        }
    }else{
      //Kondisi Jika Tepat Waktu
      $simpan = mysql_query("INSERT INTO pengembalian VALUES ('$no_pengembalian', '$tglkembali', '$dt_current', 0, '$pemeriksa_masuk', '$no_stk')"); //Kondisi Jam Tepat waktu
      if ($simpan) {
      $simdet = mysql_query("SELECT * FROM temp_kondisi");
      while ($r=mysql_fetch_row($simdet)) {
        mysql_query("UPDATE mobil SET status='Tersedia' WHERE id_mobil='$id_mobil'");
        mysql_query("INSERT INTO periksa_masuk VALUES ('$no_pengembalian', '$r[0]', '$r[2]', '$r[3]')");
      }
      mysql_query("TRUNCATE TABLE temp_kondisi");
      echo "<script>alert('Data Berhasil di Simpan!');window.location='pengembalian.php';</script>";
      } else {
        echo "<script>alert('Data Gagal di Simpan!');window.location='tambah-pengembalian.php';</script>";
      }
    }
  }else{
    //Kondisi Jika Tanggal Kurang dari Tanggal Pengembalian
    $simpan = mysql_query("INSERT INTO pengembalian VALUES ('$no_pengembalian', '$tglkembali', '$dt_current', 0, '$pemeriksa_masuk', '$no_stk')"); //Kondisi Tgl kurang dari tgl pengembalian
    if ($simpan) {
    $simdet = mysql_query("SELECT * FROM temp_kondisi");
    while ($r=mysql_fetch_row($simdet)) {
      mysql_query("UPDATE mobil SET status='Tersedia' WHERE id_mobil='$id_mobil'");
      mysql_query("INSERT INTO periksa_masuk VALUES ('$no_pengembalian', '$r[0]', '$r[2]', '$r[3]')");
    }
    mysql_query("TRUNCATE TABLE temp_kondisi");
    echo "<script>alert('Data Berhasil di Simpan!');window.location='pengembalian.php';</script>";
    } else {
      echo "<script>alert('Data Gagal di Simpan!');window.location='tambah-pengembalian.php';</script>";
    }
  }

}

?>
<div id="page-wrapper">
  <div class='row'>
    <div class='col-lg-12'>
      <h3 class="page-header"><span class="glyphicon glyphicon-file"></span> Form Pengembalian</h3>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>Tambah Kembalian</strong>
        </div>
        <div class="panel-body">
          <div class="row">
            <div class="col-lg-12">
              <form action="tambah-pengembalian.php" method="POST" enctype="multipart/form-data" class="form-horizontal" id="form-perkap">
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
                    <textarea type="text" id="keterangan" name="keterangan" class="form-control" placeholder="Keterangan" maxlength="15"></textarea>
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
                      <th>Kondisi Masuk</th>
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

              <form action="#" method="POST" enctype="multipart/form-data" class="form-horizontal ">
                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input">No. Pengembalian</label>
                  <div class="col-md-3">
                    <input type="text" id="no_pengembalian" name="no_pengembalian" class="form-control" placeholder="Nomor Pengembalian" value="<?php echo autonumber("db_rentmobil", "no_pengembalian", 4, "PNG") ?>" readonly>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input">Tanggal</label>
                  <div class="col-md-4">
                    <input type="text" id="tgl_pengembalian" name="tgl_pengembalian" class="form-control" value="<?php echo $tgl; ?>" readonly>
                  </div>
                </div>

                <hr>

                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input">No. STK</label>
                  <div class="col-md-3">
                    <input type="text" id="no_stk" name="no_stk" class="form-control" placeholder="Nomor STK" readonly>
                  </div>
                  <button type="button" class="btn btn-default" data-toggle="modal" data-target="#ModalSTK">CARI</button>
                </div>
                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input">Tanggal Pinjam</label>
                  <div class="col-md-4">
                    <input type="text" id="tgl_mulai" name="tgl_mulai" class="form-control" placeholder="Tanggal Pinjam" readonly>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input">Tanggal Kembali</label>
                  <div class="col-md-4">
                    <input type="text" id="tgl_selesai" name="tgl_selesai" class="form-control" placeholder="Tanggal kembali" readonly>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input">Jam Keluar</label>
                  <div class="col-md-2">
                    <input type="text" id="jam_keluar" name="jam_keluar" class="form-control" placeholder="Jam Keluar" readonly>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input">ID Mobil</label>
                  <div class="col-md-3">
                    <input type="text" id="id_mobil" name="id_mobil" class="form-control" placeholder="ID Mobil" readonly>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input">Jasa Supir</label>
                  <div class="col-md-2">
                    <input type="text" id="jasa_supir" name="jasa_supir" class="form-control" placeholder="Jasa Supir" readonly>
                  </div>
                </div>

                <hr>

                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input">Pemeriksa</label>
                  <div class="col-md-5">
                    <input type="text" id="pemeriksa_masuk" name="pemeriksa_masuk" class="form-control" placeholder="Pemeriksa" maxlength="25" onkeyup="validHuruf(this)" required>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input"></label>
                  <div class="col-md-5">
                    <a href="pengembalian.php" type="reset" class="btn btn-default">BATAL</a>
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

  <!-- Modal STK -->
  <div class="modal fade" id="ModalSTK" tabindex="-1" role="dialog" aria-labelledby="ModalSTKLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Pilih STK</h4>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-lg-12">
              <div class="table-responsive">
              <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-stk">
                <thead>
                  <tr>
                    <th>No. STK</th>
                    <th>Tanggal Keluar</th>
                    <th>Tanggal Kembali</th>
                    <th>Jam Keluar</th>
                    <th>ID Mobil</th>
                    <th>Jasa Supir</th>
                    <th>Opsi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $get = mysql_query("SELECT a.id_mobil, a.no_stk, a.no_spsk, b.tgl_mulai, b.tgl_selesai, b.jam_keluar, f.jasa_supir, g.merk, g.no_pol, g.warna, a.tgl_stk, a.pemeriksa_keluar, c.nama_penyewa, c.telp_penyewa, b.lama_sewa FROM stk a JOIN spsk b ON a.no_spsk = b.no_spsk JOIN penyewa c ON b.id_penyewa = c.id_penyewa JOIN periksa_keluar d ON a.no_stk = d.no_stk JOIN perlengkapan e ON d.id_perkap = e.id_perkap JOIN detail_mobil f ON b.no_spsk = f.no_spsk JOIN mobil g ON f.id_mobil = g.id_mobil WHERE a.no_stk NOT IN (SELECT no_stk FROM pengembalian) GROUP BY a.id_mobil");
                  while ($tampil=mysql_fetch_array($get)) {
                  ?>
                  <tr>
                    <?php
                      $tgl_mulai   = date_create($tampil['tgl_mulai']);
                      $tgl_selesai = date_create($tampil['tgl_selesai']);
                      $jam         = date_create($tampil['jam_keluar']);
                      $tglmulai    = date_format($tgl_mulai, 'd-m-Y');
                      $tglselesai  = date_format($tgl_selesai, 'd-m-Y');
                      $jamkeluar   = date_format($jam, 'H:i');
                    ?>
                    <td id='no_stk_<?php echo $tampil['no_stk'];?>'><?php echo $tampil['no_stk']; ?></td>
                    <td id='tgl_mulai_<?php echo $tampil['no_stk'];?>'><?php echo $tglmulai; ?></td>
                    <td id='tgl_selesai_<?php echo $tampil['no_stk'];?>'><?php echo $tglselesai; ?></td>
                    <td align="center" id='jam_keluar_<?php echo $tampil['no_stk'];?>'><?php echo $jamkeluar; ?></td>
                    <td id='id_mobil_<?php echo $tampil['no_stk'];?>'><?php echo $tampil['id_mobil']; ?></td>
                    <td id='jasa_supir_<?php echo $tampil['no_stk'];?>'><?php echo $tampil['jasa_supir']; ?></td>
                    <td align="center"><button onclick="pilihSTK('<?php echo $tampil['no_stk']; ?>')" class="btn btn-info btn-xs">Pilih</button></td>
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
  <script language='javascript'>
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

  //ambil data dari modal stk
  function pilihSTK(no_stk) {
    no_stk      = $('#no_stk_'+no_stk).html();
    tgl_mulai   = $('#tgl_mulai_'+no_stk).html();
    tgl_selesai = $('#tgl_selesai_'+no_stk).html();
    jam_keluar  = $('#jam_keluar_'+no_stk).html();
    id_mobil    = $('#id_mobil_'+no_stk).html();
    jasa_supir  = $('#jasa_supir_'+no_stk).html();
    $('#no_stk').val(no_stk);
    $('#tgl_mulai').val(tgl_mulai);
    $('#tgl_selesai').val(tgl_selesai);
    $('#jam_keluar').val(jam_keluar);
    $('#id_mobil').val(id_mobil);
    $('#jasa_supir').val(jasa_supir);
    $('#ModalSTK').modal('hide');
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
