<?php
mysql_connect("localhost","root","root");
mysql_select_db("db_rentmobil");
?>
<table class="data">
	<tr>
		<th>ID Perlengkapan</th>
		<th>Nama Perlengkapan</th>
		<th>Kondisi</th>
	</tr>
	<?php
	$data = mysql_query("SELECT * FROM temp_kondisi");
	while($d=mysql_fetch_array($data)){
	?>
	<tr>
		<td><?php echo $d['id_perkap'] ?></td>
		<td><?php echo $d['nama_perkap'] ?></td>
		<td><?php echo $d['kondisi'] ?></td>
	</tr>
	<?php } ?>
</table>
