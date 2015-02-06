<?php
$session_id = $this->UserLogin->isLogin();
$divisi = $session_id['divisi_id'];
$level = $session_id['level_id'];
?>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.numeric.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/currency.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/calendar.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/calendar2.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.confirm.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jsalert.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.formx.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.validationEngine-enx.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.validationEnginex.js"></script>
<link rel="stylesheet" href="<?=base_url()?>assets/css/jquery-ui.css" type="text/css" />
<link rel="stylesheet" href="<?=base_url()?>assets/css/calendar.css" type="text/css" />
<script language="javascript">

$(document).ready(function(){
	//$('#submit').attr("disabled", true);
	$('#aju_cuti').attr("disabled", true);
	$('#balanced').val('0');
	$('#lama_cuti').val('0');
});

$(function(){
	// Check NIP
	$('select[name=nip]').change(function(){
		//Json 1
		$.getJSON('<?=site_url('tblkarycuti/hitung')?>/'+$(this).val(),
			function(data){
				$('#cuti_pakai').val(data.jml);
				}
		);
	
	
		
		//Json 2
		$.getJSON('<?=site_url('tblkarycuti/data')?>/'+$(this).val(),
			function(data){		
				$('#divisi').val(data.divisi_nm);
				$('#jabatan').val(data.karyjab_nm);
				$('#join').val(data.tgl_join);
				$('#saldo_cuti').val(data.saldo_cuti);
				$('#cuti_bersama').val(data.cuti_bersama);
				$('#id_karylvl').val(data.id_karylvl);						
				$('#totcuti').val(data.cuti_aju);
				$('#id_div').val(data.id_divisi);
				$('#id_up').val(data.id_up);
				
				var a = $('#saldo_cuti').val();
				var b = $('#cuti_bersama').val();
				var c = $('#cuti_pakai').val();
				
				var d = parseInt(a) - parseInt(b) - parseInt(c) ; 
				
				$('#sisa').val(d);
				
				
				
				if($('#cb_karycutijns option:selected').val() == '2'){
					$('#saldo_cuti').val('0');
					$('#cuti_bersama').val('0');
					$('#totcuti').val('0');
					$('#sisa').val('0');
					$('#balanced').val('0');
					$('#cuti_pakai').val('0');
					}
				});	
		} );
		// End NIP
	
	//Ajuan Cuti	
	$('#aju_cuti').click(function(){
		var a = $('#sisa').val();
		var b = $('#aju_cuti').val();
		var c = parseInt(a) -  parseInt(b);
		$('#balanced').val(c);
		if(c < 0) {
			$('#balanced').val(c);
			//alert("Hub Admin HRD, Cuti Anda Melebihi Batas");
		}
	} );
	//End Ajuan Cuti
	
	
		
		
		
		
		
//Dropdown Menu
function loadData(type,parentId){
	  $('#loading').text('Loading '+type.replace('_','/')+' data...');
      $.post('<?=site_url('tblkarycuti/loaddata')?>',
		{data_type: type, parent_id: parentId},
		function(data){
		  $('#lama_cuti').val(data.lama_cuti);
		  
		  if(data.error == undefined){ 
			 $('#cb_'+type).empty();
			 $('#cb_'+type).append('<option></option>');
			 for(var x=0;x<data.length;x++){
			 	$('#cb_'+type).append($('<option></option>').val(data[x].id).text(data[x].nama));
			 }
			 $('#loading').text('');
		  }else{
			 alert(data.error);
			 $('#cb_karycutials').text('');
		  }
		},'json' 
      );      
   }
   
$(function(){
	loadData('karycutijns',0); 	
	$('#cb_karycutijns').change( 
		function(){
			if($('#cb_karycutijns option:selected').val() != ''){
				$('#aju_cuti').attr("disabled", true);
				loadData('karycutials',$('#cb_karycutijns option:selected').val());
			}
				if($('#cb_karycutijns option:selected').val() == '1'){	
					$('#aju_cuti').attr("disabled", false);
					$('#lama_cuti').val('0');
				}else{
					$('#aju_cuti').val('');
					$('#saldo_cuti').val('0');
					$('#cuti_bersama').val('0');
					$('#totcuti').val('0');
					$('#sisa').val('0');
					$('#balanced').val('0');
					$('#cuti_pakai').val('0');
				}
				
			});
		});

	$('#cb_karycutials').change(function(){
		$.getJSON('<?=site_url('tblkarycuti/istimewa')?>/'+$(this).val(),
				function(data){
					    $('#lama_cuti').val(data.lama_cuti);
					   
				});
		 });
	
	// aju cuti	 
	//~ $('#delegasi').change(function(){
		//~ var awal = $('#tgl_mulai').val();
		//~ var akhir = $('#tgl_akhir').val();
		//~ //alert('tes');
		//~ //json isi aju cuti
		//~ $.getJSON('<?=site_url('tblkarycuti/ajucuti')?>/'+awal+'/'+akhir,
			//~ function(ajucuti){
				//~ //alert(ajucuti.aju);
				//~ $('#aju_cuti').val(ajucuti.aju);
				//~ var a = $('#sisa').val();
		//~ var b = $('#aju_cuti').val();
		//~ var c = parseInt(a) -  parseInt(b);
		//~ $('#balanced').val(c);
		//~ if(c < 0) {
			//~ $('#balanced').val(c);
			//~ //alert("Hub Admin HRD, Cuti Anda Melebihi Batas");
		//~ }
				//~ 
			//~ });
		//~ 
		//~ 
		//~ });
			 
	
	//end Drop Down
	
	//cek_tanggal
	
		
					
	
	
	
	//end tanggal
	
	
	
	//Cek input ket& validasi
	$('#ket').bind('keypress',function(){
		
		var BB = $('#balanced').val();
		var varbil1 = $('#tgl_aju').val();
		var varbil2 = $('#tgl_mulai').val();
		var varbil3 = $('#tgl_akhir').val();
		var varbil4 = $('#tgl_msk').val();
		var divisi_id = $('#divisi_id').val();
	
		$.getJSON('<?=site_url('tblkarycuti/cek_tanggal')?>/'+varbil1+'/'+varbil2+'/'+varbil3+'/'+varbil4,
				function(data){	
					var nil = data.jml;
					var nul = data.jml1;
					var nol = data.jml2;
					
						if ($('#cb_karycutijns option:selected').val() == '1'){
						
							if(divisi_id == 1){
								$('#submit').attr("disabled", false);
							}else{
								if(BB <= 0)				
									{alert('Hub Admin HRD, Balanced cuti Anda ('+BB+')');}
								else if (varbil2 == '')
									{alert('Harap mengisi tgl awal cuti');}
								else if (varbil3 == '')
									{alert('Harap mengisi tgl akhir cuti');}
								else if (varbil4 == '')		
									{alert('Harap mengisi tgl masuk kerja');}
								else if(nil <= 7){
									alert('Harap cek kembali tgl mulai cuti anda')}
								else if(nul <= 0){
									alert('Harap cek kembali tgl akhir cuti anda')}
								else if(nol <= 0){
									alert('Harap cek kembali tgl masuk kerja anda')}
								else
									{$('#submit').attr("disabled", false);}
							}
					}else {
							
							if(divisi_id == 1){
								$('#submit').attr("disabled", false);
							}else{
								if (varbil2 == '')
									{alert('Harap mengisi tgl awal cuti');}
								else if (varbil3 == '')
									{alert('Harap mengisi tgl akhir cuti');}
								else if (varbil4 == '')		
									{alert('Harap mengisi tgl masuk kerja');}
								else if(nil <= 7){
									alert('Harap cek kembali tgl mulai cuti anda')}
								else if(nul <= 0){
									alert('Harap cek kembali tgl akhir cuti anda')}
								else if(nol <= 0){
									alert('Harap cek kembali tgl masuk kerja anda')}
								else
									{$('#submit').attr("disabled", false);}
							  }
							}
					
					});
		});
	//End input Ket		
	
	// aju cuti
	
		
		
	$(function(){
		$('#formAdd')
		.validationEngine()
		.ajaxForm({
			success:function(response){
				if(response == 4){
					alert("Data Berhasil Disimpan");
					refreshTable();
				}else{
				    alert(response);
				}
			}
		});	
	});	
});

</script>

<form method="post" id="formAdd" action="<?=base_url()?>tblkarycuti/insert_cuti_admin">
<input type='hidden' name='idtgl' id='idtgl'>
<input type='hidden' name='id_user' value='<?php echo $id_user ?>'>
<input type='hidden' name='id_pt' value='<?php echo $id_pt ?>'>
<input type='hidden' name='karycutipar' value='<?php echo $id_karycutipar ?>'>
<input type='hidden' name="id_karylvl"  id="id_karylvl">
<input type='hidden' name="id_div"  id="id_div">
<input type="hidden"  id="divisi_id" value="<?=$divisi?>"/>
<input type="hidden" name="id_up"  id="id_up">
 

<table>
	
	<tr> 
		<td >Request Date</td>
		<td>:</td>
			<?php $tgl = date("d-m-Y");  ?>
		<td ><input type="text" name="request_date" id="tgl_aju" value="<?=$tgl?>"  style="width:100px" readonly="true"></td>    
		<td >Saldo Cuti</td>
		<td>:</td>
		<td ><input name="saldo_cuti" style="width:50"type=text readonly=true id="saldo_cuti" value=0>Hari</td>
			
	</tr>
	<tr > 
		<td >Jenis Cuti</td>
		<td>:</td>
		<td ><select name="jns_cuti" id='cb_karycutijns' class="validate[required]"></select>
			</td>
		<td >Cuti Bersama</td>
		<td>:</td>
		<td ><input name="cuti_bersama" style="width:50"type=text readonly=true id="cuti_bersama" value=0>Hari</td>
		

		
	</tr>
	<tr > 
		<td >Alasan Cuti Istimewa</td>
		<td>:</td>
		<td >
		<select name="cuti_kat" id="cb_karycutials"></select>
		</td>
		
		<td >Cuti Terpakai</td>
		<td>:</td>
		<td ><input name="cuti_pakai" style="width:50" type="text" readonly=true id="cuti_pakai" value ="0">Hari</td>
   
		
	</tr>
	<tr > 
		<td >Hari Cuti Istimewa</td>
		<td>:</td>
		<td >
		<input name="lama_cuti" style="width:20" readonly=true id="lama_cuti" >Hari</td>
		
		<td colspan='3' ></td>
		
		
	</tr>
	
	
	<tr>
		<td >Nama Karyawan</td>
		<td >:</td>
		<td >
				<select name="nip">
					<option>Select Name</option>
					<?php foreach ($karycuti1 as $row):?>
						<option value=<?php echo $row->id_kary ?>>
							<?php echo $row->nama;?>
						</option>
					<?php endforeach ?>
				</select></td>
		
	</tr>
 
    <tr > 
		<td><font size=2 face=Tahoma> Jabatan </font></td>
		<td>:</td>
		<td ><input name="jabatan" style="width:250"type=text readonly=true id="jabatan"></td>
		
   
   </tr>
   
    

	<tr> 
		<td ><font size=2 face=Tahoma> Divisi/Departemen </font></td>
		<td>:</td>
		<td><input name="divisi" style="width:250"type=text readonly=true id="divisi"></td>
		<td width='22%'>Pengajuan Cuti Thn.</td>
		<td>:</td>
		<td>
<!--
			<input type="text" id="aju_cuti" name ="aju_cuti" readonly=true style="width:50">
-->
			<select name='aju_cuti' id='aju_cuti' class="validate[required]"><option></option>
				<?php for ($i=1;$i<=12;$i++){ ?>
					<option><?php echo $i ?></option>
					<? } ?></select>Hari
					
					</td>
	</tr>
   

   <tr > 
		<td ><font size=2 face=Tahoma> Masuk Kerja </font></td>
		<td>:</td>
		<td ><input name="join" style="width:250" type="text" readonly="true" id="join" ></td>
		<td width=>Balanced Awal Cuti</td>
		<td>:</td>
		<td><input name="sisa" style="width:50"type=text readonly=true id="sisa" value=0>Hari</td>

   </tr>
   <tr > 
       <td colspan='3'>Dengan Ini Mengajukan Ijin Tidak Masuk Kerja (Cuti)</td>
		<td width=>Balanced akhir Cuti</td>
		<td>:</td>
		<td><input name="balanced" id='balanced' style="width:50"type=text readonly=true >Hari</td>
   </tr>
 
   <tr > 
		<td > Mulai tanggal </td>
		<td>:</td>
		<td colspan='2'>
		<input name="tgl_mulai" class="validate[required]" style="width:100"type="text" readonly="true" id="tgl_mulai">
		<a href="JavaScript:;" onClick="return showCalendar('tgl_mulai', 'dd-mm-y');" title="Pilih Tanggal" > <img src="<?=base_url()?>assets/js/ico_calendar.gif" alt="s"/></a></td>
        <span id="alert1" font-color="red"></span>   
   </tr>
	<tr> 
		<td > Sampai dengan tanggal </td>
		<td>:</td>
		<td colspan='2'><input name="tgl_akhir" class="validate[required]" style="width:100"type=text readonly=true id="tgl_akhir">
		<a href="JavaScript:;" onClick="return showCalendar('tgl_akhir', 'dd-mm-y');" title="Pilih Tanggal" id="tes"> <img src="<?=base_url()?>assets/js/ico_calendar.gif" alt="s"/></a></td>
		
   </tr>
   
   <tr > 
		<td > Masuk tanggal </td>
		<td>:</td>
		<td colspan='2'><input name="tgl_msk" style="width:100"type=text class="validate[required]" readonly=true id="tgl_msk">
		<a href="JavaScript:;" onClick="return showCalendar('tgl_msk', 'dd-mm-y');" title="Pilih Tanggal" > <img src="<?=base_url()?>assets/js/ico_calendar.gif" alt="s"/></a></td>
		
   </tr>
   
	<tr>
    <td >Delegasi Kepada</td>
		<td >:</td>
		<td colspan="4" >
			<select name='delegasi' id="delegasi" class="validate[required]">
				<option></option>
				<?php foreach ($karycuti1 as $row):?>
				<option><?php echo $row->nama;?></option>
				<?php endforeach ?>
				</select>
		</td>
	</tr>
	 
   
   
  

   

	<tr > 
		<td width='22%'>Keterangan</td>
		<td>:</td>
		<td colspan='2'><input name="ket" style="width:400" type="text"  id="ket" class="validate[required]" ></td>
   </tr>


	<tr>
		<td>&nbsp;</td>
		<td colspan="3">
		<input type="submit" name="simpan" value="Proses Cuti" id="submit">
		<input type="reset" name="batal" value="Clear"><span id="alert"></span></td>
	</tr>
	
</table>
</form>


 



