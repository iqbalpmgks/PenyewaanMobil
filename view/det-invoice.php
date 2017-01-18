<?php include '../koneksi.php'; ?>

<div id="page-wrapper">
<div class="row">
	<div class="col-lg-12">
		<h3><span class="glyphicon glyphicon-list-alt"></span>  Detail Invoice</h3>
		<a class="btn" href="invoice.php"><span class="glyphicon glyphicon-arrow-left"></span>  Kembali</a>

<?php
$no_invoice	= mysql_real_escape_string($_GET['no_invoice']);
$det				= mysql_query("SELECT * FROM invoice a JOIN spsk b ON a.no_spsk = b.no_spsk JOIN penyewa c ON b.id_penyewa = c.id_penyewa WHERE no_invoice='$no_invoice'")or die(mysql_error());
while($d=mysql_fetch_array($det)){
	?>
	<table class="table">
		<tr>
			<th class="col-md-3">No. Invoice</th>
			<td><?php echo $d['no_invoice'] ?></td>
		</tr>
		<tr>
			<th class="col-md-3">Tanggal Invoice</th>
			<td><?php echo $d['tgl_invoice'] ?></td>
		</tr>
		<tr>
			<th class="col-md-3">No. SPSK</th>
			<td><?php echo $d['no_spsk'] ?></td>
		</tr>
		<tr>
			<th class="col-md-3">Nama Penyewa</th>
			<td><?php echo $d['nama_penyewa'] ?></td>
		</tr>
		<tr>
			<th class="col-md-3">Total Harga</th>
			<td><?php echo $d['subtotal'] ?></td>
		</tr>
		<tr>
			<th class="col-md-3">Sisa Pembayaran</th>
			<td><?php echo $d['sisa_bayar'] ?></td>
		</tr>
	</table>
	<?php
}
?>
</div>
</div>
