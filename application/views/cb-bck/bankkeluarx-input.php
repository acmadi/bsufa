<html>
<head>
<link rel="stylesheet" href="<?=base_url()?>assets/css/easyui.css" type="text/css" />
<link rel="stylesheet" href="<?=base_url()?>assets/css/icon.css" type="text/css" />
<link rel="stylesheet" href="<?=base_url()?>assets/css/demo.css" type="text/css" />

<!--script language="javascript" src="<?=base_url()?>assets/js/jquery-1.7.2.min.js"></script-->
<script language="javascript" src="<?=base_url()?>assets/js/jquery.easyui.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/jquery.edatagrid.js"></script>
<?=script('jquery.formx.js')?>
<?=script('currency.js')?>

<script type="text/javascript">		
	$(function(){		
$("#apno").change(function(){
	//alert('tes');
	//$('#amount').val(0);
			$.getJSON('<?=site_url()?>/bankkeluarx/getdata/' + $(this).val(),
			function(getdata){				
				$('#total_billing').val(numToCurr(getdata.MBASE_AMT));
				$('#paid_billing').val(numToCurr(getdata.MALLOC_AMT));
				$('#balance').val(numToCurr(getdata.MBAL_AMT));
				$('#remark').val((getdata.DESCS));
				$('#amount').val(numToCurr(getdata.amount));
				$('#alamat').val(getdata.alamat);
				$('#nm_supplier').val(getdata.nm_supplier);
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
		});	

		$('.calculate').bind('keyup keypress',function(){
			var rep_coma = new RegExp(",", "g");
			$(this).val(numToCurr($(this).val()));			
			var amount = parseInt($('#amount').val().replace(rep_coma,""));
					var balance = parseInt($('#balance').val().replace(rep_coma,""));
		
					if (amount > balance) {
					
                              alert('Nilai Amount lebih besar daripada Nilai Balance');
							  $('#amount').val(0);
							}
					else  {
							}
			});	
			
		$('#gg').combogrid({  
        panelWidth:150,  
        value:'006',  
       
        idField:'apinvoice_id',  
        textField:'doc_no',  
        url:'bankkeluarx/po',  
        columns:[[  
            {field:'doc_no',title:'doc_no',width:150},  
        ]]  
    });  
			
		$('#cc').combogrid({  
        panelWidth:450,  
        value:'',  
       
        idField:'cashflow_id',  
        textField:'nama',  
        url:'bankkeluarx/cashflow',  
        columns:[[  
            {field:'kodecash',title:'kodecash',width:100},  
            {field:'nama',title:'nama',width:200},  
        ]]  
    });  
	
		$('#dd').combogrid({  
        panelWidth:450,  
        value:'006',  
       
        idField:'bank_id',  
        textField:'bank_nm',  
        url:'bankkeluarx/bank',  
        columns:[[  
			{field:'bank_id',title:'Kode Bank',width:100},  
            {field:'bank_nm',title:'Nama Bank',width:200},  
			{field:'bank_acc',title:'Rekening',width:200},  
        ]]  
    });  
	
	
	// $('#apno').combogrid({  
        // panelWidth:450,  
        // value:'006',  
       
        // idField:'doc_no',  
        // textField:'doc_no',  
        // url:'bankkeluarx/loadap',  
        // columns:[[  
			// {field:'doc_no',title:'AP No',width:130},  
            // {field:'nm_supplier',title:'Nama Supplier',width:170},  
			// {field:'trx_amt',title:'Jumlah',width:100},  
        // ]]  
    // });  
		$(function(){
			$('#dg').edatagrid({
				url: "<?=site_url('bankkeluarx/cekdata')?>",
				saveUrl: "<?=site_url('bankkeluarx/savedetail/'.$nobk)?>",
				updateUrl: "<?=site_url('bankkeluarx/save')?>",
				destroyUrl: "<?=site_url('bankkeluarx/delete')?>"
			});
		});
		
</script>
</head>
<form id="formAdd" method="post" action="<?=site_url('bankkeluarx/saveheader')?>">
 <?php $tgl = date('m/d/Y'); ?>
<body>
	<table>
	<tr>
	<td colspan="6">
	<h2>BANK PAYMENT</h2>		
	</td>
	</tr>
	<!--<tr>
	<td>Trx Type</td>
			<td>:</td>
			<td>
                        <select name="trxtype">
                                                            <? foreach($trxtype as $row): ?>
                                                            <option value="<?=@$row->trx_type?>"><?=@$row->trx_type?></option> 
                                                            <? endforeach;?>
                        </select>          
            </td>
	</tr>-->
	<tr>
		<td>Voucher</td>
			<td>:</td>
			<td><input type="text" name="voucher" id="voucher" class="validate[required] xinput" xinput" value="<?=$nobk?>" class="validate[required]" size="30" /></td>

			<td>Tagihan AP</td>
			<td>:</td>			
			<!--<td>
					<select id="gg" name="apno" size="80" >
					<option></option>
					</select> 
            </td>-->
			
			<td>
                        <select name="apno" id="apno">
						<option></option>
                                                            <? foreach($po as $row): ?>
                                                            <option value="<?=@$row->id_plan?>"><?=@$row->doc_no?> | <?=@$row->id_plan?></option> 
                                                            <? endforeach;?>
                        </select>          
            </td>

			
	</tr>
	<tr>
		<td>Nama Supplier</td>
			<td>:</td>
			<td><input type="text" name="nm_supplier" id="nm_supplier" readonly="readonly" size="30" /></td>

			<td>Alamat Supplier</td>
			<td>:</td>			
			<!--<td>
					<select id="gg" name="apno" size="80" >
					<option></option>
					</select> 
            </td>-->
			
			<td>
                        <textarea name="alamat" id="alamat" readonly="readonly" style="width:208px"></textarea>        
            </td>

			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
	</tr>
	<tr>
		<td>Trans Date</td>
			<td>:</td>
			<td>
			<input id="tgl" name="tgl" class="easyui-datebox" value="<?=$tgl?>" size="30"></input>
			</td>			
			<td>Paid By</td>			
			<td>:</td>
			<td>
			<select name='paid'>
			<option value='Cash'>Cash</option>
			<option value='Transfer'>Transfer</option>
			<option value='Cheque'>Cheque</option>
			</select>
			</td>
			<td>Total</td>
			<td>:</td>
			<td><input type="text" name="total_billing" id="total_billing" class="calculate input validate[required]" value="<?=@$data->total_billing?>" style="width:100px;background-color:#EFFC94" readonly="true" size="30" /></td>
		
	</tr>
	<tr>
		<!--<td>From</td>
			<td>:</td>
			<td><input type="text" name="from" id="from" class="validate[required] xinput" xinput" value="<?=@$data->from?>" class="validate[required]" size="30" /></td>-->
			<!--<td>No. Cek</td>
			<td>:</td>
			<td><input type="text" name="nocek" id="nocek" class="validate[required] xinput" xinput" value="<?=@$data->nocek?>" class="validate[required]" size="30" /></td>-->
			<!--<td>Bank Date</td>
			<td>:</td>
			<td>
			<input id="paid_date" name="paid_date" class="easyui-datebox" size="30"></input>
			</td>-->
			<td>Bank</td>
			<td>:</td>
			<td>
					<select id="dd" name="bank" size="80" >
					<option></option>
					</select> 
            </td>
				<td>Amount</td>			
			<td>:</td>
			<td><input type="text" class="calculate input validate[required]" name="amount" id="amount" value="<?=@$data->amount?>" size="30" /></td>
			<td>Paid</td>
			<td>:</td>
			<td><input type="text" name="paid_billing" id="paid_billing" class="calculate input validate[required]" value="<?=@$data->paid_billing?>"  style="width:100px;background-color:#EFFC94" readonly="true" size="30" /></td>
			
	</tr>
	<tr>
			
			<!--<td>Ttd Check</td>
			<td>:</td>
			<td>
			<input id="cek_date" name="cek_date"  class="easyui-datebox" size="30"></input>
			</td>-->
			
			
	</tr>
	<tr>
	<td>CashFlow</td>			
			<td>:</td>
			<td><select id="cc" name="kodecash" size="80" ></select> </td>
		<td>Remark</td>
			<td>:</td>
			<td><input type = "text " name="remark" id="remark" class="validate[required] xinput" value="<?=@$data->remark?>" class="validate[required]" size="30" /></td>
		<td>Balance </td>
			<td>:</td>
			<td><input type="text" name="balance" id="balance" class="calculate input validate[required]" value="<?=@$data->balance?>"  style="width:100px;background-color:#EFFC94" readonly="true" size="30" /></td>
			
			
	</tr>
	</table>
	<!--<table id="dg" title="Cashbook Detail" style="width:880px;height:250px"
			toolbar="#toolbar"
			rownumbers="true" fitColumns="true" singleSelect="true">
		<thead>	 		
			<tr>			
				<th field="acc_no" width="80"  class="easyui-combobox" editor="{type:'combobox',options:{valueField:'acc_no',textField:'name',url:'<?=site_url('bankkeluarx/loadcoa')?>',required:true}}">Acc No</th>				
				
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
			<td colspan='3'><input type="submit" name="save" value="Save"/></td>
			<td colspan='3'><input type="reset" name="cancel" value="Cancel"/></td>
		</tr>
		</form>
</body>
</html>
