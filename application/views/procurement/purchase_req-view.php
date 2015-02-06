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

	$.fn.datebox.defaults.formatter = function(date) {
			var y = date.getFullYear();
			var m = date.getMonth() + 1;
			var d = date.getDate();
			return (d < 10 ? '0' + d : d) + '-' + (m < 10 ? '0' + m : m) + '-' + y;
		};	
		
		$('#tglpr').datebox({  
                                                required:true  
                                });
								
	$('.calculate').bind('keyup keypress',function(){
			var rep_coma = new RegExp(",", "g");
			$(this).val(numToCurr($(this).val()));			
			var amount = parseInt($('#amountpr').val().replace(rep_coma,""));
			});	
	
	$('#dg').edatagrid({
		//url: "<?=site_url('purchase_req/cekdata_dg/')?>",
		url: "<?=site_url("purchase_req/cekdata_dg/".$data->no_pr."")?>",
		saveUrl: "<?=site_url("purchase_req/save_dg/".$data->no_pr."")?>",
		updateUrl: "<?=site_url("purchase_req/update_dg/".$data->no_pr."")?>",
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
					<select  name="bgtnm" id="bgtnm" >
					<option value="<?=@$data->id_trbgt?>"><?=@$data->form_kode?></option>
					<?foreach($budgetnm as $row):?>
						<option value="<?=$row->id_trbgt?>"><?=$row->form_kode?></option>
					<?endforeach?>
					</select>
						<!--<select name="bgtnm" id='bgtnm' style='width:150px' class="easyui-validatebox">
							<option></option>
							<?php foreach($budgetnm as $row):?>
								<option value="<?=$row->id_trbgt?>"><?=$row->form_kode?></option>
							<?php endforeach;?>
						</select>-->
				</td>
			</tr>
			<tr>
				<td>Tgl. PR</td>
				<td><input type="text" name="tglpr" id="tglpr" value="<?=@$data->tgl_pr?>" class="validate[required]" /></td>
				<td>Amount</td>
				<td><input type="text" name="amountpr" id="amountpr" class="input calculate" value="<?=@$data->amount?>" style="text-align:right"/></td>
			</tr>
			
			<tr>
				<td>No. PR</td>
				<td><input type="text" name="nopr" id="nopr" value="<?=@$data->no_pr?>" style="width:200px" /></td>
				<td>User Requestor</td>
				<td><input type="text" name="reqpr" id="reqpr" value="<?=@$data->req_pr?>" style="width:200px" /></td>
			</tr>
			
			<tr>
				<td>Divisi</td>
				<td><input type="text" name="divisipr" value="<?=@$data->divisi_nm?>" id="divisipr" style="width:150px" /></td>
				<td>Budget Detail</td>
				<td><input type="text" name="buddet" id="buddet"  value="<?=@$data->description?>"  style="width:280px"/></td>
			</tr>
			
			
			
			<tr>
				<td>Keterangan</td>
				<td colspan= "3">
				<input type="text" name="ketpr" id="ketpr" value="<?=@$data->ket_pr?>"  style="width:600px;height:60px" >
					</textarea>
	 
				</td>
			</tr>
			</table>		
			<!-- GRID TABLE 
<div class="easyui-tabs" style="width:1000px;height:250px;">
	<div title="Request PR" style="padding:10px;">	
		<table id="dg" title="Edit Request PR" style="width:980px;height:200px"
				url="<?=site_url('purchase_req/cekdata_dg')?>/<?=$data->no_pr?>"
				toolbar="#toolbar" pagination="true"
				fitColumns="true" singleSelect="true">
			<thead>
				<tr>
					<th field="nmbrg" width="180px">Account No</th>
					<th field="satuan" width="180px">Account Name</th>
					<th field="qty" width="180px" >Description</th>							
					<th field="vendor" width="100px" editor="text">Debet</th>
					</tr>
			</thead>
		</table>
		<div id="toolbar">
			<a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newItem()">Add</a>
			<a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyItem()">Delete</a>
		</div>
	</div>	
</div>	-->
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


