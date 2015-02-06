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
/*$("#apno").change(function(){
	//alert('tes');
			$.getJSON('<?=site_url()?>/bankkeluar/getdata/' + $(this).val(),
			function(getdata){				
				$('#total_billing').val(numToCurr(getdata.MDOC_AMT));
				$('#paid_billing').val(numToCurr(getdata.MALLOC_AMT));
				$('#balance').val(numToCurr(getdata.MBAL_AMT));
			});
		});	*/
		
			$.fn.datebox.defaults.formatter = function(date) {
			var y = date.getFullYear();
			var m = date.getMonth() + 1;
			var d = date.getDate();
			return (d < 10 ? '0' + d : d) + '-' + (m < 10 ? '0' + m : m) + '-' + y;
		};	
		
		$('#tgl').datebox({  
                                                required:true  
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
			
		/*$('#cc').combogrid({  
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
		$(function(){
			$('#dg').edatagrid({
				url: "<?=site_url('bankkeluar/cekdata/'.$data->id_cash.'')?>",
				saveUrl: "<?=site_url('bankkeluar/savedetail/'.$nobk)?>",
				updateUrl: "<?=site_url('bankkeluar/save')?>",
				destroyUrl: "<?=site_url('bankkeluar/delete')?>"
			});
		});*/
		
</script>
</head>
<form id="formAdd" method="post" action="<?=site_url('cb/bankkeluar/Editheader2/')?>">
<input type="hidden" name="id_cash" value="<?php echo $row->id_cash;?>">
<body>
	<table>
	<tr>
	<td colspan="6">
	<h2>BANK PAYMENT DATE</h2>		
	</td>
	</tr>
	<tr>	
	</tr>
	<tr>
		<td>Voucher</td>
			<td>:</td>
			<input type="hidden" name="id_plan" value="<?php echo $row->id_plan;?>">
			<td><input type="text" name="voucher" id="voucher" class="validate[required] xinput" xinput" value="<?php echo $row->voucher;?>"  style="width:180px;background-color:#EFFC94" readonly="true" size="30" /></td>
<td>Trans Date</td>
			<td>:</td>		
			<td><input type="text" name="tgl"  value="<?php echo indo_date($row->trans_date);?>"  size="30" style="width:180px;background-color:#EFFC94" readonly="true"/></td>
	</tr>
	<tr>	<td>Tagihan AP</td>
			<td>:</td>
			<td><input type="text" name="doc_no" id="doc_no" class="validate[required] xinput" xinput" value="<?php echo $row->doc_no;?>"  style="width:180px;background-color:#EFFC94" readonly="true" size="30" /></td>
	<!--td>No Arsip</td>
			<td>:</td>
			<td><input type="text" name="no_arsip" id="no_arsip" class="validate[required] xinput" style="width:180px;background-color:#ffff" size="30" value="<?php echo $row->no_arsip;?>"/></td-->
			<td>No. Cek</td>
			<td>:</td>
			<td><input type="text" style="text-align:left;width:180px" name="nocek" id="nocek" value="<?php echo $row->slipno;?>" size="26"/></td>
	
	</tr>
	<tr>	<td>Paid By</td>			
			<td>:</td>
			<td><input type="text" name="paid" id="paid" class="validate[required] xinput"  value="<?php echo $row->paidby?>" style="width:180px;background-color:#EFFC94" readonly="true" size="30" /></td>
			<!--<td>Bank Date</td>
			<td>:</td>			
			<td><input type="text" name="paid_date" id="paid_date" class="easyui-datebox" xinput" value="<?=@$data->payment_date?>" size="30" /></td>-->
			<td>Tanggal Cek</td>
			<td>:</td>
			<td><input type="text" name="cek_date" id="cek_date" class="easyui-datebox" xinput" value="<?php if(indo_date($row->slip_date)=='01-01-1970'){ echo ''; }else{ echo indo_date($row->slip_date); } ?>"  size="30"  style="width:180px"/></td>
		
	</tr>
	<tr>
			<td>Bank</td>
			<td>:</td>
			<td><input type="text" name="bank" id="bank" class="validate[required] xinput" xinput" value="<?php echo $bank->bank_nm." | ".$bank->bank_acc;?>" style="width:180px;background-color:#EFFC94" readonly="true" size="30" /></td>
				<td>Tanggal Pembayaran</td>
			<td>:</td>
			<td><input type="text" name="payment_date" id="payemnt_date" class="easyui-datebox" xinput" value="<?php if(indo_date($row->payment_date)=='01-01-1970'){ echo ''; }else{ echo indo_date($row->payment_date); }?>"  size="30"  style="width:180px"/></td>
	
			
	</tr>
	<tr>
		<td>Remark</td>
			<td>:</td>
			<td><input "text " name="remark" id="remark" class="validate[required] xinput" xinput" value="<?php echo $row->descs?>" style="width:180px;background-color:#EFFC94" readonly="true"  size="30" /></td>
				<td>Tanggal Cair</td>
			<td>:</td>
			<td><input type="text" name="paid_date" id="paid_date" class="easyui-datebox" xinput" value="<?php if(indo_date($row->paid_date)=='01-01-1970'){ echo ''; }else{ echo indo_date($row->paid_date); } ?>"  size="30"  style="width:180px"/></td>
	
	</tr>
	<tr>
		<td>Amount</td>			
			<td>:</td>
			<td><input type="text" class="calculate input validate[required]" name="amount" id="amount" value="<?php echo number_format($nilai)?>"  style="width:180px;background-color:#EFFC94" readonly="true" size="30" /></td>
			
	</tr>
	</table>
	
		<tr>
			<td colspan='3'><input type="submit" name="save" value="Save"/></td>
			<td colspan='3'><input type="reset" name="cancel" value="Cancel"/></td>
		</tr>
		</form>
</body>
</html>
