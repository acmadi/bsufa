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
	
	/*$("#kode").change(function(){
		var kode = $('#kode').val();
		$.getJSON('<?=site_url('prverifikasi/getkodebrg')?>/'+kode,
			function(data){
				$("[name=barang]").val(data.nm_brg);
			});
	});*/
	

</script>

<form method="post">
	<table class="dv-table" style="width:100%;background:#fafafa;padding:5px;margin-top:5px;">
		<tr>
			<input type="hidden" value="<?=$idpr?>" name="idpr" id="idpr"/>
			<td width="90px"><input name="request"  readonly="true" style="width:90px"></input></td>
			<td width="90px"><input name="ven_req"  readonly="true" style="width:90px"></input></td>
			<td width="60px"><input name="qty"  readonly="true" style="width:60px"></input></td>
			<td width="60px"><input name="satuan" readonly="true" style="width:60px"></input></td>
			<td width="100px">
				<select name="kode" id="kode" style="width:100px">
					<option></option>
						<?php foreach($pmaster as $row): ?>
							<option value="<?=$row->kd_brg?>"><?=$row->nm_brg?>&nbsp;[<?=$row->kd_brg?>]</option>
						<?php endforeach ?>
				</select>
			</td>
		</tr>
		
	</table>
	<div style="padding:5px 0;text-align:right;padding-right:30px">
		<a href="#" class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="saveItem(<?php echo $_REQUEST['index'];?>)">Save</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-cancel" plain="true" onclick="cancelItem(<?php echo $_REQUEST['index'];?>)">Cancel</a>
	</div>
</form>

