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
	
	$(document).ready(function(){
		$('#sell').attr('readonly',true);
		$('#nm').attr('readonly',true);
	});

	
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
	
	
	$('#aktif').click(function(){
		if($("#aktif").length == $("#aktif:checked").length) {
			$('#nm').attr('readonly',false);
		}else{
			$('#nm').attr('readonly',true);
		}
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
<input type="hidden" name="bank_id" value="<?=$data->tranbank_id?>"/>
<h1>Cek/Giro</h1>
<table border="0"  cellpadding="2" cellspacing="2">
<input type="hidden" name="tranbank_id" value="<?=$data->tranbank_id?>"/>
	<tr>
		<td>Cek / Giro</td>
		<td>:</td>
		<td>
			<select name="pil" class="xinput">
				<option>Check</option>
				<option>Giro</option>
			</select>
		</td>
	</tr>
	<tr>
		<td>Bank</td>
		<td>:</td>
		<td>
			<select name="bank"  class="xinput">
				<option value="bukopin">Bukopin</option>
				<option value="bri">BRI</option>
				<option value="mandiri">Mandiri</option>
			</select>
		</td>
	</tr>
	<tr>
		<td>Penagih</td>
		<td>:</td>
		<td>
			<input type="text" name="nm" id="nm" value="<?=$data->terimadari?>"/>
			<input type="checkbox" name="aktif" id="aktif"/>
		</td>
	</tr>		
	<tr>
		<td>Tanggal Giro / Cek</td>
		<td>:</td>
		<td>
			<input type="text" name="tgl" id="tgl" class="xinput validate[required]" readonly="true"/>
			<a href="JavaScript:;" onClick="return showCalendar('tgl', 'dd-mm-y');" title="Pilih Tanggal" ><img src="<?=base_url()?>assets/js/ico_calendar.gif" alt="s"/></a>
		</td>
	</tr>
	<tr>
		<td>Tanggal Kliring</td>
		<td>:</td>
		<td>
			<input type="text" name="tglklr" id="tglklr" class="xinput" readonly="true"/>
			<a href="JavaScript:;" onClick="return showCalendar('tglklr', 'dd-mm-y');" title="Pilih Tanggal" >
			<img src="<?=base_url()?>assets/js/ico_calendar.gif" alt="s"/></a>
		</td>
	</tr>	
	<tr>
		<td>Nomor Cek</td>
		<td>:</td>
		<td><input type="text" maxlength="12" name="no_cek" id="no_cek" class="validate[required]" value=""/></td>
	</tr>	
	<tr>
		<td>No. Rekening Tujuan</td>
		<td>:</td>
		<td colspan="5"><input type="text" name="norek" id="norek" value="" /></td>
	</tr>
	<tr>
		<td>Nama Bank Tujuan</td>
		<td>:</td>
		<td><input type="text" name="nb" id="nb" value=""/></td>
	</tr>		
	<tr>
		<td colspan="3"><b>Voucher Description</b></td>
	</tr>
	<tr>
		<td>No Voucher</td>
		<td>:</td>
		<td><input type="text" name="" value="<?=$data->nomor?>" readonly></td>
	</tr>	
	<tr>
		<td>Jumlah</td>
		<td>:</td>
		<td><input type="text" name="jml" id="jml" value="<?=number_format($data->bank_out)?>" readonly/></td>
	</tr>				
	<tr>
		<td colspan="3"><input type="submit" name="print" value="Print"/></td>
	</tr>
</table>

</form>
