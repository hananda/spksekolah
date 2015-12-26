<table class="table">
	<thead>
		<tr>
			<th>Ranking</th>
			<th>Nama Sekolah</th>
			<th>Point</th>
		</tr>
	</thead>
	<tbody>
		<?php 
			for ($i=0; $i < count($data) ; $i++) { 
		?>
		<tr>
			<td><?php echo ($i+1); ?></td>
			<td><?php echo $data[$i]["sekolah_nama"]; ?></td>
			<td><?php echo $data[$i]["nilai_akhir"]; ?></td>
		</tr>
		<?php		
			}
		?>
	</tbody>
</table>