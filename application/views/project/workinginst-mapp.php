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
	
	
	var kugiri = new RegExp(",", "g");
	
	var rep_coma = new RegExp(",", "g");
		$(".calculate").bind('keyup keypress',function(){
				$(this).val(numToCurr($(this).val()));
						parseInt($("#claim_value").val().replace(kugiri,""));
						
			});
	
	$('#claim_value').bind('keyup keypress',function(){
	
			var pph	 = $('#pph').val();
			var nilvalue = parseInt($("#claim_value").val().replace(kugiri,""));
			
			var nilppn = nilvalue- (nilvalue / 1.1);
			var nilpph = (nilvalue - nilppn) * (pph/100);
				$('#nilpph').val(numToCurr(nilpph));
				$('#nilppn').val(numToCurr(nilppn));
	
	})
	
		
			$('#dg').datagrid({
				view: detailview,
				detailFormatter:function(index,row){
					return '<div class="ddv"></div>';
				},
				onExpandRow: function(index,row){
					var ddv = $(this).datagrid('getRowDetail',index).find('div.ddv');
					var xref   = $("#no_cjc").val();
					var nobgt	= $("#nobgt").val();
					var idkontrak = $('#idkontrak').val();
					//var idkontrak	= $("idkontrak").val();
					//alert(nobgt);
					ddv.panel({
						border:false,
						cache:true,
						href:"<?=site_url('cjc/show_cjc')?>/"+xref+"/"+nobgt+"/"+idkontrak+"/?index="+index,
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
		
				
});


		function saveItem(index){
			var row = $('#dg').datagrid('getRows')[index];
			var nobgt = $('#nobgt').val();
			
			var url = row.isNewRecord ? '<?=site_url('cjc/save_dg')?>' : '<?=site_url('cjc/save_dg')?>/'+nobgt+row.id;
			
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


	/*GRID EASY-UI*/
			$('#mr').datagrid({
				view: detailview,
				detailFormatter:function(index,row){
					return '<div class="ddv"></div>';
				},
				onExpandRow: function(index,row){
					var ddv = $(this).datagrid('getRowDetail',index).find('div.ddv');
					//var spk   = $("#spk").val();
					ddv.panel({
						border:false,
						cache:true,
						//href:"<?#=site_url('workinginst/show_topspk')?>/"+spk+"/?index="+index,
						onLoad:function(){
							$('#mr').datagrid('fixDetailRowHeight',index);
							$('#mr').datagrid('selectRow',index);
							$('#mr').datagrid('getRowDetail',index).find('form').form('load',row);
						}
					});
					$('#mr').datagrid('fixDetailRowHeight',index);
				}
			});
			/*END GRID*/
			
			
	/*GRID EASY-UI*/
			$('#sp').datagrid({
				view: detailview,
				detailFormatter:function(index,row){
					return '<div class="ddv"></div>';
				},
				onExpandRow: function(index,row){
					var ddv = $(this).datagrid('getRowDetail',index).find('div.ddv');
					//var spk   = $("#spk").val();
					ddv.panel({
						border:false,
						cache:true,
						//href:"<?#=site_url('workinginst/show_topspk')?>/"+spk+"/?index="+index,
						onLoad:function(){
							$('#sp').datagrid('fixDetailRowHeight',index);
							$('#sp').datagrid('selectRow',index);
							$('#sp').datagrid('getRowDetail',index).find('form').form('load',row);
						}
					});
					$('#sp').datagrid('fixDetailRowHeight',index);
				}
			});
			/*END GRID*/

			

</script>

<?php
$attr = array('class' => 'block-content form', 'id' => 'formAdd');
echo form_open(site_url('cjc/save'), $attr);
#$pph 		= $data->pph;
#$prevprog 	= $prop->prop_am;
$blc_os = $data->contract_amount - $prevalue->nilai;
#$propppn = $prop->prop_ppn;
#$proppph = $prop->prop_pph;
#$propamount = $prop->prop_amount;
#$paynet = $prop->paynet;

#$propamount = $propppn + $proppph + $paynet;
#$blcdp		= $dp->paiddp;
?>
<div class="easyui-tabs" style="width:1000px;height:410px;">
	<div title="Contract" style="padding:10px;">
	<table>
		<input  type="hidden" name="idkontrak" id="idkontrak"value="<?=@$data->id_kontrak?>">
		<input  type="hidden" name="nobgt" id="nobgt"value="<?=@$data->no_trbgtproj?>">
		<input  type="hidden" name="nospk" id="nospk"value="<?=@$data->no_spk?>">
		<input  type="hidden" name="pph"   id="pph" value="<?=@$kontrak->pph?>"> 
		<input  type="hidden" name="nilpph"   id="nilpph" > 
		<input  type="hidden" name="nilppn"   id="nilppn" > 
		<input type="hidden" name="tgl" value="<?=gettgl();?>" readonly="true"/></td>
		<tr>
			
			<td><label for="name">Contractor</label><input type="text" name="vendor_nm" id="vendor_nm" value="<?=$data->nm_supplier?>" readonly="true" style="width:300px"/></td> 		 
			<td><label for="name">Contract.No</label><input type="text" name="nokontrak" id="nokontrak" value="<?=$data->no_kontrak?>" readonly="true"/></td>
			
		</tr> 		 
		<tr>
			<td colspan='2'><label for="name">Job</label><input type="text" name="job" id="job" value="<?=$data->mainjob_desc?>" readonly="true" style="width:600px"></td>
			
		</tr> 		 
		<tr>
			<td><label for="name">Total Contract</label><input type="text" name="contramount" id="contramount" class="input" value="<?=number_format($data->contract_amount)?>" readonly="true"/> Incl.Ppn</td>
			<td><label for="name">Previous Value</label><input type="text" name="paidprogamount" id="paidprogamount" value="<?=number_format(@$prevalue->nilai)?>" class="input" readonly="true"/>Incl.Ppn</td>	
			
			
		</tr> 		 
		<tr>
			
			<td><label for="name">Balanced </label><input type="text" name="blc_os" id="blc_os" value="<?=number_format($blc_os)?>" class="input" readonly="true"/> Incl.Ppn</td> 		 
			<td><label for="name">Progress </label><input style="width:50px"type="text" name="progamount" id="progamount" value="<?=number_format(@$progress->prog)?>" class="input" readonly="true"/>%</td> 		 
			
		</tr>		 
		<table id="mr" title="Payment Scheme" style="width:700px;height:210px"
				url="<?=site_url('workinginst/get_topspk')?>/<?=@$data->no_spk?>"
				
				toolbar="#toolbar2" pagination="true"
				fitColumns="true" singleSelect="true">
			<thead>
				<tr>
					
					<th field="top" width="25">Term Of Payment</th>
					<th field="persen" width="10" editor="numberbox" align="center">%</th>
					<th field="amount" width="25" editor="numberbox" align='right'>Value(Rp)</th>
					<th field="keterangan" width="70">Description</th>
				</tr>
			</thead>
		</table>
		
	</table>
	</div>    
	
	
	
		<input type="hidden" name="pph" id="pph" value="<?#=$pph?>">
		
		
	
	
	
	
	
	<div title="Certified Job To Complish" style="padding:10px;">
		<table>
		<tr>
			<td colspan="3"><input type="hidden" name="no_cjc" value="<?=$cjc_no->no_cjc?>" id="no_cjc" readonly="true" style="width:230px"/></td>		 
		</tr>
		
		<tr>
			<table id="sp" title="Claim Value History" style="width:700px;height:210px"
				url="<?=site_url('workinginst/get_topspk')?>/<?=@$data->no_spk?>"
				
				toolbar="#toolbar2" pagination="true"
				fitColumns="true" singleSelect="true">
			<thead>
				<tr>
					
					<th field="top" width="25">Term Of Payment</th>
					<th field="persen" width="10" editor="numberbox" align="center">%</th>
					<th field="amount" width="25" editor="numberbox" align='right'>Value(Rp)</th>
					<th field="claim" width="25" editor="numberbox" align='right'>Claim Value(Rp)</th>
					<th field="blc" width="25" editor="numberbox" align='right'>Balanced(Rp)</th>
					
				</tr>
			</thead>
		</table>
			
		</tr>
		
		<table>
		
		
		<tr>
			<td> <label for="name">Term Of Type</label>
			<select type="text" name="paystat"  id="paystat" style="width:120px">
						<option></option>
						<?foreach(@$payspk as $row):?>
						<option value="<? echo $row->id_payspk?>" align="left">
									<? $top = $row->tipe_payspk;
									if($top == 1){ $top = 'DP';}
									elseif ($top == 2){ $top = 'Progress';}
									elseif($top == 3){ $top = 'Retensi';}
									echo $top?> &nbsp;
									<? echo $row->persen?>%
						</option>
						
						<? endforeach ?>
						</select></td> 		 
			
			
		</tr>
		<tr>
			<td><label for="name">Value</label><input type="text" name="claim_value" id="claim_value" class="calculate input" style="width:120px" align="right" > Incl.PPN
		</tr>
		<tr>
			<td><u>Remark</u></td>
		</tr>
		<tr>
			<td><input name="remark" style="width:600px"></td>
		</tr>
		
		</table>	 		 		 
	</div>
	<div title="Progress Detail" style="padding:10px;" id="detprog">
		<table id="dg" title="Input Contractor" style="width:780px;height:250px"
				url="<?=site_url('cjc/get_dg')?>/<?=$data->no_trbgtproj?>/<?=@$data->id_kontrak?>"
				toolbar="#toolbar" pagination="true"
				fitColumns="true" singleSelect="true">
			<thead>
				<tr>
					
					<th field="jobdet" width="250px"  >Detail Job</th>				
					<th field="progres" width="40px">Claim %</th>
					<th field="thismon" width="40px" editor="text">Progress %</th>
					<th field="prev" width="40px" editor="text">Prev %</th>
					<th field="ytd" width="40px" editor="text">YTD %</th>
					<th field="balance" width="40px" editor="text">Balance %</th>
					
				</tr>
			</thead>
		</table>
	</div>
</div>

       <input type="submit" value="Save" /> <input type="reset" value="Cancel" />

<?=form_close()?>
