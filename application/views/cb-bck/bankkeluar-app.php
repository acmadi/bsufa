<html>
<head>
<link rel="stylesheet" href="<?=base_url()?>assets/css/easyui.css" type="text/css" />
<link rel="stylesheet" href="<?=base_url()?>assets/css/icon.css" type="text/css" />
<link rel="stylesheet" href="<?=base_url()?>assets/css/demo.css" type="text/css" />

<!--script language="javascript" src="<?=base_url()?>assets/js/jquery-1.7.2.min.js"></script-->
<script language="javascript" src="<?=base_url()?>assets/js/jquery.easyui.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/jquery.edatagrid.js"></script>
<script language="javascript" src="<?=site_url()?>assets/js/jquery.formx.js"></script>
<?=script('jquery.formx.js')?>
<?=script('currency.js')?>

<script type="text/javascript">		
	$(function(){		
$("#apno").change(function(){
	//alert('tes');
			$.getJSON('<?=site_url()?>/bankkeluar/getdata/' + $(this).val(),
			function(getdata){				
				$('#total_billing').val(numToCurr(getdata.MDOC_AMT));
				$('#paid_billing').val(numToCurr(getdata.MALLOC_AMT));
				$('#balance').val(numToCurr(getdata.MBAL_AMT));
			});
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
				//
				//refreshTable();
				//$('#buttonID').click();
			}
		});	
		});	

		$('.calculate').bind('keyup keypress',function(){
			var rep_coma = new RegExp(",", "g");
			$(this).val(numToCurr($(this).val()));			
			var amount = parseInt($('#amount').val().replace(rep_coma,""));
			});	
			
		$('#cc').combogrid({  
        panelWidth:450,  
        value:'006',  
       
        idField:'kodecash',  
        textField:'kodecash',  
        url:'bankkeluar/cashflow',  
        columns:[[  
            {field:'kodecash',title:'kodecash',width:100},  
            {field:'nama',title:'nama',width:200},  
        ]]  
    });  
	
		$('#dd').combogrid({  
        panelWidth:450,  
        value:'006',  
       
        idField:'kodebank',  
        textField:'namabank',  
        url:'bankkeluar/bank',  
        columns:[[  
			{field:'kodebank',title:'Kode Bank',width:100},  
            {field:'namabank',title:'Nama Bank',width:100},  
            {field:'nomorrek',title:'Rekening',width:200},  
        ]]  
    });  
	// $('#apno').combogrid({  
        // panelWidth:450,  
        // value:'006',  
       
        // idField:'doc_no',  
        // textField:'doc_no',  
        // url:'bankkeluar/loadap',  
        // columns:[[  
			// {field:'doc_no',title:'AP No',width:130},  
            // {field:'nm_supplier',title:'Nama Supplier',width:170},  
			// {field:'trx_amt',title:'Jumlah',width:100},  
        // ]]  
    // });  
		$(function(){
			$('#dg').edatagrid({
				url: "<?=site_url('bankkeluar/cekdata/'.$data->id_cash.'')?>",
				saveUrl: "<?=site_url('bankkeluar/savedetail/'.$nobk)?>",
				updateUrl: "<?=site_url('bankkeluar/save')?>",
				destroyUrl: "<?=site_url('bankkeluar/delete')?>"
			});
			
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
</head>
<form id="formAdd" method="post" action="<?=site_url('bankkeluar/approve2/'.$data->id_cash.'')?>" id="formAdd">
<body>
	<table>
	<tr>
	<td colspan="6">
	<h2>BANK PAYMENT</h2>		
	</td>
	</tr>
	<tr>	
	</tr>
	<tr>
		<td>Voucher</td>
			<td>:</td>
			<td><input type="text" name="voucher" id="voucher" class="validate[required] xinput" xinput" value="<?=@$data->voucher?>"  style="width:150px;background-color:#EFFC94" readonly="true" size="30" /></td>

			<td>Tagihan AP</td>
			<td>:</td>
			<td><input type="text" name="doc_no" id="doc_no" class="validate[required] xinput" xinput" value="<?=@$data->doc_no?>"  style="width:150px;background-color:#EFFC94" readonly="true" size="30" /></td>
			<td>Total</td>
			<td>:</td>
			<td><input type="text" name="total_billing" id="total_billing" class="calculate input validate[required]" value="<?=@$data->mbase_amt?>" style="width:150px;background-color:#EFFC94" readonly="true" size="30" /></td>
	</tr>
	<tr>
		<td>Payment Date</td>
			<td>:</td>		
			<td><input type="text" name="tgl" id="tgl" class="validate[required] xinput"   value="<?=@$data->trans_date?>" style="width:150px;background-color:#EFFC94" readonly="true" size="30" /></td>
			<td>Paid By</td>			
			<td>:</td>
			<td><input type="text" name="paid" id="paid" class="validate[required] xinput"  value="<?=@$data->paidby?>" style="width:150px;background-color:#EFFC94" readonly="true" size="30" /></td>
				<td>Paid</td>
			<td>:</td>
			<td><input type="text" name="paid_billing" id="paid_billing" class="calculate input validate[required]" value="<?=@$data->malloc_amt?>"  style="width:150px;background-color:#EFFC94" readonly="true" size="30" /></td>

	</tr>
	<tr>		
			<td>No. Cek</td>
			<td>:</td>
			<td><input type="text" name="nocek" id="nocek" class="validate[required] xinput" xinput" value="<?=@$data->slipno?>" style="width:150px;background-color:#EFFC94" readonly="true" size="30" /></td>
			<td>Bank Date</td>
			<td>:</td>			
			<td><input type="text" name="paid_date" id="paid_date" class="validate[required] xinput" xinput" value="<?=@$data->payment_date?>" style="width:150px;background-color:#EFFC94" readonly="true" size="30" /></td>
			<td>Balance </td>
			<td>:</td>
			<td><input type="text" name="balance" id="balance" class="calculate input validate[required]" value="<?=@$data->mbal_amt?>"  style="width:150px;background-color:#EFFC94" readonly="true" size="30" /></td>
				
	</tr>
	<tr>
			<td>Bank</td>
			<td>:</td>
			<td><input type="text" name="bank" id="bank" class="validate[required] xinput" xinput" value="<?=@$data->acc_name?>" style="width:177px;background-color:#EFFC94" readonly="true" size="30" /></td>
			<td>Ttd Check</td>
			<td>:</td>
			<td><input type="text" name="cek_date" id="cek_date" class="validate[required] xinput" xinput" value="<?=@$data->slip_date?>" style="width:150px;background-color:#EFFC94" readonly="true" size="30" /></td>
			
	</tr>
	<tr>
		<td>Remark</td>
			<td>:</td>
			<td><input "text " name="remark" id="remark" class="validate[required] xinput" xinput" value="<?=@$data->descs?>" style="width:177px;background-color:#EFFC94" readonly="true"  size="30" /></td>
			<td>Amount</td>			
			<td>:</td>
			<td><input type="text" class="calculate input validate[required]" name="amount" id="amount" value="<?=@$data->amount?>"  style="width:150px;background-color:#EFFC94" readonly="true" size="30" /></td>
			
	</tr>
	</table>
	<!--<table id="dg" title="Cashbook Detail" style="width:880px;height:250px"
			toolbar="#toolbar"
			rownumbers="true" fitColumns="true" singleSelect="true">
		<thead>	 		
			<tr>			
				<th field="acc_no" width="80"  class="easyui-combobox" editor="{type:'combobox',options:{valueField:'acc_no',textField:'name',url:'<?=site_url('bankkeluar/loadcoa')?>',required:true}}">Acc No</th>				
				
				<th field="line_desc" width="50"  editor="text">Descs</th>
				<th field="amount" width="50" editor="numberbox" >Amount</th>
			</tr>
		</thead>
	</table>
	<div id="toolbar" >
		<a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="javascript:$('#dg').edatagrid('addRow')">New</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="javascript:$('#dg').edatagrid('destroyRow')">Delete</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="javascript:$('#dg').edatagrid('saveRow')">Save</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-undo" plain="true" onclick="javascript:$('#dg').edatagrid('cancelRow')">Cancel</a>
	</div>	-->
		<tr>
			<td colspan='3'><input type="submit" name="save" value="Approved"/></td>
			<td colspan='3'><input type="reset" name="cancel" value="Cancel"/></td>
		</tr>
		</form>
</body>
</html>
