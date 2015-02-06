<?#=script('jquery.tabs.js')?>
<?=link_tag(CSS_PATH.'easyui.css')?>
<?=link_tag(CSS_PATH.'icon.css')?>
<?=link_tag(CSS_PATH.'demo.css')?>
<?=script('jquery.easyui.min.js')?>
<?=script('jquery.edatagrid.js')?>
<?=script('currency.js')?>
<?=script('jquery.numeric.js')?>
<link href="<?=site_url()?>assets/css/validationEngine.jquery.css" rel="stylesheet" type="text/css">
<!--<script language="javascript" src="<?=site_url()?>assets/js/jquery-1.6.minx.js"></script>-->
<script language="javascript" src="<?=site_url()?>assets/js/jquery.validationEnginex.js"></script>
<script language="javascript" src="<?=site_url()?>assets/js/jquery.validationEngine-enx.js"></script>
<script language="javascript" src="<?=site_url()?>assets/js/jquery.formx.js"></script>
<?=script('datagrid-detailview.js')?>
<?=script('currency.js')?>

<script type="text/javascript">	
	

function loadData(type,parentId){
	  // berikan kondisi sedang loading data ketika proses pengambilan data
	  $('#loading').text('Loading '+type.replace('_','/')+' data...');
      $.post('<?=site_url('apinvoice/loaddatacoa')?>', //request ke fungsi load data di inputAP
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
   
   function saveItem(index){
			//alert("test");
			var row = $('#dg').datagrid('getRows')[index];
			var url = row.isNewRecord ? '<?=site_url('apinvoice/savejurnal')?>' : '<?=site_url('apinvoice/savejurnal')?>/'+row.id;
			
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
			var voucher = $('#doc_no').val();
			$.getJSON('<?=site_url()?>apinvoice/lempar/'+ voucher,
			function(lempar){
			$('#totald').val(lempar.debet);
			$('#totalc').val(lempar.credit);
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
				var a = $('#gl_id').val();
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
							
							var voucher = $('#doc_no').val();
			$.getJSON('<?=site_url()?>apinvoice/lempar/'+ voucher,
			function(lempar){
			$('#totald').val(lempar.debet);
			$('#totalc').val(lempar.credit);
			});
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
 $(function(){
 
		$.fn.datebox.defaults.formatter = function(date) {
			var y = date.getFullYear();
			var m = date.getMonth() + 1;
			var d = date.getDate();
			return (d < 10 ? '0' + d : d) + '-' + (m < 10 ? '0' + m : m) + '-' + y;
		};	
		
		$('#receipt_date').datebox({  
                                                required:true  
                                });
		$('#due_date').datebox({  
                                                required:true  
                                });
		$('#inv_date').datebox({  
                                                required:true  
                                });
		
		$('.calculate').bind('keyup keypress',function(){
			var rep_coma = new RegExp(",", "g");
			$(this).val(numToCurr($(this).val()));			
			var amount = parseInt($('#amount').val().replace(rep_coma,""));
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
					ddv.panel({
						border:false,
						cache:true,
						href:"<?=site_url('apinvoice/show_form')?>/"+xref+"/"+rem+"/?index="+index,
						onLoad:function(){
							$('#dg').datagrid('fixDetailRowHeight',index);
							$('#dg').datagrid('selectRow',index);
							$('#dg').datagrid('getRowDetail',index).find('form').form('load',row);
								// $('#am').attr('readOnly',true);
				// $('#am2').attr('readOnly',true);
				// $('#descs').attr('readOnly',true);
				
						}
					});
					$('#dg').datagrid('fixDetailRowHeight',index);
				}
			});
	 

			$('#formAdd')
		//.validationEngine()
		.ajaxForm({
			success:function(response){
				//alert(response);
				if(response=="sukses"){
					alert(response);
					refreshTable();
				}else{
					alert(response);
				}
			}
		});			
});  	 
  
		</script>

<form method="post" action="<?=site_url('apinvoice/approve')?>" id="formAdd">
<body>	
	<table>
	<tr>
		<h2>AP INVOICE</h2>		
	</tr>
	<tr>
		<td>AP</td>
			<td>:</td>
			<td><input type="text" name="doc_no" id="doc_no"  class="validate[required] xinput" xinput"  value="<?=@$data->doc_no?>"  class="validate[required]" style="width:180px;background-color:#EFFC94"  readonly="true" size="30" /></td>
			<td>Invoice No</td>
			<td>:</td>
			<td><input type="text" name="inv_no" id="inv_no"  value="<?=@$data->inv_no?>" class="validate[required]" size="30" /></td>

	</tr>

	<tr>
		<td>Receipt Date</td>
			<td>:</td>
			<td>
			<input id="receipt_date" name="receipt_date" value="<?=@$data->doc_date?>" size="30"></input>
			</td>
			<td>Invoice Date </td>
			<td>:</td>
			<td>
			<input id="inv_date" name="inv_date" value="<?=@$data->inv_date?>"   size="30"></input>
			</td>
	</tr>
	<tr>
	<td>Type</td>
	<td>:</td>
	<td>
	<input id="trx_type" name="trx_type" value="<?=@$data->trx_type?>"   style="width:180px;background-color:#EFFC94" readonly="true"   size="30"></input>
	</td>
	<td>Due Date</td>
			<td>:</td>
			<td>
             <input id="due_date" name="due_date" value="<?=@$data->due_date?>"  size="30"></input>      
            </td>
	</tr>
	<tr>
		<td>No. Reff</td>
			<td>:</td>
			<td>
			<input id="ref_no" name="ref_no" value="<?=@$data->po_no?>"    style="width:220px;background-color:#EFFC94" readonly="true"  size="50"></input>      
            </td>
			<td>Invoice Amount</td>		
			<td>:</td>
			<td><input type="text" class="input calculate"  name="amount" id="amount" class="calculate input validate[required]" value="<?=@$data->base_amt?>" size="30" /></td>
			</tr>
	<tr>
	<td>Vendor Name</td>
			<td>:</td>
			<td><input type="text" name="vendor" id="vendor" class="validate[required] xinput" xinput" value="<?=@$data->nm_supplier?>"  style="width:200px;background-color:#EFFC94" readonly="true"  size="80" />
			</td>
			<!--<td>Ppn Amount</td>
			<td>:</td>
			<td><input type="text" name="ppn" id="ppn" class="calculate input validate[required]" value="<?=number_format($data->ppn)?>"  /></td>-->
			
	</tr>
	<tr>	
	<td>AP Category</td>
			<td>:</td>
			<td><input type="text" name="category" id="category" class="validate[required] xinput" xinput" value="<?=@$data->category?>" style="width:180px;background-color:#EFFC94" readonly="true" size="30" /></td>
		<!--	<td>Pph Amount</td>
			<td>:</td>
			<td><input type="text" name="pphamount" id="pphamount" class="calculate input validate[required]" value="<?=number_format($data->pph)?>" size="30" /></td>-->
	</tr>
	<!--<tr>	
			<td>Total </td>
			<td>:</td>
			<td><input type="text" name="total_billing" id="total_billing" class="calculate input validate[required]" value="<?=number_format($data->total)?>" style="width:100px;background-color:#EFFC94" readonly="true" size="30" /></td>-->
			<!--<td>Pph</td>
			<td>:</td>
			<td><input type="text" name="ppn" id="ppn" class="calculate input validate[required]" value="<?=@$data->pph?>"  style="width:100px;background-color:#EFFC94" readonly="true"  /></td>
			</td>	-->		
	</tr>
	<!--<tr>	
	<td>Paid </td>
			<td>:</td>
			<td><input type="text" name="paid_billing" id="paid_billing" class="calculate input validate[required]" value="<?=number_format($data->paid)?>"  style="width:100px;background-color:#EFFC94" readonly="true" size="30" /></td>
	
	</tr>-->
	<tr>	
	</tr>
	<!--<tr>	
	<td>Balance </td>
			<td>:</td>
			<td><input type="text" name="balance" id="balance" class="calculate input validate[required]" value="<?=number_format($data->balance)?>"  style="width:100px;background-color:#EFFC94" readonly="true" size="30" /></td>
	</tr>-->
<tr>
			<td>Remark</td>
			<td>:</td>
			<td><input "text " name="remark" id="remark" class="validate[required] xinput" xinput" value="<?=@$data->descs?>"  size="100" /></td>			
	</tr>	
	</table>	
	<!-- GRID TABLE -->
<div class="easyui-tabs" style="width:1000px;height:250px;">
	<div title="Journal Detail Invoice" style="padding:10px;">	
		<table id="dg" title="Edit Journal" style="width:980px;height:200px"
				url="<?=site_url('apinvoice/get_dg')?>/<?=$data->doc_no?>"
				toolbar="#toolbar" pagination="true"
				fitColumns="true" singleSelect="true">
			<thead>
				<tr>
					<th field="acc_no" width="180px">Account No</th>
					<th field="acc_name" width="180px">Account Name</th>
					<th field="descs" width="180px" >Description</th>							
					<th field="debet" width="100px" editor="text">Debet</th>
					<th field="credit" width="100px" editor="text">Credit</th>
					</tr>
			</thead>
		</table>
		<div id="toolbar">
			<a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newItem()">Add</a>
			<a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyItem()">Delete</a>
		</div>
	</div>	
</div>	
	<br>
	<!--	<div>

	<tr>
			<td colspan='3'>Total</td>
			<td colspan='3'><input type="text" name="totald" id="totald"/></td>
		</tr>
			<tr>
			<td colspan='3'><input type="text" name="totalc" id="totalc"/></td>
		</tr>
		</div>-->
		<div>

			<td colspan='3'>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

			
			
			</td>
			<td colspan='3'></td>
			<td colspan='3'>Total&nbsp;&nbsp;</td>
			<td colspan='3'><input type="text" align="right" name="totald" id="totald"   value="<?=@$data->debet?>" style="width:150px;background-color:#EFFC94;text-align:right" readonly="true" size="80" /></td>
		</tr>
			&nbsp;&nbsp;&nbsp;
			<tr>
			<td colspan='3'><input type="text" align="right" name="totalc" id="totalc"   value="<?=@$data->credit?>" style="width:150px;background-color:#EFFC94;text-align:right" readonly="true" size="80" /></td>
		</tr>		
		</div>
	
	<br>
		<tr>
	<input type="submit" name="save" value="Approved"/>
	</tr>

			
</body>
</form>


