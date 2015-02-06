<?=script('currency.js')?>	
<script type="text/javascript">
$('.calculate').bind('keyup keypress',function(){
		$(this).val(numToCurr($(this).val()));
});
</script>

<form method="post">
	<table class="dv-table" style="width:100%;background:#fafafa;padding:5px;margin-top:5px;">
		<tr>
				<input type="hidden" name="idtrbgtproj" id="idtrbgtproj"  input" required="true"></input>
				
			<td><input name="jobdet" id="job" required="true" style="width:370" readonly="true"></input>
			<input name="proj_id" style="width:180" class="calculate easyui-validatebox input" required="true" readonly="true"></input>
			<input name="cost" style="width:180" class="calculate easyui-validatebox input" required="true" align="right"></input></td>
			<input name="codebgt" style="width:180" class="calculate easyui-validatebox input" required="true" align="right"></input></td>
			<input name="totalbgt" style="width:180" class="calculate easyui-validatebox input" required="true" align="right"></input></td>
			<input name="totalprop" style="width:180" class="calculate easyui-validatebox input" required="true" align="right"></input></td>
			<input name="xblc" style="width:180" class="calculate easyui-validatebox input" required="true" align="right"></input></td>
			<input name="amount" style="width:180" class="calculate easyui-validatebox input" required="true" align="right"></input></td>
			
			
			
		</tr>
		
	</table>
	<div style="padding:5px 0;text-align:right;padding-right:30px">
		<a href="#" class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="saveItem(<?php echo $_REQUEST['index'];?>)">Save</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-cancel" plain="true" onclick="cancelItem(<?php echo $_REQUEST['index'];?>)">Cancel</a>
	</div>
</form>

