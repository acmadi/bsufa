<?php
$tglva = date('m/y');
$M = date('m');
$Y = date('y');
$rcek = $this->db->where('substring(kwitansi_no,4,2)',$M)
				 ->where('substring(kwitansi_no,7,2)',$Y)
				 ->order_by('kwitansi_id','DESC')
				 ->get('db_kwitansi')->row();
$nil = substr(@$rcek->kwitansi_no,-5) + 1;
#var_dump($nil);exit;

if($nil > 9999) $code = 'BM/'.$tglva.'/'.$nil;
elseif($nil > 999) $code = 'BM/'.$tglva.'/0'.$nil;
elseif($nil > 99) $code = 'BM/'.$tglva.'/00'.$nil;
elseif($nil > 9) $code = 'BM/'.$tglva.'/000'.$nil;
else $code = 'BM/'.$tglva.'/0000'.$nil;

?>



<html>
<head>
<link rel="stylesheet" href="<?=base_url()?>assets/css/easyui.css" type="text/css" />
<link rel="stylesheet" href="<?=base_url()?>assets/css/icon.css" type="text/css" />
<link rel="stylesheet" href="<?=base_url()?>assets/css/demo.css" type="text/css" />

<!--script language="javascript" src="<?=base_url()?>assets/js/jquery-1.7.2.min.js"></script-->
<script language="javascript" src="<?=base_url()?>assets/js/jquery.easyui.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/jquery.edatagrid.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/calendar.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/calendar2.js"></script>


<script type="text/javascript">	
// var products = 
	// [
		    // {productid:'FI-SW-01',name:'Koi'},
		    // {productid:'K9-DL-01',name:'Dalmation'},
		    // {productid:'RP-SN-01',name:'Rattlesnake'},
		    // {productid:'RP-LI-02',name:'Iguana'},
		    // {productid:'FL-DSH-01',name:'Manx'},
		    // {productid:'FL-DLH-02',name:'Persian'},
		    // {productid:'AV-CB-01',name:'Amazon Parrot'}
		// ];			
		
	 $('#cc').combogrid({  
        panelWidth:450,  
        value:'006',  
       
        idField:'kodecash',  
        textField:'kodecash',  
        url:'bankmasuk/cashflow',  
        columns:[[  
            {field:'kodecash',title:'kodecash',width:100},  
            {field:'nama',title:'nama',width:200},  

        ]]  
    });  
	
		 $('#dd').combogrid({  
        panelWidth:450,  
        value:'006',  
       
        idField:'acc_no',  
        textField:'acc_no',  
        url:'bankmasuk/loadcoa',  
        columns:[[  
            {field:'acc_no',title:'acc_no',width:100},  
            {field:'acc_name',title:'acc_name',width:200},  

        ]]  
    });  

		$(function(){
			$('#dg').edatagrid({
				url: "<?=site_url('bankmonitoring/cekdata')?>",
				saveUrl: "<?=site_url('bankmonitoring/savedetail')?>",
				updateUrl: "<?=site_url('bankmonitoring/save')?>",
				destroyUrl: "<?=site_url('bankmonitoring/delete')?>"
			});
		});
		
		function qq(value,name){
			alert(value+":"+name)
		}		
	
	</script>
</head>
<form method="post" action="<?=site_url('bankmonitoring/saveheader')?>">
<body>
	<h2>BANK MASUK</h2>		
	</div>
	<tr>
		<td>Voucher</td>
			<td>:</td>
			<td><input type="text" name="voucher" id="voucher"  disabled="disabled"class="validate[required] xinput" xinput" value="<?=$code?>" class="validate[required]" size="30" /></td>
			<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
			<td>Paid&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>			
			<td>:</td>
			<select name='paid'>
			<option value='Cash'>Cash</option>
			<option value='Transfer'>Transfer</option>
			<option value='Cek'>Cek</option>
			</select>
			

	</tr>
	<br>
	<br>
	<tr>
			<td>From&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
			<td>:</td>
			<td><input type="text" name="refno" id="refno" class="validate[required] xinput" xinput" value="<?=@$data->refno?>" class="validate[required]" size="30" /></td>
			<!--<td><input type="text" name="voucher_date" id="bank_nm" class="validate[required] xinput" xinput" value="<?=@$data->bank_nm?>" class="validate[required]" size="30" /></td>-->
			<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			<td>Payment</td>
			<td>:</td>
			<td>
			<input id="payment" class="easyui-datebox" size="30"></input>
			</td>
		
	</tr>
	<br>
	<br>
		<tr>

			<td>Date&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
			<td>:</td>
			<td>
			<input id="tgl" class="easyui-datebox" size="30"></input>
			</td>
			<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			<td>Bank&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  </td>
			<td>:</td>
			<td>
                        <select name="bank">
                                                            <? foreach($bank as $row): ?>
                                                            <option value="<?=@$row->bank_id?>"><?=@$row->bank_nm?></option> 
                                                            <? endforeach;?>
                        </select>          
            </td>
			
	</tr>
	<br>	
	<br>
	<tr>
	<td>Cash IN</td>
			<td>:</td>
			<td><select id="cc" name="kodecash" size="80" ></select> </td>		
			<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
		<td>Amount&nbsp;</td>			
			<td>:</td>
			<td><input type="text" class="easyui-numberbox"  precision="2" groupSeparator="," name="amount" id="amount" class="validate[required] xinput" xinput" value="<?=@$data->amount?>" class="validate[required]" size="30" /></td>
			
			
	</tr>
	<br>	
	<br>
	<tr>		
			<td>Account</td>
			<td>:</td>
			<td><select id="dd" name="acc_no" size="30" ></select> </td>	
	</tr>
	<br>	
	<br>
	<tr>
		<td>Remark</td>
			<td>:</td>
			<td><input type="textarea " name="remark" id="remark" style="height:60px;" class="validate[required] xinput" xinput" value="<?=@$data->remark?>" class="validate[required]" size="80" /></td>
	</tr>
	</tr>
	
	<tr>
	<td>
	</td>	
	</tr>	
	
		<br>
	<br>
	<!--<table id="dg" title="Cashbook Detail" style="width:700px;height:250px"
			toolbar="#toolbar"
			rownumbers="true" fitColumns="true" singleSelect="true">
		<thead>	 		
			<tr>			
				<th field="acc_no" width="50"  class="easyui-combobox" editor="{type:'combobox',options:{valueField:'acc_no',textField:'acc_no',url:'<?=site_url('bankmonitoring/loadcoa')?>',multiple:true,required:true}}">Acc No</th>				
				<th field="dept" width="50" editor="{type:'combobox',options:{valueField:'divisi_id',textField:'divisi_nm',url:'<?=site_url('bankmonitoring/loaddivisi')?>',required:true}}">Divisi</th>
				<th field="line_desc" width="50"  editor="text">Descs</th>
				<th field="amount" width="50" editor="numberbox">Amount</th>
			</tr>
		</thead>
	</table>
	<div id="toolbar">
		<a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="javascript:$('#dg').edatagrid('addRow')">New</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="javascript:$('#dg').edatagrid('destroyRow')">Delete</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="javascript:$('#dg').edatagrid('saveRow')">Save</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-undo" plain="true" onclick="javascript:$('#dg').edatagrid('cancelRow')">Cancel</a>
	</div>	-->
	<br>
	<br>
		<tr>
			<td colspan='3' align="center"><input type="submit" name="save" value="Save"/></td>
			<td colspan='3'><input type="reset" name="cancel" value="Cancel"/></td>
		</tr>
		</form>
</body>
</html>
