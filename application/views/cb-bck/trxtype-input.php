<html>
<head>
<link rel="stylesheet" href="<?=base_url()?>assets/css/easyui.css" type="text/css" />
<link rel="stylesheet" href="<?=base_url()?>assets/css/icon.css" type="text/css" />
<link rel="stylesheet" href="<?=base_url()?>assets/css/demo.css" type="text/css" />
<!--script language="javascript" src="<?=base_url()?>assets/js/jquery-1.7.2.min.js"></script-->
<script language="javascript" src="<?=base_url()?>assets/js/jquery.easyui.min.js"></script>
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
				url: "<?=site_url('trxtype/cekdata')?>",
				saveUrl: "<?=site_url('trxtype/save')?>",
				updateUrl: "<?=site_url('trxtype/save')?>",
				destroyUrl: "<?=site_url('trxtype/delete')?>"
			});
		});
		
		// function loadData(){
			// $('#cc').combobox({
				// url:"<?=site_url('trxtype/cekdata')?>",
				// valueField:'trxtype_id',
				// textField:'trx_type'
			// });
		// }		
	</script>
</head>
<body>
	<h2>Adjusment Jurnal</h2>		
	</div>
	<tr>
		<td>Bank Name</td>
			<td>:</td>
			<td><input type="text" name="bank_nm" id="bank_nm" class="validate[required] xinput" xinput" value="<?=@$data->bank_nm?>" class="validate[required]" size="30" /></td>
	</tr>
	<tr>
	<td>
	</td>	
	</tr>	
	<table id="dg" title="My Users" style="width:700px;height:250px"
			toolbar="#toolbar" pagination="true"
			rownumbers="true" fitColumns="true" singleSelect="true">
		<thead>
			<tr>
			<th field="test" width="25" id='acc_no' editor="{type:'combobox',options:{valueField:'productid',textField:'name',data:products,required:true}}">Acc No</th>
				
				<th field="trx_type" width="50" editor="{type:'validatebox',options:{required:true}}">Trx Type</th>
				<th field="descs" width="50" editor="text">Descs</th>
				<th field="trx_mode" width="50" editor="text">Mode</th>
			</tr>
		</thead>
	</table>
	<div id="toolbar">
		<a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="javascript:$('#dg').edatagrid('addRow')">New</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="javascript:$('#dg').edatagrid('destroyRow')">Delete</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="javascript:$('#dg').edatagrid('saveRow')">Save</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-undo" plain="true" onclick="javascript:$('#dg').edatagrid('cancelRow')">Cancel</a>
	</div>	
</body>
</html>
