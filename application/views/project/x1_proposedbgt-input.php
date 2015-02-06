<?#=link_tag(CSS_PATH.'x-forminput.css')?>
<?=script('currency.js')?>
<?=script('jquery-1.7.2.min.js')?>
<?=script('jquery.easyui.min.js')?>
<?=script('datagrid-detailview.js')?>
<?=link_tag(CSS_PATH.'easyui.css')?>
<?=link_tag(CSS_PATH.'icon.css')?>
<?=link_tag(CSS_PATH.'demo.css')?>



<script type="text/javascript">

	$(".calculate").bind('keyup keypress',function(){
		$(this).val(numToCurr($(this).val()));
	});

function loadData(type,parentId){
	  // berikan kondisi sedang loading data ketika proses pengambilan data
	  $('#loading').text('Loading '+type.replace('_','/')+' data...');
      $.post('<?=site_url('updateprojbgt/loaddata')?>', //request ke fungsi load data di inputAP
		{data_type: type, parent_id: parentId},
		function(data){
		  if(data.error == undefined){ // jika respon error tidak terdefinisi maka pengambilan data sukses 
			 $('#'+type).empty(); // kosongkan dahulu combobox yang ingin diisi datanya
			 $('#'+type).append('<option></option>'); // buat pilihan awal pada combobox
			 for(var x=0;x<data.length;x++){
				// berikut adalah cara singkat untuk menambahkan element option pada tag <select>
			 	$('#'+type).append($('<option></option>').val(data[x].id).text(data[x].nama));
			 }
			 $('#loading').text(''); // hilangkan text loading
		  }else{
			 alert(data.error); // jika ada respon error tampilkan alert
			 //$('#combobox_customer').text('');
		  }
		},'json' // format respon yang diterima langsung di convert menjadi JSON 
      );      
   }
   
   
 
 
 


$(function(){

			
			
			
			$(document).ready(function(){
					$('#tr1').hide();
					$('#tr2').hide();
					$('#tr3').hide();
					$('#tr4').hide();
					$('#tr5').hide();
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
			
			
			
				loadData('project_id',0);
				$('#project_id').change(function(){
					loadData('cost',$('#project_id option:selected').val());
						});	
							
				$('#cost').change(function(){
					loadData('subcost',$('#cost option:selected').val());
						});	
			
			$('#subcost').change(function(){
				var project_id = $('#project_id option:selected').val()
				var cost = $('#cost option:selected').val()
				var subcost = $('#subcost option:selected').val()
					$.post('<?=site_url('proposedbgt/tampildata')?>',
							{'project':project_id,'cost':cost,'subcost':subcost},
								function(data){
									if(data.error == undefined){
										$('#bgt').empty(); // kosongkan dahulu combobox yang ingin diisi datanya
										$('#bgt').append('<option></option>'); // buat pilihan awal pada combobox
											//alert(data.length);
											for(var x=0;x<data.length;x++){
											// berikut adalah cara singkat untuk menambahkan element option pada tag <select>
										$('#bgt').append($('<option></option>').val(data[x].id).text(data[x].nama));
											}}
											else{
												alert(data.error); // jika ada respon error tampilkan alert
													}				
								},'json');
			});
			
			$('#bgt').change(function(){
				var proj  = $('#project_id option:selected').val();
				var cost  = $('#cost option:selected').val();
				var subcost = $('#subcost option:selected').val();
				$.getJSON('<?=site_url('proposedbgt/cekdata')?>/' + $(this).val() + '/' + proj + '/' 
				+ cost + '/' + subcost,
					function(response){
						$('#totbgt').val(response.totbgt);
						$('#actual').val(response.actual);
						$('#blc').val(response.blc);
						$('#allbgt').val(response.allbgt);
						$('#allactual').val(response.allactual);
						$('#allblc').val(response.allblc);
						$('#desc').val(response.desc);
						$('#ket').val(response.ket);
					})
			})
			
			$('#bg').datagrid({
				view: detailview,
				detailFormatter:function(index,row){
					return '<div class="ddv"></div>';},
						onExpandRow: function(index,row){
							var ddv = $(this).datagrid('getRowDetail',index).find('div.ddv');
							var idpo   = $('#idpo').val();
							ddv.panel({
								border:false,
								cache:true,
									href:"<?=site_url('proposedbgt/show_proproj')?>/"+idpo+"/?index="+index,
										onLoad:function(){
											$('#bg').datagrid('fixDetailRowHeight',index);
											$('#bg').datagrid('selectRow',index);
											$('#bg').datagrid('getRowDetail',index).find('form').form('load',row);
										}
							});
					$('#bg').datagrid('fixDetailRowHeight',index);
				}
			});			
			
			
			
});
  
		function destroyItem(){
			var row = $('#bg').datagrid('getSelected');
			if (row){
				$.messager.confirm('Confirm','Are you sure you want to remove this Vendor?',function(r){
					if (r){
						var index = $('#bg').datagrid('getRowIndex',row);
						$.post('<?=site_url('tendereval/delete_dg')?>',{id:row.id},function(){
							$('#bg').datagrid('deleteRow',index);
						});
					}
				});
			}
		}
		

	function newItem(){
			$('#bg').datagrid('appendRow',{isNewRecord:true});
			var index = $('#bg').datagrid('getRows').length - 1;
			$('#bg').datagrid('expandRow', index);
			$('#bg').datagrid('selectRow', index);
	} 
  
</script>
<?php
$attr = array('class' => 'block-content form', 'id' => 'formAdd','target','_blank');
echo form_open(site_url('project/slip_bgtproj/cekpdf'), $attr);
?>

<font color='red' size='4'>Proposed Budget<hr width="150px" align="left"></font></h2>
	<input type="hidden" name="desc" id="desc"/>
	   <?php $tgl = date('d-m-Y'); ?>
  <table>
       <tr>
			<td>Job to Many Budget</td>
			<td><input type="radio" name="pilih" id="pilih" value ="1">&nbsp;&nbsp;&nbsp;Job to Single Budget
			&nbsp;<input type="radio" name="pilih" id="pilih" value ="2"></td>
	</tr>
       
      <tr>
			<td for="date">Proposed Date</td>
			<td><input type="text" name="tgl" style="width:100px" value="<?=$tgl?>" id="tgl" readonly="true" style="width:150px"/></td>  
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
			<td><input type="text" name="amount" id="amount" class="calculate input validate[required]" maxlength="20"/></td>
		</tr>
	   <tr id="tr5" > 
			<td>Budget Type</td>
			<td><input type="text" name="ket" id="ket" style="background-color:#EFFC94" readonly="true"></td>
			<td>Remark</td>
			<td><textarea name="remark" id="remark"></textarea></td>
		</tr>
		
		<tr id="tr6" > 
			<td>Main Job</td>
			<td colspan="3"><input type="text" name="job" id="job"  style="width:300px"></td>
		</tr>
   </table>
<div style="width:900px;padding:20px 0 0 0" id="tr9">
		<table id="bg" title="Add Detail Job" style="width:1100px;height:250px"
				url="<?=site_url('proposedbgt/get_dg')?>"
				toolbar="#toolbar" pagination="true"
				fitColumns="true" singleSelect="true">
			<thead>	 		
				<tr>			
					<th field="jobdet" width="100px"  >Detail Job</th>				
					<th field="proj" width="130px" >Project</th>				
					<th field="Budget" width="120px">Desc.BGT</th>
					<th field="out_po" width="80px"  editor="text">Tot.BGT</th>
					<th field="satuan" width="80px" editor="text">Tot.Props</th>
					<th field="masuk" width="110px" editor="text">Blc.Props</th>
					<th field="masuk" width="80px" editor="text">Amount.Props</th>
				</tr>
			</thead>
	<tr>	
		<div id="toolbar">
			<a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newItem()">Add</a>
			<a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyItem()">Delete</a>
		</div>
	</tr>
	</table>
</div>


<table>
<tr id="tr7">
			<td colspan="3"><input type="submit" name="save" value="Proposed" /> <input type="reset" name="reset" value="Cancel" /></td>
		  </tr>
</table>   
<?=form_close()?>
