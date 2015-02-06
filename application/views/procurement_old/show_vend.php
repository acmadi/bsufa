<?=script('currency.js')?>	
<script type="text/javascript">
	var kugiri = new RegExp(",", "g");

	$(".calculate").bind('keyup keypress',function(){
		$(this).val(numToCurr($(this).val()));
	});
	
	$("[name=diskon]").bind('keyup keypress',function(){
		var satuan = parseInt($('[name=satuan]').val().replace(kugiri,""));
		var diskon = parseInt($('[name=diskon]').val().replace(kugiri,""));
		
		var total = satuan - diskon;
		$("[name=total]").val(numToCurr(total));
	});
</script>

<form method="post">
	<table class="dv-table" style="width:100%;background:#fafafa;padding:5px;margin-top:5px;">
		<input type="hidden" value="<?=$idpr?>" name="idpr" id="idpr"/>		
		<tr>
			<td>
				<select name="brg" style="width:120px" class="easyui-validatebox" required="true">
					<option></option>
					<?php foreach($nm_brg as $row): ?>
						<option value="<?=$row->kd_brg_ver?>"><?=$row->nm_brg?></option>
					<?php endforeach?>
				</select>				
			</td>
			<td>
				<select name="vendor" style="width:120px" class="easyui-validatebox" required="true">
					<option></option>
					<?php foreach($pvendor as $row): ?>
						<option value="<?=$row->kd_supp_gb?>"><?=$row->nm_supplier?></option>
					<?php endforeach?>
				</select>
			</td>
			<td><input name="satuan" class="calculate easyui-validatebox  input" required="true"></input></td>
			<td><input name="diskon" class="calculate easyui-validatebox input" required="true"></input></td>
			<td><input name="total" class="input" readonly="true"></input></td>
		</tr>
		
	</table>
	<div style="padding:5px 0;text-align:right;padding-right:30px">
		<a href="#" class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="saveItem(<?php echo $_REQUEST['index'];?>)">Save</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-cancel" plain="true" onclick="cancelItem(<?php echo $_REQUEST['index'];?>)">Cancel</a>
	</div>
</form>

