<html>
<head>
<link rel="stylesheet" href="<?=base_url()?>assets/css/easyui.css" type="text/css" />
<link rel="stylesheet" href="<?=base_url()?>assets/css/icon.css" type="text/css" />
<link rel="stylesheet" href="<?=base_url()?>assets/css/demo.css" type="text/css" />

<!--script language="javascript" src="<?=base_url()?>assets/js/jquery-1.7.2.min.js"></script-->
<script language="javascript" src="<?=base_url()?>assets/js/jquery.easyui.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/jquery.edatagrid.js"></script>

<?=script('currency.js')?>

<script type="text/javascript">		

	$('.calculate').bind('keyup keypress',function(){
			var rep_coma = new RegExp(",", "g");
			$(this).val(numToCurr($(this).val()));			
			var amount = parseInt($('#amount').val().replace(rep_coma,""));
				//	var balance = parseInt($('#balance').val().replace(rep_coma,""));
		
					// if (amount > balance) {
					
                              // alert('Nilai Amount lebih besar daripada Nilai Balance');
							  // $('#amount').val(0);
							// }
					// else  {
							// }
			});	
	$('#amount_plan').keyup(function(){
		var amount = $('#amount').val().replace(/,/g,'');
		var amount_plan = $('#amount_plan').val().replace(/,/g,'');
		$('#amount_blc').val(numToCurr(amount-amount_plan));
	});
	$('#amount_plan').keyup(function(){
			var blc = $('#amount_blc').val().replace(/,/g,'');
			if(blc<0){
				alert('Tidak Boleh Melebihi Nilai Tagihan');
				$('#amount_plan').val(0);
				$('#amount_blc').val(0);
			}
			});
</script>
</head>
<form method="post" action="<?=site_url('cb/cashplaning/saveplan')?>">
 <?php $tgl = date('m/d/Y'); ?>
<body>
	<table>
	<tr>
	<td colspan="6">
	<h2>Payment Plan</h2>		
	</td>
	</tr>
	
	<td>Payment Plan Date</td>
			<td>:</td>
			<td>
			<input id="tgl" name="tgl" class="easyui-datebox" value="<?=$tgl?>" size="30"></input>
			</td>			
			
	</tr>

	<tr>
		<td>Total Amount</td>
			<td>:</td>
			<td><input type="text" name="amount" id="amount" class="calculate input validate[required]"  value="<?=number_format($row->trx_amt)?>" size="30" style="background:lightgray"/></td>
	<tr>
	<tr>
		<td>Amount Plan</td>
			<td>:</td>
			<td><input type="text" name="amount_plan" id="amount_plan" class="calculate input validate[required]"  value="" size="30" /></td>
	<tr>
	<tr>
		<td>Amount Balance</td>
			<td>:</td>
			<td><input type="text" name="amount_blc" id="amount_blc" class="calculate input validate[required]"  value="" size="30" /></td>
	<tr>
		<tr>
		<!--<td>ID</td>
			<td>:</td>-->
			<td><input type="hidden" name="id_ap" id="id_ap"  value="<?=$id?>" size="30" /></td>
		<tr>
			<td><input type="submit" name="save" value="Save"/></td>
			<td><input type="reset" name="cancel" value="Cancel"/></td>
		</tr>
		</form>
</body>
</html>
