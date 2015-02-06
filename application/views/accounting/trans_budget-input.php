<?php
#die('tres');
$date = date("d-m-Y");
$session_id = $this->UserLogin->isLogin(); 
$lvl = $session_id['level_id'];
$pt = $session_id['id_pt'];
#var_dump($lvl);exit;
?>
<link rel="stylesheet" href="<?=base_url()?>assets/css/menuform.css" type="text/css" />
<script language="javascript" src="<?=base_url()?>assets/js/jquery.numeric.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/currency.js"></script>
<link rel="stylesheet" href="<?=base_url()?>assets/css/menuform.css" type="text/css" />
<script language="javascript" src="<?=site_url()?>assets/js/jquery.validationEngine.js"></script>
<script language="javascript" src="<?=site_url()?>assets/js/jquery.validationEngine-en.js"></script>
<script language="javascript" src="<?=site_url()?>assets/js/jquery.formx.js"></script>
<script type="text/javascript">
	$(function(){
		
		$(document).ready(function(){
			$('#bgt_year').append('<option></option>');
			for(var i = 2014;i < 2021;i++){
				$('#bgt_year').append($('<option></option>').val(i).text(i));
			}
		});
		
		$('#formAdd').validationEngine({
				beforeSuccess: function(){
					var kugiri = new RegExp(",", "g");
					var amount = parseInt($('#amount').val().replace(kugiri,""));
					var blcmonth = parseInt($('#blc_month').val().replace(kugiri,""));
					var blcytd = parseInt($('#blc_ytd').val().replace(kugiri,""));
					var blcmnthdiv = parseInt($('#blcmnthdiv').val().replace(kugiri,""));
					var blcalldiv = parseInt($('#blcalldiv').val().replace(kugiri,""));
					var blcytdalldiv = parseInt($('#blcytdalldiv').val().replace(kugiri,""));
					var blcmnthalldiv = parseInt($('#blcmnthalldiv').val().replace(kugiri,""));
					var blcdiv = parseInt($('#blcdiv').val().replace(kugiri,""));
					var blcytddiv = parseInt($('#blcytddiv').val().replace(kugiri,""));
					var tot_blc = parseInt($('#tot_blc').val().replace(kugiri,""));
					var lvl = $('#lvl').val();
					var flag_pr = $('#flag_pr').val();
					
					/*if(amount > blcalldiv){
						alert('Amount proposed budget greater than balance annual budget company');
						return true;
					}else*/ if(lvl == 3){
						setTimeout("location.reload(true);",1500);
						return false;
					/*}else if(amount > blcmnthalldiv){
						alert('Amount proposed budget greater than balance month budget company');
						return true;						
					}else if(amount > blcdiv){
						alert('Amount proposed budget greater than balance annual budget division');
						return true;						
					}else if(amount > blcytddiv){
						alert('Amount proposed budget greater than balance ytd budget division');
						return true;					
					}else if(amount > blcmnthdiv){
						alert('Amount proposed budget greater than balance month budget division');
						return true;	*/				
					}else if(amount > tot_blc){
						alert('Amount proposed budget greater than balance annual budget');
						return true;					
					/*}else if(amount > blcytd){
						alert('Amount proposed budget greater than balance ytd budget');
						return true;
					}else if(amount > blcmonth){
						alert('Amount proposed budget greater than balance month budget');
						return true;*/						
					}else{
						setTimeout("location.reload(true);",1500);
						return false;						
					}
					/*if(amount > blcmonth && amount > blcytd && amount > blcmnthdiv){
						alert('Proposed budget melebihi anggaran budget bulan ini');
						alert('Request budget lebih besar dari budget YTD');
						alert('Request budget lebih besar dari budget Divisi');
						return true;
					}else if(amount > blcmonth && amount > blcytd && amount < blcmnthdiv){
						alert('Proposed budget melebihi anggaran budget bulan ini');
						alert('Request budget lebih besar dari budget YTD');
						//setTimeout("location.reload(true);",1500);
						return true;
					}else if(amount > blcmonth && amount < blcytd){
						alert('Proposed budget melebihi anggaran budget bulan ini');
						//setTimeout("location.reload(true);",1500);			
						return true;						
					}else{
						setTimeout("location.reload(true);",1500);
						return false;
					}*/
				},
			
				success: function(){
					//~ $('#formAdd').ajaxSubmit({
						//~ success: function(data){
							//~ alert(String(data).replace(/<\/?[^>]+>/gi, ''));
							//~ refreshTable();
						//~ }
					//~ });
					$('#formAdd')
		.validationEngine()
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
					
					return false;
				}
		});
		
		$('#btnClose').click(function(){
			$.validationEngine.closePrompt(".formError",true)
			refreshTable();
		});
	

	$('select[name=code]').change(function(){
			 var tgl = $('#tgl_aju').val();
			 var jml = tgl.substring(5,3);
			 var thn = $('#bgt_year option:selected').val();
			 var divisi = $('#divisi_id').val();
			 var kode = $(this).val();
			 var description = $('#desc').val($('#code option:selected').text());
			 
			$.getJSON('<?=site_url('trans_budget/bgt_balance')?>/'+jml+'/'+thn+'/'+kode,
				function(blcdata){
					$('#annu_tot').val(blcdata.annu_tot);
					$('#tot_blc').val(blcdata.blc_ann);
					$('#blc_month').val(blcdata.blc_month);
					$('#actmonth').val(blcdata.actmonth);
					$('#actdivmonth').val(blcdata.actdivmonth);
					$('#actalldivmonth').val(blcdata.actalldivmonth);
					$('#actytd').val(blcdata.actytd);
					$('#actdivytd').val(blcdata.actdivytd);
					$('#actalldivytd').val(blcdata.actalldivytd);
					$('#actann').val(blcdata.actann);
					$('#actdivann').val(blcdata.actdivann);
					$('#actalldivann').val(blcdata.actdivallann);
					$('#bgt_ytd').val(blcdata.bgtytd);
					$('#blc_ytd').val(blcdata.blc_ytd);
					$('#bgt_month').val(blcdata.bgtmnth);
					$('#totdiv').val(blcdata.totdiv);
					$('#blcdiv').val(blcdata.blcdiv);
					$('#totalldiv').val(blcdata.totalldiv);
					$('#blcalldiv').val(blcdata.blcalldiv);
					$('#totmnthdiv').val(blcdata.totmnthdiv);
					$('#blcmnthdiv').val(blcdata.blcmnthdiv);
					$('#totmnthalldiv').val(blcdata.totmnthalldiv);
					$('#blcmnthalldiv').val(blcdata.blcmnthalldiv);
					$('#totytddiv').val(blcdata.totytddiv);
					$('#blcytddiv').val(blcdata.blcytddiv);
					$('#totytdalldiv').val(blcdata.totytdalldiv);
					$('#blcytdalldiv').val(blcdata.blcytdalldiv);
					//~ $('#noid').val(blcdata.noid);
					$('#divisi_id').val(blcdata.divisi_id);
					//~ //File span id
					$('#span_bgt_month').text(blcdata.bgtmnth);
					$('#span_totmnthdiv').text(blcdata.totmnthdiv);
					$('#span_totmnthalldiv').text(blcdata.totmnthalldiv);
					$('#span_actmonth').text(blcdata.actmonth);
					$('#span_actdivmonth').text(blcdata.actdivmonth);
					$('#span_actalldivmonth').text(blcdata.actalldivmonth);
					$('#span_blc_month').text(blcdata.blc_month);
					$('#span_blcmnthdiv').text(blcdata.blcmnthdiv);
					$('#span_blcmnthalldiv').text(blcdata.blcmnthalldiv);
					$('#span_bgt_ytd').text(blcdata.bgtytd);
					$('#span_totytddiv').text(blcdata.totytddiv);
					$('#span_totytdalldiv').text(blcdata.totytdalldiv);
					$('#span_actytd').text(blcdata.actytd);
					$('#span_actdivytd').text(blcdata.actdivytd);
					$('#span_actalldivytd').text(blcdata.actalldivytd);
					$('#span_blc_ytd').text(blcdata.blc_ytd);
					$('#span_blcytddiv').text(blcdata.blcytddiv);
					$('#span_blcytdalldiv').text(blcdata.blcytdalldiv);
					$('#span_annu_tot').text(blcdata.annu_tot);
					$('#span_totdiv').text(blcdata.totdiv);
					$('#span_totalldiv').text(blcdata.totalldiv);
					$('#span_actann').text(blcdata.actann);
					$('#span_actdivann').text(blcdata.actdivann);
					$('#span_actalldivann').text(blcdata.actdivallann);
					$('#span_tot_blc').text(blcdata.blc_ann);
					$('#span_blcdiv').text(blcdata.blcdiv);
					$('#span_blcalldiv').text(blcdata.blcalldiv);
			});
		});	

	  $('.calculate').bind('keyup keypress',function(){
			$(this).val(numToCurr($(this).val()));
		  }).numeric();
		  
   function loadData(type,parentId){
	  // berikan kondisi sedang loading data ketika proses pengambilan data
	  $('#loading').text('Loading '+type.replace('_','/')+' data...');
      $.post('<?=site_url('trans_budget/loaddata')?>', //request ke fungsi load data di inputAP
		{data_type: type, parent_id: parentId},
		function(data){
		  if(data.error == undefined){ // jika respon error tidak terdefinisi maka pengambilan data sukses 
			 $('#'+type).empty(); // kosongkan dahulu combobox yang ingin diisi datanya
			 $('#'+type).append('<option>-Choose data-</option>'); // buat pilihan awal pada combobox
			 for(var x=0;x<data.length;x++){
				// berikut adalah cara singkat untuk menambahkan element option pada tag <select>
			 	$('#'+type).append($('<option></option>').val(data[x].id).text(data[x].nama));
			 }
			 $('#loading').text(''); // hilangkan text loading
		  }else{
			 alert(data.error); // jika ada respon error tampilkan alert
			 $('#'+type).text('');
		  }
		},'json' // format respon yang diterima langsung di convert menjadi JSON 
      );      
   }
   
   $('#bgt_year').change(function(){
	   loadData('code',$('#bgt_year option:selected').val())
   });	  
				 
});

			


</script>
<div id="utama" align="left">
<form method="post" action="<?=site_url('print/slip_budget')?>"  id="formAdd" target='_blank'>
<table border="0"  cellpadding="0" cellspacing="0">
	<input type="hidden" name="lvl" id="lvl" value="<?=$lvl?>"/>
	<input type="hidden" name="desc" id="desc"/>
	<input type="hidden" name="divisi_id" id="divisi_id"/>
	<input type="hidden" name="tgl_aju" id="tgl_aju"  value="<?=$date?>" readonly="true"/>
	<input type="hidden" name="bgt_month" id="bgt_month" class="input validate[required]" readonly="true" >
    <input type="hidden" name="totmnthdiv" class="input" id="totmnthdiv" readonly="true"/>
	<input type="hidden" name="totmnthalldiv" class="input" id="totmnthalldiv" readonly="true"/>
	<input type="hidden" name="actmonth" id="actmonth" class="input validate[required]" readonly="true" >
	<input type="hidden" name="actdivmonth" class="input" id="actdivmonth" readonly="true"/>
	<input type="hidden" name="actalldivmonth" class="input" id="actalldivmonth" readonly="true"/>
	<input type="hidden" name="blc_month" id="blc_month" class="input" readonly="true"/>
	<input type="hidden" name="blc_divmonth" class="input" id="blcmnthdiv" readonly="true"/>
	<input type="hidden" name="blcmnthalldiv" class="input" id="blcmnthalldiv" readonly="true"/>
	<input type="hidden" name="bgt_ytd" id="bgt_ytd" class="input" readonly="true"/>
	<input type="hidden" name="totytddiv" class="input" id="totytddiv" readonly="true"/>
	<input type="hidden" name="totytdalldiv" class="input" id="totytdalldiv" readonly="true"/>
	<input type="hidden" name="actytd" id="actytd" class="input validate[required]" readonly="true" >
	<input type="hidden" name="actdivytd" class="input" id="actdivytd" readonly="true"/>
	<input type="hidden" name="actalldivytd" class="input" id="actalldivytd" readonly="true"/>
	<input type="hidden" name="blc_ytd" id="blc_ytd" class="input" readonly="true"/>
	<input type="hidden" name="blc_divytd" class="input" id="blcytddiv" readonly="true"/>
	<input type="hidden" name="blcytdalldiv" class="input" id="blcytdalldiv" readonly="true"/>
	<input type="hidden" name="annu_tot" class="input" id="annu_tot" readonly="true"/>
	<input type="hidden" name="totdiv" class="input" id="totdiv" readonly="true"/>
	<input type="hidden" name="totalldiv" class="input" id="totalldiv" readonly="true"/>
	<input type="hidden" name="actann" class="input" id="actann" readonly="true"/>
	<input type="hidden" name="actdivann" class="input" id="actdivann" readonly="true"/>
	<input type="hidden" name="actalldivann" class="input" id="actalldivann" readonly="true"/>
	<input type="hidden" name="blc_ann" class="input" id="tot_blc" readonly="true"/>
	<input type="hidden" name="blc_divann" class="input" id="blcdiv" readonly="true"/>
	<input type="hidden" name="blcalldiv" class="input" id="blcalldiv" readonly="true"/>


		<tr>
						
			<td>YEAR : <select name="bgt_year" id="bgt_year"></select>	</td>
		
			<td colspan='8'>BUDGET : <select name="code"  id="code"></select>
<!--
				<select name="code"  class="xinput">
						<option>Select Budget</option>
						<?php #foreach ($kodebgt as $row):?>	
						<option value="<?#=$row->code;?>" <?php #if($row->code==@$data->code_id) echo"selected";?>><?php #echo $row->descbgt;?></option>
						<?php #endforeach ?>
					</select>			
-->
				</td>

		<tr>
			
			<? if ($pt == '44'){ ?>
				<td colspan='6'>
				<input type="radio" name="flag_pr" id="flag_pr" value="1" checked class="validate[required] radio"> Budget PR
				<input type="radio" name="flag_pr" id="flag_pr" value="2" class="validate[required] radio"> Non Budget PR
				</td>
				
				<? } ?>
			
		</tr>
		<tr><td colspan='9'></td></tr>
		
		</table>
		<table border="1"  cellpadding="1" cellspacing="1">
		<tr>
			<td colspan='3' valign='center' align='center' bgcolor='black'><font color='white'><b>ACCOUNT BUDGET</b></font></td>
			<td colspan='3' valign='center' align='center' bgcolor='black'><font color='white'><b>DIVISION BUDGET</b></font></td>
			<td colspan='3' valign='center' align='center' bgcolor='black'><font color='white'><b>COMPANY BUDGET</b></font></td>
		</tr>
				<tr>
						<td>Budget  Month</td>
						<td>:</td>
						<td align="right" width="100px"><span id="span_bgt_month">0</span></td>
					
						<td>Budget  Month</td>
						<td>:</td>
						<td align="right" width="100px"><span id="span_totmnthdiv">0</span></td>
						
						<td>Budget  Month</td>
						<td>:</td>
						<td align="right" width="100px"><span id="span_totmnthalldiv">0</span></td>
				</tr>
				<tr>
						<td>Actual  Month</td>
						<td>:</td>
						<td align="right"><span id="span_actmonth">0</span></td>
					
						<td>Actual  Month</td>
						<td>:</td>
						<td align="right"><span id="span_actdivmonth">0</span></td>
						
						<td>Actual  Month</td>
						<td>:</td>
						<td align="right"><span id="span_actalldivmonth">0</span></td>
				</tr>
				<tr>
						<td>Balance Budget  Month</td>
						<td>:</td>
						<td align="right"><span id="span_blc_month">0</span></td>
					
						<td>Balance Budget  Month</td>
						<td>:</td>
						<td align="right"><span id="span_blcmnthdiv">0</span></td>
						
						<td>Balance Budget  Month</td>
						<td>:</td>
						<td align="right"><span id="span_blcmnthalldiv">0</span></td>
				</tr>
				<tr>	
						<td>Budget  YTD</td>
						<td>:</td>
						<td align="right"><span id="span_bgt_ytd">0</span></td>
					
						<td>Budget  YTD</td>
						<td>:</td>
						<td align="right"><span id="span_totytddiv">0</span></td>
						
						<td>Budget  YTD</td>
						<td>:</td>
						<td align="right"><span id="span_totytdalldiv">0</span></td>
				</tr>
				<tr>
						<td>Actual  YTD</td>
						<td>:</td>
						<td align="right"><span id="span_actytd">0</span></td>
					
						<td>Actual  YTD</td>
						<td>:</td>
						<td align="right"><span id="span_actdivytd">0</span></td>
						
						<td>Actual  YTD</td>
						<td>:</td>
						<td align="right"><span id="span_actalldivytd">0</span></td>
				</tr>
				<tr>
						<td>Balance Budget  YTD</td>
						<td>:</td>
						<td align="right"><span id="span_blc_ytd">0</span></td>
					
						<td>Balance Budget  YTD</td>
						<td>:</td>
						<td align="right"><span id="span_blcytddiv">0</span></td>
						
						<td>Balance Budget  YTD</td>
						<td>:</td>
						<td align="right"><span id="span_blcytdalldiv">0</span></td>
				</tr>
				<tr>						
						<td>Budget  Annual</td>
						<td>:</td>
						<td align="right"><span id="span_annu_tot">0</span></td>
					
						<td>Budget  Annual</td>
						<td>:</td>
						<td align="right"><span id="span_totdiv">0</span></td>
						
						<td>Budget  Annual</td>
						<td>:</td>
						<td align="right"><span id="span_totalldiv">0</span></td>
				</tr>
				<tr>						
						<td>Actual  Annual</td>
						<td>:</td>
						<td align="right"><span id="span_actann">0</span></td>
					
						<td>Actual  Annual</td>
						<td>:</td>
						<td align="right"><span id="span_actdivann">0</span></td>
						
						<td>Actual  Annual</td>
						<td>:</td>
						<td align="right"><span id="span_actalldivann">0</span></td>
				</tr>
				<tr>
						<td>Balance Budget  Annual</td>
						<td>:</td>
						<td align="right"><span id="span_tot_blc">0</span></td>
										
						<td>Balance Budget  Annual</td>
						<td>:</td>
						<td align="right"><span id="span_blcdiv">0</span></td>
					
						<td>Balance Budget  Annual</td>
						<td>:</td>
						<td align="right"><span id="span_blcalldiv">0</span></td>
				</tr>
				
			
		<tr>
				<td></td>
				<td></td> 
				<td colspan='7'><input  type='hidden' name="realamount" id="realisasi" class="calculate input validate[required]" readonly='true'></td>
			
		</tr>
		</table>
		<table>
		<tr>
			
				<td>Proposed Amount </td>
				<td>:</td> 
				<td colspan='7'><input type="text" name="amount" id="amount" class="xinput calculate input validate[required]"/></td>
		</tr>
		
		
		<tr>
			
				<td>Remark</td> 
				<td>:</td> 
				<td colspan='7'><textarea name="remark" id="remark" class="xinput validate[required]"></textarea></td>
			
		</tr>
		
		<tr>
			<td colspan ='9'>
				<input type="hidden" name="noid" id="noid" value="<?=@$data->id_trbgt?>"/>
				<input type="submit" id="klik" name="proposed" value="Proposed"/>
				<input type="reset"  id="btnClose" value="Close"/>
			</td>
		</tr>
	</table>
</form>
</div>
