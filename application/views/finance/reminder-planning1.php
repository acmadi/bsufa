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

</script>
</head>
<form method="post" action="<?=site_url('reminder/surat_reminder1')?>">
 <?php $tgl = date('m/d/Y'); ?>
<body>
	<table>
	<tr>
	<td colspan="6">
	<h2>Reminder 1</h2>		
	</td>
	</tr>
	<tr>
		<td>Reminder Date</td>
			<td>:</td>
			<td>
			<input id="reminder_date" name="reminder_date" class="easyui-datebox" value="<?=$tgl?>" size="30"></input>
			</td>			
			
	</tr>
	<!--<tr>
	<td>Date</td>
			<td>:</td>
			<td>
			<input id="tgl" name="tgl" class="easyui-datebox" value="<?=$tgl?>" size="30"></input>
			</td>			
			
	</tr>
	<tr>
		<td>Reminder No</td>
			<td>:</td>
			<td><input type="text" name="no_reminder" id="no_reminder"  size="30" /></td>
		<tr>
		<tr>
		-->
			<td><input type="hidden" name="id_sp" id="id_sp"  value="<?=$id?>" size="30" /></td>
		<tr>
			<td><input type="submit" name="save" value="Save"/></td>
			<td><input type="reset" name="cancel" value="Cancel"/></td>
		</tr>
		</form>
</body>
</html>
