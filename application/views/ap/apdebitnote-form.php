<html>
<head>
<link rel="stylesheet" href="<?=base_url()?>assets/css/easyui.css" type="text/css" />
<link rel="stylesheet" href="<?=base_url()?>assets/css/icon.css" type="text/css" />
<link rel="stylesheet" href="<?=base_url()?>assets/css/demo.css" type="text/css" />
<!--script language="javascript" src="<?=base_url()?>assets/js/jquery-1.7.2.min.js"></script-->
<script language="javascript" src="<?=base_url()?>assets/js/jquery.easyui.min.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/currency.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/jquery.edatagrid.js"></script>

<script type="text/javascript">	
	var products =  
	
	
	[
		    {productid:'FI-SW-01',name:'Koi'},
		    {productid:'K9-DL-01',name:'Dalmation'},
		    {productid:'RP-SN-01',name:'Rattlesnake'},
		    {productid:'RP-LI-02',name:'Iguana'},
		    {productid:'FL-DSH-01',name:'Manx'},
		    {productid:'FL-DLH-02',name:'Persian'},
		    {productid:'AV-CB-01',name:'Amazon Parrot'}
		];	

		// $(function(){
			// $('#cc').combogrid({
				// panelWidth:450,
				// value:'006',

				// idField:'trx_type',
				// textField:'descs',
				// url:"<?=site_url('trxtype/cekdata')?>",
				// columns:[[
					// {field:'trx_type',title:'Code',width:60},
					// {field:'descs',title:'Name',width:60}
				// ]]
			// });
		// });
		

		$(function(){
			$('#dg').edatagrid({
				url: "<?=site_url('adjustment/cekdata/'.$data->gl_id.'')?>",
				saveUrl: "<?=site_url('adjustment/savedetail')?>",
				updateUrl: "<?=site_url('adjustment/save')?>",
				destroyUrl: "<?=site_url('adjustment/delete')?>"
			});
		});
		
		

	// $('.calculate').bind('keyup keypress',function(){
		// $(this).val(numToCurr($(this).val()));
	 // }).numeric();	
	 


		
		// function loadData(){
			// $('#cc').combobox({
				// url:"<?=site_url('trxtype/cekdata')?>",
				// valueField:'trxtype_id',
				// textField:'trx_type'
			// });
		// }		
	</script>
</head>
<form method="post" action="<?=site_url('adjustment/approve/'.$data->gl_id.'')?>">
<body>
<table>
	<h2>Memorial Journal</h2>		
	</div>
	<tr>
	<!--<td>Trx Type</td>
			<td>:</td>
			<td>
			<select name="trxtype">
			<option value='AJ'>AJ</option>
			</select>
			</td>
	</tr>-->
		<tr>
			<td><input type="hidden" name="gl_id" id="gl_id" class="validate[required] xinput" xinput" value="<?=@$data->gl_id?>"  style="width:110px;background-color:#EFFC94" readonly="true" size="30" /></td>
	</tr>
	<tr>
		<td>Journal No.</td>
			<td>:</td>
			<td><input type="text" name="voucher" id="voucher" class="validate[required] xinput" xinput" value="<?=@$data->voucher?>"  style="width:110px;background-color:#EFFC94" readonly="true" size="30" /></td>
	</tr>
	<tr>
		<td>Date</td>
			<td>:</td>
			<td><input type="text" name="voucher_date" id="voucher_date" class="validate[required] xinput" xinput" value="<?=@$data->trans_date?>"  style="width:110px;background-color:#EFFC94" readonly="true" size="30" /></td>
	</tr>
	<tr>
		<td>Description</td>
			<td>:</td>
			<td><input type="text" name="remark" id="remark"  xinput" value="<?=@$data->desc?>" style="width:360px;background-color:#EFFC94" readonly="true" size="80" /></td>
	</tr>
	<tr>
	<td>
	</td>	
	</tr>	
	<table id="dg" title="Memorial Journal Detail" style="width:880px;height:250px"
			toolbar="#toolbar" 
			rownumbers="true" fitColumns="true" singleSelect="true">
		<thead>
			<tr>
			<th field="acc_no" width="80" id='acc_no' editor="{type:'combobox',options:{valueField:'acc_no',textField:'name',url:'<?=site_url('adjustment/loadcoa')?>',required:true}}">Acc No</th>
				
				<!--<th field="dept" width="50"editor="{type:'combobox',options:{valueField:'divisi_id',textField:'divisi_nm',url:'<?=site_url('bankmonitoring/loaddivisi')?>',required:true}}">Divisi</th>-->
				<th field="line_desc" width="70" editor="text">Description</th>
				<th field="debit" width="50" align="right" editor="numberbox">Debet</th>
				<th field="credit" width="50" align="right" editor="numberbox">Credit</th>
			</tr>
		</thead>
	</table>
	<div id="toolbar">
		<!--<a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="javascript:$('#dg').edatagrid('addRow')">New</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="javascript:$('#dg').edatagrid('destroyRow')">Delete</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="javascript:$('#dg').edatagrid('saveRow')">Save</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-undo" plain="true" onclick="javascript:$('#dg').edatagrid('cancelRow')">Cancel</a>-->
	</div>	
	<div>

			<td colspan='3'>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

			
			
			</td>
			<td colspan='3'></td>
			<td colspan='3'>Total&nbsp;&nbsp;</td>
			<td colspan='3'><input type="text" align="right" name="debit" id="debit"  xinput" value="<?=@$data->debit?>" style="width:150px;background-color:#EFFC94;text-align:right" readonly="true" size="80" /></td>
		</tr>
			&nbsp;&nbsp;&nbsp;
			<tr>
			<td colspan='3'><input type="text" align="right" name="credit" id="credit"  xinput" value="<?=@$data->credit?>" style="width:150px;background-color:#EFFC94;text-align:right" readonly="true" size="80" /></td>
		</tr>		
		</div>
		<tr>
			<td colspan='3'><input type="submit" name="save" value="Posting"/></td>
			<td colspan='3'><input type="reset" name="cancel" value="Cancel"/></td>
		</tr>
		</table>
</body>
</html>
