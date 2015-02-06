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
	<h2>CASHBOOK</h2>		
	</div>
	<tr>
	<td>Trx Type</td>
			<td>:</td>
			<td>
                        <select name="trxtype">
                                                            <? foreach($trxtype as $row): ?>
                                                            <option value="<?=@$row->trx_type?>"><?=@$row->trx_type?></option> 
                                                            <? endforeach;?>
                        </select>          
            </td>
	</tr>
	<br>
	<tr>
		<td>Voucher</td>
			<td>:</td>
			<td><input type="text" name="voucher" id="bank_nm"  disabled="disabled"class="validate[required] xinput" xinput" value="<?=@$data->bank_nm?>" class="validate[required]" size="30" /></td>
			<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
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
	<tr>
		<td>Date&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
			<td>:</td>
			<td>
			<input id="tgl" class="easyui-datebox" size="30"></input>
			</td>
			<!--<td><input type="text" name="voucher_date" id="bank_nm" class="validate[required] xinput" xinput" value="<?=@$data->bank_nm?>" class="validate[required]" size="30" /></td>-->
			<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			<td>Paid&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>			
			<td>:</td>
			<select name='paid'>
			<option value='ca'>Cash</option>
			<option value='tr'>Transfer</option>
			<option value='ce'>Cek</option>
			</select>
	</tr>
	<br>	
		<tr>
		<td>Ref No&nbsp;&nbsp; </td>
			<td>:</td>
			<td><input type="text" name="refno" id="refno" class="validate[required] xinput" xinput" value="<?=@$data->refno?>" class="validate[required]" size="30" /></td>
			<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
			<td>Amount&nbsp;</td>			
			<td>:</td>
			<td><input type="text" name="amount" id="amount" class="validate[required] xinput" xinput" value="<?=@$data->amount?>" class="validate[required]" size="30" /></td>
	</tr>
	<br>	
	<tr>
		<td>Remark</td>
			<td>:</td>
			<td><input type="text" name="remark" id="remark" class="validate[required] xinput" xinput" value="<?=@$data->remark?>" class="validate[required]" size="80" /></td>
			
			
	</tr>
	</tr>
	
	<tr>
	<td>
	</td>	
	</tr>	
	
		<br>
	<br>
	<table id="dg" title="Cashbook Detail" style="width:700px;height:250px"
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
	</div>	
	<br>
	<br>
		<tr>
			<td colspan='3'><input type="submit" name="save" value="Save"/></td>
			<td colspan='3'><input type="reset" name="cancel" value="Cancel"/></td>
		</tr>
		</form>
</body>
</html>
