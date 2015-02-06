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
<link rel="stylesheet" href="<?=base_url()?>assets/css/menuku.css" type="text/css" />


<script type="text/javascript">
$(function(){
$(document).ready(function() {
	$('#cat').attr("disabled", true);
	$('input[name=proses]').attr("disabled", true);

    $('input[name=ajuan]').click(function() {
		$('#cat').attr("disabled", false);
    });

    $('#cat').change(function() {
		$('input[name=proses]').attr("disabled", false);
    });
	
	var jns = $('#id_jnscuti').val();
		if (jns == '2')	
			{	$('#saldo_cuti').text('0');
			$('#cuti_bersama').text('0');
			$('#cuti_pakai').text('0');
			$('#sisa').text(0);
			$('#balanced').text(0);
			$('#cuti_pakai').text(0);
			$('#cuti_aju').text(0);
		}
		
	var id = $('input[name=id_kary]').val();
	$.getJSON('<?=site_url('tblkarycuti/hitung')?>/'+id,
		function(data){
			//alert(data.jml);
			var jns = $('#id_jnscuti').val();
			if(jns == '2')
				$('#cuti_pakai').text(0);
			else
				$('#cuti_pakai').text(data.jml);
				var a = $('#saldo_cuti').text();
				var b = $('#cuti_bersama').text();
				var c = $('#cuti_pakai').text();
				var d = parseInt(a) - parseInt(b) - parseInt(c) ;
				var e = $('#cuti_aju').text();
				$('#sisa').text(d);
				var f =  parseInt(d) - parseInt(e); 
				$('#balanced').text(f);		
	});

});


});
</script>

<input  type="hidden" name="id_kary" value="<?=@$view['kary_id']?>">
<input  type="hidden" name="id_jnscuti" id='id_jnscuti' value="<?=@$view['jns_cuti']?>">
<input  type="hidden"  name="ngaran" id='ngaran'>

 
<table>
	
	<tr> 
		<td >Request Date</td>
		<td>:</td>
			<?php $tgl = date("d-m-Y");  ?>
		<td ><?=@$data->tgl_aju?></td>
    
		<td >Saldo Cuti</td>
		<td>:</td>
		<td ><span id="saldo_cuti"><?=@$view['saldo_cuti']?></span>Hari</td>
	
	
	</tr>
	<tr > 
		<td >Jenis Cuti</td>
		<td>:</td>
		<td ><?=@$view['karycutijns_nm']?></td>
		<td >Cuti Bersama</td>
		<td>:</td>
		<td ><span id="cuti_bersama"><?=@$view['cuti_bersama']?></span>Hari</td>
		
		
	</tr>
	<tr > 
		<td >Alasan Cuti Istimewa</td>
		<td>:</td>
		<td ><?=@$view['karycutials_nm']?></td>
		
		<td >Cuti Terpakai</td>
		<td>:</td>
		<td ><span id='cuti_pakai'></span>Hari</td>
	</tr>
	
	<tr > 
		<td >Hari Cuti Istimewa</td>
		<td>:</td>
		<td ><span id=""><?=@$view['lama_cuti']?></span>Hari</td>
		<td colspan='3' ></td>
	</tr>
	
	<tr>
		<td >Nama Karyawan</td>
		<td >:</td>
		<td ><?=@$data->nama?></td>
		
	</tr>
 
    <tr > 
		<td><font size=2 face=Tahoma> Jabatan </font></td>
		<td>:</td>
		<td><?=@$view['karyjab_nm']?></td>
   </tr>
    
	<tr> 
		<td ><font size=2 face=Tahoma> Divisi/Departemen </font></td>
		<td>:</td>
		<td><?=@$data->divisi_nm?></td>
		<td width='22%'>Cuti yang akan diajukan</td>
		<td>:</td>
		<td><span id="cuti_aju"><?=@$data->aju_cuti?></span>Hari</td>
	</tr>
   

   <tr > 
		<td ><font size=2 face=Tahoma> Masuk Kerja </font></td>
		<td>:</td>
		<td ><?=@$data->tgl_join?></td>
		<!--<td width=>Balanced Awal Cuti</td>
		<td>:</td>
		<td><span id="sisa"></span>Hari</td>-->

   </tr>
   <tr > 
       <td colspan='3'><b>Dengan Ini Mengajukan Ijin Tidak Masuk Kerja (Cuti)</b></td>
		<!--<td width=>Balanced akhir Cuti</td>
		<td>:</td>
		<td><span id="balanced"></span>Hari</td>-->
   </tr>
 
   <tr > 
		<td > Mulai tanggal </td>
		<td>:</td>
		<td colspan='2'><?=@$view['startdate_cuti']?></td>
   </tr>
    
	<tr > 
		<td > Sampai dengan tanggal </td>
		<td>:</td>
		<td colspan='2'><?=@$view['enddate_cuti']?></td>
		
   </tr>
   
   <tr > 
		<td > Masuk tanggal </td>
		<td>:</td>
		<td colspan='2'><?=@$view['tgl_msk']?></td>
		
   </tr>
   
	<tr>
    <td >Delegasi Kepada</td>
		<td >:</td>
		<td colspan='4'><?=@$view['pic_delegasi']?></td>
	</tr>
	<tr > 
		<td width='22%'>Keterangan</td>
		<td>:</td>
		<td colspan='2'><?=@$view['catatan']?></td>
   </tr>
</table>

