<?php include '../koneksi.php'; ?>

<div id="page-wrapper">
<div class="row">
	<div class="col-lg-12">
		<h3><span class="glyphicon glyphicon-list-alt"></span>  Detail Penyewa</h3>
		<a class="btn" href="penyewa.php"><span class="glyphicon glyphicon-arrow-left"></span>  Kembali</a>

<?php
$id_penyewa	= mysql_real_escape_string($_GET['id_penyewa']);
$det				= mysql_query("SELECT * FROM penyewa WHERE id_penyewa='$id_penyewa'")or die(mysql_error());
while($d=mysql_fetch_array($det)){
	?>
	<table class="table">
		<tr>
			<th class="col-md-3">ID Penyewa</th>
			<td><?php echo $d['id_penyewa'] ?></td>
		</tr>
		<tr>
			<th class="col-md-3">Nama Penyewa</th>
			<td><?php echo $d['nama_penyewa'] ?></td>
		</tr>
		<tr>
			<th class="col-md-3">No. KTP/SIM</th>
			<td><?php echo $d['no_ktpsim'] ?></td>
		</tr>
		<tr>
			<th class="col-md-3">Jenis Kelamin</th>
			<td><?php echo $d['jenkel'] ?></td>
		</tr>
		<tr>
			<th class="col-md-3">Alamat</th>
			<td><?php echo $d['alamat_penyewa'] ?></td>
		</tr>
		<tr>
			<th class="col-md-3">No. Telp</th>
			<td><?php echo $d['telp_penyewa'] ?></td>
		</tr>
		<tr>
			<th class="col-md-3">Email</th>
			<td><?php echo $d['email'] ?></td>
		</tr>
	</table>
	<?php
}
?>
</div>
</div>
