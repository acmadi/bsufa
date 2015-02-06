<?=script('currency.js')?>	
<script type="text/javascript">

			var kugiri = new RegExp(",", "g");
			
			$(".calculate").bind('keyup keypress',function(){
				$(this).val(numToCurr($(this).val()));
						var amount = parseInt($("#persen").val().replace(kugiri,""));
						
			});
			
	 $('#persen').numberbox({  
        min:0,  
        precision:2  
    });  
					
</script>

<form method="post">
	<table class="dv-table" style="width:100px;background:#fafafa;padding:5px;margin-top:5px;">
		<input type="hidden" value="<?=$nospk?>" name="nospk" id="nospk"/>
		<input type="hidden" value="<?=$kontrak?>" name="kontrak" id="kontrak"/>				
		<tr>
			
			<select style="width:150px" name="top" id="top">
			<option></option>
			<option value='1'>DP</option>
			<option value='2'>Progress</option>
			<option value='3'>Retensi</option>
			</select>
			<!--<input style="width:80px" 	name="persen" id="persen" class="calculate input"  >-->
			<input style="width:80px" 	name="persen" id="persen" >
			<input style="width:400px" 	name="keterangan" id="keterangan" align="left">
			
		
			
		</tr>
		
	</table>
	<div style="padding:5px 0;text-align:right;padding-right:10px">
		<a href="#" class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="saveItemMr(<?php echo $_REQUEST['index'];?>)">Save</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-cancel" plain="true" onclick="cancelItemMr(<?php echo $_REQUEST['index'];?>)">Cancel</a>
	</div>
</form>

