<?php include '../koneksi.php'; ?>

<div id="page-wrapper">
<div class="row">
	<div class="col-lg-12">
		<h3><span class="glyphicon glyphicon-list-alt"></span>  Detail Pengembalian</h3>
		<a class="btn" href="pengembalian.php"><span class="glyphicon glyphicon-arrow-left"></span>  Kembali</a>

<?php
$no_pengembalian		= mysql_real_escape_string($_GET['no_pengembalian']);
$d				= mysql_fetch_array(mysql_query("SELECT a.no_pengembalian, a.tgl_pengembalian, b.no_stk, c.jam_keluar, d.id_mobil, e.nama_penyewa, a.pemeriksa_masuk, a.jam_masuk, a.telat FROM pengembalian a JOIN stk b ON a.no_stk = b.no_stk JOIN spsk c ON b.no_spsk = c.no_spsk JOIN detail_mobil d ON c.no_spsk = d.no_spsk JOIN penyewa e ON c.id_penyewa = e.id_penyewa WHERE a.no_pengembalian='PNG0001'"));
	?>
	<table class="table">
		<tr>
			<th class="col-md-3">No. Pengembalian</th>
			<td><?php echo $d['no_pengembalian'] ?></td>
		</tr>
		<tr>
			<th class="col-md-3">Tanggal Pengembalian</th>
			<td><?php echo $d['tgl_pengembalian'] ?></td>
		</tr>
		<tr>
			<th class="col-md-3">No. STK</th>
			<td><?php echo $d['no_stk'] ?></td>
		</tr>
		<tr>
			<th class="col-md-3">Jam Keluar</th>
			<td><?php echo $d['jam_keluar'] ?></td>
		</tr>
		<tr>
			<th class="col-md-3">ID Mobil</th>
			<td><?php echo $d['id_mobil'] ?></td>
		</tr>
		<tr>
			<th class="col-md-3">Nama Penyewa</th>
			<td><?php echo $d['nama_penyewa'] ?></td>
		</tr>
		<tr>
			<th class="col-md-3">Pemeriksa</th>
			<td><?php echo $d['pemeriksa_masuk'] ?></td>
		</tr>
		<tr>
			<th class="col-md-3">Jam Masuk</th>
			<td><?php echo $d['jam_masuk'] ?></td>
		</tr>
		<tr>
			<th class="col-md-3">Keterlambatan</th>
			<td><?php echo $d['telat'] ?></td>
		</tr>
	</table>

	<table width="100%" class="table table">
		<tr align="center">
			<td align="center"><b>ID </b></td>
			<td align="center"><b>Nama Perlengkapan</b></td>
			<td align="center"><b>Kondisi Masuk</b></td>
			<td align="center"><b>Keterangan</b></td>
		</tr>
		<?php
		$no_pengembalian		= mysql_real_escape_string($_GET['no_pengembalian']);
		$det			= mysql_query("SELECT * FROM periksa_masuk a JOIN perlengkapan b ON a.id_perkap = b.id_perkap WHERE no_pengembalian='$no_pengembalian'")or die(mysql_error());
		while($d=mysql_fetch_array($det)){
		?>
		<tr>
			<td align="center"><?php echo $d['id_perkap'] ?></td>
			<td><?php echo $d['nama_perkap'] ?></td>
			<td align="center"><?php echo $d['kondisi_masuk'] ?></td>
			<td><?php echo $d['keterangan']; ?></td>
		</tr>
		<?php	} ?>
	</table>
</div>
</div>
