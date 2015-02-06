<?=link_tag(CSS_PATH.'easyui.css')?>
<?=link_tag(CSS_PATH.'icon.css')?>
<?=link_tag(CSS_PATH.'demo.css')?>

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
			
			//var f=jQuery.noConflict();  
  
			//MUlai Document

			$(document).ready(function(){
					$('#tr1').hide();
					$('#tr2').hide();
					$('#tr3').hide();
					$('#tr4').hide();
					$('#tr5').hide();
			});					

			$('.calculate').bind('keyup keypress',function(){
				$(this).val(numToCurr(f(this).val()));
			});

			
			
			/*Contractor*/
			$('#dg').datagrid({
				view: detailview,
				detailFormatter:function(index,row){
					return '<div class="ddv"></div>';
				},
				onExpandRow: function(index,row){
					var ddv = $(this).datagrid('getRowDetail',index).find('div.ddv');
					var xref   = $("#no_prop").val();
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


			//Pengecekan Ketika di Save
			$("#aksi").click(function(){
				//setTimeout("location.reload(true);",100);
				refreshTable();
			});

			$('input:radio').change(function(){
					if($('input:radio[name=pilih]:checked').val() == '1' ){
											//alert('tes');
											$('#tr1').hide();
										$('#tr2').hide();
										$('#tr3').hide();
										$('#tr4').hide();
										$('#tr5').hide();
										
										
										$('#tr6').show();
										
										
										$('#tr8').show();
										$('#tr9').show();
											
								}  
									else{
                                        
										$('#tr1').show();
										$('#tr2').show();
										$('#tr3').show();
										$('#tr4').show();
										$('#tr5').show();
											
											
										$('#tr6').hide();
											
										$('#tr8').hide();
										$('#tr9').hide();
                                   }
			});

			
		});

		/*Contractor CRUD*/
		function saveItem(index){
			var row = $('#dg').datagrid('getRows')[index];
			var url = row.isNewRecord ? '<?=site_url('proposedbgt/save_dg')?>' : '<?=site_url('proposed/save_dg')?>/'+row.id;
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
			var index = f('#dg').datagrid('getRows').length - 1;
			$('#dg').datagrid('expandRow', index);
			$('#dg').datagrid('selectRow', index);
		}
		/*End Contractor CRUD*/
		

		
	</script>

<?php
$attr = array('class' => 'block-content form', 'id' => 'formAdd','target','_blank');
echo form_open(site_url('proposedbgt/save_approve'), $attr);
?>
<input type="hidden" name="idmain" value="<?=$data->mainjob_id?>"/>
<font color='red' size='4'>Proposed Budget<hr width="150px" align="left"></font></h2>
	<input type="hidden" name="desc" id="desc"/>
	   <?php $tgl = date('d-m-Y'); ?>
  <table>
       <!--tr>
			<td>Job to Many Budget</td>
			<td><input type="radio" name="pilih" id="pilih" value ="1">&nbsp;&nbsp;&nbsp;Job to Single Budget
			&nbsp;<input type="radio" name="pilih" id="pilih" value ="2"></td>
	</tr-->
       
     <tr>
			<td for="date">Proposed Date</td>
			<td><input type="text" name="tgl_prop" style="width:100px;background-color:#EFFC94" value="<?=indo_date($data->mainjob_date)?>" id="tgl" readonly="true" style="width:150px"/></td>  
	</tr>
     <tr>
			<td for="date">Approved Date</td>
			<td><input type="text" name="tgl_app" style="width:100px;background-color:#EFFC94" value="<?=$tgl?>" id="tgl" readonly="true" style="width:150px"/></td>  
	</tr>	
	<tr>
			<td>No.Proposed</td>
			<td><input type="text" name="no_prop" id="no_prop"  value="<?=$data->no_trbgtproj?>" style="width:210px;background-color:#EFFC94" readonly="true"/></td>
	</tr>
	<tr id="tr1">
			<td>Project Name</td>
			<td><select name="project_id" id="project_id" style="width:150px"></select></td>
			<td>Total Budget</td>
			<td><input type="text" name="totbgt" id="totbgt" class="input" style="background-color:#EFFC94" readonly="true"/></td>
		</tr>         
		<tr id="tr2">
			<td>Structure Cost</td>
			<td><select name="cost" id="cost" style="width:150px"></select></td>
			<td>Actual Budget</td>
			<td><input type="text" name="actual" id="actual" class="input" style="background-color:#EFFC94" readonly="true"/></td>
		</tr>		
		<tr id="tr3">
			<td>Sub Structure</td>
			<td><select name="subcost" id="subcost" style="width:150px"></select></td>
			<td>Balanced Budget</td>
			<td><input type="text" name="blc" id="blc" class="input" style="background-color:#EFFC94" readonly="true"/></td>
		</tr>
	   <tr id="tr4"> 
			<td>Budget Name</td>
			<td><select name="bgt" id="bgt" style="width:150px"></select></td>
			<td>Proposed. Amount</td>
			<td><input type="text" name="amount" id="amount" class="calculate" maxlength="20"/></td>
		</tr>
	   <tr id="tr5" > 
			<td>Budget Type</td>
			<td><input type="text" name="ket" id="ket" style="background-color:#EFFC94" readonly="true"></td>
			<td>Remark</td>
			<td><textarea name="remark" id="remark"></textarea></td>
		</tr>
		
		<tr id="tr6" > 
			<td>Main Job</td>
			<td colspan="3"><input type="text" name="job" id="job" value="<?=$data->mainjob_desc?>" style="width:300px;background-color:#EFFC94" readonly="true" ></td>
		</tr>
		
   </table>

<!-- GRID TABLE -->
<div class="easyui-tabs" style="width:900px;height:300px;">
	<!--Contractor -->
	<div title="Add Detail Job" style="padding:10px;">	
		<table id="dg" title="List Detail Job" style="width:800px;height:250px"
				url="<?=site_url('proposedbgt/get_dg')?>/<?=$data->mainjob_id?>"
				toolbar="#toolbar" pagination="true"
				fitColumns="true" singleSelect="true">
			<thead>
				<tr>
					<th field="jobdet" width="100px"  >Detail Job</th>				
					<th field="proj_id" width="130px" >Project</th>				
					<th field="codebgt" width="120px">Desc.BGT</th>
					<th field="totalbgt" width="80px"  editor="text" align="right">Tot.BGT</th>
					<th field="totalprop" width="80px" editor="text" align="right">Tot.Props</th>
					<th field="xblc" width="110px" editor="text" align="right">Blc.Props</th>
					<th field="amount" width="80px" editor="text" align="right">Amount.Props</th>
				</tr>
			</thead>
		</table>
		<!--div id="toolbar">
			<a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newItem()">Add</a>
			<a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyItem()">Delete</a>
		</div-->
	</div>	
</div>
Remark	
<input type="text" name="ketprop" id="ketprop" required="true" >
<input type="submit" name="aksi" id="aksi" value="Approved"/>
<input type="submit" name="aksi" id="close" value="Unapproved"/>
<?=form_close()?>
<!--End Detail TABLE-->


