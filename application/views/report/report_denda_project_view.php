<? $this->load->view(ADMIN_HEADER) ?>
<script language="javascript" src="<?=base_url()?>assets/js/calendar.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/calendar2.js"></script>
<link rel="stylesheet" href="<?=base_url()?>assets/css/calendar.css" type="text/css" />
<link rel="stylesheet" href="<?=base_url()?>assets/css/menuform.css" type="text/css"/>
<script type="text/javascript">
	$(function(){
		/*$('#klik').click(function(){
			window.open();
		});*/
	});
</script>
<h2>Penalty Project<hr width="150px" align="left"></h2>
<div class="printed">
<form method="post" action="<?=base_url()?>print/print_denda_project" target="_blank">
<table border="0">
	<tr>
		<td>Periode Penalty of the Year</td>
		<td>:</td>
		<td>
			<select name="thn" id="thn" style="width:100px">
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
	 <?php
		$tgl = date('d-m-Y');
	 ?>	
	 <input type="hidden" name="tgl1" id="tgl1" value="<?=$tgl?>"  style="width:100px" readonly="true">

	<tr>
		<td colspan="3">
			<input type="submit" name="klik" id="klik" value="Print"/>
		</td>
	</tr>
</table>
</form>
</div>
<?$this->load->view(ADMIN_FOOTER)?>
