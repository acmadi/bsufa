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
function saveItem(index){
			//alert("test");
			var row = $('#dg').datagrid('getRows')[index];
			var url = row.isNewRecord ? '<?=site_url('adjustment/savedetail')?>' : '<?=site_url('adjustment/savedetail')?>/'+row.id;
			
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
					var voucher = $('#voucher').val();
			$.getJSON('<?=site_url()?>adjustment/lempar/'+ voucher,
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
						$.post('<?=site_url('adjustment/delete')?>/'+ a,
						//{
						//id:row.id},
						function(){
							$('#dg').datagrid('deleteRow',index);
							
							var voucher = $('#voucher').val();
			$.getJSON('<?=site_url()?>adjustment/lempar/'+ voucher,
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
		
		$('#voucher_date').datebox({  
                                                required:true  
                                });
			// $('#dg').edatagrid({
				// url: "<?=site_url('adjustment/cekdata')?>",
				// saveUrl: "<?=site_url('adjustment/savedetail')?>",
				// updateUrl: "<?=site_url('adjustment/save')?>",
				// destroyUrl: "<?=site_url('adjustment/delete')?>"
			// });
			
	
		// $("#cek").change(function(){
	// //alert('tes');
			// $.getJSON('<?=site_url()?>/adjustment/test/' + $(this).val(),
			// function(test){				
				// $('#totald').val(test.totald);	
				// $('#totalc').val(test.totalc);
			// });
		// });	
		
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
					var xref   = $("#voucher").val();
					var rem   = $("#remark").val();
					ddv.panel({
						border:false,
						cache:true,
						//href:"<?=site_url('adjustment/show_form2')?>/"+xref+"/"+rem+"/?index="+index,
						href:"<?=site_url('adjustment/show_form2')?>/"+xref+"/"+"/?index="+index,
						onLoad:function(){
							$('#dg').datagrid('fixDetailRowHeight',index);
							$('#dg').datagrid('selectRow',index);
							$('#dg').datagrid('getRowDetail',index).find('form').form('load',row);
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
				//
				//refreshTable();
				//$('#buttonID').click();
			}
		});			
});  	 
	 
</script>
</head>
<form id="formAdd" method="post" action='<?=site_url('adjustment/saveheader')?>'>
 <?php $tgl = date('d/m/Y'); ?>
<body>
<table>
	<h2>Memorial Journal</h2>		
	</div>
	<!--<tr>
	<td>Trx Type</td>
			<td>:</td>
			<select name="trxtype">
			<option value='AJ'>AJ</option>
			</select>
	</tr>-->
	<tr>
		<td>Journal No.</td>
			<td>:</td>
			<td><input type="text" name="voucher" id="voucher" class="validate[required] xinput" value="<?=@$data->voucher?>" style="width:110px;background-color:#EFFC94" readonly="true" size="30" /></td>
	</tr>
	<tr>
		<td>Date</td>
			<td>:</td>
			<td>	<input id="voucher_date" name="voucher_date"  value="<?=@$data->trans_date?>"  size="30"></input> 
</td>	
	</tr>
	<tr>
		<td>Description</td>
			<td>:</td>
			<td><input type="text" name="remark" id="remark"  value="<?=@$data->desc?>" class="xinput validate[required]" size="80" /></td>
	</tr>
	<tr>
	<td>
	</td>	
	</tr>	
	</table>
		<br>
	<br>
	<!--<table id="dg" title="Adjustment Jurnal Detail" style="width:880px;height:250px"
			toolbar="#toolbar" 
			rownumbers="true" fitColumns="true" singleSelect="true">
		<thead>
			<tr>
			<th field="acc_no" width="80" id='acc_no' editor="{type:'combobox',options:{valueField:'acc_no',textField:'name',url:'<?=site_url('adjustment/loadcoa')?>',required:true}}">Acc No</th>
				
				
				<th field="descs" width="70" editor="text">Descs</th>
				<th field="debit" width="50" editor="numberbox">Debit</th>
				<th field="credit" width="50" editor="numberbox">Credit</th>
			</tr>
		</thead>
	</table>
	<div id="toolbar">
		<a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="javascript:$('#dg').edatagrid('addRow')">New</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="javascript:$('#dg').edatagrid('destroyRow')">Delete</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="javascript:$('#dg').edatagrid('saveRow')">Save</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-undo" plain="true" onclick="javascript:$('#dg').edatagrid('cancelRow')">Cancel</a>
	</div>	-->
	<!-- GRID TABLE -->
<div class="easyui-tabs" style="width:1000px;height:300px;">
	<div title="Add Detail Adjustment" style="padding:10px;">	
		<table id="dg" title="Input Adjustment" style="width:980px;height:250px"
				url="<?=site_url('adjustment/get_dg')?>/<?=$data->gl_id?>"
				toolbar="#toolbar" pagination="true"
				fitColumns="true" singleSelect="true">
			<thead>
				<tr>
					<!--<th field="acc_no" width="180px">Account No</th>
					<th field="acc_name" width="180px">Account Name</th>
					<th field="descs" width="180px" >Description</th>							
					<th field="debet" width="100px" editor="text">Debet</th>
					<th field="credit" width="100px" editor="text">Credit</th>-->
					<th field="acc_no" width="100px">Account No</th>
					<th field="acc_name" width="120px" >Account Name</th>
					<th field="descs" width="120px" >Description</th>		
					<th field="debet" width="100px" editor="text">Debet</th>
					<th field="credit" width="100px" editor="text">Credit</th>
					<th field="sub_ledger" width="120px" >Sub Ledger</th>		
					<th field="ap_no" width="120px" >AP No</th>			
					<th field="invoice_ap" width="120px" >Invoice AP</th>	
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
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;

			
			
			</td>
			<td colspan='3'></td>
			<td colspan='3'>Total&nbsp;&nbsp;</td>
			<td colspan='3'><input type="text" align="right" name="totald" id="totald"   value="<?=@$data->debit?>" style="width:150px;background-color:#EFFC94;text-align:right" readonly="true" size="80" /></td>
		</tr>
			&nbsp;&nbsp;&nbsp;
			<tr>
			<td colspan='3'><input type="text" align="right" name="totalc" id="totalc"   value="<?=@$data->credit?>" style="width:150px;background-color:#EFFC94;text-align:right" readonly="true" size="80" /></td>
		</tr>		
		</div>
	
	<br>
		<tr>
	<input type="submit" name="save" value="Save"/>
	<input type="reset" name="cancel" value="Cancel"/>
	</tr>
</body>
</html>
