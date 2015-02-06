<?=link_tag(CSS_PATH.'easyui.css')?>
<?=link_tag(CSS_PATH.'icon.css')?>
<?=link_tag(CSS_PATH.'demo.css')?>
<?#=script('jquery-1.7.2.min.js')?>
<?=script('jquery.easyui.min.js')?>
<?=script('datagrid-detailview.js')?>

<script type="text/javascript">
$(function(){
	
			$('#brg').datagrid({
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
						href:"<?=site_url('prverifikasi/show_brg')?>/"+idpr+"/?index="+index,
						onLoad:function(){
							$('#brg').datagrid('fixDetailRowHeight',index);
							$('#brg').datagrid('selectRow',index);
							$('#brg').datagrid('getRowDetail',index).find('form').form('load',row);
						}
					});
					$('#brg').datagrid('fixDetailRowHeight',index);
				}
			});	
	});
			
		//CRUD
		function newItem(){
			$('#brg').datagrid('appendRow',{isNewRecord:true});
			var index = $('#brg').datagrid('getRows').length - 1;
			$('#brg').datagrid('expandRow', index);
			$('#brg').datagrid('selectRow', index);
		}
		
		function saveItem(index){
			var row = $('#brg').datagrid('getRows')[index];
			var url = row.isNewRecord ? '<?=site_url('prverifikasi/save_brg')?>' : '<?=site_url('prverifikasi/update_brg')?>/'+row.id;
			$('#brg').datagrid('getRowDetail',index).find('form').form('submit',{
				url: url,
				onSubmit: function(){
					return $(this).form('validate');
				},
				success: function(data){
					data = eval('('+data+')');
					data.isNewRecord = false;
					$('#brg').datagrid('collapseRow',index);
					$('#brg').datagrid('updateRow',{
						index: index,
						row: data
					});
				}
			});
		}
</script>





 <form action="" method="post">
	<input type="hidden" name="idpr" value="<?=$data->id_pr?>"/>
		<table>
			<tr>
				<td>Budget Name</td>
				<td colspan="3"><input type="text" name="bgtnm" value="<?=$data->description?>" id="bgtnm" size="40" readonly="true"/></td>
			</tr>
			<tr>
				<td>Tgl. PR</td>
				<td><input type="text" name="tglpr" id="tglpr" value="<?=gettgl(); ?>" readonly="true"/></td>
				<td>Amount</td>
				<td><input type="text" name="amountpr" id="amountpr" readonly="true" value="<?=number_format($data->amount)?>" style="text-align:right"/></td>
			</tr>
			<tr>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>No. PR</td>
				<td><input type="text" name="nopr" id="nopr" value="<?=$data->no_pr?>" style="width:200px" readonly="true"/></td>
			</tr>
			<tr>
				<td>Divisi</td>
				<td><input type="text" name="divisipr" value="<?=$data->divisi_nm?>" id="divisipr" readonly="true"/></td>
				<td>User Requestor</td>
				<td><input type="text" name="reqpr" id="reqpr" value="<?=$nama?>" readonly="true"/></td>
			</tr>		
			<tr>
				<td>Keterangan</td>
				<td colspan= "3">
				<input type="text" name="ketpr" value="<?=$data->ket_pr?>" id="ketpr" readonly="true" class="xinput validate[required]" >
				</td>
			</tr>
			</table>	


<div class="easyui-tabs" style="width:900px;height:350px;">
	<div title="Detail Barang PR" style="padding:10px;">
		<table id="brg" title="Input Contractor" style="width:900px;height:250px"
				url="<?=site_url('prverifikasi/get_brg')?>/<?=$data->id_pr?>"
				toolbar="#toolbar" pagination="true"
				fitColumns="true" singleSelect="true">
			<thead>	 		
				<tr>			
					<th field="request" width="90px">Barang Request</th>				
					<th field="ven_req" width="90px">Vendor Rec.</th>
					<th field="qty" width="60px">Qty</th>
					<th field="satuan" width="60px">Satuan</th>
					<th field="kode" width="100px">Nama Barang</</th>
				</tr>
			</thead>
		</table>
		<div id="toolbar">
		</div>
	</div>
</div>





