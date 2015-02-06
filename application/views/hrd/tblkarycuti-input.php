<?php
$session_id = $this->UserLogin->isLogin();
$kary_id = $session_id['kary_id'];
$data = $this->mstmodel->datakary($kary_id);
$cekcuti = $this->mstmodel->hitung_cuti($kary_id);
if($cekcuti->jml==NULL)
	$jml = 0;
else
	$jml = $cekcuti->jml;
	

$sisa_awal = @$data->saldo_cuti - @$data->cuti_bersama - $jml;
?>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.numeric.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/currency.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/calendar.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/calendar2.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.confirm.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jsalert.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.formx.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.formx.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.validationEngine-enx.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.validationEnginex.js"></script>
<link rel="stylesheet" href="<?=base_url()?>assets/css/jquery-ui.css" type="text/css" />
<link rel="stylesheet" href="<?=base_url()?>assets/css/calendar.css" type="text/css" />
<link rel="stylesheet" href="<?=base_url()?>assets/css/menuku.css" type="text/css" />
<script language="javascript">

$(document).ready(function(){
	//$('#submit').attr("disabled", true);
	$('#aju_cuti').attr("disabled", true);
	$('#balanced').val('0');
	$('#lama_cuti').val('0');
	/*$('#tgl_mulai').val('0');
	$('#tgl_akhir').val('0');
	$('#tgl_msk').val('0');*/
});

$(function(){
	// Check NIP
	
	//Ajuan Cuti	
	$('#aju_cuti').change(function(){
		var a = $('#sisa').text();
		var b = $('#aju_cuti').val();
		var c = parseInt(a) -  parseInt(b);
		$('#balanced').text(c);
		$('#hide_balanced').val(c);
		if(c < 0) {
			//$('#balanced').text(c);
			alert("Hub Admin HRD, Cuti Anda Melebihi Batas");
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
					$('#lama_cuti').text('0');
				}else{
					//$('#aju_cuti').text('');
					$('#saldo_cuti').text('0');
					$('#cuti_bersama').text('0');
					$('#totcuti').text('0');
					$('#sisa').text('0');
					$('#balanced').text('0');
					$('#cuti_pakai').text('0');
				}
				
			});
		});

	$('#cb_karycutials').change(function(){
		$.getJSON('<?=site_url('tblkarycuti/istimewa')?>/'+$(this).val(),
				function(data){
					    $('#span_lama_cuti').text(data.lama_cuti);
					    $('#lama_cuti').val(data.lama_cuti);
					   
				});
		 });
	
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
			//refreshTable();
			//$('#btnReset').click();
		}
		});	
	});	
	
	
});

</script>

<form method="post" id="formAdd" action="<?=base_url()?>tblkarycuti/insert_cuti">
<!-- Input File Hidden -->
<?php $tgl = date("d-m-Y");  ?>	
<input type="hidden" name="request_date" value="<?=$tgl?>" id="">
<input type="hidden" name="hide_balanced" value="" id="hide_balanced">
<input type="hidden" name="lama_cuti" value="" id="lama_cuti">
<input type="hidden" name="id_up" value="<?=@$data->id_up?>" id="id_up">
<input type="hidden" name="kary_id" value="<?=@$data->id_kary?>" id="kary_id">
<table border="0" cellpadding="2" cellspacing="2">
	<tr> 
		<td >Request Date2</td>
		<td>:</td>
		<td ><?=$tgl?></td>    
		<td >Saldo Cuti</td>
		<td>:</td>
		<td><span id="saldo_cuti"><?=@$data->saldo_cuti?></span>Hari</td>
			
	</tr>
	<tr > 
		<td >Jenis Cuti</td>
		<td>:</td>
		<td ><select name="jns_cuti" id='cb_karycutijns' style="width:150px" class="validate[required]"></select>
			</td>
		<td >Cuti Bersama</td>
		<td>:</td>
		<td><span id=""><?=@$data->cuti_bersama?></span>Hari</td>
		

		
	</tr>
	<tr > 
		<td >Alasan Cuti Istimewa</td>
		<td>:</td>
		<td>
		<select name="cuti_kat" id="cb_karycutials" style="width:150px"></select>
		</td>
		
		<td >Cuti Terpakai</td>
		<td>:</td>
		<td ><span id=""><?=$jml?></span>Hari</td>
	</tr>
	<tr > 
		<td >Hari Cuti Istimewa</td>
		<td>:</td>
		<td><span id="span_lama_cuti">0</span>Hari</td>
		
		<td>Sisa Cuti</td>
		<td>:</td>
		<td><span id="sisa"><?=$sisa_awal?></span>Hari</td>
		
	</tr>
	
	
	<tr>
		<td >Nama Karyawan</td>
		<td >:</td>
		<td ><?=@$data->nama?></td>
		
	</tr>
 
    <tr> 
		<td><font size=2 face="Tahoma"> Jabatan </font></td>
		<td>:</td>
		<td><?=@$data->karyjab_nm?></td>
   </tr>
   
    

	<tr> 
		<td ><font size="2" face="Tahoma"> Divisi/Departemen </font></td>
		<td>:</td>
		<td><?=@$data->divisi_nm?></td>
		<td width='22%'>Pengajuan Cuti Thn.</td>
		<td>:</td>
		<td><select name='aju_cuti' id='aju_cuti'class="validate[required]"><option></option>
				<?php for ($i=1;$i<=12;$i++){ ?>
					<option><?php echo $i ?></option>
					<? } ?></select>Hari</td>
	
	</tr>
   

   <tr > 
		<td><font size=2 face=Tahoma> Masuk Kerja </font></td>
		<td>:</td>
		<td><?=@indo_date($data->tgl_join)?></td>
		

   </tr>
   <tr > 
       <td colspan='3'><b>Dengan Ini Mengajukan Ijin Tidak Masuk Kerja (Cuti)</b></td>
		<!--td width=>Balanced akhir Cuti</td>
		<td>:</td>
		<td><span id="balanced">0</span>Hari</td-->
   </tr>
 
   <tr > 
		<td > Mulai tanggal </td>
		<td>:</td>
		<td colspan='2'>
		<input name="tgl_mulai" style="width:100" type="text" readonly="true" id="tgl_mulai" class="validate[required]">
		<a href="JavaScript:;" onClick="return showCalendar('tgl_mulai', 'dd-mm-y');" title="Pilih Tanggal" > <img src="<?=base_url()?>assets/js/ico_calendar.gif" alt="s"/></a></td>
        <span id="alert1" font-color="red"></span>   
   </tr>
	<tr> 
		<td > Sampai dengan tanggal </td>
		<td>:</td>
		<td colspan='2'><input name="tgl_akhir" class="validate[required]" style="width:100"type=text readonly=true id="tgl_akhir">
		<a href="JavaScript:;" onClick="return showCalendar('tgl_akhir', 'dd-mm-y');" title="Pilih Tanggal" > <img src="<?=base_url()?>assets/js/ico_calendar.gif" alt="s"/></a></td>
   </tr>
   
   <tr > 
		<td >Masuk tanggal </td>
		<td>:</td>
		<td colspan='2'><input name="tgl_msk" style="width:100"type=text class="validate[required]" readonly=true id="tgl_msk">
		<a href="JavaScript:;" onClick="return showCalendar('tgl_msk', 'dd-mm-y');" title="Pilih Tanggal" > <img src="<?=base_url()?>assets/js/ico_calendar.gif" alt="s"/></a></td>
		
   </tr>
   
	<tr>
    <td >Delegasi Kepada</td>
		<td >:</td>
		<td colspan='4' >
				<select name='delegasi' style="width:150px" id="delegasi" class="validate[required]">
					<option></option>
					<?php foreach ($karycuti1 as $row):?>
					<option value=<?php echo $row->nama;?>><?php echo $row->nama;?></option>
					<?php endforeach ?>
				</select></td>
	</tr>
	 
	<tr > 
		<td width='22%'>Keterangan</td>
		<td>:</td>
		<td colspan='2'><input name="ket" style="width:150" type="text"  id="ket" class="validate[required]" ></td>
   </tr>


	<tr>
		<td>&nbsp;</td>
		<td colspan="3">
		<input type="submit" name="simpan" value="Proses Cuti" id="submit">
		<input type="reset" name="batal" value="Clear"><span id="alert"></span></td>
	</tr>
	
</table>
</form>


 



