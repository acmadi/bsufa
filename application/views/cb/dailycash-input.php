<script language="javascript" src="<?=base_url()?>assets/js/jquery.numeric.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/currency.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.formx.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.validationEngine-enx.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.validationEnginex.js"></script>
<script type="text/javascript" src="<?=base_url();?>assets/js/jquery-ui-1.8.2.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {
	$('.calculate').bind('keyup keypress',function(){
		$(this).val(numToCurr($(this).val()));			
	});
});

$(function(){
	$('#formadd').validationEngine().ajaxForm({
		success:function(response){
			if(response == 4){
				alert("Data Berhasil Disimpan");
				refreshTable();
			}else{
			    alert(response);
			 }
		}
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
	.ui-autocomplete {
		max-height: 150px;
		overflow-y: auto;
		overflow-x: hidden;
	}
	* html .ui-autocomplete {
		height: 150px;
	}
</style>

<form method="post" id="formadd" action="<?php echo base_url();?>cb/dailycash/savecash">
	<script type="text/javascript">
		$(document).ready(function() {
			$('#reset').trigger('click');
		});
	</script>
	<table border=1>
		<tr>
			<h3>FORM ADD</h3>
		</tr>
		<tr>
			<td>PT</td>
			<td> : </td>
			<td><input type="text" class="mytextbox calculate" value="<?=$ptsess->nm_pt?>" readonly disabled/></td>
			<input type="hidden" name="pt" value="<?=$ptsess->id_pt?>">
		</tr>
		<tr>
			<td>Proyek</td>
			<td> : </td>
			<td><input type="text" class="mytextbox calculate" value="<?=$projeksess->nm_subproject?>" readonly disabled/></td>
			<input type="hidden" name="project" value="<?=$projeksess->subproject_id?>">
		</tr>
		<tr>			
			<td>Bank </td>
			<td> : </td>
			<td><input type="text" class="mytextbox calculate" value="<?=$banksess->namabank." - ".$banksess->nomorrek;?>" readonly disabled/></td>	
			<input type="hidden" name="bank" value="<?=$banksess->bank_id?>">			
		</tr>
		<tr>
			<td>Saldo Rekening</td>
			<td> : </td>
			<td><input type="text" style="text-align:right;" class="mytextbox calculate" value="<?=number_format($cashsess->end_amount)?>" readonly/></td>
		</tr>
		<tr>
			<td>Debet</td>
			<td> : </td>
			<td><input type="text" style="text-align:right;" name="debet" id="debet" class="mytextbox calculate" value="0" required/></td>
			<td>Kredit</td>
			<td> : </td>
			<td><input type="text" style="text-align:right;" name="credit" id="credit" class="mytextbox calculate" value="0" required/></td>
		</tr>
		<tr>
			<td>Keterangan</td>
			<td> : </td>
			<td colpan=4><textarea style="width:100%;" name="remark" class="mytextbox" required></textarea></td>
		</tr>
		<tr>
			<td><input type="submit" value="SIMPAN" class="mytextboxx"></td>
			<td><input type="reset" value="Reset" id="reset" class="mytextboxx"></td>
		</tr>
	</table>
</form>