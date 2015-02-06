
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
//LOADPERTAMA
$(document).ready(function(){
		$('#z_hide').hide();
		$('#x_hide').hide();
	
			});
$(function(){	
	$('#kat').change(function(){
		 if($('#kat option:selected').val()=='1'){
			 	$('#z_hide').show();
			 	$('#x_hide').hide();
		}else if ($('#kat option:selected').val()=='3'){
				$('#x_hide').hide();
				$('#z_hide').hide();
		}else{
				$('#x_hide').show();
				$('#z_hide').hide();
		}    
	});
	
		$('#start_date').datebox({  
        required:true  
    });  
    
    $('#end_date').datebox({  
        required:true  
    });  
				
});	


</script>

<h2><font color='red' size='4'>All PR Report<hr width="150px" align="left"></font></h2>
<div class="printed">
<form method="post" action="<?=site_url('procurement/print_allreportprgmi/print_reportpr')?>" target="_blank">

<table>
	<tr>
		<td>Kategori</td>
		<td>:</td>
		<td colspan="4">
			<select name="kat" id="kat" class="xinput">
				<option value="0">Pilih Kategori</option>
				<option value="1">Divisi</option>
				<option value="2">Vendor</option>
				<option value="3">ALL</option>
				
				
			</select>
		</td>
	</tr>
	<tr id="z_hide">
		<td>Divisi</td>
		<td>:</td>
		<td colspan="4">
			<select name="div" id="div" class="xinput">
				<option></option>
				<?php foreach($data['div'] as $row): ?>
				<option value=<?=$row->divisi_id ?>><?=$row->divisi_nm ?></option>
				<?php endforeach; ?>
			</select>
		</td>
	</tr>
	<tr>
	<tr id="x_hide">
		<td>Vendor</td>
		<td>:</td>
		<td colspan="4">
			<select name="ven" id="ven" class="xinput">
				<option></option>
				<?php foreach($data['ven'] as $row): ?>
				<option value=<?=$row->kd_supplier ?>><?=$row->nm_supplier ?></option>
				<?php endforeach; ?>
			</select>
		</td>
	</tr>
	<tr>
	<tr>
		<? $tgl = date("d-m-Y");?>
		<td>Date</td>
		<td>:</td>
		<td>
			<input type="text" name="start_date" id="start_date" class="required" style="width:120px">
		</td>
		<td>To</td>
		<td>
			<input type="text" name="end_date" id="end_date" class="required" style="width:120px">
		</td>
	</tr>
	<tr><td><input type="submit" name="save" value="Print" style="width:100px"/></td></tr>
	</table>
	


</form>
	
</div>
<?php
$this->load->view(ADMIN_FOOTER);
?>


