<?php
include '../koneksi.php';

if (isset($_POST['submit'])) {
  $id_supir    	= $_POST['id_supir'];
  $nama_supir  	= ucwords($_POST['nama_supir']);
  $alamat_supir = ucwords($_POST['alamat_supir']);
  $telp_supir 	= $_POST['telp_supir'];
  $tarif        = $_POST['tarif'];
  $status       = $_POST['status'];

  $update = mysql_query("UPDATE supir SET id_supir='$id_supir', nama_supir='$nama_supir', alamat_supir='$alamat_supir', telp_supir='$telp_supir', tarif='$tarif', status='$status' WHERE id_supir='$id_supir'");
  if ($update) {
    echo "<script>alert('Data BERHASIL di Update!');window.location='supir.php';</script>";
  } else {
    echo "<script>alert('Data GAGAL di Update!');window.location='edit-supir.php';</script>";
  }
}

?>

<div id="page-wrapper">
  <div class="col-lg-12">
  	<h3></h3>
  </div>

  <?php
  $id_supir   = mysql_real_escape_string($_GET['id_supir']);
  $det        = mysql_query("SELECT * FROM supir WHERE id_supir='$id_supir'")or die(mysql_error());
  while($d=mysql_fetch_array($det)){
  ?>
  <div class="row">
    <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>Edit Supir</strong>
        </div>
        <div class="panel-body">
          <div class="row">
            <div class="col-lg-12">
  	          <form action="edit-supir.php" method="POST">
  		          <table class="table">
            			<tr>
            				<th class="col-md-2">ID Supir</th>
            				<td><input type="text" class="form-control" name="id_supir" value="<?php echo $d['id_supir']; ?>" readonly></td>
            			</tr>
            			<tr>
            				<th class="col-md-2">Nama Supir</th>
            				<td><input type="text" class="form-control" name="nama_supir" value="<?php echo $d['nama_supir']; ?>" maxlength="50" required></td>
            			</tr>
            			<tr>
            				<th class="col-md-2">Alamat</th>
            				<td><textarea rows="3" type="text" class="form-control" name="alamat_supir" maxlength="80" required><?php echo $d['alamat_supir']; ?></textarea>
            			</tr>
                  <tr>
            				<th class="col-md-2">No. Telp</th>
            				<td><input type="text" class="form-control" name="telp_supir" value="<?php echo $d['telp_supir']; ?>" maxlength="12" onkeyup="validAngka(this)" required></td>
            			</tr>
                  <tr>
                    <th class="col-md-2">Tarif</th>
                    <td><input type="text" class="form-control" name="tarif" value="<?php echo $d['tarif']; ?>" maxlength="12" onkeyup="validAngka(this)" required></td>
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
                      <a href="supir.php" type="reset" class="btn btn-default">BATAL</a>
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
