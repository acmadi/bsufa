


<form method="post" action="<?=site_url('cb/bankmonitoring/saveheader')?>">
<body>
	<h2>CASHBOOK</h2>		
	</div>
	<tr>
	<td>Trx Type</td>
			<td>:</td>
			<td><input type="text" name="id_cash" id="id_cash"  class="validate[required] xinput" xinput" value="<?=@$data->id_cash?>" class="validate[required]" size="30" /></td>
	</tr>
	<br>
	<tr>
		<td>Voucher</td>
			<td>:</td>
			<td><input type="text" name="voucher" id="voucher"  disabled="disabled"class="validate[required] xinput" xinput" value="<?=@$data->voucher?>" class="validate[required]" size="30" /></td>
	</tr>
	<br>
	<tr>
		<td>Date</td>
			<td>:</td>
			<td>
			<input id="trans_date" class="easyui-datebox" size="30"></input>
			</td>
	<br>	
	<tr>
			<td>Amount</td>			
			<td>:</td>
			<td><input type="text" class="easyui-numberbox"  precision="2" groupSeparator="," name="amount" id="amount" class="validate[required] xinput" xinput" value="<?=@$data->amount?>" class="validate[required]" size="30" /></td>
	</tr>
	</tr>

		<tr>
			<td colspan='3'><input type="submit" name="save" value="Save"/></td>
			<td colspan='3'><input type="reset" name="cancel" value="Cancel"/></td>
		</tr>
		</form>
