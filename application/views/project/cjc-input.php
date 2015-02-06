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
			var ppn = amount * 0.1;
			var dp = amount * 0.2;
			var nett = amount - pph - ppn - dp;
			var blc_dp = dp_amount - dp;

			$('#ppn').val(numToCurr(ppn));
			$("#dp").val(numToCurr(dp));
			$("#nett").val(numToCurr(nett));
			$("#blc_dp").val(numToCurr(blc_dp));
		});	
		
			$('#dg').datagrid({
				view: detailview,
				detailFormatter:function(index,row){
					return '<div class="ddv"></div>';
				},
				onExpandRow: function(index,row){
					var ddv = $(this).datagrid('getRowDetail',index).find('div.ddv');
					var xref   = $("#no_prop").val();
					ddv.panel({
						border:false,
						cache:true,
						href:"<?=site_url('cjc/show_form')?>/"+xref+"/?index="+index,
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
</script>

<?php
$attr = array('class' => 'block-content form', 'id' => 'formAdd');
echo form_open(site_url('cjc/save'), $attr);
?>
<div class="easyui-tabs" style="width:700px;height:300px;">
	<div title="Contract" style="padding:10px;">
		<label for="name">Date</label><input type="text" name="tgl" value="<?=gettgl();?>" readonly="true"/><br/>
		<label for="name">Contract.No</label>
			<select name="idkontrak" id="idkontrak">
					<option></option>
				<?php foreach($kontrak as $row):?>
					<option value="<?=$row->id_kontrak?>"><?=$row->no_kontrak?></option>
				<?php endforeach; ?>
			</select><br/> 		 
		<label for="name">Contract.Nm</label><input type="text" name="vendor_nm" id="vendor_nm" readonly="true"/><br/> 		 
		<label for="name">Contract Amount</label><input type="text" name="contramount" id="contramount" class="input" readonly="true"/><br/> 		 
		<label for="name">DP Amount</label><input type="text" name="dp_amount" id="dp_amount" class="input" readonly="true"/><br/> 		 
		<label for="name">Job</label><input type="text" name="job" id="job" readonly="true"/><br/> 		 
		<label for="name">Prev.Progress</label><input type="text" name="progamount" id="progamount" class="input" readonly="true"/>%<br/> 		 
		<label for="name">Prev.Paid</label><input type="text" name="paidprogamount" id="paidprogamount" class="input" readonly="true"/><br/> 		 
		<label for="name">Remarks</label><textarea name="remarks" id="remarks"></textarea>	<br/> 
	</div>
	
	<div title="Certified Job To Complish" style="padding:10px;">
		<label for="name">CJC No</label><input type="text" name="no_cjc" value="<?=$cjc_no->no_cjc?>" id="no_cjc" readonly="true" style="width:150px"/><br/> 		 
		<label for="name">Prop.Progress</label><input type="text" name="prop_progress" class="input" style="width:60px" id="prop_progress"/>%<br/> 		 
		<label for="name">Payment Claim</label><input type="text" name="amount" class="input calculate" id="amount"/><br/> 		 
		<label for="name">PPN 10%</label><input type="text" name="ppn" id="ppn" readonly="true" readonly="true"/><br/> 		 
		<label for="name">PPH</label><input type="text" name="pph" id="pph" readonly="true"/><br/> 		 
		<label for="name">DP</label><input type="text" name="dp" id="dp" readonly="true"/><br/> 		 
		<label for="name">Payment Nett</label><input type="text" name="nett" id="nett" readonly="true"/><br/> 		 
		<label for="name">Balanced DP</label><input type="text" name="blc_dp" id="blc_dp" readonly="true"/><br/> 		 		 
	</div>
	<div title="Detail Job" style="padding:10px;">
		<table id="dg" title="Input Contractor" style="width:800px;height:250px"
				url="<?=site_url('cjc/get_dg')?>/x"
				toolbar="#toolbar" pagination="true"
				fitColumns="true" singleSelect="true">
			<thead>
				<tr>
					<th field="jobdet" width="100px"  >Detail Job</th>				
					<th field="proj_id" width="130px" >Amount</th>				
					<th field="codebgt" width="120px">Progres %</th>
					<th field="totalbgt" width="80px"  editor="text">Nilai Progress</th>
					<th field="totalprop" width="80px" editor="text">Prev %</th>
					<th field="xblc" width="110px" editor="text">YTD %</th>
					<th field="amount" width="80px" editor="text">Balance %</th>
				</tr>
			</thead>
		</table>
		<div id="toolbar">
			<a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newItem()">Add</a>
			<a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyItem()">Delete</a>
		</div>	
	</div>
</div>

       <input type="submit" value="Save" /> <input type="reset" value="Cancel" />

<?=form_close()?>
