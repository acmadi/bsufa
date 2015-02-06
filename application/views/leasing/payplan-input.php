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
      // $.post('<?=site_url('apinvoice/loaddatacoa')?>', //request ke fungsi load data di inputAP
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
			var url = row.isNewRecord ? '<?=site_url('payplan/saveitem')?>' : '<?=site_url('payplan/saveitem')?>/'+row.id;
			
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
			// var voucher = $('#doc_no').val();
			// $.getJSON('<?=site_url()?>apinvoice/lempar/'+ voucher,
			// function(lempar){
			// $('#totald').val(lempar.debet);
			// $('#totalc').val(lempar.credit);
			// $('#doc_ref').val(lempar.doc_no);
			// //$('#amount').val(lempar.amo);
			// });
			
			// $.getJSON('<?=site_url()?>apinvoice/lemparap/'+ voucher,
			// function(lemparap){
			

			// $('#amount').val(lemparap.credit);
			// });
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
		
		function newItem(){
		
		var remark = $('#remark').val();
		
			if (remark == ''){
			alert('Please Full Fill Description');
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
		
	$(function(){		
	
	$.fn.datebox.defaults.formatter = function(date) {
			var y = date.getFullYear();
			var m = date.getMonth() + 1;
			var d = date.getDate();
			return (d < 10 ? '0' + d : d) + '-' + (m < 10 ? '0' + m : m) + '-' + y;
		};	
		
		$('#inv_date').datebox({  
                                                required:true  
                                });
		$('#receipt_date').datebox({  
                                                required:true  
								});
		$('#due_date').datebox({  
                                                required:true  
								});
												
	var rep_coma = new RegExp(",", "g");
	$("#pph").change(function(){
	
			$(this).val(numToCurr($(this).val()));
			
				if($("#jns").val()==""){
			
				if($("#pph option:selected").val()==6){
					var amount2 = parseInt($('#amount').val().replace(rep_coma,""));
					var nett2 = (amount2*50)/100;
					var pph2= (nett2 * 6)/100;
					$('#pphamount').val(numToCurr(pph2));
				}else if($("#pph option:selected").val()==7){
					var amount2 = parseInt($('#amount').val().replace(rep_coma,""));
					var nett2 = (amount2*50)/100;
					var pph2 = nett2 * 0.1;
					$('#pphamount').val(numToCurr(pph2));
					}else if($("#pph option:selected").val()==3){
					var amount2 = parseInt($('#amount').val().replace(rep_coma,""));
					var nett2 = (amount2*50)/100;
					var pph2= (nett2 * 2)/100;
					$('#pphamount').val(numToCurr(pph2));
					}else if($("#pph option:selected").val()==4){
					var amount2 = parseInt($('#amount').val().replace(rep_coma,""));
					var nett2 = (amount2*50)/100;
					var pph2= (nett2 * 3)/100;
					$('#pphamount').val(numToCurr(pph2));
					}else if($("#pph option:selected").val()==5){
					var amount2 = parseInt($('#amount').val().replace(rep_coma,""));
					var nett2 = (amount2*50)/100;
					var pph2= (nett2 * 4)/100;
					$('#pphamount').val(numToCurr(pph2));
					}else if($("#pph option:selected").val()==8){
					var amount2 = parseInt($('#amount').val().replace(rep_coma,""));
					var nett2 = (amount2*50)/100;
					var pph2= (nett2 * 5)/100;
					$('#pphamount').val(numToCurr(pph2));
					}		
						else {
							var amount2 = parseInt($('#amount').val().replace(rep_coma,""));
					var nett2 = (amount2*50)/100;
					var pph2 = nett2 * 0;
					$('#pphamount').val(numToCurr(pph2));
						}
				}else {
				if($("#pph option:selected").val()==6){
					var amount2 = parseInt($('#amount').val().replace(rep_coma,""));
					var nett2 = amount2/1.1
					var pph2= (nett2 * 6)/100;
					$('#pphamount').val(numToCurr(pph2));
				}else if($("#pph option:selected").val()==7){
					var amount2 = parseInt($('#amount').val().replace(rep_coma,""));
					var nett2 = amount2/1.1
					var pph2 = nett2 * 0.1;
					$('#pphamount').val(numToCurr(pph2));
					}else if($("#pph option:selected").val()==3){
					var amount2 = parseInt($('#amount').val().replace(rep_coma,""));
					var nett2 = amount2/1.1
					var pph2= (nett2 * 2)/100;
					$('#pphamount').val(numToCurr(pph2));
					}else if($("#pph option:selected").val()==4){
					var amount2 = parseInt($('#amount').val().replace(rep_coma,""));
					var nett2 = amount2/1.1
					var pph2= (nett2 * 3)/100;
					$('#pphamount').val(numToCurr(pph2));
					}else if($("#pph option:selected").val()==5){
					var amount2 = parseInt($('#amount').val().replace(rep_coma,""));
					var nett2 = amount2/1.1
					var pph2= (nett2 * 4)/100;
					$('#pphamount').val(numToCurr(pph2));
					}else if($("#pph option:selected").val()==8){
					var amount2 = parseInt($('#amount').val().replace(rep_coma,""));
					var nett2 = amount2/1.1
					var pph2= (nett2 * 5)/100;
					$('#pphamount').val(numToCurr(pph2));
					}		
						else {
							var amount2 = parseInt($('#amount').val().replace(rep_coma,""));
					var nett2 = amount2/1.1
					var pph2 = nett2 * 0;
					$('#pphamount').val(numToCurr(pph2));
						}
					}
						
		});	
		});	
		var rep_coma = new RegExp(",", "g");
		$('.calculate').bind('keyup keypress',function(){
			
			$(this).val(numToCurr($(this).val()));
			
			var amount = parseInt($('#amount').val().replace(rep_coma,""));
			var nett = amount/1.1
			var ppn = nett * 0.1;
		
			$('#ppn').val(numToCurr(ppn));

		});	
		
		$("#vendor").change(function(){
	//alert('tes');
			$.getJSON('<?=site_url()?>/apinvoice/jnsusaha/' + $(this).val(),
			function(jnsusaha){				
				$('#jns').val(jnsusaha.jns_usaha);	
			});
		});	
		
 $(function(){
 
	
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
					var amo   = $("#amount").val();
					ddv.panel({
						border:false,
						cache:true,
						//href:"<?=site_url('apinvoice/show_manual')?>/"+xref+"/"+amo+"/?index="+index,
						href:"<?=site_url('payplan/show_manual')?>/"+xref+"/"+"/?index="+index,
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

<form method="post" action="<?=site_url('payplan/SimpanHeader')?>" id="formAdd">
<body>	
	<table>
	
	<tr>
		<td>CODE</td>
			<td>:</td>
			<td><input type="text" name="kode" id="kode"  class="validate[required] xinput" xinput"  value="<?=$no_pp?>"  class="validate[required]" style="width:180px;background-color:#EFFC94" readonly="true" size="30" />
			
			

	</tr>

	
	<tr>
		<td>Description</td>
			<td>:</td>
			<td><input "text " name="remark" id="remark" class="validate[required] xinput" xinput" value="<?=@$data->descs?>"  size="65" /></td>		
			
			</tr>
			
	
	
	</table>	
	<!-- GRID TABLE -->
<div class="easyui-tabs" style="width:1000px;height:300px;">
	<div title="Term Payment Plan" style="padding:10px;">	
		<table id="dg" title="Payment Plan" style="width:980px;height:250px"
				url="<?=site_url('payplan/get_dg')?>"
				toolbar="#toolbar" pagination="true"
				fitColumns="true" singleSelect="true">
			<thead>
				<tr>
					<th field="trxtype" width="180px">Term Payment</th>
					<th field="descs" width="180px">Description</th>
					<th field="freq" width="130px" >Freq</th>
					<th field="intvl" width="130px" >Interval</th>	
					<th field="intvl_type" width="100px" >Base</th>
					<th field="persen" width="100px" editor="text">%</th>
					<th field="fix_amount" width="100px" editor="text">Amount</th>
					</tr>
			</thead>
		</table>
		<div id="toolbar">
			<a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newItem()">Add</a>
			<a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyItem()">Delete</a>
		</div>
	</div>	
</div>	

		<tr>
	<input type="submit" name="save" value="Save"/>
	<input type="reset" name="cancel" value="Cancel"/>
	</tr>

			
</body>
</form>


