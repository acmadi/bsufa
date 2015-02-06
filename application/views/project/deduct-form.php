<?=link_tag(CSS_PATH.'easyui.css')?>
<?=link_tag(CSS_PATH.'menuform.css')?>
<?=link_tag(CSS_PATH.'icon.css')?>
<?=link_tag(CSS_PATH.'demo.css')?>
<?=script('jquery.easyui.min.js')?>
<?=script('datagrid-detailview.js')?>
<?=script('jquery.numeric.js')?>
<?=script('currency.js')?>
<?=script('jquery.validationEngine-enx.js')?>
<?=script('jquery.validationEnginex.js')?>
<?=script('jquery.formx.js')?>

<script type="text/javascript">
$(function(){
		var rep_coma = new RegExp(",", "g");

		$('.calculate').bind('keyup keypress',function(){
			
			$(this).val(numToCurr($(this).val()));
			
			var budget = parseInt($('#totdeduct').val().replace(rep_coma,""));
			

			var contrak = parseInt($('#totkon').val().replace(rep_coma,""));
			var claim = parseInt($('#claim').val().replace(rep_coma,""));
			var total = contrak-claim;
			
			
					if (budget > total) {
					
                              alert('Nilai Deduct lebih besar daripada Nilai Kontrak');
							  $('#totdeduct').val(0);
							}
			});	



$('#formAdd')
		.validationEngine()
		.ajaxForm({
			success:function(response){
				if(response=='sukses'){
					alert(response);
					refreshTable();
				}else{
					alert(response);
				}
			}
		});			   
	   
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

	//Dropdown Menu
function loadData(type,parentId){
	  $('#loading').text('Loading '+type.replace('_','/')+' data...');
      $.post('<?=site_url('deduct/dropdown')?>',
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
      );      
   }
   
loadData('project',0);
/*DropDown Menu*/
	$('#project').change(function(){
			loadData('addbgt',$('#project option:selected').val());
		});
</script>



<?php
$attr = array('class' => 'block-content form', 'id' => 'formAdd');
echo form_open(site_url('deduct/kurangkontrakapproved'), $attr);

?>



	<table>
		<input id="formAdd" type='hidden'name='idkon' id='idkon' value=<?=@$sql->id_kontrak?>>
		<tr>
			<td>No. Contract</td>
			<td>:</td>
			<td><input name='nokon' id='nokon' class='midreadonly'value='<?=@$sql->no_kontrak?>' readonly='true'></td>
			
		</tr>
		<tr>
			<td>Job</td>
			<td>:</td>
			<td><input name='job' id='job' class='longreadonly' value='<?=@$sql->job?>' readonly='true'></td>
			
		</tr>
		<tr>
			<td>Total Contract</td>
			<td>:</td>
			<td><input name='totkon' id='totkon' class='readonly' value='<?=number_format(@$sql->contract_amount)?>' readonly='true'></td>
			
		</tr>
		<tr>
			<td>Claim Amount</td>
			<td>:</td>
			<td><input name='claim' id='claim' class='readonly' value='<?=number_format(@$sql->bayar)?>' readonly='true'</td>
			
		</tr>
		
		<tr>
			<td>Total Deduct</td>
			<td>:</td>
			<td><input name='totdeduct' id='totdeduct' class="calculate input validate[required]" value='<?=number_format(@$sql->sisa)?>' ></td>
		<tr>
			<td>No. IOM</td>
			<td>:</td>
			<td><input name='noiom' id='noiom' class='midinput' required='required' value=<?=@$sql->iom_no?>></td>
		</tr>
		</table>
		<div class="easyui-tabs" style="width:900px;height:220px;">
	<!--Contractor -->
	<div title="Budget Alocation" style="padding:10px;">
		<table id="bgt" title="Deduct Budget" style="width:900px;height:170px"
				url="<?=site_url('tendereval/get_bgt')?>/<?=@$sql->id_kontrak?>"
				toolbar="#toolbar2" pagination="true"
				fitColumns="true" singleSelect="true">
			<thead>
				<tr>
					
					<th field="job" width="200px" >Description</th>				
					<th field="nilai_proposed" width="100px" align="center" editor="numberbox">Approved</th>				
					<th field="nilai_approved" width="100px" align="center" editor="numberbox">Deduct</th>				
					
				</tr>
			</thead>
		</table>
		
	</div>
	
	<!--Material-->
	
</div>		
Reason :<input type="text" name='reason' id='reason'required='required'>
<input type="submit" name="save" id="save" value="Approved"/>




<?=form_close()?>
