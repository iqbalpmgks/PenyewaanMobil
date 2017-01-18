<?php
include '../koneksi.php';

?>
<div id="page-wrapper">
  <div class='row'>
    <div class='col-lg-12'>
      <h3 class="page-header">
        <a class="btn btn-defaul" href="stk.php">Kembali</a>
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
            <b>SURAT TERIMA KENDARAAN</b>
          </div>
        </div>
      </br>
    </br>

<?php
$no =1;
$no_stk = $_GET['no_stk'];
$get    = mysql_query("SELECT a.id_mobil, a.no_stk, a.no_spsk, b.tgl_mulai, g.merk, g.no_pol, g.warna, a.tgl_stk, a.pemeriksa_keluar, c.nama_penyewa, c.telp_penyewa, b.lama_sewa FROM stk a JOIN spsk b ON a.no_spsk = b.no_spsk JOIN penyewa c ON b.id_penyewa = c.id_penyewa JOIN periksa_keluar d ON a.no_stk = d.no_stk JOIN perlengkapan e ON d.id_perkap = e.id_perkap JOIN detail_mobil f ON b.no_spsk = f.no_spsk JOIN mobil g ON f.id_mobil = g.id_mobil WHERE a.no_stk='$no_stk' AND g.id_mobil = a.id_mobil GROUP BY a.id_mobil");
while ($tampil=mysql_fetch_array($get)) {
?>
<div>
  <table border="0" width="100%">
    <tr>
      <td><b>No. STK</b> </td>
      <td>:</td>
      <td><?php echo $tampil['no_stk']; ?></td>
      <td><b>No. SPSK</b> </td>
      <td>:</td>
      <td><?php echo $tampil['no_spsk']; ?></td>
    </tr>
    <tr>
      <td><b>Tanggal</b> </td>
      <td>:</td>
      <?php
        $tgl_stk = Date_create($tampil['tgl_stk']);
        $tglstk  = Date_format($tgl_stk, 'd/m/Y');
      ?>
      <td><?php echo $tglstk; ?></td>
      <td><b>Lama Sewa</b></td>
      <td>:</td>
      <td><?php echo $tampil['lama_sewa']; ?> hari</td>
    </tr>
    <tr>
      <td colspan="6"><br></td>
    </tr>
    <tr>
      <td><b>Pemeriksa</b></td>
      <td>:</td>
      <td><?php echo $tampil['pemeriksa_keluar']; ?></td>
      <td><b>No. Polisi</b></td>
      <td>:</td>
      <td><?php echo $tampil['no_pol']; ?></td>
    </tr>
    <tr>
      <td><b>Nama Penyewa</b></td>
      <td>:</td>
      <td><?php echo $tampil['nama_penyewa']; ?></td>
      <td><b>Merk Mobil</b></td>
      <td>:</td>
      <td><?php echo $tampil['merk']; ?></td>
    </tr>
    <tr>
      <td><b>No. Telp</b></td>
      <td>:</td>
      <td><?php echo $tampil['telp_penyewa']; ?></td>
      <td><b>Warna</b></td>
      <td>:</td>
      <td><?php echo $tampil['warna'];?></td>
    </tr>
  </table>
</div>
<?php } ?>
<table border="1" width="100%" cellspacing="0">
  <tr>
    <td colspan="6" align="center"><b>KONDISI KENDARAAN</b></td>
  </tr>
  <tr>
    <td colspan="2"></td>
    <td colspan="2" align="center">KELUAR (OUT)</td>
    <td colspan="2" align="center">MASUK (IN)</td>
  </tr>
  <tr>
    <td align="center"><b>No.</b></td>
    <td align="center"><b>Perlengkapan</b></td>
    <td align="center"><b>Kondisi</b></td>
    <td align="center"><b>Keterangan</b></td>
    <td align="center"><b>Kondisi</b></td>
    <td align="center"><b>Keterangan</b></td>
  </tr>
  <?php
  $no = 1;
  $no_stk = $_GET['no_stk'];
  $get    = mysql_query("SELECT * FROM stk a JOIN spsk b ON a.no_spsk = b.no_spsk JOIN penyewa c ON b.id_penyewa = c.id_penyewa JOIN periksa_keluar d ON a.no_stk = d.no_stk JOIN perlengkapan e ON d.id_perkap = e.id_perkap WHERE a.no_stk='$no_stk'");
  while ($tampil=mysql_fetch_array($get)) {
  ?>
  <tr>
    <td align="center"><?php echo $no++; ?></td>
    <td><?php echo $tampil['nama_perkap']; ?></td>
    <td align="center"><?php echo $tampil['kondisi_keluar']; ?></td>
    <td align="center"><?php echo $tampil['keterangan']; ?></td>
    <td></td>
    <td align="center"></td>
  </tr>
<?php } ?>
</table>
</br>
<table border="0" width="100%" cellspacing="0">
  <tr>
    <td><img src="../img/kerangka.jpg" width="300px" alt="Kerangka Mobil" align="left"/></td>
    <td>
      Kode:<br>
      <ol>
        <li>Baret</li>
        <li>Penyok</li>
        <li>Pecah</li>
        <li>Retak</li>
        <li>Buram</li>
      </ol>
    </td>
    <td><img src="../img/kerangka.jpg" width="300px" alt="Kerangka Mobil" align="left"/></td>
    <td>
      Kode:<br>
      <ol>
        <li>Baret</li>
        <li>Penyok</li>
        <li>Pecah</li>
        <li>Retak</li>
        <li>Buram</li>
      </ol>
    </td>
  </tr>
</table>
<hr>
<?php
$no_stk = $_GET['no_stk'];
$get    = mysql_fetch_array(mysql_query("SELECT * FROM stk a JOIN spsk b ON a.no_spsk = b.no_spsk JOIN penyewa c ON b.id_penyewa = c.id_penyewa JOIN periksa_keluar d ON a.no_stk = d.no_stk JOIN perlengkapan e ON d.id_perkap = e.id_perkap WHERE a.no_stk='$no_stk'"));
$date   = date('d/m/Y');
?>
<table width="100%" border="0">
  <tr>
    <td width="200px"><b>Tanggal Keluar</b></td>
    <td>:</td>
    <td width="200px"><?php echo $get['tgl_mulai']; ?></td>
    <td width="200px"><b>Tanggal Masuk</b></td>
    <td>:</td>
    <td width="200px"></td>
  </tr>
  <tr>
    <td width="200px"><b>Jam Keluar</b></td>
    <td>:</td>
    <td width="200px"><?php echo $get['jam_keluar']; ?></td>
    <td width="200px"><b>Jam Masuk</b></td>
    <td>:</td>
    <td width="200px"></td>
  </tr>
</table>
<br>
<table border="0" width="100%">
  <tr>
    <td align="right" colspan="2"></td>
    <td align="center">Tangerang, <?php echo $date; ?></td>
  </tr>
  <tr>
    <td align="center" width="200px"><b>Penyewa</b></td>
    <td align="center"></td>
    <td align="center" width="200px"><b>Staff Admin</b></td>
  </tr>
  <tr>
    <td align="center"></td>
    <td align="center"><br><br><br></td>
    <td align="center"></td>
  </tr>
  <tr>
    <td align="center">( <?php echo $get['nama_penyewa']; ?> )</td>
    <td align="center"></td>
    <td align="center">( <?php echo $_SESSION['login_user']; ?> )</td>
  </tr>
</table>
</div>

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
    window.frames["print_frame"].document.images = document.images;
    window.frames["print_frame"].document.body.innerHTML = '<style>' + a + '</style>' + b;
    window.frames["print_frame"].window.focus();
    window.frames["print_frame"].window.print();
}
//]]>
</script>
