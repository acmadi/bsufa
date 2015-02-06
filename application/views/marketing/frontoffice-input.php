
<script language="javascript" src="<?=base_url()?>assets/js/calendar.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/calendar2.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.formx.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.validationEngine-enx.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.validationEnginex.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.numeric.js"></script>
<link rel="stylesheet" href="<?=base_url()?>assets/css/calendar.css" type="text/css" />

<script language="javascript">

/*validation form*/
$(function(){
		$('#formadd')
		.validationEngine()
		.ajaxForm({
			success:function(response){
				if(response == 4){
					alert("Data Berhasil Disimpan");
					refreshTable();
				}else{
				    alert(response);
				 }
			
		}
		});	
		
		
		
	});			
	
</script>

<link rel="stylesheet" href="<?=base_url()?>assets/css/menuform.css" type="text/css" />
<form method='post' action='<?=site_url()?>frontoffice/InputFO' id='formadd'>

<table border="0" cellpadding="2" cellspacing="2">
	
  
    <!--Customer Complaint-->
    <tr>
		<td colspan="3" style=""><b>Input Guest Book</b></td>
    </tr>
    <tr>
		<td>Date</td>
		<td>:</td>
		<td>
			<input type="text" name="tgl" id="tgl"  value="<?=$tgl = date("d-m-Y");  ?>" style="width:75px" readonly>
		</td>
						
	</tr>
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
		<td>Guest Name</td>
		<td>:</td>
		<td>
			<input name="nama" id="nama"  class="xinput validate[required]" style='width:150px'></select>
		</td>
			
	</tr>	
	<tr>
		<td>Contact Person</td>
		<td>:</td>
		<td>
			<input name="pic"  id="pic" class="xinput validate[required]">
		</td>
		
		
	</tr>
	<tr>
		<td>Source</td>
		<td>:</td>
		<td>
			<select name="source" id="source" class="xinput validate[required]" >
				<option></option>
				<option>Appointment</option>
				<option>Incoming Call</option>
				<option>Walk In</option>
		</td>
		
		
	</tr>
		
	<tr>
		<td>Tujuan</td>
		<td colspan ='3'></td>
	</tr>	
		<tr>
			<td colspan ='6'><textarea name='tujuan' style='width:400px'></textarea></td>
		</tr>
	</tr>
	
		
		
		
		<tr>
		<td colspan="3">
			<input type="submit" name="save" value="Save"/>
			<input type="reset" name="cancel" value="Cancel"/>
		</td>
	</tr>	
</table>
</form>
