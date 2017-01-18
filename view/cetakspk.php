<?php
include '../koneksi.php';

?>
<div id="page-wrapper">
  <div class='row'>
    <div class='col-lg-12'>
      <h3 class="page-header">
        <a class="btn btn-defaul" href="spk.php">Kembali</a>
        <a class="btn btn-default no-print" href="javascript:printDiv('area-1');">Print</a>
      </h3>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-12">
      <div id="area-1">
        <div>
          <div align="left">
            <img src="../img/cop.jpg" width="400px" alt="Logo Artha Laras"/><br>
            <!-- Jl. Dr. Ciptomangunkusumo, No. 11, Ciledug - Tangerang 15153,<br>
            Telp: 021-7319980 / 0812-1341-1361 <br><br> -->
          </div>
        </br>
          <div align="center">
            <b><u>SURAT PERINTAH KERJA</u></b>
          </div>
        </div>
        </br>
<?php
$no_spk	= $_GET['no_spk'];
$tampil = mysql_fetch_array(mysql_query("SELECT * FROM spk a JOIN supir b ON a.id_supir = b.id_supir JOIN spsk c ON a.no_spsk = c.no_spsk JOIN penyewa d ON c.id_penyewa = d.id_penyewa JOIN detail_mobil e ON a.id_mobil = e.id_mobil JOIN mobil f ON e.id_mobil = f.id_mobil WHERE a.no_spk='$no_spk'"));
?>
<div>
<table border="0" width="100%">
  <tr>
    <td><b>No. SPK</b> </td>
    <td>:</td>
    <td ><?php echo $tampil['no_spk']; ?></td>
    <td><b>No. SPSK</b> </td>
    <td>:</td>
    <td><?php echo $tampil['no_spsk']; ?></td>
  </tr>
  <tr>
    <td ><b>Tanggal</b> </td>
    <td>:</td>
    <?php
      $tgl_spk     = Date_create($tampil['tgl_spk']);
      $tgl_mulai   = Date_create($tampil['tgl_mulai']);
      $tgl_selesai = Date_create($tampil['tgl_selesai']);
      $tglspk      = Date_format($tgl_spk, 'd/m/Y');
      $tglmulai    = Date_format($tgl_mulai, 'd/m/Y');
      $tglselesai  = Date_format($tgl_selesai, 'd/m/Y');
    ?>
    <td><?php echo $tglspk; ?></td>
    <td><b>Lama Sewa</b></td>
    <td>:</td>
    <td><?php echo $tampil['lama_sewa']; ?> hari</td>
  </tr>

  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td><b>Dari Tanggal</b></td>
    <td>:</td>
    <td><?php echo $tglmulai; ?></td>
  </tr>
  <tr>
    <td><b>No. Polisi</b></td>
    <td>:</td>
    <td><?php echo $tampil['no_pol']; ?></td>
    <td><b>Sampai Tanggal</b></td>
    <td>:</td>
    <td><?php echo $tglselesai; ?></td>
  </tr>
  <tr>
    <td><b>Merk Mobil</b></td>
    <td>:</td>
    <td><?php echo $tampil['merk']; ?></td>
    <td><b>Jam Keluar</b></td>
    <td>:</td>
    <td><?php echo $tampil['jam_keluar']; ?></td>
  </tr>
  <tr>
    <td><b>Lokasi Terima</b></td>
    <td>:</td>
    <td><?php echo $tampil['lokasi']; ?></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
</div>
</table>

</br>
<!-- Body -->
<b>Yang bertanda tangan dibawah ini, menugaskan :</b></br>
<table border="0" width="300px">
  <tr>
    <td width="100px">Nama</td>
    <td>:</td>
    <td>&nbsp;<?php echo $tampil['nama_supir']; ?></td>
  </tr>
  <tr>
    <td>Alamat</td>
    <td>:</td>
    <td>&nbsp;<?php echo $tampil['alamat_supir']; ?></td>
  </tr>
  <tr>
    <td colspan="3" height="30px"></td>
  </tr>
  <tr>
    <td>No. Telp</td>
    <td>:</td>
    <td>&nbsp;<?php echo $tampil['telp_supir']; ?></td>
  </tr>
  <tr>
    <td colspan="3" height="30px"></td>
  </tr>
</table>
<b>Untuk melayani Tn./Ny. :</b>
<table border="0" width="300px">
  <tr>
    <td width="100px">Nama</td>
    <td>:</td>
    <td>&nbsp;<?php echo $tampil['nama_penyewa']; ?></td>
  </tr>
  <tr>
    <td>Alamat</td>
    <td>:</td>
    <td>&nbsp;<?php echo $tampil['alamat_penyewa']; ?></td>
  </tr>
  <tr>
    <td colspan="3" height="30px"></td>
  </tr>
  <tr>
    <td>No. Telp</td>
    <td>:</td>
    <td>&nbsp;<?php echo $tampil['telp_penyewa']; ?></td>
  </tr>
</table>

<p>Demikianlah surat perintah ini dibuat, agar dapat dilaksanakan sebaik-baiknya dengan penuh tanggung jawab.
  Jika dilapangan terjadi suatu kondisi di luar ketentuan surat ini, dapat dibicarakan lebih lanjut.
</p>
<!-- End of Body -->

<table width="200px" border="0" height="150px" align="right">
  <tr>
    <td align="center"></td>
    <th></th>
    <td align="center"><b>Staff Admin</b></td>
  </tr>
  <tr>
    <td align="center"></td>
    <td align="center"></td>
    <td align="center"></td>
  </tr>
  <tr>
    <td align="center"></td>
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
    window.frames["print_frame"].document.body.innerHTML = '<style>' + a + '</style>' + b;
    window.frames["print_frame"].window.focus();
    window.frames["print_frame"].window.print();
}
//]]>
</script>
