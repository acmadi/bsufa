

<? $this->load->view(ADMIN_HEADER) ?>
<?=link_tag(CSS_PATH.'menuform.css')?>
<?=script('jquery-1.4.2.min.js')?>


<script language="javascript" src="<?=base_url()?>assets/js/calendar.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/calendar2.js"></script>
<link rel="stylesheet" href="<?=base_url()?>assets/css/calendar.css" type="text/css" />
<link rel="stylesheet" href="<?=base_url()?>assets/css/menuform.css" type="text/css"/>
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
				
});	


</script>

<h2><font color='red' size='4'>All PR Report<hr width="150px" align="left"></font></h2>
<div class="printed">
<form method="post" action="<?=site_url('procurement/print_allreportpr/print_reportpr')?>" target="_blank">

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
				<option value=<?=$row->id ?>><?=$row->div ?></option>
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
				<option value=<?=$row->kd_supp ?>><?=$row->nm_supp ?></option>
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
			<input type="text" style="width:100px" name="start_date" id="start_date" class="xinput validate[required]" readonly="true">
			<a href="JavaScript:;" onClick="return showCalendar('start_date', 'dd-mm-y');" title="Pilih Tanggal" > <img src="<?=base_url()?>assets/js/ico_calendar.gif" alt="s"/></a>
		</td>
		<td>To</td>
		<td>
			<input type="text" style="width:100px" name="end_date" id="end_date" class="xinput validate[required]" readonly="true">
			<a href="JavaScript:;" onClick="return showCalendar('end_date', 'dd-mm-y');" title="Pilih Tanggal" > <img src="<?=base_url()?>assets/js/ico_calendar.gif" alt="s"/></a>
		</td>
	</tr>
	<tr><td><input type="submit" name="save" value="Print" style="width:100px"/></td></tr>
	</table>
	


</form>
	
</div>
<?php
$this->load->view(ADMIN_FOOTER);
?>


