<?php
include '../koneksi.php';

if (isset($_POST['submit'])) {
  $id_mobil    	= $_POST['id_mobil'];
  $merk       	= ucwords($_POST['merk']);
  $no_pol       = strtoupper($_POST['no_pol']);
  $warna				= ucwords($_POST['warna']);
  $thn_buat			= $_POST['thn_buat'];
  $harga        = $_POST['harga'];
  $no_rangka    = $_POST['no_rangka'];
  $no_mesin     = strtoupper($_POST['no_mesin']);
  $status       = strtoupper($_POST['status']);

  $update = mysql_query("UPDATE mobil SET id_mobil='$id_mobil', merk='$merk', no_pol='$no_pol', warna='$warna', thn_buat='$thn_buat', harga='$harga', no_rangka='$no_rangka', no_mesin='$no_mesin', status='$status' WHERE id_mobil='$id_mobil'");
  if ($update) {
    echo "<script>alert('Data BERHASIL di Update!');window.location='mobil.php';</script>";
  } else {
    echo "<script>alert('Data GAGAL di Update!');window.location='edit-mobil.php';</script>";
  }
}

?>

<div id="page-wrapper">
  <div class="col-lg-12">
  	<h3></h3>
  </div>

  <?php
  $id_mobil   = mysql_real_escape_string($_GET['id_mobil']);
  $det        = mysql_query("SELECT * FROM mobil WHERE id_mobil='$id_mobil'")or die(mysql_error());
  while($d=mysql_fetch_array($det)){
  ?>
  <div class="row">
    <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>Edit Mobil</strong>
        </div>
        <div class="panel-body">
          <div class="row">
            <div class="col-lg-12">
  	          <form action="edit-mobil.php" method="POST">
  		          <table class="table">
            			<tr>
            				<th class="col-md-2">ID Mobil</th>
            				<td><input type="text" class="form-control" name="id_mobil" value="<?php echo $d['id_mobil'] ?>" readonly></td>
            			</tr>
            			<tr>
            				<th class="col-md-2">Merk Mobil</th>
            				<td><input type="text" class="form-control" name="merk" value="<?php echo $d['merk'] ?>" maxlength="35"></td>
            			</tr>
            			<tr>
            				<th class="col-md-2">No. Polisi</th>
            				<td><input type="text" class="form-control" name="no_pol" value="<?php echo $d['no_pol'] ?>" maxlength="10"></td>
            			</tr>
                  <tr>
            				<th class="col-md-2">Warna</th>
            				<td><input type="text" class="form-control" name="warna" value="<?php echo $d['warna'] ?>" maxlength="10"></td>
            			</tr>
                  <tr>
            				<th class="col-md-2">Tahun Buat</th>
            				<td><input type="text" class="form-control" name="thn_buat" value="<?php echo $d['thn_buat'] ?>" maxlength="4" onkeyup="validAngka(this)"></td>
            			</tr>
                  <tr>
            				<th class="col-md-2">Harga Sewa</th>
            				<td><input type="text" class="form-control" name="harga" value="<?php echo $d['harga'] ?>" maxlength="12" onkeyup="validAngka(this)"></td>
            			</tr>
                  <tr>
            				<th class="col-md-2">No. Rangka</th>
            				<td><input type="text" class="form-control" name="no_rangka" value="<?php echo $d['no_rangka'] ?>" maxlength="25"></td>
            			</tr>
                  <tr>
            				<th class="col-md-2">No. Mesin</th>
            				<td><input type="text" class="form-control" name="no_mesin" value="<?php echo $d['no_mesin'] ?>" maxlength="25"></td>
            			</tr>
                  <tr>
            				<th class="col-md-2">Status</th>
            				<td>
                      <select id="status" name="status" class="form-control">
                        <option value="">Pilih Status</option>
                        <option <?php if( $d['status']=='Tersedia'){echo "selected"; } ?> value="Tersedia">Tersedia</option>
                        <option <?php if( $d['status']=='Terpakai'){echo "selected"; } ?> value="Terpakai">Terpakai</option>
                      </select>
            			</tr>
            			<tr>
            				<td></td>
            				<td>
                      <a href="mobil.php" type="reset" class="btn btn-default">BATAL</a>
                      <button type="submit" name="submit" class="btn btn-primary">SIMPAN</button>
                    </td>
            			</tr>
            		</table>
            	</form>
            	<?php } ?>
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
</script>
<!--End of Code JS Validation-->
