<html>
<head>
<?=script('currency.js')?>
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
<form method="post" action="<?php echo base_url();?>cb/dailycash/editcashheader">
	<input type="hidden" name="id" value="<?=$data->id_dailycash?>">
	<table border=1>
		<tr>
			<h3>FORM EDIT BEGINNING</h3>
		</tr>
		<tr>
			<td>PT</td>
			<td> : </td>
			<td><input type="text" class="mytextbox calculate" value="<?=$data->nm_pt?>" readonly disabled/></td>
			<input type="hidden" name="pt" value="<?=$data->id_pt?>">
		</tr>
		<tr>
			<td>Project</td>
			<td> : </td>
			<td><input type="text" class="mytextbox calculate" value="<?=$data->nm_subproject?>" readonly disabled/></td>
			<input type="hidden" name="subproject" value="<?=$data->id_project?>">
		</tr>
		<tr>			
			<td>Bank </td>
			<td> : </td>
			<td><input type="text" class="mytextbox calculate" value="<?=$data->namabank." - ".$data->nomorrek;?>" readonly disabled/></td>	
			<input type="hidden" name="bank" value="<?=$data->bank_id?>">			
		</tr>
		<tr>
			<td>Beginning</td>
			<td> : </td>
			<td><input type="text" style="text-align:right;" name="begin" class="mytextbox calculate" value="<?=$data->begin_amount?>"/></td>
		</tr>
		<tr>
			<td><input type="submit" value="Update" class="mytextboxx"></td>
			<td><input type="reset" value="Reset" class="mytextboxx"></td>
		</tr>
	</table>
</form>