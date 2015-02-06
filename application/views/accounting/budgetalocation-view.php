<?php //var_dump($data);?>

<form action="<?=site_url();?>accounting/budgetalocation/set_alokasi" method="post">
<table width="100%" align="center" border=1>
	<tr height="40px">
		<td>Kode Project</td>
		<td>Nama Project</td>
		<td>Persen Alokasi</td>
	</tr>
	<tr>
		<td>
			<?=$data->subproject_id;?>
			<input type="hidden" name="kodeproject" value='<?=$data->subproject_id;?>'>
		</td>
		<td>
			<?=$data->nm_subproject;?>
			<input type="hidden" name="namaproject" value='<?=$data->nm_subproject;?>'>
		</td>
		<td><input type="text" name="persen"></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td>
			<input type="text" name="url" value='<?=$this->uri->segment(2);?>'>
			<input type="submit" name="submit" value="save">
		</td>
	</tr>
</table>
</form>