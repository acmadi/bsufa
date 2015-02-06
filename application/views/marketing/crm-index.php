<script language="javascript" src="<?=base_url()?>assets/js/jquery-1.4.2.min.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.numeric.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/currency.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/calendar.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/calendar2.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.confirm.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jsalert.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.formx.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.formx.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.validationEngine-enx.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.validationEnginex.js"></script>
<link rel="stylesheet" href="<?=base_url()?>assets/css/jquery-ui.css" type="text/css" />
<link rel="stylesheet" href="<?=base_url()?>assets/css/calendar.css" type="text/css" />
<script language="javascript">

$(function(){

function loadData(type,parentId){
	  $('#loading').text('Loading '+type.replace('_','/')+' data...');
      $.post('<?=site_url('marketing/crm/loaddata')?>',
		{data_type: type, parent_id: parentId},
		function(data){
		 
		  
		  if(data.error == undefined){ 
			 $('#'+type).empty();
			 $('#'+type).append('<option></option>');
			 for(var x=0;x<data.length;x++){
			 	$('#'+type).append($('<option></option>').val(data[x].id).text(data[x].nama));
			 }
			 $('#loading').text('');
		  }else{
			 alert(data.error);
			 //$('#cb_karycutials').text('');
		  }
		},'json' 
      );      
   }


	loadData('project_nm',0); 	
	loadData('customer',0); 
	loadData('bulan',0); 
	loadData('agama',0); 
	loadData('sex',0);
	
});
</script>



<?php
//$data = $this->mstmodel->projectnm();
//$data1 = $this->mstmodel->globalresult('db_karysek');
//$data2 = $this->mstmodel->globalresult('db_agama');
//var_dump($data);
?>
<form>
<table>
	<tr>
		<td>Project</td>
		<td>:</td>
		<td><input type="radio" value='1' name="proj">All Project</td>
		<td><input type="radio" value='2' name="proj">Per Project</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>:</td>
		<td colspan='2' ><select name='proj_nm' id='project_nm'></select></td>
	</tr>
	
	<tr>
		<td>Customer</td>
		<td>:</td>
		<td><input type="radio" value='1' name="tr">All Customer</td>
		<td><input type="radio" value='2' name="tr" >Per Customer</td>
	</tr>
	
	<tr>
		<td>&nbsp;</td>
		<td>:</td>
		<td colspan='2'><select name='customer' id='customer'></select> </td>
	</tr>
	<tr>
		<td>Profesi</td>
		<td>:</td>
		<td colspan='2'><select>
				<?php foreach($data as $row): ?>
					<option><?=$row->nm_project?></option>
				<?php endforeach; ?>
			</select> </td>
	</tr>
	<tr>
		<td>Month of Birth</td>
		<td>:</td>
		<td><select name="bulan" id="bulan"></select>
		</td>
	</tr>
	<tr>
		<td>Religion</td>
		<td>:</td>
		<td colspan='2'><select name="agama" id="agama"></select> </td>
	</tr>
	<tr>
		<td>Sex</td>
		<td>:</td>
		<td colspan='2'><select name="sex" id="sex"></select> </td>
		
	</tr>
	<tr>
		<td>City</td>
		<td>:</td>
		<td><select>
				<option>adsdasd</option>
			</select>
		</td>
	</tr>
	
	<tr>
		<td><input type="submit" name="cari" value="Search" ></td>
		<td colspan='2'><input type="reset" name="cari" value="Released" ></td>
		
	</tr>
</table>
</form>
