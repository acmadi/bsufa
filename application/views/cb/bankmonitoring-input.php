<html>
<head>
<link rel="stylesheet" href="<?=base_url()?>assets/css/easyui.css" type="text/css" />
<link rel="stylesheet" href="<?=base_url()?>assets/css/icon.css" type="text/css" />
<link rel="stylesheet" href="<?=base_url()?>assets/css/demo.css" type="text/css" />

<!--script language="javascript" src="<?=base_url()?>assets/js/jquery-1.7.2.min.js"></script-->
<script language="javascript" src="<?=base_url()?>assets/js/jquery.easyui.min.js"></script>
<!--<script type="text/javascript" src="<?=base_url()?>assets/js/jquery.edatagrid.js"></script>-->
<script language="javascript" src="<?=base_url()?>assets/js/calendar.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/calendar2.js"></script>
<?=script('datagrid-detailview.js')?>
<?=script('jquery.formx.js')?>
<?=link_tag(CSS_PATH.'demo.css')?>
<?=script('currency.js')?>

<script type="text/javascript">	

		$.fn.datebox.defaults.formatter = function(date) {
			var y = date.getFullYear();
			var m = date.getMonth() + 1;
			var d = date.getDate();
			return (d < 10 ? '0' + d : d) + '-' + (m < 10 ? '0' + m : m) + '-' + y;
		};	
		
		$('#tgl').datebox({  
                                                required:true  
                                });
		
		$('.calculate').bind('keyup keypress',function(){
			var rep_coma = new RegExp(",", "g");
			$(this).val(numToCurr($(this).val()));			
			var amount = parseInt($('#amount').val().replace(rep_coma,""));
			});	
		
		
		$('#cc').combogrid({  
        panelWidth:450,  
        value:'',  
       
        idField:'cashflow_id',  
        textField:'nama',  
        url:'bankmonitoring/cashflow',  
        columns:[[  
            {field:'kodecash',title:'kodecash',width:100},  
            {field:'nama',title:'nama',width:200},  

        ]]  
    });  
	
		$('#dd').combogrid({  
        panelWidth:450,  
        value:'006',  
       
        idField:'bank_id',  
        textField:'bank_nm',  
        url:'bankkeluar/bank',  
        columns:[[  
			{field:'bank_id',title:'Kode Bank',width:100},  
            {field:'bank_nm',title:'Nama Bank',width:200},  
			{field:'bank_acc',title:'Rekening',width:200},  
        ]]  
    });  

		// $(function(){
			// $('#dg').edatagrid({
				// url: "<?=site_url('bankmonitoring/cekdata')?>",
				// saveUrl: "<?=site_url('bankmonitoring/savedetail/'.$nocb)?>",
				// updateUrl: "<?=site_url('bankmonitoring/save')?>",
				// destroyUrl: "<?=site_url('bankmonitoring/delete')?>"
			// });
		// });
		
		$('#dg').datagrid({
				view: detailview,
				detailFormatter:function(index,row){
					return '<div class="ddv"></div>';
				},
				onExpandRow: function(index,row){
					var ddv = $(this).datagrid('getRowDetail',index).find('div.ddv');
					var xref   = $("#voucher").val();
					ddv.panel({
						border:false,
						cache:true,
						href:"<?=site_url('bankmonitoring/show_form')?>/"+xref+"/?index="+index,
						onLoad:function(){
							$('#dg').datagrid('fixDetailRowHeight',index);
							$('#dg').datagrid('selectRow',index);
							$('#dg').datagrid('getRowDetail',index).find('form').form('load',row);
						}
					});
					$('#dg').datagrid('fixDetailRowHeight',index);
				}
			});
		
		/*Contractor CRUD*/
		function saveItem(index){
			//alert("test");
			var row = $('#dg').datagrid('getRows')[index];
			var url = row.isNewRecord ? '<?=site_url('bankmonitoring/savedetail')?>' : '<?=site_url('bankmonitoring/savedetail')?>/'+row.id;
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
			$.getJSON('<?=site_url()?>bankmonitoring/lempar/'+ voucher,
			function(lempar){
			$('#totald').val(numToCurr(lempar.amt_base));
			//$('#totalc').val(lempar.credit);
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
				$.messager.confirm('Confirm','Are you sure you want to remove this Record?',function(r){
					if (r){
						var index = $('#dg').datagrid('getRowIndex',row);
						$.post('<?=site_url('bankmonitoring/delete_dg')?>',{id:row.id},function(){
							$('#dg').datagrid('deleteRow',index);
						});
					}
				});
			}
		}
		
		function newItem(){
		
		var remark = $('#remark').val();
		
			if (remark == ''){
			alert('Isi Remark Terlebih Dahulu');
			}
			else
			{
		
			$('#dg').datagrid('appendRow',{isNewRecord:true});
			var index = $('#dg').datagrid('getRows').length - 1;
			$('#dg').datagrid('expandRow', index);
			$('#dg').datagrid('selectRow', index);
			}
		}
		/*End Contractor CRUD*/
	$(document).ready(function(){
			  	    $("#cheque").hide();
					$("#terima").hide();
					$("#cheque1").hide();
					$("#cheque2").hide();
					$("#terima1").hide();
					$("#terima2").hide();
					
	
	
	
   $("#paid").change(function(){
   //alert(uu);
   
				if($("#paid option:selected").val()==1){
			
					$("#terima").show();
					$("#terima1").show();
					$("#terima2").show();
					$("#cheque").hide();
					$("#cheque1").hide();
					$("#cheque2").hide();
				}else if ($("#paid option:selected").val()==2){
					$("#terima").show();
					$("#terima1").show();
					$("#terima2").show();
					$("#cheque").show();
					$("#cheque1").show();
					$("#cheque2").show();
		
					// $("#vendor2").hide();
					// $("#vendor").show();
				}
				else
				{
					$("#terima").show();
					$("#terima1").show();
					$("#terima2").show();
					$("#cheque").show();
					$("#cheque1").show();
					$("#cheque2").show();
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
<form id="formAdd" method="post" action="<?=site_url('cb/bankmonitoring/saveheader')?>">
 <?php $tgl = date('d-m-Y'); ?>
<body>

	<table>
	<tr>
	<td colspan="6">
	<h2>BANK IN</h2>		
	</td>
	</tr>
	<tr>
		<td>Voucher</td>
			<td>:</td>
			<td><input type="text" name="voucher" id="voucher" class="validate[required] xinput" xinput" value="<?=$nocb?>" class="validate[required]" style="width:125px;background-color:#EFFC94" readonly="true" size="30" /></td>
			<td>Bank</td>
			<td>:</td>
			<td>
					<select id="dd" name="bank" size="150" ></select> 
            </td>

	</tr>
	<tr>
		<td>Date</td>
			<td>:</td>
			<td>
			<input id="tgl" name="tgl"  value="<?=$tgl?>"  size="30"></input>
			</td>			
			<td>Paid</td>			
			<td>:</td>
			<td>
			<select name='paid'  id="paid">
			<option value=></option>
			<option value=1>Cash</option>
			<option value=2>Transfer</option>
			<option value=3>Cek</option>
			</select>
			</td>
			<td id="cheque1">No. Cheque</td>
			<td id="cheque2">:</td>
			<td><input type="text" name="cheque" id="cheque"  class="validate[required] xinput" xinput" value="<?=@$data->remark?>" class="validate[required]" size="30" /></td>
	</tr>
	<tr>
			<!--<td>Cash In</td>			
			<td>:</td>
			<td><select id="cc" name="kodecash" size="80" ></select> </td>-->
			<td>Remark</td>
			<td>:</td>
			<td><input type="text" name="remark" id="remark"  class="validate[required] xinput" xinput" value="<?=@$data->remark?>" class="validate[required]" size="80" /></td>
			
			<td>Amount</td>			
			<td>:</td>
			<td><input type="text" class="calculate input validate[required]" name="amount" id="amount"  value="<?=@$data->amount?>" size="30" /></td>
			
	</tr>
	<tr>
	<td>CashFlow</td>			
			<td>:</td>
			<td><select id="cc" name="kodecash" size="80" ></select> </td>
		<td id ="terima2">Terima Dari</td>
			<td id ="terima1">:</td>
			<td><input type="text" name="terima" id="terima"  class="validate[required] xinput" xinput" value="<?=@$data->remark?>" class="validate[required]" size="30" /></td>
	</tr>
	<tr>
	<td>Project</td>
			<td>:</td>
			<td> <select name="project_detail" id="project_detail">
						<option>-</option>
                                                            <? foreach($project_detail as $row): ?>
                                                            <option value="<?=@$row->subproject_id?>"><?=@$row->nm_subproject?></option> 
                                                            <? endforeach;?>
                        </select>  
	</td>
	</tr>
	</table>
	<!--<table id="dg" title="Cash In Detail" style="width:900px;height:250px"
			toolbar="#toolbar"
			rownumbers="true" fitColumns="true" singleSelect="true">
		<thead>	 		
			<tr>			
				<th field="acc_no" width="80"  class="easyui-combobox" editor="{type:'combobox',options:{valueField:'acc_no',textField:'name',url:'<?=site_url('bankmonitoring/loadcoa')?>',required:true}}">Acc No</th>				
				<th field="line_desc" width="50"  editor="text">Descs</th>
				<th field="amount" width="50" editor="numberbox" >Amount</th>
			</tr>
		</thead>
	</table>
	<div id="toolbar" >
		<a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="javascript:$('#dg').edatagrid('addRow')">New</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="javascript:$('#dg').edatagrid('destroyRow')">Delete</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="javascript:$('#dg').edatagrid('saveRow')">Save</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-undo" plain="true" onclick="javascript:$('#dg').edatagrid('cancelRow')">Cancel</a>
	</div>	-->
	 <!--GRID TABLE -->
<div class="easyui-tabs" style="width:1100px;height:300px;">
	<div title="Add Jurnal Bank" style="padding:10px;">	
		<table id="dg" title="Jurnal Bank" style="width:1100px;height:250px"
				url="<?=site_url('bankmonitoring/get_dg')?>"
				toolbar="#toolbar" pagination="true"
				fitColumns="true" singleSelect="true">
			<thead>
				<tr>
					<th field="acc_no" width="180px">Account No</th>
					<th field="acc_name" width="180px">Account Name</th>
					<th field="sub_ledger" width="180px" >Sub Ledger</th>	
					<th field="line_desc" width="180px" >Desc</th>							
					<th field="amount" width="100px" editor="text">Credit</th>
					
				</tr>
			</thead>
		</table>
		<div id="toolbar">
			<a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newItem()">Add</a>
			<a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyItem()">Delete</a>
		</div>
	</div>	
</div>	
<!--<br>

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
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

			
			
			</td>
			<td colspan='3'></td>
			<td colspan='3'>Balance&nbsp;&nbsp;</td>
			<td colspan='3'><input type="text" align="right" name="totald" id="totald"   value="<?=number_format(@$data->amt_base)?>" style="width:150px;background-color:#EFFC94;text-align:right" readonly="true" size="80" /></td>
		</tr>
			
		</div>
	
	<br>-->s
		<tr>
			<td colspan='3'><input type="submit" name="save" value="Save"/></td>
			<td colspan='3'><input type="reset" name="cancel" value="Cancel"/></td>
		</tr>
		</form>
</body>
</html>
