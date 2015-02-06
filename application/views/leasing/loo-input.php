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
			var url = row.isNewRecord ? '<?=site_url('loo/saveitem')?>' : '<?=site_url('loo/saveitem')?>/'+row.id;
			
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
					
					
		function cancelItem(index){
			var row = $('#dg').datagrid('getRows')[index];
			if (row.isNewRecord){
				$('#dg').datagrid('deleteRow',index);
			} else {
				$('#dg').datagrid('collapseRow',index);
			}
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
					var xref   = $("#noref").val();
					//var rem   = $("#remark").val();
					//var amo   = $("#amount").val();
					ddv.panel({
						border:false,
						cache:true,
						//href:"<?=site_url('apinvoice/show_manual')?>/"+xref+"/"+amo+"/?index="+index,
						href:"<?=site_url('loo/show_unit')?>/"+xref+"/"+"/?index="+index,
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
			
			
		
		// function newItem(){
			
			// $('#dg').datagrid('appendRow',{isNewRecord:true});
			// var index = $('#dg').datagrid('getRows').length - 1;
			// $('#dg').datagrid('expandRow', index);
			// $('#dg').datagrid('selectRow', index);
		// }
		
		


function loadData(type,parentId){
	  $('#loading').text('Loading '+type.replace('_','/')+' data...');
      $.post('<?=site_url('loo/loaddata')?>',
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


	
	loadData('proj',0);
	loadData('tenant',0);
	

	/*DropDown Menu*/
	$('#proj').change(function(){
			loadData('nounit',$('#proj option:selected').val());
		});
	
	
	
		
	/*event hide form*/
	$('#tenant').change(function(){
		
		//~ alert('tes');
		$.getJSON('<?=site_url('loo/tampil')?>/'+$(this).val(),
				function(data){
					    $('#tlp').val(data.customer_tlp);
						$('#alamat').val(data.customer_alamat1);
					    
					   
				});
		 
		 });
		 
		 $('#nounit').change(function(){
		
		//~ alert('tes');
		$.getJSON('<?=site_url('loo/tampilluas')?>/'+$(this).val(),
				function(data){
					    $('#luasunit').val(data.luas);

					    
					   
				});
		 
		 });

	/*fungsi validasi numeric*/
	  
	  var kugiri = new RegExp(",", "g");
	  var rep_coma = new RegExp(",", "g");
	  $('.calculate').bind('keyup keypress',function(){
			//$(this).val($(this).val());
		  $(this).val(numToCurr($(this).val()));
			
			var psm = parseInt($('#psm').val().replace(rep_coma,""));
			var period = parseInt($('#period').val().replace(rep_coma,""));
			var luasunit = ($('#luasunit').val());
			
			var totlease = (psm * luasunit)*period;
			var lpm = psm * luasunit;

			$('#totlease').val(numToCurr(totlease));
			$('#lpm').val(numToCurr(lpm));
			
			var scpsm = parseInt($('#sc_psm').val().replace(rep_coma,""));
			var scbln = scpsm * luasunit;
			$('#sc_bln').val(numToCurr(scbln));
			
			//parseInt($("#price_meter").val().replace(kugiri,""));
		  
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
<form method='post' action='<?=site_url()?>loo/InsertLoo' id='formadd'>
<div class="easyui-tabs" style="width:1000px;height:350px;">
	<div title="Entry LOO" style="padding:10px;">
<table border="0" cellpadding="2" cellspacing="2">
	<? $today = date('d-M-Y');?>
  
    <!--Customer Profile-->
    
    <tr>
		<td colspan="3" style=""><font color='#FF0000'><b><u>ENTRY LOO</u></b></font></td>
    </tr>
    
    <tr>
			<td >Tgl</td>
			<td>:</td>
			<td colspan="6"><b><input  name='tgl' id='tgl'style='width:100;text-align:center;background-color:#C0C0C0' value=<?=$today?> readonly ></b></td>
	
    </tr>
    
    
    
    <tr>
	<td >NO LOO</td>
		<td >:</td>
		<td  ><b><input name='noref' id='noref' style='width:150;background-color:#FF8080' readonly value=<?=$sql->noloo?>></b></td>
	
	
		
		
			<td>Function Leased</td>
			<td>:</td>
			<td>
				<input type="radio" name="function"  id='office' value="1"/> Office
				<input type="radio" name="function"  id='retail' value="2"/> Retail
			</td>	
		
    </tr>
			
		
    
	<tr >
			
		<td>Project</td>
		<td>:</td>
		<td>
			<select name='proj' id='proj' style='width:150'></select>
		</td>
		
		
		
			<td>Lease Period</td>
			<td>:</td>
			<td><select  name='period' id='period' style='background-color:#80FF00;width:40' readonly>
				<?$x=1;while($x<=60){?>
				<option><?=$x;$x++;?></option>
				<?}?>
			
			
			</select>Month</td>
			
		<td >Service Charge per Meter</td>
			<td>:</td>
			<td><input name='sc_psm' id='sc_psm' style='width:100;text-align:right'  class='validate[required] calculate' ></td>	
			
		
			
		
	</tr>
	
	<tr id='tr2'>
		<td >No Unit</td>
		<td>:</td>
		<td><select  name='nounit' id='nounit' style='width:80'  class='validate[required]' ></select></td>
		
			<td >Lease per SQM</td>
			<td>:</td>
			<td><input name='psm' id='psm' style='width:100;text-align:right'  class='validate[required] calculate' ></td>
			
				<td >Service Charge per Month</td>
				<td>:</td>
				<td><input name='sc_bln' id='sc_bln' style='width:100;text-align:right;background-color:#80FFFF' readonly ></td>
			
	</tr>
	
	<tr>
		<td>Area</td>
		<td>:</td>
		<td><input name='luasunit' id='luasunit' style='width:60;background-color:#80FF00' readonly>Sqm</td>
			
			<td >Lease per Month </td>
			<td>:</td>
			<td><input  name='lpm' id='lpm'  style='background-color:#80FF00;width:100'  readonly ></td>
			
				<td >Deposit Leased</td>
				<td>:</td>
				<td><input name='depoleas' id='psm' style='width:100;text-align:right'  class='validate[required] calculate' ></td>
			
	</tr>
	
	
	<tr>
		
		<td>Tenant</td>
		<td>:</td>
		<td><select name='tenant' id='tenant' style='width:150' readonly></select></td>
			<td >Total Leased</td>
				<td>:</td>
				<td><input  name='totlease' id='totlease'  style='background-color:#80FF00;width:100'  readonly ></td>
				
					<td >Deposit Service Charge</td>
					<td>:</td>
					<td><input name='deposc' id='deposc' style='width:100;text-align:right'  class='validate[required] calculate' ></td>
			
	</tr>
	
	<tr>
		
		<td>No.Tlp</td>
		<td>:</td>
		<td colspan='4'><input name='tlp' id='tlp' style='background-color:#FFFF00;width:80' readonly></td>
			
			
			<td >Deposit Tlp</td>
			<td>:</td>
			<td><input name='depotlp' id='depotlp' style='width:100;text-align:right'  class='validate[required] calculate' ></td>
				
	</tr>
	
	<tr>
		<td colspan='3'><b><u>Alamat</td></u></b>
			
	</tr>
	
	<tr>
		<td colspan='6'><textarea name='alamat' id='alamat' style='width:250;background-color:#FFFF00' readonly></textarea></td>
		<td><input type="hidden" name='luasunit' id='luasunit' style='background-color:#FFFF00;width:80' readonly></td>
	</tr>
	
	

	<tr id='tr14'>
		<td colspan="3">
			<input type="submit" name="save" value="Save"/>
			<input type="reset" name="cancel" value="Cancel"/>
		</td>
	</tr>	
</table>
</div>
</form>

<div title="Unit Asign" style="padding:10px;">


		<table id="dg" title="Unit Asign" style="width:980px;height:250px"
				url="<?=site_url('loo/get_dg')?>"toolbar="#toolbar" pagination="true"
				fitColumns="true" singleSelect="true">
				
				<thead>
				<tr>
				    <th field="project2" width="100px">Unit No</th>
					<th field="unitno" width="100px">Unit No</th>
					<th field="luas" width="100px" >Luas</th>
					<th field="harga" width="100px" >Harga/m2</th>					
				</tr>
			</thead>
				
			</table>	
			<div id="toolbar">
			<a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newItem()">Add</a>
			<a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyItem()">Delete</a>
		</div>
	
	</div>
