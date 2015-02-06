<script language="javascript" src="<?=base_url()?>assets/js/jquery.numeric.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/currency.js"></script>
<script language="javascript">
	$(function(){
		/*$(document).ready(function() {
			$('input[name=bgt1]').val(numToCurr( $(this).val())).numeric();
		});*/
		$('#formAdd').validationEngine({
				success: function(){
					//$.post("<?=site_url($module_url.'/save')?>",
						$('#formAdd').serialize(),
						function(data){
							alert(data);
							$('#btnClose').click();
						}
					//);
					return false;
				}
			});
		$('#btnClose').click(function(){
			$.validationEngine.closePrompt(".formError",true)
			refreshTable();
		});
		
	  $('.calculate').bind('keyup keypress',function(){
			//var total = 0;
			$(this).val( numToCurr($(this).val()));
			var kugiri = new RegExp(",", "g");
			var jan = parseInt($('#bgt1').val().replace(kugiri,""));
			var feb = parseInt($('#bgt2').val().replace(kugiri,""));
			var mar = parseInt($('#bgt3').val().replace(kugiri,""));
			var apr = parseInt($('#bgt4').val().replace(kugiri,""));
			var mei = parseInt($('#bgt5').val().replace(kugiri,""));
			var jun = parseInt($('#bgt6').val().replace(kugiri,""));
			var jul = parseInt($('#bgt7').val().replace(kugiri,""));
			var agus = parseInt($('#bgt8').val().replace(kugiri,""));
			var sep = parseInt($('#bgt9').val().replace(kugiri,""));
			var okt = parseInt($('#bgt10').val().replace(kugiri,""));
			var nov = parseInt($('#bgt11').val().replace(kugiri,""));
			var des = parseInt($('#bgt12').val().replace(kugiri,""));
			var total = jan + feb + mar + apr + mei + jun + jul + agus + sep + okt + nov + des;
			$('#tot_mst').val(numToCurr(total));
		  });
	});
</script>
<form action="<?=site_url($module_url.'/save_bgt')?>" id="formAdd" method="post">
<table>
	
	
	
	<tr>
		<td>Januari</td>
		<td>:</td>
		<td>
        <input type="text" name="bgt1"  id="bgt1" value="<?=number_format(@$data->bgt1)?>"  size="15" class="calculate validate[required]" maxlength="15"/></td>
		<td>Febuari</td>
		<td>:</td>
		<td>
        <input type="text" name="bgt2" id="bgt2" value="<?=number_format(@$data->bgt2)?>" size="15" class="calculate validate[required]" maxlength="15"/></td>
	</tr>
	<tr>
		<td>Maret</td>
		<td>:</td>
		<td>
        <input type="text" name="bgt3"  id="bgt3" value="<?=number_format(@$data->bgt3)?>" size="15"  class="calculate validate[required]" maxlength="15"/></td>
		<td>April</td>
		<td>:</td>
		<td>
        <input type="text" name="bgt4"  id="bgt4" value="<?=number_format(@$data->bgt4)?>" size="15"  class="calculate validate[required]" maxlength="15"/></td>
	</tr>
	<tr>

	</tr>
	<tr>
		<td>Mei</td>
		<td>:</td>
		<td>
        <input type="text" name="bgt5"  id="bgt5" value="<?=number_format(@$data->bgt5)?>" size="15"  class="calculate validate[required]" maxlength="15"/></td>
		<td>Juni</td>
		<td>:</td>
		<td>
        <input type="text" name="bgt6"  id="bgt6" value="<?=number_format(@$data->bgt6)?>" size="15"  class="calculate validate[required]" maxlength="15"/></td>
	</tr>
	<tr>
	</tr>
	<tr>
		<td>Juli</td>
		<td>:</td>
		<td>
        <input type="text" name="bgt7"  id="bgt7" value="<?=number_format(@$data->bgt7)?>" size="15"  class="calculate validate[required]" maxlength="15"/></td>
		<td>Agustus</td>
		<td>:</td>
		<td>
        <input type="text" name="bgt8" id="bgt8" value="<?=number_format(@$data->bgt8)?>" size="15"  class="calculate validate[required]" maxlength="15"/></td>
	</tr>
	<tr>
		<td>September</td>
		<td>:</td>
		<td>
        <input type="text" name="bgt9"  id="bgt9" value="<?=number_format(@$data->bgt9)?>" size="15"  class="calculate validate[required]" maxlength="15"/></td>
		<td>Oktober</td>
		<td>:</td>
		<td>
        <input type="text" name="bgt10"  id="bgt10" value="<?=number_format(@$data->bgt10)?>" size="15"  class="calculate validate[required]" maxlength="15"/></td>
	</tr>
	<tr>
		<td>November</td>
		<td>:</td>
		<td>
        <input type="text" name="bgt11"  id="bgt11" value="<?=number_format(@$data->bgt11)?>" size="15"  class="calculate validate[required]" maxlength="15"/></td>
		<td>Desember</td>
		<td>:</td>
		<td>
        <input type="text" name="bgt12" id="bgt12" value="<?=number_format(@$data->bgt12)?>" size="15"  class="calculate validate[required]" maxlength="15"/></td>
	</tr>
	<tr>
		<td>Total Budget</td>
		<td>:</td>
		<td colspan="4">
        <input type="text" name="tot_mst"  id="tot_mst" value="<?=number_format(@$data->tot_mst)?>" size="15" class="calculate validate[required]"  readonly="true" maxlength="50"/></td>
	</tr>
	<tr>
		<td>Description</td>
		<td>:</td>
		<td>
        <input type="text" name="descbgt" value="<?=@$data->descbgt?>"  size="15"  class="validate[required]" id="descbgt"/></td>
		<td>Tahun</td>
		<td>:</td>
		<td>
        <input type="text" name="thn" id="thn" value="<?=@$data->thn?>"  size="8" class="validate[required,custom[integer]]" maxlength="4"/></td>
	</tr>
	<tr>
		<td>Coa</td>
		<td>:</td>
		<td>
			<select name="code" style="width:200px">
				<option>Pilih Budget</option>
				<?php foreach ($kodebgt as $row):?>	
				<option value="<?=$row->code;?>" <?php if($row->code==@$data->code_id) echo"selected";?>><?php echo $row->descbgt;?></option>
				<?php endforeach ?>
			</select>	
        </td>
		<td>Cash Flow</td>
		<td>:</td>
		<td>
			<select name="cash" id="cash" class="input">
				<?php foreach($cash as $row): ?>
				<option value="<?=$row->cash_id;?>"><?=$row->kodecash?>&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;<?=$row->nama;?></option>
				<?php endforeach; ?>
			</select>		
        </td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td>
			<input type="hidden" name="id_mst" value="<?=@$data->id_mst?>" />
			<input type="submit" value="Save" />
			<input type="button" id="btnClose" value="Cancel" />
		</td>
	</tr>
</table>
</form>
