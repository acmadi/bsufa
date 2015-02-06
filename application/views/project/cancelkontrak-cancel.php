<?=link_tag(CSS_PATH.'menuform.css')?>
<?=script('jquery.numeric.js')?>
<?=script('currency.js')?>
<?=script('jquery.validationEngine-enx.js')?>
<?=script('jquery.validationEnginex.js')?>
<?=script('jquery.formx.js')?>

<script type="text/javascript">



	$(function(){
		$('#formAdd')
		.validationEngine()
		.ajaxForm({
			success:function(response){
			alert(response);
			refreshTable();
			$('#btnReset').click();

		}
		});	
		$("#tidak").change(function(){
	//alert('tes');
	//$('#amount').val(0);
refreshTable();
		});	
	});
	
		//Dropdown Menu
function loadData(type,parentId){
	  $('#loading').text('Loading '+type.replace('_','/')+' data...');
      $.post('<?=site_url('workinginst/dropdown')?>',
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
   
loadData('project',0);
/*DropDown Menu*/
	$('#project').change(function(){
			loadData('addbgt',$('#project option:selected').val());
		});


</script>

<form method="post" id="formAdd" action="<?=base_url()?>workinginst/ok"> 
<input type="hidden" name="id" id="id" value="<?=@$id?>" >

<table>
	<tr> 
	<td>No. Void</td>
			<td>:</td>
		<td><input type="text" name="no_void" id="no_void"  size="30" /></td>
	
	</tr>
	<tr>
			
			<td colspan='3'><u>ALOKASI</u></td>
		</tr>
		<tr>
			
			<td colspan='2'><select name='project' id='project'></select></td>
		
			
			<td><select name='addbgt' id='addbgt'></select></td>
			
		</tr>
	</table>
	<table>
	<tr> 
	<td>Keterangan</td>
			<!--<td>:</td>-->
		<tr> 
		<td><textarea style="width:400px;height:100px" name="ket" id="ket" /></td>
		</tr>
	</tr>

	<tr>
		<td align="center">
			<input type="submit" name="proses" value="Proses">
	
			<input type="reset" name="proses" id="btnReset" value="Reset">
		</td>
	</tr>
</table>
	</form>


 



