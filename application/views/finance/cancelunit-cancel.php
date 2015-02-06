<script language="javascript" src="<?=base_url()?>assets/js/jquery.numeric.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/currency.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/calendar.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/calendar2.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.confirm.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jsalert.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.formx.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.validationEngine-enx.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.validationEnginex.js"></script>

<script type="text/javascript">

	$(function(){
		$('#formAdd')
		.validationEngine()
		.ajaxForm({
			success:function(response){
			alert(response);
			refreshTable();
			$('#btnReset').click();
		}
		});	
	});

</script>

<form method="post" id="formAdd" action="<?=base_url()?>finance/cancelunit/ok"> 
<input type="hidden" name="id" id="id" value="<?=@$id?>" >

<table>
	<tr colspan="2"> 
		<td >Apakah anda ini proses cancel unit ini?</td>
	
	</tr>
	<tr>
		<td align="center">
			<input type="submit" name="proses" value="Proses">
		
			<input type="reset" name="proses" value="Tidak">
		</td>
	</tr>
</table>
</form>

 



