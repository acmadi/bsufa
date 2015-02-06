<?=script('currency.js')?>	
<script type="text/javascript">
var kugiri = new RegExp(",", "g");
$('.calculate').bind('keyup keypress',function(){
		$(this).val(numToCurr($(this).val()));
		

});

/*$("[name=progres]").bind('keyup keypress',function(){
//alert('tes');
		$(this).val(numToCurr($(this).val()));
		var progres = parseInt($("#progres").val().replace(kugiri,""));
		var dismon = parseInt($("#thismon").val().replace(kugiri,""));
		//var idprev = parseInt($("#idprev").val().replace(kugiri,""));
		//var iytd = parseInt($("#idytd").val().replace(kugiri,""));
		//var idblc = parseInt($("#idblc").val().replace(kugiri,""));
		//var idblc = parseInt($("#idprev").val().replace(kugiri,""));
		
		//alert(prog);
		
		//var prev = parseInt($("#prev").val().replace(kugiri,""));
		//var nil_prog = parseInt($("[name=nil_prog]").val().replace(kugiri,""));
		//var am = parseInt($("#am").val().replace(kugiri,""));
		
		//var yeartd	= parseInt($("[name=ytd]").val().replace(kugiri,""));
		//alert(thismon);
		//var ytd = progres + yeartd;
		//var balance = 100 - ytd;
		//var nil_prog = progres * am * 0.01;
		//var thismon = progres + thismon;
		var dismon = dismon + progres;
		var prev = dismon - progres;
		//var blc	= idblc - prog;
		//var yeartd	= iytd + prog;
		//var iytd = prog + dismon + idprev;
		//var iblc = idblc - iytd;
		//$("[name=ytd]").val(ytd);	
		//$("[name=balance]").val(balance);
		$("#thismon").val(numToCurr(dismon));
		$("#prev").val(numToCurr(prev));
		//$("#ytd").val(numToCurr(yeartd));
		//$("#ytd").val(numToCurr(iytd));
		
		//$("[name=nil_prog]").val(numToCurr(nil_prog));	
		//var balance_tot = am - nil_prog;
		//$("[name=balance_nilai]").val(numToCurr(balance_tot));




})*/
/*$("[name=progres]").change(function(){
alert('tes');	
		var progres = parseInt($("[name=progres]").val());
		var prev = parseInt($("[name=prev]").val());
		var nil_prog = parseInt($("[name=nil_prog]").val().replace(kugiri,""));
		var am = parseInt($("#am").val().replace(kugiri,""));
		
		var ytd = progres + prev;
		var balance = 100 - ytd;
		var nil_prog = progres * am * 0.01;
		
		
		$("[name=ytd]").val(ytd);	
		$("[name=balance]").val(balance);
		$("[name=nil_prog]").val(nil_prog);	
		var balance_tot = am - nil_prog;
		$("[name=balance_nilai]").val(numToCurr(balance_tot));
		
});*/
/*$("[name=nil_prog]").change(function(){
		var nil_prog = parseInt($("[name=nil_prog]").val().replace(kugiri,""));
		var am = parseInt($("#am").val().replace(kugiri,""));		
		var balance = am - nil_prog;
		$("[name=balance_nilai]").val(numToCurr(balance));
		
});*/


</script>

<form method="post">
	<table class="dv-table" style="width:110%;background:#fafafa;padding:5px;margin-top:5px;">
			<input  type="hidden" name="id" id="id"/>
			<input  type="hidden" name="nobgt" id="nobgt"value=<?=$nobgt?>>
			
			<input type="hidden"  name="id_mainjob" id="id_mainjob"/>
			<input  type="hidden" id="idkontrak"    name="idkontrak" value="<?=@$kontrak?>" />
			<input type="hidden" value="<?=$no_cjc?>" id="no_cjc" name="no_cjc"/>
			
			
		<tr>
			<td>
				<input name="jobdet" style="width:380px" id="jobdet"  readonly="true"></input>
				<input name="progres"  id="progres" maxlength="3"  style="width:60px" class="easyui-validatebox calculate" required="true"></input>
				<input name="thismon" style="width:60px" id="thismon" class="easyui-validatebox calculate" readonly="true" align="right" ></input>
				<input name="prev" style="width:60px" id="prev" class="easyui-validatebox" readonly="true" align="right" ></input>
				<input name="ytd" style="width:60px" id="ytd" class="easyui-validatebox" readonly="true" align="right" ></input>
				<input name="balance" id="balance"style="width:60px" class="easyui-validatebox" readonly="true" align="right" ></input>
			
		</tr>
		
	</table>
	<div style="padding:5px 0;text-align:right;padding-right:30px">
		<a href="#" class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="saveItem(<?php echo $_REQUEST['index'];?>)">Save</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-cancel" plain="true" onclick="cancelItem(<?php echo $_REQUEST['index'];?>)">Cancel</a>
	</div>
</form>

