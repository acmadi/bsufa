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

// function loadData(type,parentId){
	  // // berikan kondisi sedang loading data ketika proses pengambilan data
	  // $('#loading').text('Loading '+type.replace('_','/')+' data...');
      // $.post('<?=site_url('bankmonitoring/loaddatacoa')?>', //request ke fungsi load data di inputAP
		// {data_type: type, parent_id: parentId},
		// function(data){
		  // if(data.error == undefined){ // jika respon error tidak terdefinisi maka pengambilan data sukses 
			 // $('#'+type).empty(); // kosongkan dahulu combobox yang ingin diisi datanya
			 // $('#'+type).append('<option></option>'); // buat pilihan awal pada combobox
			 // for(var x=0;x<data.length;x++){
				// // berikut adalah cara singkat untuk menambahkan element option pada tag <select>
			 	// $('#'+type).append($('<option></option>').val(data[x].id).text(data[x].nama));
			 // }
			 // $('#loading').text(''); // hilangkan text loading
		  // }else{
			 // alert(data.error); // jika ada respon error tampilkan alert
			 // //$('#combobox_customer').text('');
		  // }
		// },'json' // format respon yang diterima langsung di convert menjadi JSON 
      // );      
   // }
   
   function saveItem(index){
			//alert("test");
			var row = $('#dg').datagrid('getRows')[index];
			var url = row.isNewRecord ? '<?=site_url('bankmonitoring/savedetail')?>' : '<?=site_url('bankmonitoring/savedetail')?>/'+row.id;
			
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
				var a = $('#gl_id').val();
							//	var a = $('#dg').datagrid('selectRow', index);
				
				//alert(a);
		if (row){
				$.messager.confirm('Confirm','Are you sure you want to remove this Record?',function(r){
					if (r){
						var index = $('#dg').datagrid('getRowIndex',row);
						$.post('<?=site_url('bankmonitoring/delete')?>/'+ a,
						//{
						//id:row.id},
						function(){
							$('#dg').datagrid('deleteRow',index);
							
							var voucher = $('#voucher').val();
			// $.getJSON('<?=site_url()?>bankmonitoring/lempar/'+ voucher,
			// function(lempar){
			// $('#totald').val(lempar.debet);
			// $('#totalc').val(lempar.credit);
			// });
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

		$('.calculate').bind('keyup keypress',function(){
			var rep_coma = new RegExp(",", "g");
			$(this).val(numToCurr($(this).val()));			
			//var amount = parseInt($('#amount').val().replace(rep_coma,""));
			});	
		
		
		$('#cc').combogrid({  
        panelWidth:450,  
        value:'006',  
       
        idField:'kodecash',  
        textField:'kodecash',  
        url:'bankmonitoring/cashflow',  
        columns:[[  
            {field:'kodecash',title:'kodecash',width:100},  
            {field:'nama',title:'nama',width:200},  

        ]]  
    });  
	
		$('#dd').combogrid({  
        panelWidth:450,  
        value:'006',  
       
        idField:'kodebank',  
        textField:'namabank',  
        url:'bankmonitoring/bank',  
        columns:[[  
			{field:'kodebank',title:'Kode Bank',width:100},  
            {field:'namabank',title:'Nama Bank',width:100},  
            {field:'nomorrek',title:'Rekening',width:200},  

        ]]  
    });  $(function(){
 
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


	 
	 		$('#dg').datagrid({
				view: detailview,
				detailFormatter:function(index,row){
					return '<div class="ddv"></div>';
				},
				onExpandRow: function(index,row){
					var ddv = $(this).datagrid('getRowDetail',index).find('div.ddv');
					var des   = $("#voucher").val();
					var rem   = $("#remark").val();
					ddv.panel({
						border:false,
						cache:true,
						//href:"<?=site_url('bankmonitoring/show_form')?>/"+des+"/"+rem+"/?index="+index,
					
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
				//
				//refreshTable();
				//$('#buttonID').click();
			}
		});		
});  	 
	
	

		// $(function(){
			// $('#dg').edatagrid({
				// url: "<?=site_url('bankmonitoring/cekdata/'.$data->id_cash.'')?>",
				// //url: "<?=site_url('bankmonitoring/cekdata')?>",
				// saveUrl: "<?=site_url('bankmonitoring/savedetail/'.$nocb)?>",
				// updateUrl: "<?=site_url('bankmonitoring/save')?>",
				// destroyUrl: "<?=site_url('bankmonitoring/delete')?>"
			// });
		// });
		
</script>
</head>
<form id="formAdd" method="post" action="<?=site_url('cb/bankmonitoring/approve/'.$data->id_cash.'')?>">
<body>

	<table>
	<tr>
	<td colspan="6">
	<h2>BANK IN</h2>		
	</td>
	</tr>
	<tr>
	<tr>
		<td>Voucher</td>
			<td>:</td>
			<td><input type="text" name="voucher" id="voucher" class="validate[required] xinput" xinput" value="<?=@$data->voucher?>" style="width:150px;background-color:#EFFC94" readonly="true" size="30" /></td>
			<td>Bank</td>
			<td>:</td>
			<td><input type="text" name="bank" id="bank" class="validate[required] xinput" xinput" value="<?=@$data->bank_nm?>" style="width:177px;background-color:#EFFC94" readonly="true" size="30" /></td>
	</tr>
	<tr>
		<td>Date</td>
			<td>:</td>
			<td><input type="text" name="tgl" id="tgl" class="validate[required] xinput" xinput" value="<?=@$data->trans_date?>"  style="width:100px;background-color:#EFFC94" readonly="true" size="30" /></td>
			<td>Paid</td>			
			<td>:</td>
			<td><input type="text" name="paid" id="paid" class="validate[required] xinput" xinput" value="<?=@$data->paidby?>" style="width:100px;background-color:#EFFC94" readonly="true" size="30" /></td>
	</tr>
	<tr>	
			<td>No Cheque</td>			
			<td>:</td>
			<td><input type="text" name="cheque" id="cheque" class="validate[required] xinput" xinput" value="<?=@$data->slipno?>" style="width:100px;background-color:#EFFC94" readonly="true"size="30" /></td>
			<td>Amount</td>			
			<td>:</td>
			<td><input type="text" class="calculate input validate[required]" name="amount" id="amount"  value="<?=(@$data->base_amount)?>"  style="width:100px;background-color:#EFFC94" readonly="true" size="30" /></td>
	</tr>
	<tr>
	<td>Terima Dari</td>
			<td>:</td>
			<td><input type="text" name="terima" id="terima" class="validate[required] xinput" xinput" value="<?=@$data->from?>" style="width:180px;background-color:#EFFC94" readonly="true"  size="30" /></td>
			
		<td>Remark</td>
			<td>:</td>
			<td><input type="text" name="remark" id="remark" class="validate[required] xinput" xinput" value="<?=@$data->descs?>" style="width:230px;background-color:#EFFC94" readonly="true"  size="30" /></td>
			
			
	</tr>
	</table>
	<!--GRID TABLE -->
<div class="easyui-tabs" style="width:1000px;height:300px;">
	<div title="Add Jurnal Bank" style="padding:10px;">	
		<table id="dg" title="Jurnal Bank" style="width:980px;height:250px"
				url="<?=site_url('bankmonitoring/get_dg')?>/<?=$data->voucher?>"
				toolbar="#toolbar" pagination="true"
				fitColumns="true" singleSelect="true">
			<thead>
				<tr>
					<th field="acc_no" width="100px">Account No</th>
					<th field="acc_name" width="180px">Account Name</th>
					<th field="sub_ledger" width="180px" >Sub Ledger</th>
					<th field="line_desc" width="180px" >Desc</th>							
					<th field="amount" width="100px" editor="text">Debet</th>
					
				</tr>
			</thead>
		</table>
		<div id="toolbar">
			<!--<a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newItem()">Add</a>
			<a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyItem()">Delete</a>-->
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
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	
			
			
			</td>
			<td colspan='3'></td>
			<td colspan='3'>Balance&nbsp;&nbsp;</td>
			<td colspan='3'><input type="text" align="right" name="totald" id="totald"   value="<?=number_format(@$data->amt_base)?>" style="width:150px;background-color:#EFFC94;text-align:right" readonly="true" size="80" /></td>
		</tr>
			
		</div>
	
	<br>
		<tr>
			<td colspan='3'><input type="submit" name="save" value="Approved"/></td>
			<td colspan='3'><input type="reset" name="cancel" value="Cancel"/></td>
		</tr>
		</form>
</body>
</html>
