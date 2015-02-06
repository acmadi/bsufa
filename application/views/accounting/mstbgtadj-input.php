<script language="javascript" src="<?=base_url()?>assets/js/jquery.numeric.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/currency.js"></script>
<link rel="stylesheet" href="<?=base_url()?>assets/css/menuku.css" type="text/css" />
<script language="javascript" src="<?=base_url()?>assets/js/calendar.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/calendar2.js"></script>
<link rel="stylesheet" href="<?=base_url()?>assets/css/calendar.css" type="text/css" />

<script language="javascript">
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
		//Variable Global
		var kugiri = new RegExp(",", "g");
		
		$(document).ready(function() {
			$('.numall').attr("readonly",true);
			$('#nilall').hide();
			$('#chkall').hide();
		});
		
	loadData('divisi',0,''); 	
	$('#cb_divisi').change( 
		function(){
			if($('#cb_divisi option:selected').val() != '' && $('#thn option:selected').val() != ''){
				loadData('budget',$('#cb_divisi option:selected').val(),$('#thn').val());
			}else{
				alert("tahun belum di isi");
			}
		});


	  //Cek Tahun Budget
	  $('select[name=thn]').change(function(){
		  var thnval = $('#thn').val();
		  $.post("<?=site_url('mstbgtadj/cekthn')?>",
		  {'thn':thnval},
		  function(response){
			  if(response == "gagal"){
				  alert('Tahun Belum ada, Please Check');
			  }
			  //alert(response);
		  });
	  });	

	
	  $('#nilall').change(function(){
		  $('.numall').val($(this).val());
		  var total = 0;
		  var curbgt1 = parseInt($('#curbgt1').text().replace(kugiri,""));
		  var bgtadj1 = parseInt($('#bgtadj1').val().replace(kugiri,""));
		  var curbgt2 = parseInt($('#curbgt2').text().replace(kugiri,""));
		  var bgtadj2 = parseInt($('#bgtadj2').val().replace(kugiri,""));
		  var curbgt3 = parseInt($('#curbgt3').text().replace(kugiri,""));
		  var bgtadj3 = parseInt($('#bgtadj3').val().replace(kugiri,""));
		  var curbgt4 = parseInt($('#curbgt4').text().replace(kugiri,""));
		  var bgtadj4 = parseInt($('#bgtadj4').val().replace(kugiri,""));
		  var curbgt5 = parseInt($('#curbgt5').text().replace(kugiri,""));
		  var bgtadj5 = parseInt($('#bgtadj5').val().replace(kugiri,""));
		  var curbgt6 = parseInt($('#curbgt6').text().replace(kugiri,""));
		  var bgtadj6 = parseInt($('#bgtadj6').val().replace(kugiri,""));
		  var curbgt7 = parseInt($('#curbgt7').text().replace(kugiri,""));
		  var bgtadj7 = parseInt($('#bgtadj7').val().replace(kugiri,""));
		  var curbgt8 = parseInt($('#curbgt8').text().replace(kugiri,""));
		  var bgtadj8 = parseInt($('#bgtadj8').val().replace(kugiri,""));
		  var curbgt9 = parseInt($('#curbgt9').text().replace(kugiri,""));
		  var bgtadj9 = parseInt($('#bgtadj9').val().replace(kugiri,""));
		  var curbgt10 = parseInt($('#curbgt10').text().replace(kugiri,""));
		  var bgtadj10 = parseInt($('#bgtadj10').val().replace(kugiri,""));
		  var curbgt11 = parseInt($('#curbgt11').text().replace(kugiri,""));
		  var bgtadj11 = parseInt($('#bgtadj11').val().replace(kugiri,""));
		  var curbgt12 = parseInt($('#curbgt12').text().replace(kugiri,""));
		  var bgtadj12 = parseInt($('#bgtadj12').val().replace(kugiri,""));
		
		  // Hasil Budget Origin dan Adjustment
		  var totbgt1 = curbgt1   + bgtadj1;
		  var totbgt2 = curbgt2   + bgtadj2;
		  var totbgt3 = curbgt3   + bgtadj3;
		  var totbgt4 = curbgt4   + bgtadj4;
		  var totbgt5 = curbgt5   + bgtadj5;
		  var totbgt6 = curbgt6   + bgtadj6;
		  var totbgt7 = curbgt7   + bgtadj7;
		  var totbgt8 = curbgt8   + bgtadj8;
		  var totbgt9 = curbgt9   + bgtadj9;
		  var totbgt10 = curbgt10 + bgtadj10;
		  var totbgt11 = curbgt11 + bgtadj11;
		  var totbgt12 = curbgt12 + bgtadj12;
		  var totbgtall = totbgt1 + totbgt2 + totbgt3 + totbgt4 +
		  totbgt5 + totbgt6 + totbgt7 + totbgt8 + totbgt9 + totbgt10 +
		  totbgt11 + totbgt12;
		  $('.numall').each(function(){
			  var itung = parseInt($(this).val().replace(kugiri,""));
			  total += itung;
		  });
		  $('#curbgt1').text(numToCurr(totbgt1));
		  $('#curbgt2').text(numToCurr(totbgt2));
		  $('#curbgt3').text(numToCurr(totbgt3));
		  $('#curbgt4').text(numToCurr(totbgt4));
		  $('#curbgt5').text(numToCurr(totbgt5));
		  $('#curbgt6').text(numToCurr(totbgt6));
		  $('#curbgt7').text(numToCurr(totbgt7));
		  $('#curbgt8').text(numToCurr(totbgt8));
		  $('#curbgt9').text(numToCurr(totbgt9));
		  $('#curbgt10').text(numToCurr(totbgt10));
		  $('#curbgt11').text(numToCurr(totbgt11));
		  $('#curbgt12').text(numToCurr(totbgt12));
		  $('#totmstadj').text(numToCurr(total));
		  $('#curtot_mst').text(numToCurr(totbgtall));
		  
		//Input File
		  $('#curbgthide1').val(numToCurr(totbgt1));
		  $('#curbgthide2').val(numToCurr(totbgt2));
		  $('#curbgthide3').val(numToCurr(totbgt3));
		  $('#curbgthide4').val(numToCurr(totbgt4));
		  $('#curbgthide5').val(numToCurr(totbgt5));
		  $('#curbgthide6').val(numToCurr(totbgt6));
		  $('#curbgthide7').val(numToCurr(totbgt7));
		  $('#curbgthide8').val(numToCurr(totbgt8));
		  $('#curbgthide9').val(numToCurr(totbgt9));
		  $('#curbgthide10').val(numToCurr(totbgt10));
		  $('#curbgthide11').val(numToCurr(totbgt11));
		  $('#curbgthide12').val(numToCurr(totbgt12));
		  $('#curtot_msthide').val(numToCurr(totbgtall));		  
	  });
	  
	 $('select[name=chkinput]').change(function(){
			if($('#chkinput option:selected').val()=='All'){
				$('.numall').attr("readonly",true);
				$('#totmstadj').attr("readonly",true);
				$('#nilall').attr("readonly",false);
			}else{
				$('#nilall').attr("readonly",true);
				$('.numall').attr("readonly",false);
			}
	  });
	  
	  $('.numall').change(function(){
		  var total = 0;
		  $('.numall').each(function(){
			  var itung = parseInt($(this).val().replace(kugiri,""));
			  total += itung;
		  });
		  //alert(total);
		  $('#totmstadj').text(numToCurr(total));
		  $('#totmstadjhide').val(total);
		  
	  });
	  
	  $('#chkall').click(function(){
		  if ($('#chkall:checked').val() !== undefined) {
			$('#nilall').show();
			$('.numall').attr("readonly",true);
		  }else{
			$('#nilall').hide();
			$('.numall').attr("readonly",false);
		  }
	  });

	  $('select[name=adj]').change(function(){
		  if($('#adj option:selected').val()=='C'){
			  $('.numall').attr("readonly",false);
			  $('#chkall').show();
		  }else if($('#adj option:selected').val()=='D'){
			  $('.numall').attr("readonly",false);
			  $('#chkall').show();
		  }else{
			  alert("error");
		  } 
	  });
	  
		
	  //Cek Current Budget
	  $('select[name=code]').change(function(){			
		  //Ambil Fungsi data  	 
		  $.getJSON('<?=site_url('mstbgtadj/datacurrent')?>/'+$(this).val(),
		  function(response){
			 $('#coahide').val(response.coa);
			 $('#coa').text(response.coa);
			 $('#coahide').val(response.acc);
			 $('#cfhide').val(response.cf);
			 $('#descbgt').text(response.descbgt);
			 $('#divisi_id').val(response.divisi_id);
			 $('#descbgthide').val(response.descbgt);
			 $('#kodebgt').text(response.kdbgt);
			 $('#bgt1').text(numToCurr(response.curbgt1));
			 $('#bgt2').text(numToCurr(response.curbgt2));
			 $('#bgt3').text(numToCurr(response.curbgt3));
			 $('#bgt4').text(numToCurr(response.curbgt4));
			 $('#bgt5').text(numToCurr(response.curbgt5));
			 $('#bgt6').text(numToCurr(response.curbgt6));
			 $('#bgt7').text(numToCurr(response.curbgt7));
			 $('#bgt8').text(numToCurr(response.curbgt8));
			 $('#bgt9').text(numToCurr(response.curbgt9));
			 $('#bgt10').text(numToCurr(response.curbgt10));
			 $('#bgt11').text(numToCurr(response.curbgt11));
			 $('#bgt12').text(numToCurr(response.curbgt12)); 
			 $('#tot_mst').text(numToCurr(response.curtot_mst)); 
			//Text File			   
			$('#curbgt1').text(numToCurr(response.curbgt1));
			$('#curbgt2').text(numToCurr(response.curbgt2));
			$('#curbgt3').text(numToCurr(response.curbgt3));
			$('#curbgt4').text(numToCurr(response.curbgt4));
			$('#curbgt5').text(numToCurr(response.curbgt5));
			$('#curbgt6').text(numToCurr(response.curbgt6));
			$('#curbgt7').text(numToCurr(response.curbgt7));
			$('#curbgt8').text(numToCurr(response.curbgt8));
			$('#curbgt9').text(numToCurr(response.curbgt9));
			$('#curbgt10').text(numToCurr(response.curbgt10));
			$('#curbgt11').text(numToCurr(response.curbgt11));
			$('#curbgt12').text(numToCurr(response.curbgt12));
			$('#curtot_mst').text(numToCurr(response.curtot_mst));
		  });
	  });	
		
	  $('.calculate').bind('keyup keypress',function(){
			//var total = 0;
			$(this).val(numToCurr($(this).val()));
			
			//Clear
			/*$('#bgtadj1').val(0);
			$('#bgtadj2').val(0);
			$('#bgtadj3').val(0);
			$('#bgtadj4').val(0);
			$('#bgtadj5').val(0);
			$('#bgtadj6').val(0);
			$('#bgtadj7').val(0);
			$('#bgtadj8').val(0);
			$('#bgtadj9').val(0);
			$('#bgtadj10').val(0);
			$('#bgtadj11').val(0);
			$('#bgtadj12').val(0);*/
			
			//Amount bulan
			var jan = parseInt($('#bgt1').text().replace(kugiri,""));
			var feb = parseInt($('#bgt2').text().replace(kugiri,""));
			var mar = parseInt($('#bgt3').text().replace(kugiri,""));
			var apr = parseInt($('#bgt4').text().replace(kugiri,""));
			var mei = parseInt($('#bgt5').text().replace(kugiri,""));
			var jun = parseInt($('#bgt6').text().replace(kugiri,""));
			var jul = parseInt($('#bgt7').text().replace(kugiri,""));
			var agus = parseInt($('#bgt8').text().replace(kugiri,""));
			var sep = parseInt($('#bgt9').text().replace(kugiri,""));
			var okt = parseInt($('#bgt10').text().replace(kugiri,""));
			var nov = parseInt($('#bgt11').text().replace(kugiri,""));
			var des = parseInt($('#bgt12').text().replace(kugiri,""));
			// Total Original Budget
			var total = jan + feb + mar + apr + mei + jun + jul + agus + sep + okt + nov + des;
						
			//Amount Adjust
			var bgtadj1 = parseInt($('#bgtadj1').val().replace(kugiri,""));
			var bgtadj2 = parseInt($('#bgtadj2').val().replace(kugiri,""));
			var bgtadj3 = parseInt($('#bgtadj3').val().replace(kugiri,""));
			var bgtadj4 = parseInt($('#bgtadj4').val().replace(kugiri,""));
			var bgtadj5 = parseInt($('#bgtadj5').val().replace(kugiri,""));
			var bgtadj6 = parseInt($('#bgtadj6').val().replace(kugiri,""));
			var bgtadj7 = parseInt($('#bgtadj7').val().replace(kugiri,""));
			var bgtadj8 = parseInt($('#bgtadj8').val().replace(kugiri,""));
			var bgtadj9 = parseInt($('#bgtadj9').val().replace(kugiri,""));
			var bgtadj10 = parseInt($('#bgtadj10').val().replace(kugiri,""));
			var bgtadj11 = parseInt($('#bgtadj11').val().replace(kugiri,""));
			var bgtadj12 = parseInt($('#bgtadj12').val().replace(kugiri,""));
			// Total Original Budget
			var totalbgtadj = bgtadj1 + bgtadj2 +bgtadj3 + bgtadj4 + bgtadj5 + bgtadj6
			 + bgtadj7 + bgtadj8 + bgtadj9 + bgtadj10 + bgtadj11 + bgtadj12;
							

			//proses pengurangan dan penjumlahan
			if($('#adj option:selected').val()=="C"){
				var jumbgt1  = jan + bgtadj1;
				var jumbgt2  = feb + bgtadj2;
				var jumbgt3  = mar + bgtadj3;
				var jumbgt4  = apr + bgtadj4;
				var jumbgt5  = mei + bgtadj5;
				var jumbgt6  = jun + bgtadj6;
				var jumbgt7  = jul + bgtadj7;
				var jumbgt8  = agus + bgtadj8;
				var jumbgt9  = sep + bgtadj9;
				var jumbgt10 = okt + bgtadj10;
				var jumbgt11 = nov + bgtadj11;
				var jumbgt12 = des + bgtadj12;
			}else{
				var jumbgt1 = jan - bgtadj1;
				var jumbgt2  = feb - bgtadj2;
				var jumbgt3  = mar - bgtadj3;
				var jumbgt4  = apr - bgtadj4;
				var jumbgt5  = mei - bgtadj5;
				var jumbgt6  = jun - bgtadj6;
				var jumbgt7  = jul - bgtadj7;
				var jumbgt8  = agus - bgtadj8;
				var jumbgt9  = sep - bgtadj9;
				var jumbgt10 = okt - bgtadj10;
				var jumbgt11 = nov - bgtadj11;
				var jumbgt12 = des - bgtadj12;
			}
			var totalall = jumbgt1 + jumbgt2 + jumbgt3 + jumbgt4 + jumbgt5 + jumbgt6
						   + jumbgt7 + jumbgt8 + jumbgt9 
						   + jumbgt10 + jumbgt11 + jumbgt12;
			//Text File			   
			$('#curbgt1').text(numToCurr(jumbgt1));
			$('#curbgt2').text(numToCurr(jumbgt2));
			$('#curbgt3').text(numToCurr(jumbgt3));
			$('#curbgt4').text(numToCurr(jumbgt4));
			$('#curbgt5').text(numToCurr(jumbgt5));
			$('#curbgt6').text(numToCurr(jumbgt6));
			$('#curbgt7').text(numToCurr(jumbgt7));
			$('#curbgt8').text(numToCurr(jumbgt8));
			$('#curbgt9').text(numToCurr(jumbgt9));
			$('#curbgt10').text(numToCurr(jumbgt10));
			$('#curbgt11').text(numToCurr(jumbgt11));
			$('#curbgt12').text(numToCurr(jumbgt12));
			$('#curtot_mst').text(numToCurr(totalall));
			
			//Input File
			$('#curbgthide1').val(numToCurr(jumbgt1));
			$('#curbgthide2').val(numToCurr(jumbgt2));
			$('#curbgthide3').val(numToCurr(jumbgt3));
			$('#curbgthide4').val(numToCurr(jumbgt4));
			$('#curbgthide5').val(numToCurr(jumbgt5));
			$('#curbgthide6').val(numToCurr(jumbgt6));
			$('#curbgthide7').val(numToCurr(jumbgt7));
			$('#curbgthide8').val(numToCurr(jumbgt8));
			$('#curbgthide9').val(numToCurr(jumbgt9));
			$('#curbgthide10').val(numToCurr(jumbgt10));
			$('#curbgthide11').val(numToCurr(jumbgt11));
			$('#curbgthide12').val(numToCurr(jumbgt12));
			$('#curtot_msthide').val(numToCurr(totalall));
						
			$('#tot_mst').val(numToCurr(total));
			$('#totmstadjhide').val(totalbgtadj);
			$('#totmstadj').text(numToCurr(totalbgtadj));
		  });
	});
	
	$(function(){
			//Proses Form
			$('#formAdd')
			.validationEngine()
			.ajaxForm({
				success:function(response){
					alert(response);
					$('#btnReset').click();
				}
			});		
			 
		$('#btnClose').click(function(){
			$.validationEngine.closePrompt(".formError",true)
			refreshTable();
		});
			
	});
</script>
<form method="POST" action="<?=site_url($module_url.'/save_bgt')?>" id="formAdd" >
<!--File Hidden utk proses Post-->
<input type="hidden" name="descbgt" id="descbgthide"/>
<input type="hidden" name="cf" id="cfhide"/>
<input type="hidden" name="coa" id="coahide"/>
<input type="hidden" name="totmstadj" id="totmstadjhide" value="0"/>
<input type="hidden" name="curbgthide1" id="curbgthide1" value="0"/>
<input type="hidden" name="curbgthide2" id="curbgthide2" value="0"/>
<input type="hidden" name="curbgthide3" id="curbgthide3" value="0"/>
<input type="hidden" name="curbgthide4" id="curbgthide4" value="0"/>
<input type="hidden" name="curbgthide5" id="curbgthide5" value="0"/>
<input type="hidden" name="curbgthide6" id="curbgthide6" value="0"/>
<input type="hidden" name="curbgthide7" id="curbgthide7" value="0"/>
<input type="hidden" name="curbgthide8" id="curbgthide8" value="0"/>
<input type="hidden" name="curbgthide9" id="curbgthide9" value="0"/>
<input type="hidden" name="curbgthide10" id="curbgthide10" value="0"/>
<input type="hidden" name="curbgthide11" id="curbgthide11" value="0"/>
<input type="hidden" name="curbgthide12" id="curbgthide12" value="0"/>
<input type="hidden" name="curtot_msthide" id="curtot_msthide" value="0"/>
<input type="hidden" name="divisi_id" id="divisi_id"/>

<span id="loading"></span>
<table style="padding:0 0 20 0">
	<tr>
		<td>Tanggal</td>
		<td>:</td>
		<td>
		    <?php
				$tgl = date("d-m-Y");
		    ?>
			<input type="text" name="tgl" id="tgl" readonly="true" value="<?=$tgl?>">		
		</td>
	    <td>Kode.Account</td>
	    <td>:</td>
	    <td><span id="kodebgt">-</span></td>
	</tr>
	<tr>
		<td>Thn.Budget</td>
		<td>:</td> 
		<td>
			<select name="thn" id="thn" style="width:150px" class="validate[required]">
					<option></option>
				<?php for($i=2010;$i <= 2030;$i++): ?>
					<option><?=$i?></option>
				<?php endfor ?>
			</select>				
	    </td>
	    <td>Kode.Desc</td>
	    <td>:</td>
	    <td><span id="descbgt">-</span></td>
	</tr>
	<tr>
		<td>Divisi</td>
		<td>:</td> 
		<td>
			<select name="divisi" id="cb_divisi" style="width:150px" class="validate[required]"></select>				
	    </td>
	    <td style="width:100px">Acc.Account</td>
	    <td>:</td>
	    <td><span id="coa">-</span></td>
	</tr>	
	<tr>
		<td>Desc Budget</td>
		<td>:</td> 
		<td>
			<select name="code" id="cb_budget" style="width:150px" class="validate[required]"></select>				
	    </td>
	    <td style="width:100px">Acc.Desc</td>
	    <td>:</td>
	    <td><span id="">-</span></td>
	</tr>	
	<tr>
		<td>Trans. Adj</td>
		<td>:</td> 
		<td>
			<select name="adj" id="adj" style="width:150px" class="validate[required]">
				<option></option>
				<option value="C">Penambahan</option>
				<option value="D">Pengurangan</option>
			</select>				
	    </td>
	    <td style="width:100px">Cf.Account</td>
	    <td>:</td>
	    <td><span id="cf">-</span></td>
	</tr>
	<tr>
		<td>All</td>
		<td>:</td> 
		<td><input type="checkbox" name="chkall" id="chkall" value="All"/>
			<input type="text" name="nilall" id="nilall" class="calculate input"/>
		</td>
	    <td style="width:100px">Cf.Desc</td>
	    <td>:</td>
	    <td><span id="">-</span></td>
	</tr>
	</table>	
	<table>
	<tr>
	    <td style="width:100"></td>
		<td  valign='center' align='center' bgcolor='black' style="width:300px"><font color='white'><b>Original Budget</b></font></td>
		<td  valign='center' align='center' bgcolor='black' style="width:300px"><font color='white'><b>Adjustment</b></font></td>
		<td  valign='center' align='center' bgcolor='black' style="width:300px"><font color='white'><b>Current Budget</b></font></td>
	</tr>
	<tr>
		<td><b>Januari</b></td>
		<td align="right"><span id="bgt1">0</span></td>
		<td align="right"><input type="text" name="bgtadj1" id="bgtadj1" value="0" class="calculate numall input" style="width:120px"/></td>
		<td align="right"><span id="curbgt1">0</span></td>
	</tr>
	<tr>
		<td><b>Febuari</b></td>
		<td align="right"><span id="bgt2">0</span></td>
		<td align="right"><input type="text" name="bgtadj2" id="bgtadj2" value="0" class="calculate numall input" style="width:120px"/></td>
		<td align="right"><span id="curbgt2">0</span></td>
	</tr>
	<tr>
		<td><b>Maret</b></td>
		<td align="right"><span id="bgt3">0</span></td>
		<td align="right"><input type="text" name="bgtadj3" id="bgtadj3" value="0" class="calculate numall input" style="width:120px"/></td>
		<td align="right"><span id="curbgt3">0</span></td>
	</tr>
	<tr>
		<td><b>April</b></td>
		<td align="right"><span id="bgt4">0</span></td>
		<td align="right"><input type="text" name="bgtadj4" id="bgtadj4" class="numall calculate input" value="0" style="width:120px"/></td>
		<td align="right"><span id="curbgt4">0</span></td>
	</tr>
	<tr>
		<td><b>Mei</b></td>
		<td align="right"><span id="bgt5">0</span></td>
		<td align="right"><input type="text" name="bgtadj5" id="bgtadj5" class="numall calculate input" value="0" style="width:120px"/></td>
		<td align="right"><span id="curbgt5">0</span></td>
	</tr>
	<tr>
		<td><b>Juni</b></td>
		<td align="right"><span id="bgt6">0</span></td>
		<td align="right"><input type="text" name="bgtadj6" id="bgtadj6" class="numall calculate input" value="0" style="width:120px"/></td>
		<td align="right"><span id="curbgt6">0</span></td>
	</tr>
	<tr>
		<td><b>Juli</b></td>
		<td align="right"><span id="bgt7">0</span></td>
		<td align="right"><input type="text" name="bgtadj7" id="bgtadj7" class="numall calculate input" value="0" style="width:120px"/></td>
		<td align="right"><span id="curbgt7">0</span></td>
	</tr>
	<tr>
		<td><b>Agustus</b></td>
		<td align="right"><span id="bgt8">0</span></td>
		<td align="right"><input type="text" name="bgtadj8" id="bgtadj8" class="numall calculate input" value="0" style="width:120px"/></td>
		<td align="right"><span id="curbgt8">0</span></td>
	</tr>
	<tr>
		<td><b>September</b></td>
		<td align="right"><span id="bgt9">0</span></td>
		<td align="right"><input type="text" name="bgtadj9" id="bgtadj9" class="numall calculate input" value="0" style="width:120px"/></td>
		<td align="right"><span id="curbgt9">0</span></td>
	</tr>
	<tr>
		<td><b>Oktober</b></td>
		<td align="right"><span id="bgt10">0</span></td>
		<td align="right"><input type="text" name="bgtadj10" id="bgtadj10" class="numall calculate input" value="0" style="width:120px"/></td>
		<td align="right"><span id="curbgt10">0</span></td>
	</tr>
	<tr>
		<td><b>November</b></td>
		<td align="right"><span id="bgt11">0</span></td>
		<td align="right"><input type="text" name="bgtadj11" id="bgtadj11" class="numall calculate input" value="0" style="width:120px"/></td>
		<td align="right"><span id="curbgt11">0</span></td>
	</tr>
	<tr>
		<td><b>Desember</b></td>
		<td align="right"><span id="bgt12">0</span></td>
		<td align="right"><input type="text" name="bgtadj12" id="bgtadj12" class="numall calculate input" value="0" style="width:120px"/></td>
		<td align="right"><span id="curbgt12">0</span></td>
	</tr>
	<tr>
		<td colspan="6" bgcolor="black"></td>
	</tr>
	<tr>
		<td><b>Total</b></td>
		<td align="right"><span id="tot_mst">0</span></td>
		<td align="right"><span id="totmstadj">0</span></td>
		<td align="right"><span id="curtot_mst">0</span></td>
	</tr>
	<tr>
		<td colspan="6" bgcolor="black"></td>
	</tr>
	<tr>
		<td  colspan="4">
			<input type="hidden" name="id_mst" value="<?=@$data->id_mst?>" />
			<input type="submit" name="submit" value="Adjustment" />
			<input type="button" id="btnClose" value="Cancel" />
		</td>
	</tr>
</table>
</form>
