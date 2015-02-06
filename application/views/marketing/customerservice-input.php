<script language="javascript" src="<?=base_url()?>assets/js/calendar.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/calendar2.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.formx.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.validationEngine-enx.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.validationEnginex.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.numeric.js"></script>
<link rel="stylesheet" href="<?=base_url()?>assets/css/calendar.css" type="text/css" />




<script language="javascript">

//FUNGSI LOAD DATA
	function loadData(type,parentId){
	  $('#loading').text('Loading '+type.replace('_','/')+' data...');
      $.post('<?=site_url('customerservice/loaddata')?>',
		{data_type: type, parent_id: parentId},
		function(data){
		 
		   if(data.error == undefined){ 
			 $('#'+type).empty();
			 $('#'+type).append($('<option></option>').val('').text(''));
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

loadData('namacustomer',0);
loadData('subproject',0);
loadData('tipe',0);
loadData('divisi',0);


//dropdown select
$('#tipe').change(function(){
			loadData('tipedesc',$('#tipe option:selected').val());
		});



//Dropdown tipe input
$('#namacustomer').change(function(){
		$.getJSON('<?=site_url('customerservice/data')?>/'+$(this).val(),
				function(data){
					   $('#hp').val(data.customer_hp);
					   $('#alamat').val(data.customer_alamat1);
					   $('#kota').val(data.kota_nm);
					    
					   
				});
		 });

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
<form method='post' action='<?=site_url()?>customerservice/InputCustomerComplaint' id='formadd'>

<table border="0" cellpadding="2" cellspacing="2">
	
  
    <!--Customer Complaint-->
    <tr>
		<td colspan="3" style=""><b>Customer Complaint</b></td>
    </tr>
    <tr>
		<td>Date</td>
		<td>:</td>
		<td>
			<input type="text" name="complaintdate"  value="<?=$tgl = date("d-m-Y");  ?>" style="width:75px"readonly="true">
		</td>
		
		<td>Complaint Type</td>
		<td>:</td>
		<td>
			<select type="text" name="tipe" id='tipe' style='width:150px'>
		</td>
		
			
	</tr>
	<tr>
		<td>Customer Name</td>
		<td>:</td>
		<td>
			<select name="namacustomer" id='namacustomer' class="xinput validate[required]" style='width:150px'></select>
		</td>
		
		<td>Complaint Description</td>
		<td>:</td>
		<td>
			<select type="text" name="tipedesc" id='tipedesc' style='width:150px'>
		</td>
	</tr>	
	<tr>
		<td>Phone</td>
		<td>:</td>
		<td>
			<input name="hp" id='hp'  readonly>
		</td>
		
		<td>Complaint Disposition</td>
		<td>:</td>
		<td>
			<select type="text" name="divisi" id='divisi' style='width:150'>
		</td>
	</tr>
	<tr>
		<td>Address</td>
		<td>:</td>
		<td colspan='4'>
			<input name="customernama" id='alamat' style="width:500px" readonly >
		</td>
	</tr>
	<tr>
		<td>City</td>
		<td>:</td>
		<td>
			<input name="kota" id='kota' style="width:150px" readonly >
		</td>
	</tr>
	<tr>
		<td>Project</td>
		<td>:</td>
		<td>
			<select name="subproject" id='subproject' style="width:150px"></select>
		</td>
	</tr>
	<tr>
		<td>Document CS</td>
		<td></td>
		<td><input type="hidden" name="checkbox" value="0" /> <input type="checkbox" name="checkbox" value="1" /></td>
	</tr>
	<tr>
		<td>Note</td>
		<td colspan ='3'></td>
	</tr>	
		<tr>
			<td colspan ='6'><textarea name='note' style='width:400px'></textarea></td>
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
