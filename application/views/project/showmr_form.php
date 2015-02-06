<?=script('currency.js')?>	
<script type="text/javascript">
	var kugiri = new RegExp(",", "g");
	
	$('.calculate').bind('keyup keypress',function(){
			$(this).val(numToCurr($(this).val()));
	});
	
	$("[name=price]").bind("keyup keypress",function(){
		var qty = parseInt($('[name=qty]').val().replace(kugiri,""));
 		var price = parseInt($('[name=price]').val().replace(kugiri,""));
 		
 		var total = price * qty;
 		$("[name=total]").val(numToCurr(total));
	});	
</script>

<form method="post">
	<table class="dv-table" style="width:100%;background:#fafafa;padding:5px;margin-top:5px;">
		<input  type="hidden" value="<?=$noprop?>" name="noprop" id="noprop"/>	
			<input name="product" style="width:220px"id="product" class="easyui-validatebox" required="true"></input>
			<input name="qty" id="qty" class="calculate easyui-validatebox  input" style="width:75px"maxlength="3" required="true"></input>
			<select name="unit" id="unit" style="width:100px">
					<?php foreach($satuan as $row): ?>
						<option><?=$row->satuan?></option>
					<?php endforeach; ?>
				</select>
			
			<input name="price" style="width:160px" id="price" class="calculate easyui-validatebox input" required="true"></input>
			<input name="total" style="width:160px" id="total" class="calculate easyui-validatebox input" readonly="true" ></input>
		</tr>
		
	</table>
	<div style="padding:5px 0;text-align:right;padding-right:30px">
		<a href="#" class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="saveItemMr(<?php echo $_REQUEST['index'];?>)">Save</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-cancel" plain="true" onclick="cancelItemMr(<?php echo $_REQUEST['index'];?>)">Cancel</a>
	</div>
</form>

