<?php
include '../koneksi.php';

if (isset($_POST['submit'])) {
  $id_staff    	= $_POST['id_staff'];
  $nama_staff  	= ucwords($_POST['nama_staff']);
  $alamat_staff = ucwords($_POST['alamat_staff']);
  $telp_staff	  = $_POST['telp_staff'];
  $username			= $_POST['username'];
  $password     = $_POST['password'];

  $update = mysql_query("UPDATE staff SET id_staff='$id_staff', nama_staff='$nama_staff', alamat_staff='$alamat_staff', telp_staff='$telp_staff', username='$username', password='$password' WHERE id_staff='$id_staff'");
  if ($update) {
    echo "<script>alert('Data BERHASIL di Update!');window.location='staff.php';</script>";
  } else {
    echo "<script>alert('Data GAGAL di Update!');window.location='edit-staff.php';</script>";
  }
}

?>

<div id="page-wrapper">
  <div class="col-lg-12">
  	<h3></h3>
  </div>

  <?php
  $id_staff   = mysql_real_escape_string($_GET['id_staff']);
  $det        = mysql_query("SELECT * FROM staff WHERE id_staff='$id_staff'")or die(mysql_error());
  while($d=mysql_fetch_array($det)){
  ?>
  <div class="row">
    <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>Edit Staff</strong>
        </div>
        <div class="panel-body">
          <div class="row">
            <div class="col-lg-12">
  	          <form action="edit-staff.php" method="POST">
  		          <table class="table">
            			<tr>
            				<th class="col-md-2">ID Staff</th>
            				<td><input type="text" class="form-control" name="id_staff" value="<?php echo $d['id_staff'] ?>" readonly></td>
            			</tr>
            			<tr>
            				<th class="col-md-2">Nama Staff</th>
            				<td><input type="text" class="form-control" name="nama_staff" value="<?php echo $d['nama_staff'] ?>" maxlength="50" required></td>
            			</tr>
            			<tr>
            				<th class="col-md-2">Alamat</th>
            				<td><textarea type="text" rows="3" class="form-control" name="alamat_staff" maxlength="80" required><?php echo $d['alamat_staff'] ?></textarea>
            			</tr>
                  <tr>
            				<th class="col-md-2">No. Telp</th>
            				<td><input type="text" class="form-control" name="telp_staff" value="<?php echo $d['telp_staff'] ?>" maxlength="12" required></td>
            			</tr>
                  <tr>
            				<th class="col-md-2">username</th>
            				<td><input type="text" class="form-control" name="username" value="<?php echo $d['username'] ?>" maxlength="15" required></td>
            			</tr>
                  <tr>
            				<th class="col-md-2">password</th>
            				<td><input type="text" class="form-control" name="password" value="<?php echo $d['password'] ?>" maxlength="20" required></td>
            			</tr>
            			<tr>
            				<td></td>
            				<td>
                      <a href="staff.php" type="reset" class="btn btn-default">BATAL</a>
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
