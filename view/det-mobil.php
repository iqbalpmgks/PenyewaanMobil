<?php include '../koneksi.php'; ?>

<div id="page-wrapper">
<div class="row">
	<div class="col-lg-12">
		<h3><span class="glyphicon glyphicon-list-alt"></span>  Detail Mobil</h3>
		<a class="btn" href="mobil.php"><span class="glyphicon glyphicon-arrow-left"></span>  Kembali</a>

<?php
$id_mobil	= mysql_real_escape_string($_GET['id_mobil']);
$det				= mysql_query("SELECT * FROM mobil WHERE id_mobil='$id_mobil'")or die(mysql_error());
while($d=mysql_fetch_array($det)){
	?>
	<table class="table">
		<tr>
			<th class="col-md-3">ID Mobil</th>
			<td><?php echo $d['id_mobil'] ?></td>
		</tr>
		<tr>
			<th class="col-md-3">Merk</th>
			<td><?php echo $d['merk'] ?></td>
		</tr>
		<tr>
			<th class="col-md-3">No. Polisi</th>
			<td><?php echo $d['no_pol'] ?></td>
		</tr>
		<tr>
			<th class="col-md-3">Warna</th>
			<td><?php echo $d['warna'] ?></td>
		</tr>
		<tr>
			<th class="col-md-3">Tahun</th>
			<td><?php echo $d['thn_buat'] ?></td>
		</tr>
		<tr>
			<th class="col-md-3">Harga Sewa</th>
			<td>Rp. <?php echo $d['harga'] ?></td>
		</tr>
		<tr>
			<th class="col-md-3">No. Rangka</th>
			<td><?php echo $d['no_rangka'] ?></td>
		</tr>
		<tr>
			<th class="col-md-3">No. Mesin</th>
			<td><?php echo $d['no_mesin'] ?></td>
		</tr>
		<tr>
			<th class="col-md-3">Status</th>
			<td><?php echo $d['status'] ?></td>
		</tr>
	</table>
	<?php
}
?>
</div>
</div>
