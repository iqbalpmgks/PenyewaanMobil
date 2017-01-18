<?php include '../koneksi.php'; ?>

<div id="page-wrapper">
<div class="row">
	<div class="col-lg-12">
		<h3><span class="glyphicon glyphicon-list-alt"></span>  Detail Kwitansi</h3>
		<a class="btn" href="kwitansi.php"><span class="glyphicon glyphicon-arrow-left"></span>  Kembali</a>

<?php
$no_kwitansi	= mysql_real_escape_string($_GET['no_kwitansi']);
$det					= mysql_query("SELECT * FROM kwitansi a JOIN spsk b ON a.no_spsk = b.no_spsk JOIN penyewa c ON b.id_penyewa = c.id_penyewa WHERE no_kwitansi='$no_kwitansi'")or die(mysql_error());
while($d=mysql_fetch_array($det)){
	?>
	<table class="table">
		<tr>
			<th class="col-md-3">No. Kwitansi</th>
			<td><?php echo $d['no_kwitansi'] ?></td>
		</tr>
		<tr>
			<th class="col-md-3">Tanggal Kwitansi</th>
			<td><?php echo $d['tgl_kwitansi'] ?></td>
		</tr>
		<tr>
			<th class="col-md-3">No. SPSK</th>
			<td><?php echo $d['no_spsk'] ?></td>
		</tr>
		<tr>
			<th class="col-md-3">Lama Sewa</th>
			<td><?php echo $d['lama_sewa'] ?> hari</td>
		</tr>
		<tr>
			<th class="col-md-3">Total Harga</th>
			<td>Rp. <?php echo $d['subtotal'] ?></td>
		</tr>
		<tr>
			<th class="col-md-3">Nama Penyewa</th>
			<td><?php echo $d['nama_penyewa'] ?></td>
		</tr>
	</table>
	<?php
}
?>
</div>
</div>
