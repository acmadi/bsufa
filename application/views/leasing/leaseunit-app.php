<script language="javascript" src="<?=base_url()?>assets/js/calendar.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/calendar2.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.form.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.validationEngine-enx.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.validationEnginex.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.numeric.js"></script>
<link rel="stylesheet" href="<?=base_url()?>assets/css/calendar.css" type="text/css" />

<link rel="stylesheet" href="<?=base_url()?>assets/css/menuku.css" type="text/css" />
<?=script('jquery.formx.js')?>

<? #tampilkan query?>
<script language="javascript">

$(function(){
$(document).ready(function(){
                        //~ $('#tr1').hide();
                        //~ $('#tr2').hide();
                        //~ $('#tr3').hide();
                        //~ $('#tr4').hide();
                        //~ $('#tr5').hide();
                        //~ $('#tr6').hide();
                        //~ $('#tr7').hide();
                        //~ $('#tr8').hide();
                        //~ $('#tr9').hide();
                        //~ $('#tr10').hide();
                        //~ $('#tr11').hide();
                        //~ $('#tr12').hide();
                        //~ $('#tr13').hide();
                        //~ $('#tr14').hide();
                        
            });

function loadData(type,parentId){
	  $('#loading').text('Loading '+type.replace('_','/')+' data...');
      $.post('<?=site_url('leaseunit/loaddata')?>',
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


	
	loadData('proj',0);
	loadData('floor',0);
	

	/*DropDown Menu*/
	$('#proj').change(function(){
			loadData('sub',$('#proj option:selected').val());
		});
	
	
	
		
	/*event hide form*/
	$('#sub').change(function(){
		
		//~ alert('tes');
		$.getJSON('<?=site_url('leaseunit/tampil')?>/'+$(this).val(),
				function(data){
					    $('#totarea').val(data.tot_luas_sewa);
						$('#leasarea').val(data.luas);
						$('#ablearea').val(data.sisa_luas);
						 
					    
					   
				});
		 
		 });
		 

	/*fungsi validasi numeric*/
	  
	  var kugiri = new RegExp(",", "g");
	  var rep_coma = new RegExp(",", "g");
	  $('.calculate').bind('keyup keypress',function(){
			//$(this).val($(this).val());
		  $(this).val(numToCurr($(this).val()));
			
			parseInt($("#price_meter").val().replace(kugiri,""));
		  
		  }).numeric();




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
		
});
</script>




<? /*$data=$this->mstmodel->group();*/ ?>


<!--
<link rel="stylesheet" href="<?=base_url()?>assets/css/menuform.css" type="text/css" />
-->
<form method='post' action='<?=site_url()?>leaseunit/EditUnitSewa' id='formadd'>
<table border="0" cellpadding="2" cellspacing="2">
	
  
    <!--Customer Profile-->
    <tr>
		<td colspan="3" style=""><font color='#FF0000'><b><u>EDIT UNIT LEASING</u></b></font></td>
    </tr>
    <tr>
		<td>Project</td>
		<td>:</td>
			<td><input  name='proj' id='proj' style='width:80' value="<?=@$data->nm_subproject?>" maxlength='10' class='validate[required]' ></td>	
	</tr>	
	<tr>
			<td >No Unit</td>
			<td>:</td>
			<td><input  name='nounit' id='nounit' style='width:80' value="<?=@$data->nounit?>" maxlength='10' class='validate[required]' ></td>
			<td><input  type='hidden' name='idunit' id='idunit' style='width:80' value="<?=@$data->id_unit?>" maxlength='10' class='validate[required]' ></td>
		</td>	
		
		
		
    </tr>
	<tr>
		
		<!--<td >Sub Project</td>
		<td>:</td>
		<td><select name='sub' id='sub'style='width:150' ></td>
		-->
				<td >Luas Unit</td>
			<td>:</td>
			<td><input  name='luasunit' id='luasunit' style='width:80' value="<?=@$data->luas?>" maxlength='10' class='validate[required]' ></td>
			
			

	</tr>
	<!--
	<tr id='tr2'>
		<td>Total Area</td>
		<td>:</td>
		<td><input name='totarea' id='totarea' style='background-color:#FFFF00;width:80' readonly></td>
		
			
			<td>Floor</td>
			<td>:</td>
			<td><select name='floor' id='floor' lass='validate[required]'></select></td>
			
			
	</tr>
	
	<tr id='tr2'>
		<td>Lease Area</td>
		<td>:</td>
		<td><input  name='leasarea' id='leasarea' style='background-color:#C0C0C0;width:80' readonly></td>
		
			
			<td>Direction</td>
			<td>:</td>
			<td><select name='arah' id='arah'>
				<option value='0'></option>
				<option >North</option>
				<option >South</option>
				<option >West</option>
				<option >East</option>
				
				</select></td>
		
			
	</tr>
	-->
	<tr>
	<!--	<td>Leaseable Area</td>
		<td>:</td>
		<td><input  name='ablearea' id='ablearea' style='background-color:#80FF00;width:80' readonly></td>
		-->
			
			
			
			<td>Price/m2</td>
			<td>:</td>
			<td><input type="text" name="harga_meter" id="harga_meter" value="<?=@$data->harga_meter?>"  class="validate[required] calculate" style='width:100;text-align:right' >
			
			
	</tr>
	<!--
	<tr>
		<td colspan='3'></td>
			<td>Status</td>
			<td>:</td>
			<td><select name='status' id='status'>
				<option value='0'></option>
				<option value='1'>Available</option>
				<option value='2'>Reserved</option>
				
				</select></td>
			
	</tr>
	-->
	

	<tr id='tr14'>
		<td colspan="3">
			<input type="submit" name="save" value="Save"/>
			<input type="reset" name="cancel" value="Cancel"/>
		</td>
	</tr>	
</table>
</form>
