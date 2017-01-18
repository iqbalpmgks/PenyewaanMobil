<?php
include '../koneksi.php';

if (isset($_POST['submit'])) {
  $id_penyewa 	  = $_POST['id_penyewa'];
  $nama_penyewa	  = ucwords($_POST['nama_penyewa']);
  $no_ktpsim      = $_POST['no_ktpsim'];
  $jenkel				  = $_POST['jenkel'];
  $alamat_penyewa	= ucwords($_POST['alamat_penyewa']);
  $telp_penyewa   = $_POST['telp_penyewa'];
  $email          = $_POST['email'];

  $update = mysql_query("UPDATE penyewa SET id_penyewa='$id_penyewa', nama_penyewa='$nama_penyewa', no_ktpsim='$no_ktpsim', jenkel='$jenkel', alamat_penyewa='$alamat_penyewa', telp_penyewa='$telp_penyewa', email='$email' WHERE id_penyewa='$id_penyewa'");
  if ($update) {
    echo "<script>alert('Data BERHASIL di Update!');window.location='penyewa.php';</script>";
  } else {
    echo "<script>alert('Data GAGAL di Update!');window.location='edit_penyewa.php';</script>";
  }
}

?>

<div id="page-wrapper">
  <div class="col-lg-12">
  	<h3></h3>
  </div>

  <?php
  $id_penyewa = mysql_real_escape_string($_GET['id_penyewa']);
  $det        = mysql_query("SELECT * FROM penyewa WHERE id_penyewa='$id_penyewa'")or die(mysql_error());
  while($d=mysql_fetch_array($det)){
  ?>
  <div class="row">
    <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>Edit Penyewa</strong>
        </div>
        <div class="panel-body">
          <div class="row">
            <div class="col-lg-12">
  	          <form action="edit-penyewa.php" method="POST">
  		          <table class="table">
            			<tr>
            				<th class="col-md-2">ID Penyewa</th>
            				<td><input type="text" class="form-control" name="id_penyewa" value="<?php echo $d['id_penyewa'] ?>" readonly></td>
            			</tr>
            			<tr>
            				<th class="col-md-2">Nama Penyewa</th>
            				<td><input type="text" class="form-control" name="nama_penyewa" value="<?php echo $d['nama_penyewa'] ?>" maxlength="50" required></td>
            			</tr>
            			<tr>
            				<th class="col-md-2">No. KTP/SIM</th>
            				<td><input type="text" class="form-control" name="no_ktpsim" value="<?php echo $d['no_ktpsim'] ?>" maxlength="16" required></td>
            			</tr>
            			<tr>
            				<th class="col-md-2">Jenis Kelamin</th>
                    <td>
                      <select id="select" name="jenkel" class="form-control">
                      <option value="">Pilih Jenis Kelamin</option>
                      <option <?php if( $d['jenkel']=='Laki-laki'){echo "selected"; } ?> value="Laki-laki">Laki-laki</option>
                      <option <?php if( $d['jenkel']=='Perempuan'){echo "selected"; } ?> value="Perempuan">Perempuan</option>
                    </select>
                  </td>
            			</tr>
            			<tr>
            				<th class="col-md-2">Alamat</th>
            				<td><textarea rows="3" type="text" class="form-control" name="alamat_penyewa" maxlength="80" required><?php echo $d['alamat_penyewa'] ?></textarea></td>
            			</tr>
                  <tr>
            				<th class="col-md-2">No. Telp</th>
            				<td><input type="text" class="form-control" name="telp_penyewa" onkeyup="validAngka(this)" maxlength="12" value="<?php echo $d['telp_penyewa'] ?>" required></td>
            			</tr>
                  <tr>
            				<th class="col-md-2">Email</th>
            				<td><input type="email" class="form-control" name="email" value="<?php echo $d['email'] ?>" maxlength="50"></td>
            			</tr>
            			<tr>
            				<td></td>
            				<td>
                      <a href="penyewa.php" type="reset" class="btn btn-default">BATAL</a>
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
