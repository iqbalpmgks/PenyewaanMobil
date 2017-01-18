<?php include '../koneksi.php'; ?>

<div id="page-wrapper">
<div class="row">
	<div class="col-lg-12">
		<h3><span class="glyphicon glyphicon-list-alt"></span>  Detail Surat Terima Kendaraan (STK)</h3>
		<a class="btn" href="stk.php"><span class="glyphicon glyphicon-arrow-left"></span>  Kembali</a>

<?php
$no_stk		= mysql_real_escape_string($_GET['no_stk']);
$d				= mysql_fetch_array(mysql_query("SELECT a.id_mobil, a.no_stk, a.no_spsk, b.tgl_mulai, b.jam_keluar, g.merk, g.no_pol, g.warna, a.tgl_stk, a.pemeriksa_keluar, c.nama_penyewa, c.telp_penyewa, b.lama_sewa FROM stk a JOIN spsk b ON a.no_spsk = b.no_spsk JOIN penyewa c ON b.id_penyewa = c.id_penyewa JOIN periksa_keluar d ON a.no_stk = d.no_stk JOIN perlengkapan e ON d.id_perkap = e.id_perkap JOIN detail_mobil f ON b.no_spsk = f.no_spsk JOIN mobil g ON f.id_mobil = g.id_mobil WHERE a.no_stk='$no_stk' AND g.id_mobil = a.id_mobil GROUP BY a.id_mobil"));
	?>
	<table class="table">
		<tr>
			<th class="col-md-3">No. STK</th>
			<td><?php echo $d['no_stk'] ?></td>
		</tr>
		<tr>
			<th class="col-md-3">Tanggal STK</th>
			<td><?php echo $d['tgl_stk'] ?></td>
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
			<th class="col-md-3">Jam Keluar</th>
			<td><?php echo $d['jam_keluar'] ?></td>
		</tr>
		<tr>
			<th class="col-md-3">Merk Mobil</th>
			<td><?php echo $d['merk'] ?></td>
		</tr>
		<tr>
			<th class="col-md-3">No. Polisi</th>
			<td><?php echo $d['no_pol'] ?></td>
		</tr>
		<tr>
			<th class="col-md-3">Nama Penyewa</th>
			<td><?php echo $d['nama_penyewa'] ?></td>
		</tr>
		<tr>
			<th class="col-md-3">Pemeriksa</th>
			<td><?php echo $d['pemeriksa_keluar'] ?></td>
		</tr>
	</table>

	<table width="100%" class="table table">
		<tr align="center">
			<td align="center"><b>ID </b></td>
			<td align="center"><b>Nama Perlengkapan</b></td>
			<td align="center"><b>Kondisi Keluar</b></td>
			<td align="center"><b>Keterangan</b></td>
		</tr>
		<?php
		$no_stk		= mysql_real_escape_string($_GET['no_stk']);
		$det			= mysql_query("SELECT * FROM periksa_keluar a JOIN perlengkapan b ON a.id_perkap = b.id_perkap WHERE no_stk='$no_stk'")or die(mysql_error());
		while($d=mysql_fetch_array($det)){
		?>
		<tr>
			<td align="center"><?php echo $d['id_perkap'] ?></td>
			<td><?php echo $d['nama_perkap'] ?></td>
			<td align="center"><?php echo $d['kondisi_keluar'] ?></td>
			<td><?php echo $d['keterangan']; ?></td>
		</tr>
		<?php	} ?>
	</table>
</div>
</div>
