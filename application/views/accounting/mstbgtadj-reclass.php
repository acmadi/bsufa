<script language="javascript" src="<?=base_url()?>assets/js/jquery.numeric.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/currency.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/calendar.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/calendar2.js"></script>
<!--<script language="javascript" src="<?=base_url()?>assets/js/jquery.formx.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.validationEnginex.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.validationEngine-enx.js"></script>-->
<link rel="stylesheet" href="<?=base_url()?>assets/css/calendar.css" type="text/css"/>
<link rel="stylesheet" href="<?=base_url()?>assets/css/menuku.css" type="text/css"/>

<script type="text/javascript">
   var kugiri = new RegExp(",", "g");
   function loadData(type,parentId,thn){
	  $('#loading').text('Loading '+type.replace('_','/')+' data...');
      $.post('<?=site_url('mstbgtadj/loaddata')?>', 
		{data_type: type, parent_id: parentId,thn : thn},
		function(data){
		  if(data.error == undefined){  
			 $('#cb_'+type).empty(); 
			 $('#cb_'+type).append('<option></option>'); 
			 for(var x=0;x<data.length;x++){
			 	$('#cb_'+type).append($('<option></option>').val(data[x].id).text(data[x].nama));
			 }
			 $('#loading').text(''); 
		  }else{
			 alert(data.error); 
			 $('#cb_budget').text('');
		  }
		},'json'  
      );      
   }
   
	$(function(){
		$(document).ready(function(){
			$('#cb_divisi').attr('disabled',true);
			$('#cb_budget').attr('disabled',true);
			$('#cb_budget2').attr('disabled',true);
			$('#bln1').attr('disabled',true);
			$('#bln2').attr('disabled',true);
			$('#classamount').attr('disabled',true);
		});

		loadData('divisi',0,'');
		$('#cb_divisi').change( 
			function(){
				$('#cb_budget').attr('disabled',false);
				if($('#cb_divisi option:selected').val() != '' && $('#thn option:selected').val() != ''){
					loadData('budget',$('#cb_divisi option:selected').val(),$('#thn').val());
					loadData('budget2',$('#cb_divisi option:selected').val(),$('#thn').val());
				}else{
					alert("tahun belum di isi");
				}
		});
		
		//Cek Tahun
		$('select[name=thn]').change(function(){
			$('#cb_divisi').attr('disabled',false);
			$('#cekthn').val($(this).val());
			
		});
		

		$('select[name=cb_budget]').change(function(){
		  $('#bln1').attr('disabled',false);
		  var thn = $('#cekthn').val();	
		  $.getJSON('<?=site_url('mstbgtadj/datacurrent')?>/'+$(this).val()+'/'+thn,
			function(data){
				$('#coa1').text(data.coa);
				$('#descacc1').text(data.descacc);
				$('#coahide1').val(data.coa);
				$('#cf1').text(data.cf);
				$('#kodebgt1').text(data.kdbgt);
				$('#descbgt1').text(data.descbgt);
				$('#jan1').val(data.curbgt1);
				$('#jan2').val(data.curbgt2);
				$('#jan3').val(data.curbgt3);
				$('#jan4').val(data.curbgt4);
				$('#jan5').val(data.curbgt5);
				$('#jan6').val(data.curbgt6);
				$('#jan7').val(data.curbgt7);
				$('#jan8').val(data.curbgt8);
				$('#jan9').val(data.curbgt9);
				$('#jan10').val(data.curbgt10);
				$('#jan11').val(data.curbgt11);
				$('#jan12').val(data.curbgt12);
				$('#totmst1').val(data.curtot_mst);
			});
		});
		
		
		$('select[name=cb_budget2]').change(function(){
			 $('#bln2').attr('disabled',false);
			 var a = $('#cb_budget').val();
			 var b = $('#cb_budget2').val();
			 var thn = $('#cekthn').val();
			 if(a == b){
			   alert("Description Budget sama");
			   refreshTable();
		     }
		  $.getJSON('<?=site_url('mstbgtadj/datacurrent')?>/'+$(this).val()+'/'+thn,
			function(data){
				$('#coa2').text(data.coa);
				$('#descacc2').text(data.descacc);
				$('#coahide2').val(data.coa);
				$('#cf2').text(data.cf);
				$('#kodebgt2').text(data.kodebgt);
				$('#descbgt2').text(data.descbgt);
				$('#feb1').val(data.curbgt1);
				$('#feb2').val(data.curbgt2);
				$('#feb3').val(data.curbgt3);
				$('#feb4').val(data.curbgt4);
				$('#feb5').val(data.curbgt5);
				$('#feb6').val(data.curbgt6);
				$('#feb7').val(data.curbgt7);
				$('#feb8').val(data.curbgt8);
				$('#feb9').val(data.curbgt9);
				$('#feb10').val(data.curbgt10);
				$('#feb11').val(data.curbgt11);
				$('#feb12').val(data.curbgt12);
				$('#totmst2').val(data.curtot_mst);
			});
		});
		
		$('select[name=bln1]').change(function(){
		  $('#cb_budget2').attr('disabled',false);	 
		  var kode = $('#cb_budget').val();
		  var thn = $('#cekthn').val();
		  $.getJSON('<?=site_url('mstbgtadj/dtmonth')?>/'+kode+'/'+$(this).val()+'/'+thn,
			function(response){
				$('#amount1').text(response.bgt);
			});
		});

		$('select[name=bln2]').change(function(){
		  $('#classamount').attr('disabled',false);
		  $('#classamount').focus();	
		  var kode = $('#cb_budget2').val();
		  var thn = $('#cekthn').val();
		  $.getJSON('<?=site_url('mstbgtadj/dtmonth')?>/'+kode+'/'+$(this).val()+'/'+thn,
			function(response){
				$('#amount2').text(response.bgt);
			});
		});

	  //Proses ketika Reclass
	  $('#classamount').bind('keyup keypress',function(){
		  var amount = parseInt($('#classamount').val().replace(kugiri,""));
		  var nil1 = parseInt($('#amount1').text().replace(kugiri,""));
		  var nil2 = parseInt($('#amount2').text().replace(kugiri,""));
		  var total1 = nil1 - amount;
		  var total2 = nil2 + amount;
		  $('#lastamount1').text(numToCurr(total1));
		  $('#lastamount2').text(numToCurr(total2));
		  
		  var lastam1 = parseInt($('#lastamount1').text().replace(kugiri,""));
		  var lastam2 = parseInt($('#lastamount2').text().replace(kugiri,""));
		  var tot_mst1 = parseInt($('#totmst1').val()); 
		  var tot_mst2 = parseInt($('#totmst2').val());
		  var tot1 = tot_mst1 - amount;
		  var tot2 = tot_mst2 + amount;
		  
		  //Budget saat Reclass
		  if($('#bln1 option:selected').val()=='bgt1'){
			  $('#jan1').val(lastam1);
			  $('#tot1').val(tot1);
		  }else if($('#bln1 option:selected').val()=='bgt2'){
			  $('#jan2').val(lastam1);
			  $('#tot1').val(tot1);
		  }else if($('#bln1 option:selected').val()=='bgt3'){
			  var tot1 = lastam1 + tot_mst1;
			  $('#jan3').val(lastam1);
			  $('#tot').val(tot1);
		  }else if($('#bln1 option:selected').val()=='bgt4'){
			  var tot1 = lastam1 + tot_mst1;
			  $('#jan4').val(lastam1);
			  $('#tot1').val(tot1);
		  }else if($('#bln1 option:selected').val()=='bgt5'){
			  $('#jan5').val(lastam1);
			  $('#tot1').val(tot1);
		  }else if($('#bln1 option:selected').val()=='bgt6'){
			  $('#jan6').val(lastam1);
			  $('#tot1').val(tot1);
		  }else if($('#bln1 option:selected').val()=='bgt7'){
			  $('#jan7').val(lastam1);
			  $('#tot1').val(tot1);
		  }else if($('#bln1 option:selected').val()=='bgt8'){	       	  	  	  
			  $('#jan8').val(lastam1);
			  $('#tot1').val(tot1);
		  }else if($('#bln1 option:selected').val()=='bgt9'){
			  $('#jan9').val(lastam1);
			  $('#tot1').val(tot1);
		  }else if($('#bln1 option:selected').val()=='bgt10'){
			  $('#jan10').val(lastam1);
			  $('#tot1').val(tot1);
		  }else if($('#bln1 option:selected').val()=='bgt11'){
			  $('#jan11').val(lastam1);
			  $('#tot1').val(tot1);
		  }else if($('#bln1 option:selected').val()=='bgt12'){
			  $('#jan12').val(lastam1);
			  $('#tot1').val(tot1);
		  }
		  
		  //Budget Kedua
		  if($('#bln2 option:selected').val()=='bgt1'){
			  $('#feb1').val(lastam2);
			  $('#tot2').val(tot2);
		  }else if($('#bln2 option:selected').val()=='bgt2'){
			  $('#feb2').val(lastam2);
			  $('#tot2').val(tot2);
		  }else if($('#bln2 option:selected').val()=='bgt3'){
			  $('#feb3').val(lastam2);
			  $('#tot2').val(tot2);
		  }else if($('#bln2 option:selected').val()=='bgt4'){
		  $('#feb4').val(lastam2);
			  $('#tot2').val(tot2);
		  }else if($('#bln2 option:selected').val()=='bgt5'){
			  $('#feb5').val(lastam2);
			  $('#tot2').val(tot2);
		  }else if($('#bln2 option:selected').val()=='bgt6'){
			  $('#feb6').val(lastam2);
			  $('#tot2').val(tot2);
		  }else if($('#bln2 option:selected').val()=='bgt7'){
			  $('#feb7').val(lastam2);
			  $('#tot2').val(tot2);
		  }else if($('#bln2 option:selected').val()=='bgt8'){	       	  	  	  
			  $('#feb8').val(lastam2);
			  $('#tot2').val(tot2);
		  }else if($('#bln2 option:selected').val()=='bgt9'){
			  $('#feb9').val(lastam2);
			  $('#tot2').val(tot2);
		  }else if($('#bln2 option:selected').val()=='bgt10'){
			  $('#feb10').val(lastam2);
			  $('#tot2').val(tot2);
		  }else if($('#bln2 option:selected').val()=='bgt11'){
			  $('#feb11').val(lastam2);
			  $('#tot2').val(tot2);
		  }else if($('#bln2 option:selected').val()=='bgt12'){
			  $('#feb12').val(lastam2);
			  $('#tot2').val(tot2);
		  }		  
		  	  	  	  
		  
	  });

	  $('.calculate').bind('keyup keypress',function(){
			$(this).val(numToCurr($(this).val()));
		 });
		 

		$('#formAdd').validationEngine({
				beforeSuccess: function(){
					var a = parseInt($('#lastamount1').text());
					if( a < 0){
						alert("Reclass terlalu besar");
						return true;
					}else{
						return false;
					}
				},
			
				success: function(){
					$('#formAdd').ajaxSubmit({
						success: function(data){
							alert(String(data).replace(/<\/?[^>]+>/gi, ''));
							refreshTable();
						}
					});
					return false;
				}
		});		 		 
	});
</script>

<form action="<?=site_url($module_url.'/save_bgtreclass')?>" id="formAdd" method="post">
<!--File Hidden utk proses Post-->
<!-- Budget Pertama -->
<input type="hidden" id="cekthn"/> 
<input type="hidden" name="coahide1" id="coahide1"/>
<input type="hidden" name="jan1" id="jan1"/>
<input type="hidden" name="jan2" id="jan2"/>
<input type="hidden" name="jan3" id="jan3"/>
<input type="hidden" name="jan4" id="jan4"/>
<input type="hidden" name="jan5" id="jan5"/>
<input type="hidden" name="jan6" id="jan6"/>
<input type="hidden" name="jan7" id="jan7"/>
<input type="hidden" name="jan8" id="jan8"/>
<input type="hidden" name="jan9" id="jan9"/>
<input type="hidden" name="jan10" id="jan10"/>
<input type="hidden" name="jan11" id="jan11"/>
<input type="hidden" name="jan12" id="jan12"/>
<input type="text" name="totmst1" id="totmst1"/>

<!-- Budget Kedua -->
<input type="hidden" name="coahide2" id="coahide2"/>
<input type="hidden" name="feb1" id="feb1"/>
<input type="hidden" name="feb2" id="feb2"/>
<input type="hidden" name="feb3" id="feb3"/>
<input type="hidden" name="feb4" id="feb4"/>
<input type="hidden" name="feb5" id="feb5"/>
<input type="hidden" name="feb6" id="feb6"/>
<input type="hidden" name="feb7" id="feb7"/>
<input type="hidden" name="feb8" id="feb8"/>
<input type="hidden" name="feb9" id="feb9"/>
<input type="hidden" name="feb10" id="feb10"/>
<input type="hidden" name="feb11" id="feb11"/>
<input type="hidden" name="feb12" id="feb12"/>
<input type="text" name="totmst2" id="totmst2"/>
<span id="loading"></span>
<table style="padding:0 0 20 0">
	<tr>
		<?php
			$tgl = date("d-m-Y");
		?>
		<td>Tanggal</td>
		<td>:</td>
		<td>
			<input type="text" name="tgl" id="tgl" value="<?=$tgl?>" readonly="true" style="width:120px">		
		</td>
	</tr>
	<tr>
		<td>Tahun Budget</td>
		<td>:</td>
		<td>
			<select name="thn" id="thn" style="width:120px" class="validate[required]">
					<option></option>
				<?php for($i=2011;$i <= 2035;$i++): ?>
					<option><?=$i?></option>
				<?php endfor ?>
			</select>				
	    </td>
	</tr>	
	<tr>
		<td>Divisi</td>
		<td>:</td> 
		<td>
			<select name="divisi" id="cb_divisi" style="width:120px" class="validate[required]"></select>				
	    </td>	
	</tr>	
	</table>
	
	<div>
		<table border="0" cellspacing="4" cellpadding="4">
		    <tr>
				<td colspan="3" valign='center' align='center' bgcolor='black' style="width:300px"><font color='white'><b>Reclass From Budget</b></font></td>
				<td colspan="3" valign='center' align='center' bgcolor='black' style="width:300px"><font color='white'><b>Reclass To Budget</b></font></td>
		    </tr>
			<tr>
				<td>Desc Budget</td>
				<td>:</td> 
				<td>
					<select name="cb_budget" id="cb_budget" style="width:120px"></select>				
				</td>
				<td>Desc Budget</td>
				<td>:</td> 
				<td>
					<select name="cb_budget2" id="cb_budget2" style="width:120px" class="validate[required]"></select>				
				</td>			
			</tr>
			<tr>
				<td>Acc.Account</td>
				<td>:</td>
				<td><span id="coa1">-</span></td>
				<td>Acc.Account</td>
				<td>:</td>
				<td><span id="coa2">-</span></td>
			</tr>
			<tr>
				<td>Desc.Account</td>
				<td>:</td>
				<td><span id="descacc1">-</span></td>
				<td>Desc.Account</td>
				<td>:</td>
				<td><span id="descacc2">-</span></td>
			</tr>
			<tr>
				<td>Acc.Cf</td>
				<td>:</td>
				<td><span id="cf1">-</span></td>
				<td>Acc.Cf</td>
				<td>:</td>
				<td><span id="cf2">-</span></td>
			</tr>
			<tr>
				<td>Desc.Cf</td>
				<td>:</td>
				<td><span id="desccf1">-</span></td>
				<td>Desc.Cf</td>
				<td>:</td>
				<td><span id="desccf2">-</span></td>
			</tr>
			<tr>
				<td>Month</td>
				<td>:</td>
				<td>
					<select name="bln1" id="bln1" style="width:120px" class="validate[required]">
						<option></option>
						<?php
							for($i=1;$i<=12;$i++){
								$nama = "bgt".$i;
								$val = $bln[$i];
						?>
						<option value="<?=$nama?>"><?=$val?></option>
						<?php
							}
						?>
					</select>
				</td>
				<td>Month</td>
				<td>:</td>
				<td>
					<select name="bln2" id="bln2" style="width:120px" class="validate[required]">
						<option></option>
						<?php
							for($i=1;$i<=12;$i++){
								$nama = "bgt".$i;
								$val = $bln[$i];
						?>
						<option value="<?=$nama?>"><?=$val?></option>
						<?php
							}
						?>
					</select>
				</td>
			</tr>
			<tr>
				<td>Amount</td>
				<td>:</td>
				<td>
					<div style="padding:0 20 0 0">
						<span id="amount1">0</span>
					</div>
				</td>
				<td>Amount</td>
				<td>:</td>
				<td>
					<span id="amount2">0</span>
				</td>
			</tr>
			<tr>
				<td>Reclass Amount</td>
				<td>:</td>
				<td>
					<input type="text" name="classamount" id="classamount"  class="input calculate" value="0"/>
				</td>
				<td>Last Amount</td>
				<td>:</td>
				<td>
					<span id="lastamount2">0</span>
				</td>
			</tr>
			<tr>
				<td>Last Amount</td>
				<td>:</td>
				<td  colspan="3">
					<span id="lastamount1">0</span>
				</td>
			</tr>
			<tr>
				<td colspan="6">
				    <input type="text" name="tot1" id="tot1" value=""/>
				    <input type="text" name="tot2" id="tot2" value=""/>
					<input type="hidden" name="id_mst" value="<?=@$data->id_mst?>" />
					<input type="submit" value="Reclass" />
					<input type="button" id="btnClose" value="Cancel" />
				</td>
			</tr>
	    </table>
	</div>
</form>

