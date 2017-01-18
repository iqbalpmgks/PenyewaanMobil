<?php include '../koneksi.php'; ?>

<div id="page-wrapper">
<div class="row">
	<div class="col-lg-12">
		<h3><span class="glyphicon glyphicon-list-alt"></span>  Detail SPSK</h3>
		<a class="btn pull-right" href="spsk.php"><span class="glyphicon glyphicon-arrow-left"></span>  Kembali</a></br>

		<?php
		$no_spsk		= mysql_real_escape_string($_GET['no_spsk']);
		$detail			= mysql_fetch_array(mysql_query("SELECT * FROM spsk a JOIN detail_mobil b ON a.no_spsk = b.no_spsk JOIN penyewa c ON a.id_penyewa = c.id_penyewa WHERE a.no_spsk='$no_spsk'"));
		?>

			<div class="form-group row">
				<label class="col-md-2 form-control-label" for="text-input">No. SPSK</label>
				<div class="col-md-3">
					<input type="text" id="no_spsk" name="no_spsk" class="form-control" placeholder="No. SPSK" value="<?php echo $detail['no_spsk'] ?>" readonly>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-md-2 form-control-label" for="text-input">Tanggal SPSK</label>
				<div class="col-md-4">
					<input type='text' id="no_spsk" name="no_spsk" class="form-control" placeholder="Tanggal SPSK" value="<?php echo $detail['tgl_spsk'] ?>" readonly>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-md-2 form-control-label" for="text-input">Nama Penyewa</label>
				<div class="col-md-5">
					<input type='text' id="no_spsk" name="no_spsk" class="form-control" placeholder="Nama Penyewa" value="<?php echo $detail['nama_penyewa'] ?>" readonly>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-md-2 form-control-label" for="text-input">Lama Sewa</label>
				<div class="col-md-2">
					<input type='text' id="no_spsk" name="no_spsk" class="form-control" placeholder="Lama Sewa" value="<?php echo $detail['lama_sewa'] ?> hari" readonly>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-md-2 form-control-label" for="text-input">Jam Keluar</label>
				<div class="col-md-3">
					<input type='text' id="no_spsk" name="no_spsk" class="form-control" placeholder="Jam Keluar" value="<?php echo $detail['jam_keluar'] ?>" readonly>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-md-2 form-control-label" for="text-input">Jenis Bayar</label>
				<div class="col-md-2">
					<input type='text' id="no_spsk" name="no_spsk" class="form-control" placeholder="Jenis Bayar" value="<?php echo $detail['jns_bayar'] ?>" readonly>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-md-2 form-control-label" for="text-input">Total Harga</label>
				<div class="col-md-4">
					<input type='text' id="no_spsk" name="no_spsk" class="form-control" placeholder="Total Harga" value="Rp. <?php echo $detail['subtotal'] ?>" readonly>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-md-2 form-control-label" for="text-input">Lokasi</label>
				<div class="col-md-5">
					<input type='text' id="no_spsk" name="no_spsk" class="form-control" placeholder="Lokasi" value="<?php echo $detail['lokasi'] ?>" readonly>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-md-2 form-control-label" for="text-input">Jaminan</label>
				<div class="col-md-4">
					<input type='text' id="no_spsk" name="no_spsk" class="form-control" placeholder="Jaminan" value="<?php echo $detail['jaminan'] ?>" readonly>
				</div>
			</div>

		<table width="100%" class="table table">
			<tr align="center">
				<td align="center"><b>ID Mobil</b></td>
				<td align="center"><b>Merk</b></td>
				<td align="center"><b>Jasa Supir</b></td>
				<td align="center"><b>Tanggal Mulai</b></td>
				<td align="center"><b>Tanggal Selesai</b></td>
			</tr>
			<?php
			$no_spsk		= mysql_real_escape_string($_GET['no_spsk']);
			$det				= mysql_query("SELECT * FROM spsk a JOIN detail_mobil b ON a.no_spsk = b.no_spsk JOIN mobil c ON b.id_mobil = c.id_mobil JOIN penyewa d ON a.id_penyewa = d.id_penyewa WHERE a.no_spsk='$no_spsk'")or die(mysql_error());
			while($d=mysql_fetch_array($det)){
			?>
			<tr>
				<td align="center"><?php echo $d['id_mobil'] ?></td>
				<td><?php echo $d['merk'] ?></td>
				<td align="center"><?php echo $d['jasa_supir'] ?></td>
				<td align="center"><?php echo $d['tgl_mulai'] ?></td>
				<td align="center"><?php echo $d['tgl_selesai'] ?></td>
			</tr>
			<?php	} ?>
		</table>
	</div>
</div>
