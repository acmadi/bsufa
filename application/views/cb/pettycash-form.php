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
	
		$.fn.datebox.defaults.formatter = function(date) {
			var y = date.getFullYear();
			var m = date.getMonth() + 1;
			var d = date.getDate();
			return (d < 10 ? '0' + d : d) + '-' + (m < 10 ? '0' + m : m) + '-' + y;
		};	
		
		$('#claim_date').datebox({  
                                                required:true  
                                });
	
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
		

			
					if (saldo <  amount) {
					
                              alert('Nilai Reimburse lebih besar daripada Saldo Petty Cash');
							  $('#amount').val(0);
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
        idField:'kodecash',  
        textField:'kodecash',  
        url:'pettycash/cashflow', 
        columns:[[  
            {field:'kodecash',title:'kodecash',width:100},  
            {field:'nama',title:'nama',width:300} 
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

		$( document ).ready(function() {
		
				var id_petty = '<?=@$data->pettycash_id?>';	
				
				var type_petty = '<?=@$data->type?>';
			
				if(type_petty==1){

				$.getJSON('<?=site_url('pettycash/getsaldo_last')?>/'+type_petty+'/'+id_petty,
							function(data){
								
								$("#saldo").val(numToCurr(data.saldo));
							});
				
				}
				else
				{
					$.getJSON('<?=site_url('pettycash/getsaldo_last')?>/'+type_petty+'/'+id_petty,
							function(data){
								
								$("#saldo").val(numToCurr(data.saldo));
							});
				
	
				}
				
		});
		
		$('#type').change(function(){
					
				var id_petty = '<?=@$data->pettycash_id?>';	
			
				if($("#type option:selected").val()==1){

				//$('#cc').attr('readOnly',true);
				 $('#cc').combogrid('disable');
				$.getJSON('<?=site_url('pettycash/getsaldo')?>/'+$(this).val()+'/'+id_petty,
							function(data){
								
								$("#saldo").val(numToCurr(data.saldo));
							});
				
				}
				else
				{
					 $('#cc').combogrid('enable');
					$.getJSON('<?=site_url('pettycash/getsaldo')?>/'+$(this).val()+'/'+id_petty,
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

<form id="formAdd" action="<?=site_url()?>pettycash/edit" method="post" >
<table>
	<tr>
		<td colspan='3'><font color='red'><b>EDIT PETTY CASH</b></font></td>
		<td colspan='3'>&nbsp;</td>
	</tr>
	<tr>
		<td>Nomor</td>
			<td>:</td>
			<td><input type="text" name="claim_no" class="validate[required] xinput" id="claim_no"value="<?=@$data->claim_no?>"  size="30" /></td>
	</tr>
	<tr>
		<td>Date</td>
			<td>:</td>
			<td><input id="claim_date" name="claim_date"  value="<?=@$data->claim_date?>" size="30"></input></td>
	</tr>
	<tr>	
			<td>Type</td>
			<td>:</td>
			<td>
			<select name="type" id="type">
			<option></option>
			<?php $type_Arr = array('1'=>'Opening','2'=>'Reimburse'); ?>
			<?php foreach($type_Arr as $key => $val):?>
				<option value='<?php echo $key;?>' <?php if($key == $data->type){echo 'selected';}?>><?php echo $val;?></option>
			<?php endforeach;?>
			</select>		
			</td>
		</tr>
		<tr>
		<td>Cash Out </td>
			<td>:</td>
			<td><select class="easyui-combogrid" id="cc" name="acc_no" readonly="true" value="<?=$data->acc_no?>"></select> </td>
			
	</tr>
	<tr>
		<td>Amount</td>
			<td>:</td>
			<td>
				<input type="text" name="amount" class="calculate input validate[required]" id="amount" value="<?=number_format($data->credit)?>"  size="30" />
				<input type="hidden" name="amount2" class="calculate" id="amount" value="<?=number_format($data->credit)?>" />
			</td>
			<td>Sisa Saldo</td>
			<td>:</td>
			<td><input type="text" name="saldo" class="calculate input validate[required]" id="saldo" readonly="true"  size="30" /></td>
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
