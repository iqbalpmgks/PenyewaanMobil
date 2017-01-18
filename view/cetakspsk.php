<?php
include '../koneksi.php';
$tgl    = date('d-m-Y');

?>
<div id="page-wrapper">
  <div class='row'>
    <div class='col-lg-12'>
      <h3 class="page-header">
        <a class="btn btn-defaul" href="spsk.php">Kembali</a>
        <a class="btn btn-default no-print" href="javascript:printDiv('area-1');">Print</a>
      </h3>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-12">
      <div id="area-1">
        <div>
          <div align="center">
            <img src="../img/cop.jpg" width="400px" alt="Logo Artha Laras"/>
          <hr>
          </br>
            <!-- Jl. Dr. Ciptomangunkusumo, No. 11, Ciledug - Tangerang 15153,<br>
            Telp: 021-7319980 / 0812-1341-1361 <br><br> -->
          </div>
          <div align="center">
            <b>SURAT PERJANJIAN SEWA KENDARAAN</b>
          </div>
        </div>
      </br>
    </br>

    <?php
    $no = 1;
    $no_spsk = $_GET['no_spsk'];
    $get     = mysql_query("SELECT * FROM spsk a JOIN penyewa b ON a.id_penyewa = b.id_penyewa JOIN detail_mobil c ON a.no_spsk = c.no_spsk JOIN mobil d ON c.id_mobil = d.id_mobil WHERE c.no_spsk='$no_spsk'");
    while ($tampil=mysql_fetch_array($get)) {
    ?>

<div>
  <table border="0" width="100%" cellspacing="0">
    <tr>
      <td><b>No. SPSK</b> </td>
      <td>:</td>
      <td><?php echo $tampil['no_spsk']; ?></td>
      <td><b>Lama Sewa</b> </td>
      <td>:</td>
      <td><?php echo $tampil['lama_sewa']; ?> hari</td>
    </tr>
    <tr>
      <td ><b>Tanggal</b> </td>
      <td>:</td>
      <td><?php echo $tampil['tgl_spsk']; ?></td>
      <td><b>Dari Tanggal</b></td>
      <td>:</td>
      <td><?php echo $tampil['tgl_mulai']; ?></td>
    </tr>

    <tr>
      <td></td>
      <td></td>
      <td></td>
      <td><b>Sampai Tanggal</b></td>
      <td>:</td>
      <td><?php echo $tampil['tgl_selesai']; ?></td>
    </tr>
    <tr>
      <td><b>Nama Penyewa</b></td>
      <td>:</td>
      <td><?php echo $tampil['nama_penyewa']; ?></td>
      <td><b>Jam Keluar</b></td>
      <td>:</td>
      <td><?php echo $tampil['jam_keluar']; ?></td>
    </tr>
    <tr>
      <td><b>No. KTP/SIM</b></td>
      <td>:</td>
      <td><?php echo $tampil['no_ktpsim']; ?></td>
      <td><b>Total Harga</b></td>
      <td>:</td>
      <td>Rp. <?php echo $tampil['subtotal']; ?></td>
    </tr>
    <tr>
      <td><b>Alamat</b></td>
      <td>:</td>
      <td><?php echo $tampil['alamat_penyewa']; ?></td>
      <td><b>Jenis Pembayaran</b></td>
      <td>:</td>
      <td><?php echo $tampil['jns_bayar']; ?></td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td></td>
      <td><b>Jumlah Pembayaran</b></td>
      <td>:</td>
      <td>Rp. <?php echo $tampil['jml_bayar']; ?></td>
    </tr>
    <tr>
      <td><b>No. Telp</b></td>
      <td>:</td>
      <td><?php echo $tampil['telp_penyewa']; ?></td>
      <td><b>Lokasi Serah Terima</b></td>
      <td>:</td>
      <td><?php echo $tampil['lokasi']; ?></td>
    </tr>
    <tr>
      <td><b>Email</b></td>
      <td>:</td>
      <td><?php echo $tampil['email']; ?></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
  </table>
</div>

<table border="1" width="100%" cellspacing="0">
  <tr>
    <td colspan="7" align="center"><b>Data</b></td>
  </tr>
  <tr>
    <td align="center"><b>No.</b></td>
    <td align="center"><b>Merk Mobil</b></td>
    <td align="center"><b>No. Polisi</b></td>
    <td align="center"><b>Tahun</b></td>
    <td align="center"><b>Warna</b></td>
    <td align="center"><b>Harga Sewa</b></td>
    <td align="center"><b>Jasa Supir</b></td>
  </tr>
  <tr>
    <?php
    $no = 1;
    $no_spsk = $_GET['no_spsk'];
    $get     = mysql_query("SELECT * FROM spsk a JOIN penyewa b ON a.id_penyewa = b.id_penyewa JOIN detail_mobil c ON a.no_spsk = c.no_spsk JOIN mobil d ON c.id_mobil = d.id_mobil WHERE c.no_spsk='$no_spsk'");
    while ($tampil=mysql_fetch_array($get)) {
    ?>
    <td align="center"><?php echo $no++; ?></td>
    <td><?php echo $tampil['merk']; ?></td>
    <td align="center"><?php echo $tampil['no_pol']; ?></td>
    <td align="center"><?php echo $tampil['thn_buat']; ?></td>
    <td><?php echo $tampil['warna']; ?></td>
    <td align="center">Rp. <?php echo $tampil['harga']; ?></td>
    <?php
      $q = mysql_query("SELECT tarif FROM supir");
      $data = mysql_fetch_array($q);
      if($tampil['jasa_supir'] == "Ya"){
        $x = $data['tarif'];
      }else{
        $x = 0;
      }
    ?>
    <td align="center">Rp. <?php echo $x; ?></td>
  </tr>
  <?php } ?>
</table>

<p>
  <center>SURAT PERJANJIAN SEWA KENDARAAN</center>
    <ol>
      <li>Uang (biaya sewa) dibayar di muka.</li>
      <li>Penggunaan kendaraan yang melebihi batas waktu akan dikenakan biaya tambahan (over time) sebesar Rp. 25.000/jam</li>
      <li>Biaya Sewa tidak termasuk tol dan parkir</li>
      <li>Kendaraan harus di kembalikan dalam keadaan/kondisi pada saat penyerahan (check list kendaraan)</li>
      <li>Bila dalam masa sewa terjadi kerusakan/kehilangan kendaraan maka akan menjadi tanggung jawab penyewa sepenuhnya, serta akan dikenakan biaya tambahan selama kendaraan tersebut dalam perbaikan/belum ditemukan</li>
      <li>Dalam masa sewa, penyewa tidak dibenarkan:</br>
        a. Meminjamkan, menyewakan, menggadaikan, dan atau menjual kendaraan kepada pihak lain</br>
        b. Menggunakan kendaraan sebagai alat tindakan kejahatan, belajar mengemudi atau hal lainnya yang bersifat diluar kepatutan
      </li>
    </ol>
    Surat perjanjian sewa kendaraan ini telah dibaca, dimengerti dan dipahami isi dan maksudnya, serta ditandatangani oleh saya selaku penyewa dalam keadaan sadar.
  </p>

  <?php
  $tampil = mysql_fetch_array(mysql_query("SELECT * FROM spsk a JOIN penyewa b ON a.id_penyewa = b.id_penyewa JOIN detail_mobil c ON a.no_spsk = c.no_spsk JOIN mobil d ON c.id_mobil = d.id_mobil WHERE c.no_spsk='$no_spsk'"));
  ?>
<table width="100%" border="0" height="150px">
  <tr>
    <td align="right" colspan="2"></td>
    <td align="center" width="250px">Tangerang, <?php echo $tgl; ?></td>
  </tr>
  <tr>
    <td align="center" width="250px"><b>Penyewa</b></td>
    <td align="center">JAMINAN:</td>
    <td align="center"><b>Staff Admin</b></td>
  </tr>
  <tr>
    <td align="center"></td>
    <td align="center"><br><?php echo $tampil['jaminan']; ?></td>
    <td align="center"></td>
  </tr>
  <tr>
    <td align="center">( <?php echo $tampil['nama_penyewa']; ?> )</td>
    <td align="center"></td>
    <td align="center">( <?php echo $_SESSION['login_user']; ?> )</td>
  </tr>
</table>
</div>

<?php } ?>
      </div>
    </div>
  </div>
  <!-- /#page-wrapper -->

<textarea id="printing-css" style="display:none;">.no-print{display:none}</textarea>
<iframe id="printing-frame" name="print_frame" src="about:blank" style="display:none;"></iframe>
<script type="text/javascript">
//<![CDATA[
function printDiv(elementId) {
    var a = document.getElementById('printing-css').value;
    var b = document.getElementById(elementId).innerHTML;
    window.frames["print_frame"].document.title = document.title;
    window.frames["print_frame"].document.body.innerHTML = '<style>' + a + '</style>' + b;
    window.frames["print_frame"].window.focus();
    window.frames["print_frame"].window.print();
}
//]]>
</script>
