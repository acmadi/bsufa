<?=link_tag(CSS_PATH.'easyui.css')?>
<?=link_tag(CSS_PATH.'icon.css')?>
<?=link_tag(CSS_PATH.'demo.css')?>
<?=script('jquery-1.7.2.min.js')?>
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
					var paiddp = parseInt($('#paid_dp').val().replace(rep_coma,""));
					
				
					var amountdp 	= contr * 0.2;
					var dpppn	  	= amountdp * 0.1;
					var pph_amount 	= (amountdp - dpppn) * (pph/100);
					var nett_dp		= amountdp - dpppn - pph_amount;
					var n_ppndp		= payment * 0.1;
					var osdp		= amountdp - paiddp;
					//alert(amountdp)
					//alert(propamount);
					//alert(amountdp);
					if (propamount < amountdp){
						alert("Silahkan melanjutkan Pembayaran DP");
					
					//else { alert("DP belum dibayar")}
					//var dp_amount = parseInt($('#dp_amount').val().replace(rep_coma,""));
					//var paidprogamount = parseInt($("#paidprogamount").val().replace(rep_coma,""));
					//var ppn = amount * 0.1;
					//var dp = amount * 0.2;
					//var nett = amount - pph - ppn - dp;
					//var blc_dp = dp_amount - dp;
					//var pph_amount = amount * (pph/100);

					
					
					
					//var blcdp = (amountdp/contr)
					
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
						
						
							$('#dpamount').val(numToCurr(amountdp));
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
											
											var fulldp 	= payment + paiddp;
											var n_ppndp = payment * 0.1;
											var n_blcdp = paiddp - payment;
											
											
											var paydp_netppn = payment - n_ppndp ;
											var n_pphdp = paydp_netppn * (pphdpvar/100);
											
											
											if(fulldp > amountdp) {
												alert("Jumlah pengajuan lebih besar dari DP");
												$("#n_ppndp").val(0);
												$('#n_pphdp').val(0);
												$("#n_blcdp").val(0);
												$("#payment").val(0);
												
											}else{
												//$("#n_blcdp").val(paydp);
												$('#n_ppndp').val(numToCurr(n_ppndp));
												$("#n_pphdp").val(numToCurr(n_pphdp));
												$("#n_blcdp").val(numToCurr(n_blcdp));
												
											}
											
									})	
							
							
					}else { alert('DP sudah dibayarkan');}		
					
			}
			else if($('#paystat option:selected').val() == '2'){
						
						var propamount = parseInt($('#paidprogamount').val().replace(rep_coma,""));
						var contr = parseInt($('#contramount').val().replace(rep_coma,""));
						var amountdp 	= contr * 0.2;
						var blcdp = parseInt($('#paid_dp').val().replace(rep_coma,""));
						var oscontr = parseInt($('#blc_os').val().replace(rep_coma,""));
						
						//alert(oscontr);
						$('#oscontr').val(numToCurr(oscontr));
						
						
						if (propamount > amountdp){
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
				
									$('#progclaim').bind('keyup keypress',function(){
										//alert('tes');
										
										$(this).val(numToCurr($(this).val()));
											
											
										    var claimprog = parseInt($('#progclaim').val().replace(rep_coma,""));
											var prog = parseInt($('#progamount').val().replace(rep_coma,""));
											
											var batasprog	= claimprog + prog;
														
											
											//alert(batasprog);
											
											if(batasprog <= 100){
												
																							
											}else{
												alert('Melampaui Progress 100%');
												
												$("#progclaim").val(0);
										
											}
									})
									
									
									$('#payprog').bind('keyup keypress',function(){
										
										
										$(this).val(numToCurr($(this).val()));
											var payprog 	= parseInt($('#payprog').val().replace(rep_coma,""));
											var oscontr 	= parseInt($('#oscontr').val().replace(rep_coma,""));
											var contramount = parseInt($('#contramount').val().replace(rep_coma,""));
											var pphdpvar 	= parseInt($('#pph').val().replace(rep_coma,""));
											var totdp	 	= parseInt($('#dp_amount').val().replace(rep_coma,""));
											var totpaid		= parseInt($('#paidprogamount').val().replace(rep_coma,""));
											var dppaid		= parseInt($('#paid_dp').val().replace(rep_coma,""));
											var retensi		= contramount * 0.05;
											var bataspay	= oscontr - retensi;
											
											var totpayprog	= payprog + totpaid;
											var kurangdp	= totdp - ((totpayprog/contramount) * totdp);
											var potongandp	= (payprog/contramount) * totdp;
											var payprogclaim = payprog - potongandp;
											
											var ppnprog		= payprogclaim * 0.1;
											var pphprog		= payprogclaim * (pphdpvar/100);
											//alert(dppaid);
											if(payprog <= bataspay){
												$('#ppnprog').val(numToCurr(ppnprog));
												$("#pphprog").val(numToCurr(pphprog));
												$("#kurangdp").val(numToCurr(kurangdp));
												$("#potongandp").val(numToCurr(potongandp));
												$("#payprogclaim").val(numToCurr(payprogclaim));
												
												//$("#blcprog").val(numToCurr(n_blcdp));
												
											}
											else{
												alert('Pembayaran Melampui Batas Tahap Retensi');
												$('#ppnprog').val(0);
												$("#pphprog").val(0);
												$("#kurangdp").val(0);
												$("#payprog").val(0);
												$("#pengurangdp").val(0);
												$("#payprogclaim").val(0);
												
												//$("#blcprog").val(numToCurr(n_blcdp));
												
											}
										
										
										
											
										    
									})
									
									
									
							}
							else { alert('Pembayaran DP belum lunas');}
				}
			
			else if($('#paystat option:selected').val() == '3'){
				
					
					var propamount = parseInt($('#paidprogamount').val().replace(rep_coma,""));
					var contramount = parseInt($('#contramount').val().replace(rep_coma,""));
					var contr = parseInt($('#contramount').val().replace(rep_coma,""));
					var amountdp 	= contr * 0.2;
					var progpaid	= contr * 0.75;
					
					var blcdp = parseInt($('#paid_dp').val().replace(rep_coma,""));
					var retensi = contramount * 0.95; 	
						
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
						$('#sh14').show();
						$('#sh15').show();

					
					
					//alert(propamount);
					//alert(amountdp);
					if (propamount < amountdp){
						 alert('Pembayaran DP belum lunas');
					}
					else if(propamount > amountdp || progpaid <= amountdp){
						alert('Pembayaran Progress belum lunas');
					}
					else if(propamount >= retensi ){
						alert ('Silahkan Melakukan Pembayaran Retensi'); 
						
						}
					else if(propamount == contr){
						alert('Kontrak ini sudah lunas');
						}
			
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
echo form_open(site_url('cjc/save'), $attr);
$pph 		= $data->pph;
$prevprog 	= $prop->prop_am;
$propamount = $prop->prop_amount;
$blcdp		= $dp->paiddp;
?>
<div class="easyui-tabs" style="width:900px;height:300px;">
	<div title="Contract" style="padding:10px;">
	<table>
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
			<td><label for="name">Remarks</label><textarea name="remarks" id="remarks" class="validate[required]"></textarea></td>
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
			<td><label for="name">DP</label><input type="text" name="dpay"  readonly="true" class="input" style="width:40px" id="dpay" value="20">%</td> 
			<td><label for="name">Total DP</label><input type="text" name="dpamount" class="input" align="right" id="dpamount" style="width:90px" readonly="true"/></td> 		 
			<td><label for="name">Paid.DP</label><input type="text" name="paid_dp" id="paid_dp" value="<?=number_format($blcdp)?>" class="input" readonly="true" style="width:90px"></td>		 
			
		</tr>
		<tr  id="sh9">
			<td><label for="name">Total Ppn</label><input type="text" name="dpppn"  readonly="true" class="input" style="width:90px" align="right" id="dpppn"></td> 
			<td><label for="name">Total Pph</label><input type="text" name="dppph"  readonly="true" class="input" style="width:90px" id="dppph" align="right"></td> 
			<td><label for="name">OS DP</label><input type="text" name="osdp" readonly="true" class="input" style="width:90px" id="osdp" align="right"></td> 
		</tr>
		<tr  id="sh10">
			<td colspan="3"><label for="name">Payment Claim</label><input type="text" name="payment"  class="input" style="width:90px" align="right" id="payment"></td> 
			
		</tr>
		<tr  id="sh11">
			<td ><label for="name">Ppn</label><input type="text" name="n_ppndp"  class="input" style="width:90px" align="right" id="n_ppndp" readonly="true"></td> 
			<td ><label for="name">Pph</label><input type="text" name="n_pphdp"  class="input" style="width:90px" align="right" id="n_pphdp" readonly="true"></td> 
			<td ><label for="name">Balanced DP</label><input type="text" name="n_blcdp"  class="input" style="width:90px" align="right" id="n_blcdp" readonly="true"></td> 
		</tr>
		
		
		
		<tr id="sh12">
			<td><label for="name">DP</label><input type="text" name="dpay"  readonly="true" class="input" style="width:40px" id="dpay" value="20">%</td> 
			<td><label for="name">Total DP</label><input type="text" name="dpamount" class="input" align="right" id="dpamount" style="width:90px" readonly="true"/></td> 		 
			<td><label for="name">Paid.DP</label><input type="text" name="paid_dp" id="paid_dp" value="<?=number_format($blcdp)?>" class="input" readonly="true" style="width:90px"></td>		 
			
		</tr>
		<tr  id="sh13">
			<td><label for="name">Total Ppn</label><input type="text" name="dpppn"  readonly="true" class="input" style="width:90px" align="right" id="dpppn"></td> 
			<td><label for="name">Total Pph</label><input type="text" name="dppph"  readonly="true" class="input" style="width:90px" id="dppph" align="right"></td> 
			<td><label for="name">OS DP</label><input type="text" name="osdp" readonly="true" class="input" style="width:90px" id="osdp" align="right"></td> 
		</tr>
		<tr  id="sh14">
			<td colspan="3"><label for="name">Payment Claim</label><input type="text" name="payment"  class="input" style="width:90px" align="right" id="payment"></td> 
			
		</tr>
		<tr  id="sh15">
			<td ><label for="name">Ppn</label><input type="text" name="n_ppndp"  class="input" style="width:90px" align="right" id="n_ppndp" readonly="true"></td> 
			<td ><label for="name">Pph</label><input type="text" name="n_pphdp"  class="input" style="width:90px" align="right" id="n_pphdp" readonly="true"></td> 
			<td ><label for="name">Balanced DP</label><input type="text" name="n_blcdp"  class="input" style="width:90px" align="right" id="n_blcdp" readonly="true"></td> 
		</tr>
		
			
			
			
	
		<tr  id="sh1">
			<td><label for="name">Progress Done</label><input type="text" name="progamount" id="progamount" value="<?=number_format($prevprog)?>" class="input" readonly="true" style="width:50px"/>%</td> 		 
			<td><label for="name">Prev.Paid</label><input type="text" name="paidprogamount" id="paidprogamount" value="<?=number_format($propamount)?>" class="input" readonly="true"/></td>
			<td><label for="name">OS Contract</label><input type="text" name="oscontr" id="oscontr" class="input" readonly="true"/><td> 		 
		</tr>
		<tr id="sh2">
			<td ><label for="name">Progress Claim</label><input type="text" name="progclaim"  class="input" style="width:60px" id="progclaim"/></td> 		 
			<td><label for="name">Amount Claim</label><input type="text" class="input" name="payprog" id="payprog"></td>
			<td><label for="name">Payment</label><input type="text" class="input" name="payprogclaim" id="payprogclaim" readonly="true"></td>
		</tr>
		<tr id="sh3">
			<td><label for="name">PPN</label><input type="text" class="input" name="ppnprog" id="ppnprog" readonly="true" readonly="true"/></td>		 
			<td colspan="2"><label for="name">PPH</label><input type="text" class="input" name="pphprog" id="pphprog" readonly="true"/> </td>		 
		</tr>
		<tr id="sh4">
			<td><label for="name">Potongan DP</label><input type="text" class="input" name="potongandp" id="potongandp" readonly="true"/></td> 		 
			<td colspan="2"><label for="name">Balanced DP</label><input type="text" class="input" name="kurangdp" id="kurangdp" readonly="true"/></td>		 		 
		</tr>
		
		
		
		
		
		</table>		 		 		 
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

       <input type="submit" value="Save" /> <input type="reset" value="Cancel" />

<?=form_close()?>
