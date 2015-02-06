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
			
			/*Budget*/
			$('#bgt').datagrid({
				view: detailview,
				detailFormatter:function(index,row){
					return '<div class="ddv"></div>';
				},
				onExpandRow: function(index,row){
					var ddv = $(this).datagrid('getRowDetail',index).find('div.ddv');
					//#var job	= $('#jobnm').val();
					//alert(job);
					//alert('tes');
					var ref   = $('#idtender').val();
					ddv.panel({
						border:false,
						cache:true,
						href:"<?=site_url('tendereval/showbgt_form')?>/"+ref+"/?index="+index,
						onLoad:function(){
							$('#bgt').datagrid('fixDetailRowHeight',index);
							$('#bgt').datagrid('selectRow',index);
							$('#bgt').datagrid('getRowDetail',index).find('form').form('load',row);
						}
					});
					$('#bgt').datagrid('fixDetailRowHeight',index);
				}
			});
			



		
			
			/*$("#refbudget").change(function(){
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
			});	*/
					
			
			
		});

		/*Contractor CRUD*/
		function saveItem(index){
			var row = $('#bgt').datagrid('getRows')[index];
			var url = row.isNewRecord ? '<?=site_url('tendereval/save_trbgt')?>' : '<?=site_url('tendereval/update_trbgt')?>/'+row.id;
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
		
		function cancelItem(index){
			var row = $('#bgt').datagrid('getRows')[index];
			if (row.isNewRecord){
				$('#bgt').datagrid('deleteRow',index);
			} else {
				$('#bgt').datagrid('collapseRow',index);
			}
		}
		
		function destroyItem(){
			var row = $('#bgt').datagrid('getSelected');
			if (row){
				$.messager.confirm('Confirm','Are you sure you want to remove this Vendor?',function(r){
					if (r){
						var index = $('#bgt').datagrid('getRowIndex',row);
						$.post('<?=site_url('tendereval/delete_dg')?>',{id:row.id},function(){
							$('#bgt').datagrid('deleteRow',index);
						});
					}
				});
			}
		}
		
		/*function newItemBgt(){
			$('#bgt').datagrid('appendRow',{isNewRecord:true});
			var index = $('#bgt').datagrid('getRows').length - 1;
			$('#bgt').datagrid('expandRow', index);
			$('#bgt').datagrid('selectRow', index);
		}*/
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
		<td>Tender Amount</td>
		<td colspan="2"><input type="text" name="tenamount" value="<?=number_format($data->nilai_tender)?>" id="tenamount" class="calculate input" style="width:200px;background-color:#EFFC94" readonly="true"/></td>	</tr>
	</tr>
	<tr>
		<td>Tender Winner</td>
		<td><input type="text" name="win" value="<?=$data->nm_supplier?>" readonly="true" style="width:200px;background-color:#EFFC94"/></td>
		<td>Job</td>
		<td><input type="text" name="jobnm" value="<?=$data->job?>" id="jobnm" style="width:200px;background-color:#EFFC94" readonly="true"/></td>	</tr>
	</tr>	
</table>


<div class="easyui-tabs" style="width:900px;height:250px;">
	<!--Contractor -->
	<div title="Budget" style="padding:10px;">
		<table id="bgt" title="Input Alokasi Tender Budget" style="width:800px;height:200px"
				url="<?=site_url('tendereval/get_bgt')?>/<?=$data->id_tendeva;?>"
				toolbar="#toolbar2" pagination="true"
				fitColumns="true" singleSelect="true">
			<thead>
				<tr>
					
					<th field="job" width="200px" >Detail Job</th>				
					<th field="nilai_proposed" width="100px" align="right" editor="numberbox">Proposed Budget</th>				
					<th field="nilai_approved" width="100px" align="right" >Tender Amount</th>				
					
				</tr>
			</thead>
		</table>
		
	</div>
	
	<!--Material-->
	
</div>	


<input type="submit" name="aksi" id="save" value="Save"/>
<input type="button" name="aksi" id="close" value="Close"/>
<?=form_close()?>


