<?#=script('jquery.tabs.js')?>
<?=link_tag(CSS_PATH.'easyui.css')?>
<?=link_tag(CSS_PATH.'icon.css')?>
<?=link_tag(CSS_PATH.'demo.css')?>
<?=script('jquery.easyui.min.js')?>
<?=script('jquery.edatagrid.js')?>

<?=script('jquery.numeric.js')?>
<link href="<?=site_url()?>assets/css/validationEngine.jquery.css" rel="stylesheet" type="text/css">
<!--<script language="javascript" src="<?=site_url()?>assets/js/jquery-1.6.minx.js"></script>-->
<script language="javascript" src="<?=site_url()?>assets/js/jquery.validationEnginex.js"></script>
<script language="javascript" src="<?=site_url()?>assets/js/jquery.validationEngine-enx.js"></script>
<script language="javascript" src="<?=site_url()?>assets/js/jquery.formx.js"></script>
<?=script('datagrid-detailview.js')?>
<?=script('currency.js')?>




<script language="javascript">
	$(function(){
		$.validationEngineLanguage.allRules['ajaxValidateNip'] = {
			"url": "<?=site_url('tblkary/ceknip')?>",
	        "alertText": "*This name is already taken",
	        "alertTextOk": "This name is avaliable",
	        "alertTextLoad": "* Validating, please wait"
	     };
		 
		 $('.calculate').bind('keyup keypress',function(){
			var rep_coma = new RegExp(",", "g");
			$(this).val(numToCurr($(this).val()));			
			var amount = parseInt($('#amount').val().replace(rep_coma,""));
			
			var amount = parseInt($('#amount').val().replace(rep_coma,""));
			var saldo = parseInt($('#saldo').val().replace(rep_coma,""));
			var total = amount+saldo;
			var nilai = 15000000;
		
					if($("#type option:selected").val()==1){
			
					// if (saldo <  amount) {
					
                              // alert('Nilai Reimburse lebih besar daripada Saldo Petty Cash');
							  // $('#amount').val(0);
							// }	else
							 if (total > 15000000){
								alert('Nilai Harus 15.000.000');
								  $('#amount').val(0);
				
								}else
							if (amount>nilai){
							alert('Nilai Harus 15.000.000');
							  $('#amount').val(0);
			



								}
			}else {
			if (saldo <  amount) {
					
                              alert('Nilai Reimburse lebih besar daripada Saldo Petty Cash');
							  $('#amount').val(0);
							} else if (amount > 300000 ){
								alert('Nilai Reimburse Tidak Boleh lebih dari Rp 300.000');
								  $('#amount').val(0);
				
								}	
							//else
							 // if (total > 5000000){
								// alert('Nilai Harus 5.000.000');
							  // $('#amount').val(0);
			
							// }else
							// if (amount>nilai){
							// alert('Nilai Harus 5.000.000');
							  // $('#amount').val(0);
			
							// }
			}
			
			});	
	     
		// $('#formAdd')
		// .validationEngine()
		// .ajaxForm({
			// success:function(response){
				// alert(response);
				// refreshTable();
				// //$('#btnReset').click();
			// }
		// });
	});
	
	$('#cc').combogrid({  
        panelWidth:450,  
        value:'006',  
       
        idField:'kodecash',  
        textField:'kodecash',  
        url:'pettycash/cashflow',  
        columns:[[  
            {field:'kodecash',title:'kodecash',width:100},  
            {field:'nama',title:'nama',width:300},  

        ]]  
    });  
	
				$('#formAdd')
		//.validationEngine()
		.ajaxForm({
			
			success:function(response){
				//alert(response);
				if(response=="sukses"){
					alert(response);
					refreshTable();
				}else{
					alert(response);
				}
			}
		});			
		
		$('#type').change(function(){
				
				if($("#type option:selected").val()==1){

				//$('#cc').attr('readOnly',true);
				 $('#cc').combogrid('disable');

				$.getJSON('<?=site_url('pettycash/getsaldo')?>/'+$(this).val(),
							function(data){
								
								$("#saldo").val(numToCurr(data.saldo));
							});
				
				}
				else
				{

					 $('#cc').combogrid('enable');
					$.getJSON('<?=site_url('pettycash/getsaldo')?>/'+$(this).val(),
							function(data){
								
								$("#saldo").val(numToCurr(data.saldo));
							});
				
	
				}
				
				
				// $.getJSON('<?=site_url('jurnaltransfer/getaccname')?>/'+$(this).val(),
							// function(data){
								
								// $("#acc_name").val(data.acc_name);
							// });
				
				});
	

</script>

<form id="formAdd" action="<?=site_url()?>pettycash/input" method="post" >
<table>
	<tr>
		<td colspan='3'><font color='red'><b>INPUT PETTY CASH</b></font></td>
		<td colspan='3'>&nbsp;</td>
	</tr>
	<tr>
		<td>Nomor</td>
			<td>:</td>
			<td><input type="text" name="claim_no" class="validate[required] xinput" id="claim_no"value="<?=$nopc?>"  size="30" /></td>
	</tr>
	<tr>
		<td>Date</td>
			<td>:</td>
			<td><input id="claim_date" name="claim_date" class="easyui-datebox" size="30"></input></td>
	</tr>
	<tr>	
			<td>Type</td>
			<td>:</td>
			<td>
			<select name="type" id="type">
			<option value='0'></option>
			<option value='1'>Opening</option>
			<option value='2'>Reimburse</option>
			</select>		
			</td>
		</tr>
		<tr>
		<td>Cash Out</td>
			<td>:</td>
			<td><select id="cc" name="acc_no" size="80" class="validate[required] xinput" readonly></select> </td>
			
	</tr>
	<tr>
		<td>Amount</td>
			<td>:</td>
			<td><input type="text" name="amount" class="calculate input validate[required]" id="amount" value="<?=@$data->amount?>"  size="30" /></td>
			<td>Sisa Saldo</td>
			<td>:</td>
			<td><input type="text" name="saldo" class="calculate input validate[required]" id="saldo" readonly="true" value="<?=@$data->amount?>"  size="30" /></td>
	</tr>
	<tr>
		<td>Description</td>
			<td>:</td>
			<td><input type="text" name="petty_desc" class="validate[required] xinput" id="petty_desc" value="<?=@$data->petty_desc?>"  size="30" /></td>
	</tr>
	
	
	<tr>	
		<td></td>
		<td></td>
		<td>
			<input type="hidden" name="pettycash_id" value="<?=@$data->pettycash_id?>" />
	
			
			<input type="submit" value="Save" />
			<input type="button" id="btnClose" value="Cancel" />
		</td>
	</tr>
	</table>
</form>
