<?=script('currency.js')?>	
<script type="text/javascript">
	var kugiri = new RegExp(",", "g");

	$(".calculate").bind('keyup keypress',function(){
		$(this).val(numToCurr($(this).val()));
		var qty_po = parseInt($("[name=qty_po]").val().replace(kugiri,""));
		var masuk = parseInt($("[name=masuk]").val().replace(kugiri,""));
		var out_po = parseInt($("[name=out_po]").val().replace(kugiri,""));
	
		if(masuk > out_po)
		{
			alert("Jumlah lebih besar");
			$("[name=masuk]").val('');
		}
				
	});
	

</script>

<form method="post">
	<table class="dv-table" style="width:750px;background:#fafafa;padding:5px;margin-top:5px;">	
		<tr>
			<td width="100px"><input style="width:100px" name="kode" id="kode" class="easyui-validatebox" required="true" readonly="true"></td>
			<td width="120px"><input style="width:120px" name="brg" id="brg" class="easyui-validatebox" required="true" readonly="true"></td>
			<td width="80px"><input style="width:80px" name="qty_po" id="qty_po" class="calculate input" required="true" readonly="true"></input></td>
			<td width="80px"><input style="width:80px" name="qty_rc" id="qty_rc" class="calculate input" required="true" readonly="true"></input></td>
			<td width="80px"><input style="width:80px" name="out_po" id="out_po" class="calculate easyui-validatebox input" required="true" readonly="true"></input></td>
			<td width="100px"><input style="width:100px" name="satuan" id="satuan" class="" readonly="true"></input></td>
			<td width="80px"><input style="width:80px" name="masuk" id="masuk" class="calculate easyui-validatebox input" required="true"></input></td>
		</tr>
		
	</table>
	<div style="padding:5px 0;text-align:right;padding-right:30px">
		<a href="#" class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="saveItem(<?php echo $_REQUEST['index'];?>)">Save</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-cancel" plain="true" onclick="cancelItem(<?php echo $_REQUEST['index'];?>)">Cancel</a>
	</div>
</form>

