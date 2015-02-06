<? $this->load->view(ADMIN_HEADER) ?>
<script language="javascript" src="<?=base_url()?>assets/js/calendar.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/calendar2.js"></script>
<link rel="stylesheet" href="<?=base_url()?>assets/css/calendar.css" type="text/css" />

<script>
$(function(){
$(document).ready(function(){
			$('#thn').append('<option></option>');
			for(var i = 2013;i < 2021;i++){
				$('#thn').append($('<option></option>').val(i).text(i));
			}
		});
		
});

</script>
<h2>REPORT REQUEST BUDGET<hr width="110px" align="left"></h2>
<div class="printed">

<form action="<?=base_url()?>print/printrequest" method="POST" target="_blank">
	<?php
		$tgl = date('d-m-Y');
	?>
		<table border="0">
			
			<tr>
				<td>Tahun</td>
				<td>:</td>
				<td>
					<select name="thn" id="thn"></select>
				</td>
			</tr>

			<tr>
				<td>As Off</td>
				<td>:</td>
				<td>		
					<input type="text" name="tgl" id="tgl_aju" value="<?#=$tgl?>"  style="width:100px" readonly="true">
					<a href="JavaScript:;" onClick="return showCalendar('tgl_aju', 'dd-mm-y');" title="Pilih Tanggal" > 
					<img src="<?=base_url()?>assets/js/ico_calendar.gif" alt="s"/></a>
					
					<!--<input type="text" name="tgl1" id="tglx" value="<?#=$tgl?>"  style="width:100px" readonly="true">
					<a href="JavaScript:;" onClick="return showCalendar('tglx', 'dd-mm-y');" title="Pilih Tanggal" > 
					<img src="<?#=base_url()?>assets/js/ico_calendar.gif" alt="s"/></a>-->
				</td>
			</tr>

			<tr>
				<td>Division</td>
				<td>:</td>
				<td>		
					<select name="divisi">
					<option value="all" selected>All</option>
					<?php
					foreach($data['divisi'] as $row):
					?>
					<option value=<?=$row->divisi_id?>><?=$row->divisi_nm?></option>
					<?php endforeach ?>
					</select>
				</td>
			</tr>
		</table>		
		<input type="submit" name="kirim" value="Print"/>
</form>
 <?$this->load->view(ADMIN_FOOTER)?>
