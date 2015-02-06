<script language="javascript" src="<?=base_url()?>assets/js/jquery.formx.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.validationEngine-enx.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.validationEnginex.js"></script>

<script type="text/javascript">
$(function(){
$(document).ready(function() {
	var jns = $('#id_jnscuti').val();
		if (jns == '2')	
			{	$('#saldo_cuti').val('0');
				$('#cuti_bersama').val('0');
				$('#cuti_pakai').val('0');
				$('#balancedawal').val('0');
				$('#balancedakhir').val('0');
				$('#cuti_aju').val('0')
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

	$(function(){
		$('#formAdd')
		.validationEngine()
		.ajaxForm({
			success:function(response){
			alert(response);
			refreshTable();
			$('#btnReset').click();
		}
		});	
	});
});
</script>

<form method="post" id="formAdd" action="<?=base_url()?>tblkaryappchief/approve"> 
<input  type="hidden" name="id_kary" value="<?=@$data->id_kary?>">
<input  type="hidden" name="chief_id" value="<?#=@$view['chief_id']?>">
<input  type="hidden" name="no_link" value="<?=@$data->no_link?>">
<input  type="hidden" name="id_approve"  value="<?#=@$view['id_karylvl']?>">
<input  type="hidden" name="id_jnscuti" id='id_jnscuti' value="<?#=@$view['jns_cuti']?>">
<?php
/*
$a = @$view['saldo_cuti'];
$b = @$view['cuti_bersama'];
$c = $a - $b;
//var_dump(@$jmlcuti['jml']);

$d = @$data->aju_cuti;
$e = $c - $d;
*/
?> 


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
		<td ><input value="<?=@$view['karycutijns_nm']?>" readonly=true></select>
			</td>
		<td >Cuti Bersama</td>
		<td>:</td>
		<td ><input value="<?=@$view['cuti_bersama']?>" id="cuti_bersama" style="width:50"type=text readonly=true>Hari</td>
		
		
	</tr>
	<tr > 
		<td >Alasan Cuti Istimewa</td>
		<td>:</td>
		<td >
		<input value="<?=@$view['karycutials_nm']?>" style="width:200"type=text readonly=true></select>
		</td>
		
		<td >Cuti Terpakai</td>
		<td>:</td>
		<td ><input name="cuti_pakai" id="cuti_pakai" style="width:50" type="text" readonly=true >Hari</td>
   
		
	</tr>
	<tr > 
		<td >Hari Cuti Istimewa</td>
		<td>:</td>
		<td >
		<input value="<?=@$view['lama_cuti']?>" style="width:20" readonly=true  >Hari</td>
		
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
		<td ><input value="<?=@$view['karyjab_nm']?>" style="width:200"type=text readonly=true ></td>
		
   
   </tr>
    

	<tr> 
		<td ><font size=2 face=Tahoma> Divisi/Departemen </font></td>
		<td>:</td>
		<td><input value="<?=@$view['divisi_nm']?>" style="width:200"type=text readonly=true></td>
		<td width='22%'>Cuti yang akan diajukan</td>
		<td>:</td>
		<td><input value="<?=@$view['aju_cuti']?>" style="width:30"type=text id="cuti_aju" readonly=true>Hari</td>
	</tr>
   

   <tr > 
		<td ><font size=2 face=Tahoma> Masuk Kerja </font></td>
		<td>:</td>
		<td ><input value="<?=@indo_date($data->tgl_join)?>"style="width:200"type=text readonly=true ></td>
		<td width=>Balanced Awal Cuti</td>
		<td>:</td>
		<td><input name="" id="sisa" style="width:50"type=text readonly=true >Hari</td>

   </tr>
   <tr > 
       <td colspan='3'>Dengan Ini Mengajukan Ijin Tidak Masuk Kerja (Cuti)</td>
		<td width=>Balanced akhir Cuti</td>
		<td>:</td>
		<td><input name="balanced"  id='balanced' style="width:50"type=text readonly=true >Hari</td>
   </tr>
 
   <tr > 
		<td > Mulai tanggal </td>
		<td>:</td>
		<td colspan='2'>
		<input value="<?=@indo_date($view['startdate_cuti'])?>" style="width:100"type=text readonly=true ></td>
   </tr>
    
	<tr > 
		<td > Sampai dengan tanggal </td>
		<td>:</td>
		<td colspan='2'><input value="<?=@indo_date($view['enddate_cuti'])?>" style="width:100"type=text readonly=true ></td>
		
   </tr>
   
   <tr > 
		<td > Masuk tanggal </td>
		<td>:</td>
		<td colspan='2'><input value="<?=@indo_date($view['tgl_msk'])?>"style="width:100"type=text readonly=true ></td>
		
   </tr>
   
	<tr>
    <td >Delegasi Kepada</td>
		<td >:</td>
		<td colspan='4' >
				<input value="<?=@$view['pic_delegasi']?>" style="width:200"type=text readonly=true></td>
	</tr>
	<tr> 
		<td width='22%'>Keterangan</td>
		<td>:</td>
		<td colspan='2'><input value="<?=@$view['ket_cuti']?>" style="width:250"type=text readonly=true  ></td>
   </tr>
   
	<tr>	
		<td width ='30%'>Apakah anda setuju untuk pengajuan cuti ini ??</td>
		<td>:</td>
		<td>
			<input type="radio" name="ajuan" value="setuju"> Setuju
			<input type="radio" name="ajuan" value="tolak"> Tolak
		</td>
	</tr>

	<tr>	
		<td width ='30%'>Catatan</td>
		<td>:</td>
		<td><input type="text" name="cat" id="cat" class="validate[required]"/></td>
	</tr>
   
	<tr>	
		<td></td>
		<td></td>
		<td>
			<input type="submit" name="proses" value="Proses">
		</td>
	</tr>
</table>
</form>

 



