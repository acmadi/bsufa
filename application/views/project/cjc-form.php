<?=link_tag(CSS_PATH.'easyui.css')?>
<?=link_tag(CSS_PATH.'icon.css')?>
<?=link_tag(CSS_PATH.'demo.css')?>
<?#=script('jquery-1.7.2.min.js')?>
<?=script('jquery.easyui.min.js')?>
<?=script('datagrid-detailview.js')?>
<?=script('currency.js')?>	
<?=script('jquery.formx.js')?>

<?=link_tag(CSS_PATH.'menuform.css')?>

<script type="text/javascript">
$(function(){
	var rep_coma = new RegExp(",", "g");
	$("#idkontrak").change(function(){
		$.getJSON("<?=site_url()?>cjc/getdata/"+$(this).val(),
			function(data){
				$("#contramount").val(numToCurr(data.contract_amount));
				$("#job").val(data.job);
				$("#progamount").val(0);
				//$("#prop_progress").val(data.progress_amount);
				$("#vendor_nm").val(data.nm_supplier);
				$("#paidprogamount").val("1,000,000");
				$("#dp_amount").val(numToCurr(data.dp_amount));
				var amount =  parseInt($('#amount').val().replace(rep_coma,""));
				var pph = amount * (data.pph_amount/100)
				$("#pph").val(numToCurr(pph));
			});
		});
	
		$('.calculate').bind('keyup keypress',function(){
			$(this).val(numToCurr($(this).val()));
			
			var amount = parseInt($('#amount').val().replace(rep_coma,""));
			var pph = parseInt($('#pph').val().replace(rep_coma,""));
			var dp_amount = parseInt($('#dp_amount').val().replace(rep_coma,""));
			var paidprogamount = parseInt($("#paidprogamount").val().replace(rep_coma,""));
			var ppn = amount * 0.1;
			var dp = amount * 0.2;
			var nett = amount - pph - ppn - dp;
			var blc_dp = dp_amount - dp;
			var pph_amount = amount * (pph/100);

			var contramount = parseInt($('#contramount').val().replace(rep_coma,""));
			var total = contramount - paidprogamount;
			
			if(amount > total) {
				alert("Jumlah lebih besar dari kontrak");
				$("#amount").val(0);
				$('#ppn').val(0);
				$("#nett").val(0);
				$("#blc_dp").val(0);
				$("#pph_amount").val(0);
				$("#dp").val(0);
			}else{
				$('#ppn').val(numToCurr(ppn));
				$("#dp").val(numToCurr(dp));
				$("#nett").val(numToCurr(nett));
				$("#blc_dp").val(numToCurr(blc_dp));
				$("#pph_amount").val(numToCurr(pph_amount));
			}

		});	
		
			$('#dg').datagrid({
				view: detailview,
				detailFormatter:function(index,row){
					return '<div class="ddv"></div>';
				},
				onExpandRow: function(index,row){
					var ddv = $(this).datagrid('getRowDetail',index).find('div.ddv');
					var xref   = $("#no_cjc").val();
					ddv.panel({
						border:false,
						cache:true,
						href:"<?=site_url('cjc/show_cjc')?>/"+xref+"/?index="+index,
						onLoad:function(){
							$('#dg').datagrid('fixDetailRowHeight',index);
							$('#dg').datagrid('selectRow',index);
							$('#dg').datagrid('getRowDetail',index).find('form').form('load',row);
						}
					});
					$('#dg').datagrid('fixDetailRowHeight',index);
				}
			});

		$("#idkontrak").change(function(){
		});


		$("#prop_progress").change(function(){
			var progamount = parseInt($("#progamount").val());
			var prop_progress = parseInt($("#prop_progress").val());
			var total = 100 - progamount;
			//alert(prop_progress);
			//alert(prop_progress);
			if(prop_progress > total){
				alert("Proposed Terlalu besar");
				$("#prop_progress").val(0);
			}
			
		});
		
		/*$("#amount").change(function(){
			var contramount = parseInt($("#contramount").val().replace(rep_coma,""));
			var paidprogamount = parseInt($("#paidprogamount").val().replace(rep_coma,""));
			var amount = parseInt($("#amount").val().replace(rep_coma,""));
	 
			var total = contramount - amount;
			
			if(amount > total){
				alert("Jumlah bayar lebih besar");
				$("#prop_progress").val(0);
				$("#amount").val(0);
			}
		});*/
		/*$('#formAdd')
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
		});	*/					
});


		function saveItem(index){
			var row = $('#dg').datagrid('getRows')[index];
			var url = row.isNewRecord ? '<?=site_url('cjc/save_dg')?>' : '<?=site_url('cjc/save_dg')?>/'+row.id;
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


</script>

<?php
$attr = array('class' => 'block-content form', 'id' => 'formAdd');
echo form_open(site_url('cjc/saveapp'), $attr);
$blc_dp = $prop->blc_dp - $data->balanced_dp;
?>
<div class="easyui-tabs" style="width:700px;height:300px;">
	<div title="Contract" style="padding:10px;">
		<label for="name">Date</label><input type="text" name="tgl" value="<?=gettgl();?>" readonly="true"/><br/>
		<label for="name">Contract.No</label><input type="text" name="nokontrak" id="nokontrak" value="<?=$data->no_kontrak?>" readonly="true"/><br/> 		 
		<label for="name">Contr. Nm</label><input type="text" name="vendor_nm" id="vendor_nm" value="<?=$data->nm_supplier?>" readonly="true"/><br/> 		 
		<label for="name">Contr. Amount</label><input type="text" name="contramount" id="contramount" class="input" value="<?=number_format($data->contract_amount)?>" readonly="true"/><br/> 		 
		<label for="name">DP Amount</label><input type="text" name="dp_amount" id="dp_amount" class="input" readonly="true" value="<?=number_format($data->dp_amount)?>"/><br/> 		 
		<label for="name">Job</label><input type="text" name="job" id="job" value="<?=$data->mainjob_desc?>" readonly="true"/><br/> 		 
		<label for="name">Prev.Progress</label><input type="text" name="progamount" id="progamount" value="<?=number_format($prop->prop_am)?>" class="input" readonly="true"/>%<br/> 		 
		<label for="name">Prev.Paid</label><input type="text" name="paidprogamount" id="paidprogamount" value="<?=number_format($prop->prop_amount)?>" class="input" readonly="true"/><br/> 		 
		<label for="name">Prev.DP</label><input type="text" name="paid_dp" id="paid_dp" value="<?=number_format($prop->blc_dp)?>" class="input" readonly="true"/><br/> 		 
		<label for="name">Remarks</label><input type="text" name="remarks" value="<?=$data->remark?>" id="remarks" readonly="true"></input><br/> 
	</div>
	    
		<input type="hidden" value="<?=$data->pph?>" id="pph" name="pph"/>
		<input type="hidden" value="<?=$data->id_kontrak?>" id="id_kontrak" name="id_kontrak"/>
		<input type="hidden" value="<?=$data->id_cjc?>" id="id_cjc" name="id_cjc"/>
	<div title="Certified Job To Complish" style="padding:10px;">
		<!--label for="name">CJC No</label--><input type="hidden" name="no_cjc" value="<?=$cjc_no->no_cjc?>" id="no_cjc" readonly="true" style="width:230px"/><br/> 		 
		<label for="name">Prop.Progress</label><input type="text" name="prop_progress"  value="<?=$data->proposed_progress?>" readonly="true" class="input" style="width:60px" id="prop_progress"/>%<br/> 		 
		<label for="name">Payment Claim</label><input type="text" name="amount" readonly="true" value="<?=number_format($data->claim_amount)?>" class="input calculate" id="amount"/><br/> 		 
		<label for="name">PPN 10%</label><input type="text" class="input" name="ppn" id="ppn" readonly="true" value="<?=number_format($ppn_amount)?>" readonly="true"/><br/> 		 
		<label for="name">PPH</label><input type="text" class="input" name="pph_amount" id="pph_amount" value="<?=number_format($pph_amount)?>" readonly="true"/><br/> 		 
		<label for="name">DP</label><input type="text" class="input" name="dp" id="dp" value="<?=number_format($data->balanced_dp)?>" readonly="true"/><br/> 		 
		<label for="name">Payment Nett</label><input type="text" class="input" name="nett" id="nett" value="<?=number_format($data->proposed_amount)?>" readonly="true"/><br/> 		 
		<label for="name">Balanced DP</label><input type="text" class="input" name="blc_dp" id="blc_dp" readonly="true" value="<?=number_format($blc_dp)?>"/><br/> 		 		 
	</div>
	<div title="Detail Job" style="padding:10px;">
		<table id="dg" title="Input Contractor" style="width:800px;height:250px"
				url="<?=site_url('cjc/get_dg')?>/<?=$data->no_trbgtproj?>"
				toolbar="#toolbar" pagination="true"
				fitColumns="true" singleSelect="true">
			<thead>
				<tr>
					<th field="jobdet" width="100px"  >Detail Job</th>				
					<th field="amount" width="110px" >Amount</th>				
					<th field="progres" width="80px">Progres %</th>
					<th field="nil_prog" width="110px"  editor="text">Nilai Progress</th>
					<th field="prev" width="80px" editor="text">Prev %</th>
					<th field="ytd" width="80px" editor="text">YTD %</th>
					<th field="balance" width="80px" editor="text">Balance %</th>
					<th field="balance_nilai" width="110px" editor="text">Nilai Balance</th>
				</tr>
			</thead>
		</table>
	</div>
</div>

<?=form_close()?>
