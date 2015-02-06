<?php
$tgl = date("d-m-Y");
?>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.formx.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.validationEngine-enx.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.validationEnginex.js"></script>

<script language="javascript">
$(function(){
	/*validation form*/
	$('#formadd')
	.validationEngine()
	.ajaxForm({
	success:function(response){
		if(response == "sukses"){
			refreshTable();
		}else{
			alert(response);
		}			
			}
		}
	);	
		
});
</script>
<form method="post" action="<?=site_url()?>kwtbillleasing/paycancel" id="formadd">
<input type="hidden" name="idkwt" id="idkwt" value="<?=$data->kwitansi_id?>"/>
<input type="hidden" name="tglcancel" id="tglcancel" value="<?=inggris_date($tgl)?>"/>

<table border="0">
	<tr>
		<td>Cancel Date</td>
		<td>:</td>
		<td><?=$tgl?></td>
	</tr>
	<tr>
		<td>Payment Date</td>
		<td>:</td>
		<td><?=indo_date($data->kwitansi_paydate)?></td>
	</tr>	
	<tr>
		<td>No Kwitansi</td>
		<td>:</td>
		<td><?=$data->kwitansi_no?></td>
	</tr>
	<tr>
		<td>Pembayaran</td>
		<td>:</td>
		<td><?=$data->kwitansi_remark?></td>
	</tr>
	<tr>
		<td>Amount</td>
		<td>:</td>
		<td><?=number_format($data->kwitansi_pay)?></td>
	</tr>
	<tr>
		<td>Remark</td>
		<td>:</td>
		<td>
			<textarea name="remark" id="remark" class="validate[required]"></textarea>
		</td>
	</tr>		
	<tr>
		<td colspan="3"><input type="submit" name="cancel" value="Cancel Payment"/></td>
	</tr>
</table>
</form>
