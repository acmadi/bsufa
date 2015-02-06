<?=link_tag(CSS_PATH.'easyui.css')?>
<?=link_tag(CSS_PATH.'icon.css')?>
<?=link_tag(CSS_PATH.'demo.css')?>
<?=script('jquery-1.7.2.min.js')?>
<?=script('jquery.easyui.min.js')?>
<?=script('datagrid-detailview.js')?>
<?=script('currency.js')?>	
<?=script('jquery.formx.js')?>


	<style type="text/css">
		form{
			margin:0;
			padding:0;
		}
		.dv-table td{
			border:0;
		}
		.dv-table input{
			border:1px solid #ccc;
		}
	</style>
	

	<script type="text/javascript">
		$(function(){			
			$('.calculate').bind('keyup keypress',function(){
				$(this).val(numToCurr($(this).val()));
			});

		
			//alert(TB_closeWindowButton());
			/*Contractor*/
			$('#dg').datagrid({
				view: detailview,
				detailFormatter:function(index,row){
					return '<div class="ddv"></div>';
				},
				onExpandRow: function(index,row){
					var ddv = $(this).datagrid('getRowDetail',index).find('div.ddv');
					var xref   = $('#mainjob_id').val();
					ddv.panel({
						border:false,
						cache:true,
						href:"<?=site_url('tendereval/show_form')?>/"+xref+"/?index="+index,
						onLoad:function(){
							$('#dg').datagrid('fixDetailRowHeight',index);
							$('#dg').datagrid('selectRow',index);
							$('#dg').datagrid('getRowDetail',index).find('form').form('load',row);
						}
					});
					$('#dg').datagrid('fixDetailRowHeight',index);
				}
			});

			/*Material*/
			$('#bgt').datagrid({
				view: detailview,
				detailFormatter:function(index,row){
					return '<div class="ddv"></div>';
				},
				onExpandRow: function(index,row){
					var ddv = $(this).datagrid('getRowDetail',index).find('div.ddv');
					//#var job	= $('#jobnm').val();
					//alert(job);
					var ref   = $('#jobnm').val();
					ddv.panel({
						border:false,
						cache:true,
						href:"<?=site_url('tenderval/showbgt_form')?>/"+ref+"/?index="+index,
						onLoad:function(){
							$('#bgt').datagrid('fixDetailRowHeight',index);
							$('#bgt').datagrid('selectRow',index);
							$('#bgt').datagrid('getRowDetail',index).find('form').form('load',row);
						}
					});
					$('#bgt').datagrid('fixDetailRowHeight',index);
				}
			});



			$(document).ready(function(){
				$("#txt_refbudget").hide();
			});			
			
			$("#refbudget").change(function(){
				var id = $(this).val();
				$("#refbudget").hide();
				$.getJSON('<?=site_url()?>/tendereval/getdata/' + id,
				function(response){
					//$('#nmbudget').val(response.nmbudget);
					$('#ambudget').val(numToCurr(response.amount));
					$('#mainjob_id').val(response.mainjob_id);
					$('#txt_refbudget').val(response.no_trbgtproj);
					$('#jobnm').val(response.mainjob_desc);
				});
				$("#txt_refbudget").show();
			});	
					
			
			
		});

		/*Contractor CRUD*/
		function saveItem(index){
			var row = $('#dg').datagrid('getRows')[index];
			var url = row.isNewRecord ? '<?=site_url('tendereval/save_dg')?>' : '<?=site_url('tendereval/save_dg')?>/'+row.id;
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
		
		function destroyItem(){
			var row = $('#dg').datagrid('getSelected');
			if (row){
				$.messager.confirm('Confirm','Are you sure you want to remove this Vendor?',function(r){
					if (r){
						var index = $('#dg').datagrid('getRowIndex',row);
						$.post('<?=site_url('tendereval/delete_dg')?>',{id:row.id},function(){
							$('#dg').datagrid('deleteRow',index);
						});
					}
				});
			}
		}
		function destroyItemMr(){
			var row = $('#bgt').datagrid('getSelected');
			if (row){
				$.messager.confirm('Confirm','Are you sure you want to remove this BQ?',function(r){
					if (r){
						var index = $('#bgt').datagrid('getRowIndex',row);
						$.post('<?=site_url('tendereval/delete_dg')?>',{id:row.id},function(){
							$('#bgt').datagrid('deleteRow',index);
						});
					}
				});
			}
		}
		
		function newItem(){
			$('#dg').datagrid('appendRow',{isNewRecord:true});
			var index = $('#dg').datagrid('getRows').length - 1;
			$('#dg').datagrid('expandRow', index);
			$('#dg').datagrid('selectRow', index);
		}
		/*End Contractor CRUD*/
		
		/*Item Crud*/
		function saveItemMr(index){
			var row = $('#bgt').datagrid('getRows')[index];
			var url = row.isNewRecord ? '<?=site_url('tendereval/save_mr')?>' : 'update_user.php?id='+row.id;
			$('#bgt').datagrid('getRowDetail',index).find('form').form('submit',{
				url: url,
				onSubmit: function(){
					return $(this).form('validate');
				},
				success: function(data){
					data = eval('('+data+')');
					data.isNewRecord = false;
					$('#bgt').datagrid('collapseRow',index);
					$('#bgt').datagrid('updateRow',{
						index: index,
						row: data
					});
				}
			});
		}
		
		function cancelItemMr(index){
			var row = $('#bgt').datagrid('getRows')[index];
			if (row.isNewRecord){
				$('#bgt').datagrid('deleteRow',index);
			} else {
				$('#bgt').datagrid('collapseRow',index);
			}
		}
		
		function newItemBgt(){
			$('#bgt').datagrid('appendRow',{isNewRecord:true});
			var index = $('#bgt').datagrid('getRows').length - 1;
			$('#bgt').datagrid('expandRow', index);
			$('#bgt').datagrid('selectRow', index);
		}		
		/*End Item Crud*/
		
		
	</script>


<?php
$attr = array('class' => 'block-content form', 'id' => 'formAdd');
echo form_open(site_url('tendereval/save'), $attr);
?>
<table border="0" width="750px">
	<tr>
		<input  type="hidden" id="mainjob_id" name="mainjob_id"/>
		<td>Date</td>
		<td colspan="3"><input type="text" name="tgl" value="<?=gettgl();?>" id="date" class="validate[required]" readonly="true" placeholder="" style="width:100px;background-color:#EFFC94"/></td>
	</tr>
	<tr>
		<td>Tender No.</td>
		<td colspan="3"><input type="text" name="no_ten" id="no_ten" style="width:220px;background-color:#EFFC94" value="<?=$no_tender?>" readonly="true"/></td>	
	</tr>
	<tr>
		<td>Budget.reff</td>
		<td colspan="3">
			<input type="text" name="txt_refbudget" id="txt_refbudget" style="width:200px;background-color:#EFFC94"  readonly="true"/>
			<select name="refbudget" id="refbudget" style="width:180px">
				<option value=""></option>
				<?php foreach($refbudget as $row): ?>
				<option value="<?=$row->mainjob_id?>"><?=$row->no_trbgtproj?></option>
				<?php endforeach ?>
			</select>		
		</td>
	</tr>
	<tr>	
		<td>Main job</td>
		<td colspan="3"><input type="text" name="jobnm" id="jobnm" style="width:200px;background-color:#EFFC94" readonly="true"/></td>	</tr>
	</tr>
	<tr>
		<td>Budget.Approved</td>	
		<td><input type="text" name="ambudget" id="ambudget" class="calculate input validate[required]" maxlength="20" readonly="true" style="width:150px;background-color:#EFFC94"/></td>	
		<td>Tender Winner</td>
		<td colspan="3">
			<select name="tendwin" id="tendwin" style="width:120">
					<option></option>
				<?php foreach($tendwin as $row):?>
					<option value="<?=$row->kd_supp_gb?>"><?=$row->nm_supplier?></option>
				<?php endforeach ?>
			</select>
		</td>
	</tr>
	
</table>


<div id="tt" class="easyui-tabs" style="width:900px;height:300px;">
	<!--Contractor -->
	<div title="Contractor" style="padding:10px;">	
		<table id="dg" title="Input Contractor" style="width:800px;height:250px"
				url="<?=site_url('tendereval/get_participant')?>"
				toolbar="#toolbar" pagination="true"
				fitColumns="true" singleSelect="true">
			<thead>
				<tr>
					<th field="contractor" width="50">Contractor</th>
					<th field="offering" width="50" editor="numberbox">Offering Price</th>
					<th field="nego" width="50" editor="numberbox">Final Nego</th>
					<th field="score" width="50" editor="numberbox">Score</th>
					<th field="remark" width="50">Remark</th>
				</tr>
			</thead>
		</table>
		<div id="toolbar">
			<a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newItem()">Add</a>
			<a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyItem()">Delete</a>
		</div>
	</div>
	
	<!--Material-->
	<div title="Budget" style="padding:10px;">
		<table id="bgt" title="Input Contractor" style="width:800px;height:250px"
				url="<?=site_url('tendereval/get_bgt')?>"
				toolbar="#toolbar2" pagination="true"
				fitColumns="true" singleSelect="true">
			<thead>
				<tr>
					<th field="job" width="100px" >Detail Job</th>				
					<th field="nilai_proposed" width="100px">Proposed Budget</th>				
					<th field="nilai_approved" width="100px">Approved Budget</th>				
					
				</tr>
			</thead>
		</table>
		<div id="toolbar2">
			<a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newItemBgt()">Add</a>
			<a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyItemBgt()">Delete</a>
		</div>		
	</div>
</div>	


<input type="submit" name="save" id="save" value="Save"/>
<input type="button" name="close" id="close" value="Close"/>
<?=form_close()?>
