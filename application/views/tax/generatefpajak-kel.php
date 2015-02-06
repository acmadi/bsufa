
<script language="javascript" src="<?=base_url()?>assets/js/calendar2.js"></script>

<script language="javascript" src="<?=base_url()?>assets/js/jquery.numeric.js"></script>
<link rel="stylesheet" href="<?=base_url()?>assets/css/calendar.css" type="text/css" />

<style>


	.mytextbox {
		font: 12px Arial, Helvetica, sans-serif;
	    border: 1px solid #008B8B;
	    padding: 5px;
	   
	}
	.mytextboxx {
	font: 14px Arial, Helvetica, sans-serif;

		width: 90px;
		height: 42px;
	border: 1px solid #EFFC94;
		background: #B9B9B9;
		color: #5D781D;  
	}

	td {
		
		padding: 6px 5px 2px 5px;
		border: 0px solid #DEDEDE;
		text-transform: uppercase;
		font: normal 11px Arial, Helvetica, sans-serif;
		color: #5D781D;1px solid #D6DDE6;
	   
	}
</style>




<form action="<?php echo site_url('generatefpajakel/inpajnom')?>" method="post" enctype="multipart/form-data" role="form"> 		
  	<table>  
	
		<tr>
			<td>No. AP</td>
			<td> : </td>
			<td><input type="text" name="noap" class="mytextbox" value="<?=$to->no_invoice; ?>" disabled readonly /> </td>
		</tr>	
	  	<tr>
			<td>Nomor Faktur Pajak</td>
			<td> : </td>
			<td><input type="text" name="nom" class="mytextbox"/> </td>
		</tr>	
	  	<tr>
			<td>Tanggal Faktur Pajak</td>
			<td> : </td>
			<td><input type="text" name="tglo" id="tglo" style="width:190px" class="xinput validate[required] mytextbox" readonly="true">
			<a href="JavaScript:;" onClick="return showCalendar('tglo', 'dd-mm-y');" title="Pilih Tanggal" > <img src="<?=base_url()?>assets/js/ico_calendar.gif" width="20px" height="20px" alt="s"/></a>
	</td>
		</tr>	
	  	<tr>
			<td>TTD Faktur Pajak</td>
			<td> : </td>
			<td><input type="text" name="ttd" class="mytextbox" value="ZAINAL FAIZ"/> </td>
		</tr>	
	  	<input type="hidden" name="ppn" class="mytextbox" value="<?=$to->tax_amount; ?>"/>
		<input type="hidden" name="noap" class="mytextbox" value="<?=$to->no_invoice; ?>"/>
		<tr>
		  	<td><input type="submit" value="Save" id="submit" name="submit" class="mytextboxx" /></td>  
	    </tr>
  	</table>  
</form>
