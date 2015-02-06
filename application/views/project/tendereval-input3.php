<?=link_tag(CSS_PATH.'easyui.css')?>
<?=link_tag(CSS_PATH.'icon.css')?>
<?=link_tag(CSS_PATH.'demo.css')?>
<?=script('jquery-1.7.2.min.js')?>
<?=script('jquery.easyui.min.js')?>
<?=script('jquery.edatagrid.js')?>


<script type="text/javascript">	
$(function(){
	$('#dg').edatagrid({
		url: "<?=site_url('adjustment/cekdata')?>",
		saveUrl: "<?=site_url('adjustment/save')?>",
		updateUrl: "<?=site_url('adjustment/save')?>",
		destroyUrl: "<?=site_url('adjustment/delete')?>"
	});
	
	$('#material').edatagrid({
		url: "<?=site_url('tendereval/cekdata')?>",
		saveUrl: "<?=site_url('tendereval/save')?>",
		updateUrl: "<?=site_url('tendereval/save')?>",
		destroyUrl: "<?=site_url('tendereval/delete')?>"
	});	
	
		$("#xrefbudget").change(function(){
			var id = $(this).val();
			$.getJSON('<?=site_url()?>/tendereval/getdata/' + id,
			function(response){
				$('#nmbudget').val(response.nmbudget);
				$('#ambudget').val(numToCurr(response.amount));
				$('#id_trbgtproj').val(response.id_trbgtproj);
			});
		});	
	
});
			
</script>

<table border="0">
	<tr>
		<input type="hidden" id="id_trbgtproj" name="id_trbgtproj"/>
		<td>Date</td>
		<td><input type="text" name="tgl" value="<?=gettgl();?>" id="date" class="validate[required]" readonly="true" placeholder=""/></td>
	</tr>
	<tr>
		<td>Budget.reff</td>
		<td>
			<select name="xrefbudget" id="xrefbudget">
				<option value=""></option>
				<?php foreach($refbudget as $row): ?>
				<option value="<?=$row->id_trbgtproj?>"><?=$row->no_trbgtproj?></option>
				<?php endforeach ?>
			</select>		
		</td>
	</tr>
	<tr>	
		<td>Budget.nm</td>
		<td><input type="text" name="nmbudget" id="nmbudget" class="validate[required]"/></td>
	</tr>
	<tr>
		<td>Budget.Amount</td>	
		<td><input type="text" name="ambudget" id="ambudget" class="calculate input validate[required]" maxlength="20" readonly="true"/></td>	
	</tr>
</table>
	
<div class="easyui-tabs" style="width:900px;height:300px;">
	<div title="Contractor" style="padding:10px;">
		<!-- Grid Data Participant -->
		<table id="dg" title="Input Contractor" style="width:800px;height:250px"
				toolbar="#toolbar1" pagination="true"
				rownumbers="true" fitColumns="true" singleSelect="true">
			<thead>
				<tr>
					<th field="contractor" width="25" id='contractor' editor="{type:'combobox',options:{valueField:'vendor_id',textField:'vendor_nm',url:'<?=site_url('tendereval/get_datavendor')?>',required:true}}">Contractor</th>
					<th field="offering"  width="30" align="right" editor="{type:'numberbox',options:{precision:2}}">Offering Price</th>
					<th field="nego" width="30" editor="text">Final Nego</th>
					<th field="score" width="30" editor="text">Score</th>
					<th field="remark" width="60" editor="text">Remark</th>
				</tr>
			</thead>
		</table>
		<div id="toolbar1">
			<a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="javascript:$('#dg').edatagrid('addRow')">New</a>
			<a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="javascript:$('#dg').edatagrid('destroyRow')">Delete</a>
			<a href="#" class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="javascript:$('#dg').edatagrid('saveRow')">Save</a>
			<a href="#" class="easyui-linkbutton" iconCls="icon-undo" plain="true" onclick="javascript:$('#dg').edatagrid('cancelRow')">Cancel</a>
		</div>
		<!-- End Data Participant-->
	</div>
	
	<div title="Material" style="padding:10px;">
		<!-- Grid Data Material -->
			<table id="material" title="Item Material" style="width:800px;height:250px"
			toolbar="#toolbar2" pagination="true"
			rownumbers="true" fitColumns="true" singleSelect="true">
			<thead>
				<tr>
					<th field="product" width="25" id='acc_no' editor="{type:'validatebox',options:{required:true}}">Contractor</th>
					<th field="qty" width="50" editor="{type:'validatebox',options:{required:true}}">Trx Type</th>
					<th field="unit" width="50" editor="text">Descs</th>
					<th field="price" width="50" editor="text">Mode</th>
				</tr>
			</thead>
		</table>
		<div id="toolbar2">
			<a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="javascript:$('#material').edatagrid('addRow')">New</a>
			<a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="javascript:$('#material').edatagrid('destroyRow')">Delete</a>
			<a href="#" class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="javascript:$('#material').edatagrid('saveRow')">Save</a>
			<a href="#" class="easyui-linkbutton" iconCls="icon-undo" plain="true" onclick="javascript:$('#material').edatagrid('cancelRow')">Cancel</a>
		</div>
    </div>	
    <!-- End Data Material-->
</div>










		
	
