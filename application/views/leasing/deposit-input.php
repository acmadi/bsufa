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
			var nilai = 5000000;
		
					if($("#type option:selected").val()==1){
			
					if (saldo <  amount) {
					
                              alert('Nilai Reimburse lebih besar daripada Saldo Petty Cash');
							  $('#amount').val(0);
							}	else
							 if (total > 5000000){
								alert('Nilai Harus 5.000.000');
							  $('#amount').val(0);
			
							}else
							if (amount>nilai){
							alert('Nilai Harus 5.000.000');
							  $('#amount').val(0);
			
							}
			}else {
			if (saldo <  amount) {
					
                              alert('Nilai Reimburse lebih besar daripada Saldo Petty Cash');
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
		
		function loadData(type,parentId){
	  $('#loading').text('Loading '+type.replace('_','/')+' data...');
      $.post('<?=site_url('deposit/loaddata')?>',
		{data_type: type, parent_id: parentId},
		function(data){
		 
		   if(data.error == undefined){ 
			 $('#'+type).empty();
			 $('#'+type).append($('<option></option>').val('').text(''));
			 for(var x=0;x<data.length;x++){
			 	$('#'+type).append($('<option></option>').val(data[x].id).text(data[x].nama));
			 }
			 $('#loading').text('');
		  }else{
			 alert(data.error);
			 //$('#cb_karycutials').text('');
		  }
		},'json' 
      );      
   }
		
		
		loadData('kd_tenant',0);
		loadData('subproject',0);
		
		
		
	});
	
	$('#cc').combogrid({  
        panelWidth:450,  
        value:'006',  
       
        idField:'kodecash',  
        textField:'kodecash',  
        url:'pettycash/cashflow',  
        columns:[[  
            {field:'kodecash',title:'kodecash',width:100},  
            {field:'nama',title:'nama',width:200},  

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
				
				
	
				});
	

</script>

<form id="formAdd" action="<?=site_url()?>deposit/input" method="post" >
<table>
	<tr>
		<td colspan='3'><font color='red'><b>INPUT DEPOSIT ENTRY</b></font></td>
		<td colspan='3'>&nbsp;</td>
	</tr>
	<tr>
		<td>Nomor</td>
			<td>:</td>
			<td><input type="text" name="no_deposit" class="validate[required] xinput" id="no_deposit"value="<?=$nopc?>"  size="30" /></td>
	</tr>
	<tr>	
			<td>Project</td>
			<td>:</td>
			<td>
			<select name='subproject' id='subproject' style='width:150;background-color:#80FFFF'></select></select>		
			</td>
	</tr>
	<tr>
		<td>Date</td>
			<td>:</td>
			<td><input id="date" name="date" class="easyui-datebox" size="30"></input></td>
	</tr>
	<tr>	
			<td>Tenant</td>
			<td>:</td>
			<td>
			<select name='kd_tenant' id='kd_tenant' style='width:150;background-color:#80FFFF'></select></select>		
			</td>
	</tr>
	<!--<tr>
		<td>Cash Out</td>
			<td>:</td>
			<td><select id="cc" name="acc_no" size="80" readonly="true"></select> </td>
			
	</tr>-->
	<tr>
		<td>Amount</td>
			<td>:</td>
			<td><input type="text" name="base_amt" class="calculate input validate[required]" id="base_amt" value="<?=@$data->base_amt?>"  size="30" /></td>
			
	</tr>
	<tr>
		<td>Description</td>
			<td>:</td>
			<td><input type="text" name="description" class="validate[required] xinput" id="description" value="<?=@$data->description?>"  size="30" /></td>
	</tr>
	
	
	<tr>	
		<td></td>
		<td></td>
		<td>
			<input type="hidden" name="deposit_id" value="<?=@$data->deposit_id?>" />
	
			
			<input type="submit" value="Save" />
			<input type="button" id="btnClose" value="Cancel" />
		</td>
	</tr>
	</table>
</form>
