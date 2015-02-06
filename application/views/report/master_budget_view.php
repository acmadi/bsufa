<? $this->load->view(ADMIN_HEADER) ?>
<link rel="stylesheet" href="<?=base_url()?>assets/css/menuform.css" type="text/css"/>
<script type="text/javascript">
	$(function(){
		/*$('#klik').click(function(){
			window.open();
		});*/
	});
</script>
<h2>Original / Current Budget<hr width="150px" align="left"></h2>
<div class="printed">
<form method="post" action="<?=base_url()?>print/print_master_budget" id="formAdd" target="_blank">
<table>	
	<tr>
		<td>Budget Year</td>
		<td>:</td>
		<td>
			<select name="thn" id="thn" style="width:120px">
				<?php
					for($i=2011;$i<2026;$i++):
				?>
					<option><?=$i?></option>
				<?php
					endfor;
				?>
			</select>
		</td>
	</tr>
	<tr>
	   <td>Choose Budget</td>
	   <td>:</td>
		<td>
			<select name="budget" id="budget" style="width:120px"> 
				<option value="1">Original Budget</option>
				<option value="2">Current Budget</option>
			</select>
		</td>
	</tr>
	<tr>
	   <td>Divisi</td>
	   <td>:</td>
		<td>
			<select name="divisi" id="divisi" style="width:120px">
				<?php foreach($data['divisi'] as $row):?>
					<option value="<?=$row->divisi_id?>"><?=$row->divisi_nm?></option>
				<?php endforeach ?>
			</select>
		</td>
	</tr>
	<tr>
		<td colspan="2">
			<input type="submit" name="klik" id="klik" value="Print"/>
		</td>
	</tr>
</table>
</form>
</div>
<?$this->load->view(ADMIN_FOOTER)?>


