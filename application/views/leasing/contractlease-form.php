<script language="javascript" src="<?=base_url()?>assets/js/calendar.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/calendar2.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.form.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.validationEngine-enx.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.validationEnginex.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.numeric.js"></script>
<link rel="stylesheet" href="<?=base_url()?>assets/css/calendar.css" type="text/css" />
<?=script('currency.js')?>
<?=script('jquery.validationEngine-enx.js')?>
<?=script('jquery.validationEnginex.js')?>
<?=script('jquery.formx.js')?>
<?#=script('jquery-1.7.2.min.js')?>
<?=link_tag(CSS_PATH.'easyui.css')?>
<?=link_tag(CSS_PATH.'icon.css')?>
<?=link_tag(CSS_PATH.'demo.css')?>
<?=script('jquery.easyui.min.js')?>
<?#=link_tag(CSS_PATH.'menuform.css')?>
<link rel="stylesheet" href="<?=base_url()?>assets/css/menuku.css" type="text/css" />
<?=script('datagrid-detailview.js')?>

<? #tampilkan query?>
<script language="javascript">
function newItem(){
			
			$('#dg').datagrid('appendRow',{isNewRecord:true});
			var index = $('#dg').datagrid('getRows').length - 1;
			$('#dg').datagrid('expandRow', index);
			$('#dg').datagrid('selectRow', index);
		}
		
function saveItem(index){
			//~ alert("test");
			var row = $('#dg').datagrid('getRows')[index];
			var url = row.isNewRecord ? '<?=site_url('contractlease/saveitem')?>' : '<?=site_url('contractlease/saveitem')?>/'+row.id;
			
			//$('#totald').refresh;
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
		



$(function(){
$(document).ready(function(){
                        //~ $('#tr1').hide();
                        //~ $('#tr2').hide();
                        //~ $('#tr3').hide();
                        //~ $('#tr4').hide();
                        //~ $('#tr5').hide();
                        //~ $('#tr6').hide();
                        //~ $('#tr7').hide();
                        //~ $('#tr8').hide();
                        //~ $('#tr9').hide();
                        //~ $('#tr10').hide();
                        //~ $('#tr11').hide();
                        //~ $('#tr12').hide();
                        //~ $('#tr13').hide();
                        //~ $('#tr14').hide();
                        
            });
            
            
      $('#dg').datagrid({
				view: detailview,
				detailFormatter:function(index,row){
					return '<div class="ddv"></div>';
				},
				onExpandRow: function(index,row){
					var ddv = $(this).datagrid('getRowDetail',index).find('div.ddv');
					var xref   = $("#doc_no").val();
					var rem   = $("#remark").val();
					var amo   = $("#amount").val();
					ddv.panel({
						border:false,
						cache:true,
						//href:"<?=site_url('apinvoice/show_manual')?>/"+xref+"/"+amo+"/?index="+index,
						href:"<?=site_url('contractlease/show_manual')?>/"+xref+"/"+"/?index="+index,
						onLoad:function(){
							$('#dg').datagrid('fixDetailRowHeight',index);
							$('#dg').datagrid('selectRow',index);
							$('#dg').datagrid('getRowDetail',index).find('form').form('load',row);
							//	$('#am').attr('readOnly',true);
				//$('#am2').attr('readOnly',true);
				//$('#descs').attr('readOnly',true);
				
						}
					});
					$('#dg').datagrid('fixDetailRowHeight',index);
				}
			});
	 
            
        
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
				var a = $('#amo1').val();
							//	var a = $('#dg').datagrid('selectRow', index);
				
				alert(a);
		if (row){
				$.messager.confirm('Confirm','Are you sure you want to remove this Record?',function(r){
					if (r){
						var index = $('#dg').datagrid('getRowIndex',row);
						$.post('<?=site_url('apinvoice/delete')?>/'+ a,
						//{
						//id:row.id},
						function(){
							$('#dg').datagrid('deleteRow',index);
							
							// var voucher = $('#doc_no').val();
			// $.getJSON('<?=site_url()?>apinvoice/lempar/'+ voucher,
			// function(lempar){
			// $('#totald').val(lempar.debet);
			// $('#totalc').val(lempar.credit);
			// });
						});
					}
				});
			}
		}
		
		
		/*End Contractor CRUD*/
       

function loadData(type,parentId){
	  $('#loading').text('Loading '+type.replace('_','/')+' data...');
      $.post('<?=site_url('contractlease/loaddata')?>',
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


	
	loadData('no_loo',0);
	

	/*DropDown Menu*/
	
	$('#no_loo').change(function(){
		
		//~ alert('tes');
		$.getJSON('<?=site_url('contractlease/tampil')?>/'+$(this).val(),
				function(data){
					    
					    $('#penyewa').val(data.customer_nama);
						$('#luas').val(data.luas);
					    $('#hrg_meter').val(numToCurr(data.hrg_meter));
					    $('#nm_subproject').val(data.nm_subproject);
					    $('#nounit').val(data.nounit);
				});
		 
		 });
	
	
	
		
	/*event hide form*/
	$('#sub').change(function(){
		
		//~ alert('tes');
		$.getJSON('<?=site_url('leaseunit/tampil')?>/'+$(this).val(),
				function(data){
					    $('#totarea').val(data.tot_luas_sewa);
					    
					   
				});
		 
		 });

	/*fungsi validasi numeric*/
	  
	  var kugiri = new RegExp(",", "g");
	  var rep_coma = new RegExp(",", "g");
	  $('.calculate').bind('keyup keypress',function(){
			//$(this).val($(this).val());
		  $(this).val(numToCurr($(this).val()));
			
			parseInt($("#hrg_meter").val().replace(kugiri,""));
		  
		  }).numeric();




/*validation form*/
$(function(){
		$('#formadd')
		.validationEngine()
		.ajaxForm({
			success:function(response){
				if(response == 4){
					alert("Data Berhasil Disimpan");
					refreshTable();
				}else{
				    alert(response);
				 }
			
		}
		});	
	});		
		
});
</script>




<? /*$data=$this->mstmodel->group();*/ ?>


<!--
<link rel="stylesheet" href="<?#=base_url()?>assets/css/menuform.css" type="text/css" />
-->
<form method='post' action='<?=site_url()?>contractlease/generateinvoice' id='formadd'>
<div class="easyui-tabs" style="width:1000px;height:300px;">
	<div title="Entry Contract Leased" style="padding:10px;">
		<table border="0" cellpadding="2" cellspacing="2">
	
  
    <!--Customer Profile-->
    
    <tr>
		<td>No Contract</td>
			<td>:</td>
			<td><input name='no_contract' id='no_contract'  value="<?=@$data->no_kontrak_sewa?>" style='width:150;'  class='validate[required]' >	</td>
			
	</tr>	
    
    <tr>
		<td>No.LOO</td>
		<td>:</td>
		<td>
			<input name='no_loo' id='no_loo'  value="<?=@$data->no_loo?>" style='width:150;'  class='validate[required]' >	
			<input type='hidden' name='id_loo' id='id_loo'  value="<?=@$data->id_loo?>" style='width:150;'  class='validate[required]' >	
			<!--<select name='no_loo' id='no_loo' value="<?=@$data->id_loo?>" style='width:150;background-color:#80FFFF'></select></select>-->
		</td>			
			<td>Penyewa</td>
			<td>:</td>
			<td><input name='penyewa' id='penyewa' value="<?=@$data->customer_nama?>" style='width:150;background-color:#80FFFF' readonly>	</td>		
    </tr>    
	<tr >		
		<td >Start Date</td>
			<td>:</td>
			<td><input  name='tglmulai' id='tglmulai' value="<?=@$data->tgl_mulai?>" style='width:80;' readonly >
				<a href="JavaScript:;" onClick="return showCalendar('tglmulai', 'dd-mm-y');" title="Pilih Tanggal" > <img src="<?=base_url()?>assets/js/ico_calendar.gif" alt="s"/></a>
			</td>
		
			<td >No Unit</td>
			<td>:</td>
			<td><input name='nounit' id='nounit' value="<?=@$data->nounit?>"  style='width:100;background-color:#80FFFF;text-align:center;' readonly>	</td>
	</tr>

	<tr>
		
		<td >Open Date</td>
			<td>:</td>
			<td><input  name='tglopen' id='tglopen'style='width:80;' value="<?=@$data->tgl_buka?>" class='validate[required]' readonly >
				<a href="JavaScript:;" onClick="return showCalendar('tglopen', 'dd-mm-y');" title="Pilih Tanggal" > <img src="<?=base_url()?>assets/js/ico_calendar.gif" alt="s"/></a>
			</td>
				
			<td >Luas Unit</td>
			<td>:</td>
			<td><input name='luas' id='luas' value="<?=@$data->luas?>" style='width:80;background-color:#80FFFF;text-align:center;' readonly>	</td>
		
			
		

	</tr>
	
	<tr id='tr2'>
		<td>Grace Period</td>
			<td>:</td>
			<td>
			<input name='period' id='period'  value="<?=@$data->grace_period?>" style='width:150;'  class='validate[required]' > Month
			
			</td>
			
			<td>Proyek</td>
			<td>:</td>
			<td><input name='nm_subproject' id='nm_subproject' value="<?=@$data->kd_project?>" style='width:150;background-color:#80FFFF' readonly>	</td>
			
		
			
			
				
			
	</tr>
	<!--
	<tr>
		<td>Payment Plan</td>
			<td>:</td>
			<td><select name='tenant' id='tenant' class='validate[required]' style='width:150' readonly></select></td>
		
			
	</tr>-->
	<tr>
		<td>Sewa Per Meter</td>
			<td>:</td>
			<td><input name='hrg_meter' id='hrg_meter' value="<?=@$data->hrg_meter?>"style='width:150;background-color:#FF80FF;text-align:right' ></td>
		
			
	</tr>
	
	
	

	<tr id='tr14'>
		<td colspan="3">
			<input type="submit" name="save" value="Approved"/>
			<input type="reset" name="cancel" value="Cancel"/>
		</td>
	</tr>	
</table>
</div>
</form>


<div title="Payment Plan" style="padding:10px;">
<!--
	<div class="easyui-tabs" style="width:600px;height:300px;">
-->
		<table id="dg" title="Payment Plan" style="width:980px;height:250px"
				url="<?=site_url('contractlease/get_dg')?>/<?=$data->id_loo?>" 
				toolbar="#toolbar" pagination="true"
				fitColumns="true" singleSelect="true">
				
				<thead>
				<tr>
					<th field="thp_bayar" width="180px">Term Payment</th>
<!--
					<th field="descs" width="180px">Description</th>
-->
					<th field="freq" width="40px" >Freq</th>
					<th field="intvl" width="40px" >Interval</th>	
<!--
					<th field="intvl_type" width="100px" >Base</th>
-->
					<th field="persen" width="40px" editor="text">%</th>
					<th field="fix_amount" width="100px" editor="text">Amount</th>
					<th field="tax" width="100px" editor="text">Pajak</th>
					<th field="stamp" width="100px" editor="text">Stamp Charg</th>
					
				</tr>
			</thead>
				
			</table>	
			<div id="toolbar">
			<a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newItem()">Add</a>
			<a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyItem()">Delete</a>
		</div>
<!--
		</div>
-->
	
	</div>
