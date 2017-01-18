<?php
include '../koneksi.php';

$tgl    = date('Y-m-d');
function autonumber($tabel, $kolom, $lebar=0, $awalan='')
{
    $query= mysql_query("SELECT no_spk FROM spk ORDER BY no_spk DESC LIMIT 1");
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
  $no_spk   = $_POST['no_spk'];
  $tgl_spk  = $_POST['tgl_spk'];
  $id_supir = $_POST['id_supir'];
  $no_spsk  = $_POST['no_spsk'];
  $id_mobil = $_POST['id_mobil'];

  if (empty($id_supir) || empty($no_spsk)) {
    echo "<script>alert('Silahkan isi semua data!');window.location='tambah-spk.php';</script>";
  } else {
    $simpan = mysql_query("INSERT INTO spk VALUES('$no_spk', '$tgl_spk', '$no_spsk', '$id_supir', '$id_mobil')");
    mysql_query("UPDATE supir SET status='Terpakai' WHERE id_supir='$id_supir'");
  }

  if ($simpan) {
    echo "<script>alert('Data SPK Siap di Cetak!');window.location='cetakspk.php?no_spk=$no_spk';</script>";
  } else {
    echo ";<script>alert('Data SPK Gagal di Cetak!');window.location='tambah-spk.php';</script>";
  }
}

?>
<div id="page-wrapper">
  <div class='row'>
    <div class='col-lg-12'>
      <h3 class="page-header"><span class="glyphicon glyphicon-file"></span> Form Surat Perintah Kerja</h3>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>Tambah SPK</strong>
        </div>
        <div class="panel-body">
          <div class="row">
            <div class="col-lg-12">
              <form action="tambah-spk.php" method="POST" enctype="multipart/form-data" class="form-horizontal ">
                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input">No. SPK</label>
                  <div class="col-md-3">
                    <input type="text" id="no_spk" name="no_spk" class="form-control" placeholder="Nomor SPK" value="<?php echo autonumber("db_rentmobil", "no_spk", 4, "SPK") ?>" readonly>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input">Tanggal</label>
                  <div class="col-md-4">
                    <input type="date" id="tgl_spk" name="tgl_spk" class="form-control" value="<?php echo $tgl; ?>" readonly>
                  </div>
                </div>

                <hr>

                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input">ID Supir</label>
                  <div class="col-md-3">
                    <input type="text" id="id_supir" name="id_supir" class="form-control" placeholder="ID Supir" readonly>
                  </div>
                  <button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal">CARI</button>
                </div>
                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input">Nama Supir</label>
                  <div class="col-md-5">
                    <input type="text" id="nama_supir" name="nama_supir" class="form-control" placeholder="Nama Supir" readonly>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input">Alamat</label>
                  <div class="col-md-6">
                    <textarea rows="3" type="text" id="alamat_supir" name="alamat_supir" class="form-control" placeholder="Alamat" readonly></textarea>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input">No. Telp</label>
                  <div class="col-md-3">
                    <input type="text" id="telp_supir" name="telp_supir" class="form-control" placeholder="Nomor Telepon" onkeyup="validAngka(this)" readonly>
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
                    <a href="spk.php" type="reset" class="btn btn-default">BATAL</a>
                    <button type="submit" name="submit" class="btn btn-primary">CETAK</button>
                  </div>
                </div>
              </form>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Supir -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Pilih Supir</h4>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-lg-12">
              <div class="table-responsive">
              <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>No. Telp</th>
                    <th>Status</th>
                    <th>Opsi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $get = mysql_query("SELECT * FROM supir WHERE status='Tersedia'");
                  while ($tampil=mysql_fetch_array($get)) {
                  ?>
                  <tr>
                    <td id='id_supir_<?php echo $tampil['id_supir'];?>'><?php echo $tampil['id_supir']; ?></td>
                    <td id='nama_supir_<?php echo $tampil['id_supir'];?>'><?php echo $tampil['nama_supir']; ?></td>
                    <td id='alamat_supir_<?php echo $tampil['id_supir'];?>'><?php echo $tampil['alamat_supir']; ?></td>
                    <td align="center" id='telp_supir_<?php echo $tampil['id_supir'];?>'><?php echo $tampil['telp_supir']; ?></td>
                    <td align="center"><?php echo $tampil['status']; ?></td>
                    <td align="center"><button onclick="pilihSUPIR('<?php echo $tampil['id_supir']; ?>')" class="btn btn-info btn-xs">Pilih</button></td>
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
                $get = mysql_query("SELECT a.no_spsk, a.lama_sewa, c.id_mobil, b.nama_penyewa FROM spsk a JOIN penyewa b ON a.id_penyewa = b.id_penyewa JOIN detail_mobil c ON a.no_spsk = c.no_spsk JOIN mobil d ON c.id_mobil = d.id_mobil WHERE c.jasa_supir='Ya' ORDER BY a.no_spsk DESC");
                while ($tampil=mysql_fetch_array($get)) {
                ?>
                <tr>
                  <td id='no_spsk_<?php echo $tampil['id_mobil'];?>'><?php echo $tampil['no_spsk']; ?></td>
                  <td align="center" id='lama_sewa_<?php echo $tampil['id_mobil'];?>'><?php echo $tampil['lama_sewa']; ?> hari</td>
                  <td id='id_mobil_<?php echo $tampil['id_mobil'];?>'><?php echo $tampil['id_mobil']; ?></td>
                  <td id='nama_penyewa_<?php echo $tampil['id_mobil'];?>'><?php echo $tampil['nama_penyewa']; ?></td>
                  <td align="center"><button onclick="pilihSPSK('<?php echo $tampil['id_mobil']; ?>')" class="btn btn-info btn-xs">Pilih</button></td>
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

  //ambil data dari modal supir
  function pilihSUPIR(id_supir){
    id_supir    = $('#id_supir_'+id_supir).html();
    nama_supir  = $('#nama_supir_'+id_supir).html();
    alamat_supir= $('#alamat_supir_'+id_supir).html();
    telp_supir  = $('#telp_supir_'+id_supir).html();
    $('#id_supir').val(id_supir);
    $('#nama_supir').val(nama_supir);
    $('#alamat_supir').val(alamat_supir);
    $('#telp_supir').val(telp_supir);
    $('#myModal').modal('hide');
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
  </script>
  <!--End of Code JS Validation-->
