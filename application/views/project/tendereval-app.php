<?=link_tag(CSS_PATH.'easyui.css')?>
<?=link_tag(CSS_PATH.'icon.css')?>
<?=link_tag(CSS_PATH.'demo.css')?>
<?#=script('jquery-1.7.2.min.js')?>
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
						href:"",
						onLoad:function(){
							$('#dg').datagrid('fixDetailRowHeight',index);
							$('#dg').datagrid('selectRow',index);
							$('#dg').datagrid('getRowDetail',index).find('form').form('load',row);
						}
					});
					$('#dg').datagrid('fixDetailRowHeight',index);
				}
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
		
		function newItem(){
			$('#dg').datagrid('appendRow',{isNewRecord:true});
			var index = $('#dg').datagrid('getRows').length - 1;
			$('#dg').datagrid('expandRow', index);
			$('#dg').datagrid('selectRow', index);
		}
		/*End Contractor CRUD*/
		
		
		
		
	</script>


<?php
$attr = array('class' => 'block-content form', 'id' => 'formAdd');
echo form_open(site_url('tendereval/save_app'), $attr);
?>
<table border="0" width="750px">
	<tr>
		<input type="hidden" id="mainjob_id" name="mainjob_id"/>
		<input type="hidden" id="idtender" name="idtender" value="<?=$data->id_tendeva?>"/>
		<td>Tender Date</td>
		<td><input type="text" name="tgl_ten" value="<?=indo_date($data->date_tendeva);?>" id="date"  readonly="true" placeholder="" style="width:100px;background-color:#EFFC94"/></td>
		<td>Approve Date</td>
		<td><input type="text" name="tgl_app" value="<?=gettgl();?>" id="date"  readonly="true" placeholder="" style="width:100px;background-color:#EFFC94"/></td>

	</tr>
	<tr>
		<td>Budget.reff</td>
		<td>
			<input type="text" name="refbudget" id="refbudget"  value="<?=$data->no_trbgtproj?>" style="width:220px;background-color:#EFFC94"  readonly="true"/>
		</td>
		<td>Tender No.</td>
		<td><input type="text" name="no_ten" id="no_ten" value="<?=$data->no_tendeva?>" style="width:220px;background-color:#EFFC94" value="<?=$no_tender?>" readonly="true"/></td>
	<tr>
		<td>Tender.Amount</td>	
		<td><input type="text" name="ambudget" id="ambudget" value="<?=number_format($data->nilai_tender)?>" class="calculate input validate[required]" maxlength="20" readonly="true" style="width:150px;background-color:#EFFC94"/></td>	
		<td>Job</td>
		<td><input type="text" name="jobnm" value="<?=$data->job?>" id="jobnm" style="width:200px;background-color:#EFFC94" readonly="true"/></td>	</tr>
	</tr>
	<tr>
		<td>Tender Winner</td>
		<td colspan="3"><input type="text" name="win" value="<?=$data->nm_supplier?>" readonly="true" style="width:200px;background-color:#EFFC94"/></td>
	</tr>	
</table>


<div class="easyui-tabs" style="width:900px;height:300px;">
	<!--Contractor -->
	<div title="Tender Participant" style="padding:10px;">	
		<table id="dg" title="Tender Participant" style="width:800px;height:250px"
				url="<?=site_url('tendereval/get_participant')?>/<?=$data->id_mainjob?>"
				toolbar="#toolbar" pagination="true"
				fitColumns="true" singleSelect="true">
			<thead>
				<tr>
					<th field="contractor" width="50">Contractor</th>
					<th field="offering" width="50" editor="numberbox" align="right">Offering Price</th>
					<th field="nego" width="50" editor="numberbox" align="right">Final Nego</th>
					<th field="score" width="50" editor="numberbox">Score</th>
					<th field="remark" width="50">Remark</th>
				</tr>
			</thead>
		</table>
	</div>
	
	
</div>	

<input type="submit" name="aksi" value="Approve"/>
<input type="submit" name="aksi" value="Unapprove"/>
<?=form_close()?>

