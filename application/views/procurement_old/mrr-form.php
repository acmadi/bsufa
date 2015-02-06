<?=link_tag(CSS_PATH.'x-forminput.css')?>
<?=script('currency.js')?>
<?=link_tag(CSS_PATH.'easyui.css')?>
<?=link_tag(CSS_PATH.'icon.css')?>
<?=link_tag(CSS_PATH.'demo.css')?>
<?#=script('jquery-1.7.2.min.js')?>
<?=script('jquery.easyui.min.js')?>
<?=script('datagrid-detailview.js')?>

<script type="text/javascript">
$(function(){
		$.fn.datebox.defaults.formatter = function(date) {
			var y = date.getFullYear();
			var m = date.getMonth() + 1;
			var d = date.getDate();
			return (d < 10 ? '0' + d : d) + '-' + (m < 10 ? '0' + m : m) + '-' + y;
		};	
		
		
			
		
			//GRID Spesial Vendor
			$('#dg').datagrid({
				view: detailview,
				detailFormatter:function(index,row){
					return '<div class="ddv"></div>';
				},
				onExpandRow: function(index,row){
					var ddv = $(this).datagrid('getRowDetail',index).find('div.ddv');
					var idpo   = $('#idpoh').val();
					ddv.panel({
						border:false,
						cache:true,
						href:"<?=site_url('mrr/show_mrr')?>/"+idpo+"/?index="+index,
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
	
		function saveItem(index){
			var row = $('#dg').datagrid('getRows')[index];
			var url = row.isNewRecord ? '<?=site_url('mrr/save_dg')?>' : '<?=site_url('mrr/save_dg')?>/'+row.id;
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
<?php
$attr = array('class' => 'block-content form', 'id' => 'formAdd');
echo form_open(site_url('mrr/saveall'), $attr);
?>
<div style="width:900px">
	<div class="x1">
		<input type="hidden" name="idpoh" id="idpoh" value="<?=$data->BrgPOH_ID?>"/> 
		<label>Divisi</label><input type="text" name="divisi" id="divisi" value="<?=$data->divisi_nm?>" readonly="true"/><br/>
		<label>Reff PR</label><input type="text" name="reff" style="width:185px" readonly="true" value="<?=$data->reff_pr?>"/><br/>
		<label>Tgl PO</label><input type="text" name="tgl_po" id="tgl_po" readonly="true" value="<?=$data->tgl_po?>" style="width:90px"/><br/>
		<label>No. PO</label><input type="text" name="no_po" id="no_po" readonly="true" style="width:185px" value="<?=$data->no_po?>"/><br/>
		<label>Kode Pos</label><input type="text" name="kd_pos" id="kd_pos" readonly="true" style="width:60px"/><br/>	
	    <label>Mata Uang</label><input type="text" name="no_po" id="no_po" readonly="true" style="width:60px" value="<?=$data->matauang?>" /><br/>
	    <label>Reff Type</label><input type="text" name="reff_type" id="reff_type" readonly="true" style="width:60px"  value="DO / FAKTUR"/><br/>
	</div>
	<div class="x1">
		<input type="hidden" name="idpnwr" id="idpnwr"/>
		<label>Supplier</label><input type="text" name="no_po" id="no_po" readonly="true" style="width:120px" value="<?=$data->nm_supp?>" style="width:150px"/><br/>
		<label>PIC</label><input type="text" name="pic" id="pic" value="<?=$data->up_supp?>" readonly="true" style="width:80px"/><br/>
		<label>Alamat</label><input type="text" name="alamat" id="alamat" value="<?=$data->almt_supp?>" readonly="true" style="width:150px"/><br/>
		<label>Kota</label><input type="text" name="kota" id="kota" value="<?=$data->kota_supp?>" readonly="true" style="width:80px"/><br/>
		<label>Telpon</label><input type="text" name="tlp" id="tlp" readonly="true" value="<?=$data->telp_supp?>" style="width:90px"/><br/>
		<label>Fax</label><input type="text" name="fax" id="fax" readonly="true" value="<?=$data->fax_supp?>" style="width:90px"/><br/>	
	    <label>Reff Date</label><input type="text" name="reff_date" id="reff_date" value="<?=gettgl();?>"  readonly="true" style="width:60px"/><br/>	
	</div>
	<div class="x1">
		<label>Reff No.</label><input type="text" name="reff_no" id="reff_no" readonly="true" style="width:90px"/><br/>
		<label>MRR Date</label><input type="text" name="tgl_mrr" id="tgl_mrr" readonly="true" value="<?=gettgl();?>" style="width:90px"/><br/>
		<label>MRR No.</label><input type="text" name="no_mrr" id="no_mrr" value="<?=$no_mrr?>" readonly="true" style="width:185px"/><br/>			
	</div>
</div>
<br/><br/>

<div style="width:900px;padding:20px 0 0 0">
		<table id="dg" title="Input MRR" style="width:800px;height:250px"
				url="<?=site_url('mrr/get_dg')?>/<?=$data->BrgPOH_ID?>"
				toolbar="#toolbar" pagination="true"
				fitColumns="true" singleSelect="true">
			<thead>	 		
				<tr>			
					<th field="kode" width="100px"   editor="{type:'validatebox',options:{required:true}}">Kode</th>				
					<th field="brg" width="120px"   editor="{type:'validatebox',options:{required:true}}">Nama Barang / Inventaris</th>				
					<th field="qty_po" width="80px" class="easyui-combobox" editor="text">Qty PO</th>
					<th field="qty_rc" width="80px" class="easyui-combobox" editor="text">Qty Receipt</th>
					<th field="out_po" width="80px"  editor="text">OutStd QTY</th>
					<th field="satuan" width="100px" editor="text">Satuan</th>
					<th field="masuk" width="80px" editor="text">QTY Masuk</th>
				</tr>
			</thead>
		</table>
		<div id="toolbar">
			<a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newItem()">New</a>
			<a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyItem()">Destroy</a>
		</div>
</div>
<input type="submit" name="simpan" value="Simpan"/>
<input type="button" name="batal" value="Batal"/>
<?=form_close()?>

   


