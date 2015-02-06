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
	$('.calculate').bind('keyup keypress',function(){
		$(this).val(numToCurr($(this).val()));
	}).numeric();
});
</script>



<?php
$attr = array('class' => 'block-content form', 'id' => 'formAdd');
echo form_open(site_url('proposedbgt/save_approve'), $attr);
?>
<div id="x-input">
	<input type="hidden"  value="<?=$data->id_trbgtproj?>" name="idtr"/>
	<input  type="hidden" value="<?=$data->kd_bgtproj?>" name="kdproj"/>
	<? $balance = (@$totbgt->tot) - (@$totact->totact);?>
       <table>
		<tr>
			<td>Approved Date</td>
			<td colspan='2'><input type="text" name="tgl_app" value="<?=gettgl();?>" readonly="true"  style="width:100px"/></td>
		</tr>		
		<tr>
			<td>Structure Cost</td>
			<td><input name="cost" value="<?=@$join->nm_scost?>" style="width:150px"></td>
			<td>Total Budget</td>
			<td><input type="text" name="totbgt" value="<?=number_format(@$totbgt->tot)?>" class="input" readonly="true"/></td>
			
		</td>
		</tr>	
		<tr>
			<td>Sub Structure</td>
			<td><input name="subcost" value="<?=@$join->nm_ssubbgtproj?>" style="width:150px"></td>
			<td>Actual Budget</td>
			<td><input type="text" name="" value="<?=number_format(@$totact->totact)?>" disabled="disabled" class="input"/></td>
		
		</tr>
		<tr>
			<td>Budget Name</td>
			<td><input type="text" name="tgl_app" value="<?=@$join->nm_bgtproj?>" readonly="true"  size="5"/></td>
			<td>Balanced Budget</td>
			<td><input type="text" name="blc" value="<?=number_format($balance)?>" class="input" readonly="true"/></td>
		</tr>
			<tr>
				<td>Proposed Budget</td>
				<td><input type="text" name="proposed" value="<?=number_format(@$data->nilai_proposed)?>" class="input" disabled="disabled"/></td>
				<td>Approved Budget</td>
				<td><input type="text" name="approved" id="approved" class="validate[required] calculate input"/></td>
			</tr>
			<tr>
				<td>Proposed Remark</td>
				<td><input type="text" name="remark" value="<?=@$data->remark?>" disabled="disabled"/></td>
				<td>Approve Remark</td>
				<td colspan="2"><textarea name="remark" id="remark"></textarea></td>
			</tr>
			
			<tr>	
				<td colspan="3"><input type="submit" value="Approved" /><input type="submit" value="Unapprove" /> </td>
			</tr>
		</table>  
</div>
<?=form_close()?>
