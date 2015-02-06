<script language="javascript" src="<?=base_url()?>assets/js/calendar.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/calendar2.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.formx.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.validationEngine-enx.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.validationEnginex.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.numeric.js"></script>
<link rel="stylesheet" href="<?=base_url()?>assets/css/calendar.css" type="text/css" />
<link rel="stylesheet" href="<?=base_url()?>assets/css/menuku.css" type="text/css" />
<?=link_tag(CSS_PATH.'styletable.css')?>
<script language="javascript">
	$(document).ready(function(){
		$(".showBybutton").hide();
		$(".hideByproses").hide();

		
		$(".enddates").blur(function(){
			var date1	 = new Date (db_tgl($("#startdate").val()));
			var date2	 = new Date (db_tgl($("#enddate").val()));
			
			if(date1=="Invalid Date"){
				alert("Tanggal Awal Belum Terisi");
				$("#enddate").val("");
				return false;
			}
			var jmlmonth = monthDiff(date1, date2);
			
			var outs = $("#outstanding").val();
			
			var Kpb  = parseInt(outs) / parseInt(jmlmonth); //kisaran perbulan
			
			//format currency
			var DecimalSeparator = Number("1.2").toLocaleString().substr(1,1);
			var AmountWithCommas = Kpb.toLocaleString();
			var arParts = String(AmountWithCommas).split(DecimalSeparator);
			var intPart = arParts[0];
			var decPart = (arParts.length > 1 ? arParts[1] : '');
			decPart = (decPart).substr(0,0);
			var id_sp = $('#id_sp').val();
			var kisaran = 'Rp ' + intPart + DecimalSeparator + decPart;
			$(".kisaran_perbulan").html(kisaran);
			$(".diffmount").html(jmlmonth + " Kali"); //selisih bulanar
			//alert(Kpb+' '+jmlmonth);
			var start = (document.pform.startdate.value);
			var end   = (document.pform.enddate.value);
			
			$("loadtest").load("<?php echo site_url()?>finance/reschedule/reschedule_view/"+start+'/'+end+'/'+jmlmonth+"/"+Kpb+"/"+id_sp);
			
			$("#loading_proses").hide();
			$(".hideByproses").show();
			$('.diffmount').val(jmlmonth);
		});
		$("#resch").click(function(){
			//alert("ha");
			var start = (document.pform.startdate.value);
			var end   = (document.pform.enddate.value);
			$("loadtest").load("<?php echo site_url()?>finance/reschedule/reschedule_view/"+start+"/"+end);
			$(".hideByproses").show();
		});
		
		
		//$("#proses_reschedule").click(function(){							// Dalam Proses
		$("#resch").click(function(){							// Dalam Proses
			var outs = $("#outstanding").val();								// nilai outstanding
			var tgl1  = new Date (db_tgl($("#startdate").val()));			// tgl pertama
			var tgl2  = new Date (db_tgl($("#enddate").val()));				// tgl kedua
			var id_sp = $("#id_sp").val();									//
			var mdf   = monthDiff(tgl1, tgl2);								// jumlah selisih bulan
			var ppm   = parseInt(outs) / parseInt(mdf);						// besarnya nilai Rp
			
			var tgl_1  = db_tgl($("#startdate").val());						// tgl pertama
			var tgl_2  = db_tgl($("#enddate").val());						// tgl kedua
			
			if(tgl_1=="undefined-undefined-" || tgl_2=="undefined-undefined-"){
				alert("Tanggal Kosong");
				//$("loadtest").hide();
				$(".hideByproses").hide();
				return false;
			}else{
			

				
				
				
			}
		
		});
		
		$("#proses_reschedule").click(function(){
			$.ajax({
					url		:'<?php echo site_url();?>finance/reschedule/proses_reschedule',
					type	:'post',
					data	:{'id_sp': id_sp,
							  'tgl_1' : tgl_1,
							  'tgl_2' : tgl_2,
							  'ppm'	 : ppm,
							  'mdf'  : mdf
					},
					success	:function(data){
						if(data){
							alert(data);
							$("#loading_proses").html('');
							$(".biaya_angsuran_sekarang").html(mdf);
							$(".hideBybutton").hide();
							$(".showBybutton").show();
							$(".hideByproses").show();
							$("#startdate").val("");
							$("#enddate").val("");
							$(".kisaran_perbulan").html("");
							$(".diffmount").html(""); 
						}
					}
				});
		
		});
		
		$("#close_window").click(function(){
		//alert("ho");
		refreshTable();
		
		});
		
	});
	
	function db_tgl(t){
		var x = t.split('-');
		var d = x[0];
		var m = x[1];
		var t = x[2];
		return t +"-"+ m +"-"+ d;
	}
	
	function monthDiff(d1, d2) {
		var months;
		months = (d2.getFullYear() - d1.getFullYear()) * 12;
		months -= d1.getMonth();
		months += d2.getMonth();
		return months <= 0 ? 0 : months;
	}
</script>
<style>
.button-click{
	background: #FF7C26;
	padding: 5px 10px;
	border-radius: 2px;
	-moz-border-radius: 2px;
	-webkit-border-radius:2px;
	border: 0px;
	color: #FFF;
	width:100px;
	cursor:pointer;
}
</style>

<form method="post" id="formAdd" action="<?=base_url()?>finance/cancelunit/proses_reschedule" name="pform"> 
<table border="0" cellpadding="1" cellspacing="2" width="100%" style="font-family:Verdana;font-size:11px;font-style:normal">
	<tr bgcolor="#FF7C26" height="25px">
		<td colspan="7">
			<b>&nbsp;Reschudle A/n : <?=$row->customer_nama?></b>
		</td>
	</tr>
	<tr bgcolor="#FFCC99" height="35px">
		<td width="12%" align="center">Sp No</td>
		<td width="10%" align="center">Unit No</td>
		<td width="13%" align="center">Telah di Angsur</td>
		<td width="13%" align="center">Sisa Angsuran</td>
		<td width="20%" align="center">Selling Price</td>
		<td width="20%" align="center">Paid</td>
		<td width="20%" align="center">Out Standing</td>
	</tr>
	<tr bgcolor="#FFFFFF" height="25px">
		<td align="center"><?=$row->no_sp?></td>
		<td align="center"><?=$row->unit_no?></td>
		<td align="center"><?=$pernah_angsuran->jml;?> x </td>
		<td align="center">
			<span class="hideBybutton"><?=$sisa_angsuran->jml;?> x </span>
			<span class="showBybutton">
				<span class="biaya_angsuran_sekarang"></span>
			</span>
		</td>
		<td align="center"><?=number_format($row->selling_price);?></td>
		<td align="center"><?=number_format($paid->paid);?></td>
		<td align="center"><?=number_format($outs->out_standing);?></td>
	</tr>
	<tr height="35px"><td colspan="6">&nbsp;</td></tr>
	<tr>
		<td colspan="6">
			Periode &nbsp;&nbsp;&nbsp;
			<input type="text" name="startdate" id="startdate" class="xinput validate[required]" readonly="true">
			<a href="JavaScript:;" onClick="return showCalendar('startdate', 'dd-mm-y');" title="Pilih Tanggal" > <img src="<?=base_url()?>assets/js/ico_calendar.gif" alt="s"/></a>
			&nbsp;&nbsp;&nbsp;&nbsp; s/d &nbsp;&nbsp;&nbsp;&nbsp;
			<input type="text" name="enddate" id="enddate" class="xinput validate[required]" readonly="true">
			<a class="enddates" href="JavaScript:;" onClick="return showCalendar('enddate', 'dd-mm-y');" title="Pilih Tanggal" > <img class="click_date" src="<?=base_url()?>assets/js/ico_calendar.gif" alt="s"/></a>
		</td>
	</tr>
	<!--tr height="35px"><td colspan="6">&nbsp;</td></tr-->
	<tr>
		<td colspan="6">
			Reschedule Pembayaran : <span class="diffmount"></span> 
		</td>
	</tr>
	<tr>
		<td colspan="6">
			Kisaran Pembayaran per-bulan : <span class="kisaran_perbulan"></span>
		</td>
	</tr>
	<tr height="35px"><td colspan="6"><input type="hidden" class="button-click" name="resch" id="resch" value="billing schedule"/></td></tr>
	
	
	<tr>
	<td colspan="7"><loadtest></loadtest></td>
	</tr>
	
	<tr>
		<td colspan="6">
			<!--&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -->
			<span class="hideByproses">
			<input type="submit" name="proses" class="button-click" value="Proses"> 
			<input type="button" name="close_window" id="close_window" class="button-click" value="Cancel">
			</span>
			<span id="loading_proses"></span>
		</td>
	</tr>
	<tr>
		<td>
			<input type="hidden" name="id_sp" id="id_sp" value="<?=$row->sp_id;?>"> <!-- id SP --><br>
			<input type="hidden" name="pernah_angsuran" id="pernah_angsuran" value="<?=$pernah_angsuran->jml;?>"> <!-- pernah angsuran sebanyak --><br>
			<input type="hidden" name="outstanding" id="outstanding" value="<?=$outs->out_standing;?>"> <!-- nilai outstanding --><br>
			<input type="hidden" name="diffmount" class="diffmount"> <!-- Selisih Bulan -->
		</td>
	</tr>
</table>

</form>

 



