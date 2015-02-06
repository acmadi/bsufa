<html>
<head>
<?=script('currency.js')?>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.formx.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.validationEngine-enx.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.validationEnginex.js"></script>
</head>
<script type="text/javascript">
$(document).ready(function() {
	$('.calculate').bind('keyup keypress',function(){
		$(this).val(numToCurr($(this).val()));			
	});
});	

</script>
<style>
	.customBg{
		display:block;
		margin-height:-2px;
		margin-left:-2px;
		height: 14px;
		padding: 4px;
	}
	.customBg2{
		display:block;
		margin-height:-2px;
		margin-left:-2px;
		height: 14px;
		padding: 4px;
	}

	.mytextbox {
		font: 12px Arial, Helvetica, sans-serif;
	    border: 1px solid #008B8B;
	    padding: 5px;
	   
	}
	.mytextboxx {
	font: 14px Arial, Helvetica, sans-serif;

		width: 90px;
		height: 42px;
	border: 1px solid #EFFC94;
		background: #B9B9B9;
		color: #5D781D;  
	}

	td {
		
		padding: 6px 5px 2px 5px;
		border: 0px solid #DEDEDE;
		text-transform: uppercase;
		font: normal 11px Arial, Helvetica, sans-serif;
		color: #5D781D;1px solid #D6DDE6;
	   
	}
</style>
<?php foreach ($hasil as $detail) { ?>
<form method="post" action="<?php echo base_url();?>cb/dailycash/editcash/<?=$detail->id_dailycashdet?>">
	<input type="hidden" name="idcash" value="<?=$detail->id_dailycash?>">
	<table border=1>
		<tr>
			<h3>FORM EDIT</h3>
		</tr>
		<tr>
			<td>PT</td>
			<td> : </td>
			<td><input type="text" class="mytextbox calculate" value="<?=$detail->nm_pt?>" readonly disabled/></td>
			<input type="hidden" name="pt" value="<?=$detail->id_pt?>">
		</tr>
		<tr>
			<td>Proyek</td>
			<td> : </td>
			<td><input type="text" class="mytextbox calculate" value="<?=$detail->nm_subproject?>" readonly disabled/></td>
			<input type="hidden" name="subproject" value="<?=$detail->id_project?>">
		</tr>
		<tr>			
			<td>Bank</td>
			<td> : </td>
			<td><input type="text" class="mytextbox calculate" value="<?=$detail->namabank." - ".$detail->nomorrek;?>" readonly disabled/></td>	
			<input type="hidden" name="bank" value="<?=$detail->bank_id?>">		
		</tr>		
		<tr>
			<td>Saldo Rekening</td>
			<td> : </td>
			<td><input type="text" style="text-align:right;" class="mytextbox calculate" value="<?=number_format($detail->end_amount)?>" readonly/></td>
		</tr>
		<tr>
			<td>Debet</td>
			<td> : </td>
			<td><input type="text" style="text-align:right;" name="debet" class="mytextbox calculate" value="<?=number_format($detail->debet)?>"/></td>
			<td>Kredit</td>
			<td> : </td>
			<td><input type="text" style="text-align:right;" name="credit" class="mytextbox calculate" value="<?=number_format($detail->credit)?>"/></td>
		</tr>
		<tr>
			<td>Keterangan</td>
			<td> : </td>
			<td colpan=4><textarea style="width:100%;" name="remark" class="mytextbox"><?=$detail->remark?></textarea></td>
		</tr>
		<tr>
			<td><input type="submit" value="SIMPAN" class="mytextboxx"></td>
			<td><input type="reset" value="Reset" class="mytextboxx"></td>
		</tr>
	</table>
</form>
<?php } ?>

</html>