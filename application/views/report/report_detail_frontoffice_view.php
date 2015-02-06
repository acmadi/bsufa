<? $this->load->view(ADMIN_HEADER) ?>
<script language="javascript" src="<?=base_url()?>assets/js/calendar.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/calendar2.js"></script>
<link rel="stylesheet" href="<?=base_url()?>assets/css/calendar.css" type="text/css" />
<link rel="stylesheet" href="<?=base_url()?>assets/css/menuform.css" type="text/css"/>




<h2><font color='red' size='4'>FRONT OFFICE REPORT<hr width="150px" align="left"></font></h2>
<div class="printed">
<form method="post" action="<?=base_url()?>print/print_detail_frontoffice" target="_blank">
<table border="0">
	
	    <tr>
		<td>Venue</td>
		<td>:</td>
		<td>
			<select name="venue" id="venue" class="xinput validate[required]" >
				<option></option>
				<option value='1'>MORE</option>
				<option value='2'>MO YOGYA</option>
		</td>
						
	</tr>
	    
	    
	    <tr>
		<td>Periode</td>
		<td>:</td>
		<td>
			<input type="text" style="width:100px" name="start_date" id="start_date" class="xinput validate[required]" readonly="true">
			<a href="JavaScript:;" onClick="return showCalendar('start_date', 'dd-mm-y');" title="Pilih Tanggal" > <img src="<?=base_url()?>assets/js/ico_calendar.gif" alt="s"/></a>
		
		</td>
		<td>To</td>
		<td>:</td>
		<td>
			<input type="text" style="width:100px" name="end_date" id="end_date" class="xinput validate[required]" readonly="true">
			<a href="JavaScript:;" onClick="return showCalendar('end_date', 'dd-mm-y');" title="Pilih Tanggal" > <img src="<?=base_url()?>assets/js/ico_calendar.gif" alt="s"/></a>
				
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
