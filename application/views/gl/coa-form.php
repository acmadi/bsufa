<?=link_tag(CSS_PATH.'menuformx.css')?>
<?//=script('jquery-1.4.2.min.js')?>
<script language="javascript" src="<?=base_url()?>assets/js/calendar.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/calendar2.js"></script>
<link rel="stylesheet" href="<?=base_url()?>assets/css/calendar.css" type="text/css" />

<script type="text/javascript">
$(function(){
		$('.calculate').bind('keyup keypress',function(){
		$(this).val(numToCurr($(this).val()));
	 }).numeric();
});
</script>

<form method="post" action="<?=site_url('coa/modif')?>">
	<table>
		<tr>
			<td>Acc No</td>
			<td>:</td>
			<td><input type="text" name="acc_no" class="xinput" value="<?=$data->acc_no ?>" /></td>
		</tr>	
		<tr>
			<td>Acc Name</td>
			<td>:</td>
			<td><input type="text" name="acc_name" class="xinput" value="<?=$data->acc_name ?>" style="width:400px"/></td>
		</tr>	
		<tr>	
			<td>Currency</td>
			<td>:</td>
			<td>
				<select name="currency" class="xinput" value="">
							
				
					<?php foreach($currency as $row):?>
						<option value="<?=$row->currency_id?>">
							<?=$row->currency_cd?>
						</option>
					<?php endforeach?>	
				</select>
			</td>
		</tr>
		<tr>	
			<td>Spec</td>
			<td>:</td>
			<td>
			<select name="spec">
				<? if ($data->spec == NULL) {?>
				<option></option>
			<? }elseif($data->spec == '1.00'){ ?>
			<option>Balance Sheet</option>
			
			<? }elseif($data->spec == '2.00'){ ?>
			<option>Profit Loss</option>
			<? } ?>
			<option value='1'>Balance Sheet</option>
			<option value='2'>Profit Loss</option>
			</select>		
			</td>
		</tr>
		<tr>	
			<td>Group</td>
			<td>:</td>
			<td>
			<select name="group">
			<option></option>
			<option value='A'>Asset</option>
			<option value='L'>Liabilities</option>
			<option value='C'>Capital</option>
			<option value='R'>Revenue</option>
			<option value='E'>Expense</option>
			</select>
			</td>
		</tr>
		<tr>	
			<td>Type</td>
			<td>:</td>
			<td>
			<select name="type">
			<option></option>
			<option value='1'>Header</option>
			<option value='2'>Transaction</option>
			</select>
			</td>
		</tr>
			<tr>	
			<td>Level</td>
			<td>:</td>
			<td>
			<select name="level">
			<option></option>
			<option value='1'>1</option>
			<option value='2'>2</option>
			<option value='3'>3</option>
			<option value='4'>4</option>
			<option value='5'>5</option>
			</select>
			</td>
		</tr>
		</tr>
			<tr>	
			<td>Status</td>
			<td>:</td>
			<td>
			<select name="status">
			<option></option>
			<option value='A'>Aktif</option>
			<option value='N'>Non Aktif</option>
			</select>
			</td>
		</tr>
		<tr>
			<td colspan='3'><input type="submit" name="save" value="Update"/></td>
		</tr>
	</table>
</form>
