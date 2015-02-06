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
	
	$(document).ready(function(){
					
					$('#sh1').hide();
					$('#sh2').hide();
					$('#sh3').hide();
					$('#sh4').hide();
					$('#sh5').hide();
					$('#sh6').hide();
					$('#sh7').hide();
					$('#sh8').hide();
					$('#sh9').hide();
					$('#sh10').hide();
					$('#sh11').hide();
					$('#sh12').hide();
					$('#sh13').hide();
					$('#sh14').hide();
					$('#sh15').hide();
					$('#detprog').hide();

					//$("#payment").val(0);
					var contramount = parseInt($('#contramount').val().replace(rep_coma,""));
					var paidprogamount = parseInt($('#paidprogamount').val().replace(rep_coma,""));
					var os = contramount - paidprogamount;
					
					$("#blc_os").val(numToCurr(os));
					 
					
								
			});					
	
	
	
	var rep_coma = new RegExp(",", "g");
		
	
		$("#paystat").change(function(){
			if($('#paystat option:selected').val() == '1'){
					//var amount = parseInt($('#amount').val().replace(rep_coma,""));
					var pph = parseInt($('#pph').val().replace(rep_coma,""));
					var propamount = parseInt($('#paidprogamount').val().replace(rep_coma,""));
					var contramount = parseInt($('#contramount').val().replace(rep_coma,""));
					var total = contramount - paidprogamount;
					var contr = parseInt($('#contramount').val().replace(rep_coma,""));
					//var paiddp = parseInt($('#paid_dp').val().replace(rep_coma,""));
					var persendp = parseInt($('#dpay').val().replace(rep_coma,""));
					
					
					
					var amountdp 	= contr * (persendp/100);
					var dpppn	  	= contr - (contr/1.1);
					var pph_amount 	= (contr - dpppn) * (pph/100);
					var nett_dp		= amountdp - dpppn - pph_amount;
					var n_ppndp		= payment + (payment/1.1);
					//var osdp		= amountdp - paiddp;
					//alert(amountdp)
					//alert(propamount);
					//alert(amountdp);
					if (propamount < amountdp){
						alert("Silahkan melanjutkan Pembayaran DP");
					
					
					
					
						$('#sh1').hide();
						$('#sh2').hide();
						$('#sh3').hide();
						$('#sh4').hide();
						$('#sh5').hide();
						$('#sh6').hide();
						$('#sh7').hide();
						
						
						$('#sh8').show();
						$('#sh9').show();
						$('#sh10').show();
						$('#sh11').show();
						
						$('#sh12').hide();
						$('#sh13').hide();
						$('#sh14').hide();
						$('#sh15').hide();
						
						$(this).val(numToCurr($(this).val()));
							$('#payment').val(numToCurr(amountdp));
							
							
							
							$('#dpppn').val(numToCurr(dpppn));
							$('#dppph').val(numToCurr(pph_amount));
							$('#nettdp').val(numToCurr(nett_dp));
							$('#osdp').val(numToCurr(osdp));
							//$('#prevprog').val(numToCurr(prevprog));
							//$('#amount').val(numToCurr(amount));
									$('#payment').bind('keyup keypress',function(){
											
											//alert(blcdp);
											//alert(amountdp);
											$(this).val(numToCurr($(this).val()));
											var payment = parseInt($('#payment').val().replace(rep_coma,""));
											var pphdpvar = parseInt($('#pph').val().replace(rep_coma,""));
											var n_ppndp = parseInt($('#n_ppndp').val().replace(rep_coma,""));
											
											//var fulldp 	= payment + paiddp;
											var n_ppndp = payment - (payment/1.1);
											//var n_blcdp = amountdp - (payment + paiddp);
											
											
											var paydp_netppn = payment - n_ppndp ;
											var n_pphdp = paydp_netppn * (pphdpvar/100);
											
											var paynetdp	= payment - n_pphdp;
											
											if(fulldp > amountdp) {
												alert("Jumlah pengajuan lebih besar dari DP");
												$("#n_ppndp").val(0);
												$('#n_pphdp').val(0);
												$("#n_blcdp").val(0);
												$("#payment").val(0);
												$("#paynetdp").val(0);
												
											}else{
												//$("#n_blcdp").val(paydp);
												$('#n_ppndp').val(numToCurr(n_ppndp));
												$("#n_pphdp").val(numToCurr(n_pphdp));
												$("#n_blcdp").val(numToCurr(n_blcdp));
												$("#payment").val(numToCurr(payment));
												$("#paynetdp").val(numToCurr(paynetdp));
												
												
											}
											
									})	
							
							
					}else { alert('Pembayaran DP telah 100%');}		
					
			}
			else if($('#paystat option:selected').val() == '2'){
						
						var propamount = parseInt($('#paidprogamount').val().replace(rep_coma,""));
						var contr = parseInt($('#contramount').val().replace(rep_coma,""));
						var progprev = parseInt($('#progprev').val().replace(rep_coma,""));
						//var blcdp = parseInt($('#paid_dp').val().replace(rep_coma,""));
						var oscon = parseInt($('#blc_os').val().replace(rep_coma,""));
						var amountdp 	= contr * 0.2;
						
						$('#oscon').val(numToCurr(oscon));
						
						
						if (progprev < 100 ){
								alert("Silahkan melanjutkan Pembayaran Progress");
						
							$('#sh8').hide();
							$('#sh9').hide();
							$('#sh10').hide();
							$('#sh11').hide();
							
							$('#sh12').hide();
							$('#sh13').hide();
							$('#sh14').hide();
							$('#sh15').hide();
						
							$('#sh1').show();
							$('#sh2').show();
							$('#sh3').show();
							$('#sh4').show();
							$('#sh5').show();
							$('#detprog').show();
				
									$('#progclaim').bind('keyup keypress',function(){
										//alert('tes');
										
										$(this).val(numToCurr($(this).val()));
											
											
										    var claimprog = parseInt($('#progclaim').val().replace(rep_coma,""));
											var prog 	= parseInt($('#progamount').val().replace(rep_coma,""));
											var batasprog		= claimprog + prog;
											var retensi 		= contr * 0.05;
											var pphdpvar 	  = parseInt($('#pph').val().replace(rep_coma,""));
											
											
											var prog_amount 	= contr * (claimprog/100); 
											
											var kurang_dp		= amountdp * (claimprog/100);
											
											var	kurang_retensi 	= retensi * (claimprog/100); 		
											
											var payprogclaim 	= (prog_amount - kurang_dp) - kurang_retensi;
											
											var ppnprog		= payprogclaim - (payprogclaim/1.1);
											var pphprog		= (payprogclaim - ppnprog) * (pphdpvar/100);
											
											var oscontr		= oscon - payprogclaim;
											var paynet		= payprogclaim - pphprog;
											
											//alert(prog_amount);
											
											if(batasprog <= 100){
												$("#payprogclaim").val(numToCurr(payprogclaim));
												$('#ppnprog').val(numToCurr(ppnprog));
												$("#pphprog").val(numToCurr(pphprog));
												$("#oscontr").val(numToCurr(oscontr));
												$("#deductdp").val(numToCurr(kurang_dp));
												$("#deductretensi").val(numToCurr(kurang_retensi));
												$("#paynet").val(numToCurr(paynet));
																							
											}else{
												alert('Melampaui Progress 100%');
												$("#payprogclaim").val(0);
										
											}
									})
									
									
									
									
									
							}
							else { alert('Pembayaran Progress telah 100%');}
				}
			
			else if($('#paystat option:selected').val() == '3'){
				
					
					var propamount = parseInt($('#paidprogamount').val().replace(rep_coma,""));
					var contramount = parseInt($('#contramount').val().replace(rep_coma,""));
					var contr = parseInt($('#contramount').val().replace(rep_coma,""));
					var pphdpvar 	  = parseInt($('#pph').val().replace(rep_coma,""));
					var amountdp 	= contr * 0.2;
					var progpaid	= contr * 0.95;
					
									
					var retensi = contramount * 0.05; 	
					var batas = contr - progpaid;
					
					var n_ppnretensi = retensi - (retensi/1.1);
					var n_pphretensi = (retensi - n_ppnretensi) * (pphdpvar/100);
					
					var n_paynet = retensi - n_pphretensi;
					
					$("#n_paynet").val(numToCurr(n_paynet));
					
					//alert (batas);	
						$('#sh1').hide();
						$('#sh2').hide();
						$('#sh3').hide();
						$('#sh4').hide();
						$('#sh5').hide();
						$('#sh6').hide();
						$('#sh7').hide();
						
						
						$('#sh8').hide();
						$('#sh9').hide();
						$('#sh10').hide();
						$('#sh11').hide();
						
						$('#sh12').show();
						$('#sh13').show();
						$('#sh14').hide();
						$('#sh15').hide();

					
					
					//alert(propamount);
					//alert(amountdp);
					if (retensi == batas){
						 alert("Silahkan melanjutkan Pembayaran Retensi");
						$("#retensi").val(numToCurr(retensi));
						$("#batas").val(numToCurr(batas));
						$("#n_ppnretensi").val(numToCurr(n_ppnretensi));
						$("#n_pphretensi").val(numToCurr(n_pphretensi));
					
					}
					else { alert ("Pembayaran Retensi telah 100%");} 
					
			
			}
			
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
					//var idkontrak	= $("idkontrak").val();
					//alert(nobgt);
					ddv.panel({
						border:false,
						cache:true,
						href:"<?=site_url('cjc/show_cjc')?>/"+xref+"/"+nobgt+"/?index="+index,
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
			//alert(nobgt);
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


</script>

<?php
$attr = array('class' => 'block-content form', 'id' => 'formAdd');
echo form_open(site_url('cjc/save'), $attr);
$pph 		= $data->pph;
$prevprog 	= $prop->prop_am;

$propppn = $prop->prop_ppn;
$proppph = $prop->prop_pph;
$propamount = $prop->prop_amount;
$paynet = $prop->paynet;

#$propamount = $propppn + $proppph + $paynet;
$blcdp		= $dp->paiddp;
?>
<div class="easyui-tabs" style="width:1100px;height:300px;">
	<div title="Contract" style="padding:10px;">
	<table>
		<input type="hidden" name="idkontrak" id="idkontrak"value="<?=@$data->id_kontrak?>">
		<input  type="hidden" name="nobgt" id="nobgt"value="<?=@$data->no_trbgtproj?>">
		
		<tr>
			<td><label for="name">Date</label><input type="text" name="tgl" value="<?=gettgl();?>" readonly="true"/></td>
			<td><label for="name">Contract.No</label><input type="text" name="nokontrak" id="nokontrak" value="<?=$data->no_kontrak?>" readonly="true"/></td>
		</tr> 		 
		<tr>
			<td><label for="name">Contr. Nm</label><input type="text" name="vendor_nm" id="vendor_nm" value="<?=$data->nm_supplier?>" readonly="true"/></td> 		 
			<td><label for="name">Contr. Amount</label><input type="text" name="contramount" id="contramount" class="input" value="<?=number_format($data->contract_amount)?>" readonly="true"/></td>
		</tr> 		 
		<tr>
			<td><label for="name">DP Amount</label><input type="text" name="dp_amount" id="dp_amount" class="input" readonly="true" value="<?=number_format($data->dp_amount)?>"/></td> 		 
			<td><label for="name">Job</label><input type="text" name="job" id="job" value="<?=$data->mainjob_desc?>" readonly="true"/></td>
		</tr> 		 
		<tr>
			<td><label for="name">Progress Done</label><input type="text" name="progamount" id="progamount" value="<?=number_format($prevprog)?>" class="input" readonly="true"/>%</td> 		 
			<td><label for="name">Prev.Paid</label><input type="text" name="paidprogamount" id="paidprogamount" value="<?=number_format($propamount)?>" class="input" readonly="true"/></td>
		</tr>		 
		<tr>
			<td><label for="name">Balanced.OS</label><input type="text" name="blc_os" id="blc_os" value="" class="input" readonly="true"/><br/> 		 
			
		</tr>
	</table>
	</div>    
	
	
	
		<input type="hidden" name="pph" id="pph" value="<?=$pph?>">
		<input type="hidden" value="<?=$data->id_kontrak?>" id="id_kontrak" name="id_kontrak"/>
		
	
	
	
	
	
	<div title="Certified Job To Complish" style="padding:10px;">
		<table>
		<tr>
			<td colspan="3"><input type="hidden" name="no_cjc" value="<?=$cjc_no->no_cjc?>" id="no_cjc" readonly="true" style="width:230px"/></td>		 
		</tr>
		<tr>
			<td> <label for="name">Payment Status</label>
			<select type="text" name="paystat"  id="paystat" style="width:60px">
						<option></option>
						<option value="1" align="left">DP</option>
						<option value="2" align="left">Progress</option>
						<option value="3" align="left">Retensi</option>
						</select></td> 		 
			
		</tr>
		
		
		<tr id="sh8">
			<td><label for="name">DP</label><input type="text" name="dpay"   class="input" style="width:40px" id="dpay" value="<?=@$nildp->dp?>">%</td> 
		</tr>
		<tr  id="sh9">
			<td colspan="2"><label for="name">Payment Claim</label><input type="text" name="payment" id="payment" class="input" style="width:120px" align="right" ></td> 
			
		</tr>
		<tr  id="sh10">
			<td><label for="name">Remarks</label><textarea name="remarks" id="remarks" class="validate[required]"></textarea></td>
		</tr>
		
		<tr  id="sh11">
			<td ><label for="name">Ppn</label><input type="text" name="n_ppndp"  class="input" style="width:120px" align="right" id="n_ppndp" readonly="true"></td> 
			<td><label for="name">Pph</label><input type="text" name="n_pphdp"  class="input" style="width:120px" align="right" id="n_pphdp" readonly="true"></td> 
			
		</tr>
		
		<tr id="sh12">
			<td><label for="name">Retensi</label><input type="text" name="batas" class="input" align="right" id="batas" style="width:120px" readonly="true"/></td> 		 
			<td><label for="name">Ppn</label><input type="text" name="n_ppnretensi" id="n_ppnretensi" class="input" align="right" id="batas" style="width:120px" readonly="true"/></td> 		 
			<td><label for="name">Pph</label><input type="text" name="n_pphretensi" id="n_pphretensi" class="input" readonly="true" style="width:120px"></td>		 

		</tr>
		<tr id="sh13">
			<td><label for="name">Payment Claim</label><input type="text" name="retensi" id="retensi" class="input" readonly="true" style="width:120px"></td>		 
			<td><label for="name">Payment Nett</label><input type="text" name="n_paynet" id="n_paynet" class="input" readonly="true" style="width:120px"></td>		 

		</tr>
		
			
			
			
	
		<tr  id="sh1">
			<td><label for="name">Progress Done</label><input type="text" name="progprev" id="progprev" value="<?=number_format($prevprog)?>" class="input" readonly="true" style="width:50px"/>%</td> 		 
			<td><label for="name">Prev.Paid</label><input type="text" name="paidprogamount" id="paidprogamount" value="<?=number_format($propamount)?>" class="input" readonly="true"/></td>
			<td><label for="name">Totsl O/S</label><input type="text" name="oscon" id="oscon" class="input" readonly="true"/><td> 		 
		</tr>
		<tr id="sh2">
			<td ><label for="name">Progress Claim</label><input type="text" name="progclaim"  class="input" style="width:60px" id="progclaim"/></td> 		 
			<td><label for="name">Payment Claim</label><input type="text" class="input" name="payprogclaim" id="payprogclaim" readonly="true"></td>
			<td><label for="name">Payment Nett</label><input type="text" name="paynet" id="paynet" class="input" readonly="true"/><td>
		</tr>
		<tr id="sh3">
			<td><label for="name">PPN</label><input type="text" class="input" name="ppnprog" id="ppnprog" readonly="true" readonly="true"/></td>		 
			<td><label for="name">PPH</label><input type="text" class="input" name="pphprog" id="pphprog" readonly="true"/> </td>		 
			<td><label for="name">Balanced O/S</label><input type="text" name="oscontr" id="oscontr" class="input" readonly="true"/><td>
		</tr>
		
		
		
		
		
		
		</table>		 		 		 
	</div>
	<div title="Progress Detail" style="padding:10px;" id="detprog">
		<table id="dg" title="Input Contractor" style="width:780px;height:250px"
				url="<?=site_url('cjc/get_dg')?>/<?=$data->no_trbgtproj?>"
				toolbar="#toolbar" pagination="true"
				fitColumns="true" singleSelect="true">
			<thead>
				<tr>
					
					<th field="jobdet" width="250px"  >Detail Job</th>				
					
					<th field="progres" width="40px">Progres %</th>
					
					<th field="thismon" width="40px" editor="text">This Month</th>
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
