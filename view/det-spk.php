<?php include '../koneksi.php'; ?>

<div id="page-wrapper">
<div class="row">
	<div class="col-lg-12">
		<h3><span class="glyphicon glyphicon-list-alt"></span>  Detail Surat Perintah Kerja (SPK)</h3>
		<a class="btn" href="spk.php"><span class="glyphicon glyphicon-arrow-left"></span>  Kembali</a>

<?php
$no_spk	= mysql_real_escape_string($_GET['no_spk']);
$det			= mysql_query("SELECT * FROM spk a JOIN supir b ON a.id_supir = b.id_supir JOIN spsk c ON a.no_spsk = c.no_spsk JOIN penyewa d ON c.id_penyewa = d.id_penyewa JOIN detail_mobil e ON a.id_mobil = e.id_mobil JOIN mobil f ON e.id_mobil = f.id_mobil WHERE a.no_spk='$no_spk'");
while($d=mysql_fetch_array($det)){
	?>
	<table class="table">
		<tr>
			<th class="col-md-3">No. SPK</th>
			<td><?php echo $d['no_spk'] ?></td>
		</tr>
		<tr>
			<th class="col-md-3">Tanggal SPK</th>
			<td><?php echo $d['tgl_spk'] ?></td>
		</tr>
		<tr>
			<th class="col-md-3">ID Supir</th>
			<td><?php echo $d['id_supir'] ?></td>
		</tr>
		<tr>
			<th class="col-md-3">Nama Supir</th>
			<td><?php echo $d['nama_supir'] ?></td>
		</tr>
		<tr>
			<th class="col-md-3">No. Telepon Supir</th>
			<td><?php echo $d['telp_supir'] ?></td>
		</tr>
		<tr>
			<th class="col-md-3">No. SPSK</th>
			<td><?php echo $d['no_spsk'] ?></td>
		</tr>
		<tr>
			<th class="col-md-3">Lama Sewa</th>
			<td><?php echo $d['lama_sewa'] ?></td>
		</tr>
		<tr>
			<th class="col-md-3">No. Polisi</th>
			<td><?php echo $d['no_pol'] ?></td>
		</tr>
		<tr>
			<th class="col-md-3">Merk</th>
			<td><?php echo $d['merk'] ?></td>
		</tr>
		<tr>
			<th class="col-md-3">Nama Penyewa</th>
			<td><?php echo $d['nama_penyewa'] ?></td>
		</tr>
		<tr>
			<th class="col-md-3">Alamat</th>
			<td><?php echo $d['alamat_penyewa'] ?></td>
		</tr>
		<tr>
			<th class="col-md-3">No. Telp</th>
			<td><?php echo $d['telp_penyewa'] ?></td>
		</tr>
	</table>
	<?php
}
?>
</div>
</div>
