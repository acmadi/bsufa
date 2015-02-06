<?=script('jquery.validationEngine-enx.js')?>
<?=script('jquery.validationEnginex.js')?>
<?=script('jquery.formx.js')?>
<?=script('calendar.js')?>
<?=script('calendar2.js')?>
<?=script('jquery.numeric.js')?>
<?=script('currency.js')?>
<?=link_tag(CSS_PATH.'menuform.css')?>

<script type="text/javascript">
	$(function(){
		$('#bgt').change(function(){
			var proj = $('#proj option:selected').val();
			$.getJSON('<?=site_url('proposedbgt/cekdata')?>/' + $(this).val() + '/' + proj,
				function(response){
					$('#totbgt').val(response.totbgt);
					$('#actual').val(response.actual);
					$('#blc').val(response.blc);
					$('#allbgt').val(response.allbgt);
					$('#allactual').val(response.allactual);
					$('#allblc').val(response.allblc);
				})
		})
		
			
		$('.calculate').bind('keyup keypress',function(){
			$(this).val(numToCurr($(this).val()));
		}).numeric();
		
		$('#formAdd')
		.validationEngine()
		.ajaxForm({
			success:function(response){
				if(response=='sukses'){
					alert(response);
					refreshTable();
				}else{
					alert(response);
				}
			}
		});			
		

	});
</script>

<?php
$attr = array('class' => 'block-content form', 'id' => 'formAdd');
echo form_open(site_url('approvedbgt/save'), $attr);
?>
<div id="x-input">
	<input type="hidden" value="<?=$data->id_trbgtproj?>" name="idtr"/>
       <label>Proposed Date</label><input type="text" name="tgl_prop" value="<?=indo_date(@$data->tgl_proposed)?>" readonly="true" style="width:100px"/><br/>
       <label>Approved Date</label><input type="text" name="tgl_app" value="<?=gettgl();?>" readonly="true"  style="width:100px"/><br/>
	   <label>Budget Name</label><input type="text" name="tgl_app" value="<?=@$data->nm_bgtproj ?>" readonly="true"  size="5"/><br/>
	
		<table border="0" width="800" cellpadding = "2" cellspacing="2">
			<tr>
				<td> <b>Description</b></td><td><b>Current Budget</b></td><td><b>All Budget Project</b></td>
			</tr>
			<tr>
				<td>Actual Budget</td><td><input type="text" name="" value="<?=number_format($xbgt->actual)?>" disabled="disabled" class="input"/></td><td><input type="text" name="" value="<?=number_format($allbgt->actual)?>" disabled="disabled" class="input"/></td>
			</tr>
			<tr>
				<td>Remark</td><td colspan="2"><input type="text" name="remark" value="<?=@$data->remark?>" disabled="disabled"/></td>
			</tr>	
			<tr>	
				<td>Proposed</td><td colspan="2"><input type="text" name="proposed" value="<?=number_format(@$data->nilai_proposed)?>" class="input" disabled="disabled"/></td>
			</tr>
			<tr>	
				<td>Approved</td><td colspan="2"><input type="text" name="approved" id="approved" class="validate[required] calculate input"/></td>
			</tr>
			<tr>	
				<td>Remark</td><td colspan="2"><textarea name="remark" id="remark"></textarea></td>
			</tr>
			<tr>	
				<td colspan="3"><input type="submit" value="Approved" /><input type="submit" value="Unapprove" /> </td>
			</tr>
		</table>  
</div>
<?=form_close()?>
