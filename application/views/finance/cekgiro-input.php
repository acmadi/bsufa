<link rel="stylesheet" href="<?=base_url()?>assets/css/menuformx.css" type="text/css" />
<script language="javascript" src="<?=base_url()?>assets/js/jquery.numeric.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/currency.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/calendar.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/calendar2.js"></script>
<link rel="stylesheet" href="<?=base_url()?>assets/css/calendar.css" type="text/css" />
<script type="text/javascript">
   function loadData(type,parentId){
	  // berikan kondisi sedang loading data ketika proses pengambilan data
	  $('#loading').text('Loading '+type.replace('_','/')+' data...');
      $.post('<?=site_url('cekgiro/loaddata')?>', //request ke fungsi load data di inputAP
		{data_type: type, parent_id: parentId},
		function(data){
		  if(data.error == undefined){ // jika respon error tidak terdefinisi maka pengambilan data sukses 
			 $('#'+type).empty(); // kosongkan dahulu combobox yang ingin diisi datanya
			 $('#'+type).append('<option>-Pilih data-</option>'); // buat pilihan awal pada combobox
			 for(var x=0;x<data.length;x++){
				// berikut adalah cara singkat untuk menambahkan element option pada tag <select>
			 	$('#'+type).append($('<option></option>').val(data[x].id).text(data[x].nama));
			 }
			 $('#loading').text(''); // hilangkan text loading
		  }else{
			 alert(data.error); // jika ada respon error tampilkan alert
			 //$('#').text('');
		  }
		},'json' // format respon yang diterima langsung di convert menjadi JSON 
      );      
   }

$(function(){ 
	loadData('project',0); 	 
	
	
	$('#project').change(function(){
		if($('#project option:selected').val() != '')
			loadData('trans',$('#project option:selected').val());		
	});

	$('#trans').change(function(){
		var tagihan = $('#trans option:selected').val()
		var kugiri = new RegExp(",", "g");
		//alert(tagihan);
		$.getJSON('<?=site_url('cekgiro/cekit')?>/'+tagihan,
		   function(respon){
			   $('#no_cek').val(respon.nomor_cek);
			   $('#jml').val(numToCurr(respon.bank_out));
			   $('#nm').val(respon.terimadari);
			   
		   }
		 );
	});
	
	
	$(document).ready(function(){
		$('#sell').attr('readonly',true);
	});
		
	$('.calculate').bind('keyup keypress',function(){
		$(this).val(numToCurr($(this).val()));
	 }).numeric();	

	 //Proses Form
	$('#formAdd')
	.validationEngine()
	.ajaxForm({
		success:function(response){
			//alert(response);
			//$('#btnReset').click();
			if(response=='sukses'){
				alert(response);
				refreshTable();
			}else{
				alert(response);
			}
		}
	});		
			 
	$('#btnClose').click(function(){
		$.validationEngine.closePrompt(".formError",true)
		refreshTable();
	});
	
});
</script>


<link rel="stylesheet" href="<?=base_url()?>assets/css/menuformx.css" type="text/css" />
<form method="post" action="<?=site_url('cekgiro/cekgiro_view')?>" id="formadd" target="_blank">
<table width="746" border="0" align="center" cellpadding="2" cellspacing="2">
	<tr>
	  <td colspan="2"><span><u><span><img src="<?=base_url()?>/assets/images/bakrie.JPG" width="74" height="78"></span></u></span></td>
	  <td colspan="5"><span>
	    </span><h1 align="left"><font size="6" face="verdana">Cek / Giro</font></h1> 
	</tr>
	<tr>
		<td>Project</td>
		<td>:</td>
		<td colspan="5"><select name="project" id="project" class="xinput"></select></td>
	</tr>
	<tr>
		<td>No Transaksi</td>
		<td>:</td>
		<td colspan="5"><select name="trans" id="trans" class="xinput"></select></td>
	</tr>
	<tr>
		<td>Nomor Cek</td>
		<td>:</td>
		<td colspan="5"><input type="text" name="no_cek" id="no_cek" value="" readonly/></td>
	</tr>
	<tr>
		<td>Jumlah</td>
		<td>:</td>
		<td colspan="5"><input type="text" name="jml" id="jml" value="" readonly/></td>
	</tr>
	<tr>
		<td>Atas nama</td>
		<td>:</td>
		<td colspan="5"><input type="text" name="nm" id="nm" value="" readonly/></td>
	</tr>
	<tr>
		<td>Cek / Giro</td>
		<td>:</td>
		<td colspan="5">
			<select name="pil" class="xinput">
				<option value="cek">Cek</option>
				<option value="giro">Giro</option>
			</select>
		</td>
	</tr>		
	<tr>
		<td>Bank</td>
		<td>:</td>
		<td colspan="5">
			<select name="bank"  class="xinput">
				<option value="bukopin">Bukopin</option>
				<option value="btn">BTN</option>
				<option value="mandiri">Mandiri</option>
				<option value="mega">Mega</option>
			</select>
		</td>
	</tr>
	<tr> <td>-- Jika giro -------------------</td></tr>
	<tr>
		<td>Tanggal Giro</td>
		<td>:</td>
		<td colspan="5">
			<input type="text" name="tgl" id="tgl" class="xinput" readonly="true"/>
			<a href="JavaScript:;" onClick="return showCalendar('tgl', 'dd-mm-y');" title="Pilih Tanggal" >			</a><a href="JavaScript:;" onClick="return showCalendar('tgl', 'dd-mm-y');" title="Pilih Tanggal" ><img src="<?=base_url()?>assets/js/ico_calendar.gif" alt="s"/></a>
		</td>

	</tr>
	<tr>
		<td>No. Rekening Tujuan</td>
		<td>:</td>
		<td colspan="5"><input type="text" name="norek" id="norek" value="" /></td>
	</tr>
	<tr>
		<td>Nama Bank Tujuan</td>
		<td>:</td>
		<td colspan="5"><input type="text" name="nb" id="nb" value="" /></td>
	</tr>	
	<tr>
		<td colspan="7"><input type="submit" name="print" value="Print"/></td>
	</tr>
</table>

</form>
