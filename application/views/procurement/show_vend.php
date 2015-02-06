<?=script('currency.js')?>	
<script type="text/javascript">
	var kugiri = new RegExp(",", "g");

	$(".calculate").bind('keyup keypress',function(){
		$(this).val(numToCurr($(this).val()));
	});
	
	$("[name=diskon1]").bind('keyup keypress',function(){
		var satuan1 = parseInt($('[name=satuan1]').val().replace(kugiri,""));
		var diskon1 = parseInt($('[name=diskon1]').val().replace(kugiri,""));
		
		
		var total1 = satuan1 - diskon1;
		
		$("[name=total1]").val(numToCurr(total1));
		
	});
	$("[name=diskon2]").bind('keyup keypress',function(){
		
		var satuan2 = parseInt($('[name=satuan2]').val().replace(kugiri,""));
		var diskon2 = parseInt($('[name=diskon2]').val().replace(kugiri,""));
		
		
		var total2 = satuan2 - diskon2;
	
		
		$("[name=total2]").val(numToCurr(total2));
		
	});
	$("[name=diskon3]").bind('keyup keypress',function(){
		
		var satuan3 = parseInt($('[name=satuan3]').val().replace(kugiri,""));
		var diskon3 = parseInt($('[name=diskon3]').val().replace(kugiri,""));
		
		
		var total3 = satuan3- diskon3;
		$
		$("[name=total3]").val(numToCurr(total3));
	});
</script>

<form method="post">
	<table class="dv-table" style="1100px;background:#fafafa;padding:5px;margin-top:5px;">
		<input type="hidden" value="<?=$idpr?>" name="idpr" id="idpr"/>		
		<input type="hidden"  name="kd_brg_ver" id="kd_brg_ver"/>
		<tr>
			<td>
					
				<input type="text" name="brg" id="brg" style="width:75px" style="width:75px" readonly="true" value="<?=@$nm_brg->nm_brg?>">
							
			</td>
			<td>
				<select name="vendor1" id="vendor1" style="width:75px" class="easyui-validatebox" required="true">
					<option></option>
					<?php foreach($pvendor as $row): ?>
						<option value="<?=$row->kd_supp_gb?>"><?=$row->nm_supplier?></option>
					<?php endforeach?>
				</select>
			</td>
			
			<td><input name="satuan1" id="satuan1" class="calculate easyui-validatebox  input" style="width:75px" required="true"></input></td>
			<td><input name="diskon1" id="diskon1" class="calculate easyui-validatebox input" style="width:75px" required="true"></input></td>
			<td><input name="total1" id="total1" class="input" style="width:75px" readonly="true"></input></td>
			<td>
				<select name="vendor2" id="vendor2" style="width:75px" class="easyui-validatebox" style="width:75px" required="true">
					<option></option>
					<?php foreach($pvendor as $row): ?>
						<option value="<?=$row->kd_supp_gb?>"><?=$row->nm_supplier?></option>
					<?php endforeach?>
				</select>
			</td>
			
			<td><input name="satuan2" id="satuan2" class="calculate easyui-validatebox  input" style="width:75px" required="true"></input></td>
			<td><input name="diskon2" id="diskon2" class="calculate easyui-validatebox input" style="width:75px" required="true"></input></td>
			<td><input name="total2" id="total2" class="input" style="width:75px" readonly="true"></input></td>
			<td>
				<select name="vendor3" id="vendor3" style="width:75px" class="easyui-validatebox" style="width:75px" >
					<option></option>
					<?php foreach($pvendor as $row): ?>
						<option value="<?=$row->kd_supp_gb?>"><?=$row->nm_supplier?></option>
					<?php endforeach?>
				</select>
			</td>
			
			<td><input name="satuan3" id="satuan3" class="input" style="width:75px" required="false"></input></td>
			<td><input name="diskon3" id="diskon3" class="input" style="width:75px" required="false"></input></td>
			<td><input name="total3" id="total3" class="input" style="width:75px" readonly="true"></input></td>
		</tr>
		
	</table>
	<div style="padding:5px 0;text-align:right;padding-right:0px">
		<a href="#" class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="saveItem(<?php echo $_REQUEST['index'];?>)">Save</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-cancel" plain="true" onclick="cancelItem(<?php echo $_REQUEST['index'];?>)">Cancel</a>
	</div>
</form>

