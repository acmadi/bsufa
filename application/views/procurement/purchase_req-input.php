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


<script type="text/javascript">

function loadData(type,parentId){
	 $('#loading').text('Loading '+type.replace('_','/')+' data...');
     $.post('<?=site_url('purchase_req/loaddata')?>',
		{data_type: type, parent_id: parentId},
		function(data){
		 
		   if(data.error == undefined){ 
			 $('#'+type).empty();
			 $('#'+type).append($('<option></option>').val('').text(''));
			 for(var x=0;x<data.length;x++){
			 	$('#'+type).append($('<option></option>').val(data[x].id).text(data[x].nama));
			 }
			 $('#loading').text('');
		  }else{
			 alert(data.error);
			 //$('#cb_karycutials').text('');
		  }
		},'json' 
      )}; 
        

$(function(){
	
	$('#dg').edatagrid({
		//url: "<?=site_url('purchase_req/cekdata_dg/')?>",
		saveUrl: "<?=site_url("purchase_req/save_dg/".$no_pr."")?>",
		updateUrl: "<?=site_url('purchase_req/save_dg')?>",
		destroyUrl: "<?=site_url('purchase_req/delete_dg')?>"
	});	
		

	$('#bgtnm').change(function(){
		$.getJSON('<?=site_url('purchase_req/datax')?>/'+$(this).val(),
			function(datax){	
				//alert("tes");
				$('#amountpr').val(numToCurr(datax.amount));
				$('#buddet').val(datax.description);
			});
		});
				
	
	
		$('#formAdd')
		.validationEngine()
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
	
	
</script>



<form method="post" id="formAdd" action="<?=site_url('purchase_req/insertpr')?>">	
<div class="easyui-tabs" style="width:900px;height:350px;">
	<div title="Budget Ref" style="padding:10px;">
			<input type="hidden" name="id_divisi" value="<?=$div?>"/>
			<input type="hidden" name="id_pt" value="<?=$pt?>"/>
		   <table>
			<tr>
				<td>Budget Name</td>
				<td colspan="3">
						<select name="bgtnm" id='bgtnm' style='width:150px' class="easyui-validatebox">
							<option></option>
							<?php foreach($budgetnm as $row):?>
								<option value="<?=$row->id_trbgt?>"><?=$row->form_kode?></option>
							<?php endforeach;?>
						</select>
				</td>
			</tr>
			<tr>
				<td>Tgl. PR</td>
				<td><input type="text" name="tglpr" id="tglpr" value="<?=gettgl();?>" class="validate[required]" readonly="true"/></td>
				<td>Amount</td>
				<td><input type="text" name="amountpr" id="amountpr" readonly="true" style="text-align:right"/></td>
			</tr>
			
			<tr>
				<td>No. PR</td>
				<td><input type="text" name="nopr" id="nopr" value="<?=$no_pr?>" style="width:200px" readonly="true"/></td>
				<td>User Requestor</td>
				<td><input type="text" name="reqpr" id="reqpr" value="<?=$nama ?>" readonly="true"/></td>
			</tr>
			
			<tr>
				<td>Divisi</td>
				<td><input type="text" name="divisipr" value="<?=$divisi_nm?>" id="divisipr" style="width:150px" readonly="true"/></td>
				<td>Budget Detail</td>
				<td><input type="text" name="buddet" id="buddet"  readonly="true" style="width:280px"/></td>
			</tr>
			
			
			
			<tr>
				<td>Keterangan</td>
				<td colspan= "3">
				<textarea name="ketpr" id="ketpr" class="xinput validate[required]" style="width:600px;height:60px" >
					</textarea>
	 
				</td>
			</tr>
			</table>		
	</div>
	<div title="Request PR" style="padding:10px;">
		<table id="dg" title="Input Barang" style="width:700px;height:250px"
				toolbar="#toolbar"
				rownumbers="true" fitColumns="true" singleSelect="true">
			<thead>	 		
				<tr>			
					<th field="nmbrg" width="50"   editor="{type:'validatebox',options:{required:true}}">Nama Barang</th>				
					<th field="satuan" width="50" class="easyui-combobox" editor="{type:'combobox',options:{valueField:'satuan',textField:'satuan',url:'<?=site_url('purchase_req/ceksatuan')?>',required:true}}">Satuan</th>
					<th field="qty" width="50"  editor="text">QTY</th>
					<th field="vendor" width="50" editor="text">Vendor Recomended</th>
				</tr>
			</thead>
		</table>
		<div id="toolbar">
			<a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="javascript:$('#dg').edatagrid('addRow')">Add</a>
			<a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="javascript:$('#dg').edatagrid('destroyRow')">Delete</a>
			<a href="#" class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="javascript:$('#dg').edatagrid('saveRow')">Save</a>
			<a href="#" class="easyui-linkbutton" iconCls="icon-undo" plain="true" onclick="javascript:$('#dg').edatagrid('cancelRow')">Cancel</a>
		</div>
	</div>	
</div>
	<input type="submit" name="save" value="Save"/>
	<input type="reset" name="cancel" value="Cancel"/>
</form>


