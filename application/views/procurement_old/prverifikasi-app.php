<?=link_tag(CSS_PATH.'easyui.css')?>
<?=link_tag(CSS_PATH.'icon.css')?>
<?=link_tag(CSS_PATH.'demo.css')?>
<?#=script('jquery-1.7.2.min.js')?>
<?=script('jquery.easyui.min.js')?>
<?=script('datagrid-detailview.js')?>

<script type="text/javascript">
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
						href:"<?=site_url('prverifikasi/show_vend')?>/"+idpr+"/?index="+index,
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
					
</script>





 <form action="" method="post">
	<input type="hidden" name="idpr" id="idpr" value="<?=$data->id_pr?>"/>
		<table>
			<tr>
				<td>Tgl. PR</td>
				<td><input type="text" name="tglpr" id="tglpr" value="<?=gettgl(); ?>" readonly="true"/></td>
			</tr>
			<tr>
				<td>No. PR</td>
				<td><input type="text" name="nopr" id="nopr" value="<?=$data->no_pr?>" style="width:200px" readonly="true"/></td>
			</tr>
			<tr>
				<td>Budget Name</td>
				<td colspan="3"><input type="text" name="bgtnm" value="<?=$data->description?>" id="bgtnm" size="40" readonly="true"/></td>
			</tr>

			<tr>
				<td>Amount</td>
				<td><input type="text" name="amountpr" id="amountpr" readonly="true" value="<?=number_format($data->amount)?>" style="text-align:right"/></td>
			</tr>
		</table>	


<div class="easyui-tabs" style="width:900px;height:300px;">
	<div title="Penawaran Vendor" style="padding:10px;">
		<table id="dg" title="Mapping Vendor" style="width:800px;height:250px"
				url="<?=site_url('prverifikasi/get_dg')?>/<?=$data->id_pr?>"
				toolbar="#toolbar" pagination="true"
				fitColumns="true" singleSelect="true">
			<thead>	 		
				<tr>			
					<th field="brg" width="50"   editor="{type:'validatebox',options:{required:true}}">Nama Barang</th>				
					<th field="vendor" width="50"   editor="{type:'validatebox',options:{required:true}}">Vendor</th>				
					<th field="satuan" width="50" class="easyui-combobox" editor="text">Hrg.Satuan</th>
					<th field="diskon" width="50"  editor="text">Diskon</th>
					<th field="total" width="50" editor="text">Subtotal</th>
				</tr>
			</thead>
		</table>
		<div id="toolbar">
			<a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newItem()">New</a>
			<a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyItem()">Destroy</a>
		</div>
	</div>
</div>
<input type="submit" value="OK" name="ok"/>






