<?=script('currency.js')?>	
<?=script('jquery.validationEngine-enx.js')?>
<?=script('jquery.validationEnginex.js')?>
<?=script('jquery.formx.js')?>

<script type="text/javascript">
$('.calculate').bind('keyup keypress',function(){
		$(this).val(numToCurr($(this).val()));
});
</script>

<form method="post">
	<table class="dv-table" style="width:100%;background:#fafafa;padding:5px;margin-top:5px;">
		<tr>
				<input type="text" value="<?=$xref?>" name="id_mainjob" id="id_mainjob"/>
			<td>
				<select name="contractor" id="contractor" style="width:120px">
					<option></option>
					<?php foreach($vendor as $row):?>
					<option value="<?=$row->kd_supp_gb?>"><?=$row->nm_supplier?></option>
					<?php endforeach; ?>
					
				</select>
			</td>
			<td><input name="offering" class="calculate easyui-validatebox  input" required="true"></input></td>
			<td><input name="nego" class="calculate easyui-validatebox input" required="true"></input></td>
			<td><input name="score" class="easyui-validatebox input" maxlength="3" required="true"></input></td>
			<td><input name="remark" class="easyui-validatebox" required="true"></input></td>
		</tr>
		
	</table>
	<div style="padding:5px 0;text-align:right;padding-right:30px">
		<a href="#" class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="saveItem(<?php echo $_REQUEST['index'];?>)">Save</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-cancel" plain="true" onclick="cancelItem(<?php echo $_REQUEST['index'];?>)">Cancel</a>
	</div>
</form>

