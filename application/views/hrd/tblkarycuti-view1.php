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
			{	$('#saldo_cuti').val('0');
			$('#cuti_bersama').val('0');
			$('#cuti_pakai').val('0');
			$('#sisa').val(0);
			$('#balanced').val(0);
			$('#cuti_pakai').val(0);
		}
		
	var id = $('input[name=id_kary]').val();
	$.getJSON('<?=site_url('tblkarycuti/hitung')?>/'+id,
		function(data){
			//alert(data.jml);
			var jns = $('#id_jnscuti').val();
			if(jns == '2')
				$('#cuti_pakai').val(0);
			else
				$('#cuti_pakai').val(data.jml);
			var a = $('#saldo_cuti').val();
			var b = $('#cuti_bersama').val();
			var c = $('#cuti_pakai').val();
			var d = parseInt(a) - parseInt(b) - parseInt(c) ;
			var e = $('#cuti_aju').val();
			$('#sisa').val(d);
			var f =  parseInt(d) - parseInt(e); 
			$('#balanced').val(f);		
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
		<td ><input  value="<?=@$data->tgl_aju?>"  style="width:100px" readonly="true"></td>
    
		<td >Saldo Cuti</td>
		<td>:</td>
		<td ><input value="<?=@$view['saldo_cuti']?>" id="saldo_cuti" style="width:50"type=text readonly=true >Hari</td>
	
	
	</tr>
	<tr > 
		<td >Jenis Cuti</td>
		<td>:</td>
		<td ><input value="<?=@$joinall['karycutijns_nm']?>" readonly=true></select>
			</td>
		<td >Cuti Bersama</td>
		<td>:</td>
		<td ><input value="<?=@$joinall['cuti_bersama']?>" id="cuti_bersama" style="width:50"type=text readonly=true>Hari</td>
		
		
	</tr>
	<tr > 
		<td >Alasan Cuti Istimewa</td>
		<td>:</td>
		<td >
		<input name='als_cuti' value="<?=@$joinall['karycutials_nm']?>"  style="width:200" type=text readonly=true></td>
		
		<td >Cuti Terpakai</td>
		<td>:</td>
		<td ><input name='cuti_pakai' id='cuti_pakai' style="width:50" type="text" readonly=true >Hari</td>
   
		
	</tr>
	
	<tr > 
		<td >Hari Cuti Istimewa</td>
		<td>:</td>
		<td >
		<input value="<?=@$joinall['lama_cuti']?>" style="width:20" readonly=true  >Hari</td>
		
		<td colspan='3' ></td>
		
		
	</tr>
	<tr>
		<td >Nama Karyawan</td>
		<td >:</td>
		<td >
				<input value="<?=@$data->nama?>" style="width:200"type=text readonly=true></td>
		
	</tr>
 
    <tr > 
		<td><font size=2 face=Tahoma> Jabatan </font></td>
		<td>:</td>
		<td ><input value="<?=@$joinall['karyjab_nm']?>" style="width:200"type=text readonly=true ></td>
		
   
   </tr>
    

	<tr> 
		<td ><font size=2 face=Tahoma> Divisi/Departemen </font></td>
		<td>:</td>
		<td><input value="<?=@$data->divisi_nm?>" style="width:200"type=text readonly=true></td>
		<td width='22%'>Cuti yang akan diajukan</td>
		<td>:</td>
		<td><input value="<?=@$data->aju_cuti?>" id="cuti_aju" style="width:30"type=text readonly=true>Hari</td>
	</tr>
   

   <tr > 
		<td ><font size=2 face=Tahoma> Masuk Kerja </font></td>
		<td>:</td>
		<td ><input value="<?=@$data->tgl_join?>"style="width:200"type=text readonly=true ></td>
		<td width=>Balanced Awal Cuti</td>
		<td>:</td>
		<td><input name="sisa" id="sisa" style="width:50"type=text readonly=true >Hari</td>

   </tr>
   <tr > 
       <td colspan='3'>Dengan Ini Mengajukan Ijin Tidak Masuk Kerja (Cuti)</td>
		<td width=>Balanced akhir Cuti</td>
		<td>:</td>
		<td><input name="balanced"  id="balanced" style="width:50"type=text readonly=true >Hari</td>
   </tr>
 
   <tr > 
		<td > Mulai tanggal </td>
		<td>:</td>
		<td colspan='2'>
		<input value="<?=@$joinall['startdate_cuti']?>" style="width:100"type=text readonly=true ></td>
   </tr>
    
	<tr > 
		<td > Sampai dengan tanggal </td>
		<td>:</td>
		<td colspan='2'><input value="<?=@$joinall['enddate_cuti']?>" style="width:100"type=text readonly=true ></td>
		
   </tr>
   
   <tr > 
		<td > Masuk tanggal </td>
		<td>:</td>
		<td colspan='2'><input value="<?=@$joinall['tgl_msk']?>"style="width:100"type=text readonly=true ></td>
		
   </tr>
   
	<tr>
    <td >Delegasi Kepada</td>
		<td >:</td>
		<td colspan='4' >
				<input value="<?=@$view['pic_delegasi']?>" style="width:200"type=text readonly=true></td>
	</tr>
   
   
  

   

	<tr > 
		<td width='22%'>Keterangan</td>
		<td>:</td>
		<td colspan='2'><input value="<?=@$joinall['ket_cuti']?>" style="width:250"type=text readonly=true  ></td>
   </tr>



	
</table>

