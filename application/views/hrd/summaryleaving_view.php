
<?
$this->load->view(ADMIN_HEADER);
?>

<link rel="stylesheet" href="<?=base_url()?>assets/css/easyui.css" type="text/css" />
<link rel="stylesheet" href="<?=base_url()?>assets/css/icon.css" type="text/css" />
<link rel="stylesheet" href="<?=base_url()?>assets/css/demo.css" type="text/css" />

<script language="javascript" src="<?=base_url()?>assets/js/jquery-1.7.2.min.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.easyui.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/jquery.edatagrid.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/calendar.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/calendar2.js"></script>

<script language="javascript">
$(function(){ 
	
	$('#div').change(function(){
		
			dip = $('#div option:selected').text();
			//alert(dip);
			$('#dipisi').val(dip);
		});
});		

</script>


			


</script>

<h2><font color='red' size='4'>Summary Leaving per Division Report<hr width="150px" align="left"></font></h2>
<div class="printed">
<form method="post" action="<?=site_url('hrdreport/print_sumary')?>" target="_blank">

<table>
	<tr>
		<td>Division Name </td>
		<td>:</td>
		<td colspan="4">
			<select name="div" id="div" class="xinput" style="width:150px">
				<option></option>
			<? foreach($div as $row) { ?>
				<option value="<?=$row->divisi_id; ?>"><?=$row->divisi_nm; ?></option>
			<? } ?>
			</select>
		</td>
	</tr>
	
	<tr>
		<td>Periode</td>
		<input type="hidden" id="dipisi" name="dipisi" >
		<td>:</td>
<input type="hidden" id="dipisi" name="dipisi" >
		<td colspan="4">
			<select name="years" id="years" class="xinput" style="width:150px">
				<option></option>
			<? for($a = 2010;$a <= 2020;$a++){ ?>
				<option value="<?=$a; ?>"><?=$a; ?></option>
				
			<?  } ?>
			</select>
		</td>
	</tr>
	
	
	
	<tr><td><input type="submit" name="save" value="Print" style="width:100px"/></td></tr>
	</table>
	


</form>
	
</div>
<?php
$this->load->view(ADMIN_FOOTER);
?>


