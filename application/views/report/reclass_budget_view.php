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
<h2>Reclass Budget<hr width="110px" align="left"></h2>
<div class="printed">
<form method="post" action="<?=base_url()?>print/print_reclass_account" id="formAdd" target="_blank">
   <table border="0">
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
	        <?php
				$tgl = date('d-m-Y');
	        ?>
			<td>As Off</td>
			<td>:</td>
			<td>
				<input type="text" name="tgl1" id="tgl1" value="<?=$tgl?>"  style="width:100px" readonly="true">
				<a href="JavaScript:;" onClick="return showCalendar('tgl1', 'dd-mm-y');" title="Pilih Tanggal" > 
				<img src="<?=base_url()?>assets/js/ico_calendar.gif" alt="s"/></a>			
			</td>
	   </tr>
	   <tr>
		   <td>Description Budget</td>
		   <td>:</td>
		   <td>
				<select name="code" id="code" style="width:120px">
					<?php foreach($data['item'] as $row): ?> 
						<option value="<?=$row->code?>">
							<?php echo $row->code ?> - <?php echo $row->descbgt ?>
						</option>
					<?php endforeach ?>
				</select>
		   </td>
	   </tr>
	   <tr>
			<td colspan="3">
				<input type="submit" name="klik" id="klik" value="Print"/>
			</td>
	   </tr>
   </table>
</form>
</div>
<?$this->load->view(ADMIN_FOOTER)?>



