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

<script type="text/javascript">

function newItem(){
			$('#dg').datagrid('appendRow',{isNewRecord:true});
			var index = $('#dg').datagrid('getRows').length - 1;
			$('#dg').datagrid('expandRow', index);
			$('#dg').datagrid('selectRow', index);
		}
		
		function saveItem(index){
			var row = $('#dg').datagrid('getRows')[index];
			var url = row.isNewRecord ? '<?=site_url('prverifikasi/save_dg')?>' : '<?=site_url('prverifikasi/save_dg')?>/'+row.id;
			

			
			$('#dg').datagrid('getRowDetail',index).find('form').form('submit',{
				url: url,
				onSubmit: function(){
					return $(this).form('validate');
				},
				success: function(data){
					data = eval('('+data+')');
					data.isNewRecord = false;
					$('#dg').datagrid('collapseRow',index);
					$('#dg').datagrid('updateRow',{
						index: index,
						row: data
					});
				}
			});
		}
                function cancelItem(index){
                                                var row = $('#dg').datagrid('getRows')[index];
                                                if (row.isNewRecord){
                                                                $('#dg').datagrid('deleteRow',index);
                                                } else {
                                                                $('#dg').datagrid('collapseRow',index);
                                                }
                                }

$(function(){
	
	
			//GRID Spesial Vendor
			$('#dg').datagrid({
				view: detailview,
				detailFormatter:function(index,row){
					return '<div class="ddv"></div>';
				},
				onExpandRow: function(index,row){
					var ddv = $(this).datagrid('getRowDetail',index).find('div.ddv');
					var idpr   = $('#idpr').val();
					ddv.panel({
						border:false,
						cache:true,
						href:"<?=site_url('prverifikasi/show_vend')?>/"+ idpr +"/?index="+index,
						onLoad:function(){
							$('#dg').datagrid('fixDetailRowHeight',index);
							$('#dg').datagrid('selectRow',index);
							$('#dg').datagrid('getRowDetail',index).find('form').form('load',row);
						}
					});
					$('#dg').datagrid('fixDetailRowHeight',index);
				}
			});
			
			

});
		//CRUD
		
					
</script>





 <form action="<?=site_url('prverifikasi/save_mapvendor')?>"  method="post">
	<input type="hidden" name="idpr" id="idpr" value="<?=$data->id_pr?>"/>
		<table>
			<tr>
				<td>Tgl. PR</td>
				<td><input type="text" name="tglpr" id="tglpr" value="<?=gettgl(); ?>" readonly="true" size="40"/></td>
			</tr>
			<tr>
				<td>No. PR</td>
				<td><input type="text" name="nopr" id="nopr" value="<?=$data->no_pr?>"  readonly="true" size="40"/></td>
			</tr>
			<tr>
				<td>Budget Name</td>
				<td colspan="3"><input type="text" name="bgtnm" value="<?=$data->description?>" id="bgtnm" size="40" readonly="true" size="40"/></td>
			</tr>

			<tr>
				<td>Amount</td>
				<td><input type="text" name="amountpr" id="amountpr" readonly="true" value="<?=number_format($data->amount)?>" style="text-align:right" size="40"/></td>
			</tr>
		</table>	


<div class="easyui-tabs" style="width:1100px;height:300px;">
	<div title="Penawaran Vendor" style="padding:10px;">
		<table id="dg" title="Mapping Vendor" style="width:1100px;height:250px"
				url="<?=site_url('prverifikasi/get_dg')?>/<?=$data->id_pr?>"
				toolbar="#toolbar" pagination="true"
				fitColumns="true" singleSelect="true">
			<thead>	 		
				<tr>			
					<th field="brg" width="50"  >Nama Barang</th>				
					<th field="vendor1" width="50"  >Vendor 1</th>				
					<th field="satuan1" width="50" >Hrg.Satuan</th>
					<th field="diskon1" width="50"  >Diskon</th>
					<th field="total1" width="50" >Subtotal</th>
					<th field="vendor2" width="50"  >Vendor 2</th>				
					<th field="satuan2" width="50" >Hrg.Satuan</th>
					<th field="diskon2" width="50"  >Diskon</th>
					<th field="total2" width="50" >Subtotal</th>
					<th field="vendor3" width="50"  >Vendor 3</th>				
					<th field="satuan3" width="50" >Hrg.Satuan</th>
					<th field="diskon3" width="50"  >Diskon</th>
					<th field="total3" width="50" >Subtotal</th>
					
					<!--th field="brg" width="50"   editor="{type:'validatebox',options:{required:true}}">Nama Barang</th>				
					<th field="vendor" width="50"   editor="{type:'validatebox',options:{required:true}}">Vendor</th>				
					<th field="satuan" width="50" class="easyui-combobox" editor="text">Hrg.Satuan</th>
					<th field="diskon" width="50"  editor="text">Diskon</th>
					<th field="total" width="50" editor="text">Subtotal</th-->
				</tr>
			</thead>
		</table>
		<!--div id="toolbar">
			<a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newItem()">New</a>
			<a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyItem()">Destroy</a>
		</div-->
	</div>
</div>
<input type="submit" value="OK" name="ok"/>






