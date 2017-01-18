<?php
include '../koneksi.php';

$tgl    = date('Y-m-d');
function autonumber($tabel, $kolom, $lebar=0, $awalan='')
{
    $query= mysql_query("SELECT no_invoice FROM invoice ORDER BY no_invoice DESC LIMIT 1");
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
  $no_invoice   = $_POST['no_invoice'];
  $tgl_invoice  = $_POST['tgl_invoice'];
  $sisa_bayar   = $_POST['sisa_bayar'];
  $no_spsk      = $_POST['no_spsk'];

  $cekid = mysql_query("SELECT * FROM invoice WHERE no_spsk = '$no_spsk'");
  if (mysql_num_rows($cekid) <> 0) {
    echo "<script>alert('Invoice Sudah di Input!');window.location='tambah-invoice.php';</script>";
  } elseif (empty($no_spsk)) {
    echo "<script>alert('Silahkan isi semua data!');window.location='tambah-invoice.php';</script>";
  } else {
  $simpan = mysql_query("INSERT INTO invoice VALUES('$no_invoice', '$tgl_invoice', '$sisa_bayar', '$no_spsk')");
}

  if ($simpan) {
    echo "<script>alert('Data Invoice Siap di Cetak!');window.location='cetakinvoice.php?no_invoice=$no_invoice';</script>";
  } else {
    echo "<script>alert('Data Invoice Gagal di Cetak!');window.location='tambah-invoice.php';</script>";
  }
}

?>

<div id="page-wrapper">
  <div class='row'>
    <div class='col-lg-12'>
      <h3 class="page-header"><span class="glyphicon glyphicon-file"></span> Form Invoice</h3>
    </div>
  </div>

      <div class="row">
        <div class="col-lg-12">
          <div class="panel panel-default">
            <div class="panel-heading">
              <strong>Tambah Invoice</strong>
            </div>
            <div class="panel-body">
              <div class="row">
                <div class="col-lg-12">
              <form action="tambah-invoice.php" method="POST" enctype="multipart/form-data" class="form-horizontal ">
                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input">No. Invoice</label>
                  <div class="col-md-3">
                    <input type="text" id="text-input" name="no_invoice" class="form-control" value="<?php echo autonumber("db_rentmobil", "no_invoice", 3, "INV") ?>" readonly>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input">Tanggal</label>
                  <div class="col-md-4">
                    <input type="date" id="text-input" name="tgl_invoice" class="form-control" value="<?php echo $tgl; ?>" readonly>
                  </div>
                </div>

                <hr>

                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input">No. SPSK</label>
                  <div class="col-md-3">
                    <input type="text" id="no_spsk" name="no_spsk" class="form-control" placeholder="Nomor SPSK" readonly>
                  </div>
                  <button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal">CARI</button>
                </div>
                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input">Nama Penyewa</label>
                  <div class="col-md-5">
                    <input type="text" id="nama_penyewa" name="nama_penyewa" class="form-control" placeholder="Nama Penyewa" readonly>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input">Total Harga</label>
                  <div class="col-md-5">
                    <input type="text" id="subtotal" name="subtotal" class="form-control" placeholder="Harga Sewa" readonly>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input">Sisa Pembayaran</label>
                  <div class="col-md-5">
                    <input type="text" id="sisa_bayar" name="sisa_bayar" class="form-control" placeholder="Sisa Pembayaran" readonly>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input"></label>
                  <div class="col-md-5">
                    <a href="invoice.php" type="reset" class="btn btn-default">BATAL</a>
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

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
              <thead>
                <tr>
                  <th>No. SPSK</th>
                  <th>Total Harga</th>
                  <th>Sisa Bayar</th>
                  <th>Nama Penyewa</th>
                  <th>Opsi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $get = mysql_query("SELECT * FROM spsk a JOIN penyewa b ON a.id_penyewa = b.id_penyewa WHERE a.jns_bayar='DP' AND no_spsk NOT IN (SELECT no_spsk FROM invoice) ORDER BY no_spsk DESC");
                while ($tampil=mysql_fetch_array($get)) {
                ?>
                <tr>
                  <td id='no_spsk_<?php echo $tampil['no_spsk'];?>'><?php echo $tampil['no_spsk']; ?></td>
                  <td align="center" id='subtotal_<?php echo $tampil['no_spsk'];?>'><?php echo $tampil['subtotal']; ?></td>
                  <td align="center" id='sisa_bayar_<?php echo $tampil['no_spsk'];?>'><?php echo $tampil['jml_bayar']; ?></td>
                  <td id='nama_penyewa_<?php echo $tampil['no_spsk'];?>'><?php echo $tampil['nama_penyewa']; ?></td>
                  <td align="center"><button onclick="pilihSPSK('<?php echo $tampil['no_spsk']; ?>')" class="btn btn-info btn-xs">Pilih</button></td>
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

//ambil data dari modal mobil
function pilihSPSK(no_spsk){
  no_spsk       = $('#no_spsk_'+no_spsk).html();
  subtotal      = $('#subtotal_'+no_spsk).html();
  sisa_bayar    = $('#sisa_bayar_'+no_spsk).html();
  nama_penyewa  = $('#nama_penyewa_'+no_spsk).html();
  $('#no_spsk').val(no_spsk);
  $('#subtotal').val(subtotal);
  $('#sisa_bayar').val(sisa_bayar);
  $('#nama_penyewa').val(nama_penyewa);
  $('#myModal').modal('hide');
}
</script>
<!--End of Code JS Validation-->
