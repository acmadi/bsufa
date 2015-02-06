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
			background-color:#80FFFF;
		}
	</style>
	

	<script type="text/javascript">
		$(function(){			
			
			
			//MUlai Document
			//var f=jQuery.noConflict();  
  
//f(document).ready(function(){  

			$(document).ready(function(){
					$('#tr1').hide();
					$('#tr2').hide();
					$('#tr3').hide();
					$('#tr4').hide();
					$('#tr5').hide();
			});					

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
					var xref   = $("#no_prop").val();
					ddv.panel({
						border:false,
						cache:true,
						href:"<?=site_url('proposedbgt/show_form')?>/"+xref+"/?index="+index,
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
			$('#mr').datagrid({
				view: detailview,
				detailFormatter:function(index,row){
					return '<div class="ddv"></div>';
				},
				onExpandRow: function(index,row){
					var ddv = $(this).datagrid('getRowDetail',index).find('div.ddv');
					var noprop   = $("#no_prop").val();
					ddv.panel({
						border:false,
						cache:true,
						href:"<?=site_url('proposedbgt/showmr_form')?>/"+noprop+"/?index="+index,
						onLoad:function(){
							$('#mr').datagrid('fixDetailRowHeight',index);
							$('#mr').datagrid('selectRow',index);
							$('#mr').datagrid('getRowDetail',index).find('form').form('load',row);
						}
					});
					$('#mr').datagrid('fixDetailRowHeight',index);
				}
			});
	
			/*
			$('#mr').datagrid({
				view: detailview,
				detailFormatter:function(index,row){
					return '<div class="ddv"></div>';
				},
				onExpandRow: function(index,row){
					var ddv = $(this).datagrid('getRowDetail',index).find('div.ddv');
					
					ddv.panel({
						border:false,
						cache:true,
						href:"<?=site_url('proposedbgt/showmr_form')?>"+"/?index="+index,
						onLoad:function(){
							$('#mr').datagrid('fixDetailRowHeight',index);
							$('#mr').datagrid('selectRow',index);
							$('#mr').datagrid('getRowDetail',index).find('form').form('load',row);
						}
					});
					$('#mr').datagrid('fixDetailRowHeight',index);
				}
			}); */


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
			//alert("test");
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
		
		
		
		function newItem(){
			
			$('#dg').datagrid('appendRow',{isNewRecord:true});
			var index = $('#dg').datagrid('getRows').length - 1;
			$('#dg').datagrid('expandRow', index);
			$('#dg').datagrid('selectRow', index);
		}
		/*End Contractor CRUD*/
		
	/*Item Crud*/
		function saveItemMr(index){
			//alert("test");
			//var noprop = $('#no_prop').val();
			
			var row = $('#mr').datagrid('getRows')[index];
			var url = row.isNewRecord ? '<?=site_url('proposedbgt/savemr_bq')?>' : '<?=site_url('proposedbgt/savemr_bq')?>/'+row.id;
			$('#mr').datagrid('getRowDetail',index).find('form').form('submit',{
				url: url,
				onSubmit: function(){
					return $(this).form('validate');
				},
				success: function(data){
					data = eval('('+data+')');
					data.isNewRecord = false;
					$('#mr').datagrid('collapseRow',index);
					$('#mr').datagrid('updateRow',{
						index: index,
						row: data
					});
				}
			});
		}

/*
		function saveItemMr(index){
			//alert('tes');
			var row = $('#mr').datagrid('getRows')[index];
			var url = row.isNewRecord ? '<?=site_url('proposedbgt/save_bq')?>' : '<?=site_url('proposedbgt/save_bq')?>/'+row.id;
			$('#mr').datagrid('getRowDetail',index).find('form').form('submit',{
				url: url,
				onSubmit: function(){
					return $(this).form('validate');
				},
				success: function(data){
					data = eval('('+data+')');
					data.isNewRecord = false;
					$('#mr').datagrid('collapseRow',index);
					$('#mr').datagrid('updateRow',{
						index: index,
						row: data
					});
				}
			});
		}
	*/	
		function cancelItemMr(index){
			var row = $('#mr').datagrid('getRows')[index];
			if (row.isNewRecord){
				$('#mr').datagrid('deleteRow',index);
			} else {
				$('#mr').datagrid('collapseRow',index);
			}
		}
		
		function newItemMr(){
			$('#mr').datagrid('appendRow',{isNewRecord:true});
			var index = $('#mr').datagrid('getRows').length - 1;
			$('#mr').datagrid('expandRow', index);
			$('#mr').datagrid('selectRow', index);
		}		
		/*End Item Crud*/
		/*$('#formAdd')
		//.validationEngine()
		.ajaxForm({
			success:function(response){
				if(response=='sukses'){
					alert(response);
					refreshTable();
				}else{
					alert(response);
				}
			}
		});*/	
	</script>

<?php
$attr = array('class' => 'block-content form', 'id' => 'formAdd');
echo form_open(site_url('proposedbgt/cekpdf'), $attr);
?>

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
			<td><input type="text" name="tgl" style="width:120px;background-color:#80FFFF" value="<?=$tgl?>" id="tgl" readonly="true" /></td>  
			
			<td><input type="hidden" name="nonkontrak" id="nonkontrak" value="0"></td><input type="checkbox" name="nonkontrak" id="nonkontrak" value="1">Non Contract<br></td>  
	</tr>
	<tr>
			<td>No.Proposed</td>
			<td><input type="text" name="no_prop" id="no_prop"  value="<?=$nobgt?>" style="width:210px;background-color:#80FFFF" readonly="true"/></td>
	</tr>
	<tr id="tr1">
			<td>Project Name</td>
			<td><select name="project_id" id="project_id" style="width:150px"></select></td>
			<td>Total Budget</td>
			<td><input type="text" name="totbgt" id="totbgt" class="input" style="background-color:#80FFFF" readonly="true"/></td>
		</tr>         
		<tr id="tr2">
			<td>Structure Cost</td>
			<td><select name="cost" id="cost" style="width:150px"></select></td>
			<td>Actual Budget</td>
			<td><input type="text" name="actual" id="actual" class="input" style="background-color:#80FFFF" readonly="true"/></td>
		</tr>		
		<tr id="tr3">
			<td>Sub Structure</td>
			<td><select name="subcost" id="subcost" style="width:150px"></select></td>
			<td>Balanced Budget</td>
			<td><input type="text" name="blc" id="blc" class="input" style="background-color:#80FFFF" readonly="true"/></td>
		</tr>
	   <tr id="tr4"> 
			<td>Budget Name</td>
			<td><select name="bgt" id="bgt" style="width:150px"></select></td>
			<td>Proposed. Amount</td>
			<td><input type="text" name="amount" id="amount" class="calculate input validate[required]" maxlength="20"/></td>
		</tr>
	   <tr id="tr5" > 
			<td>Budget Type</td>
			<td><input type="text" name="ket" id="ket" style="background-color:#80FFFF" readonly="true"></td>
			<td>Remark</td>
			<td><textarea name="remark" id="remark"></textarea></td>
		</tr>
		
		<tr id="tr6" > 
			<td>Main Job</td>
			<td colspan="3"><input type="text" name="job" id="job" class="easyui-validatebox" required="true" style="width:300px"></td>
		</tr>
   </table>

<!-- GRID TABLE -->
<div class="easyui-tabs" style="width:1200px;height:275px;">
	
	<div title="Allocation Budget" style="padding:10px;">	
		<table id="dg" title="Add Budget" style="width:1000px;height:225px"
				url="<?=site_url('proposedbgt/get_dg')?>/x"
				toolbar="#toolbar" pagination="true"
				fitColumns="true" singleSelect="true">
			<thead>
				<tr>
<!--
					<th field="jobdet" width="140px"  >Detail Job</th>				
-->
					<th field="proj_id" width="120px">Project</th>
					<th field="cost" width="100px">Structure</th>				
					
					<th field="codebgt" width="100px">Description</th>
					<th field="totalbgt" width="110px"  editor="text" >Budget</th>
					<th field="totalprop" width="110px" editor="text" >Actual</th>
					<th field="xblc" width="110px" editor="text" >Balanced</th>
					<th field="amount" width="110px" editor="text" >Amount</th>
					
				</tr>
			</thead>
		</table>
		<div id="toolbar">
			<a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newItem()">Add</a>
			<a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyItem()">Delete</a>
		</div>
	</div>	
	<!--Material-->
<!--
	<div title="BQ" style="padding:10px;">
		<table id="mr" title="Input BQ" style="width:750px;height:250px"
				url="<?#=site_url('proposedbgt/get_mr')?>"
				toolbar="#toolbar2" pagination="true"
				fitColumns="true" singleSelect="true">
			<thead>
				<tr>
					
					<th field="product" width="70">Product</th>
					<th field="qty" width="25" editor="numberbox">QTY</th>
					<th field="unit" width="30">Unit</th>
					<th field="price" width="50" editor="numberbox" >Price</th>
					<th field="total" width="50" editor="numberbox" >Total Price</th>
				</tr>
			</thead>
		</table>
		<div id="toolbar2">
			<a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newItemMr()">Add</a>
			<a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyItemMr()">Delete</a>
		</div>		
	</div>
-->
	
</div>	
<input type="submit" name="aksi" id="aksi" value="Proposed"/>
<input type="button" name="close" id="close" value="Close"/>
<?=form_close()?>
<!--End Detail TABLE-->


