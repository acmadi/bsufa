<? $this->load->view(ADMIN_HEADER) ?>
<script language="javascript" src="<?=base_url()?>assets/js/jquery-1.4.2.min.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/calendar.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/calendar2.js"></script>
<link rel="stylesheet" href="<?=base_url()?>assets/css/calendar.css" type="text/css" />
<link rel="stylesheet" href="<?=base_url()?>assets/css/menuform.css" type="text/css"/>
<table>
	<tr>
		<td>Pay Date</td>
			<td>:</td>
				<td><input name='subproject' ></select></td>
					<td>Payment Type</td>
						<td>:</td>
							<td><select name='subproject' >
									<option>Cash</option>
									<option>Transfer</option>
									<Option>Cheque</Option>
									<option>Credit Card></select></td>
	
	</tr>
	<tr>
		<td>Billing No.</td>
			<td>:</td>
				<td><input name='subproject' ></select></td>
					<td>Bank</td>
						<td>:</td>
							<td><select name='subproject' >
									<option>BCA</option>
									<option>Mandiri</option>
									<Option>Niaga</Option>
									<option>Permata</option></select></td>
	</tr>
	<tr>
		<td>Bill Amount</td>
			<td>:</td>
				<td><input name='customername' ></td>
					<td>Acc. Bank</td>
						<td>:</td>
							<td><input name='subproject' ></td>
	</tr>
	
	<tr>
		<td>Payment Amount</td>
			<td>:</td>
				<td><input name='hp' ></td>
					<td>Branch. Bank</td>
						<td>:</td>
							<td><input name='subproject' ></td>
	
	</tr>
	
	<tr>
		<td>Balanced Amount</td>
			<td>:</td>
				<td><input name='hp' ></td>
					<td>A/N</td>
						<td>:</td>
							<td><input name='subproject' ></td>
	</tr>
	
	<tr>

</table>	
	

	<input type="submit" name="save" value="Pay Bill"/>
	<input type="reset" name="cancel" value="Cancel"/>	

<?$this->load->view(ADMIN_FOOTER)?>

