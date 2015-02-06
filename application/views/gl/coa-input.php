<?#=script('jquery.tabs.js')?>
<?=link_tag(CSS_PATH.'easyui.css')?>
<?=link_tag(CSS_PATH.'icon.css')?>
<?=link_tag(CSS_PATH.'demo.css')?>
<?=script('jquery.easyui.min.js')?>
<?=script('jquery.edatagrid.js')?>
<?=script('currency.js')?>
<?=script('jquery.numeric.js')?>
<link href="<?=site_url()?>assets/css/validationEngine.jquery.css" rel="stylesheet" type="text/css">
<!--<script language="javascript" src="<?=site_url()?>assets/js/jquery-1.6.minx.js"></script>-->
<script language="javascript" src="<?=site_url()?>assets/js/jquery.validationEnginex.js"></script>
<script language="javascript" src="<?=site_url()?>assets/js/jquery.validationEngine-enx.js"></script>
<script language="javascript" src="<?=site_url()?>assets/js/jquery.formx.js"></script>
<?=script('datagrid-detailview.js')?>
<?=script('currency.js')?>

<script type="text/javascript">
$(function(){
		$('.calculate').bind('keyup keypress',function(){
		$(this).val(numToCurr($(this).val()));
	 }).numeric();
	 
	 $('#formAdd')
		.ajaxForm({
			success:function(response){
				if(response=="sukses"){
					alert(response);
					refreshTable();
				}else{
					alert(response);
				}
			}
		});			
	 
	 
});
</script>

<form id="formAdd" method="post" action="<?=site_url('coa/simpan')?>">
	<table>
		<tr>
			<td>Acc No</td>
			<td>:</td>
			<td><input type="text" name="acc_no" class="xinput"/></td>
		</tr>	
		<tr>
			<td>Acc Name</td>
			<td>:</td>
			<td><input type="text" name="acc_name" class="xinput"/></td>
		</tr>	
		<tr>	
			<td>Currency</td>
			<td>:</td>
			<td>
				<select name="currency" class="xinput">
					<option></option>
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
			<option></option>
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
			<td colspan='3'><input type="submit" name="save" value="Save"/></td>
		</tr>
	</table>
</form>
